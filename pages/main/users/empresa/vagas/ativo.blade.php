<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../../../../assets/images/global/RHconexao-logo.svg" type="image/png">
    <title>Vagas Ativas - Conexão RH</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- css -->
    <link rel="stylesheet" href="../../../../../assets/css/pages/vagas-ativas/vagas-ativas.css">

    <!-- js -->
    <script defer src="../../../../../assets/js/global/script.js"></script>
    <script defer src="../../../../../assets/js/global/auth-guard.js"></script>
    <script defer src="./../../../../../assets/js/pages/ativo/ativo.js"></script>
    <style>
        /* Estilos adicionais para interatividade e feedback */
        .candidate-list-container {
            display: none;
            background-color: #fdfdff;
            border: 1px solid #eef;
            border-radius: 0 0 16px 16px;
            margin: 0 1.5rem;
            padding: 1.5rem;
            border-top: none;
        }
        .job-summary-card.open .candidate-list-container {
            display: block;
        }
        .job-listing-wrapper .info-message,
        .job-listing-wrapper .loading-message {
            text-align: center;
            padding: 2rem;
            font-size: 1.1rem;
            color: var(--text-light);
            background-color: var(--white-color);
            border-radius: 16px;
        }
        .candidate-table { width: 100%; border-collapse: collapse; margin-top: 1rem; }
        .candidate-table th, .candidate-table td { padding: 0.75rem 1rem; text-align: left; border-bottom: 1px solid #eef; }
        .candidate-table th { font-weight: 600; color: var(--text-light); font-size: 0.9rem; }
        .candidate-info { display: flex; align-items: center; gap: 0.75rem; }
        .candidate-info img { width: 36px; height: 36px; border-radius: 50%; object-fit: cover; }
        .status-tag { font-size: 0.8rem; font-weight: 600; padding: 0.3rem 0.8rem; border-radius: 12px; }
        .status-tag.status-triagem { background-color: #e0f2fe; color: #0ea5e9; }
        .status-tag.status-revisao { background-color: #fef3c7; color: #f59e0b; }
        .status-tag.status-entrevista { background-color: #dcfce7; color: #22c55e; }
        .error-message { color: #f95a5a; }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="logo-icon">
                    <img class="logo-img" src="../../../../../assets/images/global/RHconexao-logo.svg" alt="logo RH Conexão">
                </div>
                <h1 class="logo-text">RH Conexão</h1>
            </div>
            <nav class="sidebar-menu">
                <h3>Menu Principal</h3>
                <ul>
                    <li><a href="../empresa.blade.php" class="menu-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                        <span>Dashboard</span>
                    </a></li>
                    
                    <li class="menu-item-collapsible">
                        <div class="menu-item menu-item-trigger" id="vagas-trigger">
                            <div class="menu-main-link ">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="7" height="9" x="3" y="3" rx="1"></rect><rect width="7" height="5" x="14" y="3" rx="1"></rect><rect width="7" height="9" x="14" y="12" rx="1"></rect><rect width="7" height="5" x="3" y="16" rx="1"></rect></svg>
                                <span>Vagas</span>
                            </div>
                            <svg class="chevron-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        </div>
                        <ul class="submenu">
                            <li><a href="./vagas.blade.php" class="submenu-item ">Criar vagas</a></li>
                            <li><a href="./ativo.blade.php" class="submenu-item active">Vagas Ativas</a></li>
                            <li><a href="./arquivadas.blade.php" class="submenu-item">Arquivadas</a></li>
                        </ul>
                    </li>

                    <li><a href="../candidatos.blade.php" class="menu-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" stroke="none"><path d="M9.602 3.7c-1.154 1.937-.635 5.227 1.424 9.025.93 1.712.697 3.02.338 3.815-.982 2.178-3.675 2.799-6.525 3.456-1.964.454-1.839.87-1.839 4.004h-1.995l-.005-1.241c0-2.52.199-3.975 3.178-4.663 3.365-.777 6.688-1.473 5.09-4.418-4.733-8.729-1.35-13.678 3.732-13.678 3.321 0 5.97 2.117 5.97 6.167 0 3.555-1.949 6.833-2.383 7.833h-2.115c.392-1.536 2.499-4.366 2.499-7.842 0-5.153-5.867-4.985-7.369-2.458zm13.398 15.3h-3v-3h-2v3h-3v2h3v3h2v-3h3v-2z"/></svg>
                        <span>Candidatos</span>
                    </a></li>
                    <li><a href="../entrevistas.blade.php" class="menu-item ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"></rect><line x1="16" x2="16" y1="2" y2="6"></line><line x1="8" x2="8" y1="2" y2="6"></line><line x1="3" x2="21" y1="10" y2="10"></line></svg>
                        <span>Entrevistas</span>
                    </a></li>
                    <li><a href="../organizacao.blade.php" class="menu-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12.22 2h-4.44a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8.38M18 14v-4h-4M14 2v4h4"></path></svg>
                        <span>Organização</span>
                    </a></li>
                </ul>

                <h3>Outros</h3>
                
            </nav>

            <div class="sidebar-footer">
                <a href="../configuracoes.blade.php" class="menu-item">
                    <svg class="icone-config" width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd" stroke="currentColor"><path d="M12 8.666c-1.838 0-3.333 1.496-3.333 3.334s1.495 3.333 3.333 3.333 3.333-1.495 3.333-3.333-1.495-3.334-3.333-3.334m0 7.667c-2.39 0-4.333-1.943-4.333-4.333s1.943-4.334 4.333-4.334 4.333 1.944 4.333 4.334c0 2.39-1.943 4.333-4.333 4.333m-1.193 6.667h2.386c.379-1.104.668-2.451 2.107-3.05 1.496-.617 2.666.196 3.635.672l1.686-1.688c-.508-1.047-1.266-2.199-.669-3.641.567-1.369 1.739-1.663 3.048-2.099v-2.388c-1.235-.421-2.471-.708-3.047-2.098-.572-1.38.057-2.395.669-3.643l-1.687-1.686c-1.117.547-2.221 1.257-3.642.668-1.374-.571-1.656-1.734-2.1-3.047h-2.386c-.424 1.231-.704 2.468-2.099 3.046-.365.153-.718.226-1.077.226-.843 0-1.539-.392-2.566-.893l-1.687 1.686c.574 1.175 1.251 2.237.669 3.643-.571 1.375-1.734 1.654-3.047 2.098v2.388c1.226.418 2.468.705 3.047 2.098.581 1.403-.075 2.432-.669 3.643l1.687 1.687c1.45-.725 2.355-1.204 3.642-.669 1.378.572 1.655 1.738 2.1 3.047m3.094 1h-3.803c-.681-1.918-.785-2.713-1.773-3.123-1.005-.419-1.731.132-3.466.952l-2.689-2.689c.873-1.837 1.367-2.465.953-3.465-.412-.991-1.192-1.087-3.123-1.773v-3.804c1.906-.678 2.712-.782 3.123-1.773.411-.991-.071-1.613-.953-3.466l2.689-2.688c1.741.828 2.466 1.365 3.465.953.992-.412 1.082-1.185 1.775-3.124h3.802c.682 1.918.788 2.714 1.774 3.123 1.001.416 1.709-.119 3.467-.952l2.687 2.688c-.878 1.847-1.361 2.477-.952 3.465.411.992 1.192 1.087 3.123 1.774v3.805c-1.906.677-2.713.782-3.124 1.773-.403.975.044 1.561.954 3.464l-2.688 2.689c-1.728-.82-2.467-1.37-3.456-.955-.988.41-1.08 1.146-1.785 3.126"/></svg> 
                    <span>Configurações</span>
                </a>
                <a href="#" id="logout-btn" class="menu-item" style="color: #f95a5a;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                    <span>Sair</span>
                </a>
            </div>
        </aside>

        <main class="main-content">
            <header class="main-header">
                <button class="mobile-menu-btn" id="mobile-menu-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
                </button>
                <div class="search-bar">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" x2="16.65" y1="21" y2="16.65"></line></svg>
                    <input type="text" placeholder="Buscar vagas ou candidatos...">
                </div>
                <div class="header-profile">
                    <button class="notification-btn" id="notification-trigger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                    </button>

                    <div class="notification-popup" id="notification-popup">
                        <div class="popup-header">
                            <h3>Notificações</h3>
                        </div>
                        <div class="popup-body">
                            <div class="notification-card unread">
                                <div class="notification-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><polyline points="17 11 19 13 23 9"></polyline></svg>
                                </div>
                                <div class="notification-content">
                                    <p><strong>João da Silva</strong> se aplicou para a vaga de <strong>Eng. de Software</strong>.</p>
                                    <div class="notification-timestamp">há 2 minutos</div>
                                </div>
                            </div>
                            <div class="notification-card unread">
                                <div class="notification-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 9a2 2 0 0 1-2-2H6l-4 4V4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v5Z"></path><path d="M18 9h2a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2h-2"></path><path d="m7 15-1 1 1 1"></path><path d="M10 15h4"></path></svg>
                                </div>
                                <div class="notification-content">
                                    <p>Nova mensagem de <strong>Mariana Costa</strong> sobre a vaga de Analista.</p>
                                    <div class="notification-timestamp">há 15 minutos</div>
                                </div>
                            </div>
                            <div class="notification-card">
                                <div class="notification-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"></rect><line x1="16" x2="16" y1="2" y2="6"></line><line x1="8" x2="8" y1="2" y2="6"></line><line x1="3" x2="21" y1="10" y2="10"></line></svg>
                                </div>
                                <div class="notification-content">
                                    <p>Sua entrevista com <strong>Pedro Alencar</strong> foi reagendada.</p>
                                    <div class="notification-timestamp">há 1 hora</div>
                                </div>
                            </div>
                        </div>
                        <div class="popup-footer">
                            <a href="#">Ver todas as notificações</a>
                        </div>
                    </div>

                    <div class="user-info">
                        <img src="https://i.pravatar.cc/150?img=68" alt="Jason Ranti">
                    </div>
                </div>
            </header>
            <header class="page-header">
                <h1>Vagas Ativas</h1>
                <div class="page-actions">
                    <select class="filter-select">
                        <option>Todos os Departamentos</option>
                        <option>Tecnologia</option>
                        <option>Marketing</option>
                    </select>
                    <a href="./vagas.blade.php" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                        <span>Criar Nova Vaga</span>
                    </a>
                </div>
            </header>

            <div class="job-listing-wrapper">
                <!-- Os cards de vagas serão inseridos aqui pelo JavaScript -->
                <p class="loading-message">Carregando vagas...</p>
            </div>
        </main>
    </div>

<script>
    // Script para o menu lateral expansível
    document.addEventListener('DOMContentLoaded', () => {
        const vagasTrigger = document.getElementById('vagas-trigger');
        if (vagasTrigger) {
            vagasTrigger.addEventListener('click', (event) => {
                event.preventDefault();
                const submenu = vagasTrigger.nextElementSibling;
                vagasTrigger.classList.toggle('open');
                submenu.classList.toggle('open');
            });
        }
    });
</script>
</body>
</html>