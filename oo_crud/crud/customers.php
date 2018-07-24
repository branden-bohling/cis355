
<?php
	Class Customers{
			  function importBootstrap(){
				echo '<!DOCTYPE html>
				<html lang="en">
				<head>
					<meta charset="utf-8">
					
					<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
					<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
						
				</head>';
			}
			
			function displayListHeading(){
				echo'<body>
				<div class="container">
						<div class="row">
							<h3>Customer File</h3>
						</div>
						<div class="row">
							<p>
								<a href="create.php" class="btn btn-success">Create</a>
							</p>
							<table class="table table-striped table-bordered">
								  <thead>
									<tr>
									  <th>Name</th>
									  <th>Email Address</th>
									  <th>Mobile Number</th>
									  <th>Action</th>
									</tr>
								  </thead>
								  <tbody>';
				
			}
			
			function loadTableContents(){
						   $pdo = Database::connect();
						   $sql = 'SELECT * FROM customers ORDER BY id DESC';
						   foreach ($pdo->query($sql) as $row) {
									echo '<tr>';
									echo '<td>'. $row['name'] . '</td>';
									echo '<td>'. $row['email'] . '</td>';
									echo '<td>'. $row['mobile'] . '</td>';
									echo '<td width=250>';
									
									
									echo '<a class="btn" href="read.php?id='.$row['id'].'">Read</a>';
									
									
									echo ' ';
									echo '<a class="btn btn-success" href="update.php?id='.$row['id'].'">Update</a>';
									echo ' ';
									echo '<a class="btn btn-danger" href="delete.php?id='.$row['id'].'">Delete</a>';
									echo '</td>';
									echo '</tr>';
						   }
						   Database::disconnect();
			}
			
			function displayListFooter(){
						'</tbody>
							</table>
					</div>
				</div> <!-- /container -->
			  </body>
			</html>';
				
			}
			
			function displayTable(){
				Customers::importBootstrap();
				Customers::displayListHeading();
				Customers::loadTableContents();
				Customers::displayListFooter();
							  
			}
		
	}
?>