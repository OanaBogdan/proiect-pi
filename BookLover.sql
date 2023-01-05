-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.25-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for vstack
CREATE DATABASE IF NOT EXISTS `vstack` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_bin */;
USE `vstack`;

-- Dumping structure for table vstack.category
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `image` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table vstack.category: ~6 rows (approximately)
INSERT INTO `category` (`id`, `name`, `image`) VALUES
	(1, 'Smartphone', '1.png'),
	(2, 'Componente PC', '2.png'),
	(3, 'Periferice', '3.png'),
	(4, 'Networking', '4.png'),
	(5, 'Console', '5.png'),
	(6, 'Laptop', '6.png');

-- Dumping structure for table vstack.product
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `type` varchar(10) NOT NULL DEFAULT 'item',
  `category_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_name` (`category_name`),
  CONSTRAINT `FK_product_category` FOREIGN KEY (`category_name`) REFERENCES `category` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

-- Dumping data for table vstack.product: ~48 rows (approximately)
INSERT INTO `product` (`id`, `name`, `description`, `price`, `image`, `type`, `category_name`) VALUES
	(1, 'Galaxy S20 FE 5G', 'Iată smartphone-ul pentru cei care își doresc totul. V-am ascultat părerile și am creat un dispozitiv care nu face compromisuri, adaptat fiecărei nevoi. Pasionati de fotografie? Jucători întăriți? Întotdeauna în căutarea unei noi inspirații', 399.99, '1.png', 'item', 'Smartphone'),
	(2, 'Galaxy Note 20 Ultra', 'Primul exemplu de fuziune între stilou și smartphone, cu Note ai o lume cu totul nouă în buzunar. Pe măsură ce ne confruntăm cu o nouă normalitate, viața necesită un nou tip de dispozitiv. Acesta nu este un smartphone obișnuit.', 999.00, '2.png', 'item', 'Smartphone'),
	(3, 'Galaxy Z Fold 2', 'Descoperiți smartphone-ul care își schimbă forma în viitor. Acest dispozitiv inovator oferă performanțe puternice, sticlă flexibilă și o durată lungă de viață a bateriei, totul în palmă.', 2050.00, '3.png', 'item', 'Smartphone'),
	(4, 'iPhone 11', 'iPhone 11 este unul dintre cele mai avansate modele dintre smartphone-urile marca Apple. Display-ul măsoară 6.1″ și folosește un panou Liquid Retina HD (1792 x 828 px cu o densitate de 326 px), ceea ce nu este nimic nou în comparație cu cel folosit în tre', 629.00, '4.png', 'item', 'Smartphone'),
	(5, 'iPhone XR', 'iPhone XR este un compromis excelent pentru cei care caută un smartphone marca Apple fără a fi nevoiți să investească sume foarte mari. Acest model ofera un ecran de 6.1 inch, realizat cu un panou IPS LCD si cu rezolutie HD (1792×828 pixeli)', 529.00, '5.png', 'item', 'Smartphone'),
	(6, 'iPhone 11 PRO MAX', 'Ecran super retina xdr de 6,5" (oled) Rezistent la praf și la apă (4 metri până la 30 de minute, ip68) Sistem de cameră triplă de 12 MP (ultra-larg, lat și teleobiectiv) cu modul noapte, mod portret și înregistrare video 4.', 1224.00, '6.png', 'item', 'Smartphone'),
	(7, 'iPhone XS', 'În lumina evaluărilor noastre, iPhone XS primește un scor de 8,5 din 10. Este de fapt un smartphone grozav de ultimă generație care oferă performanțe solide, chiar dacă nu la egalitate cu succesorii săi.', 420.00, '7.png', 'item', 'Smartphone'),
	(8, 'iPhone 7', 'Cameră de 12 MP Zoom digital de până la 5x Clasament IP67 - Ecran Retina HD rezistent la apă, stropire și praf - Ecran lat cu iluminare din spate LED de 4,7" (diagonală).', 149.00, '8.png', 'item', 'Smartphone'),
	(9, 'Huawei P20 Pro', 'Schimbare de viteză pentru Huawei după prudența arătată anul trecut cu seria „P”, pe de altă parte era inevitabil și noul curs era previzibil după excelentul Mate 10 Pro, unul dintre cele mai bune Android de pe piață în prezent.', 759.00, '9.png', 'item', 'Smartphone'),
	(10, 'Huawei P10 Lite', 'Versiunea „Lite” a celui mai recent vârf de gamă Huawei marchează o creștere suplimentară în comparație cu predecesorul P9, continuând pe un drum bine trasat fără șocuri excesive.', 266.00, '10.png', 'item', 'Smartphone'),
	(11, 'Huawei P9 Lite', 'Designul este similar cu cel al celorlalte dispozitive din gama P9. Profilul este metalic. Sticla in fata unde gasim o camera cu focus fix de 8 megapixeli, luminozitate, senzori de proximitate si un mic LED RGB de notificare.', 124.00, '11.png', 'item', 'Smartphone'),
	(12, 'LG G8 ThinQ', 'Sistem de operare (OS) Android, dimensiunea afișajului 6,1 inchi, cameră principală de 12 MP.', 513.00, '12.png', 'item', 'Smartphone'),
	(13, 'Lg Velvet 5G', 'LG Velvet este un smartphone Android de bun nivel, puternic devotat imaginilor, capabil să satisfacă chiar și cel mai pretențios utilizator.', 418.00, '13.png', 'item', 'Smartphone'),
	(14, 'ASUS ZenFone Max', 'În România este disponibil din ianuarie 2019 în două configurații diferite de memorie și trei variante de culoare. Dimensiunile sunt în concordanță cu dimensiunea ecranului (6,3 inci) și se ridică la 158,4 x 76,3 x 7,7 mm și o greutate de 160 de grame.', 386.00, '14.png', 'item', 'Smartphone'),
	(15, 'ASUS ZenFone 5', 'A fost anunțat la MWC 2018 în două culori și două variante de memorie, dar este încă actual datorită caracteristicilor sale. Dimensiunile totale și greutatea sunt cuprinse, 153 x 75,7 x 7,9 mm și 155 grame.', 89.00, '15.png', 'item', 'Smartphone'),
	(16, 'ASUS ROG Phone 3 Strix', 'ASUS Android Q cu Gaming UI / 6.59 inch - Amoled 2340x1080 / Qualcomm Snapdragon 865 / 8GB RAM / 256GB Stocare / Baterie 6000mAh.', 999.00, '16.png', 'item', 'Smartphone'),
	(17, 'Sony Xperia L3\n', 'Linia L de la Sony este cea dedicată low end al pieței de smartphone-uri și propune unele dintre caracteristicile dispozitivelor mai scumpe într-un mod mai puțin rafinat. Xperia L3 se remarcă prin ecranul său mare de 5,7 inchi HD+ și camere dual-cam bune.', 200.00, '17.png', 'item', 'Smartphone'),
	(18, 'Sony Xperia 5', 'Chiar dacă nu atinge înălțimile lui Xperia 1, acest Xperia 5 seamănă foarte mult cu acesta și poate fi considerat aproape un vârf de gamă. Are tot ce este necesar pentru a oferi o experiență utilizator de cel mai înalt nivel: procesor super puternic, came', 484.00, '18.png', 'item', 'Smartphone'),
	(19, 'Sony Xperia 1', 'Dacă ești în căutarea vârfului absolut al gamei Sony, trebuie să țintești Xperia 1. Un produs care uimește pornind de la display, un OLED 4K de 6.1 ″, trecând prin SoC Snapdragon 855 foarte puternic și ajungând la cel foarte avansat. sectorul camerei.', 949.00, '19.png', 'item', 'Smartphone'),
	(20, 'Galaxy M31', 'Cu incredibilul ecran de 6,4 inchi al Galaxy M31 veți avea o vedere fără margini a conținutului dvs. preferat. Fie că vizionați un film, jucați un joc sau navigați pe net, tehnologia Super AMOLED FHD+ vă oferă detalii incredibile pentru o experiență.', 184.00, '20.png', 'item', 'Smartphone'),
	(21, 'SHARKOON Alimentatore', 'Sharkoon SHP Bronze este o sursă de alimentare ATX cu certificare „80 PLUS Bronze”. Poate fi instalat în cele mai comune carcase ATX; datorită cablurilor negre și carcasei sale negre, este surprinzător de discret.', 52.00, '21.png', 'item', 'Componente PC'),
	(22, 'Ryzen 5 2600', 'AMD Ryzen 5 2600, AM4, Zen+, 6 Core, 12 fire, 3.4GHz, 3.9GHz Turbo, 19MB Cache, 65W, CPU, Retail + Wraith Stealth. Zen+ pe Ryzen a doua generație.', 209.00, '22.png', 'item', 'Componente PC'),
	(23, 'HYPERX 16gb RAM', 'HyperX FURY DDR4 RGB duce performanța și stilul sistemului dvs. la următorul nivel, cu viteze care ating 3466MHz, iluminarea RGB pe lungimea modulului, oferind efecte de iluminare unice și uimitoare.', 120.00, '23.png', 'item', 'Componente PC'),
	(24, 'INTEL PCore i7-6700K', 'Procesoarele Intel Core de a șasea generație oferă performanțe remarcabile pentru desktop, cu o frecvență îmbunătățită în aplicațiile multimedia și Internet pentru jocuri.', 420.00, '24.png', 'item', 'Componente PC'),
	(25, 'MSI B450 GAMING PLUS MAX', 'B450 GAMING PLUS MAX este echipat cu Core Boost, Turbo M. 2, DDR4 Boost, conector USB 3.2 Gen2. Suportă procesoare AMD Ryzen™ de generația 1, 2 și 3.', 94.99, '25.png', 'item', 'Componente PC'),
	(26, 'Viixm Cuffie Gaming ', 'Căști profesionale care pot fi folosite pe orice dispozitiv cu o intrare audio de 3,5 mm. Căștile pentru jocuri Viixm funcționează pe PS4, PS3 , PS vita, PSP, Xbox One, Nintendo Switch (audio), Nintendo New 3DS LL/3DS (audio), Nintendo 3DS LL/3DS (', 20.00, '26.png', 'item', 'Periferice'),
	(27, 'ASUS Tastiera Gaming USB', 'Tastatură mecanică pentru jocuri ROG Strix Flare RGB cu comutatoare Cherry MX, insignă iluminată personalizabilă și taste media dedicate pentru jocuri. Simțiți satisfacția fiecărei apăsări de taste datorită celebrului Cherry MX BROWN și comutatoarelor God', 169.00, '27.png', 'item', 'Periferice'),
	(28, 'LOGITECH G502 HERO Mouse ', '\nG502 Hero include un senzor optic avansat pentru o precizie precisă a țintirii, iluminare RGB personalizabilă, profiluri de joc personalizate, de la 200 la 16.000 DPI și greutăți repoziționabile.', 57.00, '28.png', 'item', 'Periferice'),
	(29, 'RAZER Kiyo Webcam', 'Razer Kiyo este mai mult decât o cameră pentru desktop. Este produsul unei cercetări ample care vizează crearea studioului de difuzare perfect. Este puternic, dar discret. Dezvoltat și testat de cei mai buni streameri, Razer Kiyo este o cameră foto', 70.00, '29.png', 'item', 'Periferice'),
	(30, 'TONOR TC30 USB', 'Tonor TC30 este practic, rentabil pentru convorbiri live sau înregistrare pe Mac, Windows la calitate înaltă, chiar și iPad cu adaptor USB.', 37.00, '30.png', 'item', 'Periferice'),
	(31, 'ATLANTIS LAND Filtro Adsl', 'Întrucât ADSL și serviciul de telefonie normală (de multe ori) împart același fir pentru a transporta semnalele respective, este necesar, pentru a evita interferențele dăunătoare, să divizăm cele 2 semnale folosind un filtru special.', 18.00, '31.png', 'item', 'Networking'),
	(32, 'DIGITUS Patch Cable, UTP', 'Cablu de corecție Digitus, UTP, CAT5E 15,0 m. Lungime cablu: 15m, Culoare produs: Gri. Tip cablu: CAT5e', 5.00, '32.png', 'item', 'Networking'),
	(33, 'NETGEAR Modem Router D7000', '\n\nModem router Nighthawk VDSL / ADSL. Bucurați-vă de WiFi ultra-rapid de până la 1,9 Gbps și de un procesor puternic dual core pentru performanțe extreme. Amplificatoare de mare putere, antene externe.', 165.00, '33.png', 'item', 'Networking'),
	(34, 'NETGEAR Switch GS108GE ', 'Switch-urile Gigabit de înaltă performanță de la NETGEAR vă permit să lucrați la viteze de 1000 Mbit/s pentru a transfera fișiere mari. Comutator puternic și compact, ideal pentru configurarea unui grup mic de lucru la 10/100 sau 1000.', 40.00, '34.png', 'item', 'Networking'),
	(35, 'TP-LINK ARCHER VR1200', 'Wi-Fi dual band: Până la 867 Mbps pe 5 GHz și 300 Mbps pe 2,4 GHz, ideal pentru jocuri online și streaming HD. Archer VR1200 profită din plin de potențialul liniei dvs. de internet, oferindu-vă viteze maxime de Wi-Fi și bandă largă.', 79.00, '35.png', 'item', 'Networking'),
	(36, 'Nintendo Switch', 'Bucură-te de jocurile tale preferate unde, când și cu oricine vrei. Cu Nintendo Switch, poți lua cu tine experiența unei console de acasă oriunde te duci.', 340.00, '36.png', 'item', 'Console'),
	(37, 'Nintendo Switch Lite', 'Nintendo Switch Lite este o consolă compactă, ușoară, cu comenzi integrate, care extinde familia Nintendo Switch', 190.00, '37.png', 'item', 'Console'),
	(38, 'Play Station 5', 'Nu știm dacă sau când articolul va fi din nou în stoc.', 500.00, '38.png', 'item', 'Console'),
	(39, 'Xbox Series X', 'Faceți cunoștință cu noul Xbox Series X, cea mai rapidă și mai puternică consolă Xbox vreodată. Bucurați-vă de jocuri în 4K și o frecvență de cadre de până la 120 fps', 500.00, '39.png', 'item', 'Console'),
	(40, 'Xbox Series S', 'Vă prezentăm noul Xbox Series S, cea mai mică și mai elegantă consolă Xbox de până acum. Experimentați cea mai recentă generație de viteză și performanță', 300.00, '40.png', 'item', 'Console'),
	(41, 'Macbook Air 2018', '\nEcran de 13,3 inchi (diagonale) cu iluminare din spate LED cu tehnologie IPS; rezoluție nativă de 2560 x 1600 la 227 pixeli pe inch; acceptă milioane de culori', 1030.00, '41.png', 'item', 'Laptop'),
	(42, 'Galaxy Book Go', 'Ecran tactil Super AMOLED de 15,6” care are un volum de culoare de 120% (DCI-P3). Sunet AKG® și Dolby Atmos® integrat pentru o experiență cinematografică cu adevărat captivantă.', 999.00, '42.png', 'item', 'Laptop'),
	(43, 'Chromebook 4+', 'SAMSUNG Chromebook 4+, laptop XE350XBAI Chrome OS, ecran LED Full HD de 15,6 inchi, baterie de 39 Wh, 4 GB RAM', 338.00, '43.png', 'item', 'Laptop'),
	(44, 'Lenovo Chromebook Flex 5', '\nLenovo IdeaPad Flex 5 Chromebook convertibil, ecran tactil Full HD de 13,3 inchi, procesor Intel Celeron 5205U, 64 GB eMMC, 4 GB RAM', 800.00, '44.png', 'item', 'Laptop'),
	(45, 'Asus Rog Strix G15 G512LV', '\nASUS Windows 10 / 15.6 inch - Full HD (1920x1080) / Intel Core i7-10870H / 16GB RAM / Nvidia GeForce RTX 2060 6GB / 1TB SSD G512LV-HN221T.', 2299.00, '45.png', 'item', 'Laptop'),
	(46, 'Logitech G Pro Wireless Gaming Mouse', 'PRO Wireless a fost conceput pentru a fi cel mai bun mouse pentru gaming pentru profesioniștii din sporturi. Timp de doi ani, Logitech G a lucrat cu peste 50 de jucători profesioniști pentru a găsi forma, greutatea și senzația perfectă.', 149.00, '46.png', 'banner', 'Periferice'),
	(47, 'Hyper X Cloud II', '\nCăștile HyperX Cloud II sunt de tip Hi-Fi, cu drivere de 53 mm care garantează performanțe audio superioare, cu sunete bogate, claritate maximă a tonurilor înalte, medii și joase, acestea din urmă îmbunătățite și mai mult de placa de sunet.', 88.51, '47.png', 'banner', 'Periferice'),
	(48, 'ASUS ROG STRIX XG248Q 24', 'ROG Strix XG248Q se referă la viteză, ceea ce îl face monitorul perfect pentru eSports și shooter-uri la persoana întâi. Acest monitor Full HD este cel mai rapid din toate timpurile.', 464.00, '48.png', 'banner', 'Periferice');

-- Dumping structure for table vstack.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_type` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table vstack.users: ~7 rows (approximately)
INSERT INTO `users` (`id`, `name`, `surname`, `username`, `email`, `password`, `created`, `user_type`) VALUES
	(1, 'Peppino', 'Peppo', 'Peppe', 'peppe@gmail.com', '202cb962ac59075b964b07152d234b70', '2022-12-06 11:19:15', 0),
	(7, 'giuliano', 'zera', 'giuliano', 'gg@gmail.com', '202cb962ac59075b964b07152d234b70', '2021-05-04 07:11:59', 0),
	(8, 'alessandro', 'volta', 'avolta', 'a@gmail.com', '202cb962ac59075b964b07152d234b70', '2021-05-04 07:22:41', 0),
	(9, 'asd', 'dasd', 'd', 'ssaass@asdx.com', '7815696ecbf1c96e6894b779456d330e', '2022-12-04 20:51:50', 0),
	(10, 'asd', 'asd', 'asd', 'junioranghel7@gmail.com', '7815696ecbf1c96e6894b779456d330e', '2022-12-28 20:39:24', 1),
	(13, 'costel', 'Anghel', 'juni', 'junioranghel7@gmail.com', 'd8578edf8458ce06fbc5bb76a58c5ca4', '2022-12-28 20:39:26', 0);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
