<?php

	session_start();
	
	$username = "";
	if(isset($_SESSION['username'])){
		$username = $_SESSION['username'];
	}

	$db = new PDO('mysql:host=localhost;dbname=cmsc 127: buy and sell','root','');
	
	$stmt = $db->prepare("SELECT * FROM user WHERE `username` = '$username'"); 
	$stmt->execute();
	$results_arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$default_delivery_addr = "";
	$contact_no = "";
		
		foreach ($results_arr as $i => $values) {
			foreach ($values as $key => $value) {
				if($key=="default_delivery_addr")$default_delivery_addr = $value;
				if($key=="contact_no")$contact_no = $value;
			}
		}
		
	$id = $_GET['id'];
	
	
	
	
	//$item_idnum = $_POST['item_idnum'];
	
	$item_name = "";
	$item_desc = "";
	$in_stock = "";
	$item_price = "";
	$used = "";
	$status = "sale";
	$condition = "";
	$book_no = "";
	$book_type = "";
	$format = "";
	$author = "";
	
	
	if($status == "sale"){
		$stmt = $db->prepare("SELECT * FROM item_on_auction WHERE `item_idnum` = '$id'"); 
		$stmt->execute();
		$results_arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		foreach ($results_arr as $i => $values) {
			foreach ($values as $key => $value) {
				if($key=="seller_username")$seller_username = $value;
				if($key=="item_name")$item_name = $value;
				if($key=="item_desc")$item_desc = $value;
				if($key=="in_stock")$in_stock = $value;
				if($key=="item_price")$item_price = $value;
				if($key=="condition")$condition = $value;
				if($key=="book_no")$book_no = $value;
				if($key=="book_type")$book_type = $value;
				if($key=="format")$format = $value;
				if($key=="author")$author = $value;
				if($key=="status")$status = $value;
				if($key=="highest_bid")$highest_bid = $value;
				if($key=="highest_bidder_username")$highest_bidder_username = $value;
				if($key=="item_photo")$item_photo = "assets/books/".$value;
			}
		}
	}
	
	if(($username == $seller_username)){
		header('location: home_page.php');
	}
	
	//$results_arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	
	if(isset($_POST['order_details'])){
		
		$bid = $_POST['bid'];
		if($bid > $highest_bid && $status != "Closed"){
			$date = date('Y-m-d H:i:s');
			$seller_username = strip_tags($_POST['seller_username']);
			
			if($status=="Ready"){
				$stmt = $db->prepare("UPDATE `item_on_auction` SET `highest_bid` = '$bid', `highest_bidder_username` = '$username', `status` = 'Open' WHERE `item_idnum` = '$id';");
				$stmt->execute();
			}else{
				$stmt = $db->prepare("UPDATE `item_on_auction` SET `highest_bid` = '$bid', `highest_bidder_username` = '$username' WHERE `item_idnum` = '$id';");
				$stmt->execute();
			}
			
			
			$stmt = $db->prepare("SELECT * FROM `bid_details` WHERE `item_idnum` = '$id' AND `bidder_username` = '$username'"); 
			$stmt->execute();
			
			if($stmt->rowCount() > 0){
				$stmt = $db->prepare("UPDATE `bid_details` SET `bid` = '$bid' WHERE `item_idnum` = '$id' AND `bidder_username` = '$username'"); 
				$stmt->execute();
			}else{
				$stmt = $db->prepare("INSERT INTO `bid_details` (`item_idnum`, `bidder_username`, `bid`) VALUES ('$id', '$username', '$bid')"); 
				$stmt->execute();
			}
			
			
			//$stmt = $db->prepare("INSERT INTO `purchase_history` (`username`, `item_name`, `price`, `date_purchased`, `method`, `seller_username`) VALUES ('$username', '$item_name', '$item_price', '$date', 'SALE', '$seller_username')"); 
			//$stmt->execute();
			
			//INSERT MAILER HERE
			//SEND TO BUYER AND SELLER
			
			header("Refresh:0");
		}else{
			?> <script> alert("Please enter a higher bid"); </script>
			<?php
		}
	}

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Item Details</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700,900" rel="stylesheet">
    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">

    <link rel="stylesheet" href="css/jquery.fancybox.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">

    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/style.css">
    
  </head>
  <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
  
  
  <nav class="navbar navbar-expand-lg navbar-light bg-light" style="position: fixed; top: 0px;width: 100%; z-index: 1">
      <b><a class="navbar-brand nav_logo" href="home_page.php">Readers'<span style='color: #AC75BD'>Exchange</span></a></b>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <form class="form-inline my-2 my-lg-0" style="width: 100%; padding-left: 50%;">
          <input type='text' id='search_bar' style=" border-style: solid; border-width: 2px; border-color: grey; padding-left: 10px; width: 60%; padding-top: 2px">
          <button class="btn btn-secondary my-2 my-sm-0 btn-sm" style="border-radius: 0 20px 20px 0; margin-right: 2%; padding-right: 15px"> Search </button>
		  <?php if (!isset($_SESSION['username'])) {?>
			  <button class="btn btn-info my-2 my-sm-0 btn-sm" style="border-radius: 20px 0 0 20px; padding-right: 15px; padding-left: 15px"> Log-in </button>
			  <button class="btn btn-outline-info my-2 my-sm-0 btn-sm" style="border-radius: 0 20px 20px 0"> Sign up </button>
		  <?php } ?>
        </form>
      </div>
    </nav>
           

  
     
   

    
   

	<!----------------------------------- ITEM DETAILS -------------------------------------------------->
    <div class="site-section testimonial-wrap" id="testimonials-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-12 text-center">
            <h2 class="section-title mb-3"><?php echo $item_name;?></h2>
          </div>
        </div>
      </div>
 
          <div>
            <div class="testimonial">
              <div class="mb-4 d-block align-items-center justify-content-center">
                <div><img src="<?php echo $item_photo ?>" alt="image not found" class="w-100 img-fluid mb-3" style="max-width:40%"></div>
              </div>
              <blockquote class="mb-3">
                <p><?php echo $item_desc;?></p>
				</blockquote>
			
              <p class="text-black">Seller username: <strong><?php echo $seller_username?></strong></p>
			  <p class="text-black">Author: <strong><?php echo $author?></strong></p>
			  <p class="text-black">Book no: <strong><?php echo $book_no?></strong></p>
			  <p class="text-black">Format: <strong><?php echo $format?></strong></p>
			  <p class="text-black">Condition: <strong><?php echo $condition?></strong></p>
			  <p class="text-black">Starting Price: <strong><?php echo $item_price?></strong></p>
			  <hr>
			  <p class="text-black">Status: <strong><?php echo $status?></strong></p>
			  <p class="text-black">Highest Bid: <strong><?php echo $highest_bid?></strong></p>
			  <p class="text-black">Highest Bidder: <strong><?php echo $highest_bidder_username?></strong></p>
			  <br>
			<?php if (isset($_SESSION['username']) && $_SESSION['username']!=$seller_username) { ?>
			  
				<div class="" style = "text-align: center;">
					<button type = 'submit' <?php if($status == "Closed") echo "disabled"; ?> class="btn btn-black rounded-0" data-toggle="modal" data-target="#submitOrder">BID</button>
				</div>
				
			 <?php } ?>
            </div>
          </div>
    </div>

        <footer class="site-footer bg-white">
      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <div class="row">
              <div class="col-md-5">
                <h2 class="footer-heading mb-4">About Us</h2>
                <p>Students from University of the Philippines Manila. CS 127 Group assigned for a Buy and Sell website.</p>
              </div>
              <div class="col-md-3 ">
                <h2 class="footer-heading mb-4">Members</h2>
                <ul class="list-unstyled">
                  <li>Buenaventura</li>
                  <li>Lim</li>
                  <li>Matabang</li>
                </ul>
              </div>
              <div class="col-md-4">
                <h2 class="footer-heading mb-4">Location</h2>
				<p>University of the Philippine Manila, Padre Faura Street</p>
              </div>
            </div>
          </div>
          <div class="col-md-3 ml-auto">
            <h2 class="footer-heading mb-4">Featured Product</h2>
            <a href="#"><img src="images/product_1_bg.jpg" alt="Image" class="img-fluid mb-3"></a>
            <h4 class="h5">Leather Brown Shoe</h4>
            <strong class="text-black mb-3 d-inline-block">$60.00</strong>
            
          </div>
        </div>
        <div class="row pt-5 mt-5 text-center">
          <div class="col-md-12">
            <div class="border-top pt-5">
            <p>
      </p>
            </div>
          </div>
          
        </div>
      </div>
    </footer>

  </div> <!-- .site-wrap -->
  
  <div class="modal fade" id="submitOrder" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
		 <form method = 'post' id = 'order_details'>
		  <div class="modal-header">
			<h5 class="modal-title" id="exampleModalLongTitle">PLEASE ENTER YOUR BID</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
					
					<div class="form-group input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"> Bid: </span>
						 </div>
						<input name="bid" class="form-control" type="number" placeholder = "Enter a bid higher than the highest" value = "<?php echo ($highest_bid + 100) ?>" ;>
					</div>	
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			<input name = "order_details" type="submit" class="btn btn-primary" value = "Submit Request">
		  </div>
		 </form>
		</div>
	  </div>
	</div>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/jquery.countdown.min.js"></script>
  <script src="js/bootstrap-datepicker.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.fancybox.min.js"></script>
  <script src="js/jquery.sticky.js"></script>

  
  <script src="js/main.js"></script>
    
  </body>
</html>