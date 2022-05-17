<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php
        session_start();
        if (isset($_COOKIE['contador'])){
            $c = $_COOKIE['contador'];
            $c++;
            echo 'Obrigado pela visita número '.$c;

            setcookie('contador', $c, time() +3600);
        }else{
            echo 'Olá meu amigo!';
            setcookie('contador', 1, time() +3600);
        }
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Projeto Final Parte 1</title>
</head>

<body class="body">
    <main class="main flex">
        <header class="header">
            <?php
                if(!isset($_SESSION['logado']) || $_SESSION['logado']!=true){
                    header("Location:index.html");
                }else{
                        echo "Olá, ".$_SESSION['nome'];
                }    
            ?>
        </header>
        <nav class="nav flex">
            <ul>
                <a target="conteudo" href="CadastroProprietario.php">
                    <li> Cadastro Proprietário</li>
                </a>
                <a target="conteudo" href="CadastroImovel.php">
                    <li> Cadastro do Imóvel</li>
                </a>
                <a target="conteudo" href="CadastroCorretor.php">
                    <li> Cadastro do Corretor</li>
                </a>
                <a target="conteudo" href="CadastroContactar.php">
                    <li> Cadastro de Contactar</li>
                </a>
                <a target="conteudo" href="CadastroInquilino.php">
                    <li> Cadastro do Inquilino</li>
                </a>
                <a target="conteudo" href="CadastroAtender.php">
                    <li> Cadastro Atender</li>
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
                    <a target="conteudo" href="ListarContato.php">
                        <li> Lista Contato</li>
                    </a>
                    <a target="conteudo" href="ListarCorretor.php">
                        <li> Lista Corretor</li>
                    </a>
                    <a target="conteudo" href="ListarImovel.php">
                        <li> Lista Imóvel</li>
                    </a>
                    <a target="conteudo" href="ListarInquilino.php">
                        <li> Lista Inquilino</li>
                    </a>
                    <a target="conteudo" href="ListarProprietario.php">
                        <li> Lista Propeietario</li>
                    </a>
                </ul>
        </aside>
        <footer class="footer">

        </footer>
    </main>

</body>

</html>