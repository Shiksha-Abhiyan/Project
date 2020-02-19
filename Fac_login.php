<?php
	session_start();
	require 'DBconfig/config.php'
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body style="background-color:#7f8c8d">
	<div id="main-wrapper">
		<center>
			<h2>Faculty Login Form</h2>
			<img src="img.jpeg" class="image" />
		</center>
	
		<form action="fac_login.php" method="post" class="form">
			<label><b>Username</label><br>
			<input name="username" type="text" class="input" placeholder="Type Username" required pattern="[0-9,a-z]{5}" title="Enter Unique Username which should be AlphaNumeric and of length 5"><br>
			<label><b>Password</label><br>
			<input name="password" type="Password" class="input" placeholder="Type Password" required><br>
			<input name="login" type="submit" id="l_btn" value="Login"><br>
			<a href="fac_Register.php"><input type="button" id="R_btn" value="Register"></a>	
			<div style="font-size: 0.8em; text-align: center;"><a href="forgot_pass.php">Forgot Your Password ?</a></div>	
		</form>
		<?php 
			if(isset($_POST['login']))
			{
				$username=$_POST['username'];
				$password=$_POST['password'];

				$query="select * from faculty where username='$username' and password='$password'";
				$query_run=mysqli_query($con,$query);
				if(mysqli_num_rows($query_run)>0)
				{
					$row=mysqli_fetch_assoc($query_run); 
					$_SESSION['username']=$row['username'];
					$_SESSION['imglink']=$row['imglink'];
					header('location:fac_profile.php');
				}
				else
				{
					echo'<script type="text/javascript"> alert("Invalid Username or Password")</script>';
				}
			}

		?>
	</div>
</body>
</html>