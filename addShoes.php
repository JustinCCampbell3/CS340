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
<body style="background-image:url('http://getwallpapers.com/wallpaper/full/4/f/7/713344-full-size-cool-shoes-hd-wallpapers-1920x1200-for-iphone.jpg');">


  <div class="footer">
    <p></p>
  </div>

<?php
	$msg = "Add a new Shoe to the Database";

// change the value of $dbuser and $dbpass to your username and password
	include 'connectvars.php';

	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

// Escape user inputs for security
		$shoeID = mysqli_real_escape_string($conn, $_POST['shoeID']);
		$brand = mysqli_real_escape_string($conn, $_POST['brand']);
		$style = mysqli_real_escape_string($conn, $_POST['style']);
		$name = mysqli_real_escape_string($conn, $_POST['name']);
		$size = mysqli_real_escape_string($conn, $_POST['size']);
		$color = mysqli_real_escape_string($conn, $_POST['color']);
		$price = mysqli_real_escape_string($conn, $_POST['price']);
		$supplierID = mysqli_real_escape_string($conn, $_POST['supplierID']);
// See if sid is already in the table
		$queryIn = "SELECT * FROM Shoe where shoeID='$shoeID' ";
		$resultIn = mysqli_query($conn, $queryIn);
		if (mysqli_num_rows($resultIn)> 0) {
			$msg ="<h2>Can't Add to Table</h2> There is already a shoe with the ID $company_name<p>";
		} else {

		// attempt insert query
			$query = "INSERT INTO Shoe (shoeID, brand, style, name, size, color, price, supplierID) VALUES ('$shoeID', '$brand', '$style', '$name', '$size', '$color', '$price', '$supplierID')";
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

	<h2 style="float: right;"> <?php echo $msg; ?> </h2>
	<br> &nbsp;
	<br> &nbsp;
	<form method="post" id="addForm" align="right">


  		<p>
  			<label for="shoeID">Shoe ID:</label>
  			<input type="text" class="required" name="shoeID" id="shoeID">
  		</p>
  		<p>
  			<label for="Brand">Brand:</label>
  			<input type="text" class="required" name="brand" id="brand">
  		</p>
  		<p>
  			<label for="Style">Style:</label>
  			<input type="text" class="required" name="style" id="style">
      </p>
        <p>
    			<label for="name">Name:</label>
    			<input type="text" class="required" name="name" id="name">
    		</p>
        <p>
    			<label for="size">Size:</label>
    			<input type="text" class="required" name="size" id="size">
    		</p>
        <p>
    			<label for="color">Color:</label>
    			<input type="text" class="required" name="color" id="color">
    		</p>
        <p>
    			<label for="price">Price:</label>
    			<input type="text" class="required" name="price" id="price">
    		</p>
        <p>
    			<label for="supplierID">Supplier ID:</label>
    			<input type="text" class="required" name="supplierID" id="supplierID">
    		</p>
      <p>
        <input type = "submit" value = "Submit" class="searchbarbutton"/>
        <input type = "reset"  value = "Clear Form" class="searchbarbutton"/>
      </p>
	</form>
	<div>
	</body>
</html>
