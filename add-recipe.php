<?php
session_start();
require 'includes/db.php';

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title        = trim($_POST['title']);
    $category     = trim($_POST['category']);
    $ingredients  = trim($_POST['ingredients']);
    $instructions = trim($_POST['instructions']);
    $cook_time    = trim($_POST['cook_time']);
    $servings     = trim($_POST['servings']);
    $user_id      = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

    if (empty($title) || empty($category) || empty($ingredients) || empty($instructions)) {
        $error = "සියලු required fields පුරවන්න!";
    } else {
        $stmt = $pdo->prepare("INSERT INTO recipes (title, category, ingredients, instructions, cook_time, servings, user_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$title, $category, $ingredients, $instructions, $cook_time, $servings, $user_id]);
        $success = "Recipe successfully added! ✅";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
  <title>Add Recipe – YumBook</title>
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
        <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
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
    <h1 class="fade-in">Add Your Recipe</h1>
    <p class="fade-in-2">Share your culinary creation with the world!</p>
  </div>
</div>

<section style="padding:4rem 0 5rem;background:var(--clr-bg);">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">

        <?php if($success): ?>
          <div class="alert alert-success mb-4"><?= $success ?></div>
        <?php endif; ?>
        <?php if($error): ?>
          <div class="alert alert-danger mb-4"><?= $error ?></div>
        <?php endif; ?>

        <div style="background:#fff;border-radius:14px;padding:2.5rem;box-shadow:0 4px 24px rgba(0,0,0,.1);">
          <h3 style="font-family:'Playfair Display',serif;margin-bottom:1.5rem;">Recipe Details</h3>

          <form method="POST">
            <div class="row g-3 mb-3">
              <div class="col-sm-6">
                <label class="form-label">Recipe Name *</label>
                <input type="text" name="title" class="form-control" placeholder="e.g. Chicken Curry" required/>
              </div>
              <div class="col-sm-6">
                <label class="form-label">Category *</label>
                <select name="category" class="form-select" required>
                  <option value="">Select category…</option>
                  <option>Breakfast</option>
                  <option>Lunch</option>
                  <option>Dinner</option>
                  <option>Desserts</option>
                </select>
              </div>
            </div>

            <div class="row g-3 mb-3">
              <div class="col-sm-6">
                <label class="form-label">Cook Time</label>
                <input type="text" name="cook_time" class="form-control" placeholder="e.g. 30 min"/>
              </div>
              <div class="col-sm-6">
                <label class="form-label">Servings</label>
                <input type="number" name="servings" class="form-control" placeholder="e.g. 4"/>
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label">Ingredients * <small style="color:#8a7968;">(one per line)</small></label>
              <textarea name="ingredients" class="form-control" rows="5" placeholder="200g chicken&#10;1 onion&#10;2 cloves garlic" required></textarea>
            </div>

            <div class="mb-4">
              <label class="form-label">Instructions * <small style="color:#8a7968;">(step by step)</small></label>
              <textarea name="instructions" class="form-control" rows="6" placeholder="Step 1: ...&#10;Step 2: ..." required></textarea>
            </div>

            <div class="d-flex gap-3">
              <button type="submit" class="btn-yum">
                <i class="bi bi-plus-circle me-2"></i>Publish Recipe
              </button>
              <a href="index.html" class="btn-yum-outline">Cancel</a>
            </div>
          </form>
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