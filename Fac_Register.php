<?php 
	require 'DBconfig/config.php'
?>
<!DOCTYPE html>
<html>
<head>
		<link rel="stylesheet" type="text/css" href="style.css">
	<title>Faculty Registration Page</title>
	<script>	
	
		var check = function() 
		{

  			if (document.getElementById('password').value == document.getElementById('cpassword').value) 
  			{
    			document.getElementById('message').style.color = 'green';
    			document.getElementById('message').innerHTML = 'Password Matched';
  			}
  			else 
  			{
    			document.getElementById('message').style.color = 'red';
    			document.getElementById('message').innerHTML = 'Password Not matched Please Enter Same Passwords';
  			}
		}

		function previewimg()
		{
			var oFReader = new FileReader();
			oFReader.readAsDataURL(document.getElementById("imglink").files[0]);

			oFReader.onload = function(oFREvent)
			{
				document.getElementById("uploadPreview").src = oFREvent.target.result;
			};
		};
	</script>
</head>
<body style="background-color:#7f8c8d">
	<form action="fac_Register.php" method="post" class="form" enctype="multipart/form-data">
	<div id="main-wrapper">
		<center>
			<h2>Faculty Registration Form</h2>
			<img src="img.jpeg" class="image" id="uploadPreview" /><br>
			<input type="file" id="imglink" name="imglink" accept=".jpg,.jpeg,.png" onchange="previewimg();"/>
		</center>
	
			<label><b>Full Name</label><br>
			<input name="fullname" type="text" class="input" placeholder="Type Full Name" id="fullname" required><br>

			<label><b>Username </label><br>
			<input name="username" type="text" class="input" id="username" placeholder="Type Username" required pattern="[0-9,a-z]{5}" title="Enter Unique Username which should be AlphaNumeric and of length 5"><br>

			<label><b>Email</label><br>
			<input name="email" type="text" class="input" id="email" placeholder="Type email" required title="Enter proper Email Address"><br>

			<label><b>Password</label><br>
			<input name="password" type="Password" class="input" placeholder="Type Password" required id='password'/><br>

			<label><b>Confirm Password</label><br>
			<input name="cpassword" type="Password" class="input" placeholder="Confirm Password" id='cpassword' required onkeyup='check();'/><br>
			<center><span id='message'></span><br></center>


			<label>Phone Number</label>
			<input name="phone" type="text" class="input" id="phone" placeholder="Type Phone Number" required pattern="[0-9]{10}" title="Enter proper 10 Digit Mobile Number"><br>

			<label>Gender</label>
			<input type="radio"  name="gender" class="rbtn" value="male" checked required>Male
			<input type="radio"  name="gender" class="rbtn" value="female" required>Female<br><br>

			<label>Institute:</label>
			<select class="spe" name="Institute">
				<option value="ICT">Institute Of Computer Technology</option>
				<option value="DCS">Departmet of Computer Science</option>
				<option value="UVPEC">U.V Patel Engineering College</option>
			</select><br>

			<input name="sub_btn" type="submit" id="S_btn" value="SignUp"><br>
			<a href="Fac_login.php"><input name="back_btn" type="button" id="B_btn" value="Back"></a>		
		</form>
		<?php
			if(isset($_POST['sub_btn']))
			{
				$fullname=$_POST['fullname'];
				$gender=$_POST['gender'];
				$email=$_POST['email'];
				$username=$_POST['username'];
				$phone=$_POST['phone'];
				$Institute=$_POST['Institute'];
				$password=$_POST['password'];
				$c_password=$_POST['cpassword'];

				$img_name=$_FILES['imglink']['name'];
				$img_size=$_FILES['imglink']['size'];
				$img_tmp=$_FILES['imglink']['tmp_name'];

				$directory='uploads/';
				$target_file = $directory.$img_name; 

				if($password==$c_password)
				{
					$query="select * from faculty where username='$username'";
					$query_run=mysqli_query($con,$query);

					if(mysqli_num_rows($query_run)>0)
					{
						echo'<script type="text/javascript"> alert("Username Already Exists.... Try with Other Username")</script>';
					}

					elseif (file_exists($target_file)) 
					{
						echo'<script type="text/javascript"> alert("Image File Already Exists.... Try with Other Image")</script>';		
					}

					elseif ($img_size>2097153)
					{
						echo'<script type="text/javascript"> alert("Image Size is Greater than 2 MB .... Try with less Size Image")</script>';
					}

					else
					{
						move_uploaded_file($img_tmp, $target_file);

						$query="insert into faculty values('','$username','$password','$fullname','$email','$phone','$gender','$Institute','$target_file')";
						$query_run = mysqli_query($con,$query);
						if($query_run)
						{	
							echo'<script type="text/javascript"> alert("User Registered")</script>';
						}
						else
						{
							echo'<script type="text/javascript"> alert("Error!!")</script>';
						}
					}
				}
				else
				{
					echo'<script type="text/javascript"> alert("Password and Confirm Password Doesnt Match")</script>';
				}

			}
		?>
	</div>
</body>
</html>