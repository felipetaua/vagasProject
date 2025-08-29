document.addEventListener('DOMContentLoaded', function() {
    const changePasswordForm = document.getElementById('change-password-form');
    const url = "http://127.0.0.1:8000/api"; // Sua URL base da API

    function setupPasswordToggle(wrapper) {
        const input = wrapper.querySelector('input');
        const toggle = wrapper.querySelector('.toggle-password');

        if (input && toggle) {
            toggle.addEventListener('click', function() {
                const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                input.setAttribute('type', type);
                const icon = this.querySelector('i');
                if (type === 'password') {
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                } else {
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                }
            });
        }
    }

    if (changePasswordForm) {
        changePasswordForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const currentPassword = document.getElementById('current-password').value;
            const newPassword = document.getElementById('new-password').value;
            const newPasswordConfirmation = document.getElementById('new-password-confirmation').value;
            const passwordError = document.getElementById('password-error');
            const messageContainer = document.getElementById('message-container');
            const submitBtn = this.querySelector('.submit-btn');

            // Resetar mensagens
            passwordError.style.display = 'none';
            messageContainer.style.display = 'none';
            messageContainer.textContent = '';
            messageContainer.className = '';

            // Validações no lado do cliente
            if (newPassword !== newPasswordConfirmation) {
                passwordError.style.display = 'block';
                return;
            }

            if (newPassword.length < 8) {
                alert('A nova senha deve ter no mínimo 8 caracteres.');
                return;
            }

            // Obter o token de autenticação do localStorage
            const token = localStorage.getItem('authToken');
            if (!token) {
                alert('Você não está autenticado. Por favor, faça login novamente.');
                window.location.href = './login.blade.php';
                return;
            }

            // Feedback visual
            const originalBtnText = submitBtn.textContent;
            submitBtn.textContent = 'Salvando...';
            submitBtn.disabled = true;

            const apiPayload = {
                current_password: currentPassword,
                new_password: newPassword,
                new_password_confirmation: newPasswordConfirmation
            };

            // Chamada para a API
            fetch(`${url}/auth/change-password`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'Authorization': `Bearer ${token}`
                },
                body: JSON.stringify(apiPayload)
            })
            .then(response => response.json().then(data => ({ status: response.status, body: data })))
            .then(({ status, body }) => {
                if (status === 200) {
                    messageContainer.textContent = body.message || 'Senha alterada com sucesso!';
                    messageContainer.className = 'success-message';
                    messageContainer.style.display = 'block';
                    changePasswordForm.reset(); // Limpa o formulário
                } else {
                    const errorMessage = body.errors ? Object.values(body.errors)[0][0] : body.message;
                    throw new Error(errorMessage || 'Não foi possível alterar a senha.');
                }
            })
            .catch(error => {
                messageContainer.textContent = error.message;
                messageContainer.className = 'error-message';
                messageContainer.style.display = 'block';
            })
            .finally(() => {
                submitBtn.textContent = originalBtnText;
                submitBtn.disabled = false;
            });
        });

        document.querySelectorAll('.password-wrapper').forEach(setupPasswordToggle);
    }
});
