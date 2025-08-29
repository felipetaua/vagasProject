<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../../../assets/images/global/RHconexao-logo.svg" type="image/png">
    <title>Assistente IA - Conexão RH</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- js -->
    <script defer src="../../../../assets/js/global/script.js"></script>
    <script defer src="../../../../assets/js/pages/ia/ia.js"></script>
    <script defer src="../../../../assets/js/global/auth-guard.js"></script>
    <!-- css -->
    <link rel="stylesheet" href="../../../../assets/css/pages/ia/ia.css">
    <style>        
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { background-color: var(--background-color); color: var(--text-dark); }
        a { text-decoration: none; color: inherit; }
        ul { list-style: none; }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="logo-icon">
                    <img class="logo-img" src="../../../../assets/images/global/RHconexao-logo.svg" alt="logo RH Conexão">
                </div>
                <h1 class="logo-text">RH Conexão</h1>
            </div>

            <nav class="sidebar-menu">
                <h3>Menu Principal</h3>
                <ul>
                    <li><a href="./colaborador.blade.php" class="menu-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" x2="16.65" y1="21" y2="16.65"></line></svg>
                        <span>Buscar Vagas</span>
                    </a></li>
                    <li><a href="./candidaturas.blade.php" class="menu-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15.5 2H8.6c-.4 0-.8.2-1.1.5-.3.3-.5.7-.5 1.1V21c0 .4.2.8.5 1.1.3.3.7.5 1.1.5h10.8c.4 0 .8-.2 1.1-.5.3-.3.5-.7.5-1.1V8.4L15.5 2z"></path><path d="M15 2v7h7"></path></svg>
                        <span>Minhas Candidaturas</span>
                    </a></li>
                    <li><a href="./ia.blade.php" class="menu-item active">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 9a3 3 0 0 1 3-3m-2 15h4m0-3c0-4.1 4-4.9 4-9A6 6 0 1 0 6 9c0 4 4 5 4 9h4Z"/>
                        </svg>
                        <span>Assistente IA </span>
                    </a></li>
                    <li><a href="./curriculo.blade.php" class="menu-item">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7h1v12a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1V5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h11.5M7 14h6m-6 3h6m0-10h.5m-.5 3h.5M7 7h3v3H7V7Z"/>
                        </svg>
                        <span>Curriculo</span>
                    </a></li>

                    <li><a href="./exclusivos.blade.php" class="menu-item">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 9H5a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h6m0-6v6m0-6 5.419-3.87A1 1 0 0 1 18 5.942v12.114a1 1 0 0 1-1.581.814L11 15m7 0a3 3 0 0 0 0-6M6 15h3v5H6v-5Z"/>
                        </svg>
                        <span>Contúdos Exclusivos</span>
                    </a></li>
                    <li><a href="./perfil.blade.php" class="menu-item ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        <span>Meu Perfil</span>
                    </a></li>
                    <h3>Outros</h3>
                </ul>
            </nav>
            <div class="sidebar-footer">
                <a href="./configuracoes.blade.php" class="menu-item">
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
                <h1>Seu Assistente de Carreira IA</h1>
                <p>Use nossa inteligência artificial para otimizar seu currículo, se preparar para entrevistas e encontrar a vaga perfeita.</p>
            </header>

            <section class="ai-features-grid">
                <article class="ai-feature-card">
                    <div class="feature-header">
                        <div class="feature-icon">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 4h3a1 1 0 0 1 1 1v15a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h3m0 3h6m-6 7 2 2 4-4m-5-9v4h4V3h-4Z"/>
                            </svg>
                        </div>
                        <div class="feature-title">
                            <h2>Otimizador de Currículo</h2>
                            <p>Receba dicas para destacar seu CV.</p>
                        </div>
                    </div>
                    <div class="feature-content">
                        <div class="ai-results">
                            <h3>Análise do Curriculo.pdf:</h3>
                            <div class="result-item success">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                                <span>Uso de verbos de ação fortes e claros.</span>
                            </div>
                            <div class="result-item success">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                                <span>Resultados quantificáveis bem descritos.</span>
                            </div>
                             <div class="result-item warning">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                                <span>Sugestão: Adicionar competências como "Docker" e "CI/CD" para vagas de Sênior.</span>
                            </div>
                        </div>
                    </div>
                    <div class="feature-footer">
                        <button  id="openResumeModalBtn" class="btn btn-primary">
                            <span>Como Analisar</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 4v6h6"/><path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"/></svg>
                        </button>
                    </div>
                </article>

                <article class="ai-feature-card">
                    <div class="feature-header">
                        <div class="feature-icon"><svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 0 0-2 2v4m5-6h8M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2m0 0h3a2 2 0 0 1 2 2v4m0 0v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-6m18 0s-4 2-9 2-9-2-9-2m9-2h.01"/>
                        </svg></div>
                        <div class="feature-title">
                            <h2>Preparador de Entrevista</h2>
                            <p>Simule perguntas para uma vaga.</p>
                        </div>
                    </div>
                    <div class="feature-content">
                         <p>Selecione uma de suas candidaturas para gerar perguntas de entrevista personalizadas.</p>
                        <div class="form-group">
                            <select>
                                <option>Selecione a vaga...</option>
                                <option>Desenvolvedor(a) Full-Stack - Tech Solutions Inc.</option>
                                <option>UI/UX Designer Sênior - Creative Minds</option>
                            </select>
                        </div>
                    </div>
                    <div class="feature-footer">
                        <button class="btn btn-primary" id="generate-questions-btn">
                            <span>Gerar Perguntas</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.5 19H9a7 7 0 1 1 6.71-9h1.79a4.5 4.5 0 1 1 0 9Z"/></svg>
                        </button>
                    </div>
                </article>

                <article class="ai-feature-card">
                    <div class="feature-header">
                        <div class="feature-icon"><svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7.171 12.906-2.153 6.411 2.672-.89 1.568 2.34 1.825-5.183m5.73-2.678 2.154 6.411-2.673-.89-1.568 2.34-1.825-5.183M9.165 4.3c.58.068 1.153-.17 1.515-.628a1.681 1.681 0 0 1 2.64 0 1.68 1.68 0 0 0 1.515.628 1.681 1.681 0 0 1 1.866 1.866c-.068.58.17 1.154.628 1.516a1.681 1.681 0 0 1 0 2.639 1.682 1.682 0 0 0-.628 1.515 1.681 1.681 0 0 1-1.866 1.866 1.681 1.681 0 0 0-1.516.628 1.681 1.681 0 0 1-2.639 0 1.681 1.681 0 0 0-1.515-.628 1.681 1.681 0 0 1-1.867-1.866 1.681 1.681 0 0 0-.627-1.515 1.681 1.681 0 0 1 0-2.64c.458-.361.696-.935.627-1.515A1.681 1.681 0 0 1 9.165 4.3ZM14 9a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z"/>
                        </svg></div>
                        <div class="feature-title">
                            <h2>Carta de Apresentação</h2>
                            <p>Crie um rascunho em segundos.</p>
                        </div>
                    </div>
                    <div class="feature-content">
                        <p>A IA usará os dados do seu perfil e da vaga para criar uma carta de apresentação inicial.</p>
                         <div class="form-group">
                            <select>
                                <option>Selecione a vaga para a carta...</option>
                                <option>Analista de Marketing Digital - Growth Co.</option>
                            </select>
                        </div>
                    </div>
                    <div class="feature-footer">
                        <button id="openCoverLetterModalBtn" class="btn btn-primary">
                            <span>Criar Rascunho</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                        </button>
                    </div>
                </article>
            </section>

            <!-- Modal de Otimizar curriculo -->
            <div id="resumePromptModal" class="modal">
                <div class="resume-modal-content">
                    <div class="resume-modal-header">
                        <h2>Sugestões de Melhoria</h2>
                        <span class="close-resume-btn">&times;</span>
                    </div>
                    
                    <div id="resumeAccordion">
                        <div class="resume-accordion-item">
                            <button class="resume-accordion-header">Reescrever Experiência com Foco em Resultados</button>
                            <div class="resume-accordion-content">
                                <pre class="resume-prompt-text" id="resumePrompt1">Com base na minha experiência em [Nome da Empresa] como [Seu Cargo], reescreva a descrição das minhas responsabilidades usando o método STAR (Situação, Tarefa, Ação, Resultado). Destaque as seguintes conquistas: [Liste 2-3 conquistas importantes].</pre>
                                <button class="resume-copy-btn" data-target="resumePrompt1">Copiar Prompt</button>
                            </div>
                        </div>
                        <div class="resume-accordion-item">
                            <button class="resume-accordion-header">Sugerir Palavras-chave para uma Vaga</button>
                            <div class="resume-accordion-content">
                                <pre class="resume-prompt-text" id="resumePrompt2">Analise a descrição desta vaga de [Cargo Desejado] e meu currículo. Sugira 5 a 7 palavras-chave e competências técnicas que eu deveria adicionar ao meu currículo para aumentar a compatibilidade com sistemas de rastreamento de candidatos (ATS).\n\nDescrição da vaga: [Cole a descrição da vaga aqui]</pre>
                                <button class="resume-copy-btn" data-target="resumePrompt2">Copiar Prompt</button>
                            </div>
                        </div>
                        <div class="resume-accordion-item">
                            <button class="resume-accordion-header">Criar um Resumo Profissional de Destaque</button>
                            <div class="resume-accordion-content">
                                <pre class="resume-prompt-text" id="resumePrompt3">Crie 3 opções de um resumo profissional conciso e impactante para um profissional de [Sua Área] com [X anos] de experiência. Meu objetivo é conseguir uma vaga como [Cargo Desejado]. Meus pontos fortes são [Liste 2-3 pontos fortes, ex: liderança de equipes, otimização de processos, desenvolvimento full-stack].</pre>
                                <button class="resume-copy-btn" data-target="resumePrompt3">Copiar Prompt</button>
                            </div>
                        </div>
                        <div class="resume-accordion-item">
                            <button class="resume-accordion-header">Não sabe criar um currículo?</button>
                            <div class="resume-accordion-content">
                                <pre class="resume-prompt-text" id="resumePrompt3">
                                    Quero que você monte um currículo profissional para mim. De quais informações você precisa?

                                    Quais habilidades precisam ser destacadas num currículo para [insira o cargo]?

                                    Quero me candidatar para uma vaga de [insira o cargo]. Quais habilidades e informações precisam aparecer no meu currículo?

                                    Liste 10 exemplos de introduções que posso usar no meu currículo;

                                    Quero me candidatar a uma vaga de [insira o cargo]. Liste as palavras-chave mais importantes que devem aparecer no currículo.
                                </pre>
                                <ul>
                                    <li><b>Detalhe</b>: Crie curriculos personalizados para cada tipo de vaga, utilizando palavras chaves que aparecem nos requisitos da vaga; </li>
                                    <li><b>Importante</b>: evite digitar dados pessoais sensíveis, pois as próprias conversas no ChatGPT podem ser usadas no treinamento da IA, com acompanhamento de humanos.</li>
                                </ul>
                                <button class="resume-copy-btn" data-target="resumePrompt3">Copiar Prompt</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal de Perguntas -->
            <div id="promptModal" class="modal">
                <div class="modal-content">
                    <span class="close-btn">&times;</span>
                    <h2>Lista de Prompts</h2>
                    <div id="accordion">
                        <div class="accordion-item">
                            <button class="accordion-header"> Faça revisão de linguagem e clareza</button>
                            <div class="accordion-content">
                                <p class="prompt-text" id="prompt1">Pode revisar essa resposta para que ela fique clara, objetiva e profissional?</p>
                                <ul>
                                    <li>Esse ajuste melhora o tom e evita erros gramaticais, reforçando uma apresentação mais segura.</li>
                                </ul>
                                <button class="copy-btn" data-target="prompt1">Copiar</button>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <button class="accordion-header">Simule uma entrevista completa</button>
                            <div class="accordion-content">
                                <p class="prompt-text" id="prompt2">
                                    Cargo do Entrevistador: [Cargo do entrevistador, ex: Desenvolvedor Sênior, Tech Lead, Engenheiro de Software] em [Área de especialidade, ex: Front-End, Back-End, Full-Stack, DevOps] , especialista em [Tecnologia específica, ex: React, Node.js, Python, AWS] da empresa [Nome da Empresa, se disponível].

                                    Vaga: [Cargo da vaga, ex: Desenvolvedor Front-End Júnior, Analista de Dados, Engenheiro de Machine Learning].

                                    Objetivo da Entrevista: Avaliar minhas habilidades técnicas e soft skills para a vaga de [Cargo da vaga] na [Nome da Empresa, se disponível], com foco em [Tecnologia específica, se aplicável].

                                    Pré-requisitos da vaga:

                                    [Copie e cole aqui a lista de pré-requisitos da vaga da empresa]

                                    Roteiro da Entrevista:

                                    Abertura: Se apresente como entrevistador da [Nome da Empresa, se disponível] e demonstre entusiasmo em me conhecer.
                                    Perguntas:
                                    Faça [Número de perguntas desejado] perguntas relevantes para a vaga e para os pré-requisitos listados.
                                    Formule perguntas que simulem situações reais do dia a dia de um [Cargo da vaga] na [Nome da Empresa, se disponível].
                                    Concentre-se em uma pergunta por vez, permitindo que eu responda completamente antes de prosseguir.
                                    Explore temas como [Habilidades técnicas da vaga, ex: linguagens de programação, frameworks, ferramentas, metodologias] e soft skills como [Habilidades interpessoais, ex: comunicação, trabalho em equipe, resolução de problemas].
                                    Inclua pelo menos uma pergunta sobre um desafio técnico que eu tenha enfrentado e como o superei.
                                    Feedback:
                                    Ao final da entrevista, avalie minhas hard skills (conhecimentos técnicos) e soft skills (habilidades interpessoais) com base nas minhas respostas.
                                    Seja específico em seus comentários, mencionando pontos fortes e áreas onde posso melhorar.
                                    Diga se me considera um bom candidato para a vaga, justificando sua avaliação.
                                    Comportamento:

                                    Mantenha um diálogo amigável e profissional durante toda a entrevista. Aja como um entrevistador técnico real, demonstrando interesse em minhas experiências e habilidades.

                                    Observações:

                                    Responda como um ser humano, utilizando linguagem natural e evitando respostas genéricas ou robóticas.
                                    Utilize as informações que eu fornecer sobre a vaga e a empresa para tornar a simulação mais realista.
                                    Dicas Extras:

                                    </p>
                                    <ul>
                                        <li>
                                            Quanto mais detalhes você fornecer, mais precisa e útil será a simulação.
                                    Use as perguntas geradas para refletir sobre seus conhecimentos e identificar áreas de aprimoramento.
                                    Pesquise sobre a empresa e a vaga para se preparar melhor para a entrevista real.
                                    Lembre-se: o ChatGPT é uma ferramenta complementar, a preparação para a entrevista depende do seu esforço e dedicação!
                                        </li>
                                    </ul>
                                <button class="copy-btn" data-target="prompt2">Copiar</button>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <button class="accordion-header">Prepare uma estratégia para discutir salário</button>
                            <div class="accordion-content">
                                <p class="prompt-text" id="prompt3">Sugira uma forma eficaz de discutir expectativas salariais durante a entrevista para [cargo], garantindo uma negociação profissional.</p>
                                <ul>
                                    <li>
                                        O comando ajuda o candidato a se posicionar de forma segura e estratégica sobre remuneração.
                                    </li>
                                </ul>
                                <button class="copy-btn" data-target="prompt3">Copiar</button>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <button class="accordion-header">Crie exemplos de habilidades específicas</button>
                            <div class="accordion-content">
                                <p class="prompt-text" id="prompt1">Me ajude a preparar exemplos detalhados de situações em que demonstrei [habilidade específica] no meu trabalho anterior.</p>
                                <ul>
                                    <li>
                                        Ideal para responder perguntas comportamentais com exemplos reais e impactantes.
                                    </li>
                                </ul>
                                <button class="copy-btn" data-target="prompt1">Copiar</button>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <button class="accordion-header">Gere respostas usando a metodologia STAR</button>
                            <div class="accordion-content">
                                <p class="prompt-text" id="prompt2">Aqui está meu currículo. Pode me ajudar a responder essas perguntas usando a metodologia STAR?</p>
                                <ul>
                                    <li>
                                        Esse comando estrutura as respostas em quatro etapas: Situação, Tarefa, Ação e Resultado, aumentando assim a clareza e a objetividade.
                                    </li>
                                </ul>
                                <button class="copy-btn" data-target="prompt2">Copiar</button>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <button class="accordion-header">Gere perguntas com base na descrição da vaga</button>
                            <div class="accordion-content">
                                <p class="prompt-text" id="prompt3">Considere esta descrição de vaga para [cargo]. Quais perguntas o recrutador provavelmente fará na entrevista?</p>
                                <ul>
                                    Com base na descrição, o ChatGPT simula uma lista de perguntas técnicas e comportamentais específicas ao perfil desejado.
                                </ul>
                                <button class="copy-btn" data-target="prompt3">Copiar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <section class="ai-chat-section">
                <div class="ai-chat-section-header">
                    <h2>Começando Sua Carreira Agora?</h2>
                    <p>Conheça nosso conteúdo para te ajudar. Um guia interativo com estratégias, ferramentas e dicas essenciais para quem está iniciando a carreira e buscando o primeiro emprego.</p>
                    <br>
                    <a class="btn copy2-btn" href="./guia.blade.php">Começar a Trilha</a>
                </div>
                <div class="chat-widget-container">
                    <div class="chat-widget-header">
                        <div class="status-indicator"></div>
                        <span>Assistente RH Conexão</span>
                    </div>
                    <div class="chat-widget-body">
                        
                        <div class="ia-card">
                            <h1 class="ia-title">Converse Diretamente com o Assistente</h1>
                            <p class="ia-subtitle">Faça perguntas abertas sobre sua carreira, peça dicas ou explore qualquer tópico profissional.</p>

                            <div class="waves-container">
                                <spline-viewer url="https://prod.spline.design/1hyHY8rEGPq1Gihl/scene.splinecode"></spline-viewer>
                            </div>

                            <a href="https://chatgpt.com/g/g-6809798f94e48191b2c9216afd9c478e" target="_blank" class="ia-button">
                                Ir para o Assistente IA
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <div id="coverLetterModal" class="modal">
            <div class="modal-content cover-letter-modal-content">

                <div class="modal-header-flex">
                    <div class="modal-title-group">
                        <h2>Rascunho da sua Carta de Apresentação</h2>
                        <button id="explanation-trigger" class="explanation-btn">?</button>
                    </div>
                    <span class="close-btn-cover-letter">&times;</span>
                </div>

                <div id="explanation-popup" class="explanation-popup">
                    <div class="explanation-header">
                        <h3>O que é uma Carta de Apresentação?</h3>
                        <span id="close-explanation-popup">&times;</span>
                    </div>
                    <p>
                        É um documento de uma página que acompanha seu currículo quando você se candidata a um emprego. O objetivo é se apresentar de forma mais pessoal, destacar suas qualificações mais relevantes para a vaga e demonstrar seu interesse genuíno pela empresa e pela posição. É sua chance de contar uma história que os dados do currículo não contam.
                    </p>
                </div>

                <div class="modal-body">
                    <textarea id="coverLetterText" readonly rows="15">
                        Prezado(a) [Nome do Gerente de Contratação],

                        Escrevo para expressar meu grande interesse na vaga de [Nome da Vaga] na [Nome da Empresa], conforme anunciado em [Onde você viu a vaga]. Com [Número] anos de experiência em [Sua Área], desenvolvi uma forte paixão por [Aspecto específico da área], e estou confiante de que minhas habilidades em [Habilidade 1] e [Habilidade 2] me tornam um candidato ideal para esta oportunidade.

                        Em meu cargo anterior na [Empresa Anterior], fui responsável por [Uma responsabilidade chave], onde obtive sucesso em [Um resultado ou conquista quantificável]. Estou particularmente atraído pela [Nome da Empresa] devido a [Mencione algo que você admira na empresa, como sua cultura, inovação ou um projeto específico].

                        Anexei meu currículo para sua análise e ficaria muito feliz com a oportunidade de discutir como minhas competências e entusiasmo podem beneficiar sua equipe.

                        Agradeço sua atenção e tempo.

                        Atenciosamente,
                        [Seu Nome Completo]
                    </textarea>
                </div>

                <div class="modal-footer">
                    <button id="copyCoverLetterBtn" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
                        <span>Copiar Carta</span>
                    </button>
                    <button id="regenerateCoverLetterBtn" class="btn btn-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 4v6h6"/><path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"/></svg>
                        <span>Gerar Novo Rascunho</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</body>
    <script type="module" src="https://unpkg.com/@splinetool/viewer@1.10.41/build/spline-viewer.js"></script>
</html>