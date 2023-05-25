<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  // Redireciona para a página de login
  header("Location: login.php");
  exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jobs";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

if (isset($_GET['vagaId'])) {
    $vagaId = $_GET['vagaId'];

    $sql = "SELECT * FROM `inscricoes` i
    LEFT JOIN cadastro c
    ON
    i.nome_usuario = c.id
    WHERE id_vaga = $vagaId";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $curriculo = 'uploads/' . $row["curriculo"];  // Caminho relativo à pasta "uploads"
            $curriculoNome = $row["nome"];
            if (!empty($curriculo) && file_exists($curriculo)) {
                echo "<div class='userVaga'>";
                echo "<p>Nome:".$row['nome']."</p>";
                echo"<p>Email: ".$row['email']."</p>";
                echo '<a href="' . $curriculo . '" download>' .'Baixar currículo' . '</a></div>';
                

            } else {
                echo '<li>Arquivo de currículo não encontrado.</li>';
            }
        }
    } else {
        echo "Nenhum candidato a esta vaga.";
    }
} else {
    echo "Nenhum candidato a esta vaga.";
}

$conn->close();
