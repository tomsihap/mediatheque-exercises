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
            FROM user
            LEFT JOIN media
                ON media.id = user.media_id
            LEFT JOIN type
                ON media.type_id = type.id
            WHERE user.id = ' . $_GET['id'];




$response = $bdd->query($request);
$user = $response->fetch(PDO::FETCH_ASSOC);

?>

<!-- // Inclusion du header -->
<?php include ('partials/_header.php'); ?>
<a href="liste-users.php" class="btn btn-sm btn-secondary">< retour à la liste des utilisateurs</a>
<h1>Page profil utilisateur</h1>

<div class="card">
    <div class="card-header"><?= $user['userName']?></div>
    <div class="card-body">
        <h2>Film loué par cet utilisateur : 
            <a href="page-media.php?id=<?= $user['mediaId']?>">
                <?= $user['mediaTitle']?> (<?= $user['mediaCreator']?>)
            </a>
            - Type :
            <a href="page-type.php?id=<?= $user['typeId']?>">
                <?= $user['typeName']?>
            </a>
        </h2>
    </div>
</div>

</table>
<!-- // Inclusion du footer -->
<?php include('partials/_footer.php'); ?>