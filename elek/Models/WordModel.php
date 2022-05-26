<?php
namespace Models;

//include 'Db.php';
class WordModel{
    
    function __construct(){
        $this->db=new Db();
    }
    
    public function listGet( $text_id, $sentence_id, $query='' ){
        $like=$this->db->escape_string($query);
        $where="";
        if($text_id){
            $where.="AND `text_id`='$text_id'";
        }
        if($sentence_id){
            $where.="AND `sentence_id`='$sentence_id'";
        }
        $sql="
            SELECT
                word_list.*,
                COUNT(*) repeated
            FROM
                word_list
                    JOIN
                sentence_member_list USING(word_id)
                    JOIN
                sentence_list USING(sentence_id)
            WHERE
                word_data LIKE '%$like%'
                $where
            GROUP BY word_id
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