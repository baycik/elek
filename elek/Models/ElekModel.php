<?php
namespace Models;
include 'Db.php';
class ElekModel {
    private $pageLength=1000;
    private $fileOffset=0;
    private $path=null;
    
    function __construct() {
        $this->db=new Db();
    }
    
    public function setFile( $path ){
        $this->path=$path;
        $row=$this->db->query("SELECT * FROM text_list WHERE text_file_path='$this->path'")->row();
        if($row){
            $this->text_id=$row->text_id;
        } else {
            $this->db->query("INSERT text_list SET text_file_path='$this->path',created_at=NOW()");
            $this->text_id=$this->db->insert_id;
        }
        return $this;
    }
    
    public function read(){
        if( file_exists($this->path.".offset") ){
            //$this->fileOffset=file_get_contents($this->path.".offset");
        } else {
            $this->fileOffset=0;
        }
        if ($source_file = fopen($this->path, "r")) {
            while(!feof($source_file)) {
                fseek($source_file, $this->fileOffset);
                $buffer = fread($source_file, $this->pageLength);
                $pageFinish=max(strrpos($buffer, '.'),strrpos($buffer, '?'),strrpos($buffer, '!'))+1;
                $this->fileOffset+=$pageFinish;
                file_put_contents($this->path.".offset", $this->fileOffset);
                $page= $this->db->escape_string(substr($buffer, 0, $pageFinish));
                if(!strlen($page)){
                    continue;
                }
                $this->db->begin_transaction();
                $this->db->query("UPDATE text_list SET text_data=CONCAT(COALESCE(text_data,''),'$page') WHERE text_id='$this->text_id'");
                $this->split_to_sentences($page);
                $this->db->commit();
            }
            fclose($source_file);
        }
        $this->textStatsCalc($this->text_id);
    }
    
    public function split_to_sentences( $page ){
        $page=str_replace('  ', ' ', $page);
        $page=str_replace(['\r','\n'], '', $page);
        $sentences = preg_split('/(?<=[.?!])\s+(?=[\w])/iu', $page, 0);
        foreach($sentences as $sentence){
            if(!strlen($sentence)){
                continue;
            }
            $this->db->query("INSERT sentence_list SET text_id='$this->text_id', sentence_data='".$this->db->escape_string($sentence)."'");
            $this->sentence_id=$this->db->insert_id;
            $this->split_to_words( $sentence );
        }
    }
    
    public function split_to_words( $sentence ){
        $words = preg_split('/[^[:alpha:]???]+/iu', $sentence, 0);
        foreach ($words as $word){
            if( !$word ){
                continue;
            }
            $word=$this->db->escape_string($word);
            $row=$this->db->query("SELECT * FROM word_list WHERE word_data='$word'")->row();
            if($row){
                $this->word_id=$row->word_id;
            } else {
                $this->db->query("INSERT word_list SET word_data='$word'");
                $this->word_id=$this->db->insert_id;
            }
            echo $this->db->error;
            $this->db->query("INSERT sentence_member_list SET sentence_id='$this->sentence_id', word_id='$this->word_id'");
        }
    }
    
    public function textStatsCalc( $text_id ){
        $sql="
            UPDATE
                text_list
            SET
                text_letter_count=CHAR_LENGTH(text_data),
                text_sentence_count=(SELECT COUNT(*) FROM sentence_list WHERE text_id=text_id),
                text_word_total_count=(SELECT COUNT(*) FROM sentence_member_list WHERE sentence_id=sentence_id),
                text_word_unique_count=(SELECT COUNT(DISTINCT word_id) FROM sentence_member_list WHERE sentence_id=sentence_id) 
            WHERE
                text_id='$text_id'
            ";
        return $this->db->query($sql);
    }

    public function wordMetaCalc(){
        $sql="DROP TEMPORARY TABLE IF EXISTS tmp_count;
        CREATE TEMPORARY TABLE tmp_count AS
        (SELECT 
            wl.word_id,COUNT(*) word_count
        FROM
            word_list wl
                JOIN
            sentence_member_list USING (word_id)
        GROUP BY word_id
        ORDER BY word_count DESC);
        SET @word_rank:=0;
        UPDATE 
            word_list wl
                JOIN
            tmp_count tc USING(word_id)
        SET wl.word_count=tc.word_count,wl.word_rank=@word_rank:=@word_rank+1
        ;";
    }

}