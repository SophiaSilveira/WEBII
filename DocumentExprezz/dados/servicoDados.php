<?php 
    session_start();
    ob_start();
	include '../connection.php';
    $tagForm="<form action='#' method='post'>";

?>

<html>
<head>
    <meta charset="UTF-8">
    <title>Prestação de Serviço dados</title>
    <link rel="stylesheet" href="estilo.css">       
    </head>
   
    <body>
	<?php
        
		$sql="SELECT s.id_S, s.descricao, s.nome_Contratante, s.cpf_Cnpj, s.data_Inicio, s.data_Final, 
		s.quantidade_Mensal, s.lista_Atividade, s.garantia, s.data_S, s.CPF_U 
        FROM servico s
        left join usuario u on u.CPF = s.CPF_U 
        WHERE s.CPF_U = '".$_SESSION['CPF']."'";
		$resultado=$conn->query($sql); 

		if(($resultado) AND ($resultado->rowCount() != 0)){
			$tabela=$resultado->fetchAll(PDO::FETCH_ASSOC);
			?>
			<table border=1>
			<tr>
				<th>ID</th>	
				<th>Descrição</th>	
				<th>Nome Contratante</th>
				<th>CPF/CNPJ Contratante</th>
				<th>Data Inicio</th>
				<th>Data Final</th>
				<th>Recebido</th>
				<th>Lista Atividade</th>
				<th>Garantia</th>
				<th>Data Documento</th>
				<th>CPF Usuario</th>
				<th>Alterar</th>
				<th>Excluir</th>	
				<th>PDF</th>
				
			</tr>
			<?php
			foreach($tabela as $linha){
				echo "<tr>";
				foreach($linha as $coluna){
					echo "<td>".$coluna."</td>";
				}
				echo "<td>";
				echo $tagForm;
				echo "<input hidden type='text' name='id' value='".$linha['id_S']."'>"; 
				echo "<input type='submit' name='alterar' value='Alterar'>";
				echo "</form>";
				echo "</td>";
				
				echo "<td>";
				echo $tagForm;
				echo "<input hidden type='text' name='id' value='".$linha['id_S']."'>"; 
				echo "<input type='submit' name='excluir' value='Excluir'>";
				echo "</form>";
				echo "</td>";

				echo "<td>";
				echo $tagForm;
				echo "<input hidden type='text' name='id' value='".$linha['id_S']."'>"; 
				echo "<input type='submit' name='pdf' value='PDF'>";
				echo "</form>";
				echo "</td>";
				echo "</tr>";

			}
		}else{
			echo "Você não possui dados <br>";
			echo "Vá cadastrar os documentos VAGABUNDO!";
		}
		echo "</table>";
		
	?>
<?php
if(isset($_POST['pdf'])){
	$_SESSION['id_S'] = $_POST['id'];
	
	if(isset($_SESSION['id_S'])){
		//header('Location:../pdf.php');
		//header('Window-target:../index.php#teste');
		//header('Location:../index.php');
		
		echo "<script>window.open('../pdfServico.php', '_blank')</script>";
	}	
 }
 if(isset($_POST['excluir'])){
	$id=$_POST['id'];
	$sql="DELETE FROM servico WHERE  id_S= :id";
	$stm=$conn->prepare($sql);
	$stm->bindParam(':id',$id);
	$resultado=$stm->execute();
	if($resultado==false){
		var_dump($stm->errorInfo());
	}else{
		header('Location: servicoDados.php');
	}
 }
 if(isset($_POST['alterar'])){
	$id=$_POST['id'];
	$sql="SELECT id_S, descricao, nome_Contratante, cpf_Cnpj, data_Inicio, data_Final, 
	quantidade_Mensal, lista_Atividade, garantia, data_S, CPF_U 
		from servico where id_S='".$id."'";
	$resultado=$conn->query($sql);
	$tabela=$resultado->fetchAll(PDO::FETCH_ASSOC);
	foreach($tabela as $linha){
		echo $tagForm;
		echo "<input type='text' name='descricao' value=".$linha['descricao'].">";
		echo "<input type='text' name='nome_Contratante' value=".$linha['nome_Contratante'].">";
        echo "<input type='text' name='cpf_Cnpj' value=".$linha['cpf_Cnpj'].">";
		echo "<input type='date' name='data_Inicio' value=".$linha['data_Inicio'].">";
		echo "<input type='date' name='data_Final' value=".$linha['data_Final'].">";
        echo "<input type='text' name='quantidade_Mensal' value=".$linha['quantidade_Mensal'].">";
		echo "<input type='text' name='lista_Atividade' value=".$linha['lista_Atividade'].">";
		echo "<input type='text' name='garantia' value=".$linha['garantia'].">";
        echo "<input type='date' name='data_S' value=".$linha['data_S'].">";
		echo "<input hidden type='text' name='id_S' value=".$linha['id_S'].">";
		echo "<input type='submit' name='confirmar' value='Confirmar'>";
		echo "</form>";
	}

 }
 if(isset($_POST['confirmar'])){
    $id_S = $_POST['id_S'];
	$descricao=$_POST['descricao'];
	$nome_Contratante=$_POST['nome_Contratante'];
	$cpf_Cnpj=$_POST['cpf_Cnpj'];
	$data_Inicio=$_POST['data_Inicio'];
	$data_Final=$_POST['data_Final'];
	$quantidade_Mensal=$_POST['quantidade_Mensal'];
	$lista_Atividade=$_POST['lista_Atividade'];
	$garantia=$_POST['garantia'];
	$data_S=$_POST['data_S'];
	
	$sql="UPDATE servico SET 
    descricao=:descricao, nome_Contratante=:nome_Contratante, cpf_Cnpj=:cpf_Cnpj, data_Inicio=:data_Inicio,
	 data_Final=:data_Final, quantidade_Mensal=:quantidade_Mensal, lista_Atividade=:lista_Atividade,
	  garantia=:garantia, data_S=:data_S
			WHERE id_S='".$id_S."'";
	$stmt=$conn->prepare($sql);
	$stmt->bindParam(':descricao',$descricao,PDO::PARAM_STR);
	$stmt->bindParam(':nome_Contratante',$nome_Contratante,PDO::PARAM_STR);
    $stmt->bindParam(':cpf_Cnpj',$cpf_Cnpj,PDO::PARAM_STR);
	$stmt->bindParam(':data_Inicio',$data_Inicio,PDO::PARAM_STR);
	$stmt->bindParam(':data_Final',$data_Final,PDO::PARAM_STR);
    $stmt->bindParam(':quantidade_Mensal',$quantidade_Mensal,PDO::PARAM_STR);
	$stmt->bindParam(':lista_Atividade',$lista_Atividade,PDO::PARAM_STR);
	$stmt->bindParam(':garantia',$garantia,PDO::PARAM_STR);
    $stmt->bindParam(':data_S',$data_S,PDO::PARAM_STR);
	$resultado=$stmt->execute();
	if(!$resultado){
		var_dump($stmt->errorInfo());
	}else{
		header('Location: servicoDados.php');
	}
 }
?>



</body>
</html>