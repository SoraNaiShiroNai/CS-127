<?php
	session_start();
	$email = $_SESSION['email'];
	$username = $_SESSION['username'];
	
	echo "<br>current user: $username ";
	echo "<br><br>";
	$item_name = strip_tags($_POST['item_name']);
	$item_desc = strip_tags($_POST['item_desc']);
	$item_price = strip_tags($_POST['item_price']);
	$item_category = strip_tags($_POST['item_category']);
	$used = strip_tags($_POST['used']);
	$status = $_POST['status'];
	$in_stock = strip_tags($_POST['in_stock']);
	
	
		$db = new PDO('mysql:host=localhost;dbname=cmsc 127: buy and sell','root','');
		$stmt = $db->prepare("INSERT INTO `item` (`username`, `item_name`, `item_desc`, `item_price`, `item_category`, `used`, `in_stock`) VALUES ('$username', '$item_name', '$item_desc', '$item_price', '$item_category', '$used', '$in_stock');");
		$stmt->execute();
	echo "<br><br><b>FIRST QUERY</b><br>";
	$stmt->debugDumpParams();
	
	
	//$stmt = $db->prepare("SELECT * FROM `item` WHERE `username`=? AND `item_name`=? AND `item_price`=? AND `item_category`=? AND `used`=? AND `in_stock`=?;");
	//$stmt->execute(array($username, $item_name, $item_price, $item_category, $used, $in_stock));
	//$results_arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
	//print_r ($results_arr);
	
	
	
	$lastid = "";
	
	
	foreach ($results_arr as $i => $values) {
		foreach ($values as $key => $value) {
			if($key=="item_id")
				$lastid = $value;
		}
	}
	
	
	echo "<br><b>ID INSERTED: </b>$lastid<br><br>";
	$stmt->debugDumpParams();
	
	//FOR THIS TO WORK (TO SUCCESSFULLY ADD THINGS INTO items_on_sale and items_on_auction TABLES, WE NEED TO BE ABLE TO GET THE AUTO-INCREMENTED ID
	//GENERATED FROM THE PREVIOUS INSERT SQL QUERY (LINE 18 ON THIS DOCUMENT)
	//if($status=="sale"){
	//	echo "Added on Sale";
	//	$db = new PDO('mysql:host=localhost;dbname=cmsc 127: buy and sell','root','');
	//	$stmt = $db->prepare("INSERT INTO `items_on_sale` (`item_id`, `item_price`) VALUES ('$lastid', '$item_price');");
	//	$stmt->execute();
	//	
	//	echo "<br><br><b>SECOND QUERY</b><br>";
	//	$stmt->debugDumpParams();
	//}
	//INSERT A CODE TO REDIRECT TO HOMEPAGE HERE
?>