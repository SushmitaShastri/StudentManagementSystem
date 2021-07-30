<?php
    $standard = $_POST["standard"];
    $subject = $_POST["subject"];
    $assignment = $_POST["assignment"];
    $teacherId = $_POST["teacherId"];
    str_replace('"',"'",$assignment);
    include($_SERVER['DOCUMENT_ROOT'].'/studentManagement/db.php');
    $sql = "insert into assignment (teacherId,statement,subject,standard) values('$teacherId',".'"'.$assignment.'"'.",'$subject','$standard')";
    if (mysqli_query($conn, $sql)) 
    {
        mysqli_close($conn);
        header('Location: /studentManagement/subjectPages/subjectPage.php?success=assignement added succesfully');
        exit;
    }
    else
    {
        $error = mysqli_error($conn);
        mysqli_close($conn);
        header('Location: /studentManagement/subjectPages/subjectPage.php?error='.$error.'\n'.$sql);
        exit;
    }
?>