<?php
namespace Models;

//include 'Db.php';
class SentenceModel{
    
    function __construct(){
        $this->db=new Db();
    }
    
    public function listGet( $text_id, $query=null ){
        $like=$this->db->escape_string(trim($query));
        $sql="
            SELECT
                sl.*,GROUP_CONCAT(word_data) known_words
            FROM
                sentence_list sl
                    LEFT JOIN
                sentence_member_list sml USING(sentence_id)
                    LEFT JOIN
                word_list wl ON sml.word_id=wl.word_id AND lugat_wordform_id IS NOT NULL
            WHERE
                text_id='$text_id'
                AND sentence_data LIKE '%$like%'
            GROUP BY
                sl.sentence_id
            ";
        $sentences= $this->db->query($sql)->rows();
        return $sentences;
    }

    public function listMetaGet($text_id, $query){
        $sentences=$this->listGet( $text_id, $query );
        foreach($sentences as $sent){
            $sent->meta=$this->itemMetaGet($sent->sentence_id);
            $sent->global_word_count=$this->global_word_count;
        }
        return $sentences;
    }

    private $global_word_count=null;
    public function itemMetaGet( $sentence_id ){
        if($this->global_word_count==null){
            $WordModel=new \Models\WordModel();
            $this->global_word_count=$WordModel->listCountGet();
        }
        $sql="
            SELECT
                *,
                ROUND(word_rank/{$this->global_word_count},2) global_rank,
                {$this->global_word_count} global_word_count
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