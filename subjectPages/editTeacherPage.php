<html>
    <head>
        <?php include($_SERVER['DOCUMENT_ROOT'].'/studentManagement/common/bootStrapDataTable.php');?>
    </head>
    <body class="jumbotron">
    <?php include($_SERVER['DOCUMENT_ROOT'].'/studentManagement/common/navbar.php');?>
    <?php
        if($_GET)
        {
            if( isset($_GET['subject']))
            {
                $subject = $_GET['subject'];
            }
            if( isset($_GET['standard']))
            {
                $standard = $_GET['standard'];
            }
            if( isset($_GET['teacherName']))
            {
                $teacherName = $_GET['teacherName'];
            }
            if( isset($_GET['rowId']))
            {
                $rowId = $_GET['rowId'];
            }
        }
        
        ?>
        <div class="container col-md-6">
        <h3>Edit Teacher</h3><br>
            <form action="/studentManagement/navmenu/subject/editTeacher.php" method="post" name="f1">
                <input type="hidden" value="<?php echo $rowId; ?>" name="rowId">
                <div class="form-group">
                    <label for="subjectName"><b>Subject Name:</b></label>
                    <input type="text" class="form-control" id="subjectName" name="subjectName" value="<?php echo $subject;?>" readonly>
                </div>
                <div class="form-group">
                    <label for="standard"><b>Standard:</b></label>
                    <input type="text" class="form-control" id="standard" name="standard" value="<?php echo $standard;?>" readonly>
                </div>
                <div class="form-group">
                    <label for="teacher"><b>Teacher:</b></label>
                    <select name="teacher" id="teacher" class="form-control" required>
                    <?php 
                        if($teacherName=='')
                        {
                            echo "<option value='' selected>Please select</option>";
                        }
                        include($_SERVER['DOCUMENT_ROOT'].'/studentManagement/db.php');
                        $teachers = "select concat(teacher.firstName,' ',teacher.lastName) as teacherName,teacher.teacherId from teacher,user where user.userId=teacher.teacherId and user.status='active'";
                        $result = mysqli_query($conn, $teachers);
                        if (mysqli_num_rows($result) > 0) 
                        {
                            while($row = mysqli_fetch_assoc($result)) 
                            {
                                if($teacherName==$row["teacherName"])
                                {
                                    echo "<option value='".$row["teacherId"]."' selected>".$row["teacherName"]."</option>";
                                }
                                else
                                {
                                    echo "<option value='".$row["teacherId"]."'>".$row["teacherName"]."</option>";
                                }
                            }
                        }
                    ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Update</button>
                <a href="/studentManagement/subjectPages/subjectPage.php"><button type="button" class="btn btn-danger">Cancel</button></a>
            </form>
        </div>
        <?php
        mysqli_close($conn);
        ?>
    </body>
</html>