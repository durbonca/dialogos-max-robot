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
                            <div class="row">
                                <div class="container-fluid form-group">
                                    <div class="row">
                                        <div class="col-2">
                                            Dialogo
                                        </div> 
                                        <div class="col-10">
                                            <input class="form-control" type="text" name='frase' id="frase">
                                        </div>
                                    </div>
                                </div>
                                <div class="container-fluid form-group">
                                    <div class="row">
                                        <div class="col-2"><p>Scripts</p></div>
                                        <div class="col-6">
                                            <select class="form-control" name='script' id='optscript'>
                                                <?php 
                                                $sql = "SELECT id,nombre FROM scripts WHERE status = 'S'";
                                                $res1 = $DbConect->Consulta($sql);
                                                if($res1){
                                                    while($opt = $DbConect->ExtraerDatos($res1)){
                                                        ?>
                                                        <option value="<?php echo $opt['id']; ?>"><?php echo $opt['nombre']; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>

                                        </div>

                                        <div class="col-4 text-right">  
                                            <input type="hidden" id="idfrase">  
                                            <button id="agregar" class="btn btn-primary" name="btn" value="agregar" type="button">Crear frase</button>
                                            <button id="actualizar" class="btn btn-success" name="btn" value="actualizar" type="button" style="display: none;">Actualizar frase</button>
                                        </div>
                                    </div>    
                                </div>

                                

                            </div>                    
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
    <script src="assets/js/jquery-3.4.1.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/functions.js"></script>

</body>

</html>
