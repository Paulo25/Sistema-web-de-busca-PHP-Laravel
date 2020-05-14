-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: linguagem
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.36-MariaDB

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
-- Table structure for table `criador`
--

DROP TABLE IF EXISTS `criador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `criador` (
  `idcriador` int(11) NOT NULL AUTO_INCREMENT,
  `nome_criador` varchar(1000) NOT NULL,
  `nascimento` int(11) NOT NULL,
  `sobre` varchar(1000) NOT NULL,
  `fk_lingua_progs` int(11) DEFAULT NULL,
  PRIMARY KEY (`idcriador`),
  KEY `fk_lingua_progs` (`fk_lingua_progs`),
  CONSTRAINT `criador_ibfk_1` FOREIGN KEY (`fk_lingua_progs`) REFERENCES `lingua_progs` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `criador`
--

LOCK TABLES `criador` WRITE;
/*!40000 ALTER TABLE `criador` DISABLE KEYS */;
INSERT INTO `criador` VALUES (1,'James Gosling',1955,'James Gosling',1);
/*!40000 ALTER TABLE `criador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `imagem`
--

DROP TABLE IF EXISTS `imagem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `imagem` (
  `id_imagem` int(11) NOT NULL AUTO_INCREMENT,
  `path_imagem` varchar(500) DEFAULT NULL,
  `fk_img_lingua` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_imagem`),
  KEY `imagem_ibfk_1` (`fk_img_lingua`),
  CONSTRAINT `imagem_ibfk_1` FOREIGN KEY (`fk_img_lingua`) REFERENCES `lingua_progs` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `imagem`
--

LOCK TABLES `imagem` WRITE;
/*!40000 ALTER TABLE `imagem` DISABLE KEYS */;
INSERT INTO `imagem` VALUES (6,'imagens/java.jpg',1),(7,'imagens/php.png',2),(8,'imagens/dotNet.png',3),(9,'imagens/python.png',4),(10,'imagens/ruby.png',5),(11,'imagens/objectivec.png',6),(12,'imagens/js.png',8);
/*!40000 ALTER TABLE `imagem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lingua_progs`
--

DROP TABLE IF EXISTS `lingua_progs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lingua_progs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `conteudo` text NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1' COMMENT '1 - ativo\n0 - inativo',
  `dt_criacao` date NOT NULL,
  `dt_atualizacao` date NOT NULL,
  `topo` tinyint(4) DEFAULT '0' COMMENT '1 - ficará no topo\n0 - não ficará no topo',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lingua_progs`
--

LOCK TABLES `lingua_progs` WRITE;
/*!40000 ALTER TABLE `lingua_progs` DISABLE KEYS */;
INSERT INTO `lingua_progs` VALUES (1,'Java','A linguagem de programação mais solicitada de longe é o Java. No topo da maioria dos índices especializados na medição da popularidade, o Java se caracteriza por ser portável, ou seja, é possível compilar um programa em Java de maneira fácil para todo tipo de aparelho. Vale lembrar também que o Java é a linguagem mais usada para a criação de aplicativos Android.','1','0000-00-00','2019-01-26',0),(2,'PHP','Usado majoritariamente em aplicações web, a linguagem PHP é útil para incluir funções a uma página que o HTML não é capaz de suportar. A linguagem também é utilizada para integração entre informações de sua página e banco de dados MySQL, por exemplo. Sites como o Yahoo e a versão web do Facebook são mantidas em PHP.','1','0000-00-00','2018-12-16',0),(3,'C#','Outra variação da linguagem C que é bastante popular no mercado. Porém, anda caindo em desuso em relação a anos anteriores. Assim como o C++, é mais complexo de se aprender que outras linguagens como Python e JavaScript. Por outro lado, ainda é uma linguagem bastante requisitada na área de desenvolvimento de games, se tornando essencial para quem planeja entrar nesse mercado.','1','0000-00-00','2018-12-16',0),(4,'Python','Considerada a linguagem de mais fácil aprendizado, a Python continua a ser uma das mais populares no mercado, mesmo que tenha sido lançada há quase 30 anos atrás (em 1989). É um dos códigos de mais fácil leitura e é bastante utilizado para desenvolvimento web e machine learning.','1','0000-00-00','2019-01-20',0),(5,'Ruby','Se está a procurar trabalho em uma startup, o Ruby é a linguagem perfeita para conseguir uma vaga na área. Usada na construção de serviços mundialmente reconhecidos como o Airbnb e o Twitter, a linguagem Ruby se caracteriza pela sintaxe de fácil leitura, permitindo que um desenvolvedor escreva menos código para que suas aplicações funcionem.','1','0000-00-00','2019-01-20',0),(6,'Objective-C','Uma variação do mundialmente conhecido C#, mas específico para construir aplicativos para iPhone e iPad. Ele não chega a ter grandes variações, mas é necessário para quem possui interesse em garantir uma vaga em empresas de desenvolvimento mobile. Além disso, a linguagem é a mais popular para quem constrói aplicativos para os aparelhos da Apple.','1','0000-00-00','2019-01-20',0),(8,'JavaScript','O JavaScript ainda é amplamente utilizado em aplicações web e tem ganhado espaço no desktop/mobile, sendo bastante usado para criar interatividade. Apesar de ser uma linguagem mais antiga em comparação à maioria das que serão listadas aqui, o JavaScript é bastante requisitado e parte desse sucesso se deve a sua simplicidade.','1','0000-00-00','0000-00-00',0),(9,'GO','Esta linguagem simples e dinâmica permite a concisão e estrutura de compilação do C, tendo a facilidade de uso de uma ferramenta script dinâmica, apresentando variação, em comparação à C, sobretudo quanto à declaração de tipos em sua sintaxe. Essa linguagem criada pela Google é um bom ponto de partida para startups que buscam se diferenciar junto aos grandes buscadores. Aprenda mais sobre essa linguagem em seu site oficial.','1','0000-00-00','0000-00-00',0),(10,'Groovy','Recurso muito útil aos programadores que querem escrever programas simples, aproveitando o código Java preexistente. A Groovy funciona como uma linguagem de script dinâmica e Java friendly, podendo ser executada como script utilizando código Java legado e suas bibliotecas favoritas. Em seu site oficial é possível obter detalhes sobre a linguagem.','1','0000-00-00','2018-12-24',0),(20,'Erlang','Esta é uma linguagem funcional para sistemas em tempo real, desenvolvida pela Ericsson. Seu segredo é, justamente, um paradigma funcional: a maior parte do código é forçado a operar em seu próprio universo no qual não poderá corromper o restante do sistema por meio de efeitos colaterais.','1','0000-00-00','2018-12-24',0),(22,'Julia','Esta linguagem dinâmica de alto nível empresta velocidade ao Python, sendo utilizada, sobretudo, na área de computação científica','1','0000-00-00','2018-12-24',0),(23,'VB.NET','Visual Basic .NET é uma linguagem de programação, que também foi criada pela Microsoft, totalmente orientada a objetos. De uma forma simples, é a evolução natural do Visual Basic 6.0. Nela ocorreram inovações na linguagem como uma nova estrutura de gerenciamento de erros, adição de namespaces, heranças e multithreading (capacidade de executar mais de uma funcionalidade ou processo ao mesmo tempo sem um interferir no outro).','1','2018-12-16','2018-12-16',0),(30,'C++','Um dos principais motivos pelo qual o C é uma das linguagens mais populares também se dá pela própria popularidade de suas variantes. O C++ é uma versão mais atual do C - embora também já tenha certa idade - e é bastante utilizado no desenvolvimento de softwares mais pesados, como sistemas integrados (CRM), aplicações que promovem interação entre cliente e servidor ou jogos para computador, entre outros.','1','2018-12-22','2018-12-22',0),(33,'F#','F# é uma linguagem de programação que oferece suporte para programação funcional, além da programação orientada a objetos. Como um membro recente em .NET, a linguagem fornece segurança de tipos, desempenho e habilidade de trabalhar como uma linguagem de script. A programação funcional estimula o uso de uma grande variedade de formas, principalmente de funções matemáticas, que estimulam o uso de seus resultados como parâmetros para outras funções que podem ser consideradas parâmetros de entrada dessas funções ou resultados das mesmas.','1','2018-12-23','2018-12-24',0);
/*!40000 ALTER TABLE `lingua_progs` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-02-03 16:50:15
