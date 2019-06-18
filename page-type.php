<?php session_start(); // Obligatoire pour utiliser les sessions ?>
<?php require_once 'pdo.php' ?>

<?php
// Récupérer les données avec PDO
$request = 'SELECT  media.id as mediaId,
                    media.creator as mediaCreator,
                    media.title as mediaTitle,
                    media.type_id as mediaTypeId,
                    type.id as typeId,
                    type.name as typeName
            FROM media
            INNER JOIN type
                ON media.type_id = type.id
            WHERE type_id = ' . $_GET['id'];




$response = $bdd->query($request);
$medias = $response->fetchAll(PDO::FETCH_ASSOC);

?>

<!-- // Inclusion du header -->
<?php include ('partials/_header.php'); ?>
<a href="liste-types.php" class="btn btn-sm btn-secondary">< retour à la liste des types</a>
<a href="ajout-type.php" class="btn btn-sm btn-primary float-right">Nouveau type</a>
<h1>Page type</h1>

<div class="card">
    <div class="card-header"><?= $medias[0]['typeName']?></div>
    <div class="card-body">
        <h2>Liste des médias de ce type :</h2>
        <ul>
            <?php foreach ($medias as $media) : ?>
                <li>
                    <a href="page-media.php?id=<?= $media['mediaId'] ?>">
                        <?= $media['mediaTitle'] ?> (<?= $media['mediaCreator'] ?>)
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>

</table>
<!-- // Inclusion du footer -->
<?php include('partials/_footer.php'); ?>