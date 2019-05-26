<?php
	
	$item_idnum = $_POST['item_idnum'];
	$db = new PDO('mysql:host=localhost;dbname=cmsc 127: buy and sell','root','');
	$stmt = $db->prepare("DELETE FROM item WHERE `item_idnum` = '$item_idnum'");
	$stmt->execute();
	
	$results_arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
	//var_dump($results_arr);
	print_r($results_arr);
	
	echo "<br>Deleted item with ID: $item_idnum successfully<br>";

?>