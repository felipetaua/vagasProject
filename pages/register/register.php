<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/images/global/RHconexao-logo.svg" type="image/png">
    <title>Crie sua conta - Conexão RH</title>
    <script defer src="assets/js/pages/register/register.js"></script>
    <link rel="stylesheet" href="assets/css/pages/register/register.css">
</head>
<body>

    <div class="info-section">
        <h1>A sua porta de entrada para o sucesso profissional.</h1>
        <p>Conectamos empresas inovadoras aos melhores talentos do mercado. Crie sua conta e comece a sua jornada.</p>

        <div class="testimonial-slider">
            <div class="testimonial-card" id="testimonialCard">
                <p>"A plataforma é intuitiva e me ajudou a encontrar o candidato ideal em menos de uma semana. Recomendo!"</p>
                <div class="testimonial-author">
                    <span>Ana Silva, Gerente de RH</span>
                    <span class="stars">★★★★★</span>
                </div>
            </div>
            <div class="testimonial-progress">
                <div class="testimonial-progress-bar" id="testimonialProgressBar"></div>
            </div>
        </div>

        <button type="button" class="already-account-btn" id="alreadyAccountBtn">Já possui conta? Acesse aqui</button>
    </div>

    <div class="form-section">
        <div class="form-content">
            <div class="stepper">
                <div class="step active"></div>
                <div class="step"></div>
                <div class="step"></div>
            </div>

            <h2>Vamos começar</h2>
            <form id="rh-form">
                <div class="form-group">
                    <div class="user-type-group">
                        <input type="radio" id="type-candidate" name="userType" value="candidate" checked>
                        <label for="type-candidate">Sou Candidato</label>
                        
                        <input type="radio" id="type-company" name="userType" value="company">
                        <label for="type-company">Sou Empresa</label>
                    </div>
                </div>

                <div class="form-group">
                    <label id="label-name" for="name" autocomplete >Nome Completo</label>
                    <input type="text" id="name" name="name" placeholder="Digite seu nome completo" required>
                </div>

                <div class="form-group">
                    <label id="label-doc" for="doc" autocomplete >CPF</label>
                    <input type="text" id="doc" name="doc" placeholder="000.000.000-00" required>
                    <div class="error-message" id="doc-error"></div>
                </div>

                <div class="form-group">
                    <label for="celular" autocomplete >Celular</label>
                    <input type="tel" id="celular" name="celular" placeholder="(00) 00000-0000" required>
                </div>

                <div class="form-group">
                    <label for="zipcode">CEP</label>
                    <input type="text" id="zipcode" name="zipcode" placeholder="00000-000" required>
                </div>
                <div class="form-group">
                    <label for="streetName">Rua</label>
                    <input type="text" id="streetName" name="streetName" placeholder="Rua das Flores" required>
                </div>
                <div class="form-group">
                    <label for="streetNumber">Número</label>
                    <input type="text" id="streetNumber" name="streetNumber" placeholder="123" required>
                </div>
                <div class="form-group">
                    <label for="district">Bairro</label>
                    <input type="text" id="district" name="district" placeholder="Centro" required>
                </div>
                <div class="form-group">
                    <label for="city">Cidade</label>
                    <input type="text" id="city" name="city" placeholder="São Paulo" required>
                </div>
                <div class="form-group">
                    <label for="state">Estado</label>
                    <input type="text" id="state" name="state" placeholder="SP" required>
                </div>


                <div class="form-group">
                    <label for="email" autocomplete >E-mail</label>
                    <input type="email" id="email" name="email" placeholder="seu.email@exemplo.com" required>
                </div>

                <div class="form-group">
                    <label for="password">Senha</label>
                    <input type="password" id="password" name="password" placeholder="Crie uma senha forte" required>
                    <div id="password-strength">
                        <div id="password-strength-bar"></div>
                    </div>
                    <div class="error-message" id="password-error"></div>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirmar Senha</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirme sua senha" required>
                </div>

                <button type="submit" class="submit-btn">Começar</button>
            </form>

            <button type="button" class="back-btn" id="backToHomeBtn">← Voltar para o início</button>
            <p class="login-link">
                Já possui uma conta? <a href="../login/login.blade.php">Clique aqui</a>
            </p>
        </div>
    </div>
</body>
    <!-- Modal de Sucesso -->
    <div id="successModal" class="modal-overlay">
        <div class="modal-content">
            <span class="modal-close-btn">&times;</span>
            <div class="modal-icon">
                <!-- Usando Font Awesome que já está no seu projeto -->
                <i class="fa fa-check-circle"></i>
            </div>
            <h2>Cadastro Realizado!</h2>
            <p>Seu cadastro foi efetuado com sucesso. Você será redirecionado para a página de login.</p>
            <button id="modalOkBtn" class="btn">OK</button>
        </div>
    </div>
</html>