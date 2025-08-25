<?php
session_start();
require_once __DIR__ . '/db_connection.php';

// Check if user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: /sistemaDeVagas/login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and retrieve form data
    $cargo = trim($_POST['cargo']);
    $empresa = trim($_POST['empresa']);
    $descricao = trim($_POST['descricao']);
    $requisitos = trim($_POST['requisitos']);
    $salario = filter_var($_POST['salario'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $localizacao = trim($_POST['localizacao']);
    $tipo_contrato = trim($_POST['tipo_contrato']);
    // The 'beneficios' field from the form is now ignored by the INSERT statement.
    // $beneficios = trim($_POST['beneficios']);

    // Basic validation
    if (empty($cargo) || empty($empresa) || empty($descricao) || empty($requisitos) || empty($salario) || empty($localizacao) || empty($tipo_contrato)) {
        $_SESSION['error_message'] = "Todos os campos obrigatórios devem ser preenchidos.";
        header("Location: cadastroVagas.php");
        exit();
    }

    // Prepare an insert statement. The 'beneficios' column has been removed.
    // This was line 79, which caused the error.
    $stmt = $conn->prepare("INSERT INTO vagas (cargo, empresa, descricao, requisitos, salario, localizacao, tipo_contrato) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssdss", $cargo, $empresa, $descricao, $requisitos, $salario, $localizacao, $tipo_contrato);

    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Vaga cadastrada com sucesso!";
        header("Location: home.php");
    } else {
        $_SESSION['error_message'] = "Erro ao cadastrar a vaga: " . $conn->error;
        header("Location: cadastroVagas.php");
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: cadastroVagas.php");
    exit();
}
?>
