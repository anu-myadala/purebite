<?php
session_start(); // allows tracking of login state
if (!isset($pageTitle)) $pageTitle = "PureBite Beauty";
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?php echo htmlspecialchars($pageTitle); ?></title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="stylesheet" href="/style.css">
</head>
<body>
  <header class="header">
    <div class="container header-row">
      <div class="logo">PureBite Beauty</div>
      <nav class="nav-links">
        <a href="/index.php" class="<?php if($currentPage=='index.php') echo 'active'; ?>">Home</a>
        <a href="/about.php" class="<?php if($currentPage=='about.php') echo 'active'; ?>">About</a>
        <a href="/products.php" class="<?php if($currentPage=='products.php') echo 'active'; ?>">Products</a>
        <a href="/news.php" class="<?php if($currentPage=='news.php') echo 'active'; ?>">News</a>
        <a href="/contact.php" class="<?php if($currentPage=='contact.php') echo 'active'; ?>">Contacts</a>

        <?php if (isset($_SESSION['user'])): ?>
          <a href="/login/users.php" class="<?php if($currentPage=='users.php') echo 'active'; ?>">Admin</a>
          <a href="/login/logout.php">Logout</a>
        <?php else: ?>
          <a href="/login/login.php" class="<?php if($currentPage=='login.php') echo 'active'; ?>">Login</a>
        <?php endif; ?>
      </nav>
    </div>
  </header>
  <main class="container">
