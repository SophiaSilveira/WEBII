<?php
    session_start();
    ob_start();
    include 'Connection.php';  
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
   
    <h3>Login</h3>

    <?php 
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        
        if(!empty($dados['SendLogin'])){
            //var_dump($dados);
            $query_usuario = "SELECT CPF, nome, senha FROM usuario WHERE CPF = :usuario"; //WHERE usuario = '".$dados['usuario']."'";
            $result_usuario = $conn -> prepare($query_usuario);
            $result_usuario->bindParam(':usuario', $dados['usuario'], PDO::PARAM_STR);
            $result_usuario->execute();

            if(($result_usuario) AND ($result_usuario->rowCount() != 0)){
                $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
                //var_dump($row_usuario);
                if($dados['senha'] == $row_usuario['senha']){
                    //echo "Usuário Logado";
                    $_SESSION['CPF'] = $row_usuario['CPF'];
                    $_SESSION['nome'] = $row_usuario['nome'];
                    header("Location: index.php");
                }else{
                    $_SESSION['msg'] = "<br> Erro: senha inválida!";        
                }
            }else{
                $_SESSION['msg'] = "<br> Erro: Usuário inválido!";
            }
 
        }

        if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
    ?>
    
    <form method="POST" action="#">
        <label>Usuário</label>
        <input type="text" name="usuario" placeholder="User" value="<?php if(isset($dados['usuario'])){ echo $dados['usuario'];}?>">
        <label>Senha</label>
        <input type="password" name="senha" placeholder="Password">
        <input type="submit" name="SendLogin" value="Acessar">
    </form>
    <a  href="cadastro/usuario.php">Cadastro</a>
</body>
</html>