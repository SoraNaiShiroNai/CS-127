<?php
	session_start();
	
	$db = new PDO('mysql:host=localhost;dbname=cmsc 127: buy and sell','root','');
	$stmt = $db->prepare("SELECT * FROM item WHERE in_stock>0");
	$stmt->execute();
	
	$results_arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
	//print_r($results_arr);
	$item_name='';
	$item_desc='';
	$item_idnum = '';
	$in_stock = '';
	
	
	if(isset($_SESSION['email'])){
		if($_SESSION['email']=='sora@disboard.com' || $_SESSION['email']=='shiro@disboard.com'){
			echo "<table border = 1>";
			echo "<tr><th>Item Name</th><th>Description</th><td>Stock</td><td></td><tr>";
			foreach ($results_arr as $i => $values) {
				echo "<tr>";
				foreach ($values as $key => $value) {
					if($key=="item_idnum")
						$item_idnum = $value;
					if($key=="item_name")
						$item_name = $value;
					if($key=="item_desc")
						$item_desc = $value;
					if($key=="in_stock")
						$in_stock = $value;
				}
				echo "<td>$item_name</td><td>$item_desc</td><td>$in_stock</td><td><form method = 'post' action = 'del.php'><input type = 'text' name = 'item_idnum' value = '$item_idnum' hidden><button type = 'submit'>Delete</button></form></td></tr>";
			}
		}
		else{
			echo "<table border = 1>";
			echo "<tr><th>Item Name</th><th>Description</th><td>Stock</td><td></td><tr>";
			foreach ($results_arr as $i => $values) {
				echo "<tr>";
				foreach ($values as $key => $value) {
					if($key=="item_idnum")
						$item_idnum = $value;
					if($key=="item_name")
						$item_name = $value;
					if($key=="item_desc")
						$item_desc = $value;
					if($key=="in_stock")
						$in_stock = $value;
				}
				echo "<td>$item_name</td><td>$item_desc</td><td>$in_stock</td><td><form method = 'post' action = 'add2cart.php'><input type = 'text' name = 'item_idnum' value = '$item_idnum' hidden><button type = 'submit'>Add to Cart</button></form></td></tr>";
			}
		}
	}
	else{
		echo "<table border = 1>";
		echo "<tr><th>Item Name</th><th>Description</th><tr>";
		foreach ($results_arr as $i => $values) {
			echo "<tr>";
			foreach ($values as $key => $value) {
				if($key=="item_name" || $key=="item_desc" )
					echo "<td>$value</td>";
			}
			echo "</tr>";
		}
	}

?>