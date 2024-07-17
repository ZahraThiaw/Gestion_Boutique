<!-- <!DOCTYPE html>
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
                <p><strong>Nom:</strong> <?php echo $client->nom; ?></p>
                <p><strong>Prénom:</strong> <?php echo $client->prenom; ?></p>
                <p><strong>Téléphone:</strong> <?php echo $client->telephone; ?></p>
            </div>
            <div class="border p-4 rounded-md mb-4">
                <div class="flex items-center mb-4">
                    <form action="enregistrerdette" method="POST">
                        <input type="hidden" name="id" value="<?php echo $client->id; ?>">
                        <label for="reference" class="mr-2">Référence:</label>
                        <input type="text" id="reference" name="reference" placeholder="rechercher un article" class="flex-1 p-2 border border-gray-300 rounded-md" value="<?php echo $article->reference ?? ''; ?>">
                        <button type="submit" class="ml-2 px-4 py-2 bg-teal-500 text-white rounded-md" style="background-color: #019b98;">Ok</button>
                    </form>
                </div>
                <?php if (!empty($error)) : ?>
                    <div class="text-red-500 text-center mb-4"><?php echo $error; ?></div>
                <?php endif; ?>

                <form action="enregistrerdette" method="POST">
                    <input type="hidden" name="id" value="<?php echo $client->id; ?>">
                    <input type="hidden" name="reference" value="<?php echo $article->reference ?? ''; ?>">
                    <div class="grid grid-cols-3 gap-4 mb-4">
                        <div>
                            <label for="libelle" class="block text-sm font-medium text-gray-700">Libellé</label>
                            <input type="text" id="libelle" name="libelle" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" value="<?php echo $article->libelle ?? ''; ?>" disabled>
                        </div>
                        <div>
                            <label for="prix" class="block text-sm font-medium text-gray-700">Prix</label>
                            <input type="number" id="prix" name="prix" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" value="<?php echo $article->prix ?? ''; ?>" disabled>
                        </div>
                        <div>
                            <label for="quantite" class="block text-sm font-medium text-gray-700">Quantité</label>
                            <input type="number" min="1" id="quantite" name="quantite" class="mt-1 p-2 block w-full border border-gray-300 rounded-md">
                        </div>
                    </div>
                    <button type="submit" class="px-4 py-2 bg-teal-500 text-white rounded-md" style="background-color: #019b98;">Ajouter</button>
                </form>
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
                        Ajouter plus de lignes si nécessaire
                    </tbody>
                </table>
            </div>
            <div class="flex justify-end mb-4">
                <span class="text-xl font-bold">Total:</span>
                <span class="text-xl font-bold ml-2"></span>
            </div>
            <div class="text-center">
                <button type="submit" class="px-6 py-2 bg-teal-500 text-white rounded-md" style="background-color: #019b98;">Enregistrer</button>
            </div>
        </div>
    </div>
</body>
</html> -->



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
                <p><strong>Nom:</strong> <?php echo htmlspecialchars($client->nom); ?></p>
                <p><strong>Prénom:</strong> <?php echo htmlspecialchars($client->prenom); ?></p>
                <p><strong>Téléphone:</strong> <?php echo htmlspecialchars($client->telephone); ?></p>
            </div>
            <?php if (!empty($successMessage)) : ?>
                    <div class="text-green-500 text-center mb-4"><?php echo htmlspecialchars($successMessage); ?></div>
                <?php endif; ?>
            <div class="border p-4 rounded-md mb-4">
                <div class="flex items-center mb-4">
                    <form action="enregistrerdette" method="POST">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($client->id); ?>">
                        <label for="reference" class="mr-2">Référence:</label>
                        <input type="text" id="reference" name="reference" placeholder="rechercher un article" class="flex-1 p-2 border border-gray-300 rounded-md" value="<?php echo htmlspecialchars($article->reference ?? ''); ?>">
                        <button type="submit" class="ml-2 px-4 py-2 bg-teal-500 text-white rounded-md" style="background-color: #019b98;">Ok</button>
                    </form>
                </div>
                <?php if (!empty($error)) : ?>
                    <div class="text-red-500 text-center mb-4"><?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>

                <form action="enregistrerdette" method="POST">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($client->id); ?>">
                    <input type="hidden" name="reference" value="<?php echo htmlspecialchars($article->reference ?? ''); ?>">
                    <div class="grid grid-cols-3 gap-4 mb-4">
                        <div>
                            <label for="libelle" class="block text-sm font-medium text-gray-700">Libellé</label>
                            <input type="text" id="libelle" name="libelle" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" value="<?php echo htmlspecialchars($article->libelle ?? ''); ?>" disabled>
                        </div>
                        <div>
                            <label for="prix" class="block text-sm font-medium text-gray-700">Prix</label>
                            <input type="number" id="prix" name="prix" class="mt-1 p-2 block w-full border border-gray-300 rounded-md" value="<?php echo htmlspecialchars($article->prix ?? ''); ?>" disabled>
                        </div>
                        <div>
                            <label for="quantite" class="block text-sm font-medium text-gray-700">Quantité</label>
                            <input type="number" min="1" id="quantite" name="quantite" class="mt-1 p-2 block w-full border border-gray-300 rounded-md">
                        </div>
                    </div>
                    <button type="submit" class="px-4 py-2 bg-teal-500 text-white rounded-md" style="background-color: #019b98;">Ajouter</button>
                </form>
            </div>
            <?php if (!empty($_SESSION['panier'])) : ?>
                <div class="overflow-x-auto mb-4">
                    <table class="min-w-full bg-white border border-gray-300 rounded-md">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 border-b">Libelle</th>
                                <th class="px-4 py-2 border-b">Prix</th>
                                <th class="px-4 py-2 border-b">Quantité</th>
                                <th class="px-4 py-2 border-b">Montant</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($_SESSION['panier'] as $item) : ?>
                                <tr>
                                    <td class="px-4 py-2 border-b"><?php echo htmlspecialchars($item['libelle']); ?></td>
                                    <td class="px-4 py-2 border-b"><?php echo htmlspecialchars(number_format($item['prix'], 2, ',', ' ') . ' FCFA'); ?></td>
                                    <td class="px-4 py-2 border-b"><?php echo htmlspecialchars($item['quantite']); ?></td>
                                    <td class="px-4 py-2 border-b"><?php echo htmlspecialchars(number_format($item['prix'] * $item['quantite'], 2, ',', ' ') . ' FCFA'); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        
                        </tbody>
                    </table>
                    </div>
                    <div class="flex justify-end mb-4">
                        <span class="text-xl font-bold">Total:</span>
                        <span class="text-xl font-bold ml-2">
                            <?php
                        $total = 0;
                        foreach ($_SESSION['panier'] as $item) {
                            $total += $item['prix'] * $item['quantite'];
                        }
                        echo htmlspecialchars(number_format($total, 2, ',', ' ') . ' FCFA');
                        ?>
                    </span>
                </div>
            <?php endif; ?>
            <form action="enregistrerdette" method="POST">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($client->id); ?>">
                <input type="hidden" name="save" value="true">
                <div class="text-center">
                    <button type="submit" class="px-6 py-2 bg-teal-500 text-white rounded-md" style="background-color: #019b98;">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
