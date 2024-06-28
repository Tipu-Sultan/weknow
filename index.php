<?php include 'includes/header.php'; ?>
<section class="mt-4">
    <div class="container">
        <h2>Welcome to Student Admission System</h2>
        <p>This system allows you to manage student admissions efficiently.</p>
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">New Admission</h5>
                        <p class="card-text">Click below to create a new student admission record.</p>
                        <a href="create.php" class="btn btn-primary">New Admission</a>
                    </div>
                </div>
            </div>
            <?php if(isset($_SESSION['admin_email'])): ?>
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">View Records</h5>
                        <p class="card-text">View and manage existing student records.</p>
                        <a href="view.php" class="btn btn-primary">View Records</a>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php include 'includes/footer.php'; ?>
