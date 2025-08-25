<?php
session_start();
require_once __DIR__ . '/db_connection.php';

// Verifica se o usuário está logado
if (!isset($_SESSION["user_id"])) {
    header("Location: ../login.php");
    exit;
}
$userId = $_SESSION["user_id"];

// Verifica se um ID de vaga foi passado
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID da vaga inválido.");
}
$vagaId = (int)$_GET['id'];

// Busca os dados da vaga
$stmtVaga = $conn->prepare("SELECT * FROM vagas WHERE id = ?");
$stmtVaga->bind_param("i", $vagaId);
$stmtVaga->execute();
$resultVaga = $stmtVaga->get_result();

if ($resultVaga->num_rows === 0) {
    die("Vaga não encontrada.");
}
$vaga = $resultVaga->fetch_assoc();
$stmtVaga->close();

// Busca os dados do usuário para o cabeçalho
$stmtUser = $conn->prepare("SELECT nome, foto FROM `cadastro` WHERE id = ?");
$stmtUser->bind_param("i", $userId);
$stmtUser->execute();
$resultUser = $stmtUser->get_result();
$user = $resultUser->fetch_assoc();
$stmtUser->close();

$conn->close();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vaga: <?php echo htmlspecialchars($vaga['cargo']); ?> - Conexão RH 2.0</title>
    <link rel="stylesheet" href="/sistemaDeVagas/css/home.css">
    <link rel="stylesheet" href="/sistemaDeVagas/css/vaga.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <?php include __DIR__ . '/templates/header.php'; ?>

    <div class="vaga-container">
        <?php 
            if (isset($_SESSION['success_message'])) {
                echo '<p class="success-message">' . htmlspecialchars($_SESSION['success_message']) . '</p>';
                unset($_SESSION['success_message']);
            }
        ?>
        <div class="vaga-header">
            <h1><?php echo htmlspecialchars($vaga['cargo']); ?></h1>
            <h2><?php echo htmlspecialchars($vaga['empresa']); ?></h2>
        </div>

        <div class="vaga-section">
            <h3>Sobre a Empresa</h3>
            <p><?php echo nl2br(htmlspecialchars($vaga['descricao_empresa'])); ?></p>
            <p><strong>Contato:</strong> <?php echo htmlspecialchars($vaga['email_empresa']); ?> | <?php echo htmlspecialchars($vaga['telefone_empresa']); ?></p>
            <p><strong>Endereço:</strong> <?php echo htmlspecialchars($vaga['localizacao']); ?></p>
        </div>

        <div class="vaga-section">
            <h3>Atividades Relacionadas ao Cargo</h3>
            <p><?php echo nl2br(htmlspecialchars($vaga['descricao'])); ?></p>
        </div>

        <div class="vaga-section">
            <h3>Habilidades Requeridas</h3>
            <p><?php echo nl2br(htmlspecialchars($vaga['requisitos'])); ?></p>
        </div>

        <div class="vaga-section">
            <h3>Detalhes da Vaga</h3>
            <div class="vaga-info">
                <div class="info-item">
                    <strong>Salário:</strong>
                    <span>R$ <?php echo number_format($vaga['salario'], 2, ',', '.'); ?></span>
                </div>
                <div class="info-item">
                    <strong>Carga Horária:</strong>
                    <span><?php echo htmlspecialchars($vaga['carga_horaria']); ?></span>
                </div>
                <div class="info-item">
                    <strong>Benefícios:</strong>
                    <span><?php echo nl2br(htmlspecialchars($vaga['beneficios'])); ?></span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
