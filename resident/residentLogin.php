<?php
session_start();
error_reporting(0);
include("includes/config.php");


	if(isset($_POST['submit']))
	{
	
		$username = $_POST['username'];
		$password =  md5($_POST['password']);

		$res = $con->query("SELECT * FROM resident WHERE userEmail='".$_POST['username']."' and password='".md5($_POST['password'])."'");
		$row = $res->fetch_assoc();

		$id	      = $row['id'];
		$role     = $row['userLevel'];
		$user     = $row['userEmail'];
		$pass     = $row['password'];
  
		if($user==$username && $pass=$password)
		{
			session_start();
			if($role=="admin")
			{
				
			  $_SESSION['login']=$id;
			  
			  
			
			  echo"<script>alert('Just Logged In This System As ADMIN');</script>";
			  echo "<script>window.location.assign('http://localhost/sociahome/admin/dashboard.php')</script>";
			} 
			if($role=="resident")
			{
				$_SESSION['login']=$_POST['username'];
				$_SESSION['id']=$id;

				
				$msg1="Welcome to Dashboard of SociaHome";
				//$cheese="dashboard.php";
					
				//echo"<script>alert('".$_SESSION['id']." You Just Logged In The System');</script>";
				//echo "<script>window.location.assign('http://localhost/sociahome/resident/dashboard.php')</script>";
			} 
		}
			else
			{
				$_SESSION['login']=$_POST['username'];	
				$uip=$_SERVER['REMOTE_ADDR'];
				$status=0;
				mysqli_query($con,"insert into userlog(username,userip,status) values('".$_SESSION['login']."','$uip','$status')");
				$errormsg="Invalid username or password";
				$extra="residentLogin.php";
				
			}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Resident - SociaHome</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/mansion.png"/>
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

	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>



</head>
<script type="text/javascript">
	function valid()
	{
		if(document.forgot.password.value!= document.forgot.confirmpassword.value)
	{
		alert("Password and Confirm Password Field do not match  !!");
		document.forgot.confirmpassword.focus();
		return false;
	}
		return true;
	}
</script>
<body>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="images/img-02.png" alt="IMG">
				</div>

				<form class="login100-form validate-form" name="login" method="post">
					<span class="login100-form-title">
						Sign In Here
							<li class="nav-item" role="presentation"><a class="nav-link active" href="/sociahome/index.html">Back to Home</a></li>
					</span>

					<!--  Error Message -->
					<?php
					if ($errormsg)
					{
					?>
					<script>
						swal({
							title: "<?php echo htmlentities($errormsg); ?>",
							//text: "You clicked the button!",
							icon: "warning",
							button: "OK",
						});
					<?php } ?>
					</script>
					<!--  Good Message -->
					<?php
					if ($msg1)
					{
					?>
					<script>
						swal({
							title: "<?php echo htmlentities($msg1); ?>",
							//text: "You clicked the button!",
							icon: "success",
							button: "OK",
						}).then(function() {
							window.location.href = "dashboard.php";
						});
					<?php } ?>
					</script>
					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="username" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" name="submit" type="submit">
							Login
						</button>
					</div>
					<!-- <div class="text-center p-t-5">
						<span class="txt1">
							Login as
						</span>
						<a class="txt2" data-toggle="modal" href="http://localhost/sociahome/admin/adminLogin.php">
							Admin
						</a>
					</div> -->
					<div class="text-center p-t-10">
						<a class="txt2" href="registration.php">
							You are new? Create your account now
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
			</div>
		<!-- Modal -->
        <!--<form class="form-login" name="forgot" method="post">
            <div aria-hidden="true" aria-labellecony="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                           <h4 class="modal-title">Forgot Password ?</h4>
                        </div>
                        <div class="modal-body">
                           <p>Enter your details below to reset your password.</p>
                           <input type="email" name="email" placeholder="Email" autocomplete="off" class="form-control" required><br >
                           <input type="text" name="contact" placeholder="contact No" autocomplete="off" class="form-control" required><br>
                           <input type="password" class="form-control" placeholder="New Password" id="password" name="password"  required ><br />
                           <input type="password" class="form-control unicase-form-control text-input" placeholder="Confirm Password" id="confirmpassword" name="confirmpassword" required >
                        </div>
                        <div class="modal-footer">
                           <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                           <button class="btn btn-theme" type="submit" name="change" onclick="return valid();">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- modal 
        </form> -->
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
	
	      <script src="assets/js/jquery.js"></script>
      <script src="assets/js/bootstrap.min.js"></script>
	

</body>
</html>