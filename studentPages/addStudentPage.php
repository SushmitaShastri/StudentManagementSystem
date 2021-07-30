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
        if( isset($_GET['message'])){
            echo "<div class='alert alert-success'><strong>Success! </strong>". $_GET['message']."</div>";
        }
        else if(isset($_GET['error'])){
            echo "<div class='alert alert-warning'><strong>Error! </strong>". $_GET['error']."</div>";
        }
    }
    ?>
            <h3>Add Student</h3><br>
            <form action="/studentManagement/navmenu/student/addStudent.php" method="post" name="f1">
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
                    <input type="email" class="form-control" id="mail" placeholder="Enter proper mail id" name="mail"
                        required>
                </div>
                <div class="form-group">
                    <label for="standard"><b>Standard:</b></label>
                    <input type="number" min='1' max='12' class="form-control" id="standard" placeholder="Enter class" name="standard"
                        required>
                </div>
                <div class="form-group">
                    <label for="usnNum"><b>USN number:</b></label>
                    <input type="text" class="form-control" id="usnNum" placeholder="Enter usn number" name="usnNum"
                        required>
                </div>
                <div class="form-group">
                    <label for="rollno"><b>Roll number:</b></label>
                    <input type="number" min='0' class="form-control" id="rollno" placeholder="Enter roll number" name="rollno"
                        required>
                </div>
                <div class="form-group">
                    <label for="userName"><b>User name:</b></label>
                    <input type="text" class="form-control" id="userName" placeholder="Enter user name" name="userName"
                        required>
                </div>
                <!-- <div class="form-group">
                    <label for="status"><b>Status:</b></label>
                    <div class="dropdown">
                    <select name="status" id="status" class="form-control" required>
                        <option value="active">Active</option>
                        <option value="inactive">In-active</option>
                    </select>
                    </div>
                </div> -->
                <button type="submit" class="btn btn-success">Add</button>
                <a href="/studentManagement/studentPages/studentPage.php"><button type="button" class="btn btn-danger">Cancel</button></a>
            </form>
    </div><br>
</body>
</html>