<?php
    // fetch form data
    $currentPassword = $_POST["currentPassword"];
    $newPassword = $_POST["newPassword"];
    session_start();
    $userName = $_SESSION["userName"];
    
    include($_SERVER['DOCUMENT_ROOT'].'/studentManagement/db.php');
    $sql = "select userName from user where userName='".$userName."' and password='".$currentPassword."'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) 
    {
        $update = "update user set password='".$newPassword."' where password='".$currentPassword."' and userName='".$userName."' ";
        if (mysqli_query($conn, $update)) 
        {
            mysqli_close($conn);
            header('Location: /studentManagement/authenticationPages/changePasswordPage.php?success=Password updated succesfully');
            exit;
        }
        else
        {
            $errorMsg = mysqli_error($conn);
            mysqli_close($conn);
            header('Location: /studentManagement/authenticationPages/changePasswordPage.php?error='.$errorMsg);
            exit;
        }
    }
    else
    {
        mysqli_close($conn);
        header('Location: /studentManagement/authenticationPages/changePasswordPage.php?error=current password is wrong');
        exit;
    }

?>