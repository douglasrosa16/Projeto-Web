<?php

require_once('db.php');
require_once('carro.php');
class CarrosDAO extends db{

    public function __construct(Db $con){
        $this->con = $con;
    }

    public function getCarros() {
        if ($this->con->isConnected()) {
            $sql="SELECT carro_id, modelo, ano, placa, marca_id from carros";
            $stmt = $this->con->prepare($sql);
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
        if ($this->con->isConnected()) {
            $sql = "INSERT INTO carros (modelo, ano, placa, marca_id) VALUES(?,?,?,?)";
            $stmt = $this->con->prepare($sql);
            if (isset($stmt)) {
                $modelo = $carro->getModelo();
                $ano    = $carro->getAno();
                $placa  = $carro->getPlaca();
                $marca_id = $carro->getMarca_id();
                $stmt->bind_param('ssss',$modelo, $ano, $placa, $marca_id);
                if ($stmt->execute()) {
                    $lastId = $this->con->getLastID();
                    $carro->setId($lastId);
                    $stmt->close();
                    return $carro;
                }
                $stmt->close();
            }
        }
        return null;
    }

    public function getCarroByID($id){
        if($this->con->isConnected()){
            $sql = "SELECT carro_id, modelo, ano, placa, marca_id from carros where carro_id = ?";
            $stmt = $this->con->prepare($sql);
            if($stmt){
                $stmt->bind_param("i",$id);
                if ($stmt->execute()){            
                    $stmt->bind_result($carro_id, $modelo, $ano, $placa, $marca_id);
                    $stmt->store_result();
                    $carro = null; //vai retornar ela caso ela seja zero
                    if($stmt->num_rows > 0){
                        $stmt->fetch();
                        $carro = new Carro($carro_id, $modelo, $ano, $placa, $marca_id);
                    }
                    $stmt->close();
                    return $carro;
                }          
            }else{
                echo "Não foi possível executar esse comando";        
            }
        }else{
            echo "Você não está conectado!";
            return null;
        }
    }


    public function apagarCarro(Carro $carro) {
        if ($this->con->isConnected()) {
            $sql = "DELETE FROM carros WHERE carro_id = ?";
            $stmt = $this->con->prepare($sql);
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
        if ($this->con->isConnected()) {
            $sql = "UPDATE carros SET modelo=? WHERE carro_id=?";
            $stmt = $this->con->prepare($sql);
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

    public function update(Carro $d){
        if($this->con->isConnected()){
            $sql = "UPDATE carros SET modelo = ?, ano = ?, placa = ? WHERE carro_id = ?";
            $stmt = $this->con->prepare($sql);
            var_dump($stmt);
            if($stmt){
                $modelo = $d->getModelo();
                $ano = $d->getAno();
                $placa = $d->getPlaca();
                $id = $d->getId();
                $stmt->bind_param('ssss', $modelo, $ano, $placa, $id);
                if($stmt->execute()){
                    $res = $stmt->execute();
                    $stmt->close();
                    return $res;
                }         
            }else{
                $stmt->close();
            }
            header("Location: listaCarros.php");
        }else{
            echo "Erro ao conectar";
            return false;
        }
    }
}
  
   ?>
