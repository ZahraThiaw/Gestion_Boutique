<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Dettes</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .btn-blue {
            background-color: #3490dc;
        }
        .btn-blue:hover {
            background-color: #2779bd;
        }
    </style>
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">
    <!-- Navbar -->
    <header class="bg-white shadow-md">
        <nav class="container mx-auto px-6 py-3">
            <div class="flex justify-between items-center">
                <div class="text-xl font-semibold text-gray-700">Gestion des Dettes</div>
                <div>
                    <a href="#" class="text-gray-700 hover:text-gray-900 mr-4">Accueil</a>
                    <a href="#" class="text-gray-700 hover:text-gray-900 mr-4">Profil</a>
                    <a href="#" class="text-gray-700 hover:text-gray-900">Déconnexion</a>
                </div>
            </div>
        </nav>
    </header>

    <div class="flex flex-1 overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 text-white p-4 overflow-y-auto">
            <h2 class="text-2xl font-bold mb-4">Menu</h2>
            <nav>
                <div class="mb-4">
                    <button class="flex items-center justify-between w-full text-lg font-semibold mb-2" onclick="toggleMenu('gestionDette')">
                        Gestion Dette
                        <i class="fas fa-plus"></i>
                    </button>
                    <ul id="gestionDette" class="pl-4 hidden">
                        <li><a href="#" class="hover:text-gray-300">Sous-menu 1</a></li>
                        <li><a href="#" class="hover:text-gray-300">Sous-menu 2</a></li>
                        <li><a href="#" class="hover:text-gray-300">Sous-menu 3</a></li>
                    </ul>
                </div>
                <div>
                    <button class="flex items-center justify-between w-full text-lg font-semibold mb-2" onclick="toggleMenu('gestionClient')">
                        Gestion Client
                        <i class="fas fa-plus"></i>
                    </button>
                    <ul id="gestionClient" class="pl-4 hidden">
                        <li><a href="#" class="hover:text-gray-300">Sous-menu 1</a></li>
                        <li><a href="#" class="hover:text-gray-300">Sous-menu 2</a></li>
                        <li><a href="#" class="hover:text-gray-300">Sous-menu 3</a></li>
                    </ul>
                </div>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-4">
            <div class="max-w-full mx-auto">
                <div class="flex flex-col md:flex-row mt-10">
                    <!-- Formulaire de saisie client -->
                    <div class="w-full md:w-1/2 bg-white p-4 rounded shadow-md mb-4 md:mb-0 md:mr-4">
                        <h2 class="text-xl font-bold mb-4">Nouveau Client</h2>
                        <div class="mb-4">
                            <label for="nom" class="block text-sm font-medium text-gray-700">Nom:</label>
                            <input type="text" id="nom" name="nom" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" placeholder="Nom client">
                        </div>
                        <div class="mb-4">
                            <label for="prenom" class="block text-sm font-medium text-gray-700">Prénom:</label>
                            <input type="text" id="prenom" name="prenom" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" placeholder="Prénom client">
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
                            <input type="email" id="email" name="email" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" placeholder="Email client">
                        </div>
                        <div class="mb-4">
                            <label for="telephone" class="block text-sm font-medium text-gray-700">Téléphone:</label>
                            <input type="text" id="telephone" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" name="telephone" placeholder="Numéro téléphone">
                        </div>
                        <div class="mb-4">
                            <label for="photo" class="block text-sm font-medium text-gray-700">Photo:</label>
                              <input type="text" id="telephone" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" name="photo" placeholder="lien photo">
                        </div>
                        <div class="text-center">
                            <button class="px-6 py-2 btn-blue text-white rounded-md">Enregistrer</button>
                        </div>
                    </div>
                    <!-- Suivi Client -->
                    <div class="w-full md:w-1/2 bg-white p-4 rounded shadow-md">
                        <h2 class="text-xl font-bold mb-4">Suivi Client</h2>
                        <div class="mb-4">
                            <label for="recherche" class="block text-sm font-medium text-gray-700">Téléphone:</label>
                            <div class="flex">
                                <input type="text" id="recherche" placeholder="rechercher un client" class="flex-1 p-2 border border-gray-300 rounded-md">
                                <button class="ml-2 px-4 py-2 btn-blue text-white rounded-md">Ok</button>
                            </div>
                        </div>
                        <div class="border p-4 rounded-md mb-4">
                            <div class="flex items-center mb-4">
                                <span class="font-medium text-gray-700 mr-2">Client:</span>
                                <button class="ml-auto px-4 py-2 btn-blue text-white rounded-md mr-2">Nouvelle</button>
                                <button class="px-4 py-2 btn-blue text-white rounded-md">Dette</button>
                            </div>
                            <div class="flex flex-col md:flex-row items-center mb-4">
                                <div class="w-full md:w-1/3 mb-4 md:mb-0">
                                    <div class="p-2 w-full border border-gray-300 rounded-md text-center">
                                        <img src="https://via.placeholder.com/150" alt="Client Image" class="mx-auto">
                                    </div>
                                </div>
                                <div class="w-full md:w-2/3 md:ml-4">
                                    <p><span class="font-medium">Nom:</span> ___</p>
                                    <p><span class="font-medium">Prénom:</span> ___</p>
                                    <p><span class="font-medium">Email:</span> ___</p>
                                </div>
                            </div>
                            <div class="mb-4">
                                <p><span class="font-medium">Total dettes:</span> ___</p>
                                <p><span class="font-medium">Montant verser:</span> ___</p>
                                <p><span class="font-medium">Montant Restant:</span> ___</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        function toggleMenu(id) {
            const menu = document.getElementById(id);
            const icon = event.currentTarget.querySelector('i');
            if (menu.classList.contains('hidden')) {
                menu.classList.remove('hidden');
                icon.classList.remove('fa-plus');
                icon.classList.add('fa-minus');
            } else {
                menu.classList.add('hidden');
                icon.classList.remove('fa-minus');
                icon.classList.add('fa-plus');
            }
        }
    </script>
</body>
</html>