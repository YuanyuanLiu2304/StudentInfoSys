<!-- The file will invoke the deleteStudent() method in the studentDAO php file to remove a student's record from the database.
-->

<?php

// Include studentDAO file
require_once('./dao/studentDAO.php');

// Process delete operation after confirmation
if(isset($_POST["id"]) && !empty($_POST["id"])){
        $studentDAO = new studentDAO();  
        $id = trim($_POST["id"]);        
        $result = $studentDAO->deleteStudent($id);
        if($result){
            header("location: index.php");
            exit();
            } else{
            echo "Oops! Something went wrong. Please try again later.";
            }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Record</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css"
      rel="stylesheet"/>
    
</head>
<body>
        <div class="container-fluid w-50">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5 mb-3">Delete Record</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-light">
                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                            <p class="fs-5">Are you sure you want to delete this student record?</p>
                            <p>
                                <input type="submit" value="Yes" class="btn btn-danger">
                                <a href="index.php" class="btn btn-secondary ms-4">No</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
</body>
</html>