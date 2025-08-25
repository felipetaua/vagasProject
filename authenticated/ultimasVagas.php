<?php 
session_start();

// Centralized database connection
// Use __DIR__ to create a robust, absolute path to the connection file.
require_once __DIR__ . '/db_connection.php';

// Verifica se o usuário está logado
if (!isset($_SESSION["user_id"])) {
  header("Location: ../login.php");
  exit;
}
$userId = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <link rel="icon" type="image/png" href="../imagens/Logo.svg"/>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/ultimasVagas.css">
    <link rel="stylesheet" href="../css/home.css">
    <!-- <link rel="stylesheet" href="../css/header.css"> -->
    <script src="../js/modal.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <title>Vagas</title>
</head>
<body>
    <?php 
    // Include the reusable header template
    require_once __DIR__ . '/templates/header.php';
    ?>

    <h1>Conheça nossas vagas</h1>
    <p>Vagas</p>
    <form method="get" action="">
        <input type="text" placeholder="Digite a vaga que busca..." name='vagas'>
        <input type="submit" value="Buscar" name='buscar'>
    </form>
    <main class="container">
    <?php
    // --- LÓGICA REATORADA PARA BUSCA DE VAGAS ---
    
    $params = [];
    $types = "";
    
    $sql = "SELECT v.id, v.empresa, v.cargo, 
                   (SELECT COUNT(*) FROM inscricoes i WHERE i.id_vaga = v.id) as total_inscritos,
                   (SELECT COUNT(*) FROM inscricoes i WHERE i.id_vaga = v.id AND i.id_usuario = ?) as ja_inscrito
            FROM vagas v 
            WHERE v.usuario_responsavel != ?";
    
    $params[] = $userId;
    $params[] = $userId;
    $types = "ii";
    
    if (!empty($_GET['vagas'])) {
        $sql .= " AND v.cargo LIKE ?";
        $searchTerm = "%" . $_GET['vagas'] . "%";
        $params[] = $searchTerm;
        $types .= "s";
    }
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='results'>";
            echo "<div><span>Empresa</span> - " . htmlspecialchars($row["empresa"]) . "</div>";
            echo "<div><span>Cargo</span> -  " . htmlspecialchars($row["cargo"]) . "</div>";
            echo "<div><span>Total de inscritos</span> - " . $row["total_inscritos"] . "</div>";
            echo "<div class='btns'>";
            
            if ($row['ja_inscrito'] > 0) {
                echo "<span style='color:green; font-weight:600;'>Inscrito</span><br>";
            } else {
                echo "<a href='inscrever.php?vaga=" . $row["id"] . "'><button class='candidatar'>Candidatar</button></a> ";
            }
            
            echo "<button class='visualizar' data-id='" . $row["id"] . "'>Visualizar</button>";
            echo "</div></div>";
        }
    } else {
        echo "<p class='not-result'>Nenhuma vaga encontrada.</p>";
    }
    
    $stmt->close();
    $conn->close();
    ?>
    </main>

    <!-- Modal Structure -->
    <div id="vagaModal" class="modal">
      <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h2>Detalhes da Vaga</h2>
        <div id="modal-body">
          <!-- AJAX content will be loaded here -->
          <p>Carregando...</p>
        </div>
      </div>
    </div>

</body>
</html>
<style>
.modal {
  display: none; 
  position: fixed; 
  z-index: 1000; 
  left: 0;
  top: 0;
  width: 100%; 
  height: 100%; 
  overflow: auto; 
  background-color: rgba(0,0,0,0.6);
  padding-top: 60px;
}

.modal-content {
  background-color: #fefefe;
  margin: 5% auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
  max-width: 600px;
  border-radius: 8px;
  position: relative;
  color: #333; 
}

.close-btn {
  color: #aaa;
  position: absolute;
  top: 10px;
  right: 25px;
  font-size: 35px;
  font-weight: bold;
}

.close-btn:hover,
.close-btn:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}

#modal-body h3 { color: #033f63; }
#modal-body p { line-height: 1.6; }
#modal-body span { font-weight: bold; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // --- Lógica do Menu Dropdown (Melhorada) ---
    const dropdownBtn = document.querySelector('.dropdown-btn');
    const dropdownMenu = document.querySelector('.dropdown-menu');

    if (dropdownBtn && dropdownMenu) {
        dropdownBtn.addEventListener('click', (event) => {
            event.stopPropagation(); // Impede que o evento de clique na janela feche o menu imediatamente
            dropdownMenu.classList.toggle('show');
        });

        window.addEventListener('click', (event) => {
            if (!dropdownBtn.contains(event.target)) {
                dropdownMenu.classList.remove('show');
            }
        });
    }

    // --- Lógica do Modal para Detalhes da Vaga ---
    const modal = document.getElementById("vagaModal");
    const modalBody = document.getElementById("modal-body");
    const closeBtn = document.querySelector(".modal .close-btn");
    const viewButtons = document.querySelectorAll(".visualizar");

    viewButtons.forEach(button => {
        button.addEventListener("click", function() {
            const vagaId = this.getAttribute("data-id");
            modalBody.innerHTML = "<p>Carregando...</p>";
            modal.style.display = "block";

            fetch(`get_vaga_details.php?id=${vagaId}`)
                .then(response => response.text())
                .then(data => {
                    modalBody.innerHTML = data;
                })
                .catch(error => {
                    modalBody.innerHTML = "<p>Ocorreu um erro ao carregar os detalhes da vaga.</p>";
                    console.error('Erro:', error);
                });
        });
    });

    closeBtn.onclick = () => modal.style.display = "none";

    window.onclick = (event) => {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
});
</script>