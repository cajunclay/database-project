<?php include 'config.php' ?>

<html lang="en">
<head>
<title>Murder Mystery Dinner Party - Event Management Dashboard</title>
</head>
<body>
<h2>Murder Mystery Dinner Party Game Management - Edit Event</h2>

<?php

	// Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
	
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
		$event_id = htmlspecialchars($_POST['event_id']);
		$event_date = htmlspecialchars($_POST['datetime']);
		$event_street = htmlspecialchars($_POST['street']);
		$event_city = htmlspecialchars($_POST['city']);
		$event_state = htmlspecialchars($_POST['state']);
		$event_zip = htmlspecialchars($_POST['zip']);
		$event_notes = htmlspecialchars($_POST['notes']);

		$sql = "UPDATE tblEvents SET event_date='" . $event_date . "', event_street='" . $event_street . "', event_city='" . $event_city . "', event_state='" . $event_state . "', event_zip='" . $event_zip . "', event_notes='" . $event_notes . "' WHERE event_id=" . $event_id . "";
	
		if ($conn->query($sql) === TRUE) {
			echo "<p><b><font color=\"green\">Event updated!</font></b></p>";
		} else {
			echo "Error updating event: " . $conn->error;
		}
	}

	if ($_GET['event_id'] != "") {
		
		$event_id = $_GET['event_id'];

		$sql = "SELECT event_id, tblCustomer_customer_id, tblGames_game_id, event_date, event_street, event_city, event_state, event_zip, event_notes FROM tblEvents WHERE event_id=" . $event_id . "";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();

		if ($result->num_rows > 0) {
			
?>

			<p><b>Update Event Information:</b></p>

			<form action="<?php echo $_SERVER['PHP_SELF'] . "?event_id=" . $event_id;?>" method="post">
				<input type="hidden" name="event_id" value="<?php echo $row["event_id"]; ?>">
				<table>
					<tr><td align="right">Date and time:</td><td><input type="datetime-local" style="font-family: Arial;" name="datetime" value="<?php echo $row["event_date"]; ?>" required></td></tr>
					<tr><td align="right">Street address:</td><td><input type="text" name="street" value="<?php echo $row["event_street"]; ?>" required></td></tr>
					<tr><td align="right">City:</td><td><input type="text" name="city" value="<?php echo $row["event_city"]; ?>" required></td></tr>
					<tr><td align="right">State:</td><td><input type="text" name="state" value="<?php echo $row["event_state"]; ?>" required></td></tr>
					<tr><td align="right">Zip code:</td><td><input type="number" name="zip" value="<?php echo $row["event_zip"]; ?>" required></td></tr>
					<tr><td align="right">Notes for the event:</td><td><textarea style="font-family: Arial;" name="notes" rows="4" cols="50"><?php echo $row["event_notes"]; ?></textarea></p></td></tr>
				</table>
				<p><input type="submit" value="Update Event">&nbsp;<input type="reset" value="Reset"></p>
			</form>

<?php

			$sql = "SELECT tblGuests_guest_id, tblCharacters_character_id, assignment_invite_sent, assignment_invite_sent_date, tblEvents_event_id, concat(guest_first_name, \" \", guest_last_name) as guest_name, character_name, character_title FROM tblCharacterAssignment join tblGuests join tblCharacters where tblEvents_event_id = " . $event_id . " and tblGuests_guest_id = guest_id and tblCharacters_character_id = character_id";
			$result = $conn->query($sql);
		
			if ($result->num_rows > 0) {
				echo "<p><b>Guest Assignments:</b><br><a href=\"add-assignment.php?event_id=" . $event_id . "&game_id=" . $row["tblGames_game_id"] . '&customer_id=' . $row["tblCustomer_customer_id"] . "\">Add Another Guest</button></a></p>";
				echo "<ul>";
				while($row = $result->fetch_assoc()) {
					echo "<li><b>" . $row["guest_name"] . "</b> (Assigned the Character: " . $row["character_name"] . " (" . $row["character_title"] . ")) (<a href=\"delete-assignment.php?guest_id=" . $row["tblGuests_guest_id"] . "&event_id=" . $row["tblEvents_event_id"] . "\">Delete</a>)</li>";
				}
				echo "</ul>";
			} else {
				echo '<p style="color: red;"><b>No guests have been added to the event.</b></p><p><a href="add-assignment.php?event_id=' . $event_id . '&game_id=' . $row["tblGames_game_id"] . '&customer_id=' . $row["tblCustomer_customer_id"] . '"><button>Add Guest</button></a></p>';
			}

		} else {
			echo "<p style=\"color: red;\"><b>No event with that ID found!</b></p>";
		}
	} else {
		echo "<p style=\"color: red;\"><b>No event ID provided!</b></p>";
	}
	
	$conn->close();	

?>
<hr>
<p><a href="event-manager.php">Back to Event Manager</a></p>

</body>
</html>