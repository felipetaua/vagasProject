document.addEventListener('DOMContentLoaded', function() {
    const resetPasswordForm = document.getElementById('reset-password-form');
    const emailInput = document.getElementById('email');
    const newPassword = document.getElementById('new-password');
    const confirmPassword = document.getElementById('confirm-password');
    const passwordError = document.getElementById('password-error');

    // Preenche e desativa o e-mail a partir da URL para segurança e UX.
    // O link de redefinição enviado por e-mail deve conter o token e o e-mail.
    const urlParams = new URLSearchParams(window.location.search);
    const emailFromUrl = urlParams.get('email');
    if (emailInput && emailFromUrl) {
        emailInput.value = decodeURIComponent(emailFromUrl);
        emailInput.readOnly = true;
    }

    function setupPasswordToggle(wrapper) {
        const input = wrapper.querySelector('input');
        const toggle = wrapper.querySelector('.toggle-password');

        if (input && toggle) {
            toggle.addEventListener('click', function() {
                // alterna o atributo type
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

    if (resetPasswordForm) {
        resetPasswordForm.addEventListener('submit', function (e) {
            e.preventDefault();

            passwordError.style.display = 'none';

            // 1. Obter dados do formulário
            const email = emailInput.value.trim();
            const password = newPassword.value;
            const password_confirmation = confirmPassword.value;

            // 2. Obter o token de redefinição da URL
            const token = urlParams.get('token');

            // 3. Validações no lado do cliente
            if (!token) {
                alert('Token de redefinição ausente ou inválido. Por favor, use o link enviado para o seu e-mail.');
                return;
            }

            if (password !== password_confirmation) {
                passwordError.style.display = 'block';
                return;
            }

            if (password.length < 8) {
                alert('A senha deve ter no mínimo 8 caracteres.');
                return;
            }

            // 4. Preparar e fazer a chamada à API
            const submitBtn = this.querySelector('.submit-btn');
            const originalBtnText = submitBtn.textContent;
            submitBtn.textContent = 'Salvando...';
            submitBtn.disabled = true;

            const apiPayload = { token, email, password, password_confirmation };
            const url = "http://127.0.0.1:8000/api"; // Sua URL base da API

            // Endpoint da API para redefinir a senha (padrão do Laravel)
            fetch(`${url}/password/reset`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(apiPayload)
            })
            .then(response => response.json().then(data => ({ status: response.status, body: data })))
            .then(({ status, body }) => {
                if (status === 200) {
                    alert(body.message || 'Senha redefinida com sucesso! Você será redirecionado para a página de login.');
                    window.location.href = './login.blade.php'; // Redireciona para o login
                } else {
                    // Trata erros de validação ou outros problemas
                    const errorMessage = body.errors ? Object.values(body.errors)[0][0] : body.message;
                    throw new Error(errorMessage || 'Não foi possível redefinir a senha.');
                }
            })
            .catch(error => {
                alert(error.message);
                submitBtn.textContent = originalBtnText;
                submitBtn.disabled = false;
            });
        });

        document.querySelectorAll('.password-wrapper').forEach(setupPasswordToggle);
    }

    const testimonials = [
        {
            text: '"A melhor plataforma para gestão de talentos que já utilizei. Simples, rápida e com resultados incríveis."',
            author: 'Marcos Andrade, CEO',
            stars: '★★★★★'
        },
        {
            text: '"Encontrei minha vaga dos sonhos em poucos dias. Recomendo para todos os profissionais!"',
            author: 'Juliana Souza, Analista de RH',
            stars: '★★★★★'
        },
        {
            text: '"A interface é intuitiva e o suporte é excelente. Facilitou muito o nosso recrutamento."',
            author: 'Carlos Lima, Diretor de Pessoas',
            stars: '★★★★★'
        }
    ];

    const card = document.getElementById('testimonialCard');
    const progressBar = document.getElementById('testimonialProgressBar');
    let current = 0;
    const duration = 5000; 

    function showTestimonial(idx, animate = false) {
        if (animate) {
            card.classList.add('slide-right');
            setTimeout(() => {
                card.innerHTML = `
                    <p>${testimonials[idx].text}</p>
                    <div class="testimonial-author">
                        <span>${testimonials[idx].author}</span>
                        <span class="stars">${testimonials[idx].stars}</span>
                    </div>
                `;
                card.classList.remove('slide-right');
            }, 350);
        } else {
            card.innerHTML = `
                <p>${testimonials[idx].text}</p>
                <div class="testimonial-author">
                    <span>${testimonials[idx].author}</span>
                    <span class="stars">${testimonials[idx].stars}</span>
                </div>
            `;
        }
    }

    function animateProgressBar() {
        progressBar.style.transition = 'none';
        progressBar.style.width = '0%';
        setTimeout(() => {
            progressBar.style.transition = `width ${duration}ms linear`;
            progressBar.style.width = '100%';
        }, 20);
    }

    function nextTestimonial() {
        current = (current + 1) % testimonials.length;
        showTestimonial(current, true);
        animateProgressBar();
    }

    showTestimonial(current);
    animateProgressBar();
    setInterval(nextTestimonial, duration);
});