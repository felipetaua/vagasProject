document.addEventListener('DOMContentLoaded', () => {
    // --- LÓGICA DE LOGOUT (SAIR) ---
    const logoutBtn = document.getElementById('logout-btn');
    if (logoutBtn) {
        logoutBtn.addEventListener('click', (event) => {
            event.preventDefault();
            
            localStorage.removeItem('authToken');
            localStorage.removeItem('user');
            
            // Redireciona para a página de login
            window.location.href = '/pages/login/login.blade.php';
        });
    }

    // --- LÓGICA DAS ABAS (TABS) ---
    const tabButtons = document.querySelectorAll('.tab-btn');
    const tabPanes = document.querySelectorAll('.tab-pane');

    if (tabButtons.length > 0 && tabPanes.length > 0) {
        tabButtons.forEach(button => {
            button.addEventListener('click', () => {
                tabButtons.forEach(btn => btn.classList.remove('active'));
                tabPanes.forEach(pane => pane.classList.remove('active'));

                button.classList.add('active');
                const targetPane = document.querySelector(button.dataset.target);
                if (targetPane) {
                    targetPane.classList.add('active');
                }
            });
        });
    }

    // --- LÓGICA DO SUBMENU (VAGAS) ---
    const vagasTrigger = document.querySelector('.menu-item-trigger');
    if (vagasTrigger) {
        const submenu = vagasTrigger.nextElementSibling;
        const currentPage = window.location.pathname.split('/').pop().toLowerCase().trim();

        if (submenu && ['vagas', 'ativo', 'arquivadas'].some(page => currentPage.includes(page))) {
            vagasTrigger.classList.add('open', 'active');
            submenu.classList.add('open');
        }

        vagasTrigger.addEventListener('click', () => {
            submenu.classList.toggle('open');
            vagasTrigger.classList.toggle('open');
        });
    }

    // --- LÓGICA DE ATUALIZAÇÃO DO PREVIEW (CADASTRO DE VAGA) ---
    const fieldsToUpdate = {
        'jobTitle': 'previewTitle',
        'department': 'previewDepartment',
        'location': 'previewLocation',
        'workModel': 'previewWorkModel',
        'jobDescription': 'previewDescription',
    };
    for (const inputId in fieldsToUpdate) {
        const inputElement = document.getElementById(inputId);
        const previewElementId = fieldsToUpdate[inputId];
        const previewElement = document.getElementById(previewElementId);
        if (inputElement && previewElement) {
            // Salva o placeholder inicial
            previewElement.dataset.placeholder = previewElement.textContent;
            inputElement.addEventListener('input', () => {
                previewElement.textContent = inputElement.value || previewElement.dataset.placeholder;
            });
        }
    }
    const salaryInput = document.getElementById('salary');
    const salaryPreview = document.getElementById('previewSalary');
    const salaryHidden = document.getElementById('salaryHidden');
    if (salaryInput && salaryPreview && salaryHidden) {
        salaryPreview.dataset.placeholder = salaryPreview.innerHTML; // Salva o placeholder
        const updateSalaryPreview = () => {
            if (salaryHidden.checked) {
                salaryPreview.innerHTML = `<span style="color:#888">Salário a combinar</span>`;
            } else if (salaryInput.value) {
                const value = parseFloat(salaryInput.value) || 0;
                const formattedSalary = value.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
                salaryPreview.innerHTML = `${formattedSalary} <span>/mês</span>`;
            } else {
                salaryPreview.innerHTML = salaryPreview.dataset.placeholder;
            }
        }
        salaryInput.addEventListener('input', updateSalaryPreview);
        salaryHidden.addEventListener('change', updateSalaryPreview);
    }

    // --- LÓGICA DO MENU MOBILE ---
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const sidebar = document.getElementById('sidebar');
    if (mobileMenuBtn && sidebar) {
        mobileMenuBtn.addEventListener('click', () => {
            sidebar.classList.toggle('show');
        });

        document.addEventListener('click', (event) => {
            const isClickInsideSidebar = sidebar.contains(event.target);
            const isClickOnMenuBtn = mobileMenuBtn.contains(event.target);
            if (!isClickInsideSidebar && !isClickOnMenuBtn && sidebar.classList.contains('show')) {
                sidebar.classList.remove('show');
            }
        });
    }
    
    // --- LÓGICA DO POPUP DE NOTIFICAÇÃO ---
    const notificationBtn = document.getElementById('notification-trigger');
    const notificationPopup = document.getElementById('notification-popup');
    if (notificationBtn && notificationPopup) {
        notificationBtn.addEventListener('click', function (event) {
            event.stopPropagation(); 
            notificationPopup.classList.toggle('active');
        });
        window.addEventListener('click', function (event) {
            if (notificationPopup.classList.contains('active') && !notificationPopup.contains(event.target)) {
                notificationPopup.classList.remove('active');
            }
        });
    }
});