<?php include('partials/menu.php')?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>

        <br><br>

        <!----Add Category Form------>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Title :</td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
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
        if(isset($_POST['submit']))
        {
            //echo "Clicked";

            //1. Get the value from category form
            $title = $_POST['title'];

            //For radio input type need to check whether button selected or not
            if(isset($_POST['featured']))
            {
                //Get the value
                $featured = $_POST['featured'];
            }
            else
            {
                //Set the default value
                $featured = "No";
            }
            if(isset($_POST['active']))
            {
                //Get the value
                $active = $_POST['active'];
            }
            else
            {
                //Set the default value
                $active = "No";
            }
        }
    ?>

</div>

<?php include('partials/footer.php')?>

<?php

?>