<?php include($_SERVER['DOCUMENT_ROOT'].'/studentManagement/db.php');?>
<?php
// fetch form data
    $firstName = $_POST["fname"];
    $lastName = $_POST["lname"];
    $userName = $_POST["uname"];
    $formPassword = $_POST["pswd"];

    echo "first name ".$firstName." last name ".$lastName." user name ".$userName." password ".$password;
    $success = 0;
    // insert to db

    $sql = "INSERT INTO teacher (firstName, lastName, userName, password)
    VALUES ('$firstName', '$lastName','$userName', '$formPassword')";

    if (mysqli_query($conn, $sql)) 
    {
        $success = 1;
        echo "New record created successfully";
    }
     else 
    {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);   
    
    if($success==1)
    {
        header('Location: ../loginForm.php?message=Registered successfully!');
        exit;
    }
    
?>