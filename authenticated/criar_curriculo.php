<?php
session_start();

require_once __DIR__ . '/../config/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: /sistemaDeVagas/login.php');
    exit();
}

// Busca os dados do usuário para exibir no header.
$stmt = $pdo->prepare("SELECT nome, foto FROM cadastro WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

// Lógica para processar o formulário quando enviado (método POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Aqui você implementaria a lógica para salvar os dados do currículo no banco de dados.
    $message = "Currículo salvo com sucesso! (Lógica de salvamento não implementada)";
}

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Currículo - Conexão RH 2.0</title>
    <link rel="stylesheet" href="/sistemaDeVagas/css/style.css">
    <style>
        main {
            display: flex;
            justify-content: center;
            padding: 20px;
        }
        .curriculo-form {
            width: 100%;
            max-width: 800px;
            margin: 20px 0;
            padding: 25px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .curriculo-form h1 {
            text-align: center;
            color: #333;
            margin-bottom: 25px;
        }
        .form-section {
            margin-bottom: 25px;
            border-bottom: 1px solid #eee;
            padding-bottom: 25px;
        }
        .form-section:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 10px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }
        .btn, .btn-submit {
            display: inline-block;
            padding: 10px 15px;
            background-color: #5cb85c;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            text-align: center;
        }
        .btn:hover, .btn-submit:hover {
            background-color: #4cae4c;
        }
        .btn-submit {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            background-color: #007bff;
        }
        .btn-submit:hover {
            background-color: #0069d9;
        }
        .message {
            text-align: center;
            padding: 10px;
            margin-bottom: 20px;
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            border-radius: 4px;
        }
        .dynamic-item {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px dashed #ccc;
        }
    </style>
</head>
<body>

<?php require_once 'templates/header.php'; ?>

<main>
    <div class="curriculo-form">
        <h1>Criar ou Editar seu Currículo</h1>

        <?php if (isset($message)): ?>
            <div class="message"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>

        <form action="criar_curriculo.php" method="POST">
            <div class="form-section">
                <h2>Informações Pessoais</h2>
                <div class="form-group"><label for="nome_completo">Nome Completo</label><input type="text" id="nome_completo" name="nome_completo" required></div>
                <div class="form-group"><label for="email">Email</label><input type="email" id="email" name="email" required></div>
                <div class="form-group"><label for="telefone">Telefone</label><input type="tel" id="telefone" name="telefone" required></div>
                <div class="form-group"><label for="endereco">Endereço (Cidade, Estado)</label><input type="text" id="endereco" name="endereco"></div>
            </div>

            <div class="form-section">
                <h2>Resumo Profissional</h2>
                <div class="form-group"><label for="resumo">Fale um pouco sobre sua carreira e objetivos.</label><textarea id="resumo" name="resumo" rows="5"></textarea></div>
            </div>

            <div class="form-section" id="experiencia-section">
                <h2>Experiência Profissional</h2>
                <!-- JS will add items here -->
                <button type="button" id="add-experiencia" class="btn">Adicionar Experiência</button>
            </div>

            <div class="form-section" id="formacao-section">
                <h2>Formação Acadêmica</h2>
                <!-- JS will add items here -->
                <button type="button" id="add-formacao" class="btn">Adicionar Formação</button>
            </div>

            <div class="form-section">
                <h2>Habilidades</h2>
                <div class="form-group"><label for="habilidades">Liste suas principais habilidades (separadas por vírgula)</label><textarea id="habilidades" name="habilidades" rows="4"></textarea></div>
            </div>

            <button type="submit" class="btn-submit">Salvar Currículo</button>
        </form>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function addDynamicField(sectionId, buttonId, template) {
        let index = 0;
        document.getElementById(buttonId).addEventListener('click', function() {
            const container = document.getElementById(sectionId);
            const newItem = document.createElement('div');
            newItem.classList.add('dynamic-item');
            newItem.innerHTML = template(index);
            this.parentNode.insertBefore(newItem, this);
            index++;
        });
    }

    const experienciaTemplate = index => `
        <div class="form-group"><label>Cargo</label><input type="text" name="experiencia[${index}][cargo]"></div>
        <div class="form-group"><label>Empresa</label><input type="text" name="experiencia[${index}][empresa]"></div>
        <div class="form-group"><label>Período (Ex: Jan 2020 - Dez 2022)</label><input type="text" name="experiencia[${index}][periodo]"></div>
        <div class="form-group"><label>Descrição das atividades</label><textarea name="experiencia[${index}][descricao]"></textarea></div>
    `;

    const formacaoTemplate = index => `
        <div class="form-group"><label>Instituição de Ensino</label><input type="text" name="formacao[${index}][instituicao]"></div>
        <div class="form-group"><label>Curso</label><input type="text" name="formacao[${index}][curso]"></div>
        <div class="form-group"><label>Período (Ex: 2018 - 2022)</label><input type="text" name="formacao[${index}][periodo]"></div>
    `;

    addDynamicField('experiencia-section', 'add-experiencia', experienciaTemplate);
    addDynamicField('formacao-section', 'add-formacao', formacaoTemplate);
});
</script>

</body>
</html>