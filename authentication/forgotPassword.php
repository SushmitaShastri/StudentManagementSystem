<?php
$mail = $_POST["mail"];
include($_SERVER['DOCUMENT_ROOT'].'/studentManagement/db.php');
$sql = "select userName from user where emailid='".$mail."'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) 
    {
        //generate new password and update to db
        //generate random password
        $limit = 8; // 8 letters password
        $password = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
        $update = "update user set password='".$password."' where emailid='".$mail."'";
        if(mysqli_query($conn, $update))
        {
            //select username and password to send it through mail
            $sql="select userName,password from user where emailid='".$mail."'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) 
            {
                while($row = $result->fetch_assoc()) 
                {
                    $userName = $row["userName"];
                    $password = $row["password"];
                }
            }

            $to_email = $mail;
            $subject = "Forgot username/password?your credentials are here.";
            $body = "Dear user,<br><br>".
            "Your credentials below<br>"
            ."<b>Username :</b>".$userName."<br>".
            "<b>Password :</b>".$password."<br><br>".
            "Thank you,<br>";
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= "From: Student Management System";
            
            if (mail($to_email, $subject, $body, $headers)) 
            {
                mysqli_close($conn);
                header('Location: /studentManagement/index.php?success=your credentials has been sent to mail');
                exit;
            } else 
            {
                mysqli_close($conn);
                header('Location: /studentManagement/index.php?error=Mail sending failed');
                exit;
            }
        }
    }
else
    {
        mysqli_close($conn);
        header('Location: /studentManagement/authenticationPages/forgotPasswordPage.php?error=no user found registered with entered mailid');
        exit;
    }

?>