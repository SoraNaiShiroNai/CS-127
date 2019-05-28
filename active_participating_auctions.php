<?php

	session_start();
	
	$username = $_SESSION['username']; 
	

	$db = new PDO('mysql:host=localhost;dbname=cmsc 127: buy and sell','root','');

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Auctions List</title>
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
	
	<link rel="stylesheet" href="css/bootstrap.css"/>
    <script src="js/bootstrap.js"> </script>
    <script src="js/jquery.js"> </script>

    <!-Personal css file to supplement bootstrap-!>
    
	
	<script>
      function display_purchase () {
        if (window.XMLHttpRequest) {
            xmlhttp=new XMLHttpRequest();
        }
       else {
          xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById('purchase_history_container').innerHTML = this.responseText;
            }
          };
        xmlhttp.open("GET", "http://localhost:80/127/home_page_handler.php?" + "function=5" + "&search=" + $('#search_bar').val(), true);
        xmlhttp.send();
      }

      function display_sale () {
        if (window.XMLHttpRequest) {
            xmlhttp=new XMLHttpRequest();
        }
       else {
          xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById('sale_history_container').innerHTML = this.responseText;
            }
          };
        xmlhttp.open("GET", "http://localhost:80/127/home_page_handler.php?" + "function=6" + "&search=" + $('#search_bar').val(), true);
        xmlhttp.send();
      }



      $(document).ready(function () {
		$(document).on("keydown", "#search_bar", function () {
		  display_purchase();
		  display_sale();
		});
        $(document).on('click','.clear_on_enter', function () {
          $(this).val('');
        });
		$(document).on('click','#logoutButton', function () {
			
        });
		$(document).on('click','#searchBTN', function () {
			display_purchase();
			display_sale();
        });
      });


    </script>
    
  </head>
  
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="position: fixed; top: 0px;width: 100%; z-index: 1">
      <b><a class="navbar-brand nav_logo" href="home_page.php">Readers'<span style='color: #AC75BD'>Exchange</span></a></b>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <form class="form-inline my-2 my-lg-0" style="width: 100%; padding-left: 50%;">
          <input type='text' id='search_bar' style=" border-style: solid; border-width: 2px; border-color: grey; padding-left: 10px; width: 60%; padding-top: 2px">
          <button id = "searchBTN" class="btn btn-secondary my-2 my-sm-0 btn-sm" style="border-radius: 0 20px 20px 0; margin-right: 2%; padding-right: 15px"> Search </button>
		  
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
   
   

   

  
     
    <div id = "pH" class="site-blocks-cover overlay" style="background-color: gray;" data-aos="fade" data-stellar-background-ratio="0.5">
     
        <div class="row align-items-center justify-content-center">

          <div class="col-md-12" data-aos="fade-up" data-aos-delay="400">
                        
            <div class="row mb-4">
              <div class="col-md-7"  style = "margin-top: 80px; margin-left: 50px">
                <h1>Active Auctions</h1>
				<br>
				<table class="table" style = "color: white">
				  <thead class="thead-dark">
					<tr>
					  <th scope="col">Book</th>
					  <th scope="col">Starting Price</th>
					  <th scope="col">Your Bid</th>
					  <th scope="col">Highest Bid</th>
					  <th scope="col">Highest Bidder</th>
					</tr>
				  </thead>
				  <tbody id = "purchase_history_container">
				  
				  
					  <?php
						$stmt = $db->prepare("SELECT * FROM bid_details WHERE `bidder_username` = '$username'");
						$stmt->execute();
						$results_arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
						$bid = 0;
						$check = 0;
						
						
						foreach ($results_arr as $i => $values) {
							print "<tr>";
							foreach ($values as $key => $value) {
								if($key=="item_idnum")$item_idnum = $value;
								if($key=="bid")$bid = $value;
								
								$stmt = $db->prepare("SELECT * FROM item_on_auction WHERE `item_idnum` = '$item_idnum'");
								$stmt->execute();
								$results_arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
								
								
								
								foreach ($results_arr as $i => $values) {
									foreach ($values as $key => $value) {
										if($key=="item_price")$price = $value;
										if($key=="item_name")$item_name = $value;
										if($key=="highest_bidder_username")$highest_bidder_username = $value;
										if($key=="highest_bid")$highest_bid = $value;
										
									}
								}
								
								
							
							}
							$link = "item_on_auction_details.php?id=".$item_idnum;
							?>
								<td><a style = "color: yellow;" href = <?php echo $link; ?>><?php echo $item_name; ?></a></td>
								<td><?php echo $price;?></td>
								<td><?php echo $bid;?></td>
								<td><?php echo $highest_bid;?></td>
								<td><?php echo $highest_bidder_username;?></td>
								
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
            <h2 class="footer-heading mb-4" style = "text-align: center;" >University of the Philippines</h2>
            <a href="#"><img src="assets/logo.jpg" alt="Image" class="img-fluid mb-3"></a>
            <h4 class="h5"></h4>
            
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