<?php

namespace Controllers;
class Panel{
    public function index(){
        return "WORKING";
    }
    
    
    public function table( int $offset, int $limit=30 ){
        echo "int $offset, int $limit=30";
        
        $PanelModel= new \Models\PanelModel($offset,$limit);
        
        $data=[
            'metinler'=>$PanelModel->textStatsListGet()
            ];
        
        view('dashboard',$data);
    }
}