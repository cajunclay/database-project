<?php include 'config.php' ?>

<html lang="en">
<head>
<title>Murder Mystery Dinner Party - Event Management Dashboard</title>
</head>
<body>
<h2>Murder Mystery Dinner Party Game Management</h2>

<?php

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
	
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

	$sql = "SELECT game_id, game_title, game_price, game_description, game_intro_video_url FROM tblGames";
	
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
		echo "<p><b>Below is a listing of the available game themes.</b></p>
			<table border=\"1\">
			<tr>
				<td><b>Game ID</b></td>
				<td><b>Game Title</b></td>
				<td><b>Game Price</b></td>				
				<td><b>Game Description</b></td>
				<td><b>Game Introductory Video</b></td>
				<td><b>Action</b></td>
			</tr>";
		while($row = $result->fetch_assoc()) {
			echo "<tr><td>" . $row["game_id"] . "</td><td>" . $row["game_title"] . "</td><td align=\"center\">" . $row["game_price"] . "</td><td>" . $row["game_description"] . "</td><td>" . $row["game_intro_video_url"] . "</td><td><a href=\"edit-game.php?game_id=" . $row["game_id"] . "\">Edit</a> | <a href=\"delete-game.php?game_id=" . $row["game_id"] . "\">Delete</a></td></tr>";
		}
		echo "</table>";
	} else {
		echo "<b>No games have been added.</b>";
	}
	
	$conn->close();

?>
<p><a href="add-game.php">Add New Game Theme</a></p>

<?php include 'footer.php' ?>