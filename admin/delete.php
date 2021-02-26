<?php
session_start();
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . "functions" . DIRECTORY_SEPARATOR . "login_functions.php";
forcer_utilisateur_connecte();

$title = 'Burger Code delete item';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'elements' . DIRECTORY_SEPARATOR . 'header.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'functions' . DIRECTORY_SEPARATOR . 'function_verif_html_entities.php';
require_once 'database.php';

if (!empty($_GET['id'])) {
    $id = checkInput($_GET['id']);
}

if (!empty($_POST)) {
    $id = checkInput($_POST['id']);
    $db = Database::connect();
    $statement = $db->prepare('DELETE FROM items WHERE id= ?');
    $statement->execute(array($id));
    Database::disconnect();
    header('Location: admine.php');
}
?>

<!-- HTML CODE -->
<div class="container">
    <div class="site">
        <!-- TITRE -->
        <h1 class="text-logo"><span><i class="fas fa-utensils"></i></span> Burger Code <span><i class="fas fa-utensils"></i></span></h1>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <h1 style="padding-bottom: 30px;"><strong>Supprimer un item</strong></h1>
            <form class="form" action="delete.php" method="POST">
                <input type="hidden" name="id" value="<?= $id ?>">
                <div class="alert alert-warning">
                    <p>Etes vous sûr de vouloir Supprimer ?</p>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-warning" style="width:auto; margin-right: 20px;"><span><i class="fas fa-check"></i></span> Oui</button>
                    <a href="admine.php" class="btn btn-danger" style="width:auto; text-shadow: 2px 2px #333; font-size: 16px;"><span><i class="fas fa-times"></i></span> Non</a>
                </div>
            </form>
            <a href="admine.php" class="btn btn-primary" style="width:auto; text-shadow: 2px 2px #333; font-size: 16px;"><span><i class="fas fa-long-arrow-alt-left"></i></span> Retour admin</a>
        </div>
    </div>
</div>