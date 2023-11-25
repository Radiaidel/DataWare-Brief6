<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

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

                <a href="../Authentification.php"
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


                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Nom d'équipes</th>
                                <th scope="col" class="px-6 py-3">date de création</th>
                                <th scope="col" class="px-6 py-3">Scrum Master</th>
                                <th scope="col" class="px-6 py-3">Projet</th>
                                <th scope="col" class="px-6 py-3">Membres</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50
                                dark:hover:bg-gray-600 ">
                                <td scope="row" class=" px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                    Equipe A</td>
                                <td class="px-6 py-4">2023-01-01</td>
                                <td class="px-6 py-4">
                                    <div class="flex gap-4 items-center"><img src="../Images/user.png" alt=""
                                            width="40">John Doe
                                </td>
                                <td class="py-2 px-4 border-b">Projet A</td>
                                <td class="px-6 py-4 flex  gap-1 items-center">
                                <img src="../Images/user.png" alt="Membre 1" class="w-8 h-8 rounded-full">
    <img src="../Images/user.png" alt="Membre 2" class="w-8 h-8 rounded-full">
    <img src="../Images/user.png" alt="Membre 3" class="w-8 h-8 rounded-full">
    <img src="../Images/user.png" alt="Membre 4" class="w-8 h-8 rounded-full">

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>





</body>

</html>