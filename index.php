<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Plataforma de Recursos Humanos">
    <meta name="keywords" content="HTML, CSS, JavaScript">
    <meta name="author" content="Tauã Felipe, Nicoly Carvalho ">
    
    <!-- css -->
    <link rel="stylesheet" href="assets/css/pages/index/index.css">

    <!-- Linking Google fonts for icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />

    <!-- Linking SwiperJS CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

    <!-- spline tools -->
    <!-- Linking SwiperJS script -->
    <script defer src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- Script principal -->
    <script defer src="https://unpkg.com/scrollreveal"></script>
    <script defer src="assets/js/pages/index/index.js"></script>
    <script defer src="assets/js/global/main.js"></script>

    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <!-- miniatura -->
    <link rel="icon" href="assets/images/global/RHconexao-icone.png" type="image/png">
    <title>Conexão RH</title>
</head>
<body>
    <header class="header">
        <a href="index.php" class="logo">
            <img src="assets/images/global/RHconexao-logo.svg" alt="Conexão RH - Pagina Inicial" class="logoEmpresa">
        </a>

        <!-- Botão hamburguer fora da logo -->
        <div class="hamburger" aria-label="Abrir menu de navegação" aria-expanded="false">
            <div class="linha"></div>
            <div class="linha"></div>
            <div class="linha"></div>    
        </div>

        <!-- Navegação principal -->
        <nav class="nav-bar" aria-label="Menu principal">
            <ul class="linkNav">
                <li>
                    <a href="/" class="linkPages curadoriaLink linkPagesActive">Início</a>
                </li>
                <li>
                    <a href="pages/ferramentas/ferramentas.html" class="linkPages ferramentasLink ativo">Ferramentas</a>
                </li>
                <li>
                    <a href="pages/sobre/sobre.html" class="linkPages">Quem Somos</a>
                </li>
                <li>
                    <a href="pages/curadoria/curadoria.html" class="linkPages">Curadoria</a>
                </li>
                <li>
                    <a href="pages/conect/conect.html" class="linkPages">Conecte-se</a>
                </li>
            </ul>
            <a href="pages/login/login.php" class="loginNav btn-mobile" aria-hidden="true">Entrar</a>
            <a href="pages/register/register.php" class="SingninNav btn-mobile" aria-hidden="true">Criar</a>
        </nav>

        <!-- Botões de ação -->
        <div class="linkAcount">
            <a href="pages/login/login.php" class="loginNav actionBtnNav btn">Entrar</a>
            <a href="pages/register/register.php" class="SingninNav actionBtnNav btn">Crie sua Conta</a>
        </div>
    </header>


    <div class="imagensFundo">
        <img class="pessoa" src="assets/images/pages/index/bg-pol.jpg" alt="" loading="lazy">
        <img class="fumaca" src="assets/images/pages/index/backgorund-fumaca.png" alt="" loading="lazy">
    </div>

    <section class="heroSection">
        <div class="heroGrid">
            <article class="floating1 cardsFlutuantes" >
                <img class="cardsHero" src="assets/images/pages/index/flutuando-1.webp" alt="Funcionalidade de cadastro rápido de perfis profissionais">
            </article>
            <article class="floating2 cardsFlutuantes">
                <img class="cardsHero" src="assets/images/pages/index/flutuando-2.webp" alt="Como a plataforma é profissional, e segue conceitos de segurança e privaicidade">
            </article>
            <article class="floating3 cardsFlutuantes">
                <img class="cardsHero" src="assets/images/pages/index/flutuando-3.webp"alt="Como utilizamos tecnologias presentes no mercado para entregar um produto profissional">
            </article>

            <main class="floatingContent contentHero">
                <div class="container-mobile">
                    <img class="mundo-mobile" src="assets/images/pages/index/word-mobile.png
                    " alt="">
                </div>
                <h1 class="heroTitle">Bem-Vindo ao Conexão RH <span class="gradient">2.0</span></h1>
                <p class="heroText">Uma plataforma de talentos e oportunidade!</p>
                <div class="containerBtn">
                    <button class="link actionButtonHero btn" id="openModalBtn" aria-label="Iniciar sua jornada na plataforma RH Conexão">Inicie sua Jornada 
                        <div class="circle"><img class="arrow" src="assets/icons/pages/index/icon-arrow-right.png" alt=""></div>
                    </button>
                </div>
            </main>
            <article class="floating5 cardsFlutuantes">
                <img class="cardsHero" src="assets/images/pages/index/flutuando-4.webp" alt="Como uma organização e trabalho em grupo é chave para tudo e nosso trabalho é em conjunto com nossos usuarios">
            </article>
            <article class="floating6 cardsFlutuantes">
                <img class="cardsHero" src="assets/images/pages/index/flutuando-5.webp" alt="Voltado ao ambiente corporativo para empresas e tambem para colaboradores que procuram uma oportunidade">
            </article>
            <article class="floating7 cardsFlutuantes">
                <img class="cardsHero" src="assets/images/pages/index/flutuando-6.webp"alt="Educação, como voce pode aprender dentro da nossa plataforma">
            </article>
        </div>
    </section>

    <section class="scroll-hero">
        <a class="scroll-down link" aria-label="Role para baixo e veja mais" href="#center-nav"><img class="scroll-down-image" src="assets/images/pages/index/scroll-down.svg" alt="Descer para ver mais" /></a>
    </section>

    <section class="heroCell">
        <figure class="cellAlign">
            <div class=" cell1">
                <img class="cellA1 cellphones-img" src="assets/images/pages/index/celular-1.png" alt="Engajamento e administração para criação da pagina">
            </div>
            <div class=" cell2">
                <img class="cellA2 cellphones-img" src="assets/images/pages/index/celular-2.png"  alt="Equipe responsável pela criação do projeto">
            </div>
            <div class=" cell3">
                <img class="cellA3 cellphones-img" src="assets/images/pages/index/celular-3.png" alt="Tela de busca de vagas na plataforma RH Conexão">
            </div>
            <div class=" cell4">
                <img class="cellA4 cellphones-img" src="assets/images/pages/index/celular-4.png" alt="Ideias e sujestões da turma">
            </div>
            <div class=" cell5">
                <img class="cellA5 cellphones-img" src="assets/images/pages/index/celular-5.png" alt="Turma de RH do Senac - Nova Londrina">
            </div>
        </figure>
    </section>

    <main class="page">
        <section class="usuariosSections">
            <div class="userContent">
                <h2 class="usuarioText">Perfil de Usuários</h2>
                <p class="userText">Conheça suas vantagens como colaborador ou empresa ao acessar e nossa plataforma.</p>
            </div>
            <div class="usuariosSectionsAlign">
                <section class="cardsUser colaborador">
                    <div class="cardUserIntro">
                        <h3 class="cardUserTitle">Colaborador</h3>
                        <p class="cardUserText">Conheça suas vantagens por criar sua conta conosco.</p>
                    </div>
                    <div class="cardColabContent">
                        <ul class="listVantagens">
                            <li class="contentItem">
                                <i><img src="assets/icons/pages/index/medal-icon.png" alt="medalha"></i>
                                <p class="empregadorText">Encontre oportunidades alinhadas ao seu perfil e objetivos.</p>
                            </li>
                            <li class="contentItem">
                                <i><img src="assets/icons/pages/index/check-circle-icon.png" alt="vantagens"></i>
                                <p class="empregadorText">Receba recomendações personalizadas com base no seu potencial.</p>
                            </li>
                            <li class="contentItem">
                                <i><img src="assets/icons/pages/index/trending-up-icon.png" alt="crescimento"></i>
                                <p class="empregadorText">Conecte-se diretamente com recrutadores e empresas inovadoras.</p>
                            </li>
                        </ul>
                        <button class="btn btnUser" aria-label="Criar conta como colaborador">Participe</button>
                    </div>
                    <img class="imgUser" src="assets/images/pages/index/pessoa-colaborador.png" alt="Imagem de um colaborador representando os usuários do site">
                </section>
                <section class="cardsUser empregador">
                    <div class="cardUserIntro">
                        <h3 class="cardUserTitle">Empregador</h3>
                        <p class="cardUserText">Descubra suas vantagens como empresa.</p>
                    </div>
                    <div class="cardEmpreContent">
                        <ul class="listVantagens">
                            <li class="contentItem"><i><img src="assets/icons/pages/index/medal-icon.png" alt="medalha"></i><p class="empregadorText">Reduza o tempo de contratação com buscas inteligentes.</p></li>
                            <li class="contentItem"><i><img src="assets/icons/pages/index/check-circle-icon.png" alt="vantagens"></i><p class="empregadorText">Fortaleça a marca empregadora e atraia os melhores talentos.</p></li>
                            <li class="contentItem"><i><img src="assets/icons/pages/index/trending-up-icon.png" alt="crescimento"></i><p class="empregadorText">Acesse uma base qualificada de talentos.</p></li>
                        </ul>
                            <button class="btn btnUser" aria-label="Criar conta como empregador">Participe</button>
                    </div>
                    <img class="imgUser" src="assets/images/pages/index/pessoa-empregador.png" alt="empregador representando empresas parceiras">
                </section>
            </div>
        </section>

        <section class="videosSection swiper">
            <div class="container swiper">
                <h2 class="swiper-title">Transforme seu ambiente de trabalho com conhecimento e soluções práticas.</h2>
                <div class="card-wrapper">
                    <!-- Card slides container -->
                    <ul class="card-list swiper-wrapper">
                        <li class="card-item swiper-slide">
                            <a href="#" class="card-link">
                                <iframe class="card-video" src="https://www.youtube.com/embed/F-mvgoG0lLc?si=rTQ3DaPBmSdXyF3h" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" loading="lazy" allowfullscreen></iframe>
                                <p class="badge badge-designer">Benefícios e Créditos</p>
                                <h3 class="card-title">Crédito do Trabalhador E-consignado - Econet </h3>
                                <button class="card-button material-symbols-rounded">arrow_forward</button>
                            </a>
                        </li>
                        <li class="card-item swiper-slide">
                            <a href="#" class="card-link">
                                <iframe class="card-video"  src="https://www.youtube.com/embed/FxfaBy7Dj2s?si=JG_DqeBZ8ggMXKrL" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" loading="lazy" allowfullscreen></iframe>
                                <p class="badge badge-developer">Rotinas Trabalhistas</p>
                                <h3 class="card-title">Hora Extra - Econet</h3>
                                <button class="card-button material-symbols-rounded">arrow_forward</button>
                            </a>
                        </li>
                        <li class="card-item swiper-slide">
                            <a href="#" class="card-link">
                                <iframe class="card-video"  src="https://www.youtube.com/embed/LwS_Ex3Z-EA?si=yaibWY6JH0rYOvtS" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" loading="lazy" allowfullscreen></iframe>
                                <p class="badge badge-marketer">Direitos do Trabalhador</p>
                                <h3 class="card-title">Calculo do 13º Salário - Econet</h3>
                                <button class="card-button material-symbols-rounded">arrow_forward</button>
                            </a>
                        </li>
                        <li class="card-item swiper-slide">
                            <a href="#" class="card-link">
                                <iframe class="card-video"  src="https://www.youtube.com/embed/rVGaWZb_yMY?si=u8AbySUEVqOWQ8UL" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" loading="lazy" allowfullscreen></iframe>
                                <p class="badge badge-gamer">Recursos Humanos</p>
                                <p class="badge badge-editor">Departamento Pessoal</p>
                                <h3 class="card-title">Prazos para Recontratação de Ex-Funcionário - Econet</h3>
                                <button class="card-button material-symbols-rounded">arrow_forward</button>
                            </a>
                        </li>
                        <li class="card-item swiper-slide">
                            <a href="#" class="card-link">
                                <iframe class="card-video" src="https://www.youtube.com/embed/GNfMBeLhldo?si=ENuvmvSFA__kwRjG" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" loading="lazy" allowfullscreen></iframe>
                                <p class="badge badge-editor">Legislação</p>
                                <h3 class="card-title">Carnaval é Feriado? Direitos e deveres do trabalhador. - Econet</h3>
                                <button class="card-button material-symbols-rounded">arrow_forward</button>
                            </a>
                        </li>
                    </ul>
            
                    <!-- Pagination Control -->
                    <div class="pagination-wrapper">
                        <div class="swiper-pagination"></div>
                    </div>
            
                    <!-- Navigation Buttons -->
                    <div class="swiper-slide-button swiper-button-prev"></div>
                    <div class="swiper-slide-button swiper-button-next"></div>
                </div>
            </div>
        </section>

        <section class="funcionalSection">
            <article class="contentFunctional">
                <div class="margin-content">
                    <h1 class="functionalTitle">Funcionalidades Presentes</h1>
                    <p class="funcionalText">O que você está interessado em fazer?</p>
                    <hr class="functionalRow">
                </div>
            </article>
            <main class="parentGrid" id="center-nav">
                <a href="/pages/sobre/sobre.html#somos" class="cardOne">
                    <h2 class="cardOneTitle">Quem somos?</h2>
                </a>
                <article href="/pages/register/register" class="cardTwo">
                    <p class="parentText">Já sabe preencher o seu curriculo?</p>
                    <button class="parentBtn cardTwoBtn btnOutline">Como preencher seu currículo</button>
                </article>
                <article href="/pages/curadoria/curadoria" class="cardThree">
                    <h2 class="parentTitle">Ei, você esta com dúvida nos processos de RH?</h2>
                    <a  href="/pages/curadoria/curadoria.html#tabs" class=" link parentWhiteBtn cardThreeBtn btn">Clique e saiba mais</a>
                </article>
                <a href="/pages/login/login" class="cardFour">
                    <p class="parentVacancy">As melhores vagas disponíveis te aguardando.</p>
                </a>
                <a href="/pages/conect/conect" class="cardFive">
                    <h2 class="parentFiveTitle">Conheça nossas empresas e parceiros.</h2>
                </a>
            </main>
        </section>
        
        <section class="depoimentsWrapper">
            <h2 class="depoimentsTitleSection">O que nossos usuários dizem</h2>
            <div class="depoimentsNavBtns">
                <button class="depoimentsNavBtn" id="depoimentPrev" aria-label="Depoimento anterior">
                    <i class="fa fa-chevron-left"></i>
                </button>
                <button class="depoimentsNavBtn" id="depoimentNext" aria-label="Próximo depoimento">
                    <i class="fa fa-chevron-right"></i>
                </button>
            </div>
            <div class="depoimentsSection">
                <article class="cardsDepoimentos depoimentos1">
                    <div class="avatar">
                        <img class="avatarPhoto" src="assets/images/pages/index/depoiments1.png" alt="Foto de Eminem, um dos usuários satisfeitos do RH Conexão">
                        <div>
                            <h3 class="depoimentsTitle">Eminem</h3>
                            <figure class="stars">
                                <img src="assets/icons/pages/index/star.svg" alt="estrela de avaliação">
                                <img src="assets/icons/pages/index/star.svg" alt="estrela de avaliação">
                                <img src="assets/icons/pages/index/star.svg" alt="estrela de avaliação">
                                <img src="assets/icons/pages/index/star.svg" alt="estrela de avaliação">
                                <img src="assets/icons/pages/index/star.svg" alt="estrela de avaliação">
                                <img src="assets/icons/pages/index/star.svg" alt="Ícone de estrela representando avaliação de 5 estrelas">
                            </figure>
                        </div>
                    </div>
                    <div class="contentDepoiments">
                        <hr class="horizontalLine">
                        <p class="depoimentsText">"Com a Inteligência do RH Conexão 2.0, consegui uma colocação na minha área em poucos dias!"</p>
                    </div>
                </article>
                <article class="cardsDepoimentos depoimentos1">
                    <div class="avatar">
                        <img class="avatarPhoto" src="assets/images/pages/index/depoiments2.png" alt="foto de um de nossos clientes que gostaram de nosso trabalho">
                        <div>
                            <h3 class="depoimentsTitle">Ariana Grande</h3>
                            <figure class="stars">
                                <img src="assets/icons/pages/index/star.svg" alt="estrela de avaliação">
                                <img src="assets/icons/pages/index/star.svg" alt="estrela de avaliação">
                                <img src="assets/icons/pages/index/star.svg" alt="estrela de avaliação">
                                <img src="assets/icons/pages/index/star.svg" alt="estrela de avaliação">
                                <img src="assets/icons/pages/index/star.svg" alt="estrela de avaliação">
                                <img src="assets/icons/pages/index/star.svg" alt="Ícone de estrela representando avaliação de 5 estrelas">
                            </figure>
                        </div>
                    </div>
                    <div class="contentDepoiments">
                        <hr class="horizontalLine">
                        <p class="depoimentsText">"O website é muito bonito visualmente, adorei as novas funções de IA."</p>
                    </div>
                </article>
                <article class="cardsDepoimentos depoimentos1">
                    <div class="avatar">
                        <img class="avatarPhoto" src="assets/images/pages/index/depoiments3.png" alt="foto do cliente">
                        <div>
                            <h3 class="depoimentsTitle">The Weekend</h3>
                            <figure class="stars">
                                <img src="assets/icons/pages/index/star.svg" alt="estrela de avaliação">
                                <img src="assets/icons/pages/index/star.svg" alt="estrela de avaliação">
                                <img src="assets/icons/pages/index/star.svg" alt="estrela de avaliação">
                                <img src="assets/icons/pages/index/star.svg" alt="estrela de avaliação">
                                <img src="assets/icons/pages/index/star.svg" alt="estrela de avaliação">
                                <img src="assets/icons/pages/index/star.svg" alt="avaliação de 5 estrelas">
                            </figure>
                        </div>
                    </div>
                    <div class="contentDepoiments">
                        <hr class="horizontalLine">
                        <p class="depoimentsText">"Graças ao RH Conexão, encontrei um emprego que realmente faz sentido para mim!"</p>
                    </div>
                </article>
                <article class="cardsDepoimentos depoimentos1">
                    <div class="avatar">
                        <img class="avatarPhoto" src="assets/images/pages/index/depoiments4.png" alt="foto de nosso cliente">
                        <div>
                            <h3 class="depoimentsTitle">LinkPark</h3>
                            <figure class="stars">
                                <img src="assets/icons/pages/index/star.svg" alt="estrela de avaliação">
                                <img src="assets/icons/pages/index/star.svg" alt="estrela de avaliação">
                                <img src="assets/icons/pages/index/star.svg" alt="estrela de avaliação">
                                <img src="assets/icons/pages/index/star.svg" alt="estrela de avaliação">
                                <img src="assets/icons/pages/index/star.svg" alt="estrela de avaliação">
                                <img src="assets/icons/pages/index/star.svg" alt="Ícone de estrela representando avaliação de 5 estrelas">
                            </figure>
                        </div>
                    </div>
                    <div class="contentDepoiments">
                        <hr class="horizontalLine">
                        <p class="depoimentsText">"A nova plataforma otimizou nosso recrutamento, tornando o processo mais rápido e eficiente"</p>
                    </div>
                </article>
                <article class="cardsDepoimentos depoimentos1">
                    <div class="avatar">
                        <img class="avatarPhoto" src="assets/images/pages/index/depoiments5.png" alt="Imagem de nossos clientes">
                        <div>
                            <h3 class="depoimentsTitle">Taylor Swift</h3>
                            <figure class="stars">
                                <img src="assets/icons/pages/index/star.svg" alt="estrela de avaliação">
                                <img src="assets/icons/pages/index/star.svg" alt="estrela de avaliação">
                                <img src="assets/icons/pages/index/star.svg" alt="estrela de avaliação">
                                <img src="assets/icons/pages/index/star.svg" alt="estrela de avaliação">
                                <img src="assets/icons/pages/index/star.svg" alt="estrela de avaliação">
                                <img src="assets/icons/pages/index/star.svg" alt="Ícone de estrela representando avaliação de 5 estrelas">
                            </figure>
                        </div>
                    </div>
                    <div class="contentDepoiments">
                        <hr class="horizontalLine">
                        <p class="depoimentsText">"O website é muito bonito visualmente, adorei as novas funções de IA."</p>
                    </div>
                </article>
            </div>
        </section>

    </main>

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
                <img class="" src="./assets/images/pages/ferramentas/formulario-contato.png" alt="Ilustração representando dúvida">
            </div>
        </div>
    </section>

    <footer>
        <div class="footer-content">
            <div class="footer-contacts">
                <img class="footer-logo" src="assets/images/global/RHconexao-logo.svg" alt="Conexão RH - Rodapé da página">
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
    
    <!-- Modal -->
    <div class="modal-overlay" id="modal">
    <div class="modal-content">
        <button class="close-modal" id="closeModalBtn">&times;</button>

        <h2>Selecione o tipo de conta</h2>
        <p class="subtitle">Como você quer usar a plataforma?</p>

        <div class="user-type-options">
        <div class="option" id="personal">
            <img src="https://img.icons8.com/ios-filled/50/000000/businessman.png" alt="Personal">
            <h3>Colaborador</h3>
            <p>Cadastre-se como candidato, monte seu perfil e aplique para as vagas disponíveis.</p>
        </div>
        <div class="option" id="business">
            <img src="https://img.icons8.com/ios-filled/50/000000/conference.png" alt="Business">
            <h3>Empresa</h3>
            <p>Ideal para empresas que desejam anunciar oportunidades e acompanhar os processos seletivos.</p>
        </div>
        </div>

        <button class="next-button" disabled>Continuar</button>
    </div>
    </div>

    <div class="video-modal-overlay" id="videoModal" hidden>
        <div class="video-modal-content">
            <button class="video-modal-close" id="closeVideoModal" aria-label="Fechar detalhes">&times;</button>
            <div class="video-modal-body">
                <div class="video-modal-player" id="videoModalPlayer"></div>
                <div class="video-modal-info">
                    <h2 class="video-modal-title" id="videoModalTitle"></h2>
                    <p class="video-modal-badges" id="videoModalBadges"></p>
                    <div class="video-modal-meta">
                        <span id="videoModalCreator"></span>
                        <a id="videoModalYoutube" href="#" target="_blank" rel="noopener" class="video-modal-link">
                            <i class="fa-brands fa-youtube"></i> Assistir no YouTube
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script type="text/javascript" src="//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js"></script>
    <script type="text/javascript">(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';fnames[3]='ADDRESS';ftypes[3]='address';fnames[4]='PHONE';ftypes[4]='phone';fnames[5]='BIRTHDAY';ftypes[5]='birthday';}(jQuery));var $mcj = jQuery.noConflict(true);</script>

    <!-- Botão flutuante de voltar ao topo -->
    <button id="backToTopBtn" aria-label="Voltar ao topo">
        <i class="fa fa-arrow-up"></i>
    </button>
</body>
</html>
