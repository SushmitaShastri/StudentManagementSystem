<?php include($_SERVER['DOCUMENT_ROOT'].'/studentManagement/db.php');
//get form values
$subjectName = $_POST["subjectName"];
$standard = $_POST["standard"];
$teacherId = $_POST["teacher"];

$insertSql = "insert into teacher_subject (teacherId,subjectName,standard) values ('".$teacherId."','".$subjectName."','".$standard."')";
echo $insertSql;
if (mysqli_query($conn, $insertSql)) 
{
    echo "added!";
    mysqli_close($conn);
    header('Location: /studentManagement/subjectPages/subjectPage.php?success=New teacher assigned');
}
else
{
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    mysqli_close($conn);
    header('Location: /studentManagement/subjectPages/subjectPage.php?error=this combination already exist');
    exit;
}

?>