<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>

        <br><br>

        <?php
        //1. Get the ID of selected Admin
        $id = $_GET['id'];

        //2. Create SQL Query to Get the details
        $sql = "SELECT * FROM tbl_admin WHERE id=$id";

        //3. Execute the Query
        $res = mysqli_query($conn, $sql);

        //4. Check whether query execute or not
        if ($res == TRUE) {
            //Check data available?
            $count = mysqli_num_rows($res);
            //Check whether we have admin or not
            if ($count == 1) {
                //Get the details
                //echo "Admin Available";
                $row = mysqli_fetch_assoc($res);

                $full_name = $row['full_name'];
                $username = $row['username'];
            } else {
                //Redirect to Manage Admin page
                header("location:" . ADMIN_MANAGE);
            }
        }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name : </td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Username :</td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
    if(isset($_POST['submit']))
    {
        //echo "Button Clicked";
        //1. Get all the values from form to update
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];

        //2. Create sql query to update admin
        $sql = "UPDATE tbl_admin SET
            full_name = '$full_name',
            username = '$username'
            WHERE id = '$id'
        ";

        //3. Execute the query
        $res = mysqli_query($conn, $sql);

        //4. Check if query successfull
        if($res == TRUE)
        {
            //Query successfull
            $_SESSION['update'] = "<div class='success'>Admin updated successfully.</div>";
            //Redirect to manage admin page
            header("location:".ADMIN_MANAGE);
        }
        else{
            $_SESSION['update'] = "<div class='error'>Failed Update Admin.</div>";
            //Redirect to manage admin page
            header("location:".ADMIN_MANAGE);

        }
    }
?>

<?php include('partials/footer.php'); ?>