<?php 
    session_start();
    ob_start();
    unset($_SESSION['id'],  $_SESSION['nome']);
    
    $_SESSION['msg'] = "<br> Deslogado com sucesso!"; 

    header("Location:login.php");
?>