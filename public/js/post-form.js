$(document).ready(function () {
    // Initialize the validation on the form
    $('#postForm').validate({
        rules: {
            title: {
                required: true,
                minlength: 8  // Title must be at least 8 characters long
            },
            content: {
                required: true
            },
            image: {
                extension: "jpeg|png|jpg"  // Optional: Ensure the image is of the correct format
            }
        },
        messages: {
            title: {
                required: "Please enter a title.",
                minlength: "The title must be at least 8 characters long."
            },
            content: {
                required: "Please enter the content.",
                minlength: "The title must be at least 20 characters long."
            },
            image: {
                extension: "Please upload a file with one of the following extensions: jpeg, png, jpg."
            }
        },
        errorElement: 'div',
        errorClass: 'invalid-feedback',
        highlight: function (element) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element) {
            $(element).removeClass('is-invalid');
        }
    });

    // Preview image on file selection
    $('#image').on('change', function () {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#imagePreview').attr('src', e.target.result).show();
        };
        reader.readAsDataURL(this.files[0]);
    });
});
