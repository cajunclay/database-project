<?php include 'config.php' ?>

<html lang="en">
<head>
<title>Murder Mystery Dinner Party - Event Management Dashboard</title>
</head>
<body>
<h2>Murder Mystery Dinner Party Game Management - Add New Game</h2>

<p><b>Add A New Game Theme:</b></p>

<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
	<table>
		<tr><td align="right">Game Title:</td><td><input type="text" name="game_title" required></td></tr>
		<tr><td align="right">Game Price:</td><td><input type="number" step=".01" name="game_price" required></td></tr>		
		<tr><td align="right">Game Description:</td><td><textarea style="font-family: Arial;" name="game_description" rows="4" cols="50" required></textarea></td></tr>
		<tr><td align="right">Game Introductory Video URL:</td><td><input type="text" name="game_url" required></td></tr>
	</table>
	<p><input type="submit" value="Add Game">&nbsp;<input type="reset" value="Reset"></p>
</form>

<?php

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$game_title = htmlspecialchars($_POST['game_title']);
		$game_price = htmlspecialchars($_POST['game_price']);		
		$game_description = htmlspecialchars($_POST['game_description']);
		$game_url = htmlspecialchars($_POST['game_url']);
		
	// Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
	
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

	$sql = "INSERT INTO tblGames(game_title, game_price, game_description, game_intro_video_url) VALUES ('" . $game_title . "', '" . $game_price . "', '" . $game_description . "', '" . $game_url . "')";
	
	if ($conn->query($sql) === TRUE) {
		echo "<p><b><font color=\"green\">Game added!</font></b></p>";
	} else {
		echo "Error adding the new game: " . $conn->error;
	}
		
	$conn->close();	
		
	}	

?>
<hr>
<p><a href="game-manager.php">Back to Game Manager</a></p>

</body>
</html>