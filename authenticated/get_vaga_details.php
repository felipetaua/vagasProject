<?php

session_start();

// Ensure the user is logged in before fetching details
if (!isset($_SESSION["user_id"])) {
    http_response_code(403); // Forbidden
    echo '<p>Acesso negado. Por favor, faça o login.</p>';
    exit;
}

require_once __DIR__ . '/db_connection.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo '<p>ID da vaga inválido.</p>';
    exit;
}

$vagaId = (int)$_GET['id'];

$stmt = $conn->prepare("SELECT * FROM vagas WHERE id = ?");
$stmt->bind_param("i", $vagaId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $vaga = $result->fetch_assoc();
    // Usando uma estrutura mais organizada e verificando a existência dos campos
    echo "<h3>" . htmlspecialchars($vaga['cargo']) . "</h3>";
    echo "<p><strong>Empresa:</strong> " . htmlspecialchars($vaga['empresa']) . "</p>";
    
    if (!empty($vaga['descricao_empresa'])) {
        echo "<h4>Sobre a Empresa</h4>";
        echo "<p>" . nl2br(htmlspecialchars($vaga['descricao_empresa'])) . "</p>";
    }

    echo "<h4>Atividades do Cargo</h4>";
    echo "<p>" . nl2br(htmlspecialchars($vaga['descricao'])) . "</p>";

    echo "<h4>Habilidades Requeridas</h4>";
    echo "<p>" . nl2br(htmlspecialchars($vaga['requisitos'])) . "</p>";

    echo "<h4>Detalhes da Vaga</h4>";
    echo "<p><strong>Salário:</strong> R$ " . htmlspecialchars(number_format($vaga['salario'], 2, ',', '.')) . "</p>";
    if (!empty($vaga['beneficios'])) echo "<p><strong>Benefícios:</strong> " . nl2br(htmlspecialchars($vaga['beneficios'])) . "</p>";
    if (!empty($vaga['carga_horaria'])) echo "<p><strong>Carga Horária:</strong> " . htmlspecialchars($vaga['carga_horaria']) . "</p>";
    if (!empty($vaga['localizacao'])) echo "<p><strong>Localização:</strong> " . htmlspecialchars($vaga['localizacao']) . "</p>";
    if (!empty($vaga['email_empresa'])) echo "<p><strong>Contato:</strong> " . htmlspecialchars($vaga['email_empresa']) . "</p>";
} else {
    echo '<p>Vaga não encontrada.</p>';
}

$stmt->close();
$conn->close();
