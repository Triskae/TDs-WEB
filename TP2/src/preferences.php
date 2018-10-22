<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8"/>

    <?php
    require_once 'entete.inc';
    entete('preferences');
    session_start();
    // Insertion de la balise link
    if (isset($_POST['style'])) {
        if ($_POST['style'] == 'Vert et Jaune') {
            $_SESSION['style'] = "<link rel='stylesheet' href='vert et jaune.css' type='text/css' />";
            $_SESSION["select1"] = "selected";
            $_SESSION["select2"] = "";
            $_SESSION["select3"] = "";
        } elseif ($_POST['style'] == 'Bleu') {
            $_SESSION['style'] = "<link rel='stylesheet' href='blue.css' type='text/css' />";
            $_SESSION["select1"] = "";
            $_SESSION["select2"] = "selected";
            $_SESSION["select3"] = "";
        } else {
            $_SESSION['style'] = "<link rel='stylesheet' href='italic.css' type='text/css' />";
            $_SESSION["select1"] = "";
            $_SESSION["select2"] = "";
            $_SESSION["select3"] = "selected";
        }
    }
    echo $_SESSION['style'];
    ?>

    <title>TP2 - Web</title>
</head>

<body>

<form name="saisiePreference" method="post" action="preferences.php">
    Choississez votre feuille de style : <br/>
    <select name="style" size="3">
        <option <?php echo $_SESSION["select1"] ?>>Vert et Jaune
        <option <?php echo $_SESSION["select2"] ?>>Bleu
        <option <?php echo $_SESSION["select3"] ?>>Italique
    </select>
    <input type="submit" name="valider" value="Valider"/><br/>
</form>

</body>

</html>
