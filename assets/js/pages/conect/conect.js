document.addEventListener("DOMContentLoaded", function() {

    const animateOnScroll = () => {
        const textElements = document.querySelectorAll('.text-content');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, {
            threshold: 0.1 
        });
        textElements.forEach(element => {
            observer.observe(element);
        });
    };

    animateOnScroll();

    const heroInput = document.querySelector('.heroSection input[type="text"]');
    if (heroInput) {
        heroInput.setAttribute('readonly', 'readonly');
        heroInput.setAttribute('tabindex', '-1');
        heroInput.style.cursor = 'default';
    }
    const frases = [
        'Digite seu e-mail e faça parte da nossa comunidade!',
        'Receba oportunidades exclusivas em primeira mão.',
        'Conecte-se com empresas que valorizam seu talento.',
        'Participe do RH Conexão e transforme sua carreira!',
        'Descubra vagas alinhadas ao seu perfil.',
        'Junte-se a quem acredita em um RH mais humano.',
        'Seja protagonista da sua trajetória profissional!'
    ];
    let fraseIndex = 0;
    let charIndex = 0;
    let typingInterval;

    function digitarFrase() {
        if (!heroInput) return;
        heroInput.placeholder = '';
        charIndex = 0;
        typingInterval = setInterval(() => {
            heroInput.placeholder = frases[fraseIndex].slice(0, charIndex + 1);
            charIndex++;
            if (charIndex === frases[fraseIndex].length) {
                clearInterval(typingInterval);
                setTimeout(apagarFrase, 1800);
            }
        }, 55);
    }

    function apagarFrase() {
        typingInterval = setInterval(() => {
            heroInput.placeholder = frases[fraseIndex].slice(0, charIndex - 1);
            charIndex--;
            if (charIndex === 0) {
                clearInterval(typingInterval);
                fraseIndex = (fraseIndex + 1) % frases.length;
                setTimeout(digitarFrase, 600);
            }
        }, 30);
    }

    digitarFrase();

    const connectBtn = document.querySelector('.heroSection button[type="submit"]');
    if (connectBtn) {
        connectBtn.addEventListener('click', function(e) {
            e.preventDefault();
            window.location.href = '../../pages/register.html/register.html';
        });
    }
});