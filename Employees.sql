-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 06 2023 г., 09:32
-- Версия сервера: 8.0.30
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `Employees`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Jobs`
--

CREATE TABLE `Jobs` (
  `Id` int NOT NULL,
  `JobName` varchar(255) NOT NULL,
  `Salary` int NOT NULL DEFAULT '15000'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `Jobs`
--

INSERT INTO `Jobs` (`Id`, `JobName`, `Salary`) VALUES
(1, 'Программист', 1500);

-- --------------------------------------------------------

--
-- Структура таблицы `log`
--

CREATE TABLE `log` (
  `id` int UNSIGNED NOT NULL,
  `msg` varchar(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `row_id` int NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `Job` varchar(50) NOT NULL,
  `Salary` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `log`
--

INSERT INTO `log` (`id`, `msg`, `time`, `row_id`, `FirstName`, `LastName`, `Job`, `Salary`) VALUES
(57, 'update', '2023-09-05 14:59:48', 9, 'Денис', 'Никитин', 'Старший Web Программист', 70000),
(56, 'update', '2024-09-05 14:50:06', 9, 'Денис', 'Никитин', 'SEO', 300000),
(55, 'update', '2023-08-05 14:49:22', 9, 'Денис', 'Никитин', 'Старший Web Программист', 70000),
(54, 'update', '2023-07-05 14:47:43', 9, 'Денис', 'Баздарев', 'Старший Web Программист', 70000),
(52, 'update', '2023-05-05 14:41:04', 9, 'Денис', 'Баздарев', 'Средний Web Программист', 35000),
(53, 'update', '2023-06-05 14:46:18', 9, 'Денис', 'Баздарев', 'Старший Web Программист', 70000),
(49, 'insert', '2023-03-05 14:37:11', 9, 'Денис', 'Баздарев', 'Младший Web Программист', 15000),
(50, 'insert', '2023-04-05 14:37:40', 9, 'Денис', 'Баздарев', 'Младший Web Программист', 15000),
(58, 'update', '2023-10-05 15:01:03', 9, 'Денис', 'Никитин', 'Старший Web Программист', 70000),
(59, 'update', '2023-11-05 15:03:21', 9, 'Денис', 'Никитин', 'Старший Web Программист', 70000),
(60, 'update', '2023-12-05 15:04:10', 9, 'Денис', 'Никитин', 'Старший Web Программист', 70000),
(64, 'update', '2024-03-06 06:08:05', 9, 'Денис', 'Никитин', 'SEO', 300000);

-- --------------------------------------------------------

--
-- Структура таблицы `NDFL`
--

CREATE TABLE `NDFL` (
  `id` int NOT NULL,
  `person_id` int NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `Job` varchar(50) NOT NULL,
  `Salary` int NOT NULL DEFAULT '15000'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Структура таблицы `Persons`
--

CREATE TABLE `Persons` (
  `Id` int NOT NULL,
  `FirstName` varchar(20) NOT NULL,
  `LastName` varchar(20) NOT NULL,
  `Job` varchar(50) NOT NULL,
  `Salary` int NOT NULL DEFAULT '15000'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `Persons`
--

INSERT INTO `Persons` (`Id`, `FirstName`, `LastName`, `Job`, `Salary`) VALUES
(9, 'Денис', 'Никитин', 'SEO', 300000);

--
-- Триггеры `Persons`
--
DELIMITER $$
CREATE TRIGGER `after_delete_person` AFTER DELETE ON `Persons` FOR EACH ROW BEGIN
DELETE FROM log WHERE row_id = DELETED.Id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_update_persons` AFTER UPDATE ON `Persons` FOR EACH ROW BEGIN
   INSERT INTO log Set msg = 'update', row_id = NEW.id, FirstName = NEW.FirstName, LastName = NEW.LastName, Job = NEW.Job, Salary = NEW.Salary;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insert_persons` AFTER INSERT ON `Persons` FOR EACH ROW BEGIN
   INSERT INTO log Set msg = 'insert', row_id = NEW.id, FirstName = NEW.FirstName, LastName = NEW.LastName, Job = NEW.Job, Salary = NEW.Salary;
END
$$
DELIMITER ;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Jobs`
--
ALTER TABLE `Jobs`
  ADD PRIMARY KEY (`Id`);

--
-- Индексы таблицы `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `NDFL`
--
ALTER TABLE `NDFL`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `Persons`
--
ALTER TABLE `Persons`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Jobs`
--
ALTER TABLE `Jobs`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `log`
--
ALTER TABLE `log`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT для таблицы `NDFL`
--
ALTER TABLE `NDFL`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `Persons`
--
ALTER TABLE `Persons`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
