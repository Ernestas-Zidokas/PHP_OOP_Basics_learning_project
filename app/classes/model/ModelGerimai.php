<?php
 
namespace App\model;

Class ModelGerimai {
    
    private $table_name;
    private $db;
    
    public function __construct(\Core\FileDB $db, $table_name){
        $this->table_name = $table_name;
        $this->db = $db;
        
    }
    public function load($id){
        $data_row = $this->db->getRow($this->table_name, $id);
        if ($data_row) {
            return new \App\Item\Gerimas($data_row);
        } else {
            return false;
        }
    }
    
    public function insert($id, \App\Item\Gerimas $gerimas){
        if(!$this->db->getRow($this->table_name, $id)){
            $this->db->setRow($this->table_name, $id, $gerimas->getData());
            $this->db->save();
            return true;
        } else {
            return false;
        }
    }
}