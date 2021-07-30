<html>
    <head>
        <?php include($_SERVER['DOCUMENT_ROOT'].'/studentManagement/common/bootStrap.php');?>
        <script>
        function pass_validation() {
            var firstpassword = document.f1.newPassword.value;
            var secondpassword = document.f1.confirmPassword.value;
            if (firstpassword == secondpassword) {
                return true;
            }
            else {
                alert("password and re-entered must be same!");
                return false;
            }
        } 
    </script>
    </head>
<body class="jumbotron">
    <?php include($_SERVER['DOCUMENT_ROOT'].'/studentManagement/common/navbar.php');?>
        <div class="container col-md-6">
        <?php
            if($_GET)
            {
                if( isset($_GET['success']))
                {
                    echo "<div class='alert alert-success'><strong>Success! </strong>". $_GET['success']."</div>";
                }
                else if(isset($_GET['error']))
                {
                    echo "<div class='alert alert-warning'><strong>Error! </strong>". $_GET['error']."</div>";
                }
            }
        ?>
            <h3>Edit password</h3><br>
            <form action="/studentManagement/authentication/changePassword.php" onsubmit="return pass_validation()" method="post" name="f1">
                <div class="form-group">
                    <label for="currentPassword"><b>Current password:</b></label>
                    <input type="password" class="form-control" id="currentPassword" placeholder="Enter current password" name="currentPassword"
                        required>
                </div>
                <div class="form-group">
                    <label for="newPassword"><b>New password:</b></label>
                    <input type="password" class="form-control" id="newPassword" placeholder="Enter new password" name="newPassword"
                        required>
                </div>
                <div class="form-group">
                    <label for="confirmPassword"><b>Confirm new password:</b></label>
                    <input type="password" class="form-control" id="confirmPassword" placeholder="Re-enter new password" name="confirmPassword"
                        required>
                </div>
                <button type="submit" class="btn btn-success">Update</button>
                <a href="/studentManagement/studentPages/studentPage.php"><button type="button" class="btn btn-danger">Cancel</button></a>
            </form>
    </div><br>
</body>
</html>