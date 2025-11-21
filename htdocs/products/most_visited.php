<?php
$pageTitle = "Most Visited Products — PureBite Beauty";
include "../includes/header.php";
echo "<h1>Top 5 Most Visited Products</h1>";
if(isset($_COOKIE['visited_counts'])) {
  $counts = json_decode($_COOKIE['visited_counts'], true);
  arsort($counts);
  $top5 = array_slice($counts, 0, 5, true);
  echo "<ol>";
  foreach($top5 as $n => $c) { echo "<li>".htmlspecialchars($n)." — ".$c." visits</li>"; }
  echo "</ol>";
} else {
  echo "<p>No products visited yet.</p>";
}
include "../includes/footer.php";
?>