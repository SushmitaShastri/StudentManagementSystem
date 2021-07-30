<html>
    <head>
        <?php include($_SERVER['DOCUMENT_ROOT'].'/studentManagement/common/bootStrapDataTable.php');?>
        <script>
            $(document).ready(function() {
                $('#homework').DataTable();
            } );
        </script>
    </head>
<body>
<?php
    //get standard and subject
    $standard = $_GET['standard'];
    $subject = $_GET['subject'];
    $teacherId = $_GET['teacherId'];
?>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/studentManagement/common/navbar.php');?>
    <div class="container" style="margin-top:80px">
        <h3>Subject Page</h3><br>
        <table id="homework" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>Sno</th>
                    <th>Standard</th>
                    <th>Subject</th>
                    <th>Assignment</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <?php
            include($_SERVER['DOCUMENT_ROOT'].'/studentManagement/db.php');
            $sql="select rowid,statement,subject,standard from assignment where teacherId='".$teacherId."' and subject='".$subject."' and standard='".$standard."'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) 
            {
                $count = 0;
                while($row = mysqli_fetch_assoc($result)) 
                {
                    $count++;
                    echo "<tr>";
                    echo "<td>".$count."</td>";
                    echo "<td>".$row["standard"]."</td>";
                    echo "<td>".$row["subject"]."</td>";
                    echo "<td><pre>".$row["statement"]."</pre></td>";  
                    echo "<td>".
                        "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#statement".$row["rowid"]."'><i class='fas fa-edit'></i> Edit</button>";?>
                    <div id="<?php echo "statement".$row["rowid"];?>" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <form name="f1" action="/studentManagement/navmenu/updateHomework.php" method="post">
                        <div class="modal-body">
                            <input type="hidden" name="rowid" value="<?php echo $row["rowid"];?>">
                            <textarea name="statement"><?php echo $row["statement"]; ?></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Update</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </form>
                        </div>
                        </div>
                    </div>
                    </div>  
                    <?php 
                    echo "</td>";
                    echo "</tr>";
                }
            }
            mysqli_close($conn);
            ?>
        </table>
    </div>
</body>
</html>