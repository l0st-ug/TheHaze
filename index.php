<?php
include('config.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
 
  <title>TheHaze | classifieds</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">


  <link rel="stylesheet" href="css/style.css">
  <script src="js/script.js"></script>

</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-sm fixed-top navbar-light bg-light" id="mynav">
  <a class="navbar-brand" href="#"><img src="logo.png" height="20px" alt="TheHaze"></a>

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon color-dark"></span>
  </button>

  <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">

    <form class="form-inline form-search" method="get" action="search.php">
            <input type="search" name="search" placeholder="I am looking for..">
            <button type="submit">Search</button>
            <i class="fa fa-search"></i>
    </form>
    <ul class="navbar-nav">
      <li class="nav-item bg-primary"><a class="nav-link" href="post.php"  style="color: #fff">POST AD</a></li>
      <?php if (!isset($_SESSION['username'])) { echo '
      <li class="nav-item"><a class="nav-link" href="login.php">LOGIN</a></li>
      <li class="nav-item"><a class="nav-link" href="register.php">REGISTER</a></li>';
      }
      else { echo '
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
          ACCOUNT
        </a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="dashboard.php">PROFILE</a>
          <a class="dropdown-item" href="dashboard.php?logout=1">LOGOUT</a>
        </div>
      </li>';
      }
      ?>
      <li class="nav-item"><a class="nav-link" href="#where">ABOUT US</a></li>
    </ul>
  </div>
</nav>

<!-- First Container -->
<div class="container-fluid bg-1 text-center" id="banner" style="margin-top: 42px">
  <h3 class="margin display-1">TheHaze</h3>

  <div class="main-container bg-2">
    Classified Ads
    <?php
        // Create connection
        $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

        // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT * FROM items ORDER BY tstamp DESC";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
            echo '<div class="row bg-3 m-5" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);"><div class="col-sm-4"><img src="uploads/img/'.$row['post_id'].'.jpg" style="max-height: 250px;"></div>
                  <div class="col-sm-8"><h1 class="mb-0" style="padding-top: 20px;"><a href="view.php?post_id='.$row['post_id'].'">'.$row['title'].'</a></h1><br /><button class="btn btn-primary" disabled><span class="fa fa-user"></span> '.$row['username'].'</button><br />'.$row['description'].'
                  <br /><b style="font-size: 24px;">Price: '.$row['price'].' INR</b><br /></div></div>';
          }
        } else {
          echo "No Ads Posted.";
        }
      ?>
  </div>


</div>



<!-- Footer -->
<footer class="container-fluid bg-4 text-center">
  Made with <span class="fa fa-heart"></span><br />
  &copy; 2018 TheHaze. All rights reserved.   Code licensed under <a href="LICENSE">MIT License</a>

</footer>
</body>
</html>
