<?php 
session_start();
// Dados de conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jobs";

// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Verifica se o usuário está logado
if (!isset($_SESSION["user_id"])) {
  header("Location: ..\login.php");
  exit;
}
$userId = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <link rel="icon" type="image/png" href="..\imagens\Logo.svg"/>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="..\css\ultimasVagas.css">
    <link rel="stylesheet" href="../css/home.css">
    <script src="..\js\modal.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <title>Vagas</title>
</head>
<body>
    <?php 
    // Busca os dados do usuário para o cabeçalho
    $stmt = $conn->prepare("SELECT nome, foto FROM `cadastro` WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $resultUser = $stmt->get_result();
    $user = $resultUser->fetch_assoc();
    ?>
    <header style='background:white; margin-top:-10px; padding:5px;'>
        <ul>
            <a href='../authenticated/home.php'> <li>
                <img src='..\imagens\Logo.svg' alt='Logo Jobs In Cariri' class='logo'> JOBS IN CARIRI
            </li></a> 
            <a href='../authenticated/profissionais.php'><li>Profissionais</li></a>
            <a href='../authenticated/cadastroVagas.php'><li>Cadastrar vaga</li></a>
            <a href='../authenticated/ultimasVagas.php'><li>Últimas vagas</li></a>
            <a href='../authenticated/vagasCriadas.php'><li>Minhas vagas</li></a>
            <div class='dropdown'> 
                <div class='perfil-img' style='display:flex; align-items:center; justify-content:center;'>
                    <div style='display:flex; flex-direction:column; align-items:center;'>
                        <?php if (!empty($user['foto'])): ?>
                            <img src='uploads/<?php echo htmlspecialchars($user['foto']); ?>' style='width:50px; height:50px; border-radius:100%;'>
                        <?php endif; ?>
                    </div>    
                    <li class='dropdown-btn'><?php echo htmlspecialchars($user['nome']); ?></li>
                    <svg xmlns='http://www.w3.org/2000/svg' style='width:10px; color:green;' viewBox='0 0 320 512'><path d='M137.4 374.6c12.5 12.5 32.8 12.5 45.3 0l128-128c9.2-9.2 11.9-22.9 6.9-34.9s-16.6-19.8-29.6-19.8L32 192c-12.9 0-24.6 7.8-29.6 19.8s-2.2 25.7 6.9 34.9l128 128z'/ ></svg>
                </div>
                <ul class='dropdown-menu'>
                    <a href='perfil.php'><li>Editar perfil</li></a>
                    <a href='#'> <li>Ranking</li></a>
                    <a href='../authenticated/profissao.php'> <li>Profissão</li></a>
                    <a href='#'><li>Contratos</li></a>
                    <a href='#'> <li>Chat</li></a>
                    <a href='curriculo.php'> <li>Currículo</li></a>
                    <a href='./logout.php'><li>Sair</li></a>
                </ul>
            </div>
        </ul>
    </header>

    <h1>Jobs in Cariri</h1>
    <p>Vagas</p>
    <form method="get" action="">
        <input type="text" placeholder="Digite a vaga que busca..." name='vagas'>
        <input type="submit" value="Buscar" name='buscar'>
    </form>
    <main class="container">
    <?php
    // --- LÓGICA REATORADA PARA BUSCA DE VAGAS ---
    
    $params = [];
    $types = "";
    
    $sql = "SELECT v.id, v.empresa, v.cargo, 
                   (SELECT COUNT(*) FROM inscricoes i WHERE i.id_vaga = v.id) as total_inscritos,
                   (SELECT COUNT(*) FROM inscricoes i WHERE i.id_vaga = v.id AND i.id_usuario = ?) as ja_inscrito
            FROM vagas v 
            WHERE v.usuario_responsavel != ?";
    
    $params[] = $userId;
    $params[] = $userId;
    $types = "ii";
    
    if (!empty($_GET['vagas'])) {
        $sql .= " AND v.cargo LIKE ?";
        $searchTerm = "%" . $_GET['vagas'] . "%";
        $params[] = $searchTerm;
        $types .= "s";
    }
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='results'>";
            echo "<div><span>Empresa</span> - " . htmlspecialchars($row["empresa"]) . "</div>";
            echo "<div><span>Cargo</span> -  " . htmlspecialchars($row["cargo"]) . "</div>";
            echo "<div><span>Total de inscritos</span> - " . $row["total_inscritos"] . "</div>";
            echo "<div class='btns'>";
            
            if ($row['ja_inscrito'] > 0) {
                echo "<span style='color:green; font-weight:600;'>Inscrito</span><br>";
            } else {
                echo "<a href='inscrever.php?vaga=" . $row["id"] . "'><button class='candidatar'>Candidatar</button></a> ";
            }
            
            echo "<button class='visualizar' data-id='" . $row["id"] . "'>Visualizar</button>";
            echo "</div></div>";
        }
    } else {
        echo "<p class='not-result'>Nenhuma vaga encontrada.</p>";
    }
    
    $stmt->close();
    $conn->close();
    ?>
    </main>
</body>
</html>
<style>

</style>

<script>
  const dropdownBtn = document.querySelector('.dropdown-btn');
const dropdownMenu = document.querySelector('.dropdown-menu');

dropdownBtn.addEventListener('click', () => {
  dropdownMenu.classList.toggle('show');
});

window.addEventListener('click', (event) => {
  if (!event.target.matches('.dropdown-btn') && !event.target.matches('.dropdown-menu')) {
    dropdownMenu.classList.remove('show');
  }
});


</script>