<html>

<head>
    <title>Login - Food Order System</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <div class="login">
        <h1 class="text-center">Login</h1>
        <br><br>
        <!----Login Form Start here------->
        <form action="" method="POST">
            Username: <br> 
            <input type="text" name="username" placeholder="Enter Username"> <br> <br>

            Password: <br>
            <input type="text" name="password" placeholder="Enter Password"> <br> <br>

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
        $password = $_POST['password'];

        //2. SQL to check whether the username and password exist
        $sql = "SELECT * FROM tbl_admin
            WHERE username = '$username AND password = '$password'";
        
        //3. Execute the query
        $res = mysqli_query($conn, $sql);
    }
?>