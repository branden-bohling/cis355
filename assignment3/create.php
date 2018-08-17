 <?php
    require 'database.php';
    include 'customers.php';
    
    $cust1 = new Customers();
    //create a new Customers object
    
    if ( !empty($_POST)) {
        // Initialize new customers object 
        // and then create that object in the database
	$cust1 = new Customers($_POST['name'], $_POST['email'], $_POST['mobile']);
        
        if($cust1->validateImage( $_FILES['Filename']['name'], $_FILES['Filename']['tmp_name'], $_FILES['Filename']['size'] )){
            $cust1->setImage($_FILES['Filename']['tmp_name']);
            $cust1->setImageName($_FILES['Filename']['name']);
            $cust1->setImageDescription($_POST['Description']);
            $cust1->setImagePath($_FILES['Filename']['tmp_name']);
        }
        
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
             
                    <form class="form-horizontal" action="create.php" method="post" 
                          onsubmit="return Validate(this);" enctype="multipart/form-data">
                      <div class="control-group <?php echo !empty($cust1->getNameError())?'error':'';?>">
                        <label class="control-label">Name</label>
                        <div class="controls">
                            <input name="name" type="text"  placeholder="Name" value="<?php echo !empty($cust1->getName())?$cust1->getName():'';?>">
                            <?php if (!empty($cust1->getNameError())): ?>
                            <span class="help-inline"><?php echo $cust1->getNameError();?></span>
                            <?php endif; ?>
                        </div>
                      </div>                       
                        </br>
                        
                        <div class="control-group <?php echo !empty($cust1->getEmailError())?'error':'';?>">
                        <label class="control-label">Email Address</label>
                        <div class="controls">
                            <input name="email" type="text" placeholder="Email Address" value="<?php echo !empty($cust1->getEmail())?$cust1->getEmail():'';?>">
                            <?php if (!empty($cust1->getEmailError())): ?>
                                <span class="help-inline"><?php echo $cust1->getEmailError();?></span>
                            <?php endif;?>
                        </div>
                        </div>
                        </br>
                        
                        <div class="control-group <?php echo !empty($cust1->getMobileError())?'error':'';?>">
                        <label class="control-label">Mobile Number</label>
                        <div class="controls">
                            <input name="mobile" type="text"  placeholder="Mobile Number" value="<?php echo !empty($cust1->getPhone())?$cust1->getPhone():'';?>">
                            <?php if (!empty($cust1->getMobileError())): ?>
                                <span class="help-inline"><?php echo $cust1->getMobileError();?></span>
                            <?php endif;?>
                        </div>
                      </div>
                        
                        <div>
                            
                            <p>File</p>
                        <input type="file" required
                            name="Filename"> 
                        <p>Description</p>
                        <textarea rows="10" cols="35" 
                            name="Description"></textarea>
                        <br/>
                            
                        </div>
                        
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Create</button>
                          <a class="btn" href="index.php">Back</a>
                        </div>
                    </form>
                </div>
        
        


                  <script>
                      var _validFileExtensions = [".jpg", ".jpeg", ".gif", ".png"];    
                      function Validate(oForm) {
                          var arrInputs = oForm.getElementsByTagName("input");
                          for (var i = 0; i < arrInputs.length; i++) {
                              var oInput = arrInputs[i];
                              if (oInput.type == "file") {
                                  var sFileName = oInput.value;
                                  if (sFileName.length > 0) {
                                      var blnValid = false;
                                      for (var j = 0; j < _validFileExtensions.length; j++) {
                                          var sCurExtension = _validFileExtensions[j];
                                          if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                                              blnValid = true;
                                              break;
                                          }
                                      }

                                      if (!blnValid) {
                                          alert("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
                                          return false;
                                      }
                                  }
                              }
                          }

                          return true;
                      }
                  </script>
    </div> <!-- /container -->
    
    
  </body>
</html>