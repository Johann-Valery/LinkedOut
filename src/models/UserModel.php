<?php
class User extends Db

// Infos de la classe
{
    private $id;
    private $pseudo;
    private $prenom;
    private $nom;
    private $password;
    private $mail;

    public function __construct($pseudo, $prenom, $nom, $password, $mail, $id = null)
    {

        $this->setPseudo($pseudo);
        $this->setPrenom($prenom);
        $this->setNom($nom);
        $this->setPassword($password);
        $this->setMail($mail);
        $this->id = $id;
    }

    // Getter et setter

    public function getId()
    {
        return $this->id;
    }

    public function getPseudo()
    {
        return $this->pseudo;
    }

    public function setPseudo($pseudo)
    {
        if(preg_match("/^[a-zA-Z0-9]*$/", $pseudo)) {
            $this->pseudo = htmlspecialchars($pseudo);
        } else {
            throw new Exception("Pseudo invalide. Caractères Alphanumériques seulement");
        }
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function setPrenom($prenom)
    {
        if(preg_match("/^[a-zA-Z]*$/", $prenom)) {
            $this->prenom = htmlspecialchars($prenom);
        } else {
            throw new Exception("Prénom invalide. Lettres seulement.");
        }
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom)
    {
        if(preg_match("/^[a-zA-Z]*$/", $nom)) {
            $this->nom = htmlspecialchars($nom);
        } else {
            throw new Exception("Nom invalide. Lettres seulement");
        }
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
{
    if(strlen($password) >= 5) {
        $this->password = htmlspecialchars($password);
    } else {
        throw new Exception("Mot de passe invalide. 5 caractères minimum, tout est accepté.");
    }
}

    public function getMail()
    {
        return $this->mail;
    }

    public function setMail($mail)
    {
        if(preg_match("/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/", $mail)) {
            $this->mail = htmlspecialchars($mail);
        } else {
            throw new Exception("Entrez une adresse mail valide.");
        }
    }

    // Fonctions de la classe

    private static function request($request)
    {
        $db = self::getInstance();
        return $db->query($request);
    }

    public static function getUsers()
    {
        return self::request("SELECT * FROM utilisateurs")->fetchALL(PDO::FETCH_ASSOC);
    }

    public static function getUsersById($id)
    {
        return self::request("SELECT * FROM utilisateurs WHERE id=$id")->fetch(PDO::FETCH_ASSOC);
    }

    public static function getUserByPseudo($pseudo)
    {
        return self::request("SELECT * FROM utilisateurs WHERE pseudo='$pseudo'")->fetch(PDO::FETCH_ASSOC);
    }

    public static function InsertInto(User $user)
    {
        return self::request("INSERT INTO utilisateurs (pseudo, prenom, nom, password, mail) VALUES('" . $user->getPseudo() . "', '" . $user->getPrenom() . "', '" . $user->getNom() . "', '" . $user->getPassword() . "', '" . $user->getMail() . "')");
    }

}