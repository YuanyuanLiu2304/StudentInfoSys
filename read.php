<!-- This file is to display comprehensive information regarding a particular student.
-->

<?php
// Include employeeDAO file
require_once('./dao/studentDAO.php');
$studentDAO = new studentDAO(); 

// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Get URL parameter
    $id =  trim($_GET["id"]);
    $student = $studentDAO->getStudent($id);
            
    if($student){
        // Retrieve individual field value
        $image = $student->getImage();
        $name = $student->getName();
        $studentId = $student->getStudentId();
        $program = $student->getProgram();
        $enrollDate = $student->getEnrollDate();
    } else{
        // URL doesn't contain valid id. Redirect to error page
        header("location: error.php");
        exit();
    }
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
} 

// Close connection
$studentDAO->getMysqli()->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
</head>
<body>
    
        <div class="container-fluid d-flex justify-content-center">
            <div class="row ">
                <div class="col-md-12 ">
                    
                    <h1 class="mt-5 pb-5">View Record</h1>
                    <!-- view image -->
                    <div class="form-group fs-5">
                        <b><label class="mb-2">Image</label></b><br>
                        <img src="imgs/<?php echo $image; ?>" alt="Uploaded Image" class="img-thumbnail" 
                        style="width: 300px; height: 200px;">
                    </div>
                    <!-- view name -->
                    <div class="form-group fs-5">
                        <b><label class="mt-3">Name</label></b>
                        <p class="fst-italic"><?php echo $name; ?></p>
                    </div>
                    <!-- view student Id -->
                    <div class="form-group fs-5">
                        <b><label >Student ID</label></b>
                        <p class="fst-italic"><?php echo $studentId; ?></p>
                    </div>
                    <!-- view program -->
                    <div class="form-group fs-5">
                        <b><label>Program</label></b>
                        <p class="fst-italic"><?php echo $program; ?></p>
                    </div>
                    <!-- view enroll date -->
                    <div class="form-group fs-5">
                        <b><label>Enroll Date</label></b>
                        <p class="fst-italic"><?php echo $enrollDate; ?></p>
                    </div>
                    <p><a href="index.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
   
</body>
</html>