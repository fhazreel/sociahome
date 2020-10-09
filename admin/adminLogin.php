<?php
session_start();
error_reporting(0);
include("include/config.php");

	if(isset($_POST['submit']))
	{
		$username=$_POST['username'];
		$password=md5($_POST['password']);
		$ret=mysqli_query($con,"SELECT * FROM admin WHERE username='$username' and password='$password'");
		$num=mysqli_fetch_array($ret);
			if($num>0)
			{
				
				$extra="dashboard.php";//
				$_SESSION['login']=$_POST['username'];
				$_SESSION['id']=$num['id'];
				$host=$_SERVER['HTTP_HOST'];
				$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
				echo ("<script LANGUAGE='Javascript'> 
				window.alert('You are successfully login $username ');
				window.location.href='dashboard.php'
				</script>");
				
				
				header("location:http://$host$uri/$extra");
				exit();
				
			
			}
				else
				{
					$_SESSION['errmsg']="Invalid username or password";
					$extra="adminLogin.php";
					$host  = $_SERVER['HTTP_HOST'];
					$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
					header("location:http://$host$uri/$extra");
					exit();
				}
	
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Admin - SociaHome</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="assets/images/admin.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->


	
</head>
<body>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="images/img-05.png" alt="IMG">
				</div>

				<form method="post" class="login100-form validate-form">
					<span class="login100-form-title">
						Admin Login 
						<li class="nav-item" role="presentation"><a class="nav-link active" href="/sociahome/index.html">Back to Home</a></li>
					</span>
					
					<?php echo htmlentities($_SESSION['errmsg']); ?>
					<?php echo htmlentities($_SESSION['errmsg']="");?>
					
					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" id="inputEmail" name="username" placeholder="Username">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" id="inputPassword" name="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button type="submit" name="submit" onclick="validation();" class="login100-form-btn">
							Login
						</button>
					</div>

					<div class="text-center p-t-5">
						<span class="txt1">
							Forgot
						</span>
						<a class="txt2" href="#">
							Username / Password?
						</a>
					</div>

					<div class="text-center p-t-35">	
					</div>
				</form>
			</div>
		</div>
	</div>
	

	
<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>


</body>
</html>
