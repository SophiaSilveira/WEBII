<?php 
    session_start();
    ob_start();
	include '../connection.php';
    $tagForm="<form action='#' method='post'>";
?>

<html>
<head>
    <meta charset="UTF-8">
    <title>Corretor</title>
    <link rel="stylesheet" href="estilo.css">       
    </head>
   
    <body>
	<?php
        
		$sql="SELECT i.id_I, i.anos_Inicio, i.anos_Fim, i.data_I, i.CPF_U
        FROM imovel i
        left join usuario u on u.CPF = i.CPF_U 
        WHERE CPF_U = '".$_SESSION['CPF']."'";
		$resultado=$conn->query($sql); 

		if(($resultado) AND ($resultado->rowCount() != 0)){
			$tabela=$resultado->fetchAll(PDO::FETCH_ASSOC);
			?>
			<table border=1>
			<tr>
				<th>CPF</th>	
				<th>Nome</th>
				<th>Nome</th>
				<th>Nome</th>	
				<th>Data de Nascimento</th>	
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
				echo "<input hidden type='text' name='id' value='".$linha['id_I']."'>"; 
				echo "<input type='submit' name='alterar' value='Alterar'>";
				echo "</form>";
				echo "</td>";
				
				echo "<td>";
				echo $tagForm;
				echo "<input hidden type='text' name='id' value='".$linha['id_I']."'>"; 
				echo "<input type='submit' name='excluir' value='Excluir'>";
				echo "</form>";
				echo "</td>";

				echo "<td>";
				echo $tagForm;
				echo "<input hidden type='text' name='id' value='".$linha['id_I']."'>"; 
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
	$_SESSION['id_I'] = $_POST['id'];
	
	if(isset($_SESSION['id_I'])){
		//header('Location:../pdf.php');
		//header('Window-target:../index.php#teste');
		//header('Location:../index.php');
		
		echo "<script>window.open('../pdfAutonomo.php', '_blank')</script>";
	}	
 }
 if(isset($_POST['excluir'])){
	$id=$_POST['id'];
	$sql="DELETE FROM imovel WHERE  id_I= :id";
	$stm=$conn->prepare($sql);
	$stm->bindParam(':id',$id);
	$resultado=$stm->execute();
	if($resultado==false){
		var_dump($stm->errorInfo());
	}else{
		header('Location: autonomoDados.php');
	}
 }
 if(isset($_POST['alterar'])){
	$id=$_POST['id'];
	$sql="SELECT id_I, anos_Inicio, anos_Fim, data_I, CPF_U 
		from imovel where id_I='".$id."'";
	$resultado=$conn->query($sql);
	$tabela=$resultado->fetchAll(PDO::FETCH_ASSOC);
	foreach($tabela as $linha){
		echo $tagForm;
		echo "<input type='text' name='anos_Inicio' value=".$linha['anos_Inicio'].">";
		echo "<input type='text' name='anos_Fim' value=".$linha['anos_Fim'].">";
        echo "<input type='text' name='data_I' value=".$linha['data_I'].">";
		echo "<input hidden type='text' name='id_I' value=".$linha['id_I'].">";
		echo "<input type='submit' name='confirmar' value='Confirmar'>";
		echo "</form>";
	}

 }
 if(isset($_POST['confirmar'])){
    $id_I = $_POST['id_I'];
	$anos_Inicio=$_POST['anos_Inicio'];
	$anos_Fim=$_POST['anos_Fim'];
	$data_I=$_POST['data_I'];
	
	$sql="update imovel set 
    anos_Inicio=:anos_Inicio,anos_Fim=:anos_Fim,data_I=:data_I
			where id_I='".$id_I."'";
	$stmt=$conn->prepare($sql);
	$stmt->bindParam(':anos_Inicio',$anos_Inicio,PDO::PARAM_STR);
	$stmt->bindParam(':anos_Fim',$anos_Fim,PDO::PARAM_STR);
    $stmt->bindParam(':data_I',$data_I,PDO::PARAM_STR);
	$resultado=$stmt->execute();
	if(!$resultado){
		var_dump($stmt->errorInfo());
	}else{
		header('Location: autonomoDados.php');
	}
 }
?>



</body>
</html>