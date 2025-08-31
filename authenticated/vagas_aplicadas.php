<?php
require_once __DIR__ . '../config/auth.php';
require_once __DIR__ . '../config/database.php';

// Apenas colaboradores podem ver esta página
if ($_SESSION['user_type'] !== 'colaborador') {
    header("Location: home.php");
    exit();
}

$userId = $_SESSION['user_id'];

// Consulta para buscar as vagas às quais o usuário se aplicou
$stmt = $pdo->prepare(
    "SELECT 
        v.id, v.cargo, v.empresa, v.localizacao, v.salario,
        DATE_FORMAT(i.data_inscricao, '%d/%m/%Y') as data_inscricao_formatada
     FROM inscricoes i
     JOIN vagas v ON i.id_vaga = v.id
     WHERE i.id_usuario = ?
     ORDER BY i.data_inscricao DESC"
);
$stmt->execute([$userId]);
$vagasAplicadas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minhas Candidaturas - RHConexão</title>
    <link rel="stylesheet" href="../vagas_aplicadas.css">
</head>
<body>
    <?php require_once 'authenticated/templates/header.php'; ?>

    <main class="main-content">
        <div class="container">
            <h1 class="page-title">Minhas Candidaturas</h1>
            <p class="page-description">Acompanhe aqui o histórico de todas as vagas para as quais você se candidatou.</p>

            <div class="applications-list">
                <?php if (empty($vagasAplicadas)): ?>
                    <div class="no-applications">
                        <img src="../assets/images/illustrations/no-data.svg" alt="Nenhuma candidatura encontrada" class="no-applications-img">
                        <h2>Nenhuma candidatura encontrada.</h2>
                        <p>Você ainda não se aplicou para nenhuma vaga. Que tal começar agora?</p>
                        <a href="ultimasVagas.php" class="btn btn-primary">Buscar Vagas</a>
                    </div>
                <?php else: ?>
                    <?php foreach ($vagasAplicadas as $vaga): ?>
                        <div class="application-card">
                            <div class="card-header">
                                <h3 class="job-title"><?php echo htmlspecialchars($vaga['cargo']); ?></h3>
                                <span class="application-date">Candidatura em: <?php echo htmlspecialchars($vaga['data_inscricao_formatada']); ?></span>
                            </div>
                            <div class="card-body">
                                <p class="company-name"><i class="fas fa-building"></i> <?php echo htmlspecialchars($vaga['empresa']); ?></p>
                                <p class="location"><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($vaga['localizacao']); ?></p>
                                <p class="salary">
                                    <i class="fas fa-dollar-sign"></i> 
                                    <?php echo ($vaga['salario'] > 0) ? 'R$ ' . number_format($vaga['salario'], 2, ',', '.') : 'Salário a combinar'; ?>
                                </p>
                            </div>
                            <div class="card-footer">
                                <a href="detalhe_vaga.php?id=<?php echo $vaga['id']; ?>" class="btn btn-secondary">Ver Detalhes da Vaga</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <?php // require_once 'templates/footer.php'; // Se você tiver um rodapé, inclua-o aqui ?>
</body>
</html>

