<?php

	session_start();
	
	$username = $_SESSION['username'];

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
	
	
	$username = "";
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
				if($key=="item_photo")$item_photo = "assets/books/".$value;
				
			}
		}
	}
	
	
	//$results_arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	
	

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
      <b><a class="navbar-brand nav_logo" href="#">Readers'<span style='color: #AC75BD'>Exchange</span></a></b>

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
			
              <p class="text-black">Seller username: <strong><?php echo $username?></strong></p>
			  <p class="text-black">Author: <strong><?php echo $author?></strong></p>
			  <p class="text-black">Book no: <strong><?php echo $book_no?></strong></p>
			  <p class="text-black">Format: <strong><?php echo $format?></strong></p>
			  <p class="text-black">Condition: <strong><?php echo $condition?></strong></p>
			  <p class="text-black">Item Price: <strong><?php echo $item_price?></strong></p>
			  
			 <?php if (isset($_SESSION['username'])) {?>
			  <form id = 'order_details' method = 'post' action = ''><br>
			  <h3 class="form-group input-group"> EDIT YOUR BILLING INFO </h3><br>
				<div class="form-group input-group">
					
						<div class="input-group-prepend">
							<span class="input-group-text"> Contact Number: </span>
						 </div>
						<input name="contact_no" class="form-control" type="text" value = "<?php echo $contact_no;?>" required>
					</div>
					<div class="form-group input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"> Meetup Location: </span>
						 </div>
						<input  name="default_delivery_addr" class="form-control" type="text" value = "<?php echo $default_delivery_addr;?>" required>
					</div>
					<div class="form-group input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"> Additional Message: </span>
						 </div>
						<input name="add_message" class="form-control" type="text" placeholder = "optional">
					</div>	
					
				
				<p><button type = 'submit' class="btn btn-black rounded-0">BUY</button></p>
				
              </form>
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