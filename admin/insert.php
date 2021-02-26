<?php
session_start();
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . "functions" . DIRECTORY_SEPARATOR . "login_functions.php";
forcer_utilisateur_connecte();

$title = 'Burger Code insert item';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'elements' . DIRECTORY_SEPARATOR . 'header.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'functions' . DIRECTORY_SEPARATOR . 'errors_functions.php';
?>

<!-- HTML CODE -->
<div class="container">
    <div class="site">
        <!-- TITRE -->
        <h1 class="text-logo"><span><i class="fas fa-utensils"></i></span> Burger Code <span><i class="fas fa-utensils"></i></span></h1>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <h1 style="padding-bottom: 30px;"><strong>Ajouter un item</strong></h1>
            <form class="form" action="insert.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Nom : </label>
                    <input class="form-control" type="text" name="name" id="name" placeholder="Nom" value="<?= $name ?>">
                    <span class="help-inline"><?= $nameError ?></span>
                </div>
                <div class="form-group">
                    <label for="description">Description : </label>
                    <input class="form-control" type="text" name="description" id="description" placeholder="Description" value="<?= $description ?>">
                    <span class="help-inline"><?= $descriptionError ?></span>
                </div>
                <div class="form-group">
                    <label for="price">Prix : (en €) </label>
                    <input class="form-control" type="number" step="0.01" name="price" id="price" placeholder="Prix : (en €)" value="<?= $price ?>">
                    <span class="help-inline"><?= $priceError ?></span>
                </div>
                <div class="form-group">
                    <label for="categorie">Catégorie : </label>
                    <select class="form-control" name="categorie" id="categorie">
                        <?php
                        $db = Database::connect();
                        foreach ($db->query('SELECT * FROM categories') as $row) {
                            echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                        }
                        Database::disconnect();
                        ?>
                    </select>
                    <span class="help-inline"><?= $categoryError ?></span>
                </div>
                <div class="form-group">
                    <label for="image">Sélectionner une image : </label>
                    <input type="file" name="image" id="image">
                    <span class="help-inline"><?= $imageError ?></span>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-success" style="width:auto; margin-right: 20px;"><span><i class="fas fa-check"></i></span> Ajouter</button>
                    <a href="admine.php" class="btn btn-primary" style="width:auto; text-shadow: 2px 2px #333; font-size: 16px;"><span><i class="fas fa-long-arrow-alt-left"></i></span> Retour</a>
                </div>
            </form>
        </div>
    </div>
</div>