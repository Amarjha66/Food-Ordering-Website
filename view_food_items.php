<?php
include ('session_m.php');

if (!isset ($login_session)) {
  header('Location: adminlogin.php'); // Redirecting To Home Page
}

?>
<!DOCTYPE html>
<html>

<head>
  <title> Admin Login | Food Zone </title>
</head>
<link rel="stylesheet" type="text/css" href="css/delete_food_item.css">
<link rel="stylesheet" type="text/css" href="https://bootswatch.com/3/united/bootstrap.min.css">
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>

<body>

  <style>
        #myBtn{
      display: none;
      position: fixed;
      bottom: 20px;
      right: 30px;
      z-index: 99;
      border: none;
      outline: none;
      background-color: green;
      color: white;
      cursor: pointer;
      padding: 15px;
      border-radius: 10px;
    }
    #myBtn:hover {
      background-color: darkgreen;
      color: white;
    }
  </style>
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
          <li><a href="aboutus.php">About</a></li>
          <li><a href="contactus.php">Contact Us</a></li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
          <li><a href="#"><span class="glyphicon glyphicon-user"></span> Welcome
              <?php echo $login_session; ?>
            </a></li>
          <li class="active"> <a href="adminlogin.php">ADMIN CONTROL PANEL</a></li>
          <li><a href="logout_m.php"><span class="glyphicon glyphicon-log-out"></span> Log Out </a></li>
        </ul>
      </div>

    </div>
  </nav>




  <div class="container">
    <div class="jumbotron">
    <style>
        .jumbotron{
          background-image: url("images/loginimg.jpg");
          background-repeat: no-repeat;
          width: 1150px;
          height: 250px;
        }
      </style>
      <h1>Hello Admin! </h1>
      <p>Manage all your restaurant from here.</p>

    </div>
  </div>

  <div class="container">
    <div class="container">
      <div class="col">

      </div>
    </div>


    <div class="col-xs-3" style="text-align: center;">

      <div class="list-group">
        <a href="view_food_items.php" class="list-group-item active">View Food Items</a>
        <a href="add_food_items.php" class="list-group-item ">Add Food Items</a>
        <a href="edit_food_items.php" class="list-group-item ">Edit Food Items</a>
        <a href="delete_food_items.php" class="list-group-item ">Delete Food Items</a>
        <a href="view_order_details.php" class="list-group-item ">View Order Details</a>
      </div>
    </div>




    <div class="col-xs-9">
      <div class="form-area" style="padding: 0px 100px 100px 100px;">
        <form action="" method="POST">
          <br style="clear: both">
          <h3 style="margin-bottom: 25px; text-align: center; font-size: 30px;"> YOUR FOOD ITEMS LIST </h3>


          <?php




          // Storing Session
          $user_check = $_SESSION['login_user1'];
          $sql = "SELECT * FROM food f WHERE f.R_ID IN (SELECT r.R_ID FROM RESTAURANTS r WHERE r.M_ID='$user_check') ORDER BY F_ID";
          $result = mysqli_query($conn, $sql);


          if (mysqli_num_rows($result) > 0) {

            ?>

            <table class="table table-striped">
              <thead class="thead-dark">
                <tr>

                  <th> Food ID </th>
                  <th> Image </th>
                  <th> Food Name </th>
                  <th> Price </th>
                  <th> Description </th>
                  <!-- <th> Restaurant ID </th> -->
                </tr>
              </thead>

              <?PHP
              //OUTPUT DATA OF EACH ROW
              while ($row = mysqli_fetch_assoc($result)) {
                ?>

                <tbody>
                  <tr>
                    <td>
                      <?php echo $row["F_ID"]; ?>
                    </td>
                    <td>
                      <img src="<?php echo $row["images_path"]; ?>" width="50px" />
                    </td>
                    <td>
                      <?php echo $row["name"]; ?>
                    </td>
                    <td>
                      <?php echo $row["price"]; ?>
                    </td>
                    <td>
                      <?php echo $row["description"]; ?>
                    </td>

                  </tr>
                </tbody>

              <?php } ?>
            </table>
            <br>


          <?php } else { ?>

            <h4>
              <center>0 RESULTS</center>
            </h4>

          <?php } ?>

        </form>


      </div>

    </div>
  </div>
  <br>
  <br>
  <br>
  <br>

</body>

</html>