<?php
    include('../config/constants.php');
    //echo "Delete page";
    //Check wheter the id and image set or not
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //remove the physical image if available
        if($image_name != "")
        {
            //Image exist
            $path = "../images/category/".$image_name;
            //Remove the image
            $remove = unlink($path);

            if($remove==FALSE)
            {
                //Set the session remove error!
                $_SESSION['remove'] = "<div class='error'>Failed to remove image</div>";
                //Redirect to manage
                header('location:'.SITEURL.'admin/manage-category.php');
                //Stop the process
                die();
            }
        }

        //delete data from database
        //Sql query delete data from database
        $sql = "DELETE FROM tbl_category WHERE id=$id";
        
        //
        $res = mysqli_query($conn, $sql);

        //Check data deleted
        if($res==TRUE)
        {
            //Deleted success
            $_SESSION['delete'] = "<div class='success'>Category delete successfully</div>";
            //Redirect to manage category
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else
        {
            //Deleted success
            $_SESSION['delete'] = "<div class='error'>Failed Delete Category</div>";
            //Redirect to manage category
            header('location:'.SITEURL.'admin/manage-category.php');
        }

        //Redirect to manage category with message
    }
    else
    {
        //redirect to manage category
        header('location:'.SITEURL.'admin/manage-category.php');
    }
?>