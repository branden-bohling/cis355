  <?php
		include 'database.php';
		include 'customers.php';
		//import the customer class
   
		echo '<a href="https://github.com/branden-bohling/cis355">Github</a>';
		Customers::displayTable();
                
                echo'<a href="pictures.php"> Pictures stored in database </a> </br>';
                echo '<a href="simpleupload.html"> Simple file upload </a></br>';
                echo '<a href="uploads/"> Simple file upload locations </a>';
  ?>
  
