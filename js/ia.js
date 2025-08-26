// Cole aqui o conteúdo completo do arquivo ia.js que você forneceu.
// O código é extenso, então basta copiar e colar.
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

    // Ocultar sidebar ao clicar fora em modo mobile
    document.addEventListener('click', function(event) {
        if (sidebar.classList.contains('show') && !sidebar.contains(event.target) && event.target !== menuBtn) {
            sidebar.classList.remove('show');
        }
    });
    
    // --- O restante do seu código ia.js ---
    // (Lógica dos modais, acordeões, copiar texto, etc.)
});