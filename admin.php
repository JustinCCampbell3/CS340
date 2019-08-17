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
	<h1>Admin</h1>

<div background-color="black" width="100%" text-align="center" height="46px">
  <u1>
    <li><a href="index.php">Home</a></li>
    <li><a href="shoes.php">Shoes</a></li>
    <li><a href="suppliers.php">Suppliers</a></li>
			<li><div id="submit_button"><form method = 'post' action = ""><input type = "submit" value = "Log out" name = "logout_btn" /></form></div></li>
  </u1>
</div>
<br> &nbsp;
<br> &nbsp;
    <title>Shoe Buyer</title>
    <link rel="stylesheet" type="text/css" href="style.css">

</header>

	<body style="background-image:url('http://allpicts.in/download/20278/2017/09/Nike_Shoe_Wallpaper_with_Nike_Kyrie_3_Flip_the_Switch_for_Basketball-1600x900.jpg/');">
	<br> &nbsp;
	<br> &nbsp;
	<br> &nbsp;

	<u3>
		<li><a href="addShoes.php">Add a Shoe</a></li>
		<li><a href="addSuppliers.php">Add a Supplier</a></li>
	<u3>

</body>
</html>
