<?php
$firstName = $_POST["fname"];
$lastName = $_POST["lname"];
$oldMailId = $_POST["oldEmail"];
$emailid = $_POST["mail"];
$userName = $_POST["userName"];
$status=$_POST["status"];
$teacherId = $_POST["teacherId"];

//check if mailid is modified
if($emailid==$oldMailId)
{
    $sendMail = FALSE;
}
else
{
    $sendMail = TRUE;
}
include($_SERVER['DOCUMENT_ROOT'].'/studentManagement/db.php');
$updateUser="update user set userName='".$userName."', emailid='".$emailid."', status='".$status."' where userId='".$teacherId."'";
$updateTeacher="update teacher set firstName='".$firstName."', lastName='".$lastName."' where teacherId='".$teacherId."'";
if (mysqli_query($conn, $updateUser)) 
    {
        if (mysqli_query($conn, $updateTeacher))
        {
            mysqli_close($conn);
            if($sendMail==TRUE)
            {
                //send password to the student through mail
                $to_email = $emailid;
                $subject = "Userid and password(student management system application)";
                $body = "Dear".$firstName.",<br><br>".
                "You have been added as student to stuent management application, find your credentials below<br>"
                ."<b>Username :</b>".$userName."<br>".
                "<b>Password :</b>".$password."<br><br>".
                "Thank you,<br>";
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= "From: Student Management System";
                
                if (mail($to_email, $subject, $body, $headers)) 
                {
                    header('Location: /studentManagement/teacherPages/teacherPage.php?success=Teacher Updated succesfully,password is sent to user via mail');
                    exit;
                } else 
                {
                    header('Location: /studentManagement/teacherPages/teacherPage.php?error=Teacher updated, but mail sending failed');
                    exit;
                }
            }
            else
            {
                header('Location: /studentManagement/teacherPages/teacherPage.php?success=Teacher Updated succesfully');
                exit;
            }
        }
        else
        {
            mysqli_close($conn);
        }
    }
    else
    {
        $error=mysqli_error($conn);
        mysqli_close($conn);
        header('Location: /studentManagement/teacherPages/teacherPage.php?error='.$error.' '.$updateUser.'\n'.$updateStudent);
        exit;
    }
    

?>