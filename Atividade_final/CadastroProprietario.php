<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php  include 'connection.php'; ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Proprietário</title>
</head>
<body>
    <form method="post" action="#">
        <fieldset>
            <input type="text" name="cpf_P" placeholder="CPF" required><br>
            <input type="text" name="nome_P" placeholder="Nome" required><br>
            <label for="data_P">Insira a Data:</label>
            <input type="date" name="data_P" required><br>
            <input type="submit" value="Salvar" name="salvar"><br>
        </fieldset>
    </form>
</body>
</html>

<?php
    if(isset($_POST['salvar'])){
        $cpf=$_POST['cpf_P'];
        $nome=$_POST['nome_P'];
        $data=$_POST['data_P'];


        $sql="INSERT INTO proprietario(CPF , nome, dataNascimento) 
        VALUE(:CPF , :nome, :dataNascimento)" ;

        $stmt=$conn->prepare($sql);
        $stmt->bindParam(':CPF',$cpf, PDO::PARAM_STR);
        $stmt->bindParam(':nome',$nome, PDO::PARAM_STR);
        $stmt->bindParam(':dataNascimento',$data, PDO::PARAM_STR);
       
        $resultado=$stmt->execute();
        if(!$resultado){
            var_dump($stmt->errorInfo());
            exit;
        }else{
            echo $stmt->rowCount()."linhas inseridas";
        }
    }        
?>