document.addEventListener('DOMContentLoaded', function() {
    let experienciaIndex = typeof initialExperienciaCount !== 'undefined' ? initialExperienciaCount : 0;
    let formacaoIndex = typeof initialFormacaoCount !== 'undefined' ? initialFormacaoCount : 0;

    // Função genérica para adicionar seções dinâmicas
    function addDynamicSection(sectionId, buttonId, templateFn, indexCounter) {
        document.getElementById(buttonId).addEventListener('click', function() {
            const container = document.getElementById(sectionId);
            const newItem = document.createElement('div');
            newItem.classList.add('dynamic-item');

            // Usa o contador correto para o tipo de seção
            let index = sectionId.includes('experiencia') ? experienciaIndex++ : formacaoIndex++;

            newItem.innerHTML = templateFn(index);
            container.insertBefore(newItem, this); // Insere o novo item antes do botão "Adicionar"
        });
    }

    const experienciaTemplate = index => `
        <div class="form-group"><label>Cargo</label><input type="text" name="experiencia[${index}][cargo]"></div>
        <div class="form-group"><label>Empresa</label><input type="text" name="experiencia[${index}][empresa]"></div>
        <div class="form-group"><label>Período (Ex: Jan 2020 - Dez 2022)</label><input type="text" name="experiencia[${index}][periodo]"></div>
        <div class="form-group"><label>Descrição das atividades</label><textarea name="experiencia[${index}][descricao]"></textarea></div>
        <button type="button" class="btn-remove">Remover Experiência</button>
    `;

    const formacaoTemplate = index => `
        <div class="form-group"><label>Instituição de Ensino</label><input type="text" name="formacao[${index}][instituicao]"></div>
        <div class="form-group"><label>Curso</label><input type="text" name="formacao[${index}][curso]"></div>
        <div class="form-group"><label>Período (Ex: 2018 - 2022)</label><input type="text" name="formacao[${index}][periodo]"></div>
        <button type="button" class="btn-remove">Remover Formação</button>
    `;

    addDynamicSection('experiencia-section', 'add-experiencia', experienciaTemplate);
    addDynamicSection('formacao-section', 'add-formacao', formacaoTemplate);

    // Usa "event delegation" para capturar cliques nos botões de remover
    document.querySelector('.curriculo-form').addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('btn-remove')) {
            e.target.closest('.dynamic-item').remove(); // Remove o bloco pai do botão
        }
    });
});