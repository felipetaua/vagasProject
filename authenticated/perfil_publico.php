<?php 
session_start();

// Use a conexão centralizada com o banco de dados
require_once __DIR__ . '/db_connection.php';

// Verifica se o usuário que está visualizando está logado
if (!isset($_SESSION["user_id"])) {
  header("Location: ../login.php");
  exit;
}

// Valida o ID do perfil a ser visualizado
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    // Redireciona ou mostra um erro se o ID for inválido
    header("Location: profissionais.php?error=invalid_id");
    exit;
}
$profileId = (int)$_GET['id'];

// Busca os dados do perfil público de forma segura
$sql = "SELECT c.id, c.nome, c.sobrenome, c.email, c.cidade, c.foto, c.curriculo, p.nome AS nome_profissao 
        FROM cadastro c 
        LEFT JOIN profissao p ON c.id_profissao = p.id 
        WHERE c.id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $profileId);
$stmt->execute();
$result = $stmt->get_result();
$profileUser = $result->fetch_assoc();

// Se nenhum usuário for encontrado com esse ID, redireciona
if (!$profileUser) {
    header("Location: profissionais.php?error=not_found");
    exit;
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <link rel="icon" type="image/png" href="/sistemaDeVagas/imagens/Logo.svg"/>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/sistemaDeVagas/css/home.css">
    <link rel="stylesheet" href="/sistemaDeVagas/css/perfil_publico.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <title>Perfil de <?php echo htmlspecialchars($profileUser['nome']); ?></title>
</head>
<body>
    <?php 
    // Inclui o cabeçalho reutilizável
    require_once __DIR__ . '/templates/header.php';
    ?>

    <main class="profile-container">
        <div class="profile-card">
            <div class="profile-header">
                <?php 
                $foto = !empty($profileUser['foto']) ? '/sistemaDeVagas/authenticated/uploads/' . htmlspecialchars($profileUser['foto']) : 'https://placehold.co/150x150';
                ?>
                <img src="<?php echo $foto; ?>" alt="Foto de <?php echo htmlspecialchars($profileUser['nome']); ?>" class="profile-photo">
                <h2><?php echo htmlspecialchars($profileUser['nome'] . ' ' . $profileUser['sobrenome']); ?></h2>
                <p class="profession"><?php echo !empty($profileUser['nome_profissao']) ? htmlspecialchars($profileUser['nome_profissao']) : 'Profissão não informada'; ?></p>
            </div>
            <div class="profile-details">
                <h3>Informações de Contato</h3>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($profileUser['email']); ?></p>
                <p><strong>Cidade:</strong> <?php echo !empty($profileUser['cidade']) ? htmlspecialchars($profileUser['cidade']) : 'Não informada'; ?></p>
            </div>
            <div class="profile-actions">
                <?php if (!empty($profileUser['curriculo'])): ?>
                    <a href="baixar_curriculo.php?id=<?php echo $profileUser['id']; ?>" class="btn-action download-cv">Baixar Currículo</a>
                <?php else: ?>
                    <p class="no-cv">Este profissional ainda não enviou um currículo.</p>
                <?php endif; ?>
            </div>
        </div>
    </main>

</body>
</html>
<?php
$stmt->close();
$conn->close();
?>