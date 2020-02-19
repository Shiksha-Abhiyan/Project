<?php 
	require 'DBconfig/config.php'
?>
<!DOCTYPE html>
<html>
<head>
	<title>Student Registration Page</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script>
		var check = function() 
		{

  			if (document.getElementById('password').value == document.getElementById('cpassword').value) 
  			{
    			document.getElementById('message').style.color = 'green';
    			document.getElementById('message').innerHTML = '"Password Matched"';
  			}
  			else 
  			{
    			document.getElementById('message').style.color = 'red';
    			document.getElementById('message').innerHTML = '"Password Not matched Please Enter Same Passwords"';
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
	<form action="Stu_Register.php" method="post" class="form" enctype="multipart/form-data">
	<div id="main-wrapper">
		<center>
			<h2>Student Registration Form</h2>
			<img src="img.jpeg" class="image" id="uploadPreview" /><br>
			<input type="file" id="imglink" name="imglink" accept=".jpg,.jpeg,.png" onchange="previewimg();"/>
		</center>

			<label><b>Full Name</label><br>
			<input name="fullname" type="text" class="input" placeholder="Type Full Name" required><br>

			<label><b>Enrollment Number</label><br>
			<input name="enrollment" type="text" class="input" placeholder="Type Enrollment Number" required pattern="[0-9]{11}" title="Enter 11 Digit Enrollment Number"><br>

			<label><b>Email</label><br>
			<input name="email" type="text" class="input" placeholder="Type email" required title="Enter proper Email Address"><br>

			<label><b>Password</label><br>
			<input name="password" type="Password" class="input" id="password" placeholder="Type Password" required><br>
			<label><b>Confirm Password</label><br>

			<input name="cpassword" type="Password" class="input" id="cpassword" placeholder="Confirm Password" required onkeyup="check();"><br>
			<center><span id='message'></span><br></center>

			<label>Gender</label>
			<input type="radio"  name="gender" class="rbtn" value="male" checked required>Male
			<input type="radio"  name="gender" class="rbtn" value="female" required>Female<br><br>

			<label>Semester</label>
			<input type="radio"  name="semt" class="rbtn" value="Sem 2" required checked>Sem-2
			<input type="radio"  name="semt" class="rbtn" value="Sem 4" required>Sem-4
			<input type="radio"  name="semt" class="rbtn" value="Sem 6" required>Sem-6
			<input type="radio"  name="semt" class="rbtn" value="Sem 8" required>Sem-8<br><br>

			<label>Specialization:</label>
			<select class="spe" name="Specialization">
				<option value="CBA">CBA</option>
				<option value="MA">MA</option>
				<option value="BDA">BDA</option>
				<option value="CS">CS</option>
			</select><br>

			<input name="sub_btn" type="submit" id="S_btn" value="SignUp"><br>
			<a href="Stu_login.php"><input name="back_btn" type="button" id="B_btn" value="Back"></a>		
		</form>
		<?php
			if(isset($_POST['sub_btn']))
			{
				$fullname=$_POST['fullname'];
				$gender=$_POST['gender'];
				$email=$_POST['email'];
				$enrollment=$_POST['enrollment'];
				$semester=$_POST['semt'];
				$special=$_POST['Specialization'];
				$password=$_POST['password'];
				$c_password=$_POST['cpassword'];

				$img_name=$_FILES['imglink']['name'];
				$img_size=$_FILES['imglink']['size'];
				$img_tmp=$_FILES['imglink']['tmp_name'];

				$directory='uploads/';
				$target_file = $directory.$img_name;

				if($password==$c_password)
				{
					$query="select * from student where enrollmentno='$enrollment'";
					$query_run=mysqli_query($con,$query);

					if(mysqli_num_rows($query_run)>0)
					{
						echo'<script type="text/javascript"> alert("Enrollment Number Already Exists.... Try with Other Enrollment Number")</script>';
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

						$query="insert into student values('','$enrollment','$fullname','$special','$password','$semester','$gender','$email','$target_file')";
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