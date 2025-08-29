<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../../../assets/images/global/RHconexao-logo.svg" type="image/png">
    <title>Meu Perfil - Conexão RH</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <script defer src="../../../../assets/js/global/auth-guard.js"></script>

    <style>
        /* --- Variáveis de Cor e Reset Básico (Unificado com o layout do Dashboard) --- */
        :root {
            --primary-color: #2E62C2;
            --primary-light: #e3eaf8;
            --background-color: #f8f8f8;
            --white-color: #ffffff;
            --text-dark: #1e1e1e;
            --text-light: #7a7a7a;
            --border-color: #e5e5e5;
            --success-color: #22c55e;
            --success-light: #dcfce7;
            --card-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { background-color: var(--background-color); color: var(--text-dark); }
        a { text-decoration: none; color: inherit; }
        ul { list-style: none; }

        /* --- Layout Principal do Dashboard --- */
        .dashboard-container { display: grid; grid-template-columns: 260px 1fr; min-height: 100vh; }
        .sidebar { background-color: var(--white-color); padding: 2rem 1.5rem; }
        .main-content { padding: 2rem; overflow-y: auto; max-height: 100vh; }
        
        /* --- Barra Lateral (Sidebar) --- */
        .sidebar-header { display: flex; align-items: center; gap: 0.75rem; margin-bottom: 2.5rem; }
        .logo-img { width: 54px; }
        .logo-text { font-size: 1.2rem; font-weight: 700; }
        .sidebar-menu h3 { font-size: 0.8rem; font-weight: 500; color: var(--text-light); text-transform: uppercase; margin: 1.5rem 0 1rem 0; }
        .menu-item { display: flex; align-items: center; gap: 1rem; padding: 0.9rem 1rem; border-radius: 8px; margin-bottom: 0.5rem; font-weight: 500; color: var(--text-light); transition: background-color 0.2s, color 0.2s; }
        .menu-item:hover, .menu-item.active { background-color: var(--primary-color); color: var(--white-color); }
        .sidebar-footer { margin-top: auto; }

        /* --- Estilos Gerais de Botões e Conteúdo --- */
        .btn { padding: 0.75rem 1.5rem; border-radius: 8px; font-weight: 600; cursor: pointer; border: none; display: inline-flex; align-items: center; gap: 0.5rem; transition: all 0.2s; text-decoration: none; }
        .btn-primary { background-color: var(--primary-color); color: var(--white-color); }
        .btn-primary:hover { background-color: #254d9b; }
        .btn-secondary { background-color: var(--white-color); color: var(--text-dark); border: 1px solid var(--border-color); }
        .btn-secondary:hover { background-color: #f5f5f5; }

        .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem; }
        .page-header h1 { font-size: 2rem; font-weight: 700; }
        
        /* --- Layout da Página de Perfil --- */
        .profile-layout {
            display: grid;
            grid-template-columns: 1fr 320px;
            gap: 2rem;
            align-items: flex-start;
        }

        .profile-main { display: flex; flex-direction: column; gap: 2rem; }
        .profile-side { display: flex; flex-direction: column; gap: 2rem; }

        /* --- Card Genérico --- */
        .profile-card {
            background-color: var(--white-color);
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            padding: 1.5rem;
        }
        .card-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; }
        .card-header h2 { font-size: 1.25rem; font-weight: 600; }
        .card-header .btn { padding: 0.5rem 1rem; }
        
        /* --- Card de Informações Principais --- */
        .user-info-header { text-align: center; }
        .user-avatar { width: 120px; height: 120px; border-radius: 50%; object-fit: cover; margin-bottom: 1rem; border: 4px solid var(--primary-light); }
        .user-info-header h1 { font-size: 1.75rem; font-weight: 700; margin-bottom: 0.25rem; }
        .user-info-header p { color: var(--text-light); margin-bottom: 1.5rem; }
        .user-contact { display: flex; flex-direction: column; gap: 0.75rem; align-items: flex-start; margin-top: 1.5rem; border-top: 1px solid var(--border-color); padding-top: 1.5rem; }
        .contact-item { display: flex; align-items: center; gap: 0.75rem; color: var(--text-dark); }
        .contact-item svg { color: var(--primary-color); }

        /* --- Card de Currículo --- */
        .resume-card { display: flex; align-items: center; justify-content: space-between; gap: 1rem; }
        .resume-info { display: flex; align-items: center; gap: 1rem; }
        .resume-info svg { color: var(--primary-color); }
        .resume-info span { font-weight: 500; }

        /* --- Card de Competências --- */
        .skills-list { display: flex; flex-wrap: wrap; gap: 0.75rem; }
        .skill-tag { background-color: var(--primary-light); color: var(--primary-color); padding: 0.5rem 1rem; border-radius: 20px; font-size: 0.9rem; font-weight: 500; }

        /* --- Card de Experiência e Educação --- */
        .timeline { display: flex; flex-direction: column; gap: 1.5rem; }
        .timeline-item { display: flex; gap: 1rem; }
        .timeline-icon { background-color: var(--primary-light); color: var(--primary-color); width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .timeline-content h3 { font-size: 1.1rem; font-weight: 600; }
        .timeline-content p { color: var(--text-light); margin: 0.25rem 0; }
        .timeline-content .date { font-size: 0.85rem; font-style: italic; }
        .timeline-content .description { font-size: 0.95rem; margin-top: 0.5rem; }

        /* --- Responsividade --- */
        @media (max-width: 1200px) {
            .profile-layout { grid-template-columns: 1fr; }
        }
        @media (max-width: 992px) {
            .dashboard-container { grid-template-columns: 1fr; }
            .sidebar { position: fixed; transform: translateX(-100%); z-index: 1000; }
        }
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
                    <li><a href="./ia.blade.php" class="menu-item">
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
                    <li><a href="./perfil.blade.php" class="menu-item active">
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
            <header class="page-header">
                <h1>Meu Perfil Profissional</h1>
                <a href="#" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                    <span>Editar Perfil</span>
                </a>
            </header>

            <div class="profile-layout">
                <div class="profile-main">
                    <article class="profile-card">
                        <div class="card-header">
                            <h2>Sobre Mim</h2>
                        </div>
                        <p style="color: var(--text-light); line-height: 1.6;">
                            Desenvolvedor Full-Stack apaixonado por criar soluções inovadoras e escaláveis. Com 5 anos de experiência, tenho um profundo conhecimento em JavaScript, React, Node.js e metodologias ágeis. Busco constantemente aprender novas tecnologias para resolver problemas complexos e entregar produtos de alta qualidade que impactam positivamente os usuários.
                        </p>
                    </article>

                    <article class="profile-card">
                        <div class="card-header">
                            <h2>Experiência Profissional</h2>
                        </div>
                        <div class="timeline">
                            <div class="timeline-item">
                                <div class="timeline-icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg></div>
                                <div class="timeline-content">
                                    <h3>Desenvolvedor(a) Full-Stack Sênior</h3>
                                    <p>Tech Solutions Inc.</p>
                                    <p class="date">Jun 2022 - Presente</p>
                                    <p class="description">Liderança técnica em projetos de desenvolvimento de aplicações web, utilizando React para o front-end e Node.js para o back-end.</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg></div>
                                <div class="timeline-content">
                                    <h3>Desenvolvedor Front-End</h3>
                                    <p>Web Innovate</p>
                                    <p class="date">Jan 2020 - Mai 2022</p>
                                    <p class="description">Desenvolvimento de interfaces responsivas e interativas para clientes de diversos setores, focando na experiência do usuário.</p>
                                </div>
                            </div>
                        </div>
                    </article>
                    
                     <article class="profile-card">
                        <div class="card-header">
                            <h2>Formação Acadêmica</h2>
                        </div>
                        <div class="timeline">
                            <div class="timeline-item">
                                <div class="timeline-icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg></div>
                                <div class="timeline-content">
                                    <h3>Ciência da Computação</h3>
                                    <p>Universidade Federal de Tecnologia (UFT)</p>
                                    <p class="date">2016 - 2019</p>
                                </div>
                            </div>
                        </div>
                    </article>

                </div>
                <div class="profile-side">
                    <article class="profile-card">
                        <div class="user-info-header">
                            <img src="https://i.pravatar.cc/150?img=68" alt="Avatar do Usuário" class="user-avatar">
                            <h1>José Almeida</h1>
                            <p>Desenvolvedor Full-Stack</p>
                        </div>
                        <div class="user-contact">
                            <div class="contact-item">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                                <span>São Paulo, Brasil</span>
                            </div>
                            <div class="contact-item">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                <span>jose.almeida@email.com</span>
                            </div>
                             <div class="contact-item">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle></svg>
                                <span>linkedin.com/in/josealmeida</span>
                            </div>
                        </div>
                    </article>
                    
                    <article class="profile-card resume-card">
                        <div class="resume-info">
                             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                             <span>Curriculo.pdf</span>
                        </div>
                        <a href="#" class="btn btn-secondary" style="padding: 0.5rem;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                        </a>
                    </article>

                     <article class="profile-card">
                        <div class="card-header">
                            <h2>Competências</h2>
                        </div>
                        <div class="skills-list">
                            <span class="skill-tag">JavaScript</span>
                            <span class="skill-tag">React</span>
                            <span class="skill-tag">Node.js</span>
                            <span class="skill-tag">HTML5 & CSS3</span>
                            <span class="skill-tag">SQL</span>
                            <span class="skill-tag">Git</span>
                            <span class="skill-tag">Scrum</span>
                            <span class="skill-tag">Figma</span>
                        </div>
                    </article>
                </div>
            </div>
        </main>
    </div>
</body>
</html>