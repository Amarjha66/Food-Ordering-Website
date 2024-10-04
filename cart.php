<?php
session_start();
require 'connection.php';
$conn = Connect();
if (!isset ($_SESSION['login_user2'])) {
  header("location: customerlogin.php");
}

// Check if ID and quantity are set
if(isset($_POST['id']) && isset($_POST['quantity'])) {
  $id = $_POST['id'];
  $quantity = $_POST['quantity'];

  // Update quantity in session
  foreach($_SESSION['cart'] as &$item) {
      if($item['food_id'] == $id) {
          $item['food_quantity'] = $quantity;
          break;
      }
  }

  // Calculate new total for the item
  $total = $quantity * $item['food_price'];

  // Return the new total
  echo number_format($total, 2);
}
?>

<?php


if (isset ($_POST["add"])) {
  if (isset ($_SESSION["cart"])) {
    $item_array_id = array_column($_SESSION["cart"], "food_id");
    if (!in_array($_GET["id"], $item_array_id)) {
      $count = count($_SESSION["cart"]);

      $item_array = array(
        'food_id' => $_GET["id"],
        'food_name' => $_POST["hidden_name"],
        'food_price' => $_POST["hidden_price"],
        'R_ID' => $_POST["hidden_RID"],
        'images_path' => $_POST["hidden_image"],
        'food_quantity' => $_POST["quantity"]
      );
      $_SESSION["cart"][$count] = $item_array;
      echo '<script>window.location="cart.php"</script>';
    } else {
      echo '<script>alert("Products already added to cart")</script>';
      echo '<script>window.location="cart.php"</script>';
    }
  } else {
    $item_array = array(
      'food_id' => $_GET["id"],
      'food_name' => $_POST["hidden_name"],
      'food_price' => $_POST["hidden_price"],
      'R_ID' => $_POST["hidden_RID"],
      'images_path' => $_POST["hidden_image"],
      'food_quantity' => $_POST["quantity"]
    );
    $_SESSION["cart"][0] = $item_array;
  }
}
if (isset ($_GET["action"])) {
  if ($_GET["action"] == "delete") {
    foreach ($_SESSION["cart"] as $keys => $values) {
      if ($values["food_id"] == $_GET["id"]) {
        unset($_SESSION["cart"][$keys]);
        echo '<script>alert("Food has been removed")</script>';
        echo '<script>window.location="cart.php"</script>';
      }
    }
  }
}

if (isset ($_GET["action"])) {
  if ($_GET["action"] == "empty") {
    foreach ($_SESSION["cart"] as $keys => $values) {

      unset($_SESSION["cart"]);
      echo '<script>alert("Cart is made empty!")</script>';
      echo '<script>window.location="cart.php"</script>';

    }
  }
}


?>

<html>

<head>
  <title> Cart | Food Zone </title>
</head>

<link rel="stylesheet" type="text/css" href="css/cart.css">
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
          <li><a href="aboutus.php">About</a></li>
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
              <li class="active"><a href="foodlist.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart
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
              <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true"
                  aria-expanded="false"><span class="glyphicon glyphicon-sign-up"></span> Sign Up <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                  <li> <a href="customersignup.php"> User Sign-up</a></li>
                </ul>
              </li>

              <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true"
                  aria-expanded="false"><span class="glyphicon glyphicon-log-in"></span> Login <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  + <li> <a href="customerlogin.php"> User Login</a></li>
                </ul>
              </li>
            </ul>

          <?php
        }
        ?>


      </div>

    </div>
  </nav>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.quantity_input').change(function() {
                var id = $(this).data('id');
                var quantity = $(this).val();

                $.ajax({
                    type: 'POST',
                    url: 'update_quantity.php',
                    data: {id: id, quantity: quantity},
                    success: function(response) {
                        $('#total_' + id).text('₹' + response);
                        calculateTotal();
                    }
                });
            });

            function calculateTotal() {
                var total = 0;
                $('.quantity_input').each(function() {
                    var id = $(this).data('id');
                    var quantity = $(this).val();
                    var price = parseFloat($('#price_' + id).text().replace('₹', ''));
                    total += price * quantity;
                });
                $('#cart_total').text('₹' + total.toFixed(2));
            }
        });
    </script>




  <?php
  if (!empty ($_SESSION["cart"])) {
    ?>
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
        <h1>Your Shopping Cart</h1>
        <p>Looks tasty...!!!</p>

      </div>

    </div>
    <div class="table-responsive" style="padding-left: 100px; padding-right: 100px;">
      <table class="table table-striped">
        <thead class="thead-dark">
          <tr>
            <th width="40%">Food Name</th>
            <th width="15%">Quantity</th>
            <th width="20%">Price Details</th>
            <th width="15%">Order Total</th>
            <th width="5%">Action</th>
          </tr>
        </thead>


        <?php

        $total = 0;
        foreach ($_SESSION["cart"] as $keys => $values) {
          ?>
          <tr>
            <td>
              <img src="<?php echo $values["images_path"]; ?>" width="50px" height="50px" />
              <?php echo $values["food_name"]; ?>
            </td>
            <td>
              <?php echo $values["food_quantity"]; ?>
            </td>
            <td>&#8377;
              <?php echo $values["food_price"]; ?>
            </td>
            <td>&#8377;
            <id="total_<?php echo $values["food_id"]; ?>"><?php echo number_format($values["food_quantity"] * $values["food_price"], 2); ?></id=>
            </td>
            <td><a href="cart.php?action=delete&id=<?php echo $values["food_id"]; ?>"><span
                  class="text-danger">Remove</span></a></td>
          </tr>
          <?php
          $total = $total + ($values["food_quantity"] * $values["food_price"]);
        }
        ?>
        <tr>
          <td colspan="3" align="right">Total</td>
          <td align="right">&#8377;
            <?php echo number_format($total, 2); ?>
          </td>
          <td></td>
        </tr>
      </table>
      <?php
      echo '<a href="cart.php?action=empty"><button class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Empty Cart</button></a>&nbsp;<a href="foodlist.php"><button class="btn btn-warning">Continue Shopping</button></a>&nbsp;<a href="payment.php"><button class="btn btn-success pull-right"><span class="glyphicon glyphicon-share-alt"></span> Check Out</button></a>';
      ?>
    </div>
    <br><br><br><br><br><br><br>
    <?php
  }
  if (empty ($_SESSION["cart"])) {
    ?>
    <div class="container">
      <div class="jumbotron">
        <h1>Your Shopping Cart</h1>
        <p>Oops! We can't smell any food here. Go back and <a href="foodlist.php">order now.</a></p>

      </div>

    </div>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <?php
  }
  ?>
  





</body>

</html>