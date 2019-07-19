-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.1.38-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para dbinteligentpos
CREATE DATABASE IF NOT EXISTS `dbinteligentpos` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `dbinteligentpos`;

-- Volcando estructura para tabla dbinteligentpos.dialogos_dirigidos
CREATE TABLE IF NOT EXISTS `dialogos_dirigidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `frase` text NOT NULL,
  `script` int(11) NOT NULL,
  `status` char(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`),
  KEY `script` (`script`),
  CONSTRAINT `fk_dialogos` FOREIGN KEY (`script`) REFERENCES `scripts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COMMENT='Aqui se pondran los dialogos del robot a ser reproducidos por max';

-- Volcando datos para la tabla dbinteligentpos.dialogos_dirigidos: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `dialogos_dirigidos` DISABLE KEYS */;
REPLACE INTO `dialogos_dirigidos` (`id`, `frase`, `script`, `status`) VALUES
	(5, 'Chocar los 5 con el cliente', 3, 'N');
/*!40000 ALTER TABLE `dialogos_dirigidos` ENABLE KEYS */;

-- Volcando estructura para tabla dbinteligentpos.dialogos_dirigidos_resp
CREATE TABLE IF NOT EXISTS `dialogos_dirigidos_resp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `frase` text NOT NULL,
  `script` varchar(50) DEFAULT NULL,
  `status` char(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT COMMENT='Aqui se pondran los dialogos del robot a ser reproducidos por max';

-- Volcando datos para la tabla dbinteligentpos.dialogos_dirigidos_resp: ~20 rows (aproximadamente)
/*!40000 ALTER TABLE `dialogos_dirigidos_resp` DISABLE KEYS */;
REPLACE INTO `dialogos_dirigidos_resp` (`id`, `frase`, `script`, `status`) VALUES
	(1, 'Hola, este dialogo esta guardado en tu base de datos', 'get_hand_boy', 'N'),
	(3, 'Espero te sirva mi aplicacion', 'act_up', 'N'),
	(4, 'Duran es mi hermano del alma', 'act_down', 'N'),
	(5, 'Te estoy escuchando desde base de datos', 'get_five', 'N'),
	(6, 'Quiero nteractuar desde la web Mate 1', 'face', 'N'),
	(7, 'Adios mi amigo', 'get_hand_boy_dr', 'N'),
	(8, 'levanto la mano derecha levemente y la vuelvo a bajar', 'talk1', 'N'),
	(9, 'levante ambas manos levente y las vuelvo a bajar', 'talk3', 'N'),
	(10, 'como mostrando algo con las manos abajo', 'talk5', 'N'),
	(11, 'dame eso por favor', 'talk8', 'N'),
	(12, 'levanto la mano izquierda levemente y la vuelvo a bajar', 'talk7', 'N'),
	(13, 'Agarrar dama con mano izquierda', 'test_hand_left', 'N'),
	(14, 'Sujetar a un niño', 'talk10', 'N'),
	(15, 'Detner patada mano derecha', 'test_hand_right', 'N'),
	(16, 'Mano Izquierda medio levantada', 'talk12', 'N'),
	(17, 'Mano Derecha medio levantada', 'talk13', 'N'),
	(18, 'rotar la cara', 'test_rotate_head', 'N'),
	(19, 'Dar la Mano', 'hello', 'N'),
	(20, 'te lo juro', 'jurar', 'N'),
	(21, 'Chocar los 5 con el cliente', 'get_five', 'N');
/*!40000 ALTER TABLE `dialogos_dirigidos_resp` ENABLE KEYS */;

-- Volcando estructura para tabla dbinteligentpos.scripts
CREATE TABLE IF NOT EXISTS `scripts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `script` varchar(45) NOT NULL,
  `description` text NOT NULL,
  `status` char(1) NOT NULL DEFAULT 'S',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla dbinteligentpos.scripts: ~27 rows (aproximadamente)
/*!40000 ALTER TABLE `scripts` DISABLE KEYS */;
REPLACE INTO `scripts` (`id`, `nombre`, `script`, `description`, `status`) VALUES
	(1, 'bajar torso', 'act_down', 'el robot baja de estatura hasta el minimo despues de moverse, pone los brazos en posicion neutral y alinea el torso verticalmente', 'S'),
	(2, 'subir torso', 'act_up', 'ajusta la altura del robot hasta encontrar un rostro, sube y baja el actuador de la altura', 'S'),
	(3, 'bailar', 'dance', 'hace un baile, usado cuando le piden un baile', 'S'),
	(4, 'girar cabeza', 'face', 'busca un rostro, rota la cabeza del robot, baja y sube el actuador por 25 seg, usado cuando el robot tiene que buscar una cara', 'S'),
	(5, 'chocar los 5', 'get_five', 'levanta el brazo para chocar la mano como gesto, sube la mano por 7 seg y despues la baja', 'S'),
	(6, 'dar la mano a hombre', 'get_hand_boy', 'levanta la mano derecha para dar un apreton de manos por 10 segundos y la vuelve a bajar', 'S'),
	(7, 'dar la mano a mujer', 'get_hand_girl', 'levanta la mano derecha mostrando la palma, espera por 10 seg y luego la vuelve a bajar', 'S'),
	(8, 'apagar', 'shutdown', 'prepara al robot para ser apagado, bajando la estatura al minimo, bajando los brazos, cabeza y el torso a una posicion neutral', 'S'),
	(9, 'posicion de combate', 'karate', 'rapidamente se para en posicion de combate y rota su cabeza, usarlo cuando no este ningun otro script activo y brazos neutral', 'S'),
	(10, 'mirar', 'look', 'realiza un llamado de atencion a su pantalla usando su cabeza y mano derecha, acompañado por la frase MIRA EN MI PANTALLA', 'S'),
	(11, 'factura', 'take check', 'realiza un llamado de atencion a la impresora de recibos, usado normalmente despues de imprimir un recibo', 'S'),
	(12, 'foto', 'take photo', 'realiza un llamado de atencion a su imresora de fotos, usado normalmente despues de imprimir una foto', 'S'),
	(13, 'pensar', 'think', 'apunta a su cabeza y hace el gesto de rescarse, usado regularmente cuando espera una respuesta o tiene mala conexion a internet', 'S'),
	(14, 'que!?', 'wat', 'el robot Dobla el cuerpo como si tratara de escuchar mejor con su oreja. Como si la frase no hubiera sido reconocida y El robot le pide que repita la frase. Utilizado frecuentemente cuando el robot no pudo reconocer una palabra', 'S'),
	(15, 'rascarse', 'scratch', 'el robot se rasca a si mismo, usado normalmente cuando el robot no esta haciendo nada', 'S'),
	(16, 'oh no!', 'oh_no', 'cubre su cara con las palmas de las manos y gira su cabeza, usado frecuentemente en caso de un error', 'S'),
	(17, 'no no!', 'no_no', 'gira su cabeza en expresion de un gesto de NO, para expresar desacuerdo, usado frecuentemente para una respuesta negativa', 'S'),
	(18, 'NO!', 'strong_no', 'cruza los brazos y gira su cabeza, como analogia del no no', 'S'),
	(19, 'ola', 'wave', 'levanta sus brazos como haciendo una ola, , usarlo cuando no este ningun otro script activo y brazos neutral', 'S'),
	(20, 'encojer de hombros', 'hz', 'el robot se encoje de hombros, parecido al QUE!?', 'S'),
	(21, 'de acuerdo', 'agree', 'robot acentua y aplaude con las manos, expresando su acuerdo. Usado para dar una respuesta positiva.', 'S'),
	(22, 'hablar', 'talk1', 'movimientos generales usados mientras el robot esta hablando', 'S'),
	(23, 'hablar', 'talk2', 'movimientos generales usados mientras el robot esta hablando', 'S'),
	(24, 'hablar', 'talk3', 'movimientos generales usados mientras el robot esta hablando', 'S'),
	(25, 'hablar', 'talk4', 'movimientos generales usados mientras el robot esta hablando', 'S'),
	(26, 'hablar', 'talk5', 'movimientos generales usados mientras el robot esta hablando', 'S'),
	(27, 'hablar', 'talk6', 'movimientos generales usados mientras el robot esta hablando', 'S');
/*!40000 ALTER TABLE `scripts` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
