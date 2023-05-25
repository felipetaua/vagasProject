<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="..\imagens\Logo.svg"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/home.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar currículo</title>
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

    <h1>Adicione seu currículo</h1>
    <p>Melhore seu perfil para conseguir sua vaga!</p>
<form action="" method="post" enctype="multipart/form-data">
    <label for="curriculo">Currículo:</label>
    <input type="file" name="curriculo" id="curriculo">
    
    <input type="submit" name="adicionar_cadastro" value="Adicionar">
</form>

</form>
</body>
</html>
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
    header("Location: ..\login.php");
    exit;
}

$id_do_usuario = $_SESSION["user_id"];

$sql = "SELECT curriculo, nome FROM cadastro WHERE id=$id_do_usuario";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$curriculo_atual = $row["curriculo"];


if (!empty($curriculo_atual)) {
    echo "<p>O currículo de "."$row[nome] "."já foi adicionado!<br> Para atualizar selecione outro</p>";
    if (isset($_FILES["curriculo"]) && $_FILES["curriculo"]["error"] === UPLOAD_ERR_OK) {
        // Define um nome único para o arquivo
        $file_name_parts = pathinfo($_FILES["curriculo"]["name"]);
        $file_extension = $file_name_parts["extension"];
        $new_file_name = uniqid(). "." . $file_extension;
    
        // Move o arquivo para o diretório de uploads
        $target_dir = "uploads/";
        $target_file = $target_dir . $new_file_name;
        move_uploaded_file($_FILES["curriculo"]["tmp_name"], $target_file);
    
        // Busca o nome do arquivo do currículo atual
        $sql = "SELECT curriculo FROM cadastro WHERE id=$id_do_usuario";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $curriculo_atual = $row["curriculo"];
    
        // Define o novo nome do currículo no banco de dados
        $sql = "UPDATE cadastro SET curriculo ='$new_file_name' WHERE id=$id_do_usuario";
        if ($conn->query($sql) === TRUE) {
            // Exclui o currículo atual se existir
            if (!empty($curriculo_atual) && file_exists($target_dir . $curriculo_atual)) {
                unlink($target_dir . $curriculo_atual);
            }
            echo "Currículo atualizado com sucesso!";
    
            header("Location: home.php");
            exit;
        } else {
            echo "Erro ao atualizar cadastro: " . $conn->error;
        }
    

}
}

    
?>

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