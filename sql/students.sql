

-- This script sets up a database and creates a table named 'students' to store information about students.
CREATE DATABASE assignment;
GRANT USAGE ON *.* TO 'yuanyuanliu'@'localhost' IDENTIFIED BY 'assignment';
GRANT ALL PRIVILEGES ON assignment.* TO 'yuanyuanliu'@'localhost';
FLUSH PRIVILEGES;

USE assignment;

-- create student table structure
CREATE TABLE IF NOT EXISTS students (
  id                 INT PRIMARY KEY  AUTO_INCREMENT,
  image              VARCHAR(255) NOT NULL,
  name               VARCHAR(255) NOT NULL,
  studentId          VARCHAR(20) NOT NULL,
  program            VARCHAR(255) NOT NULL,
  enrollDate        DATE NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

