<?php include 'config.php' ?>

<html lang="en">
<head>
<title>Murder Mystery Dinner Party - Event Management Dashboard</title>
</head>
<body>
<h2>Murder Mystery Dinner Party Game Management - Delete Event</h2>

<?php

	if ($_GET['event_id'] != "") {
		
		$event_id = $_GET['event_id'];
		
		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
	
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}			
		
		$sql = "DELETE FROM tblEvents WHERE event_id=" . $event_id . "";

		try {
			$result = $conn->query($sql);
		} catch(Exception $e) {
			echo $e->GetMessage();
		}

		if ($conn->affected_rows == 1) {
			echo "<p style=\"color: green;\"><b>Event deleted!</b></p>";
		} else {
			echo "<p style=\"color: red;\"><b>Error deleting the specified event.</b></p>";
		}
		
		$conn->close();	
		
	}

?>
<p><a href="event-manager.php">Back to Event Manager</a></p>

</body>
</html>