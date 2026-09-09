<?php
require_once __DIR__ . '/../includes/config.php';
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
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

const ENQ_MAX_FILE = 25 * 1024 * 1024; // 25 MB
const ENQ_ALLOWED_EXT = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'jpg', 'jpeg', 'png', 'gif', 'webp', 'dwg', 'dxf', 'step', 'stp', 'igs', 'zip', 'rar', 'txt', 'csv'];

function enq_json(bool $ok, string $msg): void {
    echo json_encode(['success' => $ok, 'message' => $msg]);
    exit;
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

$name         = trim($_POST['name'] ?? '');
$email        = trim($_POST['email'] ?? '');
$company      = trim($_POST['company'] ?? '');
$phone        = trim($_POST['phone'] ?? '');
$industry     = trim($_POST['industry'] ?? '');
$ndt_technology = trim($_POST['ndt_technology'] ?? '');
$requirement_type = trim($_POST['requirement_type'] ?? '');
$message      = trim($_POST['message'] ?? '');

if (empty($name) || empty($email) || empty($message)) {
    enq_json(false, 'Name, email and message are required.');
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    enq_json(false, 'Please enter a valid email address.');
}

// Save the attached specification/drawing file (optional).
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

    $dir = __DIR__ . '/../assets/uploads';
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }
    $filename = 'enquiry-' . date('Ymd-His') . '-' . bin2hex(random_bytes(4)) . '.' . $ext;
    if (!move_uploaded_file($file['tmp_name'], $dir . '/' . $filename)) {
        enq_json(false, 'Could not save the attachment. Please try again.');
    }
    $specPath = 'assets/uploads/' . $filename;
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
    if ($specPath) $body .= "Attachment: " . BASE_URL . "/$specPath\n";
    $body   .= "Message:\n$message\n";

    $headers = "From: noreply@jagstechnologies.com\r\n";
    $headers .= "Reply-To: $email\r\n";

    @mail($to, $subject, $body, $headers);

    enq_json(true, 'Your enquiry has been received successfully.');
} catch (Exception $e) {
    error_log('[JAGS-ENQ] ERROR ' . $e->getMessage());
    enq_json(false, 'Something went wrong. Please try again later.');
}