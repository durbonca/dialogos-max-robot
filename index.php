<?php
$servidor = "localhost";
$usuario = "root";
$pwd = "";
$dbase = "dbinteligentpos";

$cn = new mysqli($servidor, $usuario, $pwd, $dbase);
if (!$cn) {
    echo "No hay conexion con la base de kdatos";
} 

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>tabla</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <div class="miAlerta alert alert-success" role="alert" id="alert_success"><span>Frase creada correctamente.</span><button type="button" class="close">&times;</button></div>
        <div class="float alert alert-danger" role="alert"><span>Error al crear la frase.</span></div>
        <h1>Creación de nuevas frases</h1>
        <form>
            <div class="form-group">
                <div>
                    <p>Dialogo</p><input class="form-control" type="text">
                </div>
            </div>
            <div class="form-group">
                <div>
                    <select class="form-control">
                        <?php 
                        $sql = "SELECT * FROM scripts WHERE status = 'S'";
                        $res1 = mysqli_query($cn,$sql);
                        if($res1){
                            while($opt = mysqli_fetch_array($res1)){        
                                ?>
                                
                                <option value="<?php echo $opt['script']; ?>"><?php echo $opt['nombre']; ?></option>

                                <?php
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="text-right"><button id="boton" class="btn btn-primary" name="btn" type="button">Crear frase</button></div>
        </form>
    </div>
    <div class="container">
        <h1>Frases actuales</h1>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 10%;">ID</th>
                        <th>Texto</th>
                        <th style="width: 10%;">ACTIVO</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $sql = "SELECT * FROM dialogos_dirigidos WHERE 1";
                $res2 = mysqli_query($cn,$sql);
                if($res2){
                    while($data = mysqli_fetch_array($res2)){
                    ?>
                        <tr>
                            <td><?php echo $data['id'] ?></td>
                            <td><?php echo $data['frase']; ?></td>
                            <td>
                                <?php 

                                ?>
                            </td>
                        </tr>
                    <?php
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/consult.js"></script>
</body>

</html>