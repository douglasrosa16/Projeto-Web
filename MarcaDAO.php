<?php

require_once('db.php');
require_once('marca.php');
class MarcasDAO extends db{

  public function __construct(Db $con){
    $this->con = $con;
  }

    public function getMarcas() {
        if ($this->con->isConnected()) {
            $sql="SELECT marca_id, nome_marca from marcas";
            $stmt = $this->con->prepare($sql);
            $stmt->execute();
            $stmt->bind_result($marca_id, $nome_marca);
            $res = $stmt->store_result();
            $Marcas = [];
            if ($stmt->num_rows > 0) {
                while ($stmt->fetch()) {
                    $Marcas[] = new Marca($marca_id, $nome_marca);
                }
            }
            $stmt->close();
            return $Marcas;
        }
        return [];
    }

    public function insereMarca(Marca $marca) {
        if ($this->con->isConnected()) {
            $sql = "INSERT INTO marcas (nome_marca) VALUES(?)";
            $stmt = $this->con->prepare($sql);
            if ($stmt) {
                $nomeMarca = $marca->getMarca();
                $stmt->bind_param('s',$nomeMarca);
                if ($stmt->execute()) {
                    $lastId = $this->con->getLastID();
                    $marca->setId($lastId);
                    $stmt->close();
                    return $marca;
                }
                $stmt->close();
            }
        }
        return null;
    }

    public function getMarcaByID($id) {
        if ($this->con->isConnected()) {
            $sql = "SELECT marca_id, nome_marca from marcas where marca_id = ?";
            $stmt = $this->con->prepare($sql);
            $stmt->bind_param('i', $id);
            if ($stmt->execute()) {
                $stmt->bind_result($marca_id, $nome_marca);
                $stmt->store_result();
                if ($stmt->num_rows > 0) {
                    if ($stmt->fetch()) {
                        $stmt->close();
                        return new Marca ($marca_id, $nome_marca);
                    }
                }
            }
            $stmt->close();
        }
        return null;
    }

    public function apagarMarca(Marca $marca) {
        if ($this->con->isConnected()) {
            $sql = "DELETE FROM marcas WHERE marca_id = ?";
            $stmt = $this->con->prepare($sql);
            if (isset($stmt)) {
                $id = $marca->getId();
                $stmt->bind_param('i', $id);
                $res = $stmt->execute();
                $stmt->close();
            }
            return $res;
        }
        return false;
    }

    public function salvarMarca(Marca $marca) {
        if ($this->con->isConnected()) {
            $sql = "UPDATE marcas SET marca=? WHERE marca_id=?";
            $stmt = $this->con->prepare($sql);
            if (isset($stmt)) {
                $marca_id = $marca->getId();
                $marca = $marca->getMarca();
                $stmt->bind_param('si',$marca, $marca_id);
                $res = $stmt->execute();
                $stmt->close();
                return $res;
            }
        }
        return false;
    }

}
  
   ?>
