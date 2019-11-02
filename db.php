<?php

//Conexão com Banco de Dados
$database = "locadora";
$host = "localhost";
$user = "root";
$password = "";

$conn = new mysqli($host, $user, $password, $database);

if(!$conn->connect_errno){
    echo "Conectado com Sucesso!";
}else{
    die("Falha na conexão: " . $conn->connect_error);
}

?>