<?php 
    //Start session
    session_start();
    //Create Constant to Store Non Repeating Values
    define('SITEURL', 'http://localhost/food-order/');
    define('ADMIN_MANAGE', 'http://localhost/food-order/admin/manage-admin.php');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'food-order');
    
    

    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($conn)); //Database connection
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn)); // Selecting Database
?>