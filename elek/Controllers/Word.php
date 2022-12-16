<?php

namespace Controllers;
class Word{
    public function index(){
    }
    public function itemUpdate( int $text_id, string $field, string $value ){
        $MetinModel= new \Models\MetinModel();
        return $MetinModel->itemUpdate($text_id,$field,$value);
    }
    
    public function itemDelete( int $text_id ){
        $MetinModel= new \Models\MetinModel();
        return $MetinModel->itemDelete($text_id);
    }

    public function itemMetaGet( string $word ){
        $WordModel= new \Models\WordModel();
        return $WordModel->itemMetaGet($word);
    }
    
    public function listGet( string $query=null ){
        $WordModel= new \Models\WordModel();
        return $WordModel->listGet(...func_get_args());
    }
    
    public function listView( int $text_id=null, int $sentence_id=null, string $query='' ){
        $WordModel= new \Models\WordModel();
        $data=[
            'text_id'=>$text_id,
            'sozler'=>$WordModel->listGet($text_id,$sentence_id, $query)??[]
            ];
        
        view('word',$data);
    }
}