<?php
include('config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
 
  <title>TheHaze | Post an Ad</title>

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

<!-- First Container -->
<div class="container-fluid bg-1 text-center" id="banner" style="margin-top: 42px">
  
  <form class="form-register" method="post" enctype="multipart/form-data" action="#">

    <div class="form-register-with-email">

      <div class="form-white-background">

        <div class="form-title-row">
          <h1>Post Ad</h1>
        </div>
        <?php include('errors.php'); ?>
        <div class="form-row">
          <label>
            <span>Product title</span>
            <input type="text" name="title" required>
          </label>
        </div>

        <div class="form-row">
          <label>
            <span data-toggle="tooltip" title="The approximate price you expect for your item.">Price</span>
            <input type="number" name="price" required>
          </label>
        </div>

        <div class="form-row">
          <label>
            <span>Condition</span>
            <select name="cond" id="cond">
                      <option>Used</option>
                      <option>Gently Used</option>
                      <option>Almost like New</option>
                      <option>Brand New</option>
                    </select>
          </label>
        </div>

        <div class="form-row">
          <label>
            <span>Description</span>
            <textarea class="required" rows="5" id="description" name="description" required></textarea>
          </label>
        </div>

        <div class="form-row">
          <label>
            <span>A photo of Item</span>
            <input type="file" name="fileToUpload" id="fileToUpload" required>
          </label>
        </div>

        <div class="form-row">
          <button type="submit" name="post">Post</button>
        </div>

      </div>

    </div>

  </form>
</div>


<?php 

  session_start();
  $errors = array(); 
  if (!isset($_SESSION['username'])) {
    header('location: login.php');
  }

  $username = $_SESSION['username'];
  // Create connection
  $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  if (isset($_POST['post'])) {

    // receive all input values from the form
    $db = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
    $title = mysqli_real_escape_string($db, $_POST['title']);
    $price = mysqli_real_escape_string($db, $_POST['price']);
    $cond = mysqli_real_escape_string($db, $_POST['cond']);
    $description = mysqli_real_escape_string($db, $_POST['description']);

    if (empty($title)) { array_push($errors, "Title is required"); }
    if (empty($price)) { array_push($errors, "Price is required"); }
    if (empty($description)) { array_push($errors, "Description is required"); }

    if (count($errors) == 0) {
      $sql = "INSERT INTO items (title, username, price, cond, description) VALUES('$title', '$username', '$price', '$cond', '$description')";
      if ($conn->query($sql) === TRUE) {
            echo "Ad posted successfully";
      } else {
            echo "Error updating record: Ad: " . $conn->error;
      }
      $sql2 = "SELECT post_id, tstamp FROM items WHERE username='$username' ORDER BY tstamp DESC;";
      $result = $conn->query($sql2);
      $row = $result->fetch_assoc();
      $post_id = $row["post_id"];

      $target_dir = "uploads/img/";
      $target_file = $target_dir . $post_id . ".jpg";
      $uploadOk = 1;
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      // Check if image file is a actual image or fake image

      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
      if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
      } else {
        echo "File is not an image.";
        $uploadOk = 0;
      }
      
      // Check file size
      if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
      }
      // Allow certain file formats
      if($imageFileType != "jpg" && $imageFileType != "jpeg" ) {
        echo "Sorry, only JPG, JPEG files are allowed.";
        $uploadOk = 0;
      }
      // Check if $uploadOk is set to 0 by an error
      if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
      // if everything is ok, try to upload file
      } 
      else {

        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        } 
        else {
          echo "Sorry, there was an error uploading your file.";
        }
      }
      echo '<script>window.location = "view.php?post_id='.$post_id.'";</script>';
    }

  }
?>

<!-- Footer -->
<footer class="container-fluid bg-4 text-center">
  Made with <span class="fa fa-heart"></span><br />
  &copy; 2018 TheHaze. All rights reserved.   Code licensed under <a href="LICENSE">MIT License</a>

</footer>
</body>
</html>
