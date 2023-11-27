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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `login` varchar(50) NOT NULL,
  `email` varchar(256) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `img` varchar(256) NOT NULL DEFAULT 'assets/img/users/default.svg',
  `status` int(11) NOT NULL DEFAULT '0',
  `about` varchar(350) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `date` varchar(10) DEFAULT NULL,
  `serviceId` int(11) DEFAULT NULL,
  `roleId` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `login`, `email`, `pass`, `img`, `status`, `about`, `price`, `date`, `serviceId`, `roleId`) VALUES
(1, 'Руслан', 'user', 'user@mail.ru', '$2y$10$q8F25ffQeFSNh0zLPPpGAOLiflL/K6qrbndelnElIIkruB0H2HwyW', 'assets/img/users/1687629458maxresdefault.jpg', 1, 'idjsjsjdhwnwjwjwjwjwjkqkqkwjduxjsnwjskxjickdkskekowpqpwo', 2000, '27.06.2023', 5, 1),
(2, 'test', 'test', 'test@mail.ru', '$2y$10$mgoZ7WTpm5Kf4VvFftSWtuzL3uMnZILk6O5BYSdcTE074Bjcb57fS', 'assets/img/users/1687804715Frame 3.png', 0, NULL, NULL, '23.06.2023', NULL, 1),
(3, 'admin', 'admin', 'admin@mail.ru', '$2y$10$0P7wlJZG71PPRJNLkPOc3uU/4mCGyAWMk6xQxbpqsZQjuNeiNcUDa', 'assets/img/users/1689231242img_568657 1.png', 2, 'pfgdjsafdofdjsofdsptaerteatwetawtjofdajsfdjasfpdasjfdp[', 234, '27.06.2023', 11, 2),
(4, 'Анастасия', 'prof1', 'prof1@mail.ru', '$2y$10$KSjVW.u95TRGQxEArTIWMOzfAY/VtgtlvRnLkXCpXufkBZcm2z1SO', 'assets/img/users/1687631677kamyar-akrep-GQIeIebbrns-unsplash.jpg', 2, 'занимаюсь ремонтом автомобилей уже более 30 лет', 4050, '24.06.2023', 4, 1),
(5, 'Аркадий', 'prof2', 'prof2@mail.ru', '$2y$10$Epm3qEnCqz5UNksCtW4m5.Puzb/oxGcP8DuoxpzXubCMt2SLvj7iS', 'assets/img/users/1687700557professional-3.jpg', 2, 'пользуюсь популярностью среди молодеживыаыацуацфаафцафццфацафцацф', 10000, '25.06.2023', 1, 1),
(6, 'Линар', 'prof3', 'prof3@mail.ru', '$2y$10$9C4dW0UREl2WRGmMpb.Iied7UFlFDCEHZjqjXttqf5y5giA1HyFEm', 'assets/img/users/1687631545test.jpg', 2, 'desgreg stgersgseg efr serr ef wef wesf wesf grgsrt srh rsh srg ersg sreg eg e gse', 30000, '24.06.2023', 9, 1),
(7, 'Виктория', 'prof4', 'prof4@mail.ru', '$2y$10$9Orf4.LOVxtet6YnjPrg0e0qKxgDGAuLNdDbL1sRI1ccHXrS6Z5Mi', 'assets/img/users/1687632311andrey-k-bVbbKwQcr8A-unsplash.jpg', 2, 'fdhgsdg rsegr sre esf ersfersfrfserfwerfwesfdwefwfeswrswrerwrwerewarerweara', 1200, '24.06.2023', 2, 1),
(8, 'Вадим', 'prof5', 'prof5@mail.ru', '$2y$10$XcxnjGg/Jcb6kOR2a69nZO3YevT2IthJCx/VTFE/A1LXIqx5wzZcO', 'assets/img/users/1687632374natalia-trofimova-8bMztZdw1sA-unsplash.jpg', 2, 'Галиев Вадим ТЕМА \"ПРОЕКТИРОВАНИИ И РАЗРАБОТКА САЙТА GRAND MASTER\"', 500, '24.06.2023', 8, 1),
(9, 'денчик)', 'prof6', 'prof6@mail.ru', '$2y$10$/CXOYL/HGpodiqtZZzISwOW/sDjd7RY71zeNDQdtOeVeAgKqx.0n.', 'assets/img/users/1687632612chris-mac-IzYTKTgDfmU-unsplash.jpg', 2, 'крутой репетитор, научу чему-угодно', 750, '24.06.2023', 8, 1),
(10, 'Мазик', 'prof7', 'prof7@mail.ru', '$2y$10$eD.9jaxXoEeNcQl17AE6TOh9mnmFmtPH85ryYiVWWw3V0UBzRZ0hW', 'assets/img/users/1687698430ernest-flowers-XKn3cxtDQ_w-unsplash.jpg', 2, 'dsfjdfpwekpew kdpkewofpwkdopq kdwpqkdpqwqwpdwqopdkwqpiwq wdjkqwpdwdjpwqdjwpdiwq jkpqk wqdojqwdoq', 1337, '25.06.2023', 13, 1),
(11, 'Виталик', 'prof8', 'prof8@mail.ru', '$2y$10$KA6oi5YsmmIFFN8BLFNimO3yydfdbuKG9E/CQ/w/WYBzS/m3OZe26', 'assets/img/users/1687702900dylann-hendricks-5XiPEL4nhX8-unsplash.jpg', 2, 'qwertyuiop[]asdfghjkl;\r\nzxcvnm,./ rwetwefwesfew esf erfsegrtdh rth rdthdr\r\nhyrdtgdtgerge1231232', 11112, '25.06.2023', 3, 1),
(12, 'companion', 'prof9', 'prof9@mail.ru', '$2y$10$vLTVjYc3R7z1UKiMfim4MeFXUQPHmyTPs31pky60207RaOXTuTFla', 'assets/img/users/1687703354Companion_Logo_new_RED.png', 2, 'работаем в сфере грузоперевозок уже более 10 лет. за это время успели добиться признания со стороны множества клиентов', 20000, '25.06.2023', 9, 1),
(13, 'Arsy', 'prof10', 'prof10@mail.ru', '$2y$10$ot.Qlt5PYubZ3Y7JYOrfUuancaCA1q.Sl7/WpJ1T6tyszL5FDp9Hu', 'assets/img/users/1687703485sina-rezakhani-dnJ6D1UmWkM-unsplash.jpg', 2, 'grzegrzgwefzswfewzfwfzb wef zweg ewf gRestretreaagreesW rgzfewfewzfwe fewzfzwefwzfewzfweszf rywgeyghtrxhdhn', 222, '25.06.2023', 14, 1),
(14, 'Никола', 'prof11', 'prof11@mail.ru', '$2y$10$O4muyhT6.B4cc0N1UvtgbODdnsYAPWoM4WyWkEsc149X5zQM9VsHC', 'assets/img/users/1687703806professional-2.jpg', 2, 'кекневркчгеаорсраросепнкпевсрекарчукчепрвкпичвурчвупкеупекчув5нуыепвк4нрыаярн4учвнрчвп5ргк5н6ч7ву56чнвунрвчпсрсчурнчвччу5енуентрч5нчнррнтаку5нрчврпмак5ча5нчн5нр у46нчуц5яу345е', 4000, '25.06.2023', 16, 1),
(15, 'АЛЕксей', 'prof12', 'prof12@mail.ru', '$2y$10$8qMvk1gweJdTqWvfgyEBuethSCgUx5iFFjv04NVKRy.9kALtFgf2i', 'assets/img/users/1687703871ben-iwara-HKUF3ZpELXs-unsplash.jpg', 2, 'geagraefrtnhtfdswefgrhjugfhrbgthfrtrwaEfgrthetyhdsretdfewr123', 1234, '25.06.2023', 8, 1),
(16, 'Нина', 'prof13', 'prof13@mail.ru', '$2y$10$/WmsSQR2bZ2LPoblGDkgZevoAZ5GI2GSgiIXTxgmWDHzVUT27g6D.', 'assets/img/users/1687703966charles-shaffer-eHuEhg4HlFg-unsplash.jpg', 2, 'hjgytrzwgtert tzwgvwefwzsvfgrez gfezafzwfgrzdegw efrzwrfwesrzyzwgertgezger', 8888, '25.06.2023', 6, 1),
(17, 'Катя', 'prof14', 'prof14@mail.ru', '$2y$10$m.PKB9a90MGstK2SgxzM9.7GRE6S28a9idg9A8PwVMVISYQDGBl4u', 'assets/img/users/1687704038dynamic-wang-oZr30H7HZdU-unsplash.jpg', 2, 'hdzhrfrhezgrhxrfgrgdxhedrsgefsgzsfweszgwezgwsftgezsfwrtzwytetgrez123', 1440, '25.06.2023', 8, 1),
(18, 'user1', 'user1', 'user1@mail.ru', '$2y$10$9sIULH.jVECPlkZE0IwAreF.ALgo3eG1CN.ARR5DWaNzNMT35/NgG', 'assets/img/users/1687797044top-2015-minions-4k-wallpaper.jpg', 0, NULL, NULL, NULL, NULL, 1),
(19, 'user', 'user2', 'user2@mail.ru', '$2y$10$HLnlOiyytkpgPb0YWkC97e.uuvMXy.Fmjtd8PklphZzW1RfcKEBNm', 'assets/img/users/1687797229cool-cute-stuart-the-minion-rumwl9od4kev8hnc.jpg', 0, NULL, NULL, NULL, NULL, 1),
(20, 'Лололошка', 'lololo', 'lol@mail.ru', '$2y$10$WxOGDcOhXQT1apYggnmF5e/nVfjmm5jFbh0PbKqGdeQKm7IVcsIsu', 'assets/img/users/16878062101649918030_1-kartinkof-club-p-rzhachnie-kartinki-chto-postavit-na-avatar-1.jpg', 2, 'Мек мек мек мек мек мек мекккккккккккккккккккккккккккк МЕЕЕЕЕЕЕЕЕЕЕЕЕЕЕЕЕЕЕЕЕЕЕЕЕЕЕЕЕЕЕЕЕЕЕЕЕЕЕЕЕЕЕЕЕЕЕЕЕЕК', 10000000, '27.06.2023', 14, 1),
(21, 'Серега', 'prof15', 'prof15@mail.ru', '$2y$10$ClvSgWDCeakeuPcf0UP4eur4apiTP0MOtYsRv/ncRxk1GBRuwfo2e', 'assets/img/users/1687817818reviewer.png', 2, 'fpjsdopfjdsoapfjsmpocvpsdauofjewofijueworajwerowepjfoewffpjsdopfjdsoapfjsmpocvpsdauofjewofijueworajwerowepjfoewffpjsdopfjdsoapfjserowepjfoewffpjsdopfjdsoapfjsmpocvpsdauofjewofijueworajwerowepjfoewffpjsdopfjdsoapfjsmpocvpsdauofjewofijueworajwerowepjfoewffpjsdopfjdsoapfjsmpocvpsdauofjewofijueworajwerowepjfoewf', 5413, '27.06.2023', 3, 1),
(22, 'лсзмлчщз', 'userue', 'user23@mail.ru', '$2y$10$FlXFmvsyZQfBmbJJmrAgM.jwUa377/S73.VvKJRuv7ykvwuWKrxbu', 'assets/img/users/1687852076chelovek-s-dvumya-pistoletami.jpg', 0, NULL, NULL, NULL, NULL, 1),
(23, 'fdgfdg', 'dfgfdg', 'gdfgfdg@m.r', '$2y$10$VWgIgkoGE2.TgdxjFSfHUO7rQXGFDP6SBB11nF3qbOv/bCoPG9tuq', 'assets/img/users/default.svg', 0, NULL, NULL, NULL, NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
