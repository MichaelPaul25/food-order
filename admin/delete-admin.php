<?php
    //Include constants.php file here
    include('../config/constants.php');

    //1. Add admin id to delete
    $id = $_GET['id'];
    //2. Create SQLQuery to Delete admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    //3. Execute the Query
    $res = mysqli_query($conn, $sql);

    //Check successfully?
    if($res == TRUE)
    {
        //Query successfully and Admin Deleted
        //echo "Admin Deleted";
        //Create session variable to display message
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully.</div>";
        //Redirect to Manage page
        header('location: '.SITEURL.'admin/manage-admin.php');
    }
    else{
        //Failed Deleted Admin
        //echo "Failed Deleted Admin";
        $_SESSION['delete'] = "<div class='error'>Failed Deleted Admin. Please try again.</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }

    //3. Redirect to Manage Admin page with message(success/error)

?>