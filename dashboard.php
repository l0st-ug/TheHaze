<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
  }
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
  }
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

<?php 
  include('config.php');

  // Create connection
  $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  $username = $_SESSION['username'];
  $sql = "SELECT name, email, mobile, hostel, verified, room, image FROM users WHERE username='$username'";
$result = $conn->query($sql);
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
?>

<!-- First Container -->
<div class="container-fluid bg-1 text-center" id="banner" style="margin-top: 42px">
  
  <div class="main-container">
    <div class="row">
    <div class="col-sm-5">
      <div class="card">
        <img src=<?php echo '"'.$image.'"'; ?> class="card-img-top" >
        <div class="card-body">
          <h1 class="card-title"><?php echo $name;?></h4>
          <h3><?php echo '@'.$username;?></h3><br />
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><span class="fa fa-edit"></span>edit</button>
        </div>
      </div>
    </div>
    <div class="col-sm-7">
      
    </div>
    </div>
  </div>

  <!-- The Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
      
        
        
        <!-- Modal body -->
        <div class="modal-body">
          <form class="form-register" method="post" action="edit.php" enctype="multipart/form-data">

            <div class="form-register-with-email">

              <div class="form-white-background">

                <div class="form-title-row">
                  <h1>Update Account</h1>
                </div>
                <?php include('errors.php'); ?>
                <div class="form-row">
                  <label>
                    <span>Mobile</span>
                    <input type="text" name="mobile">
                  </label>
                </div>

                <div class="form-row">
                  <label>
                    <span>Hostel</span>
                    <select name="hostel" id="hostel">
                      <option>BH-1</option>
                      <option>BH-2</option>
                      <option>BH-3</option>
                      <option>GH</option>
                    </select>
                  </label>
                </div>

                <div class="form-row">
                  <label>
                    <span>Room no.</span>
                    <input type="number" name="room">
                  </label>
                </div>

                <div class="form-row">
                  <label>
                    <span>Profile Photo</span>
                    <input type="file" name="fileToUpload" id="fileToUpload"><br>
                  </label>
                </div>

                <div class="form-row">
                  <button type="submit" name="update_user">Update</button>
                </div>

              </div>

            </div>

          </form>
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
