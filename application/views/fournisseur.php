<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Fournisseurs</title>
    <link rel="stylesheet" href="<?php  echo base_url("assets/css/test.css") ?>">
</head>
<body>
    <h2>Liste des Fournisseurs</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($fournisseurs as $fournisseur): ?>
            <tr>
                <td><?= $fournisseur->idfournisseur ?></td>
                <td><?= $fournisseur->nomfournisseur ?></td>
                <td><?= $fournisseur->emailfournisseur ?></td>
                <td>
                    <a href="<?= base_url("fournisseur/edit/{$fournisseur->idfournisseur}") ?>">Modifier</a>
                    <a href="<?= base_url("fournisseur/remove/{$fournisseur->idfournisseur}") ?>">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
