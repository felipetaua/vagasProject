<?php
session_start();
require_once __DIR__ . '/db_connection.php';

if (!isset($_SESSION["user_id"])) {
    header("Location: /sistemaDeVagas/login.php");
    exit;
}
$userId = $_SESSION["user_id"];

// --- LÓGICA DE BUSCA DE DADOS ---
// Busca dados do usuário para o header
$stmtUser = $conn->prepare("SELECT nome, foto FROM `cadastro` WHERE id = ?");
$stmtUser->bind_param("i", $userId);
$stmtUser->execute();
$resultUser = $stmtUser->get_result();
$user = $resultUser->fetch_assoc();
$stmtUser->close();

$sqlVagas = "
    SELECT v.id, v.empresa, v.cargo, COUNT(i.id_vaga) AS total_inscritos
    FROM vagas v
    LEFT JOIN inscricoes i ON v.id = i.id_vaga
    WHERE v.usuario_responsavel = ?
    GROUP BY v.id, v.empresa, v.cargo
    ORDER BY v.id DESC
";
$stmtVagas = $conn->prepare($sqlVagas);
$stmtVagas->bind_param("i", $userId);
$stmtVagas->execute();
$resultVagas = $stmtVagas->get_result();

// O fechamento da conexão foi movido para o final do script
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minhas Vagas | Sistema de Vagas</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    
    <link rel="stylesheet" href="/sistemaDeVagas/css/header.css">
    <link rel="stylesheet" href="/sistemaDeVagas/css/vagasCriadas.css">
</head>
<body>
    <?php include __DIR__ . '/templates/header.php'; ?>

    <main class="container">
        <header class="page-header">
            <h1>Minhas Vagas Publicadas</h1>
            <p>Gerencie as vagas que você criou e veja os profissionais inscritos.</p>
        </header>

        <section class="vagas-grid" id="vagas-container">
            <?php if ($resultVagas->num_rows > 0): ?>
                <?php while ($vaga = $resultVagas->fetch_assoc()): ?>
                    <div class="vaga-card">
                        <div class="card-header">
                            <h2 class="cargo"><?= htmlspecialchars($vaga['cargo']) ?></h2>
                            <span class="empresa"><?= htmlspecialchars($vaga['empresa']) ?></span>
                        </div>
                        <div class="card-body">
                            <div class="info-item">
                                <i class="fa-solid fa-users"></i>
                                <span><strong><?= $vaga['total_inscritos'] ?></strong> profissionais inscritos</span>
                            </div>
                        </div>
                        <div class="card-actions">
                            <button class="action-btn btn-inscritos" data-vaga-id="<?= $vaga['id'] ?>">
                                <i class="fa-solid fa-eye"></i> Ver Inscritos
                            </button>
                            <button class="action-btn btn-encerrar" data-vaga-id="<?= $vaga['id'] ?>">
                                <i class="fa-solid fa-trash-can"></i> Encerrar
                            </button>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="no-results">
                    <p>Você ainda não publicou nenhuma vaga.</p>
                </div>
            <?php endif; ?>
            <?php
                $stmtVagas->close();
                $conn->close();
            ?>
        </section>
    </main>

    <div id="inscritos-modal" class="modal-overlay" style="display: none;">
        <div class="modal-content">
            <header class="modal-header">
                <h3>Profissionais Inscritos</h3>
                <button class="close-modal-btn"><i class="fa-solid fa-xmark"></i></button>
            </header>
            <div class="modal-body" id="usuarios-vinculados">
                <div class="loader"></div>
            </div>
        </div>
    </div>
    
    <div id="toast-container"></div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/sistemaDeVagas/js/vagasCriadas.js"></script>
</body>
</html>