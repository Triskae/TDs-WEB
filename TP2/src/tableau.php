<?php
/**
 * Created by IntelliJ IDEA.
 * User: filipe
 * Date: 08/10/2018
 * Time: 13:43
 */


$tab =  array (
    array("date.php", "23-09-2016", "1856"),
    array("tableau.php", "223-09-2016", "1875")
);

$titre = array ("Nom du fichier", "Date de modification","Taille");


echo "<pre>";
echo print_r($tab);
echo "</pre>";

echo "<br>";

echo "<pre>";
echo var_dump($tab);
echo "</pre>";


echo genereTableau($titre, $tab);

function genereTableau ($title, $body) {
    $HTMLstring = "<table border='1px solid black'><tr>";
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

$local = glob("*");
foreach ($local as $file) {
    if (is_file($file)) {
        $filesize = filesize($file);
    } else $filesize = "dir";
    $filedate = filemtime($file);
    $date = date("d F Y", $filedate);
    echo "$file date de $date et pese $filesize";
    echo "<br>";
}
