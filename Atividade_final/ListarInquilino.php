<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <?php include 'connection.php'; ?>
        <meta charset="UTF-8">
        <title>Lista Inquilino</title>
    <link rel="stylesheet" href="style.css">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
<div class="conteiner">

            <h1>Lista de Inquilínos</h1>
            <table border="1">
                <tr>
                    <th>CPF</th><th>nome</th><th>data de Nascimento</th><th>salário</th><th>id_imóvel</th>
                </tr>
               <?php
                    $sql="SELECT CPF, nome, dataNascimento, salario, id_imovel FROM inquilino";
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