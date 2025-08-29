<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styleHome.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <title>Jobs In Cariri</title>
</head>

<body style="background-image:url('https://i.ibb.co/cJgW1Zy/Adobe-Stock-352915097-1.png');  background-repeat: no-repeat;
;     background-size: cover;">
<header style="background:white; border-bottom-left-radius:10px; border-bottom-right-radius:10px;">
        <ul class='logo'>
            <li><img src=".\imagens\Logo.svg" alt="" style="width:30px"></li>
        </ul>
        <ul class='btns-header'>
            <li>Candidaturas</li>
            <li>Empresas</li>
            <li>Publicar vaga</li>
        </ul>
        <ul class='container-cadastro'>
            <li style='color:#FFA500; text-decoration:none;'><a style="text-decoration:none;color:#FFA500;"href="./login.php">Login</a></li>
            <li><a style="text-decoration:none;color:#033F63;" href="./cadastro.php">Cadastro</a></li>
        </ul>
    </header>
    
    <main >
        <div class="title">
        <h1 style='font-weight:300;'>Conectando talentos a oportunidades</h1>
        <h1 style='font-weight:600;'>Encontre sua vaga de emprego</h1>
        </div>
        <form method="get" action="">
            <input type="text" name='vagas' placeholder='Pelo que procura? Digite aqui...'>
            <input type="text" name='local' placeholder='Onde? Qual cidade?'>
            <input type="submit" name="buscar" id="" value='Pesquisar' class='pesquisar'>
        </form>
    </main>
    <section>
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
  $local = $_GET['local'];

  // Monta a consulta SQL para selecionar as vagas correspondentes aos termos de busca
  $sql = "SELECT * FROM vagas WHERE cargo LIKE '%$vagas%'";

  // Executa a consulta SQL
  $result = $conn->query($sql);

  // Verifica se há resultados a serem exibidos
  if ($result->num_rows > 0) {

    // Exibe os resultados
    while($row = $result->fetch_assoc()) {
      echo "<div class='results'>"."Empresa - " . $row["empresa"]."<br>"."Cargo -  ". $row["cargo"]."<a href='login.php'><button>Candidatar</button></a>"."</div>";
    }

  } else {
    echo "<p class='not-result'>Nenhum resultado encontrado.</p>";
  }

  // Fecha a conexão com o banco de dados
  $conn->close();

}
?>
    </section>
</body>
</html>

<style>

    .not-result{
        font-size:30px;
        text-align:center;
        margin:50px auto;
        font-weight:600;
    }
    section{
        display:flex;
        justify-content:center;
        margin:30px;
        align-items:center;
        flex-wrap:wrap;
       
    }
    .results{
        display:flex;
        flex-direction:column;
        align-items:center;
        justify-content:center;
        background:white;
        color:black;
        flex-wrap:wrap;
        width:350px;
        border-radius:10px;
        height:110px;
        margin:10px;
        padding:5px;
        text-align:center;
    }
    button{
        background:#FFA500;
        color:white;
        border:none;
        margin:10px;
        height:30px;
        width:100px;
        border-radius:12px;
        cursor:pointer;
    }
</style>