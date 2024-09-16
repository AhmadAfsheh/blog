$(document).ready(function () {
    // Initialize form validation
    $('#postForm').validate({
        rules: {
            title: {
                required: true,
                minlength: 8
            },
            content: {
                required: true,
                minlength: 20
            },
            image: {
                extension: "jpeg|png|jpg|gif"
            }
        },
        messages: {
            title: {
                required: "Please enter a title.",
                minlength: "The title must be at least 8 characters."
            },
            content: {
                required: "Please enter content.",
                minlength: "The content must be at least 20 characters."
            },
            image: {
                extension: "Please upload a file with one of the following extensions: jpeg, png, jpg"
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

    // Image preview functionality
    $('#image').on('change', function () {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#imagePreview').attr('src', e.target.result).show();
        };
        reader.readAsDataURL(this.files[0]);
    });

    // Load old image if exists
    function loadOldImage(imagePath) {
        if (imagePath) {
            $('#imagePreview').attr('src', `/storage/${imagePath}`).show();
        }
    }

    // Example: Load old image on page load if image path is available
    let oldImagePath = '{{ old("image", $post->image ?? "") }}';
    loadOldImage(oldImagePath);
});
