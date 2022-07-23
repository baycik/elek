<?php

namespace Controllers;
class Metin{
    public function index(){
        $this->table();
    }
    public function itemUpdate( int $text_id, string $field, string $value ){
        $MetinModel= new \Models\MetinModel();
        return $MetinModel->itemUpdate($text_id,$field,$value);
    }
    
    public function itemDelete( int $text_id ){
        $MetinModel= new \Models\MetinModel();
        return $MetinModel->itemDelete($text_id);
    }

    public function listGet(){
        $MetinModel= new \Models\MetinModel();
        return $MetinModel->listGet();
    }

    public function itemGet($text_id){
        $MetinModel= new \Models\MetinModel();
        return $MetinModel->itemGet($text_id);
    }
}