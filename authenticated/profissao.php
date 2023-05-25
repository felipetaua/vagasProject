<!DOCTYPE html>
<html>
<head>
<link rel="icon" type="image/png" href="..\imagens\Logo.svg"/>
<link rel="stylesheet" href="../css/home.css">
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
  <title>Cadastro de Profissão</title>
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

    echo "<header style='background:white; margin-top:-10px; padding:5px; '>
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
    
  <h1>Cadastro de Profissão</h1>
  <form method="post">
    <label for="id_profissao">Selecione a profissão:</label>
    <select name="id_profissao">
    <?php



      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "jobs";
      
      
      $conn = new mysqli($servername, $username, $password, $dbname);
      
      if ($conn->connect_error) {
          die("Falha na conexão: " . $conn->connect_error);
      }

      $sql = "SELECT id, nome FROM profissao";
      $result = mysqli_query($conn, $sql);

      while ($row = mysqli_fetch_assoc($result)) {
        $id = $row["id"];
        $nome = $row["nome"];
        echo "<option value=\"$id\">$nome</option>";
      }

      
      mysqli_close($conn);
    ?>
    </select>
    <br><br>
    <input type="submit" name="submit" value="Cadastrar">
  </form>
</body>
</html>
<script>const dropdownBtn = document.querySelector('.dropdown-btn');
const dropdownMenu = document.querySelector('.dropdown-menu');

dropdownBtn.addEventListener('click', () => {
  dropdownMenu.classList.toggle('show');
});

window.addEventListener('click', (event) => {
  if (!event.target.matches('.dropdown-btn') && !event.target.matches('.dropdown-menu')) {
    dropdownMenu.classList.remove('show');
  }
});</script>
<?php





if (isset($_SESSION["user_id"])) {
  $id_do_usuario = $_SESSION["user_id"];
}

if (isset($_POST["submit"])) {
  
  $id_profissao = $_POST["id_profissao"];

  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "jobs";
  

  $conn = new mysqli($servername, $username, $password, $dbname);
  

  if ($conn->connect_error) {
      die("Falha na conexão: " . $conn->connect_error);
  }
  
  $sql = "UPDATE cadastro SET id_profissao = $id_profissao WHERE id = $id_do_usuario";
  if (mysqli_query($conn, $sql)) {
    echo "Profissão cadastrada com sucesso!";
    header("Location: home.php");
    exit(); 
  } else {
    echo "Erro ao cadastrar profissão: " . mysqli_error($conn);
  }

 
  mysqli_close($conn);
}
?>


<style>

body {
  font-family: Arial, sans-serif;
  color: #333;
  background:#033f63;
}


h1, form {
  margin: 30px auto;
  max-width: 500px;
  display:flex;
  justify-content:center;
  align-items:center;
  flex-direction:column;
  color:white;
  
}

form label{
  margin:30px;
}

input[type=submit] {
  background-color: white;
  color: #033f63;
  padding: 10px 15px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}


select {
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  width: 100%;
  box-sizing: border-box;
  margin-bottom: 20px;
}


</style>

