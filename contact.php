<?php
session_start();
require 'includes/db.php';

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = trim($_POST['name']);
    $email   = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);

    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        $error = "සියලු fields පුරවන්න!";
    } else {
        $stmt = $pdo->prepare("INSERT INTO messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $email, $subject, $message]);
        $success = "Message sent successfully! ✅";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
  <title>Contact – YumBook</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"/>
  <link rel="stylesheet" href="css/style.css"/>
</head>
<body>

<nav class="navbar navbar-expand-lg">
  <div class="container">
    <a class="navbar-brand" href="index.html">Yum<span>Book</span></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="nav">
      <ul class="navbar-nav ms-auto gap-1">
        <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="recipes.html">Recipes</a></li>
        <li class="nav-item"><a class="nav-link" href="categories.html">Categories</a></li>
        <li class="nav-item"><a class="nav-link active" href="contact.php">Contact</a></li>
      </ul>
      <?php if(isset($_SESSION['user_id'])): ?>
        <a href="dashboard.php" class="btn-yum ms-3" style="font-size:.88rem;">Dashboard</a>
      <?php else: ?>
        <a href="auth/login.php" class="btn-yum ms-3" style="font-size:.88rem;">Login</a>
      <?php endif; ?>
    </div>
  </div>
</nav>

<div class="page-hero">
  <div class="container">
    <h1 class="fade-in">Contact Us</h1>
    <p class="fade-in-2">We'd love to hear your questions and suggestions!</p>
  </div>
</div>

<section style="padding:4rem 0 5rem;background:var(--clr-bg);">
  <div class="container">
    <div class="row g-5">
      <div class="col-lg-7">

        <?php if($success): ?>
          <div class="alert alert-success mb-4"><?= $success ?></div>
        <?php endif; ?>
        <?php if($error): ?>
          <div class="alert alert-danger mb-4"><?= $error ?></div>
        <?php endif; ?>

        <div style="background:#fff;border-radius:14px;padding:2.5rem;box-shadow:0 4px 24px rgba(0,0,0,.1);">
          <h3 style="font-family:'Playfair Display',serif;margin-bottom:1.5rem;">Send a Message</h3>

          <form method="POST">
            <div class="row g-3 mb-3">
              <div class="col-sm-6">
                <label class="form-label">Your Name *</label>
                <input type="text" name="name" class="form-control" placeholder="Chamodi Nadeesha" required/>
              </div>
              <div class="col-sm-6">
                <label class="form-label">Email Address *</label>
                <input type="email" name="email" class="form-control" placeholder="hello@example.com" required/>
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">Subject *</label>
              <select name="subject" class="form-select" required>
                <option value="">Choose a subject…</option>
                <option>General Question</option>
                <option>Recipe Suggestion</option>
                <option>Report an Issue</option>
                <option>Partnership Inquiry</option>
                <option>Other</option>
              </select>
            </div>
            <div class="mb-4">
              <label class="form-label">Message *</label>
              <textarea name="message" class="form-control" rows="5" placeholder="Write your message here…" required></textarea>
            </div>
            <button type="submit" class="btn-yum w-100">
              <i class="bi bi-send me-2"></i>Send Message →
            </button>
          </form>
        </div>
      </div>

      <div class="col-lg-5">
        <div class="contact-info-box">
          <h3>Contact Information</h3>
          <div class="contact-info-item">
            <div class="icon"><i class="bi bi-geo-alt-fill"></i></div>
            <div>Rajarata University of Sri Lanka<br>Mihintale, Anuradhapura</div>
          </div>
          <div class="contact-info-item">
            <div class="icon"><i class="bi bi-envelope-fill"></i></div>
            <div>yumbook@rusl.ac.lk</div>
          </div>
          <div class="contact-info-item">
            <div class="icon"><i class="bi bi-telephone-fill"></i></div>
            <div>+94 72 1879408</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<footer>
  <div class="container">
    <p class="footer-copy">&copy; 2026 YumBook · B.L.Chamodi Nadeesha · ASB/2023/163</p>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>