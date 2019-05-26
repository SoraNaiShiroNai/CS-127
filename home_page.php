<?php
	session_start();
	
	
	if(isset($_POST['login'])){
		
		$db = new PDO('mysql:host=localhost;dbname=cmsc 127: buy and sell','root','');
		$password = strip_tags($_POST['password']);
		$username = strip_tags($_POST['username']);
		
		$stmt = $db->prepare("SELECT * FROM user WHERE `username` = '$username' AND `password` = '$password'"); 
		$stmt->execute();
		 //insert checker here
		//$stmt -> debugDumpParams();
		$results_arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$checked = "";
		
		
		if($stmt->rowCount() > 0){
			foreach ($results_arr as $i => $values) {
				foreach ($values as $key => $value) {
					if($key=="username")$checked = $value;
					
				}
			}
			$_SESSION['username'] = $checked;
			$username = $_SESSION['username'];
			header('location: home_page.php');
		}
	}
	
	if(isset($_POST['log_out'])){
		unset($_SESSION['username']);
	}
?>



<!doctype html>
<html>
  <title> Readers' Exchange </title>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-Bootstrap import-!>
	
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
	
	
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700,900" rel="stylesheet">
    <link rel="stylesheet" href="fonts/icomoon/style.css">
	
    <link rel="stylesheet" href="css/bootstrap.css"/>
    <script src="js/bootstrap.js"> </script>
    <script src="js/jquery.js"> </script>

    <!-Personal css file to supplement bootstrap-!>
    <link rel="stylesheet" href="css/supplementary.css"/>
	

    <!-Icon imports-!>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-scripts-!>
	
	 
    <script>
      function display_books_on_sale () {
        if (window.XMLHttpRequest) {
            xmlhttp=new XMLHttpRequest();
        }
       else {
          xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById('sale_container').innerHTML = this.responseText;
            }
          };
        xmlhttp.open("GET", "http://localhost:80/127/home_page_handler.php?" + "function=1", true);
        xmlhttp.send();
      }

      function display_books_on_auction () {
        if (window.XMLHttpRequest) {
            xmlhttp=new XMLHttpRequest();
        }
       else {
          xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById('auction_container').innerHTML = this.responseText;
            }
          };
        xmlhttp.open("GET", "http://localhost:80/127/home_page_handler.php?" + "function=2", true);
        xmlhttp.send();
      }



      $(document).ready(function () {
		if ($('#loggedin').val()=='something') {
			$('#loginButton').hide();
			$('#signupButton').hide();
			$('#logoutButton').show();
		}
        display_books_on_sale();
        display_books_on_auction();
        $(document).on('click', '.on_sale', function() {
          var location = 'item_on_sale_details.php?id=' + $(this).attr('id');
		  window.location.href = location;
		  
        });
        $(document).on('click','.clear_on_enter', function () {
          $(this).val('');
        });
		$(document).on('click','#logoutButton', function () {
			
        });
      });


    </script>


  </head>



  <body class='scrollbar-primary'>
    <div class="main_bg"></div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="position: fixed; top: 0px;width: 100%; z-index: 1">
      <b><a class="navbar-brand nav_logo" href="#"><i class='fas fa-book-open'></i>Readers'<span style='color: #AC75BD'>Exchange</span></a></b>

		
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
			<form class="form-inline my-2 my-lg-0" style="width: 120%; padding-left: 50%;">
				<input class="clear_on_enter" type='text' id='search_bar' style=" border-style: solid; border-width: 2px; border-color: grey; padding-left: 10px; width: 70%; padding-top: 2px" value="Look for great books...">
				<button class="btn btn-secondary my-2 my-sm-0 btn-sm" style="border-radius: 0 20px 20px 0; margin-right: 2%; padding-right: 15px"> Search </button>
			</form>
			<form method = 'post' class="form-inline my-2 my-lg-0"  style="width: 20%; padding-left: 0%;">
				<!--<input class="clear_on_enter" type='text' id='search_bar' style=" border-style: solid; border-width: 2px; border-color: grey; padding-left: 10px; width: 60%; padding-top: 2px" value="Look for great books...">
				<button class="btn btn-secondary my-2 my-sm-0 btn-sm" style="border-radius: 0 20px 20px 0; margin-right: 2%; padding-right: 15px"> Search </button>-->
			  
			  
			  
			  <?php if(!isset($_SESSION['username'])){ ?>
				<button id='loginButton' class="btn btn-info my-2 my-sm-0 btn-sm" style="border-radius: 20px 0 0 20px; padding-right: 15px; padding-left: 15px" type = "button" data-toggle="modal" data-target="#exampleModal"> Log-in </button>
				<a href = "signup.php" id = "signupButton" class="btn btn-outline-info my-2 my-sm-0 btn-sm" style="border-radius: 0 20px 20px 0"> Sign up </a>
			  <?php } ?>
			</form>
		
		<?php if(isset($_SESSION['username'])){

				echo "Signed in as ";
				echo $_SESSION['username'];
				echo "  "; ?>
				
				<form method = "POST" action = "">
					<button  class="btn btn-info my-2 my-sm-0 btn-sm" style=" padding-right: 15px; padding-left: 15px" type = "submit"  name = "log_out" >Logout</button>
				</form>
			<?php } ?>
      </div>
    </nav>

    <div class='main_container'>
      <div class='card primary_message' align='right'>
        <h1 style="font-size: 3.5em; color: white; letter-spacing: .25em; text-transform: uppercase; font-weight: 300; text-align:right;">Auction, buy, or sell</h1>
        <br>
        <h4 style="font-size:1.3em; color: rgb(211,211,211); font-weight: normal; max-width: 45%; white-space: normal"> Readers'Exchange is a place where you can buy, sell, or auction books you currently have. </h4>
        <br>
        <div style="position: inline;">
          <button class="btn btn-info" style="border-radius: 20px 0 0 20px; width: 70px">Buy</button><button class="btn btn-secondary" style="border-radius: 0; width: 90px">Auction</button><button class="btn btn-danger" style="border-radius: 0 20px 20px 0; width: 70px">Sell</button>
        </div>
      </div>

      <!-popular products container!->
      <div class="card popular_products">
        <h1 style="font-size: 20px; color: #adb5bd; letter-spacing: .2em; text-transform: uppercase; font-weight: 700; font-weight:normal; text-align:center; margin-top: 5%">Popular Books</h1>
        <h1 style="color: #000; font-size: 40px; font-weight: 700;text-align:center; margin-bottom:0">Just a few popular books...</h1>
        <p style="text-align: center; color: grey;"> These are 8 of the books most commonly bought and searched by users this week.</p>
        <div id='sale_container' class="card_container">

        </div>
      </div>
      <!-end of popular products container-!>

      <!-intermediate between sell and auction items>
      <div class="intermediate">
        <h1 style="font-size: 20px; color: white; letter-spacing: .2em; text-transform: uppercase; font-weight: 700; font-weight:normal; text-align:left; margin-top: 5%">get notifications on similar books you purchased</h1>
        <h1 style="color: #FEF5DF; font-size: 40px;  letter-spacing: .09em; font-weight: 300;text-align:left; margin-bottom:0">Join our newsletter...</h1>
        <br>
        <div>
          <button class="btn btn-secondary" style="position: inline;border-radius: 0">Subscribe</button><input class="clear_on_enter" type='text' style="height: 38px;vertical-align: bottom;border-style: solid; border-width: 2px; border-color: grey; padding-left: 10px; width: 60%; padding-top: 2px" value="Enter your email here...">
        </div>
      </div>
      <!-end of intermediate>

      <div class="on_auction_container">
        <h1 style="font-size: 20px; color: #adb5bd; letter-spacing: .2em; text-transform: uppercase; font-weight: 700; font-weight:normal; text-align:center; margin-top: 5%">Book Auction</h1>
        <h1 style="color: white; font-size: 40px; font-weight: 700;text-align:center; margin-bottom:0">Books currently on auction...</h1>
        <p style="text-align: center; color: white">These 8 books have the highest open bids this week.</p>
        <div id="auction_container" class="card_container">

          
        </div>
      </div>
	  
		
		
		
		
      <footer class="footer-distributed">

        <div class="footer-left">

          <b><a class="navbar-brand nav_logo" href="#" style="color: white; margin:0"><i class='fas fa-book-open'></i>Readers'<span style='color: #AC75BD'>Exchange</span></a></b>

          <p class="footer-company-name">readers'exchange &copy; 2019</p>
        </div>

        <div class="footer-center">

          <div>
            <i class="fa fa-map-marker"></i>
            <p><span>Somewhere</span>Nowhere, Philippines</p>
          </div>

          <div>
            <i class="fa fa-phone"></i>
            <p>+1 555 123456</p>
          </div>

          <div>
            <i class="fa fa-envelope"></i>
            <p><a href="#">readexch@gmail.com</a></p>
          </div>

        </div>

        <div class="footer-right">

          <p class="footer-company-about">
            <span>About the company</span>
            This is a sample buy and sell website created by Chicken in compliance to the requirement of CMSC 127.
          </p>

          <div class="footer-icons">

            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-github"></i></a>

          </div>

        </div>

      </footer>


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
	<!-- Modal -->
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
				<form method = 'post' action = ''>
				  <div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Log In</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body">
					<div class="form-group input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"> Username </span>
						 </div>
						<input name="username" class="form-control" type="text">
					</div>
					<div class="form-group input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"> Password </span>
						 </div>
						<input name="password" class="form-control" type="password">
					</div>
				  </div>
				  <div class="modal-footer">
					
					
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" name = "login" class="btn btn-primary">Confirm</button>
				
				   </div>
			  </form>
			</div>
		  </div>
		</div>
</html>
