<?php
/**
 * Created by PhpStorm.
 * User: qjb
 * Date: 14/01/2019
 * Time: 15:58
 */
require_once ('conn.php');
session_start();

if(!isset($_SESSION['username'])&& isset($_POST['login'])){
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
}



?>


<!doctype html>
<html lang="fr">
<head>
    <title>Accueil Musique</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-lg-12">

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
