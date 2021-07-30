<?php
include($_SERVER['DOCUMENT_ROOT'].'/studentManagement/db.php');
$rowId = $_GET["rowId"];
$deleteSubject = "delete from teacher_subject where rowId='".$rowId."'";
if (mysqli_query($conn, $deleteSubject)) 
    {
        echo "Record deleted successfully";
        mysqli_close($conn);
        header('Location: /studentManagement/subjectPages/subjectPage.php?success=Deleted succesfully');
        exit;
    }else 
    {
        echo "Error deleting record: " . mysqli_error($conn);
        mysqli_close($conn);
    }
?>