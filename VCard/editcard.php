<!-- Making sure that user is logged in -->
<?php
session_start();
	if(!isset($_SESSION['username'])){
		header("location:http://localhost/Vcard/login.php?err=1");
	}
	$username = $_SESSION['username'];
?>

<!-- generating error if any-->
<?php
	if(isset($_GET['err']))
		echo "<script type='text/javascript'>alert('please enter valid information');</script>";

//	getting id to modify card into the databse
	$id = "";
	if(isset($_GET['id']))
		$id = $_GET['id'];
?>

<html>
	<head>
		<link rel="stylesheet" href="css/style.css" type="text/css">
		<link href='http://fonts.googleapis.com/css?family=Ubuntu:400,400italic' rel='stylesheet' type='text/css'>
		<title>	Card </title>
		<!--adding some css to beautify the inputs :)-->
		<style>
			input[type="text"],input[type="email"]{
				width:250px;
				margin-bottom: 15px;
				background-color: rgba(255, 255, 255, 0);
				border:none;
				color:#fff;
			}
		</style>
		
		<!-- adding script to set the user icon and id to request parameters -->
		<script>
			var userId;
			function setUser(form){
				var userIcon = document.getElementById('user').src.split('img/')[1];
				if(userIcon==="man.png")
					form.action += "u_type=man";
				else
					form.action += "u_type=woman";
				form.action += `&id=${userId}`;
			}
		</script>
	</head>
	
	<body>
		<div id="bcbg">
			<form method="post" action="save.php?<?php if($id!="")echo 'update=1&'?>" onsubmit="setUser(this);">
			 	
				<!-- For fetching the data if card needs to be updated -->
				<?php
				$con = mysqli_connect("localhost","root","","vcarddb");

				if (!$con)
					die("Connection failed: " . mysqli_connect_error());
				
				$result = mysqli_query($con,"select * from cards where username = '$username' AND phone_no='$id' ;");

//				Checking if user is exist in database or not
				if($id=="" || mysqli_num_rows($result) < 1){	
					echo '
						<div class="card"> 
							<img id="user" src="img/man.png">  
							<input type="text" class="line1" placeholder="Enter Name" name="name" required>
							<input type="text" class="line2" placeholder="Enter job title" name="job_title" required>
							<input type="text" class="line2" placeholder="Enter company name" name="company_name">
							<div class="contact" style="margin-top: 20px">
								<input type="email" class="line3" placeholder="Enter Email" name="email" required>
								<input type="text" class="line3" placeholder="Enter Website" name="website">
								<input id="uid" type="text" class="line3" placeholder="Enter Phone No." name="phone_no" required>  
							</div>

							<input class="btn" type="submit" value="Save">
							<a class="btn" href="./homepage.php">Cancle</a>
						</div>';  
				}
				else{
					$card = mysqli_fetch_assoc($result);
					echo '
						<div class="card"> 
							<img id="user" src="img/'.$card['u_type'].'.png">  
							<input type="text" class="line1" placeholder="Enter Name" name="name" value="'.$card['name'].'" required>
							<input type="text" class="line2" placeholder="Enter job title" name="job_title" value="'.$card['job_title'].'" required>
							<input type="text" class="line2" placeholder="Enter company name" name="company_name" value="'.$card['company_name'].'">
							<div class="contact" style="margin-top: 20px">
								<input type="email" class="line3" placeholder="Enter Email" name="email" value="'.$card['email'].'" required>
								<input type="text" class="line3" placeholder="Enter Website" name="website" value="'.$card['website'].'">
								<input id="uid" type="text" class="line3" placeholder="Enter Phone No." name="phone_no" value="'.$card['phone_no'].'" required>
							</div>

							<input class="btn" type="submit" value="Save">
							<a class="btn" href="./homepage.php">Cancle</a>
						</div>'; 
				}

//				  This is very importatnt. It is used to store the id before user modifies it.
//				  This needs to be done in order to modify data in the database 
				  echo "<script>window.addEventListener('load',function(){userId = document.getElementById('uid').value;});</script>";
				?>
			</form>
		</div>	
	</body>
	
	<!-- Adding random.js to get random background and card color -->
	<script src="js/random.js"></script>

	<!-- Adding script to toggle the user image	-->
	<script>
		var userImg = document.getElementById('user');
		userImg.addEventListener('click',function(){
		if(userImg.src.split('img/')[1]==="man.png")
			userImg.src = "img/woman.png";
		else
			userImg.src = "img/man.png";
		});
	</script>
</html>