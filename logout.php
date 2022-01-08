<?php
	
	session_start();
	if(isset($_SESSION['login_student_username']))
	{
		unset($_SESSION['login_student_username']);
		
	}
	
	else if(isset($_SESSION['login_admin_username']))
	{
		unset($_SESSION['login_admin_username']);
	}
	header("location:index.php");

?>