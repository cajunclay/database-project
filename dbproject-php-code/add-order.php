<?php include 'config.php' ?>

<html lang="en">
<head>
<title>Murder Mystery Dinner Party - Event Management Dashboard</title>
</head>
<body>
<h2>Murder Mystery Dinner Party Game Management - Add New Order</h2>

<p><b>Add A New Order:</b></p>

<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
	<table>
		<tr><td align="right">Customer's First Name:</td><td><input type="text" name="first_name" required></td></tr>
		<tr><td align="right">Customer's Last Name:</td><td><input type="text" name="last_name" required></td></tr>
		<tr><td align="right">Customer's Phone Number:</td><td><input type="text" name="phone" required></td></tr>		
		<tr><td align="right">Customer's Email Address:</td><td><input type="text" name="email" required></td></tr>				
		<tr><td align="right">Game Purchased:</td><td><select name="game_id" required><option value="">---</option>
<?php

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
	
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

	$sql = "SELECT game_id, game_title, game_price FROM tblGames";
	
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			echo '<option value="' . $row["game_id"] . '">' . $row["game_title"] . ' ($' . $row["game_price"] . ')</option>';
		}
		echo "</select></td></tr>";
	}
	
	$conn->close();

?>

	</table>
	<p><input type="submit" value="Add Order">&nbsp;<input type="reset" value="Reset"></p>
</form>

<?php

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$first_name = htmlspecialchars($_POST['first_name']);
		$last_name = htmlspecialchars($_POST['last_name']);
		$phone = htmlspecialchars($_POST['phone']);
		$email = htmlspecialchars($_POST['email']);				
		$game_id = htmlspecialchars($_POST['game_id']);
		
	// Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
	
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

	$sql = "INSERT INTO tblCustomer(first_name, last_name, email_address, phone_number) VALUES ('" . $first_name . "', '" . $last_name . "', '" . $email . "', '" . $phone . "')";
	
	if ($conn->query($sql) === TRUE) {
		echo "<p><b><font color=\"green\">New customer added!</font></b></p>";
	} else {
		echo "Error adding a new customer: " . $conn->error;
	}

	$sql = "INSERT INTO tblOrders(order_date, order_total, tblCustomer_customer_id, tblGames_game_id) VALUES (curdate(), (select game_price from tblGames where game_id=" . $game_id . "), last_insert_id(), '" . $game_id . "')";
	
	if ($conn->query($sql) === TRUE) {
		echo "<p><b><font color=\"green\">Order added!</font></b></p>";
	} else {
		echo "Error adding the new order: " . $conn->error;
	}
		
	$conn->close();	
		
	}	

?>
<hr>
<p><a href="orders.php">Back to Orders</a></p>

</body>
</html>