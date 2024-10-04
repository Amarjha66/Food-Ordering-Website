<?php
include ('session_m.php');

if (!isset ($login_session)) {
  header('Location: adminlogin.php');
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
    <button onclick="topFunction()" id="myBtn" title="Go to top">
      <span class="glyphicon glyphicon-chevron-up"></span>
    </button>
  
  
    <script type="text/javascript">
      window.onscroll = function()
      {
        scrollFunction()
      };

      function scrollFunction(){
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
        <a href="view_food_items.php" class="list-group-item">View Food Items</a>
        <a href="add_food_items.php" class="list-group-item ">Add Food Items</a>
        <a href="edit_food_items.php" class="list-group-item ">Edit Food Items</a>
        <a href="delete_food_items.php" class="list-group-item ">Delete Food Items</a>
        <a href="view_order_details.php" class="list-group-item active">View Order Details</a>
      </div>
    </div>




    <div class="col-xs-9">
      <div class="form-area" style="padding: 0px;">
        <form action="" method="POST">
          <br style="clear: both">
          <h3 style="margin-bottom: 25px; text-align: center; font-size: 30px;"> YOUR FOOD ORDER LIST </h3>


          <?php
          // Storing Session
          $user_check = $_SESSION['login_user1'];
          //  $sql = "SELECT * FROM orders o WHERE o.R_ID IN (SELECT r.R_ID FROM RESTAURANTS r WHERE r.M_ID='$user_check') ORDER BY order_date";
          $sql = "SELECT 
                orders.*, 
                customer.address AS customer_address, 
                customer.fullname AS customer_fullname, 
                customer.contact AS customer_contact,
                food.images_path AS food_photo
              FROM 
                  orders 
              LEFT JOIN 
                  customer ON orders.username = customer.username 
              LEFT JOIN 
                  restaurants ON orders.R_ID = restaurants.R_ID 
              LEFT JOIN 
                  food ON orders.F_ID = food.F_ID
              WHERE 
                  restaurants.M_ID = '$user_check' OR orders.R_ID IS NULL
              ORDER BY 
                  order_date;
          ";

          $result = mysqli_query($conn, $sql);


          if (mysqli_num_rows($result) > 0) {
            ?>

            <table class="table table-striped">
              <thead class="thead-dark">
                <tr>
                  <th> </th>
                  <th> Order ID </th>
                  <th> Order Date </th>
                  <th> Food Image </th>
                  <th> Food Name </th>
                  <th> Price </th>
                  <th> Quantity </th>
                  <th> Customer </th>
                  <th> Address & Contact </th>
                </tr>
              </thead>

              <?PHP
              //OUTPUT DATA OF EACH ROW
              while ($row = mysqli_fetch_assoc($result)) {
                ?>

                <tbody>
                  <tr>
                    <td> <span class=""></span> </td>
                    <td>
                      <?php echo $row["order_ID"]; ?>
                    </td>
                    <td>
                      <?php echo $row["order_date"]; ?>
                    </td>
                    <td>
                      <img src="<?php echo $row["food_photo"]; ?>" width="50px" />
                    </td>
                    <td>
                      <?php echo $row["foodname"]; ?>
                    </td>
                    <td>
                      <?php echo $row["price"]; ?>
                    </td>
                    <td>
                      <?php echo $row["quantity"]; ?>
                    </td>
                    <td>
                      <?php echo $row["customer_fullname"]; ?>
                    </td>
                    <td>
                      <?php echo $row["customer_address"]; ?>
                      <?php echo $row["customer_contact"]; ?>
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