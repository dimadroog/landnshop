-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 14 2016 г., 16:19
-- Версия сервера: 5.5.50
-- Версия PHP: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `landnblog`
--

-- --------------------------------------------------------

--
-- Структура таблицы `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `preview` text NOT NULL,
  `content` text NOT NULL,
  `date` varchar(255) NOT NULL,
  `publish` int(11) NOT NULL,
  `amount` int(255) NOT NULL,
  `min_amount` int(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `price` int(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `article`
--

INSERT INTO `article` (`id`, `title`, `preview`, `content`, `date`, `publish`, `amount`, `min_amount`, `unit`, `price`) VALUES
(1, 'lightSlider', '<p>assa</p>\r\n', '<p>asassa</p>\r\n', '1407441600', 1, 188, 4, 'шт.', 40),
(3, 'How to disable time in Bootstrap DateTimePicker?', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>\r\n', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p>&nbsp;</p>\r\n', '1469394000', 1, 39996, 2, 'м.', 300),
(5, 'Sets the picker default date/time. ', '<p>350</p>\r\n', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n', '1471986000', 1, 41, 3, 'м.', 350),
(10, 'Lorem ipsum dolor sit amet', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>\r\n', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>\r\n', '1466715600', 1, 68, 3, 'м.', 400),
(11, 'Ut enim ad minim veniam', '<p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>\r\n', '<p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>\r\n', '1474491600', 1, 386, 4, 'шт.', 50);

-- --------------------------------------------------------

--
-- Структура таблицы `article_category`
--

CREATE TABLE IF NOT EXISTS `article_category` (
  `id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `block`
--

CREATE TABLE IF NOT EXISTS `block` (
  `id` int(11) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `publish` int(11) NOT NULL,
  `publish_menu` int(11) NOT NULL,
  `background` varchar(255) NOT NULL,
  `bg_color` varchar(255) NOT NULL,
  `bg_style` varchar(255) NOT NULL,
  `animate` varchar(255) NOT NULL,
  `weight` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `block`
--

INSERT INTO `block` (`id`, `alias`, `name`, `content`, `publish`, `publish_menu`, `background`, `bg_color`, `bg_style`, `animate`, `weight`) VALUES
(1, 'footer', 'Футер', '', 1, 0, '', '', '', '', 3),
(2, 'slider', 'Слайдер 100%', '<h2 style="text-align: center;">Это&nbsp;слайдер!</h2>\r\n\r\n<h4>Это текст перед слайдером</h4>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt="" src="http://landnblog/static/wysiwyg/responsive_filemanager/source/slid1.jpg?1474394577925" style="width: 150px; height: 60px;" /></p>\r\n\r\n<p><img alt="" src="http://landnblog/static/wysiwyg/responsive_filemanager/source/slid3.jpg?1474394603881" style="width: 150px; height: 60px;" /></p>\r\n\r\n<p><img alt="" src="http://landnblog/static/wysiwyg/responsive_filemanager/source/slid4.png?1474394614725" style="width: 150px; height: 60px;" /></p>\r\n', 1, 0, '', '', 'background-repeat: no-repeat; background-size: cover; background-attachment: fixed; background-position: top center;', '', 1),
(3, 'contact', 'Контакты', '<h1 style="text-align: center;">Связаться с нами</h1>\r\n\r\n<h3>Вы можете написать нам заполнив форму ниже.</h3>\r\n', 1, 1, '', '', 'background-repeat: no-repeat; background-size: cover; background-attachment: fixed; background-position: top center;', '', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `position_lg` text NOT NULL,
  `position_lt` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `customer`
--

INSERT INTO `customer` (`id`, `name`, `mail`, `password`, `phone`, `position_lg`, `position_lt`) VALUES
(75, 'pupkin vasya', 'a@a.aa', '222', '000111222333', '', ''),
(76, 'yguukgk', '', 'mizov12', 'hjk', '', ''),
(77, 'sdf', 'aaa@bbb.cc', '', 'sdf', '', ''),
(78, 'xcvxcv', 'aaa@bbb.cc', '', 'cxvcxv', '', ''),
(79, ']', 'aaa@bbb.cc', '', 'cxvcxv', '', ''),
(80, 'df', 'aaa@bbb.cc', '', '000111222333', '', ''),
(81, 'pupkin vasya', 'aaa@bbb.cc', '', 'jk', '', ''),
(82, 'встроенные', 'aaa@bbb.cc', '', 'jk', '', ''),
(83, '', '', '', '', '', ''),
(84, 'встроенные', 'aaa@bbb.cc', '', '000111222333', '', ''),
(85, '', 'aaa@bbb.cc', '', 'hjk', '', ''),
(86, 'Курсы/группы', 'sdf', '', 'jk', '', ''),
(87, '', '', '', '', '', ''),
(88, 'встроенные', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `sum` int(255) NOT NULL,
  `json` text NOT NULL,
  `status` int(11) NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `order`
--

INSERT INTO `order` (`id`, `customer_id`, `sum`, `json`, `status`, `date`) VALUES
(16, 75, 2000, '[{"id":"11","title":"Ut enim ad minim veniam","price":"50","count":"4","sum":200,"unit":"\\u0448\\u0442."},{"id":"3","title":"How to disable time in Bootstrap DateTimePicker?","price":"300","count":"2","sum":600,"unit":"\\u043c."},{"id":"10","title":"Lorem ipsum dolor sit amet","price":"400","count":"3","sum":1200,"unit":"\\u043c."}]', 1, 1475692117),
(17, 75, 1400, '[{"id":"11","title":"Ut enim ad minim veniam","price":"50","count":"4","sum":200,"unit":"\\u0448\\u0442."},{"id":"10","title":"Lorem ipsum dolor sit amet","price":"400","count":"3","sum":1200,"unit":"\\u043c."}]', 0, 1475692197),
(18, 75, 200, '[{"id":"11","title":"Ut enim ad minim veniam","price":"50","count":"4","sum":200,"unit":"\\u0448\\u0442."}]', 0, 1475826507),
(19, 75, 4100, '[{"id":"11","title":"Ut enim ad minim veniam","price":"50","count":82,"sum":4100,"unit":"\\u0448\\u0442."}]', 0, 1476946015),
(20, 75, 160, '[{"id":"1","title":"lightSlider","price":"40","count":"4","sum":160,"unit":"\\u0448\\u0442."}]', 0, 1477034331),
(21, 76, 200, '[{"id":"11","title":"Ut enim ad minim veniam","price":"50","count":"4","sum":200,"unit":"\\u0448\\u0442."}]', 0, 1477053419);

-- --------------------------------------------------------

--
-- Структура таблицы `setting`
--

CREATE TABLE IF NOT EXISTS `setting` (
  `id` int(11) NOT NULL,
  `sitename` varchar(255) NOT NULL,
  `seo_title` varchar(255) NOT NULL,
  `seo_description` text NOT NULL,
  `seo_keywords` text NOT NULL,
  `bootstrap_theme` varchar(255) NOT NULL,
  `navbar_position` varchar(255) NOT NULL,
  `navbar_theme` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `super_password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `articles` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `setting`
--

INSERT INTO `setting` (`id`, `sitename`, `seo_title`, `seo_description`, `seo_keywords`, `bootstrap_theme`, `navbar_position`, `navbar_theme`, `password`, `super_password`, `email`, `articles`) VALUES
(1, 'My Landing Page', 'Мой одностраничный сайт', 'Описание сайта', 'Ключевые слова', 'bootstrap.min', 'navbar-fixed-top', 'navbar-default', '66b65567cedbc743bda3417fb813b9ba', '1acd9c7e06f217cd759345b99d372d31', 'mail@mail', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `article_category`
--
ALTER TABLE `article_category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `block`
--
ALTER TABLE `block`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT для таблицы `article_category`
--
ALTER TABLE `article_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `block`
--
ALTER TABLE `block`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=89;
--
-- AUTO_INCREMENT для таблицы `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT для таблицы `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
