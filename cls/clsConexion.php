<?php
class ConexionSQL {

    private $servidor;
    private $usuarios;
    private $pwd;
    private $conexion;
    private $manejador;
    private $dbase;

    function __construct ($servidor="localhost",$usuarios="root",$pwd="",$conexion=""){    
        $this->conexion = $conexion;
        $this->servidor = $servidor;
        $this->usuarios = $usuarios;
        $this->pwd = $pwd;
        $this->dbase = "dbinteligentpos";
        $this->manejador = "Mysqli";
    }

    public function Consulta($sql) {
        
        if ($this->manejador == "Mysql") {
            $this->conexion = mysql_connect($this->servidor, $this->usuarios, $this->pwd);
            if (!$this->conexion) {
                return false;
            } else {
                mysql_select_db($this->dbase, $this->conexion);
            }
            $resultado = mysql_query($sql, $this->conexion);
            if (mysql_error()) {
                echo "<script>alert('".mysql_error()."');</script>";
            }
        }
        if ($this->manejador == "MariaDB") {
            $this->conexion = new mysqli($this->servidor, $this->usuarios, $this->pwd, $this->dbase);
            $resultado = mysqli_query($this->conexion, $sql);
        }
        if ($this->manejador == "Mysqli") {
            $this->conexion = new mysqli($this->servidor, $this->usuarios, $this->pwd, $this->dbase);
            $resultado = mysqli_query($this->conexion, $sql);
        }

        if (!$resultado) {
            return false;
        } else {
            return $resultado;
        }
    }

    public function ExtraerDatos($res) {
        if ($this->manejador == "Mysql") {
            $d = mysql_fetch_array($res);
        }
        if ($this->manejador == "MariaDB") {
            $d = mysqli_fetch_array($res);
        }
        if ($this->manejador == "Mysqli") {
            $d = mysqli_fetch_array($res);
        }
        if (!$d) {
            return FALSE;
        } else {
            return $d;
        }
    }

    public function nroreg($res) {
        if ($this->manejador == "Mysql") {
            $c = mysql_num_rows($res);
        }
        if ($this->manejador == "Mysqli") {
            $c = mysqli_num_rows($res);
        }
        if ($this->manejador == "MariaDB") {
            $c = mysqli_num_rows($res);
        }
        if (!$c) {
            return false;
        } else {
            return $c;
        }
    }

    public function FilasAfectadas() {
        if ($this->manejador == "Mysql") {
            $d = mysql_affected_rows();
        }
        if ($this->manejador == "MariaDB") {
            $d = mysqli_affected_rows($this->conexion);
        }
        if ($this->manejador == "Mysqli") {
            $d = mysqli_affected_rows($this->conexion);
        }
        if (!$d) {
            return FALSE;
        } else {
            return $d;
        }
    }

}