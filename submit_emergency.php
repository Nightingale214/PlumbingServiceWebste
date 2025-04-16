<?php
session_start();
$conn = new mysqli('127.0.0.1', 'root', '', 'test');
$user_id = $_SESSION['user_id'] ?? null; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $email = $conn->real_escape_string($_POST['email']);
    $address = $conn->real_escape_string($_POST['address']);
    $service_type = $conn->real_escape_string($_POST['service-type']);
    $message = $conn->real_escape_string($_POST['message']);

    $stmt = $conn->prepare("INSERT INTO emergency_requests (user_id, name, phone, email, address, service_type, message) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssss", $user_id, $name, $phone, $email, $address, $service_type, $message);
    $stmt->execute();
    exit;
}
?>
