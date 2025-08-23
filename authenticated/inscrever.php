<?php
session_start();

// 1. Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
  // Redireciona para a página de login (caminho corrigido)
  header("Location: ../login.php");
  exit;
}

// 2. Valida a entrada: verifica se o ID da vaga foi passado e se é um número
if (!isset($_GET['vaga']) || !is_numeric($_GET['vaga'])) {
    header("Location: ultimasVagas.php?error=invalid_vaga");
    exit;
}

// 3. Conecta ao banco de dados de forma segura
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jobs";

// Usando o estilo orientado a objetos, que é mais limpo
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  // Em um ambiente de produção, você deveria logar este erro em vez de mostrá-lo.
  die("Conexão falhou: " . $conn->connect_error);
}

// 4. Pega as variáveis de forma segura
$userId = (int)$_SESSION['user_id'];
$vagaId = (int)$_GET['vaga'];

// 5. Verifica se o usuário já está inscrito na vaga usando PREPARED STATEMENTS
$sql_verifica = "SELECT id FROM inscricoes WHERE id_usuario = ? AND id_vaga = ?";
$stmt = $conn->prepare($sql_verifica);
$stmt->bind_param("ii", $userId, $vagaId); // "ii" para dois inteiros
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    // Usuário já está inscrito, redireciona com uma mensagem de status
    $stmt->close();
    $conn->close();
    header("Location: ultimasVagas.php?status=already_registered");
    exit;
}
$stmt->close();

// 6. Insere a nova inscrição usando PREPARED STATEMENTS
$sql_insert = "INSERT INTO inscricoes (id_usuario, id_vaga) VALUES (?, ?)";
$stmt = $conn->prepare($sql_insert);
$stmt->bind_param("ii", $userId, $vagaId);

if ($stmt->execute()) {
    // Sucesso, redireciona com uma mensagem de sucesso
    header("Location: ultimasVagas.php?status=success");
} else {
    // Erro, redireciona com uma mensagem de erro
    header("Location: ultimasVagas.php?error=db_error");
}

$stmt->close();
$conn->close();
exit;
