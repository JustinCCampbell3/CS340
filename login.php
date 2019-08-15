<!DOCTYPE html>

<?php
	$currentpage = "Login Page";
	session_start();
?>
<html>
	<header>
		<h1>Login</h1>
		<div background-color="black" width="100%" text-align="center" height="46px">
			<ul>
				<li><a href="index.html">Home</a></li>
				<li><a href="shoes.php">Shoes</a></li>
				<li><a href="suppliers.php">Suppliers</a></li>
				<li><a href="addShoes.php">Add a Shoe</a></li>
				<li><a href="addSuppliers.php">Add by Supplier</a></li>
			</ul>
		</div>
		<br> &nbsp;
		<br> &nbsp;
		<title>Login Page</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</header>
	
	<body style="background-image:url('https://w.wallhaven.cc/full/j8/wallhaven-j86mmm.jpg');">



		<center><div id="box01">
			<form action = "" method = "post">
				<div id="login_box">
					<h3>Enter username and password</h3>
					<div>
						<input type = "text" class = "textbox" name = "txt_uname" placeholder = "Username" />
						<br>
						<br>
						<input type = "password" class = "textbox" name = "txt_pwd" placeholder = "Password" />
						<br>
						<br>
						<input type = "submit" value = "Log in" name = "sub_btn" id = "sub_btn" />
				</div>
			</form>
		</div></center>
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
						echo "<script type = 'text/javascript'> document.location = 'index.php'; </script>"; //javascript inside php because the header redirect isn't working
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