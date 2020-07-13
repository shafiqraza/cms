<?php session_start(); ?>

<?php

	$_SESSION['firstname'] = null;
	$_SESSION['lastname'] = null;
	$_SESSION['username'] = null;
	$_SESSION['user_role'] = null;
	header("Location: /cms/index");	

 ?>
