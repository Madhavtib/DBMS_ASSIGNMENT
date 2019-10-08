<?php
session_start();
if(!isset($_SESSION["username"])){
header("Location:login.php");
exit(); }
?>
<html>
<link rel="stylesheet" href="css/style.css" />
<div class="form">
	<h3><b>This is the Homepage.</b></h3>
<h3>Welcome <string><?php echo $_SESSION['username']; ?></h3>
<form action="login.php">
<input type="submit" name="logout" value="Logout" />
<?php
session_destroy();
// Redirecting To Home Page
unset($_SESSION['username']);
exit();
?> 
</form>
</div>
</html>