<?php session_start(); // Obligatoire pour utiliser les sessions ?>
<?php require_once 'pdo.php' ?>


<?php
// Récupérer les données avec PDO
$request = 'SELECT  user.id as userId,
                    user.name as userName,
                    media.id as mediaId,
                    media.title as mediaTitle,
                    media.creator as mediaCreator,
                    media.type_id as mediaTypeId
            FROM user
            INNER JOIN media
                ON user.media_id = media.id';
$response = $bdd->query($request);
$users = $response->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- // Inclusion du header -->
<?php include ('partials/_header.php'); ?>
<a href="index.php" class="btn btn-sm btn-secondary">< retour à l'index</a>
<a href="ajout-user.php" class="btn btn-sm btn-primary float-right">Nouvel utilisateur</a>

<h1>Liste des utilisateurs</h1>

<!-- // Foreach du tableau -->
<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Nom de l'utilisateur</th>
            <th>Média emprunté</th>
        </tr>
    </thead>
<?php foreach($users as $user) : ?>
    <tr>
        <td><?= $user['userId'] ?></td>
        <td><?= $user['userName'] ?></td>
        <td><?= $user['mediaTitle'] ?> (<?= $user['mediaCreator'] ?>)</td>
    </tr>
<?php endforeach; ?>
</table>

<!-- // Inclusion du footer -->
<?php include('partials/_footer.php'); ?>