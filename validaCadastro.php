<?php

// 1. Configuração e Conexão
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jobs";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");

$status = 'error';
$message = 'Ocorreu um erro desconhecido.';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $userType = $_POST['userType'] ?? null;
    $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
    $raw_password = $_POST['password'] ?? '';
    $celular = $_POST['celular'] ?? null;

    // Campos de endereço
    $cep = $_POST['zipcode'] ?? null;
    $rua = $_POST['streetName'] ?? null;
    $numero = $_POST['streetNumber'] ?? null;
    $bairro = $_POST['district'] ?? null;
    $cidade = $_POST['city'] ?? null;
    $estado = $_POST['state'] ?? null;

    // Validação básica
    if (empty($userType) || empty($email) || empty($raw_password)) {
        $message = "Por favor, preencha todos os campos obrigatórios.";
    } else {
        // Verifica se o e-mail já existe na tabela 'usuarios'
        $sql_check_email = "SELECT id FROM usuarios WHERE email = ?";
        $stmt_check = $conn->prepare($sql_check_email);
        $stmt_check->bind_param("s", $email);
        $stmt_check->execute();
        $result = $stmt_check->get_result();

        if ($result->num_rows > 0) {
            $status = 'exists';
            $message = "E-mail já cadastrado!";
        } else {
            $conn->begin_transaction();

            try {
                $hashed_password = password_hash($raw_password, PASSWORD_DEFAULT);

                $sql_endereco = "INSERT INTO enderecos (cep, rua, numero, bairro, cidade, estado) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt_endereco = $conn->prepare($sql_endereco);
                $stmt_endereco->bind_param("ssssss", $cep, $rua, $numero, $bairro, $cidade, $estado);
                $stmt_endereco->execute();
                $id_endereco = $conn->insert_id;

                $sql_usuario = "INSERT INTO usuarios (email, senha, celular, tipo_usuario) VALUES (?, ?, ?, ?)";
                $stmt_usuario = $conn->prepare($sql_usuario);
                $stmt_usuario->bind_param("ssss", $email, $hashed_password, $celular, $userType);
                $stmt_usuario->execute();
                $id_usuario = $conn->insert_id;

                if ($userType === 'candidate') {
                    $nome_completo = $_POST['name'] ?? null;
                    $cpf = $_POST['cpf'] ?? null;
                    
                    $sql_candidato = "INSERT INTO candidatos (id_usuario, id_endereco, nome_completo, cpf) VALUES (?, ?, ?, ?)";
                    $stmt_candidato = $conn->prepare($sql_candidato);
                    $stmt_candidato->bind_param("iiss", $id_usuario, $id_endereco, $nome_completo, $cpf);
                    $stmt_candidato->execute();

                } elseif ($userType === 'company') {
                    $razao_social = $_POST['razao_social'] ?? null;
                    $cnpj = $_POST['cnpj'] ?? null;

                    $sql_empresa = "INSERT INTO empresas (id_usuario, id_endereco, razao_social, cnpj) VALUES (?, ?, ?, ?)";
                    $stmt_empresa = $conn->prepare($sql_empresa);
                    $stmt_empresa->bind_param("iiss", $id_usuario, $id_endereco, $razao_social, $cnpj);
                    $stmt_empresa->execute();
                }

                $conn->commit();
                $status = 'success';
                $message = "Cadastro realizado com sucesso!";

            } catch (mysqli_sql_exception $exception) {
                $conn->rollback();
                $message = "Erro ao cadastrar: Ocorreu um problema ao salvar seus dados.";
            }
        }
        $stmt_check->close();
    }
} else {
    $message = "Método de requisição inválido.";
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Status do Cadastro</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body { background: black; color: white; font-family: 'Roboto', sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .container { text-align: center; }
        .message { font-size: 30px; font-weight: 600; margin-bottom: 40px; }
        .success { color: #00A6ED; }
        .error { color: #e74c3c; }
        .exists { color: #f39c12; }
        .btn { background: white; height: 40px; width: 150px; color: black; border: none; border-radius: 10px; text-align: center; font-weight: 600; cursor: pointer; text-decoration: none; padding: 10px 20px; }
        .loader { border: 16px solid #f3f3f3; border-top: 16px solid #3498db; border-radius: 50%; width: 120px; height: 120px; animation: spin 2s linear infinite; margin: 20px auto; }
        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
        .redirect-text { font-size: 24px; color: #00A6ED; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <?php if ($status === 'success'): ?>
            <div class="message success"><?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?></div>
            <div class="loader"></div>
            <div class="redirect-text">Você será redirecionado para a tela de login.</div>
            <script>setTimeout(function(){ window.location.href = 'login.php'; }, 3000);</script>
        <?php elseif ($status === 'exists'): ?>
            <div class="message exists"><?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?></div>
            <button class="btn" onclick="window.history.back()">Voltar</button>
        <?php else: ?>
            <div class="message error"><?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?></div>
            <button class="btn" onclick="window.history.back()">Tentar Novamente</button>
        <?php endif; ?>
    </div>
</body>
</html>
