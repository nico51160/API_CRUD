<?php
class Tuto {
    private $tutoID;
    private $titre;
    private $description;
    private $url;

    public function getTutoID() {
        return $this->tutoID;
    }

    public function getTitre() {
        return $this->titre;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getUrl() {
        return $this->url;
    }

    public function setTutoID($tutoID) {
        $tutoID = intval($tutoID);
        if(is_int($tutoID)) {
            $this->tutoID = $tutoID;
        }
    }

    public function setTitre($titre) {
        if(is_string($titre)) {
            $this->titre = $titre;
        }
    }

    public function setDescription($description) {
        if(is_string($description)) {
            $this->description = $description;
        }
    }

    public function setUrl($url) {
        if(is_string($url)) {
            $this->url = $url;
        }
    }

}