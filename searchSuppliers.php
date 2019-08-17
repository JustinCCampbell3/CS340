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
    <title>Shoe Buyer</title>;
    <link rel="stylesheet" type="text/css" href="style.css">

</header>
<body style="background-image:url('https://wallpapercave.com/wp/3eaIVZM.jpg');">


  <h2 style="color: black; float: left">Search for a Supplier</h2>
	<br> &nbsp;
	<br> &nbsp;


	<form method="post" id="addForm" align="right">
		<p>
			<label for="company_name">Enter a Company Name:</label>
			<input type="text" class="required" name="company_name" id="company_name">
		</p>
		<p>
			<input type = "submit"  value = "Submit" name="sub_btn" id="sub_btn" class="searchbarbutton" />
			<input type = "reset"  value = "Clear Form" class="searchbarbutton"/>
		</p>
	</form>



	<?php
	// change the value of $dbuser and $dbpass to your username and password
		include 'connectvars.php';


		$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		if (!$conn) {
			die('Could not connect: ' . mysql_error());
		}
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$company_name = mysqli_real_escape_string($conn, $_POST['company_name']);
			$query = "SELECT * FROM Supplier WHERE company_name='$company_name' GROUP BY supplierID ";
			$result = mysqli_query($conn, $query);
			if(mysqli_num_rows($result) > 0){
	  		echo "<table id='t01' border=1>";
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


		}
	?>
	</body>
</html>
