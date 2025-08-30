<?php
// Inicia a sessão para gerenciar mensagens e login
session_start();

// Inclui seu arquivo de conexão que cria a variável $pdo
require_once 'config/db.php';

// Verifica se o formulário foi enviado (método POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 1. Coleta e limpa os dados do formulário (sem alterações aqui)
    $nome = trim($_POST['nome']);
    $sobrenome = trim($_POST['sobrenome']);
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];
    $confirmaSenha = $_POST['confirmaSenha'];
    $cpf = trim($_POST['cpf']);
    $dtNascimento = $_POST['dtNascimento'];
    $celular = trim($_POST['celular']);
    $tipo_usuario = $_POST['tipo_usuario'];
    $erros = []; 

    if (empty($nome) || empty($sobrenome) || empty($email) || empty($senha) || empty($cpf) || empty($dtNascimento) || empty($celular)) {
        $erros[] = "Todos os campos são obrigatórios.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erros[] = "Formato de e-mail inválido.";
    }
    if (strlen($senha) < 8) {
        $erros[] = "A senha deve ter no mínimo 8 caracteres.";
    }
    if ($senha !== $confirmaSenha) {
        $erros[] = "As senhas não coincidem.";
    }
    if ($tipo_usuario !== 'colaborador' && $tipo_usuario !== 'empresa') {
        $erros[] = "Tipo de usuário inválido.";
    }

    if (empty($erros)) {
        try {
            $sql = "SELECT id FROM cadastro WHERE email = :email";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['email' => $email]);
            if ($stmt->fetch()) { // fetch() retorna um registro se encontrar, ou false se não
                $erros[] = "Este e-mail já está cadastrado.";
            }

            $sql = "SELECT id FROM cadastro WHERE cpf = :cpf";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['cpf' => $cpf]);
            if ($stmt->fetch()) {
                $erros[] = "Este CPF já está cadastrado.";
            }
        } catch (PDOException $e) {
            $erros[] = "Erro ao consultar o banco de dados: " . $e->getMessage();
        }
    }

    if (empty($erros)) {
        
        // CRIPTOGRAFA A SENHA
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        // Prepara o comando SQL com "named placeholders" (ex: :nome)
        $sql = "INSERT INTO cadastro (nome, sobrenome, email, senha, cpf, dtNascimento, celular, tipo_usuario) 
                VALUES (:nome, :sobrenome, :email, :senha, :cpf, :dtNascimento, :celular, :tipo_usuario)";
        
        try {
            $stmt = $pdo->prepare($sql);

            // Executa a query passando um array associativo com os valores
            $stmt->execute([
                'nome' => $nome,
                'sobrenome' => $sobrenome,
                'email' => $email,
                'senha' => $senha_hash,
                'cpf' => $cpf,
                'dtNascimento' => $dtNascimento,
                'celular' => $celular,
                'tipo_usuario' => $tipo_usuario
            ]);

            $_SESSION['mensagem_sucesso'] = "Cadastro realizado com sucesso! Faça o login.";
            header("Location: login.php"); // Altere para sua página de login
            exit();

        } catch (PDOException $e) {
            $erros[] = "Ocorreu um erro ao salvar seu cadastro: " . $e->getMessage();
        }
    }

    if (!empty($erros)) {
        echo "<h1>Erro no Cadastro</h1>";
        echo "<ul>";
        foreach ($erros as $erro) {
            echo "<li>" . htmlspecialchars($erro) . "</li>";
        }
        echo "</ul>";
        echo '<a href="cadastro.php">Voltar para o formulário</a>';
    }

} else {
    header("Location: cadastro.php");
    exit();
}
?>