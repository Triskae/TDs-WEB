<?php
require_once 'entete.inc';
entete("ConnexionCreation")
?>

<?php
    if ($_SESSION['connecte'] === TRUE) {
        ?>


<form method="POST" action="index.php">
    <input type="submit" value="Déconnexion" name="deconnexion"/>
</form>

<?php
    } else {
        ?>
<form method="POST" action="index.php">
    <label for="nom">Nom</label>
    <input type="text" id="nom" name="nom"/>

    <br/>

    <label for="prenom">Prénom</label>
    <input type="text" id="prenom" name="prenom"/>

    <br/>

    <label for="motdepasse">Mot de passe</label>
    <input type="password" id="password" name="password"/>

    <br/>

    <input type="submit" value="Connexion"/>
</form>
<?php
    }

    if (isset($_POST["prenom"], $_POST["nom"], $_POST["password"])) {
        $users = file_get_contents('users.csv');
        $newUser = $_POST["prenom"] . ";" . $_POST["nom"] . ";" . $_POST["password"];
        if (strpos($users, $newUser) !== FALSE) {
            $_SESSION['connecte'] = TRUE;
        }
    } else if (isset($_POST['deconnexion'])) {
        session_destroy();
    }
?>
