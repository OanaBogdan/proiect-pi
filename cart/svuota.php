<?php
	session_start();
	$_SESSION['cart'] = array();
	$_SESSION['message'] = 'Coșul golit';
	header('location: ../cart.php');
?>