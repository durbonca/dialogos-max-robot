<?php

include ("cls/clsConexion.php");

$DbConect = new ConexionSQL();

$tabla_cliente = "dialogos_dirigidos";

$id = isset($_REQUEST['id'])?$_REQUEST['id']:null;
$btn = isset($_REQUEST['btn'])?$_REQUEST['btn']:null;
$frase = isset($_REQUEST['frase'])?$_REQUEST['frase']:null;
$script = isset($_REQUEST['script'])?$_REQUEST['script']:null;

switch ($btn) {
    case 'agregar':
        $sql = "INSERT INTO ".$tabla_cliente." (frase,script) VALUES('".$frase."',".$script.")";
        $res3 = $DbConect->Consulta($sql);
        break;
    case 'editar':
        $sql = "SELECT * FROM ".$tabla_cliente." WHERE id = ".$id;
        $res3 = $DbConect->Consulta($sql);
        $form = $DbConect->ExtraerDatos($res3);
        $frase = $form['frase'];
        $script = $form['script'];
        break;

    case 'actualizar':
        $sql = "UPDATE ".$tabla_cliente." SET frase='".$frase."', script=".$script." WHERE id=".$id;
        $res3 = $DbConect->Consulta($sql);
        break;

    case 'eliminar':
        $sql = "DELETE FROM ".$tabla_cliente." WHERE id=".$id;
        $res3 = $DbConect->Consulta($sql);
        break;
    
    case 'activar':
        $sql = "SELECT * FROM ".$tabla_cliente." WHERE status='S'";
        $res3 = $DbConect->Consulta($sql);
        if( $DbConect->nroreg($res3) > 0){

        }else{
            $sql = "UPDATE ".$tabla_cliente." SET status='S' WHERE id = ".$id;
            $res3 = $DbConect->Consulta($sql);
        }    
        break;
    case 'desactivar':
        $sql = "UPDATE ".$tabla_cliente." SET status='N' WHERE id = ".$id;
        $res3 = $DbConect->Consulta($sql);
        break;
}

?>
<table class="table-sm" id="dialogos">
	<thead>
		<tr>
			<th style="width: 10%;">ID</th>
			<th>FRASE</th>
			<th>ACCION</th>
			<th style="width: 180px;">ACTIVO</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$sql = "SELECT d.*,s.nombre FROM ".$tabla_cliente." d INNER JOIN scripts s ON d.script=s.id";
		$res2 = $DbConect->Consulta($sql);
		if($res2){
			while($data = $DbConect->ExtraerDatos($res2)){
				?>
				<tr>
					<td><?php echo $data['id'] ?></td>
					<td><?php echo $data['frase']; ?></td>
					<td><?php echo $data['nombre']; ?></td>
					<td >

						<?php if($data['status']=="N"){ ?>
							<button type="button" id="a<?php echo $data['id']; ?>" name="btn" value="activar" class="btn btn-success activar">🗣️</button>
						<?php }else{ ?>
							<button type="button" id="d<?php echo $data['id']; ?>" name="btn" value="desactivar" class="btn btn-warning desactivar">🗣️</button>
						<?php } ?>

						<button type="button" data-frase="<?php echo $data['frase']; ?>" data-script="<?php echo $data['script']; ?>" data-id="<?php echo $data['id']; ?>" name="btn" value="editar" class="btn btn-primary editar">📝</button>

						<button type="button" id="x<?php echo $data['id']; ?>" name="btn" value="X" class="btn btn-danger eliminar">✖️</button>

					</td>
				</tr>
				<?php
			}
		}
		?>
	</tbody>
</table>