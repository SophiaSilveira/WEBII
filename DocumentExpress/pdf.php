<?php 
    //autoload do composer
    require __DIR__.'/vendor/autoload.php';

    use Dompdf\Dompdf;
    use Dompdf\Options;

    $n = 1;

    //instancia de options
    $options = new Options();
    $options->setChroot(__DIR__);
    $options->setIsRemoteEnabled(true);

    //instancia de dompdf
    $dompdf = new Dompdf($options);


    //carrega o html para dentro da classe
    $dompdf->loadhtml('

    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>WDEV - Arquivo PDF</title>
        <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <div>
    '.$n.'

    </div>
    <h1>WDEV - Arquivo PDF de teste </h1>
    <hr>

    <h2>Imagem</h2>
    <img src="https://i.pinimg.com/originals/6f/35/c9/6f35c90954e9d57a3b18bfefebf220aa.jpg" >
    <hr>

    <h2>Link</h2>
    <a href="https://youtube.com/wdevoficial">Canal do WDEV</a>
    <hr>

    <h2>Lista não ordenada</h2>
    <ul>
        <li>Item 1</li>
        <li>Item 2</li>
        <li>Item 3</li>
        <li>Item 4</li>
    </ul>
    <hr>

    <h2>Lista ordenada</h2>
    <ol>
        <li>Item 1</li>
        <li>Item 2</li>
        <li>Item 3</li>
        <li>Item 4</li>
    </ol>
    <hr>
    
    <h2>Tabela</h2>
    <table>
        <thead>
            <tr>
                <th>Coluna 1</th>
                <th>Coluna 2</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Valor 1</td>
                <td>Valor 2</td>
            </tr>
            <tr>
                <td>Valor 1</td>
                <td>Valor 2</td>
            </tr>
            <tr>
                <td>Valor 1</td>
                <td>Valor 2</td>
            </tr>
            <tr>
                <td>Valor 1</td>
                <td>Valor 2</td>
            </tr>
        </tbody>
    </table>

    <form action="index.php" method="post">
        <input type="submit" value="Salvar" name="Salvar">
    </form>
</body>
</html>
    ');
    //$dompdf->loadPhpFile(__DIR__.'/arquivo.php');

    //Passando o arquivo.php para o html, ai nao precisamos do arquivo.html
    //fazer uma condição para passar o $html
    //if(isset($_POST['Salvar'])){
    
        //$html = file_get_contents('arquivo.php');
        //$dompdf->loadHtml($html); 
    //}

    //inserindo o HTML que queremos converter
    
      


    //mudança na pagina
    $dompdf->setPaper('A4');
    
    //renderiza o arquivo pdf
    $dompdf->render();
    
    header('content-type: application/pdf');
    echo $dompdf->output();

    //fazer download direto quando abre o arquivo
    //$dompdf->stream('documento-wdev.pdf');

    //http://localhost/pdf/index.php
?>