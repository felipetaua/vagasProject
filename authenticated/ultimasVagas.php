<?php
session_start();
// Use a conexão centralizada com o banco de dados via PDO
require_once __DIR__ . '/../config/db.php';

// Verifica se o usuário está logado
if (!isset($_SESSION["user_id"])) {
    header("Location: ../login.php");
    exit;
}
$userId = $_SESSION['user_id'];

// --- BUSCA DADOS DO USUÁRIO LOGADO PARA O HEADER ---
// Esta consulta busca o nome e a foto do usuário logado para exibição no cabeçalho.
$stmt_user = $pdo->prepare("SELECT nome, foto FROM cadastro WHERE id = ?");
$stmt_user->execute([$userId]);
$user = $stmt_user->fetch(PDO::FETCH_ASSOC);

// --- LÓGICA DE BUSCA DE VAGAS (Refatorado para PDO) ---
$sql = "SELECT v.id, v.empresa, v.cargo, v.cidade, v.carga_horaria,
               COUNT(DISTINCT i.id) as total_inscritos,
               COALESCE(SUM(CASE WHEN i.id_usuario = ? THEN 1 ELSE 0 END), 0) as ja_inscrito
        FROM vagas v 
        LEFT JOIN inscricoes i ON v.id = i.id_vaga
        WHERE v.usuario_responsavel != ?";

$params = [$userId, $userId];

$searchTerm = $_GET['vagas'] ?? '';
if (!empty($searchTerm)) {
    $sql .= " AND v.cargo LIKE ?";
    $params[] = "%" . $searchTerm . "%";
}

$sql .= " GROUP BY v.id ORDER BY v.id DESC"; // Mostra as vagas mais recentes primeiro

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$vagas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encontrar Vagas</title>

    <link rel="icon" type="image/png" href="../imagens/Logo.svg"/>
    
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="../css/header.css"> 
    <link rel="stylesheet" href="../css/ultimasVagas.css">
</head>
<body>
    <?php require_once __DIR__ . '/templates/header.php'; ?>

    <header class="page-header">
        <h1>Encontre a sua próxima oportunidade</h1>
        <p>Milhares de vagas de tecnologia esperando por você</p>
        <form method="get" action="" class="search-form">
            <div class="input-wrapper">
                <i class="fa-solid fa-search"></i>
                <input type="text" placeholder="Digite o cargo que busca..." name='vagas' value="<?= htmlspecialchars($searchTerm) ?>">
            </div>
            <button type="submit">Buscar</button>
        </form>
    </header>
    
    <main class="container">
        <?php if (count($vagas) > 0): ?>
            <div class="job-grid">
                <?php foreach ($vagas as $vaga): ?>
                    <div class="job-card">
                        <div class="job-card-header">
                            <h3 class="job-title"><?= htmlspecialchars($vaga["cargo"]) ?></h3>
                            <p class="job-company"><?= htmlspecialchars($vaga["empresa"]) ?></p>
                        </div>
                        <div class="job-card-body">
                            <div class="job-detail"><i class="fa-solid fa-location-dot"></i><span><?= htmlspecialchars($vaga["cidade"]) ?></span></div>
                            <div class="job-detail"><i class="fa-solid fa-briefcase"></i><span><?= htmlspecialchars($vaga["carga_horaria"]) ?></span></div>
                            <div class="job-detail"><i class="fa-solid fa-users"></i><span><?= $vaga["total_inscritos"] ?> inscritos</span></div>
                        </div>
                        <div class="job-card-actions">
                            <button class="action-btn view-btn" data-id="<?= $vaga["id"] ?>"><i class="fa-solid fa-eye"></i> Visualizar</button>
                            <?php if ($vaga['ja_inscrito'] > 0): ?>
                                <span class="status-badge applied"><i class="fa-solid fa-check"></i> Inscrito</span>
                            <?php else: ?>
                                <a href="inscrever.php?vaga=<?= $vaga["id"] ?>" class="action-btn apply-btn"><i class="fa-solid fa-paper-plane"></i> Candidatar</a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="not-found">
                <i class="fa-solid fa-wind"></i>
                <h2>Nenhuma vaga encontrada</h2>
                <p>Tente buscar por outros termos ou verifique novamente mais tarde.</p>
            </div>
        <?php endif; ?>
    </main>

    <div id="vagaModal" class="modal">
      <div class="modal-content">
        <span class="close-btn">&times;</span>
        <div id="modal-body"><p>Carregando...</p></div>
      </div>
    </div>

    <script src="../js/ultimasVagas.js" defer></script>
</body>
</html>