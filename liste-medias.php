<?php session_start(); // Obligatoire pour utiliser les sessions ?>

<?php require_once 'pdo.php' ?>

<?php
// Récupérer les données avec PDO
$request = 'SELECT  media.id as mediaId,
                    media.title as mediaTitle,
                    media.creator as mediaCreator,
                    type.id as typeId,
                    type.name as typeName
            FROM media
            LEFT JOIN type
                ON media.type_id = media.id';
$response = $bdd->query($request);
$medias = $response->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- // Inclusion du header -->
<?php include ('partials/_header.php'); ?>
<a href="index.php" class="btn btn-sm btn-secondary">< retour à l'index</a>
<a href="ajout-media.php" class="btn btn-sm btn-primary float-right">Nouveau média</a>

<h1>Liste des médias</h1>

<!-- // Foreach du tableau -->
<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Créateur</th>
            <th>Titre</th>
            <th>Type de média</th>
        </tr>
    </thead>
<?php foreach($medias as $media) : ?>
    <tr>
        <td><?= $media['mediaId'] ?></td>
        <td><?= $media['mediaCreator'] ?></td>
        <td><?= $media['mediaTitle'] ?></td>
        <td><?= $media['typeName'] ?></td>
    </tr>
<?php endforeach; ?>
</table>

<!-- // Inclusion du footer -->
<?php include('partials/_footer.php'); ?>