<?php session_start(); // Obligatoire pour utiliser les sessions ?>
<?php require_once 'pdo.php' ?>


<?php

if (!empty($_POST)) {

    // Gérer les données du formulaire
    $query = "  INSERT INTO type (name)
                VALUES (:name)";

    $request = $bdd->prepare($query);

    $response = $request->execute([
        'name'   => $_POST['name'],
    ]);

    if ($response) {
        $_SESSION['info'][] = "Le type a bien été ajouté.";
        Header('Location: liste-types.php'); exit();
    }
    else {
        throw new Exception('Il y a eu un problème lors de l\'enregistrement des données.');
    }

}
?>

<!-- // Inclusion du header -->
<?php include('partials/_header.php'); ?>

<a href="liste-types.php" class="btn btn-sm btn-secondary">< retour à la liste</a>
<h1>Ajout d'un type de média</h1>

<!-- FORMULAIRE D'AJOUT -->
<form action="ajout-type.php" method="post">

    <div class="form-group">
        <label for="formName">Nom du nouveau type</label>
        <input name="name" class="form-control" type="text">
    </div>

    <button class="btn btn-primary float-right" type="submit">Créer</button>

</form>
<!-- / FORMULAIRE D'AJOUT -->

<!-- // Inclusion du footer -->
<?php include('partials/_footer.php'); ?>