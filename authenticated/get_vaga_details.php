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
    echo "<h3>" . htmlspecialchars($vaga['cargo']) . "</h3>";
    echo "<p><span>Empresa:</span> " . htmlspecialchars($vaga['empresa']) . "</p>";
    echo "<p><span>Descrição:</span><br>" . nl2br(htmlspecialchars($vaga['descricao'])) . "</p>";
    echo "<p><span>Requisitos:</span><br>" . nl2br(htmlspecialchars($vaga['requisitos'])) . "</p>";
    echo "<p><span>Salário:</span> R$ " . htmlspecialchars(number_format($vaga['salario'], 2, ',', '.')) . "</p>";
    echo "<p><span>Localização:</span> " . htmlspecialchars($vaga['localizacao']) . "</p>";
    echo "<p><span>Tipo de Contrato:</span> " . htmlspecialchars($vaga['tipo_contrato']) . "</p>";
} else {
    echo '<p>Vaga não encontrada.</p>';
}

$stmt->close();
$conn->close();
