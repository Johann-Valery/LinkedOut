<?php

class MainController extends Controller
{
    public function index()
    {
        if (isset ($_POST["disconnect"])) {
            session_destroy();
            $this->redirect("/login");
        } elseif (isset ($_POST["login"])) {
            $this->redirect("/login");
        } elseif (isset ($_POST["createaccount"])) {
            $this->redirect("/register");
        } elseif (isset ($_POST["delete"])) {
            Message::deleteMessage($_POST["delete"]);
        } elseif (isset ($_POST["create"])) {
            $message = new Message($_POST["title"], $_POST["content"], $_SESSION["user"]);
            Message::InsertMessageInto($message);
        } elseif (isset ($_POST["confirm"])) {
            $message = new Message($_POST["title"], $_POST["content"], $_SESSION["user"], $_POST["confirm"]);
            Message::editMessage($message);
        }

        $messages = Message::getMessages();

        require_once (__DIR__ . "/../../views/main.php");
    }
}