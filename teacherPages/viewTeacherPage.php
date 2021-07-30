<html>
    <head>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/studentManagement/common/bootStrapDataTable.php');?>
    </head>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/studentManagement/common/navbar.php');?><br>
    <?php
        if($_GET)
        {
            if( isset($_GET['teacherId']))
            {
                $teacherId = $_GET['teacherId'];
            }
        }
        include($_SERVER['DOCUMENT_ROOT'].'/studentManagement/db.php');
        //$sql = "select stud_subject.subject,sub_teacher.teacherId,concat(teacher.firstName,' ',teacher.lastName) as subjectTeacher from stud_subject,sub_teacher,teacher where studentId = '".$studentId."' and sub_teacher.subject=stud_subject.subject and teacher.teacherId=sub_teacher.teacherId";
        // $sql = "SELECT student_subject.studentId,student_subject.subjectName,student.standard,teacher_subject.teacherId,concat(teacher.firstName,' ',teacher.lastName) as teacherName FROM student_subject,student,teacher_subject,teacher where student_subject.studentId="."'".$studentId."'"." and student.studentId=student_subject.studentId and teacher_subject.subjectName=student_subject.subjectName and teacher_subject.standard=student.standard and teacher_subject.teacherId=teacher.teacherId";
        $sql = "select subjectName,standard from teacher_subject where teacherId='".$teacherId."'";
        //echo $sql;
        $result = mysqli_query($conn, $sql);?>
<div class="container">
    <table class="table table-striped table-bordered">
    <thead>
        <tr>
        <th scope="col">Standard</th>
        <th scope="col">Subject</th>
        </tr>
    </thead>
    <tbody>
       <?php if (mysqli_num_rows($result) > 0) 
        {
            while($row = mysqli_fetch_assoc($result)) 
            {
                echo "<tr>";
                echo "<td>".$row["standard"]."</td>";
                echo "<td>".$row["subjectName"]."</td>";
                echo "</tr>";
            }
        }
        ?>
    </tbody>
    </table>
    <?php mysqli_close($conn);?>
    <a href='/studentManagement/teacherPages/teacherPage.php'><button class="btn btn-info">Back</button></a>
</div>
</html>