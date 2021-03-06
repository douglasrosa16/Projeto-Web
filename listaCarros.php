<?php

    require_once('db.php');
    require_once('CarrosDAO.php');
    require_once('carro.php');

    $db = new Db("localhost", "root", "", "locadora");
    if ($db->connect()) {     
        $dao = new CarrosDAO($db);
        $carro = null;
        
        //Deletar o Carro
        if(count($_GET) && isset($_GET['op']) && $_GET['id']!=""){     
            $opcao = $_GET['op'];
            $mCarro = $dao->getCarroByID($_GET['id']);
            if(!$mCarro == null){
                if($opcao == "apagar"){                
                    $dao->apagarCarro($mCarro);
                }
            }else{
                header("location:listaCarros.php");
            }
        }    

        //Pesquisar Carro por ID
        if(count($_GET) && (isset($_GET['id_pesquisa']))) {
            if($_GET['id_pesquisa'] != ""){
                $carro = $dao->getCarroByID($_GET['id_pesquisa']);
            }
        }
    
        $carros = $dao->getCarros();
    
    

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
    <link rel="stylesheet" href="style.css">
    <title>Carros Cadastrados</title>
  </head>
  <body>

    <div class="container">
        <div class="py-5 text-center">
            <h2>Lista de Carros</h2>
        </div>
        <div class="row">
            <div class="col-md-12" >
                <form action="listaCarros.php" class="card p-2 my-4" 
                    method="GET">
                    <div class="input-group">
                        <div class="input-group-append">    
                            <input type="number" name="id_pesquisa" placeholder="Informe o ID">               
                            <button type="submit" class="btn btn-secondary">
                                Pesquisar
                            </button>
                            <?php                             
                                if(!$carro == null){
                                    echo "<strong>ID: </strong>".$carro->getId()." - ". "<strong>Nome:  </strong>  ".$carro->getModelo();
                                }else{
                                    echo "";
                                }                                  
                            ?>
                        </div>
                    </div>
                </form>
                <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
<?php      
    foreach($carros as $d){ 
?>                
                <tr>
                    <th scope="row"><?php echo $d->getId();?></th>
                    <td><?php echo $d->getModelo();?></td>
                    <td>
                        <a class="btn btn-secondary btn-sm active" 
                           href="carro_info.php?&id=<?php echo $d->getId();?>">
                            Info
                        </a>  
                        <a class="btn btn-danger btn-sm active"
                           href="listaCarros.php?op=apagar&id=<?php echo $d->getId(); ?>">
                            Apagar
                        </a>
                        <a class="btn btn-success btn-sm active" 
                           href="editarCarro.php?&id=<?php echo $d->getId();?>">
                            Editar
                        </a>   
                    </td>
<?php 
        }   
?>                
                </tr>
                </tbody>
                </table>
                <a class="btn btn-primary" href="index.php" role="button">Voltar</a>
            </div>
        </div>
    </div>
    
    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
