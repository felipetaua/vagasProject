<?php
function deleteVaga($vagaId) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "jobs";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    // Verificar se existem inscritos relacionados à vaga
    $checkInscricoes = "SELECT COUNT(*) as total FROM inscricoes WHERE id_vaga = $vagaId";
    $result = $conn->query($checkInscricoes);
    $row = $result->fetch_assoc();
    $totalInscricoes = $row['total'];

    if ($totalInscricoes >= 0) {
        // Remover as inscrições relacionadas à vaga
        $deleteInscricoes = "DELETE FROM inscricoes WHERE id_vaga = $vagaId";
        $conn->query($deleteInscricoes);
    }

    // Excluir a vaga
    $deleteVaga = "DELETE FROM vagas WHERE id = $vagaId";
    if ($conn->query($deleteVaga) === TRUE) {
        echo "Vaga excluída com sucesso.";
        header("location:vagasCriadas.php");
        
    } else {
        echo "Erro ao excluir a vaga: " . $conn->error;
    }

    $conn->close();
    exit; // Terminar a execução do script PHP após a exclusão
}




if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["vagaId"])) {
        $vagaId = $_POST["vagaId"];
        deleteVaga($vagaId);
        
    } else {
        echo "ID da vaga não fornecido.";
    }
}
?>





