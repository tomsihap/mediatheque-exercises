<?php session_start(); // Obligatoire pour utiliser les sessions ?>
<?php require_once 'pdo.php' ?>


<?php
if (!empty($_POST)) {

    // Gérer les données du formulaire
    $query = "  INSERT INTO user (name, media_id)
                VALUES (:name, :media_id)";

    $request = $bdd->prepare($query);

    $response = $request->execute([
        'name'      => $_POST['name'],
        'media_id'  => $_POST['media_id']
    ]);

    if ($response) {
        $_SESSION['info'][] = "L'utilisateur a bien été ajouté.";
        Header('Location: liste-users.php'); exit();
    }
    else {
        throw new Exception('Il y a eu un problème lors de l\'enregistrement des données.');
    }
}

// Récupération de la liste des types de médias pour le select>option

$request = "SELECT  media.id as mediaId,
                    media.creator as mediaCreator,
                    media.Title as mediaTitle,
                    type.id as typeId,
                    type.name as typeName
            FROM media
            LEFT JOIN type
                ON media.type_id = type.id";
$response = $bdd->query($request);
$medias = $response->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- // Inclusion du header -->
<?php include('partials/_header.php'); ?>

<a href="liste-users.php" class="btn btn-sm btn-secondary">
    < retour à la liste</a> <h1>Ajout d'un utilisateur</h1>

        <!-- FORMULAIRE D'AJOUT -->
        <form action="ajout-user.php" method="post">

            <div class="form-group">
                <label for="formName">Nom de l'emprunteur</label>
                <input name="name" class="form-control" type="text">
            </div>

            <div class="form-group">
                <label for="formMediaId">Média emprunté</label>
                <select class="form-control" name="media_id">
                    <?php foreach ($medias as $media) : ?>
                        <option value="<?= $media['mediaId'] ?>">
                            <?= $media['mediaTitle'] ?> (<?= $media['mediaCreator'] ?>) - Type : <?= $media['typeName'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button class="btn btn-primary float-right" type="submit">Créer</button>

        </form>
        <!-- / FORMULAIRE D'AJOUT -->

        <!-- // Inclusion du footer -->
        <?php include('partials/_footer.php'); ?>