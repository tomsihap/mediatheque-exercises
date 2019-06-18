<?php session_start(); // Obligatoire pour utiliser les sessions ?>
<?php require_once 'pdo.php' ?>


<?php
// Récupérer les données avec PDO
$request = 'SELECT  user.id as userId,
                    user.name as userName,
                    user.media_id as userMediaId,
                    media.id as mediaId,
                    media.title as mediaTitle,
                    media.creator as mediaCreator,
                    media.type_id as mediaTypeId
            FROM user
            LEFT JOIN media
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
<?php foreach($users as $user) :

    // Soit on affiche : "Média (créateur)", soit on n'affiche rien si pas de média emprunté.
    $mediaEmprunte = ($user['userMediaId']) ? $user['mediaTitle'] . ' (' . $user['mediaCreator'] . ')' : '' ?>
    <tr>
        <td><?= $user['userId'] ?></td>
        <td><?= $user['userName'] ?></td>
        <td><?= $mediaEmprunte ?></td>
    </tr>
<?php endforeach; ?>
</table>

<!-- // Inclusion du footer -->
<?php include('partials/_footer.php'); ?>