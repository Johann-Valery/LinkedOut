<?php

class RegisterController extends Controller
{
    public function index()
    {

        if (isset ($_POST["register"])) {
            $user = new User($_POST["pseudo"], $_POST["prenom"], $_POST["nom"], $_POST["password"], $_POST["mail"]);
            User::InsertInto($user);

            header('Location: /login');
            exit();
        }
        require_once (__DIR__ . "/../../views/register.php");
    }
}