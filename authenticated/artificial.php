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
        </div>
    
    <div id="promptModal" class="modal">
        </div>
    
    <div id="coverLetterModal" class="modal">
        </div>

    <script defer src="../js/ia.js"></script>
    <script type="module" src="https://unpkg.com/@splinetool/viewer@1.10.41/build/spline-viewer.js"></script>
</body>
</html>