document.addEventListener('DOMContentLoaded', function() {
    var currentTab = 0; // A aba atual é definida como a primeira (0)

    // --- Lógica para formulário de múltiplos passos ---

    function showTab(n) {
        var x = document.getElementsByClassName("tab-content");
        if (!x[n]) return;

        x[n].style.display = "block";
        
        document.getElementById("prevBtn").style.display = (n === 0) ? "none" : "inline";
        
        if (n === (x.length - 1)) {
            document.getElementById("nextBtn").innerHTML = "Cadastrar";
        } else {
            document.getElementById("nextBtn").innerHTML = "Próximo";
        }
        
        fixStepIndicator(n);
    }

    function nextPrev(n) {
        var x = document.getElementsByClassName("tab-content");
        
        if (n === 1 && !validateForm()) return false;
        
        x[currentTab].style.display = "none";
        currentTab = currentTab + n;
        
        if (currentTab >= x.length) {
            document.getElementById("regForm").submit();
            return false;
        }
        
        showTab(currentTab);
    }

    function validateForm() {
        var x, y, i, valid = true;
        x = document.getElementsByClassName("tab-content");
        y = x[currentTab].getElementsByTagName("input");
        
        for (i = 0; i < y.length; i++) {
            if (y[i].required && y[i].value === "") {
                y[i].classList.add("invalid");
                valid = false;
            } else {
                y[i].classList.remove("invalid");
            }
        }
        
        if (valid) {
            document.getElementsByClassName("step")[currentTab].classList.add("finish");
        }
        
        return valid;
    }

    function fixStepIndicator(n) {
        var i, x = document.getElementsByClassName("step");
        for (i = 0; i < x.length; i++) {
            x[i].classList.remove("active");
        }
        if (x[n]) {
            x[n].classList.add("active");
        }
    }

    // --- Lógica para campos dinâmicos (Candidato/Empresa) ---

    const userTypeRadios = document.querySelectorAll('input[name="userType"]');
    const labelName = document.getElementById('label-name');
    const inputName = document.getElementById('name');
    const labelDoc = document.getElementById('label-doc');
    const inputDoc = document.getElementById('doc');
    const candidateFields = document.getElementById('candidate-fields');
    const dtNascimentoInput = document.getElementById('dtNascimento');

    function updateUserType() {
        const selectedType = document.querySelector('input[name="userType"]:checked').value;
        
        if (selectedType === 'company') {
            labelName.textContent = 'Razão Social';
            inputName.placeholder = 'Digite a razão social';
            
            labelDoc.textContent = 'CNPJ';
            inputDoc.placeholder = '00.000.000/0000-00';

            // Esconde campos de candidato e remove a obrigatoriedade
            candidateFields.style.display = 'none';
            dtNascimentoInput.required = false;
        } else { // candidate
            labelName.textContent = 'Nome Completo';
            inputName.placeholder = 'Digite seu nome completo';

            labelDoc.textContent = 'CPF';
            inputDoc.placeholder = '000.000.000-00';

            // Mostra campos de candidato e define a obrigatoriedade
            candidateFields.style.display = 'block';
            dtNascimentoInput.required = true;
        }
        // Limpa o valor do campo de documento ao trocar o tipo
        inputDoc.value = '';
    }

    // --- Inicialização e Eventos ---

    // Exibe a primeira aba
    showTab(currentTab);

    // Adiciona eventos aos botões de navegação
    document.getElementById('nextBtn').addEventListener('click', () => nextPrev(1));
    document.getElementById('prevBtn').addEventListener('click', () => nextPrev(-1));

    // Adiciona eventos aos seletores de tipo de usuário
    userTypeRadios.forEach(radio => radio.addEventListener('change', updateUserType));

    // Define o estado inicial dos campos dinâmicos
    updateUserType();
});