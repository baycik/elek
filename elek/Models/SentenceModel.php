<?php
namespace Models;

//include 'Db.php';
class SentenceModel{
    private $db;
    function __construct(){
        $this->db=new Db();
    }
    
    public function listGet( int $text_id=0, $query=null ){
        $where="";
        if($text_id){
            $where.="AND text_id=$text_id";
        }
        if($query){
            $where.="AND sentence_data like '%".$this->db->escape_string(trim($query))."%'";
        }
        $sql="
            SELECT
                sl.*,GROUP_CONCAT(word_data) known_words
            FROM
                elek_sentence_list sl
                    LEFT JOIN
                elek_sentence_member_list sml USING(sentence_id)
                    LEFT JOIN
                elek_word_list wl ON sml.word_id=wl.word_id AND lugat_wordform_id IS NOT NULL
            WHERE 1=1
                $where
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
                elek_sentence_member_list
                    JOIN
                elek_word_list USING(word_id)
            WHERE
                sentence_id='$sentence_id'
        ";
        return $this->db->query($sql)->rows();
    }
    
    // public function itemUpdate($text_id,$field,$value){
    //     $this->db->query("UPDATE elek_text_list SET `$field`='$value' WHERE text_id='$text_id'");
    // }
    // public function itemDelete($text_id){
    //     $this->db->query("DELETE FROM elek_text_list WHERE text_id='$text_id'");
    //     $this->db->query("DELETE elek_word_list FROM elek_word_list LEFT JOIN elek_sentence_member_list USING(word_id) WHERE sentence_id IS NULL");
    //     return $this->db->affected_rows;
    // }
}