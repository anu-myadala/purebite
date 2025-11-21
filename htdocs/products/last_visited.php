<?php
$pageTitle = "Last 5 Visited — PureBite Beauty";
include "../includes/header.php";
echo "<h1>Last 5 Visited Products</h1>";
if(isset($_COOKIE['last_visited'])) {
  $visited = json_decode($_COOKIE['last_visited'], true);
  echo "<ul>";
  foreach($visited as $p) { echo "<li>".htmlspecialchars($p)."</li>"; }
  echo "</ul>";
} else {
  echo "<p>No recently visited products.</p>";
}
include "../includes/footer.php";
?>