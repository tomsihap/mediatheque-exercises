<?php require_once 'pdo.php' ?>


<?php
if (!empty($_POST)) {

    // Gérer les données du formulaire
    $query = "  INSERT INTO user (name, media_id)
                VALUES (:name, :media_id)";

    $request = $bdd->prepare($query);

    $request->execute([
        'name'      => $_POST['name'],
        'media_id'  => $_POST['media_id']
    ]);
}
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
                <label for="formMediaId"># du média emprunté</label>
                <input name="media_id" class="form-control" type="number">
            </div>

            <button class="btn btn-primary float-right" type="submit">Créer</button>

        </form>
        <!-- / FORMULAIRE D'AJOUT -->

        <!-- // Inclusion du footer -->
        <?php include('partials/_footer.php'); ?>