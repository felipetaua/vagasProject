<?php
session_start();

require_once __DIR__ . '/db_connection.php'; // Verifique se o caminho está correto

// 1. VERIFICAÇÃO DE LOGIN
if (!isset($_SESSION["user_id"])) {
    header("Location: /sistemaDeVagas/login.php");
    exit;
}
$userId = $_SESSION["user_id"];

// 2. BUSCA DADOS DO USUÁRIO LOGADO (para o header)
$stmtUser = $conn->prepare("SELECT nome, foto FROM `cadastro` WHERE id = ?");
$stmtUser->bind_param("i", $userId);
$stmtUser->execute();
$resultUser = $stmtUser->get_result();
$user = $resultUser->fetch_assoc();
$stmtUser->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/sistemaDeVagas/imagens/Logo.svg" type="image/svg+xml">
    <title>Assistente IA - RH Conexão</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/sistemaDeVagas/css/header.css">

    <link rel="stylesheet" href="/sistemaDeVagas/css/ia.css">
</head>
<body>
    <?php include __DIR__ . '/templates/header.php'; ?>
    <main class="main-content">
        <div class="container">
            <header class="page-header">
                <h1>Seu Assistente de Carreira IA</h1>
                <p>Use nossa inteligência artificial para otimizar seu currículo, se preparar para entrevistas e encontrar a vaga perfeita.</p>
            </header>

            <section class="ai-features-grid">
                <article class="ai-feature-card">
                    <div class="feature-header">
                        <div class="feature-icon">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 4h3a1 1 0 0 1 1 1v15a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h3m0 3h6m-6 7 2 2 4-4m-5-9v4h4V3h-4Z"/></svg>
                        </div>
                        <div class="feature-title">
                            <h2>Otimizador de Currículo</h2>
                            <p>Receba dicas para destacar seu CV.</p>
                        </div>
                    </div>
                    <div class="feature-content">
                        <div class="ai-results">
                            <h3>Análise do Curriculo.pdf:</h3>
                            <div class="result-item success"><span>Uso de verbos de ação fortes e claros.</span></div>
                            <div class="result-item warning"><span>Sugestão: Adicionar competências como "Docker" e "CI/CD".</span></div>
                        </div>
                    </div>
                    <div class="feature-footer">
                        <button id="openResumeModalBtn" class="btn btn-primary"><span>Analisar meu CV</span></button>
                    </div>
                </article>

                <article class="ai-feature-card">
                    <div class="feature-header">
                        <div class="feature-icon"><svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 0 0-2 2v4m5-6h8M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2m0 0h3a2 2 0 0 1 2 2v4m0 0v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-6m18 0s-4 2-9 2-9-2-9-2m9-2h.01"/></svg></div>
                        <div class="feature-title">
                            <h2>Preparador de Entrevista</h2>
                            <p>Simule perguntas para uma vaga.</p>
                        </div>
                    </div>
                    <div class="feature-content">
                        <p>Selecione uma de suas candidaturas para gerar perguntas de entrevista personalizadas.</p>
                        <div class="form-group"><select><option>Selecione a vaga...</option><option>Desenvolvedor(a) Full-Stack</option></select></div>
                    </div>
                    <div class="feature-footer">
                        <button class="btn btn-primary" id="generate-questions-btn"><span>Gerar Perguntas</span></button>
                    </div>
                </article>

                <article class="ai-feature-card">
                    <div class="feature-header">
                        <div class="feature-icon"><svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7.171 12.906-2.153 6.411 2.672-.89 1.568 2.34 1.825-5.183m5.73-2.678 2.154 6.411-2.673-.89-1.568 2.34-1.825-5.183M9.165 4.3c.58.068 1.153-.17 1.515-.628a1.681 1.681 0 0 1 2.64 0 1.68 1.68 0 0 0 1.515.628 1.681 1.681 0 0 1 1.866 1.866c-.068.58.17 1.154.628 1.516a1.681 1.681 0 0 1 0 2.639 1.682 1.682 0 0 0-.628 1.515 1.681 1.681 0 0 1-1.866 1.866 1.681 1.681 0 0 0-1.516.628 1.681 1.681 0 0 1-2.639 0 1.681 1.681 0 0 0-1.515-.628 1.681 1.681 0 0 1-1.867-1.866 1.681 1.681 0 0 0-.627-1.515 1.681 1.681 0 0 1 0-2.64c.458-.361.696-.935.627-1.515A1.681 1.681 0 0 1 9.165 4.3ZM14 9a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z"/></svg></div>
                        <div class="feature-title">
                            <h2>Carta de Apresentação</h2>
                            <p>Crie um rascunho em segundos.</p>
                        </div>
                    </div>
                    <div class="feature-content">
                        <p>A IA usará os dados do seu perfil e da vaga para criar uma carta de apresentação inicial.</p>
                        <div class="form-group"><select><option>Selecione a vaga para a carta...</option><option>Analista de Marketing Digital</option></select></div>
                    </div>
                    <div class="feature-footer">
                        <button id="openCoverLetterModalBtn" class="btn btn-primary"><span>Criar Rascunho</span></button>
                    </div>
                </article>
            </section>
            <section class="ai-chat-section">
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
                            <a href="https://chatgpt.com/g/g-6809798f94e48191b2c9216afd9c478e-clara" target="_blank" class="ia-button">Ir para o Assistente IA</a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
    
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

    <script defer src="/sistemaDeVagas/js/ia.js"></script>
    <script type="module" src="https://unpkg.com/@splinetool/viewer@1.10.41/build/spline-viewer.js"></script>
    <script>
        // Adicionando a lógica do dropdown do cabeçalho que estava faltando nesta página.
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownBtn = document.querySelector('.dropdown-btn');
            const dropdownMenu = document.querySelector('.dropdown-menu');

            if (dropdownBtn && dropdownMenu) {
                dropdownBtn.addEventListener('click', (event) => {
                    event.stopPropagation(); // Impede que o clique se propague e feche o menu imediatamente.
                    dropdownMenu.classList.toggle('show');
                });

                window.addEventListener('click', (event) => {
                    if (!dropdownBtn.contains(event.target)) {
                        dropdownMenu.classList.remove('show');
                    }
                });
            }
        });
    </script>
</body>
</html>