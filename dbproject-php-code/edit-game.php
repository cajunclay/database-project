<?php include 'config.php' ?>

<html lang="en">
<head>
<title>Murder Mystery Dinner Party - Event Management Dashboard</title>
</head>
<body>
<h2>Murder Mystery Dinner Party Game Management - Edit Game</h2>

<?php

	// Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
	
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
		$game_id = htmlspecialchars($_POST['game_id']);
		$game_title = htmlspecialchars($_POST['game_title']);
		$game_price = htmlspecialchars($_POST['game_price']);
		$game_description = htmlspecialchars($_POST['game_description']);
		$game_url = htmlspecialchars($_POST['game_url']);

		$sql = "UPDATE tblGames SET game_title='" . $game_title . "', game_price='" . $game_price . "', game_description='" . $game_description . "', game_intro_video_url='" . $game_url . "' WHERE game_id=" . $game_id . "";
	
		if ($conn->query($sql) === TRUE) {
			echo "<p><b><font color=\"green\">Game updated!</font></b></p>";
		} else {
			echo "Error updating game: " . $conn->error;
		}
	}

	if ($_GET['game_id'] != "") {
		
		$game_id = $_GET['game_id'];

		$sql = "SELECT game_id, game_title, game_price, game_description, game_intro_video_url FROM tblGames WHERE game_id=" . $game_id . "";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();

		if ($result->num_rows > 0) {
			
?>

			<p><b>Update Game Information:</b></p>

			<form action="<?php echo $_SERVER['PHP_SELF'] . "?game_id=" . $game_id;?>" method="post">
				<input type="hidden" name="game_id" value="<?php echo $row["game_id"]; ?>">
				<table>
					<tr><td align="right">Game Title:</td><td><input type="text" size="52" name="game_title" value="<?php echo $row["game_title"]; ?>" required></td></tr>
					<tr><td align="right">Game Price:</td><td><input type="number" step=".01" size="15" name="game_price" value="<?php echo $row["game_price"]; ?>" required></td></tr>				
					<tr><td align="right">Game Description:</td><td><textarea style="font-family: Arial;" name="game_description" rows="4" cols="52" required><?php echo $row["game_description"]; ?></textarea></td></tr>
					<tr><td align="right">Game Introductory Video URL:</td><td><input type="text" size="52" name="game_url" value="<?php echo $row["game_intro_video_url"]; ?>" required></td></tr>
				</table>
				<p><input type="submit" value="Update Game">&nbsp;<input type="reset" value="Reset"></p>
			</form>

<?php

			$sql = "SELECT character_id, character_name, character_title, tblGames_game_id FROM tblCharacters WHERE tblGames_game_id=" . $game_id . "";
			$result = $conn->query($sql);
		
			if ($result->num_rows > 0) {
				echo "<p><b>Character Listing:</b><br><a href=\"add-character.php?game_id=" . $game_id . "\">Add Another Character</button></a></p>";
				echo "<ul>";
				while($row = $result->fetch_assoc()) {
					echo "<li>" . $row["character_name"] . " (" . $row["character_title"] . ") (<a href=\"edit-character.php?char_id=" . $row["character_id"] . "\">Edit</a>/<a href=\"delete-character.php?char_id=" . $row["character_id"] . "&game_id=" . $row["tblGames_game_id"] . "\">Delete</a>)</li>";
				}
				echo "</ul>";
			} else {
				echo '<p style="color: red;"><b>No characters have been added to the game.</b></p><p><a href="add-character.php?game_id=' . $game_id . '"><button>Add Character</button></a></p>';
			}

		} else {
			echo "<p style=\"color: red;\"><b>No game with that ID found!</b></p>";
		}
	} else {
		echo "<p style=\"color: red;\"><b>No game ID provided!</b></p>";
	}
	
	$conn->close();	

?>
<hr>
<p><a href="game-manager.php">Back to Game Manager</a></p>

</body>
</html>