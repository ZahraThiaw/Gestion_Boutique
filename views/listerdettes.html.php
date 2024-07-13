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
        <h1 class="text-3xl font-bold mb-4">Liste des dettes</h1>

        <?php if (!empty($error)) : ?>
            <div class="text-red-500 text-center mb-4"><?php echo $error; ?></div>
        <?php endif; ?>
        <?php if (isset($_GET['success'])) : ?>
            <div class="text-green-500 text-center mb-4"><?php echo htmlspecialchars($_GET['success']); ?></div>
        <?php endif; ?>

       <form method="POST" class="mb-4">
            <div class="flex justify-between">
                <div>
                    <label for="status" class="block text-gray-700">Filtrer par statut:</label>
                    <select name="status" id="status" class="border rounded p-2">
                        <option value="0" <?php echo (isset($status) && $status == 0) ? 'selected' : ''; ?>>Non soldés</option>
                        <option value="1" <?php echo (isset($status) && $status == 1) ? 'selected' : ''; ?>>Soldés</option>
                    </select>
                </div>
                <div>
                    <label for="date" class="block text-gray-700">Filtrer par date:</label>
                    <input type="date" name="date" id="date" class="border rounded p-2" value="<?php echo htmlspecialchars($date); ?>">
                </div>
                <div>
                    <input type="hidden" name="id" value="<?php echo $client->id; ?>">
                    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md">Filtrer</button>
                </div>
            </div>
        </form>



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
                                        <button type="submit" class="bg-teal-500 text-white py-1 px-4 rounded-md" style="background-color: #019b98;">Détails</button>
                                    </form>
                                </td>
                                <td class="py-2 px-4 border-r border-gray-300">
                                    <form action="listerpaiements" method="POST">
                                        <input type="hidden" name="id" value="<?php echo $dette->id; ?>">
                                        <button type="submit" class="bg-teal-500 text-white py-1 px-4 rounded-md" style="background-color: #019b98;">Voir Paiements</button>
                                    </form>
                                </td>
                                <td class="py-2 px-4">
                                    <form action="enregistrerpaiement" method="POST">
                                        <input type="hidden" name="id" value="<?php echo $dette->id; ?>">
                                        <button type="submit" class="bg-teal-500 text-white py-1 px-4 rounded-md" style="background-color: #019b98;">Payer</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else : ?>
            <p class="text-gray-700 text-center">Aucune dette trouvée.</p>
        <?php endif; ?>


        <!-- Pagination -->
        <?php if ($total > 0) : ?>
            <div class="flex justify-center mt-4">
                <?php
                $totalPages = ceil($total / $perPage);
                for ($i = 1; $i <= $totalPages; $i++): ?>
                    <form action="" method="POST" class="inline">
                        <input type="hidden" name="id" value="<?php echo $client->id; ?>">
                        <input type="hidden" name="status" value="<?php echo htmlspecialchars($status); ?>">
                        <input type="hidden" name="date" value="<?php echo htmlspecialchars($date); ?>">
                        <button type="submit" name="page" value="<?php echo $i; ?>" class="border px-3 py-1 <?php echo $i == $currentPage ? 'bg-blue-500 text-white' : 'bg-white text-blue-500'; ?>">
                            <?php echo $i; ?>
                        </button>
                    </form>
                <?php endfor; ?>
            </div>
        <?php endif; ?>

    </div>
</body>
</html>
