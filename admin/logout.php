<?php
session_start();
$_SESSION['login']=="";
session_unset();

//session_destroy();



echo ("<script LANGUAGE='Javascript'>
window.alert('You have successfully logout');
window.location.href='http://localhost/sociahome/resident/residentLogin.php'
</script>");
$_SESSION['errmsg']="You have successfully logout";


?>

