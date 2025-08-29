document.addEventListener('DOMContentLoaded', function() {
    const url = "http://127.0.0.1:8000/api";

    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
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

    const loginForm = document.getElementById('login-form');

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

    if (loginForm) {
        loginForm.addEventListener('submit', function(event) {
            event.preventDefault();
            
            const email = document.getElementById('identifier').value.trim();
            const password = document.getElementById('password').value;

            if (!email || !password) {
                alert('Por favor, preencha os campos de e-mail e senha.');
                return;
            }

            const apiPayload = {
                email: email,
                password: password
            };

            fetch(`${url}/auth/login`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(apiPayload)
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => { throw err; });
                }
                return response.json();
            })
            .then(data => {
                console.log('Login successful:', data);
                // Verifica se o token e os dados do usuário foram recebidos
                if (data.access_token && data.user) {
                    localStorage.setItem('authToken', data.access_token);
                    localStorage.setItem('user', JSON.stringify(data.user));

                    // Redireciona com base no tipo de usuário
                    if (data.user.type === 'company') {
                        window.location.href = '/pages/main/users/empresa/empresa.blade.php';
                    } else {
                        // Assume que qualquer outro tipo é 'colaborador'
                        window.location.href = '/pages/main/users/colaborador/colaborador.blade.php';
                    }
                } else {
                    throw new Error('Token ou dados do usuário não recebidos do servidor.');
                }
            })
            .catch(error => {
                console.error('Login error:', error);
                const errorMessage = error.message || 'E-mail ou senha incorretos. Tente novamente.';
                alert(errorMessage);
            });
        });

        document.querySelectorAll('.password-wrapper').forEach(setupPasswordToggle);
    }
});
