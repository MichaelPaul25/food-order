<?php include('partials/menu.php'); ?>

<!------ Main Contenct Section Start------>
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Admin</h1>
        <br />

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];  //Displaying session message
            unset($_SESSION['add']); // Removing session message
        }
        if(isset($_SESSION['delete'])){
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if(isset($_SESSION['update'])){
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        if(isset($_SESSION['user-not-found']))
        {
            echo $_SESSION['user-not-found'];
            unset($_SESSION['user-not-found']);
        }
        if(isset($_SESSION['pwd-not-match']))
        {
            echo $_SESSION['pwd-not-match'];
            unset($_SESSION['pwd-not-match']);
        }
        if(isset($_SESSION['change-pwd']))
        {
            echo $_SESSION['change-pwd'];
            unset($_SESSION['change-pwd']);
        }
        ?>
        <br /><br><br>

        <!--Button to add admin--->
        <a href="../admin/add-admin.php" class="btn-primary">Add Admin</a>
        <br /><br>

        <table class="tbl-full">
            <tr>
                <th>Serial Number</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>

            <?php
            //Query to get the data from tbl_admin
            $sql = "SELECT * FROM tbl_admin";
            $res = mysqli_query($conn, $sql);

            //Check wheter the query is execute or not
            if ($res == TRUE) {
                //COunt rows to check data from database
                $count = mysqli_num_rows($res); //Get all rows from database

                $sn =1;

                if ($count > 0) {
                    //WE have data in database
                    while ($rows = mysqli_fetch_assoc($res)) {
                        //Using while loop to get data from database
                        //And while loop will run as long as we hava data from DB

                        //Get individual data
                        $id = $rows['id'];
                        $full_name = $rows['full_name'];
                        $username = $rows['username'];

                        //Display the value in table
            ?>
                        <tr>
                            <td><?php echo $sn++; ?>.</td>
                            <td><?php echo $full_name; ?></td>
                            <td><?php echo $username; ?></td>
                            <td>
                                <a href="<?php echo SITEURL;?>admin/update-password.php?id=<?php echo $id;?>" class="btn-primary">Change Password</a>
                                <a href="<?php echo SITEURL;?>admin/update-admin.php?id=<?php echo $id;?>" class="btn-secondary">Update Admin</a>
                                <a href="<?php echo SITEURL;?>admin/delete-admin.php?id=<?php echo $id;?>" class="btn-danger">Delete Admin</a>
                            </td>
                        </tr>

            <?php
                    }
                } else {
                    //We dont have data in database
                }
            }
            ?>
        </table>
    </div>
</div>
<!------ Main Contenct Section End------>

<?php include('partials/footer.php'); ?>