<?php include 'config.php' ?>

<html lang="en">
<head>
<title>Murder Mystery Dinner Party - Event Management Dashboard</title>
</head>
<body>
<h2>Murder Mystery Dinner Party Guest Management - Add New Guest</h2>

<p><b>Add A New Guest:</b></p>

<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
	<table>
		<tr><td align="right">Guest's First Name:</td><td><input type="text" name="first_name" required></td></tr>
		<tr><td align="right">Guest's Last Name:</td><td><input type="text" name="last_name" required></td></tr>
		<tr><td align="right">Guest's Phone Number:</td><td><input type="text" name="phone" required></td></tr>		
		<tr><td align="right">Guest's Email Address:</td><td><input type="text" name="email" required></td></tr>				
	</table>
	<p><input type="submit" value="Add Guest">&nbsp;<input type="reset" value="Reset"></p>
</form>

<?php

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$first_name = htmlspecialchars($_POST['first_name']);
		$last_name = htmlspecialchars($_POST['last_name']);
		$phone = htmlspecialchars($_POST['phone']);
		$email = htmlspecialchars($_POST['email']);				
		
	// Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
	
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

	$sql = "INSERT INTO tblGuests(guest_first_name, guest_last_name, guest_phone_number, guest_email) VALUES ('" . $first_name . "', '" . $last_name . "', '" . $phone . "', '" . $email . "')";
	
	if ($conn->query($sql) === TRUE) {
		echo "<p><b><font color=\"green\">New guest added!</font></b></p>";
	} else {
		echo "Error adding a new guest: " . $conn->error;
	}
		
	$conn->close();	
		
	}	

?>
<hr>
<p><a href="guests.php">Back to Guests</a></p>

</body>
</html>