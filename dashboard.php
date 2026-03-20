<?php
session_start();
require 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php");
    exit;
}

$username = $_SESSION['username'];

$stmt = $pdo->prepare("SELECT * FROM recipes WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$_SESSION['user_id']]);
$myRecipes = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <title>Dashboard – YumBook</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="css/style.css"/>
</head>
<body>
<nav class="navbar navbar-expand-lg">
  <div class="container">
    <a class="navbar-brand" href="index.html">Yum<span>Book</span></a>
    <div class="ms-auto d-flex align-items-center gap-3">
      <span style="font-size:.9rem;">👋 Hello, <strong><?= htmlspecialchars($username) ?></strong></span>
      <a href="auth/logout.php" class="btn-yum" style="font-size:.85rem;">Logout</a>
    </div>
  </div>
</nav>

<section style="padding:4rem 0;background:var(--clr-bg);">
  <div class="container">
    <h2 style="font-family:'Playfair Display',serif;margin-bottom:2rem;">
      My Recipes 🍽️
    </h2>

    <?php if(empty($myRecipes)): ?>
      <div style="text-align:center;padding:3rem;background:#fff;border-radius:14px;">
        <p style="color:#8a7968;">ඔයා තවම recipes add කරලා නැහැ!</p>
        <a href="add-recipe.php" class="btn-yum">+ Add Recipe</a>
      </div>
    <?php else: ?>
      <div class="row g-4">
        <?php foreach($myRecipes as $r): ?>
          <div class="col-sm-6 col-lg-3">
            <div class="recipe-card">
              <div class="recipe-card-body">
                <span class="recipe-badge"><?= htmlspecialchars($r['category']) ?></span>
                <div class="recipe-card-title"><?= htmlspecialchars($r['title']) ?></div>
                <div class="recipe-meta">
                  <span>⏱ <?= htmlspecialchars($r['cook_time']) ?></span>
                  <span>👥 <?= htmlspecialchars($r['servings']) ?></span>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</section>

<footer>
  <div class="container">
    <p class="footer-copy">&copy; 2026 YumBook · B.L.Chamodi Nadeesha · ASB/2023/163</p>
  </div>
</footer>
</body>
</html>