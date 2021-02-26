<?php
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'database.php';
$title = 'Burger Code Login Admin';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'elements' . DIRECTORY_SEPARATOR . 'header.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'functions' . DIRECTORY_SEPARATOR . 'function_verif_html_entities.php';

$email = $password = $error = null;

if (!empty($_POST)) {
    $email = checkInput($_POST['email']);
    $password = checkInput($_POST['password']);
    $db = Database::connect();
    $statement = $db->prepare('SELECT * FROM users WHERE email = ? AND password = ?');
    $statement->execute(array($email, $password));
    Database::disconnect();

    if ($statement->fetch()) {
        session_start();
        $_SESSION['email'] = $email;
        header('Location: admine.php');
    } else {
        $error = 'Identifiants incorrects';
    }
}

?>

<!-- HTML CODE -->
<div class="container">
    <div class="site">
        <!-- TITRE -->
        <h1 class="text-logo"><span><i class="fas fa-utensils"></i></span> Burger Code <span><i class="fas fa-utensils"></i></span></h1>
    </div>
    <div class="row">
        <!-- description produit -->
        <div class="col-sm-12">
            <h1 style="padding-bottom: 30px;"><strong>Login</strong></h1>
            <?php if ($error) : ?>
                <div class="alert alert-danger" style="margin-top:3px;">
                    <span class="help-inline"><?= $error ?></span>
                </div>
            <?php endif; ?>
            <form class="form" action="" method="POST">
                <div class="form-group">
                    <label for="email">Email :</label>
                    <input class="form-control" type="email" name="email" id="email" placeholder="Votre email" value="<?= $email ?>">
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe :</label>
                    <input class="form-control" type="password" name="password" id="password" placeholder="Votre mot de passe" value="<?= $password ?>">
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary" style="width: auto;">Se connecter</button>
                </div>
            </form>
        </div>
    </div>
</div>