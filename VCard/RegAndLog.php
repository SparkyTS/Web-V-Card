<!-- Function to valid date user data-->
<?php

	function valid_email($email) {
		return preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email);
	}

	function valid_pass($password) {
		return strlen($password) >= 8;
	}

	function valid_uname($username){
		return preg_match("/^[a-z_][a-z0-9_]*$/i",$username);
	}

?>

<?php
	session_start();
	
	$username = $_POST['username'];
	$password = $_POST['password'];
	$email = $_POST['email'];

	if(valid_email($email) && valid_pass($password) && valid_uname($username)){
		//inserting user into the database
		$con = mysqli_connect("localhost","root","","vcarddb");
		$result = mysqli_query($con,"insert into registration values('$username','$password','$email');");
		if(!$result)
			echo "Error while inserting data to the database";
		else{
			$_SESSION['username'] = $username;
			header("location:http://localhost/Vcard/homepage.php");
		}
	}
	else{
		header("location:http://localhost/Vcard/registration.php?err=1");
	}
?>
