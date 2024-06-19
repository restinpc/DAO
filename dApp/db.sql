-- Database dump for /dApp/public_html/engine/nodes/config.php

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `nodestecru`
--

-- --------------------------------------------------------

--
-- Структура таблицы `nodes_access`
--

CREATE TABLE `nodes_access` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `access` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `nodes_access`
--

INSERT INTO `nodes_access` (`id`, `admin_id`, `user_id`, `access`) VALUES
(1, 1, 1, 2),
(2, 2, 1, 2),
(3, 3, 1, 2),
(4, 4, 1, 2),
(5, 5, 1, 2),
(6, 6, 1, 2),
(7, 7, 1, 2),
(8, 8, 1, 2),
(10, 10, 1, 2),
(11, 11, 1, 2),
(12, 12, 1, 2),
(14, 14, 1, 2),
(15, 15, 1, 2),
(16, 16, 1, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `nodes_admin`
--

CREATE TABLE `nodes_admin` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `url` varchar(40) NOT NULL,
  `img` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `nodes_admin`
--

INSERT INTO `nodes_admin` (`id`, `name`, `url`, `img`) VALUES
(1, 'Access', 'access', 'cms/access.jpg'),
(2, 'Pages', 'pages', 'cms/pages.jpg'),
(3, 'Content', 'content', 'cms/content.jpg'),
(4, 'Products', 'products', 'cms/products.jpg'),
(5, 'Users', 'users', 'cms/users.jpg'),
(6, 'Panoramas', 'panoramas', 'cms/cardboard.png'),
(7, 'Finance', 'finance', 'cms/finance.jpg'),
(8, 'Language', 'language', 'cms/language.jpg'),
(10, 'Files', 'files', 'cms/files.jpg'),
(11, 'Config', 'config', 'cms/config.jpg'),
(12, 'Backend', 'backend', 'cms/backend.jpg'),
(14, 'Perfomance', 'perfomance', 'cms/perfomance.jpg'),
(15, 'Outbox', 'outbox', 'cms/outbox.jpg'),
(16, 'Errors', 'errors', 'cms/errors.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `nodes_backend`
--

CREATE TABLE `nodes_backend` (
  `id` int(11) NOT NULL,
  `mode` varchar(400) DEFAULT NULL,
  `file` varchar(400) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `nodes_backend`
--

INSERT INTO `nodes_backend` (`id`, `mode`, `file`) VALUES
(1, '', 'main.php'),
(2, 'admin', 'admin.php'),
(3, 'account', 'account.php'),
(4, 'signup', 'register.php'),
(5, 'login', 'login.php'),
(6, 'content', 'content.php'),
(7, 'product', 'product.php'),
(8, 'search', 'search.php'),
(9, '#', 'profile.php'),
(11, 'webvr', 'webvr.php'),
(12, 'dao', 'dao.php'),
(13, 'social', 'social.php'),
(14, 'developer', 'developer.php'),
(16, 'booking', 'booking.php'),
(18, 'contacts', 'contacts.php');

-- --------------------------------------------------------

--
-- Структура таблицы `nodes_cache`
--

CREATE TABLE `nodes_cache` (
  `id` int(11) NOT NULL,
  `url` varchar(300) NOT NULL,
  `title` varchar(100) NOT NULL DEFAULT '',
  `date` int(11) NOT NULL DEFAULT '0',
  `lang` varchar(3) NOT NULL,
  `interval` int(11) NOT NULL DEFAULT '0',
  `html` longtext NOT NULL,
  `description` varchar(200) NOT NULL DEFAULT '',
  `keywords` varchar(300) NOT NULL DEFAULT '',
  `content` longtext NOT NULL,
  `time` double NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `nodes_catalog`
--

CREATE TABLE `nodes_catalog` (
  `id` int(11) NOT NULL,
  `caption` varchar(400) NOT NULL,
  `description` mediumtext NOT NULL,
  `text` mediumtext NOT NULL,
  `url` varchar(100) NOT NULL,
  `img` varchar(100) NOT NULL,
  `visible` tinyint(1) NOT NULL,
  `lang` varchar(3) NOT NULL,
  `order` int(11) NOT NULL DEFAULT '0',
  `date` int(11) NOT NULL DEFAULT '0',
  `public_date` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `nodes_catalog`
--

INSERT INTO `nodes_catalog` (`id`, `caption`, `description`, `text`, `url`, `img`, `visible`, `lang`, `order`, `date`, `public_date`) VALUES
(15, 'Privacy Policy', '', '<ul><li><a href=\"#1\">Information Collection</a></li><li><a href=\"#2\">Information Usage</a></li><li><a href=\"#3\">Information Protection</a></li><li><a href=\"#4\">Cookie Usage</a></li><li><a href=\"#5\">3rd Party Disclosure</a></li><li><a href=\"#6\">3rd Party Links</a></li><li><a href=\"#7\">CalOPPA</a></li><li><a href=\"#8\">COPPA</a></li><li><a href=\"#9\">Contact Information</a></li></ul><p>&nbsp;</p><p>This privacy policy has been compiled to better serve those who are concerned with how their \'Personally Identifiable Information\' (PII) is being used online. PII, as described in US privacy law and information security, is information that can be used on its own or with other information to identify, contact, or locate a single person, or to identify an individual in context. Please read our privacy policy carefully to get a clear understanding of how we collect, use, protect or otherwise handle your Personally Identifiable Information in accordance with our website.</p><p><br /> <a name=\"1\"></a><strong>What personal information do we collect from the people that visit our website?</strong></p><p>When ordering or registering on our site, as appropriate, you may be asked to enter your name, email address, mailing address or other details to help you with your experience.</p><p><br /> <strong>When do we collect information?</strong></p><p>We collect information from you when you register on our site, place an order, subscribe to a newsletter, respond to a survey, fill out a form, Use Live Chat or enter information on our site.</p><p><br /> <a name=\"2\"></a><strong>How do we use your information?</strong></p><p>We may use the information we collect from you when you register, make a purchase, sign up for our newsletter, respond to a survey or marketing communication, surf the website, or use certain other site features in the following ways:</p><ul><li>To improve our website in order to better serve you.</li><li>To allow us to better service you in responding to your customer service requests</li><li>To administer a contest, promotion, survey or other site feature.</li><li>To quickly process your transactions.</li><li>To ask for ratings and reviews of services or products.</li><li>To follow up with them after correspondence (live chat, email or phone inquiries).</li></ul><p><br /> <a name=\"3\"></a><strong>How do we protect your information?</strong></p><p>Our site is scanned on a regular basis for security holes and known vulnerabilities in order to make your visit to our site as safe as possible. We will never ask for personal or sensitive information such as names, email addresses and credit card numbers from unauthorized users.</p><p><br /> <a name=\"4\"></a><strong>Do we use \'cookies\'?</strong></p><p>Yes. Cookies are small files that a site or its service provider transfers to your computer\'s hard drive through your Web browser (if you allow) that enables the site\'s or service provider\'s systems to recognize your browser and capture and remember certain information. For instance, we use cookies to help us remember and process the items in your shopping cart. They are also used to help us understand your preferences based on previous or current site activity, which enables us to provide you with improved services. We also use cookies to help us compile aggregate data about site traffic and site interaction so that we can offer better site experiences and tools in the future. We use cookies to:</p><ul><li>Help remember and process the items in the shopping cart.</li><li>Understand and save user\'s preferences for future visits.</li></ul><p>You can choose to have your computer warn you each time a cookie is being sent, or you can choose to turn off all cookies. You do this through your browser settings. Since browser is a little different, look at your browser\'s Help Menu to learn the correct way to modify your cookies.</p><p><br /> <strong>If users disable cookies in their browser</strong></p><p>If you turn cookies off, some features will be disabled. Some of the features that make your site experience more efficient and may not function properly. <br /> However, you will still be able to place orders .</p><p><br /> <a name=\"5\"></a><strong>Third-party disclosure</strong></p><p>We do not sell, trade, or otherwise transfer to outside parties your Personally Identifiable Information unless we provide users with advance notice. This does not include website hosting partners and other parties who assist us in operating our website, conducting our business, or serving our users, so long as those parties agree to keep this information confidential. We may also release information when it\'s release is appropriate to comply with the law, enforce our site policies, or protect ours or others\' rights, property or safety. <br /> However, non-personally identifiable visitor information may be provided to other parties for marketing, advertising, or other uses.</p><p><br /> <a name=\"6\"></a><strong>Third-party links</strong></p><p>Occasionally, at our discretion, we may include or offer third-party products or services on our website. These third-party sites have separate and independent privacy policies. We therefore have no responsibility or liability for the content and activities of these linked sites. Nonetheless, we seek to protect the integrity of our site and welcome any feedback about these sites.</p><p><br /> <a name=\"7\"></a><strong>California Online Privacy Protection Act</strong></p><p>CalOPPA is the first state law in the nation to require commercial websites and online services to post a privacy policy. The law\'s reach stretches well beyond California to require any person or company in the United States (and conceivably the world) that operates websites collecting Personally Identifiable Information from California consumers to post a conspicuous privacy policy on its website stating exactly the information being collected and those individuals or companies with whom it is being shared. <br /> According to CalOPPA, we agree to the following:</p><ul><li>Users can visit our site anonymously.</li><li>Once this privacy policy is created, we will add a link to it on our home page or as a minimum, on the first significant page after entering our website.</li><li>Our Privacy Policy link includes the word \'Privacy\' and can easily be found on the page specified above.</li><li>You will be notified of any Privacy Policy changes on our Privacy Policy Page.</li><li>Users can change your personal information by logging in to your account.</li></ul><p><br /> <strong>How does our site handle Do Not Track signals?</strong></p><p>We honor Do Not Track signals and Do Not Track, plant cookies, or use advertising when a Do Not Track (DNT) browser mechanism is in place.</p><p><br /> <strong>Does our site allow third-party behavioral tracking?</strong></p><p>It\'s also important to note that we allow third-party behavioral tracking</p><p><br /> <a name=\"8\"></a><strong>COPPA (Children Online Privacy Protection Act)</strong></p><p>When it comes to the collection of personal information from children under the age of 13 years old, the Children\'s Online Privacy Protection Act (COPPA) puts parents in control. The Federal Trade Commission, United States\' consumer protection agency, enforces the COPPA Rule, which spells out what operators of websites and online services must do to protect children\'s privacy and safety online. <br /> We do not specifically market to children under the age of 13 years old.</p><p><br /> <strong>CAN SPAM Act</strong></p><p>The CAN-SPAM Act is a law that sets the rules for commercial email, establishes requirements for commercial messages, gives recipients the right to have emails stopped from being sent to them, and spells out tough penalties for violations. <br /> To be in accordance with CANSPAM, we agree to the following: <br /> If at any time you would like to unsubscribe from receiving future emails, you can email us at and we will promptly remove you from ALL correspondence.</p><p><br /> <a name=\"9\"></a><strong>Contacting Us</strong></p><p>If there are any questions regarding this privacy policy, you may contact us using the information below.</p>', 'privacy_policy', '', 0, 'en', 0, 1543925624, 1543925624),
(16, 'Terms and Conditions', '', '<p>These Website Standard Terms and Conditions written on this webpage shall manage your use of this website. These Terms will be applied fully and affect to your use of this Website. By using this Website, you agreed to accept all terms and conditions written in here. You must not use this Website if you disagree with any of these Website Standard Terms and Conditions.</p>\r\n<p>Minors or people below 18 years old are not allowed to use this Website.</p>\r\n<ul>\r\n<li><a href=\"#1\">Intellectual Property Rights</a></li>\r\n<li><a href=\"#2\">Restrictions</a></li>\r\n<li><a href=\"#3\">Your Content</a></li>\r\n<li><a href=\"#4\">No warranties</a></li>\r\n<li><a href=\"#5\">Limitation of liability</a></li>\r\n<li><a href=\"#6\">Indemnification</a></li>\r\n<li><a href=\"#7\">Severability</a></li>\r\n<li><a href=\"#8\">Variation of Terms</a></li>\r\n<li><a href=\"#9\">Assignment</a></li>\r\n<li><a href=\"#10\">Entire Agreement</a></li>\r\n<li><a href=\"#11\">Governing Law &amp; Jurisdiction</a></li>\r\n</ul>\r\n<p><br /> <a name=\"1\"></a><strong>Intellectual Property Rights</strong></p>\r\n<p>Other than the content you own, under these Terms, and/or its licensors own all the intellectual property rights and materials contained in this Website. <br /> You are granted limited license only for purposes of viewing the material contained on this Website.</p>\r\n<p><br /> <a name=\"2\"></a><strong>Restrictions</strong></p>\r\n<p>You are specifically restricted from all of the following:</p>\r\n<ul>\r\n<li>Publication of any material from this site in any other media without a direct active hyperlink to the source.</li>\r\n<li>Selling, sublicensing and/or otherwise commercializing any Website material.</li>\r\n<li>Public performance and/or display of material from this site without express reference to the original source.</li>\r\n<li>Using this Website in any way that is or may be damaging to this Website.</li>\r\n<li>Using this Website in any way that impacts user access to this Website.</li>\r\n<li>Using this Website contrary to applicable laws and regulations, or in any way may cause harm to the Website, or to any person or business entity.</li>\r\n<li>Engaging in any data mining, data harvesting, data extracting or any other similar activity in relation to this Website.</li>\r\n<li>Using this Website to engage in any advertising or marketing.</li>\r\n</ul>\r\n<p>Certain areas of this Website are restricted from being access by you and may further restrict access by you to any areas of this Website, at any time, in absolute discretion. Any user ID and password you may have for this Website are confidential and you must maintain confidentiality as well.</p>\r\n<p><br /> <a name=\"3\"></a><strong>Your Content</strong></p>\r\n<p>In these Website Standard Terms and Conditions, &ldquo;Your Content&rdquo; shall mean any audio, video text, images or other material you choose to display on this Website. By displaying Your Content, you grant a non-exclusive, worldwide irrevocable, sub licensable license to use, reproduce, adapt, publish, translate and distribute it in any and all media. <br /> Your Content must be your own and must not be invading any third-party&rsquo;s rights. reserves the right to remove any of Your Content from this Website at any time without notice.</p>\r\n<p><br /> <a name=\"4\"></a><strong>No warranties</strong></p>\r\n<p>This Website is provided &ldquo;as is,&rdquo; with all faults, and express no representations or warranties, of any kind related to this Website or the materials contained on this Website. Also, nothing contained on this Website shall be interpreted as advising you.</p>\r\n<p><br /> <a name=\"5\"></a><strong>Limitation of liability</strong></p>\r\n<p>In no event shall , nor any of its officers, directors and employees, shall be held liable for anything arising out of or in any way connected with your use of this Website whether such liability is under contract. , including its officers, directors and employees shall not be held liable for any indirect, consequential or special liability arising out of or in any way related to your use of this Website.</p>\r\n<p><br /> <a name=\"6\"></a><strong>Indemnification</strong></p>\r\n<p>You hereby indemnify to the fullest extent from and against any and/or all liabilities, costs, demands, causes of action, damages and expenses arising in any way related to your breach of any of the provisions of these Terms.</p>\r\n<p><br /> <a name=\"7\"></a><strong>Severability</strong></p>\r\n<p>If any provision of these Terms is found to be invalid under any applicable law, such provisions shall be deleted without affecting the remaining provisions herein.</p>\r\n<p><br /> <a name=\"8\"></a><strong>Variation of Terms</strong></p>\r\n<p>is permitted to revise these Terms at any time as it sees fit, and by using this Website you are expected to review these Terms on a regular basis.</p>\r\n<p><br /> <a name=\"9\"></a><strong>Assignment</strong></p>\r\n<p>The is allowed to assign, transfer, and subcontract its rights and/or obligations under these Terms without any notification. However, you are not allowed to assign, transfer, or subcontract any of your rights and/or obligations under these Terms.</p>\r\n<p><br /> <a name=\"10\"></a><strong>Entire Agreement</strong></p>\r\n<p>These Terms constitute the entire agreement between and you in relation to your use of this Website, and supersede all prior agreements and understandings.</p>\r\n<p><br /> <a name=\"11\"></a><strong>Governing Law &amp; Jurisdiction</strong></p>\r\n<p>These Terms and Conditions are governed and interpreted in accordance with the legislation of the Russian Federation, and you submit to the non-exclusive jurisdiction of the state and federal courts located in the Russian Federation for the resolution of any disputes.</p>', 'terms_and_conditions', '', 0, 'en', 0, 1543925624, 1543925624),
(26, 'Конфиденциальность', '', '<p>Эта политика конфиденциальности составлена с целью более эффективного предоставления информации тем, кто обеспокоен использованием их \"лично идентифицируемой информации\" в Интернете.&nbsp;Личной, является информацией, которая может быть использована самостоятельно или совместно с другой информацией для идентификации, связи или определения местонахождения отдельного лица, или для идентификации личности в контексте. Пожалуйста, внимательно прочитайте нашу политику конфиденциальности, чтобы четко понять, как мы собираем, используем, защищаем или иным образом обрабатываем вашу личную информацию.</p>\r\n<ul>\r\n<li><a href=\"#1\">Сбор информации</a></li>\r\n<li><a href=\"#2\">Использование информации</a></li>\r\n<li><a href=\"#3\">Защита информации</a></li>\r\n<li><a href=\"#4\">Использование cookie</a></li>\r\n<li><a href=\"#5\">Раскрытие третьим сторонам</a></li>\r\n<li><a href=\"#6\">Ссылки на сторонние ресурсы</a></li>\r\n<li><a href=\"#7\">CalOPPA&nbsp;</a></li>\r\n<li><a href=\"#8\">COPPA</a></li>\r\n<li><a href=\"#9\">Контактная информация<br /><br /></a></li>\r\n</ul>\r\n<h2>Сбор информации</h2>\r\n<p><a name=\"1\"></a></p>\r\n<p>При регистрации на нашем сайте мы запрашиваем имя, адрес электронной почты, почтовый адрес или другие данные, которые помогут вам в использовании нашего сервиса. Мы собираем информацию у вас при регистрации на нашем сайте, оформлении заказа, подписке на новостную рассылку, ответе на опрос, заполнении формы, использовании онлайн-чата или иной форме вводе информации на нашем сайте.<br /><br /></p>\r\n<h2>Использование информации</h2>\r\n<p><a name=\"2\"></a></p>\r\n<p>Мы можем использовать информацию, которую мы собираем у вас при регистрации, совершении покупки, подписке на нашу рассылку, ответе на опрос или маркетинговое общение, просмотре веб-сайта или использовании определенных функций сайта следующим образом:</p>\r\n<ul>\r\n<li>Для улучшения нашего веб-сайта с целью более качественного обслуживания вас.</li>\r\n<li>Для возможности более качественного отклика на ваши запросы в области обслуживания клиентов.</li>\r\n<li>Для проведения конкурсов, акций, опросов или других функций сайта.</li>\r\n<li>Для быстрой обработки ваших транзакций.</li>\r\n<li>Для просьбы оценить и оставить отзывы о услугах или продукции.</li>\r\n<li>Для контакта с вами после переписки (через онлайн-чат, электронную почту или телефонные запросы).<br /><br /></li>\r\n</ul>\r\n<h2>Защита информации</h2>\r\n<p><a name=\"2\"></a></p>\r\n<p>Наш сайт регулярно сканируется на наличие уязвимостей и известных уязвимостей в целях обеспечения максимальной безопасности вашего посещения. Мы никогда не будем запрашивать личную или конфиденциальную информацию, такую как имена, адреса электронной почты и номера кредитных карт, у неавторизованных пользователей.<br /><br /></p>\r\n<h2>Использование cookie</h2>\r\n<p><a name=\"4\"></a></p>\r\n<p>Да. Куки (cookies) - это небольшие файлы, которые сайт или поставщик услуг передает на жесткий диск вашего компьютера через веб-браузер (если вы разрешаете), что позволяет системам сайта или поставщика услуг распознавать ваш браузер и запоминать определенную информацию. Например, мы используем куки, чтобы помочь нам запоминать и обрабатывать товары в вашей корзине покупок. Они также используются для понимания ваших предпочтений на основе предыдущей или текущей активности на сайте, что позволяет нам предоставлять улучшенные услуги. Мы также используем куки, чтобы получить агрегированные данные о трафике на сайте и взаимодействии с сайтом, чтобы в будущем предложить лучшие пользовательские впечатления и инструменты на сайте. Мы используем куки для:</p>\r\n<ul>\r\n<li>Помощи в запоминании и обработке товаров в корзине покупок.</li>\r\n<li>Понимания и сохранения пользовательских предпочтений для последующих посещений.</li>\r\n</ul>\r\n<p>Вы можете выбрать опцию предупреждения вашего компьютера каждый раз, когда куки отправляются, или отключить все куки. Вы можете сделать это через настройки вашего браузера. Поскольку каждый браузер немного отличается, обратитесь к Руководству пользователя вашего браузера, чтобы узнать правильный способ изменения настроек куки<br /><br /></p>\r\n<h2>Раскрытие третьим лицам</h2>\r\n<p><a name=\"5\"></a></p>\r\n<p>Мы не продаем, не обмениваем и не передаем личную информацию третьим лицам без предварительного уведомления пользователей. Это не относится к партнерам по хостингу веб-сайта и другим сторонам, которые помогают нам в работе нашего веб-сайта, ведении бизнеса или обслуживании пользователей, при условии, что эти стороны согласны сохранять эту информацию конфиденциальной. Мы также можем раскрывать информацию, если ее раскрытие необходимо в соответствии с законом, для обеспечения соблюдения политики нашего сайта или защиты наших или чужих прав, собственности или безопасности. Однако информация, не позволяющая идентифицировать посетителя лично, может быть предоставлена другим сторонам для маркетинга, рекламы или других целей.<br /><br /></p>\r\n<h2>Ссылки на сторонние ресурсы</h2>\r\n<p><a name=\"6\"></a></p>\r\n<p>Иногда по нашему усмотрению мы можем включать или предлагать нашему сайту продукты или услуги третьих лиц. У этих сторон есть отдельные и независимые политики конфиденциальности. Поэтому мы не несем ответственности за содержание и деятельность этих связанных сайтов. Тем не менее, мы стремимся защитить целостность нашего сайта и приветствуем любую обратную связь о этих ресурсах.<br />&nbsp;</p>\r\n<h2>Защита онлайн-приватности (CalOPPA)</h2>\r\n<p><a name=\"7\"></a></p>\r\n<p>Согласно CalOPPA, мы соглашаемся с следующим:</p>\r\n<p>Пользователи могут посещать наш сайт анонимно. После создания этой политики конфиденциальности мы добавим ссылку на нее на главной странице нашего сайта или, как минимум, на первой значимой странице после входа на наш веб-сайт. Ссылка на нашу политику конфиденциальности содержит слово \"Конфиденциальность\" и может быть легко найдена на указанной выше странице. Вы будете уведомлены об изменениях в политике конфиденциальности на нашей странице политики конфиденциальности. Пользователи могут изменить свою личную информацию, войдя в свою учетную запись. Также важно отметить, что мы разрешаем отслеживание поведения третьими лицами.<br /><br /></p>\r\n<h2>Защита онлайн-приватности детей (COPPA)</h2>\r\n<p><a name=\"8\"></a></p>\r\n<p>Когда речь идет о сборе личной информации детей в возрасте до 13 лет, Закон о защите онлайн-приватности детей (COPPA) предоставляет родителям контроль. Федеральная торговая комиссия, агентство по защите прав потребителей Соединенных Штатов, осуществляет контроль за соблюдением правил COPPA, которые определяют, что операторы веб-сайтов и онлайн-сервисов должны делать для защиты конфиденциальности и безопасности детей в Интернете. Мы не нацелены специально на детей в возрасте до 13 лет.<br /><br /></p>\r\n<h2>Контактная информация</h2>\r\n<p><a name=\"9\"></a></p>\r\n<p>Если у вас есть какие-либо вопросы относительно этой политики конфиденциальности, вы можете связаться с нами по электронной почте <a href=\"mailto:developing@nodes-tech.ru\" target=\"_blank\" rel=\"noopener\">developing@nodes-tech.ru</a></p>', 'privacy_policy', '', 0, 'ru', 0, 1688645109, 1688645109),
(27, 'Правила и условия', '', '<p>Эти Правила и условия сайта регулируют правовую составляющую использования этого программного продукта. Используя этот сайт, вы соглашаетесь принять все условия и положения, указанные здесь. Если вы не согласны с любым из этих Стандартных условий и положений сайта, вы не должны использовать этот сайт.</p>\r\n<p>Лицам, не достигшим 18-летнего возраста или несовершеннолетним, запрещено использовать этот сайт.</p>\r\n<ul>\r\n<li><a href=\"#1\">Интеллектуальная собственность</a></li>\r\n<li><a href=\"#2\">Ограничения</a></li>\r\n<li><a href=\"#3\">Ваш контент</a></li>\r\n<li><a href=\"#4\">Отказ от гарантий</a></li>\r\n<li><a href=\"#5\">Ограничение ответственности</a></li>\r\n<li><a href=\"#6\">Возмещение ущерба</a></li>\r\n<li><a href=\"#7\">Раздельность условий</a></li>\r\n<li><a href=\"#8\">Изменение условий</a></li>\r\n<li><a href=\"#9\">Передача прав</a></li>\r\n<li><a href=\"#10\">Полное соглашение</a></li>\r\n<li><a href=\"#11\">Применимое право и юрисдикция</a></li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<h2>Интеллектуальная собственность</h2>\r\n<h2><a name=\"1\"></a></h2>\r\n<p>За исключением контента, принадлежащего вам, согласно этим Условиям и/или его лицензиары владеют всеми правами интеллектуальной собственности и материалами, содержащимися на этом сайте. Вам предоставляется ограниченная лицензия только в целях просмотра материала, содержащегося на этом сайте.</p>\r\n<p>&nbsp;</p>\r\n<h2>Ограничения</h2>\r\n<p><a name=\"2\"></a></p>\r\n<p>Вам категорически запрещено делать следующее:</p>\r\n<ul>\r\n<li>Публикация любого материала с этого сайта в любых других СМИ без прямой активной гиперссылки на источник.</li>\r\n<li>Продажа, сублицензирование и/или коммерциализация любого материала с этого сайта.</li>\r\n<li>Публичное исполнение и/или показ материала с этого сайта без выраженной ссылки на первоисточник.</li>\r\n<li>Использование этого сайта таким образом, который может нанести ущерб этому сайту.</li>\r\n<li>Использование этого сайта таким образом, который влияет на доступ пользователей к этому сайту.</li>\r\n<li>Использование этого сайта вопреки применимым законам и правилам или каким-либо образом может нанести вред сайту, любому человеку или бизнес-структуре.</li>\r\n<li>Проведение любой добычи данных, сбора данных, извлечения данных или любой другой аналогичной деятельности в отношении этого сайта. Использование этого сайта для проведения рекламной или маркетинговой деятельности.</li>\r\n</ul>\r\n<p>Некоторые разделы этого сайта ограничены для вас и могут быть дополнительно ограничены вашим доступом к любым разделам этого сайта в любое время по нашему абсолютному усмотрению. Любой идентификатор пользователя и пароль, которые у вас есть для этого сайта, являются конфиденциальными, и вы также должны сохранять их конфиденциальность.<br /><br /></p>\r\n<h2>Ваш контент</h2>\r\n<p><a name=\"3\"></a></p>\r\n<p>В этих Стандартных условиях и положениях сайта \"Ваш контент\" означает любой аудио-, видео-, текстовый, графический или другой материал, который вы выбираете для отображения на этом веб-сайте. Отображая свой контент, вы предоставляете неисключительную, международную, безотзывную, сублицензируемую лицензию на использование, воспроизведение, адаптацию, публикацию, перевод и распространение его в любых и всех средствах.</p>\r\n<p>Ваш контент должен быть вашим собственным и не должен нарушать права третьих лиц. оставляет за собой право в любое время и без предварительного уведомления удалить любой из вашего контента с этого веб-сайта.<br /><br /></p>\r\n<h2>Отказ от гарантий</h2>\r\n<p><a name=\"4\"></a></p>\r\n<p>Этот веб-сайт предоставляется \"как есть\", со всеми его недостатками, и не делает никаких представлений или гарантий, каких бы то ни было, относящихся к этому веб-сайту или материалам, содержащимся на этом веб-сайте. Кроме того, ничто, содержащееся на этом веб-сайте, не должно рассматриваться как совет.<br /><br /></p>\r\n<h2>Ограничение ответственности</h2>\r\n<p><a name=\"5\"></a></p>\r\n<p>В никаком случае , как и его офицеры, директоры и сотрудники, не несут ответственности за что-либо, возникающее из или связанное с вашим использованием этого веб-сайта, независимо от того, основывается ли такая ответственность на контракте. , включая его офицеров, директоров и сотрудников, не несет ответственности за любую косвенную, последующую или особую ответственность, возникшую из или связанную с вашим использованием этого веб-сайта.<br /><br /></p>\r\n<h2>Возмещение ущерба</h2>\r\n<p><a name=\"6\"></a></p>\r\n<p>Вы полностью возмещаете все расходы и/или все обязательства, требования, причины действий, ущерб и расходы, возникшие в любом отношении, связанном с нарушением вами любых положений настоящих условий.<br /><br /></p>\r\n<h2>Разделимость условий</h2>\r\n<p><a name=\"7\"></a></p>\r\n<p>Если какое-либо положение настоящих Условий будет признано недействительным в соответствии с применимым законодательством, такие положения будут удалены без воздействия на оставшиеся положения настоящего документа.<br /><br /></p>\r\n<h2>Изменение условий</h2>\r\n<p><a name=\"8\"></a></p>\r\n<p>имеет право в любое время изменять настоящие Условия по своему усмотрению, и используя этот Веб-сайт, вы обязаны периодически ознакамливаться с настоящими Условиями.<br /><br /></p>\r\n<h2>Переуступка</h2>\r\n<p><a name=\"9\"></a></p>\r\n<p>имеет право передать, перевести или подрядить свои права и/или обязательства по настоящим Условиям без уведомления. Однако вам запрещается передавать, переводить или подрядывать любые из ваших прав и/или обязательств по настоящим Условиям.<br /><br /></p>\r\n<h2>Полное соглашение</h2>\r\n<p><a name=\"10\"></a></p>\r\n<p>Настоящие Условия составляют полное соглашение между и вас относительно использования данного Веб-сайта и заменяют все предыдущие соглашения и понимание.<br /><br /></p>\r\n<h2>Применимое право и юрисдикция</h2>\r\n<p><a name=\"11\"></a></p>\r\n<p>Настоящие Условия регулируются и толкуются в соответствии с законодательством РФ, и вы подчиняетесь неисключительной юрисдикции государственных и федеральных судов, расположенных в РФ, для разрешения любых споров.</p>', 'terms_and_conditions', '', 0, 'ru', 0, 1688645136, 1688645136),
(28, '隱私政策', '', '<p>这个隐私政策的目的是更有效地向那些担心他们在互联网上使用他们的\"可识别个人信息\"的人提供信息。个人信息是指可以单独或与其他信息结合使用以识别、联系或确定个人位置，或在特定背景下识别个人身份的信息。请仔细阅读我们的隐私政策，以清楚了解我们如何收集、使用、保护或以其他方式处理您的个人信息。</p>\r\n<ul>\r\n<li><a href=\"#1\">信息收集</a></li>\r\n<li><a href=\"#2\">信息使用</a></li>\r\n<li><a href=\"#3\">信息保护</a></li>\r\n<li><a href=\"#4\">Cookie 使用</a></li>\r\n<li><a href=\"#5\">向第三方公开披露</a></li>\r\n<li><a href=\"#6\">引用第三方资源</a></li>\r\n<li><a href=\"#7\">CalOPPA 法案</a></li>\r\n<li><a href=\"#8\">COPPA 法案</a></li>\r\n<li><a href=\"#9\">联络信息</a><br /><br /></li>\r\n</ul>\r\n<h2>信息收集</h2>\r\n<p><a name=\"1\"></a></p>\r\n<p>当您在我们的网站注册时，我们会要求您提供姓名、电子邮件地址、邮寄地址或其他能够帮助您使用我们服务的数据。我们会在您注册我们的网站、下订单、订阅新闻通讯、回答调查、填写表格、使用在线聊天或在我们的网站上输入信息的过程中收集您的信息。<br /><br /></p>\r\n<h2>信息使用</h2>\r\n<p><a name=\"2\"></a></p>\r\n<p>我们可能会使用我们从您那里收集到的信息进行以下操作：</p>\r\n<ul>\r\n<li>为了改善我们的网站，以提供更高质量的服务；</li>\r\n<li>为了更好地响应您在客户服务方面的请求；</li>\r\n<li>为了举办比赛、促销活动、调查或其他网站功能；</li>\r\n<li>快速处理您的交易；</li>\r\n<li>要求您评估并留下有关服务或产品的评论；</li>\r\n<li>在与您通信后与您联系（通过在线聊天、电子邮件或电&nbsp;<br /><br /></li>\r\n</ul>\r\n<h2>信息保护</h2>\r\n<p><a name=\"3\"></a></p>\r\n<p>我们定期扫描我们的网站，以确保您访问的最大安全性，以查找漏洞和已知的漏洞。我们绝不会要求未经授权的用户提供个人或机密信息，如姓名、电子邮件地址和信用卡号码。<br /><br /></p>\r\n<h2>使用Cookie</h2>\r\n<p><a name=\"4\"></a></p>\r\n<p>是的。Cookie是小文件，通过网络浏览器传递到您计算机的硬盘上的网站或服务提供商。这允许网站系统或服务提供商识别您的浏览器并记住特定信息。例如，我们使用Cookie来帮助我们记住和处理您购物车中的商品。它们还用于根据您在网站上的先前或当前活动了解您的偏好，从而为您提供改进的服务。我们还使用Cookie来获取关于网站流量和与网站的互动的聚合数据，以便将来提供更好的用户体验和工具。我们使用Cookie来：</p>\r\n<p>帮助记住和处理购物车中的商品。 理解和保存用户的首选项以供后续访问。 您可以选择在每次发送Cookie时都提示您的计算机，或者禁用所有Cookie。您可以通过浏览器设置进行此操作。由于每个浏览器略有不同，请参阅您浏览器的用户指南以获得正确更改Cookie设置的方法。<br /><br /></p>\r\n<h2>向第三方披露</h2>\r\n<p><a name=\"5\"></a></p>\r\n<p>我们不会在未事先通知用户的情况下出售、交换或转让个人信息给第三方。这不适用于我们网站托管合作伙伴和其他帮助我们经营网站、开展业务或为用户提供服务的方，只要这些方同意将此信息保密。我们还可能在法律要求、遵守我们网站政策或保护我们或他人的权利、财产或安全所必需的情况下披露信息。然而，不能识别访问者个人身份的信息可能会提供给其他方用于营销、广告或其他目的<br /><br /></p>\r\n<h2>第三方资源链接</h2>\r\n<p><a name=\"6\"></a></p>\r\n<div class=\"flex items-end gap-1 mt-2 flex-row\">\r\n<div class=\"text-black text-wrap min-w-[20px] rounded-md p-3 bg-[#f4f6f8] dark:bg-[#1e1e20]\">\r\n<div class=\"leading-relaxed break-words\">\r\n<div class=\"markdown-body\">\r\n<p>根据我们的判断，我们有时会在我们的网站上包含或提供第三方的产品或服务。这些第三方拥有独立的隐私政策。因此，我们对这些关联网站的内容和活动不承担责任。但是，我们致力于保护我们网站的完整性，并欢迎任何有关这些资源的反馈。<br /><br /></p>\r\n<h2>在线隐私保护（CalOPPA）</h2>\r\n<p><a name=\"7\"></a></p>\r\n<p>根据CalOPPA，我们同意以下内容：</p>\r\n<p>用户可以匿名访问我们的网站。在创建隐私政策后，我们将在我们网站的主页上或至少在登录我们网站后的第一个重要页面上添加该隐私政策的链接。我们的隐私政策链接包含 \"隐私\" 一词，并且可以在上述指定页面上轻松找到。我们会在我们的隐私政策页面上通知您有关隐私政策的变更。用户可以通过登录他们的帐户来更改他们的个人信息。还值得注意的是，我们允许第三方进行行为跟踪。<br /><br /></p>\r\n<h2>儿童在线隐私保护（COPPA）</h2>\r\n<p><a name=\"8\"></a></p>\r\n<p>当涉及到收集13岁以下儿童的个人信息时，儿童在线隐私保护法（COPPA）赋予父母控制权。美国联邦贸易委员会，即美国消费者保护机构，负责监督COPPA规则的执行，这些规则规定网站运营商和在线服务提供商必须采取措施保护儿童在互联网上的隐私和安全。我们并不专门面向13岁以下儿童。<br /><br /></p>\r\n<h2>联系方式</h2>\r\n<p><a name=\"9\"></a></p>\r\n<p>如果您对本隐私政策有任何疑问，请通过电子邮件与我们联系&nbsp;<a href=\"mailto:developing@nodes-tech.ru\">developing@nodes-tech.ru</a></p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>', 'privacy_policy', '', 0, 'zh', 0, 1688645136, 1688645136),
(29, '條款和條件', '', '<p>条款和条件 这些网站标准条款和条件是在此网页上编写的，将管理您对本网站的使用。这些条款将完全适用并影响您对本网站的使用。通过使用本网站，您同意接受此处所写的所有条款和条件。如果您不同意这些网站标准条款和条件中的任何内容，则不得使用本网站。</p>\r\n<p>未成年人或18岁以下的人不得使用本网站。</p>\r\n<ul>\r\n<li><a href=\"#1\">知识产权</a></li>\r\n<li><a href=\"#2\">限制</a></li>\r\n<li><a href=\"#3\">您的内容</a></li>\r\n<li><a href=\"#4\">无保证</a></li>\r\n<li><a href=\"#5\">责任限制</a></li>\r\n<li><a href=\"#6\">赔偿</a></li>\r\n<li><a href=\"#7\">可分割性</a></li>\r\n<li><a href=\"#8\">条款变更</a></li>\r\n<li><a href=\"#9\">转让</a></li>\r\n<li><a href=\"#10\">完整协议</a></li>\r\n<li><a href=\"#11\">法律管辖<br /><br /></a></li>\r\n</ul>\r\n<p>知识产权<a name=\"1\"></a></p>\r\n<p>除了您拥有的内容外，在这些条款下，以及/或其许可方拥有本网站中包含的所有知识产权和材料。 您仅被授予有限许可，仅用于查看本网站上包含的材料。<br /><br /></p>\r\n<p>限制<a name=\"2\"></a></p>\r\n<p>您明确受到以下所有限制的约束：</p>\r\n<ul>\r\n<li>未经直接活动超链接到来源的许可，禁止在任何其他媒体上发布本网站的任何材料。</li>\r\n<li>禁止销售、再许可和/或以任何方式商业化任何网站材料。</li>\r\n<li>未经明确引用原始来源，禁止公开展示本网站的材料。</li>\r\n<li>以可能对本网站造成损害的任何方式使用本网站。</li>\r\n<li>以可能影响用户访问本网站的任何方式使用本网站。</li>\r\n<li>违反适用法律和法规，或以任何方式对本网站、任何个人或商业实体造成损害。</li>\r\n<li>在与本网站相关的任何数据挖掘、数据收集、数据提取或任何其他类似活动中使用本网站。</li>\r\n<li>使用本网站进行任何广告或营销活动。</li>\r\n</ul>\r\n<p>本网站的某些区域受到限制，您可能无法访问这些区域，而且我们保留随时自行决定限制您对本网站任何区域的访问权限的权利。您可能拥有的任何用户ID和密码都是机密的，您必须保持机密性。<br /><br /></p>\r\n<p>您的内容<a name=\"3\"></a></p>\r\n<p>在这些网站标准条款和条件中，&ldquo;您的内容&rdquo;指的是您选择在本网站上显示的任何音频、视频、文本、图像或其他材料。通过显示您的内容，您授予非独占性、全球不可撤销、可转让的许可证，在任何媒体上使用、复制、改编、发布、翻译和分发您的内容。 您的内容必须是您自己的，并且不得侵犯任何第三方的权利。保留随时在未经通知的情况下从本网站删除您的任何内容的权利。<br /><br /></p>\r\n<p>无担保<a name=\"4\"></a></p>\r\n<p>本网站按&ldquo;原样&rdquo;提供，不提供任何明示或暗示的陈述或保证，与本网站或本网站上包含的材料有关的任何种类的保证均不提供。此外，本网站上的任何内容都不应被解释为向您提供建议。<br /><br /></p>\r\n<p>责任限制<a name=\"5\"></a></p>\r\n<p>在任何情况下，无论是根据合同还是其他方式，对于因您使用本网站而产生的任何事项，包括其官员、董事和雇员，均不承担任何责任。对于因您使用本网站而产生的任何间接、后果性或特殊责任，包括其官员、董事和雇员，均不承担任何责任。<br /><br /></p>\r\n<p>赔偿<a name=\"6\"></a></p>\r\n<p>您在此对因您违反本条款的任何规定而产生的任何及/或所有责任、费用、要求、诉因、损害和费用进行最充分的赔偿，这些赔偿与您违反本条款的任何规定有关。<br /><br /></p>\r\n<p>可分割性<a name=\"7\"></a></p>\r\n<p>如果根据任何适用法律发现本条款的任何规定无效，则应删除该等规定，但不影响本条款中的其他规定。<br /><br /></p>\r\n<p>条款的变更<a name=\"8\"></a></p>\r\n<p>有权随时根据其认为合适的方式修订本条款，并且通过使用本网站，您应定期审查这些条款。<br /><br /></p>\r\n<p>转让<a name=\"9\"></a></p>\r\n<p>允许转让、转让和分包其在本条款下的权利和/或义务，而无需任何通知。但是，您不得转让、转让或分包您在本条款下的任何权利和/或义务。<br /><br /></p>\r\n<p>完整协议<a name=\"10\"></a></p>\r\n<p>本条款构成您与之间关于您使用本网站的协议，并取代所有先前的协议和理解。<br /><br /></p>\r\n<p>管辖法律和司法管辖权<a name=\"11\"></a></p>\r\n<p>真实条件受俄罗斯法律的调整和解释，并且您服从位于俄罗斯的国家和联邦法院的非排他性司法管辖权，以解决任何争议。</p>', 'terms_and_conditions', '', 0, 'zh', 0, 1688645136, 1688645136);

-- --------------------------------------------------------

--
-- Структура таблицы `nodes_comment`
--

CREATE TABLE `nodes_comment` (
  `id` int(11) NOT NULL,
  `url` varchar(100) NOT NULL,
  `reply` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `text` text NOT NULL,
  `date` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `nodes_config`
--

CREATE TABLE `nodes_config` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `value` text NOT NULL,
  `text` varchar(100) NOT NULL,
  `type` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `nodes_config`
--

INSERT INTO `nodes_config` (`id`, `name`, `value`, `text`, `type`) VALUES
(1, 'name', 'DAO Mansion', 'Site name', 'string'),
(2, 'description', 'Incorporating the concept of Web 3.0 information society, the DAO aims to create a progressive and sustainable community that combines ecological, social, and economic benefits.', 'Description', 'string'),
(3, 'email', 'developing@nodes-tech.ru', 'Site email', 'string'),
(4, 'language', 'ru', 'Site language', 'string'),
(5, 'languages', 'en;ru;zh', 'Available languages', 'string'),
(6, 'image', 'https://nodes-tech.ru/img/preview.jpg', 'Site image', 'string'),
(7, 'email_image', 'https://nodes-tech.ru/img/preview.jpg', 'Email header image', 'string'),
(8, 'invoice_image', 'https://nodes-tech.ru/img/preview.jpg', 'Invoice logo image', 'string'),
(9, 'git', 'http://dao.nodes-tech.ru:3000/restinpc/DAO', 'Git repository url', 'string'),
(10, 'template', 'bootstrap', 'Template', 'string'),
(11, 'default', 'profile.php', 'System', 'string'),
(12, 'debug', '0', 'Debug mode', 'bool'),
(13, 'cron', '0', 'jQuery cron', 'bool'),
(14, 'cache', '1', 'Allow cache', 'bool'),
(15, 'compress', '1', 'Compress HTML', 'bool'),
(16, 'sandbox', '1', 'Sandbox payment mode', 'bool'),
(20, 'free_message', '0', 'Messages between users', 'bool'),
(21, 'daily_report', '1', 'Daily report to email', 'bool'),
(22, 'confirm_signup_email', '0', 'Email confirmation while sign up', 'bool'),
(23, 'send_comments_email', '1', 'Email admin on comment', 'bool'),
(24, 'send_registration_email', '1', 'Email user on sign up', 'bool'),
(25, 'send_message_email', '1', 'Email user on message', 'bool'),
(26, 'send_paypal_email', '1', 'Email user on payment', 'bool'),
(30, 'yandex_money', '', '<a href=\"https://money.yandex.ru/\" target=\"_blank\">Yandex Money ID</a>', 'string'),
(31, 'paypal_test', '1', 'PayPal test mode', 'bool'),
(32, 'paypal_id', '', '<a href=\"https://www.paypal.com/\" target=\"_blank\">PayPal user ID</a>', 'string'),
(33, 'payment_description', '', 'Payment description', 'string'),
(51, 'outbox_limit', '1', 'Max outbox  minute', 'int'),
(52, 'version', '8', 'System', 'int'),
(55, 'cron_images', '1703692501', 'System', 'int'),
(56, 'cron_exec', '1703700721', 'System', 'int'),
(57, 'cron_done', '1703700721', 'System', 'int'),
(58, 'lastreport', '1703631602', 'System', 'int');

-- --------------------------------------------------------

--
-- Структура таблицы `nodes_content`
--

CREATE TABLE `nodes_content` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL DEFAULT '0',
  `url` varchar(100) NOT NULL,
  `lang` varchar(3) NOT NULL,
  `order` int(11) NOT NULL DEFAULT '0',
  `caption` varchar(400) NOT NULL,
  `text` text NOT NULL,
  `img` varchar(100) NOT NULL,
  `date` int(11) NOT NULL DEFAULT '0',
  `public_date` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `nodes_error`
--

CREATE TABLE `nodes_error` (
  `id` int(11) NOT NULL,
  `url` varchar(400) NOT NULL,
  `lang` varchar(3) NOT NULL,
  `date` int(11) NOT NULL DEFAULT '0',
  `ip` varchar(20) NOT NULL,
  `get` text NOT NULL,
  `post` text NOT NULL,
  `session` text NOT NULL,
  `count` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `nodes_firebase`
--

CREATE TABLE `nodes_firebase` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `token` varchar(400) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `nodes_inbox`
--

CREATE TABLE `nodes_inbox` (
  `id` int(11) NOT NULL,
  `from` int(11) NOT NULL DEFAULT '0',
  `to` int(11) NOT NULL DEFAULT '0',
  `text` text NOT NULL,
  `date` int(11) NOT NULL DEFAULT '0',
  `readed` int(11) NOT NULL DEFAULT '0',
  `inform` tinyint(1) NOT NULL,
  `system` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `nodes_invoice`
--

CREATE TABLE `nodes_invoice` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `order_id` int(11) NOT NULL DEFAULT '0',
  `amount` double NOT NULL,
  `date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `nodes_language`
--

CREATE TABLE `nodes_language` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `lang` varchar(3) NOT NULL,
  `value` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `nodes_language`
--

INSERT INTO `nodes_language` (`id`, `name`, `lang`, `value`) VALUES
(1, 'Upload', 'en', 'Upload'),
(2, 'Link', 'en', 'Link'),
(3, 'Cancel', 'en', 'Cancel'),
(4, 'Uploaded', 'en', 'Uploaded'),
(5, 'For uploading selected area use double click', 'en', 'For uploading selected area use double click'),
(6, 'Error', 'en', 'Error'),
(7, 'Or file', 'en', 'Or file'),
(8, 'Upload image', 'en', 'Upload image'),
(9, 'Received', 'ru', 'Получено'),
(10, 'Sitemap', 'en', 'Sitemap'),
(11, 'Format', 'en', 'Format'),
(12, 'Upload new image', 'en', 'Upload new image'),
(13, 'Logout sucsessful', 'en', 'Logout sucsessful'),
(14, 'Quit', 'en', 'Quit'),
(15, 'Site', 'en', 'Site'),
(16, 'Users', 'en', 'Users'),
(17, 'Comments', 'en', 'Comments'),
(18, 'Content', 'en', 'Content'),
(19, 'Errors', 'en', 'Errors'),
(20, 'Files', 'en', 'Files'),
(21, 'Images', 'en', 'Images'),
(22, 'Videos', 'en', 'Videos'),
(23, 'Access', 'en', 'Access'),
(24, 'Config', 'en', 'Config'),
(25, 'Backend', 'en', 'Backend'),
(26, 'Logout', 'en', 'Logout'),
(27, 'new messages', 'ru', 'новые сообщения'),
(28, 'Password', 'en', 'Password'),
(29, 'Upload selection as thumb?', 'en', 'Upload selection as thumb?'),
(30, 'Save uploaded images', 'en', 'Save uploaded images'),
(31, 'Previous page', 'en', 'Previous page'),
(32, 'Next page', 'en', 'Next page'),
(33, 'Updated', 'en', 'Updated'),
(34, 'Interval', 'en', 'Interval'),
(35, 'Not existing', 'en', 'Not existing'),
(36, 'Not cathing', 'en', 'Not cathing'),
(37, 'Not refreshing', 'en', 'Not refreshing'),
(38, 'minut', 'en', 'minut'),
(39, 'minuts', 'en', 'minuts'),
(40, 'hour', 'en', 'hour'),
(41, 'hours', 'en', 'hours'),
(42, 'Dayly', 'en', 'Dayly'),
(43, 'Change interval', 'en', 'Change interval'),
(44, 'Refresh catch', 'en', 'Refresh catch'),
(45, 'Edit article', 'en', 'Edit article'),
(46, 'Caption', 'en', 'Caption'),
(47, 'No image', 'en', 'No image'),
(48, 'Edit directory', 'en', 'Edit directory'),
(49, 'Return', 'en', 'Return'),
(50, 'Add new article', 'en', 'Add new article'),
(51, 'Edit', 'en', 'Edit'),
(52, 'Delete', 'en', 'Delete'),
(53, 'Add a new directory', 'en', 'Add a new directory'),
(54, 'Description', 'en', 'Description'),
(55, 'Back', 'en', 'Back'),
(56, 'List', 'en', 'List'),
(57, 'Add', 'en', 'Add'),
(58, 'Preview', 'en', 'Preview'),
(59, 'Uploading files', 'en', 'Uploading files'),
(60, 'File', 'en', 'File'),
(61, 'Submit', 'en', 'Submit'),
(62, 'Included files', 'en', 'Included files'),
(63, 'Path', 'en', 'Path'),
(64, 'Class', 'en', 'Class'),
(65, 'Create new file', 'en', 'Create new file'),
(66, 'Lost password', 'en', 'Lost password'),
(67, 'allready exist', 'en', 'already exist'),
(68, 'Incorrect email of password', 'en', 'Incorrect email of password'),
(69, 'not found', 'en', 'not found'),
(70, 'Message with new password is sended to email', 'en', 'Message with new password is sended to email'),
(71, 'New password is', 'en', 'New password is'),
(72, 'New password for', 'en', 'New password for'),
(73, 'Registration sucsessful', 'en', 'Registration successful'),
(74, 'We are glad to confirm sucsessful registration at', 'en', 'We are glad to confirm successful registration at'),
(75, 'About software', 'en', 'About software'),
(76, 'Errors not found', 'en', 'Errors not found'),
(77, 'Clear log', 'en', 'Clear log'),
(78, 'Date', 'en', 'Date'),
(79, 'New user', 'en', 'New user'),
(80, 'Name', 'en', 'Name'),
(81, 'Ban', 'en', 'Ban'),
(82, 'Unban', 'en', 'Unban'),
(83, 'Confirm deleting banned user', 'en', 'Confirm deleting banned user'),
(84, 'Create user', 'en', 'Create user'),
(85, 'Incorrect email', 'en', 'Incorrect email'),
(86, 'Enter password', 'en', 'Enter password'),
(87, 'Update interval', 'en', 'Update interval'),
(88, 'All pages', 'en', 'All pages'),
(89, 'Logs', 'en', 'Logs'),
(90, 'Text', 'en', 'Text'),
(91, 'Pages not found', 'en', 'Pages not found'),
(92, 'Sign Up', 'en', 'Sign Up'),
(93, 'Admin', 'en', 'Admin'),
(94, 'Upload files', 'en', 'Upload files'),
(95, 'Account', 'en', 'Account'),
(96, 'Save settings', 'en', 'Save settings'),
(97, 'Access denied', 'en', 'Access denied'),
(98, 'Message sent successfully', 'en', 'Message sent successfully'),
(99, 'New message from', 'en', 'New message from'),
(100, 'My Account', 'en', 'My Account'),
(101, 'Show navigation', 'en', 'Show navigation'),
(102, 'Get in Touch', 'en', 'Get in Touch'),
(103, 'Contact Us', 'en', 'Contact Us'),
(104, 'Your message here', 'en', 'Your message here'),
(105, 'Send message', 'en', 'Send message'),
(106, 'Developed by', 'en', 'Developed by'),
(107, 'Up', 'en', 'Up'),
(108, 'Show All', 'en', 'Show All'),
(109, 'Change picture', 'en', 'Change picture'),
(110, 'Enter your email and password to continue', 'en', 'Enter your email and password to continue'),
(111, 'Settings', 'en', 'Settings'),
(112, 'Email', 'en', 'Email'),
(113, 'New password', 'en', 'New password'),
(114, 'Enter your email', 'en', 'Enter your email'),
(115, 'Enter your password', 'en', 'Enter your password'),
(116, 'Save changes', 'en', 'Save changes'),
(117, 'Back to account', 'en', 'Back to account'),
(118, 'Invalid conformation code', 'en', 'Invalid conformation code'),
(119, 'Registration at', 'en', 'Registration at'),
(120, 'Confirmation code', 'en', 'Confirmation code'),
(121, 'No articles found', 'en', 'No articles found'),
(122, 'Messages', 'en', 'Messages'),
(123, 'Back to admin', 'en', 'Back to admin'),
(124, 'Status', 'en', 'Status'),
(125, 'Yes', 'en', 'Yes'),
(126, 'No', 'en', 'No'),
(127, 'Show in navigation', 'en', 'Show in navigation'),
(128, 'Back to content', 'en', 'Back to content'),
(129, 'Delete image', 'en', 'Delete image'),
(130, 'Comments not found', 'en', 'Comments not found'),
(131, 'Add reply', 'en', 'Add reply'),
(132, 'Users not found', 'en', 'Users not found'),
(133, 'Share friends in', 'en', 'Share friends in'),
(134, 'Language', 'en', 'Language'),
(135, 'Home', 'en', 'Home'),
(136, 'Connect us at', 'en', 'Connect us at'),
(137, 'Copyright', 'en', 'Copyright'),
(138, 'All rights reserved', 'en', 'All rights reserved'),
(139, 'There is no users, you can send a message', 'en', 'There is no users, you can send a message'),
(140, 'offline', 'en', 'offline'),
(141, 'Add comment', 'en', 'Add comment'),
(142, 'Submit comment', 'en', 'Submit comment'),
(143, 'Add new comment', 'en', 'Add new comment'),
(144, 'There is no comments', 'en', 'There is no comments'),
(145, 'Comment submited!', 'en', 'Comment submited!'),
(146, 'To post a comment, please', 'en', 'To post a comment, please'),
(147, 'Updating engine from version', 'ru', 'Обновления движка с версии'),
(148, 'Reply', 'en', 'Reply'),
(149, 'Upload', 'ru', 'Загрузить'),
(150, 'Link', 'ru', 'Ссылка'),
(151, 'Cancel', 'ru', 'Отмена'),
(152, 'Uploaded', 'ru', 'Загружено'),
(153, 'For uploading selected area use double click', 'ru', 'Для сохранения выделенной области используй двойной клик'),
(154, 'Error', 'ru', 'Ошибка'),
(155, 'Upload image', 'ru', 'Загрузить изображение'),
(156, 'Sitemap', 'ru', 'Карта сайта'),
(157, 'Format', 'ru', 'Маска'),
(158, 'Upload new image', 'ru', 'Загрузить новое изобр.'),
(159, 'Logout sucsessful', 'ru', 'Сессия завершена'),
(160, 'Quit', 'ru', 'Выход'),
(161, 'Site', 'ru', 'Сайт'),
(162, 'Users', 'ru', 'Пользователи'),
(163, 'Comments', 'ru', 'Комментарии'),
(164, 'Content', 'ru', 'Контент'),
(165, 'Errors', 'ru', 'Ошибки'),
(166, 'Files', 'ru', 'Файлы'),
(167, 'Images', 'ru', 'Изображения'),
(168, 'Videos', 'ru', 'Видео'),
(169, 'Access', 'ru', 'Доступ'),
(170, 'Config', 'ru', 'Настройки'),
(171, 'Backend', 'ru', 'Бекенд'),
(172, 'Logout', 'ru', 'Выход'),
(173, 'Authentication timeout', 'ru', 'Таймаут аутенфикации'),
(174, 'Password', 'ru', 'Пароль'),
(175, 'Upload selection as thumb?', 'ru', 'Загрузить выделенную облать как превью?'),
(176, 'Save uploaded images', 'ru', 'Сохранить загруженные'),
(177, 'Previous page', 'ru', 'Предыдущая страница'),
(178, 'Next page', 'ru', 'Следующая страница'),
(179, 'Updated', 'ru', 'Обновлено'),
(180, 'Interval', 'ru', 'Интервал'),
(181, 'Not existing', 'ru', 'Не существует'),
(182, 'Not cathing', 'ru', 'Не кешируется'),
(183, 'Not refreshing', 'ru', 'Не обновляется'),
(184, 'minut', 'ru', 'минут'),
(185, 'minuts', 'ru', 'минут'),
(186, 'hour', 'ru', 'час'),
(187, 'hours', 'ru', 'часов'),
(188, 'Dayly', 'ru', 'Суточно'),
(189, 'Change interval', 'ru', 'Изменить интервал'),
(190, 'Refresh catch', 'ru', 'Обновить кэш'),
(191, 'Edit article', 'ru', 'Редактировать статью'),
(192, 'Caption', 'ru', 'Название'),
(193, 'No image', 'ru', 'Нет изображения'),
(194, 'Edit directory', 'ru', 'Редактировать раздел'),
(195, 'Return', 'ru', 'Назад'),
(196, 'Add new article', 'ru', 'Добавить новую статью'),
(197, 'Edit', 'ru', 'Редактировать'),
(198, 'Delete', 'ru', 'Удалить'),
(199, 'Add a new directory', 'ru', 'Добавить раздел'),
(200, 'Description', 'ru', 'Описание'),
(201, 'Back', 'ru', 'Назад'),
(202, 'List', 'ru', 'Список'),
(203, 'Add', 'ru', 'Добавить'),
(204, 'Preview', 'ru', 'Превью'),
(205, 'Uploading files', 'ru', 'Загрузка файлов'),
(206, 'File', 'ru', 'Файл'),
(207, 'Submit', 'ru', 'Отправить'),
(208, 'Included files', 'ru', 'Подключенные файлы'),
(209, 'Path', 'ru', 'Путь'),
(210, 'Class', 'ru', 'Класс'),
(211, 'Create new file', 'ru', 'Создать новый файл'),
(212, 'Lost password', 'ru', 'Забыли пароль'),
(213, 'allready exist', 'ru', 'уже существует'),
(214, 'Incorrect email of password', 'ru', 'Неправильный email или пароль'),
(215, 'not found', 'ru', 'не найден'),
(216, 'Message with new password is sended to email', 'ru', 'Письмо с новым паролем отправлено на указанный email'),
(217, 'New password is', 'ru', 'Новый пароль'),
(218, 'New password for', 'ru', 'Новый пароль для'),
(219, 'Registration sucsessful', 'ru', 'Вы успешно зарегистрировались'),
(220, 'We are glad to confirm sucsessful registration at', 'ru', 'Мы рады сообщить, что Вы успешно зарегистрировались на'),
(221, 'About software', 'ru', 'О программе'),
(222, 'Errors not found', 'ru', 'Ошибок не найдено'),
(223, 'Clear log', 'ru', 'Очистить список'),
(224, 'Date', 'ru', 'Дата'),
(225, 'New user', 'ru', 'Новый пользователь'),
(226, 'Name', 'ru', 'Имя'),
(227, 'Ban', 'ru', 'Забанить'),
(228, 'Unban', 'ru', 'Разбанить'),
(229, 'Confirm deleting banned user', 'ru', 'Удалить забаненного пользователя, без возможности восстановления'),
(230, 'Create user', 'ru', 'Создать пользователя'),
(231, 'Incorrect email', 'ru', 'Неправильный email'),
(232, 'Enter password', 'ru', 'Введите пароль'),
(233, 'Update interval', 'ru', 'Обновить интервал'),
(234, 'All pages', 'ru', 'Все страницы'),
(235, 'Logs', 'ru', 'Логи'),
(236, 'Text', 'ru', 'Текст'),
(237, 'Pages not found', 'ru', 'Страниц не найдено'),
(238, 'Sign Up', 'ru', 'Регистрация'),
(239, 'Admin', 'ru', 'Админ'),
(240, 'Upload files', 'ru', 'Загрузка файлов'),
(241, 'Account', 'ru', 'Аккаунт'),
(242, 'Save settings', 'ru', 'Сохранить настройки'),
(243, 'Access denied', 'ru', 'Доступ запрещен'),
(244, 'Message sent successfully', 'ru', 'Сообщение успешно отправлено'),
(245, 'New message from', 'ru', 'Новое сообщение от'),
(246, 'My Account', 'ru', 'Мой аккаунт'),
(247, 'Show navigation', 'ru', 'Показать навигацию'),
(248, 'Your message here', 'ru', 'Ваше сообщение'),
(249, 'Send message', 'ru', 'Отправить сообщение'),
(250, 'Developed by', 'ru', 'Разработчик'),
(251, 'Up', 'ru', 'Вверх'),
(252, 'Show All', 'ru', 'Показать все'),
(253, 'Change picture', 'ru', 'Сменить изображение'),
(254, 'Enter your email and password to continue', 'ru', 'Для продолжения укажите ваш email и пароль'),
(255, 'Settings', 'ru', 'Настройки'),
(256, 'Email', 'ru', 'Email'),
(257, 'New password', 'ru', 'Новый пароль'),
(258, 'Enter your email', 'ru', 'Укажите ваш email'),
(259, 'Enter your password', 'ru', 'Укажите ваш пароль'),
(260, 'Save changes', 'ru', 'Сохранить настройки'),
(261, 'Back to account', 'ru', 'Назад в аккаунт'),
(262, 'Invalid conformation code', 'ru', 'Неправильный код подтверждения'),
(263, 'Registration at', 'ru', 'Регистрация на'),
(264, 'Confirmation code', 'ru', 'Код подтверждения'),
(265, 'No articles found', 'ru', 'Статей не найдено'),
(266, 'Messages', 'ru', 'Сообщения'),
(267, 'Back to admin', 'ru', 'Назад в админку'),
(268, 'Status', 'ru', 'Статус'),
(269, 'Yes', 'ru', 'Да'),
(270, 'No', 'ru', 'Нет'),
(271, 'Show in navigation', 'ru', 'Показать в навигации'),
(272, 'Back to content', 'ru', 'Назад к содержанию'),
(273, 'Delete image', 'ru', 'Удалить изображение'),
(274, 'Comments not found', 'ru', 'Комментариев не найдено'),
(275, 'Add reply', 'ru', 'Добавить ответ'),
(276, 'Users not found', 'ru', 'Пользователей не найдено'),
(277, 'Share friends in', 'ru', 'Рассказать друзьям в'),
(278, 'Language', 'ru', 'Язык'),
(279, 'Home', 'ru', 'Главная'),
(280, 'Connect us at', 'ru', 'Связаться в '),
(281, 'All rights reserved', 'ru', 'Все права защищены'),
(282, 'There is no users, you can send a message', 'ru', 'Контакты отсутствуют'),
(283, 'Add comment', 'ru', 'Добавить комментарий'),
(284, 'Submit comment', 'ru', 'Отправить комментарий'),
(285, 'Add new comment', 'ru', 'Добавить новый комментарий'),
(286, 'There is no comments', 'ru', 'Комментарии отсутствуют'),
(287, 'Comment submited!', 'ru', 'Комментарий отправлен!'),
(288, 'To post a comment, please', 'ru', 'Чтобы отправить комментарий, '),
(289, 'Restore password', 'ru', 'Восстановить пароль'),
(290, 'Reply', 'ru', 'Ответ'),
(291, 'Enabled', 'ru', 'Включено'),
(292, 'Autoupdate', 'ru', 'Автообновление'),
(293, 'Authentication error', 'ru', 'Ошибка аутенфикации'),
(294, 'Disabled', 'ru', 'Отключено'),
(295, 'Select your language', 'en', 'Select your language'),
(296, 'Select your language', 'ru', 'Выбирете язык'),
(297, 'Search', 'en', 'Search'),
(298, 'Search results by request', 'en', 'Search results by request'),
(299, 'Documentation', 'en', 'Documentation'),
(300, 'Add new value', 'en', 'Add new value'),
(301, 'Or file', 'ru', 'Или файл'),
(302, 'Online', 'ru', 'онлайн'),
(303, 'Get in Touch', 'ru', 'Связаться'),
(304, 'Contact Us', 'ru', 'Напишите нам'),
(305, 'Copyright', 'ru', 'Copyright'),
(306, 'offline', 'ru', 'оффлайн'),
(307, 'Search', 'ru', 'Поиск'),
(308, 'Search results by request', 'ru', 'Поиск по запросу'),
(309, 'Documentation', 'ru', 'Документация'),
(310, 'Add new value', 'ru', 'Добавить запись'),
(311, 'Download', 'en', 'Download'),
(312, 'Install', 'en', 'Install'),
(313, 'Framework', 'en', 'Framework'),
(314, 'auth', 'ru', 'Авторизуйтесь'),
(315, 'Useful services', 'en', 'Useful services'),
(316, 'Setup', 'en', 'Setup'),
(317, 'Login to send message', 'en', 'Login to send message'),
(318, 'Add article', 'en', 'Add article'),
(319, 'Download', 'ru', 'Скачать'),
(320, 'Install', 'ru', 'Установить'),
(321, 'Framework', 'ru', 'Структура'),
(322, 'Useful services', 'ru', 'Полезные сервисы'),
(323, 'Setup', 'ru', 'Установка'),
(324, 'Login to send message', 'ru', 'Авторизуйтесь, чтобы отправить сообщение'),
(325, 'Add article', 'ru', 'Добавить статью'),
(326, 'register now', 'ru', 'Зарегистрируйтесь'),
(327, 'register now', 'en', 'register now'),
(328, 'auth', 'en', 'auth'),
(329, 'There is no articles', 'en', 'There is no articles'),
(330, 'Functions', 'en', 'Functions'),
(331, 'Database', 'en', 'Database'),
(332, 'There is no articles', 'ru', 'Статей не найдено'),
(333, 'Functions', 'ru', 'Функции'),
(334, 'Database', 'ru', 'База данных'),
(335, 'Clear logs', 'ru', 'Очистить логи'),
(336, 'Logs not found', 'ru', 'Логи не найдены'),
(337, 'Sorry, no results found', 'en', 'Sorry, no results found'),
(338, 'Search results for', 'ru', 'Результаты поиска'),
(339, 'Sorry, no results found', 'ru', 'По вашему запросу ничего не нашлось'),
(340, 'Value', 'en', 'Value'),
(341, 'Showing', 'en', 'Showing'),
(342, 'to', 'en', 'to'),
(343, 'from', 'en', 'from'),
(344, 'entries', 'en', 'entries'),
(345, 'per page', 'en', 'per page'),
(346, 'Next', 'en', 'Next'),
(347, 'IP', 'ru', ''),
(348, 'New message', 'ru', 'Новое сообщение'),
(349, 'Previous', 'en', 'Previous'),
(350, 'Code', 'en', 'Code'),
(351, 'Select option', 'en', 'Select option'),
(352, 'Content not found', 'en', 'Content not found'),
(353, 'Crop image', 'en', 'Crop image'),
(354, 'Value', 'ru', 'Значение'),
(355, 'Showing', 'ru', 'Отображаются'),
(356, 'to', 'ru', 'по'),
(357, 'from', 'ru', 'из'),
(358, 'entries', 'ru', 'вхождений'),
(359, 'per page', 'ru', 'на страницу'),
(360, 'Next', 'ru', 'Вперед'),
(361, 'Account confirmation', 'ru', 'Подтверждение аккаунта'),
(362, 'Previous', 'ru', 'Назад'),
(363, 'Code', 'ru', 'Код'),
(364, 'Select option', 'ru', 'Выберете опцию'),
(365, 'Content not found', 'ru', 'Данных не найдено'),
(366, 'Crop image', 'ru', 'Обрезать изображение'),
(367, 'Sended', 'en', 'Sended'),
(368, 'at', 'en', 'at'),
(369, 'Sended', 'ru', 'Отправлено'),
(370, 'at', 'ru', 'в'),
(371, 'Too many failed attempts', 'en', 'Too many failed attempts'),
(372, 'Try again after', 'en', 'Try again after'),
(373, 'seconds', 'en', 'seconds'),
(374, 'Action', 'en', 'Action'),
(375, 'User', 'en', 'User'),
(376, 'IP', 'en', 'IP'),
(377, 'Too many failed attempts', 'ru', 'Слишком много неудачных попыток'),
(378, 'User', 'ru', 'Пользователь'),
(379, 'Action', 'ru', 'Действие'),
(380, 'seconds', 'ru', 'секунд'),
(381, 'Try again after', 'ru', 'Попробуйте еще через'),
(382, 'New message', 'en', 'New message'),
(383, 'Clear logs', 'en', 'Clear logs'),
(384, 'Logs not found', 'en', 'Logs not found'),
(385, 'Updates', 'en', 'Updates'),
(386, 'Autoupdate', 'en', 'Autoupdate'),
(387, 'Enabled', 'en', 'Enabled'),
(388, 'Disabled', 'en', 'Disabled'),
(389, 'Authentication error', 'en', 'Authentication error'),
(390, 'Authentication timeout', 'en', 'Authentication timeout'),
(391, 'Restore password', 'en', 'Restore password'),
(392, 'Received', 'en', 'Received'),
(393, 'new messages', 'en', 'new messages'),
(394, 'Updating engine from version', 'en', 'Updating engine from version'),
(395, 'Downloading files', 'en', 'Downloading files'),
(396, 'Receiving', 'en', 'Receiving'),
(397, 'Update aborted', 'en', 'Update aborted'),
(398, 'Replacing downloaded files from', 'en', 'Replacing downloaded files from'),
(399, 'Receiving MySQL data', 'en', 'Receiving MySQL data'),
(400, 'Executed', 'en', 'Executed'),
(401, 'commands', 'en', 'commands'),
(402, 'Updating to version', 'en', 'Updating to version'),
(403, 'is complete', 'en', 'is complete'),
(404, 'after 5 seconds', 'en', 'after 5 seconds'),
(405, 'Current version', 'en', 'Current version'),
(406, 'New updates available', 'en', 'New updates available'),
(407, 'Update Now', 'en', 'Update Now'),
(408, 'No updates available', 'en', 'No updates available'),
(409, 'Invalid confirmation code', 'en', 'Invalid confirmation code'),
(410, 'Data not found', 'en', 'Data not found'),
(411, 'Trying to register', 'en', 'Trying to register'),
(412, 'Comment posted', 'en', 'Comment posted'),
(413, 'There is no files', 'en', 'There is no files'),
(414, 'Downloading files', 'ru', 'Скачивание файлов'),
(415, 'Receiving', 'ru', 'Получение'),
(416, 'Update aborted', 'ru', 'Обновление прекращено'),
(417, 'Replacing downloaded files from', 'ru', 'Перемещение скачанных файлов из'),
(418, 'Receiving MySQL data', 'ru', 'Получение MySQL данных'),
(419, 'Executed', 'ru', 'Исполнено'),
(420, 'commands', 'ru', 'комманд'),
(421, 'Updating to version', 'ru', 'Обновление до версии'),
(422, 'is complete', 'ru', 'завершено'),
(423, 'after 5 seconds', 'ru', 'через 5 секунд'),
(424, 'Current version', 'ru', 'Текущая версия'),
(425, 'New updates available', 'ru', 'Доступно обновление'),
(426, 'Update Now', 'ru', 'Обновить сейчас'),
(427, 'No updates available', 'ru', 'Обновление недоступно'),
(428, 'Invalid confirmation code', 'ru', 'Неверный код подтверждения'),
(429, 'Data not found', 'ru', 'Данные не найдены'),
(430, 'Trying to register', 'ru', 'Попытка регистрации'),
(431, 'Comment posted', 'ru', 'Добавлен комментарий'),
(432, 'There is no files', 'ru', 'Файлов не найдено'),
(433, 'Updates', 'ru', 'Обновления'),
(434, 'Login', 'en', 'Login'),
(435, 'Loading', 'en', 'Loading'),
(436, 'Page not found', 'en', 'Page not found'),
(437, 'Back to Home Page', 'en', 'Back to Home Page'),
(438, 'or', 'en', 'or'),
(439, 'Login', 'ru', 'Логин'),
(440, 'Attendance', 'en', 'Attendance'),
(441, 'Page not found', 'ru', 'Страница не найдена'),
(442, 'Back to Home Page', 'ru', 'Назад на главную'),
(443, 'or', 'ru', 'или'),
(444, 'Loading', 'ru', 'Загрузка'),
(445, 'Back to Top', 'en', 'Back to Top'),
(446, 'Search results for', 'en', 'Search results for'),
(447, 'Templates', 'en', 'Templates'),
(448, 'Default file', 'en', 'Default file'),
(449, 'New file', 'en', 'New file'),
(450, 'New template', 'en', 'New template'),
(451, 'Default template', 'en', 'Default template'),
(452, 'Template name', 'en', 'Template name'),
(453, 'Views', 'en', 'Views'),
(454, 'Visitors', 'en', 'Visitors'),
(455, 'Statistic', 'en', 'Statistic'),
(456, 'Pages', 'en', 'Pages'),
(457, 'Referrers', 'en', 'Referrers'),
(458, 'By days', 'en', 'By days'),
(459, 'By weeks', 'en', 'By weeks'),
(460, 'By months', 'en', 'By months'),
(461, 'Amount', 'en', 'Amount'),
(462, 'Blank', 'en', 'Blank'),
(463, 'Restore your password', 'en', 'Restore your password'),
(464, 'To restore your password, use this code', 'en', 'To restore your password, use this code'),
(465, 'Message with confirmation code is sended to email', 'en', 'Message with confirmation code is sended to email'),
(466, 'There is no templates', 'en', 'There is no templates'),
(467, 'Register', 'en', 'Register'),
(468, 'Try to register', 'en', 'Try to register'),
(469, 'Trying to login', 'en', 'Trying to login'),
(470, 'Engine update', 'en', 'Engine update'),
(471, 'Attendance', 'ru', 'Посещаемость'),
(472, 'Back to Top', 'ru', 'Наверх'),
(473, 'Templates', 'ru', 'Шаблоны'),
(474, 'Default file', 'ru', 'Файл по-умолчанию'),
(475, 'New file', 'ru', 'Новый файл'),
(476, 'New template', 'ru', 'Новый шаблон'),
(477, 'Default template', 'ru', 'Шаблон по-умолчанию'),
(478, 'Template name', 'ru', 'Название шаблона'),
(479, 'Views', 'ru', 'Просмотры'),
(480, 'Visitors', 'ru', 'Посетители'),
(481, 'Statistic', 'ru', 'Статистика'),
(482, 'Pages', 'ru', 'Страницы'),
(483, 'Referrers', 'ru', 'Источники'),
(484, 'By days', 'ru', 'По дням'),
(485, 'By weeks', 'ru', 'По неделям'),
(486, 'By months', 'ru', 'По месяцам'),
(487, 'Amount', 'ru', 'Количество'),
(488, 'Blank', 'ru', 'Пусто'),
(489, 'Restore your password', 'ru', 'Восстановить пароль'),
(490, 'To restore your password, use this code', 'ru', 'Для восстановления пароля используйте этот код'),
(491, 'Message with confirmation code is sended to email', 'ru', 'Письмо с кодом подтверждения отправлено на указаный email'),
(492, 'There is no templates', 'ru', 'Шаблоны отсутствуют'),
(493, 'Register', 'ru', 'Регистрация'),
(494, 'Try to register', 'ru', 'Попытка регистрации'),
(495, 'Trying to login', 'ru', 'Попытка авторизации'),
(496, 'Engine update', 'ru', 'Обновление движка'),
(497, 'Withdrawal already requested', 'en', 'Withdrawal already requested'),
(498, 'Withdrawal request accepted', 'en', 'Withdrawal request accepted'),
(499, 'Select file', 'en', 'Select file'),
(500, 'Editable file', 'en', 'Editable file'),
(501, 'Source file', 'en', 'Source file'),
(502, 'Gateway Timeout', 'en', 'Gateway Timeout'),
(503, 'Image too small. Minimal size is 400x400', 'en', 'Image too small. Minimal size is 400x400'),
(504, 'Drop files here', 'en', 'Drop files here'),
(505, 'System message', 'en', 'System message'),
(506, 'sign in', 'en', 'sign in'),
(507, 'Confirm Shipment', 'en', 'Confirm Shipment'),
(508, 'Post track number', 'en', 'Post track number'),
(509, 'Shipment is confirmed', 'en', 'Shipment is confirmed'),
(510, 'This item is sold out now?', 'en', 'This item is sold out now?'),
(511, 'New order', 'en', 'New order'),
(512, 'Archive order', 'en', 'Archive order'),
(513, 'Finished', 'en', 'Finished'),
(514, 'Purchaser', 'en', 'Purchaser'),
(515, 'Shipping address', 'en', 'Shipping address'),
(516, 'All Items', 'en', 'All Items'),
(517, 'Buy Now!', 'en', 'Buy Now!'),
(518, 'Title', 'en', 'Title'),
(519, 'Ask price', 'en', 'Ask price'),
(520, 'Edit product', 'en', 'Edit product'),
(521, 'Click to Deactivate', 'en', 'Click to Deactivate'),
(522, 'Click to Activate', 'en', 'Click to Activate'),
(523, 'You might also be interested in', 'en', 'You might also be interested in'),
(524, 'Products not found', 'en', 'Products not found'),
(525, 'Category', 'en', 'Category'),
(526, 'Reset Filter', 'en', 'Reset Filter'),
(527, 'Unable to purchase your own product', 'en', 'Unable to purchase your own product'),
(528, 'Buy Now', 'en', 'Buy Now'),
(529, 'Tracking number', 'en', 'Tracking number'),
(530, 'Shipment in process', 'en', 'Shipment in process'),
(531, 'Confirm receipt', 'en', 'Confirm receipt'),
(532, 'Seller', 'en', 'Seller'),
(533, 'Shipping from', 'en', 'Shipping from'),
(534, 'Category', 'ru', 'Категория'),
(535, 'Reset Filter', 'ru', 'Сбросить'),
(536, 'Unable to purchase your own product', 'ru', 'Нельзя приобрести свой товар'),
(537, 'New comment at', 'en', 'New comment at'),
(538, 'You might also be interested in', 'ru', 'Вас может заинтересовать'),
(539, 'Products not found', 'ru', 'Товары не найдены'),
(540, 'New message at', 'en', 'New message at'),
(541, 'Dear', 'en', 'Dear'),
(542, 'sent a message for you', 'en', 'sent a message for you'),
(543, 'For details, click', 'en', 'For details, click'),
(544, 'here', 'en', 'here'),
(545, 'Withdrawal request at', 'en', 'Withdrawal request at'),
(546, 'You withdrawal request is pending now', 'en', 'You withdrawal request is pending now'),
(547, 'After some time you will receive', 'en', 'After some time you will receive'),
(548, 'on your PayPal account', 'en', 'on your PayPal account'),
(549, 'There in new withdrawal request at', 'en', 'There in new withdrawal request at'),
(550, 'Need to pay', 'en', 'Need to pay'),
(551, 'on PayPal account', 'en', 'on PayPal account'),
(552, 'and confirm request', 'en', 'and confirm request'),
(553, 'Details', 'en', 'Details'),
(554, 'Withdrawal is complete at', 'en', 'Withdrawal is complete at'),
(555, 'You withdrawal is complete', 'en', 'You withdrawal is complete'),
(556, 'Thanks for using our service and have a nice day', 'en', 'Thanks for using our service and have a nice day'),
(557, 'New purchase at', 'en', 'New purchase at'),
(558, 'Congratulations on your purchase at', 'en', 'Congratulations on your purchase at'),
(559, 'You can see details of your purchases', 'en', 'You can see details of your purchases'),
(560, 'There in new purchase at', 'en', 'There in new purchase at'),
(561, 'make a payment', 'en', 'make a payment'),
(562, 'to your PayPal account', 'en', 'to your PayPal account'),
(563, 'Your order has been shipped at', 'en', 'Your order has been shipped at'),
(564, 'Your order', 'en', 'Your order'),
(565, 'has been shipped', 'en', 'has been shipped'),
(566, 'After receiving, please update purchase status', 'en', 'After receiving, please update purchase status'),
(567, 'Your order has been completed at', 'en', 'Your order has been completed at'),
(568, 'Your order has been completed', 'en', 'Your order has been completed'),
(569, 'Funds added to your account and available for withdrawal', 'en', 'Funds added to your account and available for withdrawal'),
(570, 'Orders not found', 'en', 'Orders not found'),
(571, 'Type', 'en', 'Type'),
(572, 'Withdrawal request', 'en', 'Withdrawal request'),
(573, 'Money deposit', 'en', 'Money deposit'),
(574, 'Order', 'en', 'Order'),
(575, 'Please, confirm transaction', 'en', 'Please, confirm transaction'),
(576, 'Confirm payment', 'en', 'Confirm payment'),
(577, 'Bots', 'en', 'Bots'),
(578, 'Banned', 'en', 'Banned'),
(579, 'Active', 'en', 'Active'),
(580, 'Please, describe this item', 'en', 'Please, describe this item'),
(581, 'Description (e.g. Blue Nike Vapor Cleats Size 10. Very comfortable and strong ankle support.)', 'en', 'Description (e.g. Blue Nike Vapor Cleats Size 10. Very comfortable and strong ankle support.)'),
(582, 'Please, confirm item shipping address', 'en', 'Please, confirm item shipping address'),
(583, 'State', 'en', 'State'),
(584, 'City', 'en', 'City'),
(585, 'Zip code', 'en', 'Zip code'),
(586, 'Street', 'en', 'Street'),
(587, 'Phone number', 'en', 'Phone number'),
(588, 'Price', 'en', 'Price'),
(589, 'Choose action', 'en', 'Choose action'),
(590, 'Edit item', 'en', 'Edit item'),
(591, 'Deactivate item', 'en', 'Deactivate item'),
(592, 'Activate item', 'en', 'Activate item'),
(593, 'List new Item', 'en', 'List new Item'),
(594, 'Edit Properties', 'en', 'Edit Properties'),
(595, 'Keywords', 'en', 'Keywords'),
(596, 'Mode', 'en', 'Mode'),
(597, 'Replace', 'en', 'Replace'),
(598, 'Cron error', 'en', 'Cron error'),
(599, 'Save', 'en', 'Save'),
(600, 'Are you sure?', 'en', 'Are you sure?'),
(601, 'Add value', 'en', 'Add value'),
(602, 'Edit property', 'en', 'Edit property'),
(603, 'New value', 'en', 'New value'),
(604, 'Delete property', 'en', 'Delete property'),
(605, 'Add new property', 'en', 'Add new property'),
(606, 'Back to products', 'en', 'Back to products'),
(607, 'Connect with social network', 'en', 'Connect with social network'),
(608, 'Delivery confirmation', 'en', 'Delivery confirmation'),
(609, 'Quality', 'en', 'Quality'),
(610, 'Your comment here', 'en', 'Your comment here'),
(611, 'Purchases', 'en', 'Purchases'),
(612, 'Thank you for your order! Shipment in process now.', 'en', 'Thank you for your order! Shipment in process now.'),
(613, 'There is no purchases', 'en', 'There is no purchases'),
(614, 'Finances', 'en', 'Finances'),
(615, 'The funds have been added to your account', 'en', 'The funds have been added to your account'),
(616, 'Balance', 'en', 'Balance'),
(617, 'Pending', 'en', 'Pending'),
(618, 'New', 'en', 'New'),
(619, 'Transactions not found', 'en', 'Transactions not found'),
(620, 'Request withdrawal', 'en', 'Request withdrawal'),
(621, 'Confirm your PayPal', 'en', 'Confirm your PayPal'),
(622, 'Deposit money', 'en', 'Deposit money'),
(623, 'Amount to deposit', 'en', 'Amount to deposit'),
(624, 'About', 'en', 'About'),
(625, 'Products', 'en', 'Products'),
(626, 'Orders', 'en', 'Orders'),
(627, 'Finance', 'en', 'Finance'),
(628, 'Order products', 'en', 'Order products'),
(629, 'Confirmation', 'en', 'Confirmation'),
(630, 'Please, confirm your order', 'en', 'Please, confirm your order'),
(631, 'Remove product', 'en', 'Remove product'),
(632, 'Sorry, there is no products', 'en', 'Sorry, there is no products'),
(633, 'Total price', 'en', 'Total price'),
(634, 'Shipping', 'en', 'Shipping'),
(635, 'Please, confirm your shipping address', 'en', 'Please, confirm your shipping address'),
(636, 'Payment', 'en', 'Payment'),
(637, 'First name', 'en', 'First name'),
(638, 'Last name', 'en', 'Last name'),
(639, 'Country', 'en', 'Country'),
(640, 'Process payment', 'en', 'Process payment'),
(641, 'FILTER RESULTS', 'en', 'FILTER RESULTS'),
(642, 'Already have an account?', 'en', 'Already have an account?'),
(643, 'Empty search query', 'en', 'Empty search query'),
(644, 'Cart', 'en', 'Cart'),
(645, 'Withdrawal already requested', 'ru', 'Вывод средств уже запрошен'),
(646, 'Withdrawal request accepted', 'ru', 'Запрос на вывод средств принят'),
(647, 'Select file', 'ru', 'Выберите файл'),
(648, 'Editable file', 'ru', 'Редактируемый файл'),
(649, 'Source file', 'ru', 'Исходный файл'),
(650, 'Gateway Timeout', 'ru', 'Таймаут запроса'),
(651, 'Image too small. Minimal size is 400x400', 'ru', 'Изображение слишком маленькое. Минимальный размер 400x400'),
(652, 'Drop files here', 'ru', 'Пертащите файлы сюда'),
(653, 'System message', 'ru', 'Системное сообщение'),
(654, 'sign in', 'ru', 'авторизуйтесь'),
(655, 'Confirm Shipment', 'ru', 'Подтвердите отправку'),
(656, 'Post track number', 'ru', 'Почтовый трек-номер'),
(657, 'Shipment is confirmed', 'ru', 'Отправка подтверждена'),
(658, 'This item is sold out now?', 'ru', 'Снять товар с продажи?'),
(659, 'New order', 'ru', 'Новый заказ'),
(660, 'Archive order', 'ru', 'Архивировать заказ'),
(661, 'Finished', 'ru', 'Завершено'),
(662, 'Purchaser', 'ru', 'Покупатель'),
(663, 'Shipping address', 'ru', 'Адрес доставки'),
(664, 'All Items', 'ru', 'Все товары'),
(665, 'Buy Now!', 'ru', 'Купить!'),
(666, 'Title', 'ru', 'Название'),
(667, 'Ask price', 'ru', 'Стоимость'),
(668, 'Edit product', 'ru', 'Редактировать товар'),
(669, 'Click to Deactivate', 'ru', 'Деактивировать'),
(670, 'Click to Activate', 'ru', 'Активировать'),
(671, 'Buy Now', 'ru', 'Купить'),
(672, 'Tracking number', 'ru', 'Трек-номер'),
(673, 'Shipment in process', 'ru', 'Доставка в процессе'),
(674, 'Confirm receipt', 'ru', 'Подтвердить получение'),
(675, 'Seller', 'ru', 'Продавец'),
(676, 'Shipping from', 'ru', 'Доставка из'),
(677, 'New comment at', 'ru', 'Новый комментарий на'),
(678, 'Ok', 'ru', 'Ok'),
(679, 'New message at', 'ru', 'Новое сообщение на'),
(680, 'Dear', 'ru', 'Дорогой'),
(681, 'sent a message for you', 'ru', 'отправил(а) сообщение вам'),
(682, 'For details, click', 'ru', 'Для подробностей, кликните'),
(683, 'here', 'ru', 'здесь'),
(684, 'Withdrawal request at', 'ru', 'Вывод средств'),
(685, 'You withdrawal request is pending now', 'ru', 'Ваш запрос на вывод средств обрабатывается'),
(686, 'After some time you will receive', 'ru', 'Через некоторое время вам придет'),
(687, 'on your PayPal account', 'ru', 'на ваш PayPal аккаунт'),
(688, 'There in new withdrawal request at', 'ru', 'Новый запрос на вывод средств на'),
(689, 'Need to pay', 'ru', 'Нужно оплатить'),
(690, 'on PayPal account', 'ru', 'на PayPal аккаунт'),
(691, 'and confirm request', 'ru', 'и подтвредить запрос'),
(692, 'Details', 'ru', 'Подробности'),
(693, 'Withdrawal is complete at', 'ru', 'Вывод средств завершен на'),
(694, 'You withdrawal is complete', 'ru', 'Ваш запрос средств обработан'),
(695, 'Thanks for using our service and have a nice day', 'ru', 'Спасибо за использование нашего сервиса и удачного Вам дня'),
(696, 'New purchase at', 'ru', 'Новая покупка на'),
(697, 'Congratulations on your purchase at', 'ru', 'Поздравляем с покупкой на'),
(698, 'You can see details of your purchases', 'ru', 'Вы можете посмотреть подробную информацию о покупке'),
(699, 'There in new purchase at', 'ru', 'Новая покупка на'),
(700, 'make a payment', 'ru', 'совершил платеж'),
(701, 'to your PayPal account', 'ru', 'на ваш PayPal аккаунт'),
(702, 'Your order has been shipped at', 'ru', 'Ваш заказ был отправлен на'),
(703, 'Your order', 'ru', 'Ваш заказ'),
(704, 'has been shipped', 'ru', 'был отправлен'),
(705, 'After receiving, please update purchase status', 'ru', 'После получения обновите статус покупки'),
(706, 'Your order has been completed at', 'ru', 'Ваш заказ был завершен на'),
(707, 'Your order has been completed', 'ru', 'Ваш заказ был завершен'),
(708, 'Funds added to your account and available for withdrawal', 'ru', 'Средства зачислены на Ваш аккаунт и доступны для вывода'),
(709, 'Orders not found', 'ru', 'Заказов не найдено'),
(710, 'Type', 'ru', 'Тип'),
(711, 'Withdrawal request', 'ru', 'Запрос на вывод'),
(712, 'Money deposit', 'ru', 'Зачисление средств'),
(713, 'Order', 'ru', 'Заказ'),
(714, 'Please, confirm transaction', 'ru', 'Пожалуйста, подтвердите'),
(715, 'Confirm payment', 'ru', 'Подтвердить платеж'),
(716, 'Bots', 'ru', 'Боты'),
(717, 'Banned', 'ru', 'Забанен'),
(718, 'Active', 'ru', 'Активен'),
(719, 'Please, describe this item', 'ru', 'Пожалуйста, опишите товар'),
(720, 'Description (e g  Blue Nike Vapor Cleats Size 10  Very comfortable and strong ankle support )', 'ru', 'Описание (прим. Синиие Nike Vapor Бутсы. Размер 10. Очень удобные и сильная поддержка лодыжки.)'),
(721, 'Please, confirm item shipping address', 'ru', 'Пожалуйста, подтвердите адрес'),
(722, 'State', 'ru', 'Область'),
(723, 'City', 'ru', 'Город'),
(724, 'Zip code', 'ru', 'Почтовый индекс'),
(725, 'Street', 'ru', 'Улица'),
(726, 'Phone number', 'ru', 'Номер телефона'),
(727, 'Price', 'ru', 'Цена'),
(728, 'Choose action', 'ru', 'Выберете действие'),
(729, 'Edit item', 'ru', 'Редактировать товар'),
(730, 'Deactivate item', 'ru', 'Деактивировать'),
(731, 'Activate item', 'ru', 'Активировать'),
(732, 'List new Item', 'ru', 'Добавить новый товар'),
(733, 'Edit Properties', 'ru', 'Редактировать свойства'),
(734, 'Keywords', 'ru', 'Ключевые слова'),
(735, 'Mode', 'ru', 'Режим'),
(736, 'Replace', 'ru', 'Заменить'),
(737, 'Cron error', 'ru', 'Ошибка cron'),
(738, 'Save', 'ru', 'Сохранить'),
(739, 'Are you sure?', 'ru', 'Вы уверены?'),
(740, 'Add value', 'ru', 'Добавить значение'),
(741, 'Edit property', 'ru', 'Редактировать свойство'),
(742, 'New value', 'ru', 'Новое значение'),
(743, 'Delete property', 'ru', 'Удалить свойство'),
(744, 'Add new property', 'ru', 'Добавить новое свойство'),
(745, 'Back to products', 'ru', 'Назад к товарам'),
(746, 'Connect with social network', 'ru', 'Подключить аккаунт соц. сети'),
(747, 'Delivery confirmation', 'ru', 'Подтверждение получения'),
(748, 'Quality', 'ru', 'Качество'),
(749, 'Your comment here', 'ru', 'Ваш комментарий'),
(750, 'Purchases', 'ru', 'Покупки'),
(751, 'Thank you for your order! Shipment in process now.', 'ru', 'Спасибо за Ваш заказ! Отправление в процессе.'),
(752, 'There is no purchases', 'ru', 'Нет новых покупок'),
(753, 'Finances', 'ru', 'Финансы'),
(754, 'The funds have been added to your account', 'ru', 'Средства были зачислены на Ваш аккаунт'),
(755, 'Balance', 'ru', 'Баланс'),
(756, 'Pending', 'ru', 'Ожидание'),
(757, 'New', 'ru', 'Новый'),
(758, 'Transactions not found', 'ru', 'Транзакций не найдено'),
(759, 'Request withdrawal', 'ru', 'Запрос на вывод'),
(760, 'Confirm your PayPal', 'ru', 'Укажите Ваш PayPal'),
(761, 'Deposit money', 'ru', 'Зачислить средства'),
(762, 'Amount to deposit', 'ru', 'Количество к зачислению'),
(763, 'About', 'ru', 'О программе'),
(764, 'Products', 'ru', 'Товары'),
(765, 'Orders', 'ru', 'Заказы'),
(766, 'Finance', 'ru', 'Финансы'),
(767, 'Order products', 'ru', 'Заказать товары'),
(768, 'Confirmation', 'ru', 'Подтверждение'),
(769, 'Please, confirm your order', 'ru', 'Пожалуйста, подтвердите Ваш заказ'),
(770, 'Remove product', 'ru', 'Удалить товар'),
(771, 'Sorry, there is no products', 'ru', 'Извините, товаров не найдено'),
(772, 'Total price', 'ru', 'Итоговая цена'),
(773, 'Shipping', 'ru', 'Доставка'),
(774, 'Please, confirm your shipping address', 'ru', 'Пожалуйста, подтвержите адрес'),
(775, 'Payment', 'ru', 'Платеж'),
(776, 'First name', 'ru', 'Имя'),
(777, 'Last name', 'ru', 'Фамилия'),
(778, 'Country', 'ru', 'Страна'),
(779, 'Process payment', 'ru', 'Оплатить'),
(780, 'FILTER RESULTS', 'ru', 'ФИЛЬТР РЕЗУЛЬТАТОВ'),
(781, 'Already have an account?', 'ru', 'Уже зарегистрированы?'),
(782, 'Empty search query', 'ru', 'Пустой поисковый запрос'),
(783, 'Cart', 'ru', 'Корзина'),
(784, 'Description (e.g. Blue Nike Vapor Cleats Size 10. Very comfortable and strong ankle support.)', 'ru', 'Описание (прим. Синиие Nike Vapor Бутсы. Размер 10. Очень удобные и сильная поддержка лодыжки.)'),
(785, 'Views per day', 'ru', 'Просмотров в день'),
(786, 'Last visit', 'en', 'Last visit'),
(787, 'b', 'ru', 'Ваш заказ был завершен'),
(788, 'Visitors per day', 'ru', 'Посетителей в день'),
(789, 'Total comments', 'ru', 'Всего комментариев'),
(790, 'Total users', 'ru', 'Всего пользователей'),
(791, 'Total articles', 'ru', 'Всего статей'),
(792, 'Total products', 'ru', 'Всего товаров'),
(793, 'Total pages', 'ru', 'Всего страниц'),
(794, 'Engine version', 'ru', 'Версия движка'),
(795, 'Delete article', 'ru', 'Удалить статью'),
(796, 'Page generation time', 'ru', 'Скорость генерации страницы'),
(797, 'Select an action', 'ru', 'Выберите действие'),
(798, 'Up to top', 'ru', 'Поднять вверх'),
(799, 'Transaction completed', 'ru', 'Перевод завершен'),
(800, 'Transaction from admin', 'ru', 'Перевод от админа'),
(801, 'New transaction', 'ru', 'Сделать перевод'),
(802, 'Transfer amount', 'ru', 'Сумма перевода'),
(803, 'This is a daily report for the website traffic and performance on', 'ru', 'Это дневной отчет о посещаемости и нагрузки на сайт'),
(804, 'Thanks for using our service', 'ru', 'Спасибо за использование нашего сервиса'),
(805, 'daily report', 'ru', 'дневной отчет'),
(806, 'Under construction', 'ru', 'В разработке'),
(807, 'Time', 'ru', 'Время'),
(808, 'Continue shopping', 'ru', 'Продолжить покупки'),
(809, 'Process order?', 'ru', 'Оформить заказ?'),
(810, 'A new item has been added to your Shopping Cart', 'ru', 'Новый товар был добавлен в корзину'),
(811, 'item(s)', 'ru', 'товар(ов)'),
(812, 'Your Shopping Cart', 'ru', 'Ваша корзина'),
(813, 'Checkout order', 'ru', 'Оформить заказ'),
(814, 'Navigation', 'ru', 'Навигация'),
(815, 'Profile image', 'ru', 'Изображение профиля'),
(816, 'Page generation speed', 'ru', 'Скорость генерации страниц'),
(817, 'By hours', 'ru', 'По часам'),
(818, 'Average Server Response', 'ru', 'Среднее время ответа сервера'),
(819, 'Average Site Response', 'ru', 'Среднее время ответа сайта'),
(820, 'Perfomance', 'ru', 'Нагрузка'),
(821, 'The user makes a purchase', 'ru', 'Пользователь сделал покупку'),
(822, 'User confirmed the receipt of the order', 'ru', 'Пользователь подтвердил получение заказа'),
(823, 'Order has been shipped', 'ru', 'Заказ был отправлен'),
(824, 'The user makes a purchase and payment!', 'ru', 'Пользователь сделал покупку с оплатой!'),
(825, 'Checkout order?', 'ru', 'Оформить заказ?'),
(826, 'Drop file here', 'ru', 'Перетащите сюда файл'),
(827, 'Uploading', 'ru', 'Загрузка'),
(828, 'Open', 'ru', 'Открыть'),
(829, 'The funds', 'ru', 'Средства'),
(830, 'has beed added to your account balance', 'ru', 'были зачислины на счет Вашего аккаунта'),
(831, 'this link', 'ru', 'эту ссылку'),
(832, 'To confirm this password, use', 'ru', 'Для подтверждения пароля, используйте'),
(833, 'Close window', 'ru', 'Закрыть окно'),
(834, 'Sorry, this email already registered', 'ru', 'Извините, этот email уже зарегистрирован'),
(835, 'The funds have been added to your account balance', 'ru', 'Средства были зачислены на Ваш счет'),
(836, 'New password activated!', 'ru', 'Новый пароль активирован!'),
(837, 'already exist', 'ru', 'уже существует'),
(838, 'Checkout order?', 'en', 'Checkout order?'),
(839, 'Error! Drag-n-drop disabled on this server', 'en', 'Error! Drag-n-drop disabled on this server'),
(840, 'Uploading', 'en', 'Uploading'),
(841, 'Drop file here', 'en', 'Drop file here'),
(842, 'Error! Drag-n-drop disabled on this server', 'ru', 'Ошибка. Функция перетаскивания отключена'),
(843, 'The user makes a purchase and payment!', 'en', 'The user makes a purchase and payment!'),
(844, 'Order has been shipped', 'en', 'Order has been shipped'),
(845, 'User confirmed the receipt of the order', 'en', 'User confirmed the receipt of the order'),
(846, 'The user makes a purchase', 'en', 'The user makes a purchase'),
(847, 'online', 'en', 'online'),
(848, 'Perfomance', 'en', 'Perfomance'),
(849, 'By hours', 'en', 'By hours'),
(850, 'Average Server Response', 'en', 'Average Server Response'),
(851, 'Average Site Response', 'en', 'Average Site Response'),
(852, 'Page generation speed', 'en', 'Page generation speed'),
(853, 'Profile image', 'en', 'Profile image'),
(854, 'Navigation', 'en', 'Navigation'),
(855, 'Checkout order', 'en', 'Checkout order'),
(856, 'Your Shopping Cart', 'en', 'Your Shopping Cart'),
(857, 'item(s)', 'en', 'item(s)'),
(858, 'Process order?', 'en', 'Process order?'),
(859, 'A new item has been added to your Shopping Cart', 'en', 'A new item has been added to your Shopping Cart'),
(860, 'Continue shopping', 'en', 'Continue shopping'),
(861, 'Time', 'en', 'Time'),
(862, 'Under construction', 'en', 'Under construction'),
(863, 'daily report', 'en', 'daily report'),
(864, 'Thanks for using our service', 'en', 'Thanks for using our service'),
(865, 'This is a daily report for the website traffic and performance on', 'en', 'This is a daily report for the website traffic and performance on'),
(866, 'Transfer amount', 'en', 'Transfer amount'),
(867, 'New transaction', 'en', 'New transaction'),
(868, 'Transaction completed', 'en', 'Transaction completed'),
(869, 'Transaction from admin', 'en', 'Transaction from admin'),
(870, 'Page generation time', 'en', 'Page generation time'),
(871, 'Select an action', 'en', 'Select an action'),
(872, 'Up to top', 'en', 'Up to top'),
(873, 'Delete article', 'en', 'Delete article'),
(874, 'Engine version', 'en', 'Engine version'),
(875, 'Total pages', 'en', 'Total pages'),
(876, 'Total articles', 'en', 'Total articles'),
(877, 'Total products', 'en', 'Total products'),
(878, 'Total users', 'en', 'Total users'),
(879, 'Total comments', 'en', 'Total comments'),
(880, 'Visitors per day', 'en', 'Visitors per day'),
(881, 'Views per day', 'en', 'Views per day'),
(882, 'Cron status', 'ru', 'Cron статус'),
(883, 'Cache', 'ru', 'Кеш'),
(884, 'Any action', 'ru', 'Любое действие'),
(885, 'Email sended', 'ru', 'Email отправлен'),
(886, 'Empty', 'ru', 'Пусто'),
(887, 'Last visit', 'ru', 'Последний визит'),
(888, 'Profile', 'ru', 'Профиль'),
(889, 'Continue', 'ru', 'Продолжить'),
(890, 'Checkout', 'ru', 'Оформить'),
(891, 'Edit catalog', 'ru', 'Редактировать каталог'),
(892, 'Delete catalog', 'ru', 'Удалить каталог'),
(893, 'Articles', 'ru', 'Статьи'),
(894, 'Down to bottom', 'ru', 'Опустить вниз'),
(895, 'List articles', 'ru', 'Список статей'),
(896, 'User banned', 'ru', 'Пользователь забанен'),
(897, 'Show more', 'en', 'Show more'),
(898, 'Privacy Policy', 'en', 'Privacy Policy'),
(899, 'Terms & Conditions', 'en', 'Terms & Conditions'),
(900, 'Any', 'en', 'Any'),
(901, 'Outbox', 'en', 'Outbox'),
(902, 'Continue', 'en', 'Continue'),
(903, 'Checkout', 'en', 'Checkout'),
(904, 'Show comments', 'en', 'Show comments'),
(905, 'Latest comments', 'en', 'Latest comments'),
(906, 'Show more', 'ru', 'Показать все'),
(907, 'Privacy Policy', 'ru', 'Конфиденциальность'),
(908, 'Terms & Conditions', 'ru', 'Правила и условия'),
(909, 'Any', 'ru', 'Любой'),
(910, 'Outbox', 'ru', 'Рассылка'),
(911, 'Show comments', 'ru', 'Показать комментарии'),
(912, 'Latest comments', 'ru', 'Последние комментарии'),
(913, 'View source', 'en', 'View source'),
(914, 'Delete file', 'en', 'Delete file'),
(915, 'Delete template', 'en', 'Delete template'),
(916, 'View source', 'ru', 'Посмотреть исходник'),
(917, 'Delete file', 'ru', 'Удалить файл'),
(918, 'Delete template', 'ru', 'Удалить шаблон'),
(919, 'Articles', 'en', 'Articles'),
(920, 'Member of', 'en', 'Member of'),
(921, 'community', 'en', 'community'),
(922, 'Property', 'en', 'Property'),
(923, 'Copy to', 'en', 'Copy to'),
(924, 'translation', 'en', 'translation'),
(925, 'Member of', 'ru', 'Участник '),
(926, 'community', 'ru', 'комьюнити'),
(927, 'Property', 'ru', 'Свойство'),
(928, 'Copy to', 'ru', 'Скопировать в'),
(929, 'translation', 'ru', 'перевод'),
(930, 'Color', 'en', 'Color'),
(931, 'White', 'en', 'White'),
(932, 'Black', 'en', 'Black'),
(933, 'Silver', 'en', 'Silver'),
(934, 'Gray', 'en', 'Gray'),
(935, 'Color', 'ru', 'Цвет'),
(936, 'White', 'ru', 'Белый'),
(937, 'Black', 'ru', 'Черный'),
(938, 'Silver', 'ru', 'Серебристый'),
(939, 'Gray', 'ru', 'Серый'),
(940, 'New bulk message', 'en', 'New bulk message'),
(941, 'Profile', 'en', 'Profile'),
(942, 'Ok', 'en', 'Ok'),
(943, 'Cron status', 'en', 'Cron status'),
(944, 'Cache', 'en', 'Cache'),
(945, 'List articles', 'en', 'List articles'),
(946, 'Edit catalog', 'en', 'Edit catalog'),
(947, 'Delete catalog', 'en', 'Delete catalog'),
(948, 'New bulk message', 'ru', 'Новая рассылка'),
(949, 'Resolution', 'en', 'Resolution'),
(950, 'Resolution', 'ru', 'Разрешение'),
(951, '1440 x 2560', 'en', '1440 x 2560'),
(952, '1080 x 1920', 'en', '1080 x 1920'),
(953, 'Close', 'en', 'Close'),
(954, 'Toggle fullscreen', 'en', 'Toggle fullscreen'),
(955, 'Zoom in/out', 'en', 'Zoom in/out'),
(956, 'Previous (arrow left)', 'en', 'Previous (arrow left)'),
(957, 'Next (arrow right)', 'en', 'Next (arrow right)'),
(958, 'votes', 'en', 'votes'),
(959, 'Share friends', 'en', 'Share friends'),
(960, 'Submitted on', 'en', 'Submitted on'),
(961, 'Close', 'ru', 'Закрыть'),
(962, 'Toggle fullscreen', 'ru', 'Включить полноэкранный режим'),
(963, 'Zoom in/out', 'ru', 'Увеличить/Уменьшить'),
(964, 'Previous (arrow left)', 'ru', 'Назад (стрелка влево)'),
(965, 'Next (arrow right)', 'ru', 'Вперед (стрелка вправо)'),
(966, 'votes', 'ru', 'голосов'),
(967, 'Share friends', 'ru', 'Поделиться'),
(968, 'Submitted on', 'ru', 'Опубликовано'),
(969, 'Share', 'en', 'Share'),
(970, 'Subscription', 'en', 'Subscription'),
(971, 'Down to bottom', 'en', 'Down to bottom'),
(972, 'Back to list', 'en', 'Back to list'),
(973, 'Passwords do not match', 'en', 'Passwords do not match'),
(974, 'Repeat password', 'en', 'Repeat password'),
(975, 'We are glad to confirm successful registration at', 'en', 'We are glad to confirm successful registration at'),
(976, 'By registering on the site, you accept the', 'en', 'By registering on the site, you accept the'),
(977, 'Terms and Conditions', 'en', 'Terms and Conditions'),
(978, 'and are familiar with the', 'en', 'and are familiar with the'),
(979, 'Delete account', 'en', 'Delete account'),
(980, 'Are you sure you want to delete your account', 'en', 'Are you sure you want to delete your account'),
(981, 'Empty', 'en', 'Empty'),
(982, 'Any action', 'en', 'Any action'),
(983, 'Email sended', 'en', 'Email sended'),
(984, 'Messages not found', 'en', 'Messages not found'),
(985, 'Send to email', 'en', 'Send to email'),
(986, 'Send in chat', 'en', 'Send in chat'),
(987, 'Text of message', 'en', 'Text of message'),
(988, 'Send messages', 'en', 'Send messages'),
(989, 'Back to outbox', 'en', 'Back to outbox'),
(990, 'Referrer', 'en', 'Referrer'),
(991, 'Actions', 'en', 'Actions'),
(992, 'View session', 'en', 'View session'),
(993, 'Mouse move to', 'en', 'Mouse move to'),
(994, 'Actions are finished at', 'en', 'Actions are finished at'),
(995, 'Click to', 'en', 'Click to'),
(996, 'Session finished', 'en', 'Session finished'),
(997, 'Mouse move to', 'ru', 'Перемещение мышки на'),
(998, 'Actions are finished at', 'ru', 'Действия закончены '),
(999, 'Click to', 'ru', 'Клик на'),
(1000, 'Session finished', 'ru', 'Сессия окночена'),
(1001, 'Passwords do not match', 'ru', 'Пароли не совпадают'),
(1002, 'Repeat password', 'ru', 'Повтрный пароль'),
(1003, 'We are glad to confirm successful registration at', 'ru', 'Мы рады подтвердить успешную регистрацию на'),
(1004, 'By registering on the site, you accept the', 'ru', 'Регистрируясь, вы принимаете'),
(1005, 'Terms and Conditions', 'ru', 'Пользовательское соглашение'),
(1006, 'and are familiar with the', 'ru', 'и согласны с условиями раздела'),
(1007, 'Delete account', 'ru', 'Удалить аккаунт'),
(1008, 'Are you sure you want to delete your account', 'ru', 'Вы уверены что хотите удалить Ваш аккаунт?'),
(1009, 'Messages not found', 'ru', 'Сообщения не найдены'),
(1010, 'Send to email', 'ru', 'Отправить на email'),
(1011, 'Send in chat', 'ru', 'Отправить в чат'),
(1012, 'Text of message', 'ru', 'Текст сообщения'),
(1013, 'Send messages', 'ru', 'Отправить сообщения'),
(1014, 'Back to outbox', 'ru', 'Назад к рассылкам'),
(1015, 'Referrer', 'ru', 'Реферер'),
(1016, 'Actions', 'ru', 'Действия'),
(1017, 'View session', 'ru', 'Просмотр сессии'),
(1020, 'Share', 'ru', 'Поделиться'),
(1021, 'Subscription', 'ru', 'Рассылка'),
(1022, 'Back to list', 'ru', 'Вернуться к списку'),
(1023, 'Internal Server Error', 'en', 'Internal Server Error'),
(1024, 'Pending payment', 'en', 'Pending payment'),
(1025, 'Invoice', 'en', 'Invoice'),
(1026, 'An invoice for payment', 'en', 'An invoice for payment'),
(1027, 'Invoice date for payment', 'en', 'Invoice date for payment'),
(1029, 'Total', 'en', 'Total'),
(1030, 'Total Paid', 'en', 'Total Paid'),
(1031, 'Amount to be paid', 'en', 'Amount to be paid'),
(1032, 'Make payment', 'en', 'Make payment'),
(1033, 'Successfully paid', 'en', 'Successfully paid'),
(1034, 'Partially paid', 'en', 'Partially paid'),
(1035, 'The funds have been added to your account balance', 'en', 'The funds have been added to your account balance'),
(1036, 'Your cart is empty', 'en', 'Your cart is empty'),
(1037, 'View invoice', 'en', 'View invoice');
INSERT INTO `nodes_language` (`id`, `name`, `lang`, `value`) VALUES
(1038, 'Order payment', 'en', 'Order payment'),
(1039, 'Step', 'en', 'Step'),
(1040, 'Login to website', 'en', 'Login to website'),
(1041, 'Close window', 'en', 'Close window'),
(1042, 'Step', 'ru', 'Шаг'),
(1043, 'Login to website', 'ru', 'Авторизоваться на сайте'),
(1044, 'Internal Server Error', 'ru', 'Внутренняя ошибка сервера'),
(1045, 'Pending payment', 'ru', 'Ожидается оплата'),
(1046, 'Invoice', 'ru', 'Cчет'),
(1047, 'An invoice for payment', 'ru', 'Счет на оплату'),
(1048, 'Invoice date for payment', 'ru', 'Дата '),
(1049, 'Bill for payment for the user', 'ru', ''),
(1050, 'Total', 'ru', 'Итого'),
(1051, 'Total Paid', 'ru', 'Оплачено'),
(1052, 'Amount to be paid', 'ru', 'К оплате'),
(1053, 'Make payment', 'ru', 'Совершить платеж'),
(1054, 'Successfully paid', 'ru', 'Успешно оплачено'),
(1055, 'Partially paid', 'ru', 'Частично оплачено'),
(1056, 'Your cart is empty', 'ru', 'Ваша корзина пуста'),
(1057, 'View invoice', 'ru', 'Счет на оплату'),
(1058, 'Order payment', 'ru', 'Оплата заказа'),
(1059, 'Select payment method', 'en', 'Select payment method'),
(1060, 'Toggle navigation', 'en', 'Toggle navigation'),
(1061, 'Select an image to upload', 'en', 'Select an image to upload'),
(1097, 'Select payment method', 'ru', 'Выберите способ оплаты'),
(1064, 'Administrators not found', 'en', 'Administrators not found'),
(1099, 'Select an image to upload', 'ru', 'Выберите изображение для загрузки'),
(1098, 'Toggle navigation', 'ru', 'Переключить навигацию'),
(1081, 'Edit permission', 'en', 'Edit permission'),
(1082, 'Delete from admin', 'en', 'Delete from admin'),
(1083, 'Make admin', 'en', 'Make admin'),
(1084, 'Manage permission', 'en', 'Manage permission'),
(1085, 'Manage permission of', 'en', 'Manage permission of'),
(1086, 'Back to access', 'en', 'Back to access'),
(1087, 'Section', 'en', 'Section'),
(1088, 'Permission', 'en', 'Permission'),
(1089, 'No access', 'en', 'No access'),
(1090, 'Read-only', 'en', 'Read-only'),
(1091, 'Full access', 'en', 'Full access'),
(1092, 'Primary admin', 'en', 'Primary admin'),
(1093, 'Send as notification', 'en', 'Send as notification'),
(1094, 'Bulk message is sending now', 'en', 'Bulk message is sending now'),
(1095, 'Complete item description', 'en', 'Complete item description'),
(1096, 'Add new admin', 'en', 'Add new admin'),
(1100, 'Administrators not found', 'ru', 'Администраторы не найдены'),
(1101, 'Edit permission', 'ru', 'Редактировать права'),
(1102, 'Delete from admin', 'ru', 'Удалить из админов'),
(1103, 'Make admin', 'ru', 'Сделать админом'),
(1104, 'Manage permission', 'ru', 'Управление правами'),
(1105, 'Manage permission of', 'ru', 'Управление правами пользователя'),
(1106, 'Back to access', 'ru', 'Наза к доступу'),
(1107, 'Section', 'ru', 'Секция'),
(1108, 'Permission', 'ru', 'Права'),
(1109, 'No access', 'ru', 'Нет доступа'),
(1110, 'Read-only', 'ru', 'Только чтение'),
(1111, 'Full access', 'ru', 'Полный доступ'),
(1112, 'Primary admin', 'ru', 'Главный админ'),
(1113, 'Send as notification', 'ru', 'Отправить уведомление'),
(1114, 'Bulk message is sending now', 'ru', 'Массовое сообщение отправляется'),
(1115, 'Complete item description', 'ru', 'Полное описание товара'),
(1116, 'Add new admin', 'ru', 'Добавить администратора'),
(1117, 'Do not have an account?', 'en', 'Do not have an account?'),
(1118, 'Forgot password', 'en', 'Forgot password'),
(1119, 'Reset password', 'en', 'Reset password'),
(1120, 'To confirm this password, use', 'en', 'To confirm this password, use'),
(1121, 'this link', 'en', 'this link'),
(1122, 'To process restore, please check your email', 'en', 'To process restore, please check your email'),
(1123, 'Setup new password', 'en', 'Setup new password'),
(1124, 'New password activated!', 'en', 'New password activated!'),
(1125, 'Request for withdrawal of funds', 'en', 'Request for withdrawal of funds'),
(1126, 'Your withdrawal request will be processed within a few days of submitting', 'en', 'Your withdrawal request will be processed within a few days of submitting'),
(1127, 'Wallet', 'en', 'Wallet'),
(1128, 'Wallet ID', 'en', 'Wallet ID'),
(1129, 'Confirm request', 'en', 'Confirm request'),
(1130, 'Back to finances', 'en', 'Back to finances'),
(1131, 'Withdrawal confirmation', 'en', 'Withdrawal confirmation'),
(1132, 'Withdrawal request processed', 'en', 'Withdrawal request processed'),
(1133, 'Do not have an account?', 'ru', 'Еще не зарегистрированы?'),
(1134, 'Forgot password', 'ru', 'Забыли пароль'),
(1135, 'Reset password', 'ru', 'Сбросить пароль'),
(1136, 'To process restore, please check your email', 'ru', 'Чтобы восстановить пароль, пожалуйста, проверьте Ваш email'),
(1137, 'Setup new password', 'ru', 'Установить новый пароль'),
(1138, 'Request for withdrawal of funds', 'ru', 'Запрос на вывод средств'),
(1139, 'Your withdrawal request will be processed within a few days of submitting', 'ru', 'Ваш запрос на снятие средств будет обработан в течение нескольких дней после отправки'),
(1140, 'Wallet', 'ru', 'Кошелек'),
(1141, 'Wallet ID', 'ru', 'ID кошелька'),
(1142, 'Confirm request', 'ru', 'Подтвердить запрос'),
(1143, 'Back to finances', 'ru', 'Назад к финансам'),
(1144, 'Withdrawal confirmation', 'ru', 'Подтверждение вывода средств'),
(1145, 'Withdrawal request processed', 'ru', 'Запрос на снятие средств обработан'),
(1146, 'Latest Articles', 'en', 'Latest Articles'),
(1147, 'Popular goods', 'en', 'Popular goods'),
(1148, 'Anonim', 'en', 'Anonim'),
(1149, 'To confirm your email, please enter or click on the following code', 'en', 'To confirm your email, please enter or click on the following code'),
(1150, 'Account confirmation', 'en', 'Account confirmation'),
(1151, 'dApp', 'en', 'dApp'),
(1152, 'WebVR', 'en', 'WebVR'),
(1153, 'Web 3.0 DAO', 'en', 'Web 3.0 DAO'),
(1154, 'Social', 'en', 'Social'),
(1155, 'Web 3.0 Mansion', 'en', 'Web 3.0 Mansion'),
(1156, 'Panoramas', 'en', 'Panoramas'),
(1157, 'Image description', 'en', 'Image description'),
(1158, 'Social graph', 'en', 'Social graph'),
(1159, 'Telegram group', 'en', 'Telegram group'),
(1160, 'Digital constitution', 'en', 'Digital constitution'),
(1161, 'Crypto democracy', 'en', 'Crypto democracy'),
(1162, 'Crowdfunding', 'en', 'Crowdfunding'),
(1163, 'P2P marketplace', 'en', 'P2P marketplace'),
(1164, 'DAO', 'en', 'DAO'),
(1165, 'Git repository', 'en', 'Git repository'),
(1166, 'Capitalization', 'en', 'Capitalization'),
(1167, 'Blockchain monitor', 'en', 'Blockchain monitor'),
(1168, 'Decentralized management', 'en', 'Decentralized management'),
(1169, 'Project Name', 'en', 'Project Name'),
(1170, 'Levels', 'en', 'Levels'),
(1171, 'Scenes', 'en', 'Scenes'),
(1172, 'Objects', 'en', 'Objects'),
(1173, 'Portals', 'en', 'Portals'),
(1174, 'Links', 'en', 'Links'),
(1175, 'Add new project', 'en', 'Add new project'),
(1176, 'Project whitepaper', 'en', 'Project whitepaper'),
(1177, 'Booking rooms', 'en', 'Booking rooms'),
(1178, 'Free look mode', 'en', 'Free look mode'),
(1179, 'Orbital preview', 'en', 'Orbital preview'),
(1180, 'Panorama viewer', 'en', 'Panorama viewer'),
(1181, 'Multiplayer game', 'en', 'Multiplayer game'),
(1182, 'Latest Articles', 'ru', 'Последние статьи'),
(1183, 'Popular goods', 'ru', 'Популярные товары'),
(1184, 'Anonim', 'ru', 'Аноним'),
(1185, 'To confirm your email, please enter or click on the following code', 'ru', 'Чтобы подтвердить адрес электронной почты, используйте код'),
(1186, 'dApp', 'ru', 'dApp'),
(1187, 'WebVR', 'ru', 'WebVR'),
(1188, 'Web 3.0 DAO', 'ru', 'Web 3.0 DAO'),
(1189, 'Social', 'ru', 'Социум'),
(1190, 'Web 3.0 Mansion', 'ru', 'Web 3.0 Вилла'),
(1191, 'Panoramas', 'ru', 'Панорамы'),
(1192, 'Image description', 'ru', 'Описание изображения'),
(1193, 'Social graph', 'ru', 'Социальный граф'),
(1194, 'Telegram group', 'ru', 'Telegram группа'),
(1195, 'Digital constitution', 'ru', 'Цифровая конституция'),
(1196, 'Crypto democracy', 'ru', 'Крипто демократия'),
(1197, 'Crowdfunding', 'ru', 'Краудфандинг'),
(1198, 'P2P marketplace', 'ru', 'P2P площадка'),
(1199, 'DAO', 'ru', 'DAO'),
(1200, 'Git repository', 'ru', 'Git репозиторий'),
(1201, 'Capitalization', 'ru', 'Капитализация'),
(1202, 'Blockchain monitor', 'ru', 'Blockchain монитор'),
(1203, 'Decentralized management', 'ru', 'Общественное управление'),
(1204, 'Project Name', 'ru', 'Название проекта'),
(1205, 'Levels', 'ru', 'Уровни'),
(1206, 'Scenes', 'ru', 'Сцены'),
(1207, 'Objects', 'ru', 'Обьекты'),
(1208, 'Portals', 'ru', 'Порталы'),
(1209, 'Links', 'ru', 'Ссылки'),
(1210, 'Add new project', 'ru', 'Добавить новый проект'),
(1211, 'Project whitepaper', 'ru', 'Описание проекта'),
(1212, 'Booking rooms', 'ru', 'Аренда комнат'),
(1213, 'Free look mode', 'ru', 'Свободный режим'),
(1214, 'Orbital preview', 'ru', 'Орбитальный режим'),
(1215, 'Panorama viewer', 'ru', 'Панорамный режим'),
(1216, 'Multiplayer game', 'ru', 'Сетевая игра'),
(1217, 'Last editing on', 'en', 'Last editing on'),
(1218, 'Decentralized management', 'zh', '分散管理'),
(1219, 'Project Name', 'zh', '項目名'),
(1220, 'Levels', 'zh', '級別'),
(1221, 'Scenes', 'zh', '場景'),
(1222, 'Objects', 'zh', '對象'),
(1223, 'Portals', 'zh', '門戶網站'),
(1224, 'Links', 'zh', '超链接'),
(1225, 'Add new project', 'zh', '添加新項目'),
(1226, 'Project whitepaper', 'zh', '項目白皮書'),
(1227, 'Booking rooms', 'zh', '預訂房間'),
(1228, 'Free look mode', 'zh', '自由觀看模式'),
(1229, 'Orbital preview', 'zh', '軌道預覽'),
(1230, 'Panorama viewer', 'zh', '全景瀏覽器'),
(1231, 'Multiplayer game', 'zh', '多人遊戲'),
(1232, 'Last editing on', 'zh', '最後編輯於'),
(1233, 'Anonim', 'zh', '匿名的'),
(1234, 'To confirm your email, please enter or click on the following code', 'zh', '要確認您的電子郵件，請輸入或點擊以下代碼'),
(1235, 'Account confirmation', 'zh', '賬戶確認'),
(1236, 'dApp', 'zh', 'dApp'),
(1237, 'WebVR', 'zh', 'WebVR'),
(1238, 'Web 3.0 DAO', 'zh', 'Web 3.0 DAO'),
(1239, 'Social', 'zh', '社會的'),
(1240, 'Web 3.0 Mansion', 'zh', 'Web 3.0 大廈'),
(1241, 'Panoramas', 'zh', '全景圖'),
(1242, 'Image description', 'zh', '圖片描述'),
(1243, 'Social graph', 'zh', '社交圖譜'),
(1244, 'Telegram group', 'zh', '电报集团'),
(1245, 'Digital constitution', 'zh', '數字憲法'),
(1246, 'Crypto democracy', 'zh', '加密民主'),
(1247, 'Crowdfunding', 'zh', '眾籌'),
(1248, 'P2P marketplace', 'zh', 'P2P市場'),
(1249, 'DAO', 'zh', 'DAO'),
(1250, 'Git repository', 'zh', 'Git 存儲庫'),
(1251, 'Capitalization', 'zh', '大寫'),
(1252, 'Blockchain monitor', 'zh', '區塊鏈監控器'),
(1253, 'Upload', 'zh', '上傳'),
(1254, 'Link', 'zh', '超鏈接'),
(1255, 'Cancel', 'zh', '取消'),
(1256, 'Uploaded', 'zh', '已上傳'),
(1257, 'For uploading selected area use double click', 'zh', '要上傳選定區域，請使用雙擊'),
(1258, 'Error', 'zh', '錯誤'),
(1259, 'Or file', 'zh', '或歸檔'),
(1260, 'Upload image', 'zh', '上傳圖片'),
(1261, 'Sitemap', 'zh', '網站地圖'),
(1262, 'Format', 'zh', '格式'),
(1263, 'Upload new image', 'zh', '上傳新圖片'),
(1264, 'Logout sucsessful', 'zh', '註銷成功'),
(1265, 'Quit', 'zh', '退出'),
(1266, 'Site', 'zh', '場地'),
(1267, 'Users', 'zh', '用戶'),
(1268, 'Comments', 'zh', '評論'),
(1269, 'Content', 'zh', '內容'),
(1270, 'Errors', 'zh', '错误'),
(1271, 'Files', 'zh', '文件'),
(1272, 'Images', 'zh', '圖片'),
(1273, 'Videos', 'zh', '視頻'),
(1274, 'Access', 'zh', '存取'),
(1275, 'Config', 'zh', '配置'),
(1276, 'Backend', 'zh', '后端'),
(1277, 'Logout', 'zh', '登出'),
(1278, 'Password', 'zh', '密碼'),
(1279, 'Upload selection as thumb?', 'zh', '將選擇上傳為拇指？'),
(1280, 'Save uploaded images', 'zh', '保存上傳的圖像'),
(1281, 'Previous page', 'zh', '上一頁'),
(1282, 'Next page', 'zh', '下一頁'),
(1283, 'Updated', 'zh', '更新'),
(1284, 'Interval', 'zh', '音程'),
(1285, 'Not existing', 'zh', '不存在'),
(1286, 'Not cathing', 'zh', '不捕捉'),
(1287, 'Not refreshing', 'zh', '不清爽'),
(1288, 'minut', 'zh', '分鐘'),
(1289, 'minuts', 'zh', '分鐘'),
(1290, 'hour', 'zh', '小時'),
(1291, 'hours', 'zh', '小時'),
(1292, 'Dayly', 'zh', '日常的'),
(1293, 'Change interval', 'zh', '變更間隔'),
(1294, 'Refresh catch', 'zh', '刷新捕獲'),
(1295, 'Edit article', 'zh', '編輯文章'),
(1296, 'Caption', 'zh', '標題'),
(1297, 'No image', 'zh', '沒有圖像'),
(1298, 'Edit directory', 'zh', '編輯目錄'),
(1299, 'Return', 'zh', '返回'),
(1300, 'Add new article', 'zh', '添加新文章'),
(1301, 'Edit', 'zh', '編輯'),
(1302, 'Delete', 'zh', '刪除'),
(1303, 'Add a new directory', 'zh', '添加新目錄'),
(1304, 'Description', 'zh', '描述'),
(1305, 'Back', 'zh', '後退'),
(1306, 'List', 'zh', '列表'),
(1307, 'Add', 'zh', '添加'),
(1308, 'Preview', 'zh', '預覽'),
(1309, 'Uploading files', 'zh', '上傳文件'),
(1310, 'File', 'zh', '文件'),
(1311, 'Submit', 'zh', '提交'),
(1312, 'Included files', 'zh', '包含的文件'),
(1313, 'Path', 'zh', '小路'),
(1314, 'Class', 'zh', '班級'),
(1315, 'Create new file', 'zh', '創建新文件'),
(1316, 'Lost password', 'zh', '忘記密碼'),
(1317, 'allready exist', 'zh', '已經存在'),
(1318, 'Incorrect email of password', 'zh', '密碼郵箱不正確'),
(1319, 'not found', 'zh', '未找到'),
(1320, 'Message with new password is sended to email', 'zh', '帶有新密碼的消息已發送至電子郵件'),
(1321, 'New password is', 'zh', '新密碼是'),
(1322, 'New password for', 'zh', '新密碼為'),
(1323, 'Registration sucsessful', 'zh', '註冊成功'),
(1324, 'We are glad to confirm sucsessful registration at', 'zh', '我們很高興確認註冊成功'),
(1325, 'About software', 'zh', '關於軟件'),
(1326, 'Errors not found', 'zh', '未發現錯誤'),
(1327, 'Clear log', 'zh', '清除日誌'),
(1328, 'Date', 'zh', '日期'),
(1329, 'New user', 'zh', '新用戶'),
(1330, 'Name', 'zh', '姓名'),
(1331, 'Ban', 'zh', '禁止'),
(1332, 'Unban', 'zh', '解禁'),
(1333, 'Confirm deleting banned user', 'zh', '確認刪除被禁止的用戶'),
(1334, 'Create user', 'zh', '創建用戶'),
(1335, 'Incorrect email', 'zh', '不正確的電子郵件'),
(1336, 'Enter password', 'zh', '輸入密碼'),
(1337, 'Update interval', 'zh', '更新間隔'),
(1338, 'All pages', 'zh', '所有頁面'),
(1339, 'Logs', 'zh', '日誌'),
(1340, 'Text', 'zh', '文本'),
(1341, 'Pages not found', 'zh', '找不到頁面'),
(1342, 'Sign Up', 'zh', '報名'),
(1343, 'Admin', 'zh', '行政'),
(1344, 'Upload files', 'zh', '上傳文件'),
(1345, 'Account', 'zh', '帳戶'),
(1346, 'Save settings', 'zh', '保存設置'),
(1347, 'Access denied', 'zh', '拒絕訪問'),
(1348, 'Message sent successfully', 'zh', '消息已成功發送'),
(1349, 'New message from', 'zh', '新消息來自'),
(1350, 'My Account', 'zh', '我的賬戶'),
(1351, 'Show navigation', 'zh', '顯示導航'),
(1352, 'Get in Touch', 'zh', '保持聯繫'),
(1353, 'Contact Us', 'zh', '聯繫我們'),
(1354, 'Your message here', 'zh', '您的留言在這裡'),
(1355, 'Send message', 'zh', '發信息'),
(1356, 'Developed by', 'zh', '由開發'),
(1357, 'Up', 'zh', '盒'),
(1358, 'Show All', 'zh', '顯示所有'),
(1359, 'Change picture', 'zh', '更換圖片'),
(1360, 'Enter your email and password to continue', 'zh', '輸入您的電子郵件和密碼以繼續'),
(1361, 'Settings', 'zh', '設置'),
(1362, 'Email', 'zh', '郵件'),
(1363, 'New password', 'zh', '新密碼'),
(1364, 'Enter your email', 'zh', '輸入你的電子郵箱'),
(1365, 'Enter your password', 'zh', '輸入您的密碼'),
(1366, 'Save changes', 'zh', '保存更改'),
(1367, 'Back to account', 'zh', '返回帳戶'),
(1368, 'Invalid conformation code', 'zh', '確認碼無效'),
(1369, 'Registration at', 'zh', '註冊於'),
(1370, 'Confirmation code', 'zh', '驗證碼'),
(1371, 'No articles found', 'zh', '沒有找到文章'),
(1372, 'Messages', 'zh', '消息'),
(1373, 'Back to admin', 'zh', '返回管理'),
(1374, 'Status', 'zh', '地位'),
(1375, 'Yes', 'zh', '是的'),
(1376, 'No', 'zh', '但'),
(1377, 'Show in navigation', 'zh', '在導航中顯示'),
(1378, 'Back to content', 'zh', '返回內容'),
(1379, 'Delete image', 'zh', '刪除圖像'),
(1380, 'Comments not found', 'zh', '未找到評論'),
(1381, 'Add reply', 'zh', '添加回复'),
(1382, 'Users not found', 'zh', '未找到用戶'),
(1383, 'Share friends in', 'zh', '分享朋友在'),
(1384, 'Language', 'zh', '語言'),
(1385, 'Home', 'zh', '家'),
(1386, 'Connect us at', 'zh', '聯繫我們'),
(1387, 'Copyright', 'zh', '版權'),
(1388, 'All rights reserved', 'zh', '版權所有'),
(1389, 'There is no users, you can send a message', 'zh', '還沒有用戶，您可以留言'),
(1390, 'offline', 'zh', '離線'),
(1391, 'Add comment', 'zh', '添加評論'),
(1392, 'Submit comment', 'zh', '提交評論'),
(1393, 'Add new comment', 'zh', '添加新評論'),
(1394, 'There is no comments', 'zh', '沒有評論'),
(1395, 'Comment submited!', 'zh', '評論已提交！'),
(1396, 'To post a comment, please', 'zh', '要發表評論，請'),
(1397, 'Reply', 'zh', '酬對'),
(1398, 'Select your language', 'zh', '選擇你的語言'),
(1399, 'Search', 'zh', '搜索'),
(1400, 'Search results by request', 'zh', '按請求搜索結果'),
(1401, 'Documentation', 'zh', '文檔'),
(1402, 'Add new value', 'zh', '增加新價值'),
(1403, 'Download', 'zh', '下載'),
(1404, 'Install', 'zh', '安裝'),
(1405, 'Framework', 'zh', '骨'),
(1406, 'Useful services', 'zh', '有用的服務'),
(1407, 'Setup', 'zh', '設置'),
(1408, 'Login to send message', 'zh', '登錄後發送消息'),
(1409, 'Add article', 'zh', '添加文章'),
(1410, 'register now', 'zh', '現在註冊'),
(1411, 'auth', 'zh', '核准'),
(1412, 'There is no articles', 'zh', '沒有文章'),
(1413, 'Functions', 'zh', '功能'),
(1414, 'Database', 'zh', '數據庫'),
(1415, 'Sorry, no results found', 'zh', '抱歉，沒有找到結果'),
(1416, 'Value', 'zh', '價值'),
(1417, 'Showing', 'zh', '顯示'),
(1418, 'to', 'zh', '從'),
(1419, 'from', 'zh', '到'),
(1420, 'entries', 'zh', '條記錄'),
(1421, 'per page', 'zh', '每頁'),
(1422, 'Next', 'zh', '下一個'),
(1423, 'Previous', 'zh', '以前的'),
(1424, 'Code', 'zh', '代碼'),
(1425, 'Select option', 'zh', '選擇選項'),
(1426, 'Content not found', 'zh', '未找到內容'),
(1427, 'Crop image', 'zh', '裁剪圖像'),
(1428, 'Sended', 'zh', '已發送'),
(1429, 'at', 'zh', '在'),
(1430, 'Too many failed attempts', 'zh', '嘗試失敗次數過多'),
(1431, 'Try again after', 'zh', '之後重試'),
(1432, 'seconds', 'zh', '秒'),
(1433, 'Action', 'zh', '行動'),
(1434, 'User', 'zh', '用戶'),
(1435, 'IP', 'zh', '網際協定'),
(1436, 'New message', 'zh', '新消息'),
(1437, 'Clear logs', 'zh', '清除日誌'),
(1438, 'Logs not found', 'zh', '未找到日誌'),
(1439, 'Updates', 'zh', '更新'),
(1440, 'Autoupdate', 'zh', '自動更新'),
(1441, 'Enabled', 'zh', '啟用'),
(1442, 'Disabled', 'zh', '殘疾人'),
(1443, 'Authentication error', 'zh', '授權錯誤'),
(1444, 'Authentication timeout', 'zh', '認證超時'),
(1445, 'Restore password', 'zh', '恢復密碼'),
(1446, 'Received', 'zh', '已收到'),
(1447, 'new messages', 'zh', '新消息'),
(1448, 'Updating engine from version', 'zh', '從版本更新引擎'),
(1449, 'Downloading files', 'zh', '下載文件'),
(1450, 'Receiving', 'zh', '接收'),
(1451, 'Update aborted', 'zh', '更新已中止'),
(1452, 'Replacing downloaded files from', 'zh', '替換下載的文件'),
(1453, 'Receiving MySQL data', 'zh', '接收MySQL數據'),
(1454, 'Executed', 'zh', '執行'),
(1455, 'commands', 'zh', '命令'),
(1456, 'Updating to version', 'zh', '更新到版本'),
(1457, 'is complete', 'zh', '做完了'),
(1458, 'after 5 seconds', 'zh', '5秒後'),
(1459, 'Current version', 'zh', '當前版本'),
(1460, 'New updates available', 'zh', '有新的更新'),
(1461, 'Update Now', 'zh', '現在更新'),
(1462, 'No updates available', 'zh', '無可用更新'),
(1463, 'Invalid confirmation code', 'zh', '確認碼無效'),
(1464, 'Data not found', 'zh', '未找到數據'),
(1465, 'Trying to register', 'zh', '正在嘗試註冊'),
(1466, 'Comment posted', 'zh', '發表評論'),
(1467, 'There is no files', 'zh', '沒有文件'),
(1468, 'Login', 'zh', '登錄'),
(1469, 'Loading', 'zh', '加載中'),
(1470, 'Page not found', 'zh', '找不到網頁'),
(1471, 'Back to Home Page', 'zh', '返回主頁'),
(1472, 'or', 'zh', '或'),
(1473, 'Attendance', 'zh', '出席率'),
(1474, 'Back to Top', 'zh', '回到頂部'),
(1475, 'Search results for', 'zh', '為。。。。尋找結果'),
(1476, 'Templates', 'zh', '模板'),
(1477, 'Default file', 'zh', '默認文件'),
(1478, 'New file', 'zh', '新文件'),
(1479, 'New template', 'zh', '新模板'),
(1480, 'Default template', 'zh', '默認模板'),
(1481, 'Template name', 'zh', '模板名稱'),
(1482, 'Views', 'zh', '意見'),
(1483, 'Visitors', 'zh', '訪客'),
(1484, 'Statistic', 'zh', '統計'),
(1485, 'Pages', 'zh', '頁數'),
(1486, 'Referrers', 'zh', '推薦人'),
(1487, 'By days', 'zh', '按天數'),
(1488, 'By weeks', 'zh', '按週計算'),
(1489, 'By months', 'zh', '按月計算'),
(1490, 'Amount', 'zh', '數量'),
(1491, 'Blank', 'zh', '空白的'),
(1492, 'Restore your password', 'zh', '恢復您的密碼'),
(1493, 'To restore your password, use this code', 'zh', '要恢復您的密碼，請使用此代碼'),
(1494, 'Message with confirmation code is sended to email', 'zh', '帶有確認碼的消息已發送至電子郵件'),
(1495, 'There is no templates', 'zh', '沒有模板'),
(1496, 'Register', 'zh', '登記'),
(1497, 'Try to register', 'zh', '嘗試註冊'),
(1498, 'Trying to login', 'zh', '正在嘗試登錄'),
(1499, 'Engine update', 'zh', '引擎更新'),
(1500, 'Withdrawal already requested', 'zh', '已請求提款'),
(1501, 'Withdrawal request accepted', 'zh', '提款請求已接受'),
(1502, 'Select file', 'zh', '選擇文件'),
(1503, 'Editable file', 'zh', '可編輯文件'),
(1504, 'Source file', 'zh', '源文件'),
(1505, 'Gateway Timeout', 'zh', '網關超時'),
(1506, 'Image too small. Minimal size is 400x400', 'zh', '圖片太小。 最小尺寸為 400x400'),
(1507, 'Drop files here', 'zh', '將文件拖放到此處'),
(1508, 'System message', 'zh', '系統消息'),
(1509, 'sign in', 'zh', '登入'),
(1510, 'Confirm Shipment', 'zh', '確認發貨'),
(1511, 'Post track number', 'zh', '發布曲目編號'),
(1512, 'Shipment is confirmed', 'zh', '發貨已確認'),
(1513, 'This item is sold out now?', 'zh', '這個商品現在已經賣完了嗎？'),
(1514, 'New order', 'zh', '新命令'),
(1515, 'Archive order', 'zh', '歸檔訂單'),
(1516, 'Finished', 'zh', '完成的'),
(1517, 'Purchaser', 'zh', '採購員'),
(1518, 'Shipping address', 'zh', '收件地址'),
(1519, 'All Items', 'zh', '所有項目'),
(1520, 'Buy Now!', 'zh', '立即購買！'),
(1521, 'Title', 'zh', '標題'),
(1522, 'Ask price', 'zh', '詢問價格'),
(1523, 'Edit product', 'zh', '編輯產品'),
(1524, 'Click to Deactivate', 'zh', '單擊以停用'),
(1525, 'Click to Activate', 'zh', '點擊激活'),
(1526, 'You might also be interested in', 'zh', '你也可能對此有興趣'),
(1527, 'Products not found', 'zh', '未找到產品'),
(1528, 'Category', 'zh', '類別'),
(1529, 'Reset Filter', 'zh', '重置過濾器'),
(1530, 'Unable to purchase your own product', 'zh', '無法購買自己的產品'),
(1531, 'Buy Now', 'zh', '立即購買'),
(1532, 'Tracking number', 'zh', '追踪號碼'),
(1533, 'Shipment in process', 'zh', '發貨中'),
(1534, 'Confirm receipt', 'zh', '確認收據'),
(1535, 'Seller', 'zh', '賣方'),
(1536, 'Shipping from', 'zh', '發貨自'),
(1537, 'New comment at', 'zh', '新評論位於'),
(1538, 'New message at', 'zh', '新消息位於'),
(1539, 'Dear', 'zh', '親愛的'),
(1540, 'sent a message for you', 'zh', '給你發了一條消息'),
(1541, 'For details, click', 'zh', '詳情請點擊'),
(1542, 'here', 'zh', '這裡'),
(1543, 'Withdrawal request at', 'zh', '提款請求於'),
(1544, 'You withdrawal request is pending now', 'zh', '您的提款請求現在正在等待處理'),
(1545, 'After some time you will receive', 'zh', '一段時間後您將收到'),
(1546, 'on your PayPal account', 'zh', '在您的 PayPal 帳戶上'),
(1547, 'There in new withdrawal request at', 'zh', '新的提款請求位於'),
(1548, 'Need to pay', 'zh', '需要付費'),
(1549, 'on PayPal account', 'zh', '在 PayPal 帳戶上'),
(1550, 'and confirm request', 'zh', '並確認請求'),
(1551, 'Details', 'zh', '細節'),
(1552, 'Withdrawal is complete at', 'zh', '提款完成於'),
(1553, 'You withdrawal is complete', 'zh', '您提款已完成'),
(1554, 'Thanks for using our service and have a nice day', 'zh', '感謝您使用我們的服務，祝您度過愉快的一天'),
(1555, 'New purchase at', 'zh', '新購買於'),
(1556, 'Congratulations on your purchase at', 'zh', '恭喜您購買'),
(1557, 'You can see details of your purchases', 'zh', '您可以查看您購買的詳細信息'),
(1558, 'There in new purchase at', 'zh', '新購買的有'),
(1559, 'make a payment', 'zh', '進行付款'),
(1560, 'to your PayPal account', 'zh', '到您的 PayPal 帳戶'),
(1561, 'Your order has been shipped at', 'zh', '您的訂單已發貨於'),
(1562, 'Your order', 'zh', '你的訂單'),
(1563, 'has been shipped', 'zh', '已經寄出'),
(1564, 'After receiving, please update purchase status', 'zh', '收到後請更新購買狀態'),
(1565, 'Your order has been completed at', 'zh', '您的訂單已完成於'),
(1566, 'Your order has been completed', 'zh', '您的訂單已完成'),
(1567, 'Funds added to your account and available for withdrawal', 'zh', '資金已添加至您的賬戶並可提取'),
(1568, 'Orders not found', 'zh', '未找到訂單'),
(1569, 'Type', 'zh', '類型'),
(1570, 'Withdrawal request', 'zh', '提款請求'),
(1571, 'Money deposit', 'zh', '存款'),
(1572, 'Order', 'zh', '命令'),
(1573, 'Please, confirm transaction', 'zh', '請確認交易'),
(1574, 'Confirm payment', 'zh', '確認付款'),
(1575, 'Bots', 'zh', '機器人'),
(1576, 'Banned', 'zh', '禁止'),
(1577, 'Active', 'zh', '積極的'),
(1578, 'Please, describe this item', 'zh', '請描述該商品'),
(1579, 'Description (e.g. Blue Nike Vapor Cleats Size 10. Very comfortable and strong ankle support.)', 'zh', '描述（例如，藍色 Nike Vapor 防滑鞋，尺碼 10。非常舒適且堅固的腳踝支撐。）'),
(1580, 'Please, confirm item shipping address', 'zh', '請確認商品的送貨地址'),
(1581, 'State', 'zh', '狀態'),
(1582, 'City', 'zh', '城市'),
(1583, 'Zip code', 'zh', '郵政編碼'),
(1584, 'Street', 'zh', '街道'),
(1585, 'Phone number', 'zh', '電話號碼'),
(1586, 'Price', 'zh', '價格'),
(1587, 'Choose action', 'zh', '選擇行動'),
(1588, 'Edit item', 'zh', '編輯項目'),
(1589, 'Deactivate item', 'zh', '停用項目'),
(1590, 'Activate item', 'zh', '激活項目'),
(1591, 'List new Item', 'zh', '列出新項目'),
(1592, 'Edit Properties', 'zh', '編輯屬性'),
(1593, 'Keywords', 'zh', '關鍵詞'),
(1594, 'Mode', 'zh', '模式'),
(1595, 'Replace', 'zh', '代替'),
(1596, 'Cron error', 'zh', '定時錯誤'),
(1597, 'Save', 'zh', '節省'),
(1598, 'Are you sure?', 'zh', '你確定嗎？'),
(1599, 'Add value', 'zh', '增值'),
(1600, 'Edit property', 'zh', '編輯屬性'),
(1601, 'New value', 'zh', '新價值'),
(1602, 'Delete property', 'zh', '刪除屬性'),
(1603, 'Add new property', 'zh', '添加新屬性'),
(1604, 'Back to products', 'zh', '返回產品'),
(1605, 'Connect with social network', 'zh', '連接社交網絡'),
(1606, 'Delivery confirmation', 'zh', '發貨確認'),
(1607, 'Quality', 'zh', '質量'),
(1608, 'Your comment here', 'zh', '您的評論在這裡'),
(1609, 'Purchases', 'zh', '購買'),
(1610, 'Thank you for your order! Shipment in process now.', 'zh', '謝謝您的訂單！ 現在正在發貨。'),
(1611, 'There is no purchases', 'zh', '沒有購買'),
(1612, 'Finances', 'zh', '財政'),
(1613, 'The funds have been added to your account', 'zh', '資金已添加至您的賬戶'),
(1614, 'Balance', 'zh', '平衡'),
(1615, 'Pending', 'zh', '待辦的'),
(1616, 'New', 'zh', '新的'),
(1617, 'Transactions not found', 'zh', '未找到交易'),
(1618, 'Request withdrawal', 'zh', '請求提款'),
(1619, 'Confirm your PayPal', 'zh', '確認您的貝寶'),
(1620, 'Deposit money', 'zh', '存錢'),
(1621, 'Amount to deposit', 'zh', '存入金額'),
(1622, 'About', 'zh', '關於'),
(1623, 'Products', 'zh', '產品'),
(1624, 'Orders', 'zh', '命令'),
(1625, 'Finance', 'zh', '金融'),
(1626, 'Order products', 'zh', '訂購產品'),
(1627, 'Confirmation', 'zh', '確認'),
(1628, 'Please, confirm your order', 'zh', '請確認您的訂單'),
(1629, 'Remove product', 'zh', '刪除產品'),
(1630, 'Sorry, there is no products', 'zh', '抱歉，沒有產品'),
(1631, 'Total price', 'zh', '總價'),
(1632, 'Shipping', 'zh', '船運'),
(1633, 'Please, confirm your shipping address', 'zh', '請確認您的送貨地址'),
(1634, 'Payment', 'zh', '支付'),
(1635, 'First name', 'zh', '名'),
(1636, 'Last name', 'zh', '姓'),
(1637, 'Country', 'zh', '國家'),
(1638, 'Process payment', 'zh', '處理付款'),
(1639, 'FILTER RESULTS', 'zh', '處理付款...'),
(1640, 'Already have an account?', 'zh', '已經有帳戶？'),
(1641, 'Empty search query', 'zh', '空搜索查詢'),
(1642, 'Cart', 'zh', '大車'),
(1643, 'Last visit', 'zh', '上次訪問'),
(1644, 'Checkout order?', 'zh', '結帳訂單？'),
(1645, 'Error! Drag-n-drop disabled on this server', 'zh', '錯誤！ 此服務器上禁用拖放操作'),
(1646, 'Uploading', 'zh', '上傳中'),
(1647, 'Drop file here', 'zh', '將文件拖放到此處'),
(1648, 'The user makes a purchase and payment!', 'zh', '用戶進行購買並付款！'),
(1649, 'Order has been shipped', 'zh', '訂單已發貨'),
(1650, 'User confirmed the receipt of the order', 'zh', '用戶確認收到訂單'),
(1651, 'The user makes a purchase', 'zh', '用戶進行購買'),
(1652, 'online', 'zh', '在線的'),
(1653, 'Perfomance', 'zh', '表現'),
(1654, 'By hours', 'zh', '按小時'),
(1655, 'Average Server Response', 'zh', '平均服務器響應'),
(1656, 'Average Site Response', 'zh', '平均站點響應'),
(1657, 'Page generation speed', 'zh', '頁面生成速度'),
(1658, 'Profile image', 'zh', '個人資料圖片'),
(1659, 'Navigation', 'zh', '導航'),
(1660, 'Checkout order', 'zh', '結帳訂單'),
(1661, 'Your Shopping Cart', 'zh', '你的購物車'),
(1662, 'item(s)', 'zh', '項目'),
(1663, 'Process order?', 'zh', '處理訂單？'),
(1664, 'A new item has been added to your Shopping Cart', 'zh', '新商品已添加到您的購物車'),
(1665, 'Continue shopping', 'zh', '繼續購物'),
(1666, 'Time', 'zh', '時間'),
(1667, 'Under construction', 'zh', '建設中'),
(1668, 'daily report', 'zh', '每日報告'),
(1669, 'Thanks for using our service', 'zh', '感謝您使用我們的服務'),
(1670, 'This is a daily report for the website traffic and performance on', 'zh', '這是網站流量和性能的每日報告'),
(1671, 'Transfer amount', 'zh', '轉賬金額'),
(1672, 'New transaction', 'zh', '新交易'),
(1673, 'Transaction completed', 'zh', '交易完成'),
(1674, 'Transaction from admin', 'zh', '來自管理員的交易'),
(1675, 'Page generation time', 'zh', '頁面生成時間'),
(1676, 'Select an action', 'zh', '選擇一個操作'),
(1677, 'Up to top', 'zh', '到頂部'),
(1678, 'Delete article', 'zh', '刪除文章'),
(1679, 'Engine version', 'zh', '發動機版本'),
(1680, 'Total pages', 'zh', '總頁數'),
(1681, 'Total articles', 'zh', '文章總數'),
(1682, 'Total products', 'zh', '產品總數'),
(1683, 'Total users', 'zh', '用戶總數'),
(1684, 'Total comments', 'zh', '評論總數'),
(1685, 'Visitors per day', 'zh', '每日訪客數'),
(1686, 'Views per day', 'zh', '每日觀看次數'),
(1687, 'Show more', 'zh', '展示更多'),
(1688, 'Privacy Policy', 'zh', '隱私政策'),
(1689, 'Terms & Conditions', 'zh', '條款及條件'),
(1690, 'Any', 'zh', '任何'),
(1691, 'Outbox', 'zh', '發件箱'),
(1692, 'Continue', 'zh', '繼續'),
(1693, 'Checkout', 'zh', '查看'),
(1694, 'Show comments', 'zh', '顯示評論'),
(1695, 'Latest comments', 'zh', '最新評論'),
(1696, 'View source', 'zh', '查看源碼'),
(1697, 'Delete file', 'zh', '刪除文件'),
(1698, 'Delete template', 'zh', '刪除模板'),
(1699, 'Articles', 'zh', '文章'),
(1700, 'Member of', 'zh', '成員'),
(1701, 'community', 'zh', '共同體'),
(1702, 'Property', 'zh', '屬性'),
(1703, 'Copy to', 'zh', '複製到'),
(1704, 'translation', 'zh', '翻譯'),
(1705, 'Color', 'zh', '顏色'),
(1706, 'White', 'zh', '白色的'),
(1707, 'Black', 'zh', '黑色的'),
(1708, 'Silver', 'zh', '銀'),
(1709, 'Gray', 'zh', '灰色的'),
(1710, 'New bulk message', 'zh', '新的群發消息'),
(1711, 'Profile', 'zh', '輪廓'),
(1712, 'Ok', 'zh', '好的'),
(1713, 'Cron status', 'zh', '計劃狀態'),
(1714, 'Cache', 'zh', '緩存'),
(1715, 'List articles', 'zh', '列出文章'),
(1716, 'Edit catalog', 'zh', '編輯目錄'),
(1717, 'Delete catalog', 'zh', '刪除目錄'),
(1718, 'Resolution', 'zh', '解決'),
(1719, '1440 x 2560', 'zh', '1440 x 2560'),
(1720, '1080 x 1920', 'zh', '1080 x 1920'),
(1721, 'Close', 'zh', '關閉'),
(1722, 'Toggle fullscreen', 'zh', '切換全屏'),
(1723, 'Zoom in/out', 'zh', '放大/縮小'),
(1724, 'Previous (arrow left)', 'zh', '上一頁（向左箭頭）'),
(1725, 'Next (arrow right)', 'zh', '下一步（向右箭頭）'),
(1726, 'votes', 'zh', '投票'),
(1727, 'Share friends', 'zh', '分享好友'),
(1728, 'Submitted on', 'zh', '提交於'),
(1729, 'Share', 'zh', '分享'),
(1730, 'Subscription', 'zh', '訂閱'),
(1731, 'Down to bottom', 'zh', '到底部'),
(1732, 'Back to list', 'zh', '返回目錄'),
(1733, 'Passwords do not match', 'zh', '密碼不匹配'),
(1734, 'Repeat password', 'zh', '重複輸入密碼'),
(1735, 'We are glad to confirm successful registration at', 'zh', '我們很高興確認註冊成功'),
(1736, 'By registering on the site, you accept the', 'zh', '通過在網站上註冊，您接受'),
(1737, 'Terms and Conditions', 'zh', '條款和條件'),
(1738, 'and are familiar with the', 'zh', '並熟悉'),
(1739, 'Delete account', 'zh', '刪除帳戶'),
(1740, 'Are you sure you want to delete your account', 'zh', '您確定要刪除您的帳戶嗎'),
(1741, 'Empty', 'zh', '空的'),
(1742, 'Any action', 'zh', '任何行動'),
(1743, 'Email sended', 'zh', '郵件已發送'),
(1744, 'Messages not found', 'zh', '未找到消息'),
(1745, 'Send to email', 'zh', '發送至電子郵件'),
(1746, 'Send in chat', 'zh', '在聊天中發送'),
(1747, 'Text of message', 'zh', '消息正文'),
(1748, 'Send messages', 'zh', '發送信息'),
(1749, 'Back to outbox', 'zh', '返回發件箱'),
(1750, 'Referrer', 'zh', '推薦人'),
(1751, 'Actions', 'zh', '行動'),
(1752, 'View session', 'zh', '查看會話'),
(1753, 'Mouse move to', 'zh', '鼠標移至'),
(1754, 'Actions are finished at', 'zh', '行動結束於'),
(1755, 'Click to', 'zh', '點擊進入'),
(1756, 'Session finished', 'zh', '會議結束'),
(1757, 'Internal Server Error', 'zh', '內部服務器錯誤'),
(1758, 'Pending payment', 'zh', '待付款'),
(1759, 'Invoice', 'zh', '發票'),
(1760, 'An invoice for payment', 'zh', '付款發票'),
(1761, 'Invoice date for payment', 'zh', '付款發票日期'),
(1762, 'Total', 'zh', '全部的'),
(1763, 'Total Paid', 'zh', '總支付'),
(1764, 'Amount to be paid', 'zh', '該付的錢'),
(1765, 'Make payment', 'zh', '付款'),
(1766, 'Successfully paid', 'zh', '支付成功'),
(1767, 'Partially paid', 'zh', '部分付款'),
(1768, 'The funds have been added to your account balance', 'zh', '資金已添加至您的賬戶餘額'),
(1769, 'Your cart is empty', 'zh', '您的購物車是空的'),
(1770, 'View invoice', 'zh', '查看發票'),
(1771, 'Order payment', 'zh', '訂單支付'),
(1772, 'Step', 'zh', '步'),
(1773, 'Login to website', 'zh', '登錄網站'),
(1774, 'Close window', 'zh', '關閉窗口'),
(1775, 'Select payment method', 'zh', '選擇付款方式'),
(1776, 'Toggle navigation', 'zh', '切換導航'),
(1777, 'Select an image to upload', 'zh', '選擇要上傳的圖像'),
(1778, 'Administrators not found', 'zh', '未找到管理員'),
(1779, 'Edit permission', 'zh', '編輯權限'),
(1780, 'Delete from admin', 'zh', '從管理員中刪除'),
(1781, 'Make admin', 'zh', '設為管理員'),
(1782, 'Manage permission', 'zh', '管理權限'),
(1783, 'Manage permission of', 'zh', '管理權限'),
(1784, 'Back to access', 'zh', '返回訪問'),
(1785, 'Section', 'zh', '部分'),
(1786, 'Permission', 'zh', '允許'),
(1787, 'No access', 'zh', '無法訪問'),
(1788, 'Read-only', 'zh', '只讀'),
(1789, 'Full access', 'zh', '完全訪問權限'),
(1790, 'Primary admin', 'zh', '主要管理員'),
(1791, 'Send as notification', 'zh', '作為通知發送'),
(1792, 'Bulk message is sending now', 'zh', '正在發送批量消息'),
(1793, 'Complete item description', 'zh', '完整的物品描述'),
(1794, 'Add new admin', 'zh', '添加新管理員'),
(1795, 'Do not have an account?', 'zh', '還沒有賬號？'),
(1796, 'Forgot password', 'zh', '忘記密碼'),
(1797, 'Reset password', 'zh', '重設密碼'),
(1798, 'To confirm this password, use', 'zh', '要確認此密碼，請使用'),
(1799, 'this link', 'zh', '這個鏈接'),
(1800, 'To process restore, please check your email', 'zh', '要處理恢復，請檢查您的電子郵件'),
(1801, 'Setup new password', 'zh', '設置新密碼'),
(1802, 'New password activated!', 'zh', '新密碼已激活！'),
(1803, 'Request for withdrawal of funds', 'zh', '請求提取資金'),
(1804, 'Your withdrawal request will be processed within a few days of submitting', 'zh', '您的提款請求將在提交後幾天內得到處理'),
(1805, 'Wallet', 'zh', '錢包'),
(1806, 'Wallet ID', 'zh', '錢包ID'),
(1807, 'Confirm request', 'zh', '確認請求'),
(1808, 'Back to finances', 'zh', '回到財務'),
(1809, 'Withdrawal confirmation', 'zh', '提款確認'),
(1810, 'Withdrawal request processed', 'zh', '提款請求已處理'),
(1811, 'Latest Articles', 'zh', '最新的文章'),
(1812, 'Popular goods', 'zh', '熱門商品'),
(1813, 'Metaverse', 'en', 'Metaverse'),
(1814, 'Last editing on', 'ru', 'Отредактировано'),
(1815, 'Metaverse', 'ru', 'Метавселенная'),
(1816, 'Metaverse', 'zh', '元宇宙'),
(1817, 'Level Name', 'en', 'Level Name'),
(1818, 'Show project scheme', 'en', 'Show project scheme'),
(1819, 'Add new level', 'en', 'Add new level'),
(1820, 'Project properties', 'en', 'Project properties'),
(1821, 'Scene Name', 'en', 'Scene Name'),
(1822, 'Show level plan', 'en', 'Show level plan'),
(1823, 'Upload scenes', 'en', 'Upload scenes'),
(1824, 'Add new scene', 'en', 'Add new scene'),
(1825, 'Position', 'en', 'Position'),
(1826, 'Rotation', 'en', 'Rotation'),
(1827, 'Latitude', 'en', 'Latitude'),
(1828, 'Longitude', 'en', 'Longitude'),
(1829, 'Floor position', 'en', 'Floor position'),
(1830, 'Floor radius', 'en', 'Floor radius'),
(1831, 'Logo size', 'en', 'Logo size'),
(1832, 'level properties', 'en', 'level properties'),
(1833, 'Level Name', 'ru', 'Название уровня'),
(1834, 'Show project scheme', 'ru', 'Показать схему проекта'),
(1835, 'Add new level', 'ru', 'Добавить уровень'),
(1836, 'Project properties', 'ru', 'Свойства проекта'),
(1837, 'Scene Name', 'ru', 'Название сцены'),
(1838, 'Show level plan', 'ru', 'Показать схему уровня'),
(1839, 'Upload scenes', 'ru', 'Загрузить сцены'),
(1840, 'Add new scene', 'ru', 'Добавить новую сцену'),
(1841, 'Position', 'ru', 'Position'),
(1842, 'Rotation', 'ru', 'Rotation'),
(1843, 'Latitude', 'ru', 'Latitude'),
(1844, 'Longitude', 'ru', 'Latitude'),
(1845, 'Floor position', 'ru', 'Положение пола'),
(1846, 'Floor radius', 'ru', 'Радиус пола'),
(1847, 'Logo size', 'ru', 'Размер лого'),
(1848, 'level properties', 'ru', 'свойства уровня'),
(1928, 'Scenes not found', 'ru', 'Сцены не найдены'),
(1927, 'Levels not found', 'ru', 'Этажи не найдены'),
(1851, 'Telegram', 'en', 'Telegram'),
(1925, 'Projects not found', 'en', 'Projects not found'),
(1926, 'Average response time', 'en', 'Average response time'),
(1856, 'DAO Mansion', 'en', 'DAO Mansion'),
(1930, 'Average response time', 'ru', 'Среднее время ответа'),
(1859, 'Rules', 'en', 'Rules'),
(1929, 'Projects not found', 'ru', 'Проекты не найдены'),
(1862, 'Rules', 'zh', '规则'),
(1865, 'Rules', 'ru', 'Правила'),
(1866, 'The original document is in a', 'en', 'The original document is in a'),
(1867, 'public repository', 'en', 'public repository'),
(1868, 'and is available for editing by the community', 'en', 'and is available for editing by the community'),
(1869, 'DAO constitution', 'en', 'DAO constitution'),
(1870, 'The original document is in a', 'ru', 'Оригинал документа находится в'),
(1871, 'public repository', 'ru', 'публичном репозитории'),
(1872, 'and is available for editing by the community', 'ru', 'и доступен для редактирования сообществом'),
(1873, 'DAO constitution', 'ru', 'Конституция DAO'),
(1874, 'The original document is in a', 'zh', '原始文檔位於'),
(1875, 'public repository', 'zh', '公共存儲庫'),
(1876, 'and is available for editing by the community', 'zh', '並且可供社區編輯'),
(1877, 'DAO constitution', 'zh', 'DAO 章程'),
(1878, 'Constitution', 'en', 'Constitution'),
(1879, 'Constitution', 'zh', '章程'),
(1880, 'Constitution', 'ru', 'Конституция'),
(1881, 'Community rules', 'en', 'Community rules'),
(1882, 'Community rules', 'ru', 'Правила сообщества'),
(1883, 'Community rules', 'zh', '社區規則'),
(1884, 'Panorama', 'en', 'Panorama'),
(1885, 'Mansion', 'en', 'Mansion'),
(1886, 'Decentralized organization', 'en', 'Decentralized organization'),
(1887, 'Multiplayer', 'en', 'Multiplayer'),
(1888, 'All articles', 'en', 'All articles'),
(1889, 'Panorama', 'ru', 'Панорама'),
(1890, 'Mansion', 'ru', 'Особняк'),
(1891, 'Decentralized organization', 'ru', 'Децентрализованная организация'),
(1892, 'Multiplayer', 'ru', 'Мультиплеер'),
(1893, 'All articles', 'ru', 'Все статьи'),
(1894, 'Level Name', 'zh', '關卡名稱'),
(1895, 'Show project scheme', 'zh', '展示項目方案'),
(1896, 'Add new level', 'zh', '添加新級別'),
(1897, 'Project properties', 'zh', '項目屬性'),
(1898, 'Scene Name', 'zh', '場景名稱'),
(1899, 'Show level plan', 'zh', '顯示關卡平面圖'),
(1900, 'Upload scenes', 'zh', '上傳場景'),
(1901, 'Add new scene', 'zh', '添加新場景'),
(1902, 'Position', 'zh', '位置'),
(1903, 'Rotation', 'zh', '迴轉'),
(1904, 'Latitude', 'zh', '緯度'),
(1905, 'Longitude', 'zh', '經度'),
(1906, 'Floor position', 'zh', '地板位置'),
(1907, 'Floor radius', 'zh', '地板半徑'),
(1908, 'Logo size', 'zh', '標誌尺寸'),
(1909, 'level properties', 'zh', '級別屬性'),
(1912, 'Telegram', 'zh', ''),
(1923, 'Levels not found', 'en', 'Levels not found'),
(1924, 'Scenes not found', 'en', 'Scenes not found'),
(1917, 'DAO Mansion', 'zh', 'DAO 別墅'),
(1918, 'Panorama', 'zh', '全景'),
(1919, 'Mansion', 'zh', '別墅'),
(1920, 'Decentralized organization', 'zh', '分散的組織'),
(1921, 'Multiplayer', 'zh', '多人遊戲'),
(1922, 'All articles', 'zh', '所有文章'),
(1931, 'Multiplayer scene', 'en', 'Multiplayer scene'),
(1932, 'Multiplayer scene', 'ru', 'Мультиплеер'),
(1933, 'Telegram', 'ru', ''),
(1934, 'DAO Mansion', 'ru', 'DAO Особняк'),
(1935, 'Web 3.0 community', 'en', 'Web 3.0 community'),
(1936, 'DAO Whitepaper', 'en', 'DAO Whitepaper'),
(1937, 'DAO Mansion whitepaper', 'en', 'DAO Mansion whitepaper'),
(1938, 'Levels not found', 'zh', '未找到級別'),
(1939, 'Scenes not found', 'zh', '未找到場景'),
(1940, 'Projects not found', 'zh', '未找到項目'),
(1941, 'Average response time', 'zh', '平均回應時間'),
(1942, 'Multiplayer scene', 'zh', '多人場景'),
(1943, 'Web 3.0 community', 'zh', 'Web 3.0 社區'),
(1944, 'DAO Whitepaper', 'zh', 'DAO 白皮書'),
(1945, 'DAO Mansion whitepaper', 'zh', 'DAO 別墅白皮書'),
(1946, 'Web 3.0 community', 'ru', 'Web 3.0 сообщество'),
(1947, 'DAO Whitepaper', 'ru', 'Технический документ DAO'),
(1948, 'DAO Mansion whitepaper', 'ru', 'Технический документ DAO Mansion');

-- --------------------------------------------------------

--
-- Структура таблицы `nodes_meta`
--

CREATE TABLE `nodes_meta` (
  `id` int(11) NOT NULL,
  `url` varchar(400) NOT NULL,
  `lang` varchar(4) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `keywords` varchar(300) NOT NULL,
  `mode` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `nodes_order`
--

CREATE TABLE `nodes_order` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `date` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  `shipping` int(11) NOT NULL DEFAULT '0',
  `payment` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `nodes_outbox`
--

CREATE TABLE `nodes_outbox` (
  `id` int(11) NOT NULL,
  `caption` varchar(400) NOT NULL,
  `text` text NOT NULL,
  `action` tinyint(4) NOT NULL,
  `date` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `nodes_pattern`
--

CREATE TABLE `nodes_pattern` (
  `id` int(11) NOT NULL,
  `attendance_id` int(11) NOT NULL DEFAULT '0',
  `action` int(1) NOT NULL,
  `x` int(11) NOT NULL DEFAULT '0',
  `y` int(11) NOT NULL DEFAULT '0',
  `top` int(11) NOT NULL DEFAULT '0',
  `width` int(11) NOT NULL DEFAULT '0',
  `height` int(11) NOT NULL DEFAULT '0',
  `date` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `nodes_perfomance`
--

CREATE TABLE `nodes_perfomance` (
  `id` int(11) NOT NULL,
  `server_time` double NOT NULL,
  `script_time` double NOT NULL,
  `cache_id` int(11) NOT NULL DEFAULT '0',
  `date` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `nodes_product`
--

CREATE TABLE `nodes_product` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL,
  `text` text NOT NULL,
  `description` text NOT NULL,
  `img` text NOT NULL,
  `shipping` int(11) NOT NULL DEFAULT '0',
  `price` double NOT NULL,
  `order` int(11) NOT NULL DEFAULT '0',
  `date` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  `views` int(11) NOT NULL DEFAULT '0',
  `rating` int(11) NOT NULL DEFAULT '0',
  `votes` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `nodes_product_data`
--

CREATE TABLE `nodes_product_data` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL DEFAULT '0',
  `value` varchar(100) NOT NULL,
  `url` varchar(40) NOT NULL,
  `order` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `nodes_product_order`
--

CREATE TABLE `nodes_product_order` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL DEFAULT '0',
  `order_id` int(11) NOT NULL DEFAULT '0',
  `price` double NOT NULL,
  `count` int(11) NOT NULL DEFAULT '0',
  `track` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `date` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `nodes_product_property`
--

CREATE TABLE `nodes_product_property` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL DEFAULT '0',
  `value` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `nodes_product_property`
--

INSERT INTO `nodes_product_property` (`id`, `cat_id`, `value`) VALUES
(1, 0, 'Category');

-- --------------------------------------------------------

--
-- Структура таблицы `nodes_property_data`
--

CREATE TABLE `nodes_property_data` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL DEFAULT '0',
  `property_id` int(11) NOT NULL DEFAULT '0',
  `data_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `nodes_referrer`
--

CREATE TABLE `nodes_referrer` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `nodes_shipping`
--

CREATE TABLE `nodes_shipping` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `zip` varchar(100) NOT NULL,
  `street1` varchar(100) NOT NULL,
  `street2` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `nodes_shipping`
--

INSERT INTO `nodes_shipping` (`id`, `user_id`, `fname`, `lname`, `country`, `state`, `city`, `zip`, `street1`, `street2`, `phone`) VALUES
(1, 1, '', '', 'Russia', 'Kursk', 'Kursk', '305040', '50 let Oktyabrya', '', '+1234567890');

-- --------------------------------------------------------

--
-- Структура таблицы `nodes_transaction`
--

CREATE TABLE `nodes_transaction` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `invoice_id` int(11) NOT NULL DEFAULT '0',
  `order_id` int(11) NOT NULL DEFAULT '0',
  `txn_id` varchar(40) NOT NULL,
  `amount` double NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `date` int(11) NOT NULL DEFAULT '0',
  `gateway` varchar(40) NOT NULL,
  `payment_date` varchar(100) NOT NULL,
  `comment` text NOT NULL,
  `ip` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `nodes_user`
--

CREATE TABLE `nodes_user` (
  `id` int(11) NOT NULL,
  `admin` int(1) NOT NULL,
  `name` varchar(25) NOT NULL,
  `photo` varchar(400) NOT NULL,
  `url` varchar(400) NOT NULL,
  `email` varchar(400) NOT NULL,
  `pass` varchar(64) NOT NULL,
  `lang` varchar(3) NOT NULL,
  `balance` double NOT NULL,
  `ip` varchar(20) NOT NULL,
  `ban` tinyint(1) NOT NULL,
  `online` int(11) NOT NULL DEFAULT '0',
  `rating` int(11) NOT NULL DEFAULT '0',
  `votes` int(11) NOT NULL DEFAULT '0',
  `token` varchar(32) NOT NULL,
  `confirm` tinyint(1) NOT NULL,
  `code` varchar(4) NOT NULL,
  `bulk_ignore` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `nodes_user`
--

INSERT INTO `nodes_user` (`id`, `admin`, `name`, `photo`, `url`, `email`, `pass`, `lang`, `balance`, `ip`, `ban`, `online`, `rating`, `votes`, `token`, `confirm`, `code`, `bulk_ignore`) VALUES
(1, 1, 'Admin', 'admin.jpg', '', 'devbyzero@yandex.ru', '$2y$11$IIHRKrcBuu7Z1TuUtYhJaeBXqO9Yc4JZFUCDHoOtGzrsRSX5B4RNa', 'en', 0, '127.0.0.1', -1, 1703700747, 0, 0, '9oj9oddbqnesifenjhu2mpjgb6', 1, '0', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `nodes_user_outbox`
--

CREATE TABLE `nodes_user_outbox` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `outbox_id` int(11) NOT NULL DEFAULT '0',
  `date` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `vr_level`
--

CREATE TABLE `vr_level` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `text` text NOT NULL,
  `image` varchar(100) NOT NULL,
  `rotation` int(11) NOT NULL,
  `scale` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `vr_link`
--

CREATE TABLE `vr_link` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `scene_id` int(11) NOT NULL,
  `url` varchar(200) NOT NULL,
  `position` varchar(100) NOT NULL,
  `scale` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `vr_navigation`
--

CREATE TABLE `vr_navigation` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `scene_id` int(11) NOT NULL,
  `target` int(11) NOT NULL,
  `position` varchar(100) NOT NULL,
  `scale` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `vr_object`
--

CREATE TABLE `vr_object` (
  `id` int(11) NOT NULL,
  `scene_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `text` text NOT NULL,
  `width` double NOT NULL,
  `height` double NOT NULL,
  `color` varchar(40) NOT NULL,
  `base64` text NOT NULL,
  `position` varchar(100) NOT NULL,
  `rotation` varchar(100) NOT NULL,
  `scale` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `vr_project`
--

CREATE TABLE `vr_project` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL,
  `text` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `vr_scene`
--

CREATE TABLE `vr_scene` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `cubemap` text NOT NULL,
  `position` varchar(400) NOT NULL,
  `rotation` varchar(400) NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `top` int(11) NOT NULL DEFAULT '0',
  `left` int(11) NOT NULL DEFAULT '0',
  `height` double NOT NULL,
  `degmet` double NOT NULL DEFAULT '1',
  `floor_position` varchar(400) NOT NULL,
  `floor_radius` double NOT NULL,
  `logo_size` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `nodes_access`
--
ALTER TABLE `nodes_access`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `nodes_admin`
--
ALTER TABLE `nodes_admin`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `nodes_backend`
--
ALTER TABLE `nodes_backend`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `nodes_cache`
--
ALTER TABLE `nodes_cache`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `url` (`url`,`lang`),
  ADD KEY `interval` (`interval`),
  ADD KEY `lang` (`lang`);

--
-- Индексы таблицы `nodes_catalog`
--
ALTER TABLE `nodes_catalog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `visible` (`visible`),
  ADD KEY `lang` (`lang`);

--
-- Индексы таблицы `nodes_comment`
--
ALTER TABLE `nodes_comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `url` (`url`),
  ADD KEY `reply` (`reply`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `nodes_config`
--
ALTER TABLE `nodes_config`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Индексы таблицы `nodes_content`
--
ALTER TABLE `nodes_content`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cat_id` (`cat_id`),
  ADD KEY `lang` (`lang`);

--
-- Индексы таблицы `nodes_error`
--
ALTER TABLE `nodes_error`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lang` (`lang`);

--
-- Индексы таблицы `nodes_firebase`
--
ALTER TABLE `nodes_firebase`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `nodes_inbox`
--
ALTER TABLE `nodes_inbox`
  ADD PRIMARY KEY (`id`),
  ADD KEY `from` (`from`),
  ADD KEY `to` (`to`);

--
-- Индексы таблицы `nodes_invoice`
--
ALTER TABLE `nodes_invoice`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `nodes_language`
--
ALTER TABLE `nodes_language`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lang` (`lang`);

--
-- Индексы таблицы `nodes_meta`
--
ALTER TABLE `nodes_meta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lang` (`lang`);

--
-- Индексы таблицы `nodes_order`
--
ALTER TABLE `nodes_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `nodes_outbox`
--
ALTER TABLE `nodes_outbox`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `nodes_pattern`
--
ALTER TABLE `nodes_pattern`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attendance_id` (`attendance_id`);

--
-- Индексы таблицы `nodes_perfomance`
--
ALTER TABLE `nodes_perfomance`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `nodes_product`
--
ALTER TABLE `nodes_product`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `nodes_product_data`
--
ALTER TABLE `nodes_product_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cat_id` (`cat_id`),
  ADD KEY `value` (`value`);

--
-- Индексы таблицы `nodes_product_order`
--
ALTER TABLE `nodes_product_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Индексы таблицы `nodes_product_property`
--
ALTER TABLE `nodes_product_property`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `nodes_property_data`
--
ALTER TABLE `nodes_property_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `property_id` (`property_id`);

--
-- Индексы таблицы `nodes_referrer`
--
ALTER TABLE `nodes_referrer`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `nodes_shipping`
--
ALTER TABLE `nodes_shipping`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `nodes_transaction`
--
ALTER TABLE `nodes_transaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `invoice_id` (`invoice_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `status` (`status`);

--
-- Индексы таблицы `nodes_user`
--
ALTER TABLE `nodes_user`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `nodes_user_outbox`
--
ALTER TABLE `nodes_user_outbox`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`);

--
-- Индексы таблицы `vr_level`
--
ALTER TABLE `vr_level`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `vr_link`
--
ALTER TABLE `vr_link`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `vr_navigation`
--
ALTER TABLE `vr_navigation`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `vr_object`
--
ALTER TABLE `vr_object`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `vr_project`
--
ALTER TABLE `vr_project`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `vr_scene`
--
ALTER TABLE `vr_scene`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `nodes_access`
--
ALTER TABLE `nodes_access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `nodes_admin`
--
ALTER TABLE `nodes_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `nodes_backend`
--
ALTER TABLE `nodes_backend`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `nodes_cache`
--
ALTER TABLE `nodes_cache`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `nodes_catalog`
--
ALTER TABLE `nodes_catalog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT для таблицы `nodes_comment`
--
ALTER TABLE `nodes_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `nodes_config`
--
ALTER TABLE `nodes_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT для таблицы `nodes_content`
--
ALTER TABLE `nodes_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `nodes_error`
--
ALTER TABLE `nodes_error`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `nodes_firebase`
--
ALTER TABLE `nodes_firebase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `nodes_inbox`
--
ALTER TABLE `nodes_inbox`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `nodes_invoice`
--
ALTER TABLE `nodes_invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `nodes_language`
--
ALTER TABLE `nodes_language`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1949;

--
-- AUTO_INCREMENT для таблицы `nodes_meta`
--
ALTER TABLE `nodes_meta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `nodes_order`
--
ALTER TABLE `nodes_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `nodes_outbox`
--
ALTER TABLE `nodes_outbox`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `nodes_pattern`
--
ALTER TABLE `nodes_pattern`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `nodes_perfomance`
--
ALTER TABLE `nodes_perfomance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `nodes_product`
--
ALTER TABLE `nodes_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `nodes_product_data`
--
ALTER TABLE `nodes_product_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `nodes_product_order`
--
ALTER TABLE `nodes_product_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `nodes_product_property`
--
ALTER TABLE `nodes_product_property`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `nodes_property_data`
--
ALTER TABLE `nodes_property_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `nodes_referrer`
--
ALTER TABLE `nodes_referrer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `nodes_shipping`
--
ALTER TABLE `nodes_shipping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `nodes_transaction`
--
ALTER TABLE `nodes_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `nodes_user`
--
ALTER TABLE `nodes_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `nodes_user_outbox`
--
ALTER TABLE `nodes_user_outbox`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `vr_level`
--
ALTER TABLE `vr_level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `vr_link`
--
ALTER TABLE `vr_link`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `vr_navigation`
--
ALTER TABLE `vr_navigation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `vr_object`
--
ALTER TABLE `vr_object`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `vr_project`
--
ALTER TABLE `vr_project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `vr_scene`
--
ALTER TABLE `vr_scene`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
