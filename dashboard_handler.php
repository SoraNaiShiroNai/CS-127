<?php
  header("Access-Control-Allow-Origin: *");
  $running_function = $_REQUEST["function"];

  function display_books_on_sale() {
    $db = new PDO ('mysql:host = localhost; dbname=cmsc 127: buy and sell','root', '');
    $query = $db->prepare("SELECT * FROM item_on_sale WHERE seller_username = ?");
    $query->bindParam(1, $_REQUEST['username']);
    $query->execute();
    while ($result = $query->fetch()) {
      echo "<div class='card mb-3 book_card' id='".$result['item_idnum']."'>";
        echo "<div class='row no-gutters'>";
          echo "<div class='col-md-4'>";
            echo "<img src='assets/books/".$result['item_photo']."' class='card-img' style='height:100%'>";
          echo  "</div>";
          echo "<div class='col-md-8' style='text-align: left'>";
            echo "<div class='card-body'>";
              echo "<h5 class='card-title'>".$result['item_name']."<span class='badge badge-info'>Regular</span> </h5>";
              echo "<table>";
                echo "<tr>";
                  echo "<td> Author: </td>";
                  echo "<td>".$result['author']."</td>";
                echo "</tr>";
                echo "<tr>";
                  echo "<td style='padding-right: 10px'> Description: </td> ";
                  echo "<td>".$result['item_desc']."</td>";
                echo "</tr>";
                echo "<tr>";
                  echo "<td> Price: </td>";
                  echo "<td>".$result['item_price']."</td>";
                echo "</tr>";
                echo "<tr>";
                  echo "<td>Condition: </td>";
                  echo "<td>".$result['condition']."</td>";
                echo "</tr>";
                echo "<tr>";
                  echo "<td>Format: </td>";
                  echo "<td>".$result['format']."</td>";
                echo "</tr>";
              echo "</table>";
              echo "<br>";
              echo "<div style='display: flex; flex-direction: row; justify-content: center; width: 100%'>
                <button class='btn btn-info edit_book sale' style='border-radius: 50px; padding: 5px 20px 5px 20px'> Edit </button>
              </div>";
            echo "</div>";
          echo "</div>";
        echo "</div>";
      echo "</div>";
    }
    $query = $db->prepare("SELECT * FROM item_on_auction WHERE seller_username = ?");
    $query->bindParam(1, $_REQUEST['username']);
    $query->execute();
    while ($result = $query->fetch()) {
      if ($result['status'] == "Ready"){
        echo "<div class='card mb-3' id='".$result['item_idnum']."'>";
          echo "<div class='row no-gutters'>";
            echo "<div class='col-md-4'>";
              echo "<img src='assets/books/".$result['item_photo']."' class='card-img' style='height:100%'>";
            echo "</div>";
            echo "<div class='col-md-8' style='text-align:left'>";
              echo "<div class='card-body'>";
                echo "<h5 class='card-title'>".$result['item_name']."<span class='badge badge-warning'>Auction</span> </h5>";
                echo "<table>";
                  echo "<tr>";
                    echo "<td> Author: </td>";
                    echo "<td>".$result['author']."</td>";
                  echo "</tr>";
                  echo "<tr>";
                    echo "<td style='padding-right: 10px'> Description: </td>";
                    echo "<td>".$result['item_desc']."</td>";
                  echo "</tr>";
                  echo "<tr>";
                    echo "<td>Price: </td>";
                    echo "<td>".$result['highest_bid']."</td>";
                  echo "</tr>";
                  echo "<tr>";
                    echo "<td>Condition:</td>";
                    echo "<td>".$result['condition']."</td>";
                  echo "</tr>";
                  echo "<tr>";
                    echo "<td>Format</td>";
                    echo "<td>".$result['format'].'</td>';
                  echo "</tr>";
                echo "</table>";
                echo "<br>";
                echo "<div style='display: flex; flex-direction: row; justify-content: center; width: 100%'>
                  <button class='btn btn-info edit_book auction' style='border-radius: 50px; padding: 5px 20px 5px 20px'> Edit </button>
                  </div>";
              echo "</div>";
            echo "</div>";
          echo "</div>";
        echo "</div>";
      }
    }
  }

  function display_books_on_sale_with_pending () {
    $db = new PDO ('mysql:host = localhost; dbname=cmsc 127: buy and sell','root', '');
    $query = $db->prepare("SELECT * FROM item_on_auction WHERE seller_username=? AND status=?");
    $query->bindParam(1, $_REQUEST['username']);
    $status = "Open";
    $query->bindParam(2, $status);
    $query->execute();
    while($result = $query->fetch()) {
      echo "<div class='card mb-3' id='".$result['item_idnum']."'>";
        echo "<div class='row no-gutters'>";
          echo "<div class='col-md-4'>";
            echo "<img src='assets/books/".$result['item_photo']."' class='card-img' style='height:100%'>";
          echo "</div>";
          echo "<div class='col-md-8' style='text-align:left'>";
            echo "<div class='card-body'>";
              echo "<h5 class='card-title'>".$result['item_name']."<span class='badge badge-warning'>Auction</span></h5>";
              echo "<table>";
                echo "<tr>";
                  echo "<td> Buyer: </td>";
                  echo "<td>".$result['highest_bidder_username']."</td>";
                echo "</tr>";
                echo "<tr>";
                  echo "<td style='padding-right: 10px'> Current Price: </td>";
                  echo "<td>".$result['highest_bid']."</td>";
                echo "</tr>";
              echo "</table>";
              echo "<br>";
              echo "<br>";
              echo "<br>";
              echo "<div style='display: flex; flex-direction: row; justify-content: center; width: 100%'>
                <button class='btn btn-warning declare_winner' style='border-radius: 50px; margin-right: 5px'> Declare Winner </button> <button class='btn btn-danger cancel_auction' style='border-radius: 50px'> Cancel </button>
                </div>";
            echo "</div>";
          echo "</div>";
        echo "</div>";
      echo "</div>";
    }
    $query = $db->prepare("SELECT * FROM purchase_history WHERE seller_username=? AND delivery_status=?");
    $query->bindParam(1, $_REQUEST['username']);
    $status = 0;
    $query->bindParam(2, $status);
    $query->execute();
    while($result = $query->fetch()) {
      if ($result['method'] == "SALE") {
        $query1 = $db->prepare("SELECT * FROM item_on_sale WHERE item_name=?");
        $query1 ->bindParam(1, $result['item_name']);
      }
      else {
        $query1 = $db->prepare("SELECT * FROM item_on_auction WHERE item_name=?");
        $query1 ->bindParam(1, $result['item_name']);
      }
      $query1->execute();
      $result1 = $query1->fetch();
      $photo = $result1['item_photo'];
      echo "<div class='card mb-3 book_card'>";
        echo "<div class='row no-gutters'>";
          echo "<div class='col-md-4'>";
            echo "<img src='assets/books/".$photo."' class='card-img' style='height:100%'>";
          echo  "</div>";
          echo "<div class='col-md-8' style='text-align: left'>";
            echo "<div class='card-body'>";
              echo "<h5 class='card-title'>".$result['item_name'];
              if ($result['method'] == "SALE") {
                echo "<span class='badge badge-info'>Regular</span>";
                echo "<span class='badge badge-secondary'>Undelivered</span>";
                echo "</h5>";
              }
              else {
                echo "<span class='badge badge-warning'>Auction</span>";
                echo "<span class='badge badge-secondary'>Undelivered</span>";
                echo "</h5>";
              }
              echo "<table>";
                echo "<tr>";
                  echo "<td> Date: </td>";
                  echo "<td>".$result['date_purchased']."</td>";
                echo "</tr>";
                echo "<tr>";
                  echo "<td style='padding-right: 10px'> Address: </td> ";
                  echo "<td>".$result['delivery_address']."</td>";
                echo "</tr>";
                echo "<tr>";
                  echo "<td> Price: </td>";
                  echo "<td>".$result['price']."</td>";
                echo "</tr>";
                echo "<tr>";
                  echo "<td>Buyer: </td>";
                  echo "<td>".$result['username']."</td>";
                echo "</tr>";
              echo "</table>";
              echo "<br>";
            echo "</div>";
          echo "</div>";
        echo "</div>";
      echo "</div>";
    }
  }

  function display_books_for_receipt() {
    $db = new PDO ('mysql:host = localhost; dbname=cmsc 127: buy and sell','root', '');
    $query = $db->prepare("SELECT * FROM purchase_history WHERE username=? AND delivery_status=?");
    $query->bindParam(1, $_REQUEST['username']);
    $status = 0;
    $query->bindParam(2, $status);
    $query->execute();
    $counter = 0;
    while($result = $query->fetch()) {
      if ($result['method'] == "SALE") {
        $query1 = $db->prepare("SELECT * FROM item_on_sale WHERE item_name=?");
        $query1->bindParam(1, $result['item_name']);
      }
      else {
        $query1=$db->prepare("SELECT * FROM item_on_auction WHERE item_name=?");
        $query1->bindParam(1, $result['item_name']);
      }
      $query1->execute();
      $result1 = $query1->fetch();
      $photo = $result1['item_photo'];
      echo "<div class='card mb-3 book_card bg-secondary'>";
        echo "<div class='row no-gutters'>";
          echo "<div class='col-md-4'>";
            echo "<img src='assets/books/".$photo."' class='card-img' style='height:100%'>";
          echo  "</div>";
          echo "<div class='col-md-8' style='text-align: left'>";
            echo "<div class='card-body'>";
              echo "<h5 name='item_name' class='card-title'>".$result['item_name'];
              if ($result['method'] == "SALE") {
                echo "<span class='badge badge-info'>Regular</span>";
                echo "</h5>";
              }
              else {
                echo "<span class='badge badge-warning'>Auction</span>";
                echo "</h5>";
              }
              echo "<table>";
                echo "<tr>";
                  echo "<td> Date: </td>";
                  echo "<td name='date'>".$result['date_purchased']."</td>";
                echo "</tr>";
                echo "<tr>";
                  echo "<td style='padding-right: 10px'>Your address: </td> ";
                  echo "<td>".$result['delivery_address']."</td>";
                echo "</tr>";
                echo "<tr>";
                  echo "<td> Price: </td>";
                  echo "<td name='price'>".$result['price']."</td>";
                echo "</tr>";
                echo "<tr>";
                  echo "<td>Sold by: </td>";
                  echo "<td> name='sold_by'".$result['seller_username']."</td>";
                echo "</tr>";
              echo "</table>";
              echo "<br>";
              echo "<div style='display: flex; flex-direction: row; justify-content: center; width: 100%'>
                <button class='btn btn-info received' style='border-radius: 50px; padding: 5px 20px 5px 20px'> Mark as received </button>
              </div>";
            echo "</div>";
          echo "</div>";
        echo "</div>";
      echo "</div>";
      $counter++;
    }
  }

  function cancel_auction() {
    $db = new PDO ('mysql:host = localhost; dbname=cmsc 127: buy and sell','root', '');
    $query = $db->prepare("UPDATE item_on_auction SET status = ? WHERE item_idnum = ?");
    $close = "Closed";
    $query->bindParam(1,$close);
    $query->bindParam(2,$_REQUEST['id']);
    $query->execute();
  }

  function declare_winner() {
    $db = new PDO ('mysql:host = localhost; dbname=cmsc 127: buy and sell','root', '');
    $query = $db->prepare("UPDATE item_on_auction SET status = ? WHERE item_idnum = ?");
    $close = "Closed";
    $query->bindParam(1,$close);
    $query->bindParam(2,$_REQUEST['id']);
    $query->execute();
    $query = $db->prepare("SELECT * FROM item_on_auction WHERE item_idnum = ?");
    $query->bindParam(1,$_REQUEST['id']);
    $query->execute();
    $result = $query->fetch();
    $query = $db->prepare("INSERT INTO purchase_history (username, item_name, price, date_purchased, method, seller_username, delivery_status, delivery_address) VALUES (?,?,?,?,?,?,?,?)");
    $query->bindParam(1,$result['highest_bidder_username']);
    $query->bindParam(2,$result['item_name']);
    $query->bindParam(3,$result['highest_bid']);
    $date = date('Y-m-d');
    $query->bindParam(4, $date);
    $method = "AUCTION";
    $query->bindParam(5, $method);
    $query->bindParam(6, $result['seller_username']);
    $status = 0;
    $query->bindParam(7, $status);
    $query1 = $db->prepare("SELECT * FROM user WHERE username = ?");
    $query1->bindParam(1, $result['highest_bidder_username']);
    $query1->execute();
    $result1 = $query1->fetch();
    $query->bindParam(8,$result1['default_delivery_addr']);
    $query->execute();
  }



switch ($running_function) {
  case 1:
    display_books_on_sale();
    break;
  case 2:
    display_books_on_sale_with_pending();
    break;
  case 3:
    display_books_for_receipt();
    break;
  case 4:
    cancel_auction();
    break;
  case 5:
    declare_winner();
    break;

}
?>
