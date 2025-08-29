<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../assets/images/global/RHconexao-logo.svg" type="image/png">
    <title>Trocar Senha - Conexão RH</title>
    <link rel="stylesheet" href="../../assets/css/pages/login/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script defer src="../../assets/js/pages/login/trocar-senha.js"></script>
</head>
<body>
    <div class="info-section">
        <h1>Segurança em primeiro lugar.</h1>
        <p>Mantenha sua conta segura. Altere sua senha regularmente e use uma combinação forte de caracteres.</p>
    </div>

    <div class="form-section">
        <div class="form-content">
            <h2>Alterar sua senha</h2>
            <p class="subtitle">Para sua segurança, informe sua senha atual antes de criar uma nova.</p>
            
            <div id="message-container" style="display: none; margin-bottom: 1rem; padding: 1rem; border-radius: 8px; text-align: center;"></div>

            <form id="change-password-form">
                <div class="form-group">
                    <label for="current-password">Senha Atual</label>
                    <div class="password-wrapper">
                        <input type="password" id="current-password" name="current-password" placeholder="Digite sua senha atual" required>
                        <span class="toggle-password"><i class="fa-solid fa-eye"></i></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="new-password">Nova Senha</label>
                    <div class="password-wrapper">
                        <input type="password" id="new-password" name="new-password" placeholder="Crie uma nova senha (mín. 8 caracteres)" required>
                        <span class="toggle-password"><i class="fa-solid fa-eye"></i></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="new-password-confirmation">Confirmar Nova Senha</label>
                    <div class="password-wrapper">
                        <input type="password" id="new-password-confirmation" name="new-password-confirmation" placeholder="Confirme a nova senha" required>
                        <span class="toggle-password"><i class="fa-solid fa-eye"></i></span>
                    </div>
                    <div class="error-message" id="password-error">As senhas não coincidem.</div>
                </div>

                <button type="submit" class="submit-btn">Salvar Nova Senha</button>

                <p class="signup-link">
                    Lembrou da senha? <a href="./login.blade.php">Voltar para o login</a>
                </p>
            </form>
        </div>
    </div>
</body>
</html>
