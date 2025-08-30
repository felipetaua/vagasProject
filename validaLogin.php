<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jobs";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email = $_POST['email'] ?? '';
    $password_from_form = $_POST['password'] ?? ''; 

    if (empty($email) || empty($password_from_form)) {
        // Redireciona de volta para a página de login com uma mensagem de erro
        header("Location: login.php?error=emptyfields");
        exit();
    }

    $sql = "SELECT id, email, senha, tipo_usuario FROM usuarios WHERE email = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        // Erro na preparação da query
        header("Location: login.php?error=sqlerror");
        exit();
    }
    
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password_from_form, $user['senha'])) {
            
            session_regenerate_id(); 
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_type'] = $user['tipo_usuario'];

            header("Location: /authenticated/home.php"); 
            exit();
        }
    }
    
    header("Location: login.php?error=wrongcredentials");
    exit();

    $stmt->close();
} else {
    header("Location: login.php");
    exit();
}

$conn->close();

