<?php
include 'includes/db.php';

date_default_timezone_set("Asia/Calcutta"); 
// Create students table
include 'includes/table.php';

$errors = [];
$response = [];

$first_name = $_POST['first_name'] ?? '';
$last_name = $_POST['last_name'] ?? '';
$middle_name = $_POST['middle_name'] ?? '';
$dob = $_POST['dob'] ?? '';
$mobile = $_POST['mobile'] ?? '';
$email = $_POST['email'] ?? '';
$permanent_address = $_POST['permanent_address'] ?? '';
$current_address = $_POST['current_address'] ?? '';
$city = $_POST['city'] ?? '';
$state = $_POST['state'] ?? '';
$country = $_POST['country'] ?? '';
$gender = $_POST['gender'] ?? '';
$is_approved = $_POST['is_approved'] ?? 0;

$branch_name = $_POST['branch_name'] ?? '';
$college_or_university_name = $_POST['college_or_university_name'] ?? '';
$passing_year = $_POST['passing_year'] ?? '';
$cgpa_percentage = $_POST['cgpa_percentage'] ?? '';

$course_name = $_POST['course_name'] ?? '';
$college_name = $_POST['college_name'] ?? '';
$course_duration = $_POST['course_duration'] ?? '';

$photo = '';

if (!empty($_FILES['photograph']['name'])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES['photograph']['name']);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES['photograph']['tmp_name']);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $errors[] = "File is not an image.";
        $uploadOk = 0;
    }

    if ($_FILES['photograph']['size'] > 1000000) {
        $errors[] = "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        $errors[] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        $errors[] = "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES['photograph']['tmp_name'], $target_file)) {
            $photo = $target_file;
        } else {
            $errors[] = "Sorry, there was an error uploading your file.";
        }
    }
} else {
    $errors[] = "Please choose a photograph.";
}

if (!empty($errors)) {
    $response['success'] = false;
    $response['errors'] = $errors;
} else {

    $student_id = generateStudentID();
    $student_sql = "INSERT INTO students (student_id, first_name, last_name, middle_name, email, mobile, dob, gender, permanent_address, current_address, city, state, country, photograph, admission_date)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
    $stmt = $conn->prepare($student_sql);

    $stmt->bind_param("ssssssssssssss", $student_id, $first_name, $last_name, $middle_name, $email, $mobile, $dob, $gender, $permanent_address, $current_address, $city, $state, $country, $photo);

    if ($stmt->execute()) {

        $course_sql = "INSERT INTO courses (course_name, college_name, course_duration,student_id)
        VALUES (?, ?, ?, ?)";
        $course_stmt = $conn->prepare($course_sql);
        $course_stmt->bind_param("sssi",$course_name, $college_name, $course_duration,$student_id);
        $course_inserted = $course_stmt->execute();

        $pre_qulification_sql = "INSERT INTO pre_qualification (branch_name, college_or_university_name, passing_year,cgpa_percentage,student_id)
        VALUES (?, ?, ?, ?,?)";
        $pre_qulification_sql_stmt = $conn->prepare($pre_qulification_sql);
        $pre_qulification_sql_stmt->bind_param("ssssi", $branch_name, $college_or_university_name, $passing_year, $cgpa_percentage,$student_id);
        $pre_qulification_inserted = $pre_qulification_sql_stmt->execute();

        if ($course_inserted && $pre_qulification_inserted) {
            $response['success'] = true;
            $response['message'] = "Application submitted successfully!";
        }


    } else {
        $response['success'] = false;
        $response['message'] = "Error submitting application: " . $stmt->error;
    }

    $stmt->close();


    $course_stmt->close();
}

header('Content-Type: application/json');
echo json_encode($response);

function generateStudentID()
{
    date_default_timezone_set("Asia/Calcutta"); 
    $year = date('y');
    $month = date('m');
    $day = date('d');
    $hour = date('H');

    $random1 = str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
    $student_id = "{$year}{$month}{$day}{$hour}{$random1}";

    return $student_id;
}