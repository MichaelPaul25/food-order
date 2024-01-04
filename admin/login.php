<?php include('../config/constants.php');?>
<html>

<head>
    <title>Login - Food Order System</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <div class="login">
        <h1 class="text-center">Login</h1>
        <br><br>
        <?php
            if(isset($_SESSION['login']))
            {
                echo $_SESSION['login'];
                unset ($_SESSION['login']);
            }
            if(isset($_SESSION['no-login-message']))
            {
                echo $_SESSION['no-login-message'];
                unset ($_SESSION['no-login-message']);
            }
        ?>
        <br><br>
        <!----Login Form Start here------->
        <form action="" method="POST">
            Username: <br> 
            <input type="text" name="username" placeholder="Enter Username"> <br> <br>

            Password: <br>
            <input type="password" name="password" placeholder="Enter Password"> <br> <br>

            <input type="submit" name="submit" value="login" class="btn-primary">
        </form>
        <!----Login Form End------->
        <p class="text-center">Create By - <a href="https://michaelpaul25.github.io/MyPortofolio.github.io/">Michael Simbolon</a></p>
    </div>
</body>

</html>

<?php
    //Check whether the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        //Process the login
        //1. Get data from login form
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        //2. SQL to check whether the username and password exist
        $sql = "SELECT * FROM tbl_admin WHERE username = '$username' AND password = '$password'";
        
        //3. Execute the query
        $res = mysqli_query($conn, $sql);

        //4. Check whether user exist or not
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
            $_SESSION['user'] = $username;  //Check whether the user logged in or not and logut will unset it
            //Redirect to Home/Dashboard
            header('location:'.SITEURL.'admin/');
        }
        else
        {
            $_SESSION['login'] = "<div class='error text-center'>Username or Password not match.</div>";
            //Redirect to Home/Dashboard
            header('location:'.SITEURL.'admin/login.php');
        }
    }
?>