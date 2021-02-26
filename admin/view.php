<?php
session_start();
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . "functions" . DIRECTORY_SEPARATOR . "login_functions.php";
forcer_utilisateur_connecte();

$title = 'Burger Code view item';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . "elements" . DIRECTORY_SEPARATOR . "header.php";
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'functions' . DIRECTORY_SEPARATOR . 'errors_functions.php';

if (!empty($_GET['id'])) {
    $id = checkInput($_GET['id']);
}

$db = Database::connect();
$statement = $db->prepare('SELECT items.id, items.name, items.description, items.price, items.image, categories.name AS category FROM items LEFT JOIN categories ON items.category = categories.id WHERE items.id= ?');
$statement->execute(array($id));
$item = $statement->fetch();

Database::disconnect();
?>

<!-- HTML CODE -->
<div class="container">
    <div class="site">
        <!-- TITRE -->
        <h1 class="text-logo"><span><i class="fas fa-utensils"></i></span> Burger Code <span><i class="fas fa-utensils"></i></span></h1>
    </div>
    <div class="row">
        <!-- description produit -->
        <div class="col-sm-6">
            <h1 style="padding-bottom: 30px;"><strong>Voir un item</strong></h1>
            <form>
                <div class="form-group">
                    <label for="">Nom : </label><?= ' ' . $item['name']; ?>
                </div>
                <div class="form-group">
                    <label for="">Description : </label><?= ' ' . $item['description']; ?>
                </div>
                <div class="form-group">
                    <label for="">Prix : </label><?= ' ' . number_format((float)$item['price'], 2, ',', '') . ' €'; ?>
                </div>
                <div class="form-group">
                    <label for="">Catégorie : </label><?= ' ' . $item['category']; ?>
                </div>
                <div class="form-group">
                    <label for="">Image : </label><?= ' ' . $item['image']; ?>
                </div>
            </form>
            <a href="admine.php" class="btn btn-primary" style="margin-top: 30px;"><span><i class="fas fa-long-arrow-alt-left"></i></span> Retour</a>
        </div>
        <!-- image produit -->
        <div class="col-sm-6 site">
            <div class="img-thumbnail">
                <img src="<?= '../images/' . $item['image'] ?>" alt="...">
                <div class="price"><?= number_format((float)$item['price'], 2, ',', '') . ' €' ?></div>
                <div class="caption">
                    <h4><?= $item['name'] ?></h4>
                    <p><?= $item['description'] ?></p>
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