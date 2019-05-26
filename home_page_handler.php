<?php
  header("Access-Control-Allow-Origin: *");
  $running_function = $_REQUEST["function"];

  function display_books_on_sale () {
    $db = new PDO ('mysql:host = localhost; dbname=cmsc 127: buy and sell', 'root', '');
    $query = $db->prepare ("SELECT * FROM item_on_sale");
    $query->execute();
    $i = 0;
    while ($result = $query->fetch()) {
      if ($i != 8) {
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
              echo "<i class='fa fa-shopping-cart'></i><span>SEND BUY REQUEST</span>";
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

  function display_books_on_auction () {
    $db = new PDO ('mysql:host = localhost; dbname=cmsc 127: buy and sell', 'root', '');
    $query = $db->prepare ("SELECT * FROM item_on_auction");
    $query->execute();
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
              echo "<p class='author'>Asking price:</p>";
              echo "<p class='new'>$".$result['item_price']."</p>";
            echo "</div>";
            echo "<div class='items cart'>";
              echo "<i class='fa fa-bookmark'></i><span>SEND BID</span>";
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

  switch ($running_function) {
    case 1:
      display_books_on_sale();
      break;
    case 2:
      display_books_on_auction();
      break;
    case 3:

      break;
    case 4:

      break;
    case 5:

      break;
  }





 ?>
