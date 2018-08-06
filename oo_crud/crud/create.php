 <?php
    require 'database.php';
    include 'customers.php';
    
    $cust1 = new Customers();
    //create a new Customers object
    
    if ( !empty($_POST)) {
        // Initialize new customers object 
        // and then create that object in the database
	$cust1 = new Customers($_POST['name'], $_POST['email'], $_POST['mobile']);
        $cust1->create();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php Customers::importBootstrap(); ?>
</head>
<body>
    <div class="container">
            
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Create a Customer</h3>
                    </div>
             
                    <form class="form-horizontal" action="create.php" method="post">
                      <div class="control-group <?php echo !empty($cust1->getNameError())?'error':'';?>">
                        <label class="control-label">Name</label>
                        <div class="controls">
                            <input name="name" type="text"  placeholder="Name" value="<?php echo !empty($cust1->getName())?$cust1->getName():'';?>">
                            <?php if (!empty($cust1->getNameError())): ?>
                            <span class="help-inline"><?php echo $cust1->getNameError();?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                        <div class="control-group <?php echo !empty($cust1->getEmailError())?'error':'';?>">
                        <label class="control-label">Email Address</label>
                        <div class="controls">
                            <input name="email" type="text" placeholder="Email Address" value="<?php echo !empty($cust1->getEmail())?$cust1->getEmail():'';?>">
                            <?php if (!empty($cust1->getEmailError())): ?>
                                <span class="help-inline"><?php echo $cust1->getEmailError();?></span>
                            <?php endif;?>
                        </div>
                      </div>
                        <div class="control-group <?php echo !empty($cust1->getMobileError())?'error':'';?>">
                        <label class="control-label">Mobile Number</label>
                        <div class="controls">
                            <input name="mobile" type="text"  placeholder="Mobile Number" value="<?php echo !empty($cust1->getPhone())?$cust1->getPhone():'';?>">
                            <?php if (!empty($cust1->getMobileError())): ?>
                                <span class="help-inline"><?php echo $cust1->getMobileError();?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Create</button>
                          <a class="btn" href="index.php">Back</a>
                        </div>
                    </form>
                </div>
    </div> <!-- /container -->
  </body>
</html>