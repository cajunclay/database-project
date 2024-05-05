<?php include 'config.php' ?>

<html lang="en">
<head>
<title>Murder Mystery Dinner Party - Event Management Dashboard</title>
</head>
<body>
<h2>Murder Mystery Dinner Party Game Management - Edit Character</h2>

<?php

	// Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
	
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
		$character_id = htmlspecialchars($_POST['char_id']);
		$character_name = htmlspecialchars($_POST['char_name']);
		$character_title = htmlspecialchars($_POST['char_title']);
		$costume = htmlspecialchars($_POST['costume']);

		$sql = "UPDATE tblCharacters SET character_name='" . $character_name . "', character_title='" . $character_title . "', character_costume_suggestions='" . $costume . "' WHERE character_id=" . $character_id . "";
	
		if ($conn->query($sql) === TRUE) {
			echo "<p><b><font color=\"green\">Character updated!</font></b></p>";
		} else {
			echo "Error updating character: " . $conn->error;
		}
	}

	if ($_GET['char_id'] != "") {
		
		$character_id = $_GET['char_id'];

		$sql = "SELECT character_id, character_name, character_title, character_costume_suggestions, tblGames_game_id FROM tblCharacters WHERE character_id=" . $character_id . "";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();

		if ($result->num_rows > 0) {
			
?>

			<p><b>Update Character Information:</b></p>

			<form action="<?php echo $_SERVER['PHP_SELF'] . "?char_id=" . $character_id;?>" method="post">
				<input type="hidden" name="char_id" value="<?php echo $row["character_id"]; ?>">
				<table>
					<tr><td align="right">Character Name:</td><td><input type="text" size="52" name="char_name" value="<?php echo $row["character_name"]; ?>" required></td></tr>
					<tr><td align="right">Character Title:</td><td><input type="text" size="52" name="char_title" value="<?php echo $row["character_title"]; ?>" required></td></tr>
					<tr><td align="right">Costume Suggestions:</td><td><textarea style="font-family: Arial;" name="costume" rows="4" cols="52" required><?php echo $row["character_costume_suggestions"]; ?></textarea></td></tr>
				</table>
				<p><input type="submit" value="Update Character">&nbsp;<input type="reset" value="Reset"></p>
			</form>

<?php

		} else {
			echo "<p style=\"color: red;\"><b>Character ID not found!</b></p>";
		}
	} else {
		echo "<p style=\"color: red;\"><b>Character ID not provided!</b></p>";
	}
	
	$conn->close();	

?>
<hr>
<p><a href="edit-game.php?game_id=<?php echo $row["tblGames_game_id"]; ?>">Back to Game</a></p>

</body>
</html>