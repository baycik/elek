<?php
namespace Models;

//include 'Db.php';
class SignatureModel{
    private $db;
    function __construct(){
        $this->db=new Db();
    }

    public function itemCreate( int $word_id ){
        $user=user('ElekEditor');
        $sql="INSERT IGNORE
                elek_signature_list
            SET
                `word_id`='{$word_id}',
                `user_id`='{$user->user_id}',
                `user_name`='{$user->user_name}',
                `user_group_title`='{$user->user_group_title}',
                `sign_date`=NOW()
            ";
        $this->db->query($sql);
        return $this->db->affected_rows;
    }

    public function itemDelete( int $word_id ){
        $user=user('ElekEditor');
        $sql="DELETE 
            FROM
                elek_signature_list
            WHERE
                `word_id`='{$word_id}' AND `user_id`='{$user->user_id}'
            ";
        $this->db->query($sql);
        return $this->db->affected_rows;

    }

    
    public function listGet( int $word_id ){
        $user=user('ElekEditor');
        $sql="
            SELECT
                *,
                DATE_FORMAT(sign_date,'%d.%m.%Y') sign_date_dmy, 
                user_id='{$user->user_id}' as is_current_user
            FROM
                elek_signature_list
            WHERE
                word_id='$word_id'
            ";
        return $this->db->query($sql)->rows();
    }

    public function listDelete(){

    }

}