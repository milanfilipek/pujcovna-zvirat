-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u6
-- http://www.phpmyadmin.net
--
-- Počítač: free1db.zikum.cz
-- Vytvořeno: Ned 28. bře 2021, 05:32
-- Verze serveru: 10.1.48-MariaDB-1~jessie
-- Verze PHP: 5.6.40-0+deb8u4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databáze: `filipek_www3_cz`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `uzivatele`
--

CREATE TABLE IF NOT EXISTS `uzivatele` (
`IDu` int(11) NOT NULL,
  `jmeno` varchar(25) COLLATE utf8_czech_ci NOT NULL,
  `prijmeni` varchar(25) COLLATE utf8_czech_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_czech_ci NOT NULL,
  `dat_nar` date NOT NULL,
  `login` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `role` varchar(8) COLLATE utf8_czech_ci NOT NULL,
  `heslo` varchar(128) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `uzivatele`
--

INSERT INTO `uzivatele` (`IDu`, `jmeno`, `prijmeni`, `email`, `dat_nar`, `login`, `role`, `heslo`) VALUES
(1, 'Filip', 'Mulánek', 'm.filipek.st@spseiostrava.cz', '2001-08-01', 'adminMF', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997'),
(2, 'Petr', 'Pomalý Slach', 'petrpom@seznam.cz', '1991-04-05', 'petrpom', 'uzivatel', '21298df8a3277357ee55b01df9530b535cf08ec1'),
(3, 'Filip', 'Kolář', 'f.kolar.st@spseiostrava.cz', '2002-08-02', 'adminFK', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997'),
(4, 'Škapu', 'Musíme', 'l.skapa@spseiostrava.cz', '1745-05-05', 'Uctívat', 'uzivatel', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220'),
(5, 'Nesmíme Uctívat', 'Škapu!!!!!', 'nene@skapazly.cz', '1930-05-05', 'reeee', 'uzivatel', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(6, 'milan filipek', 'obri pele', 'gigantus@seznam.cz', '2020-08-17', 'gigant', 'admin', 'e51f0b2de9c798db2db066080060124a81a3accc');

-- --------------------------------------------------------

--
-- Struktura tabulky `vypujcky`
--

CREATE TABLE IF NOT EXISTS `vypujcky` (
`IDv` int(11) NOT NULL,
  `IDz` int(11) NOT NULL,
  `IDu` int(11) NOT NULL,
  `datum_vyp` date NOT NULL,
  `datum_exp` date NOT NULL,
  `datum_vraceni` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `vypujcky`
--

INSERT INTO `vypujcky` (`IDv`, `IDz`, `IDu`, `datum_vyp`, `datum_exp`, `datum_vraceni`) VALUES
(2, 3, 1, '2020-06-14', '2020-07-14', '2020-06-15'),
(3, 3, 2, '2020-06-15', '2020-07-15', '2020-06-15'),
(4, 4, 2, '2020-06-15', '2020-07-15', '2020-06-15'),
(5, 3, 4, '2020-06-15', '2020-07-15', '2020-06-15'),
(6, 8, 4, '2020-06-15', '2020-07-15', '2020-06-15'),
(7, 4, 4, '2020-06-15', '2020-07-15', '2020-06-15'),
(8, 7, 1, '2020-06-15', '2020-07-15', '2020-06-15'),
(9, 1, 6, '2020-06-15', '2020-07-15', NULL);

-- --------------------------------------------------------

--
-- Struktura tabulky `zvirata`
--

CREATE TABLE IF NOT EXISTS `zvirata` (
`IDz` int(11) NOT NULL,
  `druh` varchar(25) COLLATE utf8_czech_ci NOT NULL,
  `jmeno` varchar(25) COLLATE utf8_czech_ci NOT NULL,
  `dat_nar` date NOT NULL,
  `popis` varchar(512) COLLATE utf8_czech_ci DEFAULT NULL,
  `obrazek` varchar(255) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `zvirata`
--

INSERT INTO `zvirata` (`IDz`, `druh`, `jmeno`, `dat_nar`, `popis`, `obrazek`) VALUES
(1, 'Slon', 'Rudolf', '2019-09-08', 'Nedávno narozený Slon od samice, která pochazí ze Srí Lanky.', 'imgs/zvirata/rudolf.jpg'),
(2, 'Pes - Dalmatin', 'Štístko', '2020-01-28', 'Stěně psího plemena původem z Chorvatska.', 'imgs/zvirata/stistko.jpg'),
(3, 'Pes - Husky', 'Charlie', '2018-11-21', 'Jeden z nejoblíbenějsích psů v USA a Kanadě.', 'imgs/zvirata/charlie.jpg'),
(4, 'Kočka - Bengálská', 'Ťapka', '2019-09-11', 'Plemeno kočky, které připomíná svým vzhledem divokou šelmu.', 'imgs/zvirata/tapka.jpg'),
(5, 'Had - užovka červená', 'Albín', '2019-09-21', 'Nejrožšířenější a nejoblíbenější domácí had.', 'imgs/zvirata/albin.jpg'),
(6, 'Krokodýl - Nilský', 'Renekton', '2017-08-01', 'Nejhojnější a neznámější druh krokodýla.', 'imgs/zvirata/renekton.jpg'),
(7, 'Kočka - Britská', 'Billy', '2018-06-20', 'Kočka s klidnou a vyrovnanou povahou.', 'imgs/zvirata/billy.jpg'),
(8, 'Lev', 'Miloš', '2017-10-21', 'Jedna z největších kočkovitých šelem.', 'imgs/zvirata/milos.jpg');

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `uzivatele`
--
ALTER TABLE `uzivatele`
 ADD PRIMARY KEY (`IDu`), ADD UNIQUE KEY `login` (`login`);

--
-- Klíče pro tabulku `vypujcky`
--
ALTER TABLE `vypujcky`
 ADD PRIMARY KEY (`IDv`);

--
-- Klíče pro tabulku `zvirata`
--
ALTER TABLE `zvirata`
 ADD PRIMARY KEY (`IDz`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `uzivatele`
--
ALTER TABLE `uzivatele`
MODIFY `IDu` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pro tabulku `vypujcky`
--
ALTER TABLE `vypujcky`
MODIFY `IDv` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pro tabulku `zvirata`
--
ALTER TABLE `zvirata`
MODIFY `IDz` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
