<?php


class Message extends Db

    // Info de la classe
{
    private $id;
    private $titre;
    private $contenu;
    private $id_user;

    public function __construct($titre, $contenu, $id_user, $id = null)
    {

        $this->setTitre($titre);
        $this->setContenu($contenu);
        $this->id_user = $id_user;
        $this->id = $id;
    }

    // Getter et setters

    public function getId()
    {
        return $this->id;
    }

    public function getTitre()
    {
        return $this->titre;
    }

    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    public function getContenu()
    {
        return $this->contenu;
    }

    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    }

    public function getId_User()
    {
        return $this->id_user;
    }
    public function setId_User($id_user)
    {
        $this->id_user = htmlspecialchars($id_user);
    }


    // Fonctions de la classe
    public static function request($request)
    {
        $db = self::getInstance();
        return $db->query($request);
    }

    public static function getMessages()
    {
        return self::request("SELECT messages.*, utilisateurs.pseudo FROM messages JOIN utilisateurs ON messages.user_id = utilisateurs.id")->fetchALL(PDO::FETCH_ASSOC);
    }

    public static function getMessageById($id)
    {
        return self::request("SELECT * FROM messages WHERE id=$id")->fetch(PDO::FETCH_ASSOC);
    }

    public static function getMessageByUser($id_user)
    {
        return self::request("SELECT * FROM messages WHERE id_user='$id_user")->fetch(PDO::FETCH_ASSOC);
    }

    public static function InsertMessageInto(Message $message)
    {
        return self::request("INSERT INTO messages (titre, contenu, user_id) VALUES('" . $message->getTitre() . "', '" . $message->getContenu() . "', '" . $message->getId_User() . "')");
    }

    public static function deleteMessage($id)
    {
        return self::request("DELETE FROM messages WHERE id=$id");
    }

    public static function editMessage(Message $message) {
        return self::request("UPDATE messages SET titre='" . $message->getTitre() . "', contenu='" . $message->getContenu() . "' WHERE id=" . $message->getId());
    }
}