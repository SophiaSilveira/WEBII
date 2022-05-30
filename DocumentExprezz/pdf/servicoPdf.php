<?php
    session_start();
    ob_start();
	include 'connection.php';
    $tagForm="<form action='#' method='post'>";

    $query_S = "SELECT s.id_S, s.descricao, s.nome_Contratante, s.cpf_Cnpj, s.data_Inicio, s.data_Final, 
    s.quantidade_Mensal, s.lista_Atividade, s.garantia, s.data_S, s.CPF_U 
                     FROM servico s 
                    left join usuario u on u.CPF = s.CPF_U 
                    WHERE s.id_S = :id"; 
    $result_S = $conn -> prepare($query_S);
    $result_S->bindParam(':id', $_SESSION['id_S'], PDO::PARAM_STR);
    $result_S->execute();

    $row_S = $result_S->fetch(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Declaração de Autonomo</title>
    <style>
        .navTit{
            text-align: center;
            margin-top: 90px;
            font-size: 14px;            
        }
        .sectionText{
            width: 90%;
            text-align: justify;
            display: flex;
            margin-left: auto;
            margin-right: auto;
            font-size: 17px;  
            line-height: 35px;            
        }
    </style>
</head>
<body class="bodyOne">
    <nav class="navTit">
        <h3> DECLARAÇÃO DE PRETAÇÃO DE SERVIÇO </h3> 
        <br>
    </nav>
    <section class="sectionText">
        <p>
        <?php echo $row_S['id_S']?>
            O profissional (ou a empresa, caso você tenha um CNPJ ativo), (colocar seu nome ou o nome empresarial), com CPF/CNPJ de nº (colocar número do CPF ou CNPJ), declara que prestou serviço     de (fazer descrição geral do serviço), para o contratante (colocar nome da empresa contratante), com CPF/CNPJ de nº (colocar número do CPF ou CNPJ), no período de (colocar a quantidade    de dias) dias, entre (colocar a data inicial e final de execução do serviço) no valor mensal de R$ (descrever o valor numérico e por extenso do pagamento combinado).
        </p>
        <p>
            Declara, ainda, que todos os serviços abaixo foram executados com sucesso:
        </p>
        <p>
            (descrever todos os serviços, ordenando todos eles com lista e descrição básica).
        </p>
    </section>
    <section class="sectionText">    
        <p>
            O contratado afirma que garante X (colocar a quantidade de dias de garantia) dias de garantia, a contar a partir desta data.
        </p>
    </section>
    <footer class="sectionText">
        <p>
            Esta declaração confirma que todas as informações prestadas são verdadeiras.
        </p>
        <p>Local, _____,_______,_____.</p>        
        <p> 
            Assinatura do/a declarante e carimbo da empresa (caso haja) <br>
            CPF do/a declarante:_____________________
        </p>
    </footer>     
</body>
</html>

<!--http://localhost/projetofinal/WEBII/DocumentExprezz/pdf/autonomoPdf.php-->