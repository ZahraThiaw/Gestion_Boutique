<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enregistrer une nouvelle dette</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="max-w-3xl mx-auto p-4">
        <h1 class="text-2xl font-bold text-center mb-4">Enregistrer une nouvelle dette</h1>
        <div class="bg-white p-4 rounded shadow-md">
            <div class="mb-4">
                <label for="client" class="block text-sm font-medium text-gray-700">Client:</label>
                <input type="text" id="client" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" disabled>
            </div>
            <div class="mb-4">
                <label for="telephone" class="block text-sm font-medium text-gray-700">Téléphone:</label>
                <input type="text" id="telephone" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" disabled>
            </div>
            <div class="border p-4 rounded-md mb-4">
                <div class="flex items-center mb-4">
                    <label for="ref" class="mr-2">Ref:</label>
                    <input type="text" id="ref" placeholder="rechercher un client" class="flex-1 p-2 border border-gray-300 rounded-md">
                    <button class="ml-2 px-4 py-2 bg-teal-500 text-white rounded-md">Ok</button>
                </div>
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <div>
                        <label for="libelle" class="block text-sm font-medium text-gray-700">Libellle</label>
                        <input type="text" id="libelle" class="mt-1 p-2 block w-full border border-gray-300 rounded-md">
                    </div>
                    <div>
                        <label for="prix" class="block text-sm font-medium text-gray-700">Prix</label>
                        <input type="text" id="prix" class="mt-1 p-2 block w-full border border-gray-300 rounded-md">
                    </div>
                    <div>
                        <label for="quantite" class="block text-sm font-medium text-gray-700">Quantité</label>
                        <input type="text" id="quantite" class="mt-1 p-2 block w-full border border-gray-300 rounded-md">
                    </div>
                </div>
                <button class="px-4 py-2 bg-teal-500 text-white rounded-md">Ok</button>
            </div>
            <div class="overflow-x-auto mb-4">
                <table class="min-w-full bg-white border border-gray-300 rounded-md">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 border-b">Article</th>
                            <th class="px-4 py-2 border-b">Prix</th>
                            <th class="px-4 py-2 border-b">Quantité</th>
                            <th class="px-4 py-2 border-b">Montant</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="px-4 py-2 border-b"></td>
                            <td class="px-4 py-2 border-b"></td>
                            <td class="px-4 py-2 border-b"></td>
                            <td class="px-4 py-2 border-b"></td>
                        </tr>
                        <!-- Ajouter plus de lignes si nécessaire -->
                    </tbody>
                </table>
            </div>
            <div class="flex justify-end mb-4">
                <span class="text-xl font-bold">Total:</span>
                <span class="text-xl font-bold ml-2">0</span>
            </div>
            <div class="text-center">
                <button class="px-6 py-2 bg-teal-500 text-white rounded-md">Enregistrer</button>
            </div>
        </div>
    </div>
</body>
</html>
