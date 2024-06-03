-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2024 at 07:12 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` varchar(50) NOT NULL,
  `category_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
('00.1094', 'Plastic Bottles'),
('03.4616', 'Rice'),
('04.5018', 'Home Accessories'),
('07.2095', 'Drinks'),
('11.5468', 'Sweets'),
('12.3218', 'Ice Cream'),
('17.3830', 'Dairy'),
('21.5758', 'Condiments'),
('24.1462', 'Soup'),
('27.8003', 'Vegetables'),
('29.8485', 'Chips'),
('30.9570', 'Baking Goods'),
('35.9705', 'Meat'),
('55.1331', 'Alcohol'),
('63.1472', 'Baked Goods'),
('71.9800', 'Spread'),
('84.6123', 'Frozen Goods'),
('86.3186', 'Seafood'),
('89.7030', 'Pasta'),
('99.6851', 'Fruit');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` varchar(50) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `supplier_id` varchar(50) NOT NULL,
  `category_id` varchar(50) NOT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `supplier_id`, `category_id`, `price`) VALUES
('03B4N2SS', 'Margarine', '87-632-8936', '17.3830', 9.50),
('13H5F5NF', 'Potatoes - Mini Red', '79-180-4683', '27.8003', 12.45),
('16V9B7VK', 'Dstk Super Cone', '91-436-4505', '12.3218', 8.00),
('17C1E6VP', 'Sesame Seed', '61-832-5491', '21.5758', 5.95),
('19W3Q7FC', 'Merlot Vina Carmen', '27-582-4878', '55.1331', 35.88),
('23D5R1AC', 'Marjoram - Dried, Rubbed', '53-117-6834', '55.1331', 12.00),
('28I2X2CY', 'Onion Brick Cheese', '52-020-7628', '17.3830', 19.97),
('28L8W6ZY', 'Cocoa Powder - Natural', '14-013-3285', '21.5758', 20.21),
('29J7H6UY', 'Godiva White Chocolate', '76-414-0102', '11.5468', 21.78),
('34D2F7WR', 'Cadbury Dark Chocolate', '76-414-0102', '11.5468', 12.70),
('35Z0Z0IR', 'Squeeze Bottle', '44-642-8022', '00.1094', 9.80),
('36Y7I9DY', 'Lamancha Do Crianza', '17-824-9373', '55.1331', 28.97),
('37J9E0RK', 'Acient Coast Caberne', '66-665-4039', '55.1331', 33.33),
('37L5V0FU', 'Base Broth Beef', '94-696-0939', '24.1462', 22.34),
('40I3Y5HI', 'Sugar - Invert', '25-189-6325', '21.5758', 10.11),
('40O0Y5QU', 'Doritos', '08-358-5734', '29.8485', 7.88),
('41I2J3AY', 'Red Cod Fillets - 225g', '83-551-8703', '86.3186', 30.00),
('44Q6M5XJ', 'Lemonade - Mandarin, 591 Ml', '11-299-0660', '07.2095', 14.54),
('45K7J5ZG', 'Hot Dog Buns', '91-951-3943', '63.1472', 25.25),
('45T1K2DT', 'Mortadella', '54-272-1237', '84.6123', 26.45),
('47V8Q8GL', 'Tart Shells - 2', '60-530-9766', '63.1472', 27.56),
('47W2V2IV', 'Mushroom - Porcini Frozen', '40-138-5025', '27.8003', 21.33),
('51J0N6BZ', 'Lemon Extract', '76-450-3511', '07.2095', 22.12),
('52I2G1KR', 'Bread - White, Sliced', '42-530-0253', '63.1472', 16.46),
('53A7D5ZU', 'Praline Paste', '47-270-4850', '21.5758', 22.98),
('53M5S5VK', 'Cookie Dough - Peanut Butter', '76-222-7492', '63.1472', 24.67),
('55L0T8VI', 'Basmati', '51-692-1164', '03.4616', 30.98),
('55L6Z0EK', 'Beer - Blue Light', '55-838-5704', '55.1331', 25.45),
('57K9Z3IB', 'White Wine - Chardonnay', '92-183-2632', '55.1331', 33.44),
('58L0X3ZC', 'Marjoram - Fresh', '98-827-9951', '27.8003', 18.79),
('58P4V3IM', 'Table Cloth 53x53 White', '40-976-1024', '04.5018', 18.99),
('64C5V8MA', 'Sherry - Dry', '10-050-8071', '55.1331', 26.73),
('64E7R0AZ', 'Quiche Assorted', '19-986-0403', '63.1472', 21.21),
('68U7H7UV', 'Seafood Assortment', '79-951-9276', '86.3186', 35.35),
('69G7R6VM', 'Bar Mix - Lime', '41-537-4547', '55.1331', 28.94),
('69W8B3YO', 'Beans - French', '62-582-0180', '27.8003', 14.65),
('71J1C2VJ', 'Pork - Ham Hocks - Smoked', '71-958-0304', '35.9705', 17.65),
('72D0I7RE', 'Arctic Char - Fresh, Whole', '89-508-7020', '86.3186', 28.32),
('72G4O2FQ', 'Mangostein', '77-470-4801', '99.6851', 15.15),
('72O5G9JE', 'Oyster - In Shell', '23-439-6156', '89.7030', 29.98),
('73S3D8PW', 'Red Wine - Concha Y Toro', '06-398-2735', '55.1331', 33.47),
('74E4I6PY', 'Sherry Dry Sack, William', '08-826-1902', '55.1331', 37.88),
('80I8Q5JG', 'Fusili Tri - Coloured', '97-826-2614', '89.7030', 19.22),
('83A6B0YJ', 'Bagelers - Cinn / Brown Sugar', '08-025-0774', '63.1472', 22.76),
('84K8C2RE', 'Red Wine - Colio Cabernet', '59-798-4590', '55.1331', 29.87),
('85K4F2ZT', 'Gatorade - Cool Blue Raspberry', '67-054-3194', '07.2095', 13.45),
('90C6K2DV', 'Pomegranates', '08-218-3876', '99.6851', 19.76),
('90P2V9HH', 'Tart Shells - Sweet, 4', '02-101-5474', '63.1472', 25.35),
('90W0G4ZF', 'Graham Cracker Mix', '24-801-8162', '63.1472', 14.66),
('94L2W3TK', 'Beef - Ground', '86-187-8759', '35.9705', 26.75),
('99B8M6KG', 'Cornstarch', '09-103-0739', '30.9570', 10.12);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` varchar(50) NOT NULL,
  `supplier_name` varchar(255) DEFAULT NULL,
  `contact_person` varchar(255) DEFAULT NULL,
  `contact_number` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `supplier_name`, `contact_person`, `contact_number`, `password`) VALUES
('02-101-5474', 'Orson Justis', 'Dominga Schonfeld', '09144372573', 'Orson Justis'),
('06-398-2735', 'Natty Alder', 'Filmore O\'Donnell', '09691378974', 'Natty Alder'),
('08-025-0774', 'Antonie Kunrad', 'Johna Klainer', '09401938379', 'Antonie Kunrad'),
('08-218-3876', 'Kane Woollhead', 'Madelina McGuiness', '09964134344', 'Kane Woollhead'),
('08-358-5734', 'Randa Howison', 'Carrol Glassborow', '09326679813', 'Randa Howison'),
('08-826-1902', 'Jorrie Philipp', 'Turner Boards', '09262734355', 'Jorrie Philipp'),
('09-103-0739', 'Thurstan Ambroise', 'Janice Oles', '09983414072', 'Thurstan Ambroise'),
('10-050-8071', 'Halley Raithmill', 'Marty Kondratovich', '09737826038', 'Halley Raithmill'),
('11-299-0660', 'Terencio Lanchberry', 'Brett Glendining', '09682433465', 'Terencio Lanchberry'),
('14-013-3285', 'Enid Spaunton', 'Asher Chittie', '09143083473', 'Enid Spaunton'),
('17-824-9373', 'Aggi Aggas', 'Gretna Burcombe', '09584071371', 'Aggi Aggas'),
('19-986-0403', 'Halley Brimicombe', 'Mel Fitchell', '09489748050', 'Halley Brimicombe'),
('21-107-1130', 'Raine Francesca Maximo', 'Deazelle Capistrano', '09876543212', 'Raine Francesca Maximo'),
('23-439-6156', 'Morry Bartlet', 'Cathy Fermin', '09117728732', 'Morry Bartlet'),
('24-801-8162', 'Tomi Carling', 'Emylee Sandercock', '09107762020', 'Tomi Carling'),
('25-189-6325', 'Heath Dobbins', 'Ami Trollope', '09482877381', 'Heath Dobbins'),
('27-582-4878', 'Janie Hovey', 'Melodie Tinner', '09423043789', 'Janie Hovey'),
('40-138-5025', 'Lidia Tinto', 'Oneida Hadgkiss', '09512510687', 'Lidia Tinto'),
('40-976-1024', 'Dasha Chasson', 'Benni Larmour', '09304059289', 'Dasha Chasson'),
('41-537-4547', 'Honey Camlin', 'Peder Tremlett', '09972307396', 'Honey Camlin'),
('42-530-0253', 'Jayson Ech', 'Rochester Clementson', '09954006768', 'Jayson Ech'),
('44-642-8022', 'Malva Ansell', 'Salome Kitchiner', '09788401809', 'Malva Ansell'),
('47-270-4850', 'Edmon Groucock', 'Tonie Lewis', '09451317106', 'Edmon Groucock'),
('51-692-1164', 'Osborn Faulkner', 'Tull Gianilli', '09844775660', 'Osborn Faulkner'),
('52-020-7628', 'Darrick MacAloren', 'Casey Hairsnape', '09295143522', 'Darrick MacAloren'),
('53-117-6834', 'Cyndy Metheringham', 'Kissee Andrzejewski', '09327428149', 'Cyndy Metheringham'),
('54-272-1237', 'Javier Zannutti', 'Evelina Abarough', '09452721421', 'Javier Zannutti'),
('55-838-5704', 'Gabriello Coale', 'Erhart Petersen', '09996311229', 'Gabriello Coale'),
('59-798-4590', 'Vidovic Gounot', 'Wallie Grimbaldeston', '09684259714', 'Vidovic Gounot'),
('60-530-9766', 'Steffi Cohen', 'Yardley Howbrook', '09547463849', 'Steffi Cohen'),
('61-832-5491', 'Nigel Hullah', 'Ned Lighten', '09569330636', 'Nigel Hullah'),
('62-582-0180', 'Marylynne Eshmade', 'Shaine Mostyn', '09140667048', 'Marylynne Eshmade'),
('66-665-4039', 'Chadd Boldison', 'Clareta Bruckstein', '09872448712', 'Chadd Boldison'),
('67-054-3194', 'Stephi Shillaber', 'Cesare Tinker', '09737248768', 'Stephi Shillaber'),
('71-958-0304', 'Arden Gornar', 'Julee Cabel', '09921472244', 'Arden Gornar'),
('76-222-7492', 'Rhetta Vaneschi', 'Jeralee Ivakin', '09533570879', 'Rhetta Vaneschi'),
('76-414-0102', 'Maje Whenham', 'Concordia Pettigree', '09851932348', 'Maje Whenham'),
('76-450-3511', 'Mariana Paolillo', 'Alene Cowie', '09604705077', 'Mariana Paolillo'),
('77-470-4801', 'Emilee Waldrum', 'Guinna Lorentz', '09650602586', 'Emilee Waldrum'),
('79-180-4683', 'Annecorinne MacSkeagan', 'Bob Nuscha', '09200289489', 'Annecorinne MacSkeagan'),
('79-951-9276', 'Dela Djekovic', 'Dorella Winters', '09445339259', 'Dela Djekovic'),
('83-551-8703', 'Tawsha Pickthorne', 'Fifi Castane', '09555342710', 'Tawsha Pickthorne'),
('86-187-8759', 'Kenon Appleyard', 'Flor Caron', '09125010882', 'Kenon Appleyard'),
('87-632-8936', 'Tobiah Lathleiff', 'Boycie Rayson', '09111431546', 'Tobiah Lathleiff'),
('89-508-7020', 'Netta Episcopio', 'Bryana Jakubowski', '09569044012', 'Netta Episcopio'),
('91-436-4505', 'Northrop Swafield', 'Kellie Auchinleck', '09221255804', 'Northrop Swafield'),
('91-951-3943', 'Cherianne Topes', 'Hester Cammidge', '09161678888', 'Cherianne Topes'),
('92-183-2632', 'Niki Jarnell', 'Humfrey Foxall', '09337098049', 'Niki Jarnell'),
('94-696-0939', 'Samara Glaum', 'Brandice Pinkney', '09348716714', 'Samara Glaum'),
('97-826-2614', 'Humfrey Garwood', 'Ailis Geldeard', '09148763206', 'Humfrey Garwood'),
('98-827-9951', 'Sky Avramchik', 'Blisse Wrack', '09328927246', 'Sky Avramchik');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`,`supplier_id`,`category_id`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`supplier_id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
