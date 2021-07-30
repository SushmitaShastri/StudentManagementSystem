<html>
    <head>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/studentManagement/common/bootStrapDataTable.php');?>
    </head>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/studentManagement/common/navbar.php');?>
    <?php
        if($_GET)
        {
            if(isset($_GET['subject']))
            {
                $subject = $_GET['subject'];
                $standard = $_GET['standard'];
            }
            if(isset($_GET['error']))
            {
                echo "<div class='alert alert-warning'><strong>Error! </strong>". $_GET['error']."</div>";
            }
            
        }
        include($_SERVER['DOCUMENT_ROOT'].'/studentManagement/db.php');
        $sql = "select concat(teacher.firstName,' ',teacher.lastName) as teacherName,teacher.teacherId from teacher,user where teacherId not IN (select teacherId from teacher_subject where subjectName='".$subject."' and standard='".$standard."')  and user.status='active' and user.userId=teacher.teacherId";
        $result = mysqli_query($conn, $sql);?>
<body class="jumbotron">
    <div class="container col-md-6">
    <h3>Assign Teacher</h3><br>
    <form action="/studentManagement/navmenu/subject/assignTeacher.php" method="post" name="f1">
        <div class="form-group">
            <label for="subjectName"><b>Subject Name:</b></label>
            <input type="text" class="form-control" id="subjectName" placeholder="Enter first name" name="subjectName" value="<?php echo $subject; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="standard"><b>Standard:</b></label>
            <input type="text" class="form-control" id="standard" placeholder="Enter first name" name="standard" value="<?php echo $standard; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="teacher"><b>Teacher:</b></label>
            <select name="teacher" id="teacher" class="form-control" required>
            <option value=''>Please select</option>
            <?php
            if (mysqli_num_rows($result) > 0) 
            {
                while($row = mysqli_fetch_assoc($result)) 
                {
                    echo "<option value='".$row['teacherId']."'>".$row['teacherName']."</option>";
                }
            }
            ?>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Assign</button>
        <a href='/studentManagement/subjectPages/subjectPage.php'><button type="button" class="btn btn-info">Back</button></a>
    </form>        
    <?php mysqli_close($conn);?>
    </div>
</body>
</html>