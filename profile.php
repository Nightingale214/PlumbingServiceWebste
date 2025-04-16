<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
$conn = new mysqli('127.0.0.1', 'root', '', 'test');
$user_id = $_SESSION['user_id'];
$result = $conn->query("SELECT * FROM emergency_requests WHERE user_id = $user_id ORDER BY submitted_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Profile | Rapid Response Plumbing Services</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            background: #f5f8fa;
            font-family: 'Segoe UI', Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .header {
            background: #0074D9;
            color: #fff;
            padding: 2em 0 1em 0;
            text-align: center;
        }
        .header h1 {
            margin: 0 0 0.3em 0;
            font-size: 2.2em;
            font-weight: 700;
        }
        .header p {
            margin: 0;
            font-size: 1.1em;
            font-weight: 400;
        }
        nav {
            background: #f5f5f5;
            padding: 1em;
            display: flex;
            justify-content: flex-end;
            gap: 1em;
        }
        nav a {
            color: #0074D9;
            text-decoration: none;
            font-weight: bold;
            padding: 0.3em 0.8em;
            border-radius: 4px;
            transition: background 0.2s;
        }
        nav a:hover, nav a.active {
            background: #e6f2fb;
        }
        .container {
            max-width: 900px;
            margin: 2em auto;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.08);
            padding: 2em 2em 2em 2em;
        }
        h2 {
            color: #0074D9;
            margin-top: 0;
            font-size: 1.6em;
            font-weight: 700;
        }
        .history-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1.5em;
        }
        .history-table th, .history-table td {
            border: 1px solid #dbeafe;
            padding: 0.7em 0.5em;
            text-align: left;
        }
        .history-table th {
            background: #e6f2fb;
            color: #0074D9;
            font-weight: 600;
        }
        .history-table tr:nth-child(even) {
            background: #f8fafc;
        }
        .cta {
            margin: 2em 0 0 0;
            text-align: center;
        }
        .cta a {
            display: inline-block;
            background: #0074D9;
            color: #fff;
            padding: 0.8em 2em;
            border-radius: 4px;
            font-size: 1.1em;
            font-weight: bold;
            text-decoration: none;
            transition: background 0.2s;
        }
        .cta a:hover {
            background: #005fa3;
        }
        @media (max-width: 600px) {
            .container { padding: 1em 0.5em; }
            .header { padding: 1.2em 0 0.7em 0; }
        }
    </style>
</head>
<body>
    <nav>
        <a href="website.html">Home</a>
        <a href="profile.php" class="active">Profile</a>
        <a href="logout.php" style="color: #d9534f;">Logout</a>
    </nav>
    <div class="header">
        <h1>Your Profile</h1>
        <p>View your emergency request history and manage your account</p>
    </div>
    <div class="container">
        <h2>Emergency Request History</h2>
        <?php if ($result->num_rows > 0): ?>
        <table class="history-table">
            <tr>
                <th>Date</th>
                <th>Full Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Address</th>
                <th>Type of Emergency</th>
                <th>Description</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['submitted_at']); ?></td>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td><?php echo htmlspecialchars($row['phone']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo htmlspecialchars($row['address']); ?></td>
                <td><?php echo htmlspecialchars(ucwords(str_replace('-', ' ', $row['service_type']))); ?></td>
                <td><?php echo htmlspecialchars($row['message']); ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
        <?php else: ?>
            <p>You have not submitted any emergency requests yet.</p>
        <?php endif; ?>
        <div class="cta">
            <a href="website.html#emergency-form">Submit New Emergency Request</a>
        </div>
    </div>
</body>
</html>
