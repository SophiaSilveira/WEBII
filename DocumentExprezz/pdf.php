<?php 
    //autoload do composer
    require __DIR__.'/vendor/autoload.php';

    use Dompdf\Dompdf;
    //use Dompdf\Options;

    //instancia de options
    //$options = new Options();
    //$options->setChroot(__DIR__);
    //$options->setIsRemoteEnabled(true);

    //instancia de dompdf
    $dompdf = new Dompdf();


    //carrega o html para dentro da classe
    //$dompdf->loadhtml('');
    //$dompdf->loadPhpFile(__DIR__.'/arquivo.php');

    //Passando o arquivo.php para o html, ai nao precisamos do arquivo.html
    //fazer uma condição para passar o $html
    //if(isset($_POST['Salvar'])){
    
        //$html = file_get_contents('arquivo.php');
        //$dompdf->loadHtml($html); 
    //}

    //inserindo o HTML que queremos converter
   //ob_start();
   //require __DIR__ .'../pdf/autonomoPdf.php';
   //$dompdf->loadhtml(ob_get_clean());
    
    //ob_start();
    //require __DIR__ .'../pdf/imovelPdf.php';
    //$dompdf->loadhtml(ob_get_clean());

    ob_start();
    require __DIR__ .'../pdf/servicoPdf.php';
    $dompdf->loadhtml(ob_get_clean());   
      


    //mudança na pagina
    $dompdf->setPaper('A4');
    
    //renderiza o arquivo pdf
    $dompdf->render();
    
    header('content-type: application/pdf');
    echo $dompdf->output();

    //fazer download direto quando abre o arquivo
    //$dompdf->stream('documento-wdev.pdf');

    
?>