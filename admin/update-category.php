<?php include('partials/menu.php') ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>

        <br><br>

        <?php
        //Check the id is exist or not
        if ($_GET['id']) {
            //Get id and detail
            $id = $_GET['id'];

            //Create sql query to get data
            $sql = "SELECT * FROM tbl_category WHERE id = $id";

            //Execute the query
            $res = mysqli_query($conn, $sql);

            //Count the row result
            $count = mysqli_num_rows($res);

            if ($count == 1) {
                //Get all data from DB
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $current_image = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];
            } else {
                $_SESSION['no-category-found'] = "<div class='error'>Category not found!</div>";
                //Redirect to manage category
                header('location:' . SITEURL . 'admin/manage-category.php');
            }
        } else {
            //Redirect to manage category
            header('location:' . SITEURL . 'admin/manage-category.php');
        }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>
                        Title :
                    </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                        if ($current_image != "") {
                            //Display image
                        ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="100px">
                        <?php
                        } else {
                            //Display message
                            echo "<div class='error'>Image not added.</div>";
                        }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New Image :</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if ($featured == "Yes") {
                                    echo "checked";
                                } ?> type="radio" name="featured" value="Yes">Yes
                        <input <?php if ($featured == "No") {
                                    echo "checked";
                                } ?> type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if ($active == "Yes") {
                                    echo "checked";
                                } ?> type="radio" name="active" value="Yes">Yes

                        <input <?php if ($active == "No") {
                                    echo "checked";
                                } ?> type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            //echo "Clicked";
            //Get all the value
            $id = $_POST['id'];
            $title = $_POST['title'];
            $current_image = $_POST['current_image'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            //2. Updating new image if selected
            //Check whether image is selected or not
            if (isset($_FILES['image']['name'])) {
                //Get the image detail
                $image_name = $_FILES['image']['name'];

                //Check image available or not
                if ($image_name != "") {
                    //Image available
                    //Upload the new image
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
                        header('location:' . SITEURL . 'admin/manage-category.php');
                        die();
                    }

                    //Remove the current image
                    if($current_image !="")
                    {
                        $remove_path = "../images/category/".$current_image;
    
                        $remove = unlink($remove_path);
    
                        //Check wheter image remove or not
                        //If failed to remove stop the process
                        if($remove == false)
                        {
                            $_SESSION['failed-remove'] = "<div class='error'>Failed to remove image</div>";
                            //Redirect to Add Category Page
                            header('location:' . SITEURL . 'admin/manage-category.php');
                            //Stop the process
                            die();
                        }

                    }

                } else {
                    $image_name = $current_image;
                }
            } else {
                $image_name = $current_image;
            }

            //3. Update the database
            $sql2 = "UPDATE tbl_category SET
                title = '$title',
                image_name = '$image_name',
                featured = '$featured',
                active = '$active'
                WHERE id = $id
            ";

            //Execute the query
            $res2 = mysqli_query($conn, $sql2);

            //Check query execute or not
            if ($res2 == TRUE) {
                $_SESSION['update'] = "<div class='success'>Update successfully!</div>";
                //Redirect to manage category
                header('location:' . SITEURL . 'admin/manage-category.php');
            } else {
                $_SESSION['update'] = "<div class='error'>Failed Update data!</div>";
                //Redirect to manage category
                header('location:' . SITEURL . 'admin/manage-category.php');
            }


            //4. Redirect to manage category
        }
        ?>
    </div>
</div>

<?php include('partials/footer.php') ?>