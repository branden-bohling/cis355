<?php
    require 'database.php';

// connect to database
$pdo = Database::connect();


// list all uploads in database 
// ORDER BY BINARY filename ASC (sorts case-sensitive, like Linux)
echo '<br><br>All files in database...<br><br>';
$sql = 'SELECT * FROM customers ' 
    . 'ORDER BY BINARY imagename ASC;';

foreach ($pdo->query($sql) as $row) {
    $id = $row['id'];
    $sql = "SELECT * FROM customers where id=$id"; 
    echo $row['id'] . ' - ' . $row['imagename'] . '<br>' . $row['imagepath'] .  '<br>' .
        $row['imagedescription'] 
        . '<img width=100 src="data:image/jpeg;base64,'
        . base64_encode( $row['image'] ).'"/>'
        . '<br><br>';
}
echo '<br><br>';

// disconnect
Database::disconnect(); 
