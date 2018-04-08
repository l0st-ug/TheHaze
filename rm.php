<html>
<body>
<?php
	include('config.php');
	session_start();
	if(isset($_GET['post_id'])) {
		$post_id = $_GET['post_id'];

		$username = $_SESSION['username'];

		//connection to database
		$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
		$post_id = $conn->real_escape_string($post_id);

		$sql = "DELETE FROM items WHERE post_id = $post_id AND username='$username'";
		if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
            echo '<script>window.location = "index.php";</script>';
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
    else{
    	echo "Hey! you lost??";
    }

?>
</body>
</html>