<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php  include 'connection.php'; ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Atenderr</title>
</head>
<body>
    <form method="post" action="#">
        <fieldset>
        <select name="cpf_I">
                <?php 
                    $sql="SELECT cpf, nome FROM inquilino";
                    $resultado=$conn->query($sql);
                    $tabela=$resultado->fetchAll(PDO::FETCH_ASSOC);
                    foreach($tabela as $linha){
                        echo "<option value='".$linha['cpf']."'>".$linha['nome']."</option>";}
                ?>
            </select><br>
            <select name="cpf_C">
                <?php 
                    $sql="SELECT cpf, nome FROM corretor";
                    $resultado=$conn->query($sql);
                    $tabela=$resultado->fetchAll(PDO::FETCH_ASSOC);
                    foreach($tabela as $linha){
                        echo "<option value='".$linha['cpf']."'>".$linha['nome']."</option>";}
                ?>
            </select><br>
        <label for="data_A">Insira a Data:</label>
        <input type="date" name="data_A" required>
        <input type="submit" value="Salvar" name="salvar"><br>
        </fieldset>
    </form>
</body>
</html>
<?php
    if(isset($_POST['salvar'])){
        $cpf_I=$_POST['cpf_I'];
        $cpf_C=$_POST['cpf_C'];
        $data_A=$_POST['data_A'];

        $sql="INSERT INTO atender(dataAtendimento, CPF_i , CPF_c) 
        VALUE(:dataAtendimento, :CPF_i, :CPF_c)" ;

        $stmt=$conn->prepare($sql);
        $stmt->bindParam(':dataAtendimento',$data_A, PDO::PARAM_STR);
        $stmt->bindParam(':CPF_i',$cpf_I, PDO::PARAM_STR);
        $stmt->bindParam(':CPF_c',$cpf_C, PDO::PARAM_STR);
       
        $resultado=$stmt->execute();
        if(!$resultado){
            var_dump($stmt->errorInfo());
            exit;
        }else{
            echo $stmt->rowCount()."linhas inseridas";
        }
    }        
?>