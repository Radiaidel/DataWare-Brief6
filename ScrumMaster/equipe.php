<?php
include("../Connexion.php");
session_start();
$utilisateur = $_SESSION['utilisateur']['id'];
$sql = "SELECT 
equipe.id AS id_equipe,
equipe.nom AS nom_equipe,
equipe.date_creation AS date_creation,
projet.nom AS nom_projet,
GROUP_CONCAT(DISTINCT membre.nom SEPARATOR ', ') AS membres
FROM
equipe
JOIN projet ON projet.id = equipe.id_projet
LEFT JOIN MembreEquipe AS membre_equipe ON equipe.id = membre_equipe.id_equipe
LEFT JOIN utilisateur AS membre ON membre_equipe.id_user = membre.id
WHERE
equipe.id_user = ?
GROUP BY
equipe.id;";
$requete = $conn->prepare($sql);
$requete->bind_param("i", $utilisateur);
$requete->execute();
$resultat = $requete->get_result();


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_equipe'])) {
    $id_equipe = $_POST['id_equipe'];

    $sqlDeleteMembers = "DELETE FROM MembreEquipe WHERE id_equipe =?";
    $stmtDeleteMembers = $conn->prepare($sqlDeleteMembers);
    $stmtDeleteMembers->bind_param("i", $id_equipe);
    $stmtDeleteMembers->execute();

    $sqlDeleteTeams = "DELETE FROM equipe WHERE id = ?";
    $sqlDeleteTeams = $conn->prepare($sqlDeleteTeams);
    $sqlDeleteTeams->bind_param("i", $id_equipe);
    $sqlDeleteTeams->execute();
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["nomEquipe"], $_POST["projet"], $_POST["membresEquipe"])) {

        $nomEquipe = htmlspecialchars($_POST["nomEquipe"]);
        $idProjet = htmlspecialchars($_POST["projet"]);
        $membresEquipe = $_POST["membresEquipe"];

        $sqlInsertEquipe = "INSERT INTO equipe (nom, id_user, id_projet) VALUES (?,? , ?)";
        $requeteInsertEquipe = $conn->prepare($sqlInsertEquipe);
        $requeteInsertEquipe->bind_param("sii", $nomEquipe,$utilisateur, $idProjet);

        if ($requeteInsertEquipe->execute()) {
            $idEquipe = $requeteInsertEquipe->insert_id;

            $sqlInsertMembres = "INSERT INTO MembreEquipe (id_user, id_equipe) VALUES (?, ?)";
            $requeteInsertMembres = $conn->prepare($sqlInsertMembres);

            foreach ($membresEquipe as $idMembre) {
                $requeteInsertMembres->bind_param("ii", $idMembre, $idEquipe);
                $requeteInsertMembres->execute();
            }

            echo "Équipe ajoutée avec succès.";
            header("Location: equipe.php");
        } else {
            echo "Erreur lors de l'ajout de l'équipe : " . $requeteInsertEquipe->error;
        }

        $requeteInsertEquipe->close();
        $requeteInsertMembres->close();
    } else {
        echo "Tous les champs du formulaire doivent être remplis.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <script src="../script.js" defer></script>

    <title>dataware | equipe</title>
</head>

<body class="bg-[#ECECF8]">



    <div class="flex h-screen bg-[#ECECF8]">
        <aside class="bg-[#2F329F] w-64 space-y-6 py-7 px-2">

            <div class="w-64">
                <a href="Dashboard.php" class="flex items-center justify-center">
                    <img src="../Images/Logo.png" class="h-8 mx-auto" alt="dataware Logo" />
                </a>
            </div>


            <nav>
                <a href="Dashboard.php"
                    class="flex items-center px-4 py-2 text-gray-200 hover:bg-[#5355] transition duration-300 ">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                        <path fill-rule="evenodd"
                            d="M2.25 13.5a8.25 8.25 0 018.25-8.25.75.75 0 01.75.75v6.75H18a.75.75 0 01.75.75 8.25 8.25 0 01-16.5 0z"
                            clip-rule="evenodd" />
                        <path fill-rule="evenodd"
                            d="M12.75 3a.75.75 0 01.75-.75 8.25 8.25 0 018.25 8.25.75.75 0 01-.75.75h-7.5a.75.75 0 01-.75-.75V3z"
                            clip-rule="evenodd" />
                    </svg>

                    <span class="mx-2">Dashboard</span>
                </a>

                <a href="projet.php"
                    class="flex items-center px-4 py-2 text-gray-200 hover:bg-[#5355]  transition duration-300 ">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                        <path
                            d="M19.5 21a3 3 0 003-3v-4.5a3 3 0 00-3-3h-15a3 3 0 00-3 3V18a3 3 0 003 3h15zM1.5 10.146V6a3 3 0 013-3h5.379a2.25 2.25 0 011.59.659l2.122 2.121c.14.141.331.22.53.22H19.5a3 3 0 013 3v1.146A4.483 4.483 0 0019.5 9h-15a4.483 4.483 0 00-3 1.146z" />
                    </svg>
                    <span class="mx-2">Projets</span>
                </a>

                <a href="equipe.php"
                    class="flex items-center px-4 py-2 text-gray-200 hover:bg-[#5355]  transition duration-300 ">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                        <path fill-rule="evenodd"
                            d="M8.25 6.75a3.75 3.75 0 117.5 0 3.75 3.75 0 01-7.5 0zM15.75 9.75a3 3 0 116 0 3 3 0 01-6 0zM2.25 9.75a3 3 0 116 0 3 3 0 01-6 0zM6.31 15.117A6.745 6.745 0 0112 12a6.745 6.745 0 016.709 7.498.75.75 0 01-.372.568A12.696 12.696 0 0112 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 01-.372-.568 6.787 6.787 0 011.019-4.38z"
                            clip-rule="evenodd" />
                        <path
                            d="M5.082 14.254a8.287 8.287 0 00-1.308 5.135 9.687 9.687 0 01-1.764-.44l-.115-.04a.563.563 0 01-.373-.487l-.01-.121a3.75 3.75 0 013.57-4.047zM20.226 19.389a8.287 8.287 0 00-1.308-5.135 3.75 3.75 0 013.57 4.047l-.01.121a.563.563 0 01-.373.486l-.115.04c-.567.2-1.156.349-1.764.441z" />
                    </svg>
                    <span class="mx-2">Équipes</span>
                </a>

                <a href="membre.php"
                    class="flex items-center px-4 py-2 text-gray-200 hover:bg-[#5355]  transition duration-300 ">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                        <path
                            d="M4.5 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM14.25 8.625a3.375 3.375 0 116.75 0 3.375 3.375 0 01-6.75 0zM1.5 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM17.25 19.128l-.001.144a2.25 2.25 0 01-.233.96 10.088 10.088 0 005.06-1.01.75.75 0 00.42-.643 4.875 4.875 0 00-6.957-4.611 8.586 8.586 0 011.71 5.157v.003z" />
                    </svg>
                    <span class="mx-2">Membres</span>
                </a>

                <a href="../Deconnexion.php"
                    class="flex items-center px-4 py-2 text-gray-200 hover:bg-[#5355]  transition duration-300 ">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                        <path fill-rule="evenodd"
                            d="M7.5 3.75A1.5 1.5 0 006 5.25v13.5a1.5 1.5 0 001.5 1.5h6a1.5 1.5 0 001.5-1.5V15a.75.75 0 011.5 0v3.75a3 3 0 01-3 3h-6a3 3 0 01-3-3V5.25a3 3 0 013-3h6a3 3 0 013 3V9A.75.75 0 0115 9V5.25a1.5 1.5 0 00-1.5-1.5h-6zm5.03 4.72a.75.75 0 010 1.06l-1.72 1.72h10.94a.75.75 0 010 1.5H10.81l1.72 1.72a.75.75 0 11-1.06 1.06l-3-3a.75.75 0 010-1.06l3-3a.75.75 0 011.06 0z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="mx-2">Déconnexion</span>
                </a>
            </nav>
        </aside>

        <div class="flex-1 flex flex-col overflow-hidden">
            <div class="container mx-auto p-6">
                <h1 class="text-3xl text-center font-bold text-gray-800 mb-6">teams Management</h1>
                <div class="mb-6">
                    <button id="openModal" onclick="addTeam()" class="inline-flex items-center text-gray-500 bg-white border border-gray-300
                                hover:bg-gray-100  font-medium
                                rounded-lg text-sm px-3 py-1.5 ">
                        Ajouter une équipe
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Nom d'équipes</th>
                                <th scope="col" class="px-6 py-3">Projet</th>

                                <th scope="col" class="px-6 py-3">Membres</th>
                                <th scope="col" class="px-6 py-3">date de création</th>

                                <th scope="col" class="px-6 py-3">Actions</th>

                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            while ($row = $resultat->fetch_assoc()) {
                                echo " 
                                    <tr data-equipe-id=\"{$row['id_equipe']}\" class=\"bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50
                                    dark:hover:bg-gray-600 \">
                                    <td scope=\"row\" class=\" px-6 py-4 text-gray-900 whitespace-nowrap
                                        dark:text-white\">{$row['nom_equipe']}</td>
                                    <td class=\"py-2 px-4 border-b\">{$row['nom_projet']}</td>
                                    <td class=\"px-6 py-4 border-b\">{$row['membres']}</td>
                                    <td class=\"px-6 py-4 border-b\">{$row['date_creation']}</td>
                                    <td class=\"px-6 py-4\">
                                    <div class=\" flex gap-6\"><svg xmlns=\"http://www.w3.org/2000/svg\" fill=\"none\"
                                    viewBox=\"0 0 24 24\" stroke-width=\"1.5\" stroke=\"currentColor\"
                                    class=\"w-6 h-6\">
                                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\"
                                        d=\"M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10\" />
                                </svg>
                                    <div id=\"deleteButton\" style=\"cursor: pointer;\" onclick=\"confirmDeleteTeam(event)\">
                                    <svg   xmlns=\"http://www.w3.org/2000/svg\" fill=\"none\" viewBox=\"0 0 24 24\"
                                    stroke-width=\"1.5\" stroke=\"currentColor\" class=\"w-6 h-6\">
                                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\"
                                        d=\"M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0\" />
                                </svg>
                                </div>
                                
                        </div>
                                    </td>
                                    </tr>
                                    ";
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



    <div id="equipeModal"
        class="hidden fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 flex items-center justify-center">


        <div class="bg-white p-8 rounded shadow-lg w-96">
            <div class="flex justify-end w-full">

                <button id="closeModal" type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm h-8 w-8  ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-toggle="crypto-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <form action="equipe.php" method="post" class="max-w-md mx-auto ">
    <div class="mb-4">
        <label for="nomEquipe" class="block text-gray-700 text-sm font-bold mb-2">Nom de l'Équipe</label>
        <input type="text" id="nomEquipe" name="nomEquipe" placeholder="Entrez le nom de l'équipe"
            class="w-full px-4 py-2 border rounded focus:outline-none focus:border-blue-500">
    </div>

    <div class="mb-4">
        <label for="projet" class="block text-gray-700 text-sm font-bold mb-2">Projet de l'Équipe</label>
        <select id="projet" name="projet"
            class="w-full px-4 py-2 border rounded focus:outline-none focus:border-blue-500">
            <?php
            $sqlProjet = "SELECT id, nom FROM projet";
            $requeteProjet = $conn->prepare($sqlProjet);
            $requeteProjet->execute();
            $resultatProjet = $requeteProjet->get_result();
            while ($rowProjet = $resultatProjet->fetch_assoc()) {
                echo "<option value=\"{$rowProjet['id']}\">{$rowProjet['nom']}</option>";
            }
            ?>
        </select>
    </div>

    <div class="mb-4">
        <label for="membresEquipe" class="block text-gray-700 text-sm font-bold mb-2">Membres de l'Équipe</label>
        <select id="membresEquipe" name="membresEquipe[]" multiple
            class="w-full px-1 py-2 border rounded">
            <?php
            $sqlMembres = "SELECT id, email FROM utilisateur WHERE role='user'";
            $requeteMembres = $conn->prepare($sqlMembres);
            $requeteMembres->execute();
            $resultatMembres = $requeteMembres->get_result();
            while ($rowMembre = $resultatMembres->fetch_assoc()) {
                echo "<option value=\"{$rowMembre['id']}\">{$rowMembre['email']}</option>";
            }
            ?>
        </select>
    </div>

    <button type="submit"
        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue">Ajouter
        Équipe</button>
</form>

        </div>
    </div>


    <?php
    $requete->close();
    ?>



</body>

</html>