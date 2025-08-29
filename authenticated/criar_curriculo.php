<?php
session_start();

require_once __DIR__ . '/../config/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: /sistemaDeVagas/login.php');
    exit();
}

// Busca os dados do usuário para exibir no header.
$stmt = $pdo->prepare("SELECT nome, foto FROM cadastro WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

// Lógica para processar o formulário quando enviado (método POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Aqui você implementaria a lógica para salvar os dados do currículo no banco de dados.
    $message = "Currículo salvo com sucesso! (Lógica de salvamento não implementada)";
}

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Currículo - Conexão RH 2.0</title>
    <link rel="stylesheet" href="/sistemaDeVagas/css/criarCurriculo.css">
    <link rel="stylesheet" href="/sistemaDeVagas/css/header.css">
</head>
<body>

<?php require_once 'templates/header.php'; ?>

<main>
    <div class="curriculo-form">
        <h1>Criar ou Editar seu Currículo</h1>

        <?php if (isset($message)): ?>
            <div class="message"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>

        <form action="criar_curriculo.php" method="POST">
            <div class="form-section">
                <h2>Informações Pessoais</h2>
                <div class="form-group"><label for="nome_completo">Nome Completo</label><input type="text" id="nome_completo" name="nome_completo" required></div>
                <div class="form-group"><label for="email">Email</label><input type="email" id="email" name="email" required></div>
                <div class="form-group"><label for="telefone">Telefone</label><input type="tel" id="telefone" name="telefone" required></div>
                <div class="form-group"><label for="endereco">Endereço (Cidade, Estado)</label><input type="text" id="endereco" name="endereco"></div>
            </div>

            <div class="form-section">
                <h2>Resumo Profissional</h2>
                <div class="form-group"><label for="resumo">Fale um pouco sobre sua carreira e objetivos.</label><textarea id="resumo" name="resumo" rows="5"></textarea></div>
            </div>

            <div class="form-section" id="experiencia-section">
                <h2>Experiência Profissional</h2>
                <!-- JS will add items here -->
                <button type="button" id="add-experiencia" class="btn">Adicionar Experiência</button>
            </div>

            <div class="form-section" id="formacao-section">
                <h2>Formação Acadêmica</h2>
                <!-- JS will add items here -->
                <button type="button" id="add-formacao" class="btn">Adicionar Formação</button>
            </div>

            <div class="form-section">
                <h2>Habilidades</h2>
                <div class="form-group"><label for="habilidades">Liste suas principais habilidades (separadas por vírgula)</label><textarea id="habilidades" name="habilidades" rows="4"></textarea></div>
            </div>

            <button type="submit" class="btn-submit">Salvar Currículo</button>
        </form>
    </div>
</main>
<script src="/sistemaDeVagas/js/criarCurriculo.js"></script>
</body>
</html>