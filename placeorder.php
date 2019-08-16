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
<?php
		$currentpage="Order Placed";

?>
<html>
<header>
	<h1>Shoe Buyer</h1>

<div background-color="black" width="100%" text-align="center" height="46px">
  <u1>
    <li><a href="index.php">Home</a></li>
    <li><a href="shoes.php">Shoes</a></li>
    <li><a href="suppliers.php">Suppliers</a></li>
    <li><a href="admin.php">Admin</a></li>
	<li><div id="submit_button"><form method = 'post' action = ""><input type = "submit" value = "Log out" name = "logout_btn" /></form></div></li>
  </u1>
</div>
<br> &nbsp;
<br> &nbsp;
    <title>Shoe Buyer</title>
    <link rel="stylesheet" type="text/css" href="style.css">

</header>
<body style="background-image:url('https://wallpapercave.com/wp/gOwBe5H.png');">

<h2 style="color:white;">Order Placed!</h2>

<?php
	include 'connectvars.php';
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if(!$conn)
	{
		die('Could not connect: '.mysql_error());
	}
	
	
	$quantity = mysqli_real_escape_string($conn, $_POST['quant']);
	$username = mysqli_real_escape_string($conn, $_SESSION['uname']);
	$shoeID = mysqli_real_escape_string($conn, $_POST['IDnum']);
	
	if($quantity > 0)
	{
		$query = "INSERT INTO Orders (username, shoeID, quantity, price) VALUES ('$username', '$shoeID', '$quantity', get_total('$quantity', '$shoeID'))";
		if(mysqli_query($conn, $query))
		{
			echo "Order successful.";
		}
		else
		{
			echo "Error: could not execute $query. " .mysqli_error($conn);
		}
	}
	
	sleep(2);
	echo "<script type = 'text/javascript'> document.location = 'shoes.php'; </script>";
	
?>
</body>
</html>