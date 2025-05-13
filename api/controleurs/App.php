<?php

class App{
    public $test;
    public $apiResult;
    public $conn;
    public function __construct(ContainerDI $c){
        $this->test = $c->get('test');
        $this->apiResult = $c->get('ApiResult');
        $this->conn = $c->get('Conn');
    }
}