<?php 
    session_start();
    ob_start();
    include 'Connection.php';

    $query_I = "SELECT i.id_I, i.data_I, u.nome, u.CPF FROM imovel i 
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
    <title>Declaração de Autonomo</title>
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
            Eu <?php echo $row_I['nome']?>__________________________________________________________________ residente à
            _________________________________________________________, nº _______
            complemento___________, Bairro ___________________, município de ________________, RG
            n°__________________,CPF n° <?php echo $row_I['CPF']?>.
            DECLARO para os devidos fins, que possuo a cerca de________ anos a posse contínua
            e incontestável do imóvel acima referido, tendo constituído moradia, e sendo esta
            posse mansa e pacífica, nos termos da legislação pertinente. Declaro ainda, sob as
            penas da Lei, que não está em andamento nenhuma ação judicial tendo por objeto
            a posse do imóvel acima referido (demarcação, divisão, retificação de área, registro
            ou outros). 
        </p>
        <p class="paragraphTree"> 
            Viçosa, _______ de _______________de _____.
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