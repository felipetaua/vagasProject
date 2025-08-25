<?php 
session_start(); 

require_once __DIR__ . '/db_connection.php';

// Verifica se o usuário está logado
if (!isset($_SESSION["user_id"])) {
  header("Location: /sistemaDeVagas/login.php");
  exit;
}
$userId = $_SESSION["user_id"];

// Busca os dados do usuário para o cabeçalho
$stmtUser = $conn->prepare("SELECT nome, foto FROM `cadastro` WHERE id = ?");
$stmtUser->bind_param("i", $userId);
$stmtUser->execute();
$resultUser = $stmtUser->get_result();
$user = $resultUser->fetch_assoc();
$stmtUser->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" type="image/png" href="/sistemaDeVagas/imagens/Logo.svg"/>
    <meta charset="UTF-8">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/sistemaDeVagas/css/home.css">
    <link rel="stylesheet" href="/sistemaDeVagas/css/header.css"> <!-- Adicionando CSS do header para consistência -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/65f22fe718.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <title>Home</title>
</head>
<body>
   
<?php include __DIR__ . '/templates/header.php'; ?>
<main>
    <section>
    <h1>Ultimos usuarios</h1>
    <?php 
// Re-using the existing database connection.
$sql = "SELECT c.id as id, c.foto as foto, c.nome as n1, COALESCE(p.nome, 'Profissão não cadastrada') as n2 FROM `cadastro` c
left JOIN `profissao` p
ON c.id_profissao = p.id
ORDER BY c.id DESC"; // Added ORDER BY to show the latest users first, matching the section title.



$result = $conn->query($sql); // This is safe as there's no user input


if ($result->num_rows > 0) {
    
    $count = 0;

   
    while($row = $result->fetch_assoc()) {
        
        if ($count >= 5) {
            break;
        }
         $idcurriculo = $row["id"] ;
        
        echo "<div class='container-vagas'>"."<div class='vagas'>"."<img src='/sistemaDeVagas/uploads/$row[foto]' style='width:50px; height:50px; border-radius:100%;'>"." Nome: " . htmlspecialchars($row["n1"])."<br>" . " Profissão: " . htmlspecialchars($row["n2"]). "<br>"."</div>"."<div class='btn-baixar candidatar' data-id='$idcurriculo' style='cursor:pointer;'>"."<p>Baixar currículo</p>"."</div>"."</div>";

        
        $count++;
    }
} else {
    echo "<div class='not-jobs'>Nenhuma vaga encontrada.</div>";
}


?>
    </section>

<section>
<h1>Ultimas vagas</h1>
<script>
    function baixarCurriculo() {
    var idcurriculo = $(this).data('id');
    window.location.href = "baixar_curriculo.php?id=" + idcurriculo;
}

$('.btn-baixar').on('click', baixarCurriculo);
</script>
<?php

// Re-using the existing database connection.
// The error "Unknown column 'data_cadastro'" happens because this column doesn't exist in your 'vagas' table.
// Assuming 'id' is an auto-incrementing primary key, ordering by 'id DESC'
// is a reliable way to get the most recently created vacancies.
$sql = "SELECT * FROM vagas ORDER BY id DESC";

$result = $conn->query($sql); // This is safe as there's no user input


if ($result->num_rows > 0) {
  
    $count = 0;

   
    while($row = $result->fetch_assoc()) {
        
        if ($count >= 5) {
            break;
        }

       
        echo "<div class='container-vagas'>"."<div class='vagas'>"." Empresa: " . htmlspecialchars($row["empresa"])."<br>" . " Cargo: " . htmlspecialchars($row["cargo"]). "<br>"."</div>"."<div class='candidatar'>"."<p> Candidatar</p>"."</div>"."</div>";

        
        $count++;
    }
} else {
    echo "<div class='not-jobs'>Nenhuma vaga encontrada.</div>";
}

$conn->close();

?>
</section>

</main>

<script>
    // This script is for the dropdown menu in the header.
    // It's better to have this in a shared JS file loaded by the header template.
    const dropdownBtn = document.querySelector('.dropdown-btn');
    const dropdownMenu = document.querySelector('.dropdown-menu');

    if (dropdownBtn && dropdownMenu) {
        dropdownBtn.addEventListener('click', () => {
            dropdownMenu.classList.toggle('show');
        });

        window.addEventListener('click', (event) => {
            if (!dropdownBtn.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.remove('show');
            }
        });
    }
</script>
</body>
</html>
