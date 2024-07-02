<?php
include 'includes/header.php';
include 'includes/db.php';

if (!isset($_SESSION['admin_email'])) {
    header("Location: admin_login.php");
    exit();
}
?>
<section class="mt-4">
    <div class="container-fluid" id="studentRecords">
        <h2 class="mb-4">View Student Records</h2>
        <div class="mb-3 container">
            <form id="searchForm">
                <div class="input-group md-form form-sm form-2 pl-0">
                    <input type="text" id="searchInput" class="form-control my-0 py-1 amber-border"
                        placeholder="Search by Name or Phone or Date of Admission" minlength="2">
                </div>
            </form>
        </div>
        <div id="recordsContainer">
            <?php
            $sql = "SELECT s.*, c.course_name AS courseName, pq.branch_name AS pre_qualification, pq.college_or_university_name AS institution, a.is_approved 
                    FROM students s
                    LEFT JOIN courses c ON s.student_id = c.student_id
                    LEFT JOIN pre_qualification pq ON s.student_id = pq.student_id
                    LEFT JOIN approvals a ON s.student_id = a.student_id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo '<div class="table-responsive">';
                echo '<table class="table table-striped table-bordered table-hover">';
                echo '<thead class="thead-dark">';
                echo '<tr><th>Student Id</th><th>Photo</th><th>Name</th><th>Date of Birth</th><th>Gender</th><th>Address 1</th><th>City</th><th>State</th><th>Course</th><th>Email</th><th>Mobile Number</th><th>Previous Qualifications</th><th>Institution</th><th>Admission Date</th><th>Status</th><th>Actions</th></tr>';
                echo '</thead>';
                echo '<tbody>';
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row['student_id'] . '</td>';
                    echo '<td><img src="' . $row['photograph'] . '" class="img-fluid img-thumbnail" style="max-width: 50px; height: 50px;" alt="Student Photo"></td>';
                    echo '<td>' . $row['first_name'] ." ". $row['last_name']. '</td>';
                    echo '<td>' . $row['dob'] . '</td>';
                    echo '<td>' . $row['gender'] . '</td>';
                    echo '<td>' . $row['permanent_address'] . '</td>';
                    echo '<td>' . $row['city'] . '</td>';
                    echo '<td>' . $row['state'] . '</td>';
                    echo '<td>' . $row['courseName'] . '</td>';
                    echo '<td>' . $row['email'] . '</td>';
                    echo '<td>' . $row['mobile'] . '</td>';
                    echo '<td>' . $row['pre_qualification'] . '</td>';
                    echo '<td>' . $row['institution'] . '</td>';
                    echo '<td>' . $row['admission_date'] . '</td>';
                    echo '<td>' . ($row['is_approved'] == 1 ? 'Approved' : 'Not Approved') . '</td>';
                    echo '<td>';
                    echo '<a href="approve.php?student_id=' . $row['student_id'] . '" class="btn btn-sm ' . ($row['is_approved'] == 1 ? 'btn-success' : 'btn-danger') . '">' . ($row['is_approved'] == 1 ? 'Approved' : 'Disapprove') . '</a>';
                    echo '<a href="edit.php?student_id=' . $row['student_id'] . '" class="btn btn-sm btn-info">Edit</a> ';
                    echo '<a href="delete.php?student_id=' . $row['student_id'] . '" class="btn btn-sm btn-danger" onclick="return confirm(\'Are you sure?\')">Delete</a></td>';
                    echo '</tr>';
                }
                echo '</tbody>';
                echo '</table>';
                echo '</div>';
            } else {
                echo '<p>No records found</p>';
            }

            $conn->close();
            ?>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
<script>
    $(document).ready(function () {
    $('tbody').on('click', 'tr', function () {
        $(this).next('.details-row').toggle();
    });

    $('#searchInput').on('input', function () {
        var searchTerm = $(this).val();
        if (searchTerm.length >= 2) {
            $.ajax({
                type: 'POST',
                url: 'search.php',
                data: { searchTerm: searchTerm },
                success: function (response) {
                    $('#recordsContainer').html(response);
                }
            });
        } else if (searchTerm.length === 0) {
            $.ajax({
                type: 'GET',
                url: 'search.php',
                success: function (response) {
                    $('#recordsContainer').html(response);
                }
            });
        }
    });
});
</script>
