<?php
$firstName = $_POST["fname"];
$lastName = $_POST["lname"];
$standard = $_POST["standard"];
$oldMailId = $_POST["oldEmail"];
$emailid = $_POST["mail"];
$usnNumber = $_POST["usnNum"];
$rollNumber = $_POST["rollno"];
$userName = $_POST["userName"];
$status=$_POST["status"];
$studentId = $_POST["studentId"];

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
$updateUser="update user set userName='".$userName."', emailid='".$emailid."', status='".$status."' where userId='".$studentId."'";
$updateStudent = "update student set usnNumber='".$usnNumber."' , rollNumber='".$rollNumber."', standard='".$standard."', firstName='".$firstName."', lastName='".$lastName."' where studentId='".$studentId."'";
if (mysqli_query($conn, $updateUser)) 
    {
        if (mysqli_query($conn, $updateStudent))
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
                    header('Location: /studentManagement/studentPages/studentPage.php?success=Student Updated succesfully,password is sent to user via mail');
                    exit;
                } else 
                {
                    header('Location: /studentManagement/studentPages/studentPage.php?error=Student updated, but mail sending failed');
                    exit;
                }
            }
            else
            {
                header('Location: /studentManagement/studentPages/studentPage.php?success=Student Updated succesfully');
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
        header('Location: /studentManagement/studentPages/studentPage.php?error='.$error.' '.$updateUser.'\n'.$updateStudent);
        exit;
    }
    

?>