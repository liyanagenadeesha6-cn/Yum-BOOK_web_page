<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>YumBook – Your Digital Recipe Diary</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
  <link rel="stylesheet" href="css/style.css" />
  <style>
    .hero {
      min-height: 90vh;
      background: linear-gradient(135deg, #1a9080 0%, #e5f4f2 100%);
      display: flex;
      align-items: center;
      position: relative;
      overflow: hidden;
    }
    .hero-tag {
      display: inline-block;
      background: rgba(192,57,43,.1);
      color: var(--clr-primary);
      border-radius: 50px;
      padding: .3rem 1rem;
      font-size: .8rem;
      font-weight: 600;
      letter-spacing: 2px;
      text-transform: uppercase;
      margin-bottom: 1.2rem;
    }
    .hero h1 { font-size: clamp(2.4rem, 6vw, 4rem); line-height: 1.1; margin-bottom: 1.2rem; }
    .hero h1 em { color: var(--clr-primary); font-style: italic; }
    .stats-bar { background: var(--clr-primary); color: #fff; padding: 1.8rem 0; }
    .stat-item { text-align: center; }
    .stat-item .num { font-family: var(--font-display); font-size: 2rem; font-weight: 700; display: block; }
    .stat-item .lbl { font-size: .82rem; opacity: .8; }
    .cta-section { background: linear-gradient(135deg, var(--clr-primary) 0%, #922b21 100%); padding: 5rem 0; color: #fff; text-align: center; }
    .btn-white { background: #fff; color: var(--clr-primary); border-radius: 50px; padding: .7rem 2rem; font-weight: 700; transition: var(--transition); display: inline-block; }
    .btn-white:hover { background: #fceee0; transform: translateY(-2px); }
  </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg">
  <div class="container">
    <a class="navbar-brand" href="index.php">Yum<span>Book</span></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navMenu">
      <ul class="navbar-nav ms-auto gap-1">
        <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="recipes.html">Recipes</a></li>
        <li class="nav-item"><a class="nav-link" href="categories.html">Categories</a></li>
        <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
      </ul>
      <?php if(isset($_SESSION['user_id'])): ?>
        <a href="dashboard.php" class="btn-yum ms-3" style="font-size:.88rem;">
          👋 <?= htmlspecialchars($_SESSION['username']) ?>
        </a>
        <a href="auth/logout.php" class="btn-yum-outline ms-2" style="font-size:.88rem;">Logout</a>
      <?php else: ?>
        <a href="auth/login.php" class="btn-yum ms-3" style="font-size:.88rem;">Login</a>
        <a href="add-recipe.php" class="btn-yum-outline ms-2" style="font-size:.88rem;">+ Add Recipe</a>
      <?php endif; ?>
    </div>
  </div>
</nav>

<!-- HERO -->
<section class="hero">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-6">
        <span class="hero-tag fade-in">✨ Your Digital Recipe Diary</span>
        <h1 class="fade-in-2">Cook with <em>passion</em>, share with love</h1>
        <h3 class="fade-in-3"><b><em>Create. Cook. Celebrate.</em></b></h3>
        <p class="fade-in-4" style="color:var(--clr-muted);font-size:1.05rem;max-width:460px;margin-bottom:2rem;">
          Discover thousands of hand-picked recipes, organize your favorites, and share your own culinary creations.
        </p>
        <div class="d-flex gap-3 flex-wrap fade-in-4">
          <a href="recipes.html" class="btn-yum">Explore Recipes</a>
          <a href="add-recipe.php" class="btn-yum-outline">Share Yours</a>
        </div>
      </div>
      <div class="col-lg-6 fade-in-3">
        <img src="https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=700&q=80"
             alt="Cooking" style="border-radius:24px;box-shadow:0 24px 64px rgba(26,18,9,.2);width:100%;"/>
      </div>
    </div>
  </div>
</section>

<!-- STATS -->
<div class="stats-bar">
  <div class="container">
    <div class="row text-center g-3">
      <div class="col-6 col-md-3 stat-item"><span class="num">200+</span><span class="lbl">Recipes</span></div>
      <div class="col-6 col-md-3 stat-item"><span class="num">15+</span><span class="lbl">Categories</span></div>
      <div class="col-6 col-md-3 stat-item"><span class="num">5k+</span><span class="lbl">Happy Cooks</span></div>
      <div class="col-6 col-md-3 stat-item"><span class="num">100%</span><span class="lbl">Free to Use</span></div>
    </div>
  </div>
</div>

<!-- CTA -->
<section class="cta-section reveal">
  <div class="container">
    <h2>Ready to share your recipe?</h2>
    <p style="opacity:.85;margin-bottom:2rem;">Join thousands of food lovers on YumBook.</p>
    <a href="add-recipe.php" class="btn-white">Add Your Recipe Now</a>
  </div>
</section>

<!-- FOOTER -->
<footer>
  <div class="container">
    <div class="row g-4">
      <div class="col-lg-4">
        <div class="footer-brand mb-3">Yum<span>Book</span></div>
        <p style="font-size:.9rem;">Your digital recipe diary.</p>
      </div>
      <div class="col-6 col-lg-2">
        <h6>Pages</h6>
        <a href="index.php">Home</a>
        <a href="recipes.html">Recipes</a>
        <a href="categories.html">Categories</a>
        <a href="add-recipe.php">Add Recipe</a>
        <a href="contact.php">Contact</a>
      </div>
    </div>
    <hr/>
    <p class="footer-copy">&copy; 2026 YumBook · B.L.Chamodi Nadeesha · ASB/2023/163</p>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>


