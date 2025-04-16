<?php
session_start();
$conn = new mysqli('127.0.0.1', 'root', '', 'test');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);

    $result = $conn->query("SELECT * FROM users WHERE email='$email' AND password='$password'");
    $user = $result->fetch_assoc();

    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        header('Location: website.html');
        exit;
    } else {
        $error_message = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | Rapid Response Plumbing Services</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
      body { background: #f5f8fa; font-family: 'Segoe UI', Arial, sans-serif; }
      .login-container { max-width: 400px; margin: 60px auto; background: #fff; border-radius: 8px; box-shadow: 0 4px 24px rgba(0,0,0,0.08); padding: 2.5em 2em 2em 2em; }
      .login-header { text-align: center; margin-bottom: 1.5em; }
      .login-header h2 { margin: 0 0 0.5em 0; color: #0074D9; font-size: 2em; font-weight: 700; }
      .form-group { margin-bottom: 1.2em; }
      label { display: block; margin-bottom: 0.4em; color: #222; font-weight: 500; }
      input[type="email"], input[type="password"] { width: 100%; padding: 0.7em; border: 1px solid #bbb; border-radius: 4px; font-size: 1em; background: #f9f9f9; transition: border 0.2s; }
      input[type="email"]:focus, input[type="password"]:focus { border-color: #0074D9; outline: none; }
      .btn-login { width: 100%; padding: 0.8em; background: #0074D9; color: #fff; border: none; border-radius: 4px; font-size: 1.1em; font-weight: bold; cursor: pointer; transition: background 0.2s; }
      .btn-login:hover { background: #005fa3; }
      .error { color: red; text-align: center; margin-bottom: 1em; }
    </style>
</head>
<body>
<div style="text-align:center; margin-top:2em; margin-bottom:1em;">
  <span style="font-size:2.2em; font-weight:700; color:#0074D9; letter-spacing:1px; font-family:'Segoe UI', Arial, sans-serif;">
    Rapid Response
  </span>
</div>
  <div class="login-container">
    <div class="login-header">
      <h2>Member Login</h2>
    </div>
    <?php if (isset($error_message)): ?>
      <div class="error"><?php echo $error_message; ?></div>
    <?php endif; ?>
    <form method="post" action="">
      <div class="form-group">
        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" required autofocus>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
      </div>
      <button type="submit" class="btn-login">Login</button>
    </form>
  </div>
  <div style="text-align:center; class="login-footer" >
    <span>New to Rapid Response?</span>
    <a href="register.php" style="font-weight: bold;">Create Account</a>
</div>

</body>
</html>
