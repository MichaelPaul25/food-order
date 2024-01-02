<?php include('partials/menu.php'); ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br><br>

        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name :</td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter Your Name">
                    </td>
                </tr>
                <tr>
                    <td>Username :</td>
                    <td>
                        <input type="text" name="username" placeholder="Your UserName">
                    </td>
                </tr>
                <tr>
                    <td>Password :</td>
                    <td>
                        <input type="password" name="password" placeholder="Your Password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>

</div>

<?php include('partials/footer.php'); ?>

<?php
//Process The Value From form and save it in database
//Check whether the submit button is clicked or not?

if (isset($_POST['submit'])) {
    //Button Clicked

    //1. Get data from form
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); //Password Enscription with MD5

    //2. SQL Query to save data to database
    $sql = "INSERT INTO tbl_admin SET
            full_name = '$full_name',
            username = '$username',
            password = '$password'
        ";

    //3. Execute the query and sent it to database
    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    //4. Check whethr the data is inserted or not and display approriate message
    if ($res == TRUE) {
        //Successful insert data
        //echo "Data Inserted!";
        //Create session variable to display the message
        $_SESSION['add'] = "Admin Added Successfully";
        //Redirect to Admin Manage page
        header("location:" . SITEURL . 'admin/manage-admin.php');
    } else {
        //echo "Data inserted failed!";
        //Create session variable to display the message
        $_SESSION['add'] = "Failed Added Admin";
        //Redirect to Add admin page
        header("location:" . SITEURL . 'admin/add-admin.php');
    }
}
?>