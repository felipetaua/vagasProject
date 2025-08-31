<?php
    $user = ['nome' => 'Seu Nome', 'foto' => 'foto.webp'];?>
<header style='background:white; margin-top:-10px; padding:5px;'>
    <ul>
        <a href='/sistemaDeVagas/authenticated/home.php'> <li>
            <img src='/sistemaDeVagas/imagens/Logo.svg' alt='Logo Conexão RH 2.0' class='logo'> Conexão RH 2.0
        </li></a> 
        <a href='/sistemaDeVagas/authenticated/profissionais.php'><li>Profissionais</li></a>
        <a href='/sistemaDeVagas/authenticated/cadastroVagas.php'><li>Cadastrar vaga</li></a>
        <a href='/sistemaDeVagas/authenticated/ultimasVagas.php'><li>Últimas vagas</li></a>
        <a href='/sistemaDeVagas/authenticated/vagasCriadas.php'><li>Minhas vagas</li></a>
        <div class='dropdown'> 
            <div class='perfil-img' style='display:flex; align-items:center; justify-content:center;'>
                <div style='display:flex; flex-direction:column; align-items:center;'>
                    <?php if (isset($user) && !empty($user['foto'])): ?>
                        <img src='/sistemaDeVagas/authenticated/uploads/<?php echo htmlspecialchars($user['foto']); ?>' style='width:50px; height:50px; border-radius:100%;'>
                    <?php else: ?>
                        <img src='https://placehold.co/50x50' alt='Foto de perfil padrão' style='width:50px; height:50px; border-radius:100%;'>
                    <?php endif; ?>
                </div>    
                <li class='dropdown-btn'><?php echo (isset($user) && $user) ? htmlspecialchars($user['nome']) : 'Perfil'; ?></li>
                <svg xmlns='http://www.w3.org/2000/svg' style='width:10px; color:green;' viewBox='0 0 320 512'><path d='M137.4 374.6c12.5 12.5 32.8 12.5 45.3 0l128-128c9.2-9.2 11.9-22.9 6.9-34.9s-16.6-19.8-29.6-19.8L32 192c-12.9 0-24.6 7.8-29.6 19.8s-2.2 25.7 6.9 34.9l128 128z'/ ></svg>
            </div>
            <ul class='dropdown-menu'>
                <a href='perfil.php'><li>Editar perfil</li></a>
                <a href='perfil_publico.php'> <li>Perfil Público</li></a>
                <a href='criar_curriculo.php'> <li>Criar Currículo</li></a>
                <link rel="stylesheet" href="/sistemaDeVagas/css/header.css">
                <header class="main-header">
                    <div class="hamburger" tabindex="0" aria-label="Abrir menu" role="button">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <ul>
                        <a href='/sistemaDeVagas/authenticated/home.php'> <li>
                            <img src='/sistemaDeVagas/imagens/Logo.svg' alt='Logo Conexão RH 2.0' class='logo'> Conexão RH 2.0
                        </li></a> 
                        <a href='/sistemaDeVagas/authenticated/profissionais.php'><li>Profissionais</li></a>
                        <a href='/sistemaDeVagas/authenticated/cadastroVagas.php'><li>Cadastrar vaga</li></a>
                        <a href='/sistemaDeVagas/authenticated/ultimasVagas.php'><li>Últimas vagas</li></a>
                        <a href='/sistemaDeVagas/authenticated/vagasCriadas.php'><li>Minhas vagas</li></a>
                        <div class='dropdown'> 
                            <div class='perfil-img'>
                                <div>
                                    <?php if (isset($user) && !empty($user['foto'])): ?>
                                        <img src='/sistemaDeVagas/authenticated/uploads/<?php echo htmlspecialchars($user['foto']); ?>' class="perfil-foto">
                                    <?php else: ?>
                                        <img src='https://placehold.co/50x50' alt='Foto de perfil padrão' class="perfil-foto">
                                    <?php endif; ?>
                                </div>    
                                <li class='dropdown-btn'><?php echo (isset($user) && $user) ? htmlspecialchars($user['nome']) : 'Perfil'; ?></li>
                                <svg xmlns='http://www.w3.org/2000/svg' style='width:10px; color:green;' viewBox='0 0 320 512'><path d='M137.4 374.6c12.5 12.5 32.8 12.5 45.3 0l128-128c9.2-9.2 11.9-22.9 6.9-34.9s-16.6-19.8-29.6-19.8L32 192c-12.9 0-24.6 7.8-29.6 19.8s-2.2 25.7 6.9 34.9l128 128z'/ ></svg>
                            </div>
                            <ul class='dropdown-menu'>
                                <a href='perfil.php'><li>Editar perfil</li></a>
                                <a href='perfil_publico.php'> <li>Perfil Público</li></a>
                                <a href='criar_curriculo.php'> <li>Criar Currículo</li></a>
                                <a href='artificial.php'> <li>Inteligencia Artificial</li></a>
                                <a href='curriculo.php'> <li>Currículo</li></a>
                                <a href='/sistemaDeVagas/authenticated/profissao.php'> <li>Profissão</li></a>
                                <a href='vagasCriadas.php'><li>Contratos</li></a>
                                <a href='./logout.php'><li>Sair</li></a>
                            </ul>
                        </div>
                    </ul>
                </header>
                <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const hamburger = document.querySelector('.hamburger');
                    const ul = document.querySelector('header ul');
                    hamburger.addEventListener('click', function() {
                        ul.classList.toggle('menu-open');
                    });
                    // Fecha o menu ao clicar fora
                    document.addEventListener('click', function(e) {
                        if (!hamburger.contains(e.target) && !ul.contains(e.target)) {
                            ul.classList.remove('menu-open');
                        }
                    });
                });
                </script>ref='artificial.php'> <li>Inteligencia Artificial</li></a>
                <a href='curriculo.php'> <li>Currículo</li></a>
                <a href='/sistemaDeVagas/authenticated/profissao.php'> <li>Profissão</li></a>
                <a href='vagasCriadas.php'><li>Contratos</li></a>
                <a href='./logout.php'><li>Sair</li></a>
            </ul>
        </div>
    </ul>
</header>