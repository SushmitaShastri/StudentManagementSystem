<html>
    <head>
        <?php include($_SERVER['DOCUMENT_ROOT'].'/studentManagement/common/bootStrapDataTable.php');?>
        <script>
            $(document).ready(function() {
                $('#teacher').DataTable();
            } );
        </script>   
    </head>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/studentManagement/common/navbar.php');?><br>
    
    <div class="container" style="margin-top:80px">
    <h3>Teacher Page</h3><br>
    <?php
    if($_GET)
    {
        if( isset($_GET['success']))
        {
            echo "<div class='alert alert-success'><strong>Success! </strong>". $_GET['success']."</div>";
        }
        if( isset($_GET['error']))
        {
            echo "<div class='alert alert-warning'><strong>Error! </strong>". $_GET['error']."</div>";
        }
    }
    ?>
    <?php if($roleId == 1){ ?>
    <div style="float:right">
        <a href='/studentManagement/teacherPages/addTeacherPage.php'><button class="btn btn-info">Add Teacher</button></a>
    </div>
    <?php }?>
    <table id="teacher" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
        <thead>
            <tr>
                <th>Sno</th>
                <th>Name</th>
            <?php if($roleId==1){?>
                <th>User name</th>
            <?php }?>
                <th>Email</th>
            <?php if($roleId==1){?>
                <th>Update</th>
            <?php }?>
                <th>More Info</th>
            </tr>
        </thead>
        <tbody>
    <?php
        include($_SERVER['DOCUMENT_ROOT'].'/studentManagement/db.php');
        $sql = "SELECT concat(teacher.firstName,' ',teacher.lastName) as teacherName,teacher.teacherId,user.userName,user.emailid FROM teacher,user where teacher.teacherId=user.userId and user.status='active'";
        $result = mysqli_query($conn, $sql);
        $count=0;
        if (mysqli_num_rows($result) > 0) 
        {
            while($row = mysqli_fetch_assoc($result)) 
            {
                $count++;
                echo "<tr>";
                echo "<td>".$count."</td>";
                echo "<td>".$row["teacherName"]."</td>";
                if($roleId==1){
                echo "<td>".$row["userName"]."</td>";
                }
                echo "<td>".$row["emailid"]."</td>";
                if($roleId==1){
                echo "<td><a href='/studentManagement/teacherPages/editUserteacherPage.php?teacherId=".$row["teacherId"]."'"."><i class='fa fa-edit'></i></a></td>";
                }
                echo "<td><a href='/studentManagement/teacherPages/viewTeacherPage.php?teacherId=".$row["teacherId"]."'"."><i class='fas fa-eye'></i></a></td>";
                echo "</tr>";
            }
        }
          
          mysqli_close($conn);
    ?>
    </table>
    </div>
</html>