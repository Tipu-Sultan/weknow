<?php
include 'includes/header.php';
include 'includes/db.php';

$sql = "SELECT s.*, a.is_approved
        FROM students s
        LEFT JOIN approvals a ON s.student_id = a.student_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    ?>
    <section class="mt-4">
        <div class="container" id="studentRecords">
            <h2 class="mb-4">View Student Records</h2>
            
            <div id="recordsContainer">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>Student Id</th>
                                <th>Name</th>
                                <th>Date of Birth</th>
                                <th>Mobile Number</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo $row['student_id']; ?></td>
                                    <td><?php echo $row['first_name'] . " " . $row['last_name']; ?></td>
                                    <td><?php echo $row['dob']; ?></td>
                                    <td><?php echo $row['mobile']; ?></td>
                                    <td>
                                        <?php if ($row['is_approved'] == 1): ?>
                                            <a target="_blank" href="print_form.php?student_id=<?php echo $row['student_id']; ?>" class="btn btn-sm btn-success">Print Form</a>
                                        <?php endif; ?>
                                        <a href="edit.php?student_id=<?php echo $row['student_id']; ?>" class="btn btn-sm btn-info">Edit</a>
                                        <a href="delete.php?student_id=<?php echo $row['student_id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <?php
} else {
    echo '<p>No records found</p>';
}

$conn->close();

include 'includes/footer.php';
?>
