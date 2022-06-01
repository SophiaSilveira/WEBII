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
    <title>Declaração S</title>
</head>
<body>
    <main class="mainAutonomo">
        <h1 class="titleServ">Declaração de Prestação de Serviço</h1>
        <form method="post" action="#">
            <label class="titleLab" for="descriver_Atividade">Descrição do Serviço</label><br>
            <input class="inputLog" type="text" name="descricao" placeholder="Descrição" required><br>
            <label class="titleLab" for="descriver_Atividade">Nome Completo do Contratante</label><br>
            <input class="inputLog" type="text" name="nome_Contratante" placeholder="Nome Contratante" required><br>
            <label class="titleLab" for="descriver_Atividade">CPF ou CNPJ do Contratante</label><br>
            <input class="inputLog" type="text" name="cpf_Cnpj" placeholder="CPF ou CNPJ do contratante" required><br>
            <label class="titleLab" for="descriver_Atividade">Data de Início do Serviço</label><br>
            <input class="titleDat" type="date" name="data_Inicio" required><br>
            <label class="titleLab" for="descriver_Atividade">Data Final do Serviço</label><br>
            <input class="titleDat" type="date" name="data_Final" required><br>
            <label class="titleLab" for="descriver_Atividade">Total Recebido pelo Contratante</label><br>
            <input class="inputLog" type="text" name="quantidade_Mensal" placeholder="Total recebido pelo Contratante" required><br>
            <label class="titleLab" for="descriver_Atividade">Listar Atividades Feitas</label><br>
            <input class="inputLog" type="text" name="lista_Atividade" placeholder="Listar Atividades Feitas" required><br>
            <label class="titleLab" class="titleLab" for="descriver_Atividade">Garantia</label><br>
            <input class="inputLog" type="text" name="garantia" placeholder="Garantia" required><br>
            <label class="titleLab" for="descriver_Atividade">Data de Emissão do Documento</label><br>
            <input class="titleDat" type="date" name="data_S" required><br>
            <input class="buttonServico" type="submit" value="Salvar" name="salvar">
        </form>
        <?php
            if(isset($_POST['salvar'])){
            $CPF_U = $_SESSION['CPF'];
            $descricao = $_POST['descricao'];
            $nome_Contratante = $_POST['nome_Contratante'];
            //$cpf_Cnpj = sha1($_POST['cpf_Cnpj']);
            $cpf_Cnpj = $_POST['cpf_Cnpj'];
            $data_Inicio = $_POST['data_Inicio'];
            $data_Final = $_POST['data_Final'];
            $quantidade_Mensal = $_POST['quantidade_Mensal'];
            $lista_Atividade = $_POST['lista_Atividade'];
            $garantia = $_POST['garantia'];
            $data_S = $_POST['data_S'];
            

            $sql="INSERT INTO servico(descricao, nome_Contratante, cpf_Cnpj, data_Inicio, data_Final, quantidade_Mensal, lista_Atividade, garantia, data_S, CPF_U) 
            VALUE(:descricao, :nome_Contratante, :cpf_Cnpj, :data_Inicio, :data_Final, :quantidade_Mensal, :lista_Atividade, :garantia, :data_S, :CPF_U) " ;

            $stmt=$conn->prepare($sql);

            $stmt->bindParam(':descricao',$descricao,PDO::PARAM_STR);
            $stmt->bindParam(':nome_Contratante',$nome_Contratante,PDO::PARAM_STR);
            $stmt->bindParam(':cpf_Cnpj',$cpf_Cnpj,PDO::PARAM_STR);
            //$stmt->bindParam(':cpf_Cnpj',sha1($cpf_Cnpj),PDO::PARAM_STR);
            $stmt->bindParam(':data_Inicio',$data_Inicio,PDO::PARAM_STR);
            $stmt->bindParam(':data_Final',$data_Final,PDO::PARAM_STR);
            $stmt->bindParam(':quantidade_Mensal',$quantidade_Mensal,PDO::PARAM_STR);
            $stmt->bindParam(':lista_Atividade',$lista_Atividade,PDO::PARAM_STR);
            $stmt->bindParam(':garantia',$garantia,PDO::PARAM_STR);
            $stmt->bindParam(':data_S', $data_S,PDO::PARAM_STR);
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

