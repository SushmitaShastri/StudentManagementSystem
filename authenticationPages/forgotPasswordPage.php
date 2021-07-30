<html>
    <head>
        <?php include($_SERVER['DOCUMENT_ROOT'].'/studentManagement/common/bootStrap.php');?>
    </head>
<body class="jumbotron">
    <!-- <div class="jumbotron"> -->
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
            <h3>Forgot credentials</h3><br>
            <form action="/studentManagement/authentication/forgotPassword.php" method="post" name="f1">
                <div class="form-group">
                    <p><i>Forgot Credentials? Enter your email id, we'll send you an email soon with username and a new password.</i></p>
                    <input type="email" class="form-control" id="mail" placeholder="Enter your mail id" name="mail"
                        required>
                </div>
                <button type="submit" class="btn btn-success">Send Mail</button>
                <a href="/studentManagement/index.php"><button type="button" class="btn btn-danger">Cancel</button></a>
            </form>
        <!-- </div> -->
    </div><br>
</body>
</html>