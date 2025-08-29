<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../../../../assets/images/global/RHconexao-logo.svg" type="image/png">
    <title>Minhas Candidaturas - Conexão RH</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- js -->
    <script defer src="../../../../assets/js/global/script.js"></script>
    <script defer src="../../../../assets/js/global/auth-guard.js"></script>
    <script defer src="../../../../assets/js/pages/candidaturas/candidaturas.js"></script>

    <!-- css -->
    <link rel="stylesheet" href="../../../../assets/css/pages/candidaturas/candidaturas.css">
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
                    <li><a href="{{ route('colaborador.dashboard') }}" class="menu-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" x2="16.65" y1="21" y2="16.65"></line></svg>
                        <span>Buscar Vagas</span>
                    </a></li>
                    <li><a href="{{ route('candidaturas.index') }}" class="menu-item active">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15.5 2H8.6c-.4 0-.8.2-1.1.5-.3.3-.5.7-.5 1.1V21c0 .4.2.8.5 1.1.3.3.7.5 1.1.5h10.8c.4 0 .8-.2 1.1-.5.3-.3.5-.7.5-1.1V8.4L15.5 2z"></path><path d="M15 2v7h7"></path></svg>
                        <span>Minhas Candidaturas</span>
                    </a></li>
                    <li><a href="{{ route('ia.index') }}" class="menu-item">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 9a3 3 0 0 1 3-3m-2 15h4m0-3c0-4.1 4-4.9 4-9A6 6 0 1 0 6 9c0 4 4 5 4 9h4Z"/>
                        </svg>
                        <span>Assistente IA </span>
                    </a></li>
                    <li><a href="{{ route('curriculo.index') }}" class="menu-item">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7h1v12a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1V5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h11.5M7 14h6m-6 3h6m0-10h.5m-.5 3h.5M7 7h3v3H7V7Z"/>
                        </svg>
                        <span>Curriculo</span>
                    </a></li>

                    <li><a href="{{ route('exclusivos.index') }}" class="menu-item">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 9H5a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h6m0-6v6m0-6 5.419-3.87A1 1 0 0 1 18 5.942v12.114a1 1 0 0 1-1.581.814L11 15m7 0a3 3 0 0 0 0-6M6 15h3v5H6v-5Z"/>
                        </svg>
                        <span>Contúdos Exclusivos</span>
                    </a></li>
                    <li><a href="{{ route('perfil.index') }}" class="menu-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        <span>Meu Perfil</span>
                    </a></li>
                    <h3>Outros</h3>
                </ul>
            </nav>

            <div class="sidebar-footer">
                <a href="{{ route('configuracoes.index') }}" class="menu-item">
                    <svg class="icone-config" width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd" stroke="currentColor" fill="currentColor"><path d="M12 8.666c-1.838 0-3.333 1.496-3.333 3.334s1.495 3.333 3.333 3.333 3.333-1.495 3.333-3.333-1.495-3.334-3.333-3.334m0 7.667c-2.39 0-4.333-1.943-4.333-4.333s1.943-4.334 4.333-4.334 4.333 1.944 4.333 4.334c0 2.39-1.943 4.333-4.333 4.333m-1.193 6.667h2.386c.379-1.104.668-2.451 2.107-3.05 1.496-.617 2.666.196 3.635.672l1.686-1.688c-.508-1.047-1.266-2.199-.669-3.641.567-1.369 1.739-1.663 3.048-2.099v-2.388c-1.235-.421-2.471-.708-3.047-2.098-.572-1.38.057-2.395.669-3.643l-1.687-1.686c-1.117.547-2.221 1.257-3.642.668-1.374-.571-1.656-1.734-2.1-3.047h-2.386c-.424 1.231-.704 2.468-2.099 3.046-.365.153-.718.226-1.077.226-.843 0-1.539-.392-2.566-.893l-1.687 1.686c.574 1.175 1.251 2.237.669 3.643-.571 1.375-1.734 1.654-3.047 2.098v2.388c1.226.418 2.468.705 3.047 2.098.581 1.403-.075 2.432-.669 3.643l1.687 1.687c1.45-.725 2.355-1.204 3.642-.669 1.378.572 1.655 1.738 2.1 3.047m3.094 1h-3.803c-.681-1.918-.785-2.713-1.773-3.123-1.005-.419-1.731.132-3.466.952l-2.689-2.689c.873-1.837 1.367-2.465.953-3.465-.412-.991-1.192-1.087-3.123-1.773v-3.804c1.906-.678 2.712-.782 3.123-1.773.411-.991-.071-1.613-.953-3.466l2.689-2.688c1.741.828 2.466 1.365 3.465.953.992-.412 1.082-1.185 1.775-3.124h3.802c.682 1.918.788 2.714 1.774 3.123 1.001.416 1.709-.119 3.467-.952l2.687 2.688c-.878 1.847-1.361 2.477-.952 3.465.411.992 1.192 1.087 3.123 1.774v3.805c-1.906.677-2.713.782-3.124 1.773-.403.975.044 1.561.954 3.464l-2.688 2.689c-1.728-.82-2.467-1.37-3.456-.955-.988.41-1.08 1.146-1.785 3.126"/></svg> 
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
                <h1>Minhas Candidaturas</h1>
                <p>Acompanhe o status dos processos seletivos para os quais você se candidatou.</p>
            </header>

            <div class="applications-grid">

                <article class="application-card">
                    <div class="card-header">
                        <h2>UI/UX Designer Sênior</h2>
                        <span class="status-badge analise">Em Análise</span>
                    </div>
                    <div class="card-body">
                        <p class="card-info">Creative Minds &bull; Candidatura em 15/06/2025</p>
                        <div class="status-tracker">
                            <div class="tracker-step completed"><div class="step-icon">✔</div><div class="step-label">Enviada</div></div>
                            <div class="tracker-step active"><div class="step-icon">2</div><div class="step-label">Em Análise</div></div>
                            <div class="tracker-step"><div class="step-icon">3</div><div class="step-label">Entrevista</div></div>
                            <div class="tracker-step"><div class="step-icon">4</div><div class="step-label">Finalizado</div></div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="#" class="btn btn-secondary">Ver Vaga</a>
                    </div>
                </article>

                <article class="application-card">
                    <div class="card-header">
                        <h2>Desenvolvedor(a) Full-Stack</h2>
                        <span class="status-badge entrevista">Entrevista</span>
                    </div>
                    <div class="card-body">
                        <p class="card-info">Tech Solutions Inc. &bull; Candidatura em 10/06/2025</p>
                        <div class="status-tracker">
                            <div class="tracker-step completed"><div class="step-icon">✔</div><div class="step-label">Enviada</div></div>
                            <div class="tracker-step completed"><div class="step-icon">✔</div><div class="step-label">Em Análise</div></div>
                            <div class="tracker-step active"><div class="step-icon">3</div><div class="step-label">Entrevista</div></div>
                            <div class="tracker-step"><div class="step-icon">4</div><div class="step-label">Finalizado</div></div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="#" class="btn btn-secondary">Ver Vaga</a>
                    </div>
                </article>

                <article class="application-card">
                    <div class="card-header">
                        <h2>Analista de Marketing Digital</h2>
                        <span class="status-badge finalizado">Finalizado</span>
                    </div>
                    <div class="card-body">
                        <p class="card-info">Growth Hackers Co. &bull; Candidatura em 01/05/2025</p>
                        <div class="status-tracker">
                            <div class="tracker-step completed"><div class="step-icon">✔</div><div class="step-label">Enviada</div></div>
                            <div class="tracker-step completed"><div class="step-icon">✔</div><div class="step-label">Em Análise</div></div>
                            <div class="tracker-step completed"><div class="step-icon">✔</div><div class="step-label">Entrevista</div></div>
                            <div class="tracker-step active"><div class="step-icon">4</div><div class="step-label">Finalizado</div></div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="#" class="btn btn-danger">Retirar Candidatura</a>
                    </div>
                </article>

            </div>
        </main>
    </div>
</body>
</html>