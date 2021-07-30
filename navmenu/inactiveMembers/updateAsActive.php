<?php
$userid = $_GET["userid"];
$update="update user set status='active' where userId='".$userid."'";
include($_SERVER['DOCUMENT_ROOT'].'/studentManagement/db.php');
if (mysqli_query($conn, $update)) 
{
    mysqli_close($conn);
    header('Location: /studentManagement/inactiveMembersPages/inactiveMembersPage.php?success=Member is active now');
    exit;
}
else
{
    $error=mysqli_error($conn);
    mysqli_close($conn);
    header('Location: /studentManagement/inactiveMembersPages/inactiveMembersPage.php?error='.$error);
    exit;
}
?>