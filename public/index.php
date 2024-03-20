<?php

session_start();
require_once("../src/models/DbModel.php");
require_once("../src/models/UserModel.php");
require_once("../src/models/MessageModel.php");
require_once("../src/controllers/Controller.php");
require_once("../src/controllers/MainController.php");
require_once("../src/controllers/RegisterController.php");
require_once("../src/controllers/LoginController.php");
require_once("../core/router.php");



try{
    $db = new PDO("mysql:host=127.0.0.1;dbname=social_network", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //Je crée un objet de mon routeur
   $app = new Router();
   //J'appelle la fonction qui gère les routes (donc qui renvoie l'utilisateur vers le bon controller)
   $app->start();
}
catch(PDOException|Exception $e){
    die($e->getMessage());
}