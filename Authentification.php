<?php
include("Connexion.php");
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submitSignUp'])) {
    $nom = $_POST['newname'];
    $email = $_POST['newEmail'];
    $motDePasse = $_POST['newPassword'];
    $confirmationMotDePasse = $_POST['ConfirmPassword'];

    if ($motDePasse !== $confirmationMotDePasse) {
        echo "Les mots de passe ne correspondent pas.";
    } else {
        $motDePasseHash = password_hash($motDePasse, PASSWORD_DEFAULT);

        $requete = $conn->prepare("INSERT INTO utilisateur (nom, email, password,statut,role) VALUES (?, ?, ?,'actif','user')");
        if (!$requete) {
            die("Erreur de préparation de la requête : " . $conn->error);
        }
        
        $requete->bind_param("sss", $nom, $email, $motDePasseHash);

        if ($requete->execute()) {
            echo "Inscription réussie !";
            header("Location: Authentification.php");
        } else {
            echo "Erreur lors de l'inscription : " . $requete->error;
        }

        $requete->close();
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submitSignIn'])) {

    $email = $_POST['email'];
    $motDePasse = $_POST['password'];

    $requete = $conn->prepare("SELECT * FROM utilisateur WHERE email = ?");
    if (!$requete) {
        die("Erreur de préparation de la requête : " . $conn->error);
    }
    
    $requete->bind_param("s", $email);
    $requete->execute();
    $resultat = $requete->get_result();

    if ($resultat->num_rows == 1) {
        $utilisateur = $resultat->fetch_assoc();

        if (password_verify($motDePasse, $utilisateur['password'])) {
            session_start();
            $_SESSION['utilisateur'] = [
                'id' => $utilisateur['id'],
                'nom' => $utilisateur['nom'],
                'email' => $utilisateur['email'],
                'role' => $utilisateur['role'],
                // Ajoutez d'autres champs si nécessaire
            ];
            if ($utilisateur['role'] == 'user') {
                header("Location: ./Membre/Dashboard.php");
                exit();
            } elseif ($utilisateur['role'] == 'po') {
                header("Location: ./ProductOwner/Dashboard.php");
                exit();
            } else {
                header("Location: ./ScrumMaster/Dashboard.php");
            }
        } else {
            echo "Mot de passe incorrect.";
        }
    } else {
        echo "Aucun utilisateur trouvé avec cet email.";
    }

    $requete->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dataware | Authentification</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#ECECF8] h-screen flex flex-col items-center justify-center">
<div >
    <a href="Dashboard.php" >
        <img src="./Images/Logo.png" class="h-8 mx-auto mb-10 w-full" alt="dataware Logo" />
    </a>
</div>

    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-md">

    <div class="flex justify-center mb-6 space-x-2">
            <button id="signInBtn" class="text-white px-6 py-2 bg-[#2F329F] hover:bg-[#5355B2] rounded-xl ">Sign In</button>
            <button id="signUpBtn" class=" text--[#2F329F] px-6 py-2 hover:underline border-2 rounded-xl border-[#2F329F]">Sign Up</button>
        </div>

        <form id="signInForm" action="#" method="POST" class="space-y-4">
            <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Sign in to your account</h1>

                <input type="email" name="email" id="email"
                    class="w-full p-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300"
                    placeholder="Your email" required>
          

            
                <input type="password" name="password" id="password"
                    class="w-full p-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300"
                    placeholder="Password" required>

            <div class="flex items-center justify-between">
                <div class="flex items-start">
                    <input id="remember" type="checkbox"
                        class="h-4 w-4 text-blue-500 border-gray-300 rounded focus:ring focus:border-blue-300">
                    <label for="remember" class="ml-2 text-sm text-gray-600">Remember me</label>
                </div>
                <a href="#" class="text-sm text-blue-500 hover:underline">Forgot password?</a>
            </div>

            <button type="submit" name="submitSignIn"
                class="w-full bg-[#2F329F]  text-white p-2 rounded-md hover:bg-[#5355B2] focus:outline-none focus:ring focus:border-blue-300">
                Sign in
            </button>
        </form>

        <form id="signUpForm" action="#" method="POST" class="hidden space-y-4">
            <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Create an account</h1>

            <input type="text" name="newname" id="newname"
                    class="w-full p-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300"
                    placeholder="Your name" required>
                <input type="email" name="newEmail" id="newEmail"
                    class="w-full p-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300"
                    placeholder="Your email" required>

            
                <input type="password" name="newPassword" id="newPassword"
                    class="w-full p-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300"
                    placeholder="New Password" required>
            
                    <input type="password" name="ConfirmPassword" id="ConfirmPassword"
                    class="w-full p-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300"
                    placeholder="Confirm password" required>
            <button type="submit" name="submitSignUp"
                class="w-full bg-[#2F329F]  text-white p-2 rounded-md hover:bg-[#5355B2] focus:outline-none focus:ring focus:border-blue-300 mt-40">
                Sign up
            </button>
        </form>
    </div>


    <script>
        const signInBtn = document.getElementById('signInBtn');
        const signUpBtn = document.getElementById('signUpBtn');
        const signInForm = document.getElementById('signInForm');
        const signUpForm = document.getElementById('signUpForm');

        signInBtn.addEventListener('click', function () {
            signInForm.classList.remove('hidden');
            signUpForm.classList.add('hidden');
            signInBtn.classList.add('text-white','bg-[#2F329F]', 'hover:bg-[#5355B2]');
            signUpBtn.classList.remove('text-white','bg-[#2F329F]', 'hover:bg-[#5355B2]');
            signInBtn.classList.remove('text--[#2F329F]','hover:underline', 'border-2',  'border-[#2F329F]');
            signUpBtn.classList.add('text--[#2F329F]','hover:underline', 'border-2','border-[#2F329F]');
        });

        signUpBtn.addEventListener('click', function () {
            signInForm.classList.add('hidden');
            signUpForm.classList.remove('hidden');
            signInBtn.classList.remove('text-white','bg-[#2F329F]', 'hover:bg-[#5355B2]');
            signUpBtn.classList.add('text-white','bg-[#2F329F]', 'hover:bg-[#5355B2]');
            signInBtn.classList.add('text--[#2F329F]','hover:underline', 'border-2', 'border-[#2F329F]');
            signUpBtn.classList.remove('text--[#2F329F]','hover:underline', 'border-2',  'border-[#2F329F]');
        });
    </script>



</body>

</html>