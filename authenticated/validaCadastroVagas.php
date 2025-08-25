<?php
session_start();
require_once __DIR__ . '/db_connection.php';

// Verifica se o usuário está logado
if (!isset($_SESSION["user_id"])) {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coleta e sanitiza os dados do formulário
    $empresa = trim($_POST['empresa']);
    $descricao_empresa = trim($_POST['descricao_empresa']);
    $telefone_empresa = trim($_POST['telefone_empresa']);
    $email_empresa = filter_var(trim($_POST['email_empresa']), FILTER_SANITIZE_EMAIL);
    $localizacao = trim($_POST['localizacao']);
    $cargo = trim($_POST['cargo']);
    $descricao = trim($_POST['descricao']);
    $carga_horaria = trim($_POST['carga_horaria']);
    $salario = filter_var($_POST['salario'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $beneficios = trim($_POST['beneficios']);
    $requisitos = trim($_POST['requisitos']);
    $usuario_responsavel = $_SESSION['user_id'];

    // Validação básica
    if (empty($empresa) || empty($cargo) || empty($descricao) || empty($salario) || empty($localizacao)) {
        $_SESSION['error_message'] = "Por favor, preencha todos os campos obrigatórios.";
        header("Location: cadastroVagas.php");
        exit();
    }

    // Prepara a query de inserção
    $sql = "INSERT INTO vagas (empresa, descricao_empresa, telefone_empresa, email_empresa, localizacao, cargo, descricao, carga_horaria, salario, beneficios, requisitos, usuario_responsavel) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Erro ao preparar a query: " . $conn->error);
    }

    // 's' para string, 'd' para double/decimal, 'i' para integer
    $stmt->bind_param("ssssssssdssi", $empresa, $descricao_empresa, $telefone_empresa, $email_empresa, $localizacao, $cargo, $descricao, $carga_horaria, $salario, $beneficios, $requisitos, $usuario_responsavel);

    if ($stmt->execute()) {
        $newVagaId = $conn->insert_id;
        $_SESSION['success_message'] = "Vaga cadastrada com sucesso!";
        header("Location: visualizar_vaga.php?id=" . $newVagaId);
    } else {
        $_SESSION['error_message'] = "Erro ao cadastrar a vaga: " . $stmt->error;
        header("Location: cadastroVagas.php");
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: cadastroVagas.php");
    exit();
}
?>