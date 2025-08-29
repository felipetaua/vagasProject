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

$userId = $_SESSION['user_id'];
$message = null;

// --- LÓGICA PARA CARREGAR DADOS EXISTENTES ---
// Inicializa variáveis para os dados do currículo
$curriculo_data = [];
$experiencias_data = [];
$formacoes_data = [];

// Busca os dados do currículo existente para preencher o formulário
$stmt_load = $pdo->prepare("SELECT * FROM curriculos WHERE id_cadastro = ?");
$stmt_load->execute([$userId]);
$curriculo_data = $stmt_load->fetch(PDO::FETCH_ASSOC) ?: [];

if (!empty($curriculo_data)) {
    // Se o currículo principal existe, busca as experiências e formações
    $stmt_exp = $pdo->prepare("SELECT * FROM curriculo_experiencia WHERE id_curriculo = ?");
    $stmt_exp->execute([$curriculo_data['id']]);
    $experiencias_data = $stmt_exp->fetchAll(PDO::FETCH_ASSOC);

    $stmt_form = $pdo->prepare("SELECT * FROM curriculo_formacao WHERE id_curriculo = ?");
    $stmt_form->execute([$curriculo_data['id']]);
    $formacoes_data = $stmt_form->fetchAll(PDO::FETCH_ASSOC);
}

// Lógica para processar o formulário quando enviado (método POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['user_id'];
    $pessoal = $_POST['pessoal'] ?? [];
    $endereco = $_POST['endereco'] ?? [];
    $resumo = $_POST['resumo'] ?? '';
    $habilidades = $_POST['habilidades'] ?? '';
    $experiencias = $_POST['experiencia'] ?? [];
    $formacoes = $_POST['formacao'] ?? [];

    // Inicia a transação para garantir a integridade dos dados
    $pdo->beginTransaction();

    try {
        // 1. VERIFICAR SE O CURRÍCULO JÁ EXISTE (LÓGICA DE UPDATE OU INSERT)
        $stmt = $pdo->prepare("SELECT id FROM curriculos WHERE id_cadastro = ?");
        $stmt->execute([$userId]);
        $curriculo = $stmt->fetch();

        if ($curriculo) {
            // UPDATE: Currículo já existe, então atualizamos
            $curriculoId = $curriculo['id'];
            $sql = "UPDATE curriculos SET nome_completo = ?, email = ?, telefone = ?, idade = ?, estado_civil = ?, nacionalidade = ?, cnh = ?, cep = ?, logradouro = ?, bairro = ?, cidade = ?, estado = ?, resumo = ?, habilidades = ? WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                $pessoal['nome_completo'], $pessoal['email'], $pessoal['telefone'], $pessoal['idade'], $pessoal['estado_civil'], $pessoal['nacionalidade'], $pessoal['cnh'],
                $endereco['cep'], $endereco['logradouro'], $endereco['bairro'], $endereco['cidade'], $endereco['estado'],
                $resumo, $habilidades, $curriculoId
            ]);
        } else {
            // INSERT: Currículo não existe, então criamos um novo
            $sql = "INSERT INTO curriculos (id_cadastro, nome_completo, email, telefone, idade, estado_civil, nacionalidade, cnh, cep, logradouro, bairro, cidade, estado, resumo, habilidades) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                $userId, $pessoal['nome_completo'], $pessoal['email'], $pessoal['telefone'], $pessoal['idade'], $pessoal['estado_civil'], $pessoal['nacionalidade'], $pessoal['cnh'],
                $endereco['cep'], $endereco['logradouro'], $endereco['bairro'], $endereco['cidade'], $endereco['estado'],
                $resumo, $habilidades
            ]);
            $curriculoId = $pdo->lastInsertId();
        }

        // 2. PROCESSAR EXPERIÊNCIAS (APAGAR E REINSERIR)
        // Primeiro, apaga todas as experiências antigas associadas a este currículo
        $stmt = $pdo->prepare("DELETE FROM curriculo_experiencia WHERE id_curriculo = ?");
        $stmt->execute([$curriculoId]);

        // Depois, insere as novas experiências enviadas pelo formulário
        if (!empty($experiencias)) {
            $sql = "INSERT INTO curriculo_experiencia (id_curriculo, cargo, empresa, periodo, descricao) VALUES (?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            foreach ($experiencias as $exp) {
                $stmt->execute([$curriculoId, $exp['cargo'], $exp['empresa'], $exp['periodo'], $exp['descricao']]);
            }
        }

        // 3. PROCESSAR FORMAÇÕES (APAGAR E REINSERIR)
        // Primeiro, apaga todas as formações antigas
        $stmt = $pdo->prepare("DELETE FROM curriculo_formacao WHERE id_curriculo = ?");
        $stmt->execute([$curriculoId]);

        // Depois, insere as novas formações
        if (!empty($formacoes)) {
            $sql = "INSERT INTO curriculo_formacao (id_curriculo, instituicao, curso, periodo) VALUES (?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            foreach ($formacoes as $form) {
                $stmt->execute([$curriculoId, $form['instituicao'], $form['curso'], $form['periodo']]);
            }
        }

        // Se tudo deu certo, confirma as alterações no banco de dados
        $pdo->commit();
        $message = "Currículo salvo com sucesso!";
    } catch (Exception $e) {
        // Se algo deu errado, desfaz todas as alterações
        $pdo->rollBack();
        $message = "Erro ao salvar o currículo: " . $e->getMessage();
    }
}

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Currículo - Conexão RH 2.0</title>
    <link rel="stylesheet" href="/sistemaDeVagas/css/criarCurriculo.css">
    <link rel="stylesheet" href="/sistemaDeVagas/css/header.css">
</head>
<body>

<?php require_once 'templates/header.php'; ?>

<main>
    <div class="curriculo-form">
        <h1>Criar ou Editar seu Currículo</h1>

        <?php if ($message): ?>
            <div class="message"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>

        <form action="criar_curriculo.php" method="POST">
            <div class="form-section">
                <h2>Informações Pessoais</h2>
                <div class="form-group"><label for="nome_completo">Nome Completo</label><input type="text" id="nome_completo" name="pessoal[nome_completo]" value="<?php echo htmlspecialchars($curriculo_data['nome_completo'] ?? ''); ?>" required></div>
                <div class="form-group"><label for="email">Email</label><input type="email" id="email" name="pessoal[email]" value="<?php echo htmlspecialchars($curriculo_data['email'] ?? ''); ?>" required></div>
                <div class="form-group"><label for="telefone">Telefone</label><input type="tel" id="telefone" name="pessoal[telefone]" value="<?php echo htmlspecialchars($curriculo_data['telefone'] ?? ''); ?>" required></div>
                <div class="form-group"><label for="idade">Idade</label><input type="number" id="idade" name="pessoal[idade]" value="<?php echo htmlspecialchars($curriculo_data['idade'] ?? ''); ?>"></div>
                <div class="form-group">
                    <label for="estado_civil">Estado Civil</label>
                    <select id="estado_civil" name="pessoal[estado_civil]">
                        <option value="">Selecione...</option>
                        <option value="Solteiro(a)" <?php echo (($curriculo_data['estado_civil'] ?? '') === 'Solteiro(a)') ? 'selected' : ''; ?>>Solteiro(a)</option>
                        <option value="Casado(a)" <?php echo (($curriculo_data['estado_civil'] ?? '') === 'Casado(a)') ? 'selected' : ''; ?>>Casado(a)</option>
                        <option value="Divorciado(a)" <?php echo (($curriculo_data['estado_civil'] ?? '') === 'Divorciado(a)') ? 'selected' : ''; ?>>Divorciado(a)</option>
                        <option value="Viúvo(a)" <?php echo (($curriculo_data['estado_civil'] ?? '') === 'Viúvo(a)') ? 'selected' : ''; ?>>Viúvo(a)</option>
                        <option value="União Estável" <?php echo (($curriculo_data['estado_civil'] ?? '') === 'União Estável') ? 'selected' : ''; ?>>União Estável</option>
                    </select>
                </div>
                <div class="form-group"><label for="nacionalidade">Nacionalidade</label><input type="text" id="nacionalidade" name="pessoal[nacionalidade]" value="<?php echo htmlspecialchars($curriculo_data['nacionalidade'] ?? 'Brasileiro(a)'); ?>"></div>
                <div class="form-group">
                    <label for="cnh">CNH</label>
                    <select id="cnh" name="pessoal[cnh]">
                        <option value="">Selecione...</option>
                        <option value="Não possuo" <?php echo (($curriculo_data['cnh'] ?? '') === 'Não possuo') ? 'selected' : ''; ?>>Não possuo</option>
                        <option value="A" <?php echo (($curriculo_data['cnh'] ?? '') === 'A') ? 'selected' : ''; ?>>Categoria A</option>
                        <option value="B" <?php echo (($curriculo_data['cnh'] ?? '') === 'B') ? 'selected' : ''; ?>>Categoria B</option>
                        <option value="AB" <?php echo (($curriculo_data['cnh'] ?? '') === 'AB') ? 'selected' : ''; ?>>Categoria A+B</option>
                        <option value="C" <?php echo (($curriculo_data['cnh'] ?? '') === 'C') ? 'selected' : ''; ?>>Categoria C</option>
                        <option value="D" <?php echo (($curriculo_data['cnh'] ?? '') === 'D') ? 'selected' : ''; ?>>Categoria D</option>
                        <option value="E" <?php echo (($curriculo_data['cnh'] ?? '') === 'E') ? 'selected' : ''; ?>>Categoria E</option>
                    </select>
                </div>

                <fieldset class="address-fieldset">
                    <legend>Endereço</legend>
                    <div class="form-group"><label for="cep">CEP</label><input type="text" id="cep" name="endereco[cep]" value="<?php echo htmlspecialchars($curriculo_data['cep'] ?? ''); ?>"></div>
                    <div class="form-group"><label for="endereco_residencial">Endereço Residencial (Rua, Av, Nº)</label><input type="text" id="endereco_residencial" name="endereco[logradouro]" value="<?php echo htmlspecialchars($curriculo_data['logradouro'] ?? ''); ?>"></div>
                    <div class="form-group"><label for="bairro">Bairro</label><input type="text" id="bairro" name="endereco[bairro]" value="<?php echo htmlspecialchars($curriculo_data['bairro'] ?? ''); ?>"></div>
                    <div class="form-group"><label for="cidade">Cidade</label><input type="text" id="cidade" name="endereco[cidade]" value="<?php echo htmlspecialchars($curriculo_data['cidade'] ?? ''); ?>"></div>
                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <select id="estado" name="endereco[estado]">
                            <option value="">Selecione o Estado</option>
                            <?php $estados = ['AC'=>'Acre', 'AL'=>'Alagoas', 'AP'=>'Amapá', 'AM'=>'Amazonas', 'BA'=>'Bahia', 'CE'=>'Ceará', 'DF'=>'Distrito Federal', 'ES'=>'Espírito Santo', 'GO'=>'Goiás', 'MA'=>'Maranhão', 'MT'=>'Mato Grosso', 'MS'=>'Mato Grosso do Sul', 'MG'=>'Minas Gerais', 'PA'=>'Pará', 'PB'=>'Paraíba', 'PR'=>'Paraná', 'PE'=>'Pernambuco', 'PI'=>'Piauí', 'RJ'=>'Rio de Janeiro', 'RN'=>'Rio Grande do Norte', 'RS'=>'Rio Grande do Sul', 'RO'=>'Rondônia', 'RR'=>'Roraima', 'SC'=>'Santa Catarina', 'SP'=>'São Paulo', 'SE'=>'Sergipe', 'TO'=>'Tocantins']; ?>
                            <?php foreach ($estados as $sigla => $nome): ?>
                                <option value="<?php echo $sigla; ?>" <?php echo (($curriculo_data['estado'] ?? '') === $sigla) ? 'selected' : ''; ?>><?php echo $nome; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </fieldset>
            </div>

            <div class="form-section">
                <h2>Resumo Profissional</h2>
                <div class="form-group"><label for="resumo">Fale um pouco sobre sua carreira e objetivos.</label><textarea id="resumo" name="resumo" rows="5"><?php echo htmlspecialchars($curriculo_data['resumo'] ?? ''); ?></textarea></div>
            </div>

            <div class="form-section" id="experiencia-section">
                <h2>Experiência Profissional</h2>
                <?php foreach ($experiencias_data as $index => $exp): ?>
                    <div class="dynamic-item">
                        <div class="form-group"><label>Cargo</label><input type="text" name="experiencia[<?php echo $index; ?>][cargo]" value="<?php echo htmlspecialchars($exp['cargo'] ?? ''); ?>"></div>
                        <div class="form-group"><label>Empresa</label><input type="text" name="experiencia[<?php echo $index; ?>][empresa]" value="<?php echo htmlspecialchars($exp['empresa'] ?? ''); ?>"></div>
                        <div class="form-group"><label>Período (Ex: Jan 2020 - Dez 2022)</label><input type="text" name="experiencia[<?php echo $index; ?>][periodo]" value="<?php echo htmlspecialchars($exp['periodo'] ?? ''); ?>"></div>
                        <div class="form-group"><label>Descrição das atividades</label><textarea name="experiencia[<?php echo $index; ?>][descricao]"><?php echo htmlspecialchars($exp['descricao'] ?? ''); ?></textarea></div>
                        <button type="button" class="btn-remove">Remover Experiência</button>
                    </div>
                <?php endforeach; ?>
                <button type="button" id="add-experiencia" class="btn">Adicionar Experiência</button>
            </div>

            <div class="form-section" id="formacao-section">
                <h2>Formação Acadêmica</h2>
                <?php foreach ($formacoes_data as $index => $form): ?>
                    <div class="dynamic-item">
                        <div class="form-group"><label>Instituição de Ensino</label><input type="text" name="formacao[<?php echo $index; ?>][instituicao]" value="<?php echo htmlspecialchars($form['instituicao'] ?? ''); ?>"></div>
                        <div class="form-group"><label>Curso</label><input type="text" name="formacao[<?php echo $index; ?>][curso]" value="<?php echo htmlspecialchars($form['curso'] ?? ''); ?>"></div>
                        <div class="form-group"><label>Período (Ex: 2018 - 2022)</label><input type="text" name="formacao[<?php echo $index; ?>][periodo]" value="<?php echo htmlspecialchars($form['periodo'] ?? ''); ?>"></div>
                        <button type="button" class="btn-remove">Remover Formação</button>
                    </div>
                <?php endforeach; ?>
                <button type="button" id="add-formacao" class="btn">Adicionar Formação</button>
            </div>

            <div class="form-section">
                <h2>Habilidades</h2>
                <div class="form-group"><label for="habilidades">Liste suas principais habilidades (separadas por vírgula)</label><textarea id="habilidades" name="habilidades" rows="4"><?php echo htmlspecialchars($curriculo_data['habilidades'] ?? ''); ?></textarea></div>
            </div>

            <button type="submit" class="btn-submit">Salvar Currículo</button>
        </form>

        <?php if (!empty($curriculo_data)): ?>
            <a href="visualizar_curriculo.php" target="_blank" class="btn-view">Visualizar / Baixar Currículo</a>
        <?php endif; ?>

    </div>
</main>
<script>
    // Passa o número de itens existentes para o JavaScript para evitar conflito de índices
    const initialExperienciaCount = <?php echo count($experiencias_data); ?>;
    const initialFormacaoCount = <?php echo count($formacoes_data); ?>;
</script>
<script src="/sistemaDeVagas/js/criarCurriculo.js"></script>
</body>
</html>