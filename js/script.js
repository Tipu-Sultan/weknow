
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
        if (this.checkValidity() === false) {
            event.stopPropagation();
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


$(document).ready(function () {

    $('#EditadmissionForm').on('submit', function (event) {
        event.preventDefault();
        if (this.checkValidity() === false) {
            event.stopPropagation();
        } else {
            var formData = new FormData(this);

            $.ajax({
                type: 'POST',
                url: 'process_update.php',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.success) {
                        $('#EditadmissionForm')[0].reset();
                        $('.invalid-feedback').removeClass('d-block').text('');
                        showAlert('success', response.message);
                    } else {
                        displayErrors(response.errors);
                    }
                },
                error: function (xhr, status, error) {
                    var errorMessage = xhr.status + ': ' + xhr.statusText;
                    showAlert('danger', 'Error - ' + errorMessage);
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


