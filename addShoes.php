<!DOCTYPE html>
<?php
		$currentpage="Add Shoes";

?>
<html>
  <head>
    <title>Shoe Buyer</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>

  <header>
    <h1>Shoe Buyer</h1>
  </header>


  <u1>
    <li><a href="index.html">Home</a></li>
    <li><a href="shoes.php">Shoes</a></li>
    <li><a href="suppliers.php">Suppliers</a></li>
		<li><a href="addShoes.php">Add a Shoe</a></li>
    <li><a href="addSuppliers.php">Add a Supplier</a></li>
  </u1>

<br> &nbsp;

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

	<h2> <?php echo $msg; ?> </h2>

	<form method="post" id="addForm">

  <legend>Shoe Info:</legend>
  		<p>
  			<label for="shoeID">Shoe ID:</label>
  			<input type="number" class="required" name="shoeID" id="shoeID">
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
        <input type = "submit"  value = "Submit" />
        <input type = "reset"  value = "Clear Form" />
      </p>
	</form>
	</body>
</html>
