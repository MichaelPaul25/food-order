<?php include('partials/menu.php'); ?>

        <!------ Main Contenct Section Start------>
        <div class="main-content">
            <div class="wrapper">
                <h1>Manage Admin</h1>
                <br /><br>
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
                    <tr>
                        <td>1.</td>
                        <td>Michael</td>
                        <td>michael25</td>
                        <td>
                        <a href="#" class="btn-secondary">Update Admin</a>
                        <a href="#" class="btn-danger">Delete Admin</a>   
                        </td>
                    </tr>
                    <tr>
                        <td>2.</td>
                        <td>Michael</td>
                        <td>michael25</td>
                        <td>
                        <a href="#" class="btn-secondary">Update Admin</a>
                        <a href="#" class="btn-danger">Delete Admin</a> 
                        </td>
                    </tr>
                    <tr>
                        <td>3.</td>
                        <td>Michael</td>
                        <td>michael25</td>
                        <td>
                        <a href="#" class="btn-secondary">Update Admin</a>
                        <a href="#" class="btn-danger">Delete Admin</a> 
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <!------ Main Contenct Section End------>

<?php include('partials/footer.php'); ?>