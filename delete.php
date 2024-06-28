<?php
include 'includes/db.php';

if (isset($_GET['student_id'])) {
    $student_id = $_GET['student_id']; 

    $sql = "DELETE FROM students WHERE student_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $student_id);

    if ($stmt->execute()) {
        header("Location: view.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}

$conn->close();
