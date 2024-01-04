<?php
    //Include constanta.php for SITEURL
    include('../config/constants.php');
    //1. Destroy the Session 
    session_destroy();  //Unset $_SESSION['user']
    //2. Redirect to login page
    header('location:'.SITEURL.'admin/login.php');
?>