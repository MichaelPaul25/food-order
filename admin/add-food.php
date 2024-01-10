<?php include('partials/menu.php')?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>

        <br><br>

        <?php 
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

        <table class="tbl-30">
            <tr>
                <td>
                    TItle : 
                </td>
                <td>
                    <input type="text" name="title" placeholder="Title of the food">
                </td>
            </tr>
            <tr>
                <td>Description :</td>
                <td>
                    <textarea name="description" id="" cols="30" rows="5" placeholder="Description of the food"></textarea>
                </td>
            </tr>
            <tr>
                <td>Price: </td>
                <td>
                    Rp. <input type="number" name="price">
                </td>
            </tr>
            <tr>
                <td>Select Image: </td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>
            <tr>
                <td>Category: </td>
                <td>
                    <select name="category">

                        <?php 
                            //Create php code to display category from database
                            //1. Create SQL to get all active category
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                            //Execution query
                            $res = mysqli_query($conn, $sql);

                            //Check wheter we have category or not
                            $count = mysqli_num_rows($res);

                            if($count>0)
                            {
                                //We have category
                                while($row = mysqli_fetch_assoc($res))
                                {
                                    $id = $row['id'];
                                    $title = $row['title'];
                                    ?>
                                        <option value="<?php echo $id;?>"><?php echo $title;?></option>
                                    <?php
                                }
                            }
                            else
                            {
                                //We dont have category
                                ?>
                                <option value="0">No Category Found</option>
                                <?php
                            }

                            //2. Display on description
                        ?>

                    </select>
                </td>
            </tr>
            <tr>
                <td>Featured: </td>
                <td>
                    <input type="radio" name="featured" value="Yes">Yes
                    <input type="radio" name="featured" value="No">No
                </td>
            </tr>
            <tr>
                <td>Active: </td>
                <td>
                    <input type="radio" name="active" value="Yes">Yes
                    <input type="radio" name="active" value="No">No
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                </td>
            </tr>
        </table>
        </form>

    <?php 
        //Check submit button click
        if(isset($_POST['submit']))
        {
            //echo "Add to database";

            //1. Get the data from form
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];
            
            //Check wheather radio button check or not
            if(isset($_POST['featured']))
            {
                $featured = $_POST['featured'];
            }
            else
            {
                //Defaulted value
                $featured = 'No';
            }
            if(isset($_POST['active']))
            {
                $active = $_POST['active'];
            }
            else
            {
                //Defaulted value
                $active = 'No';
            }
            //2. Upload the image if selected
            //Check whether the select image is clicked
            if(isset($_FILES['image']['name']))
            {
                //Get the details of the selected image
                $image_name = $_FILES['image']['name'];

                //Check the image selected or not
                if($image_name != "")
                {
                    //1. Rename the image
                    //Get the extention of selected image(.jpg, .png, .gif, etc)
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
                        header('location:' . SITEURL . 'admin/add-food.php');
                        die();
                    }
                }
            }
            else
            {
                $image_name = ""; //Select image name blank
            }

            //3. Insert into database
            //Create a Sql Query
            $sql2 = "INSERT INTO tbl_food SET
                title = '$title',
                description = '$description',
                price = $price,
                image_name = '$image_name',
                category_id = $category,
                featured = '$featured',
                active = '$active'
            ";

            //Execute the query
            $res2 = mysqli_query($conn, $sql2);

            //Check whether query is success
            if($res2 == true)
            {
                //Data inserted successfully
                $_SESSION['add'] = "<div class='success'>Food Added Successfully</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
            }
            else
            {
                //Failed to add data
                $_SESSION['add'] = "<div class='error'>Failed added the Food</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
            }

            //4. Redirect to Manage food


        }
    ?>

    </div>
</div>


<?php include('partials/footer.php')?>