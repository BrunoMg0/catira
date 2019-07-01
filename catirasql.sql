-- MySQL dump 10.13  Distrib 5.7.25, for Linux (x86_64)
--
-- Host: localhost    Database: catira
-- ------------------------------------------------------
-- Server version	5.7.25

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
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorias` (
  `id_cat` int(11) NOT NULL AUTO_INCREMENT,
  `nome_cat` varchar(45) NOT NULL,
  PRIMARY KEY (`id_cat`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,'Eletrônicos'),(2,'Brinquedos'),(3,'Informática'),(4,'Veículos'),(5,'Instrumentos'),(6,'Livros'),(7,'Calçados'),(8,'Ferramentas'),(9,'Jogos'),(10,'Jóias'),(11,'Roupas'),(12,'Outros');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perguntas`
--

DROP TABLE IF EXISTS `perguntas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `perguntas` (
  `id_pergunta` int(11) NOT NULL AUTO_INCREMENT,
  `id_perguntaa_prod` int(11) NOT NULL,
  `mensagem` varchar(400) NOT NULL,
  `nome_usuario` varchar(45) NOT NULL,
  PRIMARY KEY (`id_pergunta`),
  KEY `fk_perguntas_1` (`id_perguntaa_prod`),
  CONSTRAINT `fk_perguntas_1` FOREIGN KEY (`id_perguntaa_prod`) REFERENCES `produtos` (`id_prod`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perguntas`
--

LOCK TABLES `perguntas` WRITE;
/*!40000 ALTER TABLE `perguntas` DISABLE KEYS */;
INSERT INTO `perguntas` VALUES (4,46,'jj','abc'),(5,46,'jj','abc'),(6,46,'jj','abc'),(7,46,'Você vende?','abc'),(8,52,'Qual o tamanho?','Bruno'),(11,58,'dadad',''),(12,58,'dada','Bruno'),(13,57,'Quanto tempo de uso?','Bruno'),(14,57,'Quanto tempo de uso?','Bruno'),(15,57,'Quanto tempo de uso?','Bruno');
/*!40000 ALTER TABLE `perguntas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produtos`
--

DROP TABLE IF EXISTS `produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produtos` (
  `id_prod` int(11) NOT NULL AUTO_INCREMENT,
  `nome_prod` varchar(45) NOT NULL,
  `descricao_prod` longtext NOT NULL,
  `categoria_prod` int(11) NOT NULL,
  `desejo_troca` varchar(45) NOT NULL,
  `caminho_img` varchar(45) NOT NULL,
  `vendedor` varchar(100) NOT NULL,
  `data` datetime DEFAULT NULL,
  PRIMARY KEY (`id_prod`),
  KEY `fk_produtos_cat` (`categoria_prod`),
  CONSTRAINT `fk_produtos_cat` FOREIGN KEY (`categoria_prod`) REFERENCES `categorias` (`id_cat`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produtos`
--

LOCK TABLES `produtos` WRITE;
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
INSERT INTO `produtos` VALUES (1,'PS4 500GB','PS4 EM BOM ESTADO DE CONSERVAÇÃO',1,'moto','imgs/ps4.jpg','vendedor1','2019-06-15 11:50:00'),(5,'quinto','5',1,'5','imgs/a.png','a','2019-06-21 00:00:00'),(6,'sexto','6',1,'6','imgs/a.png','abc@gmail.com','2019-06-21 00:00:00'),(7,'setimo','7',1,'7','imgs/a.png','abc@gmail.com','2019-06-21 00:00:00'),(8,'oitavo','8',1,'8','imgs/a.png','abc@gmail.com','2019-06-21 00:00:00'),(9,'nono','9',1,'9','imgs/a.png','abc@gmail.com','2019-06-21 00:00:00'),(10,'10','10',1,'10','imgs/a.png','abc@gmail.com','2019-06-21 00:00:00'),(11,'11','11',1,'11','imgs/a.png','abc@gmail.com','2019-06-15 00:00:00'),(12,'12','12',1,'12','imgs/a.png','a','2019-06-15 00:00:00'),(13,'13','13',1,'13','imgs/a.png','a','2019-06-15 00:00:00'),(14,'14','14',1,'14','imgs/a.png','a','2019-06-15 00:00:00'),(15,'15','151',1,'5','imgs/a.png','a','2019-06-15 00:00:00'),(16,'16','16',1,'16','imgs/a.png','a','2019-06-15 00:00:00'),(17,'17','17',1,'17','imgs/a.png','a','2019-06-15 00:00:00'),(18,'18','18',1,'18','imgs/a.png','a','2019-06-15 00:00:00'),(19,'19','19',1,'17','imgs/a.png','a','2019-06-15 00:00:00'),(20,'20','20',1,'17','imgs/a.png','a','2019-06-15 00:00:00'),(22,'22','22',1,'17','imgs/a.png','a','2019-06-15 00:00:00'),(23,'23','23',1,'18','imgs/a.png','a','2019-06-15 00:00:00'),(24,'24','24',1,'17','imgs/a.png','a','2019-06-15 00:00:00'),(27,'PS4 500GB','PS4 EM BOM ESTADO DE CONSERVAÇÃO',1,'moto','imgs/ps4.jpg','1','2019-06-15 00:00:00'),(33,'mouse logitech','Mouse logitech g402, troco por teclado mecânico.',3,'teclado mecanico','imgs/download.jpeg','abc@gmail.com','2019-06-15 00:00:00'),(35,'mouse logitech','Mouse\r\nMouse\r\nMouse',3,'jogo de ps4 ou conversor digital','imgs/download.jpeg','brunojp00@gmail.com','2019-06-15 00:00:00'),(38,'Guitarra Elétrica','Guitarra Elétrica',5,'bateria','imgs/guitarra.jpg','brunojp00@gmail.com','2019-06-15 00:00:00'),(39,'Jogo Uncharted 4','Jogo Uncharted 4 seminovo',9,'Outro jogo de ps4','imgs/uncharted.jpg','brunojp00@gmail.com','2019-06-15 00:00:00'),(40,'Tenis Adidas','Tenis',7,'jogo de ps4','imgs/tenis adidas.jpg','brunojp00@gmail.com','2019-06-15 00:00:00'),(42,'Caixa Para Ferramentas','Caixa de ferramentas com martelo e algumas chaves.',8,'Maquita','imgs/caixaParaFerramentas.jpg','brunojp00@gmail.com','2019-06-15 00:00:00'),(46,'Pingente de ouro','Pingente de ouro',10,'Bicicleta','imgs/pingente.jpg','abc@gmail.com','2019-06-15 00:00:00'),(47,'Camiseta Preta','Camiseta Preta',11,'Bermuda','imgs/camisetaPreta.jpg','abc@gmail.com','2019-06-15 00:00:00'),(52,'Carrinho Hot Wheels','Carrinho Hot Wheels',2,'Carrinho de controle remoto','imgs/carrinho.jpg','brunojp00@gmail.com','2019-06-21 23:43:45'),(54,'gol g4','Carro gol g4 completo',4,'terreno','imgs/gol.jpg','brunojp00@gmail.com','2019-06-22 09:16:24'),(57,'Jogo The Last Of US','Jogo the last of us remasterizado.',9,'Outro jogo de ps4','imgs/tlou.jpg','abc@gmail.com','2019-06-30 11:10:25'),(58,'TV LED 40P SONY','TV de 40 polegadas da marca SONY em bom estado.',1,'ps4','imgs/tv.jpg','brunojp00@gmail.com','2019-06-30 11:44:38');
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome_usuario` varchar(100) NOT NULL,
  `email_usuario` varchar(100) NOT NULL,
  `senha_usuario` varchar(100) NOT NULL,
  `logradouro` varchar(45) NOT NULL,
  `numero` varchar(45) NOT NULL,
  `cidade` varchar(45) NOT NULL,
  `estado` varchar(45) NOT NULL,
  `cep` varchar(45) NOT NULL,
  `telefone` varchar(45) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `email_usuario_UNIQUE` (`email_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (8,'Bruno','brunojp00@gmail.com','81dc9bdb52d04dc20036dbd8313ed055','rua 2','194','cidade','estado','387700111','3835614509'),(49,'bruno','brunojp001@gmail.com','1','rua','1','cidade','estado','387700000','3835614509'),(50,'5','5','5','5','5','5','5','5','5'),(51,'6','6','6','','','','','',''),(52,'7','7','7','','','','','',''),(53,'1','8','1','','','','','',''),(54,'2','2','2','','','','','',''),(55,'3','3','3','','','','','',''),(56,'10','10','10','','','','','',''),(57,'1','1','1','','','','','',''),(58,'9','9','9','','','','','',''),(59,'11','11','11','','','','','',''),(60,'12','12','12','','','','','',''),(61,'abc','abc@gmail.com','81dc9bdb52d04dc20036dbd8313ed055','rua','numero','PTU','MG','38770000','35555555'),(62,'123456','aaaa@gmail.com','aaa','rua','1','cidade','estado','387700000','3835614509'),(63,'oiiii','2aaw@gmail.com','a','aa','1','cidade','estado','387700000','3835614509'),(64,'123@aa','123','111','a','a','a','a','a','a'),(65,'25','25','25','25','25','25','25','25','25'),(66,'1','a@gmail.com','202cb962ac59075b964b07152d234b70','1','1','1','1','1','1'),(67,'a','123@gmail.com','81dc9bdb52d04dc20036dbd8313ed055','a','a','a','PI','a','35555555');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-07-01 20:35:04
