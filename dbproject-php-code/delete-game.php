<?php include 'config.php' ?>

<html lang="en">
<head>
<title>Murder Mystery Dinner Party - Event Management Dashboard</title>
</head>
<body>
<h2>Murder Mystery Dinner Party Game Management - Delete Game</h2>

<?php

	if ($_GET['game_id'] != "") {
		
		$game_id = $_GET['game_id'];
		
		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
	
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}			
		
		$sql = "DELETE FROM tblGames WHERE game_id=" . $game_id . "";
		
		try {
			$result = $conn->query($sql);
		} catch(Exception $e) {
			echo $e->GetMessage();
		}

		if ($conn->affected_rows == 1) {
			echo "<p style=\"color: green;\"><b>Game deleted!</b></p>";
		} else {
			echo "<p style=\"color: red;\"><b>Error deleting the specified game.</b></p>";
		}
		
		$conn->close();	
		
	}

?>
<p><a href="game-manager.php">Back to Game Manager</a></p>

</body>
</html>