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
        if($res3){
            echo "hay frases activas";
            ?>
                <div class="miAlerta alert alert-success" role="alert" id="alert_success"><span>Frase creada correctamente.</span><button type="button" class="close">&times;</button></div>
            <?php
        }else{
            ?>
                <div class="float alert alert-danger" role="alert"><span>Error al crear la frase.</span></div>
            <?php
        }    
        break;
    case 'editar':
        $sql = "SELECT * FROM ".$tabla_cliente." WHERE id = '".$id."'";
        $res3 = $DbConect->Consulta($sql);
        $form = $DbConect->ExtraerDatos($res3);
        $frase = $form['frase'];
        $script = $form['script'];

        break;

    case 'actualizar':
        $sql = "UPDATE ".$tabla_cliente." SET frase='".$frase."', script=".$script." WHERE id='".$id."'";
        $res3 = $DbConect->Consulta($sql);
        if($res3){
            $frase='';
            $script='';
            echo "Actualizado con exito";
        ?>
            <div class="miAlerta alert alert-success" role="alert" id="alert_warning"><span>Frase Actualizada Correctamente.</span><button type="button" class="close">&times;</button></div>
        <?php
        }else{
            ?>
                <div class="float alert alert-danger" role="alert"><span>Error al Actualizar Frase.</span></div>
            <?php
        }

        break;
    case 'X':
        $sql = "DELETE FROM ".$tabla_cliente." WHERE id='".$id;
        $res3 = $DbConect->Consulta($sql);
        
        if($DbConect->FilasAfectadas() > 0){
            ?>
                <div class="miAlerta alert alert-success" role="alert" id="alert_warning"><span>Frase Eliminada.</span><button type="button" class="close">&times;</button></div>
            <?php
        }else{
            ?>
                <div class="float alert alert-danger" role="alert"><span>Error al eliminar la frase.</span></div>
            <?php
        }    
        break;
    
    case 'activar':
        $sql = "SELECT * FROM ".$tabla_cliente." WHERE status='S'";
        $res3 = $DbConect->Consulta($sql);
        if( $DbConect->nroreg($res3) > 0){
            echo "hay frases activas por lo que no se puede activar dos al mismo tiempo";

            ?>
                <div class="miAlerta alert alert-danger" role="alert" id="alert_warning"><span>Hay Frases Activas aun no se puede activar dos... </span><button type="button" class="close">&times;</button></div>
            <?php
        }else{
            $sql = "UPDATE ".$tabla_cliente." SET status='S' WHERE id = '".$id;
            $res3 = $DbConect->Consulta($sql);
            if($res3){
                echo "Actulizado con exito";
            ?>
                <div class="miAlerta alert alert-success" role="alert" id="alert_warning"><span>Frase Activada Correctamente.</span><button type="button" class="close">&times;</button></div>
            <?php
            }else{
                ?>
                    <div class="float alert alert-danger" role="alert"><span>Error al Activar Frase.</span></div>
                <?php
            }   
        }    
        break;
    case 'desactivar':
        $sql = "UPDATE ".$tabla_cliente." SET status='N' WHERE id = ".$id;
        $res3 = $DbConect->Consulta($sql);
        if($DbConect->FilasAfectadas()>0){
            echo "Actualizado con exito";
            ?>
                <div class="miAlerta alert alert-success" role="alert" id="alert_warning"><span>Frase Desactivada Correctamente.</span><button type="button" class="close">&times;</button></div>
            <?php
        }else{
            ?>
                <div class="float alert alert-danger" role="alert"><span>Error al Desactivar Frase.</span></div>
            <?php
        }    
        break;
    default:
        # code...
        break;
}

?>
<table class="table-sm">
                        <thead>
                            <tr>
                                <th style="width: 10%;">ID</th>
                                <th>FRASE</th>
                                <th>ACCION</th>
                                <th style="width: 10%;">ACTIVO</th>
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
                                        <td>
                                            <div class="d-flex text-white">
                                                <?php if($data['status']=="N"){ ?>
                                                <div class="p-1"><button type="button" id="a<?php echo $data['id']; ?>" name="btn" value="activar" class="btn btn-success activar">🗣️</button></div>
                                                <?php }else{ ?>
                                                <div class="p-1"><button type="button" id="d<?php echo $data['id']; ?>" name="btn" value="desactivar" class="btn btn-warning desactivar">🗣️</button></div>
                                                <?php } ?>
                                                <div class="p-1"><button type="button" id="e<?php echo $data['id']; ?>" name="btn" value="editar" class="btn btn-primary editar">📝</button></div>
                                                <div class="p-1"><button type="button" id="x<?php echo $data['id']; ?>" name="btn" value="X" class="btn btn-danger eliminar">✖️</button></div>
                                            </div>

                                        </td>
                                </tr>
                            <?php
                            }
                        }
                        ?>
                        </tbody>
                    </table>