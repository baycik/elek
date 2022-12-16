<?php
namespace Models;

//include 'Db.php';
class WordModel{
    
    function __construct(){
        $this->db=new Db();
    }

    public function itemMetaGet(string $word){
        $global_word_count=$this->listCountGet();
        $sql="
            SELECT
                *,
                ROUND(word_rank/{$global_word_count},2) global_rank,
                {$global_word_count} global_word_count
            FROM
                word_list
            WHERE
                word_data=LOWER('$word')
        ";
        $meta=$this->db->query($sql)->row();

        if(!$meta){
            return $meta;
        }
        $sql="
            SELECT
                sentence_id,
                sentence_data
            FROM
                sentence_list
                    JOIN
                sentence_member_list USING(sentence_id)
            WHERE
                word_id={$meta->word_id}
            GROUP BY sentence_id
            LIMIT 3
        ";
        $meta->sentence_list=$this->db->query($sql)->rows();
        return $meta;
    }

    
    public function listGet( string $query=null ){
        $sql="
            SELECT
                word_list.*,
                lugat_wordform_id IS NOT NULL is_known
            FROM
                word_list
            WHERE
                word_data LIKE '%$query%'
            ORDER BY lugat_wordform_id IS NOT NULL
            ";
        return $this->db->query($sql)->rows();
    }

    public function listCountGet(){
        $result=$this->db->query("SELECT COUNT(*) total_count FROM word_list")->row();
        return $result->total_count;
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