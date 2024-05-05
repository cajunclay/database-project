<?php include 'config.php' ?>

<html lang="en">
<head>
<title>Murder Mystery Dinner Party - Event Management Dashboard</title>
</head>
<body>
<h2>Murder Mystery Dinner Party Event Management</h2>

<?php

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
	
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

	$sql = "SELECT event_id, concat(first_name, ' ', last_name) as customer_name, game_title, event_date, event_street, event_city, event_state, event_zip, guest_count(event_id) as guest_count FROM tblEvents join tblGames join tblCustomer where tblEvents.tblCustomer_customer_id = tblCustomer.customer_id and tblEvents.tblGames_game_id = tblGames.game_id";
	
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
		echo "<p><b>Below is a listing of scheduled events.</b></p><table border=\"1\">
			<tr>
				<td><b>Event ID</b></td>
				<td><b>Customer Name</b></td>
				<td><b>Game Theme</b></td>
				<td><b>Event Date</b></td>
				<td><b>Location</b></td>
				<td><b>Guests Assigned</b></td>
				<td><b>Action</b></td>
			</tr>";
		while($row = $result->fetch_assoc()) {
			echo "<tr><td>" . $row["event_id"] . "</td><td>" . $row["customer_name"] . "</td><td>" . $row["game_title"] . "</td><td>" . $row["event_date"] . "</td><td>" . $row["event_street"] . ", " . $row["event_city"] . ", " . $row["event_state"] . " " . $row["event_zip"] . "</td><td>" . $row["guest_count"] . "</td><td><a href=\"edit-event.php?event_id=" . $row["event_id"] . "\">Edit</a> | <a href=\"delete-event.php?event_id=" . $row["event_id"] . "\">Delete</a></td></tr>";
		}
		echo "</table>";
	} else {
		echo "No games have been scheduled.";
	}
	
	$conn->close();

?>
<p><a href="schedule-event.php">Add New Event</a></p>

<?php include 'footer.php' ?>