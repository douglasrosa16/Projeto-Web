<?php

    class Carro{

      private $carro_id;
      private $modelo;
      private $ano;
      private $placa;
      private $marca_id;

        public function __construct($carro_id=null, $modelo=null, $ano=null, $placa=null, $marca_id=null){
            $this->carro_id = $carro_id;
            $this->modelo = $modelo;
            $this->ano = $ano;
            $this->placa = $placa;
            $this->marca_id = $marca_id;
        }

        public function setId($carro_id){
            $this->carro_id = $carro_id;
        }

        public function getId(){
            return $this->carro_id;
        }

        public function setModelo($modelo){
            $this->modelo = $modelo;
        }

        public function getModelo(){
            return $this->modelo;
        }

        public function setAno($ano){
            $this->ano = $ano;
        }

        public function getAno(){
            return $this->ano;
        }

        public function setPlaca($placa){
            $this->placa = $placa;
        }

        public function getPlaca(){
            return $this->placa;
        }

        public function setMarca_id($marca_id){
            $this->marca_id = $marca_id;
        }

        public function getMarca_id(){
            return $this->marca_id;
        }
    }

?>