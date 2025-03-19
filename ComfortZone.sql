-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 14 2025 г., 02:49
-- Версия сервера: 8.0.30
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `SladkiyMir`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admins`
--

CREATE TABLE `admins` (
  `ID` int NOT NULL,
  `Names` varchar(20) NOT NULL,
  `Surnames` varchar(20) NOT NULL,
  `Emails` varchar(20) NOT NULL,
  `Phones` varchar(10) NOT NULL,
  `Logins` varchar(20) NOT NULL,
  `Pass` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `admins`
--

INSERT INTO `admins` (`ID`, `Names`, `Surnames`, `Emails`, `Phones`, `Logins`, `Pass`) VALUES
(1, 'Lira', 'Kortes', 'sd@sd', '8800', 'infern', 'sdsdsdsd'),
(3, 'Liza', 'Levicheva', 'llevi.97@mail.ru', '8800', 'molochko', 'molochko');

-- --------------------------------------------------------

--
-- Структура таблицы `recordroom`
--

CREATE TABLE `recordroom` (
  `id` int NOT NULL,
  `choiceCity` set('Москва','Казань','Санкт-Петербург') NOT NULL,
  `choiceDate1` date NOT NULL,
  `choiceDate2` date NOT NULL,
  `typeRoom` int NOT NULL,
  `id_user` int NOT NULL,
  `number` int NOT NULL,
  `total` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `recordroom`
--

INSERT INTO `recordroom` (`id`, `choiceCity`, `choiceDate1`, `choiceDate2`, `typeRoom`, `id_user`, `number`, `total`) VALUES
(1, 'Москва', '2025-03-14', '2025-03-27', 4, 44, 100, 11700),
(2, 'Москва', '2025-03-27', '2025-03-28', 1, 44, 204, 2000),
(3, 'Москва', '2025-03-27', '2025-03-28', 1, 44, 203, 2000),
(4, 'Казань', '2025-03-14', '2025-03-28', 4, 45, 104, 12600);

-- --------------------------------------------------------

--
-- Структура таблицы `rooms`
--

CREATE TABLE `rooms` (
  `id` int NOT NULL,
  `type` int NOT NULL,
  `number` int NOT NULL,
  `id_record` int NOT NULL,
  `id_user` int NOT NULL,
  `record` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `rooms`
--

INSERT INTO `rooms` (`id`, `type`, `number`, `id_record`, `id_user`, `record`) VALUES
(1, 4, 100, 1, 44, 'yes'),
(2, 1, 204, 2, 44, 'yes'),
(3, 1, 203, 3, 44, 'yes'),
(4, 4, 104, 4, 45, 'yes');

-- --------------------------------------------------------

--
-- Структура таблицы `typeRoom`
--

CREATE TABLE `typeRoom` (
  `id` int NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `roomCost` varchar(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `typeRoom`
--

INSERT INTO `typeRoom` (`id`, `type`, `roomCost`) VALUES
(1, 'Стандарт', '2000'),
(2, 'Люкс', '4000'),
(3, 'Премиум', '5500'),
(4, 'Эконом', '900');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `ID` int NOT NULL,
  `Names` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `Logins` varchar(255) NOT NULL,
  `Surname` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Phone` varchar(20) NOT NULL,
  `Pass` varchar(20) NOT NULL,
  `id_record` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`ID`, `Names`, `Logins`, `Surname`, `Email`, `Phone`, `Pass`, `id_record`) VALUES
(29, 'sd', 'sd', 'sd', 'sd@r', '+7 (901) 905-38', 'sdsdsdsd', 8),
(44, 'Карина', 'licoricez', 'Самойлова', 'kirabultuh@gmail.com', '89019053839', '777901qas', 3),
(45, 'Максим', 'Forbi', 'Лавринов', 'tasherhd@gmail.com', '89019053839', '12345678', 4);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `recordroom`
--
ALTER TABLE `recordroom`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `number` (`number`) USING BTREE,
  ADD KEY `typeRoom` (`typeRoom`),
  ADD KEY `id_user` (`id_user`);

--
-- Индексы таблицы `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `number` (`number`),
  ADD KEY `rooms_ibfk_1` (`type`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_record` (`id_record`);

--
-- Индексы таблицы `typeRoom`
--
ALTER TABLE `typeRoom`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `id_record` (`id_record`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `admins`
--
ALTER TABLE `admins`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `recordroom`
--
ALTER TABLE `recordroom`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `typeRoom`
--
ALTER TABLE `typeRoom`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `recordroom`
--
ALTER TABLE `recordroom`
  ADD CONSTRAINT `recordroom_ibfk_1` FOREIGN KEY (`typeRoom`) REFERENCES `typeRoom` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `recordroom_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_ibfk_1` FOREIGN KEY (`type`) REFERENCES `recordroom` (`typeRoom`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `rooms_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `recordroom` (`id_user`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `rooms_ibfk_3` FOREIGN KEY (`id_record`) REFERENCES `recordroom` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `rooms_ibfk_4` FOREIGN KEY (`number`) REFERENCES `recordroom` (`number`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_record`) REFERENCES `recordroom` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
