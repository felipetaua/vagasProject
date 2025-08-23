<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styleLogin.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
   
    <title>Login</title>
</head>
<body>
    <main> 
    <div class="logo">
        <img src="./imagens/Logo.svg" alt="Logo da Jobs In Cariri">
        <p>Jobs In Cariri</p>
        </div>  
        <form id="loginForm" action="validaLogin.php" method="post">
    <h1>Login</h1>
    <p>Entre com seu e-mail e sua senha</p>
    <input type="email" name="email" placeholder="Digite seu email..." required>
    <input type="password" name="senha" placeholder="Digite sua senha..." required>
    <input type="submit" value="Entrar">
</form>
  <p class="cadastro-login">Não tem uma conta?<a href="cadastro.php"> Crie aqui!</a></p>
  </main> 
  
</body>
</html>
