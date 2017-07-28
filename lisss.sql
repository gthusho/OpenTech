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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `almacenes`
--

LOCK TABLES `almacenes` WRITE;
/*!40000 ALTER TABLE `almacenes` DISABLE KEYS */;
INSERT INTO `almacenes` VALUES (1,'Almacen Sucre 1','av. Juana azurduy #324',1,'2017-06-22 14:28:15',1,'2017-06-22 22:28:15','2017-06-22 22:31:22',1),(2,'Almacen Sucre 2','Av. Las americas #145',1,'2017-06-22 14:32:34',1,'2017-06-22 22:32:34','2017-06-22 22:32:34',2),(15,'Agapito D1','Av. Villa Amornia #154',1,'2017-07-06 00:07:10',1,'2017-07-06 08:07:10','2017-07-07 20:45:43',4);
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
  `material_id` int(11) NOT NULL DEFAULT '1',
  `unidad_id` int(11) NOT NULL DEFAULT '1',
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
  KEY `fk_unidad_id_articulos_idx` (`unidad_id`),
  CONSTRAINT `fk_categoria_articulo_articulos` FOREIGN KEY (`categoria_articulo_id`) REFERENCES `categorias_articulos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_marca_id_articulos` FOREIGN KEY (`marca_id`) REFERENCES `marcas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_material_id_articulos` FOREIGN KEY (`material_id`) REFERENCES `materiales` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_unidad_id_articulos` FOREIGN KEY (`unidad_id`) REFERENCES `unidades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=668 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articulos`
--

LOCK TABLES `articulos` WRITE;
/*!40000 ALTER TABLE `articulos` DISABLE KEYS */;
INSERT INTO `articulos` VALUES (7,'Adeshivo color madera 22 mm.',1,'2017-07-14 21:50:01','558',1,11,1,1,0.00,6.00,0.00,0.00,NULL,1.00,NULL,NULL),(8,'Adeshivo color madera 32 mm.',1,'2017-07-14 21:50:01','557',1,11,1,1,0.00,8.00,0.00,0.00,NULL,1.00,NULL,NULL),(9,'Adeshivo color madera 45 cm.',1,'2017-07-14 21:50:01','556',1,11,1,1,0.00,180.00,0.00,0.00,NULL,1.00,NULL,NULL),(10,'Argolla Canaleada 22mm.',1,'2017-07-14 21:50:01','580',1,11,1,1,0.00,3.70,0.00,0.00,NULL,1.00,NULL,NULL),(11,'Argolla Canaleada 32mm.',1,'2017-07-14 21:50:01','579',1,11,1,1,0.00,4.00,0.00,0.00,NULL,1.00,NULL,NULL),(12,'Argolla Canaleada Plastica 32mm.',1,'2017-07-14 21:50:01','586',1,11,1,1,0.00,3.50,0.00,0.00,NULL,1.00,NULL,NULL),(13,'Argolla Canaleada Plastica Dorado 32mm.',1,'2017-07-14 21:50:01','583',1,11,1,1,0.00,5.00,0.00,0.00,NULL,1.00,NULL,NULL),(14,'Argolla Canaleada Plastica Madera 32mm.',1,'2017-07-14 21:50:01','585',1,11,1,1,0.00,5.00,0.00,0.00,NULL,1.00,NULL,NULL),(15,'Argolla Canaleada Plastica Plateada 32mm.',1,'2017-07-14 21:50:01','584',1,11,1,1,0.00,5.00,0.00,0.00,NULL,1.00,NULL,NULL),(16,'Argolla Cuadrada Combinado 32mm.',1,'2017-07-14 21:50:01','588',1,11,1,1,0.00,7.00,0.00,0.00,NULL,1.00,NULL,NULL),(17,'Argolla Cuadrada Plateada 32mm.',1,'2017-07-14 21:50:01','587',1,11,1,1,0.00,7.00,0.00,0.00,NULL,1.00,NULL,NULL),(18,'Argolla Normal 22mm.',1,'2017-07-14 21:50:01','582',1,11,1,1,0.00,3.40,0.00,0.00,NULL,1.00,NULL,NULL),(19,'Argolla Normal 32mm.',1,'2017-07-14 21:50:01','581',1,11,1,1,0.00,3.70,0.00,0.00,NULL,1.00,NULL,NULL),(20,'Botonera Normal',1,'2017-07-14 21:50:01','575',1,11,1,1,0.00,85.00,0.00,0.00,NULL,1.00,NULL,NULL),(21,'Botonera Tallada',1,'2017-07-14 21:50:01','574',1,11,1,1,0.00,120.00,0.00,0.00,NULL,1.00,NULL,NULL),(22,'Soporte Corniza 22mm.',1,'2017-07-14 21:50:01','573',1,11,1,1,0.00,50.00,0.00,0.00,NULL,1.00,NULL,NULL),(23,'Soporte Corniza 32mm.',1,'2017-07-14 21:50:01','572',1,11,1,1,0.00,60.00,0.00,0.00,NULL,1.00,NULL,NULL),(24,'Soporte Cuello Largo 22mm.',1,'2017-07-14 21:50:01','564',1,11,1,1,0.00,52.00,0.00,0.00,NULL,1.00,NULL,NULL),(25,'Soporte Cuello Largo 32mm.',1,'2017-07-14 21:50:01','563',1,11,1,1,0.00,55.00,0.00,0.00,NULL,1.00,NULL,NULL),(26,'Soporte Cuello Largo Central 22mm.',1,'2017-07-14 21:50:02','566',1,11,1,1,0.00,52.00,0.00,0.00,NULL,1.00,NULL,NULL),(27,'Soporte Cuello Largo Central 32mm.',1,'2017-07-14 21:50:02','565',1,11,1,1,0.00,55.00,0.00,0.00,NULL,1.00,NULL,NULL),(28,'Soporte Doble 32 y 22mm.',1,'2017-07-14 21:50:02','567',1,11,1,1,0.00,95.00,0.00,0.00,NULL,1.00,NULL,NULL),(29,'Soporte Doble 32 y 32mm.',1,'2017-07-14 21:50:02','568',1,11,1,1,0.00,100.00,0.00,0.00,NULL,1.00,NULL,NULL),(30,'Soporte Doble Plato 32 y 22mm.',1,'2017-07-14 21:50:02','569',1,11,1,1,0.00,120.00,0.00,0.00,NULL,1.00,NULL,NULL),(31,'Soporte Herraje 22mm.',1,'2017-07-14 21:50:02','577',1,11,1,1,0.00,45.00,0.00,0.00,NULL,1.00,NULL,NULL),(32,'Soporte Herraje 32mm.',1,'2017-07-14 21:50:02','576',1,11,1,1,0.00,50.00,0.00,0.00,NULL,1.00,NULL,NULL),(33,'Soporte Niquelado 32mm.',1,'2017-07-14 21:50:02','578',1,11,1,1,0.00,75.00,0.00,0.00,NULL,1.00,NULL,NULL),(34,'Soporte Pequeño 22mm.',1,'2017-07-14 21:50:02','560',1,11,1,1,0.00,45.00,0.00,0.00,NULL,1.00,NULL,NULL),(35,'Soporte Pequeño Central 22mm.',1,'2017-07-14 21:50:02','562',1,11,1,1,0.00,45.00,0.00,0.00,NULL,1.00,NULL,NULL),(36,'Soporte Pequeño Plato 22mm.',1,'2017-07-14 21:50:02','571',1,11,1,1,0.00,90.00,0.00,0.00,NULL,1.00,NULL,NULL),(37,'Soporte Simple  Central 32mm.',1,'2017-07-14 21:50:02','561',1,11,1,1,0.00,50.00,0.00,0.00,NULL,1.00,NULL,NULL),(38,'Soporte Simple 32mm.',1,'2017-07-14 21:50:02','559',1,11,1,1,0.00,50.00,0.00,0.00,NULL,1.00,NULL,NULL),(39,'Soporte Simple Plato 32mm.',1,'2017-07-14 21:50:02','570',1,11,1,1,0.00,95.00,0.00,0.00,NULL,1.00,NULL,NULL),(40,'Tela Adidas Brillo Azul Marino',1,'2017-07-14 21:50:02','18',2,7,1,1,0.00,16.00,0.00,0.00,NULL,1.00,NULL,NULL),(41,'Tela Adidas Brillo Azul Pastel',1,'2017-07-14 21:50:02','12',2,7,1,1,0.00,16.00,0.00,0.00,NULL,1.00,NULL,NULL),(42,'Tela Adidas Brillo Blanco',1,'2017-07-14 21:50:02','16',2,7,1,1,0.00,16.00,0.00,0.00,NULL,1.00,NULL,NULL),(43,'Tela Adidas Brillo Celeste',1,'2017-07-14 21:50:02','13',2,7,1,1,0.00,16.00,0.00,0.00,NULL,1.00,NULL,NULL),(44,'Tela Adidas Brillo Negro',1,'2017-07-14 21:50:02','14',2,7,1,1,0.00,16.00,0.00,0.00,NULL,1.00,NULL,NULL),(45,'Tela Adidas Brillo Plomo Medio',1,'2017-07-14 21:50:02','11',2,7,1,1,0.00,16.00,0.00,0.00,NULL,1.00,NULL,NULL),(46,'Tela Adidas Brillo Rojo',1,'2017-07-14 21:50:03','20',2,7,1,1,0.00,16.00,0.00,0.00,NULL,1.00,NULL,NULL),(47,'Tela Adidas Brillo Turquesa',1,'2017-07-14 21:50:03','15',2,7,1,1,0.00,16.00,0.00,0.00,NULL,1.00,NULL,NULL),(48,'Tela Adidas Brillo Verde Jade',1,'2017-07-14 21:50:03','17',2,7,1,1,0.00,16.00,0.00,0.00,NULL,1.00,NULL,NULL),(49,'Tela 3 Amarillo Brasil',1,'2017-07-14 21:50:03','211',3,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(50,'Tela 3 Amarillo Oro',1,'2017-07-14 21:50:03','214',3,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(51,'Tela 3 Amarillo Pato',1,'2017-07-14 21:50:03','202',3,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(52,'Tela 3 Arena',1,'2017-07-14 21:50:03','218',3,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(53,'Tela 3 Azul Elétrico',1,'2017-07-14 21:50:03','179',3,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(54,'Tela 3 Azul Francia',1,'2017-07-14 21:50:03','178',3,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(55,'Tela 3 Azul Líder',1,'2017-07-14 21:50:03','186',3,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(56,'Tela 3 Azul Marino',1,'2017-07-14 21:50:03','177',3,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(57,'Tela 3 Azul Pastel',1,'2017-07-14 21:50:03','180',3,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(58,'Tela 3 Azul Petróleo',1,'2017-07-14 21:50:03','187',3,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(59,'Tela 3 Blanco',1,'2017-07-14 21:50:03','217',3,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(60,'Tela 3 Cafe Moro',1,'2017-07-14 21:50:03','226',3,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(61,'Tela 3 Calipso',1,'2017-07-14 21:50:03','181',3,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(62,'Tela 3 Capri',1,'2017-07-14 21:50:03','182',3,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(63,'Tela 3 Celeste',1,'2017-07-14 21:50:03','206',3,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(64,'Tela 3 Coral',1,'2017-07-14 21:50:03','207',3,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(65,'Tela 3 Crudo',1,'2017-07-14 21:50:03','213',3,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(66,'Tela 3 Damasco',1,'2017-07-14 21:50:03','204',3,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(67,'Tela 3 Fucsia',1,'2017-07-14 21:50:03','208',3,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(68,'Tela 3 Grafito',1,'2017-07-14 21:50:04','197',3,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(69,'Tela 3 Gris Claro',1,'2017-07-14 21:50:04','196',3,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(70,'Tela 3 Gris Oscuro',1,'2017-07-14 21:50:04','195',3,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(71,'Tela 3 Guindo',1,'2017-07-14 21:50:04','212',3,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(72,'Tela 3 Jacinto',1,'2017-07-14 21:50:04','183',3,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(73,'Tela 3 Jeans',1,'2017-07-14 21:50:04','222',3,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(74,'Tela 3 Lila',1,'2017-07-14 21:50:04','203',3,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(75,'Tela 3 Marengo',1,'2017-07-14 21:50:04','199',3,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(76,'Tela 3 Melange Oscuro',1,'2017-07-14 21:50:04','198',3,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(77,'Tela 3 Morado',1,'2017-07-14 21:50:04','192',3,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(78,'Tela 3 Mostaza',1,'2017-07-14 21:50:04','215',3,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(79,'Tela 3 Naranja',1,'2017-07-14 21:50:04','205',3,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(80,'Tela 3 Negro',1,'2017-07-14 21:50:04','200',3,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(81,'Tela 3 Obispo',1,'2017-07-14 21:50:04','216',3,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(82,'Tela 3 Paquete Vela',1,'2017-07-14 21:50:04','184',3,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(83,'Tela 3 Rojo Bandera',1,'2017-07-14 21:50:04','210',3,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(84,'Tela 3 Rojo Italiano',1,'2017-07-14 21:50:04','209',3,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(85,'Tela 3 Rosado',1,'2017-07-14 21:50:04','201',3,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(86,'Tela 3 Terracota',1,'2017-07-14 21:50:05','228',3,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(87,'Tela 3 Turquesa',1,'2017-07-14 21:50:05','185',3,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(88,'Tela 3 Vainilla',1,'2017-07-14 21:50:05','219',3,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(89,'Tela 3 Verde Agua',1,'2017-07-14 21:50:05','227',3,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(90,'Tela 3 Verde Botella',1,'2017-07-14 21:50:05','190',3,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(91,'Tela 3 Verde Cata',1,'2017-07-14 21:50:05','194',3,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(92,'Tela 3 Verde Jade',1,'2017-07-14 21:50:05','191',3,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(93,'Tela 3 Verde Limón',1,'2017-07-14 21:50:05','225',3,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(94,'Tela 3 Verde Manzana',1,'2017-07-14 21:50:05','224',3,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(95,'Tela 3 Verde Militar',1,'2017-07-14 21:50:05','221',3,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(96,'Tela 3 Verde Nilo',1,'2017-07-14 21:50:05','220',3,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(97,'Tela 3 Verde P. Claro',1,'2017-07-14 21:50:05','188',3,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(98,'Tela 3 Verde Petróleo',1,'2017-07-14 21:50:05','189',3,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(99,'Tela 3 Verde Rombocol',1,'2017-07-14 21:50:05','193',3,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(100,'Tela 3 Verde Viva',1,'2017-07-14 21:50:05','223',3,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(101,'Tela 4  Amarillo pato',1,'2017-07-14 21:50:05','98',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(102,'Tela 4 Amarillo Brasil',1,'2017-07-14 21:50:05','107',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(103,'Tela 4 Amarillo Oro',1,'2017-07-14 21:50:05','110',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(104,'Tela 4 Arena',1,'2017-07-14 21:50:05','114',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(105,'Tela 4 Azul Eléctrico',1,'2017-07-14 21:50:05','73',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(106,'Tela 4 Azul Francia',1,'2017-07-14 21:50:06','75',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(107,'Tela 4 Azul Lider',1,'2017-07-14 21:50:06','82',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(108,'Tela 4 Azul Marino',1,'2017-07-14 21:50:06','74',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(109,'Tela 4 Azul Pastel',1,'2017-07-14 21:50:06','76',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(110,'Tela 4 Azul Petróleo',1,'2017-07-14 21:50:06','83',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(111,'Tela 4 Blanco',1,'2017-07-14 21:50:06','113',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(112,'Tela 4 Café Moro',1,'2017-07-14 21:50:06','122',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(113,'Tela 4 Calipso',1,'2017-07-14 21:50:06','77',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(114,'Tela 4 Capri',1,'2017-07-14 21:50:06','78',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(115,'Tela 4 Celeste',1,'2017-07-14 21:50:06','102',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(116,'Tela 4 Coral',1,'2017-07-14 21:50:06','103',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(117,'Tela 4 Crudo',1,'2017-07-14 21:50:06','109',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(118,'Tela 4 Damasco',1,'2017-07-14 21:50:06','100',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(119,'Tela 4 Fucsia',1,'2017-07-14 21:50:06','104',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(120,'Tela 4 Grafito',1,'2017-07-14 21:50:06','93',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(121,'Tela 4 Gris Claro',1,'2017-07-14 21:50:06','92',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(122,'Tela 4 Gris Oscuro',1,'2017-07-14 21:50:06','91',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(123,'Tela 4 Guindo',1,'2017-07-14 21:50:06','108',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(124,'Tela 4 Jacinto',1,'2017-07-14 21:50:06','79',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(125,'Tela 4 Jeans',1,'2017-07-14 21:50:06','118',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(126,'Tela 4 Lila',1,'2017-07-14 21:50:06','99',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(127,'Tela 4 Marengo',1,'2017-07-14 21:50:07','95',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(128,'Tela 4 Melange Oscuro',1,'2017-07-14 21:50:07','94',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(129,'Tela 4 Morado',1,'2017-07-14 21:50:07','88',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(130,'Tela 4 Mostaza',1,'2017-07-14 21:50:07','111',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(131,'Tela 4 Naranja',1,'2017-07-14 21:50:07','101',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(132,'Tela 4 Negro',1,'2017-07-14 21:50:07','96',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(133,'Tela 4 Obispo',1,'2017-07-14 21:50:07','112',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(134,'Tela 4 Paquete Vela',1,'2017-07-14 21:50:07','80',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(135,'Tela 4 Rojo Bandera',1,'2017-07-14 21:50:07','106',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(136,'Tela 4 Rojo Italiano',1,'2017-07-14 21:50:07','105',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(137,'Tela 4 Rosado',1,'2017-07-14 21:50:07','97',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(138,'Tela 4 Terracota',1,'2017-07-14 21:50:07','124',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(139,'Tela 4 Turquesa',1,'2017-07-14 21:50:08','81',4,5,1,1,0.00,80.00,0.00,0.00,NULL,1.00,NULL,NULL),(140,'Tela 4 Vainilla',1,'2017-07-14 21:50:08','115',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(141,'Tela 4 Verde Agua',1,'2017-07-14 21:50:08','123',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(142,'Tela 4 Verde Botella',1,'2017-07-14 21:50:08','86',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(143,'Tela 4 Verde Cata',1,'2017-07-14 21:50:08','90',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(144,'Tela 4 Verde Jade',1,'2017-07-14 21:50:08','87',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(145,'Tela 4 Verde Limón',1,'2017-07-14 21:50:08','121',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(146,'Tela 4 Verde Manzana',1,'2017-07-14 21:50:08','120',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(147,'Tela 4 Verde Militar',1,'2017-07-14 21:50:08','117',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(148,'Tela 4 Verde Nilo',1,'2017-07-14 21:50:08','116',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(149,'Tela 4 Verde P. Claro',1,'2017-07-14 21:50:08','85',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(150,'Tela 4 Verde Petróleo',1,'2017-07-14 21:50:08','84',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(151,'Tela 4 Verde Rombocol',1,'2017-07-14 21:50:09','89',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(152,'Tela 4 Verde Viva',1,'2017-07-14 21:50:09','119',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(153,'Tela 5 Amarillo Brasil',1,'2017-07-14 21:50:09','159',5,5,1,1,0.00,99.00,0.00,0.00,NULL,1.00,NULL,NULL),(154,'Tela 5 Amarillo Oro',1,'2017-07-14 21:50:09','162',5,5,1,1,0.00,99.00,0.00,0.00,NULL,1.00,NULL,NULL),(155,'Tela 5 Amarillo Pato',1,'2017-07-14 21:50:09','150',5,5,1,1,0.00,99.00,0.00,0.00,NULL,1.00,NULL,NULL),(156,'Tela 5 Arena',1,'2017-07-14 21:50:09','166',5,5,1,1,0.00,99.00,0.00,0.00,NULL,1.00,NULL,NULL),(157,'Tela 5 Azul Eléctrico',1,'2017-07-14 21:50:09','127',5,5,1,1,0.00,99.00,0.00,0.00,NULL,1.00,NULL,NULL),(158,'Tela 5 Azul Francia',1,'2017-07-14 21:50:09','126',5,5,1,1,0.00,99.00,0.00,0.00,NULL,1.00,NULL,NULL),(159,'Tela 5 Azul Lider',1,'2017-07-14 21:50:09','134',5,5,1,1,0.00,99.00,0.00,0.00,NULL,1.00,NULL,NULL),(160,'Tela 5 Azul Marino',1,'2017-07-14 21:50:09','125',5,5,1,1,0.00,99.00,0.00,0.00,NULL,1.00,NULL,NULL),(161,'Tela 5 Azul Pastel',1,'2017-07-14 21:50:09','128',5,5,1,1,0.00,99.00,0.00,0.00,NULL,1.00,NULL,NULL),(162,'Tela 5 Azul Petróleo',1,'2017-07-14 21:50:09','135',5,5,1,1,0.00,99.00,0.00,0.00,NULL,1.00,NULL,NULL),(163,'Tela 5 Blanco',1,'2017-07-14 21:50:09','165',5,5,1,1,0.00,99.00,0.00,0.00,NULL,1.00,NULL,NULL),(164,'Tela 5 Café Moro',1,'2017-07-14 21:50:09','174',5,5,1,1,0.00,99.00,0.00,0.00,NULL,1.00,NULL,NULL),(165,'Tela 5 Calipso',1,'2017-07-14 21:50:09','129',5,5,1,1,0.00,99.00,0.00,0.00,NULL,1.00,NULL,NULL),(166,'Tela 5 Capri',1,'2017-07-14 21:50:09','131',5,5,1,1,0.00,99.00,0.00,0.00,NULL,1.00,NULL,NULL),(167,'Tela 5 Celeste',1,'2017-07-14 21:50:09','154',5,5,1,1,0.00,99.00,0.00,0.00,NULL,1.00,NULL,NULL),(168,'Tela 5 Coral',1,'2017-07-14 21:50:09','155',5,5,1,1,0.00,99.00,0.00,0.00,NULL,1.00,NULL,NULL),(169,'Tela 5 Crudo',1,'2017-07-14 21:50:09','161',5,5,1,1,0.00,99.00,0.00,0.00,NULL,1.00,NULL,NULL),(170,'Tela 5 Damasco',1,'2017-07-14 21:50:10','152',5,5,1,1,0.00,99.00,0.00,0.00,NULL,1.00,NULL,NULL),(171,'Tela 5 Fucsia',1,'2017-07-14 21:50:10','156',5,5,1,1,0.00,99.00,0.00,0.00,NULL,1.00,NULL,NULL),(172,'Tela 5 Grafito',1,'2017-07-14 21:50:10','145',5,5,1,1,0.00,99.00,0.00,0.00,NULL,1.00,NULL,NULL),(173,'Tela 5 Gris Claro',1,'2017-07-14 21:50:10','144',5,5,1,1,0.00,99.00,0.00,0.00,NULL,1.00,NULL,NULL),(174,'Tela 5 Gris Oscuro',1,'2017-07-14 21:50:10','143',5,5,1,1,0.00,99.00,0.00,0.00,NULL,1.00,NULL,NULL),(175,'Tela 5 Guindo',1,'2017-07-14 21:50:10','160',5,5,1,1,0.00,99.00,0.00,0.00,NULL,1.00,NULL,NULL),(176,'Tela 5 Jacinto',1,'2017-07-14 21:50:10','130',5,5,1,1,0.00,99.00,0.00,0.00,NULL,1.00,NULL,NULL),(177,'Tela 5 Jeans',1,'2017-07-14 21:50:10','170',5,5,1,1,0.00,99.00,0.00,0.00,NULL,1.00,NULL,NULL),(178,'Tela 5 Lila',1,'2017-07-14 21:50:10','151',5,5,1,1,0.00,99.00,0.00,0.00,NULL,1.00,NULL,NULL),(179,'Tela 5 Marengo',1,'2017-07-14 21:50:10','147',5,5,1,1,0.00,99.00,0.00,0.00,NULL,1.00,NULL,NULL),(180,'Tela 5 Melange Oscuro',1,'2017-07-14 21:50:10','146',5,5,1,1,0.00,99.00,0.00,0.00,NULL,1.00,NULL,NULL),(181,'Tela 5 Morado',1,'2017-07-14 21:50:10','140',5,5,1,1,0.00,99.00,0.00,0.00,NULL,1.00,NULL,NULL),(182,'Tela 5 Mostaza',1,'2017-07-14 21:50:10','163',5,5,1,1,0.00,99.00,0.00,0.00,NULL,1.00,NULL,NULL),(183,'Tela 5 Naranja',1,'2017-07-14 21:50:10','153',5,5,1,1,0.00,99.00,0.00,0.00,NULL,1.00,NULL,NULL),(184,'Tela 5 Negro',1,'2017-07-14 21:50:10','148',5,5,1,1,0.00,99.00,0.00,0.00,NULL,1.00,NULL,NULL),(185,'Tela 5 Obispo',1,'2017-07-14 21:50:10','164',5,5,1,1,0.00,99.00,0.00,0.00,NULL,1.00,NULL,NULL),(186,'Tela 5 Paquete Vela',1,'2017-07-14 21:50:10','132',5,5,1,1,0.00,99.00,0.00,0.00,NULL,1.00,NULL,NULL),(187,'Tela 5 Rojo Bandera',1,'2017-07-14 21:50:10','158',5,5,1,1,0.00,99.00,0.00,0.00,NULL,1.00,NULL,NULL),(188,'Tela 5 Rojo Italiano',1,'2017-07-14 21:50:10','157',5,5,1,1,0.00,99.00,0.00,0.00,NULL,1.00,NULL,NULL),(189,'Tela 5 Rosado',1,'2017-07-14 21:50:10','149',5,5,1,1,0.00,99.00,0.00,0.00,NULL,1.00,NULL,NULL),(190,'Tela 5 Terracota',1,'2017-07-14 21:50:11','176',5,5,1,1,0.00,99.00,0.00,0.00,NULL,1.00,NULL,NULL),(191,'Tela 5 Turquesa',1,'2017-07-14 21:50:11','133',5,5,1,1,0.00,99.00,0.00,0.00,NULL,1.00,NULL,NULL),(192,'Tela 5 Vainilla',1,'2017-07-14 21:50:11','167',5,5,1,1,0.00,99.00,0.00,0.00,NULL,1.00,NULL,NULL),(193,'Tela 5 Verde Agua',1,'2017-07-14 21:50:11','175',5,5,1,1,0.00,99.00,0.00,0.00,NULL,1.00,NULL,NULL),(194,'Tela 5 Verde Botella',1,'2017-07-14 21:50:11','138',5,5,1,1,0.00,99.00,0.00,0.00,NULL,1.00,NULL,NULL),(195,'Tela 5 Verde Cata',1,'2017-07-14 21:50:11','142',5,5,1,1,0.00,99.00,0.00,0.00,NULL,1.00,NULL,NULL),(196,'Tela 5 Verde Jade',1,'2017-07-14 21:50:11','139',5,5,1,1,0.00,99.00,0.00,0.00,NULL,1.00,NULL,NULL),(197,'Tela 5 Verde Limón',1,'2017-07-14 21:50:11','173',5,5,1,1,0.00,99.00,0.00,0.00,NULL,1.00,NULL,NULL),(198,'Tela 5 Verde Manzana',1,'2017-07-14 21:50:11','172',5,5,1,1,0.00,99.00,0.00,0.00,NULL,1.00,NULL,NULL),(199,'Tela 5 Verde Militar',1,'2017-07-14 21:50:11','169',5,5,1,1,0.00,99.00,0.00,0.00,NULL,1.00,NULL,NULL),(200,'Tela 5 Verde Nilo',1,'2017-07-14 21:50:11','168',5,5,1,1,0.00,99.00,0.00,0.00,NULL,1.00,NULL,NULL),(201,'Tela 5 Verde P. Claro',1,'2017-07-14 21:50:11','137',5,5,1,1,0.00,99.00,0.00,0.00,NULL,1.00,NULL,NULL),(202,'Tela 5 Verde Petróleo',1,'2017-07-14 21:50:11','136',5,5,1,1,0.00,99.00,0.00,0.00,NULL,1.00,NULL,NULL),(203,'Tela 5 Verde Rombocol',1,'2017-07-14 21:50:11','141',5,5,1,1,0.00,99.00,0.00,0.00,NULL,1.00,NULL,NULL),(204,'Tela 5 Verde Viva',1,'2017-07-14 21:50:11','171',5,5,1,1,0.00,99.00,0.00,0.00,NULL,1.00,NULL,NULL),(205,'Tela Pique  Verde Manzana',1,'2017-07-14 21:50:11','68',6,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(206,'Tela Pique Amarillo Brasil',1,'2017-07-14 21:50:11','55',6,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(207,'Tela Pique Amarillo Oro',1,'2017-07-14 21:50:11','58',6,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(208,'Tela Pique Amarillo Pato',1,'2017-07-14 21:50:12','46',6,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(209,'Tela Pique Arena',1,'2017-07-14 21:50:12','62',6,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(210,'Tela Pique Azul Electrico',1,'2017-07-14 21:50:12','23',6,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(211,'Tela Pique Azul Francia',1,'2017-07-14 21:50:12','22',6,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(212,'Tela Pique Azul Lider',1,'2017-07-14 21:50:12','30',6,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(213,'Tela Pique Azul Marino',1,'2017-07-14 21:50:12','21',6,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(214,'Tela Pique Azul Pastel',1,'2017-07-14 21:50:12','24',6,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(215,'Tela Pique Azul Petróleo',1,'2017-07-14 21:50:12','31',6,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(216,'Tela Pique Blanco',1,'2017-07-14 21:50:12','61',6,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(217,'Tela Pique Café Moro',1,'2017-07-14 21:50:12','70',6,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(218,'Tela Pique Calipso',1,'2017-07-14 21:50:12','25',6,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(219,'Tela Pique Capri',1,'2017-07-14 21:50:12','26',6,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(220,'Tela Pique Celeste',1,'2017-07-14 21:50:12','50',6,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(221,'Tela Pique Coral',1,'2017-07-14 21:50:12','51',6,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(222,'Tela Pique Crudo',1,'2017-07-14 21:50:13','57',6,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(223,'Tela Pique Damasco',1,'2017-07-14 21:50:13','48',6,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(224,'Tela Pique Fucsia',1,'2017-07-14 21:50:13','52',6,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(225,'Tela Pique Grafito',1,'2017-07-14 21:50:13','41',6,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(226,'Tela Pique Gris Claro',1,'2017-07-14 21:50:13','40',6,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(227,'Tela Pique Gris Oscuro',1,'2017-07-14 21:50:13','39',6,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(228,'Tela Pique Guindo',1,'2017-07-14 21:50:13','56',6,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(229,'Tela Pique Jacinto',1,'2017-07-14 21:50:13','27',6,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(230,'Tela Pique Jeans',1,'2017-07-14 21:50:13','66',6,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(231,'Tela Pique Lila',1,'2017-07-14 21:50:13','47',6,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(232,'Tela Pique Marengo',1,'2017-07-14 21:50:13','43',6,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(233,'Tela Pique Melange Oscuro',1,'2017-07-14 21:50:13','42',6,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(234,'Tela Pique Morado',1,'2017-07-14 21:50:13','36',6,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(235,'Tela Pique Mostaza',1,'2017-07-14 21:50:13','59',6,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(236,'Tela Pique Naranja',1,'2017-07-14 21:50:13','49',6,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(237,'Tela Pique Negro',1,'2017-07-14 21:50:13','44',6,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(238,'Tela Pique Obispo',1,'2017-07-14 21:50:13','60',6,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(239,'Tela Pique Paquete Vela',1,'2017-07-14 21:50:13','28',6,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(240,'Tela Pique Rojo Bandera',1,'2017-07-14 21:50:13','54',6,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(241,'Tela Pique Rojo Italiano',1,'2017-07-14 21:50:13','53',6,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(242,'Tela Pique Rosado',1,'2017-07-14 21:50:14','45',6,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(243,'Tela Pique Terracota',1,'2017-07-14 21:50:14','72',6,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(244,'Tela Pique Turquesa',1,'2017-07-14 21:50:14','29',6,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(245,'Tela Pique Vainilla',1,'2017-07-14 21:50:14','63',6,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(246,'Tela Pique Verde Agua',1,'2017-07-14 21:50:14','71',6,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(247,'Tela Pique Verde Botella',1,'2017-07-14 21:50:14','34',6,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(248,'Tela Pique Verde Cata',1,'2017-07-14 21:50:14','38',6,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(249,'Tela Pique Verde Jade',1,'2017-07-14 21:50:14','35',6,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(250,'Tela Pique Verde Limón',1,'2017-07-14 21:50:14','69',6,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(251,'Tela Pique Verde Militar',1,'2017-07-14 21:50:14','65',6,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(252,'Tela Pique Verde Nilo',1,'2017-07-14 21:50:14','64',6,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(253,'Tela Pique Verde Petróleo',1,'2017-07-14 21:50:14','32',6,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(254,'Tela Pique Verde Petróleo Claro',1,'2017-07-14 21:50:14','33',6,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(255,'Tela Pique Verde Rombocol',1,'2017-07-14 21:50:14','37',6,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(256,'Tela Pique Verde Viva',1,'2017-07-14 21:50:14','67',6,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(257,'Tela 7 Amarillo Brasil',1,'2017-07-14 21:50:14','428',7,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(258,'Tela 7 Amarillo Oro',1,'2017-07-14 21:50:14','431',7,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(259,'Tela 7 Amarillo Pato',1,'2017-07-14 21:50:14','424',7,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(260,'Tela 7 Azul Eléctrico',1,'2017-07-14 21:50:14','412',7,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(261,'Tela 7 Azul Pastel',1,'2017-07-14 21:50:15','413',7,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(262,'Tela 7 Blanco',1,'2017-07-14 21:50:15','434',7,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(263,'Tela 7 Café Moro',1,'2017-07-14 21:50:15','438',7,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(264,'Tela 7 Calipso',1,'2017-07-14 21:50:15','414',7,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(265,'Tela 7 Capri',1,'2017-07-14 21:50:15','415',7,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(266,'Tela 7 Crudo',1,'2017-07-14 21:50:15','430',7,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(267,'Tela 7 Damasco',1,'2017-07-14 21:50:15','426',7,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(268,'Tela 7 Grafito',1,'2017-07-14 21:50:15','421',7,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(269,'Tela 7 Guindo',1,'2017-07-14 21:50:15','429',7,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(270,'Tela 7 Lila',1,'2017-07-14 21:50:15','425',7,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(271,'Tela 7 Morado',1,'2017-07-14 21:50:15','420',7,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(272,'Tela 7 Mostaza',1,'2017-07-14 21:50:15','432',7,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(273,'Tela 7 Naranja',1,'2017-07-14 21:50:15','427',7,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(274,'Tela 7 Negro',1,'2017-07-14 21:50:15','422',7,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(275,'Tela 7 Obispo',1,'2017-07-14 21:50:15','433',7,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(276,'Tela 7 Rosado',1,'2017-07-14 21:50:15','423',7,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(277,'Tela 7 Terracota',1,'2017-07-14 21:50:15','440',7,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(278,'Tela 7 Verde Agua',1,'2017-07-14 21:50:15','439',7,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(279,'Tela 7 Verde Botella',1,'2017-07-14 21:50:15','418',7,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(280,'Tela 7 Verde Jade',1,'2017-07-14 21:50:15','419',7,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(281,'Tela 7 Verde Limón',1,'2017-07-14 21:50:16','437',7,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(282,'Tela 7 Verde Manzana',1,'2017-07-14 21:50:16','436',7,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(283,'Tela 7 Verde P. Claro',1,'2017-07-14 21:50:16','417',7,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(284,'Tela 7 Verde Petróleo',1,'2017-07-14 21:50:16','416',7,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(285,'Tela 7 Verde Viva',1,'2017-07-14 21:50:16','435',7,5,1,1,0.00,89.00,0.00,0.00,NULL,1.00,NULL,NULL),(286,'Tela Algodón Rib Jersey Amarillo Brasil',1,'2017-07-14 21:50:16','368',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(287,'Tela Algodón Rib Jersey Amarillo Oro',1,'2017-07-14 21:50:16','371',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(288,'Tela Algodón Rib Jersey Amarillo Pato',1,'2017-07-14 21:50:16','359',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(289,'Tela Algodón Rib Jersey Arena',1,'2017-07-14 21:50:16','375',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(290,'Tela Algodón Rib Jersey Azul Eléctrico',1,'2017-07-14 21:50:16','336',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(291,'Tela Algodón Rib Jersey Azul Francia',1,'2017-07-14 21:50:16','335',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(292,'Tela Algodón Rib Jersey Azul Lider',1,'2017-07-14 21:50:16','343',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(293,'Tela Algodón Rib Jersey Azul Marino',1,'2017-07-14 21:50:16','334',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(294,'Tela Algodón Rib Jersey Azul Pastel',1,'2017-07-14 21:50:16','337',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(295,'Tela Algodón Rib Jersey Azul Petróleo',1,'2017-07-14 21:50:16','344',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(296,'Tela Algodón Rib Jersey Blanco',1,'2017-07-14 21:50:16','374',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(297,'Tela Algodón Rib Jersey Café Moro',1,'2017-07-14 21:50:16','383',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(298,'Tela Algodón Rib Jersey Calipso',1,'2017-07-14 21:50:16','338',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(299,'Tela Algodón Rib Jersey Capri',1,'2017-07-14 21:50:16','339',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(300,'Tela Algodón Rib Jersey Celeste',1,'2017-07-14 21:50:16','363',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(301,'Tela Algodón Rib Jersey Colores',1,'2017-07-14 21:50:16','663',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(302,'Tela Algodón Rib Jersey Coral',1,'2017-07-14 21:50:16','364',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(303,'Tela Algodón Rib Jersey Crudo',1,'2017-07-14 21:50:17','370',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(304,'Tela Algodón Rib Jersey Damasco',1,'2017-07-14 21:50:17','361',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(305,'Tela Algodón Rib Jersey Fucsia',1,'2017-07-14 21:50:17','365',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(306,'Tela Algodón Rib Jersey Grafito',1,'2017-07-14 21:50:17','354',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(307,'Tela Algodón Rib Jersey Gris Claro',1,'2017-07-14 21:50:17','353',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(308,'Tela Algodón Rib Jersey Gris Oscuro',1,'2017-07-14 21:50:17','352',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(309,'Tela Algodón Rib Jersey Guindo',1,'2017-07-14 21:50:17','369',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(310,'Tela Algodón Rib Jersey Jacinto',1,'2017-07-14 21:50:17','340',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(311,'Tela Algodón Rib Jersey Jeans',1,'2017-07-14 21:50:17','379',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(312,'Tela Algodón Rib Jersey Lila',1,'2017-07-14 21:50:17','360',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(313,'Tela Algodón Rib Jersey Marengo',1,'2017-07-14 21:50:17','356',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(314,'Tela Algodón Rib Jersey Melange Oscuro',1,'2017-07-14 21:50:17','355',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(315,'Tela Algodón Rib Jersey Morado',1,'2017-07-14 21:50:17','349',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(316,'Tela Algodón Rib Jersey Mostaza',1,'2017-07-14 21:50:17','372',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(317,'Tela Algodón Rib Jersey Naranja',1,'2017-07-14 21:50:17','362',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(318,'Tela Algodón Rib Jersey Negro',1,'2017-07-14 21:50:17','357',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(319,'Tela Algodón Rib Jersey Obispo',1,'2017-07-14 21:50:17','373',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(320,'Tela Algodón Rib Jersey Paquete Vela',1,'2017-07-14 21:50:17','341',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(321,'Tela Algodón Rib Jersey Rojo Bandera',1,'2017-07-14 21:50:17','367',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(322,'Tela Algodón Rib Jersey Rojo Italiano',1,'2017-07-14 21:50:17','366',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(323,'Tela Algodón Rib Jersey Rosado',1,'2017-07-14 21:50:18','358',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(324,'Tela Algodón Rib Jersey Terracota',1,'2017-07-14 21:50:18','385',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(325,'Tela Algodón Rib Jersey Turquesa',1,'2017-07-14 21:50:18','342',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(326,'Tela Algodón Rib Jersey Vainilla',1,'2017-07-14 21:50:18','376',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(327,'Tela Algodón Rib Jersey Verde  Militar',1,'2017-07-14 21:50:18','378',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(328,'Tela Algodón Rib Jersey Verde Agua',1,'2017-07-14 21:50:18','384',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(329,'Tela Algodón Rib Jersey Verde Botella',1,'2017-07-14 21:50:18','347',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(330,'Tela Algodón Rib Jersey Verde Cata',1,'2017-07-14 21:50:18','351',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(331,'Tela Algodón Rib Jersey Verde Jade',1,'2017-07-14 21:50:18','348',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(332,'Tela Algodón Rib Jersey Verde Limón',1,'2017-07-14 21:50:18','382',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(333,'Tela Algodón Rib Jersey Verde Manzana',1,'2017-07-14 21:50:18','381',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(334,'Tela Algodón Rib Jersey Verde Nilo',1,'2017-07-14 21:50:18','377',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(335,'Tela Algodón Rib Jersey Verde P. Claro',1,'2017-07-14 21:50:18','346',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(336,'Tela Algodón Rib Jersey Verde Petróleo',1,'2017-07-14 21:50:18','345',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(337,'Tela Algodón Rib Jersey Verde Rombocol',1,'2017-07-14 21:50:18','350',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(338,'Tela Algodón Rib Jersey Verde Viva',1,'2017-07-14 21:50:18','380',4,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(339,'Tela 8 Amarillo Brasil',1,'2017-07-14 21:50:18','400',8,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(340,'Tela 8 Amarillo Oro',1,'2017-07-14 21:50:18','403',8,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(341,'Tela 8 Amarillo Pato',1,'2017-07-14 21:50:18','397',8,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(342,'Tela 8 Arena',1,'2017-07-14 21:50:18','407',8,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(343,'Tela 8 Azul Líder',1,'2017-07-14 21:50:18','388',8,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(344,'Tela 8 Azul Petróleo',1,'2017-07-14 21:50:18','389',8,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(345,'Tela 8 Blanco',1,'2017-07-14 21:50:19','406',8,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(346,'Tela 8 Café Moro',1,'2017-07-14 21:50:19','409',8,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(347,'Tela 8 Crudo',1,'2017-07-14 21:50:19','402',8,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(348,'Tela 8 Damasco',1,'2017-07-14 21:50:19','399',8,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(349,'Tela 8 Grafito',1,'2017-07-14 21:50:19','392',8,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(350,'Tela 8 Guindo',1,'2017-07-14 21:50:19','401',8,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(351,'Tela 8 Lila',1,'2017-07-14 21:50:19','398',8,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(352,'Tela 8 Marengo',1,'2017-07-14 21:50:19','394',8,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(353,'Tela 8 Melange Oscuro',1,'2017-07-14 21:50:19','393',8,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(354,'Tela 8 Mostaza',1,'2017-07-14 21:50:19','404',8,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(355,'Tela 8 Negro',1,'2017-07-14 21:50:19','395',8,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(356,'Tela 8 Obispo',1,'2017-07-14 21:50:19','405',8,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(357,'Tela 8 Paquete Vela',1,'2017-07-14 21:50:19','386',8,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(358,'Tela 8 Rosado',1,'2017-07-14 21:50:19','396',8,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(359,'Tela 8 Terracota',1,'2017-07-14 21:50:19','411',8,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(360,'Tela 8 Turquesa',1,'2017-07-14 21:50:19','387',8,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(361,'Tela 8 Verde Agua',1,'2017-07-14 21:50:19','410',8,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(362,'Tela 8 Verde Limón',1,'2017-07-14 21:50:19','408',8,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(363,'Tela 8 Verde P. Claro',1,'2017-07-14 21:50:19','391',8,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(364,'Tela 8 Verde Petróleo',1,'2017-07-14 21:50:19','390',8,5,1,1,0.00,82.00,0.00,0.00,NULL,1.00,NULL,NULL),(365,'Cierre # 5 Colores ',1,'2017-07-14 21:50:19','643',9,8,1,1,0.00,1.00,0.00,0.00,NULL,1.00,NULL,NULL),(366,'Cierre Tractor 75 cm. Colores ',1,'2017-07-14 21:50:19','644',9,8,1,1,0.00,2.00,0.00,0.00,NULL,1.00,NULL,NULL),(367,'Cierre Tractor 75 cm. Negro',1,'2017-07-14 21:50:20','664',9,8,1,1,0.00,2.00,0.00,0.00,NULL,1.00,NULL,NULL),(368,'15 Amarillo Oro',1,'2017-07-14 21:50:20','9',15,7,1,1,0.00,16.00,0.00,0.00,NULL,1.00,NULL,NULL),(369,'15 Arena',1,'2017-07-14 21:50:20','595',15,7,1,1,0.00,16.00,0.00,0.00,NULL,1.00,NULL,NULL),(370,'15 Azul Lider',1,'2017-07-14 21:50:20','593',15,7,1,1,0.00,16.00,0.00,0.00,NULL,1.00,NULL,NULL),(371,'15 Azul Marino',1,'2017-07-14 21:50:20','6',15,7,1,1,0.00,16.00,0.00,0.00,NULL,1.00,NULL,NULL),(372,'15 Azul Pastel',1,'2017-07-14 21:50:20','10',15,7,1,1,0.00,16.00,0.00,0.00,NULL,1.00,NULL,NULL),(373,'15 Blanco',1,'2017-07-14 21:50:20','5',15,7,1,1,0.00,16.00,0.00,0.00,NULL,1.00,NULL,NULL),(374,'15 Cafe Moro',1,'2017-07-14 21:50:20','596',15,7,1,1,0.00,16.00,0.00,0.00,NULL,1.00,NULL,NULL),(375,'15 Celeste',1,'2017-07-14 21:50:20','589',15,7,1,1,0.00,16.00,0.00,0.00,NULL,1.00,NULL,NULL),(376,'15 Fucsia',1,'2017-07-14 21:50:20','591',15,7,1,1,0.00,16.00,0.00,0.00,NULL,1.00,NULL,NULL),(377,'15 Grafito',1,'2017-07-14 21:50:20','603',15,7,1,1,0.00,16.00,0.00,0.00,NULL,1.00,NULL,NULL),(378,'15 Gris Oscuro',1,'2017-07-14 21:50:20','7',15,7,1,1,0.00,16.00,0.00,0.00,NULL,1.00,NULL,NULL),(379,'15 Guindo',1,'2017-07-14 21:50:20','597',15,7,1,1,0.00,16.00,0.00,0.00,NULL,1.00,NULL,NULL),(380,'15 Morado',1,'2017-07-14 21:50:20','602',15,7,1,1,0.00,16.00,0.00,0.00,NULL,1.00,NULL,NULL),(381,'15 Mostaza',1,'2017-07-14 21:50:20','594',15,7,1,1,0.00,16.00,0.00,0.00,NULL,1.00,NULL,NULL),(382,'15 Naranja',1,'2017-07-14 21:50:20','598',15,7,1,1,0.00,16.00,0.00,0.00,NULL,1.00,NULL,NULL),(383,'15 Negro',1,'2017-07-14 21:50:20','3',15,7,1,1,0.00,16.00,0.00,0.00,NULL,1.00,NULL,NULL),(384,'15 Rojo Bandera',1,'2017-07-14 21:50:20','4',15,7,1,1,0.00,16.00,0.00,0.00,NULL,1.00,NULL,NULL),(385,'15 Rosado',1,'2017-07-14 21:50:20','592',15,7,1,1,0.00,16.00,0.00,0.00,NULL,1.00,NULL,NULL),(386,'15 Terracota',1,'2017-07-14 21:50:20','599',15,7,1,1,0.00,16.00,0.00,0.00,NULL,1.00,NULL,NULL),(387,'15 Turquesa',1,'2017-07-14 21:50:20','8',15,7,1,1,0.00,16.00,0.00,0.00,NULL,1.00,NULL,NULL),(388,'15 Verde Jade',1,'2017-07-14 21:50:21','590',15,7,1,1,0.00,16.00,0.00,0.00,NULL,1.00,NULL,NULL),(389,'15 Verde Manzana',1,'2017-07-14 21:50:21','600',15,7,1,1,0.00,16.00,0.00,0.00,NULL,1.00,NULL,NULL),(390,'15 Verde Viva',1,'2017-07-14 21:50:21','601',15,7,1,1,0.00,16.00,0.00,0.00,NULL,1.00,NULL,NULL),(391,'16 Amarillo Brasil',1,'2017-07-14 21:50:21','475',16,8,1,1,0.00,10.00,0.00,0.00,NULL,1.00,NULL,NULL),(392,'16 Amarillo Oro',1,'2017-07-14 21:50:21','478',16,8,1,1,0.00,10.00,0.00,0.00,NULL,1.00,NULL,NULL),(393,'16 Amarillo Pato',1,'2017-07-14 21:50:21','466',16,8,1,1,0.00,10.00,0.00,0.00,NULL,1.00,NULL,NULL),(394,'16 Arena',1,'2017-07-14 21:50:21','482',16,8,1,1,0.00,10.00,0.00,0.00,NULL,1.00,NULL,NULL),(395,'16 Azul Eléctrico',1,'2017-07-14 21:50:21','444',16,8,1,1,0.00,10.00,0.00,0.00,NULL,1.00,NULL,NULL),(396,'16 Azul Francia',1,'2017-07-14 21:50:21','443',16,8,1,1,0.00,10.00,0.00,0.00,NULL,1.00,NULL,NULL),(397,'16 Azul Lider',1,'2017-07-14 21:50:21','450',16,8,1,1,0.00,10.00,0.00,0.00,NULL,1.00,NULL,NULL),(398,'16 Azul Marino',1,'2017-07-14 21:50:21','442',16,8,1,1,0.00,10.00,0.00,0.00,NULL,1.00,NULL,NULL),(399,'16 Azul Pastel',1,'2017-07-14 21:50:21','445',16,8,1,1,0.00,10.00,0.00,0.00,NULL,1.00,NULL,NULL),(400,'16 Azul Petróleo',1,'2017-07-14 21:50:21','451',16,8,1,1,0.00,10.00,0.00,0.00,NULL,1.00,NULL,NULL),(401,'16 Blanco',1,'2017-07-14 21:50:21','481',16,8,1,1,0.00,10.00,0.00,0.00,NULL,1.00,NULL,NULL),(402,'16 Café Moro',1,'2017-07-14 21:50:21','490',16,8,1,1,0.00,10.00,0.00,0.00,NULL,1.00,NULL,NULL),(403,'16 Calipso',1,'2017-07-14 21:50:21','441',16,8,1,1,0.00,10.00,0.00,0.00,NULL,1.00,NULL,NULL),(404,'16 Capri',1,'2017-07-14 21:50:21','446',16,8,1,1,0.00,10.00,0.00,0.00,NULL,1.00,NULL,NULL),(405,'16 Celeste',1,'2017-07-14 21:50:21','470',16,8,1,1,0.00,10.00,0.00,0.00,NULL,1.00,NULL,NULL),(406,'16 Colores',1,'2017-07-14 21:50:21','623',16,8,1,1,0.00,10.00,0.00,0.00,NULL,1.00,NULL,NULL),(407,'16 Coral',1,'2017-07-14 21:50:21','471',16,8,1,1,0.00,10.00,0.00,0.00,NULL,1.00,NULL,NULL),(408,'16 Crudo',1,'2017-07-14 21:50:21','477',16,8,1,1,0.00,10.00,0.00,0.00,NULL,1.00,NULL,NULL),(409,'16 Damasco',1,'2017-07-14 21:50:22','468',16,8,1,1,0.00,10.00,0.00,0.00,NULL,1.00,NULL,NULL),(410,'16 Fucsia',1,'2017-07-14 21:50:22','472',16,8,1,1,0.00,10.00,0.00,0.00,NULL,1.00,NULL,NULL),(411,'16 Grafito',1,'2017-07-14 21:50:22','461',16,8,1,1,0.00,10.00,0.00,0.00,NULL,1.00,NULL,NULL),(412,'16 Gris Claro',1,'2017-07-14 21:50:22','460',16,8,1,1,0.00,10.00,0.00,0.00,NULL,1.00,NULL,NULL),(413,'16 Gris Oscuro',1,'2017-07-14 21:50:22','459',16,8,1,1,0.00,10.00,0.00,0.00,NULL,1.00,NULL,NULL),(414,'16 Guindo',1,'2017-07-14 21:50:22','476',16,8,1,1,0.00,10.00,0.00,0.00,NULL,1.00,NULL,NULL),(415,'16 Jacinto',1,'2017-07-14 21:50:22','447',16,8,1,1,0.00,10.00,0.00,0.00,NULL,1.00,NULL,NULL),(416,'16 Jeans',1,'2017-07-14 21:50:22','486',16,8,1,1,0.00,10.00,0.00,0.00,NULL,1.00,NULL,NULL),(417,'16 Lila',1,'2017-07-14 21:50:22','467',16,8,1,1,0.00,10.00,0.00,0.00,NULL,1.00,NULL,NULL),(418,'16 Marengo',1,'2017-07-14 21:50:22','463',16,8,1,1,0.00,10.00,0.00,0.00,NULL,1.00,NULL,NULL),(419,'16 Melange Oscuro',1,'2017-07-14 21:50:22','462',16,8,1,1,0.00,10.00,0.00,0.00,NULL,1.00,NULL,NULL),(420,'16 Morado',1,'2017-07-14 21:50:22','456',16,8,1,1,0.00,10.00,0.00,0.00,NULL,1.00,NULL,NULL),(421,'16 Mostaza',1,'2017-07-14 21:50:22','479',16,8,1,1,0.00,10.00,0.00,0.00,NULL,1.00,NULL,NULL),(422,'16 Naranja',1,'2017-07-14 21:50:22','469',16,8,1,1,0.00,10.00,0.00,0.00,NULL,1.00,NULL,NULL),(423,'16 Negro',1,'2017-07-14 21:50:22','464',16,8,1,1,0.00,10.00,0.00,0.00,NULL,1.00,NULL,NULL),(424,'16 Obispo',1,'2017-07-14 21:50:22','480',16,8,1,1,0.00,10.00,0.00,0.00,NULL,1.00,NULL,NULL),(425,'16 Paquete Vela',1,'2017-07-14 21:50:22','448',16,8,1,1,0.00,10.00,0.00,0.00,NULL,1.00,NULL,NULL),(426,'16 Rojo Bandera',1,'2017-07-14 21:50:22','474',16,8,1,1,0.00,10.00,0.00,0.00,NULL,1.00,NULL,NULL),(427,'16 Rojo Iataliano',1,'2017-07-14 21:50:22','473',16,8,1,1,0.00,10.00,0.00,0.00,NULL,1.00,NULL,NULL),(428,'16 Rosado',1,'2017-07-14 21:50:22','465',16,8,1,1,0.00,10.00,0.00,0.00,NULL,1.00,NULL,NULL),(429,'16 Terracota',1,'2017-07-14 21:50:23','492',16,8,1,1,0.00,10.00,0.00,0.00,NULL,1.00,NULL,NULL),(430,'16 Turquesa',1,'2017-07-14 21:50:23','449',16,8,1,1,0.00,10.00,0.00,0.00,NULL,1.00,NULL,NULL),(431,'16 Vainilla',1,'2017-07-14 21:50:23','483',16,8,1,1,0.00,10.00,0.00,0.00,NULL,1.00,NULL,NULL),(432,'16 Verde Agua',1,'2017-07-14 21:50:23','491',16,8,1,1,0.00,10.00,0.00,0.00,NULL,1.00,NULL,NULL),(433,'16 Verde Botella',1,'2017-07-14 21:50:23','454',16,8,1,1,0.00,10.00,0.00,0.00,NULL,1.00,NULL,NULL),(434,'16 Verde Cata',1,'2017-07-14 21:50:23','458',16,8,1,1,0.00,10.00,0.00,0.00,NULL,1.00,NULL,NULL),(435,'16 Verde Jade',1,'2017-07-14 21:50:23','455',16,8,1,1,0.00,10.00,0.00,0.00,NULL,1.00,NULL,NULL),(436,'16 Verde Limón',1,'2017-07-14 21:50:23','489',16,8,1,1,0.00,10.00,0.00,0.00,NULL,1.00,NULL,NULL),(437,'16 Verde Manzana',1,'2017-07-14 21:50:23','488',16,8,1,1,0.00,10.00,0.00,0.00,NULL,1.00,NULL,NULL),(438,'16 Verde Militar',1,'2017-07-14 21:50:23','485',16,8,1,1,0.00,10.00,0.00,0.00,NULL,1.00,NULL,NULL),(439,'16 Verde Nilo',1,'2017-07-14 21:50:23','484',16,8,1,1,0.00,10.00,0.00,0.00,NULL,1.00,NULL,NULL),(440,'16 Verde P. Claro',1,'2017-07-14 21:50:23','453',16,8,1,1,0.00,10.00,0.00,0.00,NULL,1.00,NULL,NULL),(441,'16 Verde Petróleo',1,'2017-07-14 21:50:23','452',16,8,1,1,0.00,10.00,0.00,0.00,NULL,1.00,NULL,NULL),(442,'16 Verde Rombocol',1,'2017-07-14 21:50:23','457',16,8,1,1,0.00,10.00,0.00,0.00,NULL,1.00,NULL,NULL),(443,'16 Verde Viva',1,'2017-07-14 21:50:23','487',16,8,1,1,0.00,10.00,0.00,0.00,NULL,1.00,NULL,NULL),(444,'17 Amarillo Oro',1,'2017-07-14 21:50:23','552',17,3,1,1,0.00,54.00,0.00,0.00,NULL,1.00,NULL,NULL),(445,'17 Arena',1,'2017-07-14 21:50:23','554',17,3,1,1,0.00,54.00,0.00,0.00,NULL,1.00,NULL,NULL),(446,'17 Asul Pastel',1,'2017-07-14 21:50:23','546',17,3,1,1,0.00,54.00,0.00,0.00,NULL,1.00,NULL,NULL),(447,'17 Azul Marino',1,'2017-07-14 21:50:23','545',17,3,1,1,0.00,54.00,0.00,0.00,NULL,1.00,NULL,NULL),(448,'17 Blanco',1,'2017-07-14 21:50:23','553',17,3,1,1,0.00,46.00,0.00,0.00,NULL,1.00,NULL,NULL),(449,'17 Crudo',1,'2017-07-14 21:50:24','551',17,3,1,1,0.00,54.00,0.00,0.00,NULL,1.00,NULL,NULL),(450,'17 Naranja',1,'2017-07-14 21:50:24','549',17,3,1,1,0.00,54.00,0.00,0.00,NULL,1.00,NULL,NULL),(451,'17 Negro',1,'2017-07-14 21:50:24','548',17,3,1,1,0.00,54.00,0.00,0.00,NULL,1.00,NULL,NULL),(452,'17 Rojo Bandera',1,'2017-07-14 21:50:24','550',17,3,1,1,0.00,54.00,0.00,0.00,NULL,1.00,NULL,NULL),(453,'17 Turquesa',1,'2017-07-14 21:50:24','547',17,3,1,1,0.00,54.00,0.00,0.00,NULL,1.00,NULL,NULL),(454,'17 Verde Militar',1,'2017-07-14 21:50:24','555',17,3,1,1,0.00,54.00,0.00,0.00,NULL,1.00,NULL,NULL),(455,'25 Amarillo Brasil',1,'2017-07-14 21:50:24','527',25,3,1,1,0.00,14.00,0.00,0.00,NULL,1.00,NULL,NULL),(456,'25 Amarillo Oro',1,'2017-07-14 21:50:24','530',25,3,1,1,0.00,14.00,0.00,0.00,NULL,1.00,NULL,NULL),(457,'25 Amarillo Pato',1,'2017-07-14 21:50:24','518',25,3,1,1,0.00,14.00,0.00,0.00,NULL,1.00,NULL,NULL),(458,'25 Arena',1,'2017-07-14 21:50:24','534',25,3,1,1,0.00,14.00,0.00,0.00,NULL,1.00,NULL,NULL),(459,'25 Azul Eléctrico',1,'2017-07-14 21:50:24','495',25,3,1,1,0.00,14.00,0.00,0.00,NULL,1.00,NULL,NULL),(460,'25 Azul Francia',1,'2017-07-14 21:50:24','494',25,3,1,1,0.00,14.00,0.00,0.00,NULL,1.00,NULL,NULL),(461,'25 Azul Líder',1,'2017-07-14 21:50:24','502',25,3,1,1,0.00,14.00,0.00,0.00,NULL,1.00,NULL,NULL),(462,'25 Azul Marino',1,'2017-07-14 21:50:24','493',25,3,1,1,0.00,14.00,0.00,0.00,NULL,1.00,NULL,NULL),(463,'25 Azul Pastel',1,'2017-07-14 21:50:24','496',25,3,1,1,0.00,14.00,0.00,0.00,NULL,1.00,NULL,NULL),(464,'25 Azul Petróleo',1,'2017-07-14 21:50:24','503',25,3,1,1,0.00,14.00,0.00,0.00,NULL,1.00,NULL,NULL),(465,'25 Blanco',1,'2017-07-14 21:50:24','533',25,3,1,1,0.00,13.00,0.00,0.00,NULL,1.00,NULL,NULL),(466,'25 Café Moro',1,'2017-07-14 21:50:24','542',25,3,1,1,0.00,14.00,0.00,0.00,NULL,1.00,NULL,NULL),(467,'25 Calipso',1,'2017-07-14 21:50:24','497',25,3,1,1,0.00,14.00,0.00,0.00,NULL,1.00,NULL,NULL),(468,'25 Capri',1,'2017-07-14 21:50:25','498',25,3,1,1,0.00,14.00,0.00,0.00,NULL,1.00,NULL,NULL),(469,'25 Celeste',1,'2017-07-14 21:50:25','522',25,3,1,1,0.00,14.00,0.00,0.00,NULL,1.00,NULL,NULL),(470,'25 Colores',1,'2017-07-14 21:50:25','622',25,3,1,1,0.00,14.00,0.00,0.00,NULL,1.00,NULL,NULL),(471,'25 Coral',1,'2017-07-14 21:50:25','523',25,3,1,1,0.00,14.00,0.00,0.00,NULL,1.00,NULL,NULL),(472,'25 Crudo',1,'2017-07-14 21:50:25','529',25,3,1,1,0.00,14.00,0.00,0.00,NULL,1.00,NULL,NULL),(473,'25 Damasco',1,'2017-07-14 21:50:25','520',25,3,1,1,0.00,14.00,0.00,0.00,NULL,1.00,NULL,NULL),(474,'25 Fucsia',1,'2017-07-14 21:50:25','524',25,3,1,1,0.00,14.00,0.00,0.00,NULL,1.00,NULL,NULL),(475,'25 Grafito',1,'2017-07-14 21:50:25','513',25,3,1,1,0.00,14.00,0.00,0.00,NULL,1.00,NULL,NULL),(476,'25 Gris Claro',1,'2017-07-14 21:50:25','512',25,3,1,1,0.00,14.00,0.00,0.00,NULL,1.00,NULL,NULL),(477,'25 Gris Oscuro',1,'2017-07-14 21:50:25','511',25,3,1,1,0.00,14.00,0.00,0.00,NULL,1.00,NULL,NULL),(478,'25 Guindo',1,'2017-07-14 21:50:25','528',25,3,1,1,0.00,14.00,0.00,0.00,NULL,1.00,NULL,NULL),(479,'25 Jacinto',1,'2017-07-14 21:50:25','499',25,3,1,1,0.00,14.00,0.00,0.00,NULL,1.00,NULL,NULL),(480,'25 Jeans',1,'2017-07-14 21:50:25','538',25,3,1,1,0.00,14.00,0.00,0.00,NULL,1.00,NULL,NULL),(481,'25 Lila',1,'2017-07-14 21:50:25','519',25,3,1,1,0.00,14.00,0.00,0.00,NULL,1.00,NULL,NULL),(482,'25 Marengo',1,'2017-07-14 21:50:25','515',25,3,1,1,0.00,14.00,0.00,0.00,NULL,1.00,NULL,NULL),(483,'25 Melange Oscuro',1,'2017-07-14 21:50:25','514',25,3,1,1,0.00,14.00,0.00,0.00,NULL,1.00,NULL,NULL),(484,'25 Morado',1,'2017-07-14 21:50:25','508',25,3,1,1,0.00,14.00,0.00,0.00,NULL,1.00,NULL,NULL),(485,'25 Mostaza',1,'2017-07-14 21:50:25','531',25,3,1,1,0.00,14.00,0.00,0.00,NULL,1.00,NULL,NULL),(486,'25 Naranja',1,'2017-07-14 21:50:25','521',25,3,1,1,0.00,14.00,0.00,0.00,NULL,1.00,NULL,NULL),(487,'25 Negro',1,'2017-07-14 21:50:25','516',25,3,1,1,0.00,14.00,0.00,0.00,NULL,1.00,NULL,NULL),(488,'25 Obispo',1,'2017-07-14 21:50:25','532',25,3,1,1,0.00,14.00,0.00,0.00,NULL,1.00,NULL,NULL),(489,'25 Paquete Vela',1,'2017-07-14 21:50:26','500',25,3,1,1,0.00,14.00,0.00,0.00,NULL,1.00,NULL,NULL),(490,'25 Rojo Bandera',1,'2017-07-14 21:50:26','526',25,3,1,1,0.00,14.00,0.00,0.00,NULL,1.00,NULL,NULL),(491,'25 Rojo Italiano',1,'2017-07-14 21:50:26','525',25,3,1,1,0.00,14.00,0.00,0.00,NULL,1.00,NULL,NULL),(492,'25 Rosado',1,'2017-07-14 21:50:26','517',25,3,1,1,0.00,14.00,0.00,0.00,NULL,1.00,NULL,NULL),(493,'25 Terracota',1,'2017-07-14 21:50:26','544',25,3,1,1,0.00,14.00,0.00,0.00,NULL,1.00,NULL,NULL),(494,'25 Turquesa',1,'2017-07-14 21:50:26','501',25,3,1,1,0.00,14.00,0.00,0.00,NULL,1.00,NULL,NULL),(495,'25 Vainilla',1,'2017-07-14 21:50:26','535',25,3,1,1,0.00,14.00,0.00,0.00,NULL,1.00,NULL,NULL),(496,'25 Verde Agua',1,'2017-07-14 21:50:26','543',25,3,1,1,0.00,14.00,0.00,0.00,NULL,1.00,NULL,NULL),(497,'25 Verde Botella',1,'2017-07-14 21:50:26','506',25,3,1,1,0.00,14.00,0.00,0.00,NULL,1.00,NULL,NULL),(498,'25 Verde Cata',1,'2017-07-14 21:50:26','510',25,3,1,1,0.00,14.00,0.00,0.00,NULL,1.00,NULL,NULL),(499,'25 Verde Jade',1,'2017-07-14 21:50:26','507',25,3,1,1,0.00,14.00,0.00,0.00,NULL,1.00,NULL,NULL),(500,'25 Verde Limón',1,'2017-07-14 21:50:26','541',25,3,1,1,0.00,14.00,0.00,0.00,NULL,1.00,NULL,NULL),(501,'25 Verde Manzana',1,'2017-07-14 21:50:26','540',25,3,1,1,0.00,14.00,0.00,0.00,NULL,1.00,NULL,NULL),(502,'25 Verde Militar',1,'2017-07-14 21:50:26','537',25,3,1,1,0.00,14.00,0.00,0.00,NULL,1.00,NULL,NULL),(503,'25 Verde Nilo',1,'2017-07-14 21:50:26','536',25,3,1,1,0.00,14.00,0.00,0.00,NULL,1.00,NULL,NULL),(504,'25 Verde P. Claro',1,'2017-07-14 21:50:26','505',25,3,1,1,0.00,14.00,0.00,0.00,NULL,1.00,NULL,NULL),(505,'25 Verde Petróleo',1,'2017-07-14 21:50:26','504',25,3,1,1,0.00,14.00,0.00,0.00,NULL,1.00,NULL,NULL),(506,'25 Verde Rombocol',1,'2017-07-14 21:50:26','509',25,3,1,1,0.00,14.00,0.00,0.00,NULL,1.00,NULL,NULL),(507,'25 Verde Viva',1,'2017-07-14 21:50:26','539',25,3,1,1,0.00,14.00,0.00,0.00,NULL,1.00,NULL,NULL),(508,'18 Amarillo Oro',1,'2017-07-14 21:50:26','635',18,2,1,1,0.00,16.00,0.00,0.00,NULL,1.00,NULL,NULL),(509,'18 Arena',1,'2017-07-14 21:50:26','625',18,2,1,1,0.00,16.00,0.00,0.00,NULL,1.00,NULL,NULL),(510,'18 Azul Lider',1,'2017-07-14 21:50:26','636',18,2,1,1,0.00,16.00,0.00,0.00,NULL,1.00,NULL,NULL),(511,'18 Azul Marino',1,'2017-07-14 21:50:27','624',18,2,1,1,0.00,16.00,0.00,0.00,NULL,1.00,NULL,NULL),(512,'18 Azul Pastel',1,'2017-07-14 21:50:27','634',18,2,1,1,0.00,16.00,0.00,0.00,NULL,1.00,NULL,NULL),(513,'18 Barnie',1,'2017-07-14 21:50:27','637',18,2,1,1,0.00,16.00,0.00,0.00,NULL,1.00,NULL,NULL),(514,'18 Blanco',1,'2017-07-14 21:50:27','631',18,2,1,1,0.00,16.00,0.00,0.00,NULL,1.00,NULL,NULL),(515,'18 Cafe Moro',1,'2017-07-14 21:50:27','630',18,2,1,1,0.00,16.00,0.00,0.00,NULL,1.00,NULL,NULL),(516,'18 Grafito',1,'2017-07-14 21:50:27','627',18,2,1,1,0.00,16.00,0.00,0.00,NULL,1.00,NULL,NULL),(517,'18 Mostaza',1,'2017-07-14 21:50:27','629',18,2,1,1,0.00,16.00,0.00,0.00,NULL,1.00,NULL,NULL),(518,'18 Naranja',1,'2017-07-14 21:50:27','633',18,2,1,1,0.00,16.00,0.00,0.00,NULL,1.00,NULL,NULL),(519,'18 Negro',1,'2017-07-14 21:50:27','639',18,2,1,1,0.00,16.00,0.00,0.00,NULL,1.00,NULL,NULL),(520,'18 Rojo Bandera',1,'2017-07-14 21:50:27','638',18,2,1,1,0.00,16.00,0.00,0.00,NULL,1.00,NULL,NULL),(521,'18 Rosado',1,'2017-07-14 21:50:27','632',18,2,1,1,0.00,16.00,0.00,0.00,NULL,1.00,NULL,NULL),(522,'18 Terracota',1,'2017-07-14 21:50:27','628',18,2,1,1,0.00,16.00,0.00,0.00,NULL,1.00,NULL,NULL),(523,'18 Turquesa',1,'2017-07-14 21:50:27','626',18,2,1,1,0.00,16.00,0.00,0.00,NULL,1.00,NULL,NULL),(524,'Tela Sintetico Azul Lider',1,'2017-07-14 21:50:27','618',19,4,1,1,0.00,15.00,0.00,0.00,NULL,1.00,NULL,NULL),(525,'Tela Sintetico Fucsia',1,'2017-07-14 21:50:27','620',19,4,1,1,0.00,15.00,0.00,0.00,NULL,1.00,NULL,NULL),(526,'Tela Sintetico Grafito',1,'2017-07-14 21:50:27','617',19,4,1,1,0.00,15.00,0.00,0.00,NULL,1.00,NULL,NULL),(527,'Tela Sintetico Gris Claro',1,'2017-07-14 21:50:27','607',19,4,1,1,0.00,15.00,0.00,0.00,NULL,1.00,NULL,NULL),(528,'Tela Sintetico Guindo',1,'2017-07-14 21:50:27','614',19,4,1,1,0.00,15.00,0.00,0.00,NULL,1.00,NULL,NULL),(529,'Tela 19 Amarillo Oro',1,'2017-07-14 21:50:27','606',19,4,1,1,0.00,15.00,0.00,0.00,NULL,1.00,NULL,NULL),(530,'Tela 19 Azul Marino',1,'2017-07-14 21:50:27','605',19,4,1,1,0.00,15.00,0.00,0.00,NULL,1.00,NULL,NULL),(531,'Tela 19 Azul Pastel',1,'2017-07-14 21:50:27','608',19,4,1,1,0.00,15.00,0.00,0.00,NULL,1.00,NULL,NULL),(532,'Tela 19 Blanco',1,'2017-07-14 21:50:27','609',19,4,1,1,0.00,15.00,0.00,0.00,NULL,1.00,NULL,NULL),(533,'Tela 19 Celeste',1,'2017-07-14 21:50:27','611',19,4,1,1,0.00,15.00,0.00,0.00,NULL,1.00,NULL,NULL),(534,'Tela 19 Naranja',1,'2017-07-14 21:50:27','621',19,4,1,1,0.00,15.00,0.00,0.00,NULL,1.00,NULL,NULL),(535,'Tela 19 Negro',1,'2017-07-14 21:50:28','604',19,4,1,1,0.00,15.00,0.00,0.00,NULL,1.00,NULL,NULL),(536,'Tela 19 Rojo Bandera',1,'2017-07-14 21:50:28','612',19,4,1,1,0.00,15.00,0.00,0.00,NULL,1.00,NULL,NULL),(537,'Tela 19 Turquesa',1,'2017-07-14 21:50:28','613',19,4,1,1,0.00,15.00,0.00,0.00,NULL,1.00,NULL,NULL),(538,'Tela 19 Verde Manzana',1,'2017-07-14 21:50:28','610',19,4,1,1,0.00,15.00,0.00,0.00,NULL,1.00,NULL,NULL),(539,'Tela Sintetico Mostaza',1,'2017-07-14 21:50:28','616',19,4,1,1,0.00,15.00,0.00,0.00,NULL,1.00,NULL,NULL),(540,'Tela Sintetico Verde Flourecente',1,'2017-07-14 21:50:28','619',19,4,1,1,0.00,15.00,0.00,0.00,NULL,1.00,NULL,NULL),(541,'Tela Sintetico Verde Jade',1,'2017-07-14 21:50:28','615',19,4,1,1,0.00,15.00,0.00,0.00,NULL,1.00,NULL,NULL),(542,'Tejido Botamanga Amarillo Brasil',1,'2017-07-14 21:50:28','316',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(543,'Tejido Botamanga Amarillo Oro',1,'2017-07-14 21:50:28','319',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(544,'Tejido Botamanga Amarillo Pato',1,'2017-07-14 21:50:28','306',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(545,'Tejido Botamanga Arena',1,'2017-07-14 21:50:28','323',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(546,'Tejido Botamanga Azul Eléctrico',1,'2017-07-14 21:50:28','283',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(547,'Tejido Botamanga Azul Francia',1,'2017-07-14 21:50:28','282',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(548,'Tejido Botamanga Azul Líder',1,'2017-07-14 21:50:28','290',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(549,'Tejido Botamanga Azul Marino',1,'2017-07-14 21:50:28','281',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(550,'Tejido Botamanga Azul Pastel',1,'2017-07-14 21:50:28','284',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(551,'Tejido Botamanga Azul Petróleo',1,'2017-07-14 21:50:29','291',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(552,'Tejido Botamanga Blanco',1,'2017-07-14 21:50:29','322',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(553,'Tejido Botamanga Cafe Moro',1,'2017-07-14 21:50:29','331',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(554,'Tejido Botamanga Calipso',1,'2017-07-14 21:50:29','285',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(555,'Tejido Botamanga Capri',1,'2017-07-14 21:50:29','286',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(556,'Tejido Botamanga Celeste',1,'2017-07-14 21:50:29','311',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(557,'Tejido Botamanga Coral',1,'2017-07-14 21:50:29','312',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(558,'Tejido Botamanga Crudo',1,'2017-07-14 21:50:29','318',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(559,'Tejido Botamanga Damasco',1,'2017-07-14 21:50:29','309',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(560,'Tejido Botamanga Fucsia',1,'2017-07-14 21:50:29','313',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(561,'Tejido Botamanga Grafito',1,'2017-07-14 21:50:29','301',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(562,'Tejido Botamanga Gris Claro',1,'2017-07-14 21:50:29','300',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(563,'Tejido Botamanga Gris Oscuro',1,'2017-07-14 21:50:29','299',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(564,'Tejido Botamanga Guindo',1,'2017-07-14 21:50:29','317',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(565,'Tejido Botamanga Jacinto',1,'2017-07-14 21:50:29','287',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(566,'Tejido Botamanga Jeans',1,'2017-07-14 21:50:29','327',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(567,'Tejido Botamanga Lila',1,'2017-07-14 21:50:29','308',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(568,'Tejido Botamanga Marengo',1,'2017-07-14 21:50:29','303',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(569,'Tejido Botamanga Melange Oscuro',1,'2017-07-14 21:50:29','302',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(570,'Tejido Botamanga Morado',1,'2017-07-14 21:50:29','295',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(571,'Tejido Botamanga Mostaza',1,'2017-07-14 21:50:29','320',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(572,'Tejido Botamanga Naranja',1,'2017-07-14 21:50:29','310',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(573,'Tejido Botamanga Negro',1,'2017-07-14 21:50:29','304',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(574,'Tejido Botamanga Obispo',1,'2017-07-14 21:50:30','321',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(575,'Tejido Botamanga Paquete Vela',1,'2017-07-14 21:50:30','288',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(576,'Tejido Botamanga Rojo Bandera',1,'2017-07-14 21:50:30','315',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(577,'Tejido Botamanga Rojo Italiano',1,'2017-07-14 21:50:30','314',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(578,'Tejido Botamanga Rosado',1,'2017-07-14 21:50:30','305',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(579,'Tejido Botamanga Terracota',1,'2017-07-14 21:50:30','333',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(580,'Tejido Botamanga Turquesa',1,'2017-07-14 21:50:30','289',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(581,'Tejido Botamanga Vainilla',1,'2017-07-14 21:50:30','324',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(582,'Tejido Botamanga Verde Agua',1,'2017-07-14 21:50:30','332',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(583,'Tejido Botamanga Verde Botella',1,'2017-07-14 21:50:30','293',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(584,'Tejido Botamanga Verde Cata',1,'2017-07-14 21:50:30','298',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(585,'Tejido Botamanga Verde Jade',1,'2017-07-14 21:50:30','294',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(586,'Tejido Botamanga Verde Limon',1,'2017-07-14 21:50:30','330',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(587,'Tejido Botamanga Verde Manzana',1,'2017-07-14 21:50:30','329',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(588,'Tejido Botamanga Verde Militar',1,'2017-07-14 21:50:30','326',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(589,'Tejido Botamanga Verde Nilo',1,'2017-07-14 21:50:30','325',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(590,'Tejido Botamanga Verde P. Claro',1,'2017-07-14 21:50:30','292',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(591,'Tejido Botamanga Verde Petróleo',1,'2017-07-14 21:50:30','296',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(592,'Tejido Botamanga Verde Rombocol',1,'2017-07-14 21:50:30','297',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(593,'Tejido Botamanga Verde Viva',1,'2017-07-14 21:50:30','328',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(594,'Tejido Cuello Amarillo Brasil',1,'2017-07-14 21:50:30','263',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(595,'Tejido Cuello Amarillo Oro',1,'2017-07-14 21:50:30','266',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(596,'Tejido Cuello Amarillo Pato',1,'2017-07-14 21:50:30','254',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(597,'Tejido Cuello Arena',1,'2017-07-14 21:50:31','270',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(598,'Tejido Cuello Azul Eléctrico',1,'2017-07-14 21:50:31','231',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(599,'Tejido Cuello Azul Francia',1,'2017-07-14 21:50:31','230',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(600,'Tejido Cuello Azul Líder',1,'2017-07-14 21:50:31','238',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(601,'Tejido Cuello Azul Marino',1,'2017-07-14 21:50:31','229',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(602,'Tejido Cuello Azul Pastel',1,'2017-07-14 21:50:31','232',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(603,'Tejido Cuello Azul Petróleo',1,'2017-07-14 21:50:31','239',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(604,'Tejido Cuello Blanco',1,'2017-07-14 21:50:31','269',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(605,'Tejido Cuello Café Moro',1,'2017-07-14 21:50:31','278',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(606,'Tejido Cuello Calipso',1,'2017-07-14 21:50:31','233',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(607,'Tejido Cuello Capri',1,'2017-07-14 21:50:31','234',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(608,'Tejido Cuello Celeste',1,'2017-07-14 21:50:31','258',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(609,'Tejido Cuello Coral',1,'2017-07-14 21:50:31','259',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(610,'Tejido Cuello Crudo',1,'2017-07-14 21:50:31','265',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(611,'Tejido Cuello Damasco',1,'2017-07-14 21:50:31','256',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(612,'Tejido Cuello Fucsia',1,'2017-07-14 21:50:31','260',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(613,'Tejido Cuello Grafito',1,'2017-07-14 21:50:31','249',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(614,'Tejido Cuello Gris Claro',1,'2017-07-14 21:50:31','248',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(615,'Tejido Cuello Gris Oscuro',1,'2017-07-14 21:50:31','247',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(616,'Tejido Cuello Guindo',1,'2017-07-14 21:50:31','264',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(617,'Tejido Cuello Jacinto',1,'2017-07-14 21:50:32','235',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(618,'Tejido Cuello Jeans',1,'2017-07-14 21:50:32','274',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(619,'Tejido Cuello Lila',1,'2017-07-14 21:50:32','255',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(620,'Tejido Cuello Marengo',1,'2017-07-14 21:50:32','251',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(621,'Tejido Cuello Melange Oscuro',1,'2017-07-14 21:50:32','250',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(622,'Tejido Cuello Morado',1,'2017-07-14 21:50:32','244',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(623,'Tejido Cuello Mostaza',1,'2017-07-14 21:50:32','267',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(624,'Tejido Cuello Naranja',1,'2017-07-14 21:50:32','257',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(625,'Tejido Cuello Negro',1,'2017-07-14 21:50:32','252',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(626,'Tejido Cuello Obispo',1,'2017-07-14 21:50:32','268',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(627,'Tejido Cuello Paquete Vela',1,'2017-07-14 21:50:32','236',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(628,'Tejido Cuello Rojo Bandera',1,'2017-07-14 21:50:32','262',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(629,'Tejido Cuello Rojo Italiano',1,'2017-07-14 21:50:32','261',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(630,'Tejido Cuello Rosado',1,'2017-07-14 21:50:32','253',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(631,'Tejido Cuello Terracota',1,'2017-07-14 21:50:32','280',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(632,'Tejido Cuello Turquesa',1,'2017-07-14 21:50:32','237',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(633,'Tejido Cuello Vainilla',1,'2017-07-14 21:50:32','271',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(634,'Tejido Cuello Verde Agua',1,'2017-07-14 21:50:32','279',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(635,'Tejido Cuello Verde Botella',1,'2017-07-14 21:50:32','242',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(636,'Tejido Cuello Verde Cata',1,'2017-07-14 21:50:32','246',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(637,'Tejido Cuello Verde Jade',1,'2017-07-14 21:50:32','243',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(638,'Tejido Cuello Verde Limón',1,'2017-07-14 21:50:32','277',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(639,'Tejido Cuello Verde Manzana',1,'2017-07-14 21:50:32','276',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(640,'Tejido Cuello Verde Militar',1,'2017-07-14 21:50:33','273',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(641,'Tejido Cuello Verde Nilo',1,'2017-07-14 21:50:33','272',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(642,'Tejido Cuello Verde P. Claro',1,'2017-07-14 21:50:33','241',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(643,'Tejido Cuello Verde Petróleo',1,'2017-07-14 21:50:33','240',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(644,'Tejido Cuello Verde Rombocol',1,'2017-07-14 21:50:33','245',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(645,'Tejido Cuello Verde Viva',1,'2017-07-14 21:50:33','275',20,5,1,1,0.00,4.50,0.00,0.00,NULL,1.00,NULL,NULL),(646,'21 Floreada con Relieve Amarillo Pato',1,'2017-07-14 21:50:33','659',21,1,1,1,0.00,32.00,0.00,0.00,NULL,1.00,NULL,NULL),(647,'21 Floreada con Relieve Cafe Moro',1,'2017-07-14 21:50:33','660',21,1,1,1,0.00,32.00,0.00,0.00,NULL,1.00,NULL,NULL),(648,'21 Floreada con Relieve Crema',1,'2017-07-14 21:50:33','657',21,1,1,1,0.00,32.00,0.00,0.00,NULL,1.00,NULL,NULL),(649,'21 Floreada con Relieve Naranja',1,'2017-07-14 21:50:33','658',21,1,1,1,0.00,32.00,0.00,0.00,NULL,1.00,NULL,NULL),(650,'21 Floreada con Relieve Rojo Italiano',1,'2017-07-14 21:50:33','662',21,1,1,1,0.00,32.00,0.00,0.00,NULL,1.00,NULL,NULL),(651,'21 Floreada con Relieve Verde Viva',1,'2017-07-14 21:50:33','661',21,1,1,1,0.00,32.00,0.00,0.00,NULL,1.00,NULL,NULL),(652,'22 Amarillo Oro',1,'2017-07-14 21:51:39','645',22,10,1,1,0.00,10.00,0.00,0.00,NULL,1.00,NULL,NULL),(653,'22 Barnie',1,'2017-07-14 21:51:39','652',22,10,1,1,0.00,10.00,0.00,0.00,NULL,1.00,NULL,NULL),(654,'22 Celeste',1,'2017-07-14 21:51:39','655',22,10,1,1,0.00,10.00,0.00,0.00,NULL,1.00,NULL,NULL),(655,'22 Crudo',1,'2017-07-14 21:51:39','654',22,10,1,1,0.00,10.00,0.00,0.00,NULL,1.00,NULL,NULL),(656,'22 Damasco',1,'2017-07-14 21:51:40','656',22,10,1,1,0.00,10.00,0.00,0.00,NULL,1.00,NULL,NULL),(657,'22 Guindo',1,'2017-07-14 21:51:40','648',22,10,1,1,0.00,10.00,0.00,0.00,NULL,1.00,NULL,NULL),(658,'22 Naranja',1,'2017-07-14 21:51:40','647',22,10,1,1,0.00,10.00,0.00,0.00,NULL,1.00,NULL,NULL),(659,'22 Negro',1,'2017-07-14 21:51:40','649',22,10,1,1,0.00,10.00,0.00,0.00,NULL,1.00,NULL,NULL),(660,'22 Rojo Bandera',1,'2017-07-14 21:51:40','646',22,10,1,1,0.00,10.00,0.00,0.00,NULL,1.00,NULL,NULL),(661,'22 Rosado',1,'2017-07-14 21:51:40','651',22,10,1,1,0.00,10.00,0.00,0.00,NULL,1.00,NULL,NULL),(662,'22 Turquesa',1,'2017-07-14 21:51:40','650',22,10,1,1,0.00,10.00,0.00,0.00,NULL,1.00,NULL,NULL),(663,'22 Verde Viva',1,'2017-07-14 21:51:40','653',22,10,1,1,0.00,10.00,0.00,0.00,NULL,1.00,NULL,NULL),(664,'Gaza Rustica Colores',1,'2017-07-14 21:51:40','641',23,1,1,1,0.00,24.00,0.00,0.00,NULL,1.00,NULL,NULL),(665,'23 colores',1,'2017-07-14 21:51:40','640',23,1,1,1,0.00,33.00,0.00,0.00,NULL,1.00,NULL,NULL),(666,'23 Liso Colores',1,'2017-07-14 21:51:40','642',23,1,1,1,0.00,34.00,0.00,0.00,NULL,1.00,NULL,NULL);
/*!40000 ALTER TABLE `articulos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caja`
--

DROP TABLE IF EXISTS `caja`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caja` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `sucursal_id` int(11) DEFAULT NULL,
  `apertura` decimal(19,2) DEFAULT NULL,
  `cierre` decimal(19,2) DEFAULT NULL,
  `registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `observaciones` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `estado` char(1) DEFAULT 'p',
  `fcierre` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usuario_id_caja_idx` (`usuario_id`),
  KEY `fk_sucursal_id_caja_idx` (`sucursal_id`),
  CONSTRAINT `fk_sucursal_id_caja` FOREIGN KEY (`sucursal_id`) REFERENCES `sucursales` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_id_caja` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caja`
--

LOCK TABLES `caja` WRITE;
/*!40000 ALTER TABLE `caja` DISABLE KEYS */;
INSERT INTO `caja` VALUES (1,1,4,1000.00,500.00,'2017-07-27 17:32:22','MIL BOLIVIANOS EN BILLETES DE 100\r\n500 EN BILLETES DE 50 \r\n63 EN MODENAS DE BS 1','2017-07-14 01:32:22','2017-07-17 19:53:19','p','2017-07-17 21:53:12'),(2,5,1,555.00,NULL,'2017-07-27 17:32:22',NULL,NULL,NULL,'p',NULL);
/*!40000 ALTER TABLE `caja` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias_articulos`
--

LOCK TABLES `categorias_articulos` WRITE;
/*!40000 ALTER TABLE `categorias_articulos` DISABLE KEYS */;
INSERT INTO `categorias_articulos` VALUES (1,'Accesorios de Madera','2017-06-21 21:55:46',1,'2017-06-22 05:55:46','2017-06-22 05:55:46'),(2,'Tela Adidas Brillo','2017-06-21 21:58:55',1,'2017-06-22 05:58:55','2017-06-27 00:28:54'),(3,'Algodón Frizado','2017-06-21 21:59:06',1,'2017-06-22 05:59:06','2017-06-22 05:59:06'),(4,'Algodón Jersey','2017-06-21 22:07:53',1,'2017-06-22 06:07:53','2017-06-22 10:07:02'),(5,'Algodón Lycra','2017-06-21 22:11:08',1,'2017-06-22 06:11:08','2017-06-22 10:07:16'),(6,'Algodon Pique','2017-06-21 22:11:15',1,'2017-06-22 06:11:15','2017-06-22 06:12:27'),(7,'Algodón Rib Grueso','2017-06-21 22:12:17',1,'2017-06-22 06:12:17','2017-06-22 06:12:17'),(8,'Algodón Rib Sencillo','2017-06-21 22:12:41',1,'2017-06-22 06:12:41','2017-06-22 06:12:41'),(9,'Cierre','2017-06-21 22:12:51',1,'2017-06-22 06:12:51','2017-06-22 06:12:51'),(15,'Tela Cuadrilex','2017-06-26 16:44:40',1,'2017-06-27 00:44:40','2017-06-27 00:44:40'),(16,'Hilo Poliester 40/2','2017-06-26 22:07:51',1,'2017-06-27 06:07:51','2017-06-27 06:07:51'),(17,'Hilo Seda Grande','2017-06-26 22:09:00',1,'2017-06-27 06:09:00','2017-06-27 06:09:00'),(18,'Tela Polar','2017-06-26 23:25:31',1,'2017-06-27 07:25:31','2017-06-27 07:25:31'),(19,'Sintetico Jersey','2017-07-14 21:03:03',1,NULL,NULL),(20,'Tejido Algodón','2017-07-14 21:03:03',1,NULL,NULL),(21,'Tela Brocato','2017-07-14 21:03:03',1,NULL,NULL),(22,'Tela Tergal','2017-07-14 21:03:03',1,NULL,NULL),(23,'Tela Yacar','2017-07-14 21:03:03',1,NULL,NULL),(24,'ninguno','2017-07-14 21:03:18',1,NULL,NULL),(25,'Hilo Seda Pequeño','2017-07-14 21:29:53',1,NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (1,'Open Red','1236547897','78969696','plaza 25 de mayo','email@gmail.com','2017-06-22 17:31:45','2017-06-22 17:31:45'),(2,'Juan Perez','789658745 ','78987878','junin # 488','juan@gmail.com','2017-06-22 17:32:55','2017-06-22 17:32:55'),(3,'Jose Jose','123632365','69698789','arenales # 789','josejose@gmail.com','2017-06-22 17:33:39','2017-06-22 17:33:39'),(4,'Amelia Hurtado','12365456321','78987873','S/N','email2@gmail.com','2017-06-22 17:34:28','2017-06-22 17:34:28'),(5,'Textil Sucre','1212121212','78475825','junin # 789','textilSucre@gmail.com','2017-06-22 17:35:25','2017-06-22 17:35:25'),(6,'Juanita Lopez','12323213654','78965478','S/N','juanita@gmail.com','2017-06-22 17:36:53','2017-06-22 17:36:53'),(7,'empresa Textil','1236545632','784578693','S/N','empresa@gmail.com','2017-06-22 17:37:35','2017-06-22 17:37:35'),(8,'Carlos Cabezas ','123365343','78212354','hernando siles # 789','carlos@gmail.com','2017-06-22 17:38:23','2017-06-22 17:38:23'),(9,'Jose Coronados','121212123','7898975','junin #785','josecoronado@gmail.com','2017-06-22 17:38:44','2017-06-22 18:07:37'),(10,'guido Barrientos','56799778s','78747512','S/N','guido@gmail.com','2017-06-22 17:43:24','2017-06-22 19:27:05'),(11,'Ikarus Inc','56799778','67619','','','2017-06-22 18:20:57','2017-06-22 18:20:57'),(17,'katerine ferrufino','105059',NULL,NULL,NULL,'2017-07-06 11:40:14','2017-07-06 11:40:14'),(18,'Guido Barrientos','5679778',NULL,NULL,NULL,'2017-07-07 18:27:57','2017-07-07 18:27:57'),(19,'Carlos comenzague','7896587450',NULL,NULL,NULL,'2017-07-07 20:23:19','2017-07-07 20:23:19'),(20,'ailson cabezas','10309020','75787924','','','2017-07-28 01:36:39','2017-07-28 01:56:33');
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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compras`
--

LOCK TABLES `compras` WRITE;
/*!40000 ALTER TABLE `compras` DISABLE KEYS */;
INSERT INTO `compras` VALUES (20,'2017-07-14 18:16:35','128',1,'2017-07-15',4,15,5,'2017-07-15 02:16:35','2017-07-15 18:18:55','Contado','','t'),(21,'2017-07-15 10:18:56','9',1,'2017-07-18',1,1,8,'2017-07-15 18:18:56','2017-07-16 02:55:03','Contado','','t'),(22,'2017-07-15 18:55:03','9',1,'2017-07-26',4,15,7,'2017-07-16 02:55:03','2017-07-17 03:49:47','Contado','','t'),(23,'2017-07-16 19:49:48','115',1,'2017-07-22',4,15,7,'2017-07-17 03:49:48','2017-07-17 05:34:10','Contado','','t'),(24,'2017-07-16 21:34:10','',1,'2017-07-18',4,15,5,'2017-07-17 05:34:10','2017-07-17 19:20:48','Credito','','t'),(25,'2017-07-17 11:20:49',NULL,1,NULL,NULL,NULL,NULL,'2017-07-17 19:20:49','2017-07-17 19:20:49',NULL,NULL,'p'),(26,'2017-07-25 14:22:23',NULL,3,NULL,NULL,NULL,NULL,'2017-07-25 22:22:23','2017-07-25 22:22:23',NULL,NULL,'p');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compras_creditos`
--

LOCK TABLES `compras_creditos` WRITE;
/*!40000 ALTER TABLE `compras_creditos` DISABLE KEYS */;
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
  `fvalides` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usuario_id_cotizaciones_idx` (`usuario_id`),
  KEY `fk_sucursal_id_cotizaciones_idx` (`sucursal_id`),
  KEY `fk_cliente_id_cotizaciones_idx` (`cliente_id`),
  CONSTRAINT `fk_cliente_id_cotizaciones` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_sucursal_id_cotizaciones` FOREIGN KEY (`sucursal_id`) REFERENCES `sucursales` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_id_cotizaciones` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cotizaciones_articulos`
--

LOCK TABLES `cotizaciones_articulos` WRITE;
/*!40000 ALTER TABLE `cotizaciones_articulos` DISABLE KEYS */;
INSERT INTO `cotizaciones_articulos` VALUES (1,'2017-07-24 11:30:02',1,11,4,'2017-07-24 19:30:02','2017-07-25 18:53:37','t',NULL),(2,'2017-07-25 10:53:37',1,11,2,'2017-07-25 18:53:37','2017-07-25 18:56:14','t',NULL),(3,'2017-07-25 10:56:14',1,18,4,'2017-07-25 18:56:14','2017-07-25 19:01:01','t',NULL),(4,'2017-07-25 11:01:02',1,18,4,'2017-07-25 19:01:02','2017-07-25 19:22:45','t',NULL),(5,'2017-07-25 11:22:45',1,NULL,NULL,'2017-07-25 19:22:45','2017-07-25 19:22:45','p',NULL),(6,'2017-07-25 13:42:32',3,10,2,'2017-07-25 21:42:32','2017-07-25 22:14:25','t',NULL),(7,'2017-07-25 14:14:26',3,NULL,NULL,'2017-07-25 22:14:26','2017-07-25 22:14:26','p',NULL),(8,'2017-07-26 17:44:39',5,19,1,'2017-07-27 01:44:39','2017-07-27 01:47:35','t','2017-08-05'),(10,'2017-07-27 18:02:32',5,NULL,1,'2017-07-28 02:02:32','2017-07-28 02:02:32','p',NULL);
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
  `usuario_id` int(11) DEFAULT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `sucursal_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `estado` varchar(1) DEFAULT 'p',
  `fvalides` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usuario_id_cotizaciones_productos_idx` (`usuario_id`),
  KEY `fk_cliente_id_cotizaciones_productos_idx` (`cliente_id`),
  KEY `fk_sucursal_id_cotizaciones_productos_idx` (`sucursal_id`),
  CONSTRAINT `fk_cliente_id_cotizaciones_productos` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_sucursal_id_cotizaciones_productos` FOREIGN KEY (`sucursal_id`) REFERENCES `sucursales` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_id_cotizaciones_productos` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cotizaciones_productos`
--

LOCK TABLES `cotizaciones_productos` WRITE;
/*!40000 ALTER TABLE `cotizaciones_productos` DISABLE KEYS */;
INSERT INTO `cotizaciones_productos` VALUES (1,'2017-07-25 10:54:00',1,NULL,NULL,'2017-07-25 18:54:00','2017-07-25 18:54:00','p',NULL),(3,'2017-07-25 13:59:15',3,2,4,'2017-07-25 21:59:15','2017-07-25 22:04:52','t',NULL),(4,'2017-07-25 14:04:52',3,5,2,'2017-07-25 22:04:52','2017-07-25 22:07:16','t',NULL),(5,'2017-07-25 14:07:16',3,1,1,'2017-07-25 22:07:16','2017-07-25 22:08:04','t',NULL),(6,'2017-07-25 14:08:04',3,7,4,'2017-07-25 22:08:04','2017-07-25 22:08:51','t',NULL),(7,'2017-07-25 14:08:51',3,10,2,'2017-07-25 22:08:51','2017-07-26 02:06:57','t','0000-00-00'),(8,'2017-07-25 14:09:51',3,10,1,'2017-07-25 22:09:51','2017-07-26 16:56:50','t','2017-07-28'),(9,'2017-07-25 14:11:21',3,NULL,NULL,'2017-07-25 22:11:21','2017-07-25 22:11:21','p',NULL),(10,'2017-07-26 17:44:41',5,20,1,'2017-07-27 01:44:41','2017-07-28 02:12:51','t','2017-08-05'),(11,'2017-07-27 18:12:52',5,NULL,1,'2017-07-28 02:12:52','2017-07-28 02:12:52','p',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_cotizaciones_productos`
--

LOCK TABLES `detalle_cotizaciones_productos` WRITE;
/*!40000 ALTER TABLE `detalle_cotizaciones_productos` DISABLE KEYS */;
INSERT INTO `detalle_cotizaciones_productos` VALUES (2,3,'2017-07-25 14:04:42',22,5,750,4,3,3,7,'Color amarillo Brasil','2017-07-25 22:04:42','2017-07-25 22:04:42'),(3,4,'2017-07-25 14:07:09',26,1,350,2,3,1,7,'','2017-07-25 22:07:09','2017-07-25 22:07:09'),(4,5,'2017-07-25 14:07:55',1,6,420,1,3,4,10,'','2017-07-25 22:07:55','2017-07-25 22:07:55'),(5,6,'2017-07-25 14:08:47',5,5,750,4,3,1,10,'','2017-07-25 22:08:47','2017-07-25 22:08:47'),(6,7,'2017-07-25 14:09:26',27,2,900,2,3,1,7,'','2017-07-25 22:09:26','2017-07-25 22:09:26'),(7,7,'2017-07-25 14:09:46',22,3,480,2,3,5,7,'','2017-07-25 22:09:46','2017-07-25 22:09:46'),(8,8,'2017-07-25 14:10:22',19,6,15600,1,3,1,7,'color rojo','2017-07-25 22:10:22','2017-07-26 23:19:22'),(10,8,'2017-07-26 15:19:43',22,20,2000,1,3,3,7,'','2017-07-26 23:19:43','2017-07-28 02:10:07'),(11,10,'2017-07-27 18:05:39',22,200,2000000,1,5,3,7,'','2017-07-28 02:05:39','2017-07-28 02:13:23'),(12,8,'2017-07-27 18:09:00',27,5,2250,1,3,1,7,'','2017-07-28 02:09:00','2017-07-28 02:09:00');
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
  `precio` decimal(19,2) DEFAULT '0.00',
  `costo` decimal(19,2) DEFAULT '0.00',
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_productos_base`
--

LOCK TABLES `detalle_productos_base` WRITE;
/*!40000 ALTER TABLE `detalle_productos_base` DISABLE KEYS */;
INSERT INTO `detalle_productos_base` VALUES (1,22,7,3,150.00,50.00,'2017-07-25 13:43:37',3,'2017-07-25 21:43:37','2017-07-25 21:43:37'),(2,22,7,2,100.00,30.00,'2017-07-25 13:44:04',3,'2017-07-25 21:44:04','2017-07-25 21:44:04'),(3,22,7,5,160.00,60.00,'2017-07-25 13:48:35',3,'2017-07-25 21:48:35','2017-07-25 21:48:35'),(4,19,7,1,260.00,170.00,'2017-07-25 13:50:14',3,'2017-07-25 21:50:14','2017-07-25 21:50:14'),(5,26,7,1,350.00,190.00,'2017-07-25 13:50:35',3,'2017-07-25 21:50:35','2017-07-25 21:50:35'),(6,27,7,1,450.00,200.00,'2017-07-25 13:50:53',3,'2017-07-25 21:50:53','2017-07-25 21:50:53'),(7,5,10,1,150.00,70.00,'2017-07-25 13:54:55',3,'2017-07-25 21:54:55','2017-07-25 21:54:55'),(8,2,10,1,120.00,70.00,'2017-07-25 13:55:23',3,'2017-07-25 21:55:23','2017-07-25 21:55:23'),(9,1,10,4,70.00,30.00,'2017-07-25 13:55:45',3,'2017-07-25 21:55:45','2017-07-25 21:55:45'),(10,7,10,4,80.00,35.00,'2017-07-25 13:56:07',3,'2017-07-25 21:56:07','2017-07-25 21:56:07');
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
  `dp` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_articulo_id_detalles_cotizaciones_idx` (`articulo_id`),
  KEY `fk_sucursal_id_detalles_cotizaciones_idx` (`sucursal_id`),
  KEY `fk_usuario_id_detalles_cotizaciones_idx` (`usuario_id`),
  KEY `fk_cotizacion_id_detalles_cotizaciones_idx` (`cotizacion_id`),
  CONSTRAINT `fk_articulo_id_detalles_cotizaciones` FOREIGN KEY (`articulo_id`) REFERENCES `articulos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_cotizacion_id_detalles_cotizaciones` FOREIGN KEY (`cotizacion_id`) REFERENCES `cotizaciones_articulos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_sucursal_id_detalles_cotizaciones` FOREIGN KEY (`sucursal_id`) REFERENCES `sucursales` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_id_detalles_cotizaciones` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalles_cotizaciones`
--

LOCK TABLES `detalles_cotizaciones` WRITE;
/*!40000 ALTER TABLE `detalles_cotizaciones` DISABLE KEYS */;
INSERT INTO `detalles_cotizaciones` VALUES (1,1,'2017-07-25 10:53:32',7,5.0000,30.0000,4,1,'2017-07-25 18:53:32','2017-07-25 18:53:32','P1'),(2,2,'2017-07-25 10:56:07',11,2.0000,8.0000,2,1,'2017-07-25 18:56:07','2017-07-25 18:56:07','P1'),(3,3,'2017-07-25 11:00:55',368,10.0000,160.0000,4,1,'2017-07-25 19:00:55','2017-07-25 19:00:55','P1'),(4,4,'2017-07-25 11:22:41',368,20.0000,320.0000,4,1,'2017-07-25 19:22:41','2017-07-25 22:13:25','P1'),(5,4,'2017-07-25 14:13:40',9,5.0000,900.0000,4,3,'2017-07-25 22:13:40','2017-07-25 22:13:40','P1'),(6,6,'2017-07-25 14:14:15',368,6.0000,96.0000,2,3,'2017-07-25 22:14:15','2017-07-25 22:14:21','P1'),(7,8,'2017-07-26 17:46:43',7,3.0000,18.0000,1,5,'2017-07-27 01:46:43','2017-07-27 01:46:59','P1'),(9,8,'2017-07-26 17:47:28',373,3.0000,48.0000,1,5,'2017-07-27 01:47:28','2017-07-27 01:47:28','P1');
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
  `cantidad` decimal(19,2) DEFAULT '0.00',
  `registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `usuario_id` int(11) NOT NULL,
  `sucursal_id` int(11) DEFAULT NULL,
  `produccion_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `precio` decimal(19,2) DEFAULT '0.00',
  `dp` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_articulo_id_detalles_producciones_idx` (`articulo_id`),
  KEY `fk_usuario_id_detalles_producciones_idx` (`usuario_id`),
  KEY `fk_sucursal_id_detalles_producciones_idx` (`sucursal_id`),
  KEY `fk_proudccion_id_detalles_producciones_idx` (`produccion_id`),
  CONSTRAINT `fk_articulo_id_detalles_producciones` FOREIGN KEY (`articulo_id`) REFERENCES `articulos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_proudccion_id_detalles_producciones` FOREIGN KEY (`produccion_id`) REFERENCES `producciones` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_sucursal_id_detalles_producciones` FOREIGN KEY (`sucursal_id`) REFERENCES `sucursales` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_id_detalles_producciones` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalles_producciones`
--

LOCK TABLES `detalles_producciones` WRITE;
/*!40000 ALTER TABLE `detalles_producciones` DISABLE KEYS */;
INSERT INTO `detalles_producciones` VALUES (13,126,22.00,'2017-07-16 20:32:06',1,4,1,'2017-07-17 04:32:06','2017-07-17 04:32:06',1804.00,'P1'),(14,126,10.00,'2017-07-27 15:04:43',1,4,2,'2017-07-27 23:04:43','2017-07-27 23:04:43',820.00,'P1'),(15,356,1.00,'2017-07-27 15:04:55',1,4,2,'2017-07-27 23:04:55','2017-07-27 23:04:55',82.00,'P1'),(16,368,5.00,'2017-07-27 19:12:29',3,4,4,'2017-07-28 03:12:29','2017-07-28 03:12:29',80.00,'P1'),(17,41,5.00,'2017-07-27 19:13:08',3,4,4,'2017-07-28 03:13:08','2017-07-28 03:13:08',80.00,'P1'),(18,143,2.00,'2017-07-27 19:13:23',3,4,4,'2017-07-28 03:13:23','2017-07-28 03:13:23',164.00,'P1');
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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalles_ventas_articulos`
--

LOCK TABLES `detalles_ventas_articulos` WRITE;
/*!40000 ALTER TABLE `detalles_ventas_articulos` DISABLE KEYS */;
INSERT INTO `detalles_ventas_articulos` VALUES (6,368,10.00,160.00,'2017-07-16 20:18:32',1,'P1',10,4,'2017-07-17 04:18:32','2017-07-17 04:18:32',15),(7,368,5.00,80.00,'2017-07-17 11:54:15',2,'P1',11,4,'2017-07-17 19:54:15','2017-07-17 19:54:15',15),(8,126,5.00,410.00,'2017-07-17 11:54:27',2,'P1',11,4,'2017-07-17 19:54:27','2017-07-17 19:54:27',15),(9,140,1.00,82.00,'2017-07-17 14:20:05',1,'P1',12,4,'2017-07-17 22:20:05','2017-07-17 22:20:05',15),(10,368,45.00,720.00,'2017-07-17 14:20:18',1,'P1',12,4,'2017-07-17 22:20:18','2017-07-17 22:20:18',15),(11,562,13.00,58.50,'2017-07-17 14:22:10',1,'P1',13,4,'2017-07-17 22:22:10','2017-07-17 22:22:10',15),(12,356,5.00,410.00,'2017-07-17 14:23:04',1,'P1',14,4,'2017-07-17 22:23:04','2017-07-17 22:23:04',15),(13,141,5.00,410.00,'2017-07-26 23:26:39',1,'P1',15,4,'2017-07-27 07:26:39','2017-07-27 07:26:39',15),(14,141,5.00,410.00,'2017-07-26 23:37:28',5,'P1',18,1,'2017-07-27 07:37:28','2017-07-27 07:37:28',1),(15,141,10.00,820.00,'2017-07-27 09:04:18',1,'P1',17,4,'2017-07-27 17:04:18','2017-07-27 17:04:18',15),(16,368,10.00,160.00,'2017-07-27 18:25:57',5,'P1',19,1,'2017-07-28 02:25:57','2017-07-28 02:27:07',1),(17,387,20.00,320.00,'2017-07-27 18:26:29',5,'P1',19,1,'2017-07-28 02:26:29','2017-07-28 02:27:35',1),(18,489,1.00,14.00,'2017-07-28 17:14:16',1,'P1',17,4,'2017-07-29 01:14:16','2017-07-29 01:14:16',15);
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
  `almacen_id` int(11) NOT NULL,
  `cantidad` decimal(19,2) DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `sucursal_id` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `existencia_articulo`
--

LOCK TABLES `existencia_articulo` WRITE;
/*!40000 ALTER TABLE `existencia_articulo` DISABLE KEYS */;
INSERT INTO `existencia_articulo` VALUES (368,15,480.00,'2017-07-15 18:18:55','2017-07-28 03:13:51',4,1),(372,15,300.00,'2017-07-15 18:18:55','2017-07-15 18:18:55',4,2),(118,15,615.00,'2017-07-15 18:18:56','2017-07-17 03:24:25',4,3),(136,15,300.00,'2017-07-15 18:18:56','2017-07-15 18:18:56',4,4),(102,15,451.00,'2017-07-15 18:18:56','2017-07-15 18:18:56',4,5),(103,15,1.00,'2017-07-15 18:18:56','2017-07-15 18:18:56',4,6),(250,15,500.00,'2017-07-15 18:18:56','2017-07-15 18:18:56',4,7),(161,15,1.00,'2017-07-15 18:18:56','2017-07-15 18:18:56',4,8),(368,1,5.00,'2017-07-16 02:55:03','2017-07-28 02:27:07',1,9),(140,15,10.00,'2017-07-17 04:03:04','2017-07-17 22:20:33',4,20),(146,15,0.00,'2017-07-17 04:06:10','2017-07-17 04:10:16',4,22),(126,15,85.00,'2017-07-17 04:20:50','2017-07-27 23:05:10',4,25),(11,15,150.00,'2017-07-17 19:20:49','2017-07-17 19:20:49',4,28),(562,15,-13.00,'2017-07-17 22:22:24','2017-07-17 22:22:24',4,29),(356,15,-6.00,'2017-07-17 22:23:11','2017-07-27 23:05:10',4,30),(141,15,-15.00,'2017-07-27 07:26:44','2017-07-29 01:15:24',4,31),(141,1,-5.00,'2017-07-27 07:37:37','2017-07-27 07:37:37',1,32),(387,1,-20.00,'2017-07-28 02:26:47','2017-07-28 02:27:35',1,33),(41,15,-5.00,'2017-07-28 03:13:51','2017-07-28 03:13:51',4,34),(143,15,-2.00,'2017-07-28 03:13:51','2017-07-28 03:13:51',4,35),(489,15,-1.00,'2017-07-29 01:15:25','2017-07-29 01:15:25',4,36);
/*!40000 ALTER TABLE `existencia_articulo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `existencia_producto`
--

DROP TABLE IF EXISTS `existencia_producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `existencia_producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cantidad` decimal(19,2) DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `sucursal_id` int(11) DEFAULT NULL,
  `almacen_id` int(11) DEFAULT NULL,
  `producto_id` int(11) NOT NULL,
  `talla_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sucursal_id_existencia_producto_idx` (`sucursal_id`),
  KEY `fk_almacen_id_existencia_producto_idx` (`almacen_id`),
  KEY `fk_producto_id_existencia_producto_id_idx` (`producto_id`),
  KEY `fk_talla_id_existencia_producto_idx` (`talla_id`),
  CONSTRAINT `fk_almacen_id_existencia_producto` FOREIGN KEY (`almacen_id`) REFERENCES `almacenes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_producto_id_existencia_producto_id` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_sucursal_id_existencia_producto` FOREIGN KEY (`sucursal_id`) REFERENCES `sucursales` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_talla_id_existencia_producto` FOREIGN KEY (`talla_id`) REFERENCES `tallas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
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
-- Table structure for table `gastos`
--

DROP TABLE IF EXISTS `gastos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gastos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `sucursal_id` int(11) NOT NULL,
  `monto` decimal(19,2) DEFAULT NULL,
  `registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `fecha` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `descripcion` text,
  PRIMARY KEY (`id`),
  KEY `fk_usuario_id_gastos_idx` (`usuario_id`),
  KEY `fk_sucursal_id_gastos_idx` (`sucursal_id`),
  CONSTRAINT `fk_sucursal_id_gastos` FOREIGN KEY (`sucursal_id`) REFERENCES `sucursales` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_id_gastos` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gastos`
--

LOCK TABLES `gastos` WRITE;
/*!40000 ALTER TABLE `gastos` DISABLE KEYS */;
INSERT INTO `gastos` VALUES (1,1,4,5.50,'2017-07-17 17:50:44','2017-07-17','2017-07-14 01:50:44','2017-07-14 01:50:44','pago pasajes entrega productos'),(2,5,1,20.00,'2017-07-26 18:17:16','2017-07-26','2017-07-27 02:17:16','2017-07-27 02:17:16','PASAJES'),(3,5,1,25.00,'2017-07-27 17:57:06','2017-07-27','2017-07-28 01:57:06','2017-07-28 01:57:30','pasajes');
/*!40000 ALTER TABLE `gastos` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ingresos`
--

LOCK TABLES `ingresos` WRITE;
/*!40000 ALTER TABLE `ingresos` DISABLE KEYS */;
INSERT INTO `ingresos` VALUES (40,1,'2017-07-15 10:16:28',20,368,50.00,'2017-07-15 18:16:28','2017-07-15 18:16:28',5000.00,15,4),(41,1,'2017-07-15 10:16:50',20,372,300.00,'2017-07-15 18:16:50','2017-07-15 18:16:50',3000.00,15,4),(42,1,'2017-07-15 10:17:04',20,118,600.00,'2017-07-15 18:17:04','2017-07-15 18:17:04',5000.00,15,4),(43,1,'2017-07-15 10:17:22',20,136,300.00,'2017-07-15 18:17:22','2017-07-15 18:17:22',21000.00,15,4),(44,1,'2017-07-15 10:17:40',20,102,451.00,'2017-07-15 18:17:40','2017-07-15 18:17:40',45000.00,15,4),(45,1,'2017-07-15 10:17:56',20,103,1.00,'2017-07-15 18:17:56','2017-07-15 18:17:56',20000.00,15,4),(46,1,'2017-07-15 10:18:13',20,250,500.00,'2017-07-15 18:18:13','2017-07-15 18:18:13',6700.00,15,4),(47,1,'2017-07-15 10:18:45',20,161,1.00,'2017-07-15 18:18:45','2017-07-15 18:18:45',3500.00,15,4),(48,1,'2017-07-15 18:54:59',21,368,15.00,'2017-07-16 02:54:59','2017-07-16 02:54:59',1000.00,1,1),(49,1,'2017-07-16 19:49:37',22,368,100.00,'2017-07-17 03:49:37','2017-07-17 03:49:37',578.50,15,4),(50,1,'2017-07-16 21:32:43',23,368,100.00,'2017-07-17 05:32:43','2017-07-17 05:34:52',500.00,15,4),(51,1,'2017-07-16 21:33:59',23,140,11.00,'2017-07-17 05:33:59','2017-07-17 05:33:59',5000.00,15,4),(52,1,'2017-07-17 11:20:32',24,11,150.00,'2017-07-17 19:20:32','2017-07-17 19:20:32',300.00,15,4);
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
  `estado` char(1) DEFAULT 'p',
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marcas`
--

LOCK TABLES `marcas` WRITE;
/*!40000 ALTER TABLE `marcas` DISABLE KEYS */;
INSERT INTO `marcas` VALUES (1,'Rragatex		','2017-06-22 02:25:18','',1,'2017-06-22 10:25:18','2017-07-15 04:58:54'),(2,'Fortun Andino 		','2017-06-22 02:25:52','',1,'2017-06-22 10:25:52','2017-07-15 04:58:17'),(3,'Hiltrabol		','2017-06-22 02:26:57','',1,'2017-06-22 10:26:57','2017-07-15 04:57:55'),(4,'King Long Texti		','2017-06-22 02:27:30','',1,'2017-06-22 10:27:30','2017-07-15 04:58:34'),(5,'Jadue		','2017-06-22 02:27:59','',1,'2017-06-22 10:27:59','2017-07-15 04:57:00'),(6,'Natan Fabric','2017-06-22 02:29:02','',1,'2017-06-22 10:29:02','2017-06-22 10:29:02'),(7,'Estrella Dorada		','2017-06-22 02:29:54','',1,'2017-06-22 10:29:54','2017-07-15 04:56:35'),(8,'Ninatex		','2017-06-22 02:30:34','',1,'2017-06-22 10:30:34','2017-07-15 04:57:31'),(9,'Bolivianita','2017-06-26 22:18:47',NULL,1,'2017-06-27 06:18:47','2017-06-27 06:18:47'),(10,'Martex		','2017-07-14 20:59:15','',1,'2017-07-15 04:59:15','2017-07-15 04:59:15'),(11,'V&S Carpinteria		','2017-07-14 21:00:38','',1,'2017-07-15 05:00:38','2017-07-15 05:00:38'),(12,'Ninguno','2017-07-14 21:03:38','',1,'2017-07-15 05:03:38','2017-07-15 05:03:38');
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materiales`
--

LOCK TABLES `materiales` WRITE;
/*!40000 ALTER TABLE `materiales` DISABLE KEYS */;
INSERT INTO `materiales` VALUES (1,'Ninguna','','2017-06-22 15:06:37',1,'2017-06-22 23:06:37','2017-07-15 05:04:17'),(2,'Poliester',NULL,'2017-07-25 13:42:57',1,'2017-07-25 21:42:57','2017-07-25 21:42:57'),(3,'Seda',NULL,'2017-07-25 13:43:03',1,'2017-07-25 21:43:03','2017-07-25 21:43:03'),(4,'Algodon',NULL,'2017-07-25 13:43:07',1,'2017-07-25 21:43:07','2017-07-25 21:43:07'),(5,'encaje',NULL,'2017-07-25 13:48:19',1,'2017-07-25 21:48:19','2017-07-25 21:48:19');
/*!40000 ALTER TABLE `materiales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modulos`
--

DROP TABLE IF EXISTS `modulos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modulos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre_UNIQUE` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modulos`
--

LOCK TABLES `modulos` WRITE;
/*!40000 ALTER TABLE `modulos` DISABLE KEYS */;
INSERT INTO `modulos` VALUES (1,'caja',NULL,NULL),(2,'gasto',NULL,NULL),(3,'venta',NULL,NULL),(4,'cotizacion',NULL,NULL),(5,'inventario',NULL,NULL),(6,'cliente',NULL,NULL);
/*!40000 ALTER TABLE `modulos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permisos`
--

DROP TABLE IF EXISTS `permisos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permisos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `modulo_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_modulo_id_permisos_idx` (`modulo_id`),
  KEY `fk_usuario_id_permisos_idx` (`usuario_id`),
  CONSTRAINT `fk_modulo_id_permisos` FOREIGN KEY (`modulo_id`) REFERENCES `modulos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_id_permisos` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permisos`
--

LOCK TABLES `permisos` WRITE;
/*!40000 ALTER TABLE `permisos` DISABLE KEYS */;
INSERT INTO `permisos` VALUES (7,1,3,'2017-07-25 19:59:21',NULL,NULL),(8,6,3,'2017-07-25 19:59:21',NULL,NULL),(9,2,4,'2017-07-25 20:02:01',NULL,NULL),(42,1,5,'2017-07-27 14:50:38',NULL,NULL),(43,2,5,'2017-07-27 14:50:38',NULL,NULL),(44,3,5,'2017-07-27 14:50:38',NULL,NULL),(45,4,5,'2017-07-27 14:50:38',NULL,NULL),(46,5,5,'2017-07-27 14:50:38',NULL,NULL),(47,6,5,'2017-07-27 14:50:38',NULL,NULL);
/*!40000 ALTER TABLE `permisos` ENABLE KEYS */;
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
  `trabajador_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) NOT NULL,
  `inicio` date DEFAULT NULL,
  `fin` date DEFAULT NULL,
  `sucursal_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `estado` char(1) DEFAULT 'p',
  `terminado` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_trabajador_id_producciones_idx` (`trabajador_id`),
  KEY `fk_usuario_id_producciones_idx` (`usuario_id`),
  KEY `fk_sucursal_id_prouducciones_idx` (`sucursal_id`),
  CONSTRAINT `fk_sucursal_id_prouducciones` FOREIGN KEY (`sucursal_id`) REFERENCES `sucursales` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_trabajador_id_producciones` FOREIGN KEY (`trabajador_id`) REFERENCES `trabajadores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_id_producciones` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `producciones`
--

LOCK TABLES `producciones` WRITE;
/*!40000 ALTER TABLE `producciones` DISABLE KEYS */;
INSERT INTO `producciones` VALUES (1,'60 poleras promocion colegio San Juanillo National School','2017/07/10 - 2017/07/15','2017-07-14 13:37:00',1,1,'2017-07-10','2017-07-15',4,'2017-07-14 21:37:00','2017-07-17 17:28:30','t',0),(2,'70 cortinas para la corte','2017/07/27 - 2017/08/21','2017-07-14 13:38:41',1,1,'2017-07-27','2017-08-21',4,'2017-07-14 21:38:41','2017-07-27 23:05:10','t',0),(3,NULL,NULL,'2017-07-27 15:05:11',NULL,1,NULL,NULL,NULL,'2017-07-27 23:05:11','2017-07-27 23:05:11','p',0),(4,'','2017/07/27 - 2017/08/12','2017-07-27 19:11:28',1,3,'2017-07-27','2017-08-12',4,'2017-07-28 03:11:28','2017-07-28 03:13:51','t',0),(5,NULL,NULL,'2017-07-27 19:13:52',NULL,3,NULL,NULL,NULL,'2017-07-28 03:13:52','2017-07-28 03:13:52','p',0);
/*!40000 ALTER TABLE `producciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `producto_tallas`
--

DROP TABLE IF EXISTS `producto_tallas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `producto_tallas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `producto_id` int(11) NOT NULL,
  `talla_id` int(11) NOT NULL,
  `precio1` decimal(19,2) DEFAULT '0.00',
  `precio2` decimal(19,2) DEFAULT '0.00',
  `precio3` decimal(19,2) DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_talla_id_produccto_tallas_idx` (`talla_id`),
  KEY `fk_producto_id_producto_tallas_idx` (`producto_id`),
  CONSTRAINT `fk_producto_id_producto_tallas` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_talla_id_produccto_tallas` FOREIGN KEY (`talla_id`) REFERENCES `tallas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `producto_tallas`
--

LOCK TABLES `producto_tallas` WRITE;
/*!40000 ALTER TABLE `producto_tallas` DISABLE KEYS */;
INSERT INTO `producto_tallas` VALUES (1,'2017-07-16 10:50:10',1,3,100.00,50.00,30.00,NULL,'2017-07-16 22:03:05'),(6,'2017-07-16 13:42:56',4,4,1.00,0.00,0.00,'2017-07-16 21:42:56','2017-07-16 21:42:56'),(7,'2017-07-16 13:55:28',1,2,100.00,98.99,92.50,'2017-07-16 21:55:28','2017-07-16 22:14:35'),(8,'2017-07-16 16:56:37',1,9,55.00,25.00,15.50,'2017-07-17 00:56:37','2017-07-17 00:56:37'),(9,'2017-07-26 15:01:17',8,3,60.00,0.00,0.00,'2017-07-26 23:01:17','2017-07-26 23:01:17'),(10,'2017-07-26 15:06:18',6,9,70.00,60.00,55.00,'2017-07-26 23:06:18','2017-07-26 23:06:18'),(11,'2017-07-26 15:06:41',6,3,80.00,70.00,65.00,'2017-07-26 23:06:41','2017-07-26 23:06:41'),(12,'2017-07-26 15:07:12',6,2,85.00,75.00,70.00,'2017-07-26 23:07:12','2017-07-26 23:07:12'),(13,'2017-07-26 15:11:05',5,6,150.00,140.00,135.00,'2017-07-26 23:11:05','2017-07-26 23:11:05'),(14,'2017-07-26 15:13:52',2,3,100.00,90.00,85.00,'2017-07-26 23:13:52','2017-07-26 23:13:52');
/*!40000 ALTER TABLE `producto_tallas` ENABLE KEYS */;
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
  `codigo` varchar(45) DEFAULT NULL,
  `codigobarra` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES (1,'Polera 20 aniversario Harry Potter','_Cj6lSaAKG.jpg',1,'2017-06-29 22:24:26','2017-06-29',2,'2017-06-30 06:24:26','2017-07-26 23:05:09','444','963'),(2,'Bandera Santa Cruz','fh6yAYMver.jpg',1,'2017-06-29 22:38:22','2017-06-30',2,'2017-06-30 06:38:22','2017-07-26 22:59:40','111','11789999'),(4,'Fular para bebes','42fODo3qK1.jpg',1,'2017-06-29 22:40:37','2017-06-18',2,'2017-06-30 06:40:37','2017-07-26 23:00:03','222','999999'),(5,'Cortinas niños pack 2','Cc4INYM2va.jpg',1,'2017-06-29 22:47:46','2017-07-06',2,'2017-06-30 06:47:46','2017-07-26 23:10:23','666','9654'),(6,'Polera deadpool','9uvkxPtKT7.png',1,'2017-06-29 23:02:15','2017-06-25',2,'2017-06-30 07:02:15','2017-07-26 23:13:06','555','951'),(7,'Solera mickey mouse','mThk45q9xZ.jpg',1,'2017-06-29 23:14:07','2017-06-18',2,'2017-06-30 07:14:07','2017-07-26 23:12:29','1010','101010'),(8,'Gorra Star Wars',NULL,1,'2017-06-29 23:14:48','2017-08-23',2,'2017-06-30 07:14:48','2017-07-26 23:04:15','333','789');
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
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos_base`
--

LOCK TABLES `productos_base` WRITE;
/*!40000 ALTER TABLE `productos_base` DISABLE KEYS */;
INSERT INTO `productos_base` VALUES (1,'Poleras manga corta Cuello Camisa','2017-06-26 17:44:09',3,1,'2017-06-27 01:44:09','2017-07-25 21:53:31'),(2,'Deportivos de 2 piezas Hombre (short, polera)','2017-06-26 17:45:14',3,1,'2017-06-27 01:45:14','2017-07-25 21:53:02'),(5,'Deportivos de 2 piezas (buzo, chamarra)','2017-06-26 17:45:52',3,1,'2017-06-27 01:45:52','2017-07-25 21:52:26'),(7,'Poleras manga larga Cuello camisa','2017-06-26 17:46:42',3,1,'2017-06-27 01:46:42','2017-07-25 21:53:43'),(19,'Edredones 2 plazas','2017-06-26 17:49:06',3,1,'2017-06-27 01:49:06','2017-07-25 21:49:02'),(22,'Cortinas 2.5 x 3','2017-06-26 17:49:25',3,1,'2017-06-27 01:49:25','2017-07-25 21:42:25'),(26,'Edredones 2.5 plazas','2017-07-25 13:49:22',3,1,'2017-07-25 21:49:22','2017-07-25 21:49:22'),(27,'Edredones 3 plazas','2017-07-25 13:49:32',3,1,'2017-07-25 21:49:32','2017-07-25 21:49:32');
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proveedores`
--

LOCK TABLES `proveedores` WRITE;
/*!40000 ALTER TABLE `proveedores` DISABLE KEYS */;
INSERT INTO `proveedores` VALUES (1,'Telas Chinas SRL','1212123653','64-69825','78968525','telaschinas@gmail.com','0000','La paz. calle sucre #4585','2017-06-22 16:34:47','2017-06-23 00:34:47','2017-06-23 00:34:47',1),(2,'Importadora TexBol ','12452456633','64-69874','78968523','texbol@gmail.com','000','calle TexBol #7895','2017-06-22 16:53:19','2017-06-23 00:53:19','2017-06-23 00:53:19',1),(3,'Import Bol','69868658666','600-87964565','78969696','bol@gmail.com','0000','dir #789654','2017-06-22 16:54:49','2017-06-23 00:54:49','2017-06-23 00:59:09',1),(4,'Textil Chile','978465134','000-78665','78965441','texChile@gmail.com','796565','arica, calles arica #7896','2017-06-22 17:05:49','2017-06-23 01:05:49','2017-06-23 01:05:49',1),(5,'Facexco','6585','000-789682','77777777','facexco@gmail.com','00000','calle loa #785','2017-06-22 17:07:16','2017-06-23 01:07:16','2017-06-23 01:07:16',1),(6,'Telas del Rio','77789665','000-78965','88888888','delRio@gmail.com','00000','peru. calle bolivia #7893','2017-06-22 17:08:45','2017-06-23 01:08:45','2017-06-23 01:09:18',1),(7,'Hilaturas Aguilar','3131321312','64-00252','78787878','aguilar@gmail.com','8787878','calle calle #798797','2017-06-22 17:27:06','2017-06-23 01:27:06','2017-06-23 01:27:06',1),(8,'Distribuidora de Hilos','5555555','69-252532','54545454','email@gmail.com','545454','direccion calle #88888','2017-06-22 17:33:55','2017-06-23 01:33:55','2017-06-23 01:33:55',1),(9,'insumos Textiles SRL','2242424','96-2424242','878979879','insumos@gmail.com','3123131','S/N','2017-06-22 17:35:12','2017-06-23 01:35:12','2017-06-23 01:35:12',1),(10,'Insumos Telas','242424222','69-242424242','099898877','insumos2@gmail.com','22222','S/N','2017-06-22 17:36:21','2017-06-23 01:36:21','2017-06-23 01:36:21',1),(11,'Rider Cabezas','10309021','','75432516','','','','2017-07-27 18:42:15','2017-07-28 02:42:15','2017-07-28 02:43:05',1);
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
INSERT INTO `roles` VALUES (1,'Administrador',1,NULL,'2017-07-18 02:20:58'),(2,'Sucursal',1,'2017-06-20 23:34:55','2017-06-20 23:34:55');
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sucursales`
--

LOCK TABLES `sucursales` WRITE;
/*!40000 ALTER TABLE `sucursales` DISABLE KEYS */;
INSERT INTO `sucursales` VALUES (1,'texmarck Casa Matriz','Ravelo #501','6464655','','10203040',1,1,1,'2017-06-26 02:49:16','2017-07-28 02:53:03'),(2,'Texmarck Americas','Av. Americas S/N','46446605','67619790','30405060',1,1,1,'2017-06-26 08:57:11','2017-07-28 02:53:23'),(4,'Texmarck Sucursal 2','Av. Villa Amornia #154','64656565','686865656','10206654',1,1,1,'2017-07-06 08:07:09','2017-07-28 02:52:21');
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tallas`
--

LOCK TABLES `tallas` WRITE;
/*!40000 ALTER TABLE `tallas` DISABLE KEYS */;
INSERT INTO `tallas` VALUES (1,'Extra Large',1,'2017-06-26 15:26:24','2017-06-26 23:26:24','2017-06-26 23:26:24'),(2,'Large',1,'2017-06-26 15:27:17','2017-06-26 23:27:17','2017-06-26 23:27:17'),(3,'Medium',1,'2017-06-26 15:27:23','2017-06-26 23:27:23','2017-06-26 23:27:23'),(4,'Small',1,'2017-06-26 15:27:30','2017-06-26 23:27:30','2017-06-26 23:27:30'),(5,'Extra Small',1,'2017-06-26 15:27:39','2017-06-26 23:27:39','2017-06-26 23:27:39'),(6,'Normal',1,'2017-06-26 15:27:51','2017-06-26 23:27:51','2017-06-26 23:27:51'),(7,'Ninguno',1,'2017-06-26 15:27:57','2017-06-26 23:27:57','2017-07-16 05:22:29'),(8,'XXL',1,'2017-07-16 16:54:51','2017-07-17 00:54:51','2017-07-17 00:54:51'),(9,'S',1,'2017-07-16 16:56:22','2017-07-17 00:56:22','2017-07-17 00:56:22'),(10,'L',1,'2017-07-25 13:54:51','2017-07-25 21:54:51','2017-07-25 21:54:51');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trabajadores`
--

LOCK TABLES `trabajadores` WRITE;
/*!40000 ALTER TABLE `trabajadores` DISABLE KEYS */;
INSERT INTO `trabajadores` VALUES (1,'Judith Rodas','S/N','644466565','katyxita@gmail.com','2017-07-11','Limpiaza','i7PKNBl92I.jpg','5656565',1,'Julio Rodas','64656565',4000,1,1,'2017-07-07 20:36:36','2017-07-07 21:35:35'),(2,'Mathias Coronado','J. Prudencio Bustillos 255','3656668','','2017-07-25','Gerente','eqzE0jxBCg.jpg','56565658',1,'Julio Rodas','64656565',5000,1,1,'2017-07-07 21:38:17','2017-07-07 21:38:17'),(3,'Rildo Estebez','calle 585','78987898','','2017-07-03','secretaria','f3BtZSbdji.jpg','10309027',1,'Luz Ruiz','85898747',1200,3,1,'2017-07-28 02:46:52','2017-07-28 02:46:52');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unidades`
--

LOCK TABLES `unidades` WRITE;
/*!40000 ALTER TABLE `unidades` DISABLE KEYS */;
INSERT INTO `unidades` VALUES (1,'ninguno','2017-06-22 15:23:29',1,'2017-06-22 23:23:29','2017-06-29 21:09:23');
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
  `sucursal_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_rol_id_usuarios_idx` (`rol_id`),
  CONSTRAINT `fk_rol_id_usuarios` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Guido Barrientos','4646465','67619790','$2y$10$Pvi8uuqaPNlZaaBnXcJ.feAyGI2lg.4E/76VTHTm2PSDX1.l.J0CC','gthusho',1,'2017-06-20 13:29:23',1,1,1,1,'UXrPwZvyDMV3JCrjtJfFAHeEsWk6japKCVNP1VMr0fUX5NagIVUhZCE7OoPy','Sucre # 1976',1,NULL,'2017-07-28 02:51:07',NULL),(2,'Diego Tayagui','','','$2y$10$fSkOVI12khQhE8Ncn0CwtufHV9MQ/DUjCFXfM.XGXXuIv.jlKltFi','diego',1,'2017-06-20 15:25:08',1,1,1,1,'4iI53z7NSilxv0xsrEVBKsARNfIHOBKo0e1Sh2JDBnVfw3R8CWpmXSh5pXqX','Arenales 100',1,'2017-06-20 23:25:08','2017-07-26 02:50:09',4),(3,'Liseth','64645556','696669669','$2y$10$kQTfOW.KFJrNb58xqJTNAuLT6NIcdxZAczLa7mkwdCP0F.NOxyxHi','liss',1,'2017-06-20 15:25:56',1,1,1,1,'RvvIV5GOtD1Cmm7t6WYwqevkoFnLfOxCVlGf8jtgz8O3YRq1oaNou1xqUI7G','Salida Tarabuco',1,'2017-06-20 23:25:56','2017-07-28 02:24:10',4),(4,'Jose Luis Coronado','','','$2y$10$XSZcACDBtPsn.c3G5MDrBODqgKlXCYfva8XHuUkvUj2rZ/3S5sH7q','pepe',1,'2017-07-17 18:20:48',1,1,1,1,NULL,'Arenales 100',2,'2017-07-18 02:20:48','2017-07-18 02:20:48',NULL),(5,'Liseth Carla 2','','','$2y$10$4E5IaHevc2RiRKK1BdwaBugFJZGAEMUWgN9fJceyh3rvNzpTZwnyS','pimienta',1,'2017-07-26 17:43:54',1,1,1,1,'uT6w5eCCdT0N0bSqZjHLItrHa0bTLDCIYNAlUkevoZ2sIoU9nbEB7sKUFSfw','Arenales 100',2,'2017-07-27 01:43:54','2017-07-28 23:42:18',1);
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
  `cliente_id` int(11) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ventas_articulos`
--

LOCK TABLES `ventas_articulos` WRITE;
/*!40000 ALTER TABLE `ventas_articulos` DISABLE KEYS */;
INSERT INTO `ventas_articulos` VALUES (10,18,'2017-07-14 19:06:09','','t',1,'Contado',4,'2017-07-15 03:06:09','2017-07-17 03:53:06',15),(11,18,'2017-07-17 19:53:07','','t',1,'Credito',4,'2017-07-17 03:53:07','2017-07-17 19:54:33',15),(12,18,'2017-07-17 11:54:33','','t',1,'Contado',4,'2017-07-17 19:54:33','2017-07-17 22:20:33',15),(13,18,'2017-07-17 14:20:33','','t',1,'Cheque',4,'2017-07-17 22:20:33','2017-07-17 22:22:23',15),(14,18,'2017-07-17 14:22:24','489978','t',1,'Tarjeta Credito',4,'2017-07-17 22:22:24','2017-07-17 22:23:11',15),(15,18,'2017-07-17 14:23:11','','t',1,'Credito',4,'2017-07-17 22:23:11','2017-07-27 07:26:44',15),(16,NULL,'2017-07-25 14:14:32',NULL,'p',3,NULL,NULL,'2017-07-25 22:14:32','2017-07-25 22:14:32',NULL),(17,18,'2017-07-26 23:34:58','','t',1,'Contado',4,'2017-07-27 07:34:58','2017-07-29 01:15:24',15),(18,18,'2017-07-26 23:36:10','','t',5,'Contado',1,'2017-07-27 07:36:10','2017-07-27 07:37:36',1),(19,20,'2017-07-26 23:37:37','','t',5,'Credito',1,'2017-07-27 07:37:37','2017-07-28 02:26:47',1),(20,NULL,'2017-07-27 18:26:48',NULL,'p',5,NULL,1,'2017-07-28 02:26:48','2017-07-28 02:26:48',1),(21,NULL,'2017-07-28 17:15:25',NULL,'p',1,NULL,NULL,'2017-07-29 01:15:25','2017-07-29 01:15:25',NULL);
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
  `fecha` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_venta_id_ventas_credito_idx` (`venta_articulo_id`),
  KEY `fk_usuadio_id_ventas_credito_idx` (`usuario_id`),
  CONSTRAINT `fk_usuadio_id_ventas_credito` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_venta_id_ventas_credito` FOREIGN KEY (`venta_articulo_id`) REFERENCES `ventas_articulos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ventas_credito_articulos`
--

LOCK TABLES `ventas_credito_articulos` WRITE;
/*!40000 ALTER TABLE `ventas_credito_articulos` DISABLE KEYS */;
INSERT INTO `ventas_credito_articulos` VALUES (1,11,90.00,'2017-07-17 17:33:06',1,'2017-07-18 01:33:06','2017-07-18 01:33:06','2017-07-17'),(2,19,80.00,'2017-07-27 18:29:29',5,'2017-07-28 02:29:29','2017-07-28 02:29:29','2017-07-27'),(3,19,100.00,'2017-07-27 18:30:30',5,'2017-07-28 02:30:30','2017-07-28 02:30:30','2017-07-27');
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

-- Dump completed on 2017-07-28 17:36:51
