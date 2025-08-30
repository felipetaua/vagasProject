<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./css/styleLogin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
</head>
<body>
    <main class="login-container">
        <div class="login-card">
            
            <div class="logo-container">
                <img src="./imagens/Logo.svg" alt="Logo da Empresa">
                <h1>Bem-vindo!</h1>
                <p>Entre com suas credenciais para continuar</p>
            </div>

            <?php
            if (isset($_GET['error'])) {
                $error_message = '';
                switch ($_GET['error']) {
                    case 'emptyfields':
                        $error_message = 'Por favor, preencha todos os campos.';
                        break;
                    case 'wrongcredentials':
                        $error_message = 'E-mail ou senha incorretos.';
                        break;
                    case 'dberror':
                        $error_message = 'Ocorreu um erro. Tente novamente mais tarde.';
                        break;
                }
                if ($error_message) {
                    echo '<p class="error-message">' . htmlspecialchars($error_message) . '</p>';
                }
            }
        ?>

            <form id="loginForm" action="validaLogin.php" method="post" novalidate>
                
                <div class="input-group">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" placeholder="Digite seu e-mail" required>
                </div>
                
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" id="password" name="senha" placeholder="Digite sua senha" required>
                    <button type="button" id="togglePassword" class="toggle-password">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                
                <button type="submit" class="submit-btn">Entrar</button>
            </form>

            <p class="cadastro-link">
                Não tem uma conta? <a href="cadastro.php">Crie uma aqui!</a>
            </p>
            <p class="home-link">
                <a href="index.php"><i class="fas fa-arrow-left"></i> Voltar para a página inicial</a>
            </p>
        </div>
    </main>
    
    <script src="./js/login.js"></script>
</body>
</html>