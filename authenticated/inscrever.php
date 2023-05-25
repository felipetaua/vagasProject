<?php

// Verifica se o usuário está logado
session_start();
if (!isset($_SESSION['user_id'])) {
  // Redireciona para a página de login
  header("Location: login.php");
  exit;
}

// Conecta ao banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jobs";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
  die("Conexão falhou: " . mysqli_connect_error());
}

// Insere a inscrição na tabela
$user_id = $_SESSION['user_id'];
$vaga_id = $_GET['vaga'];


// Insere a inscrição na tabela
$user_id = $_SESSION['user_id'];
$vaga_id = $_GET['vaga'];

// Verifica se o usuário já está inscrito na vaga
$sql_verifica = "SELECT id FROM inscricoes WHERE nome_usuario = '$user_id' AND id_vaga = '$vaga_id'";
$result_verifica = mysqli_query($conn, $sql_verifica);

if (mysqli_num_rows($result_verifica) > 0) {
// Usuário já está inscrito na vaga
echo "Usuário já está inscrito nesta vaga.";
} else {
// Insere a inscrição na tabela
$sql = "INSERT INTO inscricoes (nome_usuario, id_vaga) VALUES ('$user_id', '$vaga_id')";

if (mysqli_query($conn, $sql)) {
echo "Inscrição realizada com sucesso!";
header("location:ultimasVagas.php");
} else {
echo "Erro ao realizar inscrição: " . mysqli_error($conn);
}
}

mysqli_close($conn);

