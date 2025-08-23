<?php 
session_start();

// 1. LÓGICA PHP NO TOPO DO ARQUIVO
// =================================

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
  header("Location: ../login.php");
  exit;
}

$userId = $_SESSION["user_id"];
$message = '';

// 2. PROCESSAMENTO DO FORMULÁRIO DE UPLOAD
// =======================================
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['adicionar_cadastro'])) {
    if (isset($_FILES["curriculo"]) && $_FILES["curriculo"]["error"] === UPLOAD_ERR_OK) {
        
        // Validação do tipo de arquivo (ex: apenas PDF)
        $allowed_types = ['application/pdf'];
        if (in_array($_FILES['curriculo']['type'], $allowed_types)) {
            
            // Busca o nome do currículo atual para poder excluí-lo depois
            $stmt = $conn->prepare("SELECT curriculo FROM cadastro WHERE id = ?");
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $result = $stmt->get_result();
            $user_data = $result->fetch_assoc();
            $current_curriculum = $user_data['curriculo'] ?? null;
            $stmt->close();

            // Define um nome único para o novo arquivo
            $target_dir = "uploads/";
            $file_extension = pathinfo($_FILES["curriculo"]["name"], PATHINFO_EXTENSION);
            $new_file_name = uniqid('cv_', true) . "." . $file_extension;
            $target_file = $target_dir . $new_file_name;

            // Move o arquivo para o diretório de uploads
            if (move_uploaded_file($_FILES["curriculo"]["tmp_name"], $target_file)) {
                // Atualiza o nome do arquivo no banco de dados
                $stmt = $conn->prepare("UPDATE cadastro SET curriculo = ? WHERE id = ?");
                $stmt->bind_param("si", $new_file_name, $userId);
                
                if ($stmt->execute()) {
                    // Exclui o currículo antigo se ele existir
                    if (!empty($current_curriculum) && file_exists($target_dir . $current_curriculum)) {
                        unlink($target_dir . $current_curriculum);
                    }
                    $message = "Currículo enviado com sucesso!";
                    header("Refresh: 2; url=curriculo.php"); // Recarrega a página após 2 segundos
                } else {
                    $message = "Erro ao salvar no banco de dados: " . $stmt->error;
                }
                $stmt->close();
            } else {
                $message = "Erro ao mover o arquivo enviado.";
            }
        } else {
            $message = "Erro: Tipo de arquivo inválido. Apenas PDF é permitido.";
        }
    } else {
        $message = "Erro no upload ou nenhum arquivo selecionado.";
    }
}

// 3. BUSCA DOS DADOS DO USUÁRIO PARA EXIBIÇÃO
// ==========================================
$stmt = $conn->prepare("SELECT * FROM `cadastro` WHERE id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

$conn->close();

// Se o usuário não for encontrado, encerra a sessão.
if (!$user) {
    session_destroy();
    header("Location: ../login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="..\imagens\Logo.svg"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/home.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Currículo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        h1 {
            text-align: center;
            color: #333;
            font-size: 2em;
            margin-top: 50px;
        }

        p {
            text-align: center;
            color: #666;
            font-size: 1.2em;
            margin-bottom: 50px;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin: auto;
            height:30vh;
            border-radius:10px;
            background-image: linear-gradient(to bottom, rgb(195 195 195 / 40%), rgb(131 126 126 / 12%));
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center center;
            max-width: 500px;
        }

        label {
            font-size: 1.2em;
            color: #666;
            margin-bottom: 10px;
        }

        input[type="file"] {
            padding: 10px;
            background-color: #fff;
            border-radius: 5px;
            border: none;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16);
            margin-bottom: 20px;
            font-size: 1.1em;
        }

        input[type="submit"] {
            padding: 10px;
            background-color: #48a8ff;
            border-radius: 5px;
            border: none;
            color: #fff;
            font-size: 1.1em;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        input[type="submit"]:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
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
                            <img src='uploads/<?php echo htmlspecialchars($user['foto']); ?>' alt="Foto de perfil" style='width:50px; height:50px; border-radius:100%;'>
                        <?php else: ?>
                            <img src='https://placehold.co/50x50' alt="Foto de perfil padrão" style='width:50px; height:50px; border-radius:100%;'>
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
    <h1>Adicione seu currículo</h1>
    <p>Melhore seu perfil para conseguir sua vaga!</p>
    <form action="curriculo.php" method="post" enctype="multipart/form-data">
        <?php if (!empty($message)): ?>
            <p style="font-weight: bold; color: #333;"><?php echo $message; ?></p>
        <?php endif; ?>

        <?php if (!empty($user['curriculo'])): ?>
            <p>Você já tem um currículo. <a href="uploads/<?php echo htmlspecialchars($user['curriculo']); ?>" target="_blank">Ver atual</a>.</p>
            <label for="curriculo">Para atualizar, selecione um novo arquivo (PDF):</label>
        <?php else: ?>
            <label for="curriculo">Selecione seu currículo (PDF):</label>
        <?php endif; ?>
        
        <input type="file" name="curriculo" id="curriculo" accept=".pdf" required>
        <input type="submit" name="adicionar_cadastro" value="Enviar Currículo">
    </form>
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
</body>
</html>