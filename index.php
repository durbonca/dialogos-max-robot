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

<body style="background:rgb(48, 48, 48); color: white;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-5">
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
                                                <div class="col-10">
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
                                            </div>    
                            </div>

                        </div>                    
                        <div class="text-right">    
                            <?php  if($btn!="editar"){  ?>
                                <button id="boton" class="btn btn-primary" name="btn" value="agregar" type="submit">Crear frase</button>
                            <?php }else{ ?>
                                <button id="boton" class="btn btn-success" name="btn" value="actualizar" type="submit">Actualizar frase</button>
                            <?php } ?> 
                        </div>
                    </form>
                </div>
                <div class="chatbox overflow-auto" id="chatbox"> 
                        
                </div>
                <div class="container">
                        <div class="row">
                            <div class="col-10">
                                <input class="form-control" type="text" name='chat' id="mensaje" value="">
                            </div>
                            <div class="col-2">    
                                <div class="text-right"><button id="botonchat" class="btn btn-success" name="btn" value="chat" type="submit">Chat</button></div>
                            </div>
                        </div>
                </div>      
            </div>    
            <div class="col-7">
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
                VerLista(p);
                VerChat(p);
            }, 1000);

            var vtn = $(window).height();
            vtn = (vtn * 90) / 100;
            $("#ListaDialogos").css({"height": vtn + 'px'});
            
            alfinal();

            $("#activar").on("click",()=>{
                alert("hola");
            });

            $("#botonchat").click(()=>{
                p = {
                        mensaje: $("#mensaje").val(),
                        btn:'Enviar'
                    };
                VerChat(p);
                alfinal();
                $("#mensaje").val("");
            })

            function alfinal(){
                var altura = 20000;
                $("#chatbox").animate({scrollTop:altura+"px"});
                
            }

            function VerLista(p){
                $.ajax({
                    async:true,
                    type:"POST",
                    data:p,
                    cache: false,
                    success: (data)=> {
                        $("#ListaDialogos").html(data);
                    },
                    error: () =>{
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
                    success: (data) => {
                        $("#chatbox").html(data);
                    },
                    error: () => {
                        $("#chatbox").html("<center><h1>Error al Cargar Lista</h1><center>");
                    },
                    url: './lista_chat.php'
                });
            }


        });  
    </script>
</body>

</html>
