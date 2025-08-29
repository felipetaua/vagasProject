document.addEventListener('DOMContentLoaded', () => {
    const jobsContainer = document.getElementById('jobs-grid-container');
    const url = 'http://127.0.0.1:8000/api';
    const token = localStorage.getItem('authToken');
    
    const searchForm = document.getElementById('search-form');
    const searchInputMain = document.getElementById('search-input-main');
    const searchInputLocation = document.getElementById('search-input-location');
    const autocompleteResults = document.getElementById('autocomplete-results');

    // Elementos do Modal
    const modal = document.getElementById('job-details-modal');
    const modalBody = document.getElementById('modal-body');
    const closeModalBtn = document.querySelector('.modal-close-btn');


    const icons = {
        default: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="7" height="9" x="3" y="3" rx="1"></rect><rect width="7" height="5" x="14" y="3" rx="1"></rect><rect width="7" height="9" x="14" y="12" rx="1"></rect><rect width="7" height="5" x="3" y="16" rx="1"></rect></svg>', // Ícone genérico de "blocos/layout"
        tecnologia: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline></svg>', // Ícone de código
        vendas: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>', // Ícone de cifrão
        saude: '<svg  xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"  fill-rule="evenodd" clip-rule="evenodd" fill="currentColor" stroke="none"><path d="M21.826 9h-2.086c.171-.487.262-.957.262-1.41 0-2.326-1.818-3.776-4.024-3.573-2.681.247-4.518 3.71-4.978 4.484-.527-.863-2.261-4.238-4.981-4.494-2.11-.199-4.019 1.181-4.019 3.582 0 3.109 4.347 7.084 9.001 11.615 1.16-1.127 2.285-2.208 3.324-3.243l.97 1.857c-1.318 1.302-2.769 2.686-4.294 4.181-6.164-6.037-11.001-10.202-11.001-14.403 0-3.294 2.462-5.526 5.674-5.596 2.163-.009 4.125.957 5.327 2.952 1.177-1.956 3.146-2.942 5.253-2.942 3.064 0 5.746 2.115 5.746 5.595 0 .464-.06.928-.174 1.395zm-11.094 4c-.346.598-.992 1-1.732 1-1.104 0-2-.896-2-2s.896-2 2-2c.74 0 1.386.402 1.732 1h1.222l1.88-2.71c.14-.202.376-.315.622-.299.245.016.464.161.576.38l2.27 4.437.813-1.45c.124-.221.357-.358.611-.358h5.274v2h-4.513l-1.759 2.908c-.132.219-.373.348-.629.337-.255-.01-.484-.16-.598-.389l-2.256-4.559-.989 1.406c-.131.186-.345.297-.573.297h-1.951z"/></svg>',
        rh: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>', // Ícone de usuários
        marketing: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" stroke="none"><path d="M13 22.589v1.411h-2v-1.425c0-1.958-.943-3.015-2-4.575h6c-1.062 1.553-2 2.612-2 4.589zm3-9.589c-.552 0-1-.448-1-1s.448-1 1-1h2v-2h-2c-.552 0-1-.448-1-1s.448-1 1-1h2v-2h-2c-.552 0-1-.448-1-1s.448-1 1-1h1.858c-.446-1.722-1.997-3-3.858-3h-4c-1.861 0-3.412 1.278-3.858 3h1.858c.552 0 1 .448 1 1s-.448 1-1 1h-2v2h2c.552 0 1 .448 1 1s-.448 1-1 1h-2v2h2c.552 0 1 .448 1 1s-.448 1-1 1h-1.858c.446 1.722 1.997 3 3.858 3h4c1.861 0 3.412-1.278 3.858-3h-1.858z"/></svg>', 
        design: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" stroke="none"><path d="M8.997 13.985c.01 1.104-.88 2.008-1.986 2.015-1.105.009-2.005-.88-2.011-1.984-.01-1.105.879-2.005 1.982-2.016 1.106-.007 2.009.883 2.015 1.985zm-.978-3.986c-1.104.008-2.008-.88-2.015-1.987-.009-1.103.877-2.004 1.984-2.011 1.102-.01 2.008.877 2.012 1.982.012 1.107-.88 2.006-1.981 2.016zm7.981-4.014c.004 1.102-.881 2.008-1.985 2.015-1.106.01-2.008-.879-2.015-1.983-.011-1.106.878-2.006 1.985-2.015 1.101-.006 2.005.881 2.015 1.983zm-12 15.847c4.587.38 2.944-4.492 7.188-4.537l1.838 1.534c.458 5.537-6.315 6.772-9.026 3.003zm14.065-7.115c1.427-2.239 5.846-9.748 5.846-9.748.353-.623-.429-1.273-.975-.813 0 0-6.572 5.714-8.511 7.525-1.532 1.432-1.539 2.086-2.035 4.447l1.68 1.4c2.227-.915 2.868-1.04 3.995-2.811zm-12.622 4.806c-2.084-1.82-3.42-4.479-3.443-7.447-.044-5.51 4.406-10.03 9.92-10.075 3.838-.021 6.479 1.905 6.496 3.447l1.663-1.456c-1.01-2.223-4.182-4.045-8.176-3.992-6.623.055-11.955 5.466-11.903 12.092.023 2.912 1.083 5.57 2.823 7.635.958.492 2.123.329 2.62-.204zm12.797-1.906c1.059 1.97-1.351 3.37-3.545 3.992-.304.912-.803 1.721-1.374 2.311 5.255-.591 9.061-4.304 6.266-7.889-.459.685-.897 1.197-1.347 1.586z"/></svg>', // Ícone de pincel
        agro: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" stroke="none"><path d="M15.787 7.531c-5.107 2.785-12.72 9.177-15.787 15.469h2.939c.819-2.021 2.522-4.536 3.851-5.902 8.386 3.747 17.21-2.775 17.21-11.343 0-1.535-.302-3.136-.92-4.755-2.347 3.119-5.647 1.052-10.851 1.625-7.657.844-11.162 6.797-8.764 11.54 3.506-3.415 9.523-6.38 12.322-6.634z"/></svg>',
    };

    let allJobs = []; // Variável para guardar todas as vagas

    // Função para exibir as vagas no grid
    function displayJobs(jobsToDisplay) {
        jobsContainer.innerHTML = ''; // Limpa o grid
        if (jobsToDisplay.length === 0) {
            jobsContainer.innerHTML = '<p class="info-message">Nenhuma vaga encontrada com os critérios de busca.</p>';
            return;
        }

        jobsToDisplay.forEach(job => {
            // Formata o endereço de forma segura
            const location = (job.address && job.address.city && job.address.state)
                ? `${job.address.city}, ${job.address.state}`
                : 'Local não informado';

            // Formata o salário
            const salary = job.salary ? `R$ ${job.salary}` : 'A combinar';

            // TODO: Adicionar lógica para selecionar o ícone correto com base no departamento da vaga
            const jobIconSvg = icons.tecnologia || icons.default;

            const jobCardHTML = `
                <article class="job-card" data-job-id="${job.id}">
                    <div class="job-header">
                        <div class="job-icon">${jobIconSvg}</div>
                        <div class="job-title">
                            <h3>${job.position || 'Título não informado'}</h3>
                            <p>${job.name || 'Empresa não informada'}</p>
                        </div>
                    </div>
                    <div class="job-details">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg> 
                            ${location}
                        </span>
                    </div>
                    <p class="description">${job.description ? job.description.substring(0, 100) + '...' : 'Descrição não disponível.'}</p>
                    <div class="job-footer">
                        <span class="job-salary">${salary} <span>/mês</span></span>
                        <button type="button" class="btn btn-secondary">Ver Detalhes</button>
                    </div>
                </article>
            `;
            jobsContainer.insertAdjacentHTML('beforeend', jobCardHTML);
        });
    }
    function handleAutocomplete() {
        const query = searchInputMain.value.toLowerCase();
        autocompleteResults.innerHTML = '';

        if (query.length < 2) {
            autocompleteResults.style.display = 'none';
            return;
        }

        const filteredJobs = allJobs.filter(job => 
            job.position.toLowerCase().includes(query) || 
            job.name.toLowerCase().includes(query)
        );

        if (filteredJobs.length > 0) {
            filteredJobs.slice(0, 5).forEach(job => { // Mostra no máximo 5 sugestões
                const item = document.createElement('div');
                item.classList.add('autocomplete-item');
                item.innerHTML = `<strong>${job.position}</strong><span>${job.name}</span>`;
                item.addEventListener('click', () => {
                    searchInputMain.value = job.position;
                    autocompleteResults.style.display = 'none';
                    // Dispara a busca ao clicar na sugestão
                    searchForm.dispatchEvent(new Event('submit', { cancelable: true }));
                });
                autocompleteResults.appendChild(item);
            });
            autocompleteResults.style.display = 'block';
        } else {
            autocompleteResults.style.display = 'none';
        }
    }

    // Lógica de Autocomplete
    if (searchInputMain) {
        searchInputMain.addEventListener('input', handleAutocomplete);
    }
    
    // Esconde o autocomplete ao clicar fora
    document.addEventListener('click', (e) => {
        if (!e.target.closest('.search-container')) {
            autocompleteResults.style.display = 'none';
        }
    });

    // Lógica de Filtro do Formulário
    searchForm.addEventListener('submit', (e) => {
        e.preventDefault();
        autocompleteResults.style.display = 'none';
        
        const mainQuery = searchInputMain.value.toLowerCase();
        const locationQuery = searchInputLocation.value.toLowerCase();

        const filteredJobs = allJobs.filter(job => {
            const matchesMain = mainQuery === '' || 
                                job.position.toLowerCase().includes(mainQuery) ||
                                job.name.toLowerCase().includes(mainQuery);
            
            const matchesLocation = locationQuery === '' ||
                                    (job.address?.city || '').toLowerCase().includes(locationQuery) ||
                                    (job.address?.state || '').toLowerCase().includes(locationQuery);

            return matchesMain && matchesLocation;
        });

        displayJobs(filteredJobs);
    });

    // Função inicial para buscar todas as vagas
    async function fetchAllJobs() {
        if (!jobsContainer) return;

        if (!token) {
            jobsContainer.innerHTML = '<p class="error-message">Você precisa estar logado para ver as vagas. Redirecionando...</p>';
            setTimeout(() => window.location.href = '/pages/login/login.blade.php', 2000);
            return;
        }
        jobsContainer.innerHTML = '<p class="loading-message">Carregando vagas...</p>';

        try {
            const response = await fetch(`${url}/jobs`, { headers: { 'Authorization': `Bearer ${token}` } });
            if (!response.ok) throw new Error('Falha ao buscar vagas.');
            
            allJobs = await response.json(); // Salva as vagas na variável global
            displayJobs(allJobs); // Exibe todas as vagas inicialmente
        } catch (error) {
            console.error('Erro:', error);
            jobsContainer.innerHTML = `<p class="error-message">${error.message}</p>`;
        }
    }

    // Função para buscar detalhes de uma vaga e exibir no modal
    async function showJobDetails(jobId) {
        if (!modal || !modalBody) return;

        // Mostra o modal com a mensagem de "carregando"
        modal.style.display = 'flex';
        setTimeout(() => modal.classList.add('show'), 10); // Adiciona a classe para a transição
        modalBody.innerHTML = '<p class="loading-message">Carregando detalhes da vaga...</p>';

        try {
            const response = await fetch(`${url}/jobs/${jobId}`, {
                headers: {
                    'Accept': 'application/json',
                    'Authorization': `Bearer ${token}`
                }
            });

            if (!response.ok) {
                throw new Error('Não foi possível carregar os detalhes da vaga.');
            }

            const job = await response.json();

            const appliedJobs = JSON.parse(localStorage.getItem('appliedJobs')) || [];
            const hasApplied = appliedJobs.includes(job.id.toString());

            const applyButtonHTML = hasApplied
                ? `<button type="button" class="btn btn-primary" disabled>Candidatura Enviada</button>`
                : `<button type="button" class="btn btn-primary" id="apply-btn" data-job-id="${job.id}">Candidatar-se</button>`;

            const location = (job.address && job.address.city && job.address.state) ? `${job.address.city}, ${job.address.state}` : 'Não informado';
            const salary = job.salary ? `R$ ${job.salary}` : 'A combinar';

            modalBody.innerHTML = `
                <div class="job-header-modal">
                    <div class="job-icon-modal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline></svg>
                    </div>
                    <div class="job-title-modal">
                        <h3>${job.position}</h3>
                        <p>${job.name}</p>
                    </div>
                </div>

                <div class="job-meta-modal">
                    <span><i class="fa-solid fa-location-dot"></i> ${location}</span>
                    <span><i class="fa-solid fa-money-bill-wave"></i> ${salary}/mês</span>
                    <span><i class="fa-solid fa-clock"></i> ${job.work_time}</span>
                </div>

                <div class="job-section">
                    <h4>Descrição da Vaga</h4>
                    <p>${job.description.replace(/\n/g, '<br>')}</p>
                </div>

                <div class="job-section">
                    <h4>Atividades Relacionadas</h4>
                    <p>${job.activies_related.replace(/\n/g, '<br>')}</p>
                </div>

                <div class="job-section">
                    <h4>Habilidades Necessárias</h4>
                    <p>${job.skills_required.replace(/\n/g, '<br>')}</p>
                </div>

                <div class="job-section">
                    <h4>Benefícios</h4>
                    <p>${job.benefits.replace(/\n/g, '<br>')}</p>
                </div>

                <div class="modal-footer">
                    ${applyButtonHTML}
                </div>
            `;

        } catch (error) {
            modalBody.innerHTML = `<p class="error-message">${error.message}</p>`;
        }
    }

    // Função para se candidatar a uma vaga
    async function applyForJob(jobId, buttonElement) {
        const token = localStorage.getItem('authToken');
        if (!token) {
            alert('Sessão expirada. Por favor, faça login novamente.');
            window.location.href = '/pages/login/login.blade.php';
            return;
        }

        const originalButtonText = buttonElement.innerHTML;
        buttonElement.disabled = true;
        buttonElement.innerHTML = 'Enviando...';

        try {
            const response = await fetch(`${url}/jobs/${jobId}/apply`, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': `Bearer ${token}`
                }
            });

            const result = await response.json();

            if (!response.ok) {
                throw new Error(result.error || 'Ocorreu um erro desconhecido.');
            }

            // Salva o ID da vaga no localStorage para desativar o botão em futuras visitas
            const appliedJobs = JSON.parse(localStorage.getItem('appliedJobs')) || [];
            const jobIdStr = jobId.toString();
            if (!appliedJobs.includes(jobIdStr)) {
                appliedJobs.push(jobIdStr);
                localStorage.setItem('appliedJobs', JSON.stringify(appliedJobs));
            }

            alert(result.message || 'Candidatura realizada com sucesso!');
            buttonElement.innerHTML = 'Candidatura Enviada';

        } catch (error) {
            console.error('Erro ao se candidatar:', error);
            alert(`Erro: ${error.message}`); 

            buttonElement.disabled = false;
            buttonElement.innerHTML = originalButtonText;
        }
    }

    // Função para fechar o modal
    function closeModal() {
        if (!modal) return;
        modal.classList.remove('show');
        setTimeout(() => modal.style.display = 'none', 300);
    }

    function setupEventListeners() {
        jobsContainer.addEventListener('click', (event) => {
            const detailsButton = event.target.closest('.btn-secondary');
            if (detailsButton) {
                const jobCard = detailsButton.closest('.job-card');
                const jobId = jobCard.dataset.jobId;
                showJobDetails(jobId);
            }
        });

        modal.addEventListener('click', (event) => {
            // Fecha o modal se clicar no overlay
            if (event.target === modal) closeModal();

            const applyButton = event.target.closest('#apply-btn');
            if (applyButton) {
                const jobId = applyButton.dataset.jobId;
                applyForJob(jobId, applyButton);
            }
        });

        closeModalBtn.addEventListener('click', closeModal);
    }

    setupEventListeners();
    fetchAllJobs();
});