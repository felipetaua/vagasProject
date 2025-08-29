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
    // Em um ambiente real, logue o erro em vez de mostrá-lo na tela
    die("Falha na conexão: " . $conn->connect_error);
}

// Verifica se o usuário está logado
if (!isset($_SESSION["user_id"])) {
  header("Location: ../login.php");
  exit;
}

$userId = $_SESSION["user_id"];
$updateMessage = '';

// 2. PROCESSAMENTO DO FORMULÁRIO DE ATUALIZAÇÃO
// ============================================
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['atualizar_cadastro'])) {
    // Coleta dos dados do formulário
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $cpf = $_POST["cpf"];
    $rg = $_POST["rg"];
    $celular = $_POST["celular"];
    $cidade = $_POST["cidade"];

    // Busca os nomes dos arquivos atuais para possível exclusão
    $stmt = $conn->prepare("SELECT foto, curriculo FROM cadastro WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $currentFiles = $result->fetch_assoc();
    $stmt->close();

    $newPhotoName = $currentFiles['foto'];
    $newCurriculumName = $currentFiles['curriculo'];

    // Processa a FOTO DE PERFIL, se enviada
    if (isset($_FILES["foto"]) && $_FILES["foto"]["error"] === UPLOAD_ERR_OK) {
        $target_dir = "uploads/";
        $file_extension = pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION);
        $newPhotoName = uniqid('foto_', true) . "." . $file_extension;
        
        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir . $newPhotoName)) {
            // Exclui a foto antiga se existir
            if (!empty($currentFiles['foto']) && file_exists($target_dir . $currentFiles['foto'])) {
                unlink($target_dir . $currentFiles['foto']);
            }
        } else {
            $newPhotoName = $currentFiles['foto']; // Mantém a foto antiga se o upload falhar
        }
    }

    // Processa o CURRÍCULO, se enviado
    if (isset($_FILES["curriculo"]) && $_FILES["curriculo"]["error"] === UPLOAD_ERR_OK) {
        // Validação simples de tipo de arquivo (apenas PDF)
        if ($_FILES['curriculo']['type'] == 'application/pdf') {
            $target_dir = "uploads/";
            $file_extension = pathinfo($_FILES["curriculo"]["name"], PATHINFO_EXTENSION);
            $newCurriculumName = uniqid('cv_', true) . "." . $file_extension;

            if (move_uploaded_file($_FILES["curriculo"]["tmp_name"], $target_dir . $newCurriculumName)) {
                // Exclui o currículo antigo se existir
                if (!empty($currentFiles['curriculo']) && file_exists($target_dir . $currentFiles['curriculo'])) {
                    unlink($target_dir . $currentFiles['curriculo']);
                }
            } else {
                $newCurriculumName = $currentFiles['curriculo']; // Mantém o antigo se o upload falhar
            }
        } else {
            $updateMessage = "Erro: Apenas arquivos PDF são permitidos para o currículo.";
        }
    }

    // Atualiza o banco de dados com os novos dados de forma segura
    if (empty($updateMessage)) {
        $sql = "UPDATE cadastro SET nome=?, email=?, cpf=?, rg=?, celular=?, cidade=?, foto=?, curriculo=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssi", $nome, $email, $cpf, $rg, $celular, $cidade, $newPhotoName, $newCurriculumName, $userId);

        if ($stmt->execute()) {
            $updateMessage = "Cadastro atualizado com sucesso!";
            // Opcional: redirecionar após um tempo ou deixar a mensagem na tela
            header("Refresh: 2; url=perfil.php");
        } else {
            $updateMessage = "Erro ao atualizar cadastro: " . $stmt->error;
        }
        $stmt->close();
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

// Se o usuário não for encontrado por algum motivo, encerra.
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/home.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <title>Perfil</title>
</head>
<body>
    <?php 
        // Inclui o cabeçalho reutilizável
        require_once __DIR__ . '/templates/header.php';
    ?>

    <?php if (!empty($updateMessage)): ?>
        <p style="color: white; text-align: center; font-weight: bold;"><?php echo $updateMessage; ?></p>
    <?php endif; ?>

    <form method='POST' action='perfil.php' enctype='multipart/form-data'>
        <div class='container-img'>
            <img src='<?php echo !empty($user['foto']) ? "uploads/" . htmlspecialchars($user['foto']) : "https://placehold.co/180x180"; ?>' style='border-radius:100%;' id='preview-img' alt="Pré-visualização da foto de perfil">
            <input type='file' name='foto' class='custom-file-input' id='foto' onchange='previewImage();' accept="image/*">
        </div>
        <div class='container-inputs'>
            <label for='nome'>Nome</label>
            <input type='text' value='<?php echo htmlspecialchars($user['nome']); ?>' name='nome'>
        </div>
        <div class='container-inputs'>
            <label for='Email'>Email</label>
            <input type='email' value='<?php echo htmlspecialchars($user['email']); ?>' name='email'>
        </div>
        <div class='container-inputs'>
            <label for='CPF'>CPF</label>
            <input type='text' value='<?php echo htmlspecialchars($user['cpf']); ?>' name='cpf'>
        </div>
        <div class='container-inputs'>
            <label for='RG'>RG</label>
            <input type='text' value='<?php echo htmlspecialchars($user['rg']); ?>' name='rg'>
        </div>
        <div class='container-inputs'>
            <label for='Telefone'>Telefone</label>
            <input type='text' value='<?php echo htmlspecialchars($user['celular']); ?>' name='celular'>
        </div>
        <div class='container-inputs'>
            <label for='Cidade'>Cidade</label>
            <input type='text' value='<?php echo htmlspecialchars($user['cidade']); ?>' name='cidade'>
        </div>
        <div class='container-inputs'>
            <label for='curriculo'>Currículo (somente PDF)</label>
            <input type='file' name='curriculo' id='curriculo' accept='.pdf'>
            <?php if (!empty($user['curriculo'])): ?>
                <p style="font-size: 0.8em; margin-top: 5px;">Atual: <a href="uploads/<?php echo htmlspecialchars($user['curriculo']); ?>" target="_blank" style="color: lightblue;">Ver/Baixar Currículo</a></p>
            <?php endif; ?>
        </div>
        <input type='submit' value='Atualizar cadastro' name='atualizar_cadastro'>
    </form>

<script>
function previewImage() {
    var preview = document.querySelector('#preview-img');
    var file = document.querySelector('#foto').files[0];
    var reader = new FileReader();

    reader.addEventListener("load", function () {
        preview.src = reader.result;
    }, false);

    if (file) {
        reader.readAsDataURL(file);
    }
}

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

<style>
    form {
    display:flex;
    justify-content:center;
    flex-direction:column;
    align-items:center;
    width:500px;
    color:white;
    margin:40px auto;}

    form input{
        width:400px;
        background:none;
        color:white;
        height:30px;}

    input[type='submit']{
        height:40px;
        width:250px;
}
    .container-inputs{
    display:flex;
    flex-direction:column;
    align-items:start;
    justify-content:flex-start;
    margin:10px;
    }
    .container-img{
        display:flex;
        flex-direction:column;
        align-items:center;
        justify-content:center;

    }

    .container-img img{
        width:180px;
        height:180px;
        border-radius:100%;
    }

    h1{
        text-align:center;
    }
  
    .custom-file-input {
        color: #033f63;
        margin:auto;
        width:190px;
        margin:30px;
        margin-left:30px;
    }
    .custom-file-input::-webkit-file-upload-button {
        visibility: hidden;
    }
    .custom-file-input::before {
        content: 'Adicione uma foto ao perfil';
        display: inline-block;
        border:none;
        background:white;
        border: 1px solid #999;
        border-radius: 3px;
        padding: 5px 8px;
        outline: none;
        color:#033f63;
        white-space: nowrap;
        -webkit-user-select: none;
        cursor: pointer;
        font-size: 10pt;
    }
    .custom-file-input:hover::before {
        border-color: black;
    }
    .custom-file-input:active {
        outline: 0;
    }
    .custom-file-input:active::before {
        background: -webkit-linear-gradient(top, #e3e3e3, #f9f9f9); 
    }

    body {
        font-family:Roboto;
        background:#033f63;
    }
    body h1{
        color:white;
    }

    .container-img {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-bottom: 20px;
    }

    .container-img img {
        margin-bottom: 10px;
    }

    .custom-file-label {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        cursor: pointer;
    }

    .container-inputs {
        display: flex;
        flex-direction: column;
        margin-bottom: 10px;
    }

    .container-inputs label {
        font-weight: bold;
        margin-bottom: 5px;
    }

    .container-inputs input {
        border: none;
        border-bottom: 1px solid #ccc;
        padding: 5px;
        outline:none;
        font-size: 16px;
    }

    input[type='submit'] {
        background-color: white;
        color: #033f63;
        border: none;
        font-weight:600;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        padding: 10px 20px;
    }   
</style>
</body>
</html>