-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Mar 04, 2020 at 10:53 AM
-- Server version: 8.0.19
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projet`
--

drop database projet;
create database projet;
use projet;

-- --------------------------------------------------------

--
-- Table structure for table `Admins`
--

CREATE TABLE `Admins` (
  `idAdmin` int NOT NULL,
  `idUser` int DEFAULT NULL,
  `Email` varchar(255) NOT NULL,
  `Fonction` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Admins`
--

INSERT INTO `Admins` (`idAdmin`, `idUser`, `Email`, `Fonction`) VALUES
(1, 1, '324b21@protonmail.com', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `Blocked_Users`
--

CREATE TABLE `Blocked_Users` (
  `idBlock` int NOT NULL,
  `idUser` int DEFAULT NULL,
  `dateBlock` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateFin` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Conversation`
--

CREATE TABLE `Conversation` (
  `cleConversation` varchar(255) NOT NULL,
  `dateCreation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nomConv` varchar(55) NOT NULL,
  `idUser` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Conversation`
--

INSERT INTO `Conversation` (`cleConversation`, `dateCreation`, `nomConv`, `idUser`) VALUES
('InjrpM5OHIW2mQwuFMvb3', '2020-02-29 22:05:36', 'test', 1);

--
-- Triggers `Conversation`
--
DELIMITER $$
CREATE TRIGGER `ins_conv_part` AFTER INSERT ON `Conversation` FOR EACH ROW INSERT into Participe VALUES (NEW.cleConversation, NEW.idUser)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `Flagged_Messages`
--

CREATE TABLE `Flagged_Messages` (
  `idFlag` int NOT NULL,
  `idMessage` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Message`
--

CREATE TABLE `Message` (
  `dateEmis` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `contenu` blob NOT NULL,
  `idUser` int NOT NULL,
  `cleConversation` varchar(255) NOT NULL,
  `idMessage` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Messages_Decryption_Keys`
--

CREATE TABLE `Messages_Decryption_Keys` (
  `idKey` int NOT NULL,
  `idMessage` int NOT NULL,
  `idPersonne` int NOT NULL,
  `messageKey` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Participe`
--

CREATE TABLE `Participe` (
  `cleConversation` varchar(255) NOT NULL,
  `idUser` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Participe`
--

INSERT INTO `Participe` (`cleConversation`, `idUser`) VALUES
('InjrpM5OHIW2mQwuFMvb3', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Utilisateur`
--

CREATE TABLE `Utilisateur` (
  `idUser` int NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `password` text NOT NULL,
  `private_key` text NOT NULL,
  `public_key` text NOT NULL,
  `description` text,
  `Name` varchar(255) DEFAULT NULL,
  `Gender` varchar(155) DEFAULT NULL,
  `Age` int DEFAULT NULL,
  `Occupation` varchar(255) DEFAULT NULL,
  `Location` varchar(255) DEFAULT NULL,
  `Quote` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Utilisateur`
--

INSERT INTO `Utilisateur` (`idUser`, `pseudo`, `Email`, `password`, `private_key`, `public_key`, `description`, `Name`, `Gender`, `Age`, `Occupation`, `Location`, `Quote`) VALUES
(1, 'fookinpelican', 'insaneinteractions.ii@gmail.com', '2bbe0c48b91a7d1b8a6753a8b9cbe1db16b84379f3f91fe115621284df7a48f1cd71e9beb90ea614c7bd924250aa9e446a866725e685a65df5d139a5cd180dc9', '-----BEGIN ENCRYPTED PRIVATE KEY-----\nMIIFHDBOBgkqhkiG9w0BBQ0wQTApBgkqhkiG9w0BBQwwHAQI6h93DDDTS+ECAggA\nMAwGCCqGSIb3DQIJBQAwFAYIKoZIhvcNAwcECEwyVz3eX9n+BIIEyHf1f4QR2/p3\nDviBWjwMu0bcy2ZqY1gF92ywhcU7ymwZuH5zPFL/ATxchzpeARsO9S2EAPs/l9yh\nxXwqqbOb4V6buSa4YQ4cx12ftFitALFHh5og64TVOfCTcNPJLJpNwFTfaeK7rg48\nVAUw7GRcNf3Ck+Y/zIY98ePR8NYZ+uUmS2NxcDY9L2EELqeXh7VMoJAxMEastUEu\ng6pwmYmot3MGuw2oIpcaM9CDS5WQ/wAtSrmhbeoxy4GGVDMRNKSvrL9t0j4WI35w\nBjx+68CRvwwZXSjv9on4zZJD8WiF9vp/U2/DwlxbSp5n4rQMkJ+B/8eiRFwi8zk1\np5NHNWej6lkTZ8K4xlK1WNas9tTWakmjhLrxFFCFgXJfPA/f9jUnKo0JqjFdk1Yq\nTDKUt9V3W7f4/TfZt0k6p6YrxuaExpToESA94VErVCkzbYInZdMH4JrdY711DPrG\nE1XPJeML7pVfjrX0kImwsIMoEw8YMebli8USWirv8EeB3ISa1nX3IRzpXsJf/cq2\nhmto5DF8uZ3T2CI+DkF2wcVY1c//E8JP3Ht9JCnpYa8yH4CIFMz6PhNOraC/VMu9\nFAcjt8qHYOI08PR1oYGwL/QXpI7quZTUuM9hi3WPEKoPgtgj+78xVxyhi0G384C0\njz5jcOFIVwBv5+ch7ymroCqwV9ClvL+Yf8vAYO9jLFikc1in1pdCEcbPutAasNV5\nbu7c/vIb4kcIQRpz53TpgqA6K1AJRGwr9XcZA/aaPJeYyKcAhY+MRCj04OdVzR8c\nX5UUv65/Up/81RcvmLPao7kjqJnm2OADBJKOZ0cmPQMGBndzKcTWV4lw1CkOUZO/\neP2BVWIS/JTOALEO2maVgSzirr1QQBZgfk+jm8svI11hOj08l1Q/9FmdvazFECoM\nX3EIn+XKUWJp3AXw9WXYIEddxZJJUmLEigbbD+NAo0UpyTIcumHE6CeuVxZ8CGLM\n0ds+U4LGWLJ5Srl9+u3s3KqSKElFcwzEPSOGPC4osoPXiOVZ5MzbImSskIgfpXnd\nJ9gtO5rgHc5HMBrzaymaV2a9ghK60jQ91pWcXYnH6njyPbyInTGAf22VXoALhmj3\nn1MTJ9vwzCiwRg2IK8WKgogFV6HtXQBiI6OnED4MLyv/nB6CH6D0h9uPvh2fSafk\n1yeMekeDi9bz5hKNIQ5LqjDL9PLK3ggKFuk1K+VW8y+7CZuk5Wd3yIZImOjPeWJe\nq9LAV/qMLTnfbTvt25mKiY2xxxd4YAEo+6+OahsRilN8Lqvt1cUy7NwNwgqF6XNu\nuVu8jaIa5n3drlImegQCVxgNd/FMnjon1o0ocpLin44fUSy+zs3GWhZsoxwoftHD\n0IoypqWECt9nAgYt8Pt29lPHcWwxSkyn8l+GpNeDMJ6ZEvMpI8f7Vlf8uEEf1g/a\n+J18sSgrkuw+ZBnxu9YnjPBmvK8LMa3pTxA9R/9vKq2F7tnGZyMcHqOv9hK10obW\nqcxkF9Pt7JPGF5m44z6pimRZQnup0eLXVVjLmjrRtjoJBLa2zjkG35pK+3UdLN33\n0YuE+BCMfrJl1gkwtYkX9X0v7Fsvz9NoQ1Qgl3irE9gBXCYWD/8iUVw8PvKsFbSw\nh+Wdtk6u6VSXPl49dTQglA==\n-----END ENCRYPTED PRIVATE KEY-----\n', '-----BEGIN PUBLIC KEY-----\nMIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA377YpGESc6zuqOT2OTZL\nOdMeQZA/o+oQjQtWdpeH61dCgrguZXD1MdDjhPY6r7TYu/Vj7R5nlf8vEHC7vudo\nT3yN/g0AHA0HHxHa6DbSYKdP9uprzeb5ldPxUw/VCuzEaVwd0qHlgCW9ISRr1ZFJ\nZlwbVb7pI7HXZeBb5Hb74bvFxlv/IokfxV+MWcXa3x6AbUMxXvofGZOAcAHnjYri\nC5sSRg/8wTuedpDaB8TNWLc5X/3ypGoCtGyRuTYhtBryxVvEAYHUT8P0whpl6Fnn\npmNHAbvzuOedKQHeZewDQrWpwEtHGeuOt5RGBah0wpF7Hl/tpmAW8EgLCLJWPJxu\n+wIDAQAB\n-----END PUBLIC KEY-----\n', 'no thanks. ', 'Fookin Pelican', 'Other', 66, 'person', 'the moon', 'Le Soleil est plus brûlant que les oiseaux'),
(2, 'testidsession', 'test@unit.com', '37c44029a230e2e983563121e92edeaf1bc46525e7f2bbba3add62ed9f129decb5e27fd7b95503799c80cd55d9b2f0decf59fcd4c4232dbf8d37458d7cf684e6', '-----BEGIN ENCRYPTED PRIVATE KEY-----\nMIIFHDBOBgkqhkiG9w0BBQ0wQTApBgkqhkiG9w0BBQwwHAQILEbZEdD6UB4CAggA\nMAwGCCqGSIb3DQIJBQAwFAYIKoZIhvcNAwcECCu88wY/EWKoBIIEyP3MiUtjW/i2\nzgBFMALZ5hkZJi5/DVDtTSFhNyzyNzyXO7dSiFl5idsHZP+7vOqcAhs1rjGt2K2v\n3AwR9EhMn45acqnTrBNGSec3nLbSXSWHPCu0gwg7JlSZ1Z+G51TcNQiZjNQJHnk3\n11nfUwNBwfoo0JnlgLXRYUqDOAkAoC04R54ES/VRFknVHgJ8Nc8bOGUWJ/14/aKD\nSKoSMRVAR+ZaG5FKyqI1Xq1HTAjLS+F65CPj1FUYti9ZmwEbTny7pJd90X0gQyhm\nnvI81FBOyKfv1b8jHXb2uG/g35XrdSCVOeTajOgIDfpbieMY9GahA+l7FyVX8G80\nVbjEE0GGOuFJygi+TXksGt2IDv0q9qCCyw8Qgf9sFsjjCnp2CBvFyH2EU4PfaN90\nBDgSUYoJkO6PJkSoU3xw8A5d6ygChgir7vKfyQm++4hIEpw7ChDSTeiYTqW7hb58\nBuMIdGr6BB6oIuIm9dtDkLbViODRcDzFrrOgBJqnj0OIpT75rPJDxnQMgAXax/sP\n7d22RzbDAxRjABzeowc2b4jUeIreqJQkUDIyYood7z0hqs5VS8g0StzdhpW05qkD\n70PXG1AxQhvAyW4M6XjgdixL0IpRAgfTVlUNruXWZfOguyCjBb0p+7F5U5otH5PT\nbbyVT62L9IFMDotHkqKCpFW0C1KSZgVcO14u+u1pyfjGd7DMZFJUcR3fxdFm8MlW\nTfMgd9x0X1zEYzTMXqvS2jUDQQQ489l1reyWBk0bvVQfoE0aAYR9U0SFgehqEq21\nGIkC6ajMKZ5qDNbJYTDVQqqYUORUzpGhj0PQohKxfzr17s0xIo5NSAs6pmOY6J+w\nvACERGkutAZp9m+cPUA3pT2tjJJDFM1uxHx8iIlKSM9nNJQetMqZf7brNlcHNP0Q\nQfq73LbYWXhXBnVhqBxgP7ofxKgxBzaVGDODxCrbyuzwsevBQzDwNCmaip+x1rSV\nICXlPxXp+WFfeTOBEWyG9uPaavoUWgyEDzTYAl2HpGSMyQU/2uYlf/L0BruJyDpr\nlu6IYVe06fFMOavHf6qfUGCFK4uDKYumtbjYt8ourCd0n+5eM1RWwtAdX1j0kks7\nm/ZcVgI5IMhkyScO4Z2MH7iIWi7UNL7oot8JXC4NZWpYRwrlUqilmucu3UuFKWwj\nF3jPVgmAcU0O8aJavoIl2LFRHqOzH2ZSmOVByboVIFqiD2pR070SOt8PBbe7s0Zb\nTx7jmBw+uN+fcb0KcslSVejLMnXnS9ZUnyPcsjhh8zGDN7qRg7cvSMvSBfIAviEk\n56qleIFXOv9VS/hr25GMt541q72GNlejjqVAa/olllaPuF5Hwmdr/QshK/3Fl58G\noL1+Za4iLD+bwzzGmKROh0cPo8XsxWysmTkrJYirLSAiBfTMqTzF6OVHAP4bAHXb\nhlikHbSKwcblS6zVr58EqcVa3zRMTvRbr/E6ckxDw5AdeF71K7RV+fCqUH9BCWZb\n2QNoFS2D8bz5tlRjEsSB4gNoubJGlAcBSaVQzS37JuzPbEYwzcSgcN8qdcAiTmTY\nmncX5F/hFOYeJjZjN61Hohq9V7RQ2EseCVy2y5TZ9+ZcKOmAIWlKUYJrzD1V2JER\nhXN36SrDXxWJ8eZFwUbHGQ==\n-----END ENCRYPTED PRIVATE KEY-----\n', '-----BEGIN PUBLIC KEY-----\nMIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAtllowMD3WKGtwKuFDeC3\n5/6uiUMLnGSy+2AhkFnrx5mO0BI3sQRX1bvOlEVNYlw42hRrInN2bUpu4dHXlOBW\nsTjGHLgqad6GEAqk0NlJINZXtZQrGsowJbNAeUYSbBNeOZggbTxMzyxRx61CUPkh\nf99DrnsVGngRGog9NJWHS1q/nv/kY0JtjW95zDQUCgg99eN+ZcpevJafsVkqVzVn\nm17bU5uURyX5HrE2Izr+v9ia6aCJUKEAhlMgLSTQM7C0BysmZa5hhSgbPuwcwdNl\nB+xh0NnpFtBV20MzRJpVzxgE/2qIuQkrMslYYE4HEuVd2sRC4WDu+JP0Xyt6Quf8\nzQIDAQAB\n-----END PUBLIC KEY-----\n', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'canadiens', NULL, '47320ad7a9ba3364f14ee865e4f1bb6aa614c52bb05099bf18cf3cd7c396210846f73b55c821fb15a535ea6bc26bc7a2bcab328bd8ff96c113d27be20680c039', '-----BEGIN ENCRYPTED PRIVATE KEY-----\nMIIFHDBOBgkqhkiG9w0BBQ0wQTApBgkqhkiG9w0BBQwwHAQI70INKDKwTB8CAggA\nMAwGCCqGSIb3DQIJBQAwFAYIKoZIhvcNAwcECCE6QFWQFwFcBIIEyGyDzVVSOdbc\nezgG40+vUij43pomb7Ff7eZfjRfZ9ix0dJfbOut4782Xf94VRmAEaxPfhB+LhGjF\nzW+npiQh5crvjaGtEldK6CJwR90v+ffTMF9WpUUjyQO1wM0KymADoI8soTqV7Cgc\nEJnER/yzcG28aykxTPZ1Tx3UqwbdrvGC+Eow00JBsyh9hAgfFiOMJby46Imm/Dsa\nCYznlQpxt/lrZZnQ01A8jZ/K9TBlC5MCskHSdZsra24iCCy5Aa533FRwhv4wuuAf\nCVlIYwweezxjMiBTEneTrsE/TThBDKqIrrNzyx5mQLnBtG49/seLX8tz91VYRN+e\nda7JkDIhl/i97yIdFsyimsWBqB0jX3JE4EbBsPaVy8qp27HqI1QtxZa73z0jUlir\nuGP0qk7WiJ0csXTapRCdi9X5gidfRvYBVRED8fE7+GSjz1+lyLmUgE3RqHyawpxN\nABXXLWeBToJqJzK/2OeH5XB5Myx28KQKxT03p8ypOV45HLxDaprYE1JJTFylF9nQ\nP8xCuxFP8694SVbvL/jYw36uJxBOn1Eu+9bINgZPE9wfJzRfX7CHvEZAPOUJW1Gd\nZ7XCFPAtyrfiHmSkK2mlwVR4cgdMs9kujS4MGszf27b9k8lEWbHM07wEFabDbTzQ\n/x3mzMolLEqoJBGlMD/M5PMbmDLFsDwllZus1dERxdiI5B0pX2AkGJJxWGRpT/GB\nxrf5aWv9pActkFdj7okK8T+5NrLozhklrpO9V9Wmvr+85t0FhmEkbEJppcrz9Vi4\ndAKnb6Sypb0mEX04PteY4CIenQfFwWN1hIXdDgV/mZsRxZGwj0EgrBpwrtUQr76V\nFtB3+yRatZERY7z/hIqjonGfVWJRh6dppLREXgnAFiK4+ePsX9VBit8XsSYH8AmT\n8iprmddFgS/kqNoX5Vy8uv+rWSDA8rkupTAUqIol8KPDYv+4fN56K2tZhqrQod6b\nICN4W/l8b8Qj3Nm2s5JPtwFF29KoRUXUe6ewsKr2cLCvQSSdE/u/0iY2PMsfv1oa\nKZQKtrjuNecSAR8GDJNkIZgs6Zb5vEs6bQij3Nl6bAWhR0Ogv389VcHnmzTdnyYx\nk2F1OzHW0FmFdJTqZPRpxwTPyhn5iKMLQswIXvHct+U6SBDxiVjHUfj5a4mGRqyw\nsTH2LKDPHvnRw5Vp6o0GNkY8FWd/kss1/2RIjcttfSrkLl+UL6GJkuC6ekhhsKBc\ncZngtyRHlKY3snw7r+NFnNqHl3I/iAZryzpWhI5Bnfq25kEhmwvBGAUCjDsi2YJJ\naCt/VWyvDVIfI6MJfQOvt4mufP4iv6br7G9IYVVoTghrOC+0RunZcj3ux8z8KiX2\nCQ23nrR5pj9l4kswr2pxdTSXy1gpwazpej1/l/XRlke2WVkNvL2+p+ohygXJUgqp\nabHGRU7khDOKq5DYl7jygb2dPTITBUVlxpZxSqYEC11Mf3axbrfNY4r3EPYl4R6N\nkOR/hFr9D+/dqNuUwSY7q6o4Pfwmd1ndOc3u6sSDF5/Smu81dgsgvlthKUd3YgcM\nPqB7ohZslwahJmOMS+JIwUNd27k1BrBz+eajPDbPiyAhNwFVmNuZeC8b4pqUXebq\nS1jxEMFBGlJr+PfWQ2OdyA==\n-----END ENCRYPTED PRIVATE KEY-----\n', '-----BEGIN PUBLIC KEY-----\nMIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAqR7Ew0Tw2Z7Aza0NOZ+2\n1C0wU3q7MS+zD2i/Nih20xYGLmkeL2hJ7Cr23q7hdn5EDjVr1mrpHljrvhlPjgm7\nxhiMWfnCbVTODzamht28Fb8k+Lkp1HcMR5xEpS2lbO+8yD93b/p3zcwxQYGtBqnO\nL1x9GFt8uIW80hRQHnXUELx+5hD9r+ZYP0pZXwbNu6RYdvTS6BGu+7w5XC0UR4o7\n+Ymz6pEChU2+cigc4c1k0AuPKwXb4mHny0JyNt/bxDkjyPBFlLDATnikEysqiLoZ\nLR1dlv2XXsbcRhcyQVIMZ052nQJMsoibszrA1if3EK+zY99ud4dYPg0elwmsl+QX\nJwIDAQAB\n-----END PUBLIC KEY-----\n', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'testtt', NULL, '03e5eca7bca6b5a1981020b60301918577e7d8d7990fd93693da74249acee489324328ddef689408af3eea8d546e35bacae5ec5d54e6fceed4b531d7b5ee9065', '-----BEGIN ENCRYPTED PRIVATE KEY-----\nMIIFHDBOBgkqhkiG9w0BBQ0wQTApBgkqhkiG9w0BBQwwHAQI53bI6kMnd1cCAggA\nMAwGCCqGSIb3DQIJBQAwFAYIKoZIhvcNAwcECGPHDUJIttGZBIIEyCEqFgpc1E0i\nfWfFXxPEZqz1KD0vuyj+pnZgRcYVKZD3955RbaH7bB6FcUteSmKPfG5PoFKbek3v\nWRE+3aEHOe55gvcP9N7BynQQDH2aeduNREpsorQNM3tz6TB0onR20avgQYLF2xb7\nxbm0PFby9cihvIBlvPPyz5RhTzgTixA1XAAvOSJ30oPeTgxLgLdPlyUXvrUPR3V9\nO2xNwJIqvNs1w0iL6HhS3EWLKIQwe4UfQCangEd/ZrDafVniztZy96XGj6LusDoJ\n1LZHtXK7VKRJwwm3tiT/uOcisfHyEoaAdbW9HjXx3XTNyhTUpAeExKH5Y6IWqOVb\nPrjfWc56H8tJLvDNzMA9mckIYTOI4LWnPNOjl7k55Fkvi71pFEGV9QAiSJvPjMZV\nWLoTmg0T7HxwE6NZzXR9YfwDHUbggTc2S5JZ7bNjYF7vif9FSX+EMh65aGyygnAf\ncXa6LPjp/oSydqdiuogWL1RifuMY0IEQ5DfT3nyHpyv7B8QUbtToYiEeUrdKx8Vd\ndZCFxommju2r04L3iPzx1sZJrcSWHFQ2oh466bHpejxGwvr4IQkqNFDt28g25HOP\n6zk5OADjelcYdqjBAobKwRaM+Leynweo/7w483oNU48+Q9QDoFp57ry61gzYXF95\nKGkSrPiPQUGDmuCl2cxxQR3iT12A3D4QP572JL1HFG7tAcUYg0VcTe+69nmQCj7K\nFSQqu2JvttiSIaQEnBYWXiRVtqqSmeoSDjJB9KnCpP2uRwiqMl8h/rVm5csJ8AMq\n5DDyNs5HXNLnukk0e3snffnh0pKRMx6aNkh0FY/wpFepDGg3tJ0pM3M5E+/T4Syv\nL1hBEpoP2++VVABRNZhLdcwZgq++UCPumOVXOnCkaOb7eHtzHR4dSHv2ksarTwKb\nvwhWyDm2EHs6yK0gpGC0ljNRROO1Nd7UlHzuQSrPSN1vG7Jz9BssaVCHTf+4Dqjo\ntQW+kFVWr0ZfOMQFOOU81rqG5jIDH1eTGxg7j3CkV/5gAjDC3hvM0+big7V4J5as\nzeG749C7jqmPkV6uXERiUHu9szoiJGcvztPri6wxQttnevQqkTjZHD+W4ZXgzDRw\nnbWGT89KVThdFIH+HGOAKdToz9dnCzGXVQLy0DEHXPFRSPS5Tc5VV+tvLFOmR8z9\nBBYatZY+tHP8bIm9U15XgU1eoIG5havg0XNrbQ4IIReyu4sglsBeRkKMeTT4466l\nUGBdEgAP31eBiOGVeoueo4dnWCqzQp60/A1m9Lb4DWutrO3qMLF4BrvmnECQ7dpK\ndAm6d1GrLY07b4q8YNX/VoeE1jUgJhIiIKxn4FDCC1YuB1NdggVf71bhMZJp4QUc\nvuQWgo/YH+37xU58k8obnZs9/+UxIPzoYBTiCHo3h2IcWTYuSrQ2FJ0nP9yAXRLT\nxXg7Co5Aw8N9Q2HVaaqCClZkS7j/7PQIfTk/PvhEAmOIkukBh+4v8ogi2mbjIw/6\ngrr7UC4mnRVJT7Se0gHZipfVeb3D/nbWtl6L8CcRMiJrjYUlDhkhDFZML1InoEFn\nb7447o1ijuimd1BAxGu8hXXIwGr+6WJCk6zScHrt5njlV8nnnMnmHx/vxgmdgz/5\nufpFs/lScXPCKkhbj8Ny8g==\n-----END ENCRYPTED PRIVATE KEY-----\n', '-----BEGIN PUBLIC KEY-----\nMIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEApLLgrjUpF/uuYZn/STWm\n+xkjGi0eTsgCkwiGmWpUGBJxMGxoxu5vsSGPF2v3fYRbreP+0mGIgdrKj1QYvLII\n5dc/qo33V4RzJr3yx9/2bdeqSHhltwm8G3XimjvFJ69Q7hEJmtykH03ty7j6Jsm6\nr4Iyn4sh4OrPiXZijWqQ6rK7CfALabAl2uD3/hVr8UvtoTX2jqcL0/8A2/4zGaTn\n5HQMQcDcsYlgnhEpxIdU7wKLt2uD0i99B/HJz9yNBxhXBegXK2gQG3KmvHiTChEc\nRsNCwdkZ6Lv5TS8hyRdBfnxEGE4MLGu8siObz8SknPTowRvUYvDtrXQ82VA5tFKX\n2wIDAQAB\n-----END PUBLIC KEY-----\n', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Admins`
--
ALTER TABLE `Admins`
  ADD PRIMARY KEY (`idAdmin`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `idUser` (`idUser`),
  ADD KEY `Admins_Users_fk` (`idUser`);

--
-- Indexes for table `Blocked_Users`
--
ALTER TABLE `Blocked_Users`
  ADD PRIMARY KEY (`idBlock`),
  ADD KEY `Blocke_Users_fk` (`idUser`);

--
-- Indexes for table `Conversation`
--
ALTER TABLE `Conversation`
  ADD PRIMARY KEY (`cleConversation`),
  ADD UNIQUE KEY `nomConv` (`nomConv`),
  ADD KEY `idUser` (`idUser`);

--
-- Indexes for table `Flagged_Messages`
--
ALTER TABLE `Flagged_Messages`
  ADD PRIMARY KEY (`idFlag`),
  ADD KEY `Message` (`idMessage`);

--
-- Indexes for table `Message`
--
ALTER TABLE `Message`
  ADD PRIMARY KEY (`idMessage`),
  ADD KEY `FK_Message_idUser` (`idUser`),
  ADD KEY `FK_Message_cleConversation` (`cleConversation`);

--
-- Indexes for table `Messages_Decryption_Keys`
--
ALTER TABLE `Messages_Decryption_Keys`
  ADD PRIMARY KEY (`idKey`),
  ADD UNIQUE KEY `unique_personne_message` (`idMessage`,`idPersonne`) USING BTREE,
  ADD KEY `FK_Messages_Decryption_Keys_idUser` (`idPersonne`);

--
-- Indexes for table `Participe`
--
ALTER TABLE `Participe`
  ADD PRIMARY KEY (`cleConversation`,`idUser`),
  ADD KEY `FK_Participe_idUser` (`idUser`);

--
-- Indexes for table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  ADD PRIMARY KEY (`idUser`),
  ADD UNIQUE KEY `pseudo` (`pseudo`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Admins`
--
ALTER TABLE `Admins`
  MODIFY `idAdmin` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `Blocked_Users`
--
ALTER TABLE `Blocked_Users`
  MODIFY `idBlock` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Flagged_Messages`
--
ALTER TABLE `Flagged_Messages`
  MODIFY `idFlag` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Message`
--
ALTER TABLE `Message`
  MODIFY `idMessage` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `Messages_Decryption_Keys`
--
ALTER TABLE `Messages_Decryption_Keys`
  MODIFY `idKey` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  MODIFY `idUser` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Admins`
--
ALTER TABLE `Admins`
  ADD CONSTRAINT `Admins_Users_fk` FOREIGN KEY (`idUser`) REFERENCES `Utilisateur` (`idUser`);

--
-- Constraints for table `Blocked_Users`
--
ALTER TABLE `Blocked_Users`
  ADD CONSTRAINT `Blocke_Users_fk` FOREIGN KEY (`idUser`) REFERENCES `Utilisateur` (`idUser`);

--
-- Constraints for table `Conversation`
--
ALTER TABLE `Conversation`
  ADD CONSTRAINT `Conversation_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `Utilisateur` (`idUser`);

--
-- Constraints for table `Flagged_Messages`
--
ALTER TABLE `Flagged_Messages`
  ADD CONSTRAINT `Message` FOREIGN KEY (`idMessage`) REFERENCES `Message` (`idMessage`) ON DELETE CASCADE;

--
-- Constraints for table `Message`
--
ALTER TABLE `Message`
  ADD CONSTRAINT `FK_Message_cleConversation` FOREIGN KEY (`cleConversation`) REFERENCES `Conversation` (`cleConversation`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_Message_idUser` FOREIGN KEY (`idUser`) REFERENCES `Utilisateur` (`idUser`) ON DELETE CASCADE;

--
-- Constraints for table `Messages_Decryption_Keys`
--
ALTER TABLE `Messages_Decryption_Keys`
  ADD CONSTRAINT `FK_Messages_Decryption_Keys_idMessage` FOREIGN KEY (`idMessage`) REFERENCES `Message` (`idMessage`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_Messages_Decryption_Keys_idUser` FOREIGN KEY (`idPersonne`) REFERENCES `Utilisateur` (`idUser`) ON DELETE CASCADE;

--
-- Constraints for table `Participe`
--
ALTER TABLE `Participe`
  ADD CONSTRAINT `FK_Participe_cleConversation` FOREIGN KEY (`cleConversation`) REFERENCES `Conversation` (`cleConversation`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_Participe_idUser` FOREIGN KEY (`idUser`) REFERENCES `Utilisateur` (`idUser`) ON DELETE CASCADE;

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `delFromBan` ON SCHEDULE EVERY 1 MINUTE STARTS '2020-02-13 18:31:51' ON COMPLETION PRESERVE ENABLE DO DELETE FROM Blocked_Users WHERE TIMESTAMPDIFF(MINUTE,CURRENT_TIMESTAMP, dateFin ) <= 0$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
