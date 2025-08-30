<?php
session_start();

require_once 'config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email = trim($_POST['email'] ?? '');
    $senha_digitada = $_POST['senha'] ?? '';

    if (empty($email) || empty($senha_digitada)) {
        header("Location: login.php?error=emptyfields");
        exit();
    }

    try {
        $sql = "SELECT id, nome, email, senha, tipo_usuario FROM cadastro WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['email' => $email]);
        
        // Busca o usuário
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($senha_digitada, $user['senha'])) {
            // Regenera o ID da sessão para previnir ataques de session fixation
            session_regenerate_id(true);

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_nome'] = $user['nome']; 
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_type'] = $user['tipo_usuario'];
            header("Location: authenticated/home.php");
            exit();

        } else {
            // Se o usuário não existe ou a senha está errada
            header("Location: login.php?error=wrongcredentials");
            exit();
        }

    } catch (PDOException $e) {
        header("Location: login.php?error=dberror");
        exit();
    }
}

header("Location: login.php");
exit();
?>