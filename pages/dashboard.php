<?php
session_start();
$_SESSION['username']="user";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>DASHBOARD</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700,900" rel="stylesheet">
    <link rel="stylesheet" href="../fonts/icomoon/style.css">

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/jquery-ui.css">
    <link rel="stylesheet" href="../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../css/owl.theme.default.min.css">
    <link rel="stylesheet" href="../css/owl.theme.default.min.css">
    <link rel="stylesheet" href="../css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="../css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="../fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="../css/aos.css">
    <link rel="stylesheet" href="../css/style.css">

      <script src="../js/jquery-3.3.1.min.js"></script>
      <script src="../js/jquery-migrate-3.0.1.min.js"></script>
      <script src="../js/jquery-ui.js"></script>
      <script src="../js/popper.min.js"></script>
      <script src="../js/bootstrap.min.js"></script>
      <script src="../js/owl.carousel.min.js"></script>
      <script src="../js/jquery.stellar.min.js"></script>
      <script src="../js/jquery.countdown.min.js"></script>
      <script src="../js/bootstrap-datepicker.min.js"></script>
      <script src="../js/jquery.easing.1.3.js"></script>
      <script src="../js/aos.js"></script>
      <script src="../js/jquery.fancybox.min.js"></script>
      <script src="../js/jquery.sticky.js"></script>
      <script src="../js/main.js"></script>


            <!-Personal css file to supplement bootstrap-!>
            <link rel="stylesheet" href="../css/supplementary.css"/>

            <!-Icon imports-!>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>

  </head>
  <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

  <div class="site-wrap">
  <div class="main_bg" style="background-image:url(../assets/books-bookshelf-bookshelves-2177482.jpg)"></div>
          <nav class="navbar navbar-expand-lg navbar-light bg-light" style="position: fixed; top: 0px;width: 100%; z-index: 1">
            <b><a class="navbar-brand nav_logo" href="#"><i class='fas fa-book-open'></i>Readers'<span style='color: #AC75BD'>Exchange</span></a></b>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

              <form class="form-inline my-2 my-lg-0" style="width: 100%; padding-left: 50%;">
                <input type='text' id='search_bar' style=" border-style: solid; border-width: 2px; border-color: grey; padding-left: 10px; width: 50%; padding-top: 2px" value="Look for great books...">
                <button class="btn btn-secondary my-2 my-sm-0 btn-sm" style="border-radius: 0 20px 20px 0; margin-right: 2%; padding-right: 15px"> Search </button>
                  </form>
                <?php
                $error="";
                if (isset($_SESSION['username'])){
                  print'
                  <div class="px-5 dropdown">
                    <button class="btn btn-outline-dark dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="icon-user text-dark"></span> USER</button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                      <button class="dropdown-item" type="button">View Profile</button>
                      <button class="dropdown-item" type="button">View History</button>
                      <div class="dropdown-divider"></div>
                      <form method="post" action=""><button class="dropdown-item" type="submit" name="logout">Logout</button></form>
                    </div>
                  </div>';
              }
              else {
                header('Refresh:1; URL=../home_page.html'); //PAGE REDIRECT IF NOT LOGGED IN
              }

              if(isset($_POST['logout'])){
                unset($_SESSION["username"]);
                unset($_SESSION["password"]);
                header('Refresh:1; URL=../home_page.html'); //PAGE REDIRECT IF NOT LOGGED IN
               }
                ?>


            </div>
          </nav>
          <div class="site-section" id="dashboardpage">
                  <div class='card primary_message' align='center'>
                    <h2 class="section-title"style="font-size:3em; color: white">Dashboard Page</h2>
                  </div>

              </div>
                <div class="card bg-light text-black ">
                  <h3 class="mb-3">WAITING FOR RESPONSE</h3>
                  <!--RETRIEVE RECENT ORDERS-->
                </div>
                <div class="card bg-light text-black">
          <h3 class="mb-3">WAITING FOR CONFIRMATION</h3>
</div>
      </div> <!-- .site-wrap -->


  </body>
</html>
