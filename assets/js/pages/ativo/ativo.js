document.addEventListener('DOMContentLoaded', () => {
    const jobsWrapper = document.querySelector('.job-listing-wrapper');
    const url = 'http://127.0.0.1:8000/api';

    // Função para formatar a data
    function formatDate(dateString) {
        const options = { day: '2-digit', month: '2-digit', year: 'numeric' };
        return new Date(dateString).toLocaleDateString('pt-BR', options);
    }

    // Função para criar os avatares dos candidatos
    function createCandidateAvatars(count) {
        if (count === 0) {
            return '<p class="no-candidates">Nenhum candidato ainda.</p>';
        }

        let avatarsHTML = '';
        const maxAvatars = 4;
        const displayCount = Math.min(count, maxAvatars);

        for (let i = 1; i <= displayCount; i++) {
            // Usando um gerador de avatar aleatório
            avatarsHTML += `<img src="https://i.pravatar.cc/150?img=${Math.floor(Math.random() * 70)}" alt="candidato">`;
        }

        if (count > maxAvatars) {
            avatarsHTML += `<span class="avatars-more">+${count - maxAvatars}</span>`;
        }

        return `<div class="candidate-avatars">${avatarsHTML}</div>`;
    }

    // Função para criar o HTML de um único card de vaga
    function createJobCardHTML(job) {
        const candidateCount = job.applications_count || 0;

        return `
            <div class="job-summary-card" data-job-id="${job.id}">
                <div class="card-header">
                    <h2>${job.position}</h2>
                    <span class="status-badge">Ativa</span>
                </div>
                <div class="card-body">
                    <div class="card-metrics">
                        <span>
                            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a3.002 3.002 0 015.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg> 
                            ${candidateCount} Candidato${candidateCount !== 1 ? 's' : ''}
                        </span>
                        <span>
                            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg> 
                            Publicada em ${formatDate(job.created_at)}
                        </span>
                    </div>
                    ${createCandidateAvatars(candidateCount)}
                </div>
                <div class="card-footer">
                    <div class="hiring-manager">
                        <img src="https://i.pravatar.cc/150?u=${job.company.id}" alt="gerente">
                        <span>${job.company.name}</span>
                    </div>
                    <button class="btn btn-secondary toggle-candidates-btn">Ver Candidatos</button>
                </div>
                <div class="candidate-list-container">
                    <h3>Candidatos para ${job.position}</h3>
                    <p class="loading-message">Carregando candidatos...</p>
                </div>
            </div>
        `;
    }

    // Função para criar a linha da tabela de um candidato
    function createCandidateRowHTML(application) {
        const user = application.user;
        if (!user) return ''; // Verificação de segurança

        const avatarUrl = user.avatar || `https://i.pravatar.cc/150?u=${user.id}`;
        const applicationDate = formatDate(application.created_at);
        
        const statusMap = {
            applied: { text: 'Triagem', class: 'status-triagem' },
            reviewing: { text: 'Revisão', class: 'status-revisao' },
            interviewed: { text: 'Entrevista', class: 'status-entrevista' },
            rejected: { text: 'Rejeitado', class: 'status-rejeitado' },
            hired: { text: 'Contratado', class: 'status-contratado' },
        };

        const statusInfo = statusMap[application.status] || { text: application.status, class: '' };

        return `
            <tr>
                <td>
                    <div class="candidate-info">
                        <img src="${avatarUrl}" alt="${user.name}">
                        <span>${user.name || 'Nome não disponível'}</span>
                    </div>
                </td>
                <td>${applicationDate}</td>
                <td><span class="status-tag ${statusInfo.class}">${statusInfo.text}</span></td>
                <td><a href="#" class="btn btn-secondary" style="padding: 0.5rem 1rem; font-size: 0.9rem;">Ver Perfil</a></td>
            </tr>
        `;
    }

    // Função para buscar os candidatos de uma vaga específica
    async function fetchCandidatesForJob(jobId, container) {
        // Verifica se os dados já foram carregados para evitar chamadas repetidas
        if (container.dataset.loaded === 'true') {
            return;
        }

        const token = localStorage.getItem('authToken');
        container.innerHTML = '<p class="loading-message">Carregando candidatos...</p>';

        try {
            const response = await fetch(`${url}/jobs/${jobId}/applications`, {
                headers: {
                    'Accept': 'application/json',
                    'Authorization': `Bearer ${token}`
                }
            });

            if (!response.ok) {
                const errorData = await response.json();
                throw new Error(errorData.message || 'Falha ao buscar candidatos.');
            }

            const applications = await response.json();
            container.dataset.loaded = 'true'; // Marca o container como carregado

            if (applications.length === 0) {
                container.innerHTML = '<h3>Candidatos</h3><p>Nenhum candidato se aplicou a esta vaga ainda.</p>';
                return;
            }

            const tableRows = applications.map(createCandidateRowHTML).join('');

            container.innerHTML = `
                <h3>Candidatos para esta Vaga</h3>
                <table class="candidate-table">
                    <thead>
                        <tr>
                            <th>Candidato</th>
                            <th>Data da Aplicação</th>
                            <th>Status</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${tableRows}
                    </tbody>
                </table>
            `;

        } catch (error) {
            console.error('Erro ao buscar candidaturas:', error);
            container.innerHTML = `<p class="error-message">${error.message}</p>`;
        }
    }

    // Função principal para buscar e exibir as vagas da empresa
    async function fetchAndDisplayCompanyJobs() {
        const token = localStorage.getItem('authToken');
        const user = JSON.parse(localStorage.getItem('user'));

        if (!token || !user || user.type !== 'company') {
            jobsWrapper.innerHTML = '<p class="info-message">Acesso negado. Faça login como empresa para ver suas vagas.</p>';
            return;
        }

        const companyId = user.id;

        try {
            const response = await fetch(`${url}/jobs/company/${companyId}`, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': `Bearer ${token}`
                }
            });

            if (!response.ok) {
                throw new Error('Falha ao carregar as vagas. Tente novamente.');
            }

            const jobs = await response.json();
            jobsWrapper.innerHTML = ''; // Limpa a mensagem de "carregando"

            if (jobs.length === 0) {
                jobsWrapper.innerHTML = '<p class="info-message">Você ainda não criou nenhuma vaga. <a href="./vagas.blade.php">Crie sua primeira vaga agora!</a></p>';
                return;
            }

            jobs.forEach(job => {
                const jobCard = createJobCardHTML(job);
                jobsWrapper.insertAdjacentHTML('beforeend', jobCard);
            });

        } catch (error) {
            console.error('Erro ao buscar vagas:', error);
            jobsWrapper.innerHTML = `<p class="info-message" style="color: #f95a5a;">${error.message}</p>`;
        }
    }

    // Adiciona o evento de clique para o botão "Ver Candidatos"
    if (jobsWrapper) {
        jobsWrapper.addEventListener('click', (event) => {
            const toggleBtn = event.target.closest('.toggle-candidates-btn');
            if (!toggleBtn) return;

            const card = toggleBtn.closest('.job-summary-card');
            if (card) {
                card.classList.toggle('open');
                const isOpening = card.classList.contains('open');
                toggleBtn.textContent = isOpening ? 'Ocultar Candidatos' : 'Ver Candidatos';

                if (isOpening) {
                    const candidateContainer = card.querySelector('.candidate-list-container');
                    fetchCandidatesForJob(card.dataset.jobId, candidateContainer);
                }
            }
        });
    }

    // Inicia o processo
    fetchAndDisplayCompanyJobs();
    
});
