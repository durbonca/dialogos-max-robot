<?php

include ("cls/clsConexion.php");

$DbConect = new ConexionSQL();

$btn=isset($_REQUEST['btn'])?$_REQUEST['btn']:null;

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>tabla</title>
    <link rel="stylesheet" type="text/css" href="css/custom.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="css/chat.css">
</head>


<body class="container-fluid" style="background:rgb(48, 48, 48); color: white;"><br>
    <div class="container-fluid">
        <div class="row">
            <div class="container col-5">
                <div id="crear_frases">
                    <div class="row">
                        <h3>Creación de nuevas frases</h3>
                    </div>
                    <div class="row">
                        <form action="index.php" method="post">
                            <div class="row">
                                <div class="container-fluid form-group">
                                                <div class="row">
                                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                                    <div class="col-2">
                                                        Dialogo
                                                    </div> 
                                                    <div class="col-10">
                                                        <input class="form-control" type="text" name='frase'>
                                                    </div>
                                                </div>
                                </div>
                                <div class="container-fluid form-group">
                                                <div class="row">
                                                    <div class="col-2"><p>Scripts</p></div>
                                                    <div class="col-6">
                                                        <select class="form-control" name='script'>
                                                            <?php 
                                                            $sql = "SELECT id,nombre FROM scripts WHERE status = 'S'";
                                                            $res1 = $DbConect->Consulta($sql);
                                                            if($res1){
                                                                while($opt = $DbConect->ExtraerDatos($res1)){
                                                                    $x= "";
                                                                    if($script==$opt['script']){
                                                                        $x="selected";
                                                                    }
                                                                    ?>
                                                                    
                                                                    <option value="<?php echo $opt['id']; ?>" $x><?php echo $opt['nombre']; ?></option>

                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>

                                                    </div>
                                                    
                                                    <div class="col-4 text-right">    
                                                        <?php  if($btn!="editar"){  ?>

                                                            <button id="boton" class="btn btn-primary" name="btn" value="agregar" type="button">Crear frase</button>
                                                        <?php }else{ ?>
                                                            <button id="boton" class="btn btn-success" name="btn" value="actualizar" type="button">Actualizar frase</button>

                                                        <?php } ?> 
                                                        </div>


                                                    
                                                </div>    
                                </div>

                                

                            </div>                    
                            
                        </form>
                    </div>
                </div>
                <div class="container chat" id="chat">
                    <div class="chatbox overflow-auto" id="chatbox">         
                    </div>
                    <div class="container">
                            <div class="row">
                                <div class="col-10">
                                    <input class="form-control" type="text" name='chat' id="mensaje" value="">
                                </div>
                                <div class="col-2">    
                                    <div class="text-right"><button id="botonchat" class="btn btn-success" name="btn" value="chat" type="button">Chat</button></div>
                                </div>
                            </div>
                    </div> 
                </div>         
            </div>    
            <div class="col-7" style="padding-left: 40px;">
                <h3>Frases actuales</h3>
                <div class="overflow-auto" id="ListaDialogos">
                    
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/functions.js"></script>
</body>

</html>
