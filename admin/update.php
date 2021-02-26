<?php
session_start();
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . "functions" . DIRECTORY_SEPARATOR . "login_functions.php";
forcer_utilisateur_connecte();

$title = 'Burger Code update item';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'elements' . DIRECTORY_SEPARATOR . 'header.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'functions' . DIRECTORY_SEPARATOR . 'functions_for_update.php';
?>

<!-- HTML CODE -->
<div class="container">
    <div class="site">
        <!-- TITRE -->
        <h1 class="text-logo"><span><i class="fas fa-utensils"></i></span> Burger Code <span><i class="fas fa-utensils"></i></span></h1>
    </div>
    <div class="row">
        <!-- formulaire -->
        <div class="col-sm-6">
            <h1 style="padding-bottom: 30px;"><strong>Modifier un item</strong></h1>
            <form class="form" action="<?= 'update.php?id=' . $id ?>" method="POST" enctype="multipart/form-data">
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
                    <label for="price">Prix (en €) : </label>
                    <input class="form-control" type="number" step="0.01" name="price" id="price" placeholder="Prix (en €) :" value="<?= $price ?>">
                    <span class="help-inline"><?= $priceError ?></span>
                </div>
                <div class="form-group">
                    <label for="categorie">Catégorie : </label>
                    <select class="form-control" name="categorie" id="categorie">
                        <?php
                        $db = Database::connect();
                        foreach ($db->query('SELECT * FROM categories') as $row) {
                            if ($row['id'] == $category) {
                                echo '<option selected="selected" value="' . $row['id'] . '">' . $row['name'] . '</option>';
                            } else {
                                echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                            }
                        }
                        Database::disconnect();
                        ?>
                    </select>
                    <span class="help-inline"><?= $categoryError ?></span>
                </div>
                <div class="form-group">
                    <label for="">Image:</label>
                    <p><?= $image ?></p>
                    <label for="image">Sélectionner une image : </label>
                    <input type="file" name="image" id="image">
                    <span class="help-inline"><?= $imageError ?></span>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-success" style="width:auto; margin-right: 20px;"><span><i class="fas fa-pencil-alt"></i></span> Modifer</button>
                    <a href="admine.php" class="btn btn-primary" style="width:auto; text-shadow: 2px 2px #333; font-size: 16px;"><span><i class="fas fa-long-arrow-alt-left"></i></span> Retour</a>
                </div>
            </form>
        </div>
        <!-- image -->
        <div class="col-sm-6 site">
            <div class="img-thumbnail">
                <img src="<?= '../images/' . $image ?>" alt="...">
                <div class="price"><?= number_format((float)$price, 2, ',', '') . ' €' ?></div>
                <div class="caption">
                    <h4><?= $name ?></h4>
                    <p><?= $description ?></p>
                    <button class="btn btn-primary" type="submit">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-dash-fill" viewBox="0 0 16 16">
                                <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM6.5 7h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1 0-1z" />
                            </svg>
                        </span> Commander
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>