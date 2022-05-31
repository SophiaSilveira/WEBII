<?php 
    session_start();
    ob_start();
    include 'connection.php';

    $query_A = "SELECT u.nome, u.rg, u.CPF, u.rua, u.numero, u.bairro, u.cidade, u.estado, u.cep, 
    a.descriver_Atividade, a.renda_Mensal, a.data_A
                FROM autonomo a 
                    left join usuario u on u.CPF = a.CPF_U 
                    WHERE a.id_A = :id"; 
    $result_A = $conn -> prepare($query_A);
    $result_A->bindParam(':id', $_SESSION['id_A'], PDO::PARAM_STR);
    $result_A->execute();
    
    $row_A = $result_A->fetch(PDO::FETCH_ASSOC);
        
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Declaração de Autonomo</title>
    <style>
        .navTitle{
            text-align: center;
            margin-top: 90px;
            font-size: 14px;
        }
        .secParagraph{
            width: 90%;
            text-align: justify;
            display: flex;
            margin-left: auto;
            margin-right: auto;
            font-size: 17px;     
        }
        .secParagraph{
            line-height: 35px;
            font-size: 17px;  
        }
        .paraTwo{
            margin-top: 100px;
            font-size: 16px;
        }
        .secPara{
            text-align: right;
            margin-bottom: 90px;
        }
        .paraTree{
            margin-bottom: 50px;
            margin-right: 45px;
        }
        .paraFour{
            margin-right: 45px;
        }
        .paraAss{
            margin-right: 128px;
        }
        .footerAuto{
            width: 90%;
            text-align: justify;
            margin-right: auto;
            margin-left: auto;
            margin-top: -20px;
        }
        .titleFive{
            margin-bottom: -10px;
            font-size: 16px;
        }

    </style>
</head>
<body>
    <nav class="navTitle">
        <h3> DECLARAÇÃO AUTÔNOMO </h3> 
        <br>
    </nav>
    <section class="secParagraph">
        <p class="paragrafo">
            Eu <?php echo $row_A['nome']?> de
            RG nº <?php echo $row_A['rg']?> CPF nº <?php echo $row_A['CPF']?>,
            residente na Rua <?php echo $row_A['rua']?>, nº <?php echo $row_A['numero']?>,
            Bairro <?php echo $row_A['bairro']?>, cidade <?php echo $row_A['cidade']?>, estado <?php echo $row_A['estado']?>,
            CEP <?php echo $row_A['cep']?>, venho por meio desta declarar para os devidos fins,
            que não mantenho vínculo empregatício com pessoa física ou jurídica mas que exerço
            atividade autônoma de <?php echo $row_A['descriver_Atividade']?> e recebo mensalmente
            rendimentos no valor de R$ <?php echo $row_A['renda_Mensal']?>.
        </p>
        <p class="paraTwo"> 
            Declaro também estar ciente das penalidades legais* a que estou sujeito (a)
        </p>
    </section>
    <section class="secPara">    
        <p class="paraTree">
        <?php echo $row_A['cidade']." - ".$row_A['estado'].", ".$row_A['data_A']?>.

        </p>
        <p class="paraFour">
            ____________________________________________<br>
            <p class="paraAss">Assinatura do Declarante</p>
        </p>
    </section>
    <footer class="footerAuto">
        <p class="titleFive">*Código Penal – Falsidade Ideológica</p>
        <p>
            rt. 299 – “Omitir, em documento público ou particular, declaração que dele devia constar, ou
            ele inserir ou fazer inserir declaração falsa ou diversa da que devia ser escrita, com o fim de
            rejudicar direito, criar obrigação ou alterar a verdade sobre fato juridicamente relevante”.
        </p>        
        <p clas="paraWeight">
            __________________________ <br>
            Declaração de Trabalho Autônomo e cópia da Carteira de Trabalho e Previdência Social (CTPS)
            com folhas de identificação e última anotação de contrato de trabalho (se houver) e página seguinte
            em branco
        </p>
    </footer>     
</body>
</html>

<!--http://localhost/projetofinal/WEBII/DocumentExprezz/pdf/autonomoPdf.php-->