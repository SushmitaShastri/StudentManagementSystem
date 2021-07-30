<?php include($_SERVER['DOCUMENT_ROOT'].'/studentManagement/db.php');
//get form values
$subjectName = $_POST["subjectName"];
$standard = $_POST["standard"];
$insert= TRUE;
$seachForDuplicate="SELECT * FROM teacher_subject where standard=".$standard." and subjectName='".$subjectName."' and teacherId is NULL";
$result = mysqli_query($conn, $seachForDuplicate);
if (mysqli_num_rows($result) > 0) 
    {
        $insert = FALSE;
    }
if($insert==TRUE)
{
    $insertSub = "insert into teacher_subject (subjectName,standard) value ('".$subjectName."','".$standard."')";
    if (mysqli_query($conn, $insertSub)) 
    {
        echo "added!";
        mysqli_close($conn);
        header('Location: /studentManagement/subjectPages/subjectPage.php?success=New subject added');
        exit;
    }
    else
    {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        mysqli_close($conn);
    }
}
else
{
    mysqli_close($conn);
    header('Location: /studentManagement/subjectPages/subjectPage.php?error=Duplicate combination of the subject');
    exit;
}
?>