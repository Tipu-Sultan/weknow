-- CREATE DATABASE student_admission_db;

CREATE TABLE students (
    student_id BIGINT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    middle_name VARCHAR(50),
    dob DATE NOT NULL,
    mobile VARCHAR(15) NOT NULL,
    gender ENUM('male', 'female', 'others') NOT NULL,
    email VARCHAR(100),
    permanent_address TEXT NOT NULL,
    current_address TEXT,
    city VARCHAR(50) NOT NULL,
    state VARCHAR(50),
    country VARCHAR(50),
    photograph VARCHAR(255),
    admission_date DATE NOT NULL
);

CREATE TABLE courses (
    course_id INT AUTO_INCREMENT PRIMARY KEY,
    course_name VARCHAR(255) NOT NULL,
    college_name VARCHAR(255) NOT NULL,
    course_duration VARCHAR(255) NOT NULL,
    student_id BIGINT,
    FOREIGN KEY (student_id) REFERENCES students(student_id) ON DELETE CASCADE
);

CREATE TABLE pre_qualification (
    id INT AUTO_INCREMENT PRIMARY KEY,
    branch_name VARCHAR(255) NOT NULL,
    college_or_university_name VARCHAR(255) NOT NULL,
    passing_year INT NOT NULL,
    cgpa_percentage DECIMAL(4,2) NOT NULL,
    student_id BIGINT,
    FOREIGN KEY (student_id) REFERENCES students(student_id) ON DELETE CASCADE
);

CREATE TABLE approvals (
    id INT AUTO_INCREMENT PRIMARY KEY,
    admin_id INT,
    student_id BIGINT NOT NULL,
    is_approved INT
);
