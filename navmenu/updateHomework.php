<?php
//get form parameters
$rowid = $_POST["rowid"];
$statement=$_POST["statement"];
str_replace("'",'"',$statement);
$update="update assignment set statement=".'"'.$statement.'"'." where rowid='".$rowid."'";
include($_SERVER['DOCUMENT_ROOT'].'/studentManagement/db.php');
if (mysqli_query($conn, $update)) 
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
        header("Location: /studentManagement/subjectPages/subjectPage.php?error=".mysqli_error($conn).' '.$update);
        exit;
    }
?>