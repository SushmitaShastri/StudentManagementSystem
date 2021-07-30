<html>
    <head>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/studentManagement/common/bootStrapDataTable.php');?>
        <script>
            $(document).ready(function() {
                $('#subject').DataTable();
            } );
        </script>
        <script>
        function confirmDelete(rowId)
        {
            var dlt = confirm("Are you sure to delete?");
            var rowId  = rowId;
            if (dlt == true) 
            {
                window.location.href='/studentManagement/navmenu/subject/deleteSubject.php?rowId='+rowId;
            }
        }
        </script>
    </head>
    <body>
        <?php include($_SERVER['DOCUMENT_ROOT'].'/studentManagement/common/navbar.php');?>
        
        <div class="container" style="margin-top:80px">
        <h3>Subject Page</h3><br>
        <?php
        if($_GET)
        {
            if( isset($_GET['success'])){ 
                echo "<div class='alert alert-success'><strong>Success! </strong>". $_GET['success']."</div>";
            }
            else if(isset($_GET['error'])){
                echo "<div class='alert alert-warning'><strong>Error! </strong>". $_GET['error']."</div>";
            }
        }
        ?>
        <?php if($roleId==1){?>
            <div style="float:right">
                <a href='/studentManagement/subjectPages/addSubjectPage.php'><button class="btn btn-info">Add Subject</button></a>
            </div>
        <?php }?>
            <table id="subject" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>Sno</th>
                        <th>Subject name</th>
                        <th>Standard</th>
                        <th>Teacher</th>
                    <?php if($roleId==1){ ?>
                        <th>Assign Teacher</th>
                        <th>Update</th>
                        <th>Delete</th>
                    <?php }?>
                    <?php if($roleId==2){ ?>
                        <th>Assignment</th>
                    <?php }?>
                    </tr>
                </thead>
                <tbody>
                <?php
                    include($_SERVER['DOCUMENT_ROOT'].'/studentManagement/db.php');
                    $sql = "SELECT user.userName,user.status,teacher_subject.rowId,teacher_subject.subjectName,teacher_subject.standard,teacher_subject.teacherId,concat(teacher.firstName,' ',teacher.lastName) as teacherName FROM teacher_subject LEFT JOIN teacher ON teacher.teacherId= teacher_subject.teacherId LEFT JOIN user ON user.userId=teacher.teacherId";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) 
                    {
                        $count = 0;
                        while($row = mysqli_fetch_assoc($result)) 
                        {
                            $count = $count+1;
                            echo "<tr>";
                            echo "<td>".$count."</td>";
                            echo "<td>".$row["subjectName"]."</td>";
                            echo "<td>".$row["standard"]."</td>";
                            if($row["status"]=='inactive')
                            {
                                $row["teacherName"]='';
                                echo "<td></td>";
                            }else
                            {
                                echo "<td>".$row["teacherName"]."</td>";
                            }
                            if($roleId==1)
                            {
                                if($row["teacherName"]=='')
                                {
                                    $cursorProperty = 'not-allowed';
                                    $tooltip='Please assign to edit it';
                                    $disabled = 'disabled';
                                    echo "<td><a  href='/studentManagement/subjectPages/editTeacherPage.php?subject=".$row["subjectName"]."&standard=".$row["standard"]."&teacherName=".$row["teacherName"]."&rowId=".$row["rowId"]."'><i class='fas fa-file'></i></a></td>";
                                    echo"<td></td>";
                                }
                                else
                                {
                                    $href="/studentManagement/subjectPages/editTeacherPage.php?subject=".$row["subjectName"]."&standard=".$row["standard"]."&teacherName=".$row["teacherName"]."&rowId=".$row["rowId"];
                                    $cursorProperty='';
                                    $tooltip='';
                                    echo "<td><a href='/studentManagement/subjectPages/assignTeacherPage.php?subject=".$row["subjectName"]."&standard=".$row["standard"]."'><i class='fas fa-plus'></i></a></td>";
                                    $disabled = '';
                                    echo "<td><a ".$disabled."  href="."'".$href."'"."><i class='fas fa-edit'></i></a></td>";
                                }
                                if($row["teacherName"]=='')
                                {
                                    echo "<td><a onClick="."confirmDelete("."'".$row["rowId"]."'".")><i class='fas fa-trash'></i></a></td>";
                                }
                                else
                                {
                                    echo "<td></td>";
                                }

                            }
                            if($roleId==2)
                            {
                                echo "<td>";
                                if($row["userName"]==$_SESSION["userName"])
                                {
                                    echo "<a href='/studentManagement/assignmentPages/assignHomeworkPage.php?subject=".$row["subjectName"]."&standard=".$row["standard"]."&teacherId=".$row["teacherId"]."'><button style='margin-right:5px' class='btn btn-primary'><i class='fas fa-file'></i> Add</button></a>";
                                    echo "<a href='/studentManagement/assignmentPages/viewHomeworkPage.php?subject=".$row["subjectName"]."&standard=".$row["standard"]."&teacherId=".$row["teacherId"]."'><button class='btn btn-primary'><i class='fas fa-list'></i> List</button></a>";
                                }
                                echo "</td>";
                            }
                            echo "</tr>";
                        }
                    }
                    mysqli_close($conn);
                ?>
                </tbody>
            </table>
        </div>
    </body>
</html>