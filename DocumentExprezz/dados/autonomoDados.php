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
        
		$sql="SELECT a.id_A, a.descriver_Atividade, a.renda_Mensal, a.data_A, a.CPF_U
        FROM autonomo a
        left join usuario u on u.CPF = a.CPF_U 
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
				echo "<input hidden type='text' name='id' value='".$linha['id_A']."'>"; 
				echo "<input type='submit' name='alterar' value='Alterar'>";
				echo "</form>";
				echo "</td>";
				
				echo "<td>";
				echo $tagForm;
				echo "<input hidden type='text' name='id' value='".$linha['id_A']."'>"; 
				echo "<input type='submit' name='excluir' value='Excluir'>";
				echo "</form>";
				echo "</td>";

				echo "<td>";
				echo $tagForm;
				echo "<input hidden type='text' name='id' value='".$linha['id_A']."'>"; 
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
	$_SESSION['id_A'] = $_POST['id'];
	
	if(isset($_SESSION['id_A'])){
		//header('Location:../pdf.php');
		//header('Window-target:../index.php#teste');
		//header('Location:../index.php');
		
		echo "<script>window.open('../pdfAutonomo.php', '_blank')</script>";
	}	
 }
 if(isset($_POST['excluir'])){
	$id=$_POST['id'];
	$sql="DELETE FROM autonomo WHERE  id_A= :id";
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
	$sql="SELECT id_A, descriver_Atividade, renda_Mensal, data_A 
		from autonomo where id_A='".$id."'";
	$resultado=$conn->query($sql);
	$tabela=$resultado->fetchAll(PDO::FETCH_ASSOC);
	foreach($tabela as $linha){
		echo $tagForm;
		echo "<input type='text' name='descriver_Atividade' value=".$linha['descriver_Atividade'].">";
		echo "<input type='text' name='renda_Mensal' value=".$linha['renda_Mensal'].">";
        echo "<input type='text' name='data_A' value=".$linha['data_A'].">";
		echo "<input hidden type='text' name='id_A' value=".$linha['id_A'].">";
		echo "<input type='submit' name='confirmar' value='Confirmar'>";
		echo "</form>";
	}

 }
 if(isset($_POST['confirmar'])){
    $id_A = $_POST['id_A'];
	$descriver_Atividade=$_POST['descriver_Atividade'];
	$renda_Mensal=$_POST['renda_Mensal'];
	$data_A=$_POST['data_A'];
	
	$sql="UPDATE autonomo SET
    descriver_Atividade=:descriver_Atividade,renda_Mensal=:renda_Mensal,data_A=:data_A
			where id_A = '".$id_A."'";
	$stmt=$conn->prepare($sql);
	$stmt->bindParam(':descriver_Atividade',$descriver_Atividade,PDO::PARAM_STR);
	$stmt->bindParam(':renda_Mensal',$renda_Mensal,PDO::PARAM_STR);
    $stmt->bindParam(':data_A',$data_A,PDO::PARAM_STR);
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