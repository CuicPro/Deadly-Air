function login() {
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    // Vérifier les identifiants (simulé ici pour l'exemple)
    if (username === 'admin' && password === 'password') {
        showAdminPanel();
    } else {
        alert('Login failed. Please try again.');
    }
}

function logout() {
    // Redirection vers la page de connexion
    location.reload();
}

function showAdminPanel() {
    document.getElementById('login-form').style.display = 'none';
    document.getElementById('admin-panel').style.display = 'block';
    // Autres actions à effectuer une fois connecté
}
