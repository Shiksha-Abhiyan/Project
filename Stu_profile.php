<?php
 	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Student Profile Page</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body style="background-color:#7f8c8d">
	<div id="main-wrapper">
		<center>
			<h2>Student Profile Page</h2>
			<h3>Welcome <?php echo $_SESSION['enrollment'] ?>
			</h3>
			<?php echo'<img  class="image" src="'.$_SESSION['imglink'].'"/>';  ?>
		</center>
	
		<form action="Stu_profile.php" method="post" class="form">
		<input name="lout" type="submit" id="L_btn" value="LogOut">		
		</form>
		<?php
			if(isset($_POST['lout']))
			{
				session_destroy();
				header('location:Stu_login.php');	
			} 	
		?>
	</div>
</body>
</html> 