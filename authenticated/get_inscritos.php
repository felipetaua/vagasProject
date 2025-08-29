<?php
session_start();
require_once __DIR__ . '/../config/db.php';

// Segurança: Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
    echo json_encode(['error' => 'Acesso negado.']);
    exit;
}

// Validação: Verifica se o ID da vaga foi fornecido
if (!isset($_GET['vaga_id']) || !is_numeric($_GET['vaga_id'])) {
    http_response_code(400);
    echo 'ID da vaga inválido.';
    exit;
}

$vagaId = (int)$_GET['vaga_id'];
$userId = $_SESSION['user_id'];

try {
    // Segurança: Verifica se o usuário logado é o dono da vaga
    $stmt_check = $pdo->prepare("SELECT usuario_responsavel FROM vagas WHERE id = ?");
    $stmt_check->execute([$vagaId]);
    $vaga = $stmt_check->fetch();

    if (!$vaga || $vaga['usuario_responsavel'] != $userId) {
        http_response_code(403);
        echo 'Você não tem permissão para ver os inscritos desta vaga.';
        exit;
    }

    // Busca os profissionais inscritos na vaga
    $sql = "
        SELECT 
            c.id, c.nome, c.sobrenome, c.foto, c.email,
            COALESCE(p.nome, 'Não informada') AS nome_profissao
        FROM inscricoes i
        JOIN cadastro c ON i.id_usuario = c.id
        LEFT JOIN profissao p ON c.id_profissao = p.id
        WHERE i.id_vaga = ? ORDER BY c.nome
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$vagaId]);
    $inscritos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Gera o HTML de resposta
    if (count($inscritos) > 0) {
        foreach ($inscritos as $inscrito) {
            $foto = !empty($inscrito['foto']) ? '/sistemaDeVagas/authenticated/uploads/' . htmlspecialchars($inscrito['foto']) : 'https://placehold.co/80x80';
            echo '
            <a href="perfil_publico.php?id=' . $inscrito['id'] . '" target="_blank" class="inscrito-link">
                <div class="inscrito-item">
                    <img src="' . $foto . '" alt="Foto de ' . htmlspecialchars($inscrito['nome']) . '" class="inscrito-foto">
                    <div class="inscrito-info">
                        <h4>' . htmlspecialchars($inscrito['nome'] . ' ' . $inscrito['sobrenome']) . '</h4>
                        <p>Profissão: ' . htmlspecialchars($inscrito['nome_profissao']) . '</p>
                        <p style="font-size: 0.85em; color: #777;">' . htmlspecialchars($inscrito['email']) . '</p>
                    </div>
                    <span style="margin-left: auto; background-color: #eaf5fc; color: #3498db; padding: 8px 12px; border-radius: 20px; font-size: 0.9em; font-weight: 500; display: inline-flex; align-items: center; white-space: nowrap;" title="Ver Perfil">
                        Ver Perfil
                        <i class="fa-solid fa-arrow-up-right-from-square" style="margin-left: 8px;"></i>
                    </span>
                </div>
            </a>';
        }
    } else {
        echo '<p class="no-inscritos">Nenhum profissional inscrito nesta vaga ainda.</p>';
    }

} catch (PDOException $e) {
    http_response_code(500);
    // Em produção, é melhor logar o erro do que exibi-lo.
    echo 'Erro no servidor ao buscar inscritos.';
}