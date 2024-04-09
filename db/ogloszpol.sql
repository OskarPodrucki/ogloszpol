-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 09 Kwi 2024, 14:46
-- Wersja serwera: 10.4.27-MariaDB
-- Wersja PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `ogloszpol`
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
-- Zrzut danych tabeli `kategorie`
--

INSERT INTO `kategorie` (`id`, `nazwa`, `opis`) VALUES
(4, 'rolnictwo', 'rolnictwo i te sprawy\r\n'),
(5, 'motoryzacja', 'motoryzacja'),
(6, 'elektronika', 'elektronika');

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
  `lokalizacja` varchar(100) DEFAULT NULL,
  `kontakt_telefoniczny` varchar(20) DEFAULT NULL,
  `data_dodania` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `ogloszenia`
--

INSERT INTO `ogloszenia` (`id`, `użytkownikId`, `zdjecie_url`, `tytul`, `opis`, `kategoria`, `cena`, `lokalizacja`, `kontakt_telefoniczny`, `data_dodania`) VALUES
(4, 1, '1', 'ciągnik john deere', 'bardzo dobry ciągnij john deere', 1, '25000.00', 'warszawa', '123 123 123', '2024-03-27 18:51:07'),
(5, 10, '2', 'test', 'test', 4, '12300.00', 'test', '312 213 321', '0000-00-00 00:00:00'),
(6, 10, '2', 'test2', 'test2', 4, '12312.00', 'test2', '123 532 432', '2024-04-03 11:33:42'),
(7, 10, '2', 'test2', 'test2', 4, '12312.00', 'test2', '123 532 432', '2024-04-03 11:34:08'),
(8, 10, '2', 'test2', 'test2', 4, '12312.00', 'test2', '123 532 432', '2024-04-03 11:34:12'),
(9, 10, '2', 'test2', 'test2', 4, '12312.00', 'test2', '123 532 432', '2024-04-03 11:34:15'),
(10, 10, '2', 'test2', 'test2', 4, '12312.00', 'test2', '123 532 432', '2024-04-03 11:34:17'),
(11, 10, '2', 'test2', 'test2', 4, '12312.00', 'test2', '123 532 432', '2024-04-03 11:34:22'),
(12, 10, '1', 'niewolnicy', 'tani niewolnicy na sprzedaz', 4, '5.00', 'niger', '213742069', '2024-04-03 12:58:02'),
(13, 10, '3', 'komputrak', 'superkomputraka', 6, '150.00', 'warszawa', '312 512 321', '2024-04-09 11:45:34'),
(14, 10, '2', 'motor', 'motor', 5, '123.00', 'warszawa', '312 123 523', '2024-04-09 11:55:34');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `polubienia`
--

CREATE TABLE `polubienia` (
  `id_polubienia` int(11) NOT NULL,
  `id_uzytkownika` int(11) NOT NULL,
  `kiedy_polubiono` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uprawnienia`
--

CREATE TABLE `uprawnienia` (
  `id` int(11) NOT NULL,
  `nazwa` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `uprawnienia`
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
-- Zrzut danych tabeli `uzytkownicy`
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
  `kiedy_zamowiono` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zdjecia_kategorie`
--

CREATE TABLE `zdjecia_kategorie` (
  `id` int(11) NOT NULL,
  `url` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `url` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `kategorie`
--
ALTER TABLE `kategorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT dla tabeli `logowania`
--
ALTER TABLE `logowania`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `ogloszenia`
--
ALTER TABLE `ogloszenia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT dla tabeli `uprawnienia`
--
ALTER TABLE `uprawnienia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT dla tabeli `zdjecia_kategorie`
--
ALTER TABLE `zdjecia_kategorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `zdjecia_ogloszenia`
--
ALTER TABLE `zdjecia_ogloszenia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
