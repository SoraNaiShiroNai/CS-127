<?php

	session_start();

	$id = $_GET['id'];
	$db = new PDO('mysql:host=localhost;dbname=cmsc 127: buy and sell','root','');
	$username = $_SESSION['username'];
	
	
	$stmt = $db->prepare("SELECT * FROM item_on_sale WHERE `item_idnum` = '$id'"); //CHANGE THE 16 to a dynamic value
	$stmt->execute();
	$results_arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	$seller_username = "";
	$item_name = "";
	$item_desc = "";
	$item_price = "";
	$condition = "";
	$in_stock = "";
	$book_no = "";
	$format = "";
	$author = "";
	$book_type = "";
	
	
	
	
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
		}
	}
	
	if(isset($_POST['editItem'])){
		
		$item_name = strip_tags($_POST['item_name']);
		$item_desc = strip_tags($_POST['item_desc']);
		$item_price = strip_tags($_POST['item_price']);
		$condition = strip_tags($_POST['condition']);
		$in_stock = strip_tags($_POST['in_stock']);
		$book_no = strip_tags($_POST['book_no']);
		$format = strip_tags($_POST['format']);
		$book_type = strip_tags($_POST['book_type']);
		$author = strip_tags($_POST['author']);
		
		
			$stmt = $db->prepare("UPDATE `item_on_sale` SET `item_name` = '$item_name', `item_desc` = '$item_desc', `item_price` = '$item_price', `condition` = '$condition', `in_stock` = '$in_stock', `book_no` = '$book_no', `format` = '$format', `book_type` = '$book_type', `author` = '$author' WHERE `item_idnum` = '$id';");
			$stmt->execute();
	}
	
	if(isset($_POST['deleteItem'])){
		$item_idnum = $_POST['item_idnum'];
		$stmt = $db->prepare("DELETE FROM `item_on_sale` WHERE `item_idnum` = '$item_idnum'");
		$stmt->execute();
		
		//AFTER DELETE REDIRECT TO PREVIOUS PAGE

	}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>EDIT ITEM</title>
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
  
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="position: fixed; top: 0px;width: 100%; z-index: 1">
      <b><a class="navbar-brand nav_logo" href="#">Readers'<span style='color: #AC75BD'>Exchange</span></a></b>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <form class="form-inline my-2 my-lg-0" style="width: 100%; padding-left: 50%;">
          <input type='text' id='search_bar' style=" border-style: solid; border-width: 2px; border-color: grey; padding-left: 10px; width: 60%; padding-top: 2px">
          <button class="btn btn-secondary my-2 my-sm-0 btn-sm" style="border-radius: 0 20px 20px 0; margin-right: 2%; padding-right: 15px"> Search </button>
		  
        </form>
      </div>
    </nav>
	
  <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
  
  <div class="site-wrap">

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>
   
   

   

  
     
    <div class="site-blocks-cover overlay" style="background-image: url(assets/bench-blur-books-459791.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center">

          <div class="col-md-12" data-aos="fade-up" data-aos-delay="400">
                        
            <div class="row mb-4">
              <div class="col-md-7">
                <h1>Edit Book</h1>
				
				<form id = "newItem" method = 'post' action = ''>
					<div class="form-group input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"> Book Name </span>
						 </div>
						<input name="item_name" class="form-control" type="text" value = "<?php echo $item_name;?>" readonly>
					</div>
					<div class="form-group input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"> Author </span>
						 </div>
						<input name="author" class="form-control" type="text" value = "<?php echo $author;?>">
					</div>
					<div class="form-group input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"> Description </span>
						 </div>
						<input name="item_desc" class="form-control" type="text" value = "<?php echo $item_desc;?>">
					</div>
					
					<div class="form-group input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"> Price </span>
						 </div>
						<input name="item_price" class="form-control" type="text" value = "<?php echo $item_price;?>">
					</div>			
					
					<div class = "row">
						<div class = "col">
							<div class="form-group input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"> Book No. </span>
								 </div>
								<input name="book_no" class="form-control" type="text" value = "<?php echo $book_no;?>">
							</div>	
						</div>
						<div class = "col">
						
							<div class="form-group input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"> Book Type </span>
								</div>
								<select name = "book_type" style = "width: 200px">
								 <?php 
									$type_id = ""; 
									$type_name = "";
									$db = new PDO('mysql:host=localhost;dbname=cmsc 127: buy and sell','root','');
									$stmt = $db->prepare("SELECT * FROM book_type");
									$stmt->execute();
									$results_arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
									foreach ($results_arr as $i => $values) {
										foreach ($values as $key => $value) {
											if($key=="type_id")$type_id = $value;
											if($key=="type_name")$type_name = $value;
											
										}
										?><option value="<?php echo $type_id;?>" class="form-control" type="text" <?php if($type_id==$book_type) echo "selected";?>><?php echo $type_name;?></option><?php
									}
								 ?>
								</select>
							
							</div>
						</div>
					</div>
					<!-- form-group// -->
					
					<div class = "row">
						<div class = "col">
							<div class="form-group input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"> Stock</span>
								 </div>
								<select name = 'in_stock'>
									<option value = 'available' <?php if($in_stock=="available") echo "selected";?>>Available</option>
									<option value = 'limited' <?php if($in_stock=="limited") echo "selected";?>>Limited</option>
									<option value = 'out-of-stock' <?php if($in_stock=="out-of-stock") echo "selected";?>>Out of Stock</option>
								</select>
							</div> 
						</div>
						<div class = "col">
							<div class="form-group input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"> Condition </span>
								 </div>
								<select name = 'condition' >
									<option value = 'used' <?php if($condition=="used") echo "selected";?>>USED</option>
									<option value = 'brandnew' <?php if($condition=="brandnew") echo "selected";?>>NEW</option>
								</select>
							</div>	
						</div>
						<div class = "col">
							<div class="form-group input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"> Format</span>
								 </div>
								<select name = 'format' style = "width: 113px">
									<option value = 'hardcover' <?php if($format=="hardcover") echo "selected";?>>Hardcover</option>
									<option value = 'paperback' <?php if($format=="paperback") echo "selected";?>>Paperback</option>
									<option value = 'audiocd' <?php if($format=="audiocd") echo "selected";?>>Audio CD</option>
									<option value = 'ebook'<?php if($format=="ebook") echo "selected";?>>eBook</option>
								</select>
							</div> 
						</div>
					</div>
					
					<!--INSERT AN IMAGE UPLOADING CODE HERE-->
		
					<div class = "row">
						<div class = "col">
							<!-- Button trigger modal -->
							<button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModal">
							  Delete from Database
							</button>
						</div>
						<div class = "col">
							<div class="form-group">
								<input type="submit" class="btn btn-primary btn-block" name = "editItem" value = 'Update Book'>
							</div> <!-- form-group// -->  
						</div>
					</div>
																	  
				</form>
               
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>  

	

		<!-- Modal -->
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Confirm Delete</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="modal-body">
				Are you sure you want to delete <?php echo $item_name;?> from the Database?
			  </div>
			  <div class="modal-footer">
				
				<form method = 'post' action = ''>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<input type = 'text' name = 'item_idnum' value = "<?php echo $id?>" hidden>
					<button type="submit" name = "deleteItem" class="btn btn-primary">Confirm</button>
				</form>
			  </div>
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
            <p><a href="#" class="btn btn-black rounded-0">Add to Cart</a></p>
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