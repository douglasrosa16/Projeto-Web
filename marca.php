<?php

    class Marca{

      private $marca_id;
      private $marca;

        public function __construct($marca_id=null, $marca=null){
            $this->marca_id = $marca_id;
            $this->marca = $marca;
        }

        public function setId($marca_id){
            $this->marca_id = $marca_id;
        }

        public function getId(){
            return $this->marca_id;
        }

        public function setMarca($marca){
            $this->marca = $marca;
        }

        public function getMarca(){
            return $this->marca;
        }

    }

?>