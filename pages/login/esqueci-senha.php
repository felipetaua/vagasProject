<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../assets/images/global/RHconexao-logo.svg" type="image/png">
    <title>Redefinir Senha - Conexão RH</title>
    <link rel="stylesheet" href="../../assets/css/pages/login/login.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script defer src="../../assets/js/pages/login/esqueci-senha.js"></script>
</head>
<body>

    <div class="info-section">
        <div class="logo">CONEXÃO RH</div>
        <h1>Crie uma nova senha</h1>
        <p>Sua segurança é nossa prioridade. Escolha uma senha forte para proteger sua conta.</p>

        <div class="testimonial-slider">
            <div class="testimonial-card" id="testimonialCard">
                <p>"A melhor plataforma para gestão de talentos que já utilizei. Simples, rápida e com resultados incríveis."</p>
                <div class="testimonial-author">
                    <span>Marcos Andrade, CEO</span>
                    <span class="stars">★★★★★</span>
                </div>
            </div>
            <div class="testimonial-progress">
                <div class="testimonial-progress-bar" id="testimonialProgressBar"></div>
            </div>
        </div>
    </div>

    <div class="form-section">
        <div class="form-content">
            <h2>Redefinir sua senha</h2>
            <p class="subtitle">Digite e confirme sua nova senha abaixo.</p>
            
            <form id="reset-password-form">
                <div class="form-group">
                    <label for="email">Digite seu Email</label>
                    <input type="email" id="email" name="email" placeholder="Digite o email" required>
                </div>
                <div class="form-group">
                    <label for="new-password">Nova Senha</label>
                    <div class="password-wrapper">
                        <input type="password" id="new-password" name="new-password" placeholder="Digite a nova senha" required>
                        <span class="toggle-password"><i class="fa-solid fa-eye"></i></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="confirm-password">Confirmar Nova Senha</label>
                    <div class="password-wrapper">
                        <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirme a nova senha" required>
                        <span class="toggle-password"><i class="fa-solid fa-eye"></i></span>
                    </div>
                    <div class="error-message" id="password-error">As senhas não coincidem.</div>
                </div>

                <button type="submit" class="submit-btn">Salvar Nova Senha</button>
            </form>

            <p class="signup-link">
                Lembrou da senha? <a href="./login.blade.php">Voltar para o login</a>
            </p>

        </div>
    </div>
</body>
</html>
