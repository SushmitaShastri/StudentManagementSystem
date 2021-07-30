<?php include($_SERVER['DOCUMENT_ROOT'].'/studentManagement/db.php');

$firstName = $_POST["fname"];
$lastName = $_POST["lname"];
$standard = $_POST["standard"];
$emailid = $_POST["mail"];
$usnNumber = $_POST["usnNum"];
$rollNumber = $_POST["rollno"];
$userName = $_POST["userName"];
$sudentId='';
$userAdded = FALSE;
$studentAdded = FALSE;

//generate random password
$limit = 8; // 8 letters password
$password = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
// echo $firstName,' ',$lastName,' ',$standard,' ',$usnNumber,' ',$userName,' ',$password;
$sqlUser = "insert into user (roleId,userName,password,emailid) values('3','".$userName."','".$password."','".$emailid."');";
echo $sqlUser,"<br>";
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
    header('Location: /studentManagement/studentPages/addStudentPage.php?error='.$errorMsg);
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
      $sudentId =  $row["userId"];
    }
}

//insert to student table
$insertToStudent = "insert into student (usnNumber,studentId,rollNumber,standard,firstName,lastName) values ('".$usnNumber."','".$sudentId."','".$rollNumber."','".$standard."','".$firstName."','".$lastName."');";
echo $insertToStudent,"<br>";
if (mysqli_query($conn, $insertToStudent)) 
{
    $studentAdded = TRUE;
    echo "student added!";
}
else
{
    $errorMsg = mysqli_error($conn);
    mysqli_close($conn);
    header('Location: /studentManagement/studentPages/addStudentPage.php?error='.$errorMsg);
    exit;
}
mysqli_close($conn);

if($userAdded==TRUE and $studentAdded==TRUE)
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
        header('Location: /studentManagement/studentPages/studentPage.php?success=Student added succesfully,password is sent to user via mail');
        exit;
    } else 
    {
        header('Location: /studentManagement/studentPages/studentPage.php?error=Student added, but mail sending failed');
        exit;
    }
    
}
?>