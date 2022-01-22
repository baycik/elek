<?php
header('Content-Type: text/plain; charset=UTF-8');

include 'Db.php';

class ParserModel {
    private $pageLength=1000;
    private $fileOffset=0;
    private $path=null;
    
    function __construct() {
        $this->db=new Db();
    }
    
    public function setFile( $path ){
        $this->path=$path;
        $row=$this->db->query("SELECT * FROM text_list WHERE text_file_path='$this->path'")->getRow();
        if($row){
            $this->text_id=$row->text_id;
        } else {
            $this->db->query("INSERT text_list SET text_file_path='$this->path'");
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
                $page= substr($buffer, 0, $pageFinish);
                
                $this->db->begin_transaction();
                $this->db->query("UPDATE text_list SET text_data=CONCAT(COALESCE(text_data,''),'$page') WHERE text_id='$this->text_id'");
                $this->split_to_sentences($page);
                $this->db->commit();
            }
            fclose($source_file);
        }
    }
    
    public function split_to_sentences( $page ){
        $page=str_replace('  ', ' ', $page);
        $sentences = preg_split('/(?<=[.?!])\s+(?=[\w])/iu', $page, null);
        foreach($sentences as $sentence){
            $this->db->query("INSERT sentence_list SET text_id='$this->text_id', sentence_data='$sentence'");
            $this->sentence_id=$this->db->insert_id;
            $this->split_to_words( $sentence );
        }
    }
    
    public function split_to_words( $sentence ){
        $words = preg_split('/[^\w’]+/iu', $sentence, null);
        foreach ($words as $word){
            if( !$word ){
                continue;
            }
            $row=$this->db->query("SELECT * FROM word_list WHERE word_data='$word'")->getRow();
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
}

$Elek=new ElekParser();
$Elek->setFile('src/metin1.txt');
$Elek->read();