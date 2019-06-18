<?php session_start(); // Obligatoire pour utiliser les sessions ?>
<?php require_once 'pdo.php' ?>


<?php
if (!empty($_POST)) {

    // Gérer les données du formulaire
    $query = "  INSERT INTO media (creator, title, type_id)
                VALUES (:creator, :title, :type_id)";

    $request = $bdd->prepare($query);

    $response = $request->execute([
        'creator'   => $_POST['creator'],
        'title'     => $_POST['title'],
        'type_id'   => $_POST['type_id'],
    ]);

    if ($response) {
        $_SESSION['info'][] = "Le média a bien été ajouté.";
        Header('Location: liste-medias.php'); exit();
    }
    else {
        throw new Exception('Il y a eu un problème lors de l\'enregistrement des données.');
    }

}

// Récupération de la liste des types de médias pour le select>option

$request = "SELECT * FROM type";
$response = $bdd->query($request);
$types = $response->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- // Inclusion du header -->
<?php include('partials/_header.php'); ?>

<a href="liste-medias.php" class="btn btn-sm btn-secondary">< retour à la liste</a>
<h1>Ajout d'un média</h1>

<!-- FORMULAIRE D'AJOUT -->
<form action="ajout-media.php" method="post">

    <div class="form-group">
        <label for="formCreator">Créateur</label>
        <input name="creator" class="form-control" type="text">
    </div>

    <div class="form-group">
        <label for="formTitle">Titre</label>
        <input name="title" class="form-control" type="text">
    </div>

    <div class="form-group">
        <label for="formTypeId">Type de média</label>
        <select class="form-control" name="type_id">
            <?php foreach ($types as $type) : ?>
                <option value="<?= $type['id'] ?>"><?= $type['name'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <button class="btn btn-primary float-right" type="submit">Créer</button>

</form>
<!-- / FORMULAIRE D'AJOUT -->

<!-- // Inclusion du footer -->
<?php include('partials/_footer.php'); ?>