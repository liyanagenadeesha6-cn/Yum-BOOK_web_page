<?php
session_start();
require '../includes/db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id']  = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: ../dashboard.php");
        exit;
    } else {
        $error = "Email හෝ Password වැරදියි!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <title>Login – YumBook</title>
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
          <h3 style="font-family:'Playfair Display',serif;color:#c0392b;margin-bottom:1.5rem;text-align:center;">Welcome Back!</h3>

          <?php if($error): ?>
            <div class="alert alert-danger"><?= $error ?></div>
          <?php endif; ?>

          <form method="POST">
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" name="email" class="form-control" placeholder="hello@example.com" required/>
            </div>
            <div class="mb-4">
              <label class="form-label">Password</label>
              <input type="password" name="password" class="form-control" placeholder="Your password" required/>
            </div>
            <button type="submit" class="btn-yum w-100">Login →</button>
          </form>

          <p style="text-align:center;margin-top:1rem;font-size:.9rem;">
            Account එකක් නැද්ද? <a href="register.php" style="color:#c0392b;">Register</a>
          </p>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>