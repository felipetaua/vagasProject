<?php 
session_start();

// 1. Validação de Sessão e Parâmetros
// ===================================

if (!isset($_SESSION["user_id"])) {
    // Se não estiver logado, não há o que fazer.
    http_response_code(403); // Forbidden
    exit("Acesso negado.");
}

if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
    // Redireciona para a home com um erro se o ID for inválido ou não existir
    header("Location: home.php?download_status=invalid_id");
    exit;
}

$curriculumUserId = (int)$_GET["id"];

// NOTA DE SEGURANÇA: Aqui você poderia adicionar uma lógica para verificar
// se o usuário logado ($_SESSION['user_id']) tem permissão para baixar
// o currículo do usuário solicitado ($curriculumUserId).

// 2. Conexão e Busca no Banco de Dados
// ====================================
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jobs";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    // Em produção, logue o erro em vez de mostrá-lo.
    error_log("DB Connection Error: " . $conn->connect_error);
    header("Location: home.php?download_status=db_error");
    exit;
}

// Busca o nome do arquivo do currículo de forma segura
$sql = "SELECT curriculo FROM cadastro WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $curriculumUserId);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();
$conn->close();

// 3. Validação do Arquivo e Início do Download
// ============================================

// Verifica se o usuário foi encontrado e se tem um currículo cadastrado
if (!$user || empty($user['curriculo'])) {
    header("Location: home.php?download_status=no_cv_found");
    exit;
}

$filename = $user['curriculo'];
$filepath = __DIR__ . '/uploads/' . $filename;

// Verifica se o arquivo realmente existe no servidor
if (!file_exists($filepath)) {
    header("Location: home.php?download_status=file_not_found");
    exit;
}

// 4. Envio dos Headers e do Arquivo
// =================================
if (ob_get_level()) ob_end_clean();
header('Content-Description: File Transfer');
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="' . basename($filename) . '"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($filepath));
readfile($filepath);
exit;
