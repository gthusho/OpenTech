CREATE DATABASE  IF NOT EXISTS `textil` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `textil`;
-- MySQL dump 10.13  Distrib 5.6.19, for Win32 (x86)
--
-- Host: localhost    Database: textil
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
-- Table structure for table `almacen`
--

DROP TABLE IF EXISTS `almacen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `almacen` (
  `IdAlmacen` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(500) DEFAULT NULL,
  `Direccion` varchar(300) DEFAULT NULL,
  `IdUsuario` int(11) DEFAULT NULL,
  `Activo` bit(1) DEFAULT b'1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `registro` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`IdAlmacen`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `almacen`
--

LOCK TABLES `almacen` WRITE;
/*!40000 ALTER TABLE `almacen` DISABLE KEYS */;
INSERT INTO `almacen` VALUES (1,'deposito 1','junin #25',1,'',NULL,NULL,'2017-06-13 18:36:01'),(2,'deposito 2','avaroa #45',1,'',NULL,NULL,'2017-06-13 18:36:01'),(3,'deposito 3','av. Juana azurduy #124',1,'',NULL,NULL,'2017-06-13 18:36:01'),(4,'deposito 4','urcullo #45',1,'',NULL,NULL,'2017-06-13 18:36:01');
/*!40000 ALTER TABLE `almacen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `articulo`
--

DROP TABLE IF EXISTS `articulo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articulo` (
  `IdArticulo` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(300) DEFAULT NULL,
  `IdFamilia` int(11) DEFAULT NULL,
  `IdMedida` int(11) DEFAULT NULL,
  `IdMarca` int(11) DEFAULT NULL,
  `IdTipoArticulo` int(11) DEFAULT NULL,
  `IdUsuario` int(11) DEFAULT NULL,
  `Codigo` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`IdArticulo`),
  KEY `IdFamilia` (`IdFamilia`),
  KEY `IdMedida` (`IdMedida`),
  KEY `IdMarca` (`IdMarca`),
  KEY `IdTipoArticulo` (`IdTipoArticulo`),
  KEY `fk_IdUsuario_articulo_idx` (`IdUsuario`),
  CONSTRAINT `articulo_familia_fk` FOREIGN KEY (`IdFamilia`) REFERENCES `familia` (`IdFamilia`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `articulo_marca_fk` FOREIGN KEY (`IdMarca`) REFERENCES `marca` (`IdMarca`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `articulo_medida_fk` FOREIGN KEY (`IdMedida`) REFERENCES `medida` (`IdMedida`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `articulo_tipoarticulo_fk` FOREIGN KEY (`IdTipoArticulo`) REFERENCES `tipoarticulo` (`IdTipoArticulo`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_IdUsuario_articulo` FOREIGN KEY (`IdUsuario`) REFERENCES `usuario` (`IdUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articulo`
--

LOCK TABLES `articulo` WRITE;
/*!40000 ALTER TABLE `articulo` DISABLE KEYS */;
INSERT INTO `articulo` VALUES (1,'Tela Roja',1,1,1,1,1,'231',NULL,NULL),(2,'Tela Verde',3,1,3,5,1,'123',NULL,NULL),(3,'Tela Transparencia',4,1,4,1,1,'456',NULL,NULL),(4,'Tela azul',6,3,5,5,1,'c-123',NULL,NULL);
/*!40000 ALTER TABLE `articulo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cliente` (
  `IdCliente` int(11) NOT NULL AUTO_INCREMENT,
  `Nit` varchar(15) DEFAULT NULL,
  `RazonSocial` varchar(300) DEFAULT NULL,
  `Direccion` varchar(300) DEFAULT NULL,
  `Telefono` varchar(15) DEFAULT NULL,
  `CorreoElectronico` varchar(100) DEFAULT NULL,
  `Foto` longblob,
  `FechaModificacion` datetime DEFAULT NULL,
  `IdUsuario` int(11) DEFAULT NULL,
  `Activo` tinyint(4) DEFAULT '1',
  `registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`IdCliente`),
  KEY `fk_IdUsuario_cliente_idx` (`IdUsuario`),
  CONSTRAINT `fk_IdUsuario_cliente` FOREIGN KEY (`IdUsuario`) REFERENCES `usuario` (`IdUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES (2,'78965','empresa A','avaroa #13','78965425','empresaA@gmail.com','','2017-06-06 01:19:49',1,1,'2017-06-13 18:36:02',NULL,NULL),(3,'123654','gato','junin #25','21313','gato@gmail.com','','2017-06-06 00:11:17',1,1,'2017-06-13 18:36:02',NULL,NULL),(4,'6356','pimienta','','67689412','pimienta@gmail.com',NULL,'2017-06-06 14:06:38',1,1,'2017-06-13 18:36:02',NULL,NULL),(5,'10309059','Juan','','45698745','',NULL,'2017-06-08 15:28:47',1,1,'2017-06-13 18:36:02',NULL,NULL),(6,'78965412','Regordete','loa #25','15478965','fat@gmail.com',NULL,NULL,1,1,'2017-06-13 18:36:02',NULL,NULL),(7,'10309518','aGata','junin #7892','78965412','a_Gata@gamil.com','','2017-06-10 03:06:07',1,1,'2017-06-13 18:36:02',NULL,NULL),(8,'689756','Ines ','','69857896','',NULL,'2017-06-08 15:28:39',1,1,'2017-06-13 18:36:02',NULL,NULL),(9,'10103030','Open Red','junin #789','78564525','OpenRed@gmail.com',NULL,'2017-06-08 15:28:04',1,1,'2017-06-13 18:36:02',NULL,NULL),(10,'69596986 ch','empresa express 12 de marzo','calle la paz','78968968','empresa',NULL,'2017-06-09 23:37:25',1,1,'2017-06-13 18:36:02',NULL,NULL),(11,'789645536j','empresa expres 12 de marzo','calle la paz #786','7897852','empresa@gmail.com',NULL,'2017-06-09 23:38:12',1,1,'2017-06-13 18:36:02',NULL,NULL),(12,'5679778','Ikarus Inc','Sucre S/N','6965656','gthusho@gmail.com',NULL,'2017-06-13 18:55:29',1,0,'2017-06-13 18:49:41','2017-06-14 02:49:41','2017-06-14 02:55:29');
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `compra`
--

DROP TABLE IF EXISTS `compra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `compra` (
  `IdCompra` int(11) NOT NULL AUTO_INCREMENT,
  `FechaCompra` date DEFAULT NULL,
  `IdProveedor` int(11) DEFAULT NULL,
  `IdTipoPago` int(11) DEFAULT NULL,
  `NumeroComprobante` int(11) DEFAULT NULL,
  `Observaciones` varchar(500) DEFAULT NULL,
  `IdUsuario` int(11) DEFAULT NULL,
  `Total` decimal(7,2) DEFAULT NULL,
  `Anulada` bit(1) DEFAULT b'0',
  `Eliminada` bit(1) DEFAULT b'0',
  `FechaRegistro` datetime DEFAULT NULL,
  `IdAlmacen` int(11) DEFAULT NULL,
  `Descuento` decimal(7,2) DEFAULT NULL,
  `registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`IdCompra`),
  KEY `IdProveedor` (`IdProveedor`),
  KEY `IdTipoPago` (`IdTipoPago`),
  KEY `IdAlmacen` (`IdAlmacen`),
  KEY `fk_IdUsuario_compra_idx` (`IdUsuario`),
  CONSTRAINT `compra_almacen_fk` FOREIGN KEY (`IdAlmacen`) REFERENCES `almacen` (`IdAlmacen`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `compra_proveedor_fk` FOREIGN KEY (`IdProveedor`) REFERENCES `proveedor` (`IdProveedor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_IdUsuario_compra` FOREIGN KEY (`IdUsuario`) REFERENCES `usuario` (`IdUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compra`
--

LOCK TABLES `compra` WRITE;
/*!40000 ALTER TABLE `compra` DISABLE KEYS */;
/*!40000 ALTER TABLE `compra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cotizacion`
--

DROP TABLE IF EXISTS `cotizacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cotizacion` (
  `IdCotizacion` int(11) NOT NULL AUTO_INCREMENT,
  `Fecha` date DEFAULT NULL,
  `FechaRegistro` datetime DEFAULT CURRENT_TIMESTAMP,
  `Observacion` varchar(500) DEFAULT NULL,
  `Anulado` bit(1) DEFAULT b'0',
  `IdUsuario` int(11) DEFAULT NULL,
  `IdCliente` int(11) DEFAULT NULL,
  `FechaValidez` date DEFAULT NULL,
  `Descuento` decimal(7,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`IdCotizacion`),
  KEY `fk_IdUsuario_cotizacion_idx` (`IdUsuario`),
  KEY `fk_IdCliente_Cotizacion_idx` (`IdCliente`),
  CONSTRAINT `fk_IdCliente_Cotizacion` FOREIGN KEY (`IdCliente`) REFERENCES `cliente` (`IdCliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_IdUsuario_cotizacion` FOREIGN KEY (`IdUsuario`) REFERENCES `usuario` (`IdUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cotizacion`
--

LOCK TABLES `cotizacion` WRITE;
/*!40000 ALTER TABLE `cotizacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `cotizacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detallecompra`
--

DROP TABLE IF EXISTS `detallecompra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detallecompra` (
  `IdDetalleCompra` int(11) NOT NULL AUTO_INCREMENT,
  `IdCompra` int(11) DEFAULT NULL,
  `IdArticulo` int(11) DEFAULT NULL,
  `Cantidad` float(7,2) DEFAULT NULL,
  `CostoUnitario` decimal(7,2) DEFAULT NULL,
  `CostoTotal` decimal(7,2) DEFAULT NULL,
  `Eliminado` bit(1) DEFAULT b'0',
  `IdUsuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`IdDetalleCompra`),
  KEY `detallecompra_compra_fk` (`IdCompra`),
  KEY `FK_detallecompra_articulo_IdArticulo` (`IdArticulo`),
  KEY `fk_idUsuario_detalecompra_idx` (`IdUsuario`),
  CONSTRAINT `FK_detallecompra_articulo_IdArticulo` FOREIGN KEY (`IdArticulo`) REFERENCES `articulo` (`IdArticulo`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detallecompra_compra_fk` FOREIGN KEY (`IdCompra`) REFERENCES `compra` (`IdCompra`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_idUsuario_detalecompra` FOREIGN KEY (`IdUsuario`) REFERENCES `usuario` (`IdUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detallecompra`
--

LOCK TABLES `detallecompra` WRITE;
/*!40000 ALTER TABLE `detallecompra` DISABLE KEYS */;
/*!40000 ALTER TABLE `detallecompra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detallecotizacion`
--

DROP TABLE IF EXISTS `detallecotizacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detallecotizacion` (
  `IdDetalleCotizacion` int(11) NOT NULL AUTO_INCREMENT,
  `IdCotizacion` int(11) DEFAULT NULL,
  `IdTipoVenta` int(11) DEFAULT NULL,
  `IdArticulo` int(11) DEFAULT NULL,
  `IdProducto` int(11) DEFAULT NULL,
  `Cantidad` float(7,2) DEFAULT NULL,
  `CostoTotal` decimal(7,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `registro` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`IdDetalleCotizacion`),
  KEY `FK_detallecotizacion_cotizacion_IdCotizacion` (`IdCotizacion`),
  KEY `FK_detallecotizacion_tipoventa_IdTipoVenta` (`IdTipoVenta`),
  KEY `FK_detallecotizacion_articulo_IdArticulo` (`IdArticulo`),
  KEY `FK_detallecotizacion_producto_IdProducto` (`IdProducto`),
  CONSTRAINT `FK_detallecotizacion_articulo_IdArticulo` FOREIGN KEY (`IdArticulo`) REFERENCES `articulo` (`IdArticulo`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_detallecotizacion_cotizacion_IdCotizacion` FOREIGN KEY (`IdCotizacion`) REFERENCES `cotizacion` (`IdCotizacion`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_detallecotizacion_producto_IdProducto` FOREIGN KEY (`IdProducto`) REFERENCES `producto` (`IdProducto`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_detallecotizacion_tipoventa_IdTipoVenta` FOREIGN KEY (`IdTipoVenta`) REFERENCES `tipoventa` (`IdTipoVenta`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detallecotizacion`
--

LOCK TABLES `detallecotizacion` WRITE;
/*!40000 ALTER TABLE `detallecotizacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `detallecotizacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalleproducto`
--

DROP TABLE IF EXISTS `detalleproducto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalleproducto` (
  `IdDetalleProducto` int(11) NOT NULL AUTO_INCREMENT,
  `IdProducto` int(11) DEFAULT NULL,
  `IdArticulo` int(11) DEFAULT NULL,
  `Cantidad` float(7,2) DEFAULT NULL,
  `IdMedida` int(11) DEFAULT NULL,
  `Eliminado` bit(1) DEFAULT b'0',
  `IdUsuario` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`IdDetalleProducto`),
  KEY `detalleproducto_producto_fk` (`IdProducto`),
  KEY `detalleproducto_articulo_fk` (`IdArticulo`),
  KEY `detalleproducto_medida_fk` (`IdMedida`),
  KEY `fk_IdUsuario_detalleproducto_idx` (`IdUsuario`),
  CONSTRAINT `detalleproducto_articulo_fk` FOREIGN KEY (`IdArticulo`) REFERENCES `articulo` (`IdArticulo`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detalleproducto_medida_fk` FOREIGN KEY (`IdMedida`) REFERENCES `medida` (`IdMedida`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detalleproducto_producto_fk` FOREIGN KEY (`IdProducto`) REFERENCES `producto` (`IdProducto`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_IdUsuario_detalleproducto` FOREIGN KEY (`IdUsuario`) REFERENCES `usuario` (`IdUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalleproducto`
--

LOCK TABLES `detalleproducto` WRITE;
/*!40000 ALTER TABLE `detalleproducto` DISABLE KEYS */;
INSERT INTO `detalleproducto` VALUES (1,1,1,23.00,1,'\0',NULL,NULL,NULL),(2,2,2,23.00,1,'\0',NULL,NULL,NULL),(3,3,3,23.00,1,'\0',NULL,NULL,NULL),(4,4,4,4.00,1,'\0',NULL,NULL,NULL),(5,5,4,4.00,1,'\0',NULL,NULL,NULL),(6,6,4,4.00,1,'\0',NULL,NULL,NULL),(7,7,3,6.00,1,'\0',NULL,NULL,NULL),(8,8,3,9.00,1,'\0',NULL,NULL,NULL),(9,9,3,9.00,1,'\0',NULL,NULL,NULL),(10,10,3,9.00,1,'\0',NULL,NULL,NULL),(11,11,3,9.00,1,'\0',NULL,NULL,NULL),(12,12,2,9.00,1,'\0',NULL,NULL,NULL),(13,13,2,9.00,1,'\0',NULL,NULL,NULL),(14,14,1,9.00,1,'\0',NULL,NULL,NULL),(15,15,1,9.00,1,'\0',NULL,NULL,NULL);
/*!40000 ALTER TABLE `detalleproducto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalleventa`
--

DROP TABLE IF EXISTS `detalleventa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalleventa` (
  `IdDetalleVenta` int(11) NOT NULL AUTO_INCREMENT,
  `IdVenta` int(11) DEFAULT NULL,
  `IdTipoVenta` int(11) DEFAULT NULL,
  `IdArticulo` int(11) DEFAULT NULL,
  `IdProducto` int(11) DEFAULT NULL,
  `Cantidad` float(7,2) DEFAULT NULL,
  `CostoTotal` decimal(7,2) DEFAULT NULL,
  `IdTipoPago` int(11) DEFAULT NULL,
  `IdUsuario` int(11) DEFAULT NULL,
  `Eliminado` bit(1) DEFAULT b'0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `registro` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`IdDetalleVenta`),
  KEY `detalleventa_tipoventa_fk` (`IdTipoVenta`),
  KEY `detalleventa_articulo_fk` (`IdArticulo`),
  KEY `detalleventa_producto_fk` (`IdProducto`),
  KEY `FK_detalleventa_venta_IdVenta` (`IdVenta`),
  CONSTRAINT `detalleventa_articulo_fk` FOREIGN KEY (`IdArticulo`) REFERENCES `articulo` (`IdArticulo`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detalleventa_producto_fk` FOREIGN KEY (`IdProducto`) REFERENCES `producto` (`IdProducto`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detalleventa_tipoventa_fk` FOREIGN KEY (`IdTipoVenta`) REFERENCES `tipoventa` (`IdTipoVenta`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detalleventa_venta_fk` FOREIGN KEY (`IdVenta`) REFERENCES `venta` (`IdVenta`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalleventa`
--

LOCK TABLES `detalleventa` WRITE;
/*!40000 ALTER TABLE `detalleventa` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalleventa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `egreso`
--

DROP TABLE IF EXISTS `egreso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `egreso` (
  `IdEgreso` int(11) NOT NULL AUTO_INCREMENT,
  `IdArticulo` int(11) DEFAULT NULL,
  `IdAlmacen` int(11) DEFAULT NULL,
  `Cantidad` float(7,2) DEFAULT NULL,
  `Observacion` varchar(500) DEFAULT NULL,
  `FechaEgreso` datetime DEFAULT NULL,
  `IdUsuario` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `registro` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`IdEgreso`),
  KEY `egreso_articulo_fk` (`IdArticulo`),
  KEY `egreso_almacen_fk` (`IdAlmacen`),
  CONSTRAINT `egreso_almacen_fk` FOREIGN KEY (`IdAlmacen`) REFERENCES `almacen` (`IdAlmacen`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `egreso_articulo_fk` FOREIGN KEY (`IdArticulo`) REFERENCES `articulo` (`IdArticulo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='salidas de articulos de almacen';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `egreso`
--

LOCK TABLES `egreso` WRITE;
/*!40000 ALTER TABLE `egreso` DISABLE KEYS */;
/*!40000 ALTER TABLE `egreso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empleado`
--

DROP TABLE IF EXISTS `empleado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empleado` (
  `IdEmpleado` int(11) NOT NULL AUTO_INCREMENT,
  `Ci` varchar(15) DEFAULT NULL,
  `Nombre` varchar(300) DEFAULT NULL,
  `Direccion` varchar(300) DEFAULT NULL,
  `Telefono` varchar(15) DEFAULT NULL,
  `CorreoElectronico` varchar(200) DEFAULT NULL,
  `FechaIngreso` date DEFAULT NULL,
  `FechaRegistro` datetime DEFAULT CURRENT_TIMESTAMP,
  `Cargo` varchar(100) DEFAULT NULL,
  `Foto` longblob,
  `Activo` bit(1) DEFAULT NULL,
  `IdUsuario` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`IdEmpleado`),
  KEY `fk_idusuario_empleado_idx` (`IdUsuario`),
  CONSTRAINT `fk_idusuario_empleado` FOREIGN KEY (`IdUsuario`) REFERENCES `usuario` (`IdUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empleado`
--

LOCK TABLES `empleado` WRITE;
/*!40000 ALTER TABLE `empleado` DISABLE KEYS */;
/*!40000 ALTER TABLE `empleado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `existencia`
--

DROP TABLE IF EXISTS `existencia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `existencia` (
  `IdExistencia` int(11) NOT NULL AUTO_INCREMENT,
  `IdArticulo` int(11) DEFAULT NULL,
  `IdAlmacen` int(11) DEFAULT NULL,
  `CantidadExistente` float(7,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `registro` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`IdExistencia`),
  KEY `existencia_articulo_fk` (`IdArticulo`),
  KEY `existencia_almacen_fk` (`IdAlmacen`),
  CONSTRAINT `existencia_almacen_fk` FOREIGN KEY (`IdAlmacen`) REFERENCES `almacen` (`IdAlmacen`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `existencia_articulo_fk` FOREIGN KEY (`IdArticulo`) REFERENCES `articulo` (`IdArticulo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `existencia`
--

LOCK TABLES `existencia` WRITE;
/*!40000 ALTER TABLE `existencia` DISABLE KEYS */;
INSERT INTO `existencia` VALUES (1,1,1,45.00,NULL,NULL,'2017-06-13 18:36:07'),(2,2,2,15.00,NULL,NULL,'2017-06-13 18:36:07'),(3,3,2,78.00,NULL,NULL,'2017-06-13 18:36:07'),(4,1,2,10.00,NULL,NULL,'2017-06-13 18:36:07'),(5,2,1,5.00,NULL,NULL,'2017-06-13 18:36:07'),(6,3,1,8.00,NULL,NULL,'2017-06-13 18:36:07'),(7,1,1,78.00,NULL,NULL,'2017-06-13 18:36:07'),(8,1,4,78.00,NULL,NULL,'2017-06-13 18:36:07'),(9,2,3,45.00,NULL,NULL,'2017-06-13 18:36:07'),(10,4,1,45.00,NULL,NULL,'2017-06-13 18:36:07');
/*!40000 ALTER TABLE `existencia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `familia`
--

DROP TABLE IF EXISTS `familia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `familia` (
  `IdFamilia` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(100) DEFAULT NULL,
  `Activo` bit(1) DEFAULT b'1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`IdFamilia`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `familia`
--

LOCK TABLES `familia` WRITE;
/*!40000 ALTER TABLE `familia` DISABLE KEYS */;
INSERT INTO `familia` VALUES (1,'Tejido','',NULL,NULL),(2,'Poliester','',NULL,NULL),(3,'Malla','',NULL,NULL),(4,'Seda','',NULL,NULL),(5,'Razo','',NULL,NULL),(6,'Tul','',NULL,NULL);
/*!40000 ALTER TABLE `familia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ingreso`
--

DROP TABLE IF EXISTS `ingreso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ingreso` (
  `IdIngreso` int(11) NOT NULL AUTO_INCREMENT,
  `IdArticulo` int(11) DEFAULT NULL,
  `IdAlmacen` int(11) DEFAULT NULL,
  `Cantidad` float(7,2) DEFAULT NULL,
  `Observacion` varchar(500) DEFAULT NULL,
  `FechaIngreso` datetime DEFAULT NULL,
  `Eliminado` bit(1) DEFAULT b'0',
  `IdUsuario` int(11) DEFAULT NULL,
  `registro` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`IdIngreso`),
  KEY `ingreso_articulo_fk` (`IdArticulo`),
  KEY `ingreso_almacen_fk` (`IdAlmacen`),
  KEY `ingreso_usuario_fk` (`IdUsuario`),
  CONSTRAINT `ingreso_almacen_fk` FOREIGN KEY (`IdAlmacen`) REFERENCES `almacen` (`IdAlmacen`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ingreso_articulo_fk` FOREIGN KEY (`IdArticulo`) REFERENCES `articulo` (`IdArticulo`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ingreso_usuario_fk` FOREIGN KEY (`IdUsuario`) REFERENCES `usuario` (`IdUsuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ingreso de articulos a almacen';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ingreso`
--

LOCK TABLES `ingreso` WRITE;
/*!40000 ALTER TABLE `ingreso` DISABLE KEYS */;
/*!40000 ALTER TABLE `ingreso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `marca`
--

DROP TABLE IF EXISTS `marca`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `marca` (
  `IdMarca` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(100) DEFAULT NULL,
  `IdUsuario` int(11) DEFAULT NULL,
  `Activo` bit(1) DEFAULT b'1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`IdMarca`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marca`
--

LOCK TABLES `marca` WRITE;
/*!40000 ALTER TABLE `marca` DISABLE KEYS */;
INSERT INTO `marca` VALUES (1,'Tex',1,'',NULL,NULL),(2,'textile',1,'',NULL,NULL),(3,'Geotex',1,'',NULL,NULL),(4,'Cavalier',1,'',NULL,NULL),(5,'Tula',1,'',NULL,NULL),(6,'Novalan',1,'',NULL,NULL),(7,'Lanas Filtex',1,'',NULL,NULL),(8,'Soria',1,'',NULL,NULL);
/*!40000 ALTER TABLE `marca` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medida`
--

DROP TABLE IF EXISTS `medida`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medida` (
  `IdMedida` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(50) DEFAULT NULL,
  `Activo` bit(1) DEFAULT b'1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `registro` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`IdMedida`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medida`
--

LOCK TABLES `medida` WRITE;
/*!40000 ALTER TABLE `medida` DISABLE KEYS */;
INSERT INTO `medida` VALUES (1,'metros','',NULL,NULL,'2017-06-13 18:36:09'),(2,'Ft','',NULL,NULL,'2017-06-13 18:36:09'),(3,'Rollo de Tela','',NULL,NULL,'2017-06-13 18:36:09'),(4,'Rollo de Tela','',NULL,NULL,'2017-06-13 18:36:09'),(5,'S','',NULL,NULL,'2017-06-13 18:36:09'),(6,'XS','',NULL,NULL,'2017-06-13 18:36:09'),(7,'L','',NULL,NULL,'2017-06-13 18:36:09'),(8,'M','',NULL,NULL,'2017-06-13 18:36:09'),(9,'XL','',NULL,NULL,'2017-06-13 18:36:09'),(10,'XXL','',NULL,NULL,'2017-06-13 18:36:09'),(11,'P','',NULL,NULL,'2017-06-13 18:36:09');
/*!40000 ALTER TABLE `medida` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `producto`
--

DROP TABLE IF EXISTS `producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `producto` (
  `IdProducto` int(11) NOT NULL DEFAULT '0',
  `Descripcion` varchar(500) DEFAULT NULL,
  `Imagen` longblob,
  `Activo` bit(1) DEFAULT b'1',
  `FechaRegistro` datetime DEFAULT CURRENT_TIMESTAMP,
  `IdUsuario` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`IdProducto`),
  KEY `fk_IdUsuario_producto_idx` (`IdUsuario`),
  CONSTRAINT `fk_IdUsuario_producto` FOREIGN KEY (`IdUsuario`) REFERENCES `usuario` (`IdUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `producto`
--

LOCK TABLES `producto` WRITE;
/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
INSERT INTO `producto` VALUES (1,'Deportivo Azul Mujer',NULL,'',NULL,NULL,NULL,NULL),(2,'deportivo masculino color azul',NULL,'',NULL,NULL,NULL,NULL),(3,'deportivo colegio santa ana',NULL,'',NULL,NULL,NULL,NULL),(4,'deportivo colegio don bosco',NULL,'',NULL,NULL,NULL,NULL),(5,'deportivo colegio aleman',NULL,'',NULL,NULL,NULL,NULL),(6,'chompas de diario colegio santa ana',NULL,'',NULL,NULL,NULL,NULL),(7,'chompas de diario colegio don bosco',NULL,'',NULL,NULL,NULL,NULL),(8,'chompas d ediario colegio aleman',NULL,'',NULL,NULL,NULL,NULL),(9,'polerones colegio santa ana',NULL,'',NULL,NULL,NULL,NULL),(10,'polerones colegio aleman',NULL,'',NULL,NULL,NULL,NULL),(11,'polerones colegio don bosco',NULL,'',NULL,NULL,NULL,NULL),(12,'gorras colegio don bosco',NULL,'',NULL,NULL,NULL,NULL),(13,'chamarras colegio aleman',NULL,'',NULL,NULL,NULL,NULL),(14,'poleras de educacion fisica colegio santa ana',NULL,'',NULL,NULL,NULL,NULL),(15,'poleras de educacion fisica colegio aleman',NULL,'',NULL,NULL,NULL,NULL),(16,'poleras de educaicon fisica colegio don bosco',NULL,'',NULL,NULL,NULL,NULL),(17,'shorts educacion fisica Mujeres',NULL,'',NULL,NULL,NULL,NULL),(18,'shorts educacion fisica hombres',NULL,'',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proveedor`
--

DROP TABLE IF EXISTS `proveedor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proveedor` (
  `IdProveedor` int(11) NOT NULL AUTO_INCREMENT,
  `Nit` varchar(20) DEFAULT NULL,
  `RazonSocial` varchar(500) DEFAULT NULL,
  `Direccion` varchar(300) DEFAULT NULL,
  `Telefono` varchar(15) DEFAULT NULL,
  `CorreoElectronico` varchar(300) DEFAULT NULL,
  `Foto` longblob,
  `Activo` bit(1) DEFAULT b'1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `registro` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`IdProveedor`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proveedor`
--

LOCK TABLES `proveedor` WRITE;
/*!40000 ALTER TABLE `proveedor` DISABLE KEYS */;
INSERT INTO `proveedor` VALUES (1,'121314','Empresa TELAS','La paz 32','3333','correo1@gmail.com',NULL,'',NULL,NULL,'2017-06-13 18:36:10'),(2,'12343554','Empresa Bontones','junin 34','5555','correo1@gmail.com',NULL,'',NULL,NULL,'2017-06-13 18:36:10'),(3,'75567','empres telas especiales','oruro 342','44444','correo1@gmail.com',NULL,'',NULL,NULL,'2017-06-13 18:36:10'),(4,'65567','Empresa Cierres','clavo 333','3333','correo1@gmail.com',NULL,'',NULL,NULL,'2017-06-13 18:36:10'),(5,'8979','Empresa HIlos','urcullo','5555','correo1@gmail.com',NULL,'',NULL,NULL,'2017-06-13 18:36:10'),(6,'979','Empresa Maquinaria','loa','5555','correo1@gmail.com',NULL,'',NULL,NULL,'2017-06-13 18:36:10');
/*!40000 ALTER TABLE `proveedor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rol`
--

DROP TABLE IF EXISTS `rol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rol` (
  `IdRol` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(50) DEFAULT NULL,
  `Activo` int(11) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`IdRol`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rol`
--

LOCK TABLES `rol` WRITE;
/*!40000 ALTER TABLE `rol` DISABLE KEYS */;
INSERT INTO `rol` VALUES (1,'Administrador',1,'2017-06-13 23:59:14','2017-06-13 23:59:14'),(2,'Empleado',1,'2017-06-14 00:00:04','2017-06-14 00:00:04'),(3,'Moderador',1,'2017-06-14 00:00:27','2017-06-14 00:00:27');
/*!40000 ALTER TABLE `rol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipoarticulo`
--

DROP TABLE IF EXISTS `tipoarticulo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipoarticulo` (
  `IdTipoArticulo` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(50) DEFAULT NULL,
  `Activo` bit(1) DEFAULT b'1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `registro` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`IdTipoArticulo`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipoarticulo`
--

LOCK TABLES `tipoarticulo` WRITE;
/*!40000 ALTER TABLE `tipoarticulo` DISABLE KEYS */;
INSERT INTO `tipoarticulo` VALUES (1,'Tela','',NULL,NULL,'2017-06-13 18:36:11'),(2,'Blusas','',NULL,NULL,'2017-06-13 18:36:11'),(3,'Deportivos','',NULL,NULL,'2017-06-13 18:36:11'),(4,'Cortinas','',NULL,NULL,'2017-06-13 18:36:11'),(5,'Telas Especiales','',NULL,NULL,'2017-06-13 18:36:11'),(6,'Pedidos','',NULL,NULL,'2017-06-13 18:36:11');
/*!40000 ALTER TABLE `tipoarticulo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipopago`
--

DROP TABLE IF EXISTS `tipopago`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipopago` (
  `IdTipoPago` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(100) DEFAULT NULL,
  `Activo` int(11) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`IdTipoPago`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipopago`
--

LOCK TABLES `tipopago` WRITE;
/*!40000 ALTER TABLE `tipopago` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipopago` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipoventa`
--

DROP TABLE IF EXISTS `tipoventa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipoventa` (
  `IdTipoVenta` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(100) DEFAULT NULL,
  `Activo` bit(1) DEFAULT b'1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`IdTipoVenta`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipoventa`
--

LOCK TABLES `tipoventa` WRITE;
/*!40000 ALTER TABLE `tipoventa` DISABLE KEYS */;
INSERT INTO `tipoventa` VALUES (1,'venta al contado','',NULL,NULL),(2,'Credito','',NULL,NULL),(3,'Rebajas','',NULL,NULL);
/*!40000 ALTER TABLE `tipoventa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `IdUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `NombreUsuario` varchar(300) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `IdRol` int(11) DEFAULT NULL,
  `FechaModificacion` datetime DEFAULT NULL,
  `Activo` bit(1) DEFAULT b'1',
  `remember_token` varchar(100) DEFAULT NULL,
  `read` int(11) DEFAULT '1',
  `insert` int(11) DEFAULT '0',
  `edit` int(11) DEFAULT '0',
  `delete` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `Nombre` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`IdUsuario`),
  KEY `usuario_rol_fk` (`IdRol`),
  CONSTRAINT `usuario_rol_fk` FOREIGN KEY (`IdRol`) REFERENCES `rol` (`IdRol`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'tijeras','$2y$10$/Z8mRZXOLyB9tHbCXnH9aORzUYAEpK6GqW5f67W3okQsf6Z93KvZe',1,NULL,'','GpDq8WvDMcVI0jzlj8Wq9YiNfpnNQswlDLJAijFF0DiI8NNRmkmODz5rZab8',1,1,1,1,NULL,'2017-06-14 03:21:17','Liseth Carla'),(3,'tinyDiego','$2y$10$leIMmMM071DzGPn0l4J3u.S3KIEmmvS8b/UzAAvVi2ewPDRiuYib6',1,NULL,'',NULL,1,0,0,0,'2017-05-29 01:23:58','2017-05-29 01:23:58',NULL),(4,'diego','$2y$10$FBwTgFhCfS83brJdTtQIx.XBceP3Qm2YYXyuX8eMyHp4sdprZnsOK',2,NULL,'','dwB6xJvJI1T5US8Sa0vpV3BmmzK1Mtl7k4Zy4u7T8WgTT45p124sci78YhTz',1,0,0,0,NULL,'2017-06-06 08:07:21',NULL),(6,'kj','$2y$10$8xnciIKNZeg9cZnAadLJMelI.JVyqou4TAy/DbIbEpbv8/Ia3wNKe',3,NULL,'',NULL,1,0,0,0,'2017-05-31 22:37:12','2017-05-31 22:37:12',NULL),(7,'sfsfs','$2y$10$1WF4rFqmmFEaDwRJWkl/6.6HhPb9zYdpXXx8c.lJ8lmn5WV6brKtS',3,NULL,'',NULL,1,0,0,0,'2017-05-31 22:52:04','2017-05-31 22:52:04',NULL),(8,'pimienta','$2y$10$1lNrNhD0gtuZd3G91oCKf.4jtUxzxOxQNr0j0Xm4tcN4TVVXoz/hW',3,NULL,'',NULL,1,0,0,0,'2017-06-06 08:11:52','2017-06-06 08:11:52',NULL),(10,'gthusho','$2y$10$Pvi8uuqaPNlZaaBnXcJ.feAyGI2lg.4E/76VTHTm2PSDX1.l.J0CC',1,NULL,'',NULL,1,1,1,1,'2017-06-14 00:33:05','2017-06-14 03:14:56','Guido Barrientos');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venta`
--

DROP TABLE IF EXISTS `venta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `venta` (
  `IdVenta` int(11) NOT NULL AUTO_INCREMENT,
  `Fecha` date DEFAULT NULL,
  `FechaRegistro` datetime DEFAULT CURRENT_TIMESTAMP,
  `Observacion` varchar(500) DEFAULT NULL,
  `Anulado` bit(1) DEFAULT b'0',
  `IdUsuario` int(11) DEFAULT NULL,
  `IdCliente` int(11) DEFAULT NULL,
  `Eliminado` bit(1) DEFAULT b'0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`IdVenta`),
  KEY `fk_IdUsuario_venta_idx` (`IdUsuario`),
  KEY `fk_IdCLiente_venta_idx` (`IdCliente`),
  CONSTRAINT `fk_IdCLiente_venta` FOREIGN KEY (`IdCliente`) REFERENCES `cliente` (`IdCliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_IdUsuario_venta` FOREIGN KEY (`IdUsuario`) REFERENCES `usuario` (`IdUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venta`
--

LOCK TABLES `venta` WRITE;
/*!40000 ALTER TABLE `venta` DISABLE KEYS */;
/*!40000 ALTER TABLE `venta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visita`
--

DROP TABLE IF EXISTS `visita`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `visita` (
  `IdVisita` int(11) NOT NULL AUTO_INCREMENT,
  `IdCliente` int(11) DEFAULT NULL,
  `FechaVisitar` date DEFAULT NULL,
  `FechaVisitada` date DEFAULT NULL,
  `Direccion` varchar(300) DEFAULT NULL,
  `Telefono` varchar(15) DEFAULT NULL,
  `IdEstadoVisita` int(11) DEFAULT NULL,
  `IdUsuario` int(11) NOT NULL,
  `registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `descripcion` text,
  `estado` char(1) DEFAULT 'a',
  PRIMARY KEY (`IdVisita`),
  KEY `FK_visita_cliente_IdCliente` (`IdCliente`),
  KEY `fk_idusuario_visita_idx` (`IdUsuario`),
  CONSTRAINT `FK_visita_cliente_IdCliente` FOREIGN KEY (`IdCliente`) REFERENCES `cliente` (`IdCliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_idusuario_visita` FOREIGN KEY (`IdUsuario`) REFERENCES `usuario` (`IdUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visita`
--

LOCK TABLES `visita` WRITE;
/*!40000 ALTER TABLE `visita` DISABLE KEYS */;
INSERT INTO `visita` VALUES (2,4,'2017-06-13',NULL,'calvo 23','65896585',NULL,1,'2017-06-13 18:36:12',NULL,NULL,NULL,'s'),(4,4,'2017-06-17',NULL,'arce 878','7896524',NULL,1,'2017-06-13 18:36:12',NULL,NULL,NULL,'c'),(5,4,'2017-06-13','2017-06-13','junin 78','78965423',NULL,1,'2017-06-13 18:36:12',NULL,'2017-06-14 04:02:09','Llovio fuerte','s'),(7,4,'2017-06-20',NULL,'Capricornio , Monteaguado','64696969',NULL,10,'2017-06-13 19:44:04','2017-06-14 03:44:04','2017-06-14 03:44:04',NULL,'a');
/*!40000 ALTER TABLE `visita` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-06-13 21:33:22
