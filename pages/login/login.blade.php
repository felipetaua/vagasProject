<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../assets/images/global/RHconexao-logo.svg" type="image/png">
    <title>Login - Conexão RH</title>
    <link rel="stylesheet" href="../../assets/css/pages/login/login.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script defer src="../../assets/js/pages/login/login.js"></script>
</head>
<body>

    <div class="info-section">
        <h1>Sua jornada para o sucesso continua aqui.</h1>
        <p>Acesse sua conta para gerenciar vagas, encontrar candidatos ou descobrir a sua próxima oportunidade de carreira.</p>

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

        <a href="/" class="info-section-btn">← Voltar para a tela inicial</a>
    </div>

    <div class="form-section">
        <div class="form-content">
            <h2>Bem-vindo de volta!</h2>
            <p class="subtitle">Faça login para continuar.</p>
            
            <form id="login-form">
                <div class="form-group">
                    <label for="identifier">Seu e-mail</label>
                    <input type="text" id="identifier" name="identifier" placeholder="E-mail" required>
                </div>

                <div class="form-group">
                    <label for="password">Senha</label>
                    <div class="password-wrapper">
                        <input type="password" id="password" name="password" placeholder="Digite sua senha" required>
                        <span class="toggle-password"><i class="fa-solid fa-eye"></i></span>
                    </div>
                </div>

                <div class="form-options">
                    <label for="remember" class="remember-me">
                        <input type="checkbox" id="remember" name="remember">
                        Lembrar-me
                    </label>
                    <a href="./trocar-senha.blade.php">Esqueci minha senha</a>
                </div>

                <button type="submit" class="submit-btn">Entrar</button>
            </form>

            <p class="signup-link">
                Não tem uma conta? <a href="../register/register.blade.php">Cadastre-se</a>
            </p>
        </div>
    </div>
</body>
</html>