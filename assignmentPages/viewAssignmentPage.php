<html>
    <head>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/studentManagement/common/bootStrapDataTable.php');?>
    <script>
            $(document).ready(function() {
                $('#viewAssignment').DataTable();
            } );
        </script>
    </head>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/studentManagement/common/navbar.php');?><br>
    <?php
        include($_SERVER['DOCUMENT_ROOT'].'/studentManagement/db.php');
        //$sql = "SELECT teacher_subject.teacherId,teacher_subject.subjectName,teacher_subject.standard,concat(teacher.firstName,' ',teacher.lastName) as teacherName FROM teacher_subject left join teacher on teacher.teacherId=teacher_subject.teacherId where teacher_subject.standard='".$standard."'";
        //echo $sql;
        if($roleId==3)
        {
            $getStudDetail="select standard from student where studentId='".$sessionUserId."'";
            $studentId=$sessionUserId;
            $standardResult = mysqli_query($conn,$getStudDetail);
            $standardRow = mysqli_fetch_assoc($standardResult);
            $standard=$standardRow["standard"];
            $sql = "select concat(teacher.firstName,' ',teacher.lastName) as teacherName,assignment.rowid, assignment_status.status,assignment.statement,assignment.subject,assignment.standard,assignment.teacherId,assignment_status.studentId from assignment left join assignment_status on assignment_status.rowid=assignment.rowid and assignment_status.studentid=".$sessionUserId." inner join teacher on teacher.teacherId=assignment.teacherId inner join user on user.userId=teacher.teacherId where assignment.standard=".$standard." and user.status='active'";
            //echo $sql;
        }
        if($roleId==2)
        {
            $sql = "select assignment.rowid,assignment_status.studentId,assignment.teacherId,assignment.statement,assignment.subject,assignment.standard,assignment_status.studentid,concat(student.firstName,' ',student.lastName) as studentName, assignment_status.status from assignment left join assignment_status on assignment_status.rowid=assignment.rowid left join student on student.studentId=assignment_status.studentid where assignment.teacherId='".$sessionUserId."'";
            //echo $sql;
        }
        $result = mysqli_query($conn, $sql);?>
<div class="container">
<?php
    if($_GET)
    {
        if( isset($_GET['success']))
        {
            echo "<div class='alert alert-success'><strong>Success! </strong>". $_GET['success']."</div>";
        }
        if(isset($_GET['error']))
        {
            echo "<div class='alert alert-warning'><strong>Error! </strong>". $_GET['error']."</div>";
        }
    }
    ?>
    <table id="viewAssignment" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
    <thead>
        <tr>
        <th scope="col">Subject</th>
        <?php if($roleId==3){ ?>
        <th scope="col">Teacher</th>
        <?php }?>
        <?php if($roleId==2){ ?>
        <th scope="col">Student</th>
        <th scope="col">Standard</th>
        <?php }?>
        <th scope="col">Assignment</th>
        <th scope="col">Status</th>
        </tr>
    </thead>
    <tbody>
       <?php if (mysqli_num_rows($result) > 0) 
        {
            while($row = mysqli_fetch_assoc($result)) 
            {
                echo "<tr>";
                echo "<td>".$row["subject"]."</td>";
                if($roleId==3)
                {
                    if($row["teacherName"]=='')
                    {
                        echo "<td><i>Not Assigned</i></td>";
                    }
                    else
                    {
                        echo "<td>".$row["teacherName"]."</td>";
                    }
                }
                if($roleId==2)
                {
                    if($row["studentName"]=='')
                    {
                        echo "<td><i>No student has done</i></td>";
                        echo "<td>".$row["standard"]."</td>";
                    }
                    else
                    {
                        echo "<td>".$row["studentName"]."</td>";
                        echo "<td>".$row["standard"]."</td>";
                    }
                }
                echo "<td><pre>".$row["statement"]."</pre></td>";
                if($roleId==2)
                {
                    $studentId=$row["studentId"];
                }
                if($row["status"]==0)
                    {
                        if($roleId==2)
                        {
                            if($row["studentName"]=='')
                            {
                                echo "<td></td>";
                            }
                            else
                            {
                                echo "<td>".
                                "<a href='/studentManagement/navmenu/assignment/updateAssignmentStatus.php?rowid=".$row["rowid"]."&status=".$row["status"]."&studentId=".$studentId."'>".
                                "<button class='btn btn-success' data-toggle='tooltip' title='Are you done with assignment?click here'>".
                                "<i class='fas fa-check'></i> Done</button></a></td>";
                            }
                        }
                        else
                        {
                            echo "<td>".
                                "<a href='/studentManagement/navmenu/assignment/updateAssignmentStatus.php?rowid=".$row["rowid"]."&status=".$row["status"]."&studentId=".$studentId."'>".
                                "<button class='btn btn-success' data-toggle='tooltip' title='Are you done with assignment?click here'>".
                                "<i class='fas fa-check'></i> Done</button></a></td>";
                        }
                        
                    }
                if($row["status"]==1)
                    {
                        echo "<td>".
                        "<a href='/studentManagement/navmenu/assignment/updateAssignmentStatus.php?rowid=".$row["rowid"]."&status=".$row["status"]."&studentId=".$studentId."'>".
                        "<button class='btn btn-danger' data-toggle='tooltip' title='Have not completed your assignment?Click here'><i class='fa fa-times'></i> Not yet</button></a></td>";
                    }
                echo "</tr>";
            }
        }?>
    </tbody>
    </table>
    <?php mysqli_close($conn);?>
</div>
</html>