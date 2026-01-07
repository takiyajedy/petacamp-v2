// Auto-show modal if there are validation errors
document.addEventListener('DOMContentLoaded', function() {
    // Check for login errors
    const loginErrors = document.querySelector('#loginForm .is-invalid');
    if (loginErrors) {
        const loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
        loginModal.show();
    }
    
    // Check for register errors
    const registerErrors = document.querySelector('#registerForm .is-invalid');
    if (registerErrors) {
        const registerModal = new bootstrap.Modal(document.getElementById('registerModal'));
        registerModal.show();
    }
});