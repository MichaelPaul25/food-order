<?php include('partials/menu.php') ?>

<?php
if (isset($_GET['id'])) {
    //Get the detail
    $id = $_GET['id'];
    //Query
    $sql2 = "SELECT * FROM tbl_food WHERE id=$id";
    //Execute the query
    $res2 = mysqli_query($conn, $sql2);

    //Get the value to array
    $row2 = mysqli_fetch_assoc($res2);

    //Get the individual value
    $title = $row2['title'];
    $description = $row2['description'];
    $price = $row2['price'];
    $current_image = $row2['image_name'];
    $current_category = $row2['category_id'];
    $featured = $row2['featured'];
    $active = $row2['active'];
} else {
    //Redirect to manage food
    header('location:' . SITEURL . 'admin/manage-food.php');
}
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>

        <br><br>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td>
                        Rp. <input type="number" name="price" value="<?php echo $price; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                        if ($current_image == "") {
                            //Image not available
                            echo "<div class='error'>Image not Available</div>";
                        } else {
                        ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="100px">
                        <?php
                        }
                        ?>

                    </td>
                </tr>

                <tr>
                    <td>Select New Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">

                            <?php
                            $sql = "SELECT * FROM tbl_category WHERE active = 'Yes'";
                            //Execute 
                            $res = mysqli_query($conn, $sql);
                            //Count rows
                            $count = mysqli_num_rows($res);

                            //Check category available or not
                            if ($count > 0) {
                                //Category available
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $category_title = $row['title'];
                                    $category_id = $row['id'];

                                    //echo "<option value='$category_id'>$category_title</option>";
                            ?>
                                    <option <?php if ($current_category == $category_id) {
                                                echo "selected";
                                            } ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                            <?php
                                }
                            } else {
                                //Category not available
                                echo "<option value='0'>Category not available</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
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
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">

                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

        <?php
        //First is buttom submit
        if (isset($_POST['submit'])) {
            //echo "Button click";
            //1. Get all the details from the form
            $id = $_POST['id'];
            $title = $_POST['title'];
            $price = $_POST['price'];
            $current_image = $_POST['current_image'];
            $category = $_POST['category_id'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            //2. Upload the image if selected
            //Check upload button clicked or not
            if (isset($_FILES['image']['name'])) {
                //upload button clicked
                $image_name = $_FILES['image']['name']; //New image name

                //Check if New image selected
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

                    $destination = "../images/food/" . $image_name;

                    //Finally upload the image
                    $upload = move_uploaded_file($source_path, $destination);

                    //Check whether the image is uploaded or not
                    //And if image is not uploaded then we will stop the process and redirect error message
                    if ($upload == false) {
                        //Set message
                        $_SESSION['upload'] = "<div class='error'>Failed to Upload Image. </div>";
                        //Redirect to Add Category Page
                        header('location:' . SITEURL . 'admin/manage-food.php');
                        die();
                    }

                    //3. Remove the current image
                    if ($current_image != "") {
                        $remove_path = "../images/food/" . $current_image;

                        $remove = unlink($remove_path);

                        //Check wheter image remove or not
                        //If failed to remove stop the process
                        if ($remove == false) {
                            $_SESSION['failed-remove'] = "<div class='error'>Failed to remove image</div>";
                            //Redirect to Add Category Page
                            header('location:' . SITEURL . 'admin/manage-food.php');
                            //Stop the process
                            die();
                        }
                    }
                }
            } else {
                $image_name = $current_image;
            }
            //4.Update the food in database
            $sql3 = "UPDATE tbl_food SET
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = '$category',
                    featured = '$featured',
                    active = '$active'
                    WHERE id =$id
                ";

            //Execute the sql
            $res3 = mysqli_query($conn, $sql3);

            //Check whether sql is executed
            if ($sql3 == true) {
                $_SESSION['update'] = "<div class='success'>Food update successfully</div>";
                //Redirect to Add Category Page
                header('location:' . SITEURL . 'admin/manage-food.php');
            } else {
                $_SESSION['update'] = "<div class='error'>Failed update Food</div>";
                //Redirect to Add Category Page
                header('location:' . SITEURL . 'admin/manage-food.php');
            }
        }
        ?>
    </div>
</div>

<?php include('partials/footer.php') ?>