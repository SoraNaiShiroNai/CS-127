<?php
	session_start();
	if(isset($_POST['adduser'])){
		$username = strip_tags($_POST['username']);
		$last_name = strip_tags($_POST['last_name']);
		$first_name = strip_tags($_POST['first_name']);
		$default_delivery_addr = strip_tags($_POST['default_delivery_addr']);
		$contact_no = strip_tags($_POST['contact_no']);
		$email_addr = strip_tags($_POST['email_addr']);
		$email_notif = "marked";//strip_tags($_POST['email_notif']);
		$password = md5(strip_tags($_POST['password']));
		
		$db = new PDO('mysql:host=localhost;dbname=cmsc 127: buy and sell','root','');
		$stmt = $db->prepare("INSERT INTO `user` (`username`, `password`, `last_name`, `first_name`, `default_delivery_addr`, `contact_no`, `email_addr`,  `email_notif`) VALUES ('$username', '$password', '$last_name', '$first_name', '$default_delivery_addr', '$contact_no', '$email_addr', '$email_notif');");
		$stmt->execute();
		$stmt->debugDumpParams();
		
		
		//INSERT FORM VALIDATORS HERE
		
		$_SESSION['username'] = $username;
		
		require ('vendor/autoload.php');
		$mail = new PHPMailer\PHPMailer\PHPMailer();
		$mail->isSMTP();
		$mail->SMTPDebug = 2;
		$mail->Host = "smtp.gmail.com";
		$mail->Port = 587;
		$mail->SMTPSecure = 'tls';
		$mail->SMTPOptions = array(
							'ssl' => array(
								'verify_peer' => false,
								'verify_peer_name' => false,
								'allow_self_signed' => true
							)
						);
		$mail->SMTPAuth = true;
		$mail->Username = '121chicken121@gmail.com';
		$mail->Password = 'cmsc-121';
		$mail->setFrom('121chicken121@gmail.com', 'Readers Exchange');
		$mail->addAddress($email_addr, 'Dear Customer');
		$mail->Subject = 'Welcome!';
		$mail->Body = 'This is to confirm that we have saved your email address. We hope you find our store useful.';
		$mail->send();
		
		//INSERT A CODE TO REDIRECT TO HOMEPAGE HERE
		header ('location: home_page.php');
	}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Sign Up</title>
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
                <h1>Sign Up</h1>
				
				<form id = "newUser" method = 'post' action = ''>
					<div class="form-group input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"> Username </span>
						 </div>
						<input name="username" class="form-control" type="text">
					</div>
					<div class="form-group input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"> Firstname </span>
						 </div>
						<input name="first_name" class="form-control" type="text">
					</div>
					<div class="form-group input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"> Surname </span>
						 </div>
						<input name="last_name" class="form-control" type="text">
					</div>			
					<div class="form-group input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"> Default Delivery Address</span>
						 </div>
						<input name="default_delivery_addr" class="form-control" type="text">
					</div>				
					<div class="form-group input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"> Email</span>
						 </div>
						<input name="email_addr" class="form-control" type="email">
					</div> <!-- form-group// -->
					
					<div class="form-group input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"> Contact Number </span>
						 </div>
						<input name="contact_no" class="form-control" type="number">
					</div>				
					<div class="form-group input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"> Password</i> </span>
						</div>
						<input name = "password" class="form-control" type="password" id = "pass">
					</div> <!-- form-group// -->
					<div class="form-group input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"> Password</i> </span>
						</div>
						<input name = "password2" class="form-control" placeholder = "confirm password" type="password" id = "pass2">
					</div> <!-- form-group// -->   
					<div class = "row mx-auto" style = "width: 600px">
						<input type="checkbox" id="checkbox" name = "email_notif" checked> Sign Up for email notification.<br>
					</div>
			
					<div class="form-group">
						<input type="submit" class="btn btn-primary btn-block" name = "adduser" value = "Submit"></button>
					</div> <!-- form-group// -->      
																	  
				</form>
                <p class="mb-5 lead">By clicking submit, you agree to our terms and policies.</p>
               
              </div>
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