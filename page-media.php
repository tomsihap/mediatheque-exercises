<?php session_start(); // Obligatoire pour utiliser les sessions ?>
<?php require_once 'pdo.php' ?>

<?php
// Récupérer les données avec PDO
$request = 'SELECT  media.id as mediaId,
                    media.creator as mediaCreator,
                    media.title as mediaTitle,
                    media.type_id as mediaTypeId,
                    type.id as typeId,
                    type.name as typeName,
                    user.id as userId,
                    user.name as userName
            FROM media
            LEFT JOIN type
                ON media.type_id = type.id
            LEFT JOIN user
                ON user.media_id = media.id
            WHERE media.id = ' . $_GET['id'];

$response = $bdd->query($request);
$media = $response->fetch(PDO::FETCH_ASSOC);

?>

<!-- // Inclusion du header -->
<?php include ('partials/_header.php'); ?>
<a href="liste-medias.php" class="btn btn-sm btn-secondary">< retour à la liste des médias</a>
<h1>Page média</h1>

<div class="card">
    <div class="card-header"><?= $media['mediaTitle']?> (<?= $media['mediaCreator']?>) - Type : <?= $media['typeName']?></div>
    <div class="card-body">
        <h2>Utilisateur louant ce film : <a href="page-user.php?id=<?= $media['userId'] ?>"><?= $media['userName']?></a></h2>
    </div>
</div>

</table>
<!-- // Inclusion du footer -->
<?php include('partials/_footer.php'); ?>