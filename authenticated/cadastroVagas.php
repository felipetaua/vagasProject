<?php
session_start();
require_once __DIR__ . '/db_connection.php';

// Verifica se o usuário está logado
if (!isset($_SESSION["user_id"])) {
    header("Location: /sistemaDeVagas/login.php");
    exit;
}
$userId = $_SESSION["user_id"];

// Busca os dados do usuário para o cabeçalho
$stmt = $conn->prepare("SELECT nome, foto FROM `cadastro` WHERE id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$resultUser = $stmt->get_result();
$user = $resultUser->fetch_assoc();
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Divulgação de Vaga - Conexão RH 2.0</title>
    <!-- <link rel="stylesheet" href="/sistemaDeVagas/css/home.css"> -->
    <link rel="stylesheet" href="/sistemaDeVagas/css/forms.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <?php include __DIR__ . '/templates/header.php'; ?>

    <div class="container">
        <h1>DIVULGAÇÃO DE VAGA</h1>
        <?php 
            if (isset($_SESSION['error_message'])) {
                echo '<p class="error-message">' . htmlspecialchars($_SESSION['error_message']) . '</p>';
                unset($_SESSION['error_message']);
            }
        ?>
        <form action="validaCadastroVagas.php" method="POST">
            <div class="form-group">
                <label for="empresa">1. NOME/RAZÃO SOCIAL:</label>
                <input type="text" id="empresa" name="empresa" required>
            </div>
            <div class="form-group">
                <label for="descricao_empresa">2. BREVE DESCRIÇÃO DA EMPRESA:</label>
                <textarea id="descricao_empresa" name="descricao_empresa" required></textarea>
            </div>
            <div class="form-group">
                <label for="telefone_empresa">3. TELEFONE:</label>
                <input type="text" id="telefone_empresa" name="telefone_empresa" required>
            </div>
            <div class="form-group">
                <label for="email_empresa">4. E-MAIL:</label>
                <input type="email" id="email_empresa" name="email_empresa" required>
            </div>
            <div class="form-group">
                <label for="localizacao">5. ENDEREÇO:</label>
                <input type="text" id="localizacao" name="localizacao" required>
            </div>
            <div class="form-group">
                <label for="cargo">6. CARGO:</label>
                <input type="text" id="cargo" name="cargo" required>
            </div>
            <div class="form-group">
                <label for="descricao">7. ATIVIDADES RELACIONADAS AO CARGO:</label>
                <textarea id="descricao" name="descricao" required></textarea>
            </div>
            <div class="form-group">
                <label for="carga_horaria">8. CARGA HORÁRIA:</label>
                <input type="text" id="carga_horaria" name="carga_horaria" placeholder="Ex: 40h semanais, Segunda a Sexta" required>
            </div>
            <div class="form-group">
                <label for="salario">9. SALÁRIO:</label>
                <input type="number" id="salario" name="salario" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="beneficios">10. BENEFÍCIOS:</label>
                <textarea id="beneficios" name="beneficios" required></textarea>
            </div>
            <div class="form-group">
                <label for="requisitos">11. HABILIDADES REQUERIDAS:</label>
                <textarea id="requisitos" name="requisitos" required></textarea>
            </div>
            
            <button type="submit" class="btn-submit">Publicar Vaga</button>
        </form>
    </div>
</body>
<script src="../js/cadastroVagas.js"></script>
</html>