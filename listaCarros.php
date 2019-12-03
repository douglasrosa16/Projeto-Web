<?php

    require_once('db.php');
    require_once('CarrosDAO.php');

    $db = new Db("localhost", "root", "", "locadora");
    if ($db->connect()) {
    $dao = new CarrosDAO($db);
  
    //Inserir um novo Carro
    if(count($_POST) && isset($_POST['name'])){ 
        $d = new Product(null, $_POST['name']);
        $dao->inserir($d); 
        header("Location: products.php");
    }
  }else{
      echo "Erro na conexão com o MySQL";
  }

?>  
<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Locadora de Carros</title>
  </head>
  <body>

    <div class="container">
        <div class="py-5 text-center">
            <h2>Cadastrar Carro</h2>
        </div>
        <div class="row">
            <div class="col-md-12" >
                <form action="product_new.php" class="card p-2 my-4" 
                    method="POST">
                    <div class="input-group">
                        <input type="text" placeholder="Product Name" 
                            class="form-control" name="name" required>
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-secondary">
                                Save
                            </button>
                        </div>
                    </div>
                </form>             
                <a class="btn btn-primary" href="products.php" role="button">Back</a>
            </div>
        </div>
    </div>
    
    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
