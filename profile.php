<?php
require_once ('conn.php');
session_start();
$stmt = $bdd->prepare('SELECT * FROM user WHERE id=:id');
$stmt->execute(array("id" => $_SESSION['id']));
$user = $stmt->fetchAll()[0];

if(isset($_POST['email'])){
    $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    $stmt = $bdd->prepare('UPDATE user SET login= :login, mdp= :password, nom= :nom, prenom= :prenom');
    $stmt->execute(array("login" => $_POST['email'], "password" => $_POST['mdp'], "nom" => $_POST['nom'], "prenom" => $_POST['prenom']));
    header('Location: accueil.php');
}
?>
<!doctype html>
<html lang="en">
<head>
    <title>Profil</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-sm navbar-light bg-light">
    <a class="navbar-brand" href="#">Gestion Musique</a>
    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId"
            aria-controls="collapsibleNavId"
            aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavId">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="accueil.php">Albums</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="artiste.php">Artistes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="fav.php">Favoris</a>
            </li>
        </ul>
        <ul class="navbar-nav my-2 my-lg-0">
            <li class="nav-item active">
                <a class="nav-link" href="profile.php">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?d=1">Deconnexion</a>
            </li>
        </ul>
    </div>
</nav>
<div class="container">
    <div class="row" style="display: flex; flex-direction: column; justify-content: center; height: 100vh; text-align: center">
        <h1>Modification compte</h1>
        <div class="col-lg-6 offset-lg-3 mt-4">
            <form method="post" action="#" style="border: 1px solid black; padding: 20px; border-radius: 5px;">
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom" value="<?=$user['nom'] ?>">
                </div>
                <div class="form-group">
                    <label for="prenom">Prenom</label>
                    <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Prenom" value="<?=$user['prenom'] ?>">
                </div>
                <div class="form-group">
                    <label for="email">Adresse email</label>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Email" value="<?=$user['login'] ?>">
                </div>
                <div class="form-group">
                    <label for="mpd">Mot de passe</label>
                    <input type="password" class="form-control" name="mdp" id="mdp" placeholder="Mot de passe" value="<?=$user['mdp'] ?>">
                </div>
                <button type="submit" name="login" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
</body>
</html>