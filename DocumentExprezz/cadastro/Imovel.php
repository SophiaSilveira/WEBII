<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php  include '../Connection.php'; ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilo.css">
    <title>Declaração I</title>
</head>
<body>
    <main>
        <h1>Declaração de Imóvel</h1>
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
            <input type="date" name="anos_Inicio" required><br>
            <input  type="date" name="anos_Fim" required><br>
            <input type="submit" value="Salvar" name="salvar">
        </form>
        <?php
            if(isset($_POST['salvar'])){
            $CPF_U = $_POST['CPF_U'];
            $anos_Inicio = $_POST['anos_Inicio'];
            $anos_Fim = $_POST['anos_Fim'];
            
            $sql="INSERT INTO imovel(anos_Inicio, anos_Fim, CPF_U) 
            VALUE (:anos_Inicio, :anos_Fim, :CPF_U)  ";

            $stmt=$conn->prepare($sql);

            $stmt->bindParam(':anos_Inicio',$anos_Inicio,PDO::PARAM_STR);
            $stmt->bindParam(':anos_Fim',$anos_Fim,PDO::PARAM_STR);
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