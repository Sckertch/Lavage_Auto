<?php
class Produit{

    public function __construct(ContainerDI $c){
        $this->c = $c;
    }

    // Fonction pour récupérer tous les lycées avec la class conn
    public function getProduit()
    {
        $a = $this->c->get("Connection")->jsonRequest("SELECT * FROM Produit",true);
        //ss($a);
        $this->c->get('App')->apiResult->send($a,true);
    }

}
