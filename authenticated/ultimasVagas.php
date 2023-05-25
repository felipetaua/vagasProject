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
$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">
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



// Busca os dados do usuário no banco de dados
$sql = "SELECT * FROM `cadastro` WHERE id = $user_id and foto is not null";
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
    }}
?>
    <h1>Jobs in Cariri</h1>
    <p>Vagas</p>
    <form method="get" action="">
        <input type="text" placeholder="Digite a vaga que busca..." name='vagas'>
        <input type="submit" value="Buscar" name='buscar'>
    </form>
    <main class="container">
    <?php
// Configurações de conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jobs";

// Cria uma conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se houve erro na conexão
if ($conn->connect_error) {
  die("Erro ao conectar ao banco de dados: " . $conn->connect_error);
}

// Verifica se o formulário foi submetido
if(isset($_GET['buscar'])) {

  // Captura os valores enviados pelo usuário
  $vagas = $_GET['vagas'];
  

  // Monta a consulta SQL para selecionar as vagas correspondentes aos termos de busca
  $sql = "SELECT * FROM vagas WHERE cargo LIKE '%$vagas%' and usuario_responsavel != $user_id ";
  

  // Executa a consulta SQL
  $result = $conn->query($sql);

  // Verifica se há resultados a serem exibidos
  if ($result->num_rows > 0) {

    // Exibe os resultados
    while($row = $result->fetch_assoc()) {
      
      $sql2 = "SELECT COUNT(*) AS total_inscritos FROM inscricoes WHERE id_vaga = $row[id]";
      $resultado = mysqli_query($conn, $sql2);
      $inscricoes = mysqli_fetch_assoc($resultado);

      $inscricoes_query = "SELECT COUNT(*) as count FROM inscricoes WHERE nome_usuario = $user_id  AND id_vaga =$row[id]";
      $inscricoes_result = mysqli_query($conn, $inscricoes_query);
      $inscricoes2 = mysqli_fetch_assoc($inscricoes_result);


      if ($inscricoes2['count'] > 0) {
        
        echo "<div class='results'>"."<div><span>Empresa</span> - " . 
        $row["empresa"]."</div>"."<div><span>Cargo</span> -  ". $row["cargo"]."</div>"."<div><span>Total de inscritos</span> - ".$inscricoes["total_inscritos"]."</div>".
        "<div class='btns'>"."<span style='color:green; font-weight:600;'>Inscrito</span><br>"."<button class='visualizar' data-id='".$row["id"]."'>Visualizar</button>"."</div>"."</div>";

    }
      else{
        echo "<div class='results'>"."<div><span>Empresa</span> - " . 
        $row["empresa"]."</div>"."<div><span>Cargo</span> -  ". $row["cargo"]."</div>"."<div><span>Total de inscritos</span> - ".$inscricoes["total_inscritos"]."</div>".
        "<div class='btns'>"."<a href=\"inscrever.php?vaga=" . $row["id"] . "\"><button class='candidatar'>Candidatar</button></a> "."<button class='visualizar' data-id='".$row["id"]."'>Visualizar</button>"."</div>"."</div>";
        
      }
      
        
    }

  } else {
    echo "<p class='not-result'>Nenhum resultado encontrado.</p>";
  }

  // Fecha a conexão com o banco de dados
  $conn->close();

} else{
    $sql = "SELECT * FROM vagas where usuario_responsavel != $user_id ";

  // Executa a consulta SQL
  $result = $conn->query($sql);

  // Verifica se há resultados a serem exibidos
  if ($result->num_rows > 0) {
    
    // Exibe os resultados
    while($row = $result->fetch_assoc()) {

      $sql2 = "SELECT COUNT(*) AS total_inscritos FROM inscricoes WHERE id_vaga = $row[id]";
      $resultado = mysqli_query($conn, $sql2);
      $inscricoes = mysqli_fetch_assoc($resultado);

      $inscricoes_query = "SELECT COUNT(*) as count FROM inscricoes WHERE nome_usuario = $user_id  AND id_vaga =$row[id]";
      $inscricoes_result = mysqli_query($conn, $inscricoes_query);
      $inscricoes2 = mysqli_fetch_assoc($inscricoes_result);


      if ($inscricoes2['count'] > 0) {
        
        echo "<div class='results'>"."<div><span>Empresa</span> - " . 
        $row["empresa"]."</div>"."<div><span>Cargo</span> -  ". $row["cargo"]."</div>"."<div><span>Total de inscritos</span> - ".$inscricoes["total_inscritos"]."</div>".
        "<div class='btns'>"."<span style='color:green; font-weight:600;'>Inscrito</span><br>"."<button class='visualizar' data-id='".$row["id"]."'>Visualizar</button>"."</div>"."</div>";

    }
      else{
        echo "<div class='results'>"."<div><span>Empresa</span> - " . 
        $row["empresa"]."</div>"."<div><span>Cargo</span> -  ". $row["cargo"]."</div>"."<div><span>Total de inscritos</span> - ".$inscricoes["total_inscritos"]."</div>".
        "<div class='btns'>"."<a href=\"inscrever.php?vaga=" . $row["id"] . "\"><button class='candidatar'>Candidatar</button></a> "."<button class='visualizar' data-id='".$row["id"]."'>Visualizar</button>"."</div>"."</div>";
        
      }
        
    }

  } else {
    echo "<p class='not-result'>Nenhum resultado encontrado.</p>";
  }
}
?>   
 </main>
 <?php
// Verifica se a requisição GET foi feita para visualizar uma vaga
if(isset($_GET['visualizar'])) {
  // Obtém o ID da vaga
  $id = $_GET['id'];

  // Consulta a vaga no banco de dados
  $sql = "SELECT * FROM vagas WHERE id = $id";
  $result = $conn->query($sql);

  // Verifica se há resultados a serem exibidos
  if ($result->num_rows > 0) {
    // Obtém a empresa da vaga
    $row = $result->fetch_assoc();
    $empresa = $row['empresa'];

    // Exibe o resultado dentro do modal
    echo "<div class='modal-body'>Empresa: " . $empresa . "</div>";
  } else {
    echo "<p class='not-result'>Nenhum resultado encontrado.</p>";
  }

  // Fecha a conexão com o banco de dados
  $conn->close();
}
?>




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