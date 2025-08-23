<?php
session_start();

// 1. Verifica se o usuário está logado e se o ID da vaga foi enviado
if (!isset($_SESSION['user_id'])) {
    http_response_code(403); // Forbidden
    die("Acesso negado.");
}

if (!isset($_GET['vagaId']) || !is_numeric($_GET['vagaId'])) {
    http_response_code(400); // Bad Request
    die("ID da vaga inválido.");
}

$vagaId = (int)$_GET['vagaId'];

// 2. Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jobs";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    http_response_code(500); // Internal Server Error
    die("Falha na conexão: " . $conn->connect_error);
}

// 3. Busca os usuários inscritos na vaga de forma segura
$sql = "SELECT c.id, c.nome, c.sobrenome, c.email 
        FROM cadastro c
        JOIN inscricoes i ON c.id = i.id_usuario
        WHERE i.id_vaga = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $vagaId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($user = $result->fetch_assoc()) {
        echo "<li class='userVaga'>";
        echo "<strong>" . htmlspecialchars($user['nome'] . ' ' . $user['sobrenome']) . "</strong><br>";
        echo "<small>" . htmlspecialchars($user['email']) . "</small><br>";
        echo "<a href='perfil_publico.php?id=" . $user['id'] . "' target='_blank'>Ver Currículo</a>";
        echo "</li>";
    }
} else {
    echo "<li>Nenhum profissional inscrito nesta vaga ainda.</li>";
}

$stmt->close();
$conn->close();