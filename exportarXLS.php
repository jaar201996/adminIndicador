<?php
   if(ISSET($_POST['enviar'])){
      header('Content-type:application/xls');
	  header('Content-Disposition: attachment; filename=dominio.xls');
	  include("conexion.php");
	  $date1 = date("Y-m-d", strtotime($_POST['date1']));
	  if('$date1'=='aaaa/mm/dd'){
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
	  }
   }
?>
