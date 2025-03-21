<?php

class Moteur{
    public ContainerDI $c;
    public function __construct(ContainerDI $c){
        $this->c = $c;
    }
}