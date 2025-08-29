
document.addEventListener('DOMContentLoaded', function() {
    const url = "http://127.0.0.1:8000/api"

    const registerForm = document.getElementById('rh-form');

    // --- Lógica do Modal de Sucesso ---
    const successModal = document.getElementById('successModal');
    const modalOkBtn = document.getElementById('modalOkBtn');
    const modalCloseBtn = successModal ? successModal.querySelector('.modal-close-btn') : null;

    const showSuccessModal = () => {
        if (successModal) {
            successModal.classList.add('show');
        }
    };

    const hideSuccessModalAndRedirect = () => {
        if (successModal) {
            successModal.classList.remove('show');
            // Espera a transição de fade-out terminar antes de redirecionar
            setTimeout(() => {
                window.location.href = '/pages/login/login.blade.php';
            }, 300); // Deve corresponder ao tempo da transição no CSS
        } else {
            // Fallback caso o modal não exista na página
            window.location.href = '/pages/login/login.blade.php';
        }
    };

    if (modalOkBtn) modalOkBtn.addEventListener('click', hideSuccessModalAndRedirect);
    if (modalCloseBtn) modalCloseBtn.addEventListener('click', hideSuccessModalAndRedirect);
    if (successModal) {
        successModal.addEventListener('click', (e) => e.target === successModal && hideSuccessModalAndRedirect());
    }
    // --- Fim da Lógica do Modal ---

    const userTypeRadios = document.querySelectorAll('input[name="userType"]');
    const labelName = document.getElementById('label-name');
    const inputName = document.getElementById('name');
    const labelDoc = document.getElementById('label-doc');
    const inputDoc = document.getElementById('doc');
    const docError = document.getElementById('doc-error');

    // alternar os campos
    const updateUserType = () => {
        const selectedType = document.querySelector('input[name="userType"]:checked').value;
        if (selectedType === 'company') {
            labelName.textContent = 'Razão Social';
            inputName.placeholder = 'Digite a razão social';
            labelDoc.textContent = 'CNPJ';
            inputDoc.placeholder = '00.000.000/0000-00';
        } else {
            labelName.textContent = 'Nome Completo';
            inputName.placeholder = 'Digite seu nome completo';
            labelDoc.textContent = 'CPF';
            inputDoc.placeholder = '000.000.000-00';
        }
        inputDoc.value = '';
        docError.textContent = ''; 
    };

    userTypeRadios.forEach(radio => radio.addEventListener('change', updateUserType));

    registerForm.addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(registerForm);
        const data = Object.fromEntries(formData.entries());

        let apiUrl;
        let apiPayload;
        const userType = data.userType; // 'candidate' ou 'company'

        // 1. Estrutura o endereço, que é comum para ambos
        const addressPayload = {
            streetName: data.streetName,
            streetNumber: data.streetNumber,
            district: data.district,
            city: data.city,
            state: data.state,
            country: "Brasil",
            zipcode: data.zipcode.replace(/\D/g, '')
        };

        // 2. Define a URL e o Payload com base no tipo de usuário
        if (userType === 'company') {
            // Se for empresa...
            apiUrl = `${url}/auth/register/company`;
            apiPayload = {
                name: data.name,
                cnpj: data.doc.replace(/\D/g, ''), // Usa o campo 'doc' como CNPJ
                phone: data.celular.replace(/\D/g, ''),
                email: data.email,
                password: data.password,
                password_confirmation: data.password_confirmation,
                address: addressPayload
            };
        } else {
            // Senão (será 'candidate')...
            apiUrl = `${url}/auth/register/user`;
            apiPayload = {
                name: data.name,
                cpf: data.doc.replace(/\D/g, ''), // Usa o campo 'doc' como CPF
                phone: data.celular.replace(/\D/g, ''),
                email: data.email,
                password: data.password,
                password_confirmation: data.password_confirmation,
                address: addressPayload
            };
        }

        // 3. Envia a requisição com a URL e o payload definidos dinamicamente
        fetch(apiUrl, {
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
            console.info('Success:', data);
            showSuccessModal();
        })
        .catch(error => {
            console.error('Error:', error);
            if (error.errors) {
                let errorMessages = "Por favor, corrija os seguintes erros:\n";
                for (const key in error.errors) {
                    errorMessages += `- ${error.errors[key].join(', ')}\n`;
                }
                alert(errorMessages);
            } else {
                alert('Ocorreu um erro ao realizar o cadastro. Tente novamente.');
            }
        });
    });
});

function isValidCPF(cpf) {
    cpf = cpf.replace(/[^\d]+/g, '');
    if (cpf.length !== 11 || !!cpf.match(/(\d)\1{10}/)) return false;
    let sum = 0;
    let remainder;
    for (let i = 1; i <= 9; i++) sum = sum + parseInt(cpf.substring(i - 1, i)) * (11 - i);
    remainder = (sum * 10) % 11;
    if ((remainder === 10) || (remainder === 11)) remainder = 0;
    if (remainder !== parseInt(cpf.substring(9, 10))) return false;
    sum = 0;
    for (let i = 1; i <= 10; i++) sum = sum + parseInt(cpf.substring(i - 1, i)) * (12 - i);
    remainder = (sum * 10) % 11;
    if ((remainder === 10) || (remainder === 11)) remainder = 0;
    if (remainder !== parseInt(cpf.substring(10, 11))) return false;
    return true;
}

function isValidCNPJ(cnpj) {
    cnpj = cnpj.replace(/[^\d]+/g, '');
    if (cnpj.length !== 14 || !!cnpj.match(/(\d)\1{13}/)) return false;
    let size = cnpj.length - 2;
    let numbers = cnpj.substring(0, size);
    let digits = cnpj.substring(size);
    let sum = 0;
    let pos = size - 7;
    for (let i = size; i >= 1; i--) {
        sum += parseInt(numbers.charAt(size - i)) * pos--;
        if (pos < 2) pos = 9;
    }
    let result = sum % 11 < 2 ? 0 : 11 - (sum % 11);
    if (result !== parseInt(digits.charAt(0))) return false;
    size = size + 1;
    numbers = cnpj.substring(0, size);
    sum = 0;
    pos = size - 7;
    for (let i = size; i >= 1; i--) {
        sum += parseInt(numbers.charAt(size - i)) * pos--;
        if (pos < 2) pos = 9;
    }
    result = sum % 11 < 2 ? 0 : 11 - (sum % 11);
    if (result !== parseInt(digits.charAt(1))) return false;
    return true;
}

document.addEventListener('DOMContentLoaded', () => {
    const userTypeRadios = document.querySelectorAll('input[name="userType"]');
    const labelName = document.getElementById('label-name');
    const inputName = document.getElementById('name');
    const labelDoc = document.getElementById('label-doc');
    const inputDoc = document.getElementById('doc');
    const docError = document.getElementById('doc-error');
    const inputCelular = document.getElementById('celular');
    const inputPassword = document.getElementById('password');
    const passwordError = document.getElementById('password-error');
    const strengthBar = document.getElementById('password-strength-bar');
    const rhForm = document.getElementById('rh-form');

    const updateUserType = () => {
        const selectedType = document.querySelector('input[name="userType"]:checked').value;
        if (selectedType === 'company') {
            labelName.textContent = 'Razão Social';
            inputName.placeholder = 'Digite a razão social';
            labelDoc.textContent = 'CNPJ';
            inputDoc.placeholder = '00.000.000/0000-00';
        } else {
            labelName.textContent = 'Nome Completo';
            inputName.placeholder = 'Digite seu nome completo';
            labelDoc.textContent = 'CPF';
            inputDoc.placeholder = '000.000.000-00';
        }
        inputDoc.value = '';
        docError.textContent = ''; 
    };

    userTypeRadios.forEach(radio => radio.addEventListener('change', updateUserType));

    const handleDocInput = (e) => {
        let value = e.target.value.replace(/\D/g, '');
        const selectedType = document.querySelector('input[name="userType"]:checked').value;

        if (selectedType === 'company') {
            value = value.replace(/(\d{2})(\d)/, '$1.$2');
            value = value.replace(/(\d{3})(\d)/, '$1.$2');
            value = value.replace(/(\d{3})(\d)/, '$1/$2');
            value = value.replace(/(\d{4})(\d)/, '$1-$2');
            e.target.value = value.slice(0, 18);
        } else {
            value = value.replace(/(\d{3})(\d)/, '$1.$2');
            value = value.replace(/(\d{3})(\d)/, '$1.$2');
            value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
            e.target.value = value.slice(0, 14);
        }
        docError.textContent = ''; 
    };
    inputDoc.addEventListener('input', handleDocInput);

    const handleCelularInput = (e) => {
        let value = e.target.value.replace(/\D/g, '');
        value = value.replace(/^(\d{2})(\d)/g, '($1) $2');
        value = value.replace(/(\d{5})(\d)/, '$1-$2');
        e.target.value = value.slice(0, 15);
    };
    inputCelular.addEventListener('input', handleCelularInput);

    const checkPasswordStrength = (password) => {
        let score = 0;
        if (password.length >= 8) score++;
        if (/[A-Z]/.test(password)) score++;
        if (/[a-z]/.test(password)) score++;
        if (/[0-9]/.test(password)) score++;
        if (/[^A-Za-z0-9]/.test(password)) score++;

        let color = '#E0E0E0';
        switch (score) {
            case 1:
            case 2:
                color = '#e74c3c';
                break;
            case 3:
                color = '#f1c40f';
                break;
            case 4:
            case 5:
                color = '#2da848';
                break;
        }
        strengthBar.style.width = password.length > 0 ? `${score * 20}%` : '0%';
        strengthBar.style.backgroundColor = color;
    };
    inputPassword.addEventListener('input', (e) => {
        checkPasswordStrength(e.target.value);
        passwordError.textContent = ''; 
    });

    const clearErrors = () => {
        docError.textContent = '';
        passwordError.textContent = '';
    };

    rhForm.addEventListener('submit', (e) => {
        e.preventDefault();
        clearErrors();

        const selectedType = document.querySelector('input[name="userType"]:checked').value;
        const docValue = inputDoc.value.replace(/[^\d]+/g, ''); 

        let isDocValid = false;
        if (selectedType === 'company') {
            isDocValid = isValidCNPJ(docValue);
            if (!isDocValid) {
                docError.textContent = 'Por favor, insira um CNPJ válido.';
            }
        } else {
            isDocValid = isValidCPF(docValue);
            if (!isDocValid) {
                docError.textContent = 'Por favor, insira um CPF válido.';
            }
        }

        const password = inputPassword.value;
        if (password.length < 8) {
            passwordError.textContent = 'Sua senha deve ter pelo menos 8 caracteres.';
        }
    });

    updateUserType();
});

document.addEventListener('DOMContentLoaded', function() {
    const backBtn = document.getElementById('backToHomeBtn');
    if (backBtn) {
        backBtn.addEventListener('click', function() {
            window.location.href = '/';
        });
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const alreadyBtn = document.getElementById('alreadyAccountBtn');
    if (alreadyBtn) {
        alreadyBtn.addEventListener('click', function() {
            window.location.href = '/pages/login/login.blade.php';
        });
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const testimonials = [
        {
            text: '"A plataforma é intuitiva e me ajudou a encontrar o candidato ideal em menos de uma semana. Recomendo!"',
            author: 'Ana Silva, Gerente de RH',
            stars: '★★★★★'
        },
        {
            text: '"O cadastro foi rápido e já comecei a receber propostas de emprego. Excelente!"',
            author: 'Lucas Pereira, Candidato',
            stars: '★★★★★'
        },
        {
            text: '"A equipe de suporte é muito atenciosa. Recomendo para empresas e profissionais."',
            author: 'Fernanda Costa, Recrutadora',
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