-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Авг 06 2016 г., 09:28
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
  `reply_to` smallint(5) UNSIGNED DEFAULT NULL,
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

INSERT INTO `comments` (`id`, `reply_to`, `product_id`, `product_name`, `product_alias`, `name`, `message`, `email`, `dt`, `status_id`) VALUES
(5, 0, 2, 'Чай чорний Чорна Смородина', 'chay-chorniy-chorna-smorodina', 'Игорь', 'test', 'admin@your-site.com', '2016-07-26 14:40:00', NULL),
(6, 0, 1, 'Чай чорний Ірландські вершки', 'chay-chorniy-irlandski-vershki', 'Игорь', 'privet!', 'admin@your-site.com', '2016-07-26 14:40:15', NULL),
(7, 0, 9, 'Чай чорний Ерл Грей Спеціальний', 'chay-chorniy-erl-grey-specialniy', 'Люда', 'Очень вкусный!', 'lyudmila_iskra@yandex.ua', '2016-08-02 14:24:55', NULL);

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
  `views` int(11) UNSIGNED NOT NULL,
  `is_published` tinyint(1) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 PACK_KEYS=0;

--
-- Дамп данных таблицы `goods`
--

INSERT INTO `goods` (`id`, `name`, `alias`, `description`, `price`, `category_id`, `views`, `is_published`) VALUES
(1, 'Чай чорний Ірландські вершки', 'chay-chorniy-irlandski-vershki', '<p><span style="color: #888888; font-family: Ubuntu, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 18px;">Чорний чай зі шматочками арахісу і вершковим ароматом.</span></p>', '69.00', 4, 367, 1),
(2, 'Чай чорний Чорна Смородина', 'chay-chorniy-chorna-smorodina', '<p><span style="color: #888888; font-family: Ubuntu, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 18px;">Суміш цейлонських та індійських чаїв з додаванням ягід і листя чорної смородини, і чудовим ароматом цієї чудової ягоди.</span></p>', '74.00', 4, 156, 1),
(3, 'Чай чорний Адмірал', 'chay-chorniy-admiral', '<p><span style="color: #888888; font-family: Ubuntu, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 18px;">Чорний чай зі шматочками яблук, кориці, часточками апельсина, коріандру, кардамону, гвоздики, червоного перцю, з інтригуючим ароматом кориці і яскравим смаком з ледь відчутною гостринкою в післясмаку.</span></p>', '98.00', 4, 87, 1),
(4, 'Чай чорний ароматизований Моя прекрасна Леді', 'chay-chorniy-aromatizovaniy-moya-prekrasna-ledi', '<p><span style="color: #888888; font-family: Ubuntu, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 18px;">Купаж чорного чаю з солодкими родзинками, шматочками плодів ананаса, пелюстками троянди, волошки і ароматом екзотичних фруктів.</span></p>', '102.00', 4, 45, 1),
(5, 'Чай чорний ароматизований Масала-2', 'chay-chorniy-aromatizovaniy-masala-2', '<p><span style="color: #888888; font-family: Ubuntu, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 18px;">Чай Масала - це традиційний напій Індії, який готують із суміші прянощів. За традицією його подають з молоком або великою кількістю цукру. Склад: чорний чай, кориця, аніс, фенхель, імбир, гвоздика, чорний перець.</span></p>', '120.00', 4, 17, 1),
(6, 'Чай чорний Іван-чай', 'chay-chorniy-ivan-chay', '<p><span style="color: #888888; font-family: Ubuntu, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 18px;">Листя зніту збирають на зростаючий місяць, коли стебло і листя рослини насичені соком. Після процесу природногої ферментації, листя сушать в печі. Цінність цього напою з віком тільки збільшується, а смак і аромат стають більш вишуканим, густим і сильним.</span></p>', '208.00', 4, 14, 1),
(7, 'Чай чорний ароматизований З халвою', 'chay-chorniy-aromatizovaniy-z-halvoyu', '<p><span style="color: #888888; font-family: Ubuntu, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 18px;">Чорний чай з насінням соняшника в кольорової глазурі, листом волоського горіха і стевією та ніжним ароматом xалви.</span></p>', '46.00', 4, 31, 1),
(8, 'Чай чорний Іван да Марья', 'chay-chorniy-ivan-da-marya', '<p><span style="color: #888888; font-family: Ubuntu, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 18px;">Купаж чорного чаю і сибірського листового Іван-чаю з шматочками яблук, листям бамбука і волоського горіха, плодами аронії, звіробоєм і ароматом айви.</span></p>', '125.00', 4, 1, 1),
(9, 'Чай чорний Ерл Грей Спеціальний', 'chay-chorniy-erl-grey-specialniy', '<p><span style="color: #888888; font-family: Ubuntu, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 18px;">Суміш цейлонських та індійських чаїв з додаванням пелюсток волошки, цедри апельсина, лимонником, квітками жасмину і оригінальним ароматом бергамоту.</span></p>', '66.00', 4, 3, 1),
(10, 'Чай чорний Святий Валентин', 'chay-chorniy-svyatiy-valentin', '<p><span style="color: #888888; font-family: Ubuntu, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 18px;">Купаж чорного чаю з кокосовою стружкою, шматочками малини і полуниці, цукровими сердечками і ніжним солодким ароматом.</span></p>', '103.00', 4, 4, 1),
(11, 'Чай чорний ароматизований Брусничний', 'chay-chorniy-aromatizovaniy-brusnichniy', '<p><span style="color: #888888; font-family: Ubuntu, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 18px;">Чорний чай з додаванням брусничного листа, сушеної журавлини, шкірки шипшини і медових гранул.</span></p>', '54.00', 4, 1, 1),
(12, 'Чай чорний Наполеон', 'chay-chorniy-napoleon', '<p><span style="color: #888888; font-family: Ubuntu, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 18px;">Купаж чорного чаю з цедрою лимона і приємним ароматом бергамоту.</span></p>', '56.00', 4, 2, 1),
(13, 'Чай чорний Венеціанська ніч', 'chay-chorniy-venecianska-nich', '<p><span style="color: #888888; font-family: Ubuntu, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 18px;">Купаж чорного чаю з гібіскусом, ягодами ожини і червоної смородини, шматочками малини, полуниці і пелюстками піону.</span></p>', '84.00', 4, 8, 1),
(14, 'Чай чорний Полуниця з вершками', 'chay-chorniy-polunicya-z-vershkami', '<p><span style="color: #888888; font-family: Ubuntu, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 18px;">Суміш цейлонських та індійських чаїв з додаванням ягід і листя полуниці і пелюсток сафлору.</span></p>', '61.00', 4, 1, 1),
(15, 'Чай чорний Айва з шерімоєю', 'chay-chorniy-ayva-z-sherimoeyu', '<p><span style="color: #888888; font-family: Ubuntu, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 18px;">Суміш китайських, цейлонських та індійських чаїв з додаванням шматочків абрикоса і ананаса, цедри апельсина, цукатів айви і шеримойї.</span></p>', '69.00', 4, 0, 1),
(16, 'Чай чорний Зоряний дощ', 'chay-chorniy-zoryaniy-dosch', '<p><span style="color: #888888; font-family: Ubuntu, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 18px;">Купаж чорного чаю з пелюстками троянди, соняшника і солодким квітковим ароматом з легкою цитрусовою ноткою.</span></p>', '41.00', 4, 22, 1),
(17, 'Чай чорний З імбиром Східний', 'chay-chorniy-z-imbirom-shidniy', '<p><span style="color: #888888; font-family: Ubuntu, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 18px;">Чорний чай з кардамоном, гвоздикою і шматочками імбиру, цитрусовою кислинкою лимонної трави та медовим присмаком з пряними нотками.</span></p>', '64.00', 4, 3, 1),
(18, 'Чай чорний Алазанська Долина', 'chay-chorniy-alazanska-dolina', '<p><span style="color: #888888; font-family: Ubuntu, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 18px;">Купаж чорного чаю з ягодами смородини, шматочками яблука і трохи терпким ароматом чорної смородини.</span></p>', '53.00', 4, 2, 1),
(19, 'Чай чорний Айва з персиком', 'chay-chorniy-ayva-z-persikom', '<p><span style="color: #888888; font-family: Ubuntu, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 18px;">Суміш китайських, цейлонських та індійських чаїв з додаванням пелюсток апельсина і сафлору, шматочків папайї і манго. Чай ароматизований натуральними маслами айви і папайї.</span></p>', '86.00', 4, 2, 1),
(20, 'Чай зелений Бенгальський Тигр', 'chay-zeleniy-bengalskiy-tigr', '<p><span style="color: #888888; font-family: Ubuntu, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 18px;">Купаж зеленого чаю з шматочками папайї, ананаса, манго, пластівцями моркви, листям полуниці, пелюстками соняшника та сафлору. Сорт вищий.</span></p>', '93.00', 3, 38, 1),
(21, 'Шоу Мей', 'shou-mey', '<p><span style="color: #888888; font-family: Ubuntu, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 18px;">Цей чай вирощується в горах Фуцзянь. Ідеально підходить для тих, хто тільки починає знайомитися з білим чаєм, так як має яскраві смакові нотки і має всі корисні і благородні властивості білого чаю - чудово втамовує спрагу, покращує стан шкіри, зупиняє старіння клітин, сприяє довголіттю.</span></p>', '100.00', 5, 18, 1),
(22, 'Гун Тін Пуер (Імператорський Пуер)', 'gun-tin-puer-imperatorskiy-puer', '<p><span style="color: #888888; font-family: Ubuntu, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 18px;">Листовий шу пуер з провінції Юньнань. Гун Тін пуер виготовляється з невеликих чайних листочків з тіпсами. Настій темного кольору з яскравим смаком з нотками сухофруктів та горіхів, має насичений аромат з відтінком деревної кори.</span></p>', '181.00', 6, 16, 1),
(23, 'Фен Янь (Око Фенікса)', 'fen-yan-oko-feniksa', '<p><span style="color: #888888; font-family: Ubuntu, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 18px;">Чайне листя за формою нагадує око фенікса, звідки і пішла назва цього чаю. При заварюванні дає прозорий настій жовто - зеленого кольору з насиченим, солодким смаком і тривалим післясмаком.</span></p>', '326.00', 7, 51, 1),
(24, 'Молі Хуа Ча (Китайський класичний з жасмином)', 'moli-hua-cha-kitayskiy-klasichniy-z-zhasminom', '<p><span style="color: #888888; font-family: Ubuntu, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 18px;">Традиційний зелений чай з додаванням пелюсток жасмину. При заварюванні виходить світло-жовтий настій з тонким ароматом жасмину і м''яким смаком.</span></p>', '60.00', 7, 11, 1),
(25, 'Молі Та Бай Хоу (Великий білий ворс)', 'moli-ta-bay-hou-velikiy-biliy-vors', '<p><span style="color: #888888; font-family: Ubuntu, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 18px;">Цей чай росте в провінції Фуцзянь. При заварюванні він дає темно-золотистий настій з вишуканим жасминовим ароматом, в якому можна розрізнити і тонкі нотки лілії. Смак чаю дуже ніжний, з довгим, солодким присмаком.</span></p>', '125.00', 7, 2, 1),
(26, 'Лі Чі Хун Ча (Червоний чай з ароматом Лі Чі)', 'li-chi-hun-cha-chervoniy-chay-z-aromatom-li-chi', '<p><span style="color: #888888; font-family: Ubuntu, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 18px;">Чай, вирощений в провінції Юньнань. При заварюванні виходить насичений настій, з яскравим ароматом польових трав, приємною кислинкою плода Лі Чі і солодким медовим присмаком.</span></p>', '81.00', 8, 4, 1),
(27, 'Білий Пуер "Люй Я Бао" (пуерні бруньки)', 'biliy-puer-lyuy-ya-bao-puerni-brunki', '<p><span style="color: #888888; font-family: Ubuntu, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 18px;">Пуерні бруньки збираються з пуерних дерев в провінції Юннань. Настій світлого кольору з ніжним квітково-весняним смаком і тонким ароматом.</span></p>', '219.00', 6, 1, 1),
(28, 'Е-Шен (Дикий зелений пуер)', 'e-shen-dikiy-zeleniy-puer', '<p><span style="color: #888888; font-family: Ubuntu, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 18px;">Шен пуер з вишуканим смаком з нотками сухофруктів і насиченим терпким ароматом з відтінками сушеної груші.</span></p>', '186.00', 6, 22, 1),
(29, 'Червоний молочний чай', 'chervoniy-molochniy-chay', '<p><span style="color: #888888; font-family: Ubuntu, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 18px;">Червоний китайський чай з провінції Юннань має приємний вершково-молочний смак, з ароматом теплого молока та медово-шоколадними нотками. Чудово зігріває організм, покращує травлення, сприяє правильній роботі печінки і нирок, знімає стрес. Можна заварювати декілька раз.</span></p>', '79.00', 8, 6, 1),
(30, 'Червоний чай Юннань', 'chervoniy-chay-yunnan', '<p><span style="color: #888888; font-family: Ubuntu, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 18px;">Цей чай вирощується в провінції Юньнань. Великі темні листя з золотистим відливом дають настій з незвично легким ароматом і спокійним смаком, який завжди дивує тих, хто звик до терпкості або кенійських цейлонських сортів.</span></p>', '57.00', 8, 28, 1),
(31, 'Чай зелений Ганпаудер - Бергамот', 'chay-zeleniy-ganpauder---bergamot', '<p><span style="color: #888888; font-family: Ubuntu, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 18px;">Китайський зелений чай ганпаудер з цедрою лимона, квітками липи і насиченим, яскравим ароматом бергамоту.</span></p>', '47.00', 3, 20, 1),
(32, 'Бай Му Дань (Білий піон)', 'bay-mu-dan-biliy-pion', '<p><span style="color: #888888; font-family: Ubuntu, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 18px;">Білий чай, вирощений в провінції Фуцзянь. Настою притаманний прозорий колір і ніжний, бархатистий смак.</span></p>', '140.00', 5, 17, 1),
(33, 'Бай Хао Інь Чжень (Срібні голки з білими волосками)', 'bay-hao-in-chzhen-sribni-golki-z-bilimi-voloskami', '<p><span style="color: #888888; font-family: Ubuntu, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 18px;">Чай вирощується в провінції Фуцзянь. Настою притаманний світло-золотистий колір, оксамитовий аромат. На смак цей чай нагадує мед.</span></p>', '268.00', 5, 23, 1),
(34, 'Чай зелений Віденський Вальс', 'chay-zeleniy-videnskiy-vals', '<p><span style="color: #888888; font-family: Ubuntu, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 18px;">Легкий літній чай на основі улуна з квітками апельсина, пелюстками волошки, шматочками полуниці та солодким ароматом банана.</span></p>', '57.00', 3, 27, 1),
(35, 'Чай зелений Японська липа', 'chay-zeleniy-yaponska-lipa', '<p><span style="color: #888888; font-family: Ubuntu, Arial, Helvetica, sans-serif; font-size: 13px; line-height: 18px;">Зелений чай Сенча з додаванням квіток липи, суцвіть ромашки і цедри апельсина.</span></p>', '71.00', 3, 8, 1);

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
(2, 'Ihor', 0, 'baka@mail.ua', 'Test!');

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
  `payment_method` varchar(20) CHARACTER SET utf8 NOT NULL,
  `delivery_method` varchar(20) CHARACTER SET utf8 NOT NULL,
  `city` varchar(50) CHARACTER SET utf8 NOT NULL,
  `status` tinyint(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `date`, `name`, `middlename`, `surname`, `phone`, `payment_method`, `delivery_method`, `city`, `status`) VALUES
(2, 1, '2016-08-05 10:55:54', 'Игорь', 'Васильевич', 'Бакал', '501235325', '2', '1', 'Киев', NULL),
(3, 1, '2016-08-05 11:26:05', 'Игорь', 'Васильевич', 'Бакал', '501235325', '1', '2', 'Киев', NULL),
(4, 3, '2016-08-05 12:47:38', 'Адрій', 'Денисович', 'Мацола', '966541242', '1', '2', 'Львів', NULL),
(5, 3, '2016-08-05 12:49:08', 'Адрій', 'Денисович', 'Мацола', '966541242', '2', '1', 'Львів', NULL),
(6, 3, '2016-08-05 12:52:24', 'Адрій', 'Денисович', 'Мацола', '966541242', '1', '3', 'Львів', NULL);

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
(3, 1, 2, 33, 1, '268.00'),
(4, 1, 2, 24, 3, '60.00'),
(5, 1, 3, 5, 1, '120.00'),
(6, 1, 3, 32, 1, '140.00'),
(7, 3, 4, 5, 1, '120.00'),
(8, 3, 4, 32, 2, '140.00'),
(9, 3, 5, 5, 1, '120.00'),
(10, 3, 5, 32, 2, '140.00'),
(11, 3, 6, 6, 2, '208.00');

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
(1, 'about', 'О Нас', 'Товарищи! дальнейшее развитие различных форм деятельности требуют определения и уточнения существенных финансовых и административных условий. Равным образом укрепление и развитие структуры обеспечивает широкому кругу (специалистов) участие в формировании форм развития.\r\n\r\nТаким образом постоянный количественный рост и сфера нашей активности представляет собой интересный эксперимент проверки дальнейших направлений развития. Товарищи! рамки и место обучения кадров позволяет оценить значение дальнейших направлений развития. Товарищи! постоянный количественный рост и сфера нашей активности в значительной степени обуславливает создание модели развития.\r\n\r\nТаким образом дальнейшее развитие различных форм деятельности позволяет оценить значение соответствующий условий активизации. Значимость этих проблем настолько очевидна, что новая модель организационной деятельности играет важную роль в формировании систем массового участия. Повседневная практика показывает, что постоянное информационно-пропагандистское обеспечение нашей деятельности позволяет выполнять важные задания по разработке соответствующий условий активизации. Задача организации, в особенности же постоянное информационно-пропагандистское обеспечение нашей деятельности позволяет оценить значение новых предложений. С другой стороны постоянное информационно-пропагандистское обеспечение нашей деятельности влечет за собой процесс внедрения и модернизации позиций, занимаемых участниками в отношении поставленных задач. Задача организации, в особенности же рамки и место обучения кадров способствует подготовки и реализации дальнейших направлений развития.\r\n\r\nЗадача организации, в особенности же укрепление и развитие структуры способствует подготовки и реализации форм развития. Идейные соображения высшего порядка, а также укрепление и развитие структуры позволяет оценить значение существенных финансовых и административных условий. С другой стороны консультация с широким активом в значительной степени обуславливает создание модели развития.\r\n\r\nТоварищи! постоянное информационно-пропагандистское обеспечение нашей деятельности обеспечивает широкому кругу (специалистов) участие в формировании систем массового участия. Таким образом сложившаяся структура организации влечет за собой процесс внедрения и модернизации модели развития. С другой стороны новая модель организационной деятельности играет важную роль в формировании систем массового участия. Таким образом рамки и место обучения кадров способствует подготовки и реализации форм развития.', 1),
(5, 'dostavka-i-oplata', 'Доставка и оплата', '<p class="text-justify" style="box-sizing: border-box; margin: 0px 0px 10px; text-align: justify; color: #333333; font-family: ''Source Sans Pro''; font-size: 14px; line-height: 20px;">С другой стороны укрепление и развитие структуры в значительной степени обуславливает создание направлений прогрессивного развития. Разнообразный и богатый опыт новая модель организационной деятельности играет важную роль в формировании форм развития. Разнообразный и богатый опыт реализация намеченных плановых заданий играет важную роль в формировании позиций, занимаемых участниками в отношении поставленных задач. Повседневная практика показывает, что укрепление и развитие структуры играет важную роль в формировании форм развития.</p>\r\n<p class="text-justify" style="box-sizing: border-box; margin: 0px 0px 10px; text-align: justify; color: #333333; font-family: ''Source Sans Pro''; font-size: 14px; line-height: 20px;">Задача организации, в особенности же реализация намеченных плановых заданий влечет за собой процесс внедрения и модернизации новых предложений. Задача организации, в особенности же дальнейшее развитие различных форм деятельности играет важную роль в формировании систем массового участия. Равным образом постоянный количественный рост и сфера нашей активности требуют от нас анализа позиций, занимаемых участниками в отношении поставленных задач. Не следует, однако забывать, что рамки и место обучения кадров позволяет оценить значение новых предложений.</p>\r\n<p class="text-justify" style="box-sizing: border-box; margin: 0px 0px 10px; text-align: justify; color: #333333; font-family: ''Source Sans Pro''; font-size: 14px; line-height: 20px;">Повседневная практика показывает, что укрепление и развитие структуры требуют от нас анализа систем массового участия. Не следует, однако забывать, что сложившаяся структура организации в значительной степени обуславливает создание направлений прогрессивного развития. Равным образом реализация намеченных плановых заданий представляет собой интересный эксперимент проверки систем массового участия. Идейные соображения высшего порядка, а также консультация с широким активом представляет собой интересный эксперимент проверки существенных финансовых и административных условий. Идейные соображения высшего порядка, а также укрепление и развитие структуры представляет собой интересный эксперимент проверки систем массового участия.</p>\r\n<p class="text-justify" style="box-sizing: border-box; margin: 0px 0px 10px; text-align: justify; color: #333333; font-family: ''Source Sans Pro''; font-size: 14px; line-height: 20px;">Таким образом постоянное информационно-пропагандистское обеспечение нашей деятельности способствует подготовки и реализации форм развития. Таким образом реализация намеченных плановых заданий способствует подготовки и реализации форм развития. Задача организации, в особенности же сложившаяся структура организации в значительной степени обуславливает создание систем массового участия. Равным образом консультация с широким активом способствует подготовки и реализации соответствующий условий активизации. Идейные соображения высшего порядка, а также укрепление и развитие структуры позволяет оценить значение позиций, занимаемых участниками в отношении поставленных задач. Разнообразный и богатый опыт начало повседневной работы по формированию позиции требуют от нас анализа существенных финансовых и административных условий.</p>\r\n<p class="text-justify" style="box-sizing: border-box; margin: 0px 0px 10px; text-align: justify; color: #333333; font-family: ''Source Sans Pro''; font-size: 14px; line-height: 20px;">Повседневная практика показывает, что начало повседневной работы по формированию позиции в значительной степени обуславливает создание направлений прогрессивного развития. Равным образом дальнейшее развитие различных форм деятельности способствует подготовки и реализации систем массового участия. Значимость этих проблем настолько очевидна, что рамки и место обучения кадров влечет за собой процесс внедрения и модернизации форм развития. Равным образом реализация намеченных плановых заданий обеспечивает широкому кругу (специалистов) участие в формировании дальнейших направлений развития.</p>', 1);

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
  `additionally` varchar(35) NOT NULL,
  `phone` int(45) UNSIGNED NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` varchar(45) NOT NULL DEFAULT 'admin',
  `password` char(32) NOT NULL,
  `is_active` tinyint(1) UNSIGNED DEFAULT '1',
  `email_confirmation` char(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `surname`, `name`, `middlename`, `city`, `street`, `house`, `flat`, `additionally`, `phone`, `email`, `role`, `password`, `is_active`, `email_confirmation`) VALUES
(1, 'admin', 'Бакал', 'Игорь', 'Васильевич', 'Киев', 'Урловская', '17', '50', '', 501235325, 'admin@your-site.com', 'admin', '5a37bc44d6d11dbc47e575b1d8c025e1', 1, NULL),
(2, 'valera', '', 'Тест', '', '', '', '', '', '', 671233412, 'test@test.ru', 'user', '420586a8fdbd0d8cc9e53553b5c6f0c0', 1, NULL),
(3, 'codecat', 'Мацола', 'Адрій', 'Денисович', 'Львів', 'площа Ринок', '26', '15', '', 966541242, 'codecat@gmail.com', 'user', '420586a8fdbd0d8cc9e53553b5c6f0c0', 1, NULL),
(6, 'Button1337', '', 'ihor', '', '', '', '', '', '', 503235621, 'proverka@mail.ua', 'user', '77931e4904f79a8fff0daa0cc30ef2f5', 1, NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`);

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
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
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `pages`
--
ALTER TABLE `pages`
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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT для таблицы `pages`
--
ALTER TABLE `pages`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
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
