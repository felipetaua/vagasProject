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

        <?php if (isset($message)): ?>
            <div class="message"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>

        <form action="criar_curriculo.php" method="POST">
            <div class="form-section">
                <h2>Informações Pessoais</h2>
                <div class="form-group"><label for="nome_completo">Nome Completo</label><input type="text" id="nome_completo" name="pessoal[nome_completo]" required></div>
                <div class="form-group"><label for="email">Email</label><input type="email" id="email" name="pessoal[email]" required></div>
                <div class="form-group"><label for="telefone">Telefone</label><input type="tel" id="telefone" name="pessoal[telefone]" required></div>
                <div class="form-group"><label for="idade">Idade</label><input type="number" id="idade" name="pessoal[idade]"></div>
                <div class="form-group">
                    <label for="estado_civil">Estado Civil</label>
                    <select id="estado_civil" name="pessoal[estado_civil]">
                        <option value="">Selecione...</option>
                        <option value="Solteiro(a)">Solteiro(a)</option>
                        <option value="Casado(a)">Casado(a)</option>
                        <option value="Divorciado(a)">Divorciado(a)</option>
                        <option value="Viúvo(a)">Viúvo(a)</option>
                        <option value="União Estável">União Estável</option>
                    </select>
                </div>
                <div class="form-group"><label for="nacionalidade">Nacionalidade</label><input type="text" id="nacionalidade" name="pessoal[nacionalidade]" value="Brasileiro(a)"></div>
                <div class="form-group">
                    <label for="cnh">CNH</label>
                    <select id="cnh" name="pessoal[cnh]">
                        <option value="">Selecione...</option>
                        <option value="Não possuo">Não possuo</option>
                        <option value="A">Categoria A</option>
                        <option value="B">Categoria B</option>
                        <option value="AB">Categoria A+B</option>
                        <option value="C">Categoria C</option>
                        <option value="D">Categoria D</option>
                        <option value="E">Categoria E</option>
                    </select>
                </div>

                <fieldset class="address-fieldset">
                    <legend>Endereço</legend>
                    <div class="form-group"><label for="cep">CEP</label><input type="text" id="cep" name="endereco[cep]"></div>
                    <div class="form-group"><label for="endereco_residencial">Endereço Residencial (Rua, Av, Nº)</label><input type="text" id="endereco_residencial" name="endereco[logradouro]"></div>
                    <div class="form-group"><label for="bairro">Bairro</label><input type="text" id="bairro" name="endereco[bairro]"></div>
                    <div class="form-group"><label for="cidade">Cidade</label><input type="text" id="cidade" name="endereco[cidade]"></div>
                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <select id="estado" name="endereco[estado]">
                            <option value="">Selecione o Estado</option>
                            <option value="AC">Acre</option>
                            <option value="AL">Alagoas</option>
                            <option value="AP">Amapá</option>
                            <option value="AM">Amazonas</option>
                            <option value="BA">Bahia</option>
                            <option value="CE">Ceará</option>
                            <option value="DF">Distrito Federal</option>
                            <option value="ES">Espírito Santo</option>
                            <option value="GO">Goiás</option>
                            <option value="MA">Maranhão</option>
                            <option value="MT">Mato Grosso</option>
                            <option value="MS">Mato Grosso do Sul</option>
                            <option value="MG">Minas Gerais</option>
                            <option value="PA">Pará</option>
                            <option value="PB">Paraíba</option>
                            <option value="PR">Paraná</option>
                            <option value="PE">Pernambuco</option>
                            <option value="PI">Piauí</option>
                            <option value="RJ">Rio de Janeiro</option>
                            <option value="RN">Rio Grande do Norte</option>
                            <option value="RS">Rio Grande do Sul</option>
                            <option value="RO">Rondônia</option>
                            <option value="RR">Roraima</option>
                            <option value="SC">Santa Catarina</option>
                            <option value="SP">São Paulo</option>
                            <option value="SE">Sergipe</option>
                            <option value="TO">Tocantins</option>
                        </select>
                    </div>
                </fieldset>
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
<script src="/sistemaDeVagas/js/criarCurriculo.js"></script>
</body>
</html>