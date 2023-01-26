<?php
namespace Models;

class MetinModel{
    private $db;
    function __construct(){
        $this->db=new Db();
    }
    
    public function listGet(){
        $sql="
            SELECT
                text_id,
                text_author,
                text_title,
                DATE_FORMAT(text_date,'%Y-%m-%d') text_date,
                text_sentence_count,
                text_word_total_count,
                text_word_unique_count,
                text_letter_count,
                created_at
            FROM
                elek_text_list
            ";
        return $this->db->query($sql)->rows();
    }

    public function itemGet($text_id){
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
                elek_text_list
            WHERE
                text_id='$text_id'
            ";
        return $this->db->query($sql)->row();
    }
    
    public function itemUpdate( int $text_id, string $field,string $value){
        $this->db->query("UPDATE elek_text_list SET `$field`='$value' WHERE text_id='$text_id'");
        return $this->db->affected_rows>0?'ok':'idle';
    }
    public function itemDelete( int $text_id){
        $this->db->query("DELETE FROM elek_text_list WHERE text_id='$text_id'");
        $this->db->query("DELETE elek_word_list FROM elek_word_list LEFT JOIN elek_sentence_member_list USING(word_id) WHERE sentence_id IS NULL");
        return $this->db->affected_rows;
    }
}