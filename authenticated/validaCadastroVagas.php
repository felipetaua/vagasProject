
<!DOCTYPE html>
<html lang="en">
<head> 
    <link rel="icon" type="image/png" href="..\imagens\Logo.svg"/>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Document</title>
</head>
<body>
<div id="sucesso" style="display: none;">
    <h2>Vaga cadastrada com sucesso!</h2>
    <h2>Jobs in Cariri agradece a confiança!</h2>
</div>

</body>
</html>
<style>
    #sucesso {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: #033F63;
    z-index: 9999;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
}

#sucesso h2 {
    font-family:Roboto;
    color: white;
    font-size: 3rem;
    text-align: center;
}

</style>

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
$idUsuario = $_SESSION["user_id"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $empresa = $_POST['empresa'];
    $cargo = $_POST['cargo'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $requisitos = $_POST['requisitos'];
    $beneficios = $_POST['beneficios'];

    $sql = "INSERT INTO vagas (empresa, cargo, telefone, email, requisitos, beneficios, usuario_responsavel) VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Falha na preparação da declaração: " . $conn->error);
    }

    $stmt->bind_param("ssssssi", $empresa, $cargo, $telefone, $email, $requisitos, $beneficios, $idUsuario);

   
    if ($stmt->execute()) {

       echo "<script>
    $('#sucesso').fadeIn('fast');
    setTimeout(function() {
        $('#sucesso').fadeOut('slow', function() {
            window.location.href = 'home.php';
        });
    }, 3000);
</script>";

    } else {
        echo "Erro ao cadastrar a vaga: " . $stmt->error;
    }

    
    $stmt->close();
}

$conn->close();
?>
