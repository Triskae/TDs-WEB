<?php
/**
 * Created by IntelliJ IDEA.
 * User: filipe
 * Date: 05/11/2018
 * Time: 13:55
 */


?>

    <!DOCTYPE html>
    <head>
        <link rel="stylesheet" type="text/css" href="mystyle.css">
    </head>
    <html>
    <body>

    <form action="index.php" method="post">
        <label for="ville">First name:</label>
        <br>
        <input type="text" name="ville" id="ville" placeholder="Entrez une ville">
        <br>
        <br>
        <input type="submit" value="Submit">
    </form>

    </body>
    </html>

<?php

//Function made with help of stackoverflow
function find_closest($now) {
    $dates = ["01:00:00", "04:00:00", "07:00:00", "10:00:00", "13:00:00", "16:00:00", "19:00:00", "22:00:00"];
    foreach($dates as $day) {
        $interval[] = abs(strtotime($now) - strtotime($day));
    }
    asort($interval);
    $closest = key($interval);
    return $dates[$closest];
}



$research = str_replace(" ", "%20", $_POST["ville"]);
$url = "http://nominatim.openstreetmap.org/search?q=" . $research . "&format=json";

$opts = array('http' => array('header' => "User-Agent: StevesCleverAddressScript 3.7.6\r\n"));
$context = stream_context_create($opts);

$jsonraw = file_get_contents($url, false, $context);
//echo $jsonraw;
$json = json_decode($jsonraw, true);


foreach ($json as $place) {

    $latitude1 = $place["boundingbox"][0];
    $latitude2 = $place["boundingbox"][1];
    $longitude1 = $place["boundingbox"][2];
    $longitude2 = $place["boundingbox"][3];


    $url_weather = "http://www.infoclimat.fr/public-api/gfs/json?_ll=" . $latitude1 . "," . $longitude1 . "," . $latitude2 . "," . $longitude2 . "&_auth=AhhTRFQqBCZRfAcwD3kGL1Y%2BATRaLAIlC3dVNg5gUSwDZ1YyBGRcP1I%2BAH1Vegc0BShUNg43U20HZAtkWCoEeAJjUz5UPgRmUToHYQ8%2FBi1WegF8WmQCJQt3VToOYFEsA2FWMwRkXCBSPwBnVWEHLQU%2FVDQOLlN0B2ULaFg9BGcCaVMwV%20DIEZlE%2BB2UPIAYtVmABaVphAj4LbVVgDjVROgNpVjoEM1xsUjkAYVV7BzQFMVQzDjlTaQdjC25YNgR4An5TTlREBHtRfgcnD2oGdFZ4ATRaOwJu&_c=a4c69e2851123ac57a2cabb4a6ad2608";
    $datas_weather = @file_get_contents($url_weather, false, $context);
    $json_weather = json_decode($datas_weather, true);

    $closest_date = find_closest(date("Y-m-d H:i:s"));
    $objectWeather = $json_weather[date("Y-m-d") . " " .$closest_date];


    echo '<div class="mapAndWeither"><iframe style="border: none;box-shadow: 1px 1px 3px black;float: left; margin: 0 2em 2em 0;width:30%; height:480px;" src="' . "http://www.openstreetmap.org/export/embed.html?bbox=" . $longitude1 . "%2C" . $latitude1 . "%2C" . $longitude2 . "%2C " . $latitude2 . "&amp;layer=mapnik" . '"></iframe>';
    if ($objectWeather["pluie"] == NULL) {
        echo "<li><b>Précipitations sur 3h :</b> aucune donnée n'a été trouvée</li>";
    } else {
        echo "<li><b>Précipitations sur 3h :</b> " . $objectWeather["pluie"] . "mm</li>";
    }
    if ($objectWeather["temperature"]["2m"] == NULL) {
        echo "<li><b>Température :</b> aucune donnée n'a été trouvée</li>";
    } else {
        echo "<li><b>Température :</b> " . round($objectWeather["temperature"]["2m"] - 273.15) . "°C</li>";
    }
    if ($objectWeather["pression"]["niveau_de_la_mer"] == NULL) {
        echo "<li><b>Pression au niveau de la mer :</b> aucune donnée n'a été trouvée</li>";
    } else {
        echo "<li><b>Pression au niveau de la mer :</b> " . $objectWeather["pression"]["niveau_de_la_mer"] / 100 . "hPa</li>";
    }
    if ($objectWeather["humidite"]["2m"] == NULL) {
        echo "<li><b>Humidité :</b> aucune donnée n'a été trouvée</li>";
    } else {
        echo "<li><b>Humidité :</b> " . $objectWeather["humidite"]["2m"] . "%</li>";
    }
    if ($objectWeather["vent_moyen"]["10m"] == NULL) {
        echo "<li><b>Vent :</b> aucune donnée n'a été trouvée</li>";
    } else {
        echo "<li><b>Vent :</b> " . $objectWeather["vent_moyen"]["10m"] . "km/h</li>";
    }
    if ($objectWeather["vent_rafales"]["10m"] == NULL) {
        echo "<li><b>Rafales :</b> aucune donnée n'a été trouvée</li>";
    } else {
        echo "<li><b>Rafales :</b> " . $objectWeather["vent_rafales"]["10m"] . "km/h</li>";
    }
    echo "</div>";
}


