<html>
    <head>
        <?php include($_SERVER['DOCUMENT_ROOT'].'/studentManagement/common/bootStrapDataTable.php');?>
        <script>
            $(document).ready(function() {
                $('#student').DataTable();
            } );
        </script> 
        <script>
         $(document).ready(function() {
                $('#teacher').DataTable();
            } );
        </script>
        <script>
        function updateInactiveTch(userid,elementId)
        {
            var status = document.getElementById(elementId).value;
            var userid =userid;
            if(status=='active')
            {
                var dlt = confirm("Are you sure to update this member as active?");
                if (dlt == true)
                {
                    window.location.href='/studentManagement/navmenu/inactiveMembers/updateAsActive.php?userid='+userid;
                }
                else
                {
                    document.getElementById(elementId).selectedIndex = "1";
                }
            }
        }
        </script>
        <script>
        $(document).ready(function(){ 
            $("#myTab li:eq(0) a").tab('show'); // show 2nd tab on page load
        });
        </script>
    </head>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/studentManagement/common/navbar.php');?><br>
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
    <div class="bs-tab">
    <ul class="nav nav-tabs" id="myTab">
        <li class="nav-item">
            <a href="#students" class="nav-link" data-toggle="tab">Students</a>
        </li>
        <li class="nav-item">
            <a href="#teachers" class="nav-link" data-toggle="tab">Teachers</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade" id="students">
        <h4 class="mt-2">Past students</h4>
        <table id="student" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>Sno</th>
                    <th>Standard</th>
                    <th>USN</th>
                    <th>Student</th>
                    <th>Rollno</th>
                    <th>UserName</th>
                    <th>Email</th>
                    <th>Update Status</th> 
                <!-- <?php //if($roleId==1){ ?> -->
                     <!-- <th>Delete</th> -->
                <?php //}?>
                </tr>
            </thead>
            <tbody>
        <?php
            $sql = "select student.studentId,student.usnNumber, concat(student.firstName,' ',student.lastName) as studentName, student.rollNumber, student.standard,user.userName,user.emailid from student,user where user.userId=student.studentId and user.status='inactive'";
            include($_SERVER['DOCUMENT_ROOT'].'/studentManagement/db.php');
            $count=0;
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) 
            {
                while($row = mysqli_fetch_assoc($result)) 
                {
                    $count++;
                    $id = 'status1'.$count;
                    echo "<tr>";
                    echo "<td>".$count."</td>";
                    echo "<td>".$row["standard"]."</td>";
                    echo "<td>".$row["usnNumber"]."</td>";
                    echo "<td>".$row["studentName"]."</td>";
                    echo "<td>".$row["rollNumber"]."</td>";
                    echo "<td>".$row["userName"]."</td>";
                    echo "<td>".$row["emailid"]."</td>";
                    echo "<td><select class='form-control' name='status' id='status1".$count."' onChange='return updateInactiveTch(".$row["studentId"].",".'"'.$id.'"'.")'><option value='active'>Active</option><option value='inactive' selected>Inactive</option></select></td>";
                    echo "</tr>";
                }
            } 
        ?>
        </table>
        </div>
        <div class="tab-pane fade" id="teachers">
            <h4 class="mt-2">Past teachers</h4>
            <?php 
                $sqlTeacher="SELECT concat(teacher.firstName,' ',teacher.lastName) as teacherName,teacher.teacherId,user.userName,user.emailid,user.status FROM teacher,user where teacher.teacherId=user.userId and user.status='inactive'";
            ?>
        <table id="teacher" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
        <thead>
            <tr>
                <th>Sno</th>
                <th>Name</th>
                <th>User name</th>
                <th>Email</th>
                <th>Update Status</th>
            </tr>
        </thead>
        <tbody>
    <?php
        $result = mysqli_query($conn, $sqlTeacher);
        $count=0;
        if (mysqli_num_rows($result) > 0) 
        {
            while($row = mysqli_fetch_assoc($result)) 
            {
                $count++;
                $id = 'status2'.$count;
                echo "<tr>";
                echo "<td>".$count."</td>";
                echo "<td>".$row["teacherName"]."</td>";
                echo "<td>".$row["userName"]."</td>";
                echo "<td>".$row["emailid"]."</td>";
                echo "<td><select class='form-control' name='status' id='status2".$count."' onChange='return updateInactiveTch(".$row["teacherId"].",".'"'.$id.'"'.")'>".
                "<option value='active'>Active</option>".
                "<option value='inactive' selected>Inactive</option>".
                "</select></td>";
                echo "</tr>";
            }
        }
          
          mysqli_close($conn);
    ?>
    </table>
    </div>
    </div>
</div>
    
    </div>
</html>