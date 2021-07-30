<html>
    <head>
        <link rel="stylesheet" type="text/css" href="/studentManagement/cssFiles/common.css">
    </head>
<?php 
    session_start();
    $roleId = $_SESSION["role"];
    $sessionUserId = $_SESSION["sessionUserId"];
?>
<nav class="navbar navbar-expand-sm bg-primary navbar-dark fixed-top">
<a class="navbar-brand">StudentManagement</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
    </button>
    <div id="navbarNavDropdown" class="navbar-collapse collapse">
        <ul class="navbar-nav mr-auto">
            <?php if($roleId==1 || $roleId==2 || $roleId==3){ ?>
            <li class="nav-item">
                <a class="nav-link" href="/studentManagement/studentPages/studentPage.php">Student</a>
            </li>
            <?php }
            ?>
            <?php if($roleId==1){ ?>
            <li class="nav-item">
                <a class="nav-link" href="/studentManagement/teacherPages/teacherPage.php">Teacher</a>
            </li>
            <?php } ?>
            <?php if($roleId==1 || $roleId==2){ ?>
            <li class="nav-item">
                <a class="nav-link" href="/studentManagement/subjectPages/subjectPage.php">Subject</a>
            </li>
            <?php } if($roleId==1){ ?>
            <li class="nav-item">
                <a class="nav-link" href="/studentManagement/inactiveMembersPages/inactiveMembersPage.php">InactiveMembers</a>
            </li>
            <?php } if($roleId==2 || $roleId==3){?>
            <li class="nav-item">
                <a class="nav-link" href="/studentManagement/assignmentPages/viewAssignmentPage.php">Assignment_status</a>
            </li>
            <?php }?>
        </ul>
        <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <?php
                        if(isset($_SESSION["userName"]))
                        {
                            echo $_SESSION["userName"];
                        }
                        else
                        {
                            header('Location: /studentManagement/index.php?notFound=You have not logged in!');
                            exit;
                        }
                        ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink" style="float:left;">
                        <a class="dropdown-item" href="/studentManagement/authenticationPages/changePasswordPage.php">Change Password</a>
                        <a class="dropdown-item" href="/studentManagement/authentication/logout.php">Logout</a>
                    </div>
                </li>
            </ul>
    </div>
</nav>
</html>