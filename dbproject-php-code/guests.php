<?php include 'config.php' ?>

<html lang="en">
<head>
<title>Murder Mystery Dinner Party - Event Management Dashboard</title>
</head>
<body>
<h2>Murder Mystery Dinner Party Guest Management</h2>

<?php

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
	
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

	$sql = "SELECT guest_id, concat(guest_first_name, ' ', guest_last_name) as guest_name, guest_phone_number, guest_email, (select count(*) from tblCharacterAssignment where guest_id = tblGuests_guest_id) as assignments FROM tblGuests;";
	
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
		echo "<p><b>Below is a listing of guests.</b></p>
			<table border=\"1\">
			<tr>
				<td><b>Name</b></td>
				<td><b>Phone</b></td>
				<td><b>Email</b></td>
				<td><b># of Events Assigned</b></td>
				<td><b>Action</b></td>
			</tr>";
		while($row = $result->fetch_assoc()) {
			echo "<tr><td>" . $row["guest_name"] . "</td><td>" . $row["guest_phone_number"] . "</td><td>" . $row["guest_email"] . "</td><td align=\"center\">" . $row["assignments"] . "</td><td><a href=\"edit-guest.php?guest_id=" . $row["guest_id"] . "\">Edit</a> | <a href=\"delete-guest.php?guest_id=" . $row["guest_id"] . "\">Delete</a></td></tr>";
		}
		echo "</table>";
	} else {
		echo "<b>No guests have been added.</b>";
	}
	
	$conn->close();

?>
<p><a href="add-guest.php">Add New Guest</a></p>

<?php include 'footer.php' ?>