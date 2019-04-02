<!--Checking if the user is logged in-->
<?php
session_start();
	if(!isset($_SESSION['username'])){
		header("location:http://localhost/Vcard/login.php?err=1");
	}
	$username = $_SESSION['username'];
 ?>

<!--making connection to database-->
<?php

	$con = mysqli_connect("localhost","root","","vcarddb");
	
	if (!$con) {
    	die("Connection failed: " . mysqli_connect_error());
	}

//	Fetching the cards saved in the users account
	$result = mysqli_query($con,"select * from cards where username = '$username' ;");
?>

<html>
	<head>
		<link rel="stylesheet" href="css/style.css" type="text/css">
		<link href='http://fonts.googleapis.com/css?family=Ubuntu:400,400italic' rel='stylesheet' type='text/css'>
		<title>Visiting Cards</title>
	</head>
	
	<body>
			<h1>VISITING CARDS</h1>
			<div class="clearfix" style="margin-right: 5%;margin-top: 10px;">
				<a class="btn" href="editcard.php">Add New Card</a>
				<a class="btn" href="logout.php\">Logout</a>
			</div>
		<section>
			<?php	
//				Displaying the cards from the users account
				if (mysqli_num_rows($result) > 0) {
					while($card = mysqli_fetch_assoc($result)) {
						echo '<div id="bcbg">
						  <div class="card">
							<img src="img/'.$card['u_type'].'.png">  
							<p class="line1">'.$card['name'].'</p>
							<p class="line2">'.$card['job_title'].'</p>
							<p class="line2">🏢&nbsp;'.$card['company_name'].'&nbsp;🏢</p>
							<div class="contact">
								<p class="line4">📧 : '.$card['email'].'</p>
								<p class="line4">🌐 : '.$card['website'].'</p>
								<p class="line4">&nbsp;📱&nbsp;&nbsp;: '.$card['phone_no'].'</p>
							</div>
							<a class="btn" href="delete.php?id='.$card['phone_no'].'">delete</a>
							<a class="btn" href="editcard.php?id='.$card['phone_no'].'">Update</a>
							<input type="hidden" value="1">
						  </div>  
						</div>';
					}
			} else {
					echo '<div id="bcbg">
						  <div class="card">
							<img src="img/man.png">  
							<p class="line1">'."Name".'</p>
							<p class="line2">'."Job Title".'</p>
							<p class="line2">🏢&nbsp;'."Company Name".'&nbsp;🏢</p>
							<div class="contact">
								<p class="line4">📧 : '."Email".'</p>
								<p class="line4">🌐 : '."Website".'</p>
								<p class="line4">&nbsp;📱&nbsp;&nbsp;: '."Contact No.".'</p>
								</div>
								<a class="btn" href="#">delete</a>
								<a class="btn" href="editcard.php">Update</a>
								<input type="hidden" value="1">
								</div>  
							</div>';
			}
			?>
		</section>
	</body>
	
	<!-- Adding this to generate the random page background and card's background	-->
	<script src="js/random.js"></script>
</html>

<!--
ref icon : https://www.iconfinder.com/search/
-->