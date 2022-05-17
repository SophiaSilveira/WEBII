<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <?php include 'connection.php'; ?>
        <meta charset="UTF-8">
        <title>Lista Imovél</title>
    <link rel="stylesheet" href="style.css">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
<div class="conteiner">

            <h1>Lista de Imóveis</h1>
            <table border="1">
                <tr>
                    <th>Cidade</th>
                    <th>Bairro</th>
                    <th>Rua</th>
                    <th>Numero</th>
                    <th>Complemento</th>
                    <th>Cep</th>
                    <th>CPF Proprietário</th>
                </tr>
               <?php
                    $sql="SELECT cidade, bairro, rua, numero, complemento, cep, CPF_p 
                          FROM imovel";
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