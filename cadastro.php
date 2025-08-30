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
                    <div class="input-group">
                        <label>Você é?</label>
                        <div class="user-type-group">
                            <input type="radio" id="type-candidate" name="userType" value="candidate" checked>
                            <label for="type-candidate">Candidato</label>
                            
                            <input type="radio" id="type-company" name="userType" value="company">
                            <label for="type-company">Empresa</label>
                        </div>
                    </div>
                    <div class="input-group">
                        <label for="name" id="label-name">Nome Completo</label>
                        <input type="text" placeholder="Digite seu nome completo" id="name" name="primary_name" required>
                        <span class="error-message"></span>
                    </div>
                    <div class="input-group">
                        <label for="doc" id="label-doc">CPF</label>
                        <input type="text" placeholder="000.000.000-00" id="doc" name="primary_doc" required>
                        <span class="error-message"></span>
                    </div>
                    <div class="input-group">
                        <label for="email">E-mail</label>
                        <input type="email" placeholder="seu.email@exemplo.com" name="email" required>
                        <span class="error-message"></span>
                    </div>
                    <div class="input-group">
                        <label for="senha">Senha</label>
                        <input type="password" placeholder="Crie uma senha forte" name="password" id="password" required>
                        <span class="error-message"></span>
                    </div>
                    <div class="input-group">
                        <label for="confirmaSenha">Confirmar Senha</label>
                        <input type="password" placeholder="Confirme sua senha" name="password_confirmation" required>
                        <span class="error-message"></span>
                    </div>
                </div>

                <div class="tab-content">
                    <h2>Endereço e Contato</h2>
                    <div class="input-group">
                        <label for="celular">Telefone / Celular</label>
                        <input type="tel" placeholder="(00) 90000-0000" name="celular" required>
                        <span class="error-message"></span>
                    </div>
                     <div id="candidate-fields">
                         <div class="input-group">
                             <label for="dtNascimento">Data de Nascimento</label>
                             <input type="date" name="dtNascimento" id="dtNascimento">
                             <span class="error-message"></span>
                         </div>
                         <div class="input-group">
                             <label for="rg">RG (Opcional)</label>
                             <input type="text" placeholder="00.000.000-0" name="rg" id="rg">
                             <span class="error-message"></span>
                         </div>
                     </div>
                    <div class="input-group">
                        <label for="zipcode">CEP</label>
                        <input type="text" id="zipcode" name="zipcode" placeholder="00000-000" required>
                    </div>
                    <div class="input-group">
                        <label for="streetName">Rua</label>
                        <input type="text" id="streetName" name="streetName" placeholder="Rua das Flores" required>
                    </div>
                    <div class="input-group">
                        <label for="streetNumber">Número</label>
                        <input type="text" id="streetNumber" name="streetNumber" placeholder="123" required>
                    </div>
                    <div class="input-group">
                        <label for="district">Bairro</label>
                        <input type="text" id="district" name="district" placeholder="Centro" required>
                    </div>
                    <div class="input-group">
                        <label for="city">Cidade</label>
                        <input type="text" id="city" name="city" placeholder="São Paulo" required>
                    </div>
                    <div class="input-group">
                        <label for="state">Estado</label>
                        <input type="text" id="state" name="state" placeholder="SP" required>
                    </div>
                </div>

                <div class="tab-content">
                    <h2>Termos de Uso</h2>
                    <div class="terms-box">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem, illum libero pariatur incidunt culpa, ex mollitia dolore porro ducimus temporibus amet ea corporis ad optio error animi repell at sed aspernatur quod!</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur, saepe. Amet, reiciendis. Doloremque, molestiae.</p>
                    </div>
                    <div class="input-group checkbox-group">
                        <input type="checkbox" name="termos" id="termos" required>
                        <label for="termos">Eu li e aceito os termos de uso.</label>
                        <span class="error-message"></span>
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