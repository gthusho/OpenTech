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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agendas`
--

LOCK TABLES `agendas` WRITE;
/*!40000 ALTER TABLE `agendas` DISABLE KEYS */;
/*!40000 ALTER TABLE `agendas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `almacen_sucursal`
--

DROP TABLE IF EXISTS `almacen_sucursal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `almacen_sucursal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sucursal_id` int(11) NOT NULL,
  `almacen_id` int(11) NOT NULL,
  `registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sucursal_id_almacen_sucursal_idx` (`sucursal_id`),
  KEY `fk_almacen_id_almacen_sucursal_idx` (`almacen_id`),
  CONSTRAINT `fk_almacen_id_almacen_sucursal` FOREIGN KEY (`almacen_id`) REFERENCES `almacenes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_sucursal_id_almacen_sucursal` FOREIGN KEY (`sucursal_id`) REFERENCES `sucursales` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `almacen_sucursal`
--

LOCK TABLES `almacen_sucursal` WRITE;
/*!40000 ALTER TABLE `almacen_sucursal` DISABLE KEYS */;
/*!40000 ALTER TABLE `almacen_sucursal` ENABLE KEYS */;
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
  PRIMARY KEY (`id`),
  KEY `fk_ciudad_id_almacenes_idx` (`ciudad_id`),
  CONSTRAINT `fk_ciudad_id_almacenes` FOREIGN KEY (`ciudad_id`) REFERENCES `ciudades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `almacenes`
--

LOCK TABLES `almacenes` WRITE;
/*!40000 ALTER TABLE `almacenes` DISABLE KEYS */;
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
  `medida_id` int(11) NOT NULL,
  `costo` float DEFAULT '0',
  `precio1` float DEFAULT '0',
  `precio2` float DEFAULT '0',
  `precio3` float DEFAULT '0',
  `codigobarra` varchar(45) DEFAULT NULL,
  `stock_min` int(11) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_categoria_articulo_articulos_idx` (`categoria_articulo_id`),
  KEY `fk_marca_id_articulos_idx` (`marca_id`),
  KEY `fk_material_id_articulos_idx` (`material_id`),
  KEY `fk_medida_id_articulos_idx` (`medida_id`),
  CONSTRAINT `fk_categoria_articulo_articulos` FOREIGN KEY (`categoria_articulo_id`) REFERENCES `categorias_articulos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_marca_id_articulos` FOREIGN KEY (`marca_id`) REFERENCES `marcas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_material_id_articulos` FOREIGN KEY (`material_id`) REFERENCES `materiales` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_medida_id_articulos` FOREIGN KEY (`medida_id`) REFERENCES `medidas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articulos`
--

LOCK TABLES `articulos` WRITE;
/*!40000 ALTER TABLE `articulos` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias_articulos`
--

LOCK TABLES `categorias_articulos` WRITE;
/*!40000 ALTER TABLE `categorias_articulos` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ciudades`
--

LOCK TABLES `ciudades` WRITE;
/*!40000 ALTER TABLE `ciudades` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
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
  `codigo` varchar(45) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `sucursal_id` int(11) NOT NULL,
  `almacen_id` int(11) NOT NULL,
  `proveedor_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tipo_compra` varchar(45) DEFAULT NULL,
  `nfactura` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo_UNIQUE` (`codigo`),
  KEY `fk_almacen_id_lotes_idx` (`almacen_id`),
  KEY `fk_sucursal_id_lotes_idx` (`sucursal_id`),
  KEY `fk_proveedor_id_lotes_idx` (`proveedor_id`),
  CONSTRAINT `fk_almacen_id_lotes` FOREIGN KEY (`almacen_id`) REFERENCES `almacenes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_proveedor_id_lotes` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_sucursal_id_lotes` FOREIGN KEY (`sucursal_id`) REFERENCES `sucursales` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compras`
--

LOCK TABLES `compras` WRITE;
/*!40000 ALTER TABLE `compras` DISABLE KEYS */;
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
  `abono` float DEFAULT '0',
  `registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `usuario_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
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
  `usuario_id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `sucursal_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
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
  `precio` float DEFAULT '0',
  `costo` float DEFAULT '0',
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_productos_base`
--

LOCK TABLES `detalle_productos_base` WRITE;
/*!40000 ALTER TABLE `detalle_productos_base` DISABLE KEYS */;
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
  `cantidad` float DEFAULT NULL,
  `precio` float DEFAULT NULL,
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
  `cantidad` float DEFAULT NULL,
  `registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `usuario_id` int(11) NOT NULL,
  `sucursal_id` int(11) DEFAULT NULL,
  `produccion_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
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
  `cantidad` float DEFAULT '0',
  `precio` float DEFAULT NULL,
  `registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `usuario_id` int(11) NOT NULL,
  `dp` varchar(45) DEFAULT NULL,
  `venta_articulo_id` int(11) NOT NULL,
  `sucursal_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usuario_id_detalles_ventas_articulos_idx` (`usuario_id`),
  KEY `fk_articulo_id_detalles_ventas_articulos_idx` (`articulo_id`),
  KEY `fk_venta_id_detalles_ventas_articulos_idx` (`venta_articulo_id`),
  KEY `fk_sucursal_id_detalles_ventas_articulos_idx` (`sucursal_id`),
  CONSTRAINT `fk_articulo_id_detalles_ventas_articulos` FOREIGN KEY (`articulo_id`) REFERENCES `articulos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_sucursal_id_detalles_ventas_articulos` FOREIGN KEY (`sucursal_id`) REFERENCES `sucursales` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_id_detalles_ventas_articulos` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_venta_articulo_id_detalles_ventas_articulos` FOREIGN KEY (`venta_articulo_id`) REFERENCES `ventas_articulos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalles_ventas_articulos`
--

LOCK TABLES `detalles_ventas_articulos` WRITE;
/*!40000 ALTER TABLE `detalles_ventas_articulos` DISABLE KEYS */;
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
-- Table structure for table `inventario`
--

DROP TABLE IF EXISTS `inventario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `compra_id` int(11) NOT NULL,
  `articulo_id` int(11) NOT NULL,
  `cantidad` float DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `costo` float DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_lote_id_articulos_idx` (`compra_id`),
  KEY `fk_familia_id_articulos_idx` (`articulo_id`),
  CONSTRAINT `fk_articulo_id_articulos` FOREIGN KEY (`articulo_id`) REFERENCES `articulos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_compra_id_articulos` FOREIGN KEY (`compra_id`) REFERENCES `compras` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventario`
--

LOCK TABLES `inventario` WRITE;
/*!40000 ALTER TABLE `inventario` DISABLE KEYS */;
/*!40000 ALTER TABLE `inventario` ENABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marcas`
--

LOCK TABLES `marcas` WRITE;
/*!40000 ALTER TABLE `marcas` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materiales`
--

LOCK TABLES `materiales` WRITE;
/*!40000 ALTER TABLE `materiales` DISABLE KEYS */;
/*!40000 ALTER TABLE `materiales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medidas`
--

DROP TABLE IF EXISTS `medidas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medidas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `estado` tinyint(4) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medidas`
--

LOCK TABLES `medidas` WRITE;
/*!40000 ALTER TABLE `medidas` DISABLE KEYS */;
/*!40000 ALTER TABLE `medidas` ENABLE KEYS */;
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
  `precio1` float DEFAULT '0',
  `precio2` float DEFAULT '0',
  `precio3` float DEFAULT '0',
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos_base`
--

LOCK TABLES `productos_base` WRITE;
/*!40000 ALTER TABLE `productos_base` DISABLE KEYS */;
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proveedores`
--

LOCK TABLES `proveedores` WRITE;
/*!40000 ALTER TABLE `proveedores` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Administrador',1,NULL,NULL),(2,'Sucursal',1,'2017-06-20 23:34:55','2017-06-20 23:34:55'),(3,'Ventas',1,'2017-06-20 23:35:04','2017-06-20 23:35:04'),(4,'Produccion',1,'2017-06-20 23:35:21','2017-06-20 23:35:21'),(5,'Moderador',0,'2017-06-20 23:35:28','2017-06-20 23:35:43');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stocks`
--

DROP TABLE IF EXISTS `stocks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stocks` (
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
-- Dumping data for table `stocks`
--

LOCK TABLES `stocks` WRITE;
/*!40000 ALTER TABLE `stocks` DISABLE KEYS */;
/*!40000 ALTER TABLE `stocks` ENABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sucursales`
--

LOCK TABLES `sucursales` WRITE;
/*!40000 ALTER TABLE `sucursales` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tallas`
--

LOCK TABLES `tallas` WRITE;
/*!40000 ALTER TABLE `tallas` DISABLE KEYS */;
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
INSERT INTO `usuarios` VALUES (1,'Guido Barrientos','4646465','67619790','$2y$10$Pvi8uuqaPNlZaaBnXcJ.feAyGI2lg.4E/76VTHTm2PSDX1.l.J0CC','gthusho',0,'2017-06-20 13:29:23',1,1,1,1,NULL,'Sucre # 197',1,NULL,'2017-06-20 23:42:33'),(2,'Diego Tayagui','','','$2y$10$fSkOVI12khQhE8Ncn0CwtufHV9MQ/DUjCFXfM.XGXXuIv.jlKltFi','diego',1,'2017-06-20 15:25:08',1,0,0,0,NULL,'Arenales 100',1,'2017-06-20 23:25:08','2017-06-20 23:58:26'),(3,'Yarita Liseth','64645556','696669669','$2y$10$kQTfOW.KFJrNb58xqJTNAuLT6NIcdxZAczLa7mkwdCP0F.NOxyxHi','liss',1,'2017-06-20 15:25:56',1,0,0,0,NULL,'Salida Tarabuco',1,'2017-06-20 23:25:56','2017-06-20 23:58:12');
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
  `estado` int(11) DEFAULT '0',
  `usuario_id` int(11) NOT NULL,
  `tipo_pago` varchar(45) DEFAULT NULL,
  `sucursal_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usuario_id_ventas_idx` (`usuario_id`),
  KEY `fl_cliente_id_ventas_idx` (`cliente_id`),
  KEY `fk_sucursal_id_venta_articulos_idx` (`sucursal_id`),
  CONSTRAINT `fk_sucursal_id_venta_articulos` FOREIGN KEY (`sucursal_id`) REFERENCES `sucursales` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_id_ventas` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fl_cliente_id_ventas` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ventas_articulos`
--

LOCK TABLES `ventas_articulos` WRITE;
/*!40000 ALTER TABLE `ventas_articulos` DISABLE KEYS */;
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
  `abono` float DEFAULT '0',
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
  `abono` float DEFAULT '0',
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

-- Dump completed on 2017-06-20 16:00:55
