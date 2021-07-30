<?php include($_SERVER['DOCUMENT_ROOT'].'/studentManagement/db.php');?>
<?php 
    $userName = $_POST["uname"];
    $password = $_POST["pswd"];
    $success = 0;
    $userNameLower = strtolower($userName);
    echo "username ".$userName." password ".$password;

    $sql = "SELECT roleId,userName,userId FROM user where lower(userName)="."'".$userNameLower."'"." and password="."'".$password."' and status='active'";
    echo $sql;
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $success = 1;
        while($row = $result->fetch_assoc()) 
        {
          $userNameDb =  $row["userName"];
          $roleId = $row["roleId"];
          $sessionUserId=$row["userId"];
        }
        session_start();
        $_SESSION["userNameDb"] = $userName;
        $_SESSION["userName"] = $userNameDb;
        $_SESSION["role"] = $roleId;
        $_SESSION["sessionUserId"] = $sessionUserId;
      } else {
        echo "0 results";
      }
      
      mysqli_close($conn);

      if($success==1)
      {
        header('Location: /studentManagement/studentPages/studentPage.php');
        exit; 
      }
      else if($success==0)
      {
        header('Location: /studentManagement/index.php?notFound=No user found with given username and password!');
        exit;
      }

?>