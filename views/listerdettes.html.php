<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des dettes</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-7xl mx-auto bg-white p-8 rounded-lg shadow mt-8">
        <h1 class="text-3xl font-bold mb-4">Liste dettes</h1>
        
        <?php if (!empty($client)) : ?>
            <div class="flex justify-between mb-4">
                <div>
                    <label class="block text-gray-700">Client:</label>
                    <div class="border-b-2 border-gray-300 py-2"><?php echo $client->prenom . ' ' . $client->nom; ?></div>
                </div>
                <div>
                    <label class="block text-gray-700">Téléphone:</label>
                    <div class="border-b-2 border-gray-300 py-2"><?php echo $client->telephone; ?></div>
                </div>
            </div>
        <?php endif; ?>

        <?php if (!empty($dettes)) : ?>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700">
                            <th class="py-2 px-4 border-r border-gray-300">Date</th>
                            <th class="py-2 px-4 border-r border-gray-300">Montant Total</th>
                            <th class="py-2 px-4 border-r border-gray-300">Montant Restant</th>
                            <th class="py-2 px-4 border-r border-gray-300">Détails de la dette</th>
                            <th class="py-2 px-4 border-r border-gray-300">Liste des paiements</th>
                            <th class="py-2 px-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dettes as $dette): ?>
                            <tr class="text-center">
                                <td class="py-2 px-4 border-r border-gray-300"><?php echo $dette->date; ?></td>
                                <td class="py-2 px-4 border-r border-gray-300"><?php echo $dette->montant_total; ?></td>
                                <td class="py-2 px-4 border-r border-gray-300"><?php echo $dette->montant_restant; ?></td>
                                <td class="py-2 px-4 border-r border-gray-300">
                                    <form action="listerarticles" method="POST">
                                        <input type="hidden" name="id" value="<?php echo $dette->id; ?>">
                                        <button type="submit" class="text-teal-500 cursor-pointer">Détails</button>
                                    </form>
                                </td>
                                <td class="py-2 px-4 border-r border-gray-300">
                                    <form action="listerpaiements" method="POST">
                                        <input type="hidden" name="id" value="<?php echo $dette->id; ?>">
                                        <button type="submit" class="text-teal-500 cursor-pointer">Lister</button>
                                    </form>
                                </td>
                                <td class="py-2 px-4">
                                    <form action="enregistrerpaiement" method="POST">
                                        <input type="hidden" name="id" value="<?php echo $dette->id; ?>">
                                        <button type="submit" class="text-teal-500 cursor-pointer">Payer</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else : ?>
            <p class="text-gray-700 text-center">Aucune dette enregistrée pour ce client.</p>
        <?php endif; ?>
    </div>
</body>
</html>
