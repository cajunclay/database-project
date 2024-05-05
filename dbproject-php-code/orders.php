<?php include 'config.php' ?>

<html lang="en">
<head>
<title>Murder Mystery Dinner Party - Event Management Dashboard</title>
</head>
<body>
<h2>Murder Mystery Dinner Party Orders</h2>

<?php

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
	
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

	$sql = "SELECT order_id, date_format(order_date, '%Y-%m-%d') as order_date, order_total, tblCustomer_customer_id, concat(first_name, ' ', last_name) as customer_name, tblGames_game_id, game_title FROM tblOrders join tblCustomer join tblGames where tblCustomer_customer_id = customer_id and tblGames_game_id = game_id";
	
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
		echo "<p><b>Below is a listing of customer orders.</b></p>
			<table border=\"1\">
			<tr>
				<td><b>Order ID</b></td>
				<td><b>Order Date</b></td>
				<td><b>Order Total</b></td>
				<td><b>Customer Name</b></td>
				<td><b>Game Theme Purchased</b></td>
				<td><b>Action</b></td>
			</tr>";
		while($row = $result->fetch_assoc()) {
			echo "<tr><td>" . $row["order_id"] . "</td><td>" . $row["order_date"] . "</td><td align=\"center\">" . $row["order_total"] . "</td><td>" . $row["customer_name"] . "</td><td>" . $row["game_title"] . "</td><td><a href=\"delete-order.php?order_id=" . $row["order_id"] . "\">Delete</a></td></tr>";
		}
		echo "</table>";
	} else {
		echo "<b>No orders have been made.</b>";
	}
	
	$conn->close();

?>
<p><a href="add-order.php">Add New Order</a></p>

<?php include 'footer.php' ?>