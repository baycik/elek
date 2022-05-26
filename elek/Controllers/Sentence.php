<?php

namespace Controllers;
class Sentence{
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
    
    public function listView( int $text_id, string $query='' ){
        $SentenceModel= new \Models\SentenceModel();
        $data=[
            'text_id'=>$text_id,
            'cumleler'=>$SentenceModel->listGet($text_id, $query)??[]
            ];
        
        view('cumleler',$data);
    }
}