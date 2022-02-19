<?php
namespace Models;

//include 'Db.php';
class MetinModel{
    
    function __construct(){
        $this->db=new Db();
    }
    
    public function textStatsListGet(){
        $sql="
            SELECT
                text_id,
                text_author,
                text_title,
                text_sentence_count,
                text_word_total_count,
                text_word_unique_count,
                text_letter_count,
                created_at
            FROM
                text_list
            ";
        return $this->db->query($sql)->rows();
    }
    
    public function itemUpdate($text_id,$field,$value){
        $this->db->query("UPDATE text_list SET `$field`='$value' WHERE text_id='$text_id'");
    }
}