<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../assets/images/global/RHconexao-logo.svg" type="image/png">
    <title>Esqueci Minha Senha - Conexão RH</title>
    <link rel="stylesheet" href="../../assets/css/pages/login/login.css">
    <script defer src="../../assets/js/pages/login/solicitar-redefinicao.js"></script>
</head>
<body>

    <div class="info-section">
        <h1>Recupere seu acesso.</h1>
        <p>Não se preocupe, acontece! Digite seu e-mail abaixo para receber um link de redefinição de senha.</p>
        <!-- O slider de testemunhos pode ser adicionado aqui se desejar -->
    </div>

    <div class="form-section">
        <div class="form-content">
            <h2>Esqueceu sua senha?</h2>
            <p class="subtitle">Insira seu e-mail e enviaremos um link para você voltar a acessar sua conta.</p>
            
            <div id="message-container" style="display: none; margin-bottom: 1rem; padding: 1rem; border-radius: 8px; text-align: center;"></div>

            <form id="forgot-password-form">
                <div class="form-group">
                    <label for="email">Seu e-mail</label>
                    <input type="email" id="email" name="email" placeholder="Digite o e-mail cadastrado" required>
                </div>
                <button type="submit" class="submit-btn">Enviar Link de Redefinição</button>
            </form>

            <p class="signup-link">
                Lembrou da senha? <a href="./login.blade.php">Voltar para o login</a>
            </p>
        </div>
    </div>
</body>
</html>

