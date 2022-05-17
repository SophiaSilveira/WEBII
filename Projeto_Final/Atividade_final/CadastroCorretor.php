<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php  include 'connection.php'; ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Corretor</title>
</head>
<body>
    <form method="post" action="#">
    <fieldset>
        <input type="text" name="cpf_C" placeholder="CPF" required><br>
        <input type="text" name="nome_C" placeholder="Nome" required><br>
        <label for="data_C">Insira a Data:</label><br>
        <input type="date" name="data_C" required><br>
        <input type="submit" value="Salvar" name="salvar"><br>
    </fieldset>
    </form>
</body>
</html>
<?php
    if(isset($_POST['salvar'])){
        $cpf_C=$_POST['cpf_C'];
        $nome_C=$_POST['nome_C'];
        $data_C=$_POST['data_C'];


        $sql="INSERT INTO corretor(CPF , nome, dataNascimento) 
        VALUE(:CPF , :nome, :dataNascimento)" ;

        $stmt=$conn->prepare($sql);
        $stmt->bindParam(':CPF',$cpf_C, PDO::PARAM_STR);
        $stmt->bindParam(':nome',$nome_C, PDO::PARAM_STR);
        $stmt->bindParam(':dataNascimento',$data_C, PDO::PARAM_STR);
       
        $resultado=$stmt->execute();
        if(!$resultado){
            var_dump($stmt->errorInfo());
            exit;
        }else{
            echo $stmt->rowCount()."linhas inseridas";
        }
    }        
?>