<!DOCTYPE html>

<?php
	$currentpage = "Login Page";

?>
<html>
	<head>
		<title>Login</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	
	<header>
		<h1>Login</h1>
	</header>
	
	<body>
		<ul>
			<li><a href="index.html">Home</a></li>
			<li><a href="shoes.php">Shoes</a></li>
			<li><a href="suppliers.php">Suppliers</a></li>
			<li><a href="addShoes.php">Add a Shoe</a></li>
			<li><a href="addSuppliers.php">Add by Supplier</a></li>
		</ul>

		<br>


		<div>
			<form action = "" method = "post">
					<h4>Enter username and password<h4>
						<input type = "text" class = "textbox" name = "txt_uname" placeholder = "Username" />
						<input type = "password" class = "textbox" name = "txt_pwd" placeholder = "Password" />
						<input type = "submit" value = "Log in" name = "sub_btn" id = "sub_btn" />
			</form>
		</div>
		<?php

			include 'connectvars.php';
			$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
			if(!$conn)
			{
				die('Could not connect: '.mysql_error());
			}
	
			if(isset($_POST['sub_btn']))
			{
				$uname = mysqli_real_escape_string($conn, $_POST['txt_uname']);
				$password = mysqli_real_escape_string($conn, $_POST['txt_pwd']);
		
				if($uname != "" && $password != "")
				{
					$sql_query = "SELECT COUNT(*) AS userNum FROM User WHERE username = '".$uname."' AND password = '".$password."'";
					$result = mysqli_query($conn, $sql_query);
					$row = mysqli_fetch_array($result);
					$cnt = $row['userNum'];
					if($cnt > 0)
					{
						$_SESSION['uname'] = $uname;
						echo "<script type = 'text/javascript'> document.location = 'index.html'; </script>"; //javascript inside php because the header redirect isn't working
					}
					else
					{
						echo "Invalid username and/or password";
					}
				}
			}
		?>
	</body>
</html>