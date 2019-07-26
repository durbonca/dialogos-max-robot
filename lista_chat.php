<?php

include ("cls/clsConexion.php");

$DbConect = new ConexionSQL();
$btn=isset($_REQUEST['btn'])?$_REQUEST['btn']:null;
$mensaje=isset($_REQUEST['mensaje'])?$_REQUEST['mensaje']:null;

if($btn=="Enviar"){
    $sql="INSERT INTO chat (usuario,mensaje) VALUES('Operador','".$mensaje."')";
    $DbConect->Consulta($sql);
    unset($btn);
    unset($mensaje);
}
?>

<div>
    <?php
        $sql = "SELECT c.* FROM chat c WHERE 1";
        $res3 = $DbConect->Consulta($sql);
        if($res3){
            while($data = $DbConect->ExtraerDatos($res3)){
                if($data['usuario']=="Max"){
                    ?>
                        <div class="chatbox mensage left row col-md-10">
                            <div class="col-md-2">
                                <img class="chatbox img left" src="images/usuarios.png" alt="avatarUser">
                            </div>
                            <div class="col-md-10" >
                                <?php echo $data['mensaje']; ?><br>
                                <span class="time-left"> 11:00</span>
                            </div>
                        </div>
                    <?php
                }
                if($data['usuario']=="Operador"){
                    ?>
                        <div class="chatbox mensage right row col-md-10" style="display: flex; justify-content: flex-end">
                            <div class="col-md-10 text-right">
                                <?php echo $data['mensaje']; ?><br>
                                <span class="time-right"> 11:02</span>    
                            </div>
                            <div class="col-md-2">
                                <img class="chatbox img right" src="images/pbot.png" alt="AvatarRobot">
                            </div>
                        </div>
                    <?php
                }
            }
        }
        ?>
</div>
