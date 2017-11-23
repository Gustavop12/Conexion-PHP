<?php
	include("Conexion/Conexionbd.php");	
if (!empty($_POST)) {
	$codigo = mysqli_real_scape_string($conexion,$_POST['cod']);
	$asignatura=mysqli_real_scape_string($conexion,$_POST['nom']);
	$nota=mysqli_real_scape_string($conexion,$_POST['nota']);
	$vermaterias="SELECT idasigna,cdasigna,nombasigna,nota From asignaturas where cdasigna ='$codigo' or nombasigna='$asignatura'";
	$existemateria=$conexion->query($vermaterias);
	$filas=$existemateria-> num_rows;
	if ($filas>0){
		echo "<script>
		alert('La Asignatura ya existe');
		window.location='Index.php';
		</script>";
	}else{
		$sqlmateria="INSERT INTO asignaturas(cdasigna,nombasigna,nota) Values('$codigo','$asignatura','$nota')";
		$resultadomateria=$conexion->query($sqlmateria);
		if ($resultadomateria>0) {
			echo "<script>
			alert('Registro Exitoso');
			window.location='Index.php';
			</script>";
		}else{
			echo "<script>
			alert('Error al Registrar');
			window.location='Index.php';
			</script>";
		}
	}
}
$materias="SELECT idasigna,cdasigna,nombasigna,nota From asignaturas";
$resultadomateria=$conexion->query($materias);
?>
<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<head>
	
	<title>Asignaturas</title>
</head>
<body>
	<h3 align="center">Registro de Asiganaturas </h3>
	<form action="<?php $_SERVER["PHP_SELF"]?> "method="POST"> 
			codigo: <input type= "text" name="codigo" placeholder="Cd101"required>
			asignatura: <input type="text" name="nombre" placeholder="Progranacion"required>
			nota: <input type="number" name="nota" placeholder="99"required>
			<input type="submit" name="guardar" value="Guardar">

	</form>
	<hr>

	<h4 align="center">**** Mis Asignaturas **** </h4>
	<table border="1">
		<THEAD>
			<TR>

				<TH>Codigo</TH>
				<th>Asignaturas</th>
				<th>Notas</th>
				<th>Editar</th>
				<th>Eliminar</th>
			</TR>	
		</THEAD>
		<tbody>
				<?php 

					while ($regmateria=$resultadomateria->fetch_array(MYSQLI_BOTH)) {
						echo "<tr>
							<td>".$regmateria['cdasigna']."</td>
						<td>".$regmateria['nombasigna']."</td>
								<td>".$regmateria['nota']."</td>
						</tr>";
		 
					}

				?>
			 

		</tbody>
	</table>
</body>
</html>