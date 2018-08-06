<?php
    session_start();
    require 'database.php';
    if ($_GET){
        $errorMessage = $_GET['errorMessage'];
    }
    else{
        $errorMessage = '';
    }
    if($_POST){
          $success = false;
          $username = $_POST["username"];
          $password = $_POST["password"];
          //$password = MD5($password);
          
          $sql = "SELECT * FROM persons WHERE email = '$username' AND password = '$password' LIMIT 1";
          
          $pdo = Database::connect();
          $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $q = $pdo->prepare($sql);
          $q->execute(array());
          $data = $q->fetch(PDO::FETCH_ASSOC);
          
          if($data){
              $_SESSION["username"] = $username;
              header("Location: success.php ");
          }
          else{
              header("Location: login.php?errorMessage=Invalid");
          }
    }
?>
<h1> Log In </h1>
<form class="form-horizontal" action="login.php" method="post">
        <input name="username" type="text"  placeholder="me@email.com" required="" >
        <input name="password" type="password" required >
        <button type="submit" class="btn btn-success">Sign in</button>
        <a href ='logout.php'> Log out </a>
        
        <p style='color: red'> <?php echo $errorMessage ?> </p>

</form>
