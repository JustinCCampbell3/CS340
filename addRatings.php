<!DOCTYPE html>
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
<?php
	$msg = "Add a Shoe rating";

// change the value of $dbuser and $dbpass to your username and password
	include 'connectvars.php';
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

// Escape user inputs for security
		$shoeID = mysqli_real_escape_string($conn, $_POST['shoeID']);
		$rating = mysqli_real_escape_string($conn, $_POST['rating']);
		$username = mysqli_real_escape_string($conn, $_SESSION['uname']);

		$sql = "SELECT username, shoeID FROM `Orders` WHERE shoeID='$shoeID' AND username='$username'";
		$result1 = mysqli_query($conn, $sql);
		if(mysqli_num_rows($result1)>0){
			$sql2 = "SELECT username, shoeID FROM 'Rating' WHERE shoeID='$shoeID' AND username='$username'";
			$result2 = mysqli_query($conn, $sql2);
			if(mysqli_num_rows($result2) > 0){
				echo"<p>You have already rated the shoe</p>";
			}
			else{
				$sql3="SELECT MAX(rateID) FROM `Rating`";
				$result3=mysqli_query($conn, $sql3);
				$result3=$result3+1;
				$query = "INSERT INTO `Rating` (`rateID`, `username`, `shoeID`, `rating`) VALUES ('$result3', '$username', '$shoeID', '$rating')";
				if(mysqli_query($conn, $query)){
					$msg =  "Record added successfully.<p>";
				} else{
					echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
				}
			}
		}
		else{
			echo"<p>You have not purchased the shoe</p>";
		}
	}
// close connection
mysqli_close($conn);
?>

<br> &nbsp;

	<body style="background-image:url('https://w.wallhaven.cc/full/0q/wallhaven-0qx59q.jpg');">
		<h2 style="float: left;"> Add a Shoe Rating </h2>
		<br> &nbsp;
		<br> &nbsp;
		<form method="post" id="addForm" align="left">


			<p>
				<label for="shoeID">Shoe ID:</label>
				<input type="number" class="required" name="shoeID" id="shoeID">
			</p>
			<p>
				<label for="rating">Shoe Rating:</label>
				<input type="number" class="required" name="rating" id="rating">
			</p>

	        <input type = "submit"  value = "Submit" class="searchbarbutton" />
	        <input type = "reset"  value = "Clear Form" class="searchbarbutton"/>
	      </p>
		</form>
		</body>
	</html>
