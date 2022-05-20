<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php  include 'Connection.php'; ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Cadastro de Usuário</title>
</head>
<body class="UBody">
    <form class="UForm" method="post" action="#">
        <fieldset class="UFieldset">
            <label for="nome">Insira seu nome completo:</label>
            <input type="text" name="nome" placeholder="Nome Completo">
            <label for="CPF">Insira seu CPF:</label>
            <input type="text" name="CPF" placeholder="CPF" required>
            <label for="rg">Insira seu RG:</label>
            <input type="text" name="rg" placeholder="RG" required>
            <label for="cep">Insira seu CEP:</label>
            <input type="text" name="cep" placeholder="CEP" required>
            <label for="estado">Selecione seu Estado:</label>
            <input type="text" name="estado" placeholder="Estado">
            <label for="cidade">Insira sua cidade:</label>
            <input type="text" name="cidade" placeholder="Cidade">
            <label for="bairro">Insira seu bairro:</label>
            <input type="text" name="bairro" placeholder="bairro">
            <label for="rua">Insira sua rua:</label>
            <input type="text" name="rua" placeholder="Rua">
            <label for="numero">Insira seu Número:</label>
            <input type="number" name="numero" placeholder="Número" required>
            <label for="complemento">Insira seu complemento:</label>
            <input type="text" name="complemento" placeholder="complemento">
            <label for="data_Nascimento">Escolha sua data de nascimento:</label>
            <input type="date" name="data_Nascimento" required>
            <label for="email">Insira seu e-mail:</label>
            <input type="email" name="email" placeholder="E-mail" required>
            <label for="senha">Insira sua senha:</label>
            <input type="password" name="senha" placeholder="Senha" required>
            <input type="submit" value="Enviar" name="Enviar"><br>
        </fieldset>
    </form>
</body>
</html>

<?php
    if(isset($_POST['Enviar'])){
        
        $CPF            =$_POST['CPF'];   
        $nome           =$_POST['nome'];    
        $rg             =$_POST['rg'];    
        $cep            =$_POST['cep'];   
        $estado         =$_POST['estado'];     
        $cidade         =$_POST['cidade'];       
        $bairro         =$_POST['bairro'];         
        $rua            =$_POST['rua'];  
        $numero         =$_POST['numero'];     
        $complemento    =$_POST['complemento'];          
        $data_Nascimento=$_POST['data_Nascimento'];            
        $email          =$_POST['email'];   
        $senha          =$_POST['senha'];           



        $sql="INSERT INTO usuario(CPF,
                                  nome, 
                                  rg, 
                                  cep, 
                                  estado, 
                                  cidade, 
                                  bairro, 
                                  rua, 
                                  numero, 
                                  complemento, 
                                  data_Nascimento,
                                  email, 
                                  senha)

            VALUE(:CPF,
                  :nome, 
                  :rg, 
                  :cep, 
                  :estado, 
                  :cidade, 
                  :bairro, 
                  :rua, 
                  :numero, 
                  :complemento, 
                  :data_Nascimento,
                  :email, 
                  :senha)";

        $stmt=$conn->prepare($sql);

        $stmt->bindParam(':CPF',$CPF, PDO::PARAM_STR);
        $stmt->bindParam(':nome',$nome, PDO::PARAM_STR); 
        $stmt->bindParam(':rg',$rg, PDO::PARAM_STR);
        $stmt->bindParam(':cep',$cep, PDO::PARAM_STR); 
        $stmt->bindParam(':estado',$estado, PDO::PARAM_STR);
        $stmt->bindParam(':cidade',$cidade, PDO::PARAM_STR); 
        $stmt->bindParam(':bairro',$bairro, PDO::PARAM_STR); 
        $stmt->bindParam(':rua',$rua, PDO::PARAM_STR);
        $stmt->bindParam(':numero',$numero, PDO::PARAM_STR); 
        $stmt->bindParam(':complemento',$complemento, PDO::PARAM_STR); 
        $stmt->bindParam(':data_Nascimento',$data_Nascimento, PDO::PARAM_STR);
        $stmt->bindParam(':email',$email, PDO::PARAM_STR);
        $stmt->bindParam(':senha',$senha, PDO::PARAM_STR);
       
        $resultado=$stmt->execute();
        if(!$resultado){
            var_dump($stmt->errorInfo());
            exit;
        }else{
            echo $stmt->rowCount()."linhas inseridas";
            header('Location:index.php');
        }
    }        
?>