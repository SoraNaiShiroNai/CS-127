<?php

	session_start();
	
	$username = $_SESSION['username']; 
	

	$db = new PDO('mysql:host=localhost;dbname=cmsc 127: buy and sell','root','');
	
	
	
	


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>History</title>
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
   
   

   

  
     
    <div class="site-blocks-cover overlay" style="background-color: gray;" data-aos="fade" data-stellar-background-ratio="0.5">
     
        <div class="row align-items-center justify-content-center">

          <div class="col-md-12" data-aos="fade-up" data-aos-delay="400">
                        
            <div class="row mb-4">
              <div class="col-md-7" style = "margin-top: 80px; margin-left: 50px">
                <h1>History of Purchases</h1>
				<br>
				<table class="table" style = "color: white">
				  <thead class="thead-dark">
					<tr>
					  <th scope="col">Book Name</th>
					  <th scope="col">Price</th>
					  <th scope="col">Date Purchased</th>
					  <th scope="col">Method</th>
					</tr>
				  </thead>
				  <tbody>
				  
				  <?php
					$stmt = $db->prepare("SELECT * FROM purchase_history WHERE `username` = '$username'");
					$stmt->execute();
					$results_arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
					
					foreach ($results_arr as $i => $values) {
						print "<tr>";
						foreach ($values as $key => $value) {
							if($key=="item_name")$item_name = $value;
							if($key=="price")$price = $value;
							if($key=="date_purchased")$date_purchased = $value;
							if($key=="method")$method = $value;
						}?>
						<td><?php echo $item_name;?></td>
						<td><?php echo $price;?></td>
						<td><?php echo $date_purchased;?></td>
						<td><?php echo $method;?></td>
						
						</tr>
						<?php
					}
				  ?>
					
				  </tbody>
				</table>
               
              </div>
            </div>
          </div>
        </div>
    </div>  
	
	 <div class="site-blocks-cover overlay" style="background-color: white;" data-aos="fade" data-stellar-background-ratio="0.5">
     
        <div class="row align-items-center justify-content-center">

          <div class="col-md-12" data-aos="fade-up" data-aos-delay="400">
                        
            <div class="row mb-4">
              <div class="col-md-7" style = "margin-top: 80px; margin-left: 50px" >
				
				
                <h1>History of Books Sold</h1>
				<br>
				<table class="table" style = "color: white">
				  <thead class="thead-dark">
					<tr>
					  <th scope="col">Book Name</th>
					  <th scope="col">Price</th>
					  <th scope="col">Date Purchased</th>
					  <th scope="col">Method</th>
					</tr>
				  </thead>
				  <tbody>
				  
				  <?php
					$stmt = $db->prepare("SELECT * FROM sale_history WHERE `username` = '$username'");
					$stmt->execute();
					$results_arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
					
					foreach ($results_arr as $i => $values) {
						print "<tr>";
						foreach ($values as $key => $value) {
							if($key=="item_name")$item_name = $value;
							if($key=="price")$price = $value;
							if($key=="date_sold")$date_sold = $value;
							if($key=="method")$method = $value;
						}?>
						<td><?php echo $item_name;?></td>
						<td><?php echo $price;?></td>
						<td><?php echo $date_sold;?></td>
						<td><?php echo $method;?></td>
						
						</tr>
						<?php
					}
				  ?>
					
				  </tbody>
				</table>
               
              </div>
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