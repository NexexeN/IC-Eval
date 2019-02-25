<?php
/**
 * Created by PhpStorm.
 * User: qjb
 * Date: 14/01/2019
 * Time: 15:58
 */
require_once ('conn.php');
session_start();

if(isset($_POST['email'])&& isset($_POST['mdp'])){
    $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    $stmt = $bdd->prepare('SELECT id, login FROM user WHERE login = :login AND mdp = :password');
    $stmt->execute(array("login" => $_POST['email'], "password" => $_POST['mdp']));
    $result = $stmt->fetchAll()[0];
    if (count($result) > 0){
        $_SESSION['id'] = $result['id'];
        $_SESSION['username'] = $result['login'];
    } else {
        header('Location: index.php');
    }
}elseif(!isset($_SESSION['username'])){
    header('Location: index.php');
}

if (isset($_GET['fav'])){
    $stmt = $bdd->prepare('INSERT INTO fav (`idUser`, `idFav`, `typeFav`) VALUES (:id, :idFav, "albums")');
    $stmt->execute(array("id" => $_SESSION['id'], "idFav" => $_GET['fav']));
}

$stmt = $bdd->prepare('SELECT * FROM albums');
$stmt->execute();
$albums = $stmt->fetchAll();

?>


<!doctype html>
<html lang="fr">
<head>
    <title>Accueil Musique</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
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
            <li class="nav-item active">
                <a class="nav-link" href="accueil.php">Albums</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="artiste.php">Artistes</a>
            </li>
        </ul>
        <ul class="navbar-nav my-2 my-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="profile.php">Profile</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container" style="padding: 0 0 50px;">
    <h1 class="mt-5">Liste des albums</h1>
    <div class="row mt-5">
        <div class="col-lg-12">
            <table id="album" class="table table-striped table-bordered" style="width: 100%">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Année</th>
                        <th scope="col">Prix</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($albums as $album){ ?>
                    <tr>
                        <th scope="row"><?=$album['alb_id'] ?></th>
                        <td><?=$album['alb_nom'] ?></td>
                        <td><?=$album['alb_annee'] ?></td>
                        <td><?=$album['alb_prix'] ?>€</td>
                        <td style="display: flex; text-align: center;">
                            <div style="width: 100%"><a href="accueil.php?fav=<?=$album['alb_id'] ?>"> <i class="fa fa-star" aria-hidden="true"></i> </a></div>
                        </td>
                    </tr>
                <?php }?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="application/javascript">
    $(document).ready(function() {
        $('#album').DataTable({
            pageLength: 25, //your page size here
        });
    } );
</script>
</body>
</html>
