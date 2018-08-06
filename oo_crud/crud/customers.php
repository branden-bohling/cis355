
<?php
	
    Class Customers{
        private $id; #private class variables
        private $name;
        private $email;
        private $phone;
        private $nameError;
        private $emailError;
        private $mobileError;
        //variables for the Customers object

        function __construct($myName = null, $myEmail = null, $myPhone = null){
            // constructor for the Customers object
            $this->name = $myName;
            $this->email = $myEmail;
            $this->phone = $myPhone;
        }
        
        // Getter and setter methods for each variable 
        function getID(){
            return $this->id;
        }

        function getName(){
            return $this->name;
        }

        function getEmail(){
            return $this->email;
        }

        function getPhone(){
            return $this->phone;
        }

        function getNameError(){
            return $this->nameError;
        }

        function getEmailError(){
            return $this->emailError;
        }

        function getMobileError(){
            return $this->mobileError;
        }

        function setID($myID){
            $this->id = $myID; 
        }

        function setName($myName){
            $this->name = $myName; 
        }

        function setEmail($myEmail){
            $this->email = $myEmail; 
        }

        function setPhone($myPhone){
            $this->phone = $myPhone; 
        }
        
        function validateInput(){
            //validate the input for creating or updating a customer
            //check that an email address is valid
            //if any of the input fields is invalid set valid to false
            //and set the respective error 
            $valid = true;
            if (empty($this->name)) {
                    $this->nameError = 'Please enter Name';
                    $valid = false;
            }
            if (empty($this->email)) {
                    $this->emailError = 'Please enter Email Address';
                    $valid = false;
            }  else if ( !filter_var($this->email,FILTER_VALIDATE_EMAIL) ) {
                $this->emailError = 'Please enter a valid Email Address';
                $valid = false;
             }

            if (empty($this->phone)) {
                    $this->mobileError = 'Please enter Mobile Number';
                    $valid = false;
            }
            return $valid;
        }

        function create(){
            // Connect to the database and insert new data
            if ($this->validateInput()) {
                $pdo = Database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "INSERT INTO customers (name,email,mobile) values(?, ?, ?)";
                $q = $pdo->prepare($sql);
                $q->execute(array($this->getName(),$this->getEmail(),$this->getPhone()));
                Database::disconnect();
                header("Location: index.php"); 
            }
        }

        function read($id){
            // read a customer that has already been created,
            // based on that customer's id
            // set the object's data to that which was entered 
            // into the database 
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM customers where id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($id));
            $data = $q->fetch(PDO::FETCH_ASSOC);
            $this->setName($data['name']);
            $this->setEmail($data['email']);
            $this->setPhone($data['mobile']);
            $this->setID($id);
            Database::disconnect();
        }	

        function update(){
            //update the database with new data for a customer
            if($this->validateInput()){
                $pdo = Database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "UPDATE customers  set name = ?, email = ?, mobile =? WHERE id = ?";
                $q = $pdo->prepare($sql);
                $q->execute(array($this->getName(),$this->getEmail(),$this->getPhone(),$this->getID()));
                Database::disconnect();
                header("Location: index.php");
            }
        }

        function delete(){
            //delete a record from the database
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "DELETE FROM customers  WHERE id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($this->getID()));
            Database::disconnect();
            header("Location: index.php");
        }




        function importBootstrap(){
            //import bootstrap CDN
            echo '<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="utf-8">
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
            </head>';
        }

        function loadTableContents(){
            //load table for index page
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

        function displayTable(){
            //HTML for displaying the table at the index page
            Customers::importBootstrap();
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
                Customers::loadTableContents();
            echo'</tbody>
                </table>
                </div>
                </div> <!-- /container -->
                </body>
              </html>';
        }

    }
?>