document.addEventListener('DOMContentLoaded', function() {
    // --- Seletores de Elementos ---
    const scheduleModal = document.getElementById('schedule-interview-modal');
    const openModalBtn = document.getElementById('schedule-interview-btn');
    const closeModalBtn = document.getElementById('close-modal-btn');
    const cancelModalBtn = document.getElementById('cancel-btn');
    const saveInterviewBtn = document.getElementById('save-interview-btn');
    const interviewForm = scheduleModal ? scheduleModal.querySelector('form.form-grid') : null;
    const interviewsList = document.querySelector('#proximas .interviews-list');
    const presentialCheckbox = document.getElementById('presential-interview');
    const interviewLinkGroup = document.getElementById('interview-link-group');
    const interviewAddressGroup = document.getElementById('interview-address-group');
    const calendarEl = document.getElementById('calendar');
    const tabs = document.querySelectorAll('.tab-btn');
    const panes = document.querySelectorAll('.tab-pane');

    // --- Lógica do Modal ---
    const toggleInterviewFields = () => {
        if (presentialCheckbox && interviewLinkGroup && interviewAddressGroup) {
            if (presentialCheckbox.checked) {
                interviewLinkGroup.classList.add('hidden');
                interviewAddressGroup.classList.remove('hidden');
            } else {
                interviewLinkGroup.classList.remove('hidden');
                interviewAddressGroup.classList.add('hidden');
            }
        }
    };

    const openModal = () => {
        if (scheduleModal) scheduleModal.classList.add('open');
    };

    const closeModal = () => {
        if (scheduleModal) {
            scheduleModal.classList.remove('open');
            if (interviewForm) interviewForm.reset();
            // Garante que o estado visual dos campos de endereço/link seja resetado
            if (presentialCheckbox) toggleInterviewFields();
        }
    };

    if (openModalBtn) openModalBtn.addEventListener('click', openModal);
    if (closeModalBtn) closeModalBtn.addEventListener('click', closeModal);
    if (cancelModalBtn) cancelModalBtn.addEventListener('click', closeModal);
    if (scheduleModal) {
        scheduleModal.addEventListener('click', (e) => {
            if (e.target === scheduleModal) closeModal();
        });
    }
    if (presentialCheckbox) {
        presentialCheckbox.addEventListener('change', toggleInterviewFields);
        toggleInterviewFields(); // Inicializa o estado correto
    }

    // --- Lógica das Abas (Tabs) ---
    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            tabs.forEach(t => t.classList.remove('active'));
            panes.forEach(p => p.classList.remove('active'));

            tab.classList.add('active');
            const targetPane = document.querySelector(tab.dataset.target);
            if (targetPane) {
                targetPane.classList.add('active');
            }
        });
    });


    // --- LÓGICA DO CALENDÁRIO (FullCalendar) ---
    let calendar = null;
    if (calendarEl) {
        calendar = new FullCalendar.Calendar(calendarEl, {
            locale: 'pt-br',
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,listWeek'
            },
            buttonText: {
                today: 'Hoje',
                month: 'Mês',
                week: 'Semana',
                list: 'Lista'
            },
            events: [
                {
                    title: 'Entrevista: Juliana M.',
                    start: '2025-06-10T14:00:00',
                    color: 'var(--primary-color)'
                },
                {
                    title: 'Entrevista: Carlos E.',
                    start: '2025-06-11T10:30:00',
                    color: 'var(--primary-color)'
                }
            ],
            editable: true,
            selectable: true,
            navLinks: true,
            dayMaxEvents: true,
        });

        calendar.render();

        const calendarPane = document.getElementById('calendario');
        if (calendarPane) {
            const observer = new MutationObserver(() => {
                if (calendarPane.classList.contains('active')) {
                    setTimeout(() => {
                        calendar.updateSize();
                    }, 150);
                }
            });

            observer.observe(calendarPane, {
                attributes: true,
                attributeFilter: ['class']
            });
        }
    }

    // --- LÓGICA PARA SALVAR ENTREVISTA (API) ---
    if (saveInterviewBtn) {
        saveInterviewBtn.addEventListener('click', async (e) => {
            e.preventDefault();

            const formData = {
                candidate: document.getElementById('candidate').value,
                job: document.getElementById('job').value,
                interviewDate: document.getElementById('interviewDate').value,
                interviewTime: document.getElementById('interviewTime').value,
                interviewers: document.getElementById('interviewers').value,
                interviewType: document.getElementById('interviewType').value,
                interviewNotes: document.getElementById('interviewNotes').value,
                isPresential: document.getElementById('presential-interview').checked,
                interviewLink: document.getElementById('interviewLink').value,
                interviewAddress: document.getElementById('interviewAddress').value,
            };
            
            // --- Validação no Frontend ---
            if (!formData.candidate || !formData.job || !formData.interviewDate || !formData.interviewTime) {
                alert('Por favor, preencha todos os campos obrigatórios (Candidato, Vaga, Data e Hora).');
                return;
            }
            
            if (formData.isPresential && !formData.interviewAddress) {
                alert('Para entrevistas presenciais, o endereço é obrigatório.');
                return;
            }

            if (!formData.isPresential && !formData.interviewLink) {
                alert('Para entrevistas online, o link da reunião é obrigatório.');
                return;
            }
            
            saveInterviewBtn.disabled = true;
            saveInterviewBtn.textContent = 'Agendando...';

            try {
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                const response = await fetch('/entrevistas/agendar', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify(formData),
                });

                if (!response.ok) {
                    const errorData = await response.json();
                    let errorMessages = 'Ocorreram erros de validação:\n';
                    for (const field in errorData.errors) {
                        errorMessages += `- ${errorData.errors[field].join(', ')}\n`;
                    }
                    alert(errorMessages);
                    throw new Error('Falha na validação dos dados.');
                }

                const newInterview = await response.json();

                if (calendar) {
                    calendar.addEvent({
                        title: `Entrevista: ${newInterview.candidate}`,
                        start: `${newInterview.interviewDate}T${newInterview.interviewTime}`,
                        allDay: false,
                        color: 'var(--primary-color)',
                        extendedProps: { id: newInterview.id }
                    });
                }

                if (interviewsList) {
                    const newCardHTML = createInterviewCard(newInterview);
                    interviewsList.insertAdjacentHTML('beforeend', newCardHTML);
                }
                
                closeModal();

            } catch (error) {
                console.error('Erro ao agendar entrevista:', error);
            } finally {
                saveInterviewBtn.disabled = false;
                saveInterviewBtn.textContent = 'Agendar e Enviar Convite';
            }
        });
    }

    /**
     * Cria o HTML para um novo card de entrevista.
     * @param {object} data - Os dados da entrevista retornados pela API.
     * @returns {string} O HTML do card.
     */
    function createInterviewCard(data) {
        const date = new Date(`${data.interviewDate}T${data.interviewTime}`);
        const day = date.getDate();
        // Assegura que o mês seja formatado corretamente sem pontos
        const month = date.toLocaleString('pt-BR', { month: 'short' }).replace('.', '');

        const interviewerImagesHtml = (data.interviewer_images || [])
            .map(img => `<img src="${img}" alt="Entrevistador">`).join('');

        return `
            <div class="interview-card" data-interview-id="${data.id}">
                <div class="interview-date">
                    <div class="day">${day}</div>
                    <div class="month">${month}</div>
                </div>
                <div class="interview-info">
                    <img src="${data.candidate_image}" alt="Candidato">
                    <div class="candidate-details">
                        <h3>${data.candidate}</h3>
                        <p>Para a vaga de ${data.job}</p>
                    </div>
                </div>
                <div class="interview-tags">
                    <div class="tag tag-stage">${data.interviewType}</div>
                    <div class="tag tag-status">Agendada - ${data.interviewTime}</div>
                </div>
                <div class="interviewers">
                    ${interviewerImagesHtml}
                </div>
                <div class="interview-actions">
                    <button class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="23 7 16 12 23 17 23 7"></polygon><rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect></svg>
                        Participar
                    </button>
                    <button class="btn-icon" title="Adicionar Feedback">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                    </button>
                </div>
            </div>`;
    }
});