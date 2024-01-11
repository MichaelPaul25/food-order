<?php include('partial-front/menu.php')?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="food-search.html" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            
            <?php 
                //Create sql query to display categories from database
                $sql ="SELECT * FROM tbl_category WHERE active='Yes' AND featured ='Yes' LIMIT 3";
                
                //Execute the query
                $res = mysqli_query($conn, $sql);
                //Count rows to check whether category is available or not
                $count = mysqli_num_rows($res);
                
                if($count>0)
                {
                    //Categories available
                    while($row=mysqli_fetch_assoc(($res)))
                    {
                        //Get the values like title like id, title, image_name
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>

                            <a href="category-foods.html">
                            <div class="box-3 float-container">
                                <?php 
                                    //Check wheter image available or not
                                    if($image_name=="")
                                    {
                                        //Display message image not available
                                        echo "<div class='error'>Image not Available</div>";
                                    }
                                    else
                                    {
                                        //Image available
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>
                            
                                <h3 class="float-text text-white"><?php echo $title; ?></h3>
                            </div>
                            </a>

                        <?php
                    }
                }
                else
                {
                    //Category not available
                    echo "<div class='error'>Category not added</div>";
                }
            ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
            //Getting foods from database that are active and featured
            //SQL Query
            $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";

            //Execute the query
            $res2 = mysqli_query($conn, $sql2);

            //count the row
            $count = mysqli_num_rows($res2);

            //Check whether food available or not
            if($count>0)
            {
                //Food available
                while($row=mysqli_fetch_assoc($res2))
                {
                    //Get all the vallues
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
                    ?>

                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php 
                                //Check wheter image available or not
                                if($image_name=="")
                                {
                                    //Image not available
                                    echo "<div class='error'>Image not available</div>";
                                }
                                else
                                {
                                    //Image available
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">

                                    <?php
                                }
                            ?>
                        </div>
                    
                        <div class="food-menu-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="food-price">Rp. <?php echo $price; ?></p>
                            <p class="food-detail">
                            <?php echo $description; ?>
                            </p>
                            <br>
                    
                            <a href="order.html" class="btn btn-primary">Order Now</a>
                        </div>
                    </div>

<?php
                }

            }
            else
            {
                //Food not available
                echo  "<div class='error'>Food not available</div>";;
            }
            ?>

            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partial-front/footer.php')?>