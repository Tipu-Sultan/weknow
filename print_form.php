<?php
include 'includes/db.php';

if (isset($_GET['student_id'])) {
    $student_id = filter_var($_GET['student_id'], FILTER_VALIDATE_INT);

    if ($student_id === false || $student_id === null) {
        die("Invalid student ID.");
    }
} else {
    die("Student ID parameter not provided.");
}

$sql = "SELECT s.student_id, s.first_name, s.last_name, s.middle_name, s.dob, s.mobile, s.gender, s.email,
               s.permanent_address, s.current_address, s.city, s.state, s.country, s.photograph, s.admission_date,
               c.course_name AS course,c.course_duration AS course_duration,
               pq.branch_name AS previous_qualifications, 
               pq.college_or_university_name AS institution,
               pq.passing_year AS passing_year,
               pq.cgpa_percentage AS cgpa_percentage,
               a.is_approved
        FROM students s
        LEFT JOIN courses c ON s.student_id = c.student_id
        LEFT JOIN pre_qualification pq ON s.student_id = pq.student_id
        LEFT JOIN approvals a ON s.student_id = a.student_id
        WHERE s.student_id = ?";

$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("i", $student_id);

    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc(); 

        echo '<html>
<head>
    <title>Student Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            background-color: #f2f2f2;
        }
        .container {
            width: 90%;
            max-width: 800px; /* Adjust max-width as needed */
            padding: 20px;
            border: 2px solid #000;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h4 {
            text-align: center;
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
        }
        .section {
            margin-top: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #ccc;
        }
        .section:last-child {
            border-bottom: none;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        .photo img {
            max-width: 100px;
            border: 1px solid #ccc;
            padding: 5px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">        
        <div class="section">
            <h4>Personal Details</h4>
            <table>
                <tr>
                    <th>Student Id</th>
                    <td style="font-weight:bold;">' . htmlspecialchars($row['student_id']) .'</td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td>' . htmlspecialchars($row['first_name'] . ' ' . $row['last_name'] . ' ' . $row['middle_name']) . '</td>
                </tr>
                <tr>
                    <th>Date of Birth</th>
                    <td>' . htmlspecialchars($row['dob']) . '</td>
                </tr>
                <tr>
                    <th>Mobile Number</th>
                    <td>' . htmlspecialchars($row['mobile']) . '</td>
                </tr>
                <tr>
                    <th>Gender</th>
                    <td>' . htmlspecialchars($row['gender']) . '</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>' . htmlspecialchars($row['email']) . '</td>
                </tr>
                <div class="photo">
            <img src="' . htmlspecialchars($row['photograph']) . '" alt="Student Photograph">
        </div>
            </table>
        </div>
        
        <div class="section">
            <h4>Address Details</h4>
            <table>
                <tr>
                    <th>Permanent Address</th>
                    <td>' . htmlspecialchars($row['permanent_address']) . '</td>
                </tr>
                <tr>
                    <th>Current Address</th>
                    <td>' . htmlspecialchars($row['current_address']) . '</td>
                </tr>
                <tr>
                    <th>City</th>
                    <td>' . htmlspecialchars($row['city']) . '</td>
                </tr>
                <tr>
                    <th>State</th>
                    <td>' . htmlspecialchars($row['state']) . '</td>
                </tr>
                <tr>
                    <th>Country</th>
                    <td>' . htmlspecialchars($row['country']) . '</td>
                </tr>
            </table>
        </div>
        
        <div class="section">
            <h4>Class/Course Details</h4>
            <table>
                <tr>
                    <th>Course/Class</th>
                    <td>' . htmlspecialchars($row['course']) . '</td>
                </tr>
                <tr>
                    <th>Admission Date</th>
                    <td>' . htmlspecialchars($row['admission_date']) . '</td>
                </tr>
                <tr>
                    <th>Course Duration</th>
                    <td>' . htmlspecialchars($row['course_duration']) . ' years</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td style="color:green">' . ($row['is_approved'] == 1 ? 'Approved' : 'Not Approved') . '</td>
                </tr>
            </table>
        </div>
        
        <div class="section">
            <h4>Previous Qualifications</h4>
            <table>
                <tr>
                    <th>Qualifications</th>
                    <td>' . htmlspecialchars($row['previous_qualifications']) . '</td>
                </tr>
                <tr>
                    <th>Institution</th>
                    <td>' . htmlspecialchars($row['institution']) . '</td>
                </tr>
                <tr>
                    <th>Passing Year</th>
                    <td>' . htmlspecialchars($row['passing_year']) . '</td>
                </tr>
                <tr>
                    <th>CPGA/Cent</th>
                    <td>' . htmlspecialchars($row['cgpa_percentage']) . '</td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>';
    } else {
        echo '<p>No student found with ID: ' . $student_id . '</p>';
    }

    $stmt->close();
} else {
    echo "Prepare statement error: " . $conn->error;
}

$conn->close();
?>