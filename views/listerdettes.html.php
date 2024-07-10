<?php
    
    
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des dettes</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-6xl mx-auto bg-white p-8 rounded-lg shadow">
        <h1 class="text-3xl font-bold mb-4">Liste dettes</h1>
        <div class="flex justify-between mb-4">
            <div>
                <label class="block text-gray-700">Client:</label>
                <div class="border-b-2 border-gray-300 py-2"></div>
            </div>
            <div>
                <label class="block text-gray-700">Téléphone:</label>
                <div class="border-b-2 border-gray-300 py-2"></div>
            </div>
        </div>
        <div class="flex items-center mb-4">
            <label class="block text-gray-700 mr-4">Statut</label>
            <div class="relative inline-block text-left">
                <select class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                    <option>solder</option>
                    <option>non solder</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M7 10l5 5 5-5z"/></svg>
                </div>
            </div>
            <button class="ml-4 bg-teal-500 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded">
                Ok
            </button>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr class="bg-gray-200 text-gray-700">
                        <th class="py-2 px-4 border-r border-gray-300">Date</th>
                        <th class="py-2 px-4 border-r border-gray-300">Montant</th>
                        <th class="py-2 px-4 border-r border-gray-300">Restant</th>
                        <th class="py-2 px-4 border-r border-gray-300">Paiement</th>
                        <th class="py-2 px-4">Liste des paiements</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($data != null) : ?>
                        <?php foreach ($data as $dette): ?>
                            <tr class="text-center">
                                <td class="py-2 px-4 border-r border-gray-300"><?php echo $dette->date; ?></td>
                                <td class="py-2 px-4 border-r border-gray-300"><?php echo $dette->montant_total; ?></td>
                                <td class="py-2 px-4 border-r border-gray-300"><?php echo $dette->montant_restant; ?></td>
                                <td class="py-2 px-4 border-r border-gray-300 text-teal-500 cursor-pointer"><button type="subtmit">Payer</button></td>
                                <td class="py-2 px-4 text-teal-500 cursor-pointer"><button type="subtmit">Lister</button></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p>Aucune dette enregistrée pour ce client</p>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
