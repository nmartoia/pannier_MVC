<?php
namespace Panier\Models;

/** Class Panier **/
class Staigiar{

    private $NOM_FORMATEUR;
    private $DATE_DEBUT;
    private $DATE_FIN;
    private $salle;

    public function getNomForm() {
        return $this->NOM_FORMATEUR;
    }

    public function getDateDeb() {
        $date = date_create($this->DATE_DEBUT);
        return date_format($date, 'd/m/Y');
        //donne la date française si on veux la date americain suprimer le code si dessus et remplacer le par return $this->$date;
    }
    public function getDateFin() {
        $date = date_create($this->DATE_FIN);
        return date_format($date, 'd/m/Y');
        //donne la date française si on veux la date americain suprimer le code si dessus et remplacer le par return $this->$date;
    }
    public function getSalle() {
        return $this->salle;
    }

    public function setNomForm(String $NOM_FORMATEUR) {
        $this->NOM_FORMATEUR = $NOM_FORMATEUR;
    }
    public function setDateDeb(String $DATE_DEBUT) {
        $this->DATE_DEBUT = $DATE_DEBUT;
    }
    public function setDateFin(String $DATE_FIN) {
        $this->DATE_FIN = $DATE_FIN;
    }
    public function setSalle(String $salle) {
        $this->salle = $salle;
    }
}
