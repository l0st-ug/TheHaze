<?php
include('server.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
 
  <title>TheHaze | Registration</title>

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
  <a class="navbar-brand" href="index.php"><img src="logo.png" height="20px" alt="TheHaze"></a>

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
          <a class="dropdown-item" href="#">INTERESTED IN</a>
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
  
  <form class="form-register" method="post" action="#">

    <div class="form-register-with-email">

      <div class="form-white-background">

        <div class="form-title-row">
          <h1>Log in</h1>
        </div>
        <?php include('errors.php'); ?>
        <div class="form-row">
          <label>
            <span>Username</span>
            <input type="text" name="username" required>
          </label>
        </div>

        <div class="form-row">
          <label>
            <span>Password</span>
              <input type="password" name="password" required>
              </label>
        </div>

        <div class="form-row">
          <button type="submit" name="login_user">Log in</button>
        </div>

      </div>

      <a href="register.php" class="form-log-in-with-existing">Don't have an account? Signup here &rarr;</a>

    </div>

  </form>
</div>



<!-- Footer -->
<footer class="container-fluid bg-4 text-center">
  Made with <span class="fa fa-heart"></span><br />
  &copy; 2018 TheHaze. All rights reserved.   Code licensed under <a href="http://opensource.org/licenses/mit-license.html">MIT License</a>

</footer>
</body>
</html>