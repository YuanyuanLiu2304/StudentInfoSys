<!-- This file is an update page that allows for the modification of student information.
-->

<?php

// Include employeeDAO file
require_once('./dao/studentDAO.php');
 
// Define variables and initialize with empty values
$image = $name = $studentId = $program = $enrollDate = "";
$imageErr = $nameErr = $studentIdErr = $programErr = $enrollDateErr = "";
$studentDAO = new studentDAO(); 

// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    
    $id = $_POST["id"];
    $fileName = $_FILES["image"]["name"];  
    $fileExt = explode('.',$fileName);
    //Setting a unique ID for the image name will ensure that the image is not overridden in the event of a duplicate name
    $fileNameNew = uniqid('',true).'.'.$fileExt[count($fileExt) - 1];
    $targetDir = 'imgs/'.$fileNameNew;
        
    //  Validate img file 
    if ($_FILES["image"]["error"] == UPLOAD_ERR_OK) {
        $image = $_FILES["image"];
       
      } else {
        $imageErr = "Image is required, please upload a file.";
      }
      

    // Validate name, name have to be between 4 and 20 alphabet
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $nameErr = "name is required, please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $nameErr = "please enter a valid name,only alphabetical characters and spaces allowed";
    } elseif(!(strlen($input_name) >= 4 && strlen($input_name) <= 20)){
        $nameErr = "student name must be between 4 and 20 alphabets.";
    } else{
        $name = $input_name;
    }
    
    // Validate studentId, student number must be between 4 and 12 digits with a positive integer values
    $input_studentId = trim($_POST["studentId"]);
    if(empty($input_studentId)){
        $studentIdErr = "studentID is required, please enter an studentID.";     
    } elseif(!(strlen($input_studentId) >= 4 && strlen($input_studentId) <= 12)){
        $studentIdErr = "student number must be between 4 and 12 digits.";
    } elseif(!ctype_digit($input_studentId)){
        $studentIdErr = "please enter a positive integer value.";
    } else{
        $studentId= $input_studentId;
    }
    
    // Validate program
    $input_program = trim($_POST["program"]);
    if(empty($input_program)){
        $programErr = "please enter the program.";     
    } else{
        $program = $input_program;
    }

    // Validate enroll date, enroll date must be before today
    $input_enroll_date = trim($_POST["enrollDate"]);
    if(empty($input_enroll_date)){
        $enrollDateErr = "please enter the the enroll date.";     
    } elseif(strtotime($input_enroll_date) >= time()){
        $enrollDateErr = "enroll date must be before today.";
    } else{
        $enrollDate = $input_enroll_date;
    }
    
    // Check errors before save the img to img folder and inserting in database 
    if(empty($imageErr) && empty($nameErr) && empty($studentIdErr) && empty($programErr) && empty($enrollDateErr)){
        
        $student = new Student($id, $fileNameNew, $name, $studentId, $program, $enrollDate);
        $result = $studentDAO->updateStudent($student);        
		header("refresh:2; url=index.php");
		echo '<br><h6 style="text-align:center">' . $result . '</h6>';

        // move the img file to imgs folder
         move_uploaded_file($_FILES["image"]["tmp_name"], $targetDir);
        // Close connection
        $studentDAO->getMysqli()->close();
    }

} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        $student = $studentDAO->getStudent($id);
                
        if($student){
            // Retrieve individual field value
            $fileNameNew = $student->getImage();
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
}
?>
 
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css"
      rel="stylesheet"/>
    
</head>
<body>
   
        <div class="container-fluid w-50">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Update Record</h2>
                    <p>Please edit the input values and submit to update the student record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post" enctype="multipart/form-data" >
                        <!-- image file field -->
                        <div class="form-group">   
                         <label class="fs-4 mt-3">Image</label>
                            <input type="file" name="image" accept="image/*" class="form-control mt-2 <?php echo (!empty($imageErr)) ? 'is-invalid' : ''; ?>">
                            <span class="invalid-feedback mb-2"><?php echo $imageErr;?></span>
                        </div>
                        <!-- name field -->
                        <div class="form-group">
                            <label class="fs-4 mt-3">Name</label>
                            <input type="text" name="name" class="form-control mt-2 <?php echo (!empty($nameErr)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $nameErr;?></span>
                        </div>
                        <!-- student Id field -->
                        <div class="form-group">
                        <label class="fs-4 mt-3">StudentID</label>
                            <input type="number" name="studentId" class="form-control mt-2 <?php echo (!empty($studentIdErr)) ? 'is-invalid' : ''; ?>"value="<?php echo $studentId; ?>">
                            <span class="invalid-feedback mb-2"><?php echo $studentIdErr;?></span>
                        </div>
                        <!-- program field -->
                        <div class="form-group">
                        <label class="fs-4 mt-3">Program</label>
                            <input type="text" name="program" class="form-control mt-2 <?php echo (!empty($programErr)) ? 'is-invalid' : ''; ?>" value="<?php echo $program; ?>">
                            <span class="invalid-feedback mb-2"><?php echo $programErr;?></span>
                        </div>
                        <!-- enroll date field -->
                        <div class="form-group">
                            <label class="fs-4 mt-3">Enroll date</label>
                            <input type="date" name="enrollDate" class="form-control mt-2 <?php echo (!empty($enrollDateErr)) ? 'is-invalid' : ''; ?>" value="<?php echo $enrollDate; ?>">
                            <span class="invalid-feedback mb-2"><?php echo $enrollDateErr;?></span>
                        </div>
                        
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary mt-3" value="Submit">
                        <a href="index.php" class="btn btn-secondary ms-3 mt-3">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    
</body>
</html>