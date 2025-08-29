const dropdownBtn = document.querySelector('.dropdown-btn');
const dropdownMenu = document.querySelector('.dropdown-menu');

if (dropdownBtn && dropdownMenu) {
    dropdownBtn.addEventListener('click', (event) => {
        event.stopPropagation(); // Impede que o clique se propague e feche o menu imediatamente.
        dropdownMenu.classList.toggle('show');
    });

    window.addEventListener('click', (event) => {
        if (!dropdownBtn.contains(event.target)) {
            dropdownMenu.classList.remove('show');
        }
    });
}

document.addEventListener('DOMContentLoaded', function() {
    function addDynamicField(sectionId, buttonId, template) {
        let index = 0;
        document.getElementById(buttonId).addEventListener('click', function() {
            const container = document.getElementById(sectionId);
            const newItem = document.createElement('div');
            newItem.classList.add('dynamic-item');
            newItem.innerHTML = template(index);
            this.parentNode.insertBefore(newItem, this);
            index++;
        });
    }

    const experienciaTemplate = index => `
        <div class="form-group"><label>Cargo</label><input type="text" name="experiencia[${index}][cargo]"></div>
        <div class="form-group"><label>Empresa</label><input type="text" name="experiencia[${index}][empresa]"></div>
        <div class="form-group"><label>Período (Ex: Jan 2020 - Dez 2022)</label><input type="text" name="experiencia[${index}][periodo]"></div>
        <div class="form-group"><label>Descrição das atividades</label><textarea name="experiencia[${index}][descricao]"></textarea></div>
    `;

    const formacaoTemplate = index => `
        <div class="form-group"><label>Instituição de Ensino</label><input type="text" name="formacao[${index}][instituicao]"></div>
        <div class="form-group"><label>Curso</label><input type="text" name="formacao[${index}][curso]"></div>
        <div class="form-group"><label>Período (Ex: 2018 - 2022)</label><input type="text" name="formacao[${index}][periodo]"></div>
    `;

    addDynamicField('experiencia-section', 'add-experiencia', experienciaTemplate);
    addDynamicField('formacao-section', 'add-formacao', formacaoTemplate);
});