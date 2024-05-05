<?php include 'config.php' ?>

<html lang="en">
<head>
<title>Murder Mystery Dinner Party - Event Management Dashboard</title>
</head>
<body>
<h2>Murder Mystery Dinner Party Game Management - Add New Guest Assignment</h2>

<?php

	if ($_GET['event_id'] != "" and $_GET['game_id'] != "" and $_GET['customer_id'] != "") {
		
		$event_id = $_GET['event_id'];
		$game_id = $_GET['game_id'];
		$customer_id = $_GET['customer_id'];
		
		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
	
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}			
		
?>

		<p><b>Add A New Guest Assignment</b></p>

		<form action="<?php echo $_SERVER['PHP_SELF'] . "?event_id=" . $event_id . "&game_id=" . $game_id . "&customer_id=" . $customer_id . "";?>" method="post">
			<input type="hidden" name="event_id" value="<?php echo $event_id; ?>">
			<input type="hidden" name="game_id" value="<?php echo $game_id; ?>">
			<input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>">
			<table>
				<tr><td align="right">Select Guest:</td><td><select name="guest_id" required><option value="">---</option>
<?php

				$sql = "SELECT guest_id, concat(guest_first_name, ' ', guest_last_name) as guest_name FROM tblGuests";
				$result = $conn->query($sql);
				
				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						echo '<option value="' . $row["guest_id"] . '">' . $row["guest_name"] . '</option>';
					}
					echo "</select></td></tr>";
				}

?>
				<tr><td align="right">Select Character:</td><td><select name="char_id" required><option value="">---</option>
<?php

				$sql = "SELECT character_id, character_name, character_title FROM tblCharacters WHERE tblGames_game_id=" . $game_id . "";
				$result = $conn->query($sql);
				
				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						echo '<option value="' . $row["character_id"] . '">' . $row["character_name"] . ' (' . $row["character_title"] . ')</option>';
					}
					echo "</select></td></tr>";
				}

?>
			</table>
			<p><input type="submit" value="Add Assignment">&nbsp;<input type="reset" value="Reset"></p>
		</form>

<?php

	} else {
		echo "<p><b>No event, game, or customer ID provided!</b></p>";
	}

	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		$event_id = htmlspecialchars($_POST['event_id']);
		$game_id = htmlspecialchars($_POST['game_id']);
		$customer_id = htmlspecialchars($_POST['customer_id']);
		$guest_id = htmlspecialchars($_POST['guest_id']);
		$char_id = htmlspecialchars($_POST['char_id']);

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		$sql = "call add_assignment('" . $guest_id . "', '". $event_id . "', '" . $customer_id . "', '" . $game_id . "', '" . $char_id . "', '" . $game_id . "')";

		try {
			$result = $conn->query($sql);
		} catch(Exception $e) {
			echo "<p><b>". $e->GetMessage() . "</b></p>";
		}

		if ($conn->affected_rows == 1) {
			echo "<p style=\"color: green;\"><b>Guest assigned!</b></p>";
		} else {
			echo "<p style=\"color: red;\"><b>Error adding the new assignment</b></p>";
		}	
	
		$conn->close();	
	
	}
			
?>
<hr>
<p><a href="edit-event.php?event_id=<?php echo $event_id; ?>">Back to Event</a></p>

</body>
</html>