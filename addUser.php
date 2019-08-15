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
		$currentpage="Add Shoes";

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
<br> &nbsp;

	<body style="background-image:url('https://w.wallhaven.cc/full/0q/wallhaven-0qx59q.jpg');">



<?php
	$msg = "Register a New User";

// change the value of $dbuser and $dbpass to your username and password
	include 'connectvars.php';

	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

// Escape user inputs for security
		$username = mysqli_real_escape_string($conn, $_POST['username']);
		$password = mysqli_real_escape_string($conn, $_POST['password']);
		$firstname = mysqli_real_escape_string($conn, $_POST['First_Name']);
		$lastname = mysqli_real_escape_string($conn, $_POST['Last_Name']);

// See if username is already in the table
		$queryIn = "SELECT * FROM User WHERE username='$username' ";
		$resultIn = mysqli_query($conn, $queryIn);
		if (mysqli_num_rows($resultIn)> 0) {
			$msg ="<h2>Can't Add to Table</h2> There is already a user with the name $username<p>";
		} else {

		// attempt insert query
			$query = "INSERT INTO User (username, password, First_Name, Last_Name) VALUES ('$username', '$password', '$firstname', '$lastname')";
			if(mysqli_query($conn, $query)){
				$msg =  "Registered successfully.<p>";
			} else{
				echo "ERROR: Could not execute $query. " . mysqli_error($conn);
			}
		}
}
// close connection
mysqli_close($conn);

?>

	<h2 style="float: left;"> <?php echo $msg; ?> </h2>
	<br> &nbsp;
	<br> &nbsp;
	<form method="post" id="addForm" align="left">


		<p>
			<label for="firstname">First Name:</label>
			<input type="text" class="required" name="firstname" id="firstname">
		</p>
		<p>
			<label for="lastname">Last Name:</label>
			<input type="text" class="required" name="lastname" id="lastname">
		</p>
		<p>
			<label for="username">Username:</label>
			<input type="text" class="required" name="username" id="username">
		<p>
		<p>
			<label for="username">Password:</label>
			<input type="password" class="required" name="password" id="password">
		<p>
        <input type = "submit"  value = "Submit" class="searchbarbutton" />
        <input type = "reset"  value = "Clear Form" class="searchbarbutton"/>
      </p>
	</form>
	</body>
</html>
