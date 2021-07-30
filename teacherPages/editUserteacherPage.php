<html>
    <head>
        <?php include($_SERVER['DOCUMENT_ROOT'].'/studentManagement/common/bootStrap.php');?>
        <script>
        function confirmInactive()
        {
            var status = document.getElementById("status").value;
            if(status=='inactive')
            {
                var cnfrm = confirm("Are you sure to inactivate user?");
                if (cnfrm != true)
                {
                    document.getElementById("status").selectedIndex = "0";
                }
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
        if( isset($_GET['message'])){
            echo "<div class='alert alert-success'><strong>Success! </strong>". $_GET['message']."</div>";
        }
        else if(isset($_GET['error'])){
            echo "<div class='alert alert-warning'><strong>Error! </strong>". $_GET['error']."</div>";
        }
        $teacherId = $_GET['teacherId'];
        $sql="SELECT teacher.firstName,user.status,teacher.lastName,teacher.teacherId,user.userName,user.emailid FROM teacher,user where teacher.teacherId=user.userId and teacherId='".$teacherId."'";
        //echo $sql;
        include($_SERVER['DOCUMENT_ROOT'].'/studentManagement/db.php');
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
    }
    ?>
            <h3>Edit Teacher</h3><br>
            <form action="/studentManagement/navmenu/teacher/editUserTeacher.php" method="post" name="f1">
                <div class="form-group">
                    <input type="hidden" name="teacherId" value="<?php echo $teacherId; ?>">
                    <label for="fname"><b>First Name:</b></label>
                    <input type="text" class="form-control" id="fname" placeholder="Enter first name" name="fname"
                        value="<?php echo $row["firstName"]; ?>" required>
                </div>
                <div class="form-group">
                    <label for="lname"><b>Last Name:</b></label>
                    <input type="text" class="form-control" id="lname" placeholder="Enter last name" name="lname"
                    value="<?php echo $row["lastName"]; ?>"  required>
                </div>
                <div class="form-group">
                    <label for="mail"><b>Email:</b></label>
                    <input type="hidden" name="oldEmail" value="<?php echo $row["emailid"]; ?>">
                    <input type="email" class="form-control" id="mail" placeholder="Enter proper mail id" name="mail"
                    value="<?php echo $row["emailid"]; ?>" required>
                </div>
                <div class="form-group">
                    <label for="userName"><b>User name:</b></label>
                    <input type="text" class="form-control" id="userName" placeholder="Enter user name" name="userName"
                    value="<?php echo $row["userName"]; ?>" required>
                </div>
                <div class="form-group">
                    <label for="status"><b>Status:</b></label>
                    <div class="dropdown">
                    <?php
                    $activeSelected='';
                    $inactiveSelected='';
                        if($row["status"]=='active')
                        {
                            $activeSelected = "selected";
                        }
                        else
                        {
                            $inactiveSelected = "selected";
                        }
                    ?>
                    <select name="status" onChange="return confirmInactive()" id="status" class="form-control" required>
                        <option value="active" <?php echo $activeSelected; ?> >Active</option>
                        <option value="inactive" <?php echo $inactiveSelected; ?>>Inactive</option>
                    </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Update</button>
                <a href="/studentManagement/teacherPages/teacherPage.php"><button type="button" class="btn btn-danger">Cancel</button></a>
            </form>
            <?php mysqli_close($conn);?>
    </div><br>
</body>
</html>