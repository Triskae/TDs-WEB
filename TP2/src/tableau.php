<?php
/**
 * Created by IntelliJ IDEA.
 * User: filipe
 * Date: 08/10/2018
 * Time: 13:43
 */


require_once 'entete.inc';
entete("Tableau");



$tab = array(
    array("date.php", "23-09-2016", "1856"),
    array("tableau.php", "223-09-2016", "1875")
);

$titre = array("Nom du fichier", "Date de modification", "Taille");


echo "<pre>";
echo print_r($tab);
echo "</pre>";

echo "<br>";

echo "<pre>";
echo var_dump($tab);
echo "</pre>";


echo genereTableau($titre, $tab);

session_start();
echo $_SESSION['style'];

function genereTableau($title, $body)
{
    $HTMLstring = "<table border=\"1\" solid black><caption>Tableau des fichiers V2</caption>";
    if ($title != null && $body != null) {
        foreach ($title as $element) {
            $HTMLstring .= "<th>";
            $HTMLstring .= $element;
            $HTMLstring .= "</th>";
        }

        foreach ($body as $line) {
            $HTMLstring = $HTMLstring . "<tr>";
            foreach ($line as $element) {
                //Verification si il y autant d'élément dans la ligne du body qu'il y a d'élément dans title.
                if (count($line) == count($title)) {
                    $HTMLstring .= "<td>";
                    $HTMLstring .= $element;
                    $HTMLstring .= "</td>";
                } else $HTMLstring .= "";

            }
            $HTMLstring = $HTMLstring . "</tr>";
        }
    }
    $HTMLstring .= "</tr></table><hr>";
    return $HTMLstring;
}

function genereTableauv2($title, $body)
{
    if (isset($_GET['tri'])) {
        if ($_GET['tri'] == 'reverse') {
            rsort($body, SORT_REGULAR);
        } elseif ($_GET['tri'] == 'normal') {
            sort($body, SORT_REGULAR);
        }
    }
    $HTMLstring = '<table border="1" solid black><caption>Tableau des fichiers V2</caption>';
    $HTMLstring .= '<tr>';

    foreach ($title as $key => $colonne) {
        $HTMLstring .= '<th>';
        $HTMLstring .= $colonne;
        $HTMLstring .= '</th>';
    }
    $HTMLstring .= '</tr>';
    $HTMLstring .= '<tr>';

    foreach ($body as $line) {
        $HTMLstring .= '<tr>';
        if (count($line) == count($title)) {
            $HTMLstring .= '<td>';
            $HTMLstring .= "<a href='$line[0]'> $line[0]</a>";
            $HTMLstring .= '</td>';
        } else $HTMLstring .= '';
        for ($i = 1; $i < count($line); $i++) {
            if (count($line) == count($title)) {
                $HTMLstring .= '<td>';
                $HTMLstring .= $line[$i];
                $HTMLstring .= '</td>';
            } else $HTMLstring .= '';
        }
        $HTMLstring .= '</tr>';
    }
    $HTMLstring .= '</table>';
    return $HTMLstring;
}

$local = glob("*");
$newArray = array();

foreach ($local as $filename) {
    if (is_file($filename)) {
        $filesize = filesize($filename);
    } else $filesize = 'dir';
    $filedate = filemtime($filename);
    $date = date('d-m-Y', $filedate);
    array_push($newArray, (array($filename, $date, $filesize)));
}

echo genereTableauv2($titre, $newArray);
echo "<br>";
echo "<br>";
echo"<a href='http://localhost:8888/TP2/src/tableau.php?tri=normal'>Ordre Croissant</a>";
echo "<br>";
echo"<a href='http://localhost:8888/TP2/src/tableau.php?tri=reverse'>Ordre Décroissant</a>";
echo "<br>";
