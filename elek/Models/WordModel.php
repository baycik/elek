<?php
namespace Models;

//include 'Db.php';
class WordModel{
    private $db;
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
                elek_word_list
            WHERE
                word_data=LOWER('$word')
        ";
        $meta=$this->db->query($sql)->row();

        if(!$meta){
            return null;
        }
        $sql="
            SELECT
                sentence_id,
                sentence_data
            FROM
                elek_sentence_list
                    JOIN
                elek_sentence_member_list USING(sentence_id)
            WHERE
                word_id={$meta->word_id}
            GROUP BY sentence_id
            LIMIT 3
        ";
        $meta->sentence_list=$this->db->query($sql)->rows();

        $SignatureModel=new SignatureModel();
        $meta->signature_list=$SignatureModel->listGet($meta->word_id);
        return $meta;
    }

    
    public function listGet( string $query=null ){
        $sql="
            SELECT
                elek_word_list.*,
                lugat_wordform_id IS NOT NULL is_known
            FROM
                elek_word_list
            WHERE
                word_data LIKE '%$query%'
            ORDER BY 
                lugat_wordform_id IS NOT NULL,
                IF(word_status IS NOT NULL,
                    IF(word_status='new' OR word_status='alternative',1,3),
                    2
                )
            ";
        return $this->db->query($sql)->rows();
    }

    public function listCountGet(){
        $result=$this->db->query("SELECT COUNT(*) total_count FROM elek_word_list")->row();
        return $result->total_count;
    }
    
    public function itemUpdate($word_id,$field,$value){
        $this->db->query("UPDATE `elek_word_list` SET `$field`='$value' WHERE `word_id`='$word_id'");
        return $this->db->affected_rows;
    }
    // public function itemDelete($text_id){
    //     $this->db->query("DELETE FROM elek_text_list WHERE text_id='$text_id'");
    //     $this->db->query("DELETE elek_word_list FROM elek_word_list LEFT JOIN elek_sentence_member_list USING(word_id) WHERE sentence_id IS NULL");
    //     return $this->db->affected_rows;
    // }
}