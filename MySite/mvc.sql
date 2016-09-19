-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Сен 19 2016 г., 14:13
-- Версия сервера: 10.1.9-MariaDB
-- Версия PHP: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `mvc`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `alias` varchar(100) NOT NULL,
  `parent_id` tinyint(3) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `name`, `alias`, `parent_id`) VALUES
(1, 'Ароматизований і композиційний чай', 'aromatizovaniy-i-kompozicyniy-chay', 0),
(2, 'Китайський елітний чай', 'kitayskiy-elitniy-chay', 0),
(3, 'На основі зеленого', 'na-osnovi-zelenogo', 1),
(4, 'На основі чорного', 'na-osnovi-chornogo', 1),
(5, 'Білий чай', 'biliy-chay', 2),
(6, 'Пуери листовi', 'pueri-listovi', 2),
(7, 'Жасминовий чай', 'zhasminoviy-chay', 2),
(8, 'Червоний чай', 'chervoniy-chay', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id` int(11) UNSIGNED NOT NULL,
  `product_id` smallint(5) UNSIGNED NOT NULL,
  `product_name` varchar(150) CHARACTER SET utf8 NOT NULL,
  `product_alias` varchar(100) CHARACTER SET utf8 NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `message` text CHARACTER SET utf8,
  `email` varchar(100) NOT NULL,
  `dt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status_id` tinyint(1) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `product_id`, `product_name`, `product_alias`, `name`, `message`, `email`, `dt`, `status_id`) VALUES
(7, 9, 'Чай чорний Ерл Грей Спеціальний', 'chay-chorniy-erl-grey-specialniy', 'Люда', 'Очень вкусный!', 'lyudmila_iskra@yandex.ua', '2016-08-02 14:24:55', NULL),
(8, 1, 'Чай чорний Ірландські вершки', 'chay-chorniy-irlandski-vershki', 'Игорь', 'test!!', 'admin@your-site.com', '2016-08-15 12:09:48', NULL),
(12, 3, 'Чай чорний Адмірал', 'chay-chorniy-admiral', 'Игорь', 'test!', 'admin@your-site.com', '2016-08-15 13:15:43', NULL),
(13, 3, 'Чай чорний Адмірал', 'chay-chorniy-admiral', 'Игорь', 'test!', 'admin@your-site.com', '2016-08-15 13:16:15', NULL),
(14, 1, 'Чай чорний Ірландські вершки', 'chay-chorniy-irlandski-vershki', 'Игорь', '12345', 'admin@your-site.com', '2016-09-09 10:30:35', NULL),
(15, 1, 'Чай чорний Ірландські вершки', 'chay-chorniy-irlandski-vershki', 'test', 'test', 'testix@test.ru', '2016-09-13 16:51:07', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `delivery_types`
--

CREATE TABLE `delivery_types` (
  `id` tinyint(4) UNSIGNED NOT NULL,
  `title` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `delivery_types`
--

INSERT INTO `delivery_types` (`id`, `title`) VALUES
(1, 'Курьер'),
(2, 'Новая почта'),
(3, 'Самовывоз');

-- --------------------------------------------------------

--
-- Структура таблицы `goods`
--

CREATE TABLE `goods` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `alias` varchar(100) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `price` decimal(10,2) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `img` varchar(400) CHARACTER SET utf8 NOT NULL,
  `is_published` tinyint(1) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 PACK_KEYS=0;

--
-- Дамп данных таблицы `goods`
--

INSERT INTO `goods` (`id`, `name`, `alias`, `description`, `price`, `category_id`, `img`, `is_published`) VALUES
(1, 'Чай чорний Ірландські вершки', 'chay-chorniy-rlandsk-vershki', '<p>Чорний чай зі шматочками арахісу і вершковим ароматом</p>', '69.00', 4, 'img-1.jpg', 1),
(2, 'Чай чорний Чорна Смородина', 'chay-chorniy-chorna-smorodina', '<p>Суміш цейлонських та індійських чаїв з додаванням ягід і листя чорної смородини, і чудовим ароматом цієї чудової ягоди.</p>', '74.00', 4, 'img-2.jpg', 1),
(3, 'Чай чорний Адмірал', 'chay-chorniy-admiral', '<p>Чорний чай зі шматочками яблук, кориці, часточками апельсина, коріандру, кардамону, гвоздики, червоного перцю, з інтригуючим ароматом кориці і яскравим смаком з ледь відчутною гостринкою в післясмаку.</p>', '98.00', 4, 'img-3.jpg', 1),
(4, 'Чай чорний ароматизований Моя прекрасна Леді', 'chay-chorniy-aromatizovaniy-moya-prekrasna-ledi', '<p>Купаж чорного чаю з солодкими родзинками, шматочками плодів ананаса, пелюстками троянди, волошки і ароматом екзотичних фруктів.</p>', '102.00', 4, 'img-4.jpg', 1),
(5, 'Чай чорний ароматизований Масала-2', 'chay-chorniy-aromatizovaniy-masala-2', '<p>Чай Масала - це традиційний напій Індії, який готують із суміші прянощів. За традицією його подають з молоком або великою кількістю цукру. Склад: чорний чай, кориця, аніс, фенхель, імбир, гвоздика, чорний перець.</p>', '120.00', 4, 'img-5.jpg', 1),
(6, 'Чай чорний Іван-чай', 'chay-chorniy-ivan-chay', '<p>Листя зніту збирають на зростаючий місяць, коли стебло і листя рослини насичені соком. Після процесу природногої ферментації, листя сушать в печі. Цінність цього напою з віком тільки збільшується, а смак і аромат стають більш вишуканим, густим і сильним.</p>', '208.00', 4, 'img-6.jpg', 1),
(7, 'Чай чорний ароматизований З халвою', 'chay-chorniy-aromatizovaniy-z-halvoyu', '<p>Чорний чай з насінням соняшника в кольорової глазурі, листом волоського горіха і стевією та ніжним ароматом xалви.</p>', '46.00', 4, 'img-7.jpg', 1),
(8, 'Чай чорний Іван да Марья', 'chay-chorniy-ivan-da-marya', '<p>Купаж чорного чаю і сибірського листового Іван-чаю з шматочками яблук, листям бамбука і волоського горіха, плодами аронії, звіробоєм і ароматом айви.</p>', '125.00', 4, 'img-8.jpg', 1),
(9, 'Чай чорний Ерл Грей Спеціальний', 'chay-chorniy-erl-grey-specialniy', '<p>Суміш цейлонських та індійських чаїв з додаванням пелюсток волошки, цедри апельсина, лимонником, квітками жасмину і оригінальним ароматом бергамоту.</p>', '66.00', 4, 'img-9.jpg', 1),
(10, 'Чай чорний Святий Валентин', 'chay-chorniy-svyatiy-valentin', '<p>Купаж чорного чаю з кокосовою стружкою, шматочками малини і полуниці, цукровими сердечками і ніжним солодким ароматом.</p>', '103.00', 4, 'img-10.jpg', 1),
(11, 'Чай чорний ароматизований Брусничний', 'chay-chorniy-aromatizovaniy-brusnichniy', '<p>Чорний чай з додаванням брусничного листа, сушеної журавлини, шкірки шипшини і медових гранул.</p>', '54.00', 4, 'img-11.jpg', 1),
(12, 'Чай чорний Наполеон', 'chay-chorniy-napoleon', '<p>Купаж чорного чаю з цедрою лимона і приємним ароматом бергамоту.</p>', '56.00', 4, 'img-12.jpg', 1),
(13, 'Чай чорний Венеціанська ніч', 'chay-chorniy-venecianska-nich', '<p>Купаж чорного чаю з гібіскусом, ягодами ожини і червоної смородини, шматочками малини, полуниці і пелюстками піону.</p>', '84.00', 4, 'img-13.jpg', 1),
(14, 'Чай чорний Полуниця з вершками', 'chay-chorniy-polunicya-z-vershkami', '<p>Суміш цейлонських та індійських чаїв з додаванням ягід і листя полуниці і пелюсток сафлору.</p>', '61.00', 4, 'img-14.jpg', 1),
(15, 'Чай чорний Айва з шерімоєю', 'chay-chorniy-ayva-z-sherimoeyu', '<p>Суміш китайських, цейлонських та індійських чаїв з додаванням шматочків абрикоса і ананаса, цедри апельсина, цукатів айви і шеримойї.</p>', '69.00', 4, 'img-15.jpg', 1),
(16, 'Чай чорний Зоряний дощ', 'chay-chorniy-zoryaniy-dosch', '<p>Купаж чорного чаю з пелюстками троянди, соняшника і солодким квітковим ароматом з легкою цитрусовою ноткою.</p>', '41.00', 4, 'img-16.jpg', 1),
(17, 'Чай чорний З імбиром Східний', 'chay-chorniy-z-imbirom-shidniy', '<p>Чорний чай з кардамоном, гвоздикою і шматочками імбиру, цитрусовою кислинкою лимонної трави та медовим присмаком з пряними нотками.</p>', '64.00', 4, 'img-17.jpg', 1),
(18, 'Чай чорний Алазанська Долина', 'chay-chorniy-alazanska-dolina', '<p>Купаж чорного чаю з ягодами смородини, шматочками яблука і трохи терпким ароматом чорної смородини.</p>', '53.00', 4, 'img-18.jpg', 1),
(19, 'Чай чорний Айва з персиком', 'chay-chorniy-ayva-z-persikom', '<p>Суміш китайських, цейлонських та індійських чаїв з додаванням пелюсток апельсина і сафлору, шматочків папайї і манго. Чай ароматизований натуральними маслами айви і папайї.</p>', '86.00', 4, 'img-19.jpg', 1),
(20, 'Чай зелений Бенгальський Тигр', 'chay-zeleniy-bengalskiy-tigr', '<p>Купаж зеленого чаю з шматочками папайї, ананаса, манго, пластівцями моркви, листям полуниці, пелюстками соняшника та сафлору. Сорт вищий.</p>', '93.00', 3, 'img-20.jpg', 1),
(21, 'Шоу Мей', 'shou-mey', '<p>Цей чай вирощується в горах Фуцзянь. Ідеально підходить для тих, хто тільки починає знайомитися з білим чаєм, так як має яскраві смакові нотки і має всі корисні і благородні властивості білого чаю - чудово втамовує спрагу, покращує стан шкіри, зупиняє старіння клітин, сприяє довголіттю.</p>', '100.00', 5, 'img-21.jpg', 1),
(22, 'Гун Тін Пуер (Імператорський Пуер)', 'gun-tin-puer-imperatorskiy-puer', '<p>Листовий шу пуер з провінції Юньнань. Гун Тін пуер виготовляється з невеликих чайних листочків з тіпсами. Настій темного кольору з яскравим смаком з нотками сухофруктів та горіхів, має насичений аромат з відтінком деревної кори.</p>', '181.00', 6, 'img-22.jpg', 1),
(23, 'Фен Янь (Око Фенікса)', 'fen-yan-oko-feniksa', '<p>Чайне листя за формою нагадує око фенікса, звідки і пішла назва цього чаю. При заварюванні дає прозорий настій жовто - зеленого кольору з насиченим, солодким смаком і тривалим післясмаком.</p>', '326.00', 7, 'img-23.jpg', 1),
(24, 'Молі Хуа Ча (Китайський класичний з жасмином)', 'moli-hua-cha-kitayskiy-klasichniy-z-zhasminom', '<p>Традиційний зелений чай з додаванням пелюсток жасмину. При заварюванні виходить світло-жовтий настій з тонким ароматом жасмину і м''яким смаком.</p>', '60.00', 7, 'img-24.jpg', 1),
(25, 'Молі Та Бай Хоу (Великий білий ворс)', 'moli-ta-bay-hou-velikiy-biliy-vors', '<p>Цей чай росте в провінції Фуцзянь. При заварюванні він дає темно-золотистий настій з вишуканим жасминовим ароматом, в якому можна розрізнити і тонкі нотки лілії. Смак чаю дуже ніжний, з довгим, солодким присмаком.</p>', '125.00', 7, 'img-25.jpg', 1),
(26, 'Лі Чі Хун Ча (Червоний чай з ароматом Лі Чі)', 'li-chi-hun-cha-chervoniy-chay-z-aromatom-li-chi', '<p>Чай, вирощений в провінції Юньнань. При заварюванні виходить насичений настій, з яскравим ароматом польових трав, приємною кислинкою плода Лі Чі і солодким медовим присмаком.</p>', '81.00', 8, 'img-26.jpg', 1),
(27, 'Білий Пуер ', 'biliy-puer-lyuy-ya-bao-puerni-brunki', '<p>Пуерні бруньки збираються з пуерних дерев в провінції Юннань. Настій світлого кольору з ніжним квітково-весняним смаком і тонким ароматом.</p>', '219.00', 6, 'img-27.jpg', 1),
(28, 'Е-Шен (Дикий зелений пуер)', 'e-shen-dikiy-zeleniy-puer', '<p>Шен пуер з вишуканим смаком з нотками сухофруктів і насиченим терпким ароматом з відтінками сушеної груші.</p>', '186.00', 6, 'img-28.jpg', 1),
(29, 'Червоний молочний чай', 'chervoniy-molochniy-chay', '<p>Червоний китайський чай з провінції Юннань має приємний вершково-молочний смак, з ароматом теплого молока та медово-шоколадними нотками. Чудово зігріває організм, покращує травлення, сприяє правильній роботі печінки і нирок, знімає стрес. Можна заварювати декілька раз.</p>', '79.00', 8, 'img-29.jpg', 1),
(30, 'Червоний чай Юннань', 'chervoniy-chay-yunnan', '<p>Цей чай вирощується в провінції Юньнань. Великі темні листя з золотистим відливом дають настій з незвично легким ароматом і спокійним смаком, який завжди дивує тих, хто звик до терпкості або кенійських цейлонських сортів.</p>', '57.00', 8, 'img-30.jpg', 1),
(31, 'Чай зелений Ганпаудер - Бергамот', 'chay-zeleniy-ganpauder---bergamot', '<p>Китайський зелений чай ганпаудер з цедрою лимона, квітками липи і насиченим, яскравим ароматом бергамоту.</p>', '47.00', 3, 'img-31.jpg', 1),
(32, 'Бай Му Дань (Білий піон)', 'bay-mu-dan-biliy-pion', '<p>Білий чай, вирощений в провінції Фуцзянь. Настою притаманний прозорий колір і ніжний, бархатистий смак.</p>', '140.00', 5, 'img-32.jpg', 1),
(33, 'Бай Хао Інь Чжень (Срібні голки з білими волосками)', 'bay-hao-in-chzhen-sribni-golki-z-bilimi-voloskami', '<p>Чай вирощується в провінції Фуцзянь. Настою притаманний світло-золотистий колір, оксамитовий аромат. На смак цей чай нагадує мед.</p>', '268.00', 5, 'img-33.jpg', 1),
(34, 'Чай зелений Віденський Вальс', 'chay-zeleniy-videnskiy-vals', '<p>Легкий літній чай на основі улуна з квітками апельсина, пелюстками волошки, шматочками полуниці та солодким ароматом банана.</p>', '57.00', 3, 'img-34.jpg', 1),
(35, 'Чай зелений Японська липа', 'chay-zeleniy-yaponska-lipa', '<p>Зелений чай Сенча з додаванням квіток липи, суцвіть ромашки і цедри апельсина.</p>', '71.00', 3, 'img-35.jpg', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

CREATE TABLE `messages` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` int(15) UNSIGNED NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `messages`
--

INSERT INTO `messages` (`id`, `name`, `phone`, `email`, `message`) VALUES
(1, 'Test', 503212321, 'test@test.com', 'Test message'),
(2, 'Игорь', 678999076, 'admin@your-site.com', 'тестирую!');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `middlename` varchar(50) CHARACTER SET utf8 NOT NULL,
  `surname` varchar(50) CHARACTER SET utf8 NOT NULL,
  `phone` char(10) NOT NULL,
  `payment_type` tinyint(4) UNSIGNED NOT NULL,
  `delivery_type` tinyint(4) UNSIGNED NOT NULL,
  `city` varchar(50) CHARACTER SET utf8 NOT NULL,
  `street` varchar(55) CHARACTER SET utf8 NOT NULL,
  `house` varchar(10) NOT NULL,
  `flat` varchar(10) NOT NULL,
  `status` tinyint(4) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `date`, `name`, `middlename`, `surname`, `phone`, `payment_type`, `delivery_type`, `city`, `street`, `house`, `flat`, `status`) VALUES
(21, 1, '2016-09-06 20:44:48', 'Игорь', 'Васильевич', 'Бакал', '501235325', 2, 3, 'Киев', 'Урловская', '17', '50', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `order_details`
--

CREATE TABLE `order_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `goods_id` int(10) UNSIGNED NOT NULL,
  `count` int(10) UNSIGNED NOT NULL,
  `price` decimal(10,2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `order_details`
--

INSERT INTO `order_details` (`id`, `user_id`, `order_id`, `goods_id`, `count`, `price`) VALUES
(25, 1, 21, 9, 2, '66.00'),
(26, 1, 21, 13, 1, '84.00');

-- --------------------------------------------------------

--
-- Структура таблицы `order_statuses`
--

CREATE TABLE `order_statuses` (
  `id` tinyint(4) UNSIGNED NOT NULL,
  `title` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `order_statuses`
--

INSERT INTO `order_statuses` (`id`, `title`) VALUES
(1, 'Обрабатывается'),
(2, 'Комплектуется'),
(3, 'Выполнен');

-- --------------------------------------------------------

--
-- Структура таблицы `pages`
--

CREATE TABLE `pages` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `alias` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` text,
  `is_published` tinyint(1) UNSIGNED DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `pages`
--

INSERT INTO `pages` (`id`, `alias`, `title`, `content`, `is_published`) VALUES
(1, 'about', 'О Нас', '<div id="lipsum">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce tincidunt, massa a blandit consequat, elit orci fermentum dui, sed sagittis nulla diam sit amet arcu. Aenean dignissim sagittis leo at hendrerit. Ut pellentesque est eu tempus ullamcorper. Integer mollis consequat velit, eget aliquet velit. Donec sollicitudin lectus a justo bibendum, in molestie ipsum efficitur. Vivamus ut risus rhoncus lorem placerat dictum a at odio. Praesent quis tellus quis turpis rutrum tincidunt nec quis nunc. Vivamus lorem leo, blandit luctus molestie non, ultricies eget quam. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Morbi eget augue vitae nulla consectetur tincidunt at ut libero. In varius posuere enim, quis blandit velit commodo at. Fusce lacinia suscipit vestibulum. In convallis sem sit amet volutpat consequat. Vivamus fringilla cursus diam, id aliquam mauris.</p>\r\n<p>Nulla rhoncus lacus quis enim commodo finibus. Pellentesque vitae ullamcorper diam, varius pellentesque metus. Cras dolor dui, scelerisque a elit sit amet, molestie molestie leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec lacinia vitae nisl sollicitudin posuere. In sed convallis erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nunc blandit risus nec odio porta, in tristique leo feugiat. Duis tellus ante, molestie eget magna et, eleifend ultrices justo. Phasellus viverra varius turpis, sed ornare mi rhoncus sit amet. Proin efficitur, ante sit amet varius ultricies, eros metus semper quam, congue laoreet purus erat ut urna. Fusce maximus sagittis elit sed tristique.</p>\r\n<p>Nullam varius dapibus fermentum. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cras pellentesque, lacus ut venenatis aliquet, sem augue sagittis augue, sit amet consectetur erat arcu in lacus. Donec laoreet volutpat tempus. Cras augue ex, pellentesque sed commodo sit amet, viverra sit amet libero. Mauris et molestie lacus, maximus pharetra neque. Nulla non eros rutrum sem ullamcorper posuere. Duis vitae maximus metus, ac tempor odio. Vestibulum quis orci eget quam interdum tincidunt sit amet id urna. Donec vel diam tincidunt, congue leo in, molestie mauris. Nunc volutpat, libero vitae hendrerit venenatis, est ligula aliquet orci, vitae sagittis ante quam nec lectus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nam diam felis, feugiat id ipsum eget, faucibus congue velit.</p>\r\n<p>Sed ut mi diam. Etiam laoreet nisi vel sem luctus vulputate. In hac habitasse platea dictumst. Sed ac pellentesque massa. Praesent orci justo, aliquam quis tellus ut, rutrum euismod libero. Sed quis libero magna. Suspendisse semper lobortis lectus, efficitur pretium sem vulputate et. Fusce placerat nisl in arcu pellentesque semper. Nulla posuere a diam eget dictum. Nullam vitae pulvinar lectus, sed bibendum urna. Ut rhoncus, ipsum pulvinar congue condimentum, metus ipsum sollicitudin lectus, in vulputate magna purus sit amet leo. Praesent condimentum eros vel nisl dictum vulputate. Ut in turpis blandit, pulvinar purus a, gravida neque.</p>\r\n<p>Phasellus tortor felis, venenatis sit amet ullamcorper vel, aliquam vitae enim. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam elementum, urna in gravida gravida, libero felis gravida quam, nec tincidunt mauris arcu pulvinar diam. Pellentesque vitae nibh in urna eleifend iaculis. Morbi iaculis diam erat, id tincidunt quam egestas et. Praesent id tellus eget mauris suscipit fermentum. Praesent commodo facilisis diam, id suscipit tellus viverra quis.</p>\r\n<p>Integer consequat magna elit, vitae viverra nisl dapibus eu. Mauris eget suscipit metus, ac pharetra nisl. Vestibulum rhoncus risus non lectus tristique vulputate. Etiam id gravida enim, ut varius arcu. Nam velit libero, sagittis eget nisl eget, blandit ultricies felis. Pellentesque molestie dui quam, vitae venenatis metus euismod a. Curabitur convallis nibh massa, ac ullamcorper nisl laoreet non. Pellentesque volutpat ex eget sem lobortis hendrerit. Aliquam imperdiet mattis elit. Etiam finibus purus at leo commodo aliquam. Ut semper enim nisi, ac pretium mauris mollis in. Fusce magna erat, sagittis eu lacinia ut, tempus non nunc. Aliquam ac libero tempor, sollicitudin lorem vitae, mattis odio.</p>\r\n<p>Fusce suscipit finibus quam et pretium. Duis venenatis aliquam risus sit amet ullamcorper. Aenean eget malesuada urna. Suspendisse non rhoncus turpis, a hendrerit augue. Fusce sagittis nisi eget feugiat semper. Mauris eleifend diam eros, sed sagittis quam suscipit eget. Phasellus luctus purus ornare iaculis condimentum. Ut tempor vitae magna ut accumsan. Aenean viverra, est at convallis dignissim, quam elit fermentum est, quis dictum tortor augue sed nunc. Integer nulla odio, vulputate ac augue eu, convallis tempor tortor. Nunc dictum, nibh sit amet posuere vehicula, odio metus cursus lacus, ac gravida quam turpis gravida tellus. Fusce venenatis ut orci ac porta. Nunc efficitur semper auctor. Curabitur feugiat interdum turpis nec suscipit. Praesent nec commodo ligula. Nulla facilisi.</p>\r\n<p>Quisque ornare malesuada felis, at imperdiet enim egestas sed. Mauris consectetur id libero sed vehicula. Aenean tempor leo mauris, vel fermentum neque lobortis non. Phasellus iaculis turpis non enim efficitur, id suscipit nisi malesuada. Curabitur sed quam in nisl egestas blandit. Donec quis maximus lorem, nec fringilla dolor. Aenean vel luctus dolor. Maecenas tincidunt purus eget neque fringilla, et dignissim augue mollis. Nullam at commodo elit. Suspendisse potenti. Nam iaculis vitae nulla eu tincidunt. Nam et lacus purus. In nisl augue, ultricies vitae egestas at, sodales quis arcu. Fusce non fringilla mauris, sed varius ante.</p>\r\n<p>In hac habitasse platea dictumst. Curabitur vulputate blandit dolor, non porta sapien ultricies rhoncus. Aliquam quis lacus in ex tempor finibus. Cras laoreet nisi nec convallis pellentesque. Mauris eget commodo risus, eget dignissim turpis. Pellentesque ac odio placerat, sollicitudin lectus quis, egestas erat. Suspendisse aliquam est quis nibh sollicitudin, sit amet efficitur neque interdum. Duis eu imperdiet ligula. Suspendisse aliquam laoreet fermentum. Phasellus dictum, sapien in consequat volutpat, sem nisl pharetra ipsum, luctus eleifend risus felis nec libero. Integer in sollicitudin velit, vel dapibus mauris.</p>\r\n<p>Nullam hendrerit quis quam at ultricies. Etiam vitae mauris quis metus pretium blandit eget ut lectus. Donec auctor nibh vel mauris iaculis sagittis. Fusce rutrum sagittis ullamcorper. Nulla commodo pharetra malesuada. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Cras sed metus orci. Morbi quis condimentum magna. Integer aliquet lorem pulvinar, hendrerit nisi eu, vehicula massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nunc blandit laoreet erat, eu ultricies lectus. Vivamus sagittis, sapien non iaculis consectetur, massa arcu placerat sapien, quis malesuada arcu sem vitae felis. Curabitur massa urna, rhoncus at sapien eu, dapibus cursus ex. Ut eget semper felis, a viverra lorem. In convallis semper libero ac laoreet.</p>\r\n</div>', 1),
(5, 'dostavka-i-oplata', 'Доставка и оплата', '<div id="lipsum">\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce tincidunt, massa a blandit consequat, elit orci fermentum dui, sed sagittis nulla diam sit amet arcu. Aenean dignissim sagittis leo at hendrerit. Ut pellentesque est eu tempus ullamcorper. Integer mollis consequat velit, eget aliquet velit. Donec sollicitudin lectus a justo bibendum, in molestie ipsum efficitur. Vivamus ut risus rhoncus lorem placerat dictum a at odio. Praesent quis tellus quis turpis rutrum tincidunt nec quis nunc. Vivamus lorem leo, blandit luctus molestie non, ultricies eget quam. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Morbi eget augue vitae nulla consectetur tincidunt at ut libero. In varius posuere enim, quis blandit velit commodo at. Fusce lacinia suscipit vestibulum. In convallis sem sit amet volutpat consequat. Vivamus fringilla cursus diam, id aliquam mauris.</p>\n<p>Nulla rhoncus lacus quis enim commodo finibus. Pellentesque vitae ullamcorper diam, varius pellentesque metus. Cras dolor dui, scelerisque a elit sit amet, molestie molestie leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec lacinia vitae nisl sollicitudin posuere. In sed convallis erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nunc blandit risus nec odio porta, in tristique leo feugiat. Duis tellus ante, molestie eget magna et, eleifend ultrices justo. Phasellus viverra varius turpis, sed ornare mi rhoncus sit amet. Proin efficitur, ante sit amet varius ultricies, eros metus semper quam, congue laoreet purus erat ut urna. Fusce maximus sagittis elit sed tristique.</p>\n<p>Nullam varius dapibus fermentum. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cras pellentesque, lacus ut venenatis aliquet, sem augue sagittis augue, sit amet consectetur erat arcu in lacus. Donec laoreet volutpat tempus. Cras augue ex, pellentesque sed commodo sit amet, viverra sit amet libero. Mauris et molestie lacus, maximus pharetra neque. Nulla non eros rutrum sem ullamcorper posuere. Duis vitae maximus metus, ac tempor odio. Vestibulum quis orci eget quam interdum tincidunt sit amet id urna. Donec vel diam tincidunt, congue leo in, molestie mauris. Nunc volutpat, libero vitae hendrerit venenatis, est ligula aliquet orci, vitae sagittis ante quam nec lectus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nam diam felis, feugiat id ipsum eget, faucibus congue velit.</p>\n<p>Sed ut mi diam. Etiam laoreet nisi vel sem luctus vulputate. In hac habitasse platea dictumst. Sed ac pellentesque massa. Praesent orci justo, aliquam quis tellus ut, rutrum euismod libero. Sed quis libero magna. Suspendisse semper lobortis lectus, efficitur pretium sem vulputate et. Fusce placerat nisl in arcu pellentesque semper. Nulla posuere a diam eget dictum. Nullam vitae pulvinar lectus, sed bibendum urna. Ut rhoncus, ipsum pulvinar congue condimentum, metus ipsum sollicitudin lectus, in vulputate magna purus sit amet leo. Praesent condimentum eros vel nisl dictum vulputate. Ut in turpis blandit, pulvinar purus a, gravida neque.</p>\n<p>Phasellus tortor felis, venenatis sit amet ullamcorper vel, aliquam vitae enim. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam elementum, urna in gravida gravida, libero felis gravida quam, nec tincidunt mauris arcu pulvinar diam. Pellentesque vitae nibh in urna eleifend iaculis. Morbi iaculis diam erat, id tincidunt quam egestas et. Praesent id tellus eget mauris suscipit fermentum. Praesent commodo facilisis diam, id suscipit tellus viverra quis.</p>\n<p>Integer consequat magna elit, vitae viverra nisl dapibus eu. Mauris eget suscipit metus, ac pharetra nisl. Vestibulum rhoncus risus non lectus tristique vulputate. Etiam id gravida enim, ut varius arcu. Nam velit libero, sagittis eget nisl eget, blandit ultricies felis. Pellentesque molestie dui quam, vitae venenatis metus euismod a. Curabitur convallis nibh massa, ac ullamcorper nisl laoreet non. Pellentesque volutpat ex eget sem lobortis hendrerit. Aliquam imperdiet mattis elit. Etiam finibus purus at leo commodo aliquam. Ut semper enim nisi, ac pretium mauris mollis in. Fusce magna erat, sagittis eu lacinia ut, tempus non nunc. Aliquam ac libero tempor, sollicitudin lorem vitae, mattis odio.</p>\n<p>Fusce suscipit finibus quam et pretium. Duis venenatis aliquam risus sit amet ullamcorper. Aenean eget malesuada urna. Suspendisse non rhoncus turpis, a hendrerit augue. Fusce sagittis nisi eget feugiat semper. Mauris eleifend diam eros, sed sagittis quam suscipit eget. Phasellus luctus purus ornare iaculis condimentum. Ut tempor vitae magna ut accumsan. Aenean viverra, est at convallis dignissim, quam elit fermentum est, quis dictum tortor augue sed nunc. Integer nulla odio, vulputate ac augue eu, convallis tempor tortor. Nunc dictum, nibh sit amet posuere vehicula, odio metus cursus lacus, ac gravida quam turpis gravida tellus. Fusce venenatis ut orci ac porta. Nunc efficitur semper auctor. Curabitur feugiat interdum turpis nec suscipit. Praesent nec commodo ligula. Nulla facilisi.</p>\n<p>Quisque ornare malesuada felis, at imperdiet enim egestas sed. Mauris consectetur id libero sed vehicula. Aenean tempor leo mauris, vel fermentum neque lobortis non. Phasellus iaculis turpis non enim efficitur, id suscipit nisi malesuada. Curabitur sed quam in nisl egestas blandit. Donec quis maximus lorem, nec fringilla dolor. Aenean vel luctus dolor. Maecenas tincidunt purus eget neque fringilla, et dignissim augue mollis. Nullam at commodo elit. Suspendisse potenti. Nam iaculis vitae nulla eu tincidunt. Nam et lacus purus. In nisl augue, ultricies vitae egestas at, sodales quis arcu. Fusce non fringilla mauris, sed varius ante.</p>\n<p>In hac habitasse platea dictumst. Curabitur vulputate blandit dolor, non porta sapien ultricies rhoncus. Aliquam quis lacus in ex tempor finibus. Cras laoreet nisi nec convallis pellentesque. Mauris eget commodo risus, eget dignissim turpis. Pellentesque ac odio placerat, sollicitudin lectus quis, egestas erat. Suspendisse aliquam est quis nibh sollicitudin, sit amet efficitur neque interdum. Duis eu imperdiet ligula. Suspendisse aliquam laoreet fermentum. Phasellus dictum, sapien in consequat volutpat, sem nisl pharetra ipsum, luctus eleifend risus felis nec libero. Integer in sollicitudin velit, vel dapibus mauris.</p>\n<p>Nullam hendrerit quis quam at ultricies. Etiam vitae mauris quis metus pretium blandit eget ut lectus. Donec auctor nibh vel mauris iaculis sagittis. Fusce rutrum sagittis ullamcorper. Nulla commodo pharetra malesuada. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Cras sed metus orci. Morbi quis condimentum magna. Integer aliquet lorem pulvinar, hendrerit nisi eu, vehicula massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nunc blandit laoreet erat, eu ultricies lectus. Vivamus sagittis, sapien non iaculis consectetur, massa arcu placerat sapien, quis malesuada arcu sem vitae felis. Curabitur massa urna, rhoncus at sapien eu, dapibus cursus ex. Ut eget semper felis, a viverra lorem. In convallis semper libero ac laoreet.</p>\n</div>\n</div>', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `payment_types`
--

CREATE TABLE `payment_types` (
  `id` tinyint(4) UNSIGNED NOT NULL,
  `title` varchar(55) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `payment_types`
--

INSERT INTO `payment_types` (`id`, `title`) VALUES
(1, 'Наличными'),
(2, 'Безналичная оплата с НДС'),
(3, 'Безналичный расчёту для физ. лиц-предпринимателей');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `login` varchar(45) NOT NULL,
  `surname` varchar(55) NOT NULL,
  `name` varchar(55) NOT NULL,
  `middlename` varchar(55) NOT NULL,
  `city` varchar(50) NOT NULL,
  `street` varchar(55) NOT NULL,
  `house` varchar(10) NOT NULL,
  `flat` varchar(10) NOT NULL,
  `phone` char(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` varchar(45) NOT NULL DEFAULT 'admin',
  `password` char(32) NOT NULL,
  `is_active` tinyint(1) UNSIGNED DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `surname`, `name`, `middlename`, `city`, `street`, `house`, `flat`, `phone`, `email`, `role`, `password`, `is_active`) VALUES
(1, 'Admin', 'Бакал', 'Игорь', 'Васильевич', 'Киев', 'Урловская', '17', '50', '501235325', 'admin@your-site.com', 'admin', '5a37bc44d6d11dbc47e575b1d8c025e1', 1),
(2, 'valera', 'test', 'Тест', '', '', '', '', '', '671233412', 'test@test.ru', 'user', '420586a8fdbd0d8cc9e53553b5c6f0c0', 1),
(3, 'Codecat', 'Мацола', 'Адрій', 'Денисович', 'Львів', 'площа Ринок', '26', '15', '966541242', 'codecat@gmail.com', 'user', '420586a8fdbd0d8cc9e53553b5c6f0c0', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `delivery_types`
--
ALTER TABLE `delivery_types`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Индексы таблицы `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`),
  ADD KEY `delivery_type` (`delivery_type`),
  ADD KEY `payment_type` (`payment_type`);

--
-- Индексы таблицы `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `order_statuses`
--
ALTER TABLE `order_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `payment_types`
--
ALTER TABLE `payment_types`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT для таблицы `delivery_types`
--
ALTER TABLE `delivery_types`
  MODIFY `id` tinyint(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `goods`
--
ALTER TABLE `goods`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT для таблицы `messages`
--
ALTER TABLE `messages`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT для таблицы `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT для таблицы `order_statuses`
--
ALTER TABLE `order_statuses`
  MODIFY `id` tinyint(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `pages`
--
ALTER TABLE `pages`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `payment_types`
--
ALTER TABLE `payment_types`
  MODIFY `id` tinyint(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `goods`
--
ALTER TABLE `goods`
  ADD CONSTRAINT `goods_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
