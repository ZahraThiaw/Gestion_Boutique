<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body class="bg-gray-100">
    <div class="flex align-center justify-center mt-10">
        <!-- Formulaire de saisie client -->
        <div class="w-1/3 bg-white p-4 rounded shadow-md mr-4">
            <h2 class="text-xl font-bold mb-4">Nouveau Client</h2>
            <div class="mb-4">
                <label for="nom" class="block text-sm font-medium text-gray-700">Nom:</label>
                <input type="text" id="nom" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" placeholder="Nom client">
            </div>
            <div class="mb-4">
                <label for="prenom" class="block text-sm font-medium text-gray-700">Prénom:</label>
                <input type="text" id="prenom" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" placeholder="Prénom client">
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
                <input type="email" id="email" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" placeholder="Email client">
            </div>
            <div class="mb-4">
                <label for="telephone" class="block text-sm font-medium text-gray-700">Téléphone:</label>
                <input type="text" id="telephone" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" placeholder="Numéro téléphone">
            </div>
            <div class="mb-4">
                <label for="photo" class="block text-sm font-medium text-gray-700">Photo:</label>
                <div class="mt-1 p-2 w-full border border-gray-300 rounded-md text-center">photo</div>
            </div>
            <div class="text-center">
                <button class="px-6 py-2 bg-teal-500 rounded-md" style="background-color: #019b98;">Enregistrer</button>
        </div>
    </div>
</body>
</html>