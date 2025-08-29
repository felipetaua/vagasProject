document.addEventListener('DOMContentLoaded', function() {
    const exclusiveContent = [
        {
            image: "../../../../assets/images/pages/curadoria/curadoria-1.jpg",
            badge: "Gestão",
            title: "Processo de Demissão: Como Tornar Mais Respeitoso",
            excerpt: "Cuidar de um processo de desligamento de um funcionário, assim como o de integração, é algo que faz parte das funções.",
            linkText: "Ler Artigo →",
            linkUrl: "/pages/curadoria/lista-postagens/detalhe-e1"
        },
        {
            image: "../../../../assets/images/pages/curadoria/curadoria-2.jpg",
            badge: "Carreira",
            title: "Entrevista de Emprego: Como Impressionar o Recrutador",
            excerpt: "Muitas pessoas podem ficar nervosas diante de uma nova oportunidade de trabalho. Saiba o que falar em uma entrevista.",
            linkText: "Ler Artigo →",
            linkUrl: "/pages/curadoria/lista-postagens/detalhe-e2"
        },
        {
            image: "../../../../assets/images/pages/curadoria/curadoria-3.jpg",
            badge: "Recrutamento",
            title: "Entrevista: Perguntas que Não Devem Ser Feitas",
            excerpt: "Um roteiro de entrevista, quando feito corretamente, traz ótimas contratações para todas as empresas. Saiba o que evitar.",
            linkText: "Ler Artigo →",
            linkUrl: "/pages/curadoria/lista-postagens/detalhe-e3"
        },
        {
            image: "../../../../assets/images/pages/curadoria/curadoria-4.png",
            badge: "Direito",
            title: "Guia Essencial de Legislação Trabalhista",
            excerpt: "As leis trabalhistas são de extrema importância para garantir os direitos e a proteção dos trabalhadores. Conheça os pontos principais.",
            linkText: "Ler Artigo →",
            linkUrl: "/pages/curadoria/lista-postagens/detalhe-e4"
        },
        {
            image: "../../../../assets/images/pages/curadoria/curadoria-5.webp",
            badge: "Direito",
            title: "Férias: Entenda Seus Direitos e Como Calcular",
            excerpt: "Férias são um período de descanso remunerado concedido ao trabalhador. Saiba tudo sobre este importante direito.",
            linkText: "Ler Artigo →",
            linkUrl: "/pages/curadoria/lista-postagens/detalhe-e5"
        },
        {
            image: "../../../../assets/images/pages/curadoria/curadoria-6.jpg",
            badge: "Recrutamento",
            title: "Recrutamento e Seleção: Perguntas e Respostas",
            excerpt: "O recrutamento é um processo de atração que, por meio das redes sociais e outras ferramentas, busca os melhores talentos.",
            linkText: "Ler Artigo →",
            linkUrl: "/pages/curadoria/lista-postagens/detalhe-e6"
        },
        {
            image: "../../../../assets/images/pages/curadoria/curadoria-7.jpg",
            badge: "Gestão",
            title: "Gestão de Benefícios para Reter Talentos",
            excerpt: "Benefício é uma forma extra de que a empresa tem de recompensar seus colaboradores pelo trabalho exercido.",
            linkText: "Ler Artigo →",
            linkUrl: "/pages/curadoria/lista-postagens/detalhe-e7"
        },
        {
            image: "../../../../assets/images/pages/curadoria/curadoria-8.jpg",
            badge: "Processos",
            title: "O Guia Completo do Processo de Admissão",
            excerpt: "Admissão é o vínculo jurídico e o compromisso firmado entre o empregador e o empregado. Entenda cada etapa.",
            linkText: "Ler Artigo →",
            linkUrl: "../../../../pages/curadoria/lista-postagens/detalhe-e8"
        },
        {
            image: "../../../../assets/images/pages/curadoria/curadoria-9.webp",
            badge: "Gestão",
            title: "O Papel Estratégico do Departamento Pessoal",
            excerpt: "O Departamento Pessoal é o setor onde se cuida de toda a parte burocrática da empresa, sendo vital para a organização.",
            linkText: "Ler Artigo →",
            linkUrl: "/pages/curadoria/lista-postagens/detalhe-e9"
        },
        {
            image: "../../../../assets/images/pages/curadoria/curadoria-10.webp",
            badge: "Desenvolvimento",
            title: "Treinamento e Desenvolvimento de Colaboradores",
            excerpt: "Treinamento e desenvolvimento é um processo que busca capacitar e aprimorar as habilidades dos colaboradores de uma empresa.",
            linkText: "Ler Artigo →",
            linkUrl: "/pages/curadoria/lista-postagens/detalhe-e10"
        },
        {
            image: "../../../../assets/images/pages/curadoria/curadoria-11.jpg",
            badge: "Cultura",
            title: "Cultura Organizacional: O que é e Como Fortalecer",
            excerpt: "A cultura organizacional se refere às crenças, valores e comportamentos compartilhados pelos membros de uma equipe.",
            linkText: "Ler Artigo →",
            linkUrl: "/pages/curadoria/lista-postagens/detalhe-e11"
        },
        {
            image: "../../../../assets/images/pages/curadoria/curadoria-12.jpg",
            badge: "História",
            title: "A Evolução e a História dos Recursos Humanos",
            excerpt: "A área de Recursos Humanos é relativamente recente, tendo surgido no início do século 20. Conheça sua trajetória.",
            linkText: "Ler Artigo →",
            linkUrl: "/pages/curadoria/lista-postagens/detalhe-e12"
        }
    ];

    const contentGrid = document.querySelector('.content-grid');

    if (contentGrid) {
        // Limpa o conteúdo estático para evitar duplicação
        contentGrid.innerHTML = ''; 

        exclusiveContent.forEach(content => {
            const card = document.createElement('article');
            card.className = 'content-card';
            card.innerHTML = `
                <img src="${content.image}" alt="${content.title}" class="card-image">
                <div class="card-body">
                    <span class="card-badge">${content.badge}</span>
                    <h3 class="card-title">${content.title}</h3>
                    <p class="card-excerpt">${content.excerpt}</p>
                    <div class="card-footer">
                        <a href="${content.linkUrl}">${content.linkText}</a>
                    </div>
                </div>
            `;
            contentGrid.appendChild(card);
        });
    }
});