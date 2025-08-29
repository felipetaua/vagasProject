<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../../../assets/images/global/RHconexao-logo.svg" type="image/png">
    <title>Conteúdo Exclusivo - Conexão RH</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <script defer src="../../../../assets/js/global/auth-guard.js"></script>
    <script defer src="../../../../assets/js/pages/exclusivos/exclusivos.js"></script>
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

        .page-header { text-align: center; margin-bottom: 2.5rem; }
        .page-header h1 { font-size: 2.25rem; font-weight: 700; color: var(--text-dark); }
        .page-header p { font-size: 1.1rem; color: var(--text-light); max-width: 700px; margin: 0.5rem auto 0; }
        
        /* --- Barra de Filtros --- */
        .filter-bar {
            background-color: var(--white-color);
            padding: 1rem;
            border-radius: 12px;
            display: flex;
            gap: 1rem;
            align-items: center;
            flex-wrap: wrap;
            margin-bottom: 2.5rem;
            border: 1px solid var(--border-color);
        }
        .search-input {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            flex-grow: 1;
        }
        .search-input input {
            border: none;
            outline: none;
            font-size: 1rem;
            width: 100%;
        }
        .filter-group button {
            background: none;
            border: 1px solid var(--border-color);
            padding: 0.6rem 1rem;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.2s;
        }
        .filter-group button.active, .filter-group button:hover {
            background-color: var(--primary-light);
            color: var(--primary-color);
            border-color: var(--primary-color);
        }

        /* --- Grid de Conteúdo --- */
        .content-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 2rem;
        }
        .content-card {
            background-color: var(--white-color);
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .content-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(46, 98, 194, 0.1);
        }
        .card-image {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }
        .card-body {
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }
        .card-badge {
            background-color: var(--primary-color);
            color: var(--white-color);
            padding: 0.25rem 0.75rem;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            align-self: flex-start;
            margin-bottom: 1rem;
        }
        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
            line-height: 1.4;
        }
        .card-excerpt {
            color: var(--text-light);
            line-height: 1.6;
            flex-grow: 1;
            margin-bottom: 1.5rem;
        }
        .card-footer {
            margin-top: auto;
            border-top: 1px solid var(--border-color);
            padding-top: 1rem;
        }
        .card-footer a {
            font-weight: 600;
            color: var(--primary-color);
        }
        .card-footer a:hover {
            text-decoration: underline;
        }

        /* Responsividade */
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
                    <li><a href="./exclusivos.blade.php" class="menu-item active">
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
                <a href="./configuracoes.blade.php" id="settings-btn" class="menu-item">
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
                <h1>Conteúdo Exclusivo para sua Carreira</h1>
                <p>Acesse artigos, guias e webinars preparados por especialistas para acelerar seu desenvolvimento profissional.</p>
            </header>

            <div class="filter-bar">
                <div class="search-input">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color:var(--text-light)"><circle cx="11" cy="11" r="8"></circle><line x1="21" x2="16.65" y1="21" y2="16.65"></line></svg>
                    <input type="text" placeholder="Buscar por tema ou palavra-chave...">
                </div>
                <div class="filter-group">
                    <button class="active">Todos</button>
                    <button>Artigos</button>
                    <button>Vídeos</button>
                    <button>Guias</button>
                </div>
            </div>

            <div class="content-grid">
                <!-- conteudo adicionando pelo js -->
            </div>
        </main>
    </div>
</body>
</html>