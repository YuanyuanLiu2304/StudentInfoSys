<!-- This file encapsulates all the relevant information related to a student. It provides various methods to interact with the student object, such as getter and setter methods to retrieve and update the student's attributes.
-->

<?php
// this class encapsulates all the relevant information related to a student
	class Student{		
        // auto_increment Id
		private $id;
		// the image of student
		private $image;
		// the name of student
		private $name;
		// the studentId of student
		private $studentId;
		// the program of student enrolled
		private $program;
		// the enroll date of student
		private $enrollDate;
		
		// parameters constructor to instantiate student object
		function __construct($id, $image, $name, $studentId, $program, $enrollDate){
			$this->setId($id);
			$this->setImage($image);
			$this->setName($name);
			$this->setStudentId($studentId);
			$this->setProgram($program);
			$this->setEnrollDate($enrollDate);
			}	
		
		// set id for student
		public function setId($id){
				$this->id = $id;
		}
	
		// get student id
		public function getId(){
				return $this->id;
		}

        // get student image
		public function getImage(){
				return $this->image;
		}
		
		// set image for student
		public function setImage($image){
				$this->image = $image;
		}
		
		// get student name
		public function getName(){
			return $this->name;
		}
		
		// set name for student
		public function setName($name){
			$this->name = $name;
		}
		
		// get studentId
		public function getStudentId(){
			return $this->studentId;
		}
		
		// set studentId for student
		public function setStudentId($studentId){
			$this->studentId = $studentId;
		}

		// get student program they are enrolled
		public function getProgram(){
			return $this->program;
		}

		// set program for student
		public function setProgram($program){
			$this->program = $program;
		}
        
		// set enrolled date for student
		public function setEnrollDate($enrollDate){
			$this->enrollDate = $enrollDate;
		}

		// get enrolled date for student
		public function getEnrollDate(){
			return $this->enrollDate;
		}

	}
?>