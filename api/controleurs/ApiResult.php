<?php

class ApiResult{

    public $result;
    
    public function __construct(ContainerDI $c){
    }

    public function send($content, bool $status){
        $this->result = new stdClass;
        //sd($content);
        $this->result->status = $status;
        $this->result->content = $content;
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($this->result);

    }

}