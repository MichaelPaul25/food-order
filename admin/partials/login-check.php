<?php
    //Authorization - Access Control
    //Check whether the user is login or not
    if(!isset($_SESSION['user'])) //If user Session not set
    {
        //User not logged in
        //Redirect to login page with message
        $_SESSION['no-login-message'] = "<div class='error text-center'>Please login to access Admin page.</div>";
        //Redirect to login page
        header('location:'.SITEURL.'admin/login.php');
    }
?>