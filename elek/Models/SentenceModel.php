<?php
namespace Models;

//include 'Db.php';
class SentenceModel{
    
    function __construct(){
        $this->db=new Db();
    }
    
    public function listGet( $text_id, $query ){
        $like=$this->db->escape_string($query);
        $sql="
            SELECT
                *
            FROM
                sentence_list
            WHERE
                text_id='$text_id'
                AND sentence_data LIKE '%$like%'
            ";
        $sentences= $this->db->query($sql)->rows();
        foreach($sentences as $sent){
            $sent->meta=$this->itemMetaGet($sent->sentence_id);
        }
        return $sentences;
    }

    public function itemMetaGet( $sentence_id ){
        $sql="
            SELECT
                *
            FROM
                sentence_member_list
                    JOIN
                word_list USING(word_id)
            WHERE
                sentence_id='$sentence_id'
        ";
        return $this->db->query($sql)->rows();
    }
    
    // public function itemUpdate($text_id,$field,$value){
    //     $this->db->query("UPDATE text_list SET `$field`='$value' WHERE text_id='$text_id'");
    // }
    // public function itemDelete($text_id){
    //     $this->db->query("DELETE FROM text_list WHERE text_id='$text_id'");
    //     $this->db->query("DELETE word_list FROM word_list LEFT JOIN sentence_member_list USING(word_id) WHERE sentence_id IS NULL");
    //     return $this->db->affected_rows;
    // }
}