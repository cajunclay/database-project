<?php include 'config.php' ?>

<html lang="en">
<head>
<title>Murder Mystery Dinner Party - Event Management Dashboard</title>
</head>
<body>
<h2>Murder Mystery Dinner Party Customer Management - Delete Customer</h2>

<?php

	if ($_GET['customer_id'] != "") {
		
		$customer_id = $_GET['customer_id'];
		
		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
	
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}			
		
		$sql = "DELETE FROM tblCustomer WHERE customer_id=" . $customer_id . "";
		
		try {
			$result = $conn->query($sql);
		} catch(Exception $e) {
			echo "<p><b>" . $e->GetMessage() . "</b></p>";
		}

		if ($conn->affected_rows == 1) {
			echo "<p style=\"color: green;\"><b>Customer deleted!</b></p>";
		} else {
			echo "<p style=\"color: red;\"><b>Error deleting the specified customer.</b></p>";
		}
		
		$conn->close();	
		
	}

?>
<p><a href="customers.php">Back to Customers</a></p>

</body>
</html>