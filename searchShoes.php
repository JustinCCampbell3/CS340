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
<body style="background-image:url('http://getwallpapers.com/wallpaper/full/4/f/7/713344-full-size-cool-shoes-hd-wallpapers-1920x1200-for-iphone.jpg');">


  <h2 style="color: black; float: left;">Search for a Shoe</h2>
	<br> &nbsp;
	<br> &nbsp;
	<form method="post" id="addForm" align="left">


		<p>
			<label for="name">Enter a Shoe Name:</label>
			<input type="text" class="required" name="name" id="name">
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
			$name = mysqli_real_escape_string($conn, $_POST['name']);
			$query = "SELECT * FROM Shoe WHERE name='$name' GROUP BY shoeID ";
			$result = mysqli_query($conn, $query);
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
		}
	?>




	</body>
</html>
