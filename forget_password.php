<!DOCTYPE html>
<html>

  <head>
    <title> Guest Login | Food Zone </title>
  </head>

  <link rel="stylesheet" type = "text/css" href ="css/managerlogin.css">
  <link rel="stylesheet" type = "text/css" href ="https://bootswatch.com/3/united/bootstrap.min.css">
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
            <li ><a href="index.php"><span class="glyphicon glyphicon-home"></span>   Home</a></li>
            <li><a href="aboutus.php">About</a></li>
            <li><a href="contactus.php">Contact Us</a></li>
          </ul>
        </div>

      </div>
    </nav>

    <div class="container">
    <div class="jumbotron">
    <style>
      .jumbotron {
        background-image: url("images/loginimg.jpg");
        background-repeat: no-repeat;
        width: 1150px;
        height: 350px;
      }
      body{
        background-color: antiquewhite;
      }
    </style>
     <h1>Hi Guest,<br> Welcome to <span class="edit"> Food Zone </span></h1>
     <br> 
   <p>Enter Your Email to Reset Your Password.</p>
    </div>
    </div>

    <div class="container" style="margin-top: 4%; margin-bottom: 2%;">
      <div class="col-md-5 col-md-offset-4">
      <div class="panel panel-primary">
        <div class="panel-heading"> Forget Password </div>
        <div class="panel-body">
          
        <form action="" method="POST">
          
        <div class="row">
              <div class="form-group col-xs-12">
                <label for="email"><span class="text-danger" style="margin-right: 5px;">*</span> Email: </label>
                  <input class="form-control" id="email" type="text" name="email" placeholder="email" required="" autofocus="">
              </div>
            </div>

        <div class="row">
          <div class="form-group col-xs-4">
              <button class="btn btn-primary" name="submit" type="submit" value=" Login ">Submit</button>
          </div>

        </div>

        </form>
        </div>     
      </div>      
    </div>
    </div>


    </body>
</html>

<?php
if (isset($_POST['submit'])) {
    // Retrieve the email from the form
    $email = $_POST['email'];
    
    // Validate email (you can add more robust email validation if needed)
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Invalid email format
        echo "<script>alert('Invalid email format');</script>";
    } else {
        // Here, you can implement the logic to send a password reset email to the user
        // For demonstration purposes, let's just display a success message
        echo "<script>alert('Password reset instructions have been sent to $email');</script>";
    }
}
?>