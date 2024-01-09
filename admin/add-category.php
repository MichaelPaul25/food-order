<?php include('partials/menu.php') ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>

        <br><br>

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

        ?>

        <!----Add Category Form------>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title :</td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured : </td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active : </td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <!----Add Category Form End------>
    </div>
    <?php
    if (isset($_POST['submit'])) {
        //echo "Clicked";

        //1. Get the value from category form
        $title = $_POST['title'];

        //For radio input type need to check whether button selected or not
        if (isset($_POST['featured'])) {
            //Get the value
            $featured = $_POST['featured'];
        } else {
            //Set the default value
            $featured = "No";
        }
        if (isset($_POST['active'])) {
            //Get the value
            $active = $_POST['active'];
        } else {
            //Set the default value
            $active = "No";
        }
        //Check wheter image selected or not
        //print_r($_FILES['image']);

        //die(); //break code here
        if (isset($_FILES['image']['name'])) {
            //Upload the image
            //To upload the image we need image name, source path
            $image_name = $_FILES['image']['name'];

            //If image selected
            if ($image_name != "") {

                //Auto rename the image
                //Get the extension out image(jpg, png, gif, etc) e.g. "food1.jpg"
                $ext = end(explode('.', $image_name));

                //set time zone
                date_default_timezone_set('Asia/Jakarta');

                //Rename the image
                $image_name = "Food_Category" . date("Y-m-d h-i-sa", time()) . '.' . $ext; //e.g. Food_Category_xxx.jpg

                $source_path = $_FILES['image']['tmp_name'];

                $destination = "../images/category/" . $image_name;

                //Finally upload the image
                $upload = move_uploaded_file($source_path, $destination);

                //Check whether the image is uploaded or not
                //And if image is not uploaded then we will stop the process and redirect error message
                if ($upload == false) {
                    //Set message
                    $_SESSION['upload'] = "<div class='error'>Failed to Upload Image. </div>";
                    //Redirect to Add Category Page
                    header('location:' . SITEURL . 'admin/add-category.php');
                    die();
                }
            }
        } else {
            //Not upload image and set the image_name value as blank
            $image_name = "";
        }

        //2. Create sql query
        $sql = "INSERT INTO tbl_category SET
                title = '$title',
                image_name='$image_name',
                featured= '$featured',
                active = '$active'";

        //3. Execute the query
        $res = mysqli_query($conn, $sql);

        //4. Check if the query execute and data added or not
        if ($res == true) {
            //Query Executed Category add
            $_SESSION['add'] = "<div class = success>Category Added Successfuly</div>";
            //Redirect to manage category page
            header('location:' . SITEURL . 'admin/manage-category.php');
        } else {
            //Failed to Add Category
            $_SESSION['add'] = "<div class = error>Failed to add Category</div>";
            //Redirect to manage category page
            header('location:' . SITEURL . 'admin/manage-category.php');
        }
    }
    ?>

</div>

<?php include('partials/footer.php') ?>

<?php

?>