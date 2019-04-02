<!--
	TO DELETE THE CARD FORM DATABASE
-->
<?php
session_start();
	if(!isset($_SESSION['username']))
		header("location:http://localhost/Vcard/login.php?err=1");
	$username = $_SESSION['username'];

	if(isset($_GET['id'])){
		$ph_no = $_GET['id'];

		$con = mysqli_connect("localhost","root","","vcarddb");

		if (!$con) 
			die("Connection failed: " . mysqli_connect_error());

		mysqli_query($con,"delete from cards where username = '$username' AND phone_no = '$ph_no' ;");

		header("location:http://localhost/Vcard/homepage.php");
	} else {
		echo "error name = id is not defined &nbsp; <br> <a href=\"#\">contact us</a>";
	}
 ?>