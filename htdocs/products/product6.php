<?php
$pageTitle = "Sugar Body Scrub — PureBite Beauty";
include "../includes/header.php";
$productName = "Sugar Body Scrub";
if(isset($_COOKIE['last_visited'])) { $visited = json_decode($_COOKIE['last_visited'], true); $visited = array_diff($visited, [$productName]); array_unshift($visited, $productName); $visited = array_slice($visited, 0, 5); } else { $visited = [$productName]; }
setcookie('last_visited', json_encode($visited), time() + (86400*7), "/");
if(isset($_COOKIE['visited_counts'])) { $counts = json_decode($_COOKIE['visited_counts'], true); } else { $counts = []; }
$counts[$productName] = ($counts[$productName] ?? 0) + 1;
setcookie('visited_counts', json_encode($counts), time() + (86400*7), "/");
?>
<div class='product-page'>
  <img src='/images/scrub.jpg' alt='Sugar Body Scrub'>
  <div class='details'>
    <h1>Sugar Body Scrub</h1>
    <p>Gently exfoliates for soft, radiant skin.</p>
    <p><strong>Price:</strong> $17.99</p>
    <a href='/products.php' class='cta'>← Back to Products</a>
  </div>
</div>
<?php include "../includes/footer.php"; ?>
