<?php
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'database.php';
require_once 'function_verif_html_entities.php';

// for UPDATE.PHP page

if (!empty($_GET['id'])) {
    $id = checkInput($_GET['id']);
}

$name = $description = $price = $category = $image = $nameError = $descriptionError = $priceError = $categoryError = $imageError = '';

if (!empty($_POST)) {
    $name = checkInput($_POST['name']);
    $description = checkInput($_POST['description']);
    $price  = checkInput($_POST['price']);
    $category = checkInput($_POST['categorie']);
    $image = checkInput($_FILES['image']['name']);
    $imagePath = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . basename($image);
    $imageExtension = pathinfo($imagePath, PATHINFO_EXTENSION);
    $isSuccess = true;

    // name
    if (empty($name)) {
        $nameError = 'Veuilez renseigner ce champ';
        $isSuccess = false;
    }
    // description
    if (empty($description)) {
        $descriptionError = 'Veuilez renseigner ce champ';
        $isSuccess = false;
    }
    // price
    if (empty($price)) {
        $priceError = 'Veuilez renseigner ce champ';
        $isSuccess = false;
    }
    // categorie
    if (empty($category)) {
        $categoryError = 'Veuilez renseigner ce champ';
        $isSuccess = false;
    }
    // image
    if (empty($image)) {
        $isImageUpdated = false;
    } else {
        $isImageUpdated = true;
        $isUploadSuccess = true;
        if ($imageExtension != 'jpg' && $imageExtension != 'png' && $imageExtension != 'jpeg' && $imageExtension != 'gif') {
            $imageError = 'Les fichiers autorises sont: .jpg, .png, .jpeg, .gif';
            $isSuccess = false;
        }
        if (file_exists($imagePath)) {
            $imageError = 'Les fichier existe dejà';
            $isSuccess = false;
        }
        if ($_FILES['image']['size'] > 500000) {
            $imageError = 'Le fichier ne doit pas depasser les 500KB';
            $isSuccess = false;
        }
        if ($isUploadSuccess) {
            if (!move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
                $imageError = 'Il y a eu une erreur lors de l\'upload de l\'image';
                $isUploadSuccess = false;
            }
        }
    }

    if (($isSuccess && $isImageUpdated && $isUploadSuccess) || ($isSuccess && !$isImageUpdated)) {
        $db = Database::connect();
        if ($isImageUpdated) {
            $statement = $db->prepare("UPDATE items SET name = ?, description = ?, price = ?, category = ?, image = ? WHERE id = ?");
            $statement->execute(array($name, $description, $price, $category, $image, $id));
        } else {
            $statement = $db->prepare("UPDATE items SET name = ?, description = ?, price = ?, category = ? WHERE id = ?");
            $statement->execute(array($name, $description, $price, $category, $id));
        }
        Database::disconnect();
        header("Location: admine.php");
    } else if ($isImageUpdated && !$isUploadSuccess) {
        $db = Database::connect();
        $statement = $db->prepare('SELECT image FROM items WHERE id = ?');
        $statement->execute(array($id));
        $item = $statement->fetch();
        $image = $item['image'];
        Database::disconnect();
    }
} else {
    $db = Database::connect();
    $statement = $db->prepare('SELECT * FROM items WHERE id = ?');
    $statement->execute(array($id));
    $item = $statement->fetch();
    $name = $item['name'];
    $description = $item['description'];
    $price = $item['price'];
    $category = $item['category'];
    $image = $item['image'];
    Database::disconnect();
}
