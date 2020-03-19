<?php
include("conexion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Datos del dominio</title>

	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style_nav.css" rel="stylesheet">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>


	<style>
		.content {
			margin-top: 80px;
		}
	</style>


</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top">
		<?php include('nav.php');?>
	</nav>
	<div class="container">
		<div class="content">
			<h2>Lista de dominios</h2>
			<hr />
			<form class="form-inline" method="get">
				<div class="form-group">
					<select name="filter" class="form-control" onchange="form.submit()">
						<option value="0">Seleccionar dominio</option>
						<?php $filter = (isset($_GET['filter']) ? strtolower($_GET['filter']) : NULL);  ?>
						<option value="6" <?php if($filter == 'ADR'){ echo 'selected'; } ?>>ADR</option>
						<option value="2" <?php if($filter == 'ALM'){ echo 'selected'; } ?>>ALM</option>
						<option value="23" <?php if($filter == 'Anallytics'){ echo 'selected'; } ?>>Anallytics</option>
						<option value="12" <?php if($filter == 'Canales Digitales para Empresas'){ echo 'selected'; } ?>>Canales Digitales para Empresas</optio>
						<option value="10" <?php if($filter == 'Cliente Persona Natural'){ echo 'selected'; } ?>>Cliente Persona Natural</option>
                        <option value="9" <?php if($filter == 'Clientes Mayorista'){ echo 'selected'; } ?>>Clientes Mayorista</option>
						<option value="21" <?php if($filter == 'Colaboradores'){ echo 'selected'; } ?>>Colaboradores</option>
                        <option value="22" <?php if($filter == 'Contabilidad'){ echo 'selected'; } ?>>Contabilidad</option>
                        <option value="20" <?php if($filter == 'CRM'){ echo 'selected'; } ?>>CRM</option>
                        <option value="13" <?php if($filter == 'Cuentas Corrientes'){ echo 'selected'; } ?>>Cuentas Corrientes</option>
                        <option value="5" <?php if($filter == 'Depositos Minoristas'){ echo 'selected'; } ?>>Depositos Minoristas</option>
                       	<option value="4" <?php if($filter == 'Digitalidad'){ echo 'selected'; } ?>>Digitalidad</option>
                        <option value="17" <?php if($filter == 'Discovery'){ echo 'selected'; } ?>>Discovery</option>
						<option value="8" <?php if($filter == 'Finanzas'){ echo 'selected'; } ?>>Finanzas</option>
						<option value="16" <?php if($filter == 'Hipotecarios'){ echo 'selected'; } ?>>Hipotecarios</option>
						<option value="15" <?php if($filter == 'Planeamiento Minorista'){ echo 'selected'; } ?>>Planeamiento Minorista</option>
						<option value="14" <?php if($filter == 'Productos Crediticios para Empresas'){ echo 'selected'; } ?>>Productos Crediticios para Empresas</option>
						<option value="11" <?php if($filter == 'Productos Transaccionales para Empresas'){ echo 'selected'; } ?>>Productos Transaccionales para Empresas</option>
						<option value="7" <?php if($filter == 'Riesgos de Tesorería'){ echo 'selected'; } ?>>Riesgos de Tesorería</option>
						<option value="18" <?php if($filter == 'Seguros'){ echo 'selected'; } ?>>Seguros</option>
						<option value="3" <?php if($filter == 'Tarjetas'){ echo 'selected'; } ?>>Tarjetas</option>
						<option value="1" <?php if($filter == 'Tesoreria'){ echo 'selected'; } ?>>Tesoreria</option>
						<option value="19" <?php if($filter == 'Vehiculares'){ echo 'selected'; } ?>>Vehiculares</option>	
					</select>
				</div>
			</form>
			<br />
			<div class="table-responsive">
			<table class="table table-striped table-hover">
				<tr>
                   <th>No</th>
                   <th>Fecha</th>
				   <th>Nombre de Dominio</th>
			       <th>Owner</th>
                   <th>Custodio de Información</th>
			       <th>ED identificados</th>
			       <th>EDC identificados</th>
			       <th>EDC en el Catalog</th>
			       <th>EDNC en el Catalog</th>
			       <th>RN Definidas</th>
			       <th>RN Activas </th>
			       <th>RN Desactivadas</th>
			       <th>ED con Traza</th>
			       <th>ED con Traza en el Catalog</th>
				</tr>
				<?php
				
			         if($filter){
					$result = pg_query($dbconn, "SELECT a.*, b.nombreusuario,c.* from dominio  a join usuario b on a.codusuario = b.codusuario join indicador c on a.coddominio = c.coddominio where a.coddominio='$filter' order by c.fecactual");
				 }else{
					$result = pg_query($dbconn, "SELECT a.*, b.nombreusuario,c.* from dominio  a join usuario b on a.codusuario = b.codusuario join indicador c on a.coddominio = c.coddominio order by c.fecactual");
				}
				if(pg_num_rows ($result) == 0){
					echo '<tr><td colspan="8">No hay datos.</td></tr>';
				}else{
					$no = 1;
					while($row = pg_fetch_assoc($result)){
						echo '
						<tr>
							<td>'.$no.'</td>
							<td>'.$row['fecactual'].'</td>
							<td>'.$row['nombredominio'].'</td>
							<td>'.$row['owner'].'</td>
							<td>'.$row['nombreusuario'].'</td>
							<td>'.$row['numedident'].'</td>
							<td>'.$row['numedcident'].'</td>
							<td>'.$row['edccatalog'].'</td>
							<td>'.$row['ednccatalog'].'</td>
							<td>'.$row['rndefinidas'].'</td>
							<td>'.$row['rnimplactejec'].'</td>
							<td>'.$row['rndesact'].'</td>
							<td>'.$row['edtrazacatalog'].'</td>
							<td>'.$row['edtrazafueracatalog'].'</td>
						</tr>
						';
						$no++;
					}
				}
				?>
			</table>
			</div>
		</div>
	</div><center>
	<p>&copy; Sistemas Web <?php echo date("Y");?></p
		</center>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>
