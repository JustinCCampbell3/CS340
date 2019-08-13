<!DOCTYPE html>
<?php
		$currentpage="List Suppliers";

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
    <li><a href="addSuppliers.php">Add by Supplier</a></li>
  </u1>

<br> &nbsp;

  <?php
  // change the value of $dbuser and $dbpass to your username and password
  	include 'connectvars.php';


  	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  	if (!$conn) {
  		die('Could not connect: ' . mysql_error());
  	}

  // query to select all information from supplier table
  	$query = "SELECT * FROM Supplier ";

  // Get results from query
  	$result = mysqli_query($conn, $query);
  	if (!$result) {
  		die("Query to show fields from table failed");
  	}

  	if(mysqli_num_rows($result) > 0){
          echo "<h1>Suppliers</h1>";
  		echo "<table id='t01' border='1'>";
          echo "<thead>";
  			echo "<tr>";
  			echo "<th>ID</th>";
  			echo "<th>Name</th>";
  			echo "<th>Address</th>";
  			echo "</tr>";
          echo "</thead>";
          echo "<tbody>";

          while($row = mysqli_fetch_array($result)){
              echo "<tr>";
              echo "<td>" . $row['supplierID'] . "</td>";
  			      echo "<td>" . $row['company_name'] . "</td>";
              echo "<td>" . $row['company_address'] . "</td>";
              echo "</tr>";
          }
          echo "</tbody>";
          echo "</table>";
  		// Free result set
          mysqli_free_result($result);
      } else{
  		echo "<p class='lead'><em>No records were found.</em></p>";
      }
  	mysqli_close($conn);
  ?>
  </body>


</html>
