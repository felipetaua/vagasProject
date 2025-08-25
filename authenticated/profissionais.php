<?php
session_start();

require_once __DIR__ . '/db_connection.php';

// --- VERIFICAÇÃO DE LOGIN ---
if (!isset($_SESSION["user_id"])) {
    header("Location: ../login.php");
    exit;
}
$userId = $_SESSION['user_id'];

// --- LÓGICA DE BUSCA SEGURA ---
$sql = "SELECT c.id, c.nome, c.sobrenome, c.foto, COALESCE(p.nome, 'Não informada') AS nome_profissao 
        FROM cadastro c 
        LEFT JOIN profissao p ON c.id_profissao = p.id 
        WHERE c.id != ?";

$params = [$userId];
$types = "i";

$search_nome = $_GET['nome'] ?? '';
$search_profissao = $_GET['profissao'] ?? '';

if (!empty($search_nome)) {
    $sql .= " AND (c.nome LIKE ? OR c.sobrenome LIKE ?)";
    $searchTerm = "%" . $search_nome . "%";
    array_push($params, $searchTerm, $searchTerm);
    $types .= "ss";
}

if (!empty($search_profissao)) {
    $sql .= " AND p.nome LIKE ?";
    $searchTermProf = "%" . $search_profissao . "%";
    $params[] = $searchTermProf;
    $types .= "s";
}

$sql .= " ORDER BY c.nome"; // Adicionado para ordenar os resultados alfabeticamente

$stmt = $conn->prepare($sql);
if ($stmt) {
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    $result = $stmt->get_result();
}

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
    <?php if (isset($result) && $result->num_rows > 0): ?>
        <?php while ($professional = $result->fetch_assoc()): ?>
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
                        <i class="fa-solid fa-eye"></i> Ver Perfil
                    </a>
                    <a href="/sistemaDeVagas/authenticated/baixar_curriculo.php?id=<?= $professional['id'] ?>" class="btn-action btn-download">
                        <i class="fa-solid fa-download"></i> Baixar CV
                    </a>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <div class="not-found">
            <i class="fa-solid fa-magnifying-glass"></i>
            <h2>Nenhum profissional encontrado</h2>
            <p>Tente refinar seus critérios de busca para encontrar o talento que procura.</p>
        </div>
    <?php endif; ?>
    </main>

    <?php
    if (isset($stmt)) {
        $stmt->close();
    }
    $conn->close();
    ?>
</body>
</html>