<?php
session_start();
?>

<html>

<head>
  <title> About | Food Zone </title>
</head>

<link rel="stylesheet" type="text/css" href="css/aboutus.css">
<link rel="stylesheet" type="text/css" href="https://bootswatch.com/3/united/bootstrap.min.css">
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>

<body>


  <button onclick="topFunction()" id="myBtn" title="Go to top">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </button>

  <script type="text/javascript">
    window.onscroll = function () {
      scrollFunction()
    };

    function scrollFunction() {
      if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("myBtn").style.display = "block";
      } else {
        document.getElementById("myBtn").style.display = "none";
      }
    }

    function topFunction() {
      document.body.scrollTop = 0;
      document.documentElement.scrollTop = 0;
    }
  </script>

  <nav class="navbar navbar-default navbar-fixed-top navigation-clean-search" role="navigation">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myNavbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">Food Zone</a>
      </div>

      <div class="collapse navbar-collapse " id="myNavbar">
        <ul class="nav navbar-nav">
          <li><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
          <li class="active"><a href="aboutus.php">About</a></li>
          <li><a href="contactus.php">Contact Us</a></li>
        </ul>

        <?php
        if (isset ($_SESSION['login_user1'])) {

          ?>


          <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Welcome
                <?php echo $_SESSION['login_user1']; ?>
              </a></li>
            <li><a href="view_order_details.php">ADMIN CONTROL PANEL</a></li>
            <li><a href="logout_m.php"><span class="glyphicon glyphicon-log-out"></span> Log Out </a></li>
          </ul>
          <?php
        } else if (isset ($_SESSION['login_user2'])) {
          ?>
            <ul class="nav navbar-nav navbar-right">
              <li><a href="#"><span class="glyphicon glyphicon-user"></span> Welcome
                <?php echo $_SESSION['login_user2']; ?>
                </a></li>
              <li><a href="foodlist.php"><span class="glyphicon glyphicon-cutlery"></span> Food Zone </a></li>
              <li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart
                  (
                  <?php
                  if (isset ($_SESSION["cart"])) {
                    $count = count($_SESSION["cart"]);
                    echo "$count";
                  } else
                    echo "0";
                  ?>)
                </a></li>
              <li><a href="logout_u.php"><span class="glyphicon glyphicon-log-out"></span> Log Out </a></li>
            </ul>
        <?php
        } else {

          ?>

            <ul class="nav navbar-nav navbar-right">
              <li> <a href="customersignup.php"><span class="glyphicon glyphicon-user"></span> Sign-up</a></li>
              <li> <a href="customerlogin.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
            </ul>

          <?php
        }
        ?>
      </div>

    </div>
  </nav>

  <div class="wide">

    <div class="tagline">It's not our <font color="red"><strong>work life</strong></font>, it's our <font color="green">
        <strong><em>life's work</em>.</strong></font>
    </div>
    <br>
    
  </div>

</body>
</html>