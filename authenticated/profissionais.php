<?php 
session_start();

// Use a conexão centralizada com o banco de dados
require_once __DIR__ . '/db_connection.php';

// Verifica se o usuário está logado
if (!isset($_SESSION["user_id"])) {
  header("Location: ../login.php");
  exit;
}
$userId = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <link rel="icon" type="image/png" href="../imagens/Logo.svg"/>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/home.css">
    <link rel="stylesheet" href="../css/profissionais.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <title>Profissionais</title>
</head>
<body>
    <?php 
    // Inclui o cabeçalho reutilizável
    require_once __DIR__ . '/templates/header.php';
    ?>

    <div class="page-title">
        <h1>Encontre Profissionais</h1>
        <p>Busque por profissionais qualificados na região do Cariri.</p>
    </div>

    <form method="get" action="profissionais.php" class="search-form">
        <input type="text" name="nome" placeholder="Buscar por nome..." value="<?php echo htmlspecialchars($_GET['nome'] ?? ''); ?>">
        <input type="text" name="profissao" placeholder="Buscar por profissão..." value="<?php echo htmlspecialchars($_GET['profissao'] ?? ''); ?>">
        <button type="submit">Buscar</button>
    </form>

    <main class="professionals-container">
    <?php
    // Lógica de busca segura no banco de dados
    $sql = "SELECT c.id, c.nome, c.sobrenome, c.foto, p.nome_profissao 
            FROM cadastro c 
            LEFT JOIN profissao p ON c.id_profissao = p.id 
            WHERE c.id != ?";

    $params = [$userId];
    $types = "i";

    $search_nome = $_GET['nome'] ?? '';
    $search_profissao = $_GET['profissao'] ?? '';

    if (!empty($search_nome)) {
        $sql .= " AND (c.nome LIKE ? OR c.sobrenome LIKE ?)";
        $searchTerm = "%" . $search_nome . "%";
        array_push($params, $searchTerm, $searchTerm);
        $types .= "ss";
    }

    if (!empty($search_profissao)) {
        $sql .= " AND p.nome_profissao LIKE ?";
        $searchTermProf = "%" . $search_profissao . "%";
        $params[] = $searchTermProf;
        $types .= "s";
    }

    $stmt = $conn->prepare($sql);
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        while ($professional = $result->fetch_assoc()) {
            echo "<div class='professional-card'>";
            
            $foto = !empty($professional['foto']) ? '../uploads/' . htmlspecialchars($professional['foto']) : 'https://placehold.co/100x100';
            echo "<img src='{$foto}' alt='Foto de " . htmlspecialchars($professional['nome']) . "' class='professional-photo'>";
            
            echo "<div class='professional-info'>";
            echo "<h3>" . htmlspecialchars($professional['nome'] . ' ' . $professional['sobrenome']) . "</h3>";
            
            $profissao = !empty($professional['nome_profissao']) ? htmlspecialchars($professional['nome_profissao']) : 'Profissão não informada';
            echo "<p>{$profissao}</p>";
            echo "</div>";

            echo "<div class='professional-actions'>";
            // Este link assume que você tem uma página de perfil público
            echo "<a href='perfil_publico.php?id=" . $professional['id'] . "' class='btn-action'>Ver Perfil</a>";
            // Link para baixar o currículo
            echo "<a href='baixar_curriculo.php?id=" . $professional['id'] . "' class='btn-action'>Baixar CV</a>";
            echo "</div>";

            echo "</div>";
        }
    } else {
        echo "<p class='not-found'>Nenhum profissional encontrado com os critérios de busca.</p>";
    }
    
    $stmt->close();
    $conn->close();
    ?>
    </main>

</body>
</html>