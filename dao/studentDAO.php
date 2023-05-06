<!-- The file extends the AbstractDAO PHP file and offers a range of methods to perform Create, Read, Update, and Delete (CRUD) operations for a given entity.
-->

<?php
require_once('abstractDAO.php');
require_once('./model/student.php');

class studentDAO extends abstractDAO {
        
    function __construct() {
        try{
            parent::__construct();
        } catch(mysqli_sql_exception $e){
            throw $e;
        }
    }  
    
    // a method to get student details information from database
    public function getStudent($id){
        $query = 'SELECT * FROM students WHERE id = ?';
        $stmt = $this->mysqli->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows == 1){
            $temp = $result->fetch_assoc();
            $student = new student($temp['id'],$temp['image'],$temp['name'], $temp['studentId'], $temp['program'], $temp['enrollDate']);
            $result->free();
            return $student;
        }
        $result->free();
        return false;
    }

    // get an arrat of students
    public function getStudents(){
        //The query method returns a mysqli_result object
        $result = $this->mysqli->query('SELECT * FROM students');
        $students = Array();
        
        if($result->num_rows >= 1){
            while($row = $result->fetch_assoc()){
                //Create a new employee object, and add it to the array.
                $student = new Student($row['id'], $row['image'], $row['name'], $row['studentId'], $row['program'], $row['enrollDate']);
                $students[] = $student;
            }
            $result->free();
            return $students;
        }
        $result->free();
        return false;
    }   
    
    // insert student record to database
    public function addStudent($student){
        
        if(!$this->mysqli->connect_errno){
            
			$query = 'INSERT INTO students (image, name, studentId, program, enrollDate) VALUES (?,?,?,?,?)';
			$stmt = $this->mysqli->prepare($query);
            if($stmt){
                    $image = $student->getImage();
                    $name = $student->getName();
			        $studentId = $student->getStudentId();
			        $program = $student->getProgram();
                    $enrollDate = $student->getEnrollDate();
			        $stmt->bind_param('sssss', 
                        $image,
				        $name,
				        $studentId,
				        $program,
                        $enrollDate
			        );    
                    //Execute the statement
                    $stmt->execute();         
                    
                    if($stmt->error){
                        return $stmt->error;
                    } else {
                        return $student->getName() . ' added successfully!';
                    } 
			}
             else {
                $error = $this->mysqli->errno . ' ' . $this->mysqli->error;
                echo $error; 
                return $error;
            }
       
        }else {
            return 'Could not connect to Database.';
        }
    }   

    // update student information
    public function updateStudent($student){
        
        if(!$this->mysqli->connect_errno){
            //The query uses the question mark (?) as a
            //placeholder for the parameters to be used
            //in the query.
            $query = "UPDATE students SET image=?, name=?, studentId=?, program=?, enrollDate=? WHERE id=?";
            $stmt = $this->mysqli->prepare($query);
            if($stmt){
                    $id = $student->getId();
                    $image = $student->getImage();
                    $name = $student->getName();
			        $studentId = $student->getStudentId();
			        $program = $student->getProgram();
                    $enrollDate = $student->getEnrollDate();
                  
			        $stmt->bind_param('sssssi',  
                        
                        $image,
				        $name,
				        $studentId,
				        $program,
                        $enrollDate,
                        $id
			        );    
                    //Execute the statement
                    $stmt->execute();         
                    
                    if($stmt->error){
                        return $stmt->error;
                    } else {
                        return $student->getName() . ' updated successfully!';
                    } 
			}
             else {
                $error = $this->mysqli->errno . ' ' . $this->mysqli->error;
                echo $error; 
                return $error;
            }
       
        }else {
            return 'Could not connect to Database.';
        }
    }   

    // delete a student record from database
    public function deleteStudent($id){
        if(!$this->mysqli->connect_errno){
            $query = 'DELETE FROM students WHERE id = ?';
            $stmt = $this->mysqli->prepare($query);
            $stmt->bind_param('i', $id);
            $stmt->execute();
            if($stmt->error){
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }
}
?>