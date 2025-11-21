<?php
session_start();
if(!isset($_SESSION['user'])) {
    header("Location: login.html");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Current Users - PureBite Beauty</title>
  <style>
    body { font-family: Arial; background: #fff4f8; color: #333; text-align: center; }
    table { margin: 50px auto; border-collapse: collapse; width: 60%; }
    th, td { padding: 12px; border: 1px solid #ccc; }
    th { background: #e69ab3; color: white; }
  </style>
</head>
<body>
  <h2>Current Users</h2>
  <table>
    <tr><th>Name</th><th>Email</th></tr>
    <tr><td>Mary Smith</td><td>mary@sjsu.edu</td></tr>
    <tr><td>John Wang</td><td>john@sjsu.edu</td></tr>
    <tr><td>Alex Bington</td><td>alex@sjsu.edu</td></tr>
    <tr><td>Sophia Rivera</td><td>sophia@sjsu.edu</td></tr>
  </table>
  <p><a href="logout.php">Logout</a></p>
</body>
</html>
