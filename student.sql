-- Create User table
CREATE TABLE User (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL, 
    password VARCHAR(255) NOT NULL,
    role VARCHAR(20) NOT NULL
);

-- Create Student table
CREATE TABLE Student (
    student_id INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    register_no VARCHAR(10) NOT NULL,
    roll_no VARCHAR(7) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone_number VARCHAR(20) NOT NULL,
    address VARCHAR(200) NOT NULL,
    father text NOT NULL,
    aadhar varchar(12) NOT NULL,
    birthday text NOT NULL,
    gender varchar(6) NOT NULL,
    dist text NOT NULL,
    pincode text NOT NULL,
    file longblob NOT NULL,
    image varchar(150) NOT NULL,
    uploaded datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Create Teacher table 
CREATE TABLE Teacher (
    teacher_id INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone_number VARCHAR(20) NOT NULL,
    address VARCHAR(200) NOT NULL
);

-- Create Admin table
CREATE TABLE Admin (
    admin_id INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone_number VARCHAR(20) NOT NULL,
    address VARCHAR(200) NOT NULL
);

-- Create Achievement table
CREATE TABLE Achievement (
    achievement_id INT PRIMARY KEY AUTO_INCREMENT,
    student_id INT NOT NULL,
    achievement_title VARCHAR(100) NOT NULL,
    achievement_description VARCHAR(500) NOT NULL,
    date_achieved DATE NOT NULL,
    FOREIGN KEY (student_id) REFERENCES Student(student_id)
);

-- Create Subject table
CREATE TABLE Subject (
    subject_id INT PRIMARY KEY AUTO_INCREMENT,
    subject_name VARCHAR(100) NOT NULL,
    subject_code VARCHAR(20) NOT NULL
);

-- Create Mark table
CREATE TABLE Mark (
    mark_id INT PRIMARY KEY AUTO_INCREMENT,
    student_id INT NOT NULL,
    subject_id INT NOT NULL,
    mark_obtained DECIMAL(5, 2) NOT NULL,
    exam_date DATE NOT NULL,
    FOREIGN KEY (student_id) REFERENCES Student(student_id),
    FOREIGN KEY (subject_id) REFERENCES Subject(subject_id)
);

-- Create Attendance table
CREATE TABLE Attendance (
    attendance_id INT PRIMARY KEY AUTO_INCREMENT,
    student_id INT NOT NULL,
    subject_id INT NOT NULL,
    attendance_date DATE NOT NULL,
    is_present BOOLEAN NOT NULL,
    FOREIGN KEY (student_id) REFERENCES Student(student_id),
    FOREIGN KEY (subject_id) REFERENCES Subject(subject_id)
);

CREATE TABLE Following (
    id INT PRIMARY KEY AUTO_INCREMENT,
    userid INT NOT NULL,
    followingid INT NOT NULL,
    FOREIGN KEY (userid) REFERENCES User(user_id),
    FOREIGN KEY (followingid) REFERENCES User(user_id)
);