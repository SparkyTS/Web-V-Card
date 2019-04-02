<!--Making sure that user have logged in-->
<?php
session_start();
	if(!isset($_SESSION['username']))
		header("location:http://localhost/Vcard/login.php?err=1");
	
	$username = $_SESSION['username'];

	$id = "";
	if(isset($_GET['id'])){
		$id = $_GET['id'];
	}
	
	$update = 0;
	if(isset($_GET['update']))
		$update = $_GET['update'] == NULL? 0 : 1;
?>

<!--Validation Functions-->
<?php
	function valid_name($str){
		return preg_match("/^[a-z _]*$/i",$str);
	}

	function valid_job_title($str){
		return preg_match("/^[a-z _.]*$/i",$str);
	}

	function valid_email($email) {
		return preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email);
	}

	function valid_company($company){
		return preg_match("/^[a-z0-9./]*$/i",$company);
	}

	function valid_phone_no($phone){
		return preg_match("/^[0-9]{10,11}$/",$phone);
	}
?>

<?php
//getting data and storing into the variables.
	$name = trim($_POST['name']);
	$job_title = trim($_POST['job_title']);
	$email = trim($_POST['email']);
	$phone_no = trim($_POST['phone_no']);
	$company_name = "N/A";
	$website = "N/A";
	$u_type = "unknown";

	if(trim($_POST['company_name'])!="")
		$company_name = trim($_POST['company_name']);
	
	if(trim($_POST['website'])!="") 
		$website = trim($_POST['website']);

	if(isset($_GET['u_type']))
			$u_type = $_GET['u_type'];

//validating the user input before saving the data to the database.
	if(valid_name($name) && valid_job_title($job_title) && valid_email($email) && valid_phone_no($phone_no)){
		$con = mysqli_connect("localhost","root","","vcarddb");
		
		//generating query to be executed in the database based on the user exist or not.
		//update = 1 indicates that user is already in the database.
		if($update==1)
			$query = "update cards set name='$name',job_title='$job_title',company_name='$company_name',email='$email',website='$website',phone_no='$phone_no',u_type='$u_type' WHERE phone_no='$id' AND username='$username'";
		else
			$query = "insert into cards values('$username','$name','$job_title','$company_name','$email','$website','$phone_no','$u_type');";
		
		$result = mysqli_query($con,$query);
		
		if(!$result)
			echo "Error while inserting data to the database &nbsp; <a href=\"#\">contact us</a><br>";
		else
			header("location:http://localhost/Vcard/homepage.php");
	} 
	else{
		header("location:http://localhost/Vcard/editcard.php?err=1&id=$id");
	}	
?>