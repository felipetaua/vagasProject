/**
 * auth-guard.js
 * 
 * Este script protege as rotas da aplicação. Ele deve ser incluído no <head>
 * de todas as páginas que exigem autenticação.
 * 
 * Funcionalidades:
 * 1. Verifica se o usuário está logado (procurando por 'authToken' no localStorage).
 * 2. Se não estiver logado, redireciona para a página de login.
 * 3. Se estiver logado, verifica se o tipo de usuário ('user' ou 'company') tem permissão para acessar a página atual.
 * 4. Se o tipo de usuário for incorreto para a rota, redireciona para o dashboard correto.
 */
(() => {
    const publicRoutes = ['/pages/login/login', '/pages/register/register'];
    const userDashboard = '/pages/main/users/colaborador/colaborador.blade.php';
    const companyDashboard = '/pages/main/users/empresa/empresa.blade.php';
    const loginPage = '/pages/login/login';

    const currentPath = window.location.pathname.replace('.blade.php', '');

    // Se a rota atual for pública, não faz nada
    if (publicRoutes.some(route => currentPath.includes(route))) {
        return;
    }

    const token = localStorage.getItem('authToken');
    const userStr = localStorage.getItem('user');

    if (!token || !userStr) {
        // Se não houver token ou usuário, redireciona para o login
        window.location.href = loginPage;
        return;
    }

    try {
        const user = JSON.parse(userStr);
        const userType = user.type;

        if (userType === 'company' && !currentPath.includes('/empresa')) {
            // Usuário é empresa, mas não está na página da empresa -> redireciona
            window.location.href = companyDashboard;
        } else if (userType !== 'company' && !currentPath.includes('/colaborador')) {
            // Usuário é colaborador, mas não está na página de colaborador -> redireciona
            window.location.href = userDashboard;
        }

    } catch (error) {
        console.error('Erro ao processar dados do usuário. Redirecionando para o login.', error);
        localStorage.clear();
        window.location.href = loginPage;
    }
})();