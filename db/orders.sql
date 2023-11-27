-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 28, 2023 at 04:51 AM
-- Server version: 5.7.39-log
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `z680`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `about` varchar(350) NOT NULL,
  `price` int(11) NOT NULL,
  `img` varchar(200) NOT NULL,
  `status` int(11) DEFAULT '1',
  `date` varchar(10) DEFAULT NULL,
  `serviceId` int(11) DEFAULT NULL,
  `userId` int(11) DEFAULT NULL,
  `professionalId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `name`, `about`, `price`, `img`, `status`, `date`, `serviceId`, `userId`, `professionalId`) VALUES
(7, 'ytergtrerwerwarew', 'rrgdgetesrgtsr4gearwe4tgyrshysetgdrhsfrye4tyghdfthdfr', 4050, 'assets/img/orders/16877043791643429559_27-hdpic-club-p-slomannoi-mashini-61.jpg', 4, '25.06.2023', 4, 1, 4),
(8, 'перевезти диван в другую квартиру', 'зауцлалзцвлухвлйцхвцлйхвлцйвщйзцалущзацзуаушзцалшфщцзцф', 30000, 'assets/img/orders/1687704960master-muir-l-sectional-2_e615be6c-b286-46e1-8aac-e5b9ac210444_2048x.webp', 3, '25.06.2023', 9, 3, NULL),
(9, 'tfyjzshjfhetzgttdethyzdh', 'gwzxshswzgtyuiktytwryuxrjshvrhtjkcgjnhbgnhjkcgdbgeryhj', 2300, 'assets/img/orders/1687705535Desktop_R_Hero_HP_0054_FINAL_1620x.webp', 4, '27.06.2023', 10, 6, 10),
(10, 'pzskvsz[kvzisodsz', 'jwirowarjew9jf9a3wjmpiarjpjrwepairiweoajewpafwejmeffmuwivpahnweiupfhunwvaperjhucwaruocewpoariowkproaujwapiurjeqporhunewpitapiwoerhfnrewiupotafjewmuotgarweuorwehjrofwjopiajptfe4ioprwae', 6546, 'assets/img/orders/1687797126voodoo.png', 3, '27.06.2023', 15, 18, NULL),
(11, 'ryhtrgregwzrgzrwsfgrwgfregsrezgerzgr', 'egewsirzfwrfenzwhiorzfewj7z9ro3wh4rhjznwurh3wp9r3hjw98rz3hjwv9r83jzhw7r8ow3hj98cr4fjh3wz9p4rczw8p9c4r8w9580349875354orjetoupegtyes5oiuprjrt4wrj8qeujr8ewj8kteropyrtjymtrotyrejmntopersnmtrepiuotnwruioptajwnueiportjwurjwp8erjweuorjewpyr8wjrjfew9rewj9rtapwerjmnwe9prtp9ijwetj8wer8joewjr8wpaeortewjptgwntgfwjuirew', 123, 'assets/img/orders/1687797392blogs-1.png', 4, '27.06.2023', 5, 19, 4),
(12, 'ын5уы654354пе4у45уып54ы4', 'ир4ы35ры435м4ы3еп4ы3уем3ыемыекмуемкуыекыусеуыуе6сыу4с4ее4уы', 454, 'assets/img/orders/1687797869vision.png', 4, '27.06.2023', 3, 10, 4),
(13, 'ydr5ydr5y5dr', 'dy5r6d5r645sygdrgxrdrgdrgdxgrd', 123, 'assets/img/orders/1687805026about.png', 3, '27.06.2023', 11, 2, NULL),
(14, 'меня поймали помогите пожалуста', 'хвызаывхазывщахызмдчхссмдчсжяыъхвдщзяъъшц9зъцлбзьбзшъяьпшшзъуаьбзуяыъаублъузщяцацу', 1, 'assets/img/orders/1687819131Скриншот-26-12-2021-203609.jpg', 0, '27.06.2023', 11, 18, NULL),
(15, 'почините машину срочно нужно', 'хзавыхачмэчсмчюсмэчбмчэжмсбэдчбмэядбмэябмэжялвьвяэажявлаяоывяыэловэяшлы', 4050, 'assets/img/orders/1687819207sa2-3.jpg', 0, '27.06.2023', 4, 1, NULL),
(16, 'четочеточеточетчоеточеточеточтеочтеочеточтеоч', 'fpjsdopfjdsoapfjsmpocvpsdauofjewofijueworajwerowepjfoewffpjsdopfjdsoapfjsmpocvpsdauofjewofijueworajwerowepjfoewffpjsdopfjdsoapfjsmpocvpsdauofjewofijueworajwerowepjfoewffpjsdopfjdsoapfjsmpocvpsdauofjewofijueworajwerowepjfoewf', 1243, 'assets/img/orders/1687819583uslugi-2.jpg', 4, '27.06.2023', 16, 21, 16),
(17, 'купи машину мне пожалуйста', 'fpjsdopfjdsoapfjsmpocvpsdauofjewofijueworajwerowepjfoewffpjsdopfjdsoapfjsmpocvpsdauofjewofijueworajwerowepjfoewffpjsdopfjdsoapfjsmpocvpsdauofjewofijueworajwerowepjfoewf', 10000000, 'assets/img/orders/1687819683uslugi-1.jpg', 2, '27.06.2023', 14, 21, 20),
(18, 'ацфщзхълкуцоклцфзшкоуцкцзхацуоашщцо', 'азьфцхщауцьхмфцффслз3кф2кчог2983г4оф2х49283ор4325ф5л9302фхл4х02ф53лш2х0х', 11112, 'assets/img/orders/1687819842delivery.png', 4, '27.06.2023', 3, 19, 11),
(19, 'pfjsmpocvpsdauofjewofijueworajwerowepjfoewf', 'fpjsdopfjdsoapfjsmpocvpsdauofjewofijueworajwerowepjfoewffpjsdopfjdsoapfjsmpocvpsdauofjewofijueworajwerowepjfoewffpjsdopfjdsoapfjsmpocvpsdauofjewofijueworajwerowepjfoewf', 775, 'assets/img/orders/1687819915shops.png', 4, '27.06.2023', 14, 3, 8),
(20, 'ycftfc htfc htfyctfytrcyrytcryc crycrtyctr', 'fpjsdopfjdsoapfjsmpocvpsdauofjewofijueworajwerowepjfoewf       fpjsdopfjdsoapfjsmpocvpsdauofjewofijueworajwerowepjfoewf', 89, 'assets/img/orders/168781997304.jpg', 3, '27.06.2023', 11, 3, NULL),
(21, 'круто обучи меня ммсэчмсчхсчзмсчх', 'fpjsdopfjdsoapfjsmpocvpsdauofjewofijueworajwerowepjfoewffpjsdopfjdsoapfjsmpocvpsdauofjewofijueworajwerowepjfoewf', 750, 'assets/img/orders/168782013603.jpg', 2, '27.06.2023', 8, 3, 9),
(22, 'p[gsdafosp[fdsa[ofipa[fkewpfkweapfjwfw[faw', 'f[awtfguowaeorjwa[rwejafwe[[afjweojwedjwoeaaewjdcwae[cowjwea', 213, 'assets/img/orders/1687852115Скриншот-26-12-2021-203609.jpg', 3, '27.06.2023', 4, 22, NULL),
(23, 'fsaiopfdjpsafds[', 'rf[ewjfaiwfwa[ifpwwaefpvjusdajdvdjsjsoapsew', 4050, 'assets/img/orders/1687852193sa2-3.jpg', 0, '27.06.2023', 4, 22, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
