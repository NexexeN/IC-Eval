<?php
/**
 * Created by PhpStorm.
 * User: qjb
 * Date: 14/01/2019
 * Time: 15:58
 */
require_once ('conn.php');
session_start();

/*if(!isset($_SESSION['username'])&& isset($_POST['login'])){
    $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    $stmt = $bdd->prepare('SELECT login FROM user WHERE login = :login AND password = :password');
    $stmt->execute(array("login" => $_POST['login'], "password" => $_POST['password']));
    $result = $stmt->fetchAll();
    if (count($result) > 0){
        $_SESSION['username'] = $_POST['login'];
    } else {
        header('Location: index.php');
    }
}else{
    header('Location: index.php');
}*/



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

    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
</head>
<body>

<div class="container">
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
                    <tr>
                        <th scope="row">1</th>
                        <td>Let It Bleed</td>
                        <td>1969</td>
                        <td>18,70€</td>
                        <td style="display: flex; text-align: center;">
                            <div style="width: 100%"><a href="album.php"> <i class="fa fa-eye" aria-hidden="true"></i> </a></div>
                            <div style="width: 100%"><a href=""> <i class="fas fa-pencil-alt" aria-hidden="true"></i> </a></div>
                            <div style="width: 100%"><a href=""> <i class="fa fa-trash" aria-hidden="true"></i> </a></div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Let It Bleed</td>
                        <td>1969</td>
                        <td>18,70€</td>
                        <td style="display: flex; text-align: center;">
                            <div style="width: 100%"><a href="album.php"> <i class="fa fa-eye" aria-hidden="true"></i> </a></div>
                            <div style="width: 100%"><a href=""> <i class="fas fa-pencil-alt" aria-hidden="true"></i> </a></div>
                            <div style="width: 100%"><a href=""> <i class="fa fa-trash" aria-hidden="true"></i> </a></div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="application/javascript">
    $(document).ready(function() {
        $('#album').DataTable();
    } );
</script>
</body>
</html>
