<?php include 'config.php' ?>

<html lang="en">
<head>
<title>Murder Mystery Dinner Party - Event Management Dashboard</title>
</head>
<body>
<h2>Murder Mystery Dinner Party - Reports</h2>

<p><b>Available Reports</b></p>

<?php

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
	
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

	$sql = "SELECT * from orders;";
	
	$result = $conn->query($sql);

	echo "<p><b>Total Customer Orders:</b> ";
	while($row = $result->fetch_assoc()) {
		echo $row["count(*)"] . "</p>";
	}

	$sql = "SELECT * from events;";
	
	$result = $conn->query($sql);

	echo "<p><b>Total Scheduled Events:</b> ";
	while($row = $result->fetch_assoc()) {
		echo $row["count(*)"] . "</p>";
	}
		
	$conn->close();

?>

<?php include 'footer.php' ?>