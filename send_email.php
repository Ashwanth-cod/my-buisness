<?php
// Allow CORS if needed
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

// Read the raw POST data
$data = json_decode(file_get_contents("php://input"), true);

// Extract product details
$product = isset($data["product"]) ? $data["product"] : "Unknown Product";
$price = isset($data["price"]) ? $data["price"] : "Unknown Price";

// Email Configuration
$to = "ashwanth.asr@gmail.com"; // Change to your email
$subject = "Payment Received for $product";
$message = "A payment of ₹" . $price . " has been received for the product: " . $product;
$headers = "From: no-reply@yourdomain.com" . "\r\n" .
           "Reply-To: no-reply@yourdomain.com" . "\r\n" .
           "Content-Type: text/plain; charset=UTF-8";

// Send the email
if (mail($to, $subject, $message, $headers)) {
    echo json_encode(["status" => "success", "message" => "Email sent successfully!"]);
} else {
    echo json_encode(["status" => "error", "message" => "Failed to send email."]);
}
?>
