<?php

session_start();
// Ensure the user is logged in before fetching details
if (!isset($_SESSION["user_id"])) {
    http_response_code(403); // Forbidden
    echo '<p>Acesso negado. Por favor, faça o login.</p>';
    exit;
}
$userId = $_SESSION['user_id'];

require_once __DIR__ . '/db_connection.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    http_response_code(400);
    echo '<p>ID da vaga inválido.</p>';
    exit;
}

$vagaId = (int)$_GET['id'];

$sql = "SELECT 
            v.*, 
            c.foto AS foto_usuario,
            (SELECT COUNT(*) FROM inscricoes i WHERE i.id_vaga = v.id AND i.id_usuario = ?) as ja_inscrito
        FROM vagas v 
        LEFT JOIN cadastro c ON v.usuario_responsavel = c.id 
        WHERE v.id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $userId, $vagaId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $vaga = $result->fetch_assoc();

    // Header
    echo "<div class='modal-vaga-header'>";
    if (!empty($vaga['foto_usuario'])) {
        echo "<img src='/sistemaDeVagas/authenticated/uploads/" . htmlspecialchars($vaga['foto_usuario']) . "' alt='Logo da Empresa' class='company-logo-modal'>";
    } else {
        echo "<img src='https://placehold.co/80x80/EFEFEF/AAAAAA&text=Logo' alt='Logo da Empresa' class='company-logo-modal'>";
    }
    echo "<div class='modal-header-text'>";
    echo "<h3>" . htmlspecialchars($vaga['cargo']) . "</h3>";
    echo "<p>" . htmlspecialchars($vaga['empresa']) . "</p>";
    echo "</div></div>";

    // Body
    echo "<div class='modal-vaga-body'>";
    if (!empty($vaga['descricao_empresa'])) echo "<h4>Sobre a Empresa</h4><p>" . nl2br(htmlspecialchars($vaga['descricao_empresa'])) . "</p>";
    echo "<h4>Atividades do Cargo</h4><p>" . nl2br(htmlspecialchars($vaga['descricao'])) . "</p>";
    echo "<h4>Habilidades Requeridas</h4><p>" . nl2br(htmlspecialchars($vaga['requisitos'])) . "</p>";
    echo "<h4>Detalhes da Vaga</h4>";
    echo "<div class='vaga-info-modal'>";
    echo "<div class='info-item'><strong>Salário:</strong><span>R$ " . htmlspecialchars(number_format($vaga['salario'], 2, ',', '.')) . "</span></div>";
    if (!empty($vaga['carga_horaria'])) echo "<div class='info-item'><strong>Carga Horária:</strong><span>" . htmlspecialchars($vaga['carga_horaria']) . "</span></div>";
    if (!empty($vaga['localizacao'])) echo "<div class='info-item'><strong>Localização:</strong><span>" . htmlspecialchars($vaga['localizacao']) . "</span></div>";
    echo "</div>";
    if (!empty($vaga['beneficios'])) echo "<h4>Benefícios</h4><p>" . nl2br(htmlspecialchars($vaga['beneficios'])) . "</p>";
    echo "</div>";

    // Footer with action button
    echo "<div class='modal-vaga-footer'>";
    if ($vaga['ja_inscrito'] > 0) {
        echo "<span class='action-btn applied'><i class='fa-solid fa-check'></i> Inscrito</span>";
    } else {
        echo "<a href='inscrever.php?vaga=" . $vaga['id'] . "' class='action-btn apply-btn'><i class='fa-solid fa-paper-plane'></i> Candidatar-se</a>";
    }
    echo "</div>";
} else {
    http_response_code(404);
    echo '<p>Vaga não encontrada.</p>';
}

$stmt->close();
$conn->close();
