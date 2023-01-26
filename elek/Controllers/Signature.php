<?php

namespace Controllers;
class Signature{
    public function index(){
    }
    public function itemCreate( int $word_id ){
        $user=user('ElekEditor');
        if(!$user){
            return false;
        }
        $SignatureModel= new \Models\SignatureModel();
        return $SignatureModel->itemCreate($word_id);
    }

    public function itemDelete( int $word_id ){
        $user=user('ElekEditor');
        if(!$user){
            return false;
        }
        $SignatureModel= new \Models\SignatureModel();
        return $SignatureModel->itemDelete($word_id);
    }
}