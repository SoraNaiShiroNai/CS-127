<?php
  session_start();

  $username = $_SESSION['username'];
  $db = new PDO ('mysql:host = localhost; dbname=cmsc 127: buy and sell','root', '');
  $query = $db->prepare ("SELECT * from user WHERE username=?");
  $query->bindParam(1, $username);
  $query->execute();
  $result = $query->fetch();
?>

<!doctype html>
<html>
  <title> Dashboard </title>
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
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.js"> </script>
      <script src="js/jquery.js"> </script>
      <script src="js/bootstrap.min.js"></script>


    <!-Personal css file to supplement bootstrap-!>
      <link rel="stylesheet" href="css/supplementary.css"/>


    <!-Icon imports-!>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-scripts>
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
            document.getElementById('on-sale').innerHTML = this.responseText;
            }
          };
        xmlhttp.open("GET", "http://localhost:80/127/127/dashboard_handler.php?" + "function=1" +  "&username=" + "<?php echo $username ?>", true);
        xmlhttp.send();
      }

      function display_books_on_sale_with_pending () {
        if (window.XMLHttpRequest) {
            xmlhttp=new XMLHttpRequest();
        }
       else {
          xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById('sold').innerHTML = this.responseText;
            }
          };
        xmlhttp.open("GET", "http://localhost:80/127/127/dashboard_handler.php?" + "function=2" +  "&username=" + "<?php echo $username ?>", true);
        xmlhttp.send();
      }

      function display_books_for_receipt () {
        if (window.XMLHttpRequest) {
            xmlhttp=new XMLHttpRequest();
        }
       else {
          xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById('buy_container').innerHTML = this.responseText;
            }
          };
        xmlhttp.open("GET", "http://localhost:80/127/127/dashboard_handler.php?" + "function=3" +  "&username=" + "<?php echo $username ?>", true);
        xmlhttp.send();
      }

      function cancel_auction(id) {
        if (window.XMLHttpRequest) {
            xmlhttp=new XMLHttpRequest();
        }
       else {
          xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById('does_not_exist').innerHTML = this.responseText;
            }
          };
        xmlhttp.open("GET", "http://localhost:80/127/127/dashboard_handler.php?" + "function=4" +  "&id=" + id, true);
        xmlhttp.send();
      }

      function declare_winner(id) {
        if (window.XMLHttpRequest) {
            xmlhttp=new XMLHttpRequest();
        }
       else {
          xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById('does_not_exist').innerHTML = this.responseText;
            }
          };
        xmlhttp.open("GET", "http://localhost:80/127/127/dashboard_handler.php?" + "function=5" +  "&id=" + id, true);
        xmlhttp.send();
      }






        $(document).ready(function() {
          display_books_on_sale();
          display_books_on_sale_with_pending();
          display_books_for_receipt();
          $(document).on('click','.clear_on_enter',function () {
            $(this).val('');
          });
          $(document).on('click','#searchButton', function () {
      			var searchWord = $('#search_bar').val();
      			console.log(searchWord);
      			window.location.href = "listing.php?search=" + searchWord;
            });
          });
          $(document).on('click', '.cancel_auction', function () {
            cancel_auction($(this).parent().parent().parent().parent().parent().attr('id'));
            $(this).parent().parent().parent().parent().parent().remove();
          });

          $(document).on('click', '.declare_winner', function () {
            declare_winner($(this).parent().parent().parent().parent().parent().attr('id'));
            $(this).parent().parent().parent().parent().parent().remove();
          });

          $(document).on('click', '.received', function () {

            $(this).parent().parent().parent().parent().parent().remove();
          });
      </script>
  </head>

  <body class='scrollbar-primary' style="background-color: #292c2f">
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="position: fixed; top: 0px;width: 100%; z-index: 1">
      <b><a class="navbar-brand nav_logo" href="home_page.php"><i class='fas fa-book-open'></i>Readers'<span style='color: #AC75BD'>Exchange</span></a></b>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
  			<div class="form-inline my-2 my-lg-0" style="width: 85%; padding-left: 50%;">
  				<input class="clear_on_enter" type='text' id='search_bar' style=" border-style: solid; border-width: 2px; border-color: grey; padding-left: 10px; width: 70%; padding-top: 2px" value="Look for great books...">
  				<button id="searchButton" class="btn btn-secondary my-2 my-sm-0 btn-sm" style="border-radius: 0 20px 20px 0; margin-right: 2%; padding-right: 15px"> Search </button>
  			</div>
        <div class="dropdown">
          <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user"></i> <?php echo $_SESSION['username']; ?>
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="history.php">View History</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Log Out</a>
          </div>
        </div>
      </div>
    </nav>

    <div class='main_container' style="flex-direction:row">
      <div class="card" style='width:70%'>
        <div class="card-header">
          Profile Information <p id='does_not_exist'> </p>
        </div>
        <div class="card-body">
          <div class="card mb-3" style="width:100%;">
            <div class="row no-gutters">
              <div class="col-md-2" align='center'>
                <i class='fas fa-book-open' style="font-size: 8rem; color: grey; margin-top: 15%"></i>
              </div>
              <div class="col-md-5">
                <div class="card-body">
                  <h4 class="card-title"><?php echo $_SESSION['username'] ?></h4>
                  <br>
                  <p class="card-text" style="line-height: 1">Name: <?php echo $result['first_name']; echo " ".$result['last_name']; ?></p>
                  <p class="card-text" style="line-height: 1">Contact: #<?php echo  $result['contact_no']; ?></p>
                  <p class="card-text" style="line-height: 1">Default Address: <?php echo $result['default_delivery_addr']; ?> </p>
                </div>
              </div>
              <div class="col-md-3">
                <div style="margin-top: 20%; margin-left: 50%; display:flex; flex-direction: row; justify-content: center; flex-wrap: wrap; width: 100%">
                  <a href = "add_item.php" class="btn btn-info add_book" style="border-radius: 50px"> add/auction a book </a>
                  <a href = "active_participating_auctions.php" class="btn btn-success view_auction" style="margin-top: 10px; border-radius: 50px"> View auctions participating in </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class='row' style="width: 70%; margin-top: 20px; height:330px">
        <div class='column card text-white bg-secondary' style="width: 49%; margin-right: 2%; height:330px">
          <div class="card-header" >
            Books you ordered:
          </div>

          <div class="card-body" id="buy_container" style="padding:0; overflow-y: scroll">

            <div class="card mb-3 bg-secondary">
              <div class="row no-gutters">
                <div class="col-md-4">
                  <img src="assets/books/asoif.jpg" class="card-img" style="height:100%">
                </div>
                <div class="col-md-8" style="text-align: left">
                  <div class="card-body">
                    <h5 class="card-title"> Book Name <span class="badge badge-info">Regular</span> </h5>
                    <table>
                      <tr>
                        <td> Author: </td>
                        <td> Book Author </td>
                      </tr>
                      <tr>
                        <td style="padding-right: 10px"> Description: </td>
                        <td> Book description here. </td>
                      </tr>
                      <tr>
                        <td> Price: </td>
                        <td> 0000.00 </td>
                      </tr>
                      <tr>
                        <td> Condition: </td>
                        <td> Multiple options </td>
                      </tr>
                      <tr>
                        <td> Format: </td>
                        <td> Multiple options </td>
                      </tr>
                    </table>
                    <br>
                    <div style="display: flex; flex-direction: row; justify-content: center; width: 100%">
                      <button class="btn btn-info received" style="border-radius: 50px; padding: 5px 20px 5px 20px"> Mark as received </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>


            <div class="card mb-3 bg-secondary">
              <div class="row no-gutters">
                <div class="col-md-4">
                  <img src="assets/books/asoif.jpg" class="card-img" style="height:100%">
                </div>
                <div class="col-md-8" style="text-align: left">
                  <div class="card-body">
                    <h5 class="card-title"> Book Name <span class="badge badge-warning">Auction</span> </h5>
                    <table>
                      <tr>
                        <td> Author: </td>
                        <td> Book Author </td>
                      </tr>
                      <tr>
                        <td style="padding-right: 10px"> Description: </td>
                        <td> Book description here. </td>
                      </tr>
                      <tr>
                        <td> Price: </td>
                        <td> 0000.00 </td>
                      </tr>
                      <tr>
                        <td> Condition: </td>
                        <td> Multiple options </td>
                      </tr>
                      <tr>
                        <td> Format: </td>
                        <td> Multiple options </td>
                      </tr>
                    </table>
                    <br>
                    <div style="display: flex; flex-direction: row; justify-content: center; width: 100%">
                      <button class="btn btn-info received" style="border-radius: 50px; padding: 5px 20px 5px 20px"> Mark as Received </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>



        <div class="card text-center column" style="width: 49%; height: 330px">
          <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
              <li class="nav-item">
                <a class="nav-link active" id="sold-tab" data-toggle="tab" href="#sold" role="tab" aria-controls="sold" aria-selected="true"> Sold with pending details: </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="on-sale-tab" data-toggle="tab" href="#on-sale" role="tab" aria-controls="on-sale" aria-selected="false">Books still on sale:</a>
              </li>
            </ul>
          </div>
          <div class="tab-content card-body" id="nav-tabContent" style="padding:0; overflow-y: scroll">
            <!-Important items being sold>
            <div class="tab-pane fade show active" id="sold" role="tabpanel" aria-labelledby="sold-tab">

              <div class="card mb-3">
                <div class="row no-gutters">
                  <div class="col-md-4">
                    <img src="assets/books/asoif.jpg" class="card-img" style="height:100%">
                  </div>
                  <div class="col-md-8" style="text-align: left">
                    <div class="card-body">
                      <h5 class="card-title"> Book Name <span class="badge badge-info">Regular</span> <span class="badge badge-secondary">Undelivered</span> </h5>
                      <table>
                        <tr>
                          <td> Date: </td>
                          <td> 01/01/2019 </td>
                        </tr>
                        <tr>
                          <td> Buyer: </td>
                          <td> Username </td>
                        </tr>
                        <tr>
                          <td> Price: </td>
                          <td> 0000.00 </td>
                        </tr>
                        <tr>
                          <td style="padding-right: 10px"> Address: </td>
                          <td> Somewhere, Unknown
                        </tr>
                        <tr>
                          <td> Message: </td>
                          <td> Sample message. </td>
                        </tr>
                      </table>
                    </div>
                  </div>
                </div>
              </div>


              <div class="card mb-3">
                <div class="row no-gutters">
                  <div class="col-md-4">
                    <img src="assets/books/asoif.jpg" class="card-img" style="height:100%">
                  </div>
                  <div class="col-md-8" style="text-align: left">
                    <div class="card-body">
                      <h5 class="card-title"> Book Name <span class="badge badge-warning">Auction</span> <span class="badge badge-secondary">Undelivered</span> </h5>
                      <table>
                        <tr>
                          <td> Date: </td>
                          <td> 01/01/2019 </td>
                        </tr>
                        <tr>
                          <td> Buyer: </td>
                          <td> Username </td>
                        </tr>
                        <tr>
                          <td> Price: </td>
                          <td> 0000.00 </td>
                        </tr>
                        <tr>
                          <td style="padding-right: 10px"> Address: </td>
                          <td> Somewhere, Unknown
                        </tr>
                      </table>
                      <br>
                      <div style="display: flex; flex-direction: row; justify-content: center; width: 100%">
                        <button class="btn btn-warning declare_winner" style="border-radius: 50px; margin-right: 5px"> Declare Winner </button> <button class="btn btn-danger cancel_auction" style="border-radius: 50px"> Cancel </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>



            <!-end of container->
            </div>

            <div class="tab-pane fade" id="on-sale" role="tabpanel" aria-labelledby="on-sale-tab">

              <div class="card mb-3">
                <div class="row no-gutters">
                  <div class="col-md-4">
                    <img src="assets/books/asoif.jpg" class="card-img" style="height:100%">
                  </div>
                  <div class="col-md-8" style="text-align: left">
                    <div class="card-body">
                      <h5 class="card-title"> Book Name <span class="badge badge-info">Regular</span> </h5>
                      <table>
                        <tr>
                          <td> Author: </td>
                          <td> Book Author </td>
                        </tr>
                        <tr>
                          <td style="padding-right: 10px"> Description: </td>
                          <td> Book description here. </td>
                        </tr>
                        <tr>
                          <td> Price: </td>
                          <td> 0000.00 </td>
                        </tr>
                        <tr>
                          <td> Condition: </td>
                          <td> Multiple options </td>
                        </tr>
                        <tr>
                          <td> Format: </td>
                          <td> Multiple options </td>
                        </tr>
                      </table>
                      <br>
                      <div style="display: flex; flex-direction: row; justify-content: center; width: 100%">
                        <button class="btn btn-info edit_book" style="border-radius: 50px; padding: 5px 20px 5px 20px"> Edit </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="card mb-3">
                <div class="row no-gutters">
                  <div class="col-md-4">
                    <img src="assets/books/asoif.jpg" class="card-img" style="height:100%">
                  </div>
                  <div class="col-md-8" style="text-align: left">
                    <div class="card-body">
                      <h5 class="card-title"> Book Name <span class="badge badge-warning">Auction</span> </h5>
                      <table>
                        <tr>
                          <td> Author: </td>
                          <td> Book Author </td>
                        </tr>
                        <tr>
                          <td style="padding-right: 10px"> Description: </td>
                          <td> Book description here. </td>
                        </tr>
                        <tr>
                          <td> Price: </td>
                          <td> 0000.00 </td>
                        </tr>
                        <tr>
                          <td> Condition: </td>
                          <td> Multiple options </td>
                        </tr>
                        <tr>
                          <td> Format: </td>
                          <td> Multiple options </td>
                        </tr>
                      </table>
                      <br>
                      <div style="display: flex; flex-direction: row; justify-content: center; width: 100%">
                        <button class="btn btn-info edit_book" style="border-radius: 50px; padding: 5px 20px 5px 20px"> Edit </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>


            </div>
          </div>
        </div>


      </div>
    </div>





  </body>
</html>
