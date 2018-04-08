<html>
<body>
<?php

  include('config.php');
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

  
  // receive all input values from the form
  $db = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
  $mobile = mysqli_real_escape_string($db, $_POST['mobile']);
  $hostel = mysqli_real_escape_string($db, $_POST['hostel']);
  $room = mysqli_real_escape_string($db, $_POST['room']);

  if (!empty($mobile)) { 
    echo "mobile";
    $sql = "UPDATE users SET mobile='$mobile' WHERE username='$username'";
    if ($conn->query($sql) === TRUE) {
            echo "mobile Record updated successfully";
    } else {
            echo "Error updating record: mobile: " . $conn->error;
    }
  }
  if (!empty($hostel)) { 
    echo "hostel";
    $sql = "UPDATE users SET hostel='$hostel' WHERE username='$username'";
    if ($conn->query($sql) === TRUE) {
            echo "hostel Record updated successfully";
    } else {
            echo "Error updating record: hostel: " . $conn->error;
    }
  }
  if (!empty($room)) { 
    echo "asdf";
    $sql = "UPDATE users SET room='$room' WHERE username='$username'";
    if ($conn->query($sql) === TRUE) {
            echo "room Record updated successfully";
    } else {
            echo "Error updating record: room: " . $conn->error;
    }
  }

  if (isset($_FILES["fileToUpload"])) {

    $target_dir = "uploads/";
    $target_file = $target_dir . $username . ".jpg";
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
      echo "   ran  ";
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";

        $sql = "UPDATE users SET image='set' WHERE username='$username'";
        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }
      } 
      else {
        echo "Sorry, there was an error uploading your file.";
      }
    }
  }
  header('location: dashboard.php');
?>
<script>window.location = "dashboard.php";</script>
</body>
</html>