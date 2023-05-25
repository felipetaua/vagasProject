<!DOCTYPE html>
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
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="..\imagens\Logo.svg"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/cadastroVagas.css">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <title>Cadastro vagas</title>
</head>
<body>
<?php 

$id_do_usuario = $_SESSION["user_id"];

// Busca os dados do usuário no banco de dados
$sql = "SELECT * FROM `cadastro` WHERE id = $id_do_usuario and foto is not null";
$result = $conn->query($sql);

// Exibe o formulário para atualização do cadastro
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {

echo "<header>
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
    }}
?>
<main>
    <h1>Publique sua vaga</h1>
    <p>Preencha o formulário abaixo</p>
    <form action="validaCadastroVagas.php" method="POST" onSubmit="return validarFormulario()">
        <div class="container">
        <label for="empresa">Empresa / Local</label>
        <input type="text" placeholder="Digite o nome da empresa ou local de trabalho..." name="empresa" required></div>
        <div class="container">
        <label for="cargo">Cargo / Função</label>
        <input type="text" placeholder="Digite uma profissão..." name="cargo" required></div>
        <div class="container">
        <label for="telefone">Telefone</label>
        <input type="number" placeholder="Digite um telefone para contato..." name="telefone" required></div>
        <div class="container">
        <label for="Email">Email</label>
        <input type="email" placeholder="Digite um email..." name="email" required></div>
        <div class="container">
        <label for="requisitos">Requisitos</label>
        <input type="text" placeholder="Digite os requisitos caso seja necessários..." name="requisitos" required></div>
        <div class="container">
        <label for="beneficios">Benefícios</label>
        <input type="text" placeholder="Digite os benefícios caso tenha ...." name="beneficios" required></div>
        <input type="submit" value="Solicitar divulgação" onClick="validarFormulario()">
    </form>
</main>
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
  

<style>
        *{
        margin:0;
        padding:0;
        box-sizing:border-box;
    }
main{
  background:linear-gradient(#033F63, #033F68);
  background-size: cover;
  background-attachment: fixed;
  height:95vh;
  background-position: center;
  color:#ffffffeb;
  
}
.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-btn {
  
  
  border: none;
  cursor: pointer;
  padding: 10px 20px;
  font-size: 16px;
}

.dropdown-menu {
  position: absolute;
  top: 100%;
  left: 0;
  background-color: #033F63;
 
  font-size:13px;
  box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
  list-style: none;
  padding: 0;
  max-width:200px;
  width:100%;
  display: none;
  z-index: 1;
}

.dropdown-menu li {
  padding: 20px 20px;
  color:#fff;
}

.dropdown-menu li:hover {
  
  color:#033F63;
  background-color: #f1f1f1;
}

.dropdown-menu li a:hover{
  color:#033F63;
 
}
a{color:white;}
.show {
  display: block;
}
</style>