document.addEventListener("DOMContentLoaded", function() {
    let currentTab = 0; // A aba atual é definida como a primeira aba (0)
    const tabs = document.getElementsByClassName("tab-content");
    const prevBtn = document.getElementById("prevBtn");
    const nextBtn = document.getElementById("nextBtn");
    const form = document.getElementById("regForm");
    const tipoUsuarioToggle = document.getElementById("tipoUsuarioToggle");
    const tipoUsuarioInput = document.getElementById("tipo_usuario");

    showTab(currentTab); // Exibe a aba atual

    function showTab(n) {
        // Esta função exibe a aba especificada do formulário...
        if (tabs[n]) {
            tabs[n].style.display = "block";
        }
        
        // ... e corrige os botões Anterior/Próximo:
        if (n === 0) {
            prevBtn.style.display = "none";
        } else {
            prevBtn.style.display = "inline";
        }

        if (n === (tabs.length - 1)) {
            nextBtn.innerHTML = "Finalizar Cadastro";
        } else {
            nextBtn.innerHTML = "Próximo";
        }
        
        // ... e executa uma função que exibe o indicador de etapa correto:
        updateStepIndicator(n);
    }

    function nextPrev(n) {
        // Esta função descobrirá qual aba exibir
        
        // Sai da função se algum campo na aba atual for inválido ao avançar
        if (n === 1 && !validateForm()) {
            return false;
        }

        // Oculta a aba atual:
        if (tabs[currentTab]) {
            tabs[currentTab].style.display = "none";
        }
        
        // Aumenta ou diminui a aba atual em 1:
        currentTab = currentTab + n;
        
        // Se você chegou ao final do formulário...
        if (currentTab >= tabs.length) {
            // ... o formulário é enviado. Esta é a lógica corrigida.
            form.submit();
            return false;
        }
        
        // Caso contrário, exibe a aba correta:
        showTab(currentTab);
    }

    function validateForm() {
        // Esta função lida com a validação dos campos do formulário
        let valid = true;
        const currentTabInputs = tabs[currentTab].querySelectorAll("input[required]");
        
        currentTabInputs.forEach(input => {
            const errorSpan = input.parentElement.querySelector('.error-message');
            if (errorSpan) {
                errorSpan.textContent = ''; // Limpa mensagens de erro anteriores
            }
            input.classList.remove('invalid');

            if (input.type !== 'checkbox' && !input.value.trim()) {
                showError(input, "Este campo é obrigatório.");
                valid = false;
            } else if (input.type === 'email' && !/^\S+@\S+\.\S+$/.test(input.value)) {
                showError(input, "Por favor, insira um e-mail válido.");
                valid = false;
            }
        });

        // Validação específica de confirmação de senha na primeira aba
        if (currentTab === 0) {
            const senha = document.getElementById("senha");
            const confirmaSenha = document.querySelector("input[name='confirmaSenha']");
            if (senha.value !== confirmaSenha.value) {
                showError(confirmaSenha, "As senhas não coincidem.");
                valid = false;
            }
        }

        return valid;
    }

    function showError(input, message) {
        const errorSpan = input.parentElement.querySelector('.error-message');
        if (errorSpan) {
            errorSpan.textContent = message;
        }
        input.classList.add('invalid');
    }

    function updateStepIndicator(n) {
        const steps = document.getElementsByClassName("step");
        for (let i = 0; i < steps.length; i++) {
            steps[i].classList.remove("active");
        }
        if (steps[n]) {
            steps[n].classList.add("active");
        }
    }

    // Event Listeners
    nextBtn.addEventListener("click", () => nextPrev(1));
    prevBtn.addEventListener("click", () => nextPrev(-1));
    
    tipoUsuarioToggle.addEventListener("change", function() {
        tipoUsuarioInput.value = this.checked ? "empresa" : "colaborador";
    });
});
