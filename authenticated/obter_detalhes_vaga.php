<?php
session_start();
header('Content-Type: application/json');

// Include the centralized database connection using an absolute path for robustness
require_once __DIR__ . '/db_connection.php';

// Function to send a JSON error and exit
function send_json_error($statusCode, $message) {
    http_response_code($statusCode);
    echo json_encode(['error' => $message]);
    exit;
}

// Check if user is logged in and if an ID is provided
if (!isset($_SESSION['user_id'])) {
    send_json_error(403, 'Acesso não autorizado.');
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    send_json_error(400, 'ID da vaga inválido.');
}

$vagaId = (int)$_GET['id'];

// Fetch vacancy details securely using prepared statements
$sql = "SELECT empresa, cargo, descricao, requisitos, salario, cidade, telefone FROM vagas WHERE id = ?";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    error_log("Prepare failed in obter_detalhes_vaga.php: " . $conn->error);
    send_json_error(500, 'Erro interno do servidor.');
}

$stmt->bind_param("i", $vagaId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $vaga = $result->fetch_assoc();
    // Safely format salary, handling NULL or non-numeric values
    $salario = $vaga['salario'] ?? 0;
    $vaga['salario'] = is_numeric($salario) ? number_format((float)$salario, 2, ',', '.') : 'Não informado';
    echo json_encode($vaga);
} else {
    echo json_encode(['error' => 'Vaga não encontrada.']);
}

$stmt->close();
$conn->close();
