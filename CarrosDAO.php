<?php

require_once('db.php');

class CarrosDAO extends db{

    public function __construct(){
        
    }

    //Mostrar as consultas
    public function select(){

    }

    //Deletar os arquivos
    public function delete(){

    }

    //Inserir novos dados
    public function insert(){

    }

    //Atualizar informações
    public function update(){

    }

    //Libera dados da memória
    public function __destruct(){
        foreach($this as $key => $value){
            unset($this->key);
        }
        foreach(array_keys(get_defined_vars)  as $var){
            unset(${"$var"});    
        } 
        unset($var);
   }






}



?>