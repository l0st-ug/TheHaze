<?php 
  session_start(); 
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

<?php 
  include('config.php');

  // Create connection
  $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  if(isset($_GET['post_id']))
  {
    $db = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
    $post_id = mysqli_real_escape_string($db, $_GET['post_id']);
    $sql = "SELECT title, username, price, cond, description FROM items WHERE post_id='$post_id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $title = $row['title'];
    $username = $row['username'];
    $price = $row['price'];
    $cond = $row['cond'];
    $description = $row['description'];

    $sql = "SELECT name, email, mobile, hostel, verified, room, image FROM users WHERE username='$username'";
    $result = $conn->query($sql);
    $flag = $result->num_rows;
    if ($flag == 0) {
      echo '<script>window.location = "index.php";</script>';
    }
    $row = $result->fetch_assoc();
    $name = $row['name'];
    $email = $row['email'];
    $hostel = $row['hostel'];
    $mobile = $row['mobile'];
    $verified = $row['verified'];
    $room = $row['room'];
    $image = $row['image'];
    if ($image == "unset")
    {
        $image = "uploads/default.jpg";
    } else {
        $image = "uploads/".$username.".jpg";
    }

    $uname = $_SESSION['username'];
    $sql = "SELECT * FROM interest WHERE username='$uname' AND post_id=$post_id";
    $result = $conn->query($sql);
    $int = $result->num_rows;
  }
?>

<!-- First Container -->
<div class="container-fluid bg-1 text-center" id="banner" style="margin-top: 42px">
  
  <div class="main-container">
    <div class="row">
    <div class="col-sm-5">
      <div class="card">
        <img src=<?php echo '"uploads/img/'.$post_id.'.jpg"'; ?> class="card-img-top" >
      </div>
    </div>
    <div class="col-sm-7 text-left" style="padding-top: 40px;">

      <h1 class="display-4"><?php echo $title; ?></h1>
      <span class="badge badge-info badge-pill"><?php echo $cond; ?></span><br />
      Posted By:
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
        <span class="fa fa-user"></span> <?php echo $name; ?> 
      </button>
      <br />
      <b style="font-size: 32px;">Price: <?php echo $price; ?> INR</b><br />
      <b>Description</b><br />
      <p><?php echo $description; ?></p>
      <?php
        if ($uname != $username)
        {
          if ($int == 0)
          {
            echo 'Add to <a class="btn btn-danger" href="interested.php?add='.$post_id.'"><span class="fa fa-heart"></span> Interested</a>';
          }
          else {
            echo 'Remove from <a class="btn btn-danger" href="interested.php?rm='.$post_id.'"><span class="fa fa-heart"></span> Interested</a>';
          }
        }
        else {
          echo '<a class="btn btn-danger" href="rm.php?post_id='.$post_id.'"><span class="fa fa-close"></span> Delete</a>';
        }
      ?>
    </div>
    </div>
  </div>

  <!-- The Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        
        
        <!-- Modal body -->
        <div class="modal-body">
          <div class="card">
            <img src=<?php echo '"'.$image.'"'; ?> class="card-img-top" >
            <div class="card-body bg-dark">
              <h1 class="card-title"><?php echo $name;?></h1>
              <h3><?php echo '@'.$username;?></h3><br />
              <h3><?php if($email!='unset') {echo $email; }?><br />
              <?php if($mobile!='0') { echo $mobile;}?><br />
              <?php if($room!='unset') {echo 'Room no. '.$room.', '.$hostel;}?></h3><br />
            </div>
          </div>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer bg-dark">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
</div>


<!-- Footer -->
<footer class="container-fluid bg-4 text-center">
  Made with <span class="fa fa-heart"></span><br />
  &copy; 2018 TheHaze. All rights reserved.   Code licensed under <a href="LICENSE">MIT License</a>

</footer>
</body>
</html>
