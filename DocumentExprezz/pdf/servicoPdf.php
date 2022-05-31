<?php
    session_start();
    ob_start();
	include 'connection.php';
    $tagForm="<form action='#' method='post'>";

    $query_S = "SELECT u.nome, u.CPF, u.cnpj, u.namePjEm, u.estado, u.cidade, s.descricao, s.nome_Contratante, s.cpf_Cnpj, s.data_Inicio, 
    s.data_Final, s.quantidade_Mensal, s.lista_Atividade, s.garantia, s.data_S, s.CPF_U
            FROM servico s 
        left join usuario u on u.CPF = s.CPF_U 
        WHERE s.id_S = :id"; 
    $result_S = $conn -> prepare($query_S);
    $result_S->bindParam(':id', $_SESSION['id_S'], PDO::PARAM_STR);
    $result_S->execute();

    $row_S = $result_S->fetch(PDO::FETCH_ASSOC);

    $primeiraData = new DateTime($row_S['data_Inicio']);
    $segundaData = new DateTime($row_S['data_Final']);
    $intervalo = $primeiraData->diff($segundaData);
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Declaração de Prestação de Serviço</title>
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
        <?php if($row_S['namePjEm'] != NULL){
            echo "A Empresa ".$row_S['namePjEm'];
        }else{
            echo "O profissional ".$row_S['nome'];
        }?>

        <?php if($row_S['cnpj'] != NULL){
            echo ", de CNPJ de nº ".$row_S['cnpj'];
        }else{
            echo ", de CPF de nº ".$row_S['CPF'];
        }?>
             declara que prestou serviço de <?php echo $row_S['descricao']?>, para o contratante <?php echo $row_S['nome_Contratante']?>, com CPF/CNPJ de nº <?php echo $row_S['cpf_Cnpj']?>, no período de <?php echo $intervalo->d ?> dias, entre <?php echo date('d/m/Y',strtotime($row_S['data_Inicio']))." até ".date('d/m/Y',strtotime($row_S['data_Final'])) ?> no valor mensal de $ <?php echo $row_S['quantidade_Mensal']?> reais.
        </p>
        <p>
            Declara, ainda, que todos os serviços abaixo foram executados com sucesso:
                
        </p>
        <p>
            <?php echo $row_S['lista_Atividade']?>.
        </p>
    </section>
    <section class="sectionText">    
        <p>
            O contratado afirma que garante <?php echo $row_S['garantia']?> dias de garantia, a contar a partir desta data.
        </p>
    </section>
    <footer class="sectionText">
        <p>
            Esta declaração confirma que todas as informações prestadas são verdadeiras.
        </p>
        <p><?php echo $row_S['cidade']." - ".$row_S['estado'].", ".date('d/m/Y',strtotime($row_S['data_S']))?></p>        
        <p> 
            Assinatura do/a declarante e carimbo da empresa <br>
            CPF do/a declarante:<?php echo $row_S['CPF']?>
        </p>
    </footer>     
</body>
</html>

<!--http://localhost/projetofinal/WEBII/DocumentExprezz/pdf/autonomoPdf.php-->