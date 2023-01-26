<?php
namespace Models;
include 'Db.php';
class ElekModel {
    private $pageLength=10000;
    private $fileOffset=0;
    private $path=null;
    private $text_id;
    private $sentence_id;
    private $word_id;
    private $db;
    
    function __construct() {
        $this->db=new Db();
    }
    
    public function setFile( $path ){
        $this->path=$path;
        $row=$this->db->query("SELECT * FROM elek_text_list WHERE text_file_path='".$this->db->escape_string($this->path)."'")->row();
        if($row){
            $this->text_id=$row->text_id;
        } else {
            $this->db->query("INSERT elek_text_list SET text_file_path='".$this->db->escape_string($this->path)."',created_at=NOW()");
            $this->text_id=$this->db->insert_id;
        }
        return $this;
    }
    
    public function read(){
        if( file_exists($this->path.".offset") ){
            $this->fileOffset=file_get_contents($this->path.".offset");
        } else {
            $this->fileOffset=0;
        }
        if ($source_file = fopen($this->path, "r")) {
            while(!feof($source_file)) {
                fseek($source_file, $this->fileOffset);
                $buffer = fread($source_file, $this->pageLength);
                $lastSentecnceFinish=max(strrpos($buffer, '.'),strrpos($buffer, '?'),strrpos($buffer, '!'));
                if($lastSentecnceFinish){//cut out last incomlplete sentence
                    $pageFinish=$lastSentecnceFinish+1;
                } else {
                    $lastWordFinish=strrpos($buffer, ' ');
                    $pageFinish=$lastWordFinish?$lastWordFinish+1:$this->pageLength;
                }
                $this->fileOffset+=$pageFinish;
                $page= substr($buffer, 0, $pageFinish);
                file_put_contents($this->path.".offset", $this->fileOffset);
                if(!strlen($page)){
                    continue;
                }
                $this->textPageSave($page);
            }
            fclose($source_file);
            $this->textStatsCalc($this->text_id);
            $this->wordMetaCalc();
        }
    }
    
    private function textPageSave($page){
        $this->db->begin_transaction();
        $this->db->query("UPDATE elek_text_list SET text_data=CONCAT(COALESCE(text_data,''),'".$this->db->escape_string($page)."') WHERE text_id='$this->text_id'");
        $this->split_to_sentences($page);
        $this->db->commit();
    }

    public function split_to_sentences( $page ){
        $page=str_replace('  ', ' ', $page);
        $page=str_replace(["\r","\n"], '', $page);
        $sentences = preg_split('/(?<=[.?!](\s|"|”|»|’))\s?(?=[\p{Lu}\b"“«‘])|(?<=[.?!])(?=[\p{Lu}])/u', $page, 0);
        if(!$sentences){
            return false;
        }
        foreach($sentences as $sentence){
            if(!strlen($sentence)){
                continue;
            }
            $filtered_sentence=preg_replace('/^[^\w]+|[^(\w.?!)]+$/u', '',$sentence,-1);
            $this->db->query("INSERT elek_sentence_list SET text_id='$this->text_id', sentence_data='".$this->db->escape_string($filtered_sentence)."'");
            $this->sentence_id=$this->db->insert_id;
            $this->split_to_words( $sentence );
        }
        return true;
    }
    
    public function split_to_words( $sentence ){
        $words = preg_split('/[^[:alpha:]’]+/iu', $sentence, 0);
        foreach ($words as $word){
            if( !$word ){
                continue;
            }
            $word_joined=preg_replace('/\W/u','',$word,-1);
            $row=$this->db->query("SELECT * FROM elek_word_list WHERE word_data=LOWER('$word_joined')")->row();
            if($row){
                $this->word_id=$row->word_id;
            } else {
                $this->db->query("INSERT IGNORE elek_word_list SET word_data=LOWER('$word_joined')");
                $this->word_id=$this->db->insert_id;
            }
            echo $this->db->error;
            $this->db->query("INSERT IGNORE elek_sentence_member_list SET sentence_id='$this->sentence_id', word_id='$this->word_id'");
        }
    }
    
    public function textStatsCalc( $text_id ){
        $sql="
            UPDATE
                elek_text_list
            SET
                text_letter_count=CHAR_LENGTH(text_data),
                text_sentence_count=(SELECT COUNT(*) FROM elek_sentence_list WHERE text_id=text_id),
                text_word_total_count=(SELECT COUNT(*) FROM elek_sentence_member_list WHERE sentence_id=sentence_id),
                text_word_unique_count=(SELECT COUNT(DISTINCT word_id) FROM elek_sentence_member_list WHERE sentence_id=sentence_id) 
            WHERE
                text_id='$text_id'
            ";
        return $this->db->query($sql);
    }

    public function wordMetaCalc(){
        $drop_sql="DROP TEMPORARY TABLE IF EXISTS tmp_count;";
        $create_sql="CREATE TEMPORARY TABLE tmp_count AS
            (SELECT
                word_id,word_count,ROW_NUMBER() OVER (ORDER BY `word_count` DESC) word_rank
            FROM
            (SELECT 
                wl.word_id,COUNT(*) word_count
            FROM
                elek_word_list wl
                    JOIN
                elek_sentence_member_list USING (word_id)
            GROUP BY word_id)ttt);";
        $update_rank_sql="UPDATE
            elek_word_list wl
                JOIN
            tmp_count tc USING (word_id) 
        SET 
            wl.word_count = tc.word_count,
            wl.word_rank = tc.word_rank";
        $link_sql="UPDATE
                elek_word_list
                    JOIN
                lgt_wordform_list lwl ON wordform=word_data
            SET
                lugat_word_id=lwl.word_id,lugat_wordform_id=lwl.wordform_id
            WHERE lugat_word_id IS NULL";
        $this->db->query($drop_sql);
        $this->db->query($create_sql);
        $this->db->query($update_rank_sql);
        $this->db->query($link_sql);
    }

}