<html>
    <head>
        <?php include($_SERVER['DOCUMENT_ROOT'].'/studentManagement/common/bootStrap.php');?>
    </head>
<body class="jumbotron">
    <?php include($_SERVER['DOCUMENT_ROOT'].'/studentManagement/common/navbar.php');?>
        <div class="container col-md-6">
        <?php
    if($_GET)
    {
        if( isset($_GET['message'])){
            echo "<div class='alert alert-success'><strong>Success! </strong>". $_GET['message']."</div>";
        }
        else if(isset($_GET['error'])){
            echo "<div class='alert alert-warning'><strong>Error! </strong>". $_GET['error']."</div>";
        }
    }
    ?>
            <h3>Add Subject</h3><br>
            <form action="/studentManagement/navmenu/subject/addSubject.php" method="post" name="f1">
                <div class="form-group">
                    <label for="subjectName"><b>Subject Name:</b></label>
                    <input type="text" class="form-control" id="subjectName" placeholder="Enter Subject name" name="subjectName"
                        required>
                </div>
                <div class="form-group">
                    <label for="standard"><b>Standard:</b></label>
                    <input type="number" min='1' max='12' class="form-control" id="standard" placeholder="Enter class" name="standard"
                        required>
                </div>
                <button type="submit" class="btn btn-success">Add</button>
                <a href="/studentManagement/subjectPages/subjectPage.php"><button type="button" class="btn btn-danger">Cancel</button></a>
            </form>
        </div>
</body>