<?php include 'config.php' ?>

<html lang="en">
<head>
<title>Murder Mystery Dinner Party - Event Management Dashboard</title>
</head>
<body>
<h2>Murder Mystery Dinner Party Customer Management</h2>

<?php

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
	
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

	$sql = "SELECT customer_id, concat(first_name, ' ', last_name) as customer_name, email_address, phone_number, (select count(order_id) from tblOrders where tblCustomer_customer_id=customer_id) as orders FROM tblCustomer;";
	
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
		echo "<p><b>Below is a listing of customers.</b></p>
			<table border=\"1\">
			<tr>
				<td><b>Customer ID</b></td>
				<td><b>Name</b></td>
				<td><b>Email</b></td>
				<td><b>Phone Number</b></td>
				<td><b>Orders</b></td>
				<td><b>Action</b></td>
			</tr>";
		while($row = $result->fetch_assoc()) {
			echo "<tr><td>" . $row["customer_id"] . "</td><td>" . $row["customer_name"] . "</td><td>" . $row["email_address"] . "</td><td>" . $row["phone_number"] . "</td><td>" . $row["orders"] . "</td><td><a href=\"edit-customer.php?customer_id=" . $row["customer_id"] . "\">Edit</a> | <a href=\"delete-customer.php?customer_id=" . $row["customer_id"] . "\">Delete</a></td></tr>";
		}
		echo "</table>";
	} else {
		echo "<b>No customers have been added.</b>";
	}
	
	$conn->close();

?>
<p><a href="add-order.php">Add New Order</a></p>

<?php include 'footer.php' ?>