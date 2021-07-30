<html>
    <head>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/studentManagement/common/bootStrapDataTable.php');?>
    </head>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/studentManagement/common/navbar.php');?><br>
    <?php
        if($_GET)
        {
            if( isset($_GET['standard']))
            {
                $standard = $_GET['standard'];
            }
        }
        include($_SERVER['DOCUMENT_ROOT'].'/studentManagement/db.php');
        //$sql = "SELECT teacher_subject.teacherId,teacher_subject.subjectName,teacher_subject.standard,concat(teacher.firstName,' ',teacher.lastName) as teacherName FROM teacher_subject left join teacher on teacher.teacherId=teacher_subject.teacherId where teacher_subject.standard='".$standard."'";
        //echo $sql;
        $sql = "select teacher_subject.teacherId, teacher_subject.subjectName,teacher_subject.standard,concat(teacher.firstName,' ',teacher.lastName) as teacherName from teacher_subject left join teacher ON teacher_subject.teacherId=teacher.teacherId where teacher_subject.standard='".$standard."'";
        $result = mysqli_query($conn, $sql);?>
<div class="container">
    <table class="table table-striped table-bordered">
    <thead>
        <tr>
        <th scope="col">Subject</th>
        <th scope="col">Teacher</th>
        </tr>
    </thead>
    <tbody>
       <?php if (mysqli_num_rows($result) > 0) 
        {
            while($row = mysqli_fetch_assoc($result)) 
            {
                echo "<tr>";
                echo "<td>".$row["subjectName"]."</td>";
                if($row["teacherName"]=='')
                {
                    echo "<td><i>Not Assigned</i></td>";
                }
                else
                {
                    echo "<td>".$row["teacherName"]."</td>";
                }
                echo "</tr>";
            }
        }?>
    </tbody>
    </table>
    <?php mysqli_close($conn);?>
    <a href='/studentManagement/studentPages/studentPage.php'><button class="btn btn-info">Back</button></a>

</div>
</html>