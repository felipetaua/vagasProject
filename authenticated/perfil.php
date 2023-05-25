<!DOCTYPE html>
<html lang="en">
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

$id_do_usuario = $_SESSION["user_id"];

// Busca os dados do usuário no banco de dados
$sql = "SELECT * FROM `cadastro` WHERE id = $id_do_usuario and foto is not null";
$result = $conn->query($sql);

// Exibe o formulário para atualização do cadastro
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {

echo "<header style='background:white; margin-top:-10px; padding:5px;'>
    <ul>
        <a href='../authenticated/home.php'> <li>
            <img src='..\imagens\Logo.svg' alt=''class='logo'> JOBS IN CARIRI
        </li></a> 
        <a href='../authenticated/profissionais.php'><li>
           Profissionais
        </li></a>
        <a href='../authenticated/cadastroVagas.php'> <li>Cadastrar vaga</li></a>
        <a href='../authenticated/ultimasVagas.php'><li>Ultimas vagas</li></a>
        <a href='../authenticated/vagasCriadas.php'><li>Minhas vagas</li></a>
        <div class='dropdown'> 
        <div class='perfil-img' style='display:flex; align-items:center; justify-content:center;'>
        <div style='display:flex; flex-direction:column; align-items:center;'>
          <img src='uploads/$row[foto]' style='width:50px; height:50px; border-radius:100%;'>  
          </div>    
  <li class='dropdown-btn'>$row[nome]</li>
  <svg xmlns='http://www.w3.org/2000/svg' style='width:10px; color:green;' viewBox='0 0 320 512'><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d='M137.4 374.6c12.5 12.5 32.8 12.5 45.3 0l128-128c9.2-9.2 11.9-22.9 6.9-34.9s-16.6-19.8-29.6-19.8L32 192c-12.9 0-24.6 7.8-29.6 19.8s-2.2 25.7 6.9 34.9l128 128z'/ ></svg>
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
</header>";

     }
      

}

  else{

    echo "<header style='background:white; margin-top:-10px; padding:5px; padding:5px;'>
      <ul>
          <a href='../authenticated/home.php'> <li>
              <img src='..\imagens\Logo.svg' alt=''class='logo'> JOBS IN CARIRI
          </li></a> 
          <a href='../authenticated/profissionais.php'><li>
           Profissionais
        </li></a>
        <a href='../authenticated/cadastroVagas.php'> <li>Cadastrar vaga</li></a>
        <a href='../authenticated/ultimasVagas.php'><li>Ultimas vagas</li></a>
        <a href='../authenticated/vagasCriadas.php'><li>Minhas vagas</li></a>
          <div class='dropdown'> 
          <div class='perfil-img' style='display:flex; align-items:center; justify-content:center;'>
            <img src='https://placehold.co/500x400' style='width:50px; height:50px; border-radius:100%;'>        
    <li class='dropdown-btn'>Perfil</li>
    <svg xmlns='http://www.w3.org/2000/svg' style='width:10px; color:green;' viewBox='0 0 320 512'><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d='M137.4 374.6c12.5 12.5 32.8 12.5 45.3 0l128-128c9.2-9.2 11.9-22.9 6.9-34.9s-16.6-19.8-29.6-19.8L32 192c-12.9 0-24.6 7.8-29.6 19.8s-2.2 25.7 6.9 34.9l128 128z'/ ></svg>
    </div>
    <ul class='dropdown-menu'>
    <a href='perfil.php'><li>Editar perfil</li></a>
    <a href='#'> <li>Ranking</li></a>
    <a href='../authenticated/profissao.php'> <li>Profissão</li></a>
    <a href='#'><li>Contratos</li></a>
    <a href='#'> <li>Chat</li></a>
    <a href='#'> <li>Curriculo</li></a>
    <a href='./logout.php'><li>Sair</li></a>
    </ul>
  </div>
  
  
      </ul>
  </header>";
  
  }

?>
    
    <?php 


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jobs";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

if (!isset($_SESSION["user_id"])) {
    
}

$id_do_usuario = $_SESSION["user_id"];


$sql = "SELECT * FROM `cadastro` WHERE id = $id_do_usuario";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<form method='POST' action='' enctype='multipart/form-data'>
            <div class='container-img'>
                <img src='uploads/{$row['foto']}' style=' border-radius:100%;' id='preview-img'>
                <input type='file' name='foto' class='custom-file-input' id='foto' onchange='previewImage();'></div>
                <div class='container-inputs'>
                <label for='nome'>Nome</label>
                <input type='text' value='{$row['nome']}' name='nome'>
            </div>
            <div class='container-inputs'>
                <label for='Email'>Email</label>
                <input type='email' value='{$row['email']}' name='email'>
            </div>
            <div class='container-inputs'>
                <label for='CPF'>CPF</label>
                <input type='text' value='{$row['cpf']}' name='cpf'>
            </div>
            <div class='container-inputs'>
                <label for='RG'>RG</label>
                <input type='text' value='{$row['rg']}' name='rg'>
            </div>
            <div class='container-inputs'>
                <label for='Telefone'>Telefone </label>
                <input type='number' value='{$row['celular']}' name='celular'>
            </div>
            <div class='container-inputs'>
                <label for='Cidade'>Cidade</label>
                <input type='text' value='{$row['cidade']}' name='cidade'>
            </div>
            <input type='submit' value='Atualizar cadastro' name='atualizar_cadastro'>
        </form>";
    }
}


// Processa a atualização do cadastro
if (isset($_POST['atualizar_cadastro'])) {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $cpf = $_POST["cpf"];
    $rg = $_POST["rg"];
    $celular = $_POST["celular"];
    $cidade = $_POST["cidade"];

    // Verifica se foi enviado um arquivo
    if (isset($_FILES["foto"]) && $_FILES["foto"]["error"] === UPLOAD_ERR_OK) {
        // Define um nome único para o arquivo
        $file_name_parts = pathinfo($_FILES["foto"]["name"]);
        $file_extension = $file_name_parts["extension"];
        $new_file_name = uniqid() . "." . $file_extension;
  
        // Move o arquivo para o diretório de uploads
        $target_dir = "uploads/";
        $target_file = $target_dir . $new_file_name;
        move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file);

        // Busca o nome do arquivo da imagem atual
        $sql = "SELECT foto FROM cadastro WHERE id=$id_do_usuario";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $foto_atual = $row["foto"];

        // Define o novo nome da imagem no banco de dados
        $sql = "UPDATE cadastro SET foto ='$new_file_name', nome='$nome', email='$email', cpf='$cpf', rg='$rg', celular='$celular', cidade='$cidade' WHERE id=$id_do_usuario";
        if ($conn->query($sql) === TRUE) {
            // Exclui a imagem atual se existir
            if (!empty($foto_atual) && file_exists($target_dir . $foto_atual)) {
                unlink($target_dir . $foto_atual);
            }
            echo "Cadastro atualizado com sucesso!";
            header("Location: home.php");
            exit;
        } else {
            echo "Erro ao atualizar cadastro: " . $conn->error;
        }
    } else {
        // Não foi enviado um arquivo, atualiza apenas os outros campos
        $sql = "UPDATE cadastro SET nome='$nome', email='$email', cpf='$cpf', rg='$rg', celular='$celular', cidade='$cidade' WHERE id=$id_do_usuario";
        if ($conn->query($sql) === TRUE) {
            echo "Cadastro atualizado com sucesso!";
            header("Location: home.php");
            exit;
        } else {
            echo "Erro ao atualizar cadastro: " . $conn->error;
        }
    }
}


$conn->close();
?>
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
    form{display:flex;
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

<style>
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
</style>