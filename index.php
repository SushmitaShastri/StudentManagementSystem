<!DOCTYPE html>
<html>
<head>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/studentManagement/common/bootStrap.php');?>
    <link rel="stylesheet" type="text/css" href="cssFiles/authForm.css">
</head>
<title>StudentManagement</title>

<body class="bg-img"><br><br> 
    <div class="container col-md-5">
    <?php
    if($_GET)
    {
        if( isset($_GET['success'])){
            //$message = $_GET['message'];// print_r($_GET);      
            // echo "<h4 style='color:green;text-align:center'><i>" . $_GET['message'] . "</i></h4>"; 
            echo "<div class='alert alert-success'><strong>Success!</strong>". $_GET['success']."</div>";
        }
        else if(isset($_GET['notFound'])){
            echo "<div class='alert alert-warning'>". $_GET['notFound']."</div>";
        }
    }
    
    ?>
        <div style="margin:auto;">
            <!-- <div class="jumbotron"> -->
            <h2>Login Form</h2>
            <hr>
            <form action="authentication/login.php" method="post">
                <div class="form-group">
                    <label for="uname"><b>Username:</b></label>
                    <input type="text" class="form-control" id="uname" placeholder="Enter username" name="uname"
                        required>
                </div>
                <div class="form-group">
                    <label for="pswd"><b>Password:</b></label>
                    <input type="password" class="form-control" id="pswd" placeholder="Enter password" name="pswd"
                        required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <!-- </div> -->
        </div><br>
        <p style="float:right;font-size:14px;"><a href="/studentManagement/authenticationPages/forgotPasswordPage.php">Forgot username/password?</a></p><br>
    </div>

</body>

</html>