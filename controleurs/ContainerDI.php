<?php
require __DIR__ . '/Moteur.php';
require __DIR__ . '/send.php';
require __DIR__ . '/../FichierBDD/Connection.php';

class ContainerDI{
    private Array $classStore;

    public function __construct(){
        $this->classStore = [];
    }

    public function get($className, $param=NULL){
        if (isset($this->classStore[$className])){
            return $this->classStore[$className];
        } else {
            if (!class_exists($className)) return;
            $this->classStore[$className] = new $className($this,$param);
            return $this->classStore[$className];
        }
    }
}