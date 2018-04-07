<?php
include('config.php');
session_start();

if (isset($_SESSION['username'])) {
    //$_SESSION['msg'] = "You must log in first";
    header('location: login.php');
  }

// variable declaration
$username = "";
//$mobile    = "";
$errors = array(); 

// connect to database
$db = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);

// REGISTER USER //


if (isset($_POST['reg_user'])) {
  echo "reg_user <br>";
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['uname']);
  $mobile = mysqli_real_escape_string($db, $_POST['mobile']);
  $password = mysqli_real_escape_string($db, $_POST['pass']);
  $college = mysqli_real_escape_string($db, $_POST['college']);
  $name = mysqli_real_escape_string($db, $_POST['name']);
  $gender = mysqli_real_escape_string($db, $_POST['gender']);
  $email = mysqli_real_escape_string($db, $_POST['email']);

  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($mobile)) { array_push($errors, "Email is required"); }
  if (empty($password)) { array_push($errors, "Password is required"); }
  $query1 = "SELECT * FROM users WHERE username='$username'";
    $results1 = mysqli_query($db, $query1);
    if (mysqli_num_rows($results1) == 1) {
      array_push($errors, "Username already taken.");
    }

  
  if (count($errors) == 0) {
  	$pass = md5($password);
  	$query = "INSERT INTO users (username, name, email, college, gender, password, mobile) VALUES('$username', '$name', '$email', '$college', '$gender', '$pass', '$mobile')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
    $query2 = "INSERT INTO events (user) VALUES('$username')";
    mysqli_query($db, $query2);
  	header('location: dashboard.php');
  	echo "<script>window.location = 'dashboard.php';</script>";
  }

}


//   LOGIN FUNCTION //


if (isset($_POST['login_user'])) {
  $uname = mysqli_real_escape_string($db, $_POST['uname']);
  $pass = mysqli_real_escape_string($db, $_POST['pass']);

  if (empty($uname)) {
    array_push($errors, "Username is required");
  }
  if (empty($pass)) {
    array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
    $password = md5($pass);
    $query = "SELECT * FROM users WHERE username='$uname' AND password='$password'";
    $results = mysqli_query($db, $query);
    if (mysqli_num_rows($results) == 1) {
      $_SESSION['username'] = $uname;
      $_SESSION['success'] = "";
      header('location: dashboard.php');
    }else {
      array_push($errors, "Wrong username/password combination");
    }
  }
}

?>