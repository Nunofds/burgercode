<?php
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'database.php';
require_once 'function_verif_html_entities.php';

// for INSERT.PHP page 

$name = $description = $price = $category = $image = $nameError = $descriptionError = $priceError = $categoryError = $imageError = '';
if (!empty($_POST)) {
    $name = checkInput($_POST['name']);
    $description = checkInput($_POST['description']);
    $price = checkInput($_POST['price']);
    $category = checkInput($_POST['categorie']);
    $image = checkInput($_FILES['image']['name']);
    $imagePath = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . basename($image);
    $imageExtension = pathinfo($imagePath, PATHINFO_EXTENSION);
    $isSuccess = true;
    $isUploadSuccess = false;

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
        $imageError = 'Veuilez renseigner ce champ';
        $isSuccess = false;
    } else {
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

    if ($isSuccess && $isUploadSuccess) {
        $db = Database::connect();
        $statement = $db->prepare("INSERT INTO items (name, description, price, category, image) VALUES (?, ?, ?, ?, ?)");
        $statement->execute(array($name, $description, $price, $category, $image));
        Database::disconnect();
        header("Location: admine.php");
    }
}
