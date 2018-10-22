<?php
/**
 * Created by IntelliJ IDEA.
 * User: filipe
 * Date: 22/10/2018
 * Time: 14:23
 */


require_once 'entete.inc';
entete("creaiton");


if (isset($_POST["prenom"], $_POST["nom"], $_POST["password"])) {
    $users = file_get_contents('users.csv');
    $newUser = $_POST["prenom"] . ";" . $_POST["nom"] . ";" . $_POST["password"];
    if (strpos($users, $newUser) === FALSE) {
        $users .= $newUser;
        echo "Compte utilisateur ajouté <br><br><br>";
    } else {
        echo "Compte utilisateur déjà existant <br><br><br>";
    }
    file_put_contents('users.csv', $users);
}
?>

<body>
<form method="POST" action="creation.php">
    <label for="nom">Nom</label>
    <input type="text" id="nom" name="nom"/>

    <br/>

    <label for="prenom">Prénom</label>
    <input type="text" id="prenom" name="prenom"/>

    <br/>

    <label for="motdepasse">Mot de passe</label>
    <input type="password" id="motdepasse" name="password"/>

    <br/>

    <input type="submit" value="Création"/>
</form>
</body>
</html>
