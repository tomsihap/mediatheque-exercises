<?php require_once 'pdo.php' ?>


<?php
if (!empty($_POST)) {

    // Gérer les données du formulaire
    $query = "  INSERT INTO media (creator, title, type_id)
                VALUES (:creator, :title, :type_id)";

    $request = $bdd->prepare($query);

    $request->execute([
        'creator'   => $_POST['creator'],
        'title'     => $_POST['title'],
        'type_id'   => $_POST['type_id'],
    ]);

}
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
        <label for="formTypeId"># du type de média</label>
        <input name="type_id" class="form-control" type="number">
    </div>

    <button class="btn btn-primary float-right" type="submit">Créer</button>

</form>
<!-- / FORMULAIRE D'AJOUT -->

<!-- // Inclusion du footer -->
<?php include('partials/_footer.php'); ?>