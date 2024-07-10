<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des paiements d'une dette</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow">
        <h1 class="text-2xl font-bold mb-4">Liste des paiements d'une dette</h1>
        <div class="grid grid-cols-3 gap-4 mb-4">
            <div class="col-span-1">
                <label class="block text-gray-700">Client</label>
                <div class="border-b-2 border-gray-300 py-2"></div>
            </div>
            <div class="col-span-1">
                <label class="block text-gray-700">Montant versé</label>
                <div class="border-b-2 border-gray-300 py-2"></div>
            </div>
            <div class="col-span-1">
                <label class="block text-gray-700">Montant restant</label>
                <div class="border-b-2 border-gray-300 py-2"></div>
            </div>
        </div>
        <div class="overflow-x-auto mb-4">
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr class="w-full bg-gray-200 text-gray-700">
                        <th class="py-2 px-4 border-r border-gray-300">Date</th>
                        <th class="py-2 px-4">Montant</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-center">
                        <td class="py-2 px-4 border-r border-gray-300"></td>
                        <td class="py-2 px-4"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="flex justify-end">
            <div>
                <label class="block text-gray-700">Montant Total</label>
                <div class="border-b-2 border-gray-300 py-2"></div>
            </div>
        </div>
    </div>
</body>
</html>
