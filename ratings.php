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
<body style="background-image:url('http://allpicts.in/download/21382/2017/11/Nike_Shoes_Wallpaper_with_Nike_Flyknit_Chukka-1280x960.jpg/');">


<h2 style="color: white;">Shoe Ratings</h2>

  <?php
  // change the value of $dbuser and $dbpass to your username and password
  	include 'connectvars.php';


  	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  	if (!$conn) {
  		die('Could not connect: ' . mysql_error());
  	}

  // query to select all information from supplier table
  	$query = " SELECT DISTINCT Shoe.shoeID, Shoe.name, AVG(Rating.rating) FROM Rating, Shoe WHERE Rating.shoeID=Shoe.shoeID GROUP BY shoeID";

  // Get results from query
  	$result = mysqli_query($conn, $query);
  	if (!$result) {
  		die("Query to show fields from table failed");
  	}

  	if(mysqli_num_rows($result) > 0){
  		echo "<table id='t01' border=1>";
          echo "<thead>";
  			echo "<tr>";
  			echo "<th>Shoe ID</th>";
  			echo "<th>Name</th>";
  			echo "<th>Average Shoe Rating</th>";
  			echo "</tr>";
          echo "</thead>";
          echo "<tbody>";

          while($row = mysqli_fetch_array($result)){
              echo "<tr>";
              echo "<td>" . $row['shoeID'] . "</td>";
  			      echo "<td>" . $row['name'] . "</td>";
              echo "<td>" . $row['AVG(Rating.rating)'] . "</td>";
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
		<li color="black"><a color="black" href="addRatings.php">Add a Shoe Rating</a></li>
	<u3>
  </body>


</html>
