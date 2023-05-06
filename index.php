<!-- This index file presents the current rows of entity and provides hyperlinks to view, edit, and delete each row. It also includes a hyperlink for adding a new entity to the table.
-->

<?php require_once('./dao/studentDAO.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        
        table tr td:last-child{
            width: 120px;
        }
    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    
        <div class="container-fluid w-75">
            <div class="student">
                <h1 class="jumbotron text-center font-italic mt-5">Student Information System</h1>
                <div class="col-md-12 bg-light">
                    <div class="mb-3 py-4 clearfix">
                        <h2 class="pull-left">Students Details</h2>
                        <a href="create.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New Student</a>
                    </div>
                    <?php
                    
                        $studentDAO = new studentDAO();
                        $students = $studentDAO->getStudents();
                        
                        if($students){
                            
                            echo '<table class="table table-bordered">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Image</th>";
                                        echo "<th>Name</th>";
                                        echo "<th>Student ID</th>";
                                        echo "<th>Program</th>";
                                        echo "<th>Enroll Date</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                foreach($students as $student){
                                    echo "<tr>";
                                        echo "<td>" . $student->getId() . "</td>";
                                        echo "<td><img src='imgs/" . $student->getImage() . "' alt='Uploaded Image' class='img-thumbnail' style='width:150px; height: 100px;'></td>";
                                        echo "<td>" . $student->getName() . "</td>";
                                        echo "<td>" . $student->getStudentId() . "</td>";
                                        echo "<td>" . $student->getProgram() . "</td>";
                                        echo "<td>" . $student->getEnrollDate() . "</td>";
                                        echo "<td>";
                                            echo '<a href="read.php?id='. $student->getId() .'" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                            echo '<a href="update.php?id='. $student->getId() .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                            echo '<a href="delete.php?id='. $student->getId() .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            //$result->free();
                        } else{
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                            
                        }
                   
                    // Close connection
                    $studentDAO->getMysqli()->close();
                    
        
                    ?>
                </div>
            </div>        
        </div>
    

</body>
</html>