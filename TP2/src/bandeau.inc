<?php

class Bandeau {
    public static $publicAcces = array('Connexion' => 'accessible si deconnecte', 'Déconnexion' => 'accessible si connecte', 'Plan du site' => 'toujours accessible', 'Page des dates' => 'accessible si deconnecte', 'Choix du style' => 'accessible si connecte', 'Création' => 'accessible si deconnecte');
    public static $map = array(array('index.php', 'Connexion'), array('index.php', 'Déconnexion'), array('tableau.php', 'Plan du site'), array('date.php', 'Page des dates'), array('preferences.php', 'Choix du style'), array('creation.php', 'Création'));

    private function genererLien($href, $name){

        if (basename($_SERVER['PHP_SELF']) == $href)
        {
            return "<div class='lien'><a href='$href' style='text-decoration: underline'>$name <=</a></div>";
        }

        return "<div class=\"lien\"><a href=\"$href\">$name</a></div>";
    }

    public function genereBarNav()
    {
        $barreNav = '<div id="barrenavigation">';

        foreach (Bandeau::$map as $element) {
            if (Bandeau::$publicAcces[$element[1]] === 'toujours accessible') {
                $barreNav .= $this->genererLien($element[0], $element[1]);
            } else if (Bandeau::$publicAcces[$element[1]] === 'accessible si deconnecte' && $_SESSION['connecte'] !== TRUE) {
                $barreNav .= $this->genererLien($element[0], $element[1]);
            } else if (Bandeau::$publicAcces[$element[1]] === 'accessible si connecte' && $_SESSION['connecte'] === TRUE) {
                $barreNav .= $this->genererLien($element[0], $element[1]);
            }
        }
        $barreNav .= '<div>Bienvenue ';
        if ($_SESSION['connecte'] === TRUE) {
            $barreNav .= $_SESSION['prenom'] . ' ' . $_SESSION['nom'];
        } else {
            $barreNav .= 'cher visiteur';
        }
        $barreNav .= ', nous sommes le ';
        $barreNav .= date('d/m/Y, G:i:s');;
        $barreNav .= '</div></div>';
        return $barreNav;
    }

}
