<?php
// This header template assumes that a session has been started
// and a database connection ($conn) is available.

if (!isset($_SESSION["user_id"])) {
    // This is a fallback, the main page should handle this first.
    header("Location: ../login.php");
    exit;
}
$headerUserId = $_SESSION['user_id'];

// Fetch user data for the header
$headerStmt = $conn->prepare("SELECT nome, foto FROM `cadastro` WHERE id = ?");
$headerStmt->bind_param("i", $headerUserId);
$headerStmt->execute();
$headerResult = $headerStmt->get_result();
$headerUser = $headerResult->fetch_assoc();
$headerStmt->close();
?>
<!-- Adicione este link no <head> da sua página principal (ex: ultimasVagas.php): -->
<link rel="stylesheet" href="/sistemaDeVagas/css/header.css">
<header class="main-header">
    <ul>
        <a href='/sistemaDeVagas/authenticated/home.php'> <li>
            <img src='..\imagens\Logo.svg' alt=''class='logo'> Conexão RH 2.0
        </li></a> 
        <a href='/sistemaDeVagas/authenticated/profissionais.php'><li>Profissionais</li></a>
        <a href='/sistemaDeVagas/authenticated/cadastroVagas.php'><li>Cadastrar vaga</li></a>
        <a href='/sistemaDeVagas/authenticated/ultimasVagas.php'><li>Últimas vagas</li></a>
        <a href='/sistemaDeVagas/authenticated/vagasCriadas.php'><li>Minhas vagas</li></a>
        <div class='dropdown'> 
            <div class='perfil-img'>
                <div>
                    <?php if ($headerUser && !empty($headerUser['foto'])): ?>
                        <img src='/sistemaDeVagas/uploads/<?php echo htmlspecialchars($headerUser['foto']); ?>' class="perfil-foto" alt="Foto de perfil">
                    <?php else: ?>
                        <img src='https://placehold.co/50x50' class="perfil-foto" alt="Foto de perfil padrão">
                    <?php endif; ?>
                </div>    
                <li class='dropdown-btn'><?php echo $headerUser ? htmlspecialchars($headerUser['nome']) : 'Usuário'; ?></li>
                <svg xmlns='http://www.w3.org/2000/svg' style='width:10px; color:green;' viewBox='0 0 320 512'><path d='M137.4 374.6c12.5 12.5 32.8 12.5 45.3 0l128-128c9.2-9.2 11.9-22.9 6.9-34.9s-16.6-19.8-29.6-19.8L32 192c-12.9 0-24.6 7.8-29.6 19.8s-2.2 25.7 6.9 34.9l128 128z'/ ></svg>
            </div>
            <ul class='dropdown-menu'>
                <a href='/sistemaDeVagas/authenticated/perfil.php'><li>Editar perfil</li></a>
                <a href='/sistemaDeVagas/authenticated/ranking.php'> <li>Ranking</li></a>
                <a href='/sistemaDeVagas/authenticated/profissao.php'> <li>Profissão</li></a>
                <a href='/sistemaDeVagas/authenticated/contratos.php'><li>Contratos</li></a>
                <a href='#'> <li>Chat</li></a>
                <a href='/sistemaDeVagas/authenticated/curriculo.php'> <li>Currículo</li></a>
                <a href='/sistemaDeVagas/authenticated/logout.php'><li>Sair</li></a>
            </ul>
        </div>
    </ul>
</header>
