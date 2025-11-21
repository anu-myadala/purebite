<?php 
$pageTitle = "Admin Login — PureBite Beauty";
include "../includes/header.php"; 
?>

<h1>Administrator Login</h1>

<form action="verify.php" method="post" class="login-form">
  <input type="text" name="USERNAME" placeholder="Username" required><br>
  <input type="password" name="PASSWORD" placeholder="Password" required><br>
  <button type="submit" class="cta">Login</button>
</form>

<style>
.login-form {
  background: #fff;
  max-width: 400px;
  margin: 50px auto;
  padding: 30px;
  border-radius: 12px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.1);
  text-align: center;
}
.login-form input {
  width: 80%;
  padding: 10px;
  margin: 10px 0;
  border: 1px solid #ccc;
  border-radius: 5px;
}
</style>

<?php include "../includes/footer.php"; ?>
