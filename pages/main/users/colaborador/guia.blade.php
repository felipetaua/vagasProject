<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../../../assets/images/global/RHconexao-logo.svg" type="image/png">
    <title>Guia Interativo - Conexão RH</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
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

        body {
            font-family: 'Inter', sans-serif;
            background-color: #F8F7F4;
            color: #404040;
        }
        .nav-link {
            transition: color 0.3s, border-bottom-color 0.3s;
        }
        .nav-link.active {
            color: #fc5e00;
            border-bottom-color: #fc5e00;
        }
        .nav-link:hover {
            color: #fc3200;
        }
        .card {
            background-color: #FFFFFF;
            border: 1px solid #E5E7EB;
            border-radius: 0.75rem;
            padding: 1.5rem;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        .btn-primary {
            background-color: #2E62C2;
            color: #FFFFFF;
            transition: background-color 0.3s;
        }
        .btn-primary:hover {
            background-color: #254d9b;
        }
        .prompt-tab {
            cursor: pointer;
            padding: 0.75rem 1rem;
            border-bottom: 2px solid transparent;
            transition: color 0.3s, border-color 0.3s;
        }
        .prompt-tab.active {
            color: #fc5e00;
            border-color: #fc5e00;
            font-weight: 500;
        }
        .chart-container {
            position: relative;
            width: 100%;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
            height: 300px;
            max-height: 400px;
        }

        @media (min-width: 768px) {
            .chart-container {
                height: 400px;
            }
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
            <header class="bg-white/80 backdrop-blur-lg shadow-sm sticky top-0 z-50">
        <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold text-gray-800">Guia do Primeiro Emprego</h1>
            <div class="hidden md:flex items-center space-x-8">
                <a href="#fundamentos" class="nav-link border-b-2 border-transparent pb-1">Fundamentos</a>
                <a href="#ferramentas" class="nav-link border-b-2 border-transparent pb-1">Ferramentas</a>
                <a href="#entrevista" class="nav-link border-b-2 border-transparent pb-1">Entrevista</a>
                <a href="#trilha" class="nav-link border-b-2 border-transparent pb-1">Trilha do Sucesso</a>
            </div>
            <button id="mobile-menu-button" class="md:hidden text-gray-700 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
            </button>
        </nav>
        <div id="mobile-menu" class="hidden md:hidden bg-white">
            <a href="#fundamentos" class="block py-2 px-6 text-sm text-gray-700 hover:bg-gray-100">Fundamentos</a>
            <a href="#ferramentas" class="block py-2 px-6 text-sm text-gray-700 hover:bg-gray-100">Ferramentas</a>
            <a href="#entrevista" class="block py-2 px-6 text-sm text-gray-700 hover:bg-gray-100">Entrevista</a>
            <a href="#trilha" class="block py-2 px-6 text-sm text-gray-700 hover:bg-gray-100">Trilha do Sucesso</a>
        </div>
    </header>

    <main class="container mx-auto px-6 py-12">
        <section id="hero" class="text-center mb-20">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">Conquiste seu Lugar no Mercado de Trabalho</h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">Um guia interativo com estratégias, ferramentas e dicas essenciais para quem está iniciando a carreira e buscando o primeiro emprego.</p>
        </section>

        <section id="fundamentos" class="mb-20 scroll-mt-20">
            <h3 class="text-3xl font-bold text-center mb-2 text-gray-800">Fundamentos da Carreira</h3>
            <p class="text-center text-gray-600 mb-12 max-w-2xl mx-auto">A base para uma carreira de sucesso começa com o autoconhecimento e o desenvolvimento das habilidades certas. Esta seção explora os pilares que sustentarão sua jornada profissional.</p>
            
            <div class="grid md:grid-cols-2 gap-8 items-center">
                <div class="space-y-6">
                    <div class="card">
                        <h4 class="text-xl font-bold mb-2">Autoconhecimento e Objetivos</h4>
                        <p class="text-gray-600">Antes de tudo, entenda seus interesses, valores e motivações. Definir objetivos claros é o primeiro passo para alinhar suas aspirações com as oportunidades do mercado e encontrar satisfação na carreira.</p>
                    </div>
                    <div class="card">
                        <h4 class="text-xl font-bold mb-2">Formação Contínua e Voluntariado</h4>
                        <p class="text-gray-600">O aprendizado não para. Cursos, certificações e trabalho voluntário são formas poderosas de adquirir experiência prática, desenvolver novas competências e enriquecer seu currículo, mesmo antes do primeiro emprego formal.</p>
                    </div>
                </div>
                <div>
                    <div class="card">
                        <h4 class="text-xl font-bold mb-4 text-center">Habilidades Essenciais: Soft vs. Hard Skills</h4>
                        <p class="text-gray-600 text-center mb-4">O mercado valoriza um equilíbrio entre competências técnicas (Hard Skills) e comportamentais (Soft Skills). Para iniciantes, as soft skills são cruciais para demonstrar potencial.</p>
                        <div class="chart-container">
                            <canvas id="skillsChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="ferramentas" class="mb-20 scroll-mt-20">
            <h3 class="text-3xl font-bold text-center mb-2 text-gray-800">Ferramentas Essenciais</h3>
            <p class="text-center text-gray-600 mb-12 max-w-2xl mx-auto">Equipe-se com as ferramentas certas para a sua busca. Um bom currículo, uma carta de apresentação impactante e uma rede de contatos sólida são seus maiores aliados.</p>
            <div class="grid md:grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="card">
                    <div class="text-3xl mb-4">📄</div>
                    <h4 class="text-xl font-bold mb-2">Currículo Vencedor</h4>
                    <p class="text-gray-600">Seu currículo é seu cartão de visitas. Para iniciantes, ele deve focar em educação, projetos, voluntariado e habilidades transferíveis, contando uma história sobre seu potencial.</p>
                </div>
                <div class="card">
                    <div class="text-3xl mb-4">✉️</div>
                    <h4 class="text-xl font-bold mb-2">Carta de Apresentação</h4>
                    <p class="text-gray-600">Use a carta para mostrar sua motivação e entusiasmo. Personalize-a para cada vaga, conectando suas habilidades e seu interesse genuíno à cultura e aos desafios da empresa.</p>
                </div>
                <div class="card">
                    <div class="text-3xl mb-4">🤝</div>
                    <h4 class="text-xl font-bold mb-2">Networking Estratégico</h4>
                    <p class="text-gray-600">Construa sua rede de contatos online (LinkedIn) e offline. Informe pessoas sobre sua busca e procure mentores. Uma boa conexão pode abrir portas inesperadas.</p>
                </div>
            </div>
        </section>

        <section id="entrevista" class="mb-20 scroll-mt-20">
            <h3 class="text-3xl font-bold text-center mb-2 text-gray-800">Preparação para a Entrevista</h3>
            <p class="text-center text-gray-600 mb-12 max-w-2xl mx-auto">A entrevista é sua chance de brilhar. Uma preparação cuidadosa transforma a ansiedade em confiança e permite que você demonstre seu verdadeiro valor.</p>
            <div class="bg-white p-8 rounded-xl shadow-md">
                <div class="grid md:grid-cols-2 gap-8">
                    <div>
                        <h4 class="text-2xl font-bold mb-4">Estratégias de Sucesso</h4>
                        <ul class="space-y-3 text-gray-700">
                            <li class="flex items-start"><span class="text-green-500 mr-2">✔</span> <strong>Pesquise:</strong> Conheça a empresa e a vaga a fundo.</li>
                            <li class="flex items-start"><span class="text-green-500 mr-2">✔</span> <strong>Pratique:</strong> Prepare respostas para perguntas comuns, focando em seu potencial.</li>
                            <li class="flex items-start"><span class="text-green-500 mr-2">✔</span> <strong>Seja Autêntico:</strong> Mostre sua personalidade e entusiasmo genuíno.</li>
                            <li class="flex items-start"><span class="text-green-500 mr-2">✔</span> <strong>Prepare Perguntas:</strong> Demonstre interesse fazendo perguntas inteligentes sobre a função e a cultura.</li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-2xl font-bold mb-4">Superando a Falta de Experiência</h4>
                        <p class="text-gray-700 mb-4">Não veja a inexperiência como uma fraqueza. Transforme-a em uma oportunidade para destacar suas qualidades mais valiosas.</p>
                        <ul class="space-y-3 text-gray-700">
                            <li class="flex items-start"><span class="text-blue-500 mr-2">💡</span> Foque na sua <strong>vontade de aprender</strong> e rápida capacidade de adaptação.</li>
                            <li class="flex items-start"><span class="text-blue-500 mr-2">💡</span> Use exemplos de projetos e voluntariado para demonstrar <strong>habilidades transferíveis</strong>.</li>
                            <li class="flex items-start"><span class="text-blue-500 mr-2">💡</span> Mostre <strong>proatividade</strong> ao perguntar sobre treinamentos e desenvolvimento.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section id="trilha" class="scroll-mt-20">
            <h3 class="text-3xl font-bold text-center mb-2 text-gray-800">Sua Trilha para o Sucesso</h3>
            <p class="text-center text-gray-600 mb-12 max-w-2xl mx-auto">Siga um roteiro prático e use prompts inteligentes para otimizar sua busca. A persistência e o aprendizado contínuo são as chaves para o seu futuro profissional.</p>
            
            <div class="card">
                <h4 class="text-2xl font-bold mb-6 text-center">10 Prompts Úteis para Otimizar sua Busca</h4>
                <p class="text-center text-gray-600 mb-8 max-w-3xl mx-auto">Use estes prompts como guias de auto-reflexão ou com ferramentas de IA para aprimorar cada etapa do seu processo de candidatura. Clique em cada aba para explorar.</p>
                <div class="flex flex-wrap justify-center border-b border-gray-200 mb-6">
                    <div class="prompt-tab active" data-tab="1">1. Habilidades</div>
                    <div class="prompt-tab" data-tab="2">2. Objetivo</div>
                    <div class="prompt-tab" data-tab="3">3. Experiência</div>
                    <div class="prompt-tab" data-tab="4">4. Carta</div>
                    <div class="prompt-tab" data-tab="5">5. Entrevista</div>
                    <div class="prompt-tab" data-tab="6">6. Pesquisa</div>
                    <div class="prompt-tab" data-tab="7">7. Perguntas</div>
                    <div class="prompt-tab" data-tab="8">8. Cursos</div>
                    <div class="prompt-tab" data-tab="9">9. Networking</div>
                    <div class="prompt-tab" data-tab="10">10. Resiliência</div>
                </div>

                <div id="prompt-content" class="p-4 bg-gray-50 rounded-lg min-h-[200px] flex flex-col justify-center">
                </div>
            </div>
            <div class="text-center mt-8">
                <a href="./ia.blade.php" class="btn-primary inline-block font-bold py-3 px-8 rounded-full shadow-md hover:shadow-lg transition-all">Voltar para o Conexão RH</a>
            </div>
        </section>
    </main>

    <footer class="bg-white border-t mt-20">
        <div class="container mx-auto px-6 py-8 text-center text-gray-600">
            <p>&copy; 2025 Conexão RH 2.0 Criado para capacitar novos talentos.</p>
            <p class="text-sm mt-2">Este é um projeto de demonstração baseado no "Guia Essencial para o Primeiro Emprego".</p>
        </div>
    </footer>
        </main>
    </div>
</body>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');

            mobileMenuButton.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });

            document.querySelectorAll('#mobile-menu a').forEach(link => {
                link.addEventListener('click', () => {
                    mobileMenu.classList.add('hidden');
                });
            });

            const sections = document.querySelectorAll('section');
            const navLinks = document.querySelectorAll('.nav-link');

            const observerOptions = {
                root: null,
                rootMargin: '0px',
                threshold: 0.4
            };

            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        navLinks.forEach(link => {
                            link.classList.remove('active');
                            if (link.getAttribute('href').substring(1) === entry.target.id) {
                                link.classList.add('active');
                            }
                        });
                    }
                });
            }, observerOptions);

            sections.forEach(section => {
                observer.observe(section);
            });

            const skillsCtx = document.getElementById('skillsChart').getContext('2d');
            new Chart(skillsCtx, {
                type: 'radar',
                data: {
                    labels: ['Comunicação', 'Trabalho em Equipe', 'Resolução de Problemas', 'Adaptabilidade', 'Iniciativa', 'Pensamento Crítico'],
                    datasets: [{
                        label: 'Soft Skills (Importância)',
                        data: [9, 8, 8, 9, 7, 7],
                        backgroundColor: 'rgba(165, 106, 67, 0.2)',
                        borderColor: '#fc5e00',
                        pointBackgroundColor: '#fc5e00',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: '#fc5e00'
                    },
                    {
                        label: 'Hard Skills (Relevância Inicial)',
                        data: [7, 5, 6, 6, 8, 5],
                        backgroundColor: 'rgba(128, 128, 128, 0.2)',
                        borderColor: '#808080',
                        pointBackgroundColor: '#808080',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: '#808080'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        r: {
                            angleLines: {
                                color: '#e5e7eb'
                            },
                            grid: {
                                color: '#e5e7eb'
                            },
                            pointLabels: {
                                font: {
                                    size: 12
                                },
                                color: '#404040'
                            },
                            ticks: {
                                backdropColor: '#F8F7F4',
                                color: '#6b7280'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed.r !== null) {
                                        label += context.parsed.r;
                                    }
                                    return label;
                                }
                            }
                        }
                    }
                }
            });

            const promptTabs = document.querySelectorAll('.prompt-tab');
            const promptContent = document.getElementById('prompt-content');
            const promptsData = {
                1: {
                    title: '1. Autoconhecimento e Habilidades',
                    content: '"Sou um estudante/recém-formado em [sua área]. Liste 5 soft skills e 5 hard skills valorizadas para iniciantes nesta área, com exemplos de como posso desenvolvê-las e evidenciá-las mesmo sem experiência formal."'
                },
                2: {
                    title: '2. Objetivo Profissional (Currículo)',
                    content: '"Crie um objetivo profissional de 3-4 frases para meu currículo de primeiro emprego. Sou [qualificação]. Tenho experiência em [projeto/voluntariado]. Busco uma oportunidade em [área] onde possa aplicar minhas habilidades e crescer com a equipe."'
                },
                3: {
                    title: '3. Detalhar Experiências Não-Formais',
                    content: '"Como posso descrever minha experiência como [voluntário/líder de projeto] no meu currículo? Destaque 2-3 atribuições e conquistas, usando verbos de ação e, se possível, números para quantificar o impacto."'
                },
                4: {
                    title: '4. Carta de Apresentação Personalizada',
                    content: '"Escreva um rascunho de carta de apresentação para a vaga de [Vaga] na [Empresa]. Destaque como minhas habilidades em [comunicação, etc.] e meu interesse em [algo da empresa] se alinham com a cultura e os desafios da empresa."'
                },
                5: {
                    title: '5. Preparação para Entrevista (Falta de Experiência)',
                    content: '"Como responder à pergunta \'Fale sobre sua falta de experiência profissional?\' em uma entrevista? Forneça uma resposta que demonstre autoconsciência, vontade de melhorar e como minhas experiências não-formais me prepararam."'
                },
                6: {
                    title: '6. Pesquisa de Empresas e Cultura',
                    content: '"Quais informações devo pesquisar sobre a empresa [Nome da Empresa] antes de uma entrevista? Foque em cultura, valores, projetos recentes e como posso usar essas informações para demonstrar meu interesse genuíno."'
                },
                7: {
                    title: '7. Perguntas para o Entrevistador',
                    content: '"Sugira 3-4 perguntas inteligentes que um iniciante pode fazer ao entrevistador no final de uma entrevista. As perguntas devem demonstrar interesse em crescimento, cultura da empresa e desafios da função."'
                },
                8: {
                    title: '8. Identificação de Cursos e Certificações',
                    content: '"Sou iniciante e quero desenvolver minhas habilidades em [área]. Liste 3-5 cursos online (gratuitos ou de baixo custo) e certificações reconhecidas que posso buscar para enriquecer meu currículo."'
                },
                9: {
                    title: '9. Estratégias de Networking no LinkedIn',
                    content: '"Como posso usar o LinkedIn para construir uma rede profissional eficaz, sendo um iniciante? Dê dicas sobre como otimizar meu perfil, conectar-me com profissionais da área e encontrar oportunidades de mentoria."'
                },
                10: {
                    title: '10. Manter a Resiliência na Busca',
                    content: '"Estou me sentindo desmotivado com a busca de emprego. Quais estratégias posso usar para manter a resiliência, gerenciar a ansiedade e transformar \'nãos\' em oportunidades de aprendizado?"'
                }
            };

            function updatePromptContent(tabId) {
                const data = promptsData[tabId];
                promptContent.innerHTML = `
                    <h5 class="text-xl font-bold text-gray-800 mb-3 text-center">${data.title}</h5>
                    <p class="text-gray-600 text-center italic">"${data.content}"</p>
                `;
            }

            promptTabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    promptTabs.forEach(t => t.classList.remove('active'));
                    tab.classList.add('active');
                    const tabId = tab.getAttribute('data-tab');
                    updatePromptContent(tabId);
                });
            });

            updatePromptContent(1);
        });
    </script>
</html>