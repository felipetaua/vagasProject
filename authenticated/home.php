<?php
session_start();

require_once __DIR__ . '/db_connection.php';

// 1. VERIFICAÇÃO DE LOGIN
if (!isset($_SESSION["user_id"])) {
    header("Location: /sistemaDeVagas/login.php");
    exit;
}
$userId = $_SESSION["user_id"];

// 2. BUSCA DADOS DO USUÁRIO LOGADO (para o header)
// Usar prepared statements é uma ótima prática de segurança!
$stmtUser = $conn->prepare("SELECT nome, foto FROM `cadastro` WHERE id = ?");
$stmtUser->bind_param("i", $userId);
$stmtUser->execute();
$resultUser = $stmtUser->get_result();
$user = $resultUser->fetch_assoc();
$stmtUser->close();

// 3. BUSCA OS 5 ÚLTIMOS USUÁRIOS CADASTRADOS (SQL Otimizada)
$sqlUsuarios = "SELECT c.id, c.foto, c.nome, COALESCE(p.nome, 'Não informado') as profissao
                FROM `cadastro` c
                LEFT JOIN `profissao` p ON c.id_profissao = p.id
                ORDER BY c.id DESC
                LIMIT 5";
$resultUsuarios = $conn->query($sqlUsuarios);

// 4. BUSCA AS 5 ÚLTIMAS VAGAS CADASTRADAS (SQL Otimizada)
$sqlVagas = "SELECT id, empresa, cargo FROM vagas ORDER BY id DESC LIMIT 5";
$resultVagas = $conn->query($sqlVagas);

$conn->close(); // Fechamos a conexão aqui, pois já buscamos todos os dados.
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
    <script src="https://kit.fontawesome.com/65f22fe718.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="/sistemaDeVagas/css/header.css">
    <link rel="stylesheet" href="/sistemaDeVagas/css/home.css">
</head>
<body>

<?php include __DIR__ . '/templates/header.php'; ?>

<main class="container">
    <section class="content-section">
        <h1>Últimos Usuários</h1>
        <div class="card-list">
            <?php if ($resultUsuarios && $resultUsuarios->num_rows > 0): ?>
                <?php while ($usuario = $resultUsuarios->fetch_assoc()): ?>
                    <div class="card">
                        <div class="card-info">
                            <img src="/sistemaDeVagas/authenticated/uploads/<?= htmlspecialchars($usuario['foto']) ?>" alt="Foto de <?= htmlspecialchars($usuario['nome']) ?>" class="user-photo">
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
                <?php endwhile; ?>
            <?php else: ?>
                <p class="no-results">Nenhum usuário encontrado.</p>
            <?php endif; ?>
        </div>
    </section>

    <section class="content-section">
        <h1>Últimas Vagas</h1>
        <div class="card-list">
            <?php if ($resultVagas && $resultVagas->num_rows > 0): ?>
                <?php while ($vaga = $resultVagas->fetch_assoc()): ?>
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
                <?php endwhile; ?>
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