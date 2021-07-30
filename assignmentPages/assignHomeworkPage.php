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
                if( isset($_GET['success']))
                {
                    echo "<div class='alert alert-success'><strong>Success! </strong>". $_GET['success']."</div>";
                }
                else if(isset($_GET['error']))
                {
                    echo "<div class='alert alert-warning'><strong>Error! </strong>". $_GET['error']."</div>";
                }
            }
            //get standard and subject
            $standard = $_GET['standard'];
            $subject = $_GET['subject'];
            $teacherId = $_GET['teacherId'];
        ?>
            <h3>Assignment</h3><br>
            <form action="/studentManagement/navmenu/assignment/assignHomework.php" method="post" name="f1">
                <input type="hidden" value="<?php echo $teacherId; ?>" name="teacherId">
                <div class="form-group">
                    <label for="standard"><b>Standard:</b></label>
                    <input type="number" min="1" max="10" value="<?php echo $standard; ?>" class="form-control" id="standard"  name="standard"
                        readonly>
                </div>
                <div class="form-group">
                    <label for="subject"><b>Subject:</b></label>
                    <input type="text" value="<?php echo $subject; ?>" class="form-control" id="subject"  name="subject"
                        readonly>
                </div>
                <div class="form-group">
                    <label for="assignment"><b>Assignment statement:</b></label>
                    <textarea placeholder="Enter you assignment question here" required class="form-control" name="assignment" id="assignment"></textarea>
                </div>
                <button type="submit" class="btn btn-success">Add</button>
                <a href="/studentManagement/subjectPages/subjectPage.php"><button type="button" class="btn btn-danger">Cancel</button></a>
            </form>
    </div><br>
</body>
</html>