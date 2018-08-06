<?php
    require 'database.php';
    include 'customers.php';
    
    $cust1 = new Customers();
    $id = 0;
    // create a new customer and variable for id
    
    if ( !empty($_GET['id'])) {
        // get id and set variable
        $id = $_REQUEST['id'];
    }
     
    if ( !empty($_POST)) {
        // update id, read the record
        // then delete record
        $id = $_POST['id'];
        $cust1->read($id);
        $cust1->delete();
         
    }
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    
    <?php Customers::importBootstrap(); ?>
    
</head>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Delete a Customer</h3>
                    </div>
                     
                    <form class="form-horizontal" action="delete.php" method="post">
                      <input type="hidden" name="id" value="<?php echo $id;?>"/>
                      <p class="alert alert-error">Are you sure you want to delete this customer?</p>
                      <div class="container">
                      <div class="form-actions">
                          <button type="submit" class="btn btn-danger">Yes</button>
                          <a class="btn" href="index.php">No</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /containerr -->
  </body>
</html>