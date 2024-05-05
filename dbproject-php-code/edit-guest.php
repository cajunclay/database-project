<?php include 'config.php' ?>

<html lang="en">
<head>
<title>Murder Mystery Dinner Party - Event Management Dashboard</title>
</head>
<body>
<h2>Murder Mystery Dinner Party Guest Management - Edit Guest</h2>

<?php

	// Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
	
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
		$guest_id = htmlspecialchars($_POST['guest_id']);
		$first = htmlspecialchars($_POST['first']);
		$last = htmlspecialchars($_POST['last']);
		$phone = htmlspecialchars($_POST['phone']);
		$email = htmlspecialchars($_POST['email']);

		$sql = "UPDATE tblGuests SET guest_first_name='" . $first . "', guest_last_name='" . $last . "', guest_phone_number='" . $phone . "', guest_email='" . $email . "' WHERE guest_id=" . $guest_id . "";

		try {
			$result = $conn->query($sql);
		} catch(Exception $e) {
			echo $e->GetMessage();
		}

		if ($conn->affected_rows == 1) {
			echo "<p><b><font color=\"green\">Guest updated!</font></b></p>";
		} else {
			echo "<p><b>Error updating guest.</b></p>";
		}
	}

	if ($_GET['guest_id'] != "") {
		
		$guest_id = $_GET['guest_id'];

		$sql = "SELECT guest_id, guest_first_name, guest_last_name, guest_phone_number, guest_email FROM tblGuests WHERE guest_id=" . $guest_id . "";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();

		if ($result->num_rows > 0) {
			
?>

			<p><b>Update Customer Information:</b></p>

			<form action="<?php echo $_SERVER['PHP_SELF'] . "?guest_id=" . $guest_id;?>" method="post">
				<input type="hidden" name="guest_id" value="<?php echo $row["guest_id"]; ?>">
				<table>
					<tr><td align="right">First Name:</td><td><input type="text" size="52" name="first" value="<?php echo $row["guest_first_name"]; ?>" required></td></tr>
					<tr><td align="right">Last Name:</td><td><input type="text" size="52" name="last" value="<?php echo $row["guest_last_name"]; ?>" required></td></tr>			
					<tr><td align="right">Phone:</td><td><input type="text" size="52" name="phone" value="<?php echo $row["guest_phone_number"]; ?>" required></td></tr>
					<tr><td align="right">Email:</td><td><input type="text" size="52" name="email" value="<?php echo $row["guest_email"]; ?>" required></td></tr>
				</table>
				<p><input type="submit" value="Update Guest">&nbsp;<input type="reset" value="Reset"></p>
			</form>

<?php

		} else {
			echo "<p style=\"color: red;\"><b>Guest ID not found!</b></p>";
		}
	} else {
		echo "<p style=\"color: red;\"><b>Guest ID not provided!</b></p>";
	}
	
	$conn->close();	

?>
<hr>
<p><a href="guests.php">Back to Guests</a></p>

</body>
</html>