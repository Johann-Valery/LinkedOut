<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Linked Out</h1>
    <!-- Si utilisateur connecté, affiche bouton "Se déconnecter", si non connecté affiche bouton "Se connecter" qui mène au login -->
    <form method="post">
    <?php if(isset($_SESSION["user"])): ?>
        <button type="submit" name="disconnect">Se déconnecter</button>
    <?php else: ?>
        <button type="submit" name="login">Se connecter</button>
        <button type="submit" name="createaccount">Créer un compte</button>
    <?php endif; ?>
    </form>
    <?php
        foreach($messages as $message){
            if(isset($_POST["edit"]) && $_POST["edit"] == $message["id"]){
                echo '<form method="post">
                    <input type="text" name="title" placeholder="Title" value="'. $message["titre"] .'"/>
                    <input type="text" name="content" placeholder="Content" value="'. $message["contenu"] .'"/>
                    <button type="submit" name="confirm" value="' . $message["id"] . '">Confirmer</button></form>';
            } else {
                echo "<h2>" . $message["titre"] . "</h2>";
                echo "<p>" . $message["contenu"] . "</p>";
                echo '<p> Posté par "' .$message['pseudo'] . '"</p>';
                if(isset($_SESSION["user"]) && $message["user_id"] === $_SESSION["user"]){
                    echo '<form method="post">
                    <button type="submit" name="edit" value="'. $message["id"] .'">Modifier</button>
                    <button type="submit" name="delete" value="'. $message["id"] .'">Supprimer</button>
                    </form>';
                }
            }
            echo "<hr>";
        }
    ?>
    <h2>
        Postez votre message ici.
    </h2>
    <?php if(isset($_SESSION["user"])): ?>
    <form method="post">
        <input type="text" name="title" placeholder="Title"/>
        <input type="text" name="content" placeholder="Content"/>
        <button type="submit" name="create">Créer post</button>
    </form>
<?php else: ?>
    <p>Vous devez être connecté pour pouvoir poster.</p>
<?php endif; ?>
</body>
</html>