-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Фев 11 2017 г., 10:56
-- Версия сервера: 10.1.21-MariaDB
-- Версия PHP: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `yiiexam`
--

-- --------------------------------------------------------

--
-- Структура таблицы `backet`
--

CREATE TABLE `backet` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `count` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `backet`
--

INSERT INTO `backet` (`id`, `user_id`, `item_id`, `count`) VALUES
(1, 4, 3, 4),
(2, 4, 2, 3),
(3, 4, 1, 1),
(7, 1, 3, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` float DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `imagesrc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Дамп данных таблицы `item`
--

INSERT INTO `item` (`id`, `name`, `price`, `description`, `imagesrc`) VALUES
(1, 'Браслет \"Подвійна кобра\"', 75, 'Плетіння \"Подвійна кобра\" чорний із зеленим', 'uploads/DSCN9986.jpg'),
(2, 'Браслет \"Конюшина\"', 60, 'Плетіння \"Кобра\" з конюшиною', 'uploads/DSCN9950.jpg'),
(3, 'Браслет \"Digicam\" з годинником', 100.5, 'Плетіння \"Цифровий камуфляж\" з годинником', 'uploads/DSCN9976.jpg'),
(4, 'Темляк \"Патріотичний\"', 15, 'Темляк \"Патріотичний\" жовто-блакитний', 'uploads/DSCN0053.jpg'),
(5, 'Набір \"Патріотичний\" з біж.', 127.75, 'Набір \"Патріотичний\" браслет та темляк з біж. у патріотичних кольорах', 'uploads/DSCN0058.jpg'),
(6, 'Темлякі у асортименті', 15, 'Темляки різного плетіння', 'uploads/DSCN0056.jpg'),
(7, 'Браслет \"Shark Jaws\"', 76.5, 'Плетіння \"Shark Jaws\" зелений', 'uploads/DSCN9986.jpg'),
(8, 'Браслет \"№6576456\"', 80, 'Плетіння \"6576456\"', 'uploads/DSCN9993.jpg');

--
-- Триггеры `item`
--
DELIMITER $$
CREATE TRIGGER `delete_item` BEFORE DELETE ON `item` FOR EACH ROW BEGIN
  DELETE FROM `backet` WHERE `item_id`=OLD.`id`;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1486516965),
('m170208_003905_create_user_table', 1486517161),
('m170208_004726_create_post_table', 1486517161),
('m170208_005521_create_item_table', 1486517161),
('m170208_005814_create_backet_table', 1486517161),
('m170208_033600_create_profile_table', 1486525035),
('m170208_220417_add_ismanager_to_user_table', 1486591742),
('m170208_221730_add_ismanager_to_user_table', 1486592400),
('m170208_221730_add_manager_to_user_table', 1486592289);

-- --------------------------------------------------------

--
-- Структура таблицы `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `post` mediumtext COLLATE utf8mb4_unicode_ci,
  `created_at` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Дамп данных таблицы `post`
--

INSERT INTO `post` (`id`, `post`, `created_at`, `user_id`) VALUES
(1, 'Перший', '2017-02-11 10:25:26', 1),
(2, ':-)', '2017-02-11 10:25:33', 1),
(3, 'Ні чо сє', '2017-02-11 10:39:30', 2),
(4, 'Ахх... Мои мягкие французкие булки', '2017-02-11 10:42:44', 4);

-- --------------------------------------------------------

--
-- Структура таблицы `profile`
--

CREATE TABLE `profile` (
  `user_id` int(11) NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `second_name` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `middle_name` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` int(11) DEFAULT NULL,
  `gender` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Дамп данных таблицы `profile`
--

INSERT INTO `profile` (`user_id`, `avatar`, `first_name`, `second_name`, `middle_name`, `birthday`, `gender`) VALUES
(1, NULL, 'Адмін', 'Адмінов', 'Адмінович', NULL, NULL),
(2, NULL, 'Брюс', 'Беннер', 'Галкович', NULL, NULL),
(3, NULL, 'Тоні', 'Старк', 'Залізович', NULL, NULL),
(4, NULL, 'Вейд', 'Вілсон', 'Вінстон', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL,
  `auth_key` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `ismanager` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password_hash`, `status`, `auth_key`, `created_at`, `updated_at`, `ismanager`) VALUES
(1, 'Admin', 'admin@localhost.com', '$2y$13$GveEGysModyvA82I5owWaeDkUkKZNU9yzLT3hipyrWXPKihQ0fkS6', 10, 'cR5q8kE-0mLw8qcCTu7yWbxQfQfcnH3m', 1486802652, 1486802652, 1),
(2, 'hulk', 'hulk@qw.er', '$2y$13$o/vpM73MqljrZgNDvAjSMeSnqhRarWwKPA4jqV3d4OQRLP/exTa9C', 10, 'BhF_3yVQSJ_d6fjd64aLrDYag5H2hQ9q', 1486802744, 1486802744, 0),
(3, 'ironman', 'iron@cool.yea', '$2y$13$zEL7TUbQ6BdTQpL9w7hU8.Qm1UCcZUFUrupdI7DP1GbxFTcsLIdT2', 10, 'mlvLuVns1DyX_txgv3oiqRoDpUdLW9Wg', 1486802826, 1486802826, 0),
(4, 'Deadpool', 'dead@pool.ha', '$2y$13$aUjJ4ffk9lTvc0WeWzW1R.QVSTMClKAEF0qOo9gTfMHRAZNk36u9S', 10, 'nHup18Xtv80bo14Ckh6tMLGmI7HtOglC', 1486802924, 1486802924, 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `backet`
--
ALTER TABLE `backet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `backet_user_id` (`user_id`),
  ADD KEY `backet_item_id` (`item_id`);

--
-- Индексы таблицы `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_user_id` (`user_id`);

--
-- Индексы таблицы `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`user_id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `backet`
--
ALTER TABLE `backet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблицы `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT для таблицы `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `profile`
--
ALTER TABLE `profile`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `backet`
--
ALTER TABLE `backet`
  ADD CONSTRAINT `backet_item_id` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`),
  ADD CONSTRAINT `backet_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Ограничения внешнего ключа таблицы `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Ограничения внешнего ключа таблицы `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `profile_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
