<?php
session_start();
require_once __DIR__ . '/../config/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: /sistemaDeVagas/login.php');
    exit();
}

$userId = $_SESSION['user_id'];

// --- LÓGICA PARA CARREGAR DADOS ---
$stmt_load = $pdo->prepare("SELECT * FROM curriculos WHERE id_cadastro = ?");
$stmt_load->execute([$userId]);
$curriculo = $stmt_load->fetch(PDO::FETCH_ASSOC);

if (!$curriculo) {
    exit('Nenhum currículo encontrado. Por favor, <a href="criar_curriculo.php">crie um primeiro</a>.');
}

$stmt_exp = $pdo->prepare("SELECT * FROM curriculo_experiencia WHERE id_curriculo = ? ORDER BY id DESC");
$stmt_exp->execute([$curriculo['id']]);
$experiencias = $stmt_exp->fetchAll(PDO::FETCH_ASSOC);

$stmt_form = $pdo->prepare("SELECT * FROM curriculo_formacao WHERE id_curriculo = ? ORDER BY id DESC");
$stmt_form->execute([$curriculo['id']]);
$formacoes = $stmt_form->fetchAll(PDO::FETCH_ASSOC);

// Função auxiliar para formatar o endereço de forma limpa
function formatAddress($c) {
    $parts = [];
    if (!empty($c['logradouro'])) $parts[] = $c['logradouro'];
    if (!empty($c['bairro'])) $parts[] = 'Bairro ' . $c['bairro'];
    if (!empty($c['cidade'])) $parts[] = $c['cidade'];
    if (!empty($c['estado'])) $parts[] = $c['estado'];
    if (!empty($c['cep'])) $parts[] = 'CEP: ' . $c['cep'];
    return implode(' - ', array_filter($parts));
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Currículo de <?php echo htmlspecialchars($curriculo['nome_completo']); ?></title>
    <link rel="stylesheet" href="/sistemaDeVagas/css/curriculo_view.css">
</head>
<body>
    <div class="toolbar no-print">
        <button onclick="window.print()">Baixar como PDF / Imprimir</button>
        <a href="criar_curriculo.php">Voltar para Edição</a>
    </div>

    <div class="page">
        <header class="cv-header">
            <h1><?php echo htmlspecialchars($curriculo['nome_completo']); ?></h1>
            <p>
                <?php
                $personal_info = [];
                if (!empty($curriculo['idade'])) $personal_info[] = htmlspecialchars($curriculo['idade']) . ' anos';
                if (!empty($curriculo['estado_civil'])) $personal_info[] = htmlspecialchars($curriculo['estado_civil']);
                if (!empty($curriculo['nacionalidade'])) $personal_info[] = htmlspecialchars($curriculo['nacionalidade']);
                echo implode(' | ', $personal_info);
                ?>
            </p>
            <p class="contact-info">
                <?php echo htmlspecialchars(formatAddress($curriculo)); ?><br>
                <strong>Telefone:</strong> <?php echo htmlspecialchars($curriculo['telefone']); ?> |
                <strong>Email:</strong> <?php echo htmlspecialchars($curriculo['email']); ?>
                <?php if (!empty($curriculo['cnh']) && $curriculo['cnh'] !== 'Não possuo'): ?>
                    | <strong>CNH:</strong> Categoria <?php echo htmlspecialchars($curriculo['cnh']); ?>
                <?php endif; ?>
            </p>
        </header>

        <section class="cv-section">
            <h2>Resumo Profissional</h2>
            <p><?php echo nl2br(htmlspecialchars($curriculo['resumo'])); ?></p>
        </section>

        <?php if (!empty($experiencias)): ?>
        <section class="cv-section">
            <h2>Experiência Profissional</h2>
            <?php foreach ($experiencias as $exp): ?>
                <div class="cv-item">
                    <h3><?php echo htmlspecialchars($exp['cargo']); ?></h3>
                    <p class="sub-heading"><?php echo htmlspecialchars($exp['empresa']); ?> | <?php echo htmlspecialchars($exp['periodo']); ?></p>
                    <p><?php echo nl2br(htmlspecialchars($exp['descricao'])); ?></p>
                </div>
            <?php endforeach; ?>
        </section>
        <?php endif; ?>

        <?php if (!empty($formacoes)): ?>
        <section class="cv-section">
            <h2>Formação Acadêmica</h2>
            <?php foreach ($formacoes as $form): ?>
                <div class="cv-item">
                    <h3><?php echo htmlspecialchars($form['curso']); ?></h3>
                    <p class="sub-heading"><?php echo htmlspecialchars($form['instituicao']); ?> | <?php echo htmlspecialchars($form['periodo']); ?></p>
                </div>
            <?php endforeach; ?>
        </section>
        <?php endif; ?>

        <?php if (!empty($curriculo['habilidades'])): ?>
        <section class="cv-section">
            <h2>Habilidades</h2>
            <p><?php echo htmlspecialchars($curriculo['habilidades']); ?></p>
        </section>
        <?php endif; ?>
    </div>
</body>
</html>