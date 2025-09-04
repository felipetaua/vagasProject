<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/pages/conect/conect.css">

    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <!-- JavaScript -->
    <script defer src="../../assets/js/global/main.js"></script>
    <script defer src="../../assets/js/pages/conect/conect.js"></script>


    <!-- miniatura -->
    <link rel="icon" href="../../assets/images/global/RHconexao-icone.png" type="image/png">
    <title>Conecte-se - Conexão RH</title>
</head>
<body>

    <header class="header">
        <a href="../../index.php" class="logo">
            <img src="../../assets/images/global/RHconexao-logo.svg" alt="Logotipo da RH Conexão" class="logoEmpresa">
        </a>

        <div class="hamburger">
            <div class="linha"></div>
            <div class="linha"></div>
            <div class="linha"></div>    
        </div>

        <nav class="nav-bar">
            <ul class="linkNav">
                <li>
                    <a href="../../index.php" class="linkPages curadoriaLink">Início</a>
                </li>
                <li>
                    <a href="../ferramentas/ferramentas.php" class="linkPages ferramentasLink">Ferramentas</a>
                </li>
                <li>
                    <a href="../sobre/sobre.php" class="linkPages">Quem Somos</a>
                </li>
                <li>
                    <a href="../../pages/curadoria/curadoria.php" class="linkPages">Curadoria</a>
                </li>
                <li>
                    <a href="#" class="linkPages ativo linkPagesActive">Conecte-se</a>
                </li>
            </ul>
            <a href="../../login.php" class="loginNav btn-mobile" >Entrar</a>
            <a href=".../../cadastro.php" class="SingninNav btn-mobile">Criar</a>
        </nav>

        <div class="linkAcount">
            <a href="../../login.php" class="loginNav actionBtnNav btn">Entrar</a>
            <a href="../../cadastro.php" class="SingninNav actionBtnNav btn">Crie sua Conta</a>
        </div>
    </header>

    <section class="heroSection">
        <h1><span class="gradient-blue">Conecte-se</span> às Oportunidades Certas</h1>
        <p>Faça parte da plataforma que conecta talentos, empresas e oportunidades de forma inteligente, dinâmica e eficiente.</p>
        <form>
            <input type="text" placeholder="Digite seu e-mail e faça parte da nossa comunidade!" readonly tabindex="-1">
            <button type="submit">Quero Me Conectar</button>
        </form>
        <img src="../../assets/images/pages/conect/hero-conect.png" alt="Imagem de Conexão Profissional">
    </section>

    <section class="features">
        <h2>Por que se Conectar?</h2>
        <p>No RH Conexão 2.0 você amplia seu networking, descobre vagas alinhadas ao seu perfil e desenvolve sua carreira com conteúdos e ferramentas que impulsionam seu crescimento.</p>
        <div class="feature-list">
            <div class="feature-item">
                <img class="feture-image" src="../../assets/icons/pages/conect/suporte-tecnico.gif" alt="">
                <h3>Match Inteligente</h3>
                <p>Nosso algoritmo conecta você às empresas e oportunidades que realmente fazem sentido para sua carreira.</p>
            </div>
            <div class="feature-item">
                <img class="feture-image" src="../../assets/icons/pages/conect/enviando.gif" alt="">
                <h3>Visibilidade Profissional</h3>
                <p>Crie um perfil atrativo, destaque suas habilidades e seja visto por recrutadores de forma estratégica.</p>
            </div>
            <div class="feature-item">
                <img class="feture-image" src="../../assets/icons/pages/conect/lista-de-controle.gif" alt="">
                <h3>Rede de Oportunidades</h3>
                <p>Participe de uma comunidade que valoriza conexões reais, desenvolvimento profissional e crescimento colaborativo.</p>
            </div>
        </div>
    </section>


<section class="advantages-section" id="colaboradores">
        <div class="section-content">
            <div class="text-content">
                <h2 class="section-title">Para <span class="gradient-blue">Colaboradores</span></h2>
                <p class="section-subtitle">Descubra como podemos impulsionar sua carreira e conectar você às melhores oportunidades do mercado.</p>
                <a href="../../pages/register/register" class="btn-main">Criar Perfil de Talento</a>
            </div>
            <div class="cards-container">
                <div class="advantage-card">
                    <div class="card-icon">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <h3>Perfil Profissional Otimizado</h3>
                    <p>Crie um perfil que destaca suas competências, experiências e objetivos de carreira de forma estratégica para atrair os recrutadores certos.</p>
                </div>
                <div class="advantage-card">
                    <div class="card-icon">
                        <i class="fas fa-lightbulb"></i>
                    </div>
                    <h3>Conteúdos Exclusivos</h3>
                    <p>Acesse uma curadoria de artigos, webinars e cursos para se manter atualizado e à frente no mercado de trabalho.</p>
                </div>
                <div class="advantage-card">
                    <div class="card-icon">
                        <i class="fas fa-network-wired"></i>
                    </div>
                    <h3>Networking de Alto Nível</h3>
                    <p>Conecte-se com profissionais e empresas que são referência em sua área, expandindo sua rede de contatos de forma significativa.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="advantages-section" id="empresas">
        <div class="section-content reverse">
            <div class="text-content">
                <h2 class="section-title">Para <span class="gradient-blue">Empresas</span></h2>
                <p class="section-subtitle">Encontre os talentos ideais para sua equipe e otimize seu processo de recrutamento com nossas ferramentas inteligentes.</p>
                <a href="../../pages/register/register" class="btn-main">Anunciar Vaga</a>
            </div>
            <div class="cards-container">
                <div class="advantage-card">
                    <div class="card-icon">
                        <i class="fas fa-search-location"></i>
                    </div>
                    <h3>Recrutamento Inteligente</h3>
                    <p>Utilize nosso algoritmo de "Match Inteligente" para encontrar candidatos que se alinham perfeitamente à cultura e aos requisitos da sua empresa.</p>
                </div>
                <div class="advantage-card">
                    <div class="card-icon">
                        <i class="fas fa-bullseye"></i>
                    </div>
                    <h3>Banco de Talentos Qualificado</h3>
                    <p>Acesse um banco de talentos diversificado e qualificado, pronto para atender às suas demandas com agilidade e precisão.</p>
                </div>
                <div class="advantage-card">
                    <div class="card-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3>Gestão de Candidatos Simplificada</h3>
                    <p>Otimize seu fluxo de recrutamento com um painel de gestão intuitivo, desde a triagem de currículos até a contratação.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="duvidas">
        <div class="container">
            <div class="texto">
            <h2>❓ Ficou com alguma dúvida?</h2>
            <p>Se você ainda tem alguma pergunta ou precisa de ajuda, fale com nossa equipe! Clique no botão abaixo e envie sua dúvida.</p>
            <a href="https://docs.google.com/forms/d/SEU_ID_DO_FORM" target="_blank" class="botao-duvida" rel="noopener noreferrer">
                Tirar Dúvida Agora
            </a>
            </div>
            <div class="imagem">
            <img class="" src="../../assets/images/pages/ferramentas/formulario-contato.png" alt="Ilustração representando dúvida">
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-contacts">
                <img class="footer-logo" src="../../assets/images/global/RHconexao-logo.svg" alt="Conexão RH - Rodapé da página">
                <h1>RHConexão</h1>
                <p>Saiba mais sobre o projeto e descubra como podemos contribuir para o seu desenvolvimento profissional!</p>

                <div class="footer-social-media">
                    <a href="https://www.instagram.com/rh.conexao.2.0?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" class="footer-link instagram" target="_blank" rel="noreferrer noopener" aria-label="Instagram">
                        <i class="fa-brands fa-instagram"></i>
                    </a>

                    <a href="https://www.facebook.com/?locale=pt_BR" class="footer-link facebook" target="_blank" rel="noreferrer noopener" aria-label="Facebook">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>

                    <a href="https://www.whatsapp.com/" class="footer-link whatsapp" target="_blank" rel="noreferrer noopener" aria-label="Whatsapp">
                        <i class="fa-brands fa-whatsapp"></i>
                    </a>
                </div>
            </div>
            
            <nav class="footer-list" aria-label="Links para empresas">
                <h3>Recursos para empresas</h3>
                <ul>
                    <li  class="li">
                        <a href="#" class="footer-link link">Curadoria</a>
                    </li>
                    <li class="li">
                        <a href="#" class="footer-link link">Proteção de Dados</a>
                    </li>
                    <li class="li">
                        <a href="#" class="footer-link link">Termos de Uso</a>
                    </li>
                </ul>
            </nav>
            
            <nav class="footer-list"  aria-label="Links para colaboradores">
                <h3>Soluções para colaboradores</h3>
                <ul>
                    <li class="li">
                        <a href="#" class="footer-link link">Artigos</a>
                    </li>
                    <li class="li">
                        <a href="#" class="footer-link link">Dicas empresariais</a>
                    </li>
                    <li class="li">
                        <a href="#" class="footer-link link">Vagas e Curriculos</a>
                    </li>
                </ul>
            </nav>
            

            <form action="https://escola.us13.list-manage.com/subscribe/post?u=a6246e182df6b62a3126abeed&amp;id=82e953ff84&amp;f_id=00568eeaf0" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_self">
                <h3>Contato</h3>
                <p>Entre em contato conosco através do campo abaixo:</p>
                <div class="input-group">
                    <label for="mce-MMERGE6">Sugestão</label>
                    <input type="text" name="MMERGE6" id="mce-MMERGE6" value="" placeholder="Digite sua sugestão" required>
                </div>
                <div class="input-group">
                    <label for="mce-EMAIL">E-mail</label>
                    <input type="email" name="EMAIL" id="mce-EMAIL" placeholder="Digite seu e-mail" required>
                    <button type="submit" name="subscribe" id="mc-embedded-subscribe">
                        <i class="fa-regular fa-envelope"></i> Enviar
                    </button>
                </div>
                <!-- Campo oculto para evitar spam bots -->
                <div style="position: absolute; left: -5000px;" aria-hidden="true">
                    <input type="text" name="b_a6246e182df6b62a3126abeed_82e953ff84" tabindex="-1" value="">
                </div>
            </form>
        </div>

        <div class="footer-copyright">
            &#169
            2025 Direitos reservados a RHConexão. Criado por: <a class="copyrightLink" href="https://github.com/felipetaua" target="_blank" rel="noreferrer noopener">felipetauaSystems </a> & <a class="link copyrightLink" href="https://github.com/nico-cbr" target="_blank" rel="noreferrer noopener"> nicoSystems </a> 
        </div>
    </footer>

    <script type="text/javascript">(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';fnames[3]='ADDRESS';ftypes[3]='address';fnames[4]='PHONE';ftypes[4]='phone';fnames[5]='BIRTHDAY';ftypes[5]='birthday';}(jQuery));var $mcj = jQuery.noConflict(true);</script>    <script type="text/javascript">(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';fnames[3]='ADDRESS';ftypes[3]='address';fnames[4]='PHONE';ftypes[4]='phone';fnames[5]='BIRTHDAY';ftypes[5]='birthday';}(jQuery));var $mcj = jQuery.noConflict(true);</script>

    <!-- Botão flutuante de voltar ao topo -->
    <button id="backToTopBtn" aria-label="Voltar ao topo">
        <i class="fa fa-arrow-up"></i>ass="fa fa-arrow-up"></i>
    </button>  

</body>
</html></html>

