<?php
session_start();
require_once 'functions/login_functions.php';

$title = 'Burger Code';
require_once 'elements/header_index.php';
require 'admin/database.php';

// base de données categories
$db = Database::connect();
$statement = $db->query('SELECT * FROM categories');
$categories = $statement->fetchAll();
foreach ($categories as $category) {
    if ($category['id'] == '1') {
        $active = '<li role="presentation" class="nav-item active"><a class="nav-link" href="' . $category['id'] . '" data-toggle="tab">' . $category['name'] . '</a></li>';
    } else {
        $notActive = '<li role="presentation" class="nav-item"><a class="nav-link" href="' . $category['id'] . '" data-toggle="tab">' . $category['name'] . '</a></li>';
    }
}

function affiche()
{
    $db = Database::connect();
    $statement = $db->query('SELECT * FROM categories');
    $categories = $statement->fetchAll();

    foreach ($categories as $category) {
        if ($category['id'] == '1') {
            echo '<div class="tab-pane active" id="' . $category['id'] . '">';
        } else {
            echo '<div class="tab-pane" id="' . $category['id'] . '">';
        }
        echo '<div class="row">';
        $statement = $db->prepare('SELECT * FROM items WHERE items.category = ?');
        $statement->execute(array($category['id']));

        while ($item = $statement->fetch()) {
            echo '<div class="col-sm-6 col-md-4">
                        <div class="img-thumbnail">
                            <img src="images/' . $item['image'] . '" alt="...">
                            <div class="price">' . number_format($item['price'], 2, ',', '') . ' €</div>
                            <div class="caption">
                                <h4>' . $item['name'] . '</h4>
                                <p>' . $item['description'] . '</p>
                                <button class="btn btn-primary" type="submit">
                                    <span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-dash-fill" viewBox="0 0 16 16"><path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM6.5 7h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1 0-1z" /></svg>
                                    </span> Commander
                                </button>
                            </div>
                        </div>
                    </div>';
        }
        echo '</div>
        </div>';
    }
}
?>

<!-- HTML CODE -->

<body>
    <div class="container site">
        <!-- TITRE -->
        <h1 class="text-logo"><span><i class="fas fa-utensils"></i></span> Burger Code <span><i class="fas fa-utensils"></i></span></h1>
        <!-- NAVBAR -->
        <nav>
            <ul class="nav nav-pills">
                <?php foreach ($categories as $category) : ?>
                    <?php if ($category['id'] == '1') : ?>
                        <li role="presentation" class="nav-item active"><a class="nav-link" href="<?= '#' . $category['id'] ?>" data-toggle="tab"><?= $category['name'] ?></a></li>
                    <?php else : ?>
                        <li role="presentation" class="nav-item"><a class="nav-link" href="<?= '#' . $category['id'] ?>" data-toggle="tab"><?= $category['name'] ?></a></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </nav>
        <!-- CONTENUE PAGE -->
        <div class="tab-content">
            <?= affiche(); ?>
            <?php Database::disconnect(); ?>
        </div>
    </div>
    <!-- FIN CONTENUE PAGE -->
</body>

<!-- Jquery CSS link -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<!-- BOOTSTRAP JS link -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>

</html>