<?php
$pageTitle = "Revitalizing Night Cream — PureBite Beauty";
include "../includes/header.php";
$productName = "Revitalizing Night Cream";
if(isset($_COOKIE['last_visited'])) { $visited = json_decode($_COOKIE['last_visited'], true); $visited = array_diff($visited, [$productName]); array_unshift($visited, $productName); $visited = array_slice($visited, 0, 5); } else { $visited = [$productName]; }
setcookie('last_visited', json_encode($visited), time() + (86400*7), "/");
if(isset($_COOKIE['visited_counts'])) { $counts = json_decode($_COOKIE['visited_counts'], true); } else { $counts = []; }
$counts[$productName] = ($counts[$productName] ?? 0) + 1;
setcookie('visited_counts', json_encode($counts), time() + (86400*7), "/");
?>
<div class='product-page'>
  <img src='/images/cream.jpg' alt='Revitalizing Night Cream'>
  <div class='details'>
    <h1>Revitalizing Night Cream</h1>
    <p>Repairs and nourishes while you sleep.</p>
    <p><strong>Price:</strong> $25.99</p>
    <a href='/products.php' class='cta'>← Back to Products</a>
  </div>
</div>
<?php include "../includes/footer.php"; ?>
