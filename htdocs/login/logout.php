<?php
session_start();
session_destroy();

// Redirect after a short delay (2 seconds)
echo "<!DOCTYPE html>
<html>
<head>
<meta http-equiv='refresh' content='2;url=/index.php'>
<title>Logging out...</title>
<style>
  body { font-family: Arial; text-align: center; padding-top: 100px; background:#fef6f9; color:#444; }
</style>
</head>
<body>
  <h2>You have been logged out successfully.</h2>
  <p>Redirecting to homepage...</p>
</body>
</html>";
exit;
?>
