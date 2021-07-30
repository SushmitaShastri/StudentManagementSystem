<?php 
include($_SERVER['DOCUMENT_ROOT'].'/studentManagement/db.php');
//get form data
$subjectName = $_POST["subjectName"];
$standard = $_POST["standard"];
$teacherId = $_POST["teacher"];
$rowId = $_POST["rowId"];
$update = TRUE;

$check = "SELECT teacherId FROM teacher_subject where teacherId='".$teacherId."' and subjectName='".$subjectName."' and standard='".$standard."'";
$result = mysqli_query($conn, $check);
if (mysqli_num_rows($result) > 0) 
    {
        $update = FALSE;
    }

if($update==TRUE)
{
    $updateSql = "update teacher_subject set teacherId = '".$teacherId."' where rowId = '".$rowId."'";
    echo $updateSql;
    if (mysqli_query($conn, $updateSql)) 
    {
        echo "Record updated successfully";
        mysqli_close($conn);
        header('Location: /studentManagement/subjectPages/subjectPage.php?success=Updated succesfully');
        exit;
    }
    else 
    {
        echo "Error updating record: " . mysqli_error($conn);
        mysqli_close($conn);
        header("Location: /studentManagement/subjectPages/subjectPage.php?error=".mysqli_error($conn));
        exit;
    }
}
else
{
    mysqli_close($conn);
    header('Location: /studentManagement/subjectPages/subjectPage.php?error=Duplicate combination,teacher is already assigned');
    exit;
}
?>