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
                                                        <input class="form-control" type="text" name='frase' value="<?php echo $frase; ?>">
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
    <script type="text/javascript">
        $(document).ready(function(){
            var p={};
            setInterval(function(){ 
                VerLista();
                VerChat();
            }, 1000);

            var vtn = $(window).height();
            vtn = (vtn * 85) / 100;
            $("#ListaDialogos").css({"height": vtn + 'px'});

            var vtn_crearFrases = $(window).height();
            vtn_crearFrases = (vtn * 30) / 100;
            $("#crear_frases").css({"height": vtn_crearFrases + 'px'});

            var vtn_chatbox = $(window).height();
            vtn_chatbox = (vtn * 80) / 100;
            $("#chatbox").css({"height": vtn_chatbox + 'px'});


            $("#botonchat").click(()=>{
                p = {
                        mensaje: $("#mensaje").val(),
                        btn:'Enviar'
                    };
                    VerChat(p);
            })

            function VerLista(){
                $.ajax({
                    async:true,
                    type:"POST",
                    cache: false,
                    success: function (data) {
                        $("#ListaDialogos").html(data);
                    },
                    error: function() {
                        $("#ListaDialogos").html("<center><h1>Error al Cargar Lista</h1><center>");
                    },
                    url: './lista_dialogos.php'
                });
            }

            function VerChat(p){
                $.ajax({
                    async:true,
                    type:"POST",
                    data:p,
                    cache: false,
                    success: function (data) {
                        $("#chatbox").html(data);
                    },
                    error: function() {
                        $("#chatbox").html("<center><h1>Error al Cargar Lista</h1><center>");
                    },
                    url: './lista_chat.php'
                });
            }

        });  
    </script>
</body>

</html>
