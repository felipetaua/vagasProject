<?php 
session_start();

// Use a conexão centralizada com o banco de dados
require_once __DIR__ . '/../config/db.php';

// Verifica se o usuário que está visualizando está logado
if (!isset($_SESSION['user_id'])) {
  header("Location: ../login.php");
  exit;
}

// Valida o ID do perfil a ser visualizado
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    // Redireciona ou mostra um erro se o ID for inválido
    header("Location: profissionais.php?error=invalid_id");
    exit;
}
$profileId = (int)$_GET['id'];

// --- LÓGICA PARA CARREGAR DADOS DO CURRÍCULO ---
// Inicializa variáveis
$profileUser = null;
$curriculo = null;
$experiencias = [];
$formacoes = [];

// 1. Busca dados básicos do cadastro (nome, foto)
$stmt_user = $pdo->prepare("SELECT id, nome, sobrenome, foto FROM cadastro WHERE id = ?");
$stmt_user->execute([$profileId]);
$profileUser = $stmt_user->fetch(PDO::FETCH_ASSOC);

if (!$profileUser) {
    header("Location: profissionais.php?error=not_found");
    exit;
}

// 2. Busca o currículo principal
$stmt_curr = $pdo->prepare("SELECT * FROM curriculos WHERE id_cadastro = ?");
$stmt_curr->execute([$profileId]);
$curriculo = $stmt_curr->fetch(PDO::FETCH_ASSOC);

if ($curriculo) {
    // 3. Se o currículo existe, busca experiências e formações
    $stmt_exp = $pdo->prepare("SELECT * FROM curriculo_experiencia WHERE id_curriculo = ? ORDER BY id DESC");
    $stmt_exp->execute([$curriculo['id']]);
    $experiencias = $stmt_exp->fetchAll(PDO::FETCH_ASSOC);

    $stmt_form = $pdo->prepare("SELECT * FROM curriculo_formacao WHERE id_curriculo = ? ORDER BY id DESC");
    $stmt_form->execute([$curriculo['id']]);
    $formacoes = $stmt_form->fetchAll(PDO::FETCH_ASSOC);
}

// Função auxiliar para formatar o endereço de forma limpa
function formatAddress($c) {
    $parts = [];
    if (!empty($c['logradouro'])) $parts[] = $c['logradouro'];
    if (!empty($c['bairro'])) $parts[] = 'Bairro ' . $c['bairro'];
    if (!empty($c['cidade'])) $parts[] = $c['cidade'];
    if (!empty($c['estado'])) $parts[] = $c['estado'];
    return implode(' - ', array_filter($parts));
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <link rel="icon" type="image/png" href="/sistemaDeVagas/imagens/Logo.svg"/>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/sistemaDeVagas/css/header.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <title>Perfil de <?php echo htmlspecialchars($profileUser['nome']); ?></title>
    <style>
        body { background-color: #f0f2f5; font-family: 'Roboto', sans-serif; }
        .cv-container { max-width: 900px; margin: 30px auto; padding: 20px; }
        .cv-page, .no-cv-card { background: white; padding: 40px; box-shadow: 0 0 15px rgba(0,0,0,0.1); border-radius: 8px; }
        .no-cv-card { text-align: center; padding: 50px; }
        .cv-header { text-align: center; border-bottom: 2px solid #eee; padding-bottom: 20px; margin-bottom: 30px; }
        .cv-header .profile-photo { width: 150px; height: 150px; border-radius: 50%; object-fit: cover; margin-bottom: 15px; border: 4px solid #fff; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .cv-header h1 { margin: 0; font-size: 2.5em; font-weight: 700; color: #2c3e50; }
        .cv-header p { margin: 5px 0; font-size: 1em; color: #555; }
        .cv-header .contact-info { font-size: 0.9em; color: #777; }
        .cv-section { margin-bottom: 30px; }
        .cv-section h2 { font-size: 1.5em; color: #34495e; border-bottom: 1px solid #ccc; padding-bottom: 5px; margin-bottom: 20px; font-weight: 500; }
        .cv-item { margin-bottom: 20px; padding-left: 20px; border-left: 3px solid #3498db; }
        .cv-item h3 { margin: 0 0 5px 0; font-size: 1.2em; font-weight: 500; }
        .cv-item .sub-heading { font-weight: bold; color: #555; margin-bottom: 8px; }
        .cv-item p { margin: 0; line-height: 1.6; }
        .profile-actions { text-align: center; margin-top: 40px; }
        .btn-action { background-color: #17a2b8; color: white; padding: 12px 25px; text-decoration: none; border-radius: 5px; display: inline-block; transition: background-color 0.2s; font-size: 1em; }
        .btn-action:hover { background-color: #138496; }
        .basic-info h2 { font-size: 2em; color: #2c3e50; }
        .basic-info .profile-photo { width: 120px; height: 120px; border-radius: 50%; object-fit: cover; margin-bottom: 15px; }
    </style>
</head>
<body>
    <?php 
    // Inclui o cabeçalho reutilizável
    require_once __DIR__ . '/templates/header.php';
    ?>

    <main class="cv-container">
        <?php if ($curriculo): ?>
            <div class="cv-page">
                <header class="cv-header">
                    <?php $foto = !empty($profileUser['foto']) ? '/sistemaDeVagas/authenticated/uploads/' . htmlspecialchars($profileUser['foto']) : 'https://placehold.co/150x150'; ?>
                    <img src="<?php echo $foto; ?>" alt="Foto de <?php echo htmlspecialchars($curriculo['nome_completo']); ?>" class="profile-photo">
                    
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

                <div class="profile-actions">
                    <a href="visualizar_curriculo.php?id=<?php echo $profileId; ?>" target="_blank" class="btn-action">Baixar / Imprimir Currículo</a>
                </div>
            </div>
        <?php else: ?>
            <div class="no-cv-card basic-info">
                <?php $foto = !empty($profileUser['foto']) ? '/sistemaDeVagas/authenticated/uploads/' . htmlspecialchars($profileUser['foto']) : 'https://placehold.co/150x150'; ?>
                <img src="<?php echo $foto; ?>" alt="Foto de <?php echo htmlspecialchars($profileUser['nome']); ?>" class="profile-photo">
                <h2><?php echo htmlspecialchars($profileUser['nome'] . ' ' . $profileUser['sobrenome']); ?></h2>
                <p>Este profissional ainda não preencheu seu currículo na plataforma.</p>
            </div>
        <?php endif; ?>
    </main>

</body>
</html>
