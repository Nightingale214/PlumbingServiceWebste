<?php
session_start();

// Store data in session if form was submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['name'] = $_POST['name'];
    $_SESSION['phone'] = $_POST['phone'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['address'] = $_POST['address'];
    $_SESSION['service_type'] = $_POST['service-type'];
    $_SESSION['message'] = $_POST['message'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile - Rapid Response</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 2rem;
            background-color: #f4f4f4;
        }
        .profile-container {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            max-width: 600px;
            margin: auto;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        h1 {
            color: #005b96;
            margin-bottom: 1rem;
        }
        p {
            margin-bottom: 0.8rem;
            font-size: 1.1rem;
        }
        .btn {
            display: inline-block;
            margin-top: 2rem;
            background: #005b96;
            color: white;
            padding: 0.8rem 1.2rem;
            border: none;
            border-radius: 5px;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <h1>Submitted Profile Details</h1>
        <?php if (isset($_SESSION['name'])): ?>
            <p><strong>Name:</strong> <?= htmlspecialchars($_SESSION['name']) ?></p>
            <p><strong>Phone:</strong> <?= htmlspecialchars($_SESSION['phone']) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($_SESSION['email']) ?></p>
            <p><strong>Address:</strong> <?= htmlspecialchars($_SESSION['address']) ?></p>
            <p><strong>Emergency Type:</strong> <?= htmlspecialchars($_SESSION['service_type']) ?></p>
            <p><strong>Description:</strong> <?= nl2br(htmlspecialchars($_SESSION['message'])) ?></p>
        <?php else: ?>
            <p>No form data submitted yet.</p>
        <?php endif; ?>
        <a href="index.html" class="btn">Back to Home</a>
    </div>
</body>
</html>
