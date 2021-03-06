<?php
/**
 * Created by PhpStorm.
 * User: qjb
 * Date: 14/01/2019
 * Time: 15:58
 */
require_once ('conn.php');
session_start();

if(!isset($_SESSION['username'])){
    header('Location: index.php');
}

if (isset($_GET['del'])){
    $stmt = $bdd->prepare('DELETE FROM `fav` WHERE `idFav` = :idFav AND `idUser` = :idUser');
    $stmt->execute(array("idUser" => $_SESSION['id'], "idFav" => $_GET['del']));
}


$stmt = $bdd->prepare('SELECT art_id, art_nom, gen_libelle, pay_libelle FROM `artistes`, genres, pays WHERE art_pays = pay_pays AND art_genre = gen_genre AND art_id IN (SELECT idFav FROM fav WHERE idUser = :id AND typeFav = "artistes")');
$stmt->execute(array("id" => $_SESSION['id']));
$artistes = $stmt->fetchAll(2);

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
            <li class="nav-item">
                <a class="nav-link" href="accueil.php">Albums</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="artiste.php">Artistes</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="fav.php">Favoris</a>
            </li>
        </ul>
        <ul class="navbar-nav my-2 my-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="profile.php">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?d=1">Deconnexion</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container" style="padding: 0 0 50px;">
    <div class="row" style="text-align:center;">
        <div class="col-6"><a href="fav.php" ><h1 class="mt-5" id="albums">Liste des albums</h1></a></div>
        <div class="col-6"><a href="favArtistes.php" ><h1 class="mt-5" id="artistes">Liste des artistes</h1></a></div>
    </div>

    <div class="row mt-5">

        <div class="col-lg-12">
            <table id="artiste" class="table table-striped table-bordered" style="width: 100%">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Genre</th>
                    <th scope="col">Pays</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($artistes as $artiste){ ?>
                    <tr>
                        <th scope="row"><?=$artiste['art_id'] ?></th>
                        <td><?=$artiste['art_nom'] ?></td>
                        <td><?=$artiste['gen_libelle'] ?></td>
                        <td><?=$artiste['pay_libelle'] ?></td>
                        <td style="display: flex; text-align: center;">
                            <div style="width: 100%">
                                <a href="favArtistes.php?del=<?=$artiste['art_id'] ?>"> <i class="fa fa-trash" aria-hidden="true"></i> </a>
                            </div>
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

        $('#artiste').DataTable({
            pageLength: 25, //your page size here
            language : {
                "sProcessing":     "Traitement en cours...",
                "sSearch":         "Rechercher&nbsp;:",
                "sLengthMenu":     "Afficher _MENU_ &eacute;l&eacute;ments",
                "sInfo":           "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
                "sInfoEmpty":      "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
                "sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                "sInfoPostFix":    "",
                "sLoadingRecords": "Chargement en cours...",
                "sZeroRecords":    "Aucun &eacute;l&eacute;ment &agrave; afficher",
                "sEmptyTable":     "Aucune donn&eacute;e disponible dans le tableau",
                "oPaginate": {
                    "sFirst":      "Premier",
                    "sPrevious":   "Pr&eacute;c&eacute;dent",
                    "sNext":       "Suivant",
                    "sLast":       "Dernier"
                },
                "oAria": {
                    "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
                    "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
                },
                "select": {
                    "rows": {
                        _: "%d lignes séléctionnées",
                        0: "Aucune ligne séléctionnée",
                        1: "1 ligne séléctionnée"
                    }
                }
            }
        });
    } );
</script>
</body>
</html>
