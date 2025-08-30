document.addEventListener("DOMContentLoaded", function() {
    let currentTab = 0;
    const tabs = document.querySelectorAll(".tab-content");
    const steps = document.querySelectorAll(".step");
    const prevBtn = document.getElementById("prevBtn");
    const nextBtn = document.getElementById("nextBtn");

    const tipoUsuarioToggle = document.getElementById('tipoUsuarioToggle');
    const tipoUsuarioInput = document.getElementById('tipo_usuario');

    tipoUsuarioToggle.addEventListener('change', function() {
        if (this.checked) {
            // Se estiver marcado, o usuário é 'empresa'
            tipoUsuarioInput.value = 'empresa';
        } else {
            // Se não, é 'colaborador'
            tipoUsuarioInput.value = 'colaborador';
        }
        console.log('Tipo de usuário selecionado:', tipoUsuarioInput.value); // Para teste
    });

     showTab(currentTab);

    showTab(currentTab);

    function showTab(n) {
        // Exibe a aba atual e oculta as outras
        tabs.forEach((tab, index) => {
            tab.style.display = (index === n) ? "block" : "none";
        });

        // Atualiza o indicador de progresso
        updateStepIndicator(n);

        // Configura os botões
        prevBtn.style.display = (n === 0) ? "none" : "inline";
        nextBtn.innerHTML = (n === tabs.length - 1) ? "Finalizar Cadastro" : "Próximo";

        // Se for a última aba, o botão vira "submit"
        if (n === tabs.length - 1) {
            nextBtn.type = "submit";
        } else {
            nextBtn.type = "button";
        }
    }

    function navigate(n) {
        // Valida a aba atual antes de prosseguir
        if (n === 1 && !validateForm()) return false;

        // Esconde a aba atual e avança
        tabs[currentTab].style.display = "none";
        currentTab = currentTab + n;

        if (currentTab >= tabs.length) {
            // Se chegou ao fim, submete o formulário
            document.getElementById("regForm").submit();
            return false;
        }
        showTab(currentTab);
    }
    
    function updateStepIndicator(n) {
        steps.forEach((step, index) => {
            if (index < n) {
                step.classList.add("active"); // Etapas passadas
            } else if (index === n) {
                step.classList.add("active"); // Etapa atual
            } else {
                step.classList.remove("active"); // Etapas futuras
            }
        });
    }

    function validateForm() {
        let valid = true;
        const currentTabInputs = tabs[currentTab].querySelectorAll("input[required]");

        currentTabInputs.forEach(input => {
            // Limpa erros anteriores
            clearError(input);

            // Validação genérica para campos vazios
            if (input.value.trim() === "" && input.type !== 'checkbox') {
                showError(input, "Este campo é obrigatório.");
                valid = false;
            }
            // Validação para checkbox
            if (input.type === 'checkbox' && !input.checked) {
                showError(input, "Você precisa aceitar os termos.");
                valid = false;
            }
            // Validação para email
            if (input.type === 'email' && input.value.trim() !== "" && !isValidEmail(input.value)) {
                showError(input, "Por favor, insira um e-mail válido.");
                valid = false;
            }
            // Validação para confirmação de senha
            if (input.name === 'confirmaSenha') {
                const senha = document.getElementById('senha').value;
                if (input.value !== senha) {
                    showError(input, "As senhas não coincidem.");
                    valid = false;
                }
            }
        });

        return valid;
    }

    function showError(input, message) {
        const inputGroup = input.parentElement;
        const errorSpan = inputGroup.querySelector(".error-message");
        input.classList.add("invalid");
        if (errorSpan) {
            errorSpan.textContent = message;
        }
    }

    function clearError(input) {
        const inputGroup = input.parentElement;
        const errorSpan = inputGroup.querySelector(".error-message");
        input.classList.remove("invalid");
        if (errorSpan) {
            errorSpan.textContent = "";
        }
    }

    function isValidEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(String(email).toLowerCase());
    }

    // Adiciona os eventos aos botões
    prevBtn.addEventListener("click", () => navigate(-1));
    nextBtn.addEventListener("click", () => {
        if (nextBtn.type !== 'submit') {
            navigate(1);
        }
    });

});