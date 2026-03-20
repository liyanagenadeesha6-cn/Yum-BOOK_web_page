<?php
session_start();
require '../includes/db.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email    = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($username) || empty($email) || empty($password)) {
        $error = "සියලු fields පුරවන්න!";
    } else {
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $error = "මේ email එක දැනටමත් register වෙලා!";
        } else {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $stmt->execute([$username, $email, $hashed]);
            header("Location: login.php");
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <title>Register – YumBook</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="../css/style.css"/>
</head>
<body>
<nav class="navbar navbar-expand-lg">
  <div class="container">
    <a class="navbar-brand" href="../index.html">Yum<span>Book</span></a>
  </div>
</nav>

<section style="padding:5rem 0;background:var(--clr-bg);">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-5">
        <div style="background:#fff;border-radius:14px;padding:2.5rem;box-shadow:0 4px 24px rgba(0,0,0,.1);">
          <h3 style="font-family:'Playfair Display',serif;color:#c0392b;margin-bottom:1.5rem;text-align:center;">Create Account</h3>

          <?php if($error): ?>
            <div class="alert alert-danger"><?= $error ?></div>
          <?php endif; ?>

          <form method="POST">
            <div class="mb-3">
              <label class="form-label">Username</label>
              <input type="text" name="username" class="form-control" placeholder="Your name" required/>
            </div>
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" name="email" class="form-control" placeholder="hello@example.com" required/>
            </div>
            <div class="mb-4">
              <label class="form-label">Password</label>
              <input type="password" name="password" class="form-control" placeholder="Min 6 characters" required/>
            </div>
            <button type="submit" class="btn-yum w-100">Register →</button>
          </form>

          <p style="text-align:center;margin-top:1rem;font-size:.9rem;">
            දැනටමත් account එකක් තිබෙනවාද? <a href="login.php" style="color:#c0392b;">Login</a>
          </p>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>