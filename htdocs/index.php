<?php
$pageTitle = "Home — PureBite Beauty";
include("includes/header.php"); 
?>

<h1 class="visually-hidden">PureBite Beauty</h1>

<!-- Carousel -->
<div class="carousel">
  <div class="carousel-track">
    <div class="slide">
      <img src="/images/banner1.jpg" alt="Natural Beauty Skincare">
      <div class="slide-caption">
        <h2>Glow Naturally</h2>
        <p>Organic skincare made with pure, edible ingredients.</p>
        <a href="/products.php" class="cta">Shop Now</a>
      </div>
    </div>
    <div class="slide">
      <img src="/images/banner2.jpg" alt="Herbal Beauty">
      <div class="slide-caption">
        <h2>Pure Herbal Care</h2>
        <p>From serums to scrubs, discover clean beauty essentials.</p>
        <a href="/products.php" class="cta">Explore</a>
      </div>
    </div>
    <div class="slide">
      <img src="/images/banner3.jpg" alt="Fragrance Free Beauty">
      <div class="slide-caption">
        <h2>Fragrance-Free, Always</h2>
        <p>Because your skin deserves honesty.</p>
        <a href="/about.php" class="cta">Learn More</a>
      </div>
    </div>
  </div>
  <button class="carousel-btn prev">&#10094;</button>
  <button class="carousel-btn next">&#10095;</button>
</div>

<!-- Featured Products -->
<h2>Featured Products</h2>
<p class="small">Discover our bestsellers crafted with pure, edible-grade ingredients.</p>

<div class="products-grid">
  <div class="card">
    <a href="/products.php">
      <img src="https://images.unsplash.com/photo-1598514982356-2802aa4a6514?auto=format&fit=crop&w=600&q=80" alt="Moisturizer Cream">
      <h3>Hydrating Face Cream</h3>
    </a>
    <p>Deeply moisturizing, chemical-free face cream made with aloe & shea butter.</p>
  </div>
  <div class="card">
    <a href="/products.php">
      <img src="https://images.unsplash.com/photo-1600185365483-26d4c7b3b7bc?auto=format&fit=crop&w=600&q=80" alt="Herbal Serum">
      <h3>Herbal Glow Serum</h3>
    </a>
    <p>Botanical serum infused with vitamin C & rosehip oil for a natural glow.</p>
  </div>
  <div class="card">
    <a href="/products.php">
      <img src="https://images.unsplash.com/photo-1612817159949-1c1c472b725f?auto=format&fit=crop&w=600&q=80" alt="Clay Mask">
      <h3>Detox Clay Mask</h3>
    </a>
    <p>Pore-cleansing mask with bentonite clay and green tea extract.</p>
  </div>
</div>

<p style="margin-top:20px; text-align:center;">
  <a href="/products.php" class="cta">View All Products</a>
</p>

<!-- Latest News -->
<h2>Latest News</h2>
<p class="small">See what’s new at PureBite Beauty.</p>

<div class="news-preview">
  <div class="news-item">
    <h3>✨ New Product Launch: Herbal Glow Serum</h3>
    <p class="meta">September 25, 2025</p>
    <p>We’re excited to introduce our Herbal Glow Serum, a vitamin-packed botanical blend that brightens and hydrates your skin naturally.</p>
    <p><a href="/news.php" class="cta">Read More</a></p>
  </div>
  <div class="news-item">
    <h3>🌱 Sustainability Promise</h3>
    <p class="meta">September 10, 2025</p>
    <p>PureBite Beauty is proud to announce our commitment to eco-friendly packaging and carbon-neutral shipping by 2026.</p>
    <p><a href="/news.php" class="cta">Read More</a></p>
  </div>
</div>

<?php include("includes/footer.php"); ?>