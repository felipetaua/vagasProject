document.addEventListener('DOMContentLoaded', function() {
    // --- Lógica do Modal para Detalhes da Vaga ---
    const modal = document.getElementById("vagaModal");
    const modalBody = document.getElementById("modal-body");
    const closeBtn = document.querySelector(".modal .close-btn");

    // Adiciona o listener ao container para pegar cliques em botões futuros (delegação de evento)
    const container = document.querySelector('.container');
    if (container) {
        container.addEventListener('click', function(event) {
            // Verifica se o elemento clicado (ou um de seus pais) é o botão de visualizar
            const viewButton = event.target.closest('.view-btn');
            if (viewButton) {
                const vagaId = viewButton.getAttribute("data-id");
                modalBody.innerHTML = "<p>Carregando...</p>";
                modal.style.display = "block";

                fetch(`get_vaga_details.php?id=${vagaId}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.text();
                    })
                    .then(data => {
                        modalBody.innerHTML = data;
                    })
                    .catch(error => {
                        modalBody.innerHTML = "<p>Ocorreu um erro ao carregar os detalhes da vaga.</p>";
                        console.error('Erro no Fetch:', error);
                    });
            }
        });
    }

    // Fecha o modal
    if (closeBtn) {
        closeBtn.onclick = () => modal.style.display = "none";
    }

    window.onclick = (event) => {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
});