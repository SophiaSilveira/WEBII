<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php  include 'connection.php'; ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Inquilino</title>
</head>
<body>
    <form method="post" action="#">
    <fieldset>
        <select name="id_imovel">
            <?php
            $sql="SELECT id, cidade FROM imovel";
            $resultado=$conn->query($sql);
            $tabela=$resultado->fetchAll(PDO::FETCH_ASSOC);
            foreach($tabela as $linha){
                echo "<option value='".$linha['id']."'>".$linha['cidade']."</option>";}
            ?>

        </select>
        <input type="text" name="cpf_I" placeholder="CPF" required>
        <input type="text" name="nome_I" placeholder="Nome" required>
        <input type="text" name="salario_I" placeholder="Salário" required>
        <label for="data_I">Insira a Data:</label>
        <input type="date" name="data_I" required>
        <input type="submit" value="Salvar" name="salvar"><br>
        </fieldset>
        </form>
</body>
</html>

<?php
    if(isset($_POST['salvar'])){
        $id_imovel=$_POST['id_imovel'];
        $cpf=$_POST['cpf_I'];
        $nome=$_POST['nome_I'];
        $salario=$_POST['salario_I'];
        $data=$_POST['data_I'];

        $sql="INSERT INTO inquilino(CPF , nome, dataNascimento, salario, id_imovel) 
        VALUE(:CPF , :nome, :dataNascimento, :salario, :id_imovel)" ;

        $stmt=$conn->prepare($sql);
        $stmt->bindParam(':CPF',$cpf, PDO::PARAM_STR);
        $stmt->bindParam(':nome',$nome, PDO::PARAM_STR);
        $stmt->bindParam(':dataNascimento',$data, PDO::PARAM_STR);
        $stmt->bindParam(':salario',$salario, PDO::PARAM_STR);
        $stmt->bindParam(':id_imovel',$id_imovel, PDO::PARAM_STR);
       
        $resultado=$stmt->execute();
        if(!$resultado){
            var_dump($stmt->errorInfo());
            exit;
        }else{
            echo $stmt->rowCount()."linhas inseridas";
        }
    }        
?>