<?php include($_SERVER['DOCUMENT_ROOT'].'/studentManagement/db.php');
$firstName = $_POST["fname"];
$lastName = $_POST["lname"];
$userName = $_POST["userName"];
$emailid = $_POST["mail"];
$teacherId = '';

$userAdded = FALSE;
$teacherAdded = FALSE;
//generate random password
$limit = 8; // 8 letters password
$password = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
$sqlUser = "insert into user (roleId,userName,password,emailid) values('2','".$userName."','".$password."','".$emailid."');";
if (mysqli_query($conn, $sqlUser)) 
{
    $userAdded = TRUE;
    echo "User added!";
}
else
{
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    $errorMsg = mysqli_error($conn);
    mysqli_close($conn);
    header('Location: /studentManagement/teacherPages/addTeacherPage.php?error='.$errorMsg);
    exit;
}
//select userid
$getUserId = "select userId from user where userName = '".$userName."' and  password = '".$password."'";
echo $getUserId,"<br>";
$result = mysqli_query($conn, $getUserId);
if (mysqli_num_rows($result) > 0) 
{
    while($row = $result->fetch_assoc()) 
    {
      $teacherId =  $row["userId"];
    }
}

//insert to teacher table
$insertToStudent = "insert into teacher (teacherId,firstName,lastName) values ('".$teacherId."','".$firstName."','".$lastName."')";
echo $insertToStudent,"<br>";
if (mysqli_query($conn, $insertToStudent)) 
{
    $teacherAdded = TRUE;
    echo "teacher added!";
}
else
{
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
if($userAdded==TRUE and $teacherAdded==TRUE)
{
    $to_email = $emailid;
    $subject = "Userid and password(student management system application)";
    $body = "Dear".$firstName.",<br><br>".
    "You have been added as teacher to stuent management application, find your credentials below<br>"
    ."<b>Username :</b>".$userName."<br>".
    "<b>Password :</b>".$password."<br><br>".
    "Thank you,<br>";
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: Student Management System";
    
    if (mail($to_email, $subject, $body, $headers)) 
    {
        header('Location: /studentManagement/teacherPages/teacherPage.php?success=Teacher added succesfully,password is sent to user via mail');
        exit;
    } else 
    {
        header('Location: /studentManagement/teacherPages/teacherPage.php?error=Teacher is added, but password sending to mail is failed');
        exit;
    }

}

?>