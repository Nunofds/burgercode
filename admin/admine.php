<?php
session_start();
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . "functions" . DIRECTORY_SEPARATOR . "login_functions.php";
forcer_utilisateur_connecte();

$title = 'Burger Code admin';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . "elements" . DIRECTORY_SEPARATOR . "header.php";
?>

<!-- HTML CODE -->
<div class="container">
    <div class="site">
        <!-- TITRE -->
        <h1 class="text-logo"><span><i class="fas fa-utensils"></i></span> Burger Code <span><i class="fas fa-utensils"></i></span></h1>
    </div>
    <div class="row">
        <h1><strong>Liste des items </strong><a href="insert.php" class="btn btn-success btn-lg"><span><i class="fas fa-plus"></i></span> Ajouter</a></h1>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Prix</th>
                    <th>Catégorie</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require 'database.php';

                $db = Database::connect();
                $statement = $db->query('SELECT items.id, items.name, items.description, items.price, categories.name AS category
                                        FROM items LEFT JOIN categories ON items.category = categories.id
                                        ORDER BY items.id DESC');
                while ($item = $statement->fetch()) {
                    echo '<tr>';
                    echo '<td>' . $item['name'] . '</td>';
                    echo '<td>' . $item['description'] . '</td>';
                    echo '<td>' . number_format((float) $item['price'], 2, ',', '') . '€' . '</td>';
                    echo '<td>' . $item['category'] . '</td>';
                    echo '<td width=300>';
                    echo '<a style="margin:2px;" class="btn btn-default" href="view.php?id=' . $item['id'] . '"><span><i class="far fa-eye"></i></span> Voir</a>';
                    echo '<a style="margin:2px;" class="btn btn-primary" href="update.php?id=' . $item['id'] . '"><span><i class="fas fa-pencil-alt"></i></span> Modifier</a>';
                    echo '<a style="margin:2px;" class="btn btn-danger" href="delete.php?id=' . $item['id'] . '"><span><i class="fas fa-times"></i></span> Suprimer</a>';
                    echo '</td>';
                    echo '</tr>';
                }
                Database::disconnect();
                ?>
            </tbody>
        </table>
    </div>
</div>


<?php require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . "elements" . DIRECTORY_SEPARATOR . "header.php"; ?>