<?php

    require_once('db.php');
    require_once('MarcaDAO.php');
    require_once('marca.php');

    $db = new Db("localhost", "root", "", "locadora");
    if ($db->connect()) {     
        $dao = new MarcasDAO($db);
        $marca = null;
        
        //Deletar uma Marca
        if(count($_GET) && isset($_GET['op']) && $_GET['id']!=""){     
            $opcao = $_GET['op'];
            $mMarca = $dao->getMarcaByID($_GET['id']);
            if(!$mMarca == null){
                if($opcao == "apagar"){                
                    $dao->apagarMarca($mMarca);
                }
            }else{
                header("location:listaMarcas.php");
            }
        }    

        //Consultar Marca por ID
        if(count($_GET) && (isset($_GET['id_pesquisa']))) {
            if($_GET['id_pesquisa'] != ""){
                $marca = $dao->getMarcaByID($_GET['id_pesquisa']);
            }
        }
    
        $marcas = $dao->getMarcas(); 
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

    <title>Marcas Cadastradas</title>
  </head>
  <body>

    <div class="container">
        <div class="py-5 text-center">
            <h2>Lista de Marcas</h2>
        </div>
        <div class="row">
            <div class="col-md-12" >
                <form action="listaMarcas.php" class="card p-2 my-4" 
                    method="GET">
                    <div class="input-group">
                        <div class="input-group-append">    
                            <input type="number" name="id_pesquisa" placeholder="Informe o ID">               
                            <button type="submit" class="btn btn-secondary">
                                Pesquisar
                            </button>
                            <?php                             
                                if(!$marca == null){
                                    echo "<strong>ID: </strong>".$marca->getId()." - ". "<strong>Nome:  </strong>  ".$marca->getMarca();
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
    foreach($marcas as $d){ 
?>                
                <tr>
                    <th scope="row"><?php echo $d->getId();?></th>
                    <td><?php echo $d->getMarca();?></td>
                    <td>
                        <a class="btn btn-secondary btn-sm active" 
                           href="marca_info.php?&id=<?php echo $d->getId();?>">
                            Info
                        </a>  
                        <a class="btn btn-danger btn-sm active"
                           href="listaMarcas.php?op=apagar&id=<?php echo $d->getId(); ?>">
                            Apagar
                        </a>
                        <a class="btn btn-success btn-sm active" 
                           href="editarMarcas.php?&id=<?php echo $d->getId();?>">
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
