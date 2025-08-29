<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../../../assets/images/global/RHconexao-logo.svg" type="image/png">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Meu Currículo - Conexão RH</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <script defer src="../../../../assets/js/global/auth-guard.js"></script>
    <script defer src="../../../../assets/js/pages/curriculo/curriculo.js"></script>
    <style>
        /* --- Variáveis de Cor e Reset Básico (Unificado) --- */
        :root {
            --primary-color: #2E62C2;
            --primary-light: #e3eaf8;
            --background-color: #f8f8f8;
            --white-color: #ffffff;
            --text-dark: #1e1e1e;
            --text-light: #7a7a7a;
            --border-color: #e5e5e5;
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

        /* --- Estilos Gerais --- */
        .btn { padding: 0.75rem 1.5rem; border-radius: 8px; font-weight: 600; cursor: pointer; border: none; display: inline-flex; align-items: center; gap: 0.5rem; transition: all 0.2s; }
        .btn-primary { background-color: var(--primary-color); color: var(--white-color); }
        .btn-primary:hover { background-color: #254d9b; }
        .btn-secondary { background-color: var(--white-color); color: var(--text-dark); border: 1px solid var(--border-color); }
        .btn-secondary:hover { background-color: #f5f5f5; }

        .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem; }
        .page-header h1 { font-size: 2rem; font-weight: 700; }
        .header-actions { display: flex; gap: 1rem; flex-wrap: wrap; }
        
        /* --- Folha de Currículo --- */
        .resume-sheet {
            background-color: var(--white-color);
            max-width: 800px; /* Largura similar a um A4 */
            margin: 0 auto;
            padding: 3rem;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        /* --- Cabeçalho do Currículo --- */
        .resume-header {
            text-align: center;
            border-bottom: 2px solid var(--border-color);
            padding-bottom: 1.5rem;
            margin-bottom: 2rem;
        }
        .resume-header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--text-dark);
            margin: 0;
        }
        .resume-header h2 {
            font-size: 1.25rem;
            font-weight: 500;
            color: var(--primary-color);
            margin-top: 0.25rem;
            margin-bottom: 1rem;
        }
        .resume-contact-info {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 0.5rem 1.5rem;
            color: var(--text-light);
            font-size: 0.9rem;
        }
        .resume-contact-info span {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* --- Seções do Currículo --- */
        .resume-section {
            margin-bottom: 2rem;
        }
        .resume-section:last-child {
            margin-bottom: 0;
        }
        .resume-section-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--primary-color);
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 0.5rem;
            margin-bottom: 1rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .resume-section p {
            line-height: 1.7;
            color: var(--text-dark);
        }

        /* --- Itens de Experiência/Educação --- */
        .resume-item {
            margin-bottom: 1.25rem;
        }
        .resume-item:last-child {
            margin-bottom: 0;
        }
        .item-header {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            flex-wrap: wrap;
        }
        .item-header h3 {
            font-size: 1.1rem;
            font-weight: 600;
        }
        .item-header span.date {
            font-style: italic;
            color: var(--text-light);
            font-size: 0.9rem;
        }
        .item-subheader {
            font-weight: 500;
            color: var(--text-light);
            margin: 0.25rem 0 0.5rem 0;
        }

        /* --- Lista de Competências --- */
        .resume-skills-list {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
        }
        .resume-skill {
            background-color: var(--primary-light);
            color: var(--primary-color);
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-size: 0.9rem;
            font-weight: 500;
        }
        
        /* --- Estilos de Impressão --- */
        @media print {
            body {
                background-color: var(--white-color);
            }
            .sidebar, .page-header {
                display: none;
            }
            .dashboard-container {
                display: block; /* Remove o grid */
            }
            .main-content {
                padding: 0;
                overflow: visible;
                max-height: none;
            }
            .resume-sheet {
                max-width: 100%;
                margin: 0;
                padding: 1cm;
                box-shadow: none;
                border-radius: 0;
                border: none;
            }
        }

        /* --- Responsividade da Tela --- */
        @media (max-width: 992px) {
            .dashboard-container { grid-template-columns: 1fr; }
            .sidebar { position: fixed; transform: translateX(-100%); z-index: 1000; }
        }
        @media (max-width: 768px) {
            .resume-sheet { padding: 1.5rem; }
            .resume-header h1 { font-size: 2rem; }
            .resume-header h2 { font-size: 1.1rem; }
        }

        /* --- Estilos para o Formulário de Construção --- */
        .curriculum-builder-layout {
            display: grid;
            grid-template-columns: 450px 1fr; /* Formulário à esquerda, pré-visualização à direita */
            gap: 2rem;
            align-items: flex-start;
        }

        .curriculum-form-column {
            position: sticky;
            top: 2rem;
            max-height: calc(100vh - 4rem);
            overflow-y: auto;
            padding-right: 1rem;
        }

        .form-card {
            background-color: var(--white-color);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: var(--card-shadow);
        }

        .form-card h3 {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-weight: 500;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.2s;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px var(--primary-light);
        }

        .form-group textarea { resize: vertical; min-height: 100px; }
        .repeater-item { border: 1px solid var(--border-color); padding: 1rem; border-radius: 8px; margin-bottom: 1rem; }
        .repeater-item-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; }
        .repeater-item-header h4 { font-weight: 600; }
        .remove-item-btn { background: none; border: none; color: #ef4444; cursor: pointer; font-weight: 600; }
        .add-item-btn { width: 100%; padding: 0.75rem; background-color: var(--primary-light); color: var(--primary-color); border: 1px dashed var(--primary-color); font-weight: 600; cursor: pointer; border-radius: 8px; transition: background-color 0.2s; }
        .add-item-btn:hover { background-color: #dbeafe; }

        @media (max-width: 1200px) {
            .curriculum-builder-layout { grid-template-columns: 1fr; }
            .curriculum-form-column { position: static; max-height: none; overflow-y: visible; padding-right: 0; }
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
                    <li><a href="./curriculo.blade.php" class="menu-item active">
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
                    <li><a href="./perfil.blade.php" class="menu-item">
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
                <h1>Meu Currículo</h1>
                <div class="header-actions">
                    <button class="btn btn-secondary" onclick="window.print()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
                        <span>Imprimir / Salvar PDF</span>
                    </button>
                    <button id="save-resume-btn" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points></polyline>
                        <span>Editar / Criar Currículo</span>
                    </button> 
                </div>
            </header>

            <div class="resume-sheet">
                <header class="resume-header">
                    <h1>José Almeida</h1>
                    <h2>Desenvolvedor Full-Stack Sênior</h2>
                    <div class="resume-contact-info">
                        <span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>São Paulo, Brasil</span>
                        <span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>jose.almeida@email.com</span>
                        <span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle></svg>linkedin.com/in/josealmeida</span>
                    </div>
                </header>

                <section class="resume-section">
                    <h3 class="resume-section-title">Resumo Profissional</h3>
                    <p>Desenvolvedor Full-Stack apaixonado por criar soluções inovadoras e escaláveis. Com 5 anos de experiência, tenho um profundo conhecimento em JavaScript, React, Node.js e metodologias ágeis. Busco constantemente aprender novas tecnologias para resolver problemas complexos e entregar produtos de alta qualidade que impactam positivamente os usuários.</p>
                </section>

                <section class="resume-section">
                    <h3 class="resume-section-title">Experiência Profissional</h3>
                    <div class="resume-item">
                        <div class="item-header">
                            <h3>Desenvolvedor Full-Stack Sênior</h3>
                            <span class="date">Jun 2022 - Presente</span>
                        </div>
                        <p class="item-subheader">Tech Solutions Inc.</p>
                        <p>Liderança técnica em projetos de desenvolvimento de aplicações web, utilizando React para o front-end e Node.js para o back-end, focando em performance e boas práticas de código.</p>
                    </div>
                    <div class="resume-item">
                        <div class="item-header">
                            <h3>Desenvolvedor Front-End</h3>
                            <span class="date">Jan 2020 - Mai 2022</span>
                        </div>
                        <p class="item-subheader">Web Innovate</p>
                        <p>Desenvolvimento de interfaces responsivas e interativas para clientes de diversos setores, melhorando a experiência do usuário e as taxas de conversão.</p>
                    </div>
                </section>

                <section class="resume-section">
                    <h3 class="resume-section-title">Formação Acadêmica</h3>
                    <div class="resume-item">
                        <div class="item-header">
                            <h3>Bacharelado em Ciência da Computação</h3>
                            <span class="date">2016 - 2019</span>
                        </div>
                        <p class="item-subheader">Universidade Federal de Tecnologia (UFT)</p>
                    </div>
                </section>

                <section class="resume-section">
                    <h3 class="resume-section-title">Principais Competências</h3>
                    <div class="resume-skills-list">
                        <span class="resume-skill">JavaScript (ES6+)</span>
                        <span class="resume-skill">React & Redux</span>
                        <span class="resume-skill">Node.js & Express</span>
                        <span class="resume-skill">HTML5 & CSS3</span>
                        <span class="resume-skill">SQL & NoSQL</span>
                        <span class="resume-skill">Git & GitHub</span>
                        <span class="resume-skill">Metodologias Ágeis</span>
                        <span class="resume-skill">Docker</span>
                        <span class="resume-skill">Figma</span>
                    </div>
                </section>

            </div>
        </main>
    </div>

    <!-- Modal de Construção de Currículo -->
    <div id="curriculum-modal" style="display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.5);">
        <div style="background-color: #f8f8f8; margin: 3% auto; padding: 2rem; border: 1px solid #888; width: 90%; max-width: 1400px; border-radius: 12px; position: relative;">
            <span id="close-curriculum-modal" style="color: #aaa; position: absolute; top: 1rem; right: 1.5rem; font-size: 28px; font-weight: bold; cursor: pointer;">&times;</span>
            
            <div class="page-header" style="margin-bottom: 1rem; padding-bottom: 1rem; border-bottom: 1px solid var(--border-color);">
                <h1 style="font-size: 1.75rem;">Construtor de Currículo</h1>
            </div>

            <div class="curriculum-builder-layout">
                <div class="curriculum-form-column">
                    <form id="curriculum-form" novalidate>
                        <div class="form-card">
                            <h3>Informações Pessoais</h3>
                            <div class="form-grid">
                                <div class="form-group"><label for="fullName">Nome Completo</label><input type="text" id="fullName" name="fullName" placeholder="Ex: Maria da Silva"></div>
                                <div class="form-group"><label for="jobTitle">Título Profissional</label><input type="text" id="jobTitle" name="jobTitle" placeholder="Ex: Desenvolvedora Front-End"></div>
                                <div class="form-group"><label for="location">Localização</label><input type="text" id="location" name="location" placeholder="Ex: São Paulo, Brasil"></div>
                                <div class="form-group"><label for="email">Email</label><input type="email" id="email" name="email" placeholder="Ex: maria.silva@email.com"></div>
                                <div class="form-group"><label for="linkedin">LinkedIn (URL)</label><input type="url" id="linkedin" name="linkedin" placeholder="https://linkedin.com/in/seu-perfil"></div>
                            </div>
                        </div>

                        <div class="form-card">
                            <h3>Resumo Profissional</h3>
                            <div class="form-group">
                                <label for="summary">Seu resumo</label>
                                <textarea id="summary" name="summary" placeholder="Descreva brevemente sua carreira, paixões e objetivos profissionais."></textarea>
                            </div>
                        </div>

                        <div class="form-card">
                            <h3>Experiência Profissional</h3>
                            <div id="experience-repeater">
                                </div>
                            <button type="button" class="add-item-btn" data-repeater-target="#experience-repeater" data-template="experience-template">Adicionar Experiência</button>
                        </div>

                        <div class="form-card">
                            <h3>Formação Acadêmica</h3>
                            <div id="education-repeater">
                                </div>
                            <button type="button" class="add-item-btn" data-repeater-target="#education-repeater" data-template="education-template">Adicionar Formação</button>
                        </div>

                        <div class="form-card">
                            <h3>Principais Competências</h3>
                            <div class="form-group">
                                <label for="skills">Competências (separadas por vírgula)</label>
                                <textarea id="skills" name="skills" placeholder="Ex: JavaScript, React, Node.js, Trabalho em Equipe"></textarea>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="curriculum-preview-column">
                    </div>
            </div>

            <div style="grid-column: 1 / -1; text-align: right; margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid var(--border-color);">
                <button type="button" id="cancel-btn" class="btn btn-secondary">Cancelar</button>
                <button type="submit" form="curriculum-form" class="btn btn-primary">Salvar Alterações</button>
            </div>
        </div>
    </div>

    <template id="experience-template">
        <div class="repeater-item">
            <div class="repeater-item-header">
                <h4>Nova Experiência</h4>
                <button type="button" class="remove-item-btn">Remover</button>
            </div>

            <div class="form-grid">
                <div class="form-group"><label>Cargo</label><input type="text" name="exp_title[]" placeholder="Ex: Desenvolvedor Pleno"></div>
                <div class="form-group"><label>Empresa</label><input type="text" name="exp_company[]" placeholder="Ex: Tech Solutions Inc."></div>
                <div class="form-group"><label>Data de Início</label><input type="text" name="exp_start_date[]" placeholder="Ex: Jan 2022"></div>
                <div class="form-group"><label>Data de Fim</label><input type="text" name="exp_end_date[]" placeholder="Ex: Presente"></div>
                <div class="form-group" style="grid-column: 1 / -1;"><label>Descrição</label><textarea name="exp_description[]" placeholder="Descreva suas responsabilidades e conquistas."></textarea></div>
            </div>
        </div>
    </template>

    <template id="education-template">
    <div class="repeater-item">
        <div class="repeater-item-header">
            <h4>Nova Formação</h4>
            <button type="button" class="remove-item-btn">Remover</button>
        </div>

        <div class="form-grid">
            <div class="form-group"><label>Curso</label><input type="text" name="edu_degree[]" placeholder="Ex: Bacharelado em Ciência da Computação"></div>
            <div class="form-group"><label>Instituição</label><input type="text" name="edu_institution[]" placeholder="Ex: Universidade Federal de Tecnologia"></div>
            <div class="form-group"><label>Data de Início</label><input type="text" name="edu_start_date[]" placeholder="Ex: 2016"></div>
            <div class="form-group"><label>Data de Fim</label><input type="text" name="edu_end_date[]" placeholder="Ex: 2019"></div>
        </div>
    </div>
</template>
</body>
</html>