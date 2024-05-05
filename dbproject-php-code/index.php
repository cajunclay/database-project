<html lang="en">
<head>
<title>Murder Mystery Dinner Party Event & Game Management Dashboard</title>
</head>
<body>
<h2>Murder Mystery Dinner Party Event & Game Management Dashboard</h2>

<p><b>Customer Menu</b></p>
<p>Customers are able to schedule, edit, and delete murder mystery dinner party events as well as add and remove character assignments.</p>

<ul>
	<li><a href="event-manager.php">Manage Events</a> - View, create, update, delete events, as well as view, create, and delete character assignments. <i>Notes: Involves tblEvents (Operations: CRUD), tblCharacterAssignment (Operations: CR*D)</i></li>
	<li><a href="add-guest.php">Invite Guest</a> - Invite (create) a new guest. <i>Notes: Involves tblGuests (Operations: C***)</i></li>
</ul>

<p><b>Guest Menu</b></p>
<p>Guests are able to view and edit their demographic information.</p>

<ul>
	<li><a href="guests.php">Guests</a> - View, create, update, and delete guests. <i>Notes: Involves tblGuests (Operations: CRUD)</i></li>    
</ul>

<p><b>Administrator Menu</b></p>
<p>Administrators are able to add, edit, and delete murder mystery dinner party game themes as well as add, update, and remove game characters.</p>

<ul>
	<li><a href="game-manager.php">Game Management</a> - View, create, update, and delete game themes, as well as view, create, update, and delete characters. <i>Notes: Involves tblGames (Operations: CRUD), tblCharacters (Operations: CRUD)</i></li>
	<li><a href="customers.php">Customers</a> - View, update, and delete customers. <i>Notes: Involves tblCustomer (Operations: *RUD)</i></li>
	<li><a href="orders.php">Orders</a> - View, create, and delete orders. This process also creates new customers. <i>Notes: Involves tblCustomer (Operations: C***), tblOrders (Operations: CR*D)</i></li>
	<li><a href="reports.php">Reports</a> - View available reports.</li>
</ul>
</body>
</html>