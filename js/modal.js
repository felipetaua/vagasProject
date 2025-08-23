document.addEventListener('DOMContentLoaded', function() {
    // Get the modal elements
    const modal = document.getElementById('vagaModal');
    const modalBody = document.getElementById('modal-body');
    const closeBtn = document.querySelector('.close-btn');

    // Function to open the modal and fetch data
    async function openModal(vagaId) {
        if (!modal || !modalBody) return;

        modal.style.display = 'block';
        modalBody.innerHTML = '<p>Carregando...</p>';

        try {
            // Fetch data from the new PHP script
            const response = await fetch(`obter_detalhes_vaga.php?id=${vagaId}`);
            if (!response.ok) {
                throw new Error('A resposta da rede não foi OK');
            }
            const data = await response.json();

            if (data.error) {
                modalBody.innerHTML = `<p style="color: red;">${data.error}</p>`;
            } else {
                // Populate the modal with the fetched data
                modalBody.innerHTML = `
                    <h3>${data.empresa} - ${data.cargo}</h3>
                    <p><span>Descrição:</span> ${data.descricao}</p>
                    <p><span>Requisitos:</span> ${data.requisitos}</p>
                    <p><span>Salário:</span> R$ ${data.salario}</p>
                    <p><span>Cidade:</span> ${data.cidade}</p>
                    <p><span>Contato (Telefone):</span> ${data.telefone}</p>
                `;
            }
        } catch (error) {
            console.error('Erro ao buscar detalhes da vaga:', error);
            modalBody.innerHTML = '<p style="color: red;">Ocorreu um erro ao carregar os detalhes. Tente novamente.</p>';
        }
    }

    // Add click event to all "Visualizar" buttons
    document.querySelectorAll('.visualizar').forEach(button => {
        button.addEventListener('click', function() {
            const vagaId = this.getAttribute('data-id');
            openModal(vagaId);
        });
    });

    // Function to close the modal
    function closeModal() {
        if (modal) modal.style.display = 'none';
    }

    // Close modal events
    if (closeBtn) closeBtn.onclick = closeModal;
    window.onclick = (event) => { if (event.target == modal) closeModal(); };
});