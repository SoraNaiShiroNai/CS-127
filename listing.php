<?php

	session_start();
	header("Access-Control-Allow-Origin: *");
	$searchWord = "";
	if(isset($_GET['search'])){
		$searchWord = strip_tags($_GET['search']);
	}
	

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
	<link rel="stylesheet" href="css/bootstrap.css"/>
    <script src="js/bootstrap.js"> </script>
    <script src="js/jquery.js"> </script>
    
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<!-Personal css file to supplement bootstrap-!>
    <link rel="stylesheet" href="css/supplementary.css"/>
	
	  <script>
      function display_books_on_sale_search () {
        if (window.XMLHttpRequest) {
            xmlhttp=new XMLHttpRequest();
        }
       else {
          xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("sale_container_search").innerHTML = this.responseText;
            }
          };
        xmlhttp.open("GET", "http://localhost:80/127/home_page_handler.php?" + "function=3" + "&search=" + $('#searchQuery1').val(), true);
        xmlhttp.send();
      }

      function display_books_on_auction_search () {
        if (window.XMLHttpRequest) {
            xmlhttp=new XMLHttpRequest();
        }
       else {
          xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById('auction_container_search').innerHTML = this.responseText;
            }
          };
        xmlhttp.open("GET", "http://localhost:80/127/home_page_handler.php?" + "function=4" + "&search=" + $('#searchQuery2').val(), true);
        xmlhttp.send();
      }

	
	  $(document).ready(function () {
		display_books_on_sale_search();
		display_books_on_auction_search();
		$(document).on("keydown", "#searchQuery1", function () {
		  display_books_on_sale_search();
		});
		$(document).on("keydown", "#searchQuery2", function () {
		  display_books_on_auction_search();
		});
        $(document).on('click', '.on_sale', function() {
          var location = 'item_on_sale_details.php?id=' + $(this).attr('id');
		  window.location.href = location;
        });
        $(document).on('click','.clear_on_enter', function () {
          $(this).val('');
        });
		$(document).on('click','#logoutButton', function () {
			
        });
		$(document).on('click', '.on_auction', function() {
          var location = 'item_on_auction_details.php?id=' + $(this).attr('id');
		  window.location.href = location;
        });
      });


    </script>
	
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
   
   

   

  
     
    <div class="card popular_products" style="background-color: gray; width:100%; margin-top: 0px; margin-right: 0px;" data-aos="fade" data-stellar-background-ratio="0.5">
     

          <div class="site-blocks-cover  col-md-12" data-aos="fade-up" data-aos-delay="400">
                        
              <div class="" style = "margin-top: 80px; margin-left: 50px">
                <h1>Search Results on Sale</h1>
					<input type = "text" id = "searchQuery1" value = "<?php echo $searchWord ?>">
					<div id="sale_container_search" class = "card_container" >
					
					</div>
				
              </div>
          </div>
    </div>  
	
	
	 <div class="site-blocks-cover overlay" style="background-color: white;" data-aos="fade" data-stellar-background-ratio="0.5">
     
		  <div class="site-blocks-cover  col-md-12" data-aos="fade-up" data-aos-delay="400">
                       
              <div class="" style = "margin-top: 80px; margin-left: 50px">
                <h1>Search Results on Auction</h1>
					<input type = "text" id="searchQuery2" value = "<?php echo $searchWord ?>">
					<div id="auction_container_search" class = "card_container" >
					
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