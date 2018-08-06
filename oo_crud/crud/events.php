  <?php
  Class Events{
	
          // keep track validation errors
        private $dateError = null;
        private $timeError = null;
        private $locationError = null;
        private $descriptionError = null;
	
        // keep track post values
        public $date;
        public $time;
        public $location;
		public $description;
		public $id;
		
		
		function __construct($myDate = null,$myTime= null,$myLocation= null,$myDescription= null,$myId= null){
			$this->date = $myDate;
			$this->time = $myTime;
			$this->location = $myLocation;
			$this->description = $myDescription;
			$this->id = $myId;
			
		}	
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		function retrieveRecord(){
		  
		$id = null;
		if ( !empty($_GET['id'])) {
			$id = $_REQUEST['id'];
		}
		 
		if ( null==$id ) {
			header("Location: index.php");
			return null;
		} else {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "SELECT * FROM events where id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($id));
			return $data = $q->fetch(PDO::FETCH_ASSOC);
			Database::disconnect();
		}
		
		
	  }
  
		function displayRecord($record){
		  $data = $record;
		  echo '
				<div class="container">

					<div class="span10 offset1">
						<div class="row">
							<h3>Read an Event</h3>
						</div>
						 
						<div class="form-horizontal" >
						  <div class="control-group">
							<label class="control-label">Event Date</label>
							<div class="controls">
								<label class="checkbox">';
									echo $data['event_date'];
								echo'</label>
							</div>
						  </div>
						  <div class="control-group">
							<label class="control-label">Event Time</label>
							<div class="controls">
								<label class="checkbox">';
									echo $data['event_time'];
								echo'</label>
							</div>
						  </div>
						  <div class="control-group">
							<label class="control-label">Event Location</label>
							<div class="controls">
								<label class="checkbox">';
									echo $data['event_location'];
								echo'</label>
							</div>
						  </div>
						  <div class="control-group">
							<label class="control-label">Event Description</label>
							<div class="controls">
								<label class="checkbox">';
									echo $data['event_description'];
								echo'</label>
							</div>
						  </div>
							<div class="form-actions">
							  <a class="btn" href="index.php">Back</a>
						   </div>
						</div>
					</div> 
				</div> <!-- /container -->';
	  }
	  
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		function displayDelete(){
			Events::importBootstrap();
			echo'
			<body>
				<div class="container">
				 
							<div class="span10 offset1">
								<div class="row">
									<h3>Delete an Event</h3>
								</div>
								 
								<form class="form-horizontal" action="event_delete.php" method="post">
								  <input type="hidden" name="id" value="<?php echo $id;?>"/>
								  <p class="alert alert-error">Are you sure to delete ?</p>
								  <div class="form-actions">
									  <button type="submit" class="btn btn-danger">Yes</button>
									  <a class="btn" href="index.php">No</a>
									</div>
								</form>
							</div>
							 
				</div> <!-- /container -->
			  </body>';
		}
		function deleteRecord(){
			$id = 0;
			 
			if ( !empty($_GET['id'])) {
				$id = $_REQUEST['id'];
			}
			 
			if ( !empty($_POST)) {
				// keep track post values
				$id = $_POST['id'];
				 
				// delete data
				$pdo = Database::connect();
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = "DELETE FROM events  WHERE id = ?";
				$q = $pdo->prepare($sql);
				$q->execute(array($id));
				Database::disconnect();
				header("Location: index.php");
				 
			}
		}
		
		function validateInput(){
			$valid = true;
			if (empty($this->$date)) {
				$this->$dateError = 'Please enter Event Date';
				$valid = false;
			}
			 
			if (empty($this->$time)) {
				$this->$timeError = 'Please enter Event Time';
				$valid = false;
			} 
			 
			if (empty($this->$location)) {
				$this->$locationError = 'Please enter Event Location';
				$valid = false;
			}
					  
			if (empty($this->$description)) {
				$this->$descriptionError = 'Please enter Event Description';
				$valid = false;
			}
			return $valid;
		}
		function getDate(){
			return $this->date;
		}


	  
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
						<h3>Events</h3>
					</div>
					<div class="row">
						<p>
							<a href="event_create.php" class="btn btn-success">Create</a>
						</p>
						<table class="table table-striped table-bordered">
							  <thead>
								<tr>
								  <th>Date</th>
								  <th>Time</th>
								  <th>Location</th>
								  <th>Description</th>
								  <th>Action</th>
								</tr>
							  </thead>
							  <tbody>';
		}
		
		function displayListFooter(){
			echo '</tbody>
					</table>
					</div>
				</div> <!-- /container -->
			  </body>
			</html>';
		}
		
		function displayUpdateForm(){
			Events::importBootstrap();
			Events::displayupdateHeading();
			Events::displayUpdateFooter();
		}
		
		function loadTableContents(){
			$pdo = Database::connect();
                       $sql = 'SELECT * FROM events ORDER BY id DESC';
                       foreach ($pdo->query($sql) as $row) {
                                echo '<tr>';
                                echo '<td>'. $row['event_date'] . '</td>';
                                echo '<td>'. $row['event_time'] . '</td>';
                                echo '<td>'. $row['event_location'] . '</td>';
								echo '<td>'. $row['event_description'] . '</td>';
								echo '<td width=250>';
                                echo '<a class="btn" href="event_read.php?id='.$row['id'].'">Read</a>';
                                echo ' ';
                                echo '<a class="btn btn-success" href="event_update.php?id='.$row['id'].'">Update</a>';
                                echo ' ';
                                echo '<a class="btn btn-danger" href="event_delete.php?id='.$row['id'].'">Delete</a>';
                                echo '</td>';
                                echo '</tr>';
                       }
                       Database::disconnect();
		}
		
		function displayTable(){
			Events::importBootstrap();
			echo '<p>https://github.com/branden-bohling/cis355 </p>';
			Events::displayListHeading();
			Events::loadTableContents();
			Events::displayListFooter();
						  
		}
  }
    ?>