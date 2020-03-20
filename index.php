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
		#div1 {
	            margin-left: 50px;
                    overflow:scroll;
     		    height:500px;
     		    width:1000px;
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
			 <form class="form-inline" method="POST" action="">
			      <label>Fecha:</label>
			      <input type="date" class="form-control" placeholder="Start"  name="date1"/>
			      <button class="btn btn-primary" name="search"><span class="glyphicon glyphicon-search"></span></button>
			  </form>
			<br />
			<div class="table-responsive" id="div1">
			<table class="table table-striped table-hover">
				<tr>
                   
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
  if(ISSET($_POST['search'])){
    $date1 = date("Y-m-d", strtotime($_POST['date1']));
    $result = pg_query($dbconn, "SELECT a.*, b.nombreusuario,c.* from dominio  a join usuario b on a.codusuario = b.codusuario join indicador c on a.coddominio = c.coddominio where c.fecactual='$date1' order by c.fecactual");
    if(pg_num_rows ($result)>0){
      while($row = pg_fetch_assoc($result)){
		  echo '
				<tr>
								
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
				</tr>';
        }
    }else{
       echo '<tr><td colspan="8">No hay datos.</td></tr>';
    }
  }else{
    $result = pg_query($dbconn, "SELECT a.*, b.nombreusuario,c.* from dominio  a join usuario b on a.codusuario = b.codusuario join indicador c on a.coddominio = c.coddominio order by c.fecactual");
    while($row = pg_fetch_assoc($result)){
          echo '
				<tr>
								
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
				</tr>';
    }
  }
?>
			</table>
		         <a class="btn btn-success" href="exportarXLS.php">Exportar a Excel</a>
			</div>
		</div>
	</div><center>
	<p>&copy; Sistemas Web <?php echo date("Y");?></p
		</center>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>
