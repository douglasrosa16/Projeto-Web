<?php

require_once('db.php');
require_once('carro.php');
class CarrosDAO extends db{

    public function __construct(){
        
    }

    public function getCarros() {
        if ($this->connection->isConnected()) {
            $sql="SELECT carro_id, modelo, ano, placa, marca_id from carros";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            $stmt->bind_result($carro_id, $modelo, $ano, $placa, $marca_id);
            $res = $stmt->store_result();
            $carros = [];
            if ($stmt->num_rows > 0) {
                while ($stmt->fetch()) {
                    $carros[] = new Carro($carro_id, $modelo, $ano, $placa, $marca_id);
                }
            }
            $stmt->close();
            return $carros;
        }
        return [];
    }

    public function insereCarro(Carro $carro) {
        if ($this->connection->isConnected()) {
            $sql = "INSERT INTO carros (modelo, ano, placa) VALUES(?,?,?)";
            $stmt = $this->connection->prepare($sql);
            if (isset($stmt)) {
                $modelo = $carro->getModelo()
                $ano    = $carro->getAno();
                $placa  = $carro->getPlaca();
                $id_marca = $carro->getMarca_id();
                $stmt->bind_param('sss',$modelo, $ano, $placa);
                if ($stmt->execute()) {
                    $lastId = $this->connection->getLastID();
                    $carro->setIdCarro($lastId);
                    $stmt->close();
                    return $carro;
                }
                $stmt->close();
            }
        }
        return null;
    }

    public function getCarroByID($id) {
        if ($this->connection->isConnected()) {
            $sql = "SELECT carro_id, modelo, ano, placa, marca_id from carros where carro_id = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->bind_param('i', $id);
            if ($stmt->execute()) {
                $stmt->bind_result($carro_id, $modelo, $ano, $placa, $marca_id);
                $stmt->store_result();
                if ($stmt->num_rows > 0) {
                    if ($stmt->fetch()) {
                        $stmt->close();
                        return new Carro ($carro_id, $modelo, $ano, $placa, $marca_id);
                    }
                }
            }
            $stmt->close();
        }
        return null;
    }

    public function apagarCarro(Carro $carro) {
        if ($this->connection->isConnected()) {
            $sql = "DELETE FROM carros WHERE carro_id = ?";
            $stmt = $this->connection->prepare($sql);
            if (isset($stmt)) {
                $id = $carro->getId();
                $stmt->bind_param('i', $id);
                $res = $stmt->execute();
                $stmt->close();
            }
            return $res;
        }
        return false;
    }

    public function salvarCarro(Carro $carro) {
        if ($this->connection->isConnected()) {
            $sql = "UPDATE carros SET modelo=? WHERE carro_id=?";
            $stmt = $this->connection->prepare($sql);
            if (isset($stmt)) {
                $carro_id = $carro->getId();
                $modelo = $carro->getModelo();
                $stmt->bind_param('si',$modelo, $carro_id);
                $res = $stmt->execute();
                $stmt->close();
                return $res;
            }
        }
        return false;
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
