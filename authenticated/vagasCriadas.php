
<?php 
session_start();

// 1. Conexão com o banco de dados (uma única vez)
require_once __DIR__ . '/db_connection.php';

// 2. Verifica se o usuário está logado
if (!isset($_SESSION["user_id"])) {
  header("Location: /sistemaDeVagas/login.php");
  exit;
}
$userId = $_SESSION["user_id"];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="/sistemaDeVagas/css/home.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <title>Minhas vagas</title>
</head>
<body>
    <?php
    // 3. Busca os dados do usuário para o cabeçalho de forma segura
    $stmt = $conn->prepare("SELECT nome, foto FROM `cadastro` WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $resultUser = $stmt->get_result();
    $user = $resultUser->fetch_assoc();
    $stmt->close();
    include __DIR__ . '/templates/header.php';
?>
<h1>Vagas publicadas por mim</h1>
<section>
<?php
// 4. Busca as vagas criadas pelo usuário de forma segura
$sql = "SELECT id, empresa, cargo FROM vagas WHERE usuario_responsavel = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$resultVagas = $stmt->get_result();

if ($resultVagas->num_rows > 0) {
    while ($vaga = $resultVagas->fetch_assoc()) {
        echo "<div class='vagas-vinculadas'>";
        echo "<p>Empresa: " . htmlspecialchars($vaga["empresa"]) . "</p>";
        echo "<p>Cargo: " . htmlspecialchars($vaga["cargo"]) ."</p>";
        
        echo '<div class="container-ver-usuarios">';
        // O modal usa o ID da vaga para buscar os inscritos
        echo '<button class="btn-open-modal" onclick="openModal(' . $vaga["id"] . ')">Inscritos</button>';
        echo '<button class="btn-encerrar-vaga" onclick="deleteVaga(' . $vaga["id"] . ')">Encerrar vaga</button>';
        echo '</div>';
        
        echo "</div>";
    }
} else {
    echo "<p style='color: white; width: 100%;'>Nenhuma vaga encontrada.</p>";
}

$stmt->close();
$conn->close();
?>


</section>
</body>
</html>

<!-- Adicione este código HTML no local apropriado da sua página para exibir o modal -->
<div id="modal" style="display: none;">
    <div class="modal-content">
        
        <div class='container-button'><button  onclick="closeModal()" class='close-modal'>X</button></div>
        <h3>Profissionais inscritos na vaga</h3>
        <ul id="usuarios-vinculados"></ul>
    </div>
</div>


<script>
    // Função para abrir o modal e carregar os usuários vinculados à vaga
    function openModal(vagaId) {
        // Aqui você pode usar o ID da vaga para fazer uma nova consulta e obter os usuários vinculados
        // Substitua esta chamada AJAX pelo código necessário para obter os usuários
        
        // Exemplo de chamada AJAX com jQuery
        $.ajax({
            url: 'usuarios_vinculados.php',
            type: 'GET',
            data: { vagaId: vagaId },
            success: function(response) {
                // Insira os usuários vinculados no modal
                $('#usuarios-vinculados').html(response);
                
                // Abra o modal
                $('#modal').fadeIn('fast');
            },
            error: function() {
                alert('Erro ao obter os usuários vinculados.');
            }
        });
    }

    function closeModal() {
    $('#modal').fadeOut('fast');
}

function deleteVaga(vagaId) {
    // Enviar solicitação AJAX para excluir a vaga
    $.ajax({
        url: 'excluirVaga.php',
        type: 'POST',
        data: { vagaId: vagaId },
        success: function(response) {
            // Processar a resposta do servidor
            console.log(response);
            alert('Vaga finalizada com sucesso!')
            
            // Atualizar a página
            location.reload();
        },
        error: function(xhr, status, error) {
            // Lidar com erros da solicitação AJAX
            console.error(xhr.responseText);
        }
    });
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
    
    html{font-family:Roboto;}

    h1{text-align:center;}
    body{
    font-family: Roboto;
    background-color: #033f63;;
    
}

body h1{
    text-align: center;
    color: white;
}

body p{
    text-align: center;


}
    section{display:flex; flex-wrap:wrap;
    align-items:center;}

    .vagas-vinculadas{
    width: 240px;
    margin:12px;
    height: 120px;
    padding: 20px;
    background-color: rgb(235 234 234);
    backdrop-filter: blur(10px);
    border-radius:5px;

    }

    .container-ver-usuarios{
        display:flex;
        justify-content:center;
        align-items:center;
        padding:10px;
    }

    .btn-open-modal{
        background:transparent;
        color:blue;
        border:none;
        font-size:14px;margin-right:5px;
        font-weight:600;
        cursor:pointer;
    }
 #modal {border-radius:5px;
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 1100px;
            max-height: 800px;
            padding: 15px;
            background-color: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            overflow: auto; /* Adicionando a barra de rolagem */
        }

.modal-content {
    
    padding: 20px;
    border-radius: 5px;
    min-width: 80%;
}

.close-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    cursor: pointer;
    font-size: 24px;
    color: #888;
}
ul{
    
    display: flex;
    align-items: center;
    flex-wrap:wrap;
    align-content:flex-start;

}
h3{text-align:center;}

.userVaga{
    width: 300px;
    margin:10px;
    height: 100px;
    padding: 20px;
    background-color: rgba(255, 255, 255, 5.8);
    backdrop-filter: blur(10px);
    border-radius:5px;´
    display:flex;
    flex-direction:column;
    justify-content:center;
    text-align:center;
}
 .userVaga a{
    list-style:none;
    text-decoration:none;
    color:green;
 }

 .close-modal{
    background:transparent;
    color:red;
    border:none;
    font-size:26px;
    cursor:pointer;
    font-weight:600;
 }

 .container-button{
    display:flex;
    justify-content:flex-end;
 }

 .btn-encerrar-vaga{
    color:red;
    background:transparent;
    border:none;
    margin-left:5px;
    font-size:14px;
    font-weight:600;
    cursor:pointer;
 }
</style>