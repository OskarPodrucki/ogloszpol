-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2024 at 09:52 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ogloszpol`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kategorie`
--

CREATE TABLE `kategorie` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(100) NOT NULL,
  `opis` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategorie`
--

INSERT INTO `kategorie` (`id`, `nazwa`, `opis`) VALUES
(4, 'Rolnictwo', 'rolnictwo i te sprawy\r\n'),
(5, 'Motoryzacja', 'motoryzacja'),
(6, 'Elektronika', 'elektronika'),
(7, 'Nieruchomośći', 'Domy, działki itd.'),
(8, 'Antyki i kolekcje', 'Dla kolekcjonerów i fanatyków'),
(9, 'Praca', 'Praca, praca, praca...'),
(10, 'Książki', 'Różnego rodzaju książki'),
(11, 'Biżuteria', 'Akcesoria i ozdoby personalne'),
(12, 'Sport', 'Sprzęt sportowy i ubiór'),
(13, 'Ogród', 'Do ogrodu'),
(14, 'Żywność', 'Produkty spożywcze i artykuły spożywcze'),
(15, 'Film i muzyka', 'Filmy, muzyka i multimedia'),
(16, 'Zdrowie i uroda', 'Produkty kosmetyczne i artykuły higieniczne'),
(17, 'Gry i zabawki', 'Gry planszowe, konsolowe i zabawki'),
(18, 'Gruz', 'Poprostu gruz'),
(19, 'Artykuły dla zwierząt', 'Produkty dla zwierząt domowych'),
(20, 'Meble', 'Meble itd.');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `logowania`
--

CREATE TABLE `logowania` (
  `id` int(11) NOT NULL,
  `kto` varchar(256) NOT NULL,
  `kiedy` date NOT NULL,
  `uprawnienia` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ogloszenia`
--

CREATE TABLE `ogloszenia` (
  `id` int(11) NOT NULL,
  `użytkownikId` int(11) DEFAULT NULL,
  `zdjecie_url` varchar(255) DEFAULT NULL,
  `tytul` varchar(255) NOT NULL,
  `opis` text NOT NULL,
  `kategoria` int(11) NOT NULL,
  `cena` decimal(10,2) DEFAULT NULL,
  `uzywane` text NOT NULL,
  `lokalizacja` varchar(100) DEFAULT NULL,
  `kontakt_telefoniczny` varchar(20) DEFAULT NULL,
  `data_dodania` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ogloszenia`
--

INSERT INTO `ogloszenia` (`id`, `użytkownikId`, `zdjecie_url`, `tytul`, `opis`, `kategoria`, `cena`, `uzywane`, `lokalizacja`, `kontakt_telefoniczny`, `data_dodania`) VALUES
(4, 1, '4', 'ciągnik john deere', 'bardzo dobry ciągnij john deere', 4, 25000.00, 'nie', 'warszawa', '123 123 123', '2024-03-27 18:51:07'),
(12, 10, '4', 'kombajn', 'fajny kombaj na sprzedarz', 4, 5.00, 'tak', 'lublin', '213742069', '2024-04-03 12:58:02'),
(13, 10, '6', 'komputrak', 'superkomputraka', 6, 150.00, 'nie', 'warszawa', '312 512 321', '2024-04-09 11:45:34'),
(14, 10, '5', 'motor', 'motor', 5, 123.00, 'tak', 'warszawa', '312 123 523', '2024-04-09 11:55:34'),
(15, 10, '12', 'laptopik', 'fajny laptop do roboty i do pogrania w słabsze giereczki', 6, 2500.00, 'nie', 'mistów', '213 511 213', '2024-04-10 06:49:14'),
(16, 10, '12', 'laptopik', 'fajny laptop do roboty i do pogrania w słabsze giereczki', 6, 2500.00, 'tak', 'mistów', '213 511 213', '2024-04-10 06:51:11'),
(17, 10, '12', 'opryskiwacz', 'bardzo fajny osprzęt działa i jest super', 4, 1234.00, 'tak', 'anielinek', '521 351 531', '2024-04-10 06:52:24'),
(18, 10, '6', 'rtx 4090', 'fajna karta graficzna', 6, 3500.00, 'tak', 'warszawa', '123 534 523', '2024-04-10 06:53:14'),
(19, 10, '11', 'gruz (Volkswagen golf)', 'fajny gruzik :D', 5, 3212.00, 'tak', 'warszawa', '431 342 254', '2024-04-10 06:54:19'),
(20, 10, '8', 'ursus c360', 'fajny ciągnik', 4, 2312.00, 'tak', 'katowice', '235 523 123', '2024-04-10 06:55:45'),
(21, 10, '8', 'ursus c360', 'fajny ciągnik', 4, 2312.00, 'tak', 'katowice', '235 523 123', '2024-04-10 06:56:36'),
(22, 10, '8', 'zegarek taki fany', 'zegareczek', 8, 123.00, 'tak', 'katowice', ' 412 123 342', '2024-04-10 13:05:16');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `polubienia`
--

CREATE TABLE `polubienia` (
  `id_polubienia` int(11) NOT NULL,
  `id_ogloszenia` int(11) NOT NULL,
  `id_uzytkownika` int(11) NOT NULL,
  `kiedy_polubiono` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `polubienia`
--

INSERT INTO `polubienia` (`id_polubienia`, `id_ogloszenia`, `id_uzytkownika`, `kiedy_polubiono`) VALUES
(1, 5, 1, '2024-04-09');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uprawnienia`
--

CREATE TABLE `uprawnienia` (
  `id` int(11) NOT NULL,
  `nazwa` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uprawnienia`
--

INSERT INTO `uprawnienia` (`id`, `nazwa`) VALUES
(1, 'admin'),
(2, 'pracownik'),
(3, 'uzytkownik'),
(4, 'odwiedzajacy');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `id` int(11) NOT NULL,
  `uprawnienia` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `haslo` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `imie` varchar(50) DEFAULT NULL,
  `nazwisko` varchar(50) DEFAULT NULL,
  `data_rejestracji` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id`, `uprawnienia`, `login`, `haslo`, `email`, `imie`, `nazwisko`, `data_rejestracji`) VALUES
(7, 3, 'oski', '202cb962ac59075b964b07152d234b70', 'oskar.podrucki.PRO@live.zs1mm.edu.pl', 'oskar', 'podrucki', '2024-03-27 18:55:56'),
(10, 3, 'marekm', '202cb962ac59075b964b07152d234b70', 'marek.m@gmail.com', 'marek', 'maczkowski', '2024-04-03 11:25:24'),
(12, 3, 'ksiazeczarnuchow', 'd483a769fdda2be027d0efa73c93f1ba', 'nigersklep@gmail.com', 'niger', 'sklep', '2024-04-03 12:59:04');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zamówienia`
--

CREATE TABLE `zamówienia` (
  `id_zamowienia` int(11) NOT NULL,
  `id_sprzedawcy` int(11) NOT NULL,
  `id_kupującego` int(11) NOT NULL,
  `kiedy_zamowiono` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `zamówienia`
--

INSERT INTO `zamówienia` (`id_zamowienia`, `id_sprzedawcy`, `id_kupującego`, `kiedy_zamowiono`) VALUES
(0, 10, 1, '2024-04-08');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zdjecia_kategorie`
--

CREATE TABLE `zdjecia_kategorie` (
  `id` int(11) NOT NULL,
  `id_kategorii` int(11) NOT NULL,
  `url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `zdjecia_kategorie`
--

INSERT INTO `zdjecia_kategorie` (`id`, `id_kategorii`, `url`) VALUES
(1, 4, '../../img/categoryimg/category4.png'),
(2, 5, '../../img/categoryimg/category5.png'),
(3, 6, '../../img/categoryimg/category6.png'),
(4, 7, '../../img/categoryimg/category7.png'),
(5, 8, '../../img/categoryimg/category8.png'),
(6, 9, '../../img/categoryimg/category9.png'),
(7, 10, '../../img/categoryimg/category10.png'),
(8, 11, '../../img/categoryimg/category11.png'),
(9, 12, '../../img/categoryimg/category12.png'),
(10, 13, '../../img/categoryimg/category13.png'),
(11, 14, '../../img/categoryimg/category14.png'),
(12, 15, '../../img/categoryimg/category15.png'),
(13, 16, '../../img/categoryimg/category16.png'),
(14, 17, '../../img/categoryimg/category17.png'),
(15, 18, '../../img/categoryimg/category18.png'),
(16, 19, '../../img/categoryimg/category19.png'),
(17, 20, '../../img/categoryimg/category20.png');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zdjecia_ogloszenia`
--

CREATE TABLE `zdjecia_ogloszenia` (
  `id` int(11) NOT NULL,
  `url` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zdjecia_uzytkownicy`
--

CREATE TABLE `zdjecia_uzytkownicy` (
  `id` int(11) NOT NULL,
  `id_kategorii` int(11) NOT NULL,
  `url` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `zdjecia_uzytkownicy`
--

INSERT INTO `zdjecia_uzytkownicy` (`id`, `id_kategorii`, `url`) VALUES
(1, 4, '0'),
(2, 5, '0'),
(3, 6, '0'),
(4, 7, '0'),
(5, 8, '0'),
(6, 9, '0'),
(7, 10, '0'),
(8, 11, '0'),
(9, 12, '0'),
(10, 13, '0'),
(11, 14, '0'),
(12, 15, '0'),
(13, 16, '0'),
(14, 17, '0'),
(15, 18, '0'),
(16, 19, '0'),
(17, 20, '0'),
(1, 4, '0'),
(2, 5, '0'),
(3, 6, '0'),
(4, 7, '0'),
(5, 8, '0'),
(6, 9, '0'),
(7, 10, '0'),
(8, 11, '0'),
(9, 12, '0'),
(10, 13, '0'),
(11, 14, '0'),
(12, 15, '0'),
(13, 16, '0'),
(14, 17, '0'),
(15, 18, '0'),
(16, 19, '0'),
(17, 20, '0'),
(0, 4, '0'),
(0, 5, '0'),
(0, 6, '0'),
(0, 7, '0'),
(0, 8, '0'),
(0, 9, '0'),
(0, 10, '0'),
(0, 11, '0'),
(0, 12, '0'),
(0, 13, '0'),
(0, 14, '0'),
(0, 15, '0'),
(0, 16, '0'),
(0, 17, '0'),
(0, 18, '0'),
(0, 19, '0'),
(0, 20, '0'),
(0, 4, '0'),
(0, 5, '0'),
(0, 6, '0'),
(0, 7, '0'),
(0, 8, '0'),
(0, 9, '0'),
(0, 10, '0'),
(0, 11, '0'),
(0, 12, '0'),
(0, 13, '0'),
(0, 14, '0'),
(0, 15, '0'),
(0, 16, '0'),
(0, 17, '0'),
(0, 18, '0'),
(0, 19, '0'),
(0, 20, '0'),
(0, 4, '0'),
(0, 5, '0'),
(0, 6, '0'),
(0, 7, '0'),
(0, 8, '0'),
(0, 9, '0'),
(0, 10, '0'),
(0, 11, '0'),
(0, 12, '0'),
(0, 13, '0'),
(0, 14, '0'),
(0, 15, '0'),
(0, 16, '0'),
(0, 17, '0'),
(0, 18, '0'),
(0, 19, '0'),
(0, 20, '0'),
(0, 4, '../../img/categoryimg/category4.png'),
(0, 5, '../../img/categoryimg/category5.png'),
(0, 6, '../../img/categoryimg/category6.png'),
(0, 7, '../../img/categoryimg/category7.png'),
(0, 8, '../../img/categoryimg/category8.png'),
(0, 9, '../../img/categoryimg/category9.png'),
(0, 10, '../../img/categoryimg/category10.png'),
(0, 11, '../../img/categoryimg/category11.png'),
(0, 12, '../../img/categoryimg/category12.png'),
(0, 13, '../../img/categoryimg/category13.png'),
(0, 14, '../../img/categoryimg/category14.png'),
(0, 15, '../../img/categoryimg/category15.png'),
(0, 16, '../../img/categoryimg/category16.png'),
(0, 17, '../../img/categoryimg/category17.png'),
(0, 18, '../../img/categoryimg/category18.png'),
(0, 19, '../../img/categoryimg/category19.png'),
(0, 20, '../../img/categoryimg/category20.png');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zgloszenia`
--

CREATE TABLE `zgloszenia` (
  `id_zgloszenia` int(11) NOT NULL,
  `id_zgloszonego` int(11) NOT NULL,
  `id_zglaszajacego` int(11) NOT NULL,
  `kiedy_zgloszono` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `kategorie`
--
ALTER TABLE `kategorie`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `logowania`
--
ALTER TABLE `logowania`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `ogloszenia`
--
ALTER TABLE `ogloszenia`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `uprawnienia`
--
ALTER TABLE `uprawnienia`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeksy dla tabeli `zdjecia_kategorie`
--
ALTER TABLE `zdjecia_kategorie`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `zdjecia_ogloszenia`
--
ALTER TABLE `zdjecia_ogloszenia`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategorie`
--
ALTER TABLE `kategorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `logowania`
--
ALTER TABLE `logowania`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ogloszenia`
--
ALTER TABLE `ogloszenia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `uprawnienia`
--
ALTER TABLE `uprawnienia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `zdjecia_kategorie`
--
ALTER TABLE `zdjecia_kategorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `zdjecia_ogloszenia`
--
ALTER TABLE `zdjecia_ogloszenia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
