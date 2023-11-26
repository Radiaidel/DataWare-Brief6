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
