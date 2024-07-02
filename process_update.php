<?php
include 'includes/db.php';
date_default_timezone_set("Asia/Calcutta");

$response = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $student_id = $_POST['student_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $middle_name = $_POST['middle_name'];
    $dob = $_POST['dob'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $permanent_address = $_POST['permanent_address'];
    $current_address = $_POST['current_address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $gender = $_POST['gender'];

    $branch_name = $_POST['branch_name'];
    $college_or_university_name = $_POST['college_or_university_name'];
    $passing_year = $_POST['passing_year'];
    $cgpa_percentage = $_POST['cgpa_percentage'];

    $course_name = $_POST['course_name'];
    $college_name = $_POST['college_name'];
    $course_duration = $_POST['course_duration'];

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
            $response['errors'][] = "File is not an image.";
            $uploadOk = 0;
        }

        if ($_FILES['photograph']['size'] > 1000000) {
            $response['errors'][] = "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $response['errors'][] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            $response['errors'][] = "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES['photograph']['tmp_name'], $target_file)) {
                $photo = $target_file;
            } else {
                $response['errors'][] = "Sorry, there was an error uploading your file.";
            }
        }
    }

    if (!empty($response['errors'])) {
        $response['success'] = false;
    } else {
        if ($photo) {
            $student_sql = "UPDATE students SET first_name=?, last_name=?, middle_name=?, email=?, mobile=?, dob=?, gender=?, permanent_address=?, current_address=?, city=?, state=?, country=?, photograph=? WHERE student_id=?";
            $stmt = $conn->prepare($student_sql);
            $stmt->bind_param("sssssssssssssi", $first_name, $last_name, $middle_name, $email, $mobile, $dob, $gender, $permanent_address, $current_address, $city, $state, $country, $photo, $student_id);
        } else {
            $student_sql = "UPDATE students SET first_name=?, last_name=?, middle_name=?, email=?, mobile=?, dob=?, gender=?, permanent_address=?, current_address=?, city=?, state=?, country=? WHERE student_id=?";
            $stmt = $conn->prepare($student_sql);
            $stmt->bind_param("ssssssssssssi", $first_name, $last_name, $middle_name, $email, $mobile, $dob, $gender, $permanent_address, $current_address, $city, $state, $country, $student_id);
        }

        if ($stmt->execute()) {
            $course_sql = "UPDATE courses SET course_name=?, college_name=?, course_duration=? WHERE student_id=?";
            $course_stmt = $conn->prepare($course_sql);
            $course_stmt->bind_param("sssi", $course_name, $college_name, $course_duration, $student_id);
            $course_updated = $course_stmt->execute();

            $pre_qualification_sql = "UPDATE pre_qualification SET branch_name=?, college_or_university_name=?, passing_year=?, cgpa_percentage=? WHERE student_id=?";
            $pre_qualification_stmt = $conn->prepare($pre_qualification_sql);
            $pre_qualification_stmt->bind_param("sssdi", $branch_name, $college_or_university_name, $passing_year, $cgpa_percentage, $student_id);
            $pre_qualification_updated = $pre_qualification_stmt->execute();

            if ($course_updated && $pre_qualification_updated) {
                $response['success'] = true;
                $response['message'] = "Student data updated successfully!";
            } else {
                $response['success'] = false;
                $response['message'] = "Error updating course or previous qualification details.";
            }
        } else {
            $response['success'] = false;
            $response['message'] = "Error updating student data: " . $stmt->error;
        }

        $stmt->close();
        $course_stmt->close();
        $pre_qualification_stmt->close();
    }

    $conn->close();
} else {
    $response['success'] = false;
    $response['message'] = "Invalid request.";
}

header('Content-Type: application/json');
echo json_encode($response);
