<?php include 'config.php' ?>

<html lang="en">
<head>
<title>Murder Mystery Dinner Party - Event Management Dashboard</title>
</head>
<body>
<h2>Murder Mystery Dinner Party Game Management - Delete Order</h2>

<?php

	if ($_GET['order_id'] != "") {
		
		$order_id = $_GET['order_id'];
		
		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
	
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}			
		
		$sql = "DELETE FROM tblOrders WHERE order_id=" . $order_id . "";
		
		try {
			$result = $conn->query($sql);
		} catch(Exception $e) {
			echo $e->GetMessage();
		}

		if ($conn->affected_rows == 1) {
			echo "<p style=\"color: green;\"><b>Order deleted!</b></p>";
		} else {
			echo "<p style=\"color: red;\"><b>Error deleting the specified order.</b></p>";
		}
		
		$conn->close();	
		
	}

?>
<p><a href="orders.php">Back to Orders</a></p>

</body>
</html>