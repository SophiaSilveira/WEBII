<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'connection.php';    ?>
        <meta charset="UTF-8">
        <title>Aniversariantes</title>
    <link rel="stylesheet" href="style.css">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
<div class="conteiner">

            <h1>Aniversariantes</h1>
            <table border="1">
                <tr>
                    <th>Nome</th><th>Data Aniversário</th><th>Idade</th></th>
                    
                </tr>
<?php 
    $sql="SELECT nome, dataNascimento, floor(datediff(curdate(),dataNascimento)/365) as idade FROM inquilino
    WHERE extract(month from dataNascimento)= extract(month from curdate())
    AND extract(day from dataNascimento)= extract(day from curdate())";
    $resultado=$conn->query($sql);
    $tabela=$resultado->fetchAll(PDO::FETCH_ASSOC);
    foreach($tabela as $linha){
        echo "<tr>";
        foreach($linha as $coluna){
           echo "<td>".$coluna."</td>";
       }
       echo "</tr>";
    }
?>

</table>
 </div>      
    </body>
</html>