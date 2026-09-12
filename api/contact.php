<?php
require_once __DIR__ . '/../includes/config.php';

/* ---------------- CORS (same-origin only) ---------------- */
$allowedOrigin = (string)parse_url(BASE_URL, PHP_URL_SCHEME) . '://' . (string)parse_url(BASE_URL, PHP_URL_HOST);
$requestOrigin = $_SERVER['HTTP_ORIGIN'] ?? '';
if ($requestOrigin !== '' && $requestOrigin === $allowedOrigin) {
    header('Access-Control-Allow-Origin: ' . $requestOrigin);
    header('Vary: Origin');
}
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

header('Content-Type: application/json');
header('Cache-Control: no-store');

const ENQ_MAX_FILE = 25 * 1024 * 1024; // 25 MB
const ENQ_ALLOWED_EXT = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'jpg', 'jpeg', 'png', 'gif', 'webp', 'dwg', 'dxf', 'step', 'stp', 'igs', 'zip', 'rar', 'txt', 'csv'];
const ENQ_RATE_LIMIT = 20; // submissions per IP per hour
const ENQ_RATE_WINDOW = 3600;

function enq_json(bool $ok, string $msg): void {
    echo json_encode(['success' => $ok, 'message' => $msg]);
    exit;
}

/* Simple per-IP rate limit stored in the system temp directory. */
function enq_rate_limited(?string $ip): bool {
    $ip = (string)$ip;
    if ($ip === '') return false;
    $dir = sys_get_temp_dir() . '/jags_enq';
    if (!is_dir($dir) && !@mkdir($dir, 0700, true)) {
        return false;
    }
    $window = (int)floor(time() / ENQ_RATE_WINDOW);
    $file   = $dir . '/' . $window . '-' . md5($ip) . '.count';
    $count  = is_file($file) ? (int)@file_get_contents($file) : 0;
    if ($count >= ENQ_RATE_LIMIT) {
        return true;
    }
    $fp = @fopen($file, 'c+');
    if ($fp) {
        if (flock($fp, LOCK_EX)) {
            clearstatcache();
            $count = (int)stream_get_contents($fp);
            $count++;
            rewind($fp);
            ftruncate($fp, 0);
            fwrite($fp, (string)$count);
            fflush($fp);
            flock($fp, LOCK_UN);
        }
        fclose($fp);
    }
    return false;
}

// If the whole POST body exceeds PHP's configured limit, PHP discards all
// fields and files. Detect it early so we can still return clean JSON.
function ini_bytes(string $val): int {
    $val = trim($val);
    if ($val === '') return 0;
    $unit = strtolower($val[strlen($val) - 1]);
    $num  = (float)$val;
    switch ($unit) {
        case 'g': return (int)($num * 1073741824);
        case 'm': return (int)($num * 1048576);
        case 'k': return (int)($num * 1024);
        default:  return (int)$num;
    }
}
if ((int)($_SERVER['CONTENT_LENGTH'] ?? 0) > ini_bytes((string)ini_get('post_max_size'))) {
    enq_json(false, 'Attachment is too large. Maximum file size is 25 MB.');
}

/* Honeypot field: bots fill it, humans never see it. Pretend success. */
if (trim((string)($_POST['company_website'] ?? '')) !== '') {
    enq_json(true, 'Your enquiry has been received successfully.');
}

$remoteIp = $_SERVER['REMOTE_ADDR'] ?? '';
if (enq_rate_limited($remoteIp)) {
    http_response_code(429);
    enq_json(false, 'Too many enquiries from your network. Please try again later.');
}

function enq_clean(string $val): string {
    return trim(preg_replace('/[\r\n\t]+/', ' ', $val) ?? '');
}

$name           = enq_clean((string)($_POST['name'] ?? ''));
$email          = enq_clean((string)($_POST['email'] ?? ''));
$company        = enq_clean((string)($_POST['company'] ?? ''));
$phone          = enq_clean((string)($_POST['phone'] ?? ''));
$industry       = enq_clean((string)($_POST['industry'] ?? ''));
$ndt_technology = enq_clean((string)($_POST['ndt_technology'] ?? ''));
$requirement_type = enq_clean((string)($_POST['requirement_type'] ?? ''));
$message        = trim((string)($_POST['message'] ?? ''));

if ($name === '' || $email === '' || $message === '') {
    enq_json(false, 'Name, email and message are required.');
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    enq_json(false, 'Please enter a valid email address.');
}
if (strlen($name) > 120 || strlen($company) > 120 || strlen($message) > 10000) {
    enq_json(false, 'One or more fields exceed the allowed length.');
}

// Save the attached specification/drawing file (optional) into a private
// directory that is not directly downloadable from the web.
$specPath = null;
if (!empty($_FILES['specification_file']) && $_FILES['specification_file']['error'] !== UPLOAD_ERR_NO_FILE) {
    $file = $_FILES['specification_file'];
    if ($file['error'] !== UPLOAD_ERR_OK) {
        enq_json(false, 'The attachment could not be uploaded. Please try again.');
    }
    if ($file['size'] > ENQ_MAX_FILE) {
        enq_json(false, 'Attachment is too large. Maximum file size is 25 MB.');
    }
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if ($ext === '' || !in_array($ext, ENQ_ALLOWED_EXT, true)) {
        enq_json(false, 'This file type is not allowed. Use PDF, Word, Excel, ZIP or common image/CAD formats.');
    }

    $dir = __DIR__ . '/../private_uploads';
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
    $filename = 'enquiry-' . date('Ymd-His') . '-' . bin2hex(random_bytes(4)) . '.' . $ext;
    if (!move_uploaded_file($file['tmp_name'], $dir . '/' . $filename)) {
        enq_json(false, 'Could not save the attachment. Please try again.');
    }
    $specPath = 'private_uploads/' . $filename;
}

try {
    $db = getDB();
    $stmt = $db->prepare("INSERT INTO quote_requests (name, company, email, phone, industry, ndt_technology, requirement_type, message, specification_file) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$name, $company, $email, $phone, $industry, $ndt_technology, $requirement_type, $message, $specPath]);

    $to      = 'enquiry@jagstechnologies.com';
    $subject = "New Quote Request from $name";
    $body    = "New quote request received:\n\n";
    $body   .= "Name: $name\n";
    $body   .= "Company: $company\n";
    $body   .= "Email: $email\n";
    $body   .= "Phone: $phone\n";
    $body   .= "Industry: $industry\n";
    $body   .= "NDT Technology: $ndt_technology\n";
    $body   .= "Requirement Type: $requirement_type\n";
    if ($specPath) $body .= "Attachment: " . BASE_URL . "/$specPath (admin panel only)\n";
    $body   .= "Message:\n$message\n";

    $headers = "From: noreply@jagstechnologies.com\r\n";
    $headers .= "Reply-To: $email\r\n";

    @mail($to, $subject, $body, $headers);

    enq_json(true, 'Your enquiry has been received successfully.');
} catch (Exception $e) {
    error_log('[JAGS-ENQ] ERROR ' . $e->getMessage());
    enq_json(false, 'Something went wrong. Please try again later.');
}