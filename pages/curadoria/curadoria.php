<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/pages/curadoria/curadoria.css">
    
    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    
    <script defer src="../../assets/js/pages/curadoria/curadoria.js"></script>
    <script defer src="../../assets/js/global/main.js"></script>

    <!-- miniatura -->
    <link rel="icon" href="../../assets/images/global/RHconexao-icone.png" type="image/png">
    <title>Blog - Conexão RH</title>
</head>
<body>

    <!-- Header -->
    <header class="header">
        <a href="../../index.php" class="logo link">
            <img src="../../assets/images/global/RHconexao-logo.svg" alt="Logotipo da RH Conexão" class="logoEmpresa">
        </a>

        <!-- Botão hamburguer fora da logo -->
        <div class="hamburger">
            <div class="linha"></div>
            <div class="linha"></div>
            <div class="linha"></div>    
        </div>

        <!-- Navegação principal -->
        <nav class="nav-bar">
            <ul class="linkNav">
                <li>
                    <a href="../../index.php" class="linkPages curadoriaLink">Início</a>
                </li>
                <li>
                    <a href="../ferramentas/ferramentas.php" class="linkPages ferramentasLink ativo">Ferramentas</a>
                </li>
                <li>
                    <a href="../sobre/sobre.php" class="linkPages">Quem Somos</a>
                </li>
                <li>
                    <a href="./curadoria.php" class="linkPages linkPagesActive">Curadoria</a>
                </li>
                <li>
                    <a href="../../pages/conect/conect.php" class="linkPages">Conecte-se</a>
                </li>
            </ul>
            <a href="../../pages/login/login.php" class="loginNav btn-mobile" >Entrar</a>
            <a href="../../pages/register/register.php" class="SingninNav btn-mobile">Criar</a>
        </nav>

        <!-- Botões de ação -->
        <div class="linkAcount">
            <a href="../../pages/login/login.php" class="loginNav actionBtnNav btn">Entrar</a>
            <a href="../../pages/register/register.php" class="SingninNav actionBtnNav btn">Crie sua Conta</a>
        </div>
    </header>

    <!-- Hero -->
    <section class="hero">
        <div class="container">
            <div class="hero-text">
                <h1>Bem-vindo a Sessão de Aprendizado da <span class="gradient">Curadoria</span> <br> do Conexão RH<span class="gradient"> 2.0</span></h1>
                <p>Dicas, tendências e insights sobre gestão de pessoas, desenvolvimento profissional e futuro do trabalho. Voltado para empresas e colaboradores.</p>
                <div class="hero-buttons">
                    <a href="#videos-podcasts" class="btn dark">PodCast</a>
                    <a href="#tabs" class="btn">Posts</a>
                </div>
            </div>
            <div class="hero-img">
                <img src="../../assets/images/pages/curadoria/hero-section.png" alt="Ilustração RH">
            </div>
        </div>
    </section>

    <!-- MAin cards-->
    <section class="rh-resource-center">
        <h1 class="rh-resource-title">Centro de Recursos de RH</h1>
        <p class="rh-resource-description">
            Acesse materiais, ferramentas e conteúdos exclusivos para apoiar sua gestão de pessoas e desenvolvimento profissional.
        </p>
    </section>

    <section class="section-search">
        <div class="search-bar-container">
            <span class="search-icon"><i class="fa fa-search"></i></span>
            <input type="text" class="search-input" placeholder="Pesquisar conteúdo, artigo ou vídeo..." aria-label="Pesquisar conteúdo">
            <ul class="search-suggestions"></ul>
        </div>
    </section>

    <section>
        <!-- tabs-->
        <div class="tabs" id="tabs">
            <button class="active">Destaques</button>
            <button>Artigos</button>
            <button>Colaborador</button>
            <button>Empresa</button>
            <button>Vídeos</button>
        </div>

        <div class="chosen-content">
            <div class="chosen-wrapper">

            </div>
        </div>
    </section>

    <!-- Featured -->
    <section class="featured">
        <div class="container">
            <h2>Em destaque para você:</h2>
            <div class="grid">
                <a href="./lista-postagens/detalhe-e1.html" class="card large link">
                    <img src="../../assets/images/pages/curadoria/curadoria-1.jpg" alt="">
                    <div class="content">
                        <!-- Meta informações -->
                        <div class="meta">
                            <span class="category category-empregador">Empregador</span>
                            <span class="category category-gestao">Gestão de Pessoas</span>
                            <span class="date">30 Abril 2024</span>
                            <span class="author">Por RH Conexão</span>
                        </div>

                        <!-- Conteúdo principal -->
                        <h3>PROCESSO DE DEMISSÃO NA EMPRESA: COMO TORNAR O PROCESSO MAIS RESPEITOSO E AGRADÁVEL</h3>
                        <p>
                            Cuidar de um processo de desligamento de um funcionário, assim como o de integração no momento da contratação é algo que faz parte das funções.
                        </p>
                    </div>
                </a>
                <a href="./lista-postagens/detalhe-e2.html" class="card large link">
                    <img src="../../assets/images/pages/curadoria/curadoria-2.jpg" alt="">
                    <div class="content">
                        <!-- Meta informações -->
                        <div class="meta">
                            <span class="category category-colaborador">Colaborador</span>
                            <span class="category category-gestao">Entrevista de Emprego</span>
                            <span class="date">30 Abril 2024</span>
                            <span class="author">Por RH Conexão</span>
                        </div>

                        <!-- Conteúdo principal -->
                        <h3>ENTREVISTA DE EMPREGO: COMO MANDAR BEM E IMPRESSIONAR O RECRUTADOR</h3>
                        <p>
                            Muitas pessoas podem ficar nervosas diante de uma nova oportunidade de trabalho. E é extremamente comum não saber o que falar em uma entrevista de emprego.
                        </p>
                    </div>
                </a>
                <a href="./lista-postagens/detalhe-e3.html" class="card large link">
                    <img src="../../assets/images/pages/curadoria/curadoria-3.jpg" alt="">
                    <div class="content">
                        <!-- Meta informações -->
                        <div class="meta">
                            <span class="category category-empregador">Empregador</span>
                            <span class="category category-gestao">Entrevista de Emprego</span>
                            <span class="date">25 Abril 2024</span>
                            <span class="author">Por RH Conexão</span>
                        </div>

                        <!-- Conteúdo principal -->
                        <h3>ENTREVISTA: PERGUNTAS QUE NÃO DEVE FAZER</h3>
                        <p>
                            Por que um roteiro é importante na hora de realizar uma entrevista? Um roteiro de entrevista, quando feito corretamente, traz ótimas contratações para todas as empresas
                        </p>
                    </div>
                </a>
                <a href="./lista-postagens/detalhe-e4.html" class="card large link">
                    <img src="../../assets/images/pages/curadoria/curadoria-4.png" alt="">
                    <div class="content">
                        <!-- Meta informações -->
                        <div class="meta">
                            <span class="category category-colaborador">Colaborador</span>
                            <span class="category category-gestao">Entrevista de Emprego</span>
                            <span class="date">20 Abril 2024</span>
                            <span class="author">Por RH Conexão</span>
                        </div>

                        <!-- Conteúdo principal -->
                        <h3>LEGISLAÇÃO TRABALHISTAS</h3>
                        <p>
                            As leis trabalhistas são de extrema importância para garantir os direitos e a proteção dos trabalhadores. No contexto histórico, o surgimento das leis trabalhistas está sendo cumprida.
                        </p>
                    </div>
                </a>
                <a href="./lista-postagens/detalhe-e5.html" class="card large link">
                    <img src="../../assets/images/pages/curadoria/curadoria-5.webp" alt="">
                    <div class="content">
                        <!-- Meta informações -->
                        <div class="meta">
                            <span class="category category-clt">CLT</span>
                            <span class="category category-colaborador">Colaborador</span>
                            <span class="date">23 Março 2024</span>
                            <span class="author">Por RH Conexão</span>
                        </div>

                        <!-- Conteúdo principal -->
                        <h3>FÉRIAS</h3>
                        <p>
                            O que são férias no contexto do direito trabalhista? Férias são um período de descanso remunerado concedido ao trabalhador após um determinado período de trabalho.
                        </p>
                    </div>
                </a>
                <a href="./lista-postagens/detalhe-e6.html" class="card large link">
                    <img src="../../assets/images/pages/curadoria/curadoria-6.jpg" alt="">
                    <div class="content">
                        <!-- Meta informações -->
                        <div class="meta">
                            <span class="category category-clt">CLT</span>
                            <span class="category category-empregador">Empregador</span>
                            <span class="date">23 Março 2024</span>
                            <span class="author">Por RH Conexão</span>
                        </div>

                        <!-- Conteúdo principal -->
                        <h3>RECRUTAMENTO E SELEÇÃO</h3>
                        <p>
                            Perguntas e Respostas sobre Recrutamento e Seleção Recrutamento O que é Recrutamento? O recrutamento é um processo de atração que, por meio das redes de sociais
                        </p>
                    </div>
                </a>
                <a href="./lista-postagens/detalhe-e7.html" class="card large link">
                    <img src="../../assets/images/pages/curadoria/curadoria-7.jpg" alt="">
                    <div class="content">
                        <!-- Meta informações -->
                        <div class="meta">
                            <span class="category category-clt">CLT</span>
                            <span class="category category-colaborador">Colaborador</span>
                            <span class="date">23 Março 2024</span>
                            <span class="author">Por RH Conexão</span>
                        </div>

                        <!-- Conteúdo principal -->
                        <h3>BENEFÍCIOS</h3>
                        <p>
                            O QUE É BENEFÍCIO? Benefício é uma forma extra de que a empresa tem de recompensar seus colaboradores pelo trabalho exercido na empresa, ...
                        </p>
                    </div>
                </a>
                <a href="./lista-postagens/detalhe-e8.html" class="card large link">
                    <img src="../../assets/images/pages/curadoria/curadoria-8.jpg" alt="">
                    <div class="content">
                        <!-- Meta informações -->
                        <div class="meta">
                            <span class="category category-colaborador">Colaborador</span>
                            <span class="date">23 Março 2024</span>
                            <span class="author">Por RH Conexão</span>
                        </div>

                        <!-- Conteúdo principal -->
                        <h3>PROCESSO DE ADMISSÃO</h3>
                        <p>
                            Admissão Admissão é um vínculo jurídico e um compromisso firmado entre o empregador e o empregado, sendo que, por meio desse vínculo, fica estabelecido que...
                        </p>
                    </div>
                </a>
                <a href="./lista-postagens/detalhe-e9.html" class="card large link">
                    <img src="../../assets/images/pages/curadoria/curadoria-9.webp" alt="">
                    <div class="content">
                        <!-- Meta informações -->
                        <div class="meta">
                            <span class="category category-clt">CLT</span>
                            <span class="category category-empregador">Empregador</span>
                            <span class="date">23 Março 2024</span>
                            <span class="author">Por RH Conexão</span>
                        </div>

                        <!-- Conteúdo principal -->
                        <h3>DEPARTAMENTO PESSOAL</h3>
                        <p>
                            O Departamento Pessoal é o setor onde se cuida de toda a parte burocrática da empresa sendo que o objetivo principal do Departamento Pessoal é...
                        </p>
                    </div>
                </a>
                <a href="./lista-postagens/detalhe-e10.html" class="card large link">
                    <img src="../../assets/images/pages/curadoria/curadoria-10.webp" alt="">
                    <div class="content">
                        <!-- Meta informações -->
                        <div class="meta">
                            <span class="category category-colaborador">Colaborador</span>
                            <span class="category category-empregador">Empregador</span>
                            <span class="date">23 Março 2024</span>
                            <span class="author">Por RH Conexão</span>
                        </div>

                        <!-- Conteúdo principal -->
                        <h3>DEPARTAMENTO PESSOAL</h3>
                        <p>
                            O que é treinamento e desenvolvimento?    Treinamento e desenvolvimento é um processo que busca treinar e desenvolver novos colaboradores de uma empresa para que...
                        </p>
                    </div>
                </a>
                <a href="./lista-postagens/detalhe-e11.html" class="card large link">
                    <img src="../../assets/images/pages/curadoria/curadoria-11.jpg" alt="">
                    <div class="content">
                        <!-- Meta informações -->
                        <div class="meta">
                            <span class="category category-colaborador">Colaborador</span>
                            <span class="category category-empregador">Empregador</span>
                            <span class="date">20 Março 2024</span>
                            <span class="author">Por RH Conexão</span>
                        </div>

                        <!-- Conteúdo principal -->
                        <h3>CULTURA ORGANIZACIONAL</h3>
                        <p>
                            O QUE É CULTURA ORGANIZACIONAL? A cultura organizacional de uma empresa se refere às crenças, valores e comportamentos compartilhados pelos membros de uma equipe.
                        </p>
                    </div>
                </a>
                <a href="./lista-postagens/detalhe-e12.html" class="card large link">
                    <img src="../../assets/images/pages/curadoria/curadoria-12.jpg" alt="">
                    <div class="content">
                        <!-- Meta informações -->
                        <div class="meta">
                            <span class="category category-colaborador">Colaborador</span>
                            <span class="category category-empregador">Empregador</span>
                            <span class="date">19 Março 2024</span>
                            <span class="author">Por RH Conexão</span>
                        </div>

                        <!-- Conteúdo principal -->
                        <h3>HISTÓRIA DO RH</h3>
                        <p>
                            A área de Recursos Humanos é relativamente recente, tendo surgido no início do século 20. Na época, era chamada de Relações Industriais devido ao impacto.
                        </p>
                    </div>
                </a>
                <a href="./lista-postagens/detalhe-e13.html" class="card large link">
                    <img src="../../assets/images/pages/curadoria/curadoria-13.png" alt="">
                    <div class="content">
                        <!-- Meta informações -->
                        <div class="meta">
                            <span class="category category-empregador">Empregador</span>
                            <span class="category category-gestao">Departamento Pessoal</span>
                            <span class="date">10 Junho 2025</span>
                            <span class="author">Por RH Conexão</span>
                        </div>

                        <!-- Conteúdo principal -->
                        <h3>ROTINAS DE ADIMISSÃO</h3>
                        <p>
                            Navegar pelo processo de admissão de novos colaboradores pode ser complexo. Saiba quais são as etapas essenciais, os documentos necessários e as melhores práticas para garantir uma contratação legal e eficiente, protegendo tanto a sua empresa quanto o novo funcionário.
                        </p>
                    </div>
                </a>
                <a href="./lista-postagens/detalhe-e14.html" class="card large link">
                    <img src="../../assets/images/pages/curadoria/curadoria-14.png" alt="">
                    <div class="content">
                        <!-- Meta informações -->
                        <div class="meta">
                            <span class="category category-clt">Cultura Organizacional</span>
                            <span class="category category-gestao">Gestão de Benefícios</span>
                            <span class="date">11 Junho 2025</span>
                            <span class="author">Por RH Conexão</span>
                        </div>

                        <!-- Conteúdo principal -->
                        <h3>GESTÃO DE BENEFÍCIOS</h3>
                        <p>
                            Entenda a diferença entre benefícios legais e espontâneos e aprenda a criar um pacote de vantagens que vai além do obrigatório. Este guia detalha desde os direitos garantidos pela CLT até as melhores práticas para uma gestão estratégica, alinhada à cultura da sua empresa e capaz de engajar e reter os melhores profissionais.
                        </p>
                    </div>
                </a>
                <a href="./lista-postagens/detalhe-e15.html" class="card large link">
                    <img src="../../assets/images/pages/curadoria/curadoria-15.png" alt="">
                    <div class="content">
                        <!-- Meta informações -->
                        <div class="meta">
                            <span class="category category-empregador">Cultura Organizacional</span>
                            <span class="category category-clt">Gestão de Benefícios</span>
                            <span class="date">11 Junho 2025</span>
                            <span class="author">Por RH Conexão</span>
                        </div>

                        <!-- Conteúdo principal -->
                        <h3>O Guia Essencial de RH: Leis Trabalhistas, Recrutamento e Avaliação de Desempenho</h3>
                        <p>
                            Navegue pelos pilares da gestão de pessoas com este guia completo. Abordamos desde as principais normas e leis trabalhistas que regem o mercado brasileiro, passando pelas etapas e tendências do recrutamento e seleção.
                        </p>
                    </div>
                </a>
                <a href="./lista-postagens/detalhe-e16.html" class="card large link">
                    <img src="../../assets/images/pages/curadoria/curadoria-16.png" alt="">
                    <div class="content">
                        <!-- Meta informações -->
                        <div class="meta">
                            <span class="category category-empregador">Direito do Trabalho</span>
                            <span class="category category-colaborador">Relações de Trabalho</span>
                            <span class="date">11 Junho 2025</span>
                            <span class="author">Por RH Conexão</span>
                        </div>

                        <!-- Conteúdo principal -->
                        <h3>Guia Completo de Representação do Empregador: Direitos e Deveres nas Relações de Trabalho</h3>
                        <p>
                            Entenda o que significa representar o empregador e como agir nas principais situações da relação de trabalho. Este guia aborda desde a formalização de contratos e a gestão de conflitos até a defesa em processos trabalhistas e negociações com sindicatos. Saiba como proteger os interesses da empresa e garantir a conformidade com a legislação.
                        </p>
                    </div>
                </a>
                <a href="./lista-postagens/detalhe-e17.html" class="card large link">
                    <img src="../../assets/images/pages/curadoria/curadoria-17.png" alt="">
                    <div class="content">
                        <!-- Meta informações -->
                        <div class="meta">
                            <span class="category category-colaborador">Demissão Humanizada</span>
                            <span class="category category-clt">CLT</span>
                            <span class="date">11 Junho 2025</span>
                            <span class="author">Por RH Conexão</span>
                        </div>

                        <!-- Conteúdo principal -->
                        <h3>Admissão e Demissão: O Guia Definitivo do RH para Processos Legais e Humanizados</h3>
                        <p>
                            Este guia detalha cada etapa do processo de admissão, desde a documentação correta até a integração, e aborda todos os tipos de demissão, com foco em uma condução legal, responsável e humanizada. Um manual indispensável para profissionais de RH que buscam segurança jurídica e um ambiente de trabalho respeitoso.
                        </p>
                    </div>
                </a>
                <a href="./lista-postagens/detalhe-e18.html" class="card large link">
                    <img src="../../assets/images/pages/curadoria/curadoria-18.png" alt="">
                    <div class="content">
                        <!-- Meta informações -->
                        <div class="meta">
                            <span class="category category-gestao">Gestão de Pessoas</span>
                            <span class="category category-empregador">Cultura Organizacional</span>
                            <span class="date">11 Junho 2025</span>
                            <span class="author">Por RH Conexão</span>
                        </div>

                        <!-- Conteúdo principal -->
                        <h3>Cultura e Capacitação: Como Criar um Ambiente Organizacional Positivo e Investir em Treinamento e Desenvolvimento</h3>
                        <p>
                            Descubra como o "clima" da sua empresa impacta diretamente a produtividade e o bem-estar da equipe. Este guia completo ensina a criar um ambiente organizacional positivo e a medir sua eficácia. Além disso, explore a importância estratégica do Treinamento e Desenvolvimento (T&D) para impulsionar o desempenho, engajar colaboradores e garantir o sucesso do seu negócio.
                        </p>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- Videos e podcast -->
    <section class="section-videos-podcasts" id="videos-podcasts">
        <div class="container">
            <h2 class="section-title"><i class="fa-solid fa-video"></i> Vídeos & Podcasts</h2>
            <p class="section-desc">Assista e ouça conteúdos exclusivos sobre RH, carreira, liderança e inovação.</p>
            <div class="media-grid">
                <!-- Vídeo 1 -->
                <div class="media-card">
                    <div class="media-thumb">
                        <img src="../../assets/images/pages/curadoria/rh-1.png" alt="Thumb vídeo 1" loading="lazy">
                        <button class="play-btn" aria-label="Assistir vídeo">
                            <i class="fa-solid fa-play"></i>
                        </button>
                    </div>
                    <div class="media-info">
                        <span class="media-type video"><i class="fa-solid fa-film"></i> Vídeo</span>
                        <h3 class="media-title">Os 6 Tipos de Cultura Organizacional: Qual é a Ideal para o Seu Negócio?</h3>
                        <p class="media-meta">Por RH Conexão • 11:17 min • 2024</p>
                        <p class="media-desc">A cultura de uma empresa vai muito além de manuais e regras. Ela é o conjunto de valores, comportamentos e práticas que define o ambiente de trabalho e impulsiona os resultados.</p>
                    </div>
                </div>
                <!-- Podcast 1 -->
                <div class="media-card">
                    <div class="media-thumb">
                        <img src="../../assets/images/pages/curadoria/duvidas-1.png" alt="Thumb podcast 1" loading="lazy">
                        <a href="https://open.spotify.com/episode/xxxxxxx" target="_blank" class="play-btn" aria-label="Ouvir podcast">
                            <i class="fa-solid fa-headphones"></i>
                        </a>
                    </div>
                    <div class="media-info">
                        <span class="media-type podcast"><i class="fa-solid fa-podcast"></i> Podcast</span>
                        <h3 class="media-title">POD OU NÃO POD RH - EP 1</h3>
                        <p class="media-meta">Por RH Conexão • 6:50 min • 2024</p>
                        <p class="media-desc">Tem dúvidas sobre leis trabalhistas? Convidamos o especialista Valdir Vonsalves para responder de forma simples: Qual a diferença entre insalubridade e periculosidade? Posso ter dois empregos registrados? Estabilidade protege contra qualquer demissão? Ouça e receba dicas valiosas para a carreira em RH.</p>
                    </div>
                </div>
                <!-- Vídeo 2 -->
                <div class="media-card">
                    <div class="media-thumb">
                        <img src="../../assets/images/pages/curadoria/rh-2.png" alt="Thumb vídeo 2" loading="lazy">
                        <button class="play-btn" aria-label="Assistir vídeo">
                            <i class="fa-solid fa-play"></i>
                        </button>
                    </div>
                    <div class="media-info">
                        <span class="media-type video"><i class="fa-solid fa-film"></i> Vídeo</span>
                        <h3 class="media-title">Cultura Organizacional Tóxica: A Parábola dos Cinco Macacos</h3>
                        <p class="media-meta">Por RH Conexão • 1:22 min • 2024</p>
                        <p class="media-desc">Uma história sobre macacos que explica por que, às vezes, as equipes têm medo de tentar algo novo. Entenda de forma simples o perigo da cultura do "sempre foi assim".</p>
                    </div>
                </div>
                <!-- Podcast 2 -->
                <div class="media-card">
                    <div class="media-thumb">
                        <img src="../../assets/images/pages/curadoria/duvidas-2.png" alt="Thumb podcast 2" loading="lazy">
                        <a href="https://open.spotify.com/episode/yyyyyyy" target="_blank" class="play-btn" aria-label="Ouvir podcast">
                            <i class="fa-solid fa-headphones"></i>
                        </a>
                    </div>
                    <div class="media-info">
                        <span class="media-type podcast"><i class="fa-solid fa-podcast"></i> Podcast</span>
                        <h3 class="media-title">POD OU NÃO POD RH - EP 2</h3>
                        <p class="media-meta">Por RH Conexão • 6:50 min • 2024</p>
                        <p class="media-desc">Neste bate-papo, tiramos as dúvidas mais comuns do direito trabalhista. Saiba as regras para ter múltiplos empregos, entenda os limites da estabilidade, como funciona o adicional noturno e as regras para aposentados que continuam trabalhando. Tudo de forma rápida e sem complicação.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="media-more-wrapper">
        <button class="btn media-more-btn" id="showMoreVideosBtn" aria-label="Ver mais vídeos">
            <i class="fa-solid fa-chevron-down arrow"></i>
        </button>
    </div>
    <div class="media-youtube-list" id="mediaYoutubeList" style="display: none;">
        <div class="media-youtube-grid">
            <!-- Vídeo 1 -->
            <div class="media-youtube-card">
                <iframe class="media-youtube-iframe" src="https://www.youtube.com/embed/F-mvgoG0lLc?si=rTQ3DaPBmSdXyF3h" title="Crédito do Trabalhador E-consignado - Econet" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" loading="lazy" allowfullscreen></iframe>
                <h4 class="media-youtube-title">Crédito do Trabalhador E-consignado - Econet</h4>
            </div>
            <!-- Vídeo 2 -->
            <div class="media-youtube-card">
                <iframe class="media-youtube-iframe" src="https://www.youtube.com/embed/FxfaBy7Dj2s?si=JG_DqeBZ8ggMXKrL" title="Hora Extra - Econet" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" loading="lazy" allowfullscreen></iframe>
                <h4 class="media-youtube-title">Hora Extra - Econet</h4>
            </div>
            <!-- Vídeo 3 -->
            <div class="media-youtube-card">
                <iframe class="media-youtube-iframe" src="https://www.youtube.com/embed/LwS_Ex3Z-EA?si=yaibWY6JH0rYOvtS" title="Calculo do 13º Salário - Econet" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" loading="lazy" allowfullscreen></iframe>
                <h4 class="media-youtube-title">Cálculo do 13º Salário - Econet</h4>
            </div>
            <!-- Vídeo 4 -->
            <div class="media-youtube-card">
                <iframe class="media-youtube-iframe" src="https://www.youtube.com/embed/rVGaWZb_yMY?si=u8AbySUEVqOWQ8UL" title="Prazos para Recontratação de Ex-Funcionário - Econet" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" loading="lazy" allowfullscreen></iframe>
                <h4 class="media-youtube-title">Prazos para Recontratação de Ex-Funcionário - Econet</h4>
            </div>
            <!-- Vídeo 5 -->
            <div class="media-youtube-card">
                <iframe class="media-youtube-iframe" src="https://www.youtube.com/embed/GNfMBeLhldo?si=ENuvmvSFA__kwRjG" title="Carnaval é Feriado? Direitos e deveres do trabalhador. - Econet" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" loading="lazy" allowfullscreen></iframe>
                <h4 class="media-youtube-title">Carnaval é Feriado? Direitos e deveres do trabalhador. - Econet</h4>
            </div>
        </div>
    </div>

    <section class="recommended-posts">
        <h2>Recomendados para você</h2>
        <div class="recommended-cards" id="recommendedCards"></div>
        <button class="btn" id="nextRecommendationsBtn" aria-label="Ver outras recomendações">
            <i class="fa fa-arrow-right"></i> Ver outros posts
        </button>
    </section>

    <!-- Latest -->
    <section class="latest">
        <div class="container">
            <h2>Últimos Artigos</h2>
            <div class="grid">
                <div class="post">
                    <img src="../../assets/images/pages/curadoria/news-1.png" alt="">
                    <h3>10 Estratégias para Melhorar a Comunicação Interna</h3>
                </div>
                <div class="post">
                    <img src="../../assets/images/pages/curadoria/news-2.png" alt="">
                    <h3>Feedback Contínuo: Como Implementar na sua Empresa</h3>
                </div>
                <div class="post">
                    <img src="../../assets/images/pages/curadoria/news-3.png" alt="">
                    <h3>Desenvolvimento de Lideranças: Guia Completo</h3>
                </div>
                <div class="post">
                    <img src="../../assets/images/pages/curadoria/news-4.png" alt="">
                    <h3>RH Ágil: Como Aplicar Métodos Ágeis na Gestão de Pessoas</h3>
                </div>
            </div>
        </div>
    </section>

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="container">
            <h3>Posts Populares</h3>
            <ol>
                <li><a class="link" href="./lista-postagens/detalhe-e13">Gestão Humanizada: O Diferencial das Empresas do Futuro</a></li>
                <li><a class="link" href="./lista-postagens/detalhe-e14">Feedback Contínuo: Como Implementar na sua Empresa</a></li>
                <li><a class="link" href="./lista-postagens/detalhe-e15">Como Atrair e Reter Talentos na Nova Economia</a></li>
                <li><a class="link" href="./lista-postagens/detalhe-e3">5 Soft Skills Essenciais para Profissionais de RH</a></li>
                <li><a class="link" href="./lista-postagens/detalhe-e16">Desenvolvimento de Lideranças: Guia Completo</a></li>
            </ol>
        </div>
    </aside>

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

    <button id="backToTopBtn" aria-label="Voltar ao topo">
        <i class="fa fa-arrow-up"></i>
    </button>

    <div class="media-detail-panel" id="mediaDetailPanel" tabindex="-1" aria-modal="true" hidden>
        <button class="close-panel" id="closeMediaDetail" aria-label="Fechar detalhes">&times;</button>
        <div class="media-detail-content" id="mediaDetailContent">

        </div>
    </div>
    <div class="media-detail-overlay" id="mediaDetailOverlay" hidden></div>
</body>
</html>
