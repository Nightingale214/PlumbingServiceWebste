<?php
session_start();
$conn = new mysqli('127.0.0.1', 'root', '', 'test');
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];
    
    // Check if email exists
    $check = $conn->query("SELECT id FROM users WHERE email='$email'");
    if ($check->num_rows > 0) {
        $error = "Email already registered!";
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $hash);
        
        if ($stmt->execute()) {
            header('Location: login.php?registered=1');
            exit;
        } else {
            $error = "Registration failed. Please try again.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register | Rapid Response Plumbing Services</title>
    <style>
        /* Same styling as login.php */
        body { background: #f5f8fa; font-family: 'Segoe UI', Arial, sans-serif; margin: 0; }
        .header { background: #0074D9; color: #fff; padding: 2em 0; text-align: center; }
        .header h1 { margin: 0; font-size: 2.2em; }
        .container { max-width: 400px; margin: 2em auto; background: #fff; padding: 2em; border-radius: 8px; box-shadow: 0 4px 24px rgba(0,0,0,0.08); }
        .form-group { margin-bottom: 1.2em; }
        label { display: block; margin-bottom: 0.4em; color: #222; font-weight: 500; }
        input { width: 100%; padding: 0.7em; border: 1px solid #bbb; border-radius: 4px; font-size: 1em; }
        button { width: 100%; padding: 0.8em; background: #0074D9; color: #fff; border: none; border-radius: 4px; font-size: 1.1em; cursor: pointer; }
        .error { color: red; text-align: center; margin-bottom: 1em; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Rapid Response</h1>
        <p>Create Your Account</p>
    </div>
    
    <div class="container">
        <?php if ($error): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <form method="post">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" required>
            </div>
            
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" required>
            </div>
            
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            
            <button type="submit">Register</button>
        </form>
        
        <div style="text-align: center; margin-top: 1.5em;">
            <a href="login.php" style="color: #0074D9;">Already have an account? Login</a>
        </div>
    </div>
</body>
</html>
