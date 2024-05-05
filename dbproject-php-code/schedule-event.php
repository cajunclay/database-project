<?php include 'config.php' ?>

<html lang="en">
<head>
<title>Murder Mystery Event Management Dashboard - Schedule New Event</title>
</head>
<body>
<h2>Schedule A New Murder Mystery Dinner Party Event Below:</h2>

<p><b>Schedule A New Event:</b></p>

<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
	<table>
		<tr><td align="right">Enter your customer ID:</td><td><input type="number" name="customer_id" required> (Grab a Customer ID <a href="customers.php">here</a>)</td></tr>
		<tr><td align="right">Select game:</td><td><select name="game_id" required><option value="">---</option>
<?php

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
	
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

	$sql = "SELECT game_id, game_title, game_description, game_intro_video_url FROM tblGames";
	
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			echo '<option value="' . $row["game_id"] . '">' . $row["game_title"] . '</option>';
		}
		echo "</select></td></tr>";
	}
	
	$conn->close();

?>
		<tr><td align="right">Choose date and time:</td><td><input type="datetime-local" style="font-family: Arial;" name="datetime" required></td></tr>
		<tr><td align="right">Enter the street address:</td><td><input type="text" name="street" required></td></tr>
		<tr><td align="right">Enter the city:</td><td><input type="text" name="city" required></td></tr>
		<tr><td align="right">Enter the state:</td><td><input type="text" name="state" required></td></tr>
		<tr><td align="right">Enter the zip code:</td><td><input type="number" name="zip" required></td></tr>
		<tr><td align="right">Enter any notes for the event:</td><td><textarea style="font-family: Arial;" name="notes" rows="4" cols="50"></textarea></td></tr>
	</table>
	<p><input type="submit" value="Add Event"><input type="reset" value="Reset"></p>
</form>

<?php

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$customer_id = htmlspecialchars($_POST['customer_id']);
		$game_id = htmlspecialchars($_POST['game_id']);
		$datetime = htmlspecialchars($_POST['datetime']);
		$street = htmlspecialchars($_POST['street']);
		$city = htmlspecialchars($_POST['city']);
		$state = htmlspecialchars($_POST['state']);
		$zip = htmlspecialchars($_POST['zip']);
		$notes = htmlspecialchars($_POST['notes']);
		
	// Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
	
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

	$sql = "INSERT INTO tblEvents(tblCustomer_customer_id, tblGames_game_id, event_date, event_street, event_city, event_state, event_zip, event_notes) VALUES ('" . $customer_id . "', '" . $game_id . "', '". $datetime . "', '" . $street . "', '" . $city . "', '" . $state . "', '" . $zip . "', '" . $notes . "')";

	try {
		$result = $conn->query($sql);
	} catch(Exception $e) {
		echo $e->GetMessage();
	}

	if ($conn->affected_rows == 1) {
		echo "<p><b><font color=\"green\">Event scheduled!</font></b></p>";
	} else {
		echo "<p><b>Error creating event.</b></p>";
	}
		
	$conn->close();	
		
	}	

?>

<hr>
<p><a href="event-manager.php">Back to Event Manager</a></p>

</body>
</html>