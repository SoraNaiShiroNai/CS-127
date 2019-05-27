<?php
  session_start();
	$username = "";
	if(isset($_SESSION['username'])){
		$username = $_SESSION['username'];
	}else $username = "";
	
	
  header("Access-Control-Allow-Origin: *");
  $running_function = $_REQUEST["function"];

  function display_books_on_sale () {
    $db = new PDO ('mysql:host = localhost; dbname=cmsc 127: buy and sell', 'root', '');
    $query = $db->prepare ("SELECT * FROM item_on_sale");
    $query->execute();
    $i = 0;
	global $username;
    while ($result = $query->fetch()) {
		
      if ($i != 8) {
		if((($result['seller_username']) != ($username)) && $result['status'] != 1){
			echo "<div class='container on_sale' id='".$result['item_idnum']."'style='background: url(assets/books/".$result['item_photo'].");background-repeat: no-repeat;background-position: center; background-size: 100% 100%'>";
			  echo "<div class='overlay'>";
				echo "<div class='items'></div>";
				echo "<div class = 'items head'>";
				  echo "<p>".$result['item_name']."</p>";
				  echo "<hr>";
				echo "</div>";
				echo "<div class = 'items price'>";
				  echo "<br>";
				  echo "<p class='author'>".$result['author']."</p>";
				  echo "<p class='new'>$".$result['item_price']."</p>";
				echo "</div>";
				echo "<div class='items cart'>";
				  echo "<i class='fa fa-shopping-cart'></i><span>Click for more details</span>";
				echo "</div>";
			  echo "</div>";
			echo "</div>";
			$i+=1;
		}
      }
      else {
        break;
      }
    }
  }

  function display_books_on_auction () {
    $db = new PDO ('mysql:host = localhost; dbname=cmsc 127: buy and sell', 'root', '');
    $query = $db->prepare ("SELECT * FROM item_on_auction");
    $query->execute();
    $i = 0;
	global $username;
    while ($result = $query->fetch()) {
      if ($i != 8) {
		if($result['seller_username']!=$username){
			echo "<div class='container on_auction' id='".$result['item_idnum']."'style='background: url(assets/books/".$result['item_photo'].");background-repeat: no-repeat;background-position: center; background-size: 100% 100%'>";
			  echo "<div class='overlay'>";
				echo "<div class='items'></div>";
				echo "<div class = 'items head'>";
				  echo "<p>".$result['item_name']."</p>";
				  echo "<hr>";
				echo "</div>";
				echo "<div class = 'items price'>";
				  echo "<br>";
				  echo "<p class='author'>".$result['author']."</p>";
				  echo "<p class='new'>$".$result['item_price']."</p>";
				echo "</div>";
				echo "<div class='items cart'>";
				  echo "<i class='fa fa-bookmark'></i><span>Click for more details</span>";
				echo "</div>";
			  echo "</div>";
			echo "</div>";
			$i+=1;
		}
      }
      else {
        break;
      }
    }
  }
  
  function display_books_on_auction_search () {
	global $username;
	$searchWord = strip_tags($_REQUEST['search']);
    $db = new PDO ('mysql:host = localhost; dbname=cmsc 127: buy and sell', 'root', '');
    $query = $db->prepare ("SELECT * FROM item_on_auction WHERE `item_name` LIKE '%$searchWord%'");
    $query->execute();
	//$query->debugDumpParams();
    $i = 0;
    while ($result = $query->fetch()) {
      if ($i != 8) {
		
			echo "<div class='container on_auction' id='".$result['item_idnum']."'style='background: url(assets/books/".$result['item_photo'].");background-repeat: no-repeat;background-position: center; background-size: 100% 100%'>";
			  echo "<div class='overlay'>";
				echo "<div class='items'></div>";
				echo "<div class = 'items head'>";
				  echo "<p>".$result['item_name']."</p>";
				  echo "<hr>";
				echo "</div>";
				echo "<div class = 'items price'>";
				  echo "<br>";
				  echo "<p class='author'>".$result['author']."</p>";
				  echo "<p class='new'>$".$result['item_price']."</p>";
				echo "</div>";
				echo "<div class='items cart'>";
				  echo "<i class='fa fa-bookmark'></i><span>Click for more details</span>";
				echo "</div>";
			  echo "</div>";
			echo "</div>";
			$i+=1;
		
      }
      else {
        break;
      }
    }
  }
  
  function display_books_on_sale_search () {
	global $username;
	$searchWord = strip_tags($_REQUEST['search']);
    $db = new PDO ('mysql:host = localhost; dbname=cmsc 127: buy and sell', 'root', '');
    $query = $db->prepare ("SELECT * FROM item_on_sale WHERE `item_name` LIKE '%$searchWord%'");
    $query->execute();
	//$query->DebugDumpParams();
    $i = 0;
    while ($result = $query->fetch()) {
      if ($i != 8) {
		if((($result['seller_username']) != ($username)) && $result['status'] != 1){
			echo "<div class='container on_sale' id='".$result['item_idnum']."'style='background: url(assets/books/".$result['item_photo'].");background-repeat: no-repeat;background-position: center; background-size: 100% 100%'>";
			  echo "<div class='overlay'>";
				echo "<div class='items'></div>";
				echo "<div class = 'items head'>";
				  echo "<p>".$result['item_name']."</p>";
				  echo "<hr>";
				echo "</div>";
				echo "<div class = 'items price'>";
				  echo "<br>";
				  echo "<p class='author'>".$result['author']."</p>";
				  echo "<p class='new'>$".$result['item_price']."</p>";
				echo "</div>";
				echo "<div class='items cart'>";
				  echo "<i class='fa fa-shopping-cart'></i><span>Click for more details</span>";
				echo "</div>";
			  echo "</div>";
			echo "</div>";
			$i+=1;
		}
      }
      else {
        break;
      }
    }
  }

  switch ($running_function) {
    case 1:
      display_books_on_sale();
      break;
    case 2:
      display_books_on_auction();
      break;
    case 3:
	  display_books_on_sale_search();
      break;
    case 4:
	  display_books_on_auction_search();
      break;
    case 5:

      break;
  }





 ?>
