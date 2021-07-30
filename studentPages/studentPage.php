<html>
    <head>
        <?php include($_SERVER['DOCUMENT_ROOT'].'/studentManagement/common/bootStrapDataTable.php');?>
        <script>
        // function confirmDelete(studentId)
        // {
        //     var dlt = confirm("Are you sure to delete?");
        //     var studentId  = studentId;
        //     if (dlt == true) 
        //     {
        //         window.location.href='/studentManagement/navmenu/deleteUser.php?studentId='+studentId;
        //     }
        // }
        // </script>  
    </head>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/studentManagement/common/navbar.php');?><br>
    <?php if($roleId!=3){ ?>
        <script>
            $(document).ready(function() {
                $('#student').DataTable();
            } );
        </script> 
        <?php }?>
    <div class="container" style="margin-top:80px">
    <h3>Student Page</h3><br>
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
    <?php if($roleId==1){ ?>
    <div>
        <a href='/studentManagement/studentPages/addStudentPage.php'><button class="btn btn-info" style="float:right">Add Student</button></a>
    </div>
    <?php }?>
    <table id="student" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
        <thead>
            <tr>
                <th>Sno</th>
                <th>Standard</th>
                <th>USN</th>
                <th>Student</th>
                <th>Rollno</th>
                <?php if($roleId==1){?>
                <th>UserName</th>
                <?php }?>
                <th>Email</th>
            <?php if($roleId==1){ ?>
                <th>Edit</th>
            <?php }?>
                <th>More Info</th>
            <?php //if($roleId==1){ ?>
                <!-- <th>Delete</th> -->
            <?php //}?>
            </tr>
        </thead>
        <tbody>
    <?php
        if($roleId!=3)
        {
            $sql = "select student.studentId,student.usnNumber, concat(student.firstName,' ',student.lastName) as studentName, student.rollNumber, student.standard,user.userName,user.emailid from student,user where user.userId=student.studentId and user.status='active'";
        }
        else
        {
            $sql = "select student.studentId,student.usnNumber, concat(student.firstName,' ',student.lastName) as studentName, student.rollNumber, student.standard,user.userName,user.emailid from student,user where user.userId=student.studentId and user.userName='".$_SESSION["userName"]."'";
        }
        include($_SERVER['DOCUMENT_ROOT'].'/studentManagement/db.php');
        $count=0;
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) 
        {
            while($row = mysqli_fetch_assoc($result)) 
            {
                $count++;
                echo "<tr>";
                echo "<td>".$count."</td>";
                echo "<td>".$row["standard"]."</td>";
                echo "<td>".$row["usnNumber"]."</td>";
                echo "<td>".$row["studentName"]."</td>";
                echo "<td>".$row["rollNumber"]."</td>";
                if($roleId==1){
                echo "<td>".$row["userName"]."</td>";
                }
                echo "<td>".$row["emailid"]."</td>";
                if($roleId==1){
                    echo "<td><a href='/studentManagement/studentPages/editStudentPage.php?studentId=".$row["studentId"]."'><i class='fa fa-edit'></i></a></td>";
                }
                echo "<td><a href='/studentManagement/studentPages/viewStudentSubjectPage.php?standard=".$row["standard"]."'"."><i class='fas fa-eye'></i></a></td>";    
                //echo "<td><a onClick='confirmDelete(".$row["studentId"].")'><i class='fas fa-trash'></i></a></td>";
                echo "</tr>";
            }
        } 
          mysqli_close($conn);
    ?>
    </table>
    </div>
</html>