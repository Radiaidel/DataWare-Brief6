function confirmDelete(event) {
    event.stopPropagation();

    var confirmation = window.confirm('Are you sure you want to delete this project?');

    if (confirmation) {
        var projectId = event.target.closest('tr').dataset.projectId;

        // Modification ici : utilisez FormData pour envoyer les données
        var formData = new FormData();
        formData.append('projectId', projectId);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'Projet.php', true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                console.log(xhr.responseText);
                window.location.reload(); // Décommentez cette ligne pour recharger la page si nécessaire
            }
        };

        // Modification ici : envoyez formData au lieu de la chaîne de requête
        xhr.send(formData);
    }
}
function confirmDeleteTeam(event) {
    var confirmation = window.confirm('Are you sure you want to delete this team?');

    if (confirmation) {
        // If confirmed, proceed with the deletion
        var equipeId = event.target.closest('tr').dataset.equipeId; // Get the team ID
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'equipe.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Handle the response from the server
                console.log(xhr.responseText);
                // Optional: Reload or update the team list after deletion
                window.location.reload(); // Uncomment this line to reload the page
            }
        };
        xhr.send('id_equipe=' + equipeId);
    }
}