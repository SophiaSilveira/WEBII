<?php
    session_start();
    ob_start();
    include 'Connection.php';  

    if((!isset($_SESSION['CPF'])) AND (!isset($_SESSION['nome']))){
        $_SESSION['msg'] = "<br> Erro: Necessário realizar login!";
        header("Location:index.php");
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <title>Projeto Final Parte 1</title>
</head>

<body class="body">
    <main class="main flex">
        <header class="header">
            <h3>Bem vindo, <?php Echo $_SESSION['nome']?>!</h3>
            <h3>de CPF <?php Echo $_SESSION['CPF']?>!</h3>
            <a href="sair.php">Sair</a>
        </header>
        <nav class="nav flex">
            <ul>
                <a target="conteudo" href="./cadastro/autonomo.php">
                    <li> Declaração para Autonômo</li>
                </a>
                <a target="conteudo" href="./cadastro/imovel.php">
                    <li> Declaração de Imóvel</li>
                </a>
                <a target="conteudo" href="./cadastro/servico.php">
                    <li> Delaraçãode Prestação de Serviço</li>
                </a>               
            </ul>
        </nav>
        <section class="SIframe">
            <iframe class="iframe" name="conteudo"></iframe>
        </section>
        <aside class="aside">
                <ul>
                    <a target="conteudo" href="Aniversariantes.php">
                    <li>Aniversariante do Dia</li>
                    </a>
                    <a target="conteudo" href="ListarAtendimento.php">
                    <li> Lista Atendimento</li>
                    </a>
                    <a target="conteudo" href="pdf.php">
                    <li> PDF</li>
                    </a>
                </ul>
        </aside>
        <footer class="footer">

        </footer>
    </main>
</body>
</html>