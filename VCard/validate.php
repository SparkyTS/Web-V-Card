<?php
session_start();

//fetching data from login form
$username = $_POST['username'];
$password = $_POST['password'];

//validation functions for username and password
function valid_uname($username){
	return preg_match("/^[a-z_][a-z0-9_]*$/i",$username);
}

function valid_pass($password) {
	return strlen($password) >= 8;
}

//if the username and password satisfy the criteria only than look into the database
if(valid_uname($username) && valid_pass($password)){
	$con = mysqli_connect("localhost","root","","vcarddb");
	$result = mysqli_query($con,"select * from registration where BINARY username='$username'  AND BINARY password='$password'");
	$rows = mysqli_num_rows($result);
	if($rows>0){
		$_SESSION['username'] = $username;
			header("location:http://localhost/Vcard/homepage.php");
	}
	else{		
		header("location:http://localhost/Vcard/login.php?err=1no record");
	}
}
else{	
		header("location:http://localhost/Vcard/login.php?err=1");
}
?>