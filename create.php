<?php include 'includes/header.php'; ?>
<section class="mt-4">
    <div class="container">
        <h2 class="mb-4">New Admission Form</h2>
        <form id="admissionForm" action="process_create.php" method="POST" enctype="multipart/form-data"
            class="needs-validation" novalidate>
            <!-- Personal Details -->
            <div class="form-section">
                <h3>Personal Details</h3>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="firstName">First Name</label>
                        <input type="text" class="form-control" id="firstName" name="first_name" required>
                        <div class="invalid-feedback">
                            Please enter a first name.
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="lastName">Last Name</label>
                        <input type="text" class="form-control" id="lastName" name="last_name" required>
                        <div class="invalid-feedback">
                            Please enter a last name.
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="middleName">Middle Name</label>
                        <input type="text" class="form-control" id="middleName" name="middle_name">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="dob">Date of Birth</label>
                        <input type="date" class="form-control" id="dob" name="dob" required>
                        <div class="invalid-feedback">
                            Please enter a valid date of birth.
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="mobile">Mobile Number</label>
                        <input type="text" class="form-control" id="mobile" name="mobile" required>
                        <div class="invalid-feedback">
                            Please enter a valid mobile number.
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="row">
                            <label>Gender</label>
                            <div class="col-4">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="genderMale" name="gender" value="male"
                                        class="custom-control-input">
                                    <label class="custom-control-label" for="genderMale">Male</label>
                                </div>

                            </div>
                            <div class="col-4">

                                <div class="custom-control custom-radio">
                                    <input type="radio" id="genderFemale" name="gender" value="female"
                                        class="custom-control-input">
                                    <label class="custom-control-label" for="genderFemale">Female</label>
                                </div>

                            </div>

                            <div class="col-4">

                                <div class="custom-control custom-radio">
                                    <input type="radio" id="genderOthers" name="gender" value="others"
                                        class="custom-control-input">
                                    <label class="custom-control-label" for="genderOthers">Others</label>
                                </div>
                                <div class="invalid-feedback ">
                                    Please select your gender.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8 mb-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email">
                        <div class="invalid-feedback">
                            Please enter a valid email address.
                        </div>
                    </div>
                </div>
            </div>

            <!-- Address Details -->
            <div class="form-section mt-4">
                <h3>Address Details</h3>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="permanentAddress">Permanent Address</label>
                        <input type="text" class="form-control" id="permanentAddress" name="permanent_address" required>
                        <div class="invalid-feedback">
                            Please enter permanent address.
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="currentAddress">Current Address</label>
                        <input type="text" class="form-control" id="currentAddress" name="current_address">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="city">City</label>
                        <input type="text" class="form-control" id="city" name="city" required>
                        <div class="invalid-feedback">
                            Please enter the city.
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="state">State</label>
                        <input type="text" class="form-control" id="state" name="state">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="country">Country</label>
                        <input type="text" class="form-control" id="country" name="country">
                    </div>
                </div>
            </div>

            <!-- Class/Course Details -->
            <div class="form-section mt-4">
                <h3>Class/Course Details</h3>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="courseName">Course/Class Name</label>
                        <input type="text" class="form-control" id="courseName" name="course_name" required>
                        <div class="invalid-feedback">
                            Please enter course name.
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="collegeName">College/University Name</label>
                        <input type="text" class="form-control" id="collegeName" name="college_name">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="course_duration">Course Duration</label>
                        <input type="text" class="form-control" id="course_duration" name="course_duration">
                    </div>
                </div>
            </div>

            <!-- Previous Qualifications -->
            <div class="form-section mt-4">
                <h3>Previous Qualifications</h3>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="branch_name">Branch/Course Name</label>
                        <input type="text" class="form-control" id="branch_name" name="branch_name" required>
                        <div class="invalid-feedback">
                            Please enter course name.
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="college_or_university_name">College/University Name</label>
                        <input type="text" class="form-control" id="college_or_university_name"
                            name="college_or_university_name">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="passingYear">Passing Year</label>
                        <input type="text" class="form-control" id="passingYear" name="passing_year">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="cgpa_percentage">Percentage</label>
                        <input type="text" class="form-control" id="cgpa_percentage" name="cgpa_percentage">
                    </div>
                </div>
            </div>

            <!-- Photograph Upload -->
            <div class="form-section mt-4">
                <h3>Photograph Upload</h3>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="photo">Photograph</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="photo" name="photograph" accept="image/*"
                                required>
                            <label class="custom-file-label" for="photo">Choose file...</label>
                            <div class="invalid-feedback">
                                Please choose a photograph.
                            </div>

                        </div>
                        <img id="photoPreview" src="" class="mt-3" width="100" height="100" />
                    </div>
                </div>
            </div>

            <button class="btn btn-primary mt-4 mb-5" id="studentBtn" type="submit" name="submit">Submit</button>
            <div id="error-succss_msg">

            </div>
        </form>
    </div>
</section>
<?php include 'includes/footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#photoPreview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $('#photo').change(function () {
        readURL(this);
    });
    $(document).ready(function () {

        $('#admissionForm').on('submit', function (event) {
            event.preventDefault();

            var submitBtn = $('#studentBtn');
            submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Please wait...');

            if (this.checkValidity() === false) {
                event.stopPropagation();
                submitBtn.prop('disabled', false).html('Submit');
            } else {
                var formData = new FormData(this);

                $.ajax({
                    type: 'POST',
                    url: 'process_create.php',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response.success) {
                            $('#admissionForm')[0].reset();
                            $('.invalid-feedback').removeClass('d-block').text('');
                            showAlert('success', response.message);
                        } else {
                            displayErrors(response.errors);
                        }
                    },
                    error: function (xhr, status, error) {
                        var errorMessage = xhr.status + ': ' + xhr.statusText;
                        showAlert('danger', 'Error - ' + errorMessage);
                    },
                    complete: function () {
                        submitBtn.prop('disabled', false).html('Submit');
                    }
                });
            }

            $(this).addClass('was-validated');
        });


        function displayErrors(errors) {
            $('.invalid-feedback').removeClass('d-block').text('');
            var errorMessage = "Errors:\n";
            $.each(errors, function (index, error) {
                errorMessage += "- " + error + "\n";
            });
            showAlert('danger', errorMessage);
        }

        function showAlert(type, message) {
            var alertHtml = '<div class="alert alert-' + type + ' alert-dismissible fade show" role="alert">' +
                message +
                '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                '</div>';
            $('#error-succss_msg').html(alertHtml);
        }
    });

</script>
<?php include 'includes/footer.php'; ?>