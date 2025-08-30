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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email = trim($_POST['email'] ?? '');
    $senha_digitada = $_POST['senha'] ?? '';

    if (empty($email) || empty($senha_digitada)) {
        header("Location: pages/login/login.php?error=emptyfields");
        exit();
    }

    $sql = "SELECT id, email, senha, tipo_usuario FROM cadastro WHERE email = ?";
    
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        error_log("Falha na preparação da declaração: " . $conn->error);
        header("Location: pages/login/login.php?error=dberror");
        exit();
    }

    $stmt->bind_param("s", $email);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            
            if (password_verify($senha_digitada, $user['senha'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_type'] = $user['tipo_usuario']; 

                if ($user['tipo_usuario'] === 'company') {
                    header("Location: autenthenticated/home.php"); 
                } else {
                    header("Location: autenthenticated/home.php"); 
                }
                exit();
            }
        }
    } else {
        error_log("Erro ao executar a consulta: " . $stmt->error);
        header("Location: /sistemaDeVagas/login.php?error=dberror");
        exit();
    }

    header("Location: /sistemaDeVagas/login.php?error=wrongcredentials");
    exit();

    $stmt->close();
}

$conn->close();
?>
