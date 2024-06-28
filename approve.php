<?php
session_start();
include 'includes/db.php';

if (isset($_GET['student_id'])) {
    
    $student_id = $_GET['student_id'];

    $sql = "SELECT is_approved FROM approvals WHERE student_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $student_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $current_status = $row['is_approved'];
        $new_status = $current_status == 1 ? 0 : 1;

        $update_sql = "UPDATE approvals SET is_approved = ? WHERE student_id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param('is', $new_status, $student_id);

        if ($update_stmt->execute()) {
            echo '<p>Student approval status updated successfully.</p>';

            header("Location: admin.php");
            exit();
        } else {
            echo '<p>Error updating student approval status.</p>';
        }

        $update_stmt->close();
    } else {
        $insert_sql = "INSERT INTO approvals (student_id, admin_id, is_approved) VALUES (?, ?, 1)";
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bind_param('ss', $student_id, $_SESSION['admin_id']);

        if ($insert_stmt->execute()) {
            echo '<p>Student approved successfully.</p>';
            header("Location: admin.php");
            exit();
        } else {
            echo '<p>Error approving student.</p>';
        }

        $insert_stmt->close();
    }

    $stmt->close();
} else {
    echo '<p>Student ID not provided.</p>';
}

$conn->close();
