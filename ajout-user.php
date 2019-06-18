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
        Header('Location: liste-users.php');
    }
    else {
        throw new Exception('Il y a eu un problème lors de l\'enregistrement des données.');
    }
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
                <input name="media_id" class="form-control" type="text">
            </div>

            <button class="btn btn-primary float-right" type="submit">Créer</button>

        </form>
        <!-- / FORMULAIRE D'AJOUT -->

        <!-- // Inclusion du footer -->
        <?php include('partials/_footer.php'); ?>