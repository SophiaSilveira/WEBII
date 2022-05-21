<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php  include '../Connection.php'; ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Declaração A</title>
</head>
<body>
    <main>
        <h1>Declaração de autônomo</h1>
        <form method="post" action="#">
            <select name="CPF_U">
                <?php 
                    $sql="SELECT CPF, nome FROM usuario";
                    $resultado=$conn->query($sql);
                    $tabela=$resultado->fetchAll(PDO::FETCH_ASSOC);
                    foreach($tabela as $linha){
                        echo "<option value='".$linha['CPF']."'>".$linha['nome']."</option>";}
                ?>
            </select><br>
            <input type="text" name="descriver_Atividade" placeholder="Descrever Atividade" required><br>
            <input  type="text" name="renda_Mensal" placeholder="Reda Aproximada mensal" required><br>
            <input type="submit" value="Salvar" name="salvar">
        </form>
        <?php
            if(isset($_POST['salvar'])){
            $CPF_U = $_POST['CPF_U'];
            $descriver_Atividade = $_POST['descriver_Atividade'];
            $renda_Mensal = $_POST['renda_Mensal'];
            
            $sql="INSERT INTO autonomo(descriver_Atividade, renda_Mensal, CPF_U) 
            VALUE (:descriver_Atividade, :renda_Mensal, :CPF_U) ";

            $stmt=$conn->prepare($sql);

            $stmt->bindParam(':descriver_Atividade',$descriver_Atividade,PDO::PARAM_STR);
            $stmt->bindParam(':renda_Mensal',$renda_Mensal,PDO::PARAM_STR);
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