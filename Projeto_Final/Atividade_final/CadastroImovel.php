<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php  include 'connection.php'; ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Imóvel</title>
</head>
<body>
    <form method="post" action="#">
        <fieldset>
            <select name="cpf">
                <?php 
                    $sql="SELECT cpf, nome FROM proprietario";
                    $resultado=$conn->query($sql);
                    $tabela=$resultado->fetchAll(PDO::FETCH_ASSOC);
                    foreach($tabela as $linha){
                        echo "<option value='".$linha['cpf']."'>".$linha['nome']."</option>";}
                ?>
            </select><br>
            <input type="text" name="cidade" placeholder="Cidade" required><br>
            <input  type="text" name="bairro" placeholder="Bairro" required><br>
            <input type="text" name="rua" placeholder="Rua" required><br>
            <input type="int" name="numero" placeholder="Número" required><br>
            <input type="text" name="complemento" placeholder="Complemento" required><br>
            <input type="text" name="cep" placeholder="CEP" required><br>
            <input type="submit" value="Salvar" name="salvar">
        </fieldset>
    </form>
</body>
</html>

<?php
    if(isset($_POST['salvar'])){
        $cpf=$_POST['cpf'];
        $cidade=$_POST['cidade'];
        $bairro=$_POST['bairro'];
        $rua=$_POST['rua'];
        $numero=$_POST['numero'];
        $complemento=$_POST['complemento'];
        $cep=$_POST['cep'];

        $sql="INSERT INTO imovel(cidade, bairro, rua, numero, complemento, cep, CPF_P) 
        VALUE(:cidade, :bairro, :rua, :numero, :complemento, :cep, :CPF_P)" ;

        $stmt=$conn->prepare($sql);
        $stmt->bindParam(':cidade',$cidade, PDO::PARAM_STR);
        $stmt->bindParam(':bairro',$bairro, PDO::PARAM_STR);
        $stmt->bindParam(':rua',$rua, PDO::PARAM_STR);
        $stmt->bindParam(':numero',$numero, PDO::PARAM_INT);
        $stmt->bindParam(':complemento',$complemento, PDO::PARAM_STR);
        $stmt->bindParam(':cep',$cep, PDO::PARAM_STR);
        $stmt->bindParam(':CPF_P',$cpf, PDO::PARAM_STR);
       
        $resultado=$stmt->execute();
        if(!$resultado){
            var_dump($stmt->errorInfo());
            exit;
        }else{
            echo $stmt->rowCount()."linhas inseridas";
        }
    }        
?>