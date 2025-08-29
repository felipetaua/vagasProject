document.addEventListener('DOMContentLoaded', () => {

    // --- Seletores de Elementos DOM ---
    const openModalBtn = document.getElementById('save-resume-btn');
    const closeModalBtn = document.getElementById('close-curriculum-modal');
    const modal = document.getElementById('curriculum-modal');
    const curriculumForm = document.getElementById('curriculum-form');
    const mainResumeSheet = document.querySelector('.main-content .resume-sheet');
    const previewContainerInModal = document.querySelector('.curriculum-preview-column');
    
    // Contém os botões "Adicionar" e os botões "Remover" que serão criados
    const formColumn = document.querySelector('.curriculum-form-column');

    let previewResumeSheet; // A pré-visualização que será clonada

    // --- Lógica do Modal ---

    const openModal = () => {
        // 1. Limpa a pré-visualização anterior (se existir) e clona a folha principal
        if (previewContainerInModal.firstChild) {
            previewContainerInModal.innerHTML = '';
        }
        previewResumeSheet = mainResumeSheet.cloneNode(true);
        previewContainerInModal.appendChild(previewResumeSheet);

        // 2. Carrega os dados da folha principal para o formulário
        loadDataIntoForm();

        // 3. Exibe o modal
        modal.style.display = 'block';
    };

    const closeModal = () => {
        modal.style.display = 'none';
    };

    openModalBtn.addEventListener('click', openModal);
    closeModalBtn.addEventListener('click', closeModal);
    modal.querySelector('#cancel-btn').addEventListener('click', closeModal);
    window.addEventListener('click', (event) => {
        if (event.target == modal) {
            closeModal();
        }
    });

    // --- Lógica dos Repeaters (Adicionar/Remover Itens) ---

    formColumn.addEventListener('click', (event) => {
        // Adicionar item
        if (event.target.matches('.add-item-btn')) {
            const templateId = event.target.dataset.template;
            const targetContainerId = event.target.dataset.repeaterTarget;
            
            const template = document.getElementById(templateId);
            const targetContainer = document.querySelector(targetContainerId);

            if (template && targetContainer) {
                const clone = template.content.cloneNode(true);
                targetContainer.appendChild(clone);
            }
        }

        // Remover item
        if (event.target.matches('.remove-item-btn')) {
            const repeaterItem = event.target.closest('.repeater-item');
            if (repeaterItem) {
                repeaterItem.remove();
                updatePreview(); // Atualiza a preview após remover
            }
        }
    });
    
    // --- Carregamento de Dados para o Formulário ---

    const findElementByText = (container, selector, text) => {
        return Array.from(container.querySelectorAll(selector))
                    .find(el => el.textContent.trim() === text);
    };

    const loadDataIntoForm = () => {
        curriculumForm.reset(); // Limpa o formulário antes de carregar
        
        // Limpa os repeaters
        document.getElementById('experience-repeater').innerHTML = '';
        document.getElementById('education-repeater').innerHTML = '';

        // Carrega dados de contato que faltavam
        const contactInfo = mainResumeSheet.querySelector('.resume-contact-info');
        if (contactInfo) {
            curriculumForm.location.value = contactInfo.querySelector('span:nth-child(1)')?.textContent.trim() || '';
            curriculumForm.email.value = contactInfo.querySelector('span:nth-child(2)')?.textContent.trim() || '';
            curriculumForm.linkedin.value = contactInfo.querySelector('span:nth-child(3)')?.textContent.trim() || '';
        }
        
        // Carrega dados simples
        curriculumForm.fullName.value = mainResumeSheet.querySelector('.resume-header h1')?.textContent || '';
        curriculumForm.jobTitle.value = mainResumeSheet.querySelector('.resume-header h2')?.textContent || '';
        
        const summaryTitle = findElementByText(mainResumeSheet, 'h3.resume-section-title', 'Resumo Profissional');
        curriculumForm.summary.value = summaryTitle?.nextElementSibling?.textContent || '';

        // Carrega competências
        const skills = Array.from(mainResumeSheet.querySelectorAll('.resume-skill')).map(skill => skill.textContent);
        curriculumForm.skills.value = skills.join(', ');

        // Carrega experiências
        const experienceSection = findElementByText(mainResumeSheet, 'h3.resume-section-title', 'Experiência Profissional')?.parentElement;
        if (experienceSection) {
            experienceSection.querySelectorAll('.resume-item').forEach(item => {
                document.querySelector('[data-template="experience-template"]').parentElement.querySelector('.add-item-btn').click();
                const newExpItem = document.querySelector('#experience-repeater .repeater-item:last-child');
                
                newExpItem.querySelector('[name="exp_title[]"]').value = item.querySelector('h3')?.textContent || '';
                newExpItem.querySelector('[name="exp_company[]"]').value = item.querySelector('.item-subheader')?.textContent || '';
                
                const dateText = item.querySelector('.date')?.textContent || '';
                const [startDate, endDate] = dateText.split(' - ').map(d => d.trim());

                newExpItem.querySelector('[name="exp_start_date[]"]').value = startDate || '';
                newExpItem.querySelector('[name="exp_end_date[]"]').value = endDate || '';
                
                newExpItem.querySelector('[name="exp_description[]"]').value = item.querySelector('p:not(.item-subheader)')?.textContent || '';
            });
        }
        
        // Carrega formação acadêmica
        const educationSection = findElementByText(mainResumeSheet, 'h3.resume-section-title', 'Formação Acadêmica')?.parentElement;
        if (educationSection) {
            educationSection.querySelectorAll('.resume-item').forEach(item => {
                document.querySelector('[data-template="education-template"]').parentElement.querySelector('.add-item-btn').click();
                const newEduItem = document.querySelector('#education-repeater .repeater-item:last-child');

                newEduItem.querySelector('[name="edu_degree[]"]').value = item.querySelector('h3')?.textContent || '';
                newEduItem.querySelector('[name="edu_institution[]"]').value = item.querySelector('.item-subheader')?.textContent || '';
                
                const dateText = item.querySelector('.date')?.textContent || '';
                const [startDate, endDate] = dateText.split(' - ').map(d => d.trim());

                newEduItem.querySelector('[name="edu_start_date[]"]').value = startDate || '';
                newEduItem.querySelector('[name="edu_end_date[]"]').value = endDate || '';
            });
        }
        
        updatePreview();
    };

    // --- Atualização da Pré-visualização em Tempo Real ---

    const updatePreview = () => {
        if (!previewResumeSheet) return;

        // Atualiza campos simples
        previewResumeSheet.querySelector('.resume-header h1').textContent = curriculumForm.fullName.value || 'Seu Nome';
        previewResumeSheet.querySelector('.resume-header h2').textContent = curriculumForm.jobTitle.value || 'Seu Cargo';
        
        const contactInfo = previewResumeSheet.querySelector('.resume-contact-info');
        if(contactInfo) {
            contactInfo.querySelector('span:nth-child(1)').innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>${curriculumForm.location.value || ''}`;
            contactInfo.querySelector('span:nth-child(2)').innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>${curriculumForm.email.value || ''}`;
            contactInfo.querySelector('span:nth-child(3)').innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle></svg>${curriculumForm.linkedin.value || ''}`;
        }
        
        const summaryTitle = findElementByText(previewResumeSheet, 'h3.resume-section-title', 'Resumo Profissional');
        if (summaryTitle && summaryTitle.nextElementSibling) {
            summaryTitle.nextElementSibling.textContent = curriculumForm.summary.value;
        }

        // Atualiza Experiência
        const expContainer = findElementByText(previewResumeSheet, 'h3.resume-section-title', 'Experiência Profissional')?.parentElement;
        if (expContainer) {
            expContainer.querySelectorAll('.resume-item').forEach(item => item.remove()); // Limpa antes de recriar
            document.querySelectorAll('#experience-repeater .repeater-item').forEach(formItem => {
                // CORREÇÃO: Adicionados colchetes '[]' aos seletores
                const newExpHTML = `
                    <div class="resume-item">
                        <div class="item-header">
                            <h3>${formItem.querySelector('[name="exp_title[]"]').value}</h3>
                            <span class="date">${formItem.querySelector('[name="exp_start_date[]"]').value} - ${formItem.querySelector('[name="exp_end_date[]"]').value}</span>
                        </div>
                        <p class="item-subheader">${formItem.querySelector('[name="exp_company[]"]').value}</p>
                        <p>${formItem.querySelector('[name="exp_description[]"]').value}</p>
                    </div>`;
                expContainer.insertAdjacentHTML('beforeend', newExpHTML);
            });
        }

        // Atualiza Formação (lógica similar à de experiência)
        const eduContainer = findElementByText(previewResumeSheet, 'h3.resume-section-title', 'Formação Acadêmica')?.parentElement;
        if (eduContainer) {
            eduContainer.querySelectorAll('.resume-item').forEach(item => item.remove());
            document.querySelectorAll('#education-repeater .repeater-item').forEach(formItem => {
                // CORREÇÃO: Adicionados colchetes '[]' aos seletores
                const newEduHTML = `
                    <div class="resume-item">
                        <div class="item-header">
                            <h3>${formItem.querySelector('[name="edu_degree[]"]').value}</h3>
                            <span class="date">${formItem.querySelector('[name="edu_start_date[]"]').value} - ${formItem.querySelector('[name="edu_end_date[]"]').value}</span>
                        </div>
                        <p class="item-subheader">${formItem.querySelector('[name="edu_institution[]"]').value}</p>
                    </div>`;
                eduContainer.insertAdjacentHTML('beforeend', newEduHTML);
            });
        }

        // Atualiza Competências
        const skillsContainer = previewResumeSheet.querySelector('.resume-skills-list');
        if (skillsContainer) {
            skillsContainer.innerHTML = ''; // Limpa antes de recriar
            const skills = curriculumForm.skills.value.split(',').filter(skill => skill.trim() !== '');
            skills.forEach(skill => {
                const skillHTML = `<span class="resume-skill">${skill.trim()}</span>`;
                skillsContainer.insertAdjacentHTML('beforeend', skillHTML);
            });
        }
    };

    curriculumForm.addEventListener('input', updatePreview);

    // --- Lógica de Salvamento ---

    curriculumForm.addEventListener('submit', (event) => {
    event.preventDefault(); // Impede o envio padrão do formulário

    const formData = new FormData(curriculumForm);
    const submitButton = modal.querySelector('button[type="submit"]');
    const originalButtonText = submitButton.textContent;
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Desabilita o botão para evitar cliques duplos
    submitButton.disabled = true;
    submitButton.textContent = 'Salvando...';

    fetch('/api/curriculo', {
        method: 'POST',
        headers: {
            // Cabeçalho de segurança CSRF
            'X-CSRF-TOKEN': csrfToken,
            // Informa que esperamos uma resposta JSON
            'Accept': 'application/json',
        },
        body: formData,
    })
    .then(response => {
        // Se a resposta não for OK (ex: erro de validação), trata como erro
        if (!response.ok) {
            return response.json().then(err => { throw err; });
        }
        return response.json();
    })
    .then(data => {
        // Se a requisição for bem-sucedida
        alert(data.message || 'Currículo salvo com sucesso!');

        // Atualiza a visualização principal do currículo na página
        mainResumeSheet.innerHTML = previewResumeSheet.innerHTML;
        
        closeModal(); // Fecha o modal
    })
    .catch(error => {
        // Se ocorrer um erro (rede, validação, etc.)
        console.error('Erro ao salvar o currículo:', error);
        
        let errorMessage = 'Ocorreu um erro ao salvar. Tente novamente.';
        // Se for um erro de validação do Laravel, mostra os campos com erro
        if (error.errors) {
            const errorFields = Object.values(error.errors).map(e => e.join(', ')).join('\n');
            errorMessage = `Por favor, corrija os seguintes erros:\n\n${errorFields}`;
        } else if (error.message) {
            errorMessage = error.message;
        }
        
        alert(errorMessage);
    })
    .finally(() => {
        // Este bloco sempre será executado, independentemente de sucesso ou erro
        submitButton.disabled = false;
        submitButton.textContent = originalButtonText;
    });
});
});