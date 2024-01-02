<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>

        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Current Password : </td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password">
                    </td>
                </tr>
                <tr>
                    <td>New Password :</td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password">
                    </td>
                </tr>
                <tr>
                    <td>Confirm Password :</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>

<?php
if (isset($_POST['submit'])) {
    //1. Get data from Form
    $id = $_POST['id'];
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);

    //2. Check Wheter the user with current ID and current user is Exist or Not
    $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password ='$current_password'";
    //Execute the query
    $res = mysqli_query($conn, $sql);
    if ($res == TRUE) {
        //Check if data available
        $count = mysqli_num_rows($res);

        if ($count == 1) {
            //User Exist and password
            //echo "User Found";
            //Check whether new password and confirm password match or not
            if ($new_password == $confirm_password) {
                //Update password
                $sql2 = "UPDATE tbl_admin SET
                        password = '$new_password'
                        WHERE id ='$id'
                    ";

                //Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                //Check if execute
                if ($res2 == TRUE) {
                    //Successfully
                    $_SESSION['change-pwd'] = "<div class='success'>Password Changed Successfully </div>";
                    //Redirecting
                    header("location:" . ADMIN_MANAGE);
                } else {
                    //Failed
                    $_SESSION['change-pwd'] = "<div class='error'>Password Changed Failed </div>";
                    //Redirecting
                    header("location:" . ADMIN_MANAGE);
                }
            } else {
                //Redirect to Manage Admin page
                $_SESSION['pwd-not-match'] = "<div class='error'>Password not match! </div>";
                //Redirecting
                header("location:" . ADMIN_MANAGE);
            }
        } else {
            //User does not exist and redirect
            $_SESSION['user-not-found'] = "<div class='error'>User Not Found. </div>";
            //Redirecting
            header("location:" . ADMIN_MANAGE);
        }
    }
    //3. Check wheter the New Password and Confirm Password is Match or not

    //4. Change password if all above is true
}
?>

<?php include('partials/footer.php'); ?>