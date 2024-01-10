<?php 
    include('../config/constants.php');
    //echo "Delete food";

    if(isset($_GET['id']) && isset($_GET['image_name']))
    {
        //Process to Delete
        //echo "Proces to delete";

        //1. Get ID and image name
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //2. Remove the image id available
        //Check whether the image is available or not and delete
        if($image_name!="")
        {
            //Get the image folder
            $path = "../images/food/".$image_name;

            //Remove image 
            $remove = unlink($path);

            //Check if image successfull remove or not
            if($remove == false)
            {
                //Failed to Remove image
                $_SESSION['upload'] = "<div class='error'>Failed to remove image</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
                //Stop the process
                die();

            }
        }

        //3. Delete food from database
        $sql = "DELETE FROM tbl_food WHERE id =$id";

        //Execute the query
        $res = mysqli_query($conn, $sql);
        
        //4. Redirect to manage food page
        //Check the query is executed or not
        if($res==true)
        {
            //Delete food successfully
            $_SESSION['delete'] = "<div class='success'>Food delete successfully</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else
        {
            //Failed to delete food
            $_SESSION['delete'] = "<div class='error'>Failed to delete Food</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }

        
    }
    else
    {
        //Redirect to Manage Food page
        //echo "Redirect ";
        $_SESSION['unauthorized'] = "<div class='error'>Unauthorized Access</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }
?>