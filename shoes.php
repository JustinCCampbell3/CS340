<!DOCTYPE html>
<?php
		$currentpage="List Shoes";

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
  </u1>
</div>
<br> &nbsp;
<br> &nbsp;
    <title>Shoe Buyer</title>
    <link rel="stylesheet" type="text/css" href="style.css">

</header>

<body style="background-image:url('https://wallpapercave.com/wp/gOwBe5H.png');">

<h2 style="color:white;">Shoes</h2>

  <?php
  // change the value of $dbuser and $dbpass to your username and password
  	include 'connectvars.php';


  	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  	if (!$conn) {
  		die('Could not connect: ' . mysql_error());
  	}

  // query to select all information from supplier table
  	$query = "SELECT name, price, brand, shoeID FROM Shoe ";

  // Get results from query
  	$result = mysqli_query($conn, $query);
  	if (!$result) {
  		die("Query to show fields from table failed");
  	}

  	if(mysqli_num_rows($result) > 0){

  		echo "<table id='t01' border='1'>";
          echo "<thead>";
  			echo "<tr>";
  			echo "<th>Name</th>";
  			echo "<th>Price</th>";
  			echo "<th>Brand</th>";
        echo "<th>ShoeID</th>";
  			echo "</tr>";
          echo "</thead>";
          echo "<tbody>";

          while($row = mysqli_fetch_array($result)){
              echo "<tr>";
              echo "<td>" . $row['name'] . "</td>";
  			      echo "<td>" . $row['price'] . "</td>";
              echo "<td>" . $row['brand'] . "</td>";
              echo "<td>" . $row['shoeID'] . "</td>";
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
	<u3>
		<li color="black"><a color="black" href="suppliers.php">Search for a Shoe</a></li>
	<u3>
	</body>


</html>
