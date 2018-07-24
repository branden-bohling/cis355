  <?php
		include 'database.php';
		include 'customers.php';
		include 'events.php';
		//import the customer and events class
   
		Events::displayTable();
		//Display the table of events
		Customers::displayTable();
  ?>
  
