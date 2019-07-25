<?php

include ("cls/clsConexion.php");

$DbConect = new ConexionSQL();

$tabla_cliente = "dialogos_dirigidos";
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
                                    <form action="index.php" method="post">
                                        <td>
                                            <input type="hidden" name="id" value="<?php echo $data['id']; ?>">

                                            <div class="d-flex text-white">
                                                <?php if($data['status']=="N"){ ?>
                                                <div class="p-1"><button type="submit" name="btn" value="activar" class="btn btn-success">🗣️</button></div>
                                                <?php }else{ ?>
                                                <div class="p-1"><button type="submit" name="btn" value="desactivar" class="btn btn-warning">🗣️</button></div>
                                                <?php } ?>
                                                <div class="p-1"><button type="submit" name="btn" value="editar" class="btn btn-primary">📝</button></div>
                                                <div class="p-1"><button type="submit" name="btn" value="X" class="btn btn-danger">✖️</button></div>
                                            </div>

                                        </td>
                                    </form>
                                </tr>
                            <?php
                            }
                        }
                        ?>
                        </tbody>
                    </table>