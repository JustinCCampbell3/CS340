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

	<body style="background-image:url('http://s1.1zoom.me/big0/100/346655-admin.jpg');">



<?php
	$msg = "Add a new Shoe Supplier to the Database";

// change the value of $dbuser and $dbpass to your username and password
	include 'connectvars.php';

	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

// Escape user inputs for security
		$supplierID = mysqli_real_escape_string($conn, $_POST['supplierID']);
		$company_name = mysqli_real_escape_string($conn, $_POST['company_name']);
		$company_address = mysqli_real_escape_string($conn, $_POST['company_address']);

// See if sid is already in the table
		$queryIn = "SELECT * FROM Supplier where company_name='$company_name' ";
		$resultIn = mysqli_query($conn, $queryIn);
		if (mysqli_num_rows($resultIn)> 0) {
			$msg ="<h2>Can't Add to Table</h2> There is already a supplier with the ID $company_name<p>";
		} else {

		// attempt insert query
			$query = "INSERT INTO Supplier (supplierID, company_name, company_address) VALUES ('$supplierID', '$company_name', '$company_address')";
			if(mysqli_query($conn, $query)){
				$msg =  "Record added successfully.<p>";
			} else{
				echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
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
			<label for="supplierID">Supplier ID:</label>
			<input type="text" class="required" name="suppplierID" id="supplierID" title="Supplier ID should be numeric">
		</p>
		<p>
			<label for="comapny_name">Company Name:</label>
			<input type="text" class="required" name="company_name" id="comapny_name">
		</p>
		<p>
			<label for="company_address">Company Address:</label>
			<input type="text" class="required" name="company_address" id="company_address">


      <p>
        <input type = "submit"  value = "Submit" class="searchbarbutton" />
        <input type = "reset"  value = "Clear Form" class="searchbarbutton"/>
      </p>
	</form>
	</body>
</html>
