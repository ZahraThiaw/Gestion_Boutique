<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des paiements d'une dette</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-5xl mx-auto bg-white p-8 rounded-lg shadow mt-8">
        <h1 class="text-2xl font-bold mb-4">Liste des paiements d'une dette</h1>
        <?php if (!empty($client) && !empty($dette)): ?>
            <div class="grid grid-cols-3 gap-4 mb-4">
                <div class="col-span-1">
                    <p><strong>Client: </strong> <?php echo $client->prenom . ' ' .$client->nom; ?></p>
                    <!-- <label class="block text-gray-700">Client</label>
                    <div class="border-b-2 border-gray-300 py-2"><?php echo $client->prenom . ' ' . $client->nom; ?></div> -->
                </div>
                <div class="col-span-1">
                    <p><strong>Montant versé: </strong><?php echo $dette->montant_verse; ?></p>
                    <!-- <label class="block text-gray-700">Montant versé</label>
                    <div class="border-b-2 border-gray-300 py-2"><?php echo $dette->montant_verse; ?></div> -->
                </div>
                <div class="col-span-1">
                    <p><strong>Montant restant: </strong><?php echo $dette->montant_restant; ?></p>
                    <!-- <label class="block text-gray-700">Montant restant</label>
                    <div class="border-b-2 border-gray-300 py-2"><?php echo $dette->montant_restant; ?></div> -->
                </div>
            </div>
            <?php if (!empty($paiements)): ?>
                <div class="overflow-x-auto mb-4 mt-8">
                    <table class="min-w-full bg-white border border-gray-300">
                        <thead>
                            <tr class="w-full bg-gray-200 text-gray-700">
                                <th class="py-2 px-4 border-r border-gray-300">Date</th>
                                <th class="py-2 px-4">Montant</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($paiements as $paiement) : ?>
                                <tr class="text-center">
                                    <td class="py-2 px-4 border-r border-gray-300"><?php echo $paiement->date; ?></td>
                                    <td class="py-2 px-4"><?php echo $paiement->montant; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="flex justify-end">
                    <div>
                        <p><strong>Montant Total: </strong><?php echo $dette->montant_verse; ?></p>
                        <!-- <label class="block text-gray-700">Montant Total</label>
                        <div class="border-b-2 border-gray-300 py-2"><?php echo $dette->montant_verse; ?></div> -->
                    </div>
                </div>
            <?php else: ?>
                <p class="text-gray-700 text-center mt-10">Aucun paiement effectué pour cette dette.</p>
            <?php endif; ?>

        <?php endif; ?>
    </div>
</body>
</html>
