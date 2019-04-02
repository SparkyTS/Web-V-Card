<!doctype html>
<?php session_start(); 
	if(isset($_GET['err']))
		echo "<script>alert('invalid username or password');</script>";
?>
<html>
	<head>
		<title>Login</title>
		<link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,300italic" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="css/login-style.css">
	

	</head>
	<body>
		<header>
			<div class="login-box">
				<img src="img/avatar.png" class="avatar">
				<h3>Login</h3>
				<form method="post" action="validate.php" name="login">
					<p>Username</p>
					<input  type="text" name="username" placeholder="Enter Username" required>
					<p>Password</p>
					<input type="password" name="password" placeholder="Enter Password" required>
					<input type="submit" name="submit" value="Login">
					<a href="Registration.php">Register</a>
				</form>
			</div>
		</header>
	</body>	
	<script src="js/random.js"></script>
</html>