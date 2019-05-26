<?php

if(isset($_POST['list_all'])){
	
	$db = new PDO('mysql:host=localhost;dbname=cmsc 127: buy and sell','root','');
	$stmt = $db->prepare("SELECT * FROM item");
	$stmt->execute();
	
	$results_arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	foreach ($results_arr as $i => $values) {
		print "<tr><td>";
		foreach ($values as $key => $value) {
			print "'$key': '$value' || ";
		}
	}
}

if(isset($_POST['add_item'])){
	
	$username = strip_tags($_POST['username']);
	$item_name = strip_tags($_POST['item_name']);
	$item_desc = strip_tags($_POST['item_desc']);
	$item_price = strip_tags($_POST['item_price']);
	$item_category = strip_tags($_POST['item_category']);
	$used = strip_tags($_POST['used']);
	$stock = strip_tags($_POST['stock']);
	
	$db = new PDO('mysql:host=localhost;dbname=cmsc 127: buy and sell','root','');
	$stmt = $db->prepare("INSERT INTO `item` (`username`, `item_name`, `item_desc`, `item_price`, `item_category`, `used`, `in_stock`) VALUES (`$username`, `$item_name`, `$item_desc`, `$item_price`, `$item_category`, `$used`, `$stock`)");
	$stmt->execute();
	
	
}






?>


<html>
	<body>
	
		<form method = 'post' action = ''><button type = 'submit' name = 'list_all'>List All</button></form>
		<form method = 'post' action = ''>
			<table>
				<tr>
					<th>Seller Username</th><td><input type = 'text' name = 'username' placeholder = 'Enter Seller Username here' maxlength = 20></td></tr>
					<th>Item Name</th><td><input type = 'text' name = 'item_name' placeholder = 'Enter Item Name' maxlength = 30></td></tr>
					<th>Item Description</th><td><input type = 'text' name = 'item_desc' placeholder = 'Enter Item Description' maxlength = 200></td></tr>
					<th>Item Price</th><td><input type = 'text' name = 'item_price' placeholder = 'Enter Price'></td></tr> <!---EDIT THIS TO BE VALIDATED AS A DOUBLE/FLOAT-->
					<th>Item Category</th><td><select name = 'item_category'><option value = 'home_car' selected>Home Car</option><option value = 'road_car'>Road Car</option><option value = 'home_car'>Race Car</option></select></td></tr>
					<th>Used? (Y/N)</th><td><select name = 'used'><option value = "y">Yes</option><option value = "n">No</option></select></td></tr>
					<th>Stock</th><td><input type = 'number' name = 'stock'></td></tr>
					<td></td>
					
				</tr>
				<tr><td><button type = 'submit' name = 'add_item'>ADD ITEM</button></td></tr>
			</table>
		</form>


	</body>
</html>