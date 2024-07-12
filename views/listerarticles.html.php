<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des articles de la dette</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-7xl mx-auto bg-white p-8 rounded-lg shadow mt-8">
        <?php if (!empty($client) && !empty($articles) && !empty($dettearticles)): ?>
            <h1 class="text-2xl font-bold mb-4 text-center">Liste des articles de la dette</h1>
            <div class="mb-4">
                <p><strong>Nom:</strong> <?php echo $client->nom; ?></p>
                <p><strong>Prénom:</strong> <?php echo $client->prenom; ?></p>
                <p><strong>Téléphone:</strong> <?php echo $client->telephone; ?></p>
            </div>
            <table class="table-auto w-full bg-white border border-gray-300 border-collapse mb-4">
                <thead>
                    <tr class="bg-gray-200 text-gray-700">
                        <th class="border border-gray-400 px-4 py-2">Référence</th>
                        <th class="border border-gray-400 px-4 py-2">Libellé</th>
                        <th class="border border-gray-400 px-4 py-2">Quantité</th>
                        <th class="border border-gray-400 px-4 py-2">Prix</th>
                        <th class="border border-gray-400 px-4 py-2">Montant</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($articles as $article) : ?>
                        <tr>
                            <td class="border border-gray-400 px-4 py-2"><?php echo $article->reference; ?></td>
                            <td class="border border-gray-400 px-4 py-2"><?php echo $article->libelle; ?></td>
                            <td class="border border-gray-400 px-4 py-2"><?php echo $dettearticles->quantite; ?></td>
                            <td class="border border-gray-400 px-4 py-2"><?php echo $article->prix; ?></td>
                            <td class="border border-gray-400 px-4 py-2"><?php echo $dettearticles->quantite * $article->prix; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="text-right font-bold">
                <p>Total de la dette: <?php echo $dette->montant_total; ?></p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
