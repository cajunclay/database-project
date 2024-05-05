<?php include 'config.php' ?>

<html lang="en">
<head>
<title>Murder Mystery Dinner Party - Event Management Dashboard</title>
</head>
<body>
<h2>Murder Mystery Dinner Party Game Management - Add New Character</h2>

<?php

	if ($_GET['game_id'] != "") {
		
		$game_id = $_GET['game_id'];

?>

		<p><b>Add A New Game Character</b></p>

		<form action="<?php echo $_SERVER['PHP_SELF'] . "?game_id=" . $game_id;?>" method="post">
			<input type="hidden" name="game_id" value="<?php echo $game_id; ?>">
			<table>
				<tr><td align="right">Character Name:</td><td><input type="text" name="char_name" required></td></tr>
				<tr><td align="right">Character's Role/Profession:</td><td><input type="text" name="char_title" required></td></tr>
				<tr><td align="right">Costume Suggestions:</td><td><textarea style="font-family: Arial;" name="costume" rows="4" cols="50" required></textarea></td></tr>
			</table>
			<p><input type="submit" value="Add Character">&nbsp;<input type="reset" value="Reset"></p>
		</form>

<?php

	} else {
		echo "<p><b>No game ID provided!</b></p>";
	}

	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		$game_id = htmlspecialchars($_POST['game_id']);
		$character_name = htmlspecialchars($_POST['char_name']);
		$character_title = htmlspecialchars($_POST['char_title']);
		$costume = htmlspecialchars($_POST['costume']);

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		$sql = "INSERT INTO tblCharacters(tblGames_game_id, character_name, character_title, character_costume_suggestions) VALUES ('" . $game_id . "', '". $character_name . "', '" . $character_title . "', '" . $costume . "')";
		
		if ($conn->query($sql) === TRUE) {
			echo "<p><b><font color=\"green\">Character added!</font></b></p>";
		} else {
			echo "Error adding the new character: " . $conn->error;
		}	
	
		$conn->close();	
	
	}
			
?>
<hr>
<p><a href="edit-game.php?game_id=<?php echo $game_id; ?>">Back to Game</a></p>

</body>
</html>