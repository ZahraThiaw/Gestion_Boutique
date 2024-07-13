<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paiement d'une dette</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="max-w-5xl mx-auto p-4 mt-10">
        <div class="bg-grey-200 p-4 rounded shadow-md">
            <div class="text-center bg-white p-4 rounded shadow-md mb-6">
                <h1 class="text-2xl font-bold">Paiement d'une dette</h1>
            </div>
            <?php if (!empty($successMessage)) : ?>
                <div class="text-green-500 text-center mb-4"><?php echo $successMessage; ?></div>
            <?php endif; ?>
            <?php if (!empty($error)) : ?>
                <div class="text-red-500 text-center mb-4"><?php echo $error; ?></div>
            <?php endif; ?>
            <div class="bg-white p-4 rounded shadow-md">
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <?php if (!empty($client) && !empty($dette)): ?>
                    <div>
                        <h2 class="text-lg font-bold">Client:  <?php echo $client->prenom . ' ' . $client->nom; ?></h2>
                        <p><span class="font-medium">Montant Total</span> : <?php echo $dette->montant_total; ?></p>
                        <p><span class="font-medium">Montant versé</span> : <?php echo $dette->montant_verse; ?></p>
                        <p><span class="font-medium">Montant Restant</span> : <?php echo $dette->montant_restant; ?></p>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="border-t border-gray-200 pt-4">
                    <h2 class="text-xl font-bold mb-4 text-center">Montant à Verser</h2>
                    <form action="enregistrerpaiement" method="POST">
                        <input type="hidden" name="id" value="<?php echo $dette->id; ?>">
                        <div class="mb-4">
                            <label for="montant" class="block text-sm font-medium text-gray-700">Montant :</label>
                            <input type="text" id="montant" name="montant" class="mt-1 p-2 block w-full border border-gray-300 rounded-md">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="px-6 py-2 bg-teal-500 text-white rounded-md" style="background-color: #019b98;">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

