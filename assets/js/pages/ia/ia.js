document.addEventListener('DOMContentLoaded', function () {

    // --- Bloco 1: Funcionalidades Gerais (Menu e Notificações) ---

    // Menu hamburguer
    const menuBtn = document.getElementById('mobile-menu-btn');
    const sidebar = document.getElementById('sidebar');
    if (menuBtn && sidebar) {
        menuBtn.addEventListener('click', function () {
            sidebar.classList.toggle('show');
        });
    }

    // Pop-up de Notificações
    const notificationBtn = document.getElementById('notification-trigger');
    const notificationPopup = document.getElementById('notification-popup');
    if (notificationBtn && notificationPopup) {
        notificationBtn.addEventListener('click', function (e) {
            e.stopPropagation();
            notificationPopup.classList.toggle('open');
        });
    }
    
    // --- Bloco 2: Lógica dos Modais e Acordeões ---

    // Seleciona os elementos para AMBOS os modais
    const resumeModal = document.getElementById("resumePromptModal");
    const interviewModal = document.getElementById("promptModal");

    const openResumeBtn = document.getElementById("openResumeModalBtn");
    const openInterviewBtn = document.getElementById("generate-questions-btn");

    const closeResumeBtn = document.querySelector(".close-resume-btn");
    const closeInterviewBtn = document.querySelector(".close-btn");

    // Adiciona os eventos de abrir e fechar para cada modal
    // Garante que os elementos existem antes de adicionar eventos
    if (openResumeBtn && resumeModal) {
        openResumeBtn.addEventListener('click', (e) => {
            e.preventDefault();
            resumeModal.style.display = "block";
        });
    }

    if (closeResumeBtn && resumeModal) {
        closeResumeBtn.addEventListener('click', () => {
            resumeModal.style.display = "none";
        });
    }
    
    if (openInterviewBtn && interviewModal) {
        openInterviewBtn.addEventListener('click', () => {
            interviewModal.style.display = "block";
        });
    }

    if (closeInterviewBtn && interviewModal) {
        closeInterviewBtn.addEventListener('click', () => {
            interviewModal.style.display = "none";
        });
    }


    // Lógica para fechar QUALQUER modal ao clicar fora
    // Usamos um único evento para controlar os dois modais
    window.addEventListener('click', (event) => {
        if (resumeModal && event.target == resumeModal) {
            resumeModal.style.display = 'none';
        }
        if (interviewModal && event.target == interviewModal) {
            interviewModal.style.display = 'none';
        }
        if (coverLetterModal && event.target == coverLetterModal) {
            coverLetterModal.style.display = 'none';
        }
        // Fecha o popup de notificação também
        if (notificationPopup && notificationPopup.classList.contains('open') && !notificationPopup.contains(event.target) && event.target !== notificationBtn) {
            notificationPopup.classList.remove('open');
        }
    });

    // --- Lógica do Acordeão do Modal de Currículo (Resume) ---
    const resumeAccordionHeaders = document.querySelectorAll(".resume-accordion-header");
    resumeAccordionHeaders.forEach(header => {
        header.addEventListener("click", function() {
            // Fecha outros acordeões abertos para manter apenas um ativo
            resumeAccordionHeaders.forEach(otherHeader => {
                if (otherHeader !== this) {
                    otherHeader.classList.remove('active');
                    otherHeader.nextElementSibling.style.maxHeight = null;
                }
            });
            
            // Abre ou fecha o acordeão clicado
            this.classList.toggle("active");
            const accordionContent = this.nextElementSibling;
            if (accordionContent.style.maxHeight) {
                accordionContent.style.maxHeight = null;
            } else {
                accordionContent.style.maxHeight = accordionContent.scrollHeight + "px";
            }
        });
    });

    // --- Lógica do Acordeão do Modal de Entrevista (Interview) ---
    const interviewAccordionHeaders = document.querySelectorAll(".accordion-header");
    interviewAccordionHeaders.forEach(header => {
        header.addEventListener("click", function() {
            this.classList.toggle("active");
            const accordionContent = this.nextElementSibling;
            if (accordionContent.style.maxHeight) {
                accordionContent.style.maxHeight = null;
            } else {
                accordionContent.style.maxHeight = accordionContent.scrollHeight + "px";
            }
        });
    });

    // --- Lógica para Copiar Texto (ambos os modais) ---
    // Função genérica de feedback para o botão de copiar
    function showCopyFeedback(button, originalText) {
        button.innerText = "Copiado!";
        const originalColor = button.style.backgroundColor;
        button.style.backgroundColor = '#047857'; 

        setTimeout(() => {
            button.innerText = originalText;
            button.style.backgroundColor = originalColor;
        }, 2000);
    }

    // Botões de cópia do modal de currículo
    const resumeCopyButtons = document.querySelectorAll(".resume-copy-btn");
    resumeCopyButtons.forEach(button => {
        button.addEventListener("click", function() {
            const targetId = this.getAttribute("data-target");
            const targetElement = document.getElementById(targetId);
            navigator.clipboard.writeText(targetElement.innerText).then(() => {
                showCopyFeedback(this, 'Copiar Prompt');
            }).catch(err => console.error('Falha ao copiar:', err));
        });
    });

    // Botões de cópia do modal de entrevista
    const interviewCopyButtons = document.querySelectorAll(".copy-btn");
    interviewCopyButtons.forEach(button => {
        button.addEventListener("click", function() {
            const targetId = this.getAttribute("data-target");
            const targetElement = document.getElementById(targetId);
            navigator.clipboard.writeText(targetElement.innerText).then(() => {
                showCopyFeedback(this, 'Copiar');
            }).catch(err => console.error('Falha ao copiar:', err));
        });
    });

    const coverLetterModal = document.getElementById('coverLetterModal');
    const openCoverLetterBtn = document.getElementById('openCoverLetterModalBtn');
    const closeCoverLetterBtn = document.querySelector('.close-btn-cover-letter');
    
    const copyCoverLetterBtn = document.getElementById('copyCoverLetterBtn');
    const regenerateCoverLetterBtn = document.getElementById('regenerateCoverLetterBtn');
    const coverLetterTextArea = document.getElementById('coverLetterText');

    // Lista de rascunhos de carta de apresentação
    const coverLetterTemplates = [
    {
        title: "Modelo Padrão",
        sector: "Geral",
        text: `Prezado(a) [Nome do Gerente de Contratação],

    Escrevo para expressar meu grande interesse na vaga de [Nome da Vaga] na [Nome da Empresa], conforme anunciado em [Onde você viu a vaga]. Com [Número] anos de experiência em [Sua Área], desenvolvi uma forte paixão por [Aspecto específico da área], e estou confiante de que minhas habilidades em [Habilidade 1] e [Habilidade 2] me tornam um candidato ideal para esta oportunidade.

    Em meu cargo anterior na [Empresa Anterior], fui responsável por [Uma responsabilidade chave], onde obtive sucesso em [Um resultado ou conquista quantificável]. Estou particularmente atraído(a) pela [Nome da Empresa] devido a [Mencione algo que você admira na empresa, como sua cultura, inovação ou um projeto específico].

    Anexei meu currículo para sua análise e ficaria muito feliz com a oportunidade de discutir como minhas competências e entusiasmo podem beneficiar sua equipe.

    Agradeço sua atenção e tempo.

    Atenciosamente,
    [Seu Nome Completo]`
        },
        {
            title: "Modelo para Mudança de Carreira",
            sector: "Transição",
            text: `À equipe de recrutamento da [Nome da Empresa],

    Escrevo para me candidatar à vaga de [Nome da Vaga]. Embora minha trajetória profissional tenha sido focada em [Sua Área Anterior], desenvolvi competências altamente transferíveis em [Habilidade Transferível 1] e [Habilidade Transferível 2], que são diretamente aplicáveis aos desafios desta posição.

    Minha experiência em [Descreva uma conquista relevante da carreira anterior] me ensinou a [Resultado aprendido, ex: otimizar processos e liderar projetos com eficiência]. Estou em transição de carreira para a área de [Nova Área] por um profundo interesse em [Motivo do interesse], e a [Nome da Empresa] se destaca por [Motivo pelo qual a empresa é atraente para você].

    Estou convencido(a) de que minha capacidade de aprender rapidamente e minha nova perspectiva podem agregar um valor único à sua equipe.

    Agradeço a consideração e aguardo a oportunidade de uma conversa.

    Cordialmente,
    [Seu Nome Completo]`
        },
        {
            title: "Modelo para Recém-Formado",
            sector: "Início de Carreira",
            text: `Prezado(a) [Nome do Gerente de Contratação],

    Com grande entusiasmo, candidato-me à vaga de [Nome da Vaga] na [Nome da Empresa]. Como recém-formado(a) em [Seu Curso] pela [Nome da Universidade], busco uma oportunidade para aplicar meu conhecimento acadêmico e minha paixão por [Sua Área de Interesse] em um ambiente dinâmico e inovador.

    Durante meus estudos, destaquei-me no projeto [Nome de um projeto acadêmico ou estágio], no qual fui responsável por [Sua responsabilidade] e aprendi a [Habilidade adquirida]. A cultura de [Valor da empresa, ex: colaboração e crescimento] da [Nome da Empresa] é exatamente o que procuro para iniciar minha carreira.

    Estou ansioso(a) para contribuir com minha energia e vontade de aprender. Meu currículo, em anexo, oferece mais detalhes sobre minha formação.

    Atenciosamente,
    [Seu Nome Completo]`
        },
        {
            title: "Modelo Direto e Moderno",
            sector: "Geral",
            text: `Assunto: Candidatura para a vaga de [Nome da Vaga]

    Prezada equipe da [Nome da Empresa],

    Gostaria de me candidatar à posição de [Nome da Vaga]. Com uma sólida experiência em [Habilidade Chave 1] e [Habilidade Chave 2], obtive resultados como [Mencione uma conquista impressionante e quantificável].

    Acredito que minha capacidade de [Outra habilidade relevante] pode contribuir diretamente para os objetivos da sua equipe. A [Nome da Empresa] me atrai por seu trabalho inovador em [Área de destaque da empresa].

    Estou à disposição para detalhar como minhas habilidades podem beneficiar a [Nome da Empresa].

    Obrigado(a),
    [Seu Nome Completo]
    [Seu Link do LinkedIn ou Portfólio]`
        },
        {
            title: "Modelo para Desenvolvedor(a) de Software",
            sector: "Tecnologia",
            text: `Prezado(a) [Nome do Gerente de Contratação],

    Escrevo para expressar meu grande interesse na vaga de [Nome da Vaga], conforme anunciado em [Onde você viu a vaga]. Com uma sólida experiência em [Linguagem de Programação 1] e [Linguagem de Programação 2], desenvolvi e mantive soluções de software robustas e escaláveis. Em meu cargo anterior na [Empresa Anterior], fui responsável por [Uma responsabilidade chave], onde obtive sucesso em [Um resultado ou conquista quantificável, ex: reduzir o tempo de carregamento da página em 25%].

    Estou particularmente atraído(a) pela [Nome da Empresa] devido à sua abordagem inovadora em [Mencione algo que você admira na empresa, como um projeto específico de IA ou a tecnologia utilizada]. Anexei meu currículo e portfólio para sua análise e ficaria muito feliz com a oportunidade de discutir como minhas competências técnicas e entusiasmo podem beneficiar sua equipe.

    Agradeço sua atenção e tempo.

    Atenciosamente,
    [Seu Nome Completo]`
        },
        {
            title: "Modelo para Analista de Dados",
            sector: "Tecnologia/Finanças",
            text: `Prezado(a) [Nome do Gerente de Contratação],

    Com entusiasmo, apresento minha candidatura para a vaga de Analista de Dados. Minha paixão por extrair insights de grandes volumes de dados e minha proficiência em ferramentas como SQL, Python e Power BI, me preparam para os desafios desta posição. Na [Empresa Anterior], liderei a análise de [Tipo de dados] que resultou em [Um resultado ou conquista quantificável, ex: uma redução de 15% nos custos operacionais].

    A cultura orientada a dados da [Nome da Empresa] e seus projetos em [Área de interesse da empresa, ex: e-commerce] me motivam a querer fazer parte do seu crescimento.

    Agradeço sua atenção.

    Atenciosamente,
    [Seu Nome Completo]`
        },
        {
            title: "Modelo para Gerente de Projeto de TI",
            sector: "Tecnologia",
            text: `Prezado(a) [Nome do Gerente de Contratação],

    Escrevo para me candidatar à vaga de Gerente de Projetos de TI. Ao longo de [Número] anos, aprimorei minha capacidade de gerenciar projetos de software do início ao fim, garantindo que sejam entregues dentro do prazo e orçamento. Na [Empresa Anterior], liderei uma equipe de [Número] pessoas no desenvolvimento de [Nome do projeto], resultando em [Um resultado ou conquista quantificável, ex: um aumento de 20% na satisfação do cliente].

    A metodologia ágil da [Nome da Empresa] e o foco na entrega contínua são áreas que me atraem profundamente. Meu currículo oferece mais detalhes sobre minha experiência em gestão e liderança.

    Agradeço a consideração.

    Atenciosamente,
    [Seu Nome Completo]`
        },
        {
            title: "Modelo para Especialista em Marketing Digital",
            sector: "Marketing",
            text: `Prezado(a) [Nome do Gerente de Contratação],

    Estou animado(a) em me candidatar à vaga de Especialista em Marketing Digital. Minha experiência em otimização de SEO, campanhas de PPC e marketing de conteúdo resultou em um crescimento de [Número]% no tráfego orgânico e um aumento de [Número]% nas taxas de conversão para a [Empresa Anterior].

    Acredito que minha paixão por dados e storytelling se alinha perfeitamente com os objetivos de marketing da [Nome da Empresa]. Estou à disposição para discutir como posso impulsionar suas estratégias digitais.

    Atenciosamente,
    [Seu Nome Completo]`
        },
        {
            title: "Modelo para Designer Gráfico",
            sector: "Marketing/Criação",
            text: `Prezado(a) [Nome do Gerente de Contratação],

    Como um(a) designer gráfico(a) com um olhar aguçado para detalhes e uma paixão por criar identidades visuais impactantes, candidato-me à vaga de [Nome da Vaga]. Minha experiência em [Software de design, ex: Adobe Creative Suite] e minha habilidade em traduzir conceitos em designs visuais resultaram em [Uma conquista quantificável ou um projeto de destaque].

    A filosofia de design da [Nome da Empresa] me inspira profundamente. Meu portfólio, disponível em [Seu Link do Portfólio], demonstra meu trabalho anterior.

    Aguardo a oportunidade de conversar.

    Atenciosamente,
    [Seu Nome Completo]`
        },
        {
            title: "Modelo para Gerente de Mídias Sociais",
            sector: "Marketing",
            text: `Prezado(a) [Nome do Gerente de Contratação],

    Escrevo para me candidatar à vaga de Gerente de Mídias Sociais. Com uma sólida experiência em construir e gerenciar comunidades online, obtive um aumento de [Número]% no engajamento e de [Número]% nos seguidores nas plataformas da [Empresa Anterior].

    Minha capacidade de criar conteúdo envolvente e de analisar métricas de desempenho pode ajudar a [Nome da Empresa] a fortalecer sua presença digital e se conectar com seu público.

    Fico à disposição para uma conversa.

    Atenciosamente,
    [Seu Nome Completo]`
        },
        {
            title: "Modelo para Analista Financeiro",
            sector: "Finanças",
            text: `Prezado(a) [Nome do Gerente de Contratação],

    Com uma base sólida em análise financeira e modelagem, apresento minha candidatura para a vaga de Analista Financeiro. Na [Empresa Anterior], fui responsável por [Uma responsabilidade chave, ex: elaborar projeções financeiras], o que contribuiu para [Um resultado ou conquista quantificável, ex: uma economia de 10% nos custos operacionais].

    Minha atenção aos detalhes e minha capacidade de trabalhar sob pressão são competências que se alinham com o dinamismo da [Nome da Empresa]. Anexei meu currículo para sua análise.

    Agradeço sua atenção.

    Atenciosamente,
    [Seu Nome Completo]`
        },
        {
            title: "Modelo para Contador(a)",
            sector: "Finanças",
            text: `Prezado(a) [Nome do Gerente de Contratação],

    Candidato-me à vaga de Contador(a) na [Nome da Empresa]. Minha experiência em conformidade fiscal, elaboração de demonstrações financeiras e auditoria me preparou para gerenciar as finanças de forma precisa e eficiente. Na [Empresa Anterior], melhorei a eficiência do processo de fechamento mensal em [Número]% ao implementar [Uma ferramenta ou processo].

    A reputação da [Nome da Empresa] por sua integridade financeira e excelência me inspira. Estou disponível para uma conversa.

    Atenciosamente,
    [Seu Nome Completo]`
        },
        {
            title: "Modelo para Representante de Vendas",
            sector: "Vendas",
            text: `Prezado(a) [Nome do Gerente de Contratação],

    Com grande entusiasmo, candidato-me à vaga de Representante de Vendas. Minha habilidade em construir relacionamentos duradouros com clientes e superar metas de vendas é demonstrada em meu histórico na [Empresa Anterior], onde fui um dos [Número]% melhores representantes em [Ano], superando minha meta em [Número]%.

    Acredito que minha paixão por [Produto ou serviço] se alinha perfeitamente com os valores da [Nome da Empresa].

    Agradeço sua consideração.

    Atenciosamente,
    [Seu Nome Completo]`
        },
        {
            title: "Modelo para Gerente de Atendimento ao Cliente",
            sector: "Atendimento",
            text: `Prezado(a) [Nome do Gerente de Contratação],

    Escrevo para me candidatar à vaga de Gerente de Atendimento ao Cliente. Minha experiência em liderar equipes de suporte e minha paixão por garantir uma experiência positiva ao cliente resultaram em um aumento de [Número]% na satisfação do cliente na [Empresa Anterior].

    A cultura de [Valor da empresa, ex: empatia e excelência] da [Nome da Empresa] é algo que admiro profundamente. Fico à disposição para uma conversa sobre como posso contribuir para sua equipe.

    Atenciosamente,
    [Seu Nome Completo]`
        },
        {
            title: "Modelo para Enfermeiro(a)",
            sector: "Saúde",
            text: `Prezado(a) [Nome do Gerente de Contratação],

    Com grande paixão por cuidar de pessoas e uma sólida formação em [Área de especialização, ex: cuidados intensivos], candidato-me à vaga de Enfermeiro(a) na [Nome da Empresa, ex: Hospital]. Minha experiência de [Número] anos na [Empresa Anterior] me permitiu desenvolver habilidades em [Habilidade 1] e [Habilidade 2], garantindo o bem-estar e a segurança dos pacientes.

    A reputação de [Nome da Empresa] por sua excelência em cuidado ao paciente é o que me atrai para esta oportunidade. Agradeço a consideração e aguardo a oportunidade de discutir como posso contribuir.

    Atenciosamente,
    [Seu Nome Completo]`
        },
        {
            title: "Modelo para Professor(a)",
            sector: "Educação",
            text: `Prezado(a) [Nome do Diretor(a) ou Coordenador(a)],

    Com grande entusiasmo, candidato-me à vaga de Professor(a) de [Sua Área de Ensino]. Minha metodologia de ensino focada no aluno e minha capacidade de criar um ambiente de aprendizado envolvente resultaram em um aumento de [Número]% no desempenho acadêmico dos meus alunos na [Instituição Anterior].

    A abordagem pedagógica inovadora da [Nome da Escola/Instituição] é o que me atrai para esta oportunidade. Estou disponível para discutir como posso contribuir para o sucesso dos seus alunos.

    Atenciosamente,
    [Seu Nome Completo]`
        },
        {
            title: "Modelo para Analista de RH",
            sector: "Recursos Humanos",
            text: `Prezado(a) [Nome do Gerente de RH],

    Escrevo para me candidatar à vaga de Analista de RH. Minha experiência em recrutamento, seleção, treinamento e desenvolvimento de talentos me preparou para contribuir para o crescimento da [Nome da Empresa]. Na [Empresa Anterior], otimizei o processo de onboarding, resultando em uma redução de [Número]% no turnover de novos colaboradores.

    A cultura de valorização do colaborador da [Nome da Empresa] é algo que admiro. Estou ansioso(a) para discutir como posso apoiar a sua equipe de RH.

    Atenciosamente,
    [Seu Nome Completo]`
        },
        {
            title: "Modelo para Engenheiro(a) de Produção",
            sector: "Indústria",
            text: `Prezado(a) [Nome do Gerente de Contratação],

    Com grande interesse, candidato-me à vaga de Engenheiro(a) de Produção. Com [Número] anos de experiência em otimizar processos de fabricação e garantir a eficiência operacional, obtive um aumento de [Número]% na produtividade da linha de montagem na [Empresa Anterior].

    A inovação e a tecnologia empregadas pela [Nome da Empresa] são o que me atraem. Estou confiante de que minhas habilidades podem contribuir para a excelência de suas operações.

    Atenciosamente,
    [Seu Nome Completo]`
        },
        {
            title: "Modelo para Advogado(a)",
            sector: "Jurídico",
            text: `Prezado(a) [Nome do Sócio ou Gerente Jurídico],

    Escrevo para expressar meu grande interesse na vaga de Advogado(a). Minha experiência em [Área do Direito, ex: direito societário] e minha capacidade de [Uma habilidade relevante, ex: conduzir negociações complexas] me prepararam para os desafios desta posição. Na [Empresa Anterior/Escritório de Advocacia], atuei em [Um caso ou projeto de destaque] que resultou em [Um resultado positivo, ex: uma resolução favorável para o cliente].

    A reputação de [Nome da Empresa/Escritório] por sua excelência jurídica e ética me motiva a querer fazer parte da equipe.

    Atenciosamente,
    [Seu Nome Completo]`
        },
        {
            title: "Modelo para Gerente de E-commerce",
            sector: "Varejo/E-commerce",
            text: `Prezado(a) [Nome do Gerente de Contratação],

    Com uma paixão por impulsionar o crescimento de vendas online e aprimorar a experiência do cliente, apresento minha candidatura para a vaga de Gerente de E-commerce. Minha experiência em [Área, ex: otimização de funil de vendas, estratégias de marketing digital e logística] resultou em um crescimento de [Número]% na receita online da [Empresa Anterior].

    A inovação da [Nome da Empresa] no setor de varejo me inspira. Estou disponível para uma conversa sobre como posso contribuir para o seu sucesso.

    Atenciosamente,
    [Seu Nome Completo]`
        },
        {
            title: "Modelo para Freelancer",
            sector: "Autônomo",
            text: `Prezado(a) [Nome do Gerente de Contratação],

    Escrevo para expressar meu grande interesse em colaborar com a [Nome da Empresa] como [Sua Profissão, ex: redator(a) freelancer]. Com uma sólida experiência em [Tipo de trabalho, ex: criação de conteúdo para blogs e sites] e um histórico de entrega de projetos de alta qualidade, estou confiante de que posso agregar valor à sua equipe.

    Meu portfólio, disponível em [Seu Link do Portfólio], demonstra minha capacidade de [Uma conquista relevante, ex: produzir conteúdo otimizado para SEO que atrai tráfego]. Estou à disposição para discutir como posso ajudar a [Nome da Empresa] a alcançar seus objetivos.

    Atenciosamente,
    [Seu Nome Completo]`
        },
        {
            title: "Modelo para Estagiário(a)",
            sector: "Estágio",
            text: `Prezado(a) [Nome do Gerente de Contratação],

    Com grande interesse, candidato-me à vaga de estagiário(a) em [Área do Estágio] na [Nome da Empresa]. Atualmente cursando [Seu Curso] na [Nome da Universidade], busco uma oportunidade para aplicar o conhecimento teórico que adquiri em projetos práticos.

    Durante minha jornada acadêmica, participei de [Nome de um projeto relevante], onde pude desenvolver habilidades em [Habilidade 1] e [Habilidade 2]. A [Nome da Empresa] me atrai por sua [Mencione algo que você admira, como programa de estágio ou cultura de aprendizado].

    Estou ansioso(a) para começar minha carreira e contribuir com meu entusiasmo e dedicação.

    Atenciosamente,
    [Seu Nome Completo]`
        },
        {
            title: "Modelo para Gerente",
            sector: "Liderança",
            text: 
            `Prezado(a) [Nome do Diretor(a)],

                Com [Número] anos de experiência em liderança e gestão de equipes, apresento minha candidatura para a vaga de [Nome da Vaga]. Minha trajetória profissional é marcada por [Uma conquista de liderança, ex: a reestruturação de uma equipe de vendas que resultou em um aumento de 30% na receita].

                Minha abordagem de liderança foca em [Sua filosofia de liderança, ex: capacitar a equipe e promover um ambiente de alta performance]. A [Nome da Empresa] é uma organização que admiro por [Mencione algo sobre a empresa, como sua liderança no mercado ou valores].

                Estou confiante de que posso liderar sua equipe rumo a novos patamares de sucesso.

                Agradeço sua atenção e aguardo a oportunidade de uma conversa.

                Atenciosamente,
                [Seu Nome Completo]`
        }
    ];

    let currentTemplateIndex = 0;

    // Elementos da janela de explicação '?'
    const explanationTrigger = document.getElementById('explanation-trigger');
    const explanationPopup = document.getElementById('explanation-popup');
    const closeExplanationPopup = document.getElementById('close-explanation-popup');
    
    // Abrir o modal principal da carta
    if (openCoverLetterBtn && coverLetterModal) {
        openCoverLetterBtn.addEventListener('click', (e) => {
            e.preventDefault();
            // Garante que o modal sempre abra com o primeiro modelo
            currentTemplateIndex = 0;
            coverLetterTextArea.value = coverLetterTemplates[currentTemplateIndex].text;

            // Atualiza o título do modal para o modelo inicial
            const modalTitle = coverLetterModal.querySelector('.modal-title-group h2');
            if (modalTitle) {
                modalTitle.innerText = `Rascunho: ${coverLetterTemplates[currentTemplateIndex].title}`;
            }

            coverLetterModal.style.display = 'block';
        });
    }

    // Fechar o modal principal da carta
    if (closeCoverLetterBtn && coverLetterModal) {
        closeCoverLetterBtn.addEventListener('click', () => {
            coverLetterModal.style.display = 'none';
            // Opcional: resetar o título ao fechar
            const modalTitle = coverLetterModal.querySelector('.modal-title-group h2');
            if (modalTitle) {
                modalTitle.innerText = 'Rascunho da sua Carta de Apresentação';
            }
        });
    }

    // Abrir a janela de explicação
    if (explanationTrigger && explanationPopup) {
        explanationTrigger.addEventListener('click', () => {
            explanationPopup.style.display = 'block';
        });
    }

    // Fechar a janela de explicação
    if (closeExplanationPopup && explanationPopup) {
        closeExplanationPopup.addEventListener('click', () => {
            explanationPopup.style.display = 'none';
        });
    }
    
    // Copiar o texto da carta
    if (copyCoverLetterBtn && coverLetterTextArea) {
        copyCoverLetterBtn.addEventListener('click', () => {
            navigator.clipboard.writeText(coverLetterTextArea.value).then(() => {
                const originalText = copyCoverLetterBtn.querySelector('span').innerText;
                copyCoverLetterBtn.querySelector('span').innerText = 'Copiado!';
                setTimeout(() => {
                    copyCoverLetterBtn.querySelector('span').innerText = originalText;
                }, 2000);
            }).catch(err => console.error('Erro ao copiar carta: ', err));
        });
    }
    
    // Gerar novo rascunho (agora ciclando pelos modelos)
    if (regenerateCoverLetterBtn && coverLetterTextArea) {
        regenerateCoverLetterBtn.addEventListener('click', () => {
            const originalText = regenerateCoverLetterBtn.querySelector('span').innerText;
            regenerateCoverLetterBtn.querySelector('span').innerText = 'Gerando...';
            regenerateCoverLetterBtn.disabled = true;
            
            // Adiciona a classe para o efeito de fade-out e mover para baixo
            coverLetterTextArea.classList.add('generating');

            setTimeout(() => {
                // Avança para o próximo modelo na lista
                currentTemplateIndex = (currentTemplateIndex + 1) % coverLetterTemplates.length;
                
                // Atualiza o textarea com o novo rascunho
                coverLetterTextArea.value = coverLetterTemplates[currentTemplateIndex].text;

                // Atualiza o título do modal para refletir o novo modelo
                const modalTitle = coverLetterModal.querySelector('.modal-title-group h2');
                if (modalTitle) {
                    modalTitle.innerText = `Rascunho: ${coverLetterTemplates[currentTemplateIndex].title}`;
                }

                // Remove a classe para o efeito de fade-in
                coverLetterTextArea.classList.remove('generating');
                
                // Restaura o botão
                regenerateCoverLetterBtn.querySelector('span').innerText = originalText;
                regenerateCoverLetterBtn.disabled = false;
            }, 800); // Delay para simular o "pensamento" da IA e dar tempo para a transição
        });
    }

    // --- Atualização do Evento de Clique na Janela ---

    window.addEventListener('click', (event) => {
        // ... (mantenha a lógica dos outros modais aqui) ...
        if (event.target == resumeModal) {
            resumeModal.style.display = "none";
        }
        if (event.target == interviewModal) {
            interviewModal.style.display = "none";
        }
        if (event.target == coverLetterModal) { 
            coverLetterModal.style.display = "none";
        }
        
    });

});