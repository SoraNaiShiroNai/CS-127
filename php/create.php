<?php
	$username = strip_tags($_POST['username']);
	$last_name = strip_tags($_POST['last_name']);
	$first_name = strip_tags($_POST['first_name']);
	$default_delivery_addr = strip_tags($_POST['default_delivery_addr']);
	$contact_no = strip_tags($_POST['contact_no']);
	$email_addr = strip_tags($_POST['email_addr']);
	$email_notif = "marked";//strip_tags($_POST['email_notif']);
	$password = strip_tags($_POST['password']);
	
	$db = new PDO('mysql:host=localhost;dbname=cmsc 127: buy and sell','root','');
	$stmt = $db->prepare("INSERT INTO `user` (`username`, `password`, `last_name`, `first_name`, `default_delivery_addr`, `contact_no`, `email_addr`,  `email_notif`) VALUES ('$username', '$password', '$last_name', '$first_name', '$default_delivery_addr', '$contact_no', '$email_addr', '$email_notif');");
	$stmt->execute();
	
	//INSERT A CODE TO REDIRECT TO HOMEPAGE HERE
	echo "<br><a href = '../index.php'><button>HOME</button></a>";
?>