<?php
include('includes/config.php');
error_reporting(0);
if(isset($_POST['submit']))
{
	$userLevel=$_POST['userLevel'];
	$fullname=$_POST['fullname'];
	$email=$_POST['email'];
	$password=md5($_POST['password']);
	$contactno=$_POST['contactno'];
	$status=1;
	
	$query=mysqli_query($con,"insert into resident(userLevel,fullName,userEmail,password,contactNo,status) values('$userLevel','$fullname','$email','$password','$contactno','$status')");
	$query1=mysqli_query($con,"insert into login(userLevel,username,password) values('$userLevel','$email','$password')");
	$msg="Registration successfull. Now You can login!";

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
	<link rel="stylesheet" type="text/css" href="css/css-reg.css">
<!--===============================================================================================-->

	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	
</head>
<script type="text/javascript">
function userAvailability() 
{
	$("#loaderIcon").show();
	jQuery.ajax({
		url: "checkAvailability.php",
		data:'email='+$("#email").val(),
		type: "POST",
			success:function(data){
			$("#user-availability-status1").html(data);
			$("#loaderIcon").hide();
			},
		error:function (){}
	});
}
</script>

<body>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="images/img-06.png" alt="IMG">
				</div>
				<form class="login100-form validate-form" name="login" method="post">
					<span class="login100-form-title">
						Resident Registration
							<!---<li class="nav-item" role="presentation"><a class="nav-link active" href="http://172.20.10.4/sociahome/index.html">Back to Home</a></li> -->
							<li class="nav-item" role="presentation"><a class="nav-link active" href="/sociahome/index.html">Back to Home</a></li>
					</span>
					
					<?php
					if ($msg)
					{
					?>
					<script>
						swal({
							title: "<?php echo htmlentities($msg); ?>",
							//text: "You clicked the button!",
							icon: "success",
							button: "OK",
						}).then(function() {
							window.location.href = "residentLogin.php";
						});
					<?php } ?>
					</script>
					
					<div class="wrap-input100 validate-input" data-validate = "Full name is required">
							<input class="input100" type="text" name="fullname" placeholder="Full Name" >
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Valid no is required: 60127895678">
							<input class="input100"  pattern="^(\+?6?01)[0|1|2|3|4|6|7|8|9]-*[0-9]{7,8}$" type="text" name="contactno" placeholder="Contact No" maxlength="11">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-phone" aria-hidden="true"></i>
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz" >
							<input class="input100" type="email" name="email" id="email" onBlur="userAvailability()" placeholder="Email">
						<span id="user-availability-status1" style="font-size:12px;"></span>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Password is required">
							<input class="input100" type="password" name="password" placeholder="Password" title="Password must contain at least 8 characters, including UPPER/lowercase and numbers" 
							pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : '');
							if(this.checkValidity()) form.pwd2.pattern = RegExp.escape(this.value);">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>						
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" name="submit" type="submit" id="submit">
							Register
						</button>
					</div>
					<div class="text-center p-t-10">
						<a class="txt2" href="residentLogin.php">
							Already have an account? Sign in here
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
					
					<input id="userLevel" name="userLevel" type="hidden" value="resident">
					
				</form>
			</div>
		</div>
	</div>

	
<script>


/* function validate(evt) {
  var theEvent = evt || window.event;

  // Handle paste
  if (theEvent.type === 'paste') {
      key = event.clipboardData.getData('text/plain');
  } else {
  // Handle key press
      var key = theEvent.keyCode || theEvent.which;
      key = String.fromCharCode(key);
  }
  var regex = /[0-9]|\./;
  if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
} */
</script>
	
	
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