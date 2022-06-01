<?php
    session_start();
    ob_start();
    //include '../Connection.php';  
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php  include '../Connection.php'; ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilo.css">
    <title>Declaração Autonomo</title>
</head>
<body>
    <main class="mainAutonomo">
        <h1 class="titleAutonomo">Declaração de autônomo</h1>
        <form method="post" action="#">
            <label class="titleLabel" for="descriver_Atividade">Descrever Atividade</label><br>
            <input class="inputLogin" type="text" name="descriver_Atividade" placeholder="Descrever Atividade" required><br>
            <label class="titleLabel" for="renda_Mensal">Renda Mensal Aproximada</label><br>
            <input class="inputLogin" type="text" name="renda_Mensal" placeholder="Renda Aproximada mensal" required><br>
            <label class="titleLabel" for="data_A">Data de Emissão do Documento</label><br>
            <input class="titleData" type="date" name="data_A" required><br>
            <input class="buttonAutonomo" type="submit" value="Salvar" name="salvar">
        </form>
        <?php
            if(isset($_POST['salvar'])){
            $CPF_U = $_SESSION['CPF'];
            $descriver_Atividade = $_POST['descriver_Atividade'];
            $renda_Mensal = $_POST['renda_Mensal'];
            $data_A = $_POST['data_A'];
            
            $sql="INSERT INTO autonomo(descriver_Atividade, renda_Mensal, data_A, CPF_U) 
            VALUE (:descriver_Atividade, :renda_Mensal, :data_A, :CPF_U) ";

            $stmt=$conn->prepare($sql);

            $stmt->bindParam(':descriver_Atividade',$descriver_Atividade,PDO::PARAM_STR);
            $stmt->bindParam(':renda_Mensal',$renda_Mensal,PDO::PARAM_STR);
            $stmt->bindParam(':data_A',$data_A,PDO::PARAM_STR);
            $stmt->bindParam(':CPF_U',$CPF_U,PDO::PARAM_STR);
       
            $resultado=$stmt->execute();
            if(!$resultado){
                var_dump($stmt->errorInfo());
                exit;
            }else{
                echo $stmt->rowCount()."Você enviou as informações com sucesso!";
            }
        }?>
    </main>
</body>
</html>