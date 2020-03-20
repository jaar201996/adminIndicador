<?php
  header('Content-type:application/xls');
  header('Content-Disposition: attachment; filename=usuarios.xls');
  include("conexion.php");
  $sql = pg_query($dbconn, "SELECT a.*, b.nombreusuario,c.* from dominio  a join usuario b on a.codusuario = b.codusuario join indicador c on a.coddominio = c.coddominio order by c.fecactual");
?>


<table order="1">
        <tr>
             <th>Fecha</th>
             <th>Owner</th>
             <th>Custodio de Informacion</th>
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
           while($row = pg_fetch_assoc($sql)){
        ?>
        <tr>
              <td><?php echo $row['fecactual']; ?></td>
              <td><?php echo $row['nombredominio']; ?></td>
              <td><?php echo $row['owner']; ?></td>
              <td><?php echo $row['nombreusuario']; ?></td>
              <td><?php echo $row['numedident']; ?></td>
              <td><?php echo $row['edccatalog']; ?></td>
              <td><?php echo $row['ednccatalog']; ?></td>
              <td><?php echo $row['rndefinidas']; ?></td>
              <td><?php echo $row['rnimplactejec']; ?></td>
              <td><?php echo $row['rndesact']; ?></td>
              <td><?php echo $row['edtrazacatalog']; ?></td>
              <td><?php echo $row['edtrazafueracatalog']; ?></td>
        </tr> 
        <?php
          }
        ?>
</table>
