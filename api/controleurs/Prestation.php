<?php

class Prestation{

    public function __construct(ContainerDI $c){
        $this->c = $c;
    }

    // Fonction pour récupérer toutes les prestations avec la class conn
    public function getPrestation()
    {
        $a = $this->c->get("Connection")->jsonRequest("SELECT * FROM Prestation", true);
        $this->c->get('App')->apiResult->send($a, true);
    }
}
