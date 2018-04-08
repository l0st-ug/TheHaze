<html>
<body>
	<?php
		include('config.php');
		session_start();

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

  		if (isset($_GET['add'])) {
  			$add = $conn->real_escape_string($_GET['add']);
  			$sql = "INSERT INTO interest (username, post_id) VALUES('$username', '$add')";
     		if ($conn->query($sql) === TRUE) {
            	echo "Added successfully";
            	echo '<script>window.location = "view.php?post_id='.$add.'";</script>';
      		} else {
            	echo "Error updating record: " . $conn->error;
      		}
      	}
      	if (isset($_GET['rm'])) {
  			$rm = $conn->real_escape_string($_GET['rm']);
  			$sql = "DELETE FROM interest WHERE username='$username' AND post_id=$rm";
     		if ($conn->query($sql) === TRUE) {
            	echo "Added successfully";
            	echo '<script>window.location = "view.php?post_id='.$rm.'";</script>';
      		} else {
            	echo "Error updating record: " . $conn->error;
      		}
      	}
      	if (empty($_GET['add']) AND empty($_GET['rm'])) {
      		echo '<script>window.location = "index.php";</script>';
      	}
    ?>
</body>
</html>

