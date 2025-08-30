<?php
session_start();

require_once __DIR__ . '/../config/db.php'; // Alterado para usar a conexão PDO centralizada

// 1. VERIFICAÇÃO DE LOGIN
if (!isset($_SESSION["user_id"])) {
    header("Location: /sistemaDeVagas/login.php");
    exit;
}

$userId = $_SESSION["user_id"];
$userType = $_SESSION["user_type"];

// 2. BUSCA DADOS DO USUÁRIO LOGADO (para o header)
$user = [];
$hasCurriculo = false;
$hasProfissao = false;

if ($userType === 'candidato') {
    $stmtUser = $pdo->prepare(
        "SELECT c.nome_completo AS nome, c.foto, c.id_profissao, c.curriculo, u.tipo_usuario 
         FROM candidatos c
         JOIN usuarios u ON c.id_usuario = u.id
         WHERE u.id = ?"
    );
    $stmtUser->execute([$userId]);
    $user = $stmtUser->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $hasCurriculo = !empty($user['curriculo']);
        $hasProfissao = !empty($user['id_profissao']);
    }
} elseif ($userType === 'empresa') {
    $stmtUser = $pdo->prepare(
        "SELECT e.razao_social AS nome, u.tipo_usuario, NULL as foto 
         FROM empresas e
         JOIN usuarios u ON e.id_usuario = u.id
         WHERE u.id = ?"
    );
    $stmtUser->execute([$userId]);
    $user = $stmtUser->fetch(PDO::FETCH_ASSOC);
    $hasCurriculo = true; // Banner de currículo não se aplica a empresas
    $hasProfissao = true; // Banner de profissão não se aplica a empresas
}

// 3. BUSCA OS 5 ÚLTIMOS CANDIDATOS CADASTRADOS (SQL Otimizada)
$sqlUsuarios = "SELECT c.id, c.nome_completo as nome, c.foto, COALESCE(p.nome, 'Não informado') as profissao
                FROM `candidatos` c
                LEFT JOIN `profissao` p ON c.id_profissao = p.id
                WHERE c.id_usuario != ?
                ORDER BY c.id DESC
                LIMIT 5";
$stmtUsuarios = $pdo->prepare($sqlUsuarios);
$stmtUsuarios->execute([$userId]);
$resultUsuarios = $stmtUsuarios->fetchAll(PDO::FETCH_ASSOC);

// 4. BUSCA AS 5 ÚLTIMAS VAGAS CADASTRADAS (SQL Otimizada)
$sqlVagas = "SELECT id, empresa, cargo FROM vagas ORDER BY id DESC LIMIT 5";
$resultVagas = $pdo->query($sqlVagas)->fetchAll(PDO::FETCH_ASSOC);

// Garante que $user não seja falso para evitar erros. Se for, há um problema de dados e o usuário é deslogado.
if (!$user) {
    error_log("Falha ao buscar dados para o user_id: $userId com tipo: $userType");
    session_destroy();
    header("Location: /sistemaDeVagas/login.php?error=session_error");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Sistema de Vagas</title>

    <link rel="icon" type="image/png" href="/sistemaDeVagas/imagens/Logo.svg"/>

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="/sistemaDeVagas/css/header.css">
    <link rel="stylesheet" href="/sistemaDeVagas/css/home.css">
</head>
<body>

<?php include __DIR__ . '/templates/header.php'; ?>

<main class="container">

    <?php if (!$hasCurriculo): ?>
    <section class="hero-section">
        <div class="hero-content">
            <h2>Dê o próximo passo na sua carreira!</h2>
            <p>Seu perfil está quase pronto. Crie um currículo completo para se destacar e aumentar suas chances de ser encontrado por recrutadores.</p>
            <a href="criar_curriculo.php" class="hero-cta-btn">Criar meu Currículo Agora</a>
        </div>
    </section>
    <?php elseif (!$hasProfissao): ?>
    <section class="hero-section">
        <div class="hero-content">
            <h2>Defina sua Profissão</h2>
            <p>Ajude os recrutadores a encontrarem você! Selecione sua área de atuação para aparecer nas buscas e receber ofertas relevantes.</p>
            <a href="profissao.php" class="hero-cta-btn">Escolher minha Profissão</a>
        </div>
    </section>
    <?php endif; ?>

    <section class="ai-promo-section" id="ai-promo-banner">
        <div class="ai-promo-icon">
            <i class="fa-solid fa-robot"></i>
        </div>
        <div class="ai-promo-content">
            <h3>Conheça a Clara, sua assistente de IA!</h3>
            <p>Otimize seu tempo! A Clara pode ajudar a criar descrições de vagas, analisar currículos e muito mais.</p>
        </div>
        <a href="artificial.php" class="ai-promo-btn">Experimentar Agora</a>
        <button class="close-ai-banner" title="Fechar">&times;</button>
    </section>

    <section class="quick-access-section">
        <h2>Acesso Rápido</h2>
        <div class="quick-access-grid">
            <?php if ($userType === 'empresa'): ?>
                <!-- Botões para Empresa -->
                <a href="criar_vaga.php" class="quick-access-card">
                    <i class="fa-solid fa-plus-circle"></i>
                    <span>Publicar Vaga</span>
                </a>
                <a href="vagasCriadas.php" class="quick-access-card">
                    <i class="fa-solid fa-briefcase"></i>
                    <span>Minhas Vagas</span>
                </a>
                <a href="profissionais.php" class="quick-access-card">
                    <i class="fa-solid fa-users"></i>
                    <span>Buscar Talentos</span>
                </a>
                <a href="artificial.php" class="quick-access-card">
                    <i class="fa-solid fa-robot"></i>
                    <span>Assistente IA</span>
                </a>
            <?php else: // Padrão para Colaborador ?>
                <!-- Botões para Colaborador -->
                <a href="criar_curriculo.php" class="quick-access-card">
                    <i class="fa-solid fa-file-alt"></i>
                    <span>Meu Currículo</span>
                </a>
                <a href="ultimasVagas.php" class="quick-access-card">
                    <i class="fa-solid fa-search"></i>
                    <span>Buscar Vagas</span>
                </a>
                <a href="artificial.php" class="quick-access-card">
                    <i class="fa-solid fa-robot"></i>
                    <span>Assistente IA</span>
                </a>
            <?php endif; ?>
        </div>
    </section>

    <section class="content-section">
        <h1>Últimos Usuários</h1>
        <div class="card-list">
            <?php if ($resultUsuarios && count($resultUsuarios) > 0): ?>
                <?php foreach ($resultUsuarios as $usuario): ?>
                    <div class="card">
                        <div class="card-info">
                            <?php $foto = !empty($usuario['foto']) ? '/sistemaDeVagas/authenticated/uploads/' . htmlspecialchars($usuario['foto']) : 'https://placehold.co/80x80'; ?>
                            <img src="<?= $foto ?>" alt="Foto de <?= htmlspecialchars($usuario['nome']) ?>" class="user-photo">
                            <div class="info-text">
                                <span class="info-name"><?= htmlspecialchars($usuario['nome']) ?></span>
                                <span class="info-details"><?= htmlspecialchars($usuario['profissao']) ?></span>
                            </div>
                        </div>
                        <a href="baixar_curriculo.php?id=<?= $usuario['id'] ?>" class="card-button download-btn">
                            <i class="fa-solid fa-download"></i>
                            <span>Baixar CV</span>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="no-results">Nenhum usuário encontrado.</p>
            <?php endif; ?>
        </div>
    </section>

    <section class="content-section">
        <h1>Últimas Vagas</h1>
        <div class="card-list">
            <?php if ($resultVagas && count($resultVagas) > 0): ?>
                <?php foreach ($resultVagas as $vaga): ?>
                    <div class="card">
                        <div class="card-info">
                            <div class="info-text">
                                <span class="info-name"><?= htmlspecialchars($vaga['cargo']) ?></span>
                                <span class="info-details">Empresa: <?= htmlspecialchars($vaga['empresa']) ?></span>
                            </div>
                        </div>
                        <a href="#" class="card-button apply-btn">
                            <span>Candidatar</span>
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="no-results">Nenhuma vaga encontrada.</p>
            <?php endif; ?>
        </div>
    </section>
</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
// Script para o dropdown do header (se o seu header.php precisar)
$(document).ready(function() {
    const dropdownBtn = document.querySelector('.dropdown-btn');
    const dropdownMenu = document.querySelector('.dropdown-menu');

    if (dropdownBtn && dropdownMenu) {
        dropdownBtn.addEventListener('click', () => {
            dropdownMenu.classList.toggle('show');
        });

        window.addEventListener('click', (event) => {
            if (!dropdownBtn.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.remove('show');
            }
        });
    }

    $('.download-btn').on('click', function(e) {
        e.preventDefault(); // Impede o link de navegar
        var url = $(this).attr('href');
        console.log("Iniciando download de: " + url);
        window.location.href = url;
    });
});
</script>

</body>
</html>