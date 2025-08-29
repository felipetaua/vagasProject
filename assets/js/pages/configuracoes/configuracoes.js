document.addEventListener('DOMContentLoaded', () => {
    const navLinks = document.querySelectorAll('.settings-nav a');
    const panes = document.querySelectorAll('.settings-pane');

    navLinks.forEach(link => {
        link.addEventListener('click', (event) => {
            event.preventDefault();

            // Remove 'active' de todos
            navLinks.forEach(l => l.classList.remove('active'));
            panes.forEach(p => p.classList.remove('active'));

            // Adiciona 'active' ao clicado e ao seu alvo
            link.classList.add('active');
            const targetId = link.dataset.target;
            const targetPane = document.getElementById(targetId);
            if (targetPane) {
                targetPane.classList.add('active');
            }
        });
    });

    
    // --- Lógica para Carregar Dados do Usuário no Formulário ---
    function loadUserData() {
        const userData = JSON.parse(localStorage.getItem('user'));
        if (!userData) {
            console.error('Dados do usuário não encontrados. Faça o login novamente.');
            return;
        }

        // Popula os campos do formulário de perfil
        const nameInput = document.getElementById('name');
        const emailInput = document.getElementById('email');

        if (nameInput) nameInput.value = userData.name || '';
        if (emailInput) emailInput.value = userData.email || '';
    }

    loadUserData();
});