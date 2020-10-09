<?php
session_start();
include("includes/config.php");
$_SESSION['login']=="";
date_default_timezone_set('Asia/Kuala_Lumpur');
$ldate=date( 'd-m-Y h:i:s A', time () );
mysqli_query($con,"UPDATE userlog SET logout = '$ldate' WHERE username = '".$_SESSION['login']."' ORDER BY id DESC LIMIT 1");
session_unset();


	
	echo ("<script LANGUAGE='Javascript'>
	window.location.href='residentLogin.php'
	</script>");
	//$_SESSION['errmsg']="You have successfully logout";	
	//$msg ="You have successfully logout";
session_destroy();

?>

