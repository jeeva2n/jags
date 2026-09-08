<?php
require_once __DIR__ . '/../includes/config.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$company = trim($_POST['company'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$industry = trim($_POST['industry'] ?? '');
$ndt_technology = trim($_POST['ndt_technology'] ?? '');
$requirement_type = trim($_POST['requirement_type'] ?? '');
$message = trim($_POST['message'] ?? '');

if (empty($name) || empty($email) || empty($message)) {
    echo json_encode(['success' => false, 'message' => 'Name, email and message are required.']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Please enter a valid email address.']);
    exit;
}

try {
    $db = getDB();
    $stmt = $db->prepare("INSERT INTO quote_requests (name, company, email, phone, industry, ndt_technology, requirement_type, message) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$name, $company, $email, $phone, $industry, $ndt_technology, $requirement_type, $message]);

    $to = 'enquiry@jagstechnologies.com';
    $subject = "New Quote Request from $name";
    $body = "New quote request received:\n\n";
    $body .= "Name: $name\n";
    $body .= "Company: $company\n";
    $body .= "Email: $email\n";
    $body .= "Phone: $phone\n";
    $body .= "Industry: $industry\n";
    $body .= "NDT Technology: $ndt_technology\n";
    $body .= "Requirement Type: $requirement_type\n";
    $body .= "Message:\n$message\n";

    $headers = "From: noreply@jagstechnologies.com\r\n";
    $headers .= "Reply-To: $email\r\n";

    @mail($to, $subject, $body, $headers);

    echo json_encode(['success' => true, 'message' => 'Your enquiry has been received successfully.']);

} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Something went wrong. Please try again later.']);
}
