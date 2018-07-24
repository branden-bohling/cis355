<?php
		include 'database.php';
		include 'events.php';
		//import the customer and events class
   
		Events::displayRecord(Events::retrieveRecord());
		//Display the record to be read retrieved from the retreiveRecord method
?>
 
