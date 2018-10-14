<?php
$date = strtotime("01 october 2012");

if (isset($_GET["date"]))
{
    $date = strtotime($_GET["date"]);
}

$dateString = date("d F Y", $date);
$months = array("January", "Febuary", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
$mois = array("janvier", "fÃ©vrier", "mars", "avril", "mai", "juin", "juillet", "aoÃ»t", "septembre", "octobre", "novembre", "dÃ©cembre");
$dateString = str_replace($months, $mois, $dateString);


$diff = strtotime("now")-$date;
$resteJ = $diff / (60*60*24) ;


if ($resteJ < 0) {
    $resteJ = (int) floor(-$resteJ );
    $resteS = -$diff - $resteJ*(60*60*24);
    $tempsRestant = "<p>Il reste ".$resteJ." jours et ".$resteS." secondes avant le $dateString</p>";
}
else
{
    $resteJ = (int) floor($resteJ );
    $resteS = $diff - $resteJ*(60*60*24);
    $tempsRestant = "<p>Il s'est passÃ© ".($resteJ)." jours et ".($resteS)." secondes depuis le $dateString</p>";
}

$now = "<p>nous sommes le ".date("d/m/Y").", il est ".date("h:i:s")."</p>";
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>date...</title>

    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />

</head>
<body>

<?php
echo $now;
echo $tempsRestant;

?>

<form method="get">
    <fieldset>
        <legend>simple champ de texte</legend>
        Entrez une date du style Â« 24-12-1975 Â» ou Â« 1975-12-24 Â» ou Â« 24 december 1975 Â» : <br />
        <input type="text" name="date" />
    </fieldset>
</form>

<form method="get">
    <fieldset>
        <legend>simple avec input type date</legend>
        <input type="date" name="date" />
        <input type="submit"  />
    </fieldset>
</form>

</body>
</html>
