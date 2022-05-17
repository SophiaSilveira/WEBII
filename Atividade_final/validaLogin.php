<?php 
    session_start();
    $usuario=array("user01","user02","user03","user04","user05");
    $senha=array("senha01","senha02","senha03","senha04","senha05");
    $nome=array("Evangivaldo","Adamastor","Gertrudes","Raimundo","Milagrito");
    $msg=FALSE;
    $nome_usuario;
    for($i=0; $i<count($usuario); $i++){
        if($_POST['user']==$usuario[$i] && $_POST['senha']==$senha[$i]){
            $msg=TRUE;
            $nome_usuario=$nome[$i];
            break;
        }
    }
    if($msg==TRUE){
        $_SESSION['logado']=TRUE;
        $_SESSION['nome']=$nome_usuario;
        header("Location:index.php");
    }else{
        header("Location:index.html");
    }
?>