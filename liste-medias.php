<?php session_start(); // Obligatoire pour utiliser les sessions ?>

<?php require_once 'pdo.php' ?>

<?php
// Récupérer les données avec PDO
$request = 'SELECT  media.id as mediaId,
                    media.title as mediaTitle,
                    media.creator as mediaCreator,
                    type.id as typeId,
                    type.name as typeName,
                    user.media_id as userMediaId,
                    user.name as userName,
                    user.id as userId
            FROM media
            LEFT JOIN type
                ON media.type_id = type.id
            LEFT JOIN user
                ON user.media_id = media.id
            ORDER BY media.title ASC';
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
            <th>Loué ?</th>
        </tr>
    </thead>
<?php foreach($medias as $media) : 
    
    // Par défaut, pas d'emprunteur
    $hasEmprunteur = '<span class="badge badge-danger">Non</span>';
    
    // Si il y a un emprunteur :
    if ($media['userMediaId']) {
        $hasEmprunteur = '<a href="page-user.php?id='.$media['userId'].'"><span class="badge badge-success">'.$media['userName'].' (Voir le profil)</span></a>';
    }
    ?>
    <tr>
        <td><?= $media['mediaId'] ?></td>
        <td><?= $media['mediaCreator'] ?></td>
        <td><a href="page-media.php?id=<?= $media['mediaId'] ?>"><?= $media['mediaTitle'] ?></a></td>
        <td><?= $media['typeName'] ?></td>
        <td><?= $hasEmprunteur ?></td>
    </tr>
<?php endforeach; ?>
</table>

<!-- // Inclusion du footer -->
<?php include('partials/_footer.php'); ?>