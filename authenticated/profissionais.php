<?php
session_start();

// Use a conexão centralizada com o banco de dados via PDO
require_once __DIR__ . '/../config/db.php';

// --- VERIFICAÇÃO DE LOGIN ---
if (!isset($_SESSION["user_id"])) {
    header("Location: ../login.php");
    exit;
}
$userId = $_SESSION['user_id'];

// --- BUSCA DADOS DO USUÁRIO LOGADO PARA O HEADER ---
$stmt_user = $pdo->prepare("SELECT nome, foto FROM cadastro WHERE id = ?");
$stmt_user->execute([$userId]);
$user = $stmt_user->fetch(PDO::FETCH_ASSOC);

// --- LÓGICA DE BUSCA DE PROFISSIONAIS (Refatorado para PDO) ---
$sql = "SELECT c.id, c.nome, c.sobrenome, c.foto, COALESCE(p.nome, 'Não informada') AS nome_profissao 
        FROM cadastro c 
        LEFT JOIN profissao p ON c.id_profissao = p.id 
        WHERE c.id != :userId";

$params = [':userId' => $userId];

$search_nome = $_GET['nome'] ?? '';
$search_profissao = $_GET['profissao'] ?? '';

if (!empty($search_nome)) {
    $sql .= " AND (c.nome LIKE :searchNome OR c.sobrenome LIKE :searchNome)";
    $params[':searchNome'] = "%" . $search_nome . "%";
}

if (!empty($search_profissao)) {
    $sql .= " AND p.nome LIKE :searchProfissao";
    $params[':searchProfissao'] = "%" . $search_profissao . "%";
}

$sql .= " ORDER BY c.nome"; // Adicionado para ordenar os resultados alfabeticamente

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$professionals = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encontrar Profissionais</title>
    
    <link rel="icon" type="image/png" href="/sistemaDeVagas/imagens/Logo.svg"/>
    
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="/sistemaDeVagas/css/header.css">
    <link rel="stylesheet" href="/sistemaDeVagas/css/profissionais.css">
</head>
<body>
    <?php require_once __DIR__ . '/templates/header.php'; ?>

    <header class="page-header">
        <h1>Encontre Profissionais</h1>
        <p>Busque por talentos qualificados para sua equipe</p>
    </header>

    <section class="search-container">
        <form method="get" action="profissionais.php" class="search-form">
            <div class="input-wrapper">
                <i class="fa-solid fa-user"></i>
                <input type="text" name="nome" placeholder="Buscar por nome..." value="<?= htmlspecialchars($search_nome); ?>">
            </div>
            <div class="input-wrapper">
                <i class="fa-solid fa-briefcase"></i>
                <input type="text" name="profissao" placeholder="Buscar por profissão..." value="<?= htmlspecialchars($search_profissao); ?>">
            </div>
            <button type="submit" class="search-button">
                <i class="fa-solid fa-search"></i>
                <span>Buscar</span>
            </button>
        </form>
    </section>

    <main class="professionals-grid">
    <?php if (count($professionals) > 0): ?>
        <?php foreach ($professionals as $professional): ?>
            <div class="professional-card">
                <?php 
                    $foto = !empty($professional['foto']) 
                        ? '/sistemaDeVagas/authenticated/uploads/' . htmlspecialchars($professional['foto']) 
                        : '/sistemaDeVagas/imagens/avatar_default.webp'; // Caminho para uma imagem padrão
                ?>
                <img src="<?= $foto ?>" alt="Foto de <?= htmlspecialchars($professional['nome']) ?>" class="professional-photo">
                
                <div class="professional-info">
                    <h3><?= htmlspecialchars($professional['nome'] . ' ' . $professional['sobrenome']) ?></h3>
                    <p><?= htmlspecialchars($professional['nome_profissao']) ?></p>
                </div>

                <div class="professional-actions">
                    <a href="/sistemaDeVagas/authenticated/perfil_publico.php?id=<?= $professional['id'] ?>" class="btn-action btn-view">
                        <i class="fa-solid fa-eye"></i><br> Ver Perfil
                    </a>
                    <a href="/sistemaDeVagas/authenticated/baixar_curriculo.php?id=<?= $professional['id'] ?>" class="btn-action btn-download">
                        <i class="fa-solid fa-download"></i> Baixar CV
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="not-found">
            <i class="fa-solid fa-magnifying-glass"></i>
            <h2>Nenhum profissional encontrado</h2>
            <p>Tente refinar seus critérios de busca para encontrar o talento que procura.</p>
        </div>
    <?php endif; ?>
    </main>

</body>
<script src="/sistemaDeVagas/js/profissionais.js"></script>
</html>