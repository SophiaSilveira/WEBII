<?php 
    session_start();
    ob_start();
    include 'connection.php';

    $query_I = "SELECT u.nome, u.rg, u.CPF, u.rua, u.numero, u.complemento, u.bairro, u.cidade, u.estado, u.cep, 
    i.data_I, i.anos_Inicio, i.anos_Fim
    
    FROM imovel i 
                    left join usuario u on u.CPF = i.CPF_U 
                    WHERE i.id_I = :id"; 
    $result_I = $conn -> prepare($query_I);
    $result_I->bindParam(':id', $_SESSION['id_I'], PDO::PARAM_STR);
    $result_I->execute();
    
    $row_I = $result_I->fetch(PDO::FETCH_ASSOC);
        
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Declaração de Posse de Imóvel</title>
    <style> 
        .navHOne{
            text-align: center;
            margin-top: 90px;
            font-size: 14px;
        }
        .sectionInitial{
            width: 90%;
            text-align: justify;
            display: flex;
            margin-left: auto;
            margin-right: auto;
            font-size: 17px;     
        }
        .paragraphOne{
            line-height: 35px;
            font-size: 17px;  
        }   
        .paragraphTree{
            text-align: right;
            margin-top: 90px;
        }  
        .paragraphFour{
            margin-top: 50px;
            text-align: center;
            line-height: 29px;
        }  


    </style>
</head>
<body>
    <nav class="navHOne">
        <h3> DECLARAÇÃO DE POSSE DE IMÓVEL </h3> 
        <br>
    </nav>
    <section class="sectionInitial">
        <p class="paragraphOne">
            Eu <?php echo $row_I['nome']?> residente do CEP <?php echo $row_I['cep']?>, rua <?php echo $row_I['rua']?>, 
            nº <?php echo $row_I['numero']?>, complemento <?php echo $row_I['complemento']?>, Bairro <?php echo $row_I['bairro']?>, 
            município de <?php echo $row_I['cidade']?>, RG nº <?php echo $row_I['rg']?>, CPF n° <?php echo $row_I['CPF']?>.
            DECLARO para os devidos fins, que possuo a cerca de <?php echo $row_I['anos_Inicio']." até ".$row_I['anos_Fim']?>  anos a posse contínua
            e incontestável do imóvel acima referido, tendo constituído moradia, e sendo esta
            posse mansa e pacífica, nos termos da legislação pertinente. Declaro ainda, sob as
            penas da Lei, que não está em andamento nenhuma ação judicial tendo por objeto
            a posse do imóvel acima referido (demarcação, divisão, retificação de área, registro
            ou outros). 
        </p>
        <p class="paragraphTree"> 
            <?php echo $row_I['cidade']." - ".$row_I['estado'].", ".$row_I['data_I']?>.
        </p>
    </section>
    <footer>    
        <p class="paragraphFour">
            ___________________________________________________________<br>
            Assinatura do Declarante reconhecida em cartório
        </p>
    </footer>    
</body>
</html>

<!--http://localhost/projetofinal/WEBII/DocumentExprezz/pdf/autonomoPdf.php-->