$(document).ready(function() {
    // Initialize form validation
    $("#postForm").validate({
        rules: {
            title: {
                required: true,
                minlength: 5
            },
            content: {
                required: true,
                minlength: 10
            },
            image: {
                extension: "jpeg|png|jpg|gif"
            }
        },
        messages: {
            title: {
                required: "Please enter a title.",
                minlength: "Title must be at least 5 characters long."
            },
            content: {
                required: "Please enter content.",
                minlength: "Content must be at least 10 characters long."
            },
            image: {
                extension: "Please upload a valid image file (jpeg, png, jpg, gif)."
            }
        },
        errorClass: "invalid-feedback d-block",
        highlight: function(element) {
            $(element).addClass("is-invalid");
        },
        unhighlight: function(element) {
            $(element).removeClass("is-invalid");
        }
    });

    // Image preview functionality
    $("#image").on('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $("#imagePreview").attr('src', e.target.result).show();
            };
            reader.readAsDataURL(file);
        } else {
            $("#imagePreview").hide();
        }
    });
});
