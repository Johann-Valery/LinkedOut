<?php

class LoginController extends Controller
{
    public function index()
    {
        if (isset ($_POST["login"])) {
            $user = User::getUserByPseudo(htmlspecialchars($_POST["pseudo"]));
            if (!$user) {
                throw new Exception("Aucun utilisateur trouvé avec ce pseudo");
            } 
            else {
                if ($user["password"] === $_POST["password"]) {
                    $_SESSION["user"] = $user["id"];
                    $this->redirect("/");
                } else{
                    throw new Exception("Mauvais mot de passe");
                }
            }
        }
        require_once (__DIR__ . "/../../views/login.php");
    }
}