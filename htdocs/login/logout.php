<?php
session_start();
// Clear user_id as well for clean logout
unset($_SESSION['user']);
unset($_SESSION['user_id']);
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
