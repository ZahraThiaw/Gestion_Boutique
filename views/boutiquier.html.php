<?php
// $data = [];
// if (isset($Clients->id)) {
//     $data['client'] = $Clients;
//     $data['dettes'] = $Dettes;
// }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Dettes</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="mx-auto p-4 px-12">
        <!-- <div class="flex justify-between items-center text-center bg-gray-300 p-4 rounded mb-6 px-20">
            <h1 class="text-3xl font-bold text-center">Bienvenue sur le site de gestion des dettes</h1>

            <aside class="p-4 flex">
                <ul class="flex">
                    <li>
                        <a href="/boutiquier" class="block py-2 px-4 hover:bg-gray-300 w-full text-left">Accueil</a>
                    </li>
                    <li>
                        <a href="/listerdettes" class="block py-2 px-4 hover:bg-gray-300 w-full text-left">Lister les dettes</a>
                    </li>
                    <li>
                        <a href="/enregistrerdette" class="block py-2 px-4 hover:bg-gray-300 w-full text-left">Enregistrer une dette</a>
                    </li>
                </ul>
            </aside>
        </div> -->
        <div class="flex mt-10">
            <!-- Formulaire de saisie client -->
            <div class="w-1/2 bg-white p-4 rounded shadow-md mr-4">
                <h2 class="text-xl font-bold mb-4">Nouveau Client</h2>

                <form action="clientsave" method="POST" enctype="multipart/form-data">
                    <div class="mb-4">
                        <label for="nom" class="block text-sm font-medium text-gray-700">Nom:</label>
                        <input type="text" id="nom" name="nom" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" placeholder="Nom client" value="<?php echo htmlspecialchars($_SESSION['valid_data']['nom'] ?? ''); ?>">
                        <?php if (isset($errors['nom'])): ?>
                            <p class="text-red-500 text-sm mt-1"><?php echo $errors['nom']; ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="mb-4">
                        <label for="prenom" class="block text-sm font-medium text-gray-700">Prénom:</label>
                        <input type="text" id="prenom" name="prenom" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" placeholder="Prénom client" value="<?php echo htmlspecialchars($_SESSION['valid_data']['prenom'] ?? ''); ?>">
                        <?php if (isset($errors['prenom'])): ?>
                            <p class="text-red-500 text-sm mt-1"><?php echo $errors['prenom']; ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
                        <input type="email" id="email" name="email" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" placeholder="Email client" value="<?php echo htmlspecialchars($_SESSION['valid_data']['email'] ?? ''); ?>">
                        <?php if (isset($errors['email'])): ?>
                            <p class="text-red-500 text-sm mt-1"><?php echo $errors['email']; ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="mb-4">
                        <label for="telephone" class="block text-sm font-medium text-gray-700">Téléphone:</label>
                        <input type="text" id="telephone" name="telephone" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" placeholder="Numéro téléphone" value="<?php echo htmlspecialchars($_SESSION['valid_data']['telephone'] ?? ''); ?>">
                        <?php if (isset($errors['telephone'])): ?>
                            <p class="text-red-500 text-sm mt-1"><?php echo $errors['telephone']; ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="mb-4">
                        <label for="photo" class="block text-sm font-medium text-gray-700">Photo:</label>
                        <input type="file" id="photo" name="photo" class="mt-1 p-2 block w-full border border-gray-300 rounded-md">
                        <?php if (isset($errors['photo'])): ?>
                            <p class="text-red-500 text-sm mt-1"><?php echo $errors['photo']; ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="text-center">
                        <button class="px-6 py-2 bg-teal-500 rounded-md" style="background-color: #019b98;" type="submit">Enregistrer</button>
                    </div>
                </form>
            </div>

            <!-- Suivi Client -->
            <div class="w-1/2 bg-white p-4 rounded shadow-md">
                <h2 class="text-xl font-bold mb-4 text-center">Suivi Client</h2>
                <div class="mb-4">
                    <form action="boutiquier" method="POST">
                        <label for="recherche" class="block text-sm font-medium text-gray-700">Téléphone:</label>
                        <div class="flex">
                            <input type="text" id="recherche" name="telephone" placeholder="Rechercher un client" class="flex-1 p-2 border border-gray-300 rounded-md" value="<?php echo $Clients->telephone ?? ''; ?>">
                            <button class="ml-2 px-4 py-2 bg-teal-500 text-white rounded-md" style="background-color: #019b98;" type="submit">Ok</button>
                        </div>
                    </form>
                </div>
                <?php if (isset($Clients) && $Clients !== false) : ?>
                    <div class="border p-4 rounded-md mb-4">
                        <div class="flex items-center mb-4">
                            <span class="font-medium text-gray-700 mr-2">Client:</span>
                            <form action="/enregistrerdettes" method="POST">
                                <input type="hidden" name="id" value="<?php echo $Clients->id; ?>">
                                <button class="ml-auto px-4 py-2 bg-teal-500 text-white rounded-md mr-2" style="background-color: #019b98;">Nouvelle</button>
                            </form>
                            <form action="/literdettes" method="POST">
                                <input type="hidden" name="id" value="<?php echo $Clients->id; ?>">
                                <button class="px-4 py-2 bg-teal-500 text-white rounded-md" style="background-color: #019b98;">Dette</button>
                            </form>
                        </div>
                        <div class="flex items-center mb-4">
                            <div class="w-1/3">
                                <div class="p-2 w-full border border-gray-300 rounded-md text-center">
                                    <img src="https://via.placeholder.com/150" alt="Client Image" class="mx-auto">
                                </div>
                            </div>
                            <div class="w-2/3 ml-4">
                                <p><span class="font-medium">Nom:</span> <?php echo htmlspecialchars($Clients->nom); ?></p>
                                <p><span class="font-medium">Prénom:</span> <?php echo htmlspecialchars($Clients->prenom); ?></p>
                                <p><span class="font-medium">Email:</span> <?php echo htmlspecialchars($Clients->email); ?></p>
                            </div>
                        </div>
                        <div class="mb-4">
                            <p><span class="font-medium">Total dettes:</span>  <?php echo $Dettes !== false ? htmlspecialchars($Dettes->montant_total) : ''; ?><p>
                            <p><span class="font-medium">Montant versé:</span>  <?php echo $Dettes !== false ? htmlspecialchars($Dettes->montant_verse) : ''; ?></p>
                            <p><span class="font-medium">Montant restant:</span><?php echo $Dettes !== false ? htmlspecialchars($Dettes->montant_restant) : ''; ?></p>
                        </div>
                    </div>
                <?php elseif (isset($error)) : ?>
                    <p class="text-red-500"><?php echo htmlspecialchars($error); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
