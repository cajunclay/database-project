<?php include 'config.php' ?>

<html lang="en">
<head>
<title>Murder Mystery Dinner Party - Event Management Dashboard</title>
</head>
<body>
<h2>Murder Mystery Dinner Party Game Management - Delete Character</h2>

<?php

	if ($_GET['char_id'] != "" and $_GET['game_id'] != "") {
		
		$character_id = $_GET['char_id'];
		$game_id = $_GET['game_id'];

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
	
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}			
		
		$sql = "DELETE FROM tblCharacters WHERE character_id=" . $character_id . "";

		try {
			$result = $conn->query($sql);
		} catch(Exception $e) {
			echo $e->GetMessage();
		}

		if ($conn->affected_rows == 1) {
			echo "<p style=\"color: green;\"><b>Character deleted!</b></p>";
		} else {
			echo "<p style=\"color: red;\"><b>Error deleting the specified character.</b></p>";
		}
		
		$conn->close();	
		
	}

?>
<p><a href="edit-game.php?game_id=<?php echo $game_id; ?>">Back to Game</a></p>

</body>
</html>