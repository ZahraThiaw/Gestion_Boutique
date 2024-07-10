<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paiement d'une dette</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="max-w-4xl mx-auto p-4">
        <div class="text-center bg-white p-4 rounded shadow-md mb-6">
            <h1 class="text-2xl font-bold">Paiement d'une dette</h1>
        </div>
        <div class="bg-white p-4 rounded shadow-md">
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <h2 class="text-lg font-bold">Client:</h2>
                    <p><span class="font-medium">Montant Total</span> : _______</p>
                    <p><span class="font-medium">Montant verser</span> : _______</p>
                    <p><span class="font-medium">Montant Restant</span> : _______</p>
                </div>
                <div>
                    <h2 class="text-lg font-bold">Nom:</h2>
                    <p>_________</p>
                </div>
            </div>
            <div class="border-t border-gray-200 pt-4">
                <h2 class="text-xl font-bold mb-4 text-center">Montant à Versé</h2>
                <div class="mb-4">
                    <label for="montant" class="block text-sm font-medium text-gray-700">Montant :</label>
                    <input type="text" id="montant" class="mt-1 p-2 block w-full border border-gray-300 rounded-md">
                </div>
                <div class="text-center">
                    <button class="px-6 py-2 bg-teal-500 text-white rounded-md">OK</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
