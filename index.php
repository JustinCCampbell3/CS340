<?php
	include 'connectvars.php';
	session_start();
	if(!isset($_SESSION['uname']))
	{
		header('Location: login.php');
	}

	if(isset($_POST['logout_btn']))
	{
		session_destroy();
		header('Location: login.php');
	}
?>


<!DOCTYPE html>
<html>
<header>

<h1>Shoe Buyer</h1>

<div background-color="black" width="100%" text-align="center" height="46px">
  <u1>
    <li><a href="index.html">Home</a></li>
    <li><a href="shoes.php">Shoes</a></li>
    <li><a href="suppliers.php">Suppliers</a></li>
    <li><a href="admin.php">Admin</a></li>
    <li><a href="login.php">Log in</a></li>
  </u1>
</div>
<br> &nbsp;
<br> &nbsp;
    <title>Shoe Buyer</title>
    <link rel="stylesheet" type="text/css" href="style.css">

</header>
<body style="background-image:url('https://wallpapercave.com/wp/EdgejZ5.jpg');">

<form method = 'post' action = "">
<input type = "submit" value = "Logout" name = "logout_btn">
</form>
</body>
</html>
