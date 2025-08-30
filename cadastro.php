<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Profissional</title>
    <link rel="stylesheet" href="./css/styleCadastro.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="main-container">
        <div class="info-column">
            <h1>Encontre seu lugar no mundo do trabalho</h1>
            <p>O caminho para o seu sucesso profissional começa aqui!</p>
        </div>

        <div class="form-column">
            <form id="regForm" action="validaCadastro.php" method="POST" novalidate>
                
                <div class="progress-indicator">
                    <div class="step active">
                        <span class="step-number">1</span>
                        <span class="step-label">Cadastro</span>
                    </div>
                    <div class="step">
                        <span class="step-number">2</span>
                        <span class="step-label">Dados</span>
                    </div>
                    <div class="step">
                        <span class="step-number">3</span>
                        <span class="step-label">Finalizar</span>
                    </div>
                </div>

                <div class="tab-content">
                    <h2>Informações de Acesso</h2>
                    <div class="input-group-toggle">
                        <span>Sou Colaborador</span>
                        <label class="switch">
                            <input type="checkbox" id="tipoUsuarioToggle">
                            <span class="slider round"></span>
                        </label>
                        <span>Sou Empresa</span>
                    </div>
                    <input type="hidden" name="tipo_usuario" id="tipo_usuario" value="colaborador">
                    <div class="input-group">
                        <label for="nome">Nome</label>
                        <input type="text" placeholder="Digite seu nome" name="nome" required>
                        <span class="error-message"></span>
                    </div>
                    <div class="input-group">
                        <label for="sobrenome">Sobrenome</label>
                        <input type="text" placeholder="Digite seu sobrenome" name="sobrenome" required>
                        <span class="error-message"></span>
                    </div>
                    <div class="input-group">
                        <label for="email">E-mail</label>
                        <input type="email" placeholder="seu.email@exemplo.com" name="email" required>
                        <span class="error-message"></span>
                    </div>
                    <div class="input-group">
                        <label for="senha">Senha</label>
                        <input type="password" placeholder="Crie uma senha forte" name="senha" id="senha" required>
                        <span class="error-message"></span>
                    </div>
                    <div class="input-group">
                        <label for="confirmaSenha">Confirmar Senha</label>
                        <input type="password" placeholder="Confirme sua senha" name="confirmaSenha" required>
                        <span class="error-message"></span>
                    </div>
                </div>

                <div class="tab-content">
                    <h2>Dados Pessoais</h2>
                    <div class="input-group">
                        <label for="cpf">CPF</label>
                        <input type="text" placeholder="000.000.000-00" name="cpf" required>
                        <span class="error-message"></span>
                    </div>
                    <div class="input-group">
                        <label for="dtNascimento">Data de Nascimento</label>
                        <input type="date" name="dtNascimento" required>
                        <span class="error-message"></span>
                    </div>
                    <div class="input-group">
                        <label for="celular">Telefone / Celular</label>
                        <input type="tel" placeholder="(00) 90000-0000" name="celular" required>
                        <span class="error-message"></span>
                    </div>
                </div>

                <div class="tab-content">
                    <div class="final-message">
                        <svg class="success-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                            <circle class="success-icon__circle" cx="26" cy="26" r="25" fill="none"/>
                            <path class="success-icon__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
                        </svg>
                        <h2>Cadastro quase completo!</h2>
                        <p>Agradecemos por se juntar à nossa comunidade. Clique em "Finalizar Cadastro" para completar o processo e começar a explorar as oportunidades.</p>
                    </div>
                </div>

                <div class="navigation-buttons">
                    <button type="button" id="prevBtn">Anterior</button>
                    <button type="button" id="nextBtn">Próximo</button>
                </div>
            </form>
        </div>
    </div>

    <script src="./js/cadastro.js"></script>
</body>
</html>