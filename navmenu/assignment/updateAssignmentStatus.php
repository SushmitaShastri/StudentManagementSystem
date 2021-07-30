<?php
//get url parameters
$rowid = $_GET["rowid"];
$status = $_GET["status"];
$studentId=$_GET["studentId"];
include($_SERVER['DOCUMENT_ROOT'].'/studentManagement/db.php');
$sqlAssignment = "select status from assignment_status where rowid='".$rowid."' and studentid='".$studentId."'";
$result = mysqli_query($conn, $sqlAssignment);
//toggle status value
if($status!=1)
{
    $status=1;
    echo "status value(inside status not equal to one) ".$status;
}
else if($status==1)
{
    $status=0;
    echo "status value(inside status equal to one) ".$status;
}
if (mysqli_num_rows($result) > 0) 
{
    $query = "update assignment_status set status='".$status."' where rowid='".$rowid."' and studentid='".$studentId."'";
}
else
{
    $query="insert into assignment_status (rowid,studentid,status) VALUES ('".$rowid."','".$studentId."','".$status."')";
}


    if (mysqli_query($conn, $query)) 
    {
        mysqli_close($conn);
        header('Location: /studentManagement/assignmentPages/viewAssignmentPage.php?success=Updated succesfully');
        exit;
    }
    else 
    {
        $error = mysqli_error($conn);
        mysqli_close($conn);
        header("Location: /studentManagement/assignmentPages/viewAssignmentPage.php?error=".$error.' '.$query);
        exit;
    }

?>