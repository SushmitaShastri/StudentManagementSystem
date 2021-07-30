<html>
    <head>
        <?php include($_SERVER['DOCUMENT_ROOT'].'/studentManagement/common/bootStrap.php');?>
    </head>
<body class="jumbotron">
    <?php include($_SERVER['DOCUMENT_ROOT'].'/studentManagement/common/navbar.php');?>
        <div class="container col-md-6">
        <?php
            if($_GET)
            {
                if( isset($_GET['message']))
                {
                    echo "<div class='alert alert-success'><strong>Success! </strong>". $_GET['message']."</div>";
                }
                else if(isset($_GET['error']))
                {
                    echo "<div class='alert alert-warning'><strong>Error! </strong>". $_GET['error']."</div>";
                }
            }
        ?>
            <h3>Add Teacher</h3><br>
            <form action="/studentManagement/navmenu/teacher/addTeacher.php" method="post" name="f1">
                <div class="form-group">
                    <label for="fname"><b>First Name:</b></label>
                    <input type="text" class="form-control" id="fname" placeholder="Enter first name" name="fname"
                        required>
                </div>
                <div class="form-group">
                    <label for="lname"><b>Last Name:</b></label>
                    <input type="text" class="form-control" id="lname" placeholder="Enter last name" name="lname"
                        required>
                </div>
                <div class="form-group">
                    <label for="mail"><b>Email:</b></label>
                    <input type="text" class="form-control" id="mail" placeholder="Enter proper mail id" name="mail"
                        required>
                </div>
                <div class="form-group">
                    <label for="userName"><b>User name:</b></label>
                    <input type="text" class="form-control" id="userName" placeholder="Enter user name" name="userName"
                        required>
                </div>
                <button type="submit" class="btn btn-success">Add</button>
                <a href="/studentManagement/teacherPages/teacherPage.php"><button type="button" class="btn btn-danger">Cancel</button></a>
            </form>
    </div><br>
</body>
</html>