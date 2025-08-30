<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RH Conexão - Sobre os Criadores</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <!-- CSS -->
    <link rel="stylesheet" href="../../assets/css/pages/sobre/sobre.css">

    <!-- JS -->
    <script defer src="../../assets/js/global/main.js"></script>
    <script defer src="../../assets/js/pages/sobre/sobre.js"></script>

    <!-- Favicon -->
    <link rel="icon" href="../../assets/images/global/RHconexao-icone.png" type="image/png">
</head>
<body>
    <!-- Header -->
    <header class="header">
        <a href="../../index.php" class="logo link">
            <img src="../../assets/images/global/RHconexao-logo.svg" alt="Logotipo da RH Conexão" class="logoEmpresa">
        </a>

        <div class="hamburger">
            <div class="linha"></div>
            <div class="linha"></div>
            <div class="linha"></div>    
        </div>

        <nav class="nav-bar">
            <ul class="linkNav">
                <li><a href="../../index.php" class="linkPages">Início</a></li>
                <li><a href="../../pages/ferramentas/ferramentas.php" class="linkPages">Ferramentas</a></li>
                <li><a href="#" class="linkPages linkPagesActive ativo">Quem Somos</a></li>
                <li><a href="../../pages/curadoria/curadoria.php" class="linkPages">Curadoria</a></li>
                <li><a href="../../pages/conect/conect.php" class="linkPages">Conecte-se</a></li>
            </ul>
            <a href="../../pages/login/login.php" class="loginNav btn-mobile">Entrar</a>
            <a href="../../pages/register/register.php" class="SingninNav btn-mobile">Criar Conta</a>
        </nav>

        <div class="linkAcount">
            <a href="../../pages/login/login.blade.php" class="loginNav actionBtnNav btn">Entrar</a>
            <a href="../../pages/register/register.blade.php" class="SingninNav actionBtnNav btn">Criar Conta</a>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-text">
            <h1>Conheça Sobre o Projeto! Quem são os <span class="gradient-blue">Criadores</span> do Conexão RH <span class="gradient-blue">2.0</span></h1>
            <p>Este projeto é fruto da dedicação, criatividade e colaboração da Turma de Recursos Humanos do Senac. Mais que uma plataforma, é a expressão do nosso aprendizado, comprometimento e visão sobre o futuro da gestão de pessoas.</p>
            <div class="btns">
                <a href="#equipe" class="hero-btn">Conheça a Equipe</a>
                <a href="#devs" class="hero-btn" style="background: #ddd; color: #333;">Nossos desenvolvedores</a>
            </div>
        </div>
        <img class="hero-image" src="../../assets/images/pages/sobre/rede.png" alt="Imagem representando uma rede de conexões">
    </section>

    <!-- About Section -->
    <section class="about" >
        <div class="section-title">
            <h2>Quem Somos</h2>
        </div>
        <div class="about-content">
            <p>O RH Conexão 2.0 é a continuidade do projeto idealizado pela turma de Técnico em Recursos Humanos de 2022 na instituição de ensino SENAC Nova Londrina/PR.</p>

            <p>Agora, em 2025, a iniciativa ganha novos rumos sob a responsabilidade da atual turma do curso, com o compromisso de inovar e evoluir constantemente.</p>
        </div>

        <div class="section-title">
            <h2>Objetivo</h2>
        </div>
        <div class="about-content2" id="somos">
            <p>
                A plataforma tem como <b> propósito modernizar, facilitar e tornar mais eficaz o processo de recrutamento </b> e seleção, conectando talentos aos empregadores de forma prática e inteligente.
            
                Mais do que um canal de conexão, o RH Conexão 2.0 também oferece uma curadoria de conteúdos estratégicos para profissionais e estudantes da área de Recursos Humanos, incluindo:
            </p>
            <div>
                <ul class="list-about">
                    <li class="item">Desenvolvimento e capacitação de colaboradores;</li>
                    <li class="item">Orientações práticas para montagem de currículos;</li>
                    <li class="item">Cadastro e divulgação de vagas para atração de talentos;</li>
                    <li class="item">Vídeos e materiais educativos que respondem às principais dúvidas sobre o setor de RH.</li>
                </ul>
            </div>
            <p>
                Com uma abordagem atual e dinâmica, o RH Conexão 2.0 é um espaço que promove conhecimento, oportunidades e crescimento profissional.
            </p>
        </div>
        
    </section>

    <section class="marcas-formativas">
        <h2>Marcas Formativas Senac</h2>
        <div class="circle">
            <div class="center-text">
            <p>Formação integral<br>para o mundo do trabalho.</p>
            </div>

            <!-- Labels -->
            <div class="label label1" data-tooltip="Capacidade de usar tecnologias de forma autônoma e eficiente.">AUTONOMIA<br>DIGITAL</div>
            <div class="label label2" data-tooltip="Capacidade criativa, inovadora e com visão empreendedora.">CRIATIVIDADE E<br>ATITUDE<br>EMPREENDEDORA</div>
            <div class="label label3" data-tooltip="Analisar, questionar e refletir criticamente.">VISÃO<br>CRÍTICA</div>
            <div class="label label4" data-tooltip="Práticas sustentáveis e responsabilidade social.">ATITUDE<br>SUSTENTÁVEL</div>
            <div class="label label5" data-tooltip="Trabalho colaborativo e comunicação assertiva.">COLABORAÇÃO E<br>COMUNICAÇÃO</div>
            <div class="label label6" data-tooltip="Conhecimento técnico e científico aplicado ao trabalho.">DOMÍNIO<br>TÉCNICO-CIENTÍFICO</div>
        </div>
    </section>

    <section class="class-gallery" id="equipe">
        <div class="section-title">
            <h2>A Turma</h2>
            <p>Momentos especiais e registros dessa jornada incrível.</p>
        </div>

        <div class="gallery-grid">
            <div class="gallery-item">
            <img src="../../assets/images/pages/sobre/team/pessoa-1.jpg" alt="Foto da turma 1">
            </div>
            <div class="gallery-item">
            <img src="../../assets/images/pages/sobre/team/pessoa-2.jpg" alt="Foto da turma 2">
            </div>
            <div class="gallery-item">
            <img src="../../assets/images/pages/sobre/team/pessoa-3.jpg" alt="Foto da turma 3">
            </div>
            <div class="gallery-item">
            <img src="../../assets/images/pages/sobre/team/pessoa-4.jpg" alt="Foto da turma 4">
            </div>
            <div class="gallery-item">
            <img src="../../assets/images/pages/sobre/team/pessoa-6.jpg" alt="Foto da turma 5">
            </div>
        </div>
        <div class="gallery-grid">
            <div class="carrossel">
                <div class="carrossel-inner">
                    <div class="gallery-item-group">
                        <img src="../../assets/images/pages/sobre/team/equipe-1.jpg" alt="Foto da equipe 1">
                    </div>
                    <div class="gallery-item-group">
                        <img src="../../assets/images/pages/sobre/team/equipe-2.jpg" alt="Foto da equipe 2">
                    </div>
                    <div class="gallery-item-group">
                        <img src="../../assets/images/pages/sobre/team/equipe-3.jpg" alt="Foto da equipe 3">
                    </div>
                    <div class="gallery-item-group">
                        <img src="../../assets/images/pages/sobre/team/equipe-5.jpg" alt="Foto da equipe 4">
                    </div>
                    <div class="gallery-item-group">
                        <img src="../../assets/images/pages/sobre/team/equipe-4.jpg" alt="Foto da equipe 4">
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="evolution">
        <div class="section-title">
            <h2>Como o Projeto Evoluiu</h2>
            <p>Veja os principais marcos e melhorias que moldaram nosso projeto até aqui.</p>
        </div>

        <div class="timeline">
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-date">Janeiro 2024</div>
                <div class="timeline-content">
                    <h3>Início da Ideia</h3>
                    <p>O projeto nasceu como um conceito básico, desenvolvido por outra turma, com o foco em resolver uma necessidade específica dos usuários: fornecer dicas e informações sobre Recursos Humanos.</p>
                </div>
            </div>

            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-date">Março 2024</div>
                <div class="timeline-content">
                    <h3>Primeiro Protótipo</h3>
                    <p>Foi desenvolvido os primeiros esboços do layout e os validamos com alguns usuários para obter feedback inicial e direcionar as melhorias.</p>
                </div>
            </div>

            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-date">Janeiro 2025</div>
                <div class="timeline-content">
                    <h3>Planejamento da Versão 2.0</h3>
                    <p>Com o início de uma nova turma de Técnico em RH, surgiu o desejo de aprimorar o projeto. Impulsionados por novas ideias e pela ascensão da Inteligência Artificial, planejamos implementar uma IA para auxiliar os usuários da área de RH.</p>
                </div>
            </div>

            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-date">Fevereiro 2025</div>
                <div class="timeline-content">
                    <h3>Lançamento e Evolução</h3>
                    <p>O projeto atinge um novo patamar com o lançamento de funcionalidades robustas, design aprimorado e foco total na entrega de valor aos usuários.</p>
                </div>
            </div>
        </div>
    </section>


    <!-- Equipe -->
    <section class="equipe" >
        <div class="section-title">
            <h2>Nosso Time</h2>
        </div>
        <div class="cards">
            <div class="card">
                <h3>Turma de RH - Senac</h3>
                <p>Somos uma equipe diversa, formada por profissionais em formação, com diferentes histórias, experiências e um propósito em comum: transformar o futuro do trabalho.</p>
            </div>
            <div class="card">
                <h3>Inspiração e Aprendizado</h3>
                <p>Este projeto reflete nossa jornada de aprendizado, colaboração e superação. Um trabalho construído com empatia, comprometimento e muita dedicação.</p>
            </div>
            <div class="card">
                <h3>Missão</h3>
                <p>Fomentar conexões inteligentes entre empresas e profissionais, utilizando tecnologia como ponte para valorizar o capital humano.</p>
            </div>
        </div>
    </section>

    <section class="developers" id="devs">
        <div class="section-title">
            <h2>Desenvolvedores</h2>
            <p>Conheça quem esteve por trás desse projeto.</p>
        </div>

        <div class="slider-container">
            <div class="slider" id="slider">
                <div class="slide">
                    <img class="dev-photo" src="../../assets/images/pages/sobre/Tauã.jpg" alt="Foto Tauã Felipe">
                    <h3>Tauã Felipe</h3>
                    <p>Desenvolvedor Front-End | Design UI & UX</p>
                    <div class="dev-social">
                        <a href="https://github.com/felipetaua" target="_blank" aria-label="GitHub Tauã" rel="noopener noreferrer">
                            <i class="fab fa-github"></i>
                        </a>
                        <a href="https://www.linkedin.com/in/taua-felipe" target="_blank" aria-label="LinkedIn Tauã" rel="noopener noreferrer"><i class="fab fa-linkedin"></i></a>
                    </div>
                    <div class="dev-comments-slider">
                        <div class="dev-comment active">"Acredito que tecnologia é ponte para transformar vidas."</div>
                        <div class="dev-comment">"Orgulho de fazer parte deste projeto incrível!"</div>
                    </div>
                </div>
                <div class="slide">
                    <img class="dev-photo" src="../../assets/images/pages/sobre/Nicoly.png" alt="Foto Nicoly Carolina">
                    <h3>Nicoly Carolina</h3>
                    <p>Desenvolvedora Back-end</p>
                    <div class="dev-social">
                        <a href="https://github.com/nico-cbr" target="_blank" aria-label="GitHub Nicoly" rel="noopener noreferrer"><i class="fab fa-github"></i></a>
                        <a href="https://www.linkedin.com/in/nico-cbr/" target="_blank" aria-label="LinkedIn Nicoly" rel="noopener noreferrer"><i class="fab fa-linkedin"></i></a>
                    </div>
                    <div class="dev-comments-slider">
                        <div class="dev-comment active">"Desenvolver é criar soluções para pessoas."</div>
                        <div class="dev-comment">"RH Conexão é sobre colaboração e inovação."</div>
                    </div>
                </div>
            </div>

            <div class="indicators" id="indicators"></div>
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
                    <a href="https://www.instagram.com/" class="footer-link instagram" target="_blank" rel="noreferrer noopener" aria-label="Instagram">
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
                    <input type="text" name="MMERGE6" class="text" id="mce-MMERGE6" value="" placeholder="Digite sua sugestão" required>
                </div>
                <div class="input-group">
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

    <script type="text/javascript" src="//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js"></script>
    <script type="text/javascript">(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';fnames[3]='ADDRESS';ftypes[3]='address';fnames[4]='PHONE';ftypes[4]='phone';fnames[5]='BIRTHDAY';ftypes[5]='birthday';}(jQuery));var $mcj = jQuery.noConflict(true);</script>

    <!-- Botão flutuante de voltar ao topo -->
    <button id="backToTopBtn" aria-label="Voltar ao topo">
        <i class="fa fa-arrow-up"></i>
    </button>
</body>
</html>
