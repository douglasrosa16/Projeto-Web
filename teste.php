<?php

    $marcas = [];
    $marcas[] = "Teste1";
    $marcas[] = "Teste2";
    $marcas[] = "Teste3";
    $marcas[] = "Teste4";
    $marcas[] = "Teste5";
    $marcas[] = "Teste6";
    $marcas[] = "Teste7";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<select>
<?php foreach($marcas as $m){ ?>    
        <option ><?php echo $m ?></option>
<?php } ?>
    </select> 
</body>
</html>