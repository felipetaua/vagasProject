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

$(document).ready(function() {

    const vagasContainer = $('#vagas-container');
    const modal = $('#inscritos-modal');
    const modalContent = $('#usuarios-vinculados');

    // Função para exibir notificações "toast"
    function showToast(message, type = 'success') {
        const toastContainer = $('#toast-container');
        const toast = $(`<div class="toast ${type}">${message}</div>`);
        toastContainer.append(toast);

        setTimeout(() => toast.addClass('show'), 10); // Adiciona a classe para animação
        setTimeout(() => {
            toast.removeClass('show');
            toast.on('transitionend', () => toast.remove());
        }, 3000); // Remove o toast após 3 segundos
    }

    // Função para abrir o modal de inscritos
    function openModal(vagaId) {
        modalContent.html('<div class="loader"></div>'); // Mostra o loader
        modal.fadeIn('fast');

        $.ajax({
            url: 'usuarios_vinculados.php',
            type: 'GET',
            data: { vagaId: vagaId },
            success: function(response) {
                setTimeout(() => modalContent.html(response), 500); // Simula um pequeno delay
            },
            error: function() {
                modalContent.html('<p>Erro ao carregar os inscritos. Tente novamente.</p>');
                showToast('Erro ao obter os usuários.', 'error');
            }
        });
    }

    // Função para fechar o modal
    function closeModal() {
        modal.fadeOut('fast');
    }

    // Função para deletar uma vaga
    function deleteVaga(vagaId, buttonElement) {
        if (!confirm('Tem certeza que deseja encerrar esta vaga? Esta ação não pode ser desfeita.')) {
            return;
        }

        $.ajax({
            url: 'excluirVaga.php',
            type: 'POST',
            data: { vagaId: vagaId },
            success: function(response) {
                showToast('Vaga encerrada com sucesso!');
                // Remove o card da vaga da tela com uma animação
                $(buttonElement).closest('.vaga-card').fadeOut(500, function() {
                    $(this).remove();
                });
            },
            error: function() {
                showToast('Erro ao encerrar a vaga.', 'error');
            }
        });
    }

    // Event Delegation para os botões da página
    vagasContainer.on('click', '.action-btn', function() {
        const vagaId = $(this).data('vaga-id');
        
        if ($(this).hasClass('btn-inscritos')) {
            openModal(vagaId);
        } else if ($(this).hasClass('btn-encerrar')) {
            deleteVaga(vagaId, this);
        }
    });

    // Eventos para fechar o modal
    modal.on('click', '.close-modal-btn', closeModal);
    modal.on('click', function(event) {
        if ($(event.target).is(modal)) {
            closeModal();
        }
    });
});