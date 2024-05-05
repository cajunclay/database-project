<?php include 'config.php' ?>

<html lang="en">
<head>
<title>Murder Mystery Dinner Party - Event Management Dashboard</title>
</head>
<body>
<h2>Murder Mystery Dinner Party Customer Management - Edit Customer</h2>

<?php

	// Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
	
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
		$customer_id = htmlspecialchars($_POST['customer_id']);
		$first = htmlspecialchars($_POST['first']);
		$last = htmlspecialchars($_POST['last']);
		$phone = htmlspecialchars($_POST['phone']);
		$email = htmlspecialchars($_POST['email']);

		$sql = "UPDATE tblCustomer SET first_name='" . $first . "', last_name='" . $last . "', email_address='" . $email . "', phone_number='" . $phone . "' WHERE customer_id=" . $customer_id . "";

		try {
			$result = $conn->query($sql);
		} catch(Exception $e) {
			echo $e->GetMessage();
		}

		if ($conn->affected_rows == 1) {
			echo "<p><b><font color=\"green\">Customer updated!</font></b></p>";
		} else {
			echo "<p><b>Error updating customer.</b></p>";
		}
	}

	if ($_GET['customer_id'] != "") {
		
		$customer_id = $_GET['customer_id'];

		$sql = "SELECT customer_id, first_name, last_name, email_address, phone_number FROM tblCustomer WHERE customer_id=" . $customer_id . "";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();

		if ($result->num_rows > 0) {
			
?>

			<p><b>Update Customer Information:</b></p>

			<form action="<?php echo $_SERVER['PHP_SELF'] . "?customer_id=" . $customer_id;?>" method="post">
				<input type="hidden" name="customer_id" value="<?php echo $row["customer_id"]; ?>">
				<table>
					<tr><td align="right">First Name:</td><td><input type="text" size="52" name="first" value="<?php echo $row["first_name"]; ?>" required></td></tr>
					<tr><td align="right">Last Name:</td><td><input type="text" size="52" name="last" value="<?php echo $row["last_name"]; ?>" required></td></tr>			
					<tr><td align="right">Phone:</td><td><input type="text" size="52" name="phone" value="<?php echo $row["phone_number"]; ?>" required></td></tr>
					<tr><td align="right">Email:</td><td><input type="text" size="52" name="email" value="<?php echo $row["email_address"]; ?>" required></td></tr>
				</table>
				<p><input type="submit" value="Update Customer">&nbsp;<input type="reset" value="Reset"></p>
			</form>

<?php

		} else {
			echo "<p style=\"color: red;\"><b>Customer ID not found!</b></p>";
		}
	} else {
		echo "<p style=\"color: red;\"><b>Customer ID not provided!</b></p>";
	}
	
	$conn->close();	

?>
<hr>
<p><a href="customers.php">Back to Customers</a></p>

</body>
</html>