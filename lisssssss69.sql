CREATE DATABASE  IF NOT EXISTS `teckmark` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `teckmark`;
-- MySQL dump 10.13  Distrib 5.6.19, for Win32 (x86)
--
-- Host: localhost    Database: teckmark
-- ------------------------------------------------------
-- Server version	5.6.20-enterprise-commercial-advanced

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `agendas`
--

DROP TABLE IF EXISTS `agendas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `agendas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(45) DEFAULT NULL,
  `asunto` varchar(255) DEFAULT NULL,
  `fecha` varchar(255) DEFAULT NULL,
  `descripcion` text,
  `planificado` text,
  `ubicacion` varchar(255) DEFAULT NULL,
  `archivo` text,
  `usuario_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usuario_id_agendas_idx` (`usuario_id`),
  CONSTRAINT `fk_usuario_id_agendas` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agendas`
--

LOCK TABLES `agendas` WRITE;
/*!40000 ALTER TABLE `agendas` DISABLE KEYS */;
INSERT INTO `agendas` VALUES (1,'Visita','Cotización cortinas Banco Visa','02/06/2017 - 04/06/2017','Cotización cortinas estilo pensionaras . llevar muestrario de materiales y colores','Ing guido Barrientos','Calacoto esq. San Buena ventura agencia 4','Ues_d7JLKz.pdf',1,'2017-06-21 23:05:47','2017-06-21 23:34:42'),(2,'Llamada telefonica','Llamar al contador','21/06/2017 - 21/06/2017','Preguntar sobre los los impuestos','Jose Albornos','',NULL,1,'2017-06-21 23:22:45','2017-06-21 23:34:34'),(3,'Tarea a realizar','Inventariar Nuevo Lote Productos','21/06/2017 - 30/06/2017','Inventariar y asignacion de codigos barra de control al nuevo lote de articulos','Carlos, jose, maria, alberto','Deposito 4',NULL,1,'2017-06-21 23:24:01','2017-06-21 23:34:25'),(4,'Reunión','Planificacion POA 2018','04/07/2017 - 04/07/2017','reunion con todos los socios para planificar poa y nuevos activos','Jose Albornos','Sala de reuniones','UDeY4_Iiys.jpg',1,'2017-06-21 23:25:37','2017-06-26 20:03:16'),(5,'Personal','Cita medida','01/06/2017 - 01/06/2017','Cita medica traumatolo','Dr. Vera,carlos valverde,jose mujica','Hospital San juan de los Sauces',NULL,1,'2017-06-21 23:26:27','2017-06-22 20:17:59');
/*!40000 ALTER TABLE `agendas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `almacenes`
--

DROP TABLE IF EXISTS `almacenes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `almacenes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `ciudad_id` int(11) NOT NULL,
  `registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `estado` tinyint(4) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `sucursal_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sucursal_id_UNIQUE` (`sucursal_id`),
  KEY `fk_ciudad_id_almacenes_idx` (`ciudad_id`),
  KEY `fk_sucursal_id_almacenes_idx` (`sucursal_id`),
  CONSTRAINT `fk_ciudad_id_almacenes` FOREIGN KEY (`ciudad_id`) REFERENCES `ciudades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_sucursal_id_almacenes` FOREIGN KEY (`sucursal_id`) REFERENCES `sucursales` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `almacenes`
--

LOCK TABLES `almacenes` WRITE;
/*!40000 ALTER TABLE `almacenes` DISABLE KEYS */;
INSERT INTO `almacenes` VALUES (1,'Almacen Sucre 1','av. Juana azurduy #324',1,'2017-06-22 14:28:15',1,'2017-06-22 22:28:15','2017-06-22 22:31:22',1),(2,'Almacen Sucre 2','Av. Las americas #145',1,'2017-06-22 14:32:34',1,'2017-06-22 22:32:34','2017-06-22 22:32:34',2);
/*!40000 ALTER TABLE `almacenes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `articulos`
--

DROP TABLE IF EXISTS `articulos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articulos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT '1',
  `registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `codigo` varchar(45) DEFAULT NULL,
  `categoria_articulo_id` int(11) NOT NULL,
  `marca_id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `unidad_id` int(11) NOT NULL,
  `costo` decimal(19,2) DEFAULT '0.00',
  `precio1` decimal(19,2) DEFAULT '0.00',
  `precio2` decimal(19,2) DEFAULT '0.00',
  `precio3` decimal(19,2) DEFAULT '0.00',
  `codigobarra` varchar(45) DEFAULT NULL,
  `stock_min` decimal(19,2) DEFAULT '1.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_categoria_articulo_articulos_idx` (`categoria_articulo_id`),
  KEY `fk_marca_id_articulos_idx` (`marca_id`),
  KEY `fk_material_id_articulos_idx` (`material_id`),
  KEY `fk_medida_id_articulos_idx` (`unidad_id`),
  CONSTRAINT `fk_categoria_articulo_articulos` FOREIGN KEY (`categoria_articulo_id`) REFERENCES `categorias_articulos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_marca_id_articulos` FOREIGN KEY (`marca_id`) REFERENCES `marcas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_material_id_articulos` FOREIGN KEY (`material_id`) REFERENCES `materiales` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_medida_id_articulos` FOREIGN KEY (`unidad_id`) REFERENCES `unidades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articulos`
--

LOCK TABLES `articulos` WRITE;
/*!40000 ALTER TABLE `articulos` DISABLE KEYS */;
INSERT INTO `articulos` VALUES (1,'Tela Batista',1,'2017-06-22 16:44:09','A00001',3,3,5,1,10000000.85,1041.03,13325.66,1040.50,'123',1.00,'2017-06-23 00:44:09','2017-06-30 21:35:52'),(2,'Tela Brocado Larga',1,'2017-06-22 16:46:24','A0002',3,2,2,7,200.00,500.00,450.00,400.00,'456',1.00,'2017-06-23 00:46:24','2017-06-30 21:37:06'),(3,'Tela de Chambray',1,'2017-06-22 16:47:45','A00003',3,6,3,5,120.00,220.00,190.50,170.00,'1ds65123v1sd65f4sdgf7sdg13',1.00,'2017-06-23 00:47:45','2017-06-24 01:38:34');
/*!40000 ALTER TABLE `articulos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categorias_articulos`
--

DROP TABLE IF EXISTS `categorias_articulos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorias_articulos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `estado` tinyint(4) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias_articulos`
--

LOCK TABLES `categorias_articulos` WRITE;
/*!40000 ALTER TABLE `categorias_articulos` DISABLE KEYS */;
INSERT INTO `categorias_articulos` VALUES (1,'Premium','2017-06-21 21:55:46',1,'2017-06-22 05:55:46','2017-06-22 05:55:46'),(2,'Tejido','2017-06-21 21:58:55',0,'2017-06-22 05:58:55','2017-06-27 00:28:54'),(3,'No Tejido','2017-06-21 21:59:06',1,'2017-06-22 05:59:06','2017-06-22 05:59:06'),(4,'Ninguna','2017-06-21 22:07:53',0,'2017-06-22 06:07:53','2017-06-22 10:07:02'),(5,'Simple','2017-06-21 22:11:08',0,'2017-06-22 06:11:08','2017-06-22 10:07:16'),(6,'Verano','2017-06-21 22:11:15',1,'2017-06-22 06:11:15','2017-06-22 06:12:27'),(7,'Invierno','2017-06-21 22:12:17',1,'2017-06-22 06:12:17','2017-06-22 06:12:17'),(8,'Otoño','2017-06-21 22:12:41',1,'2017-06-22 06:12:41','2017-06-22 06:12:41'),(9,'Primavera','2017-06-21 22:12:51',1,'2017-06-22 06:12:51','2017-06-22 06:12:51'),(15,'San Valentin','2017-06-26 16:44:40',1,'2017-06-27 00:44:40','2017-06-27 00:44:40'),(16,'super shore','2017-06-26 22:07:51',1,'2017-06-27 06:07:51','2017-06-27 06:07:51'),(17,'Nova Seda','2017-06-26 22:09:00',1,'2017-06-27 06:09:00','2017-06-27 06:09:00'),(18,'OpenRed','2017-06-26 23:25:31',1,'2017-06-27 07:25:31','2017-06-27 07:25:31');
/*!40000 ALTER TABLE `categorias_articulos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ciudades`
--

DROP TABLE IF EXISTS `ciudades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ciudades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `departamento` varchar(255) DEFAULT NULL,
  `registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `estado` tinyint(4) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ciudades`
--

LOCK TABLES `ciudades` WRITE;
/*!40000 ALTER TABLE `ciudades` DISABLE KEYS */;
INSERT INTO `ciudades` VALUES (1,'Sucre','Chuquisaca','2017-06-22 13:47:34',1,'2017-06-22 21:47:34','2017-06-22 21:47:34'),(2,'Santa Cruz','Santa Cruz de la Sierra','2017-06-22 13:48:45',1,'2017-06-22 21:48:45','2017-06-22 21:48:45'),(3,'El Alto','La Paz','2017-06-22 13:49:05',0,'2017-06-22 21:49:05','2017-06-22 21:50:15'),(4,'La Paz','La Paz','2017-06-22 13:51:10',1,'2017-06-22 21:51:10','2017-06-22 21:51:10'),(5,'Montero','Santa Cruz de la Sierra','2017-06-22 13:51:27',1,'2017-06-22 21:51:27','2017-06-22 21:51:27'),(6,'Cochabamba','Cochabamba','2017-06-22 13:51:44',1,'2017-06-22 21:51:44','2017-06-22 21:51:44'),(7,'Tarija','Tarija','2017-06-22 14:37:54',1,'2017-06-22 22:37:54','2017-06-22 22:37:54'),(8,'Bermejo','Tarija','2017-06-22 14:38:06',1,'2017-06-22 22:38:06','2017-06-22 22:38:06');
/*!40000 ALTER TABLE `ciudades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `razon_social` varchar(255) DEFAULT NULL,
  `nit` varchar(45) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (1,'Open Red','1236547897','78969696','plaza 25 de mayo','email@gmail.com','2017-06-22 17:31:45','2017-06-22 17:31:45'),(2,'Juan Perez','789658745 ','78987878','junin # 488','juan@gmail.com','2017-06-22 17:32:55','2017-06-22 17:32:55'),(3,'Jose Jose','123632365','69698789','arenales # 789','josejose@gmail.com','2017-06-22 17:33:39','2017-06-22 17:33:39'),(4,'Amelia Hurtado','12365456321','78987873','S/N','email2@gmail.com','2017-06-22 17:34:28','2017-06-22 17:34:28'),(5,'Textil Sucre','1212121212','78475825','junin # 789','textilSucre@gmail.com','2017-06-22 17:35:25','2017-06-22 17:35:25'),(6,'Juanita Lopez','12323213654','78965478','S/N','juanita@gmail.com','2017-06-22 17:36:53','2017-06-22 17:36:53'),(7,'empresa Textil','1236545632','784578693','S/N','empresa@gmail.com','2017-06-22 17:37:35','2017-06-22 17:37:35'),(8,'Carlos Cabezas ','123365343','78212354','hernando siles # 789','carlos@gmail.com','2017-06-22 17:38:23','2017-06-22 17:38:23'),(9,'Jose Coronados','121212123','7898975','junin #785','josecoronado@gmail.com','2017-06-22 17:38:44','2017-06-22 18:07:37'),(10,'guido Barrientos','56799778s','78747512','S/N','guido@gmail.com','2017-06-22 17:43:24','2017-06-22 19:27:05'),(11,'Ikarus Inc','56799778','67619','','','2017-06-22 18:20:57','2017-06-22 18:20:57');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `compras`
--

DROP TABLE IF EXISTS `compras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `compras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `codigo` varchar(45) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `sucursal_id` int(11) DEFAULT NULL,
  `almacen_id` int(11) DEFAULT NULL,
  `proveedor_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tipo_compra` varchar(45) DEFAULT NULL,
  `nfactura` varchar(45) DEFAULT NULL,
  `estado` char(1) DEFAULT 'p',
  PRIMARY KEY (`id`),
  KEY `fk_almacen_id_lotes_idx` (`almacen_id`),
  KEY `fk_sucursal_id_lotes_idx` (`sucursal_id`),
  KEY `fk_proveedor_id_lotes_idx` (`proveedor_id`),
  CONSTRAINT `fk_almacen_id_lotes` FOREIGN KEY (`almacen_id`) REFERENCES `almacenes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_proveedor_id_lotes` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_sucursal_id_lotes` FOREIGN KEY (`sucursal_id`) REFERENCES `sucursales` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compras`
--

LOCK TABLES `compras` WRITE;
/*!40000 ALTER TABLE `compras` DISABLE KEYS */;
INSERT INTO `compras` VALUES (1,'2017-07-01 00:21:50','',1,'2017-07-14',2,1,5,'2017-07-01 08:21:50','2017-07-03 08:09:41','Contado','2323','t'),(7,'2017-07-01 03:08:22','',1,'2017-07-25',1,1,7,'2017-07-01 11:08:22','2017-07-03 07:51:58','Contado','125545','t'),(8,'2017-07-01 18:02:42','',1,'2017-07-26',2,1,3,'2017-07-02 02:02:42','2017-07-03 05:16:12','Credito','10202025','t'),(9,'2017-07-01 18:41:21','',1,'2017-07-26',2,1,6,'2017-07-02 02:41:21','2017-07-03 06:44:21','Cheque','','t'),(11,'2017-07-03 00:40:36','',1,'2017-07-23',1,1,3,'2017-07-03 08:40:36','2017-07-03 08:42:15','Credito','','t'),(12,'2017-07-03 00:42:16','',1,'2017-07-13',1,1,1,'2017-07-03 08:42:16','2017-07-03 19:00:44','Contado','','t'),(13,'2017-07-03 11:00:44','',1,'2017-07-03',1,1,2,'2017-07-03 19:00:44','2017-07-03 22:30:10','Credito','','t'),(14,'2017-07-03 14:27:30',NULL,1,NULL,NULL,NULL,NULL,'2017-07-03 22:27:30','2017-07-03 22:27:30',NULL,NULL,'p');
/*!40000 ALTER TABLE `compras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `compras_creditos`
--

DROP TABLE IF EXISTS `compras_creditos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `compras_creditos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `compra_id` int(11) NOT NULL,
  `abono` decimal(19,4) DEFAULT '0.0000',
  `registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `usuario_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_comrpa_id_compras_credito_idx` (`compra_id`),
  KEY `fk_usuario_id_compras_creditos_idx` (`usuario_id`),
  CONSTRAINT `fk_comrpa_id_compras_credito` FOREIGN KEY (`compra_id`) REFERENCES `compras` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_id_compras_creditos` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compras_creditos`
--

LOCK TABLES `compras_creditos` WRITE;
/*!40000 ALTER TABLE `compras_creditos` DISABLE KEYS */;
INSERT INTO `compras_creditos` VALUES (1,13,855.5000,'2017-07-05 02:02:34',1,'2017-07-05 10:02:34','2017-07-05 10:02:34','2017-07-13'),(3,13,100.0000,'2017-07-05 20:59:22',1,'2017-07-06 04:59:22','2017-07-06 04:59:22','2017-07-15');
/*!40000 ALTER TABLE `compras_creditos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cotizaciones_articulos`
--

DROP TABLE IF EXISTS `cotizaciones_articulos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cotizaciones_articulos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `usuario_id` int(11) DEFAULT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `sucursal_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `estado` char(1) DEFAULT 'p',
  PRIMARY KEY (`id`),
  KEY `fk_usuario_id_cotizaciones_idx` (`usuario_id`),
  KEY `fk_sucursal_id_cotizaciones_idx` (`sucursal_id`),
  KEY `fk_cliente_id_cotizaciones_idx` (`cliente_id`),
  CONSTRAINT `fk_cliente_id_cotizaciones` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_sucursal_id_cotizaciones` FOREIGN KEY (`sucursal_id`) REFERENCES `sucursales` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_id_cotizaciones` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cotizaciones_articulos`
--

LOCK TABLES `cotizaciones_articulos` WRITE;
/*!40000 ALTER TABLE `cotizaciones_articulos` DISABLE KEYS */;
/*!40000 ALTER TABLE `cotizaciones_articulos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cotizaciones_productos`
--

DROP TABLE IF EXISTS `cotizaciones_productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cotizaciones_productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `usuario_id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `sucursal_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usuario_id_cotizaciones_productos_idx` (`usuario_id`),
  KEY `fk_cliente_id_cotizaciones_productos_idx` (`cliente_id`),
  KEY `fk_sucursal_id_cotizaciones_productos_idx` (`sucursal_id`),
  CONSTRAINT `fk_cliente_id_cotizaciones_productos` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_sucursal_id_cotizaciones_productos` FOREIGN KEY (`sucursal_id`) REFERENCES `sucursales` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_id_cotizaciones_productos` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cotizaciones_productos`
--

LOCK TABLES `cotizaciones_productos` WRITE;
/*!40000 ALTER TABLE `cotizaciones_productos` DISABLE KEYS */;
/*!40000 ALTER TABLE `cotizaciones_productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_cotizaciones_productos`
--

DROP TABLE IF EXISTS `detalle_cotizaciones_productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalle_cotizaciones_productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cotizacion_producto_id` int(11) DEFAULT NULL,
  `registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `productos_base_id` int(11) DEFAULT NULL,
  `cantidad` float DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `sucursal_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `material_id` int(11) DEFAULT NULL,
  `talla_id` int(11) DEFAULT NULL,
  `descripcion` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cotizacion_producto_id_detalle_cotizaciones_productos_idx` (`cotizacion_producto_id`),
  KEY `fk_sucursal_id_detalle_cotizaciones_productos_idx` (`sucursal_id`),
  KEY `fk_usuario_id_detalle_Cotizaciones_productos_idx` (`usuario_id`),
  KEY `fk_material_id_detalle_cotizaciones_productos_idx` (`material_id`),
  KEY `fk_talla_id_detalle_cotizaciones_productos_idx` (`talla_id`),
  KEY `fk_detalle_productos_base_id_detalle_cotizaciones_productos_idx` (`productos_base_id`),
  CONSTRAINT `fk_cotizacion_producto_id_detalle_cotizaciones_productos` FOREIGN KEY (`cotizacion_producto_id`) REFERENCES `cotizaciones_productos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_detalle_productos_base_id_detalle_cotizaciones_productos` FOREIGN KEY (`productos_base_id`) REFERENCES `productos_base` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_material_id_detalle_cotizaciones_productos` FOREIGN KEY (`material_id`) REFERENCES `materiales` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_sucursal_id_detalle_cotizaciones_productos` FOREIGN KEY (`sucursal_id`) REFERENCES `sucursales` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_talla_id_detalle_cotizaciones_productos` FOREIGN KEY (`talla_id`) REFERENCES `tallas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_id_detalle_Cotizaciones_productos` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_cotizaciones_productos`
--

LOCK TABLES `detalle_cotizaciones_productos` WRITE;
/*!40000 ALTER TABLE `detalle_cotizaciones_productos` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalle_cotizaciones_productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_productos_base`
--

DROP TABLE IF EXISTS `detalle_productos_base`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalle_productos_base` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_base_id` int(11) NOT NULL,
  `talla_id` int(11) DEFAULT NULL,
  `material_id` int(11) DEFAULT NULL,
  `precio` decimal(19,4) DEFAULT '0.0000',
  `costo` decimal(19,4) DEFAULT '0.0000',
  `registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `usuario_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_producto_id_detalle_productos_base_idx` (`producto_base_id`),
  KEY `fk_talla_id_detalles_productos_base_idx` (`talla_id`),
  KEY `fk_material_id_detalles_productos_base_idx` (`material_id`),
  KEY `fk_usuario_id_detalles_productos_base_idx` (`usuario_id`),
  CONSTRAINT `fk_material_id_detalles_productos_base` FOREIGN KEY (`material_id`) REFERENCES `materiales` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_producto_id_detalle_productos_base` FOREIGN KEY (`producto_base_id`) REFERENCES `productos_base` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_talla_id_detalles_productos_base` FOREIGN KEY (`talla_id`) REFERENCES `tallas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_id_detalles_productos_base` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_productos_base`
--

LOCK TABLES `detalle_productos_base` WRITE;
/*!40000 ALTER TABLE `detalle_productos_base` DISABLE KEYS */;
INSERT INTO `detalle_productos_base` VALUES (1,16,2,5,170.0000,56.8500,'2017-06-26 20:20:18',2,'2017-06-27 04:20:18','2017-06-27 07:21:10'),(2,2,2,6,250.0000,140.4500,'2017-06-26 20:23:50',2,'2017-06-27 04:23:50','2017-06-27 07:19:12'),(3,16,3,5,150.0000,46.1600,'2017-06-26 20:24:40',2,'2017-06-27 04:24:40','2017-06-27 07:21:45'),(4,4,6,4,90.0000,20.6800,'2017-06-26 20:29:13',2,'2017-06-27 04:29:13','2017-06-27 07:19:32'),(5,16,1,3,180.0000,65.2300,'2017-06-26 20:29:52',2,'2017-06-27 04:29:52','2017-06-27 07:20:29'),(6,11,4,1,110.0000,48.1200,'2017-06-26 21:54:38',2,'2017-06-27 05:54:38','2017-06-27 07:19:52'),(7,10,3,6,60.0000,23.5600,'2017-06-26 21:56:42',2,'2017-06-27 05:56:42','2017-06-27 05:56:42');
/*!40000 ALTER TABLE `detalle_productos_base` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalles_cotizaciones`
--

DROP TABLE IF EXISTS `detalles_cotizaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalles_cotizaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cotizacion_id` int(11) DEFAULT NULL,
  `registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `articulo_id` int(11) DEFAULT NULL,
  `cantidad` decimal(19,4) DEFAULT NULL,
  `precio` decimal(19,4) DEFAULT NULL,
  `sucursal_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_articulo_id_detalles_cotizaciones_idx` (`articulo_id`),
  KEY `fk_sucursal_id_detalles_cotizaciones_idx` (`sucursal_id`),
  KEY `fk_usuario_id_detalles_cotizaciones_idx` (`usuario_id`),
  KEY `fk_cotizacion_id_detalles_cotizaciones_idx` (`cotizacion_id`),
  CONSTRAINT `fk_articulo_id_detalles_cotizaciones` FOREIGN KEY (`articulo_id`) REFERENCES `articulos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_cotizacion_id_detalles_cotizaciones` FOREIGN KEY (`cotizacion_id`) REFERENCES `cotizaciones_articulos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_sucursal_id_detalles_cotizaciones` FOREIGN KEY (`sucursal_id`) REFERENCES `sucursales` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_id_detalles_cotizaciones` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalles_cotizaciones`
--

LOCK TABLES `detalles_cotizaciones` WRITE;
/*!40000 ALTER TABLE `detalles_cotizaciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalles_cotizaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalles_producciones`
--

DROP TABLE IF EXISTS `detalles_producciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalles_producciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `articulo_id` int(11) NOT NULL,
  `cantidad` decimal(19,4) DEFAULT NULL,
  `registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `usuario_id` int(11) NOT NULL,
  `sucursal_id` int(11) DEFAULT NULL,
  `produccion_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `precio` decimal(19,4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_articulo_id_detalles_producciones_idx` (`articulo_id`),
  KEY `fk_usuario_id_detalles_producciones_idx` (`usuario_id`),
  KEY `fk_sucursal_id_detalles_producciones_idx` (`sucursal_id`),
  KEY `fk_proudccion_id_detalles_producciones_idx` (`produccion_id`),
  CONSTRAINT `fk_articulo_id_detalles_producciones` FOREIGN KEY (`articulo_id`) REFERENCES `articulos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_proudccion_id_detalles_producciones` FOREIGN KEY (`produccion_id`) REFERENCES `producciones` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_sucursal_id_detalles_producciones` FOREIGN KEY (`sucursal_id`) REFERENCES `sucursales` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_id_detalles_producciones` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalles_producciones`
--

LOCK TABLES `detalles_producciones` WRITE;
/*!40000 ALTER TABLE `detalles_producciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalles_producciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalles_ventas_articulos`
--

DROP TABLE IF EXISTS `detalles_ventas_articulos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalles_ventas_articulos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `articulo_id` int(11) DEFAULT NULL,
  `cantidad` decimal(19,2) DEFAULT '0.00',
  `precio` decimal(19,2) DEFAULT NULL,
  `registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `usuario_id` int(11) NOT NULL,
  `dp` varchar(45) DEFAULT NULL,
  `venta_articulo_id` int(11) NOT NULL,
  `sucursal_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `almacen_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usuario_id_detalles_ventas_articulos_idx` (`usuario_id`),
  KEY `fk_articulo_id_detalles_ventas_articulos_idx` (`articulo_id`),
  KEY `fk_venta_id_detalles_ventas_articulos_idx` (`venta_articulo_id`),
  KEY `fk_sucursal_id_detalles_ventas_articulos_idx` (`sucursal_id`),
  KEY `fk_almance_id_detalles_ventas_articulos_idx` (`almacen_id`),
  CONSTRAINT `fk_almance_id_detalles_ventas_articulos` FOREIGN KEY (`almacen_id`) REFERENCES `almacenes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_articulo_id_detalles_ventas_articulos` FOREIGN KEY (`articulo_id`) REFERENCES `articulos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_sucursal_id_detalles_ventas_articulos` FOREIGN KEY (`sucursal_id`) REFERENCES `sucursales` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_id_detalles_ventas_articulos` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_venta_articulo_id_detalles_ventas_articulos` FOREIGN KEY (`venta_articulo_id`) REFERENCES `ventas_articulos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalles_ventas_articulos`
--

LOCK TABLES `detalles_ventas_articulos` WRITE;
/*!40000 ALTER TABLE `detalles_ventas_articulos` DISABLE KEYS */;
INSERT INTO `detalles_ventas_articulos` VALUES (1,1,3.00,13325.66,'2017-07-05 17:28:18',1,'P2',1,2,'2017-07-06 01:28:18','2017-07-06 01:28:18',1),(2,2,3.00,400.00,'2017-07-05 17:29:52',1,'P3',1,2,'2017-07-06 01:29:52','2017-07-06 01:29:52',1);
/*!40000 ALTER TABLE `detalles_ventas_articulos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalles_ventas_productos`
--

DROP TABLE IF EXISTS `detalles_ventas_productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalles_ventas_productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) DEFAULT NULL,
  `cantidad` float DEFAULT '0',
  `precio` float DEFAULT NULL,
  `registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `usuario_id` int(11) NOT NULL,
  `dp` varchar(45) DEFAULT NULL,
  `venta_producto_id` int(11) NOT NULL,
  `sucursal_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_producto_id_detalles_Ventas_productos_idx` (`producto_id`),
  KEY `fk_usuario_id_detalles_ventas_productos_idx` (`usuario_id`),
  KEY `fk_venta_producto_id_detalles_ventas_productos_idx` (`venta_producto_id`),
  KEY `fk_sucursal_id_detalles_ventas_productos_idx` (`sucursal_id`),
  CONSTRAINT `fk_producto_id_detalles_Ventas_productos` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_sucursal_id_detalles_ventas_productos` FOREIGN KEY (`sucursal_id`) REFERENCES `sucursales` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_id_detalles_ventas_productos` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_venta_producto_id_detalles_ventas_productos` FOREIGN KEY (`venta_producto_id`) REFERENCES `ventas_productos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalles_ventas_productos`
--

LOCK TABLES `detalles_ventas_productos` WRITE;
/*!40000 ALTER TABLE `detalles_ventas_productos` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalles_ventas_productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `existencia_articulo`
--

DROP TABLE IF EXISTS `existencia_articulo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `existencia_articulo` (
  `articulo_id` int(11) NOT NULL,
  `almacen_id` int(11) DEFAULT NULL,
  `cantidad` decimal(19,2) DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `sucursal_id` int(11) NOT NULL,
  PRIMARY KEY (`articulo_id`,`sucursal_id`),
  KEY `fk_almacen_id_existencia_articulo_idx` (`almacen_id`),
  KEY `fk_sucursal_id_existencia_idx` (`sucursal_id`),
  CONSTRAINT `fk_almacen_id_existencia_articulo` FOREIGN KEY (`almacen_id`) REFERENCES `almacenes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_articulo_id_existencia_articulo` FOREIGN KEY (`articulo_id`) REFERENCES `articulos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_sucursal_id_existencia` FOREIGN KEY (`sucursal_id`) REFERENCES `sucursales` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `existencia_articulo`
--

LOCK TABLES `existencia_articulo` WRITE;
/*!40000 ALTER TABLE `existencia_articulo` DISABLE KEYS */;
INSERT INTO `existencia_articulo` VALUES (1,1,152.00,NULL,NULL,1);
/*!40000 ALTER TABLE `existencia_articulo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `existencia_producto`
--

DROP TABLE IF EXISTS `existencia_producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `existencia_producto` (
  `detalle_producto_id` int(11) NOT NULL,
  `cantidad` decimal(19,4) DEFAULT '0.0000',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `sucursal_id` int(11) NOT NULL,
  `almacen_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`detalle_producto_id`,`sucursal_id`),
  KEY `fk_sucursal_id_existencia_producto_idx` (`sucursal_id`),
  KEY `fk_almacen_id_existencia_producto_idx` (`almacen_id`),
  CONSTRAINT `fk_almacen_id_existencia_producto` FOREIGN KEY (`almacen_id`) REFERENCES `almacenes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_detalle_producto_base_id_existencia_producto` FOREIGN KEY (`detalle_producto_id`) REFERENCES `productos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_sucursal_id_existencia_producto` FOREIGN KEY (`sucursal_id`) REFERENCES `sucursales` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `existencia_producto`
--

LOCK TABLES `existencia_producto` WRITE;
/*!40000 ALTER TABLE `existencia_producto` DISABLE KEYS */;
/*!40000 ALTER TABLE `existencia_producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ingresos`
--

DROP TABLE IF EXISTS `ingresos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ingresos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `compra_id` int(11) NOT NULL,
  `articulo_id` int(11) NOT NULL,
  `cantidad` decimal(19,2) DEFAULT '1.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `costo` decimal(19,2) DEFAULT '0.00',
  `almacen_id` int(11) NOT NULL,
  `sucursal_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_lote_id_articulos_idx` (`compra_id`),
  KEY `fk_familia_id_articulos_idx` (`articulo_id`),
  KEY `fk_almance_id_inventario_idx` (`almacen_id`),
  KEY `fk_usuario_id_ingresos_idx` (`usuario_id`),
  KEY `fk_sucursal_id_ingresos_idx` (`sucursal_id`),
  CONSTRAINT `fk_almance_id_inventario` FOREIGN KEY (`almacen_id`) REFERENCES `almacenes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_articulo_id_articulos` FOREIGN KEY (`articulo_id`) REFERENCES `articulos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_compra_id_articulos` FOREIGN KEY (`compra_id`) REFERENCES `compras` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_sucursal_id_ingresos` FOREIGN KEY (`sucursal_id`) REFERENCES `sucursales` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_id_ingresos` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ingresos`
--

LOCK TABLES `ingresos` WRITE;
/*!40000 ALTER TABLE `ingresos` DISABLE KEYS */;
INSERT INTO `ingresos` VALUES (7,1,'2017-07-01 02:02:02',1,1,50.00,'2017-07-01 10:02:02','2017-07-01 10:02:02',500.00,1,2),(8,1,'2017-07-01 02:24:05',1,2,100.00,'2017-07-01 10:24:05','2017-07-01 10:24:05',100.00,1,2),(15,1,'2017-07-01 18:40:52',8,2,300.00,'2017-07-02 02:40:52','2017-07-02 02:40:52',300.00,1,2),(16,1,'2017-07-01 18:41:16',8,1,500.00,'2017-07-02 02:41:16','2017-07-02 02:41:16',1000.00,1,2),(17,1,'2017-07-01 18:44:57',7,1,1.00,'2017-07-02 02:44:57','2017-07-03 07:51:24',100.00,1,1),(18,1,'2017-07-01 19:31:46',8,3,5.00,'2017-07-02 03:31:46','2017-07-02 03:31:46',150.00,1,2),(19,1,'2017-07-02 22:25:32',9,1,150.00,'2017-07-03 06:25:32','2017-07-03 06:25:32',635.00,1,2),(20,1,'2017-07-02 22:25:49',9,2,1.00,'2017-07-03 06:25:49','2017-07-03 06:25:49',136.23,1,2),(21,1,'2017-07-02 23:45:44',9,3,1.00,'2017-07-03 07:45:44','2017-07-03 07:45:44',35.50,1,2),(22,1,'2017-07-02 23:51:50',7,3,5.00,'2017-07-03 07:51:50','2017-07-03 07:51:50',120.00,1,1),(25,1,'2017-07-03 00:41:46',11,1,1.00,'2017-07-03 08:41:46','2017-07-03 08:41:46',100.00,1,1),(26,1,'2017-07-03 00:42:55',11,2,5.00,'2017-07-03 08:42:55','2017-07-03 08:42:55',101.00,1,1),(27,1,'2017-07-03 10:50:26',12,1,50.00,'2017-07-03 18:50:26','2017-07-03 18:58:38',3000.00,1,1),(29,1,'2017-07-03 10:59:53',12,3,12.00,'2017-07-03 18:59:53','2017-07-03 18:59:53',25.00,1,1),(30,1,'2017-07-03 14:23:54',13,1,31.00,'2017-07-03 22:23:54','2017-07-03 22:27:07',1000.00,1,1),(31,1,'2017-07-03 14:26:10',13,3,1.00,'2017-07-03 22:26:10','2017-07-03 22:26:10',50.50,1,1),(32,1,'2017-07-03 14:30:10',13,2,1.00,'2017-07-03 22:30:10','2017-07-03 22:30:10',150.00,1,1);
/*!40000 ALTER TABLE `ingresos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ingresos_productos`
--

DROP TABLE IF EXISTS `ingresos_productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ingresos_productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) NOT NULL,
  `produccion_id` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `talla_id` int(11) NOT NULL,
  `registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `usuario_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `sucursal_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_producto_id_stock_idx` (`producto_id`),
  KEY `fk_produccion_id_stock_idx` (`produccion_id`),
  KEY `fk_usuario_id_stock_idx` (`usuario_id`),
  KEY `fk_talla_id_stock_idx` (`talla_id`),
  KEY `fk_sucursal_id_stock_idx` (`sucursal_id`),
  CONSTRAINT `fk_produccion_id_stock` FOREIGN KEY (`produccion_id`) REFERENCES `producciones` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_producto_id_stock` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_sucursal_id_stock` FOREIGN KEY (`sucursal_id`) REFERENCES `sucursales` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_talla_id_stock` FOREIGN KEY (`talla_id`) REFERENCES `tallas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_id_stock` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ingresos_productos`
--

LOCK TABLES `ingresos_productos` WRITE;
/*!40000 ALTER TABLE `ingresos_productos` DISABLE KEYS */;
/*!40000 ALTER TABLE `ingresos_productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `marcas`
--

DROP TABLE IF EXISTS `marcas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `marcas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `descripcion` text,
  `estado` tinyint(4) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marcas`
--

LOCK TABLES `marcas` WRITE;
/*!40000 ALTER TABLE `marcas` DISABLE KEYS */;
INSERT INTO `marcas` VALUES (1,'Jovialco','2017-06-22 02:25:18','Excelente calidad en sedas pero no en algodon',1,'2017-06-22 10:25:18','2017-06-22 10:25:18'),(2,'Rafael Catala','2017-06-22 02:25:52','Diseña y fabrica telas de alta calidad para los editores textiles más importantes del mundo, la alta costura y el prêt a porter de lujo.',1,'2017-06-22 10:25:52','2017-06-22 10:25:52'),(3,'Rutex','2017-06-22 02:26:57','Disponemos de una gran superficie que nos permite albergar la maquinaria necesaria y un elevado stock de materia prima tanto en variedad de colores como en varias composiciones tales como todos',1,'2017-06-22 10:26:57','2017-06-22 10:26:57'),(4,'Batavia','2017-06-22 02:27:30','Fábrica de Tejidos desde 1755. Especialistas en Tejidos Ignífugos. Disponemos de más de 2000 tipos de tejidos.',1,'2017-06-22 10:27:30','2017-06-23 00:54:09'),(5,'Vives y Mari','2017-06-22 02:27:59','Fábrica de Tejidos. Producto > En la fabricación de nuestros productos utilizamos gran variedad de fibras naturales, artificiales y sintéticas.',1,'2017-06-22 10:27:59','2017-06-22 10:27:59'),(6,'Natan Fabric','2017-06-22 02:29:02','',1,'2017-06-22 10:29:02','2017-06-22 10:29:02'),(7,'Ben Textiles','2017-06-22 02:29:54','',0,'2017-06-22 10:29:54','2017-06-22 10:34:00'),(8,'Sal Tex','2017-06-22 02:30:34','',1,'2017-06-22 10:30:34','2017-06-22 10:30:34'),(9,'Bolivianita','2017-06-26 22:18:47',NULL,1,'2017-06-27 06:18:47','2017-06-27 06:18:47');
/*!40000 ALTER TABLE `marcas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materiales`
--

DROP TABLE IF EXISTS `materiales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `materiales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `descripcion` text,
  `registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `estado` tinyint(4) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materiales`
--

LOCK TABLES `materiales` WRITE;
/*!40000 ALTER TABLE `materiales` DISABLE KEYS */;
INSERT INTO `materiales` VALUES (1,'Seda China','Baja Calidad','2017-06-22 14:58:40',1,'2017-06-22 22:58:40','2017-06-22 22:58:40'),(2,'Seda Japonesa','Alta Calidad','2017-06-22 14:58:57',1,'2017-06-22 22:58:57','2017-06-22 22:59:08'),(3,'Algodon Artificial','Proveniente de Brasil','2017-06-22 14:59:59',1,'2017-06-22 22:59:59','2017-06-22 22:59:59'),(4,'Lana gruesa','Proveniente de Chile','2017-06-22 15:00:53',1,'2017-06-22 23:00:53','2017-06-22 23:00:53'),(5,'Algodon','','2017-06-22 15:01:46',1,'2017-06-22 23:01:46','2017-06-22 23:01:46'),(6,'Vegetal','','2017-06-22 15:05:30',1,'2017-06-22 23:05:30','2017-06-22 23:05:30'),(7,'Origen Animal','','2017-06-22 15:06:16',1,'2017-06-22 23:06:16','2017-06-22 23:06:16'),(8,'Ninguna','No esta bien definido','2017-06-22 15:06:37',0,'2017-06-22 23:06:37','2017-06-22 23:07:14'),(9,'Hilo Azteca',NULL,'2017-06-26 22:13:06',1,'2017-06-27 06:13:06','2017-06-27 06:13:06');
/*!40000 ALTER TABLE `materiales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `producciones`
--

DROP TABLE IF EXISTS `producciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `producciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `destino` text,
  `fecha` varchar(45) DEFAULT NULL,
  `registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `trabajador_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `inicio` date DEFAULT NULL,
  `fin` date DEFAULT NULL,
  `sucursal_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_trabajador_id_producciones_idx` (`trabajador_id`),
  KEY `fk_usuario_id_producciones_idx` (`usuario_id`),
  KEY `fk_sucursal_id_prouducciones_idx` (`sucursal_id`),
  CONSTRAINT `fk_sucursal_id_prouducciones` FOREIGN KEY (`sucursal_id`) REFERENCES `sucursales` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_trabajador_id_producciones` FOREIGN KEY (`trabajador_id`) REFERENCES `trabajadores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_id_producciones` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `producciones`
--

LOCK TABLES `producciones` WRITE;
/*!40000 ALTER TABLE `producciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `producciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produccto_tallas`
--

DROP TABLE IF EXISTS `produccto_tallas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produccto_tallas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `produccto_id` int(11) NOT NULL,
  `talla_id` int(11) NOT NULL,
  `precio1` decimal(19,4) DEFAULT '0.0000',
  `precio2` decimal(19,4) DEFAULT '0.0000',
  `precio3` decimal(19,4) DEFAULT '0.0000',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_talla_id_produccto_tallas_idx` (`talla_id`),
  KEY `fk_producto_id_producto_tallas_idx` (`produccto_id`),
  CONSTRAINT `fk_producto_id_producto_tallas` FOREIGN KEY (`produccto_id`) REFERENCES `productos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_talla_id_produccto_tallas` FOREIGN KEY (`talla_id`) REFERENCES `tallas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produccto_tallas`
--

LOCK TABLES `produccto_tallas` WRITE;
/*!40000 ALTER TABLE `produccto_tallas` DISABLE KEYS */;
/*!40000 ALTER TABLE `produccto_tallas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` text,
  `imagen` text,
  `estado` tinyint(4) DEFAULT '1',
  `registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `fecha` date DEFAULT NULL,
  `usuario_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos_base`
--

DROP TABLE IF EXISTS `productos_base`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `productos_base` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` text,
  `registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `usuario_id` int(11) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos_base`
--

LOCK TABLES `productos_base` WRITE;
/*!40000 ALTER TABLE `productos_base` DISABLE KEYS */;
INSERT INTO `productos_base` VALUES (1,'Poleras manga corta','2017-06-26 17:44:09',2,1,'2017-06-27 01:44:09','2017-06-27 01:46:52'),(2,'Pantalones Largos','2017-06-26 17:45:14',2,1,'2017-06-27 01:45:14','2017-06-27 01:46:02'),(3,'Chompas','2017-06-26 17:45:20',2,1,'2017-06-27 01:45:20','2017-06-27 01:45:20'),(4,'Bufandas','2017-06-26 17:45:39',2,1,'2017-06-27 01:45:39','2017-06-27 01:45:39'),(5,'Pantalones Cortos','2017-06-26 17:45:52',2,1,'2017-06-27 01:45:52','2017-06-27 01:45:52'),(6,'Pantalones de vestir','2017-06-26 17:46:21',2,1,'2017-06-27 01:46:21','2017-06-27 01:46:21'),(7,'Poleras manga larga','2017-06-26 17:46:42',2,1,'2017-06-27 01:46:42','2017-06-27 01:46:42'),(8,'Cuellos de tortuga','2017-06-26 17:47:18',2,1,'2017-06-27 01:47:18','2017-06-27 01:47:18'),(9,'Medias','2017-06-26 17:47:26',2,1,'2017-06-27 01:47:26','2017-06-27 01:47:26'),(10,'Canzoncillos','2017-06-26 17:47:32',2,1,'2017-06-27 01:47:32','2017-06-27 01:47:32'),(11,'Boxers','2017-06-26 17:47:38',2,1,'2017-06-27 01:47:38','2017-06-27 01:47:38'),(12,'Corpiños','2017-06-26 17:48:01',2,1,'2017-06-27 01:48:01','2017-06-27 01:48:01'),(13,'Gorros','2017-06-26 17:48:21',2,1,'2017-06-27 01:48:21','2017-06-27 01:48:21'),(14,'Sacos','2017-06-26 17:48:31',2,1,'2017-06-27 01:48:31','2017-06-27 01:48:31'),(15,'Chalecos','2017-06-26 17:48:41',2,1,'2017-06-27 01:48:41','2017-06-27 01:48:41'),(16,'Camisas','2017-06-26 17:48:47',2,1,'2017-06-27 01:48:47','2017-06-27 07:35:54'),(17,'Corbatas','2017-06-26 17:48:53',2,1,'2017-06-27 01:48:53','2017-06-27 01:48:53'),(18,'Banderas','2017-06-26 17:49:00',2,1,'2017-06-27 01:49:00','2017-06-27 01:49:00'),(19,'Edredones','2017-06-26 17:49:06',2,1,'2017-06-27 01:49:06','2017-06-27 01:49:06'),(20,'Cubre Camas','2017-06-26 17:49:14',2,1,'2017-06-27 01:49:14','2017-06-27 01:49:14'),(21,'Manteles','2017-06-26 17:49:19',2,1,'2017-06-27 01:49:19','2017-06-27 01:49:19'),(22,'Cortinas','2017-06-26 17:49:25',2,1,'2017-06-27 01:49:25','2017-06-27 01:49:25'),(23,'Toallas','2017-06-26 17:49:32',2,1,'2017-06-27 01:49:32','2017-06-27 01:49:32'),(24,'Sabanas','2017-06-26 17:49:41',2,1,'2017-06-27 01:49:41','2017-06-27 01:49:41'),(25,'banderas 2','2017-06-27 09:37:53',1,1,'2017-06-27 17:37:53','2017-06-27 17:37:53');
/*!40000 ALTER TABLE `productos_base` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proveedores`
--

DROP TABLE IF EXISTS `proveedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proveedores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `razon_social` varchar(255) DEFAULT NULL,
  `nit` varchar(45) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `celular` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `fax` varchar(45) DEFAULT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  `registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `estado` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proveedores`
--

LOCK TABLES `proveedores` WRITE;
/*!40000 ALTER TABLE `proveedores` DISABLE KEYS */;
INSERT INTO `proveedores` VALUES (1,'Telas Chinas SRL','1212123653','64-69825','78968525','telaschinas@gmail.com','0000','La paz. calle sucre #4585','2017-06-22 16:34:47','2017-06-23 00:34:47','2017-06-23 00:34:47',1),(2,'Importadora TexBol ','12452456633','64-69874','78968523','texbol@gmail.com','000','calle TexBol #7895','2017-06-22 16:53:19','2017-06-23 00:53:19','2017-06-23 00:53:19',1),(3,'Import Bol','69868658666','600-87964565','78969696','bol@gmail.com','0000','dir #789654','2017-06-22 16:54:49','2017-06-23 00:54:49','2017-06-23 00:59:09',1),(4,'Textil Chile','978465134','000-78665','78965441','texChile@gmail.com','796565','arica, calles arica #7896','2017-06-22 17:05:49','2017-06-23 01:05:49','2017-06-23 01:05:49',1),(5,'Facexco','6585','000-789682','77777777','facexco@gmail.com','00000','calle loa #785','2017-06-22 17:07:16','2017-06-23 01:07:16','2017-06-23 01:07:16',1),(6,'Telas del Rio','77789665','000-78965','88888888','delRio@gmail.com','00000','peru. calle bolivia #7893','2017-06-22 17:08:45','2017-06-23 01:08:45','2017-06-23 01:09:18',1),(7,'Hilaturas Aguilar','3131321312','64-00252','78787878','aguilar@gmail.com','8787878','calle calle #798797','2017-06-22 17:27:06','2017-06-23 01:27:06','2017-06-23 01:27:06',1),(8,'Distribuidora de Hilos','5555555','69-252532','54545454','email@gmail.com','545454','direccion calle #88888','2017-06-22 17:33:55','2017-06-23 01:33:55','2017-06-23 01:33:55',1),(9,'insumos Textiles SRL','2242424','96-2424242','878979879','insumos@gmail.com','3123131','S/N','2017-06-22 17:35:12','2017-06-23 01:35:12','2017-06-23 01:35:12',1),(10,'Insumos Telas','242424222','69-242424242','099898877','insumos2@gmail.com','22222','S/N','2017-06-22 17:36:21','2017-06-23 01:36:21','2017-06-23 01:36:21',1);
/*!40000 ALTER TABLE `proveedores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Administrador',0,NULL,'2017-06-27 06:59:17'),(2,'Sucursal',1,'2017-06-20 23:34:55','2017-06-20 23:34:55'),(3,'Ventas',1,'2017-06-20 23:35:04','2017-06-20 23:35:04'),(4,'Produccion',1,'2017-06-20 23:35:21','2017-06-20 23:35:21'),(5,'Moderador',0,'2017-06-20 23:35:28','2017-06-20 23:35:43');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sucursales`
--

DROP TABLE IF EXISTS `sucursales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sucursales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `celular` varchar(255) DEFAULT NULL,
  `nit` varchar(45) DEFAULT NULL,
  `usuario_id` int(11) NOT NULL,
  `ciudad_id` int(11) NOT NULL,
  `estado` tinyint(4) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ciudad_id_sucursales_idx` (`ciudad_id`),
  KEY `fk_usuario_id_sucursales_idx` (`usuario_id`),
  CONSTRAINT `fk_ciudad_id_sucursales` FOREIGN KEY (`ciudad_id`) REFERENCES `ciudades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_id_sucursales` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sucursales`
--

LOCK TABLES `sucursales` WRITE;
/*!40000 ALTER TABLE `sucursales` DISABLE KEYS */;
INSERT INTO `sucursales` VALUES (1,'WallMart Sucre','Ravelo #501','6464655','','10203040',1,1,1,'2017-06-26 02:49:16','2017-06-26 08:50:00'),(2,'Americas','Av. Americas S/N','46446605','67619790','30405060',1,1,1,'2017-06-26 08:57:11','2017-06-26 08:57:11');
/*!40000 ALTER TABLE `sucursales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tallas`
--

DROP TABLE IF EXISTS `tallas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tallas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT '1',
  `registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tallas`
--

LOCK TABLES `tallas` WRITE;
/*!40000 ALTER TABLE `tallas` DISABLE KEYS */;
INSERT INTO `tallas` VALUES (1,'Extra Large',1,'2017-06-26 15:26:24','2017-06-26 23:26:24','2017-06-26 23:26:24'),(2,'Large',1,'2017-06-26 15:27:17','2017-06-26 23:27:17','2017-06-26 23:27:17'),(3,'Medium',1,'2017-06-26 15:27:23','2017-06-26 23:27:23','2017-06-26 23:27:23'),(4,'Small',1,'2017-06-26 15:27:30','2017-06-26 23:27:30','2017-06-26 23:27:30'),(5,'Extra Small',1,'2017-06-26 15:27:39','2017-06-26 23:27:39','2017-06-26 23:27:39'),(6,'Normal',1,'2017-06-26 15:27:51','2017-06-26 23:27:51','2017-06-26 23:27:51'),(7,'Ninguno',0,'2017-06-26 15:27:57','2017-06-26 23:27:57','2017-06-26 23:28:05');
/*!40000 ALTER TABLE `tallas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trabajadores`
--

DROP TABLE IF EXISTS `trabajadores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trabajadores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `fecha_ingreso` date DEFAULT NULL,
  `cargo` varchar(45) DEFAULT NULL,
  `foto` text,
  `ci` varchar(45) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT '1',
  `referencia` varchar(255) DEFAULT NULL,
  `tel_referencia` varchar(255) DEFAULT NULL,
  `sueldo` float DEFAULT NULL,
  `usuario_id` int(11) NOT NULL,
  `sucursal_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usuario_id_trabajadores_idx` (`usuario_id`),
  KEY `fk_sucursal_id_trabajadores_idx` (`sucursal_id`),
  CONSTRAINT `fk_sucursal_id_trabajadores` FOREIGN KEY (`sucursal_id`) REFERENCES `sucursales` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_id_trabajadores` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trabajadores`
--

LOCK TABLES `trabajadores` WRITE;
/*!40000 ALTER TABLE `trabajadores` DISABLE KEYS */;
/*!40000 ALTER TABLE `trabajadores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unidades`
--

DROP TABLE IF EXISTS `unidades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unidades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `estado` tinyint(4) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unidades`
--

LOCK TABLES `unidades` WRITE;
/*!40000 ALTER TABLE `unidades` DISABLE KEYS */;
INSERT INTO `unidades` VALUES (1,'Pieza','2017-06-22 15:23:29',1,'2017-06-22 23:23:29','2017-06-29 21:09:23'),(3,'unidad','2017-06-22 15:24:05',1,'2017-06-22 23:24:05','2017-06-29 21:10:42'),(4,'Caja.','2017-06-22 15:24:24',1,'2017-06-22 23:24:24','2017-06-30 00:41:54'),(5,'Docena','2017-06-22 15:24:52',1,'2017-06-22 23:24:52','2017-06-29 21:09:52'),(6,'Ninguna','2017-06-22 15:25:08',0,'2017-06-22 23:25:08','2017-06-22 23:25:17'),(7,'Rollo','2017-06-26 22:22:51',1,'2017-06-27 06:22:51','2017-06-29 21:10:19');
/*!40000 ALTER TABLE `unidades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `celular` varchar(45) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `username` varchar(10) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT '1',
  `registrado` datetime DEFAULT CURRENT_TIMESTAMP,
  `read` tinyint(4) DEFAULT '1',
  `insert` tinyint(4) DEFAULT '0',
  `edit` tinyint(4) DEFAULT '0',
  `delete` tinyint(4) DEFAULT '0',
  `remember_token` varchar(100) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `rol_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_rol_id_usuarios_idx` (`rol_id`),
  CONSTRAINT `fk_rol_id_usuarios` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Guido Barrientos','4646465','67619790','$2y$10$Pvi8uuqaPNlZaaBnXcJ.feAyGI2lg.4E/76VTHTm2PSDX1.l.J0CC','gthusho',0,'2017-06-20 13:29:23',1,1,1,1,'7Zca60jrdpuXevKfQUt5MMnosGxjQa1RXbXxBXTRaZcDkSCReczUAH7UrM0Z','Sucre # 197',1,NULL,'2017-07-03 08:49:35'),(2,'Diego Tayagui','','','$2y$10$fSkOVI12khQhE8Ncn0CwtufHV9MQ/DUjCFXfM.XGXXuIv.jlKltFi','diego',1,'2017-06-20 15:25:08',1,0,0,0,NULL,'Arenales 100',1,'2017-06-20 23:25:08','2017-06-20 23:58:26'),(3,'Yarita Liseth','64645556','696669669','$2y$10$kQTfOW.KFJrNb58xqJTNAuLT6NIcdxZAczLa7mkwdCP0F.NOxyxHi','liss',1,'2017-06-20 15:25:56',1,0,0,0,NULL,'Salida Tarabuco',1,'2017-06-20 23:25:56','2017-06-20 23:58:12');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ventas_articulos`
--

DROP TABLE IF EXISTS `ventas_articulos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ventas_articulos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cliente_id` int(11) NOT NULL,
  `registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `observaciones` text,
  `estado` char(1) DEFAULT 'p',
  `usuario_id` int(11) NOT NULL,
  `tipo_pago` varchar(45) DEFAULT NULL,
  `sucursal_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `almacen_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usuario_id_ventas_idx` (`usuario_id`),
  KEY `fl_cliente_id_ventas_idx` (`cliente_id`),
  KEY `fk_sucursal_id_venta_articulos_idx` (`sucursal_id`),
  KEY `fk_almance_id_ventas_articulos_idx` (`almacen_id`),
  CONSTRAINT `fk_almance_id_ventas_articulos` FOREIGN KEY (`almacen_id`) REFERENCES `almacenes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_sucursal_id_venta_articulos` FOREIGN KEY (`sucursal_id`) REFERENCES `sucursales` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_id_ventas` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fl_cliente_id_ventas` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ventas_articulos`
--

LOCK TABLES `ventas_articulos` WRITE;
/*!40000 ALTER TABLE `ventas_articulos` DISABLE KEYS */;
INSERT INTO `ventas_articulos` VALUES (1,11,'2017-07-05 17:26:42','','t',1,'Credito',2,'2017-07-06 01:26:42','2017-07-06 01:30:14',1),(2,1,'2017-07-05 17:30:15',NULL,'p',1,NULL,NULL,'2017-07-06 01:30:15','2017-07-06 01:30:15',NULL);
/*!40000 ALTER TABLE `ventas_articulos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ventas_credito_articulos`
--

DROP TABLE IF EXISTS `ventas_credito_articulos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ventas_credito_articulos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `venta_articulo_id` int(11) NOT NULL,
  `abono` decimal(19,2) DEFAULT '0.00',
  `registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `usuario_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_venta_id_ventas_credito_idx` (`venta_articulo_id`),
  KEY `fk_usuadio_id_ventas_credito_idx` (`usuario_id`),
  CONSTRAINT `fk_usuadio_id_ventas_credito` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_venta_id_ventas_credito` FOREIGN KEY (`venta_articulo_id`) REFERENCES `ventas_articulos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ventas_credito_articulos`
--

LOCK TABLES `ventas_credito_articulos` WRITE;
/*!40000 ALTER TABLE `ventas_credito_articulos` DISABLE KEYS */;
/*!40000 ALTER TABLE `ventas_credito_articulos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ventas_credito_productos`
--

DROP TABLE IF EXISTS `ventas_credito_productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ventas_credito_productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `venta_producto_id` int(11) NOT NULL,
  `abono` decimal(19,4) DEFAULT '0.0000',
  `registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `usuario_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usuario_id_ventas_credito_productos_idx` (`usuario_id`),
  KEY `fk_venta_producto_id_ventas_credito_productos_idx` (`venta_producto_id`),
  CONSTRAINT `fk_usuario_id_ventas_credito_productos` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_venta_producto_id_ventas_credito_productos` FOREIGN KEY (`venta_producto_id`) REFERENCES `ventas_productos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ventas_credito_productos`
--

LOCK TABLES `ventas_credito_productos` WRITE;
/*!40000 ALTER TABLE `ventas_credito_productos` DISABLE KEYS */;
/*!40000 ALTER TABLE `ventas_credito_productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ventas_productos`
--

DROP TABLE IF EXISTS `ventas_productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ventas_productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cliente_id` int(11) NOT NULL,
  `registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `observaciones` text,
  `estado` int(11) DEFAULT '0',
  `usuario_id` int(11) NOT NULL,
  `tipo_pago` varchar(45) DEFAULT NULL,
  `sucursal_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cliente_id_ventas_productos_idx` (`cliente_id`),
  KEY `fk_usuario_id_ventas_productos_idx` (`usuario_id`),
  KEY `fk_sucursal_id_ventas_productos_idx` (`sucursal_id`),
  CONSTRAINT `fk_cliente_id_ventas_productos` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_sucursal_id_ventas_productos` FOREIGN KEY (`sucursal_id`) REFERENCES `sucursales` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_id_ventas_productos` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ventas_productos`
--

LOCK TABLES `ventas_productos` WRITE;
/*!40000 ALTER TABLE `ventas_productos` DISABLE KEYS */;
/*!40000 ALTER TABLE `ventas_productos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-07-05 22:26:27
