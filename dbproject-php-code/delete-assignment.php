<?php include 'config.php' ?>

<html lang="en">
<head>
<title>Murder Mystery Dinner Party - Event Management Dashboard</title>
</head>
<body>
<h2>Murder Mystery Dinner Party Game Management - Delete Guest Assignment</h2>

<?php

	if ($_GET['guest_id'] != "" and $_GET['event_id'] != "") {
		
		$guest_id = $_GET['guest_id'];
		$event_id = $_GET['event_id'];
		
		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
	
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}			
		
		$sql = "DELETE FROM tblCharacterAssignment WHERE tblGuests_guest_id=" . $guest_id . " and tblEvents_event_id=" . $event_id . "";
		
		try {
			$result = $conn->query($sql);
		} catch(Exception $e) {
			echo $e->GetMessage();
		}

		if ($conn->affected_rows == 1) {
			echo "<p style=\"color: green;\"><b>Guest assignment deleted!</b></p>";
		} else {
			echo "<p style=\"color: red;\"><b>Error deleting the specified assignment.</b></p>";
		}
		
		$conn->close();	
		
	}

?>
<p><a href="edit-event.php?event_id=<?php echo $event_id; ?>">Back to Event</a></p>

</body>
</html>