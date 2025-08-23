<?php 
session_start();

// 1. Validação de Sessão e Input
if (!isset($_SESSION["user_id"])) {
    header("Location: ../login.php");
    exit;
}

if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
    // Redireciona com erro se o ID for inválido ou não existir
    header("Location: home.php?download_status=invalid_id");
    exit;
}

$curriculumUserId = (int)$_GET["id"];

// 2. Conexão com o Banco de Dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jobs";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    // Em produção, logue o erro em vez de mostrá-lo
    error_log("DB Connection Error: " . $conn->connect_error);
    header("Location: home.php?download_status=db_error");
    exit;
}

// 3. Busca Segura do Nome do Arquivo
// Usando prepared statements para prevenir SQL Injection
$sql = "SELECT curriculo FROM cadastro WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $curriculumUserId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $curriculumFilename = $row["curriculo"];

    // 4. Validação do Arquivo e Download
    if (!empty($curriculumFilename)) {
        $filePath = __DIR__ . "/uploads/" . $curriculumFilename;

        // Verifica se o arquivo realmente existe no servidor
        if (file_exists($filePath)) {
            // Limpa qualquer output que possa ter sido iniciado
            ob_clean(); 
            flush();

            // Define os headers para o download
            header("Content-Type: application/octet-stream");
            header("Content-Disposition: attachment; filename=\"" . basename($filePath) . "\"");
            header("Content-Length: " . filesize($filePath));
            header("Cache-Control: must-revalidate");
            header("Pragma: public");

            // Lê o arquivo e envia para o output
            readfile($filePath);
            
            // Encerra o script para garantir que nada mais seja enviado
            exit;
        } else {
            // Arquivo não encontrado no servidor
            header("Location: home.php?download_status=file_not_found");
        }
    } else {
        // Usuário não tem currículo cadastrado no banco
        header("Location: home.php?download_status=no_cv");
    }
} else {
    // Usuário com o ID fornecido não foi encontrado
    header("Location: home.php?download_status=user_not_found");
}

$stmt->close();
$conn->close();
exit;
?>