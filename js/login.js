document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.getElementById('password');
    const togglePasswordButton = document.getElementById('togglePassword');
    const icon = togglePasswordButton.querySelector('i');

    togglePasswordButton.addEventListener('click', function() {
        // Verifica o tipo atual do campo de senha
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);

        // Altera o ícone do olho
        if (type === 'password') {
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        } else {
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        }
    });
});