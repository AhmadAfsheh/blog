document.addEventListener('DOMContentLoaded', function () {
    if (window.Laravel && window.Laravel.success) {
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: window.Laravel.success,
        });
    }

    if (window.Laravel && window.Laravel.error) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: window.Laravel.error,
        });
    }
});