<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Food</h1>

        <br /><br>
                <!--Button to add admin--->
                <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>
                <br /><br>

                <?php
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }
                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }
                    if(isset($_SESSION['upload']))
                    {
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    }
                    if(isset($_SESSION['unauthorized']))
                    {
                        echo $_SESSION['unauthorized'];
                        unset($_SESSION['unauthorized']);
                    }
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                ?>

                <table class="tbl-full">
                    <tr>
                        <th>S.N</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>action</th>
                    </tr>
                    <?php
                        //Create SQL query to get all food
                        $sql = "SELECT * FROM tbl_food";

                        //Execute the query
                        $res = mysqli_query($conn, $sql);

                        //Count the rows
                        $count = mysqli_num_rows($res);

                        //Create serial number
                        $sn =1;

                        if($count>0)
                        {
                            //We have food in database
                            //Get the food from database and display
                            while($row = mysqli_fetch_assoc($res))
                            {
                                //Get the value from individual column
                                $id = $row['id'];
                                $title = $row['title'];
                                $price = $row['price'];
                                $image_name = $row['image_name'];
                                $featured = $row['featured'];
                                $active = $row['active'];

                                ?>
                                <tr>
                                <td><?php echo $sn++;?>.</td>
                                <td><?php echo $title;?></td>
                                <td><?php echo $price;?></td>
                                <td><?php 
                                    //Check image available or not
                                    if($image_name != "")
                                    {
                                        //Display the image
                                        ?>

                                        <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name;?>" width="100px">

                                        <?php
                                    }
                                    else
                                    {
                                        //Display the message
                                        echo "<div class='error'>Image not added!</div>";
                                    }
                                ?></td>
                                <td><?php echo $featured;?></td>
                                <td><?php echo $active;?></td>
                                <td>
                                <a href="<?php echo SITEURL;?>admin/update-food.php?id=<?php echo $id;?>" class="btn-secondary">Update Food</a>
                                <a href="<?php echo SITEURL;?>admin/delete-food.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>" class="btn-danger">Delete Food</a>   
                                </td>
                                </tr>

                                <?php
                            }
                        }
                        else
                        {
                            //Food not added
                            echo "<tr><td coldspan='7' class='error'>Food not added yet.</td></tr>";
                        }
                    ?>
                   
                    
                </table>
    </div>
</div>

<?php include('partials/footer.php');?>