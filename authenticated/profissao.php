<?php 
session_start();

// Use a conexão centralizada e segura
require_once __DIR__ . '/db_connection.php';

// Verifica se o usuário está logado
if (!isset($_SESSION["user_id"])) {
  header("Location: ../login.php");
  exit;
}

$userId = $_SESSION["user_id"];
$updateMessage = '';

// Processa o formulário quando ele é enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lógica para ATUALIZAR a profissão do usuário
    if (isset($_POST["submit"])) {
        $id_profissao = $_POST["id_profissao"];

        // Valida se o id da profissão é um número
        if (is_numeric($id_profissao)) {
            // Atualiza o cadastro do usuário de forma segura com prepared statements
            $sql = "UPDATE cadastro SET id_profissao = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            // "ii" significa que estamos passando dois inteiros (integer)
            $stmt->bind_param("ii", $id_profissao, $userId);
            
            if ($stmt->execute()) {
                $updateMessage = "Profissão atualizada com sucesso!";
            } else {
                $updateMessage = "Erro ao atualizar a profissão: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $updateMessage = "Erro: Profissão inválida selecionada.";
        }
    }

    // Lógica para CRIAR uma nova profissão
    if (isset($_POST["create_profession"])) {
        $new_profession_name = trim($_POST["new_profession_name"]);

        if (!empty($new_profession_name)) {
            // Verifica se a profissão já existe para evitar duplicatas
            $stmt_check = $conn->prepare("SELECT id FROM profissao WHERE nome = ?");
            $stmt_check->bind_param("s", $new_profession_name);
            $stmt_check->execute();
            $stmt_check->store_result();

            if ($stmt_check->num_rows == 0) {
                $stmt_insert = $conn->prepare("INSERT INTO profissao (nome) VALUES (?)");
                $stmt_insert->bind_param("s", $new_profession_name);
                if ($stmt_insert->execute()) {
                    $updateMessage = "Nova profissão '" . htmlspecialchars($new_profession_name) . "' adicionada com sucesso!";
                } else {
                    $updateMessage = "Erro ao adicionar nova profissão: " . $stmt_insert->error;
                }
                $stmt_insert->close();
            } else {
                $updateMessage = "Erro: A profissão '" . htmlspecialchars($new_profession_name) . "' já existe.";
            }
            $stmt_check->close();
        } else {
            $updateMessage = "Erro: O nome da nova profissão não pode ser vazio.";
        }
    }
}

// Busca a lista de profissões para preencher o dropdown
$professions = [];
$sql_professions = "SELECT id, nome FROM profissao ORDER BY nome ASC";
$result_professions = $conn->query($sql_professions);
if ($result_professions->num_rows > 0) {
    while ($row = $result_professions->fetch_assoc()) {
        $professions[] = $row;
    }
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <link rel="icon" type="image/png" href="/sistemaDeVagas/imagens/Logo.svg"/>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/sistemaDeVagas/css/home.css">
  <link rel="stylesheet" href="/sistemaDeVagas/css/header.css">
  <link rel="stylesheet" href="/sistemaDeVagas/css/profissao.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
  <title>Cadastro de Profissão</title>
</head>
<body>
  <?php 
  // Inclui o cabeçalho reutilizável
  require_once __DIR__ . '/templates/header.php';
  ?>
    
  <main class="main-container">
    <h1>Cadastro de Profissão</h1>
    <form method="post" action="profissao.php" class="profession-form">
      <label for="id_profissao">Selecione a sua profissão:</label>
      <select name="id_profissao" id="id_profissao" required>
        <option value="">-- Escolha uma opção --</option>
        <?php foreach ($professions as $profession): ?>
          <option value="<?php echo htmlspecialchars($profession['id']); ?>">
            <?php echo htmlspecialchars($profession['nome']); ?>
          </option>
        <?php endforeach; ?>
      </select>
      <input type="submit" name="submit" value="Salvar Profissão">

    </form>

    <div class="separator"></div>

    <button type="button" id="toggle-add-form-btn">Adicionar Nova Profissão</button>

    <div id="add-profession-container" class="hidden">
        <form method="post" action="profissao.php" class="profession-form">
            <label for="new_profession_name">Nome da Nova Profissão:</label>
            <input type="text" name="new_profession_name" id="new_profession_name" required>
            <input type="submit" name="create_profession" value="Salvar Nova Profissão">
        </form>
    </div>

    <?php if (!empty($updateMessage)): ?>
      <p class="update-message"><?php echo $updateMessage; ?></p>
    <?php endif; ?>
  </main>
  <script>
    document.getElementById('toggle-add-form-btn').addEventListener('click', function() {
        var formContainer = document.getElementById('add-profession-container');
        formContainer.classList.toggle('hidden');
    });
  </script>
</body>
</html>
