<?php

session_name('TD2');
session_start();

require_once 'bandeau.inc';

function entete($title) {
    $entete = "<head><title>$title</title>";
    if (isset($_SESSION['pref'])) {
        $entete .= "<link rel='stylesheet' href=./'$_SESSION[pref].css'";
    }
    $entete .= '<link href="nav.css"/>';
    $entete .= '</head><body>';
    $bandeau = new Bandeau();
    $entete .= $bandeau->genereBarNav();
    echo $entete;
}


