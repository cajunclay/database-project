<?php include 'config.php' ?>

<html lang="en">
<head>
<title>Murder Mystery Dinner Party - Event Management Dashboard</title>
</head>
<body>
<h2>Murder Mystery Dinner Party Guest Management - Delete Guest</h2>

<?php

	if ($_GET['guest_id'] != "") {
		
		$guest_id = $_GET['guest_id'];
		
		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
	
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}			
		
		$sql = "DELETE FROM tblGuests WHERE guest_id=" . $guest_id . "";
		
		try {
			$result = $conn->query($sql);
		} catch(Exception $e) {
			echo $e->GetMessage();
		}

		if ($conn->affected_rows == 1) {
			echo "<p style=\"color: green;\"><b>Guest deleted!</b></p>";
		} else {
			echo "<p style=\"color: red;\"><b>Error deleting the specified guest.</b></p>";
		}
		
		$conn->close();	
		
	}

?>
<p><a href="guests.php">Back to Guests</a></p>

</body>
</html>