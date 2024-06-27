-- Database dump for ./dApp/public_html/engine/nodes/config.php

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES binary */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
DROP TABLE IF EXISTS `nodes_access`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nodes_access` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `access` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `nodes_access` WRITE;
/*!40000 ALTER TABLE `nodes_access` DISABLE KEYS */;
INSERT INTO `nodes_access` VALUES (1,1,1,2),(2,2,1,2),(3,3,1,2),(4,4,1,2),(5,5,1,2),(6,6,1,2),(7,7,1,2),(8,8,1,2),(10,10,1,2),(11,11,1,2),(12,12,1,2),(14,14,1,2),(15,15,1,2),(16,16,1,2);
/*!40000 ALTER TABLE `nodes_access` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `nodes_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nodes_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `url` varchar(40) NOT NULL,
  `img` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `nodes_admin` WRITE;
/*!40000 ALTER TABLE `nodes_admin` DISABLE KEYS */;
INSERT INTO `nodes_admin` VALUES (1,'Access','access','cms/access.jpg'),(2,'Pages','pages','cms/pages.jpg'),(3,'Content','content','cms/content.jpg'),(4,'Products','products','cms/products.jpg'),(5,'Users','users','cms/users.jpg'),(6,'Panoramas','panoramas','cms/cardboard.png'),(7,'Finance','finance','cms/finance.jpg'),(8,'Language','language','cms/language.jpg'),(10,'Files','files','cms/files.jpg'),(11,'Config','config','cms/config.jpg'),(12,'Backend','backend','cms/backend.jpg'),(14,'Perfomance','perfomance','cms/perfomance.jpg'),(15,'Outbox','outbox','cms/outbox.jpg'),(16,'Errors','errors','cms/errors.jpg');
/*!40000 ALTER TABLE `nodes_admin` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `nodes_backend`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nodes_backend` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mode` varchar(400) DEFAULT NULL,
  `file` varchar(400) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `nodes_backend` WRITE;
/*!40000 ALTER TABLE `nodes_backend` DISABLE KEYS */;
INSERT INTO `nodes_backend` VALUES (1,'','main.php'),(2,'admin','admin.php'),(3,'account','account.php'),(4,'signup','register.php'),(5,'login','login.php'),(6,'content','content.php'),(7,'product','product.php'),(8,'search','search.php'),(9,'#','profile.php'),(11,'webvr','webvr.php'),(12,'dao','dao.php'),(13,'social','social.php'),(14,'developer','developer.php'),(16,'booking','booking.php'),(18,'contacts','contacts.php');
/*!40000 ALTER TABLE `nodes_backend` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `nodes_cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nodes_cache` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(300) NOT NULL,
  `title` varchar(100) NOT NULL DEFAULT '',
  `date` int(11) NOT NULL DEFAULT '0',
  `lang` varchar(3) NOT NULL,
  `interval` int(11) NOT NULL DEFAULT '0',
  `html` longtext NOT NULL,
  `description` varchar(200) NOT NULL DEFAULT '',
  `keywords` varchar(300) NOT NULL DEFAULT '',
  `content` longtext NOT NULL,
  `time` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `url` (`url`,`lang`),
  KEY `interval` (`interval`),
  KEY `lang` (`lang`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `nodes_cache` WRITE;
/*!40000 ALTER TABLE `nodes_cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `nodes_cache` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `nodes_catalog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nodes_catalog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `caption` varchar(400) NOT NULL,
  `description` mediumtext NOT NULL,
  `text` mediumtext NOT NULL,
  `url` varchar(100) NOT NULL,
  `img` varchar(100) NOT NULL,
  `visible` tinyint(1) NOT NULL,
  `lang` varchar(3) NOT NULL,
  `order` int(11) NOT NULL DEFAULT '0',
  `date` int(11) NOT NULL DEFAULT '0',
  `public_date` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `visible` (`visible`),
  KEY `lang` (`lang`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `nodes_catalog` WRITE;
/*!40000 ALTER TABLE `nodes_catalog` DISABLE KEYS */;
INSERT INTO `nodes_catalog` VALUES (15,'Privacy Policy','','<ul><li><a href=\"#1\">Information Collection</a></li><li><a href=\"#2\">Information Usage</a></li><li><a href=\"#3\">Information Protection</a></li><li><a href=\"#4\">Cookie Usage</a></li><li><a href=\"#5\">3rd Party Disclosure</a></li><li><a href=\"#6\">3rd Party Links</a></li><li><a href=\"#7\">CalOPPA</a></li><li><a href=\"#8\">COPPA</a></li><li><a href=\"#9\">Contact Information</a></li></ul><p>&nbsp;</p><p>This privacy policy has been compiled to better serve those who are concerned with how their \'Personally Identifiable Information\' (PII) is being used online. PII, as described in US privacy law and information security, is information that can be used on its own or with other information to identify, contact, or locate a single person, or to identify an individual in context. Please read our privacy policy carefully to get a clear understanding of how we collect, use, protect or otherwise handle your Personally Identifiable Information in accordance with our website.</p><p><br /> <a name=\"1\"></a><strong>What personal information do we collect from the people that visit our website?</strong></p><p>When ordering or registering on our site, as appropriate, you may be asked to enter your name, email address, mailing address or other details to help you with your experience.</p><p><br /> <strong>When do we collect information?</strong></p><p>We collect information from you when you register on our site, place an order, subscribe to a newsletter, respond to a survey, fill out a form, Use Live Chat or enter information on our site.</p><p><br /> <a name=\"2\"></a><strong>How do we use your information?</strong></p><p>We may use the information we collect from you when you register, make a purchase, sign up for our newsletter, respond to a survey or marketing communication, surf the website, or use certain other site features in the following ways:</p><ul><li>To improve our website in order to better serve you.</li><li>To allow us to better service you in responding to your customer service requests</li><li>To administer a contest, promotion, survey or other site feature.</li><li>To quickly process your transactions.</li><li>To ask for ratings and reviews of services or products.</li><li>To follow up with them after correspondence (live chat, email or phone inquiries).</li></ul><p><br /> <a name=\"3\"></a><strong>How do we protect your information?</strong></p><p>Our site is scanned on a regular basis for security holes and known vulnerabilities in order to make your visit to our site as safe as possible. We will never ask for personal or sensitive information such as names, email addresses and credit card numbers from unauthorized users.</p><p><br /> <a name=\"4\"></a><strong>Do we use \'cookies\'?</strong></p><p>Yes. Cookies are small files that a site or its service provider transfers to your computer\'s hard drive through your Web browser (if you allow) that enables the site\'s or service provider\'s systems to recognize your browser and capture and remember certain information. For instance, we use cookies to help us remember and process the items in your shopping cart. They are also used to help us understand your preferences based on previous or current site activity, which enables us to provide you with improved services. We also use cookies to help us compile aggregate data about site traffic and site interaction so that we can offer better site experiences and tools in the future. We use cookies to:</p><ul><li>Help remember and process the items in the shopping cart.</li><li>Understand and save user\'s preferences for future visits.</li></ul><p>You can choose to have your computer warn you each time a cookie is being sent, or you can choose to turn off all cookies. You do this through your browser settings. Since browser is a little different, look at your browser\'s Help Menu to learn the correct way to modify your cookies.</p><p><br /> <strong>If users disable cookies in their browser</strong></p><p>If you turn cookies off, some features will be disabled. Some of the features that make your site experience more efficient and may not function properly. <br /> However, you will still be able to place orders .</p><p><br /> <a name=\"5\"></a><strong>Third-party disclosure</strong></p><p>We do not sell, trade, or otherwise transfer to outside parties your Personally Identifiable Information unless we provide users with advance notice. This does not include website hosting partners and other parties who assist us in operating our website, conducting our business, or serving our users, so long as those parties agree to keep this information confidential. We may also release information when it\'s release is appropriate to comply with the law, enforce our site policies, or protect ours or others\' rights, property or safety. <br /> However, non-personally identifiable visitor information may be provided to other parties for marketing, advertising, or other uses.</p><p><br /> <a name=\"6\"></a><strong>Third-party links</strong></p><p>Occasionally, at our discretion, we may include or offer third-party products or services on our website. These third-party sites have separate and independent privacy policies. We therefore have no responsibility or liability for the content and activities of these linked sites. Nonetheless, we seek to protect the integrity of our site and welcome any feedback about these sites.</p><p><br /> <a name=\"7\"></a><strong>California Online Privacy Protection Act</strong></p><p>CalOPPA is the first state law in the nation to require commercial websites and online services to post a privacy policy. The law\'s reach stretches well beyond California to require any person or company in the United States (and conceivably the world) that operates websites collecting Personally Identifiable Information from California consumers to post a conspicuous privacy policy on its website stating exactly the information being collected and those individuals or companies with whom it is being shared. <br /> According to CalOPPA, we agree to the following:</p><ul><li>Users can visit our site anonymously.</li><li>Once this privacy policy is created, we will add a link to it on our home page or as a minimum, on the first significant page after entering our website.</li><li>Our Privacy Policy link includes the word \'Privacy\' and can easily be found on the page specified above.</li><li>You will be notified of any Privacy Policy changes on our Privacy Policy Page.</li><li>Users can change your personal information by logging in to your account.</li></ul><p><br /> <strong>How does our site handle Do Not Track signals?</strong></p><p>We honor Do Not Track signals and Do Not Track, plant cookies, or use advertising when a Do Not Track (DNT) browser mechanism is in place.</p><p><br /> <strong>Does our site allow third-party behavioral tracking?</strong></p><p>It\'s also important to note that we allow third-party behavioral tracking</p><p><br /> <a name=\"8\"></a><strong>COPPA (Children Online Privacy Protection Act)</strong></p><p>When it comes to the collection of personal information from children under the age of 13 years old, the Children\'s Online Privacy Protection Act (COPPA) puts parents in control. The Federal Trade Commission, United States\' consumer protection agency, enforces the COPPA Rule, which spells out what operators of websites and online services must do to protect children\'s privacy and safety online. <br /> We do not specifically market to children under the age of 13 years old.</p><p><br /> <strong>CAN SPAM Act</strong></p><p>The CAN-SPAM Act is a law that sets the rules for commercial email, establishes requirements for commercial messages, gives recipients the right to have emails stopped from being sent to them, and spells out tough penalties for violations. <br /> To be in accordance with CANSPAM, we agree to the following: <br /> If at any time you would like to unsubscribe from receiving future emails, you can email us at and we will promptly remove you from ALL correspondence.</p><p><br /> <a name=\"9\"></a><strong>Contacting Us</strong></p><p>If there are any questions regarding this privacy policy, you may contact us using the information below.</p>','privacy_policy','',0,'en',0,1543925624,1543925624),(16,'Terms and Conditions','','<p>These Website Standard Terms and Conditions written on this webpage shall manage your use of this website. These Terms will be applied fully and affect to your use of this Website. By using this Website, you agreed to accept all terms and conditions written in here. You must not use this Website if you disagree with any of these Website Standard Terms and Conditions.</p>\r\n<p>Minors or people below 18 years old are not allowed to use this Website.</p>\r\n<ul>\r\n<li><a href=\"#1\">Intellectual Property Rights</a></li>\r\n<li><a href=\"#2\">Restrictions</a></li>\r\n<li><a href=\"#3\">Your Content</a></li>\r\n<li><a href=\"#4\">No warranties</a></li>\r\n<li><a href=\"#5\">Limitation of liability</a></li>\r\n<li><a href=\"#6\">Indemnification</a></li>\r\n<li><a href=\"#7\">Severability</a></li>\r\n<li><a href=\"#8\">Variation of Terms</a></li>\r\n<li><a href=\"#9\">Assignment</a></li>\r\n<li><a href=\"#10\">Entire Agreement</a></li>\r\n<li><a href=\"#11\">Governing Law &amp; Jurisdiction</a></li>\r\n</ul>\r\n<p><br /> <a name=\"1\"></a><strong>Intellectual Property Rights</strong></p>\r\n<p>Other than the content you own, under these Terms, and/or its licensors own all the intellectual property rights and materials contained in this Website. <br /> You are granted limited license only for purposes of viewing the material contained on this Website.</p>\r\n<p><br /> <a name=\"2\"></a><strong>Restrictions</strong></p>\r\n<p>You are specifically restricted from all of the following:</p>\r\n<ul>\r\n<li>Publication of any material from this site in any other media without a direct active hyperlink to the source.</li>\r\n<li>Selling, sublicensing and/or otherwise commercializing any Website material.</li>\r\n<li>Public performance and/or display of material from this site without express reference to the original source.</li>\r\n<li>Using this Website in any way that is or may be damaging to this Website.</li>\r\n<li>Using this Website in any way that impacts user access to this Website.</li>\r\n<li>Using this Website contrary to applicable laws and regulations, or in any way may cause harm to the Website, or to any person or business entity.</li>\r\n<li>Engaging in any data mining, data harvesting, data extracting or any other similar activity in relation to this Website.</li>\r\n<li>Using this Website to engage in any advertising or marketing.</li>\r\n</ul>\r\n<p>Certain areas of this Website are restricted from being access by you and may further restrict access by you to any areas of this Website, at any time, in absolute discretion. Any user ID and password you may have for this Website are confidential and you must maintain confidentiality as well.</p>\r\n<p><br /> <a name=\"3\"></a><strong>Your Content</strong></p>\r\n<p>In these Website Standard Terms and Conditions, &ldquo;Your Content&rdquo; shall mean any audio, video text, images or other material you choose to display on this Website. By displaying Your Content, you grant a non-exclusive, worldwide irrevocable, sub licensable license to use, reproduce, adapt, publish, translate and distribute it in any and all media. <br /> Your Content must be your own and must not be invading any third-party&rsquo;s rights. reserves the right to remove any of Your Content from this Website at any time without notice.</p>\r\n<p><br /> <a name=\"4\"></a><strong>No warranties</strong></p>\r\n<p>This Website is provided &ldquo;as is,&rdquo; with all faults, and express no representations or warranties, of any kind related to this Website or the materials contained on this Website. Also, nothing contained on this Website shall be interpreted as advising you.</p>\r\n<p><br /> <a name=\"5\"></a><strong>Limitation of liability</strong></p>\r\n<p>In no event shall , nor any of its officers, directors and employees, shall be held liable for anything arising out of or in any way connected with your use of this Website whether such liability is under contract. , including its officers, directors and employees shall not be held liable for any indirect, consequential or special liability arising out of or in any way related to your use of this Website.</p>\r\n<p><br /> <a name=\"6\"></a><strong>Indemnification</strong></p>\r\n<p>You hereby indemnify to the fullest extent from and against any and/or all liabilities, costs, demands, causes of action, damages and expenses arising in any way related to your breach of any of the provisions of these Terms.</p>\r\n<p><br /> <a name=\"7\"></a><strong>Severability</strong></p>\r\n<p>If any provision of these Terms is found to be invalid under any applicable law, such provisions shall be deleted without affecting the remaining provisions herein.</p>\r\n<p><br /> <a name=\"8\"></a><strong>Variation of Terms</strong></p>\r\n<p>is permitted to revise these Terms at any time as it sees fit, and by using this Website you are expected to review these Terms on a regular basis.</p>\r\n<p><br /> <a name=\"9\"></a><strong>Assignment</strong></p>\r\n<p>The is allowed to assign, transfer, and subcontract its rights and/or obligations under these Terms without any notification. However, you are not allowed to assign, transfer, or subcontract any of your rights and/or obligations under these Terms.</p>\r\n<p><br /> <a name=\"10\"></a><strong>Entire Agreement</strong></p>\r\n<p>These Terms constitute the entire agreement between and you in relation to your use of this Website, and supersede all prior agreements and understandings.</p>\r\n<p><br /> <a name=\"11\"></a><strong>Governing Law &amp; Jurisdiction</strong></p>\r\n<p>These Terms and Conditions are governed and interpreted in accordance with the legislation of the Russian Federation, and you submit to the non-exclusive jurisdiction of the state and federal courts located in the Russian Federation for the resolution of any disputes.</p>','terms_and_conditions','',0,'en',0,1543925624,1543925624),(26,'Конфиденциальность','','<p>Эта политика конфиденциальности составлена с целью более эффективного предоставления информации тем, кто обеспокоен использованием их \"лично идентифицируемой информации\" в Интернете.&nbsp;Личной, является информацией, которая может быть использована самостоятельно или совместно с другой информацией для идентификации, связи или определения местонахождения отдельного лица, или для идентификации личности в контексте. Пожалуйста, внимательно прочитайте нашу политику конфиденциальности, чтобы четко понять, как мы собираем, используем, защищаем или иным образом обрабатываем вашу личную информацию.</p>\r\n<ul>\r\n<li><a href=\"#1\">Сбор информации</a></li>\r\n<li><a href=\"#2\">Использование информации</a></li>\r\n<li><a href=\"#3\">Защита информации</a></li>\r\n<li><a href=\"#4\">Использование cookie</a></li>\r\n<li><a href=\"#5\">Раскрытие третьим сторонам</a></li>\r\n<li><a href=\"#6\">Ссылки на сторонние ресурсы</a></li>\r\n<li><a href=\"#7\">CalOPPA&nbsp;</a></li>\r\n<li><a href=\"#8\">COPPA</a></li>\r\n<li><a href=\"#9\">Контактная информация<br /><br /></a></li>\r\n</ul>\r\n<h2>Сбор информации</h2>\r\n<p><a name=\"1\"></a></p>\r\n<p>При регистрации на нашем сайте мы запрашиваем имя, адрес электронной почты, почтовый адрес или другие данные, которые помогут вам в использовании нашего сервиса. Мы собираем информацию у вас при регистрации на нашем сайте, оформлении заказа, подписке на новостную рассылку, ответе на опрос, заполнении формы, использовании онлайн-чата или иной форме вводе информации на нашем сайте.<br /><br /></p>\r\n<h2>Использование информации</h2>\r\n<p><a name=\"2\"></a></p>\r\n<p>Мы можем использовать информацию, которую мы собираем у вас при регистрации, совершении покупки, подписке на нашу рассылку, ответе на опрос или маркетинговое общение, просмотре веб-сайта или использовании определенных функций сайта следующим образом:</p>\r\n<ul>\r\n<li>Для улучшения нашего веб-сайта с целью более качественного обслуживания вас.</li>\r\n<li>Для возможности более качественного отклика на ваши запросы в области обслуживания клиентов.</li>\r\n<li>Для проведения конкурсов, акций, опросов или других функций сайта.</li>\r\n<li>Для быстрой обработки ваших транзакций.</li>\r\n<li>Для просьбы оценить и оставить отзывы о услугах или продукции.</li>\r\n<li>Для контакта с вами после переписки (через онлайн-чат, электронную почту или телефонные запросы).<br /><br /></li>\r\n</ul>\r\n<h2>Защита информации</h2>\r\n<p><a name=\"2\"></a></p>\r\n<p>Наш сайт регулярно сканируется на наличие уязвимостей и известных уязвимостей в целях обеспечения максимальной безопасности вашего посещения. Мы никогда не будем запрашивать личную или конфиденциальную информацию, такую как имена, адреса электронной почты и номера кредитных карт, у неавторизованных пользователей.<br /><br /></p>\r\n<h2>Использование cookie</h2>\r\n<p><a name=\"4\"></a></p>\r\n<p>Да. Куки (cookies) - это небольшие файлы, которые сайт или поставщик услуг передает на жесткий диск вашего компьютера через веб-браузер (если вы разрешаете), что позволяет системам сайта или поставщика услуг распознавать ваш браузер и запоминать определенную информацию. Например, мы используем куки, чтобы помочь нам запоминать и обрабатывать товары в вашей корзине покупок. Они также используются для понимания ваших предпочтений на основе предыдущей или текущей активности на сайте, что позволяет нам предоставлять улучшенные услуги. Мы также используем куки, чтобы получить агрегированные данные о трафике на сайте и взаимодействии с сайтом, чтобы в будущем предложить лучшие пользовательские впечатления и инструменты на сайте. Мы используем куки для:</p>\r\n<ul>\r\n<li>Помощи в запоминании и обработке товаров в корзине покупок.</li>\r\n<li>Понимания и сохранения пользовательских предпочтений для последующих посещений.</li>\r\n</ul>\r\n<p>Вы можете выбрать опцию предупреждения вашего компьютера каждый раз, когда куки отправляются, или отключить все куки. Вы можете сделать это через настройки вашего браузера. Поскольку каждый браузер немного отличается, обратитесь к Руководству пользователя вашего браузера, чтобы узнать правильный способ изменения настроек куки<br /><br /></p>\r\n<h2>Раскрытие третьим лицам</h2>\r\n<p><a name=\"5\"></a></p>\r\n<p>Мы не продаем, не обмениваем и не передаем личную информацию третьим лицам без предварительного уведомления пользователей. Это не относится к партнерам по хостингу веб-сайта и другим сторонам, которые помогают нам в работе нашего веб-сайта, ведении бизнеса или обслуживании пользователей, при условии, что эти стороны согласны сохранять эту информацию конфиденциальной. Мы также можем раскрывать информацию, если ее раскрытие необходимо в соответствии с законом, для обеспечения соблюдения политики нашего сайта или защиты наших или чужих прав, собственности или безопасности. Однако информация, не позволяющая идентифицировать посетителя лично, может быть предоставлена другим сторонам для маркетинга, рекламы или других целей.<br /><br /></p>\r\n<h2>Ссылки на сторонние ресурсы</h2>\r\n<p><a name=\"6\"></a></p>\r\n<p>Иногда по нашему усмотрению мы можем включать или предлагать нашему сайту продукты или услуги третьих лиц. У этих сторон есть отдельные и независимые политики конфиденциальности. Поэтому мы не несем ответственности за содержание и деятельность этих связанных сайтов. Тем не менее, мы стремимся защитить целостность нашего сайта и приветствуем любую обратную связь о этих ресурсах.<br />&nbsp;</p>\r\n<h2>Защита онлайн-приватности (CalOPPA)</h2>\r\n<p><a name=\"7\"></a></p>\r\n<p>Согласно CalOPPA, мы соглашаемся с следующим:</p>\r\n<p>Пользователи могут посещать наш сайт анонимно. После создания этой политики конфиденциальности мы добавим ссылку на нее на главной странице нашего сайта или, как минимум, на первой значимой странице после входа на наш веб-сайт. Ссылка на нашу политику конфиденциальности содержит слово \"Конфиденциальность\" и может быть легко найдена на указанной выше странице. Вы будете уведомлены об изменениях в политике конфиденциальности на нашей странице политики конфиденциальности. Пользователи могут изменить свою личную информацию, войдя в свою учетную запись. Также важно отметить, что мы разрешаем отслеживание поведения третьими лицами.<br /><br /></p>\r\n<h2>Защита онлайн-приватности детей (COPPA)</h2>\r\n<p><a name=\"8\"></a></p>\r\n<p>Когда речь идет о сборе личной информации детей в возрасте до 13 лет, Закон о защите онлайн-приватности детей (COPPA) предоставляет родителям контроль. Федеральная торговая комиссия, агентство по защите прав потребителей Соединенных Штатов, осуществляет контроль за соблюдением правил COPPA, которые определяют, что операторы веб-сайтов и онлайн-сервисов должны делать для защиты конфиденциальности и безопасности детей в Интернете. Мы не нацелены специально на детей в возрасте до 13 лет.<br /><br /></p>\r\n<h2>Контактная информация</h2>\r\n<p><a name=\"9\"></a></p>\r\n<p>Если у вас есть какие-либо вопросы относительно этой политики конфиденциальности, вы можете связаться с нами по электронной почте <a href=\"mailto:devbyzero@yandex.ru\" target=\"_blank\" rel=\"noopener\">devbyzero@yandex.ru</a></p>','privacy_policy','',0,'ru',0,1688645109,1688645109),(27,'Правила и условия','','<p>Эти Правила и условия сайта регулируют правовую составляющую использования этого программного продукта. Используя этот сайт, вы соглашаетесь принять все условия и положения, указанные здесь. Если вы не согласны с любым из этих Стандартных условий и положений сайта, вы не должны использовать этот сайт.</p>\r\n<p>Лицам, не достигшим 18-летнего возраста или несовершеннолетним, запрещено использовать этот сайт.</p>\r\n<ul>\r\n<li><a href=\"#1\">Интеллектуальная собственность</a></li>\r\n<li><a href=\"#2\">Ограничения</a></li>\r\n<li><a href=\"#3\">Ваш контент</a></li>\r\n<li><a href=\"#4\">Отказ от гарантий</a></li>\r\n<li><a href=\"#5\">Ограничение ответственности</a></li>\r\n<li><a href=\"#6\">Возмещение ущерба</a></li>\r\n<li><a href=\"#7\">Раздельность условий</a></li>\r\n<li><a href=\"#8\">Изменение условий</a></li>\r\n<li><a href=\"#9\">Передача прав</a></li>\r\n<li><a href=\"#10\">Полное соглашение</a></li>\r\n<li><a href=\"#11\">Применимое право и юрисдикция</a></li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<h2>Интеллектуальная собственность</h2>\r\n<h2><a name=\"1\"></a></h2>\r\n<p>За исключением контента, принадлежащего вам, согласно этим Условиям и/или его лицензиары владеют всеми правами интеллектуальной собственности и материалами, содержащимися на этом сайте. Вам предоставляется ограниченная лицензия только в целях просмотра материала, содержащегося на этом сайте.</p>\r\n<p>&nbsp;</p>\r\n<h2>Ограничения</h2>\r\n<p><a name=\"2\"></a></p>\r\n<p>Вам категорически запрещено делать следующее:</p>\r\n<ul>\r\n<li>Публикация любого материала с этого сайта в любых других СМИ без прямой активной гиперссылки на источник.</li>\r\n<li>Продажа, сублицензирование и/или коммерциализация любого материала с этого сайта.</li>\r\n<li>Публичное исполнение и/или показ материала с этого сайта без выраженной ссылки на первоисточник.</li>\r\n<li>Использование этого сайта таким образом, который может нанести ущерб этому сайту.</li>\r\n<li>Использование этого сайта таким образом, который влияет на доступ пользователей к этому сайту.</li>\r\n<li>Использование этого сайта вопреки применимым законам и правилам или каким-либо образом может нанести вред сайту, любому человеку или бизнес-структуре.</li>\r\n<li>Проведение любой добычи данных, сбора данных, извлечения данных или любой другой аналогичной деятельности в отношении этого сайта. Использование этого сайта для проведения рекламной или маркетинговой деятельности.</li>\r\n</ul>\r\n<p>Некоторые разделы этого сайта ограничены для вас и могут быть дополнительно ограничены вашим доступом к любым разделам этого сайта в любое время по нашему абсолютному усмотрению. Любой идентификатор пользователя и пароль, которые у вас есть для этого сайта, являются конфиденциальными, и вы также должны сохранять их конфиденциальность.<br /><br /></p>\r\n<h2>Ваш контент</h2>\r\n<p><a name=\"3\"></a></p>\r\n<p>В этих Стандартных условиях и положениях сайта \"Ваш контент\" означает любой аудио-, видео-, текстовый, графический или другой материал, который вы выбираете для отображения на этом веб-сайте. Отображая свой контент, вы предоставляете неисключительную, международную, безотзывную, сублицензируемую лицензию на использование, воспроизведение, адаптацию, публикацию, перевод и распространение его в любых и всех средствах.</p>\r\n<p>Ваш контент должен быть вашим собственным и не должен нарушать права третьих лиц. оставляет за собой право в любое время и без предварительного уведомления удалить любой из вашего контента с этого веб-сайта.<br /><br /></p>\r\n<h2>Отказ от гарантий</h2>\r\n<p><a name=\"4\"></a></p>\r\n<p>Этот веб-сайт предоставляется \"как есть\", со всеми его недостатками, и не делает никаких представлений или гарантий, каких бы то ни было, относящихся к этому веб-сайту или материалам, содержащимся на этом веб-сайте. Кроме того, ничто, содержащееся на этом веб-сайте, не должно рассматриваться как совет.<br /><br /></p>\r\n<h2>Ограничение ответственности</h2>\r\n<p><a name=\"5\"></a></p>\r\n<p>В никаком случае , как и его офицеры, директоры и сотрудники, не несут ответственности за что-либо, возникающее из или связанное с вашим использованием этого веб-сайта, независимо от того, основывается ли такая ответственность на контракте. , включая его офицеров, директоров и сотрудников, не несет ответственности за любую косвенную, последующую или особую ответственность, возникшую из или связанную с вашим использованием этого веб-сайта.<br /><br /></p>\r\n<h2>Возмещение ущерба</h2>\r\n<p><a name=\"6\"></a></p>\r\n<p>Вы полностью возмещаете все расходы и/или все обязательства, требования, причины действий, ущерб и расходы, возникшие в любом отношении, связанном с нарушением вами любых положений настоящих условий.<br /><br /></p>\r\n<h2>Разделимость условий</h2>\r\n<p><a name=\"7\"></a></p>\r\n<p>Если какое-либо положение настоящих Условий будет признано недействительным в соответствии с применимым законодательством, такие положения будут удалены без воздействия на оставшиеся положения настоящего документа.<br /><br /></p>\r\n<h2>Изменение условий</h2>\r\n<p><a name=\"8\"></a></p>\r\n<p>имеет право в любое время изменять настоящие Условия по своему усмотрению, и используя этот Веб-сайт, вы обязаны периодически ознакамливаться с настоящими Условиями.<br /><br /></p>\r\n<h2>Переуступка</h2>\r\n<p><a name=\"9\"></a></p>\r\n<p>имеет право передать, перевести или подрядить свои права и/или обязательства по настоящим Условиям без уведомления. Однако вам запрещается передавать, переводить или подрядывать любые из ваших прав и/или обязательств по настоящим Условиям.<br /><br /></p>\r\n<h2>Полное соглашение</h2>\r\n<p><a name=\"10\"></a></p>\r\n<p>Настоящие Условия составляют полное соглашение между и вас относительно использования данного Веб-сайта и заменяют все предыдущие соглашения и понимание.<br /><br /></p>\r\n<h2>Применимое право и юрисдикция</h2>\r\n<p><a name=\"11\"></a></p>\r\n<p>Настоящие Условия регулируются и толкуются в соответствии с законодательством РФ, и вы подчиняетесь неисключительной юрисдикции государственных и федеральных судов, расположенных в РФ, для разрешения любых споров.</p>','terms_and_conditions','',0,'ru',0,1688645136,1688645136),(28,'隱私政策','','<p>这个隐私政策的目的是更有效地向那些担心他们在互联网上使用他们的\"可识别个人信息\"的人提供信息。个人信息是指可以单独或与其他信息结合使用以识别、联系或确定个人位置，或在特定背景下识别个人身份的信息。请仔细阅读我们的隐私政策，以清楚了解我们如何收集、使用、保护或以其他方式处理您的个人信息。</p>\r\n<ul>\r\n<li><a href=\"#1\">信息收集</a></li>\r\n<li><a href=\"#2\">信息使用</a></li>\r\n<li><a href=\"#3\">信息保护</a></li>\r\n<li><a href=\"#4\">Cookie 使用</a></li>\r\n<li><a href=\"#5\">向第三方公开披露</a></li>\r\n<li><a href=\"#6\">引用第三方资源</a></li>\r\n<li><a href=\"#7\">CalOPPA 法案</a></li>\r\n<li><a href=\"#8\">COPPA 法案</a></li>\r\n<li><a href=\"#9\">联络信息</a><br /><br /></li>\r\n</ul>\r\n<h2>信息收集</h2>\r\n<p><a name=\"1\"></a></p>\r\n<p>当您在我们的网站注册时，我们会要求您提供姓名、电子邮件地址、邮寄地址或其他能够帮助您使用我们服务的数据。我们会在您注册我们的网站、下订单、订阅新闻通讯、回答调查、填写表格、使用在线聊天或在我们的网站上输入信息的过程中收集您的信息。<br /><br /></p>\r\n<h2>信息使用</h2>\r\n<p><a name=\"2\"></a></p>\r\n<p>我们可能会使用我们从您那里收集到的信息进行以下操作：</p>\r\n<ul>\r\n<li>为了改善我们的网站，以提供更高质量的服务；</li>\r\n<li>为了更好地响应您在客户服务方面的请求；</li>\r\n<li>为了举办比赛、促销活动、调查或其他网站功能；</li>\r\n<li>快速处理您的交易；</li>\r\n<li>要求您评估并留下有关服务或产品的评论；</li>\r\n<li>在与您通信后与您联系（通过在线聊天、电子邮件或电&nbsp;<br /><br /></li>\r\n</ul>\r\n<h2>信息保护</h2>\r\n<p><a name=\"3\"></a></p>\r\n<p>我们定期扫描我们的网站，以确保您访问的最大安全性，以查找漏洞和已知的漏洞。我们绝不会要求未经授权的用户提供个人或机密信息，如姓名、电子邮件地址和信用卡号码。<br /><br /></p>\r\n<h2>使用Cookie</h2>\r\n<p><a name=\"4\"></a></p>\r\n<p>是的。Cookie是小文件，通过网络浏览器传递到您计算机的硬盘上的网站或服务提供商。这允许网站系统或服务提供商识别您的浏览器并记住特定信息。例如，我们使用Cookie来帮助我们记住和处理您购物车中的商品。它们还用于根据您在网站上的先前或当前活动了解您的偏好，从而为您提供改进的服务。我们还使用Cookie来获取关于网站流量和与网站的互动的聚合数据，以便将来提供更好的用户体验和工具。我们使用Cookie来：</p>\r\n<p>帮助记住和处理购物车中的商品。 理解和保存用户的首选项以供后续访问。 您可以选择在每次发送Cookie时都提示您的计算机，或者禁用所有Cookie。您可以通过浏览器设置进行此操作。由于每个浏览器略有不同，请参阅您浏览器的用户指南以获得正确更改Cookie设置的方法。<br /><br /></p>\r\n<h2>向第三方披露</h2>\r\n<p><a name=\"5\"></a></p>\r\n<p>我们不会在未事先通知用户的情况下出售、交换或转让个人信息给第三方。这不适用于我们网站托管合作伙伴和其他帮助我们经营网站、开展业务或为用户提供服务的方，只要这些方同意将此信息保密。我们还可能在法律要求、遵守我们网站政策或保护我们或他人的权利、财产或安全所必需的情况下披露信息。然而，不能识别访问者个人身份的信息可能会提供给其他方用于营销、广告或其他目的<br /><br /></p>\r\n<h2>第三方资源链接</h2>\r\n<p><a name=\"6\"></a></p>\r\n<div class=\"flex items-end gap-1 mt-2 flex-row\">\r\n<div class=\"text-black text-wrap min-w-[20px] rounded-md p-3 bg-[#f4f6f8] dark:bg-[#1e1e20]\">\r\n<div class=\"leading-relaxed break-words\">\r\n<div class=\"markdown-body\">\r\n<p>根据我们的判断，我们有时会在我们的网站上包含或提供第三方的产品或服务。这些第三方拥有独立的隐私政策。因此，我们对这些关联网站的内容和活动不承担责任。但是，我们致力于保护我们网站的完整性，并欢迎任何有关这些资源的反馈。<br /><br /></p>\r\n<h2>在线隐私保护（CalOPPA）</h2>\r\n<p><a name=\"7\"></a></p>\r\n<p>根据CalOPPA，我们同意以下内容：</p>\r\n<p>用户可以匿名访问我们的网站。在创建隐私政策后，我们将在我们网站的主页上或至少在登录我们网站后的第一个重要页面上添加该隐私政策的链接。我们的隐私政策链接包含 \"隐私\" 一词，并且可以在上述指定页面上轻松找到。我们会在我们的隐私政策页面上通知您有关隐私政策的变更。用户可以通过登录他们的帐户来更改他们的个人信息。还值得注意的是，我们允许第三方进行行为跟踪。<br /><br /></p>\r\n<h2>儿童在线隐私保护（COPPA）</h2>\r\n<p><a name=\"8\"></a></p>\r\n<p>当涉及到收集13岁以下儿童的个人信息时，儿童在线隐私保护法（COPPA）赋予父母控制权。美国联邦贸易委员会，即美国消费者保护机构，负责监督COPPA规则的执行，这些规则规定网站运营商和在线服务提供商必须采取措施保护儿童在互联网上的隐私和安全。我们并不专门面向13岁以下儿童。<br /><br /></p>\r\n<h2>联系方式</h2>\r\n<p><a name=\"9\"></a></p>\r\n<p>如果您对本隐私政策有任何疑问，请通过电子邮件与我们联系&nbsp;<a href=\"mailto:devbyzero@yandex.ru\">devbyzero@yandex.ru</a></p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>','privacy_policy','',0,'zh',0,1688645136,1688645136),(29,'條款和條件','','<p>条款和条件 这些网站标准条款和条件是在此网页上编写的，将管理您对本网站的使用。这些条款将完全适用并影响您对本网站的使用。通过使用本网站，您同意接受此处所写的所有条款和条件。如果您不同意这些网站标准条款和条件中的任何内容，则不得使用本网站。</p>\r\n<p>未成年人或18岁以下的人不得使用本网站。</p>\r\n<ul>\r\n<li><a href=\"#1\">知识产权</a></li>\r\n<li><a href=\"#2\">限制</a></li>\r\n<li><a href=\"#3\">您的内容</a></li>\r\n<li><a href=\"#4\">无保证</a></li>\r\n<li><a href=\"#5\">责任限制</a></li>\r\n<li><a href=\"#6\">赔偿</a></li>\r\n<li><a href=\"#7\">可分割性</a></li>\r\n<li><a href=\"#8\">条款变更</a></li>\r\n<li><a href=\"#9\">转让</a></li>\r\n<li><a href=\"#10\">完整协议</a></li>\r\n<li><a href=\"#11\">法律管辖<br /><br /></a></li>\r\n</ul>\r\n<p>知识产权<a name=\"1\"></a></p>\r\n<p>除了您拥有的内容外，在这些条款下，以及/或其许可方拥有本网站中包含的所有知识产权和材料。 您仅被授予有限许可，仅用于查看本网站上包含的材料。<br /><br /></p>\r\n<p>限制<a name=\"2\"></a></p>\r\n<p>您明确受到以下所有限制的约束：</p>\r\n<ul>\r\n<li>未经直接活动超链接到来源的许可，禁止在任何其他媒体上发布本网站的任何材料。</li>\r\n<li>禁止销售、再许可和/或以任何方式商业化任何网站材料。</li>\r\n<li>未经明确引用原始来源，禁止公开展示本网站的材料。</li>\r\n<li>以可能对本网站造成损害的任何方式使用本网站。</li>\r\n<li>以可能影响用户访问本网站的任何方式使用本网站。</li>\r\n<li>违反适用法律和法规，或以任何方式对本网站、任何个人或商业实体造成损害。</li>\r\n<li>在与本网站相关的任何数据挖掘、数据收集、数据提取或任何其他类似活动中使用本网站。</li>\r\n<li>使用本网站进行任何广告或营销活动。</li>\r\n</ul>\r\n<p>本网站的某些区域受到限制，您可能无法访问这些区域，而且我们保留随时自行决定限制您对本网站任何区域的访问权限的权利。您可能拥有的任何用户ID和密码都是机密的，您必须保持机密性。<br /><br /></p>\r\n<p>您的内容<a name=\"3\"></a></p>\r\n<p>在这些网站标准条款和条件中，&ldquo;您的内容&rdquo;指的是您选择在本网站上显示的任何音频、视频、文本、图像或其他材料。通过显示您的内容，您授予非独占性、全球不可撤销、可转让的许可证，在任何媒体上使用、复制、改编、发布、翻译和分发您的内容。 您的内容必须是您自己的，并且不得侵犯任何第三方的权利。保留随时在未经通知的情况下从本网站删除您的任何内容的权利。<br /><br /></p>\r\n<p>无担保<a name=\"4\"></a></p>\r\n<p>本网站按&ldquo;原样&rdquo;提供，不提供任何明示或暗示的陈述或保证，与本网站或本网站上包含的材料有关的任何种类的保证均不提供。此外，本网站上的任何内容都不应被解释为向您提供建议。<br /><br /></p>\r\n<p>责任限制<a name=\"5\"></a></p>\r\n<p>在任何情况下，无论是根据合同还是其他方式，对于因您使用本网站而产生的任何事项，包括其官员、董事和雇员，均不承担任何责任。对于因您使用本网站而产生的任何间接、后果性或特殊责任，包括其官员、董事和雇员，均不承担任何责任。<br /><br /></p>\r\n<p>赔偿<a name=\"6\"></a></p>\r\n<p>您在此对因您违反本条款的任何规定而产生的任何及/或所有责任、费用、要求、诉因、损害和费用进行最充分的赔偿，这些赔偿与您违反本条款的任何规定有关。<br /><br /></p>\r\n<p>可分割性<a name=\"7\"></a></p>\r\n<p>如果根据任何适用法律发现本条款的任何规定无效，则应删除该等规定，但不影响本条款中的其他规定。<br /><br /></p>\r\n<p>条款的变更<a name=\"8\"></a></p>\r\n<p>有权随时根据其认为合适的方式修订本条款，并且通过使用本网站，您应定期审查这些条款。<br /><br /></p>\r\n<p>转让<a name=\"9\"></a></p>\r\n<p>允许转让、转让和分包其在本条款下的权利和/或义务，而无需任何通知。但是，您不得转让、转让或分包您在本条款下的任何权利和/或义务。<br /><br /></p>\r\n<p>完整协议<a name=\"10\"></a></p>\r\n<p>本条款构成您与之间关于您使用本网站的协议，并取代所有先前的协议和理解。<br /><br /></p>\r\n<p>管辖法律和司法管辖权<a name=\"11\"></a></p>\r\n<p>真实条件受俄罗斯法律的调整和解释，并且您服从位于俄罗斯的国家和联邦法院的非排他性司法管辖权，以解决任何争议。</p>','terms_and_conditions','',0,'zh',0,1688645136,1688645136);
/*!40000 ALTER TABLE `nodes_catalog` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `nodes_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nodes_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(100) NOT NULL,
  `reply` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `text` varchar(4000) NOT NULL,
  `date` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `url` (`url`),
  KEY `reply` (`reply`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `nodes_comment` WRITE;
/*!40000 ALTER TABLE `nodes_comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `nodes_comment` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `nodes_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nodes_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `value` text NOT NULL,
  `text` varchar(100) NOT NULL,
  `type` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=62 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `nodes_config` WRITE;
/*!40000 ALTER TABLE `nodes_config` DISABLE KEYS */;
INSERT INTO `nodes_config` VALUES (1,'name','DAO Mansion','Site name','string'),(2,'description','Incorporating the concept of Web 3.0 information society, the DAO aims to create a progressive and sustainable community that combines ecological, social, and economic benefits.','Description','string'),(3,'email','devbyzero@yandex.ru','Site email','string'),(4,'language','ru','Site language','string'),(5,'languages','en;ru;zh','Available languages','string'),(6,'image','https://dao-mansion.ru/img/preview.jpg','Site image','string'),(7,'email_image','https://dao-mansion.ru/img/preview.jpg','Email header image','string'),(8,'invoice_image','https://dao-mansion.ru/img/preview.jpg','Invoice logo image','string'),(9,'template','bootstrap','Template','string'),(10,'default','profile.php','System','string'),(11,'debug','0','Debug mode','bool'),(12,'cron','0','jQuery cron','bool'),(13,'cache','1','Allow cache','bool'),(14,'compress','1','Compress HTML','bool'),(15,'sandbox','1','Sandbox payment mode','bool'),(20,'free_message','0','Messages between users','bool'),(21,'daily_report','1','Daily report to email','bool'),(22,'confirm_signup_email','1','Email confirmation while sign up','bool'),(23,'send_comments_email','1','Email admin on comment','bool'),(24,'send_registration_email','1','Email user on sign up','bool'),(25,'send_message_email','1','Email user on message','bool'),(26,'send_paypal_email','1','Email user on payment','bool'),(27,'git','http://git.dao-mansion.ru:3000/restinpc/DAO','Git repository url','string'),(61,'cron_sessions','1719468361','System','int'),(30,'yandex_money','','<a href=\"https://money.yandex.ru/\" target=\"_blank\">Yandex Money ID</a>','string'),(31,'paypal_test','1','PayPal test mode','bool'),(32,'paypal_id','','<a href=\"https://www.paypal.com/\" target=\"_blank\">PayPal user ID</a>','string'),(33,'payment_description','','Payment description','string'),(51,'outbox_limit','1','Max outbox  minute','int'),(52,'version','8','System','int'),(55,'cron_images','1719468302','System','int'),(56,'cron_exec','1719504841','System','int'),(57,'cron_done','1719504842','System','int'),(58,'lastreport','1719442802','System','int');
/*!40000 ALTER TABLE `nodes_config` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `nodes_content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nodes_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL DEFAULT '0',
  `url` varchar(100) NOT NULL,
  `lang` varchar(3) NOT NULL,
  `order` int(11) NOT NULL DEFAULT '0',
  `caption` varchar(400) NOT NULL,
  `text` text NOT NULL,
  `img` varchar(100) NOT NULL,
  `date` int(11) NOT NULL DEFAULT '0',
  `public_date` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `cat_id` (`cat_id`),
  KEY `lang` (`lang`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `nodes_content` WRITE;
/*!40000 ALTER TABLE `nodes_content` DISABLE KEYS */;
/*!40000 ALTER TABLE `nodes_content` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `nodes_error`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nodes_error` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(400) NOT NULL,
  `lang` varchar(3) NOT NULL,
  `date` int(11) NOT NULL DEFAULT '0',
  `ip` varchar(20) NOT NULL,
  `get` text NOT NULL,
  `post` text NOT NULL,
  `session` text NOT NULL,
  `count` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `lang` (`lang`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `nodes_error` WRITE;
/*!40000 ALTER TABLE `nodes_error` DISABLE KEYS */;
/*!40000 ALTER TABLE `nodes_error` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `nodes_inbox`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nodes_inbox` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from` int(11) NOT NULL DEFAULT '0',
  `to` int(11) NOT NULL DEFAULT '0',
  `text` text NOT NULL,
  `date` int(11) NOT NULL DEFAULT '0',
  `readed` int(11) NOT NULL DEFAULT '0',
  `inform` tinyint(1) NOT NULL,
  `system` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `from` (`from`),
  KEY `to` (`to`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `nodes_inbox` WRITE;
/*!40000 ALTER TABLE `nodes_inbox` DISABLE KEYS */;
/*!40000 ALTER TABLE `nodes_inbox` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `nodes_invoice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nodes_invoice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `order_id` int(11) NOT NULL DEFAULT '0',
  `amount` double NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `nodes_invoice` WRITE;
/*!40000 ALTER TABLE `nodes_invoice` DISABLE KEYS */;
/*!40000 ALTER TABLE `nodes_invoice` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `nodes_language`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nodes_language` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `lang` varchar(3) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lang` (`lang`)
) ENGINE=MyISAM AUTO_INCREMENT=1294 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `nodes_language` WRITE;
/*!40000 ALTER TABLE `nodes_language` DISABLE KEYS */;
INSERT INTO `nodes_language` VALUES (1,'Received','ru','Получено'),(2,'new messages','ru','новые сообщения'),(3,'Updating engine from version','ru','Обновления движка с версии'),(4,'Upload','ru','Загрузить'),(5,'Link','ru','Ссылка'),(6,'Cancel','ru','Отмена'),(7,'Uploaded','ru','Загружено'),(8,'For uploading selected area use double click','ru','Для сохранения выделенной области используй двойной клик'),(9,'Error','ru','Ошибка'),(10,'Upload image','ru','Загрузить изображение'),(11,'Sitemap','ru','Карта сайта'),(12,'Format','ru','Маска'),(13,'Upload new image','ru','Загрузить новое изобр.'),(14,'Logout sucsessful','ru','Сессия завершена'),(15,'Quit','ru','Выход'),(16,'Site','ru','Сайт'),(17,'Users','ru','Пользователи'),(18,'Comments','ru','Комментарии'),(19,'Content','ru','Контент'),(20,'Errors','ru','Ошибки'),(21,'Files','ru','Файлы'),(22,'Images','ru','Изображения'),(23,'Videos','ru','Видео'),(24,'Access','ru','Доступ'),(25,'Config','ru','Настройки'),(26,'Backend','ru','Бекенд'),(27,'Logout','ru','Выход'),(28,'Authentication timeout','ru','Таймаут аутенфикации'),(29,'Password','ru','Пароль'),(30,'Upload selection as thumb?','ru','Загрузить выделенную облать как превью?'),(31,'Save uploaded images','ru','Сохранить загруженные'),(32,'Previous page','ru','Предыдущая страница'),(33,'Next page','ru','Следующая страница'),(34,'Updated','ru','Обновлено'),(35,'Interval','ru','Интервал'),(36,'Not existing','ru','Не существует'),(37,'Not cathing','ru','Не кешируется'),(38,'Not refreshing','ru','Не обновляется'),(39,'minut','ru','минут'),(40,'minuts','ru','минут'),(41,'hour','ru','час'),(42,'hours','ru','часов'),(43,'Dayly','ru','Суточно'),(44,'Change interval','ru','Изменить интервал'),(45,'Refresh catch','ru','Обновить кэш'),(46,'Edit article','ru','Редактировать статью'),(47,'Caption','ru','Название'),(48,'No image','ru','Нет изображения'),(49,'Edit directory','ru','Редактировать раздел'),(50,'Return','ru','Назад'),(51,'Add new article','ru','Добавить новую статью'),(52,'Edit','ru','Редактировать'),(53,'Delete','ru','Удалить'),(54,'Add a new directory','ru','Добавить раздел'),(55,'Description','ru','Описание'),(56,'Back','ru','Назад'),(57,'List','ru','Список'),(58,'Add','ru','Добавить'),(59,'Preview','ru','Превью'),(60,'Uploading files','ru','Загрузка файлов'),(61,'File','ru','Файл'),(62,'Submit','ru','Отправить'),(63,'Included files','ru','Подключенные файлы'),(64,'Path','ru','Путь'),(65,'Class','ru','Класс'),(66,'Create new file','ru','Создать новый файл'),(67,'Lost password','ru','Забыли пароль'),(68,'allready exist','ru','уже существует'),(69,'Incorrect email of password','ru','Неправильный email или пароль'),(70,'not found','ru','не найден'),(71,'Message with new password is sended to email','ru','Письмо с новым паролем отправлено на указанный email'),(72,'New password is','ru','Новый пароль'),(73,'New password for','ru','Новый пароль для'),(74,'Registration sucsessful','ru','Вы успешно зарегистрировались'),(75,'We are glad to confirm sucsessful registration at','ru','Мы рады сообщить, что Вы успешно зарегистрировались на'),(76,'About software','ru','О программе'),(77,'Errors not found','ru','Ошибок не найдено'),(78,'Clear log','ru','Очистить список'),(79,'Date','ru','Дата'),(80,'New user','ru','Новый пользователь'),(81,'Name','ru','Имя'),(82,'Ban','ru','Забанить'),(83,'Unban','ru','Разбанить'),(84,'Confirm deleting banned user','ru','Удалить забаненного пользователя, без возможности восстановления'),(85,'Create user','ru','Создать пользователя'),(86,'Incorrect email','ru','Неправильный email'),(87,'Enter password','ru','Введите пароль'),(88,'Update interval','ru','Обновить интервал'),(89,'All pages','ru','Все страницы'),(90,'Logs','ru','Логи'),(91,'Text','ru','Текст'),(92,'Pages not found','ru','Страниц не найдено'),(93,'Sign Up','ru','Регистрация'),(94,'Admin','ru','Админ'),(95,'Upload files','ru','Загрузка файлов'),(96,'Account','ru','Аккаунт'),(97,'Save settings','ru','Сохранить настройки'),(98,'Access denied','ru','Доступ запрещен'),(99,'Message sent successfully','ru','Сообщение успешно отправлено'),(100,'New message from','ru','Новое сообщение от'),(101,'My Account','ru','Мой аккаунт'),(102,'Show navigation','ru','Показать навигацию'),(103,'Your message here','ru','Ваше сообщение'),(104,'Send message','ru','Отправить сообщение'),(105,'Developed by','ru','Разработчик'),(106,'Up','ru','Вверх'),(107,'Show All','ru','Показать все'),(108,'Change picture','ru','Сменить изображение'),(109,'Enter your email and password to continue','ru','Для продолжения укажите ваш email и пароль'),(110,'Settings','ru','Настройки'),(111,'Email','ru','Email'),(112,'New password','ru','Новый пароль'),(113,'Enter your email','ru','Укажите ваш email'),(114,'Enter your password','ru','Укажите ваш пароль'),(115,'Save changes','ru','Сохранить настройки'),(116,'Back to account','ru','Назад в аккаунт'),(117,'Invalid conformation code','ru','Неправильный код подтверждения'),(118,'Registration at','ru','Регистрация на'),(119,'Confirmation code','ru','Код подтверждения'),(120,'No articles found','ru','Статей не найдено'),(121,'Messages','ru','Сообщения'),(122,'Back to admin','ru','Назад в админку'),(123,'Status','ru','Статус'),(124,'Yes','ru','Да'),(125,'No','ru','Нет'),(126,'Show in navigation','ru','Показать в навигации'),(127,'Back to content','ru','Назад к содержанию'),(128,'Delete image','ru','Удалить изображение'),(129,'Comments not found','ru','Комментариев не найдено'),(130,'Add reply','ru','Добавить ответ'),(131,'Users not found','ru','Пользователей не найдено'),(132,'Share friends in','ru','Рассказать друзьям в'),(133,'Language','ru','Язык'),(134,'Home','ru','Главная'),(135,'Connect us at','ru','Связаться в '),(136,'All rights reserved','ru','Все права защищены'),(137,'There is no users, you can send a message','ru','Контакты отсутствуют'),(138,'Add comment','ru','Добавить комментарий'),(139,'Submit comment','ru','Отправить комментарий'),(140,'Add new comment','ru','Добавить новый комментарий'),(141,'There is no comments','ru','Комментарии отсутствуют'),(142,'Comment submited!','ru','Комментарий отправлен!'),(143,'To post a comment, please','ru','Чтобы отправить комментарий, '),(144,'Restore password','ru','Восстановить пароль'),(145,'Reply','ru','Ответ'),(146,'Enabled','ru','Включено'),(147,'Autoupdate','ru','Автообновление'),(148,'Authentication error','ru','Ошибка аутенфикации'),(149,'Disabled','ru','Отключено'),(150,'Select your language','ru','Выбирете язык'),(151,'Or file','ru','Или файл'),(152,'Online','ru','online'),(153,'Get in Touch','ru','Связаться'),(154,'Contact Us','ru','Контакты'),(155,'Copyright','ru','Copyright'),(156,'offline','ru','оффлайн'),(157,'Search','ru','Поиск'),(158,'Search results by request','ru','Поиск по запросу'),(159,'Documentation','ru','Документация'),(160,'Add new value','ru','Добавить запись'),(161,'auth','ru','Авторизуйтесь'),(162,'Download','ru','Скачать'),(163,'Install','ru','Установить'),(164,'Framework','ru','Структура'),(165,'Useful services','ru','Полезные сервисы'),(166,'Setup','ru','Установка'),(167,'Login to send message','ru','Авторизуйтесь, чтобы отправить сообщение'),(168,'Add article','ru','Добавить статью'),(169,'register now','ru','Зарегистрируйтесь'),(170,'There is no articles','ru','Статей не найдено'),(171,'Functions','ru','Функции'),(172,'Database','ru','База данных'),(173,'Clear logs','ru','Очистить логи'),(174,'Logs not found','ru','Логи не найдены'),(175,'Search results for','ru','Результаты поиска'),(176,'Sorry, no results found','ru','По вашему запросу ничего не нашлось'),(177,'IP','ru',''),(178,'New message','ru','Новое сообщение'),(179,'Value','ru','Значение'),(180,'Showing','ru','Отображаются'),(181,'to','ru','по'),(182,'from','ru','из'),(183,'entries','ru','вхождений'),(184,'per page','ru','на страницу'),(185,'Next','ru','Вперед'),(186,'Account confirmation','ru','Подтверждение аккаунта'),(187,'Previous','ru','Назад'),(188,'Code','ru','Код'),(189,'Select option','ru','Выберете опцию'),(190,'Content not found','ru','Данных не найдено'),(191,'Crop image','ru','Обрезать изображение'),(192,'Sended','ru','Отправлено'),(193,'at','ru','в'),(194,'Too many failed attempts','ru','Слишком много неудачных попыток'),(195,'User','ru','Пользователь'),(196,'Action','ru','Действие'),(197,'seconds','ru','секунд'),(198,'Try again after','ru','Попробуйте еще через'),(199,'Downloading files','ru','Скачивание файлов'),(200,'Receiving','ru','Получение'),(201,'Update aborted','ru','Обновление прекращено'),(202,'Replacing downloaded files from','ru','Перемещение скачанных файлов из'),(203,'Receiving MySQL data','ru','Получение MySQL данных'),(204,'Executed','ru','Исполнено'),(205,'commands','ru','комманд'),(206,'Updating to version','ru','Обновление до версии'),(207,'is complete','ru','завершено'),(208,'after 5 seconds','ru','через 5 секунд'),(209,'Current version','ru','Текущая версия'),(210,'New updates available','ru','Доступно обновление'),(211,'Update Now','ru','Обновить сейчас'),(212,'No updates available','ru','Обновление недоступно'),(213,'Invalid confirmation code','ru','Неверный код подтверждения'),(214,'Data not found','ru','Данные не найдены'),(215,'Trying to register','ru','Попытка регистрации'),(216,'Comment posted','ru','Добавлен комментарий'),(217,'There is no files','ru','Файлов не найдено'),(218,'Updates','ru','Обновления'),(219,'Login','ru','Логин'),(220,'Page not found','ru','Страница не найдена'),(221,'Back to Home Page','ru','Назад на главную'),(222,'or','ru','или'),(223,'Loading','ru','Загрузка'),(224,'Attendance','ru','Посещаемость'),(225,'Back to Top','ru','Наверх'),(226,'Templates','ru','Шаблоны'),(227,'Default file','ru','Файл по-умолчанию'),(228,'New file','ru','Новый файл'),(229,'New template','ru','Новый шаблон'),(230,'Default template','ru','Шаблон по-умолчанию'),(231,'Template name','ru','Название шаблона'),(232,'Views','ru','Просмотры'),(233,'Visitors','ru','Посетители'),(234,'Statistic','ru','Статистика'),(235,'Pages','ru','Страницы'),(236,'Referrers','ru','Источники'),(237,'By days','ru','По дням'),(238,'By weeks','ru','По неделям'),(239,'By months','ru','По месяцам'),(240,'Amount','ru','Количество'),(241,'Blank','ru','Пусто'),(242,'Restore your password','ru','Восстановить пароль'),(243,'To restore your password, use this code','ru','Для восстановления пароля используйте этот код'),(244,'Message with confirmation code is sended to email','ru','Письмо с кодом подтверждения отправлено на указаный email'),(245,'There is no templates','ru','Шаблоны отсутствуют'),(246,'Register','ru','Регистрация'),(247,'Try to register','ru','Попытка регистрации'),(248,'Trying to login','ru','Попытка авторизации'),(249,'Engine update','ru','Обновление движка'),(250,'Category','ru','Категория'),(251,'Reset Filter','ru','Сбросить'),(252,'Unable to purchase your own product','ru','Нельзя приобрести свой товар'),(253,'You might also be interested in','ru','Вас может заинтересовать'),(254,'Products not found','ru','Товары не найдены'),(255,'Withdrawal already requested','ru','Вывод средств уже запрошен'),(256,'Withdrawal request accepted','ru','Запрос на вывод средств принят'),(257,'Select file','ru','Выберите файл'),(258,'Editable file','ru','Редактируемый файл'),(259,'Source file','ru','Исходный файл'),(260,'Gateway Timeout','ru','Таймаут запроса'),(261,'Image is too small. Minimal size is 400x400','ru','Изображение слишком маленькое. Минимальный размер 400x400'),(262,'Drop files here','ru','Пертащите файлы сюда'),(263,'System message','ru','Системное сообщение'),(264,'sign in','ru','авторизуйтесь'),(265,'Confirm Shipment','ru','Подтвердите отправку'),(266,'Post track number','ru','Почтовый трек-номер'),(267,'Shipment is confirmed','ru','Отправка подтверждена'),(268,'This item is sold out now?','ru','Снять товар с продажи?'),(269,'New order','ru','Новый заказ'),(270,'Archive order','ru','Архивировать заказ'),(271,'Finished','ru','Завершено'),(272,'Purchaser','ru','Покупатель'),(273,'Shipping address','ru','Адрес доставки'),(274,'All Items','ru','Все товары'),(275,'Buy Now!','ru','Купить!'),(276,'Title','ru','Название'),(277,'Ask price','ru','Стоимость'),(278,'Edit product','ru','Редактировать товар'),(279,'Click to Deactivate','ru','Деактивировать'),(280,'Click to Activate','ru','Активировать'),(281,'Buy Now','ru','Купить'),(282,'Tracking number','ru','Трек-номер'),(283,'Shipment in process','ru','Доставка в процессе'),(284,'Confirm receipt','ru','Подтвердить получение'),(285,'Seller','ru','Продавец'),(286,'Shipping from','ru','Доставка из'),(287,'New comment at','ru','Новый комментарий на'),(288,'Ok','ru','Ok'),(289,'New message at','ru','Новое сообщение на'),(290,'Dear','ru','Дорогой'),(291,'sent a message for you','ru','отправил(а) сообщение вам'),(292,'For details, click','ru','Для подробностей, кликните'),(293,'here','ru','здесь'),(294,'Withdrawal request at','ru','Вывод средств'),(295,'You withdrawal request is pending now','ru','Ваш запрос на вывод средств обрабатывается'),(296,'After some time you will receive','ru','Через некоторое время вам придет'),(297,'on your PayPal account','ru','на ваш PayPal аккаунт'),(298,'There in new withdrawal request at','ru','Новый запрос на вывод средств на'),(299,'Need to pay','ru','Нужно оплатить'),(300,'on PayPal account','ru','на PayPal аккаунт'),(301,'and confirm request','ru','и подтвредить запрос'),(302,'Details','ru','Подробности'),(303,'Withdrawal is complete at','ru','Вывод средств завершен на'),(304,'You withdrawal is complete','ru','Ваш запрос средств обработан'),(305,'Thanks for using our service and have a nice day','ru','Спасибо за использование нашего сервиса и удачного Вам дня'),(306,'New purchase at','ru','Новая покупка на'),(307,'Congratulations on your purchase at','ru','Поздравляем с покупкой на'),(308,'You can see details of your purchases','ru','Вы можете посмотреть подробную информацию о покупке'),(309,'There in new purchase at','ru','Новая покупка на'),(310,'make a payment','ru','совершил платеж'),(311,'to your PayPal account','ru','на ваш PayPal аккаунт'),(312,'Your order has been shipped at','ru','Ваш заказ был отправлен на'),(313,'Your order','ru','Ваш заказ'),(314,'has been shipped','ru','был отправлен'),(315,'After receiving, please update purchase status','ru','После получения обновите статус покупки'),(316,'Your order has been completed at','ru','Ваш заказ был завершен на'),(317,'Your order has been completed','ru','Ваш заказ был завершен'),(318,'Funds added to your account and available for withdrawal','ru','Средства зачислены на Ваш аккаунт и доступны для вывода'),(319,'Orders not found','ru','Заказов не найдено'),(320,'Type','ru','Тип'),(321,'Withdrawal request','ru','Запрос на вывод'),(322,'Money deposit','ru','Зачисление средств'),(323,'Order','ru','Заказ'),(324,'Please, confirm transaction','ru','Пожалуйста, подтвердите'),(325,'Confirm payment','ru','Подтвердить платеж'),(326,'Bots','ru','Боты'),(327,'Banned','ru','Забанен'),(328,'Active','ru','Активен'),(329,'Please, describe this item','ru','Пожалуйста, опишите товар'),(330,'Description (e g  Blue Nike Vapor Cleats Size 10  Very comfortable and strong ankle support )','ru','Описание (прим. Синиие Nike Vapor Бутсы. Размер 10. Очень удобные и сильная поддержка лодыжки.)'),(331,'Please, confirm item shipping address','ru','Пожалуйста, подтвердите адрес'),(332,'State','ru','Область'),(333,'City','ru','Город'),(334,'Zip code','ru','Почтовый индекс'),(335,'Street','ru','Улица'),(336,'Phone number','ru','Номер телефона'),(337,'Price','ru','Цена'),(338,'Choose action','ru','Выберете действие'),(339,'Edit item','ru','Редактировать товар'),(340,'Deactivate item','ru','Деактивировать'),(341,'Activate item','ru','Активировать'),(342,'List new Item','ru','Добавить новый товар'),(343,'Edit Properties','ru','Редактировать свойства'),(344,'Keywords','ru','Ключевые слова'),(345,'Mode','ru','Режим'),(346,'Replace','ru','Заменить'),(347,'Cron error','ru','Ошибка cron'),(348,'Save','ru','Сохранить'),(349,'Are you sure?','ru','Вы уверены?'),(350,'Add value','ru','Добавить значение'),(351,'Edit property','ru','Редактировать свойство'),(352,'New value','ru','Новое значение'),(353,'Delete property','ru','Удалить свойство'),(354,'Add new property','ru','Добавить новое свойство'),(355,'Back to products','ru','Назад к товарам'),(356,'Connect with social network','ru','Подключить аккаунт соц. сети'),(357,'Delivery confirmation','ru','Подтверждение получения'),(358,'Quality','ru','Качество'),(359,'Your comment here','ru','Ваш комментарий'),(360,'Purchases','ru','Покупки'),(361,'Thank you for your order! Shipment in process now.','ru','Спасибо за Ваш заказ! Отправление в процессе.'),(362,'There is no purchases','ru','Нет новых покупок'),(363,'Finances','ru','Финансы'),(364,'The funds have been added to your account','ru','Средства были зачислены на Ваш аккаунт'),(365,'Balance','ru','Баланс'),(366,'Pending','ru','Ожидание'),(367,'New','ru','Новый'),(368,'Transactions not found','ru','Транзакций не найдено'),(369,'Request withdrawal','ru','Запрос на вывод'),(370,'Confirm your PayPal','ru','Укажите Ваш PayPal'),(371,'Deposit money','ru','Зачислить средства'),(372,'Amount to deposit','ru','Количество к зачислению'),(373,'About','ru','О программе'),(374,'Products','ru','Товары'),(375,'Orders','ru','Заказы'),(376,'Finance','ru','Финансы'),(377,'Order products','ru','Заказать товары'),(378,'Confirmation','ru','Подтверждение'),(379,'Please, confirm your order','ru','Пожалуйста, подтвердите Ваш заказ'),(380,'Remove product','ru','Удалить товар'),(381,'Sorry, there is no products','ru','Извините, товаров не найдено'),(382,'Total price','ru','Итоговая цена'),(383,'Shipping','ru','Доставка'),(384,'Please, confirm your shipping address','ru','Пожалуйста, подтвержите адрес'),(385,'Payment','ru','Платеж'),(386,'First name','ru','Имя'),(387,'Last name','ru','Фамилия'),(388,'Country','ru','Страна'),(389,'Process payment','ru','Оплатить'),(390,'FILTER RESULTS','ru','ФИЛЬТР РЕЗУЛЬТАТОВ'),(391,'Already have an account?','ru','Уже зарегистрированы?'),(392,'Empty search query','ru','Пустой поисковый запрос'),(393,'Cart','ru','Корзина'),(394,'Description (e.g. Blue Nike Vapor Cleats Size 10. Very comfortable and strong ankle support.)','ru','Описание (прим. Синиие Nike Vapor Бутсы. Размер 10. Очень удобные и сильная поддержка лодыжки.)'),(395,'Views per day','ru','Просмотров в день'),(396,'b','ru','Ваш заказ был завершен'),(397,'Visitors per day','ru','Посетителей в день'),(398,'Total comments','ru','Всего комментариев'),(399,'Total users','ru','Всего пользователей'),(400,'Total articles','ru','Всего статей'),(401,'Total products','ru','Всего товаров'),(402,'Total pages','ru','Всего страниц'),(403,'Engine version','ru','Версия движка'),(404,'Delete article','ru','Удалить статью'),(405,'Page generation time','ru','Скорость генерации страницы'),(406,'Select an action','ru','Выберите действие'),(407,'Up to top','ru','Поднять вверх'),(408,'Transaction completed','ru','Перевод завершен'),(409,'Transaction from admin','ru','Перевод от админа'),(410,'New transaction','ru','Сделать перевод'),(411,'Transfer amount','ru','Сумма перевода'),(412,'This is a daily report for the website traffic and performance on','ru','Это дневной отчет о посещаемости и нагрузки на сайт'),(413,'Thanks for using our service','ru','Спасибо за использование нашего сервиса'),(414,'daily report','ru','дневной отчет'),(415,'Under construction','ru','В разработке'),(416,'Time','ru','Время'),(417,'Continue shopping','ru','Продолжить покупки'),(418,'Process order?','ru','Оформить заказ?'),(419,'A new item has been added to your Shopping Cart','ru','Новый товар был добавлен в корзину'),(420,'item(s)','ru','товар(ов)'),(421,'Your Shopping Cart','ru','Ваша корзина'),(422,'Checkout order','ru','Оформить заказ'),(423,'Navigation','ru','Навигация'),(424,'Profile image','ru','Изображение профиля'),(425,'Page generation speed','ru','Скорость генерации страниц'),(426,'By hours','ru','По часам'),(427,'Average Server Response','ru','Среднее время ответа сервера'),(428,'Average Site Response','ru','Среднее время ответа сайта'),(429,'Perfomance','ru','Нагрузка'),(430,'The user makes a purchase','ru','Пользователь сделал покупку'),(431,'User confirmed the receipt of the order','ru','Пользователь подтвердил получение заказа'),(432,'Order has been shipped','ru','Заказ был отправлен'),(433,'The user makes a purchase and payment!','ru','Пользователь сделал покупку с оплатой!'),(434,'Checkout order?','ru','Оформить заказ?'),(435,'Drop file here','ru','Перетащите сюда файл'),(436,'Uploading','ru','Загрузка'),(437,'Open','ru','Открыть'),(438,'The funds','ru','Средства'),(439,'has beed added to your account balance','ru','были зачислины на счет Вашего аккаунта'),(440,'this link','ru','эту ссылку'),(441,'To confirm this password, use','ru','Для подтверждения пароля, используйте'),(442,'Close window','ru','Закрыть окно'),(443,'Sorry, this email already registered','ru','Извините, этот email уже зарегистрирован'),(444,'The funds have been added to your account balance','ru','Средства были зачислены на Ваш счет'),(445,'New password activated!','ru','Новый пароль активирован!'),(446,'already exist','ru','уже существует'),(447,'Error! Drag-n-drop disabled on this server','ru','Ошибка. Функция перетаскивания отключена'),(448,'Cron status','ru','Cron статус'),(449,'Cache','ru','Кеш'),(450,'Any action','ru','Любое действие'),(451,'Email sended','ru','Email отправлен'),(452,'Empty','ru','Пусто'),(453,'Last visit','ru','Последний визит'),(454,'Profile','ru','Профиль'),(455,'Continue','ru','Продолжить'),(456,'Checkout','ru','Оформить'),(457,'Edit catalog','ru','Редактировать каталог'),(458,'Delete catalog','ru','Удалить каталог'),(459,'Articles','ru','Статьи'),(460,'Down to bottom','ru','Опустить вниз'),(461,'List articles','ru','Список статей'),(462,'User banned','ru','Пользователь забанен'),(463,'Show more','ru','Показать все'),(464,'Privacy policy','ru','Конфиденциальность'),(465,'Terms & conditions','ru','Правила и условия'),(466,'Any','ru','Любой'),(467,'Outbox','ru','Рассылка'),(468,'Show comments','ru','Показать комментарии'),(469,'Latest comments','ru','Последние комментарии'),(470,'View source','ru','Посмотреть исходник'),(471,'Delete file','ru','Удалить файл'),(472,'Delete template','ru','Удалить шаблон'),(473,'Member of','ru','Участник '),(474,'community','ru','комьюнити'),(475,'Property','ru','Свойство'),(476,'Copy to','ru','Скопировать в'),(477,'translation','ru','перевод'),(478,'Color','ru','Цвет'),(479,'White','ru','Белый'),(480,'Black','ru','Черный'),(481,'Silver','ru','Серебристый'),(482,'Gray','ru','Серый'),(483,'New bulk message','ru','Новая рассылка'),(484,'Resolution','ru','Разрешение'),(485,'Close','ru','Закрыть'),(486,'Toggle fullscreen','ru','Включить полноэкранный режим'),(487,'Zoom in/out','ru','Увеличить/Уменьшить'),(488,'Previous (arrow left)','ru','Назад (стрелка влево)'),(489,'Next (arrow right)','ru','Вперед (стрелка вправо)'),(490,'votes','ru','голосов'),(491,'Share friends','ru','Поделиться'),(492,'Submitted on','ru','Опубликовано'),(493,'Mouse move to','ru','Перемещение мышки на'),(494,'Actions are finished at','ru','Действия закончены '),(495,'Click to','ru','Клик на'),(496,'Session finished','ru','Сессия окночена'),(497,'Passwords do not match','ru','Пароли не совпадают'),(498,'Repeat password','ru','Повтрный пароль'),(499,'We are glad to confirm successful registration at','ru','Мы рады подтвердить успешную регистрацию на'),(500,'By registering on the site, you accept the','ru','Регистрируясь, вы принимаете'),(501,'Terms and Conditions','ru','Пользовательское соглашение'),(502,'and are familiar with the','ru','и согласны с условиями раздела'),(503,'Delete account','ru','Удалить аккаунт'),(504,'Are you sure you want to delete your account','ru','Вы уверены что хотите удалить Ваш аккаунт?'),(505,'Messages not found','ru','Сообщения не найдены'),(506,'Send to email','ru','Отправить на email'),(507,'Send in chat','ru','Отправить в чат'),(508,'Text of message','ru','Текст сообщения'),(509,'Send messages','ru','Отправить сообщения'),(510,'Back to outbox','ru','Назад к рассылкам'),(511,'Referrer','ru','Реферер'),(512,'Actions','ru','Действия'),(513,'View session','ru','Просмотр сессии'),(514,'Share','ru','Поделиться'),(515,'Subscription','ru','Рассылка'),(516,'Back to list','ru','Вернуться к списку'),(517,'Step','ru','Шаг'),(518,'Login to website','ru','Авторизоваться на сайте'),(519,'Internal Server Error','ru','Внутренняя ошибка сервера'),(520,'Pending payment','ru','Ожидается оплата'),(521,'Invoice','ru','Cчет'),(522,'An invoice for payment','ru','Счет на оплату'),(523,'Invoice date for payment','ru','Дата '),(524,'Bill for payment for the user','ru',''),(525,'Total','ru','Итого'),(526,'Total Paid','ru','Оплачено'),(527,'Amount to be paid','ru','К оплате'),(528,'Make payment','ru','Совершить платеж'),(529,'Successfully paid','ru','Успешно оплачено'),(530,'Partially paid','ru','Частично оплачено'),(531,'Your cart is empty','ru','Ваша корзина пуста'),(532,'View invoice','ru','Счет на оплату'),(533,'Order payment','ru','Оплата заказа'),(534,'Select payment method','ru','Выберите способ оплаты'),(535,'Select an image to upload','ru','Выберите изображение для загрузки'),(536,'Toggle navigation','ru','Переключить навигацию'),(537,'Administrators not found','ru','Администраторы не найдены'),(538,'Edit permission','ru','Редактировать права'),(539,'Delete from admin','ru','Удалить из админов'),(540,'Make admin','ru','Сделать админом'),(541,'Manage permission','ru','Управление правами'),(542,'Manage permission of','ru','Управление правами пользователя'),(543,'Back to access','ru','Наза к доступу'),(544,'Section','ru','Секция'),(545,'Permission','ru','Права'),(546,'No access','ru','Нет доступа'),(547,'Read-only','ru','Только чтение'),(548,'Full access','ru','Полный доступ'),(549,'Primary admin','ru','Главный админ'),(550,'Send as notification','ru','Отправить уведомление'),(551,'Bulk message is sending now','ru','Массовое сообщение отправляется'),(552,'Complete item description','ru','Полное описание товара'),(553,'Add new admin','ru','Добавить администратора'),(554,'Do not have an account?','ru','Еще не зарегистрированы?'),(555,'Forgot password','ru','Забыли пароль'),(556,'Reset password','ru','Сбросить пароль'),(557,'To process restore, please check your email','ru','Чтобы восстановить пароль, пожалуйста, проверьте Ваш email'),(558,'Setup new password','ru','Установить новый пароль'),(559,'Request for withdrawal of funds','ru','Запрос на вывод средств'),(560,'Your withdrawal request will be processed within a few days of submitting','ru','Ваш запрос на снятие средств будет обработан в течение нескольких дней после отправки'),(561,'Wallet','ru','Кошелек'),(562,'Wallet ID','ru','ID кошелька'),(563,'Confirm request','ru','Подтвердить запрос'),(564,'Back to finances','ru','Назад к финансам'),(565,'Withdrawal confirmation','ru','Подтверждение вывода средств'),(566,'Withdrawal request processed','ru','Запрос на снятие средств обработан'),(567,'Latest Articles','ru','Последние статьи'),(568,'Popular goods','ru','Популярные товары'),(569,'Anonim','ru','Аноним'),(570,'To confirm your email, please enter or click on the following code','ru','Чтобы подтвердить адрес электронной почты, используйте код'),(571,'dApp','ru','dApp'),(572,'WebVR','ru','WebVR'),(573,'Web 3.0 DAO','ru','Web 3.0 DAO'),(574,'Social','ru','Социум'),(575,'Web 3.0 Mansion','ru','Web 3.0 Вилла'),(576,'Panoramas','ru','Панорамы'),(577,'Image description','ru','Описание изображения'),(578,'Social graph','ru','Социальный граф'),(579,'Telegram group','ru','Telegram группа'),(580,'Digital constitution','ru','Цифровая конституция'),(581,'Crypto democracy','ru','Крипто демократия'),(582,'Crowdfunding','ru','Краудфандинг'),(583,'P2P marketplace','ru','P2P площадка'),(584,'DAO','ru','DAO'),(585,'Git repository','ru','Git репозиторий'),(586,'Capitalization','ru','Капитализация'),(587,'Blockchain monitor','ru','Blockchain монитор'),(588,'Decentralized management','ru','Общественное управление'),(589,'Project Name','ru','Название проекта'),(590,'Levels','ru','Уровни'),(591,'Scenes','ru','Сцены'),(592,'Objects','ru','Обьекты'),(593,'Portals','ru','Порталы'),(594,'Links','ru','Ссылки'),(595,'Add project','ru','Добавить проект'),(596,'Project whitepaper','ru','Описание проекта'),(597,'Booking rooms','ru','Аренда комнат'),(598,'Free look mode','ru','Свободный режим'),(599,'Orbital preview','ru','Орбитальный режим'),(600,'Panorama viewer','ru','Панорамный режим'),(601,'Multiplayer game','ru','Сетевая игра'),(602,'Decentralized management','zh','分散管理'),(603,'Project Name','zh','項目名'),(604,'Levels','zh','級別'),(605,'Scenes','zh','場景'),(606,'Objects','zh','對象'),(607,'Portals','zh','門戶網站'),(608,'Links','zh','超链接'),(609,'Add project','zh','添加新項目'),(610,'Project whitepaper','zh','項目白皮書'),(611,'Booking rooms','zh','預訂房間'),(612,'Free look mode','zh','自由觀看模式'),(613,'Orbital preview','zh','軌道預覽'),(614,'Panorama viewer','zh','全景瀏覽器'),(615,'Multiplayer game','zh','多人遊戲'),(616,'Last editing on','zh','最後編輯於'),(617,'Anonim','zh','匿名的'),(618,'To confirm your email, please enter or click on the following code','zh','要確認您的電子郵件，請輸入或點擊以下代碼'),(619,'Account confirmation','zh','賬戶確認'),(620,'dApp','zh','dApp'),(621,'WebVR','zh','WebVR'),(622,'Web 3.0 DAO','zh','Web 3.0 DAO'),(623,'Social','zh','社會的'),(624,'Web 3.0 Mansion','zh','Web 3.0 大廈'),(625,'Panoramas','zh','全景圖'),(626,'Image description','zh','圖片描述'),(627,'Social graph','zh','社交圖譜'),(628,'Telegram group','zh','电报集团'),(629,'Digital constitution','zh','數字憲法'),(630,'Crypto democracy','zh','加密民主'),(631,'Crowdfunding','zh','眾籌'),(632,'P2P marketplace','zh','P2P市場'),(633,'DAO','zh','DAO'),(634,'Git repository','zh','Git 存儲庫'),(635,'Capitalization','zh','大寫'),(636,'Blockchain monitor','zh','區塊鏈監控器'),(637,'Upload','zh','上傳'),(638,'Link','zh','超鏈接'),(639,'Cancel','zh','取消'),(640,'Uploaded','zh','已上傳'),(641,'For uploading selected area use double click','zh','要上傳選定區域，請使用雙擊'),(642,'Error','zh','錯誤'),(643,'Or file','zh','或歸檔'),(644,'Upload image','zh','上傳圖片'),(645,'Sitemap','zh','網站地圖'),(646,'Format','zh','格式'),(647,'Upload new image','zh','上傳新圖片'),(648,'Logout sucsessful','zh','註銷成功'),(649,'Quit','zh','退出'),(650,'Site','zh','場地'),(651,'Users','zh','用戶'),(652,'Comments','zh','評論'),(653,'Content','zh','內容'),(654,'Errors','zh','错误'),(655,'Files','zh','文件'),(656,'Images','zh','圖片'),(657,'Videos','zh','視頻'),(658,'Access','zh','存取'),(659,'Config','zh','配置'),(660,'Backend','zh','后端'),(661,'Logout','zh','登出'),(662,'Password','zh','密碼'),(663,'Upload selection as thumb?','zh','將選擇上傳為拇指？'),(664,'Save uploaded images','zh','保存上傳的圖像'),(665,'Previous page','zh','上一頁'),(666,'Next page','zh','下一頁'),(667,'Updated','zh','更新'),(668,'Interval','zh','音程'),(669,'Not existing','zh','不存在'),(670,'Not cathing','zh','不捕捉'),(671,'Not refreshing','zh','不清爽'),(672,'minut','zh','分鐘'),(673,'minuts','zh','分鐘'),(674,'hour','zh','小時'),(675,'hours','zh','小時'),(676,'Dayly','zh','日常的'),(677,'Change interval','zh','變更間隔'),(678,'Refresh catch','zh','刷新捕獲'),(679,'Edit article','zh','編輯文章'),(680,'Caption','zh','標題'),(681,'No image','zh','沒有圖像'),(682,'Edit directory','zh','編輯目錄'),(683,'Return','zh','返回'),(684,'Add new article','zh','添加新文章'),(685,'Edit','zh','編輯'),(686,'Delete','zh','刪除'),(687,'Add a new directory','zh','添加新目錄'),(688,'Description','zh','描述'),(689,'Back','zh','後退'),(690,'List','zh','列表'),(691,'Add','zh','添加'),(692,'Preview','zh','預覽'),(693,'Uploading files','zh','上傳文件'),(694,'File','zh','文件'),(695,'Submit','zh','提交'),(696,'Included files','zh','包含的文件'),(697,'Path','zh','小路'),(698,'Class','zh','班級'),(699,'Create new file','zh','創建新文件'),(700,'Lost password','zh','忘記密碼'),(701,'allready exist','zh','已經存在'),(702,'Incorrect email of password','zh','密碼郵箱不正確'),(703,'not found','zh','未找到'),(704,'Message with new password is sended to email','zh','帶有新密碼的消息已發送至電子郵件'),(705,'New password is','zh','新密碼是'),(706,'New password for','zh','新密碼為'),(707,'Registration sucsessful','zh','註冊成功'),(708,'We are glad to confirm sucsessful registration at','zh','我們很高興確認註冊成功'),(709,'About software','zh','關於軟件'),(710,'Errors not found','zh','未發現錯誤'),(711,'Clear log','zh','清除日誌'),(712,'Date','zh','日期'),(713,'New user','zh','新用戶'),(714,'Name','zh','姓名'),(715,'Ban','zh','禁止'),(716,'Unban','zh','解禁'),(717,'Confirm deleting banned user','zh','確認刪除被禁止的用戶'),(718,'Create user','zh','創建用戶'),(719,'Incorrect email','zh','不正確的電子郵件'),(720,'Enter password','zh','輸入密碼'),(721,'Update interval','zh','更新間隔'),(722,'All pages','zh','所有頁面'),(723,'Logs','zh','日誌'),(724,'Text','zh','文本'),(725,'Pages not found','zh','找不到頁面'),(726,'Sign Up','zh','報名'),(727,'Admin','zh','行政'),(728,'Upload files','zh','上傳文件'),(729,'Account','zh','帳戶'),(730,'Save settings','zh','保存設置'),(731,'Access denied','zh','拒絕訪問'),(732,'Message sent successfully','zh','消息已成功發送'),(733,'New message from','zh','新消息來自'),(734,'My Account','zh','我的賬戶'),(735,'Show navigation','zh','顯示導航'),(736,'Get in Touch','zh','保持聯繫'),(737,'Contact Us','zh','聯絡我們'),(738,'Your message here','zh','您的留言在這裡'),(739,'Send message','zh','發信息'),(740,'Developed by','zh','由開發'),(741,'Up','zh','盒'),(742,'Show All','zh','顯示所有'),(743,'Change picture','zh','更換圖片'),(744,'Enter your email and password to continue','zh','輸入您的電子郵件和密碼以繼續'),(745,'Settings','zh','設置'),(746,'Email','zh','郵件'),(747,'New password','zh','新密碼'),(748,'Enter your email','zh','輸入你的電子郵箱'),(749,'Enter your password','zh','輸入您的密碼'),(750,'Save changes','zh','保存更改'),(751,'Back to account','zh','返回帳戶'),(752,'Invalid conformation code','zh','確認碼無效'),(753,'Registration at','zh','註冊於'),(754,'Confirmation code','zh','驗證碼'),(755,'No articles found','zh','沒有找到文章'),(756,'Messages','zh','消息'),(757,'Back to admin','zh','返回管理'),(758,'Status','zh','地位'),(759,'Yes','zh','是的'),(760,'No','zh','但'),(761,'Show in navigation','zh','在導航中顯示'),(762,'Back to content','zh','返回內容'),(763,'Delete image','zh','刪除圖像'),(764,'Comments not found','zh','未找到評論'),(765,'Add reply','zh','添加回复'),(766,'Users not found','zh','未找到用戶'),(767,'Share friends in','zh','分享朋友在'),(768,'Language','zh','語言'),(769,'Home','zh','家'),(770,'Connect us at','zh','聯繫我們'),(771,'Copyright','zh','版權'),(772,'All rights reserved','zh','版權所有'),(773,'There is no users, you can send a message','zh','還沒有用戶，您可以留言'),(774,'offline','zh','離線'),(775,'Add comment','zh','添加評論'),(776,'Submit comment','zh','提交評論'),(777,'Add new comment','zh','添加新評論'),(778,'There is no comments','zh','沒有評論'),(779,'Comment submited!','zh','評論已提交！'),(780,'To post a comment, please','zh','要發表評論，請'),(781,'Reply','zh','酬對'),(782,'Select your language','zh','選擇你的語言'),(783,'Search','zh','搜索'),(784,'Search results by request','zh','按請求搜索結果'),(785,'Documentation','zh','文檔'),(786,'Add new value','zh','增加新價值'),(787,'Download','zh','下載'),(788,'Install','zh','安裝'),(789,'Framework','zh','骨'),(790,'Useful services','zh','有用的服務'),(791,'Setup','zh','設置'),(792,'Login to send message','zh','登錄後發送消息'),(793,'Add article','zh','添加文章'),(794,'register now','zh','現在註冊'),(795,'auth','zh','核准'),(796,'There is no articles','zh','沒有文章'),(797,'Functions','zh','功能'),(798,'Database','zh','數據庫'),(799,'Sorry, no results found','zh','抱歉，沒有找到結果'),(800,'Value','zh','價值'),(801,'Showing','zh','顯示'),(802,'to','zh','從'),(803,'from','zh','到'),(804,'entries','zh','條記錄'),(805,'per page','zh','每頁'),(806,'Next','zh','下一個'),(807,'Previous','zh','以前的'),(808,'Code','zh','代碼'),(809,'Select option','zh','選擇選項'),(810,'Content not found','zh','未找到內容'),(811,'Crop image','zh','裁剪圖像'),(812,'Sended','zh','已發送'),(813,'at','zh','在'),(814,'Too many failed attempts','zh','嘗試失敗次數過多'),(815,'Try again after','zh','之後重試'),(816,'seconds','zh','秒'),(817,'Action','zh','行動'),(818,'User','zh','用戶'),(819,'IP','zh','網際協定'),(820,'New message','zh','新消息'),(821,'Clear logs','zh','清除日誌'),(822,'Logs not found','zh','未找到日誌'),(823,'Updates','zh','更新'),(824,'Autoupdate','zh','自動更新'),(825,'Enabled','zh','啟用'),(826,'Disabled','zh','殘疾人'),(827,'Authentication error','zh','授權錯誤'),(828,'Authentication timeout','zh','認證超時'),(829,'Restore password','zh','恢復密碼'),(830,'Received','zh','已收到'),(831,'new messages','zh','新消息'),(832,'Updating engine from version','zh','從版本更新引擎'),(833,'Downloading files','zh','下載文件'),(834,'Receiving','zh','接收'),(835,'Update aborted','zh','更新已中止'),(836,'Replacing downloaded files from','zh','替換下載的文件'),(837,'Receiving MySQL data','zh','接收MySQL數據'),(838,'Executed','zh','執行'),(839,'commands','zh','命令'),(840,'Updating to version','zh','更新到版本'),(841,'is complete','zh','做完了'),(842,'after 5 seconds','zh','5秒後'),(843,'Current version','zh','當前版本'),(844,'New updates available','zh','有新的更新'),(845,'Update Now','zh','現在更新'),(846,'No updates available','zh','無可用更新'),(847,'Invalid confirmation code','zh','確認碼無效'),(848,'Data not found','zh','未找到數據'),(849,'Trying to register','zh','正在嘗試註冊'),(850,'Comment posted','zh','發表評論'),(851,'There is no files','zh','沒有文件'),(852,'Login','zh','登錄'),(853,'Loading','zh','加載中'),(854,'Page not found','zh','找不到網頁'),(855,'Back to Home Page','zh','返回主頁'),(856,'or','zh','或'),(857,'Attendance','zh','出席率'),(858,'Back to Top','zh','回到頂部'),(859,'Search results for','zh','為。。。。尋找結果'),(860,'Templates','zh','模板'),(861,'Default file','zh','默認文件'),(862,'New file','zh','新文件'),(863,'New template','zh','新模板'),(864,'Default template','zh','默認模板'),(865,'Template name','zh','模板名稱'),(866,'Views','zh','意見'),(867,'Visitors','zh','訪客'),(868,'Statistic','zh','統計'),(869,'Pages','zh','頁數'),(870,'Referrers','zh','推薦人'),(871,'By days','zh','按天數'),(872,'By weeks','zh','按週計算'),(873,'By months','zh','按月計算'),(874,'Amount','zh','數量'),(875,'Blank','zh','空白的'),(876,'Restore your password','zh','恢復您的密碼'),(877,'To restore your password, use this code','zh','要恢復您的密碼，請使用此代碼'),(878,'Message with confirmation code is sended to email','zh','帶有確認碼的消息已發送至電子郵件'),(879,'There is no templates','zh','沒有模板'),(880,'Register','zh','登記'),(881,'Try to register','zh','嘗試註冊'),(882,'Trying to login','zh','正在嘗試登錄'),(883,'Engine update','zh','引擎更新'),(884,'Withdrawal already requested','zh','已請求提款'),(885,'Withdrawal request accepted','zh','提款請求已接受'),(886,'Select file','zh','選擇文件'),(887,'Editable file','zh','可編輯文件'),(888,'Source file','zh','源文件'),(889,'Gateway Timeout','zh','網關超時'),(890,'Image is too small. Minimal size is 400x400','zh','圖片太小。 最小尺寸為 400x400'),(891,'Drop files here','zh','將文件拖放到此處'),(892,'System message','zh','系統消息'),(893,'sign in','zh','登入'),(894,'Confirm Shipment','zh','確認發貨'),(895,'Post track number','zh','發布曲目編號'),(896,'Shipment is confirmed','zh','發貨已確認'),(897,'This item is sold out now?','zh','這個商品現在已經賣完了嗎？'),(898,'New order','zh','新命令'),(899,'Archive order','zh','歸檔訂單'),(900,'Finished','zh','完成的'),(901,'Purchaser','zh','採購員'),(902,'Shipping address','zh','收件地址'),(903,'All Items','zh','所有項目'),(904,'Buy Now!','zh','立即購買！'),(905,'Title','zh','標題'),(906,'Ask price','zh','詢問價格'),(907,'Edit product','zh','編輯產品'),(908,'Click to Deactivate','zh','單擊以停用'),(909,'Click to Activate','zh','點擊激活'),(910,'You might also be interested in','zh','你也可能對此有興趣'),(911,'Products not found','zh','未找到產品'),(912,'Category','zh','類別'),(913,'Reset Filter','zh','重置過濾器'),(914,'Unable to purchase your own product','zh','無法購買自己的產品'),(915,'Buy Now','zh','立即購買'),(916,'Tracking number','zh','追踪號碼'),(917,'Shipment in process','zh','發貨中'),(918,'Confirm receipt','zh','確認收據'),(919,'Seller','zh','賣方'),(920,'Shipping from','zh','發貨自'),(921,'New comment at','zh','新評論位於'),(922,'New message at','zh','新消息位於'),(923,'Dear','zh','親愛的'),(924,'sent a message for you','zh','給你發了一條消息'),(925,'For details, click','zh','詳情請點擊'),(926,'here','zh','這裡'),(927,'Withdrawal request at','zh','提款請求於'),(928,'You withdrawal request is pending now','zh','您的提款請求現在正在等待處理'),(929,'After some time you will receive','zh','一段時間後您將收到'),(930,'on your PayPal account','zh','在您的 PayPal 帳戶上'),(931,'There in new withdrawal request at','zh','新的提款請求位於'),(932,'Need to pay','zh','需要付費'),(933,'on PayPal account','zh','在 PayPal 帳戶上'),(934,'and confirm request','zh','並確認請求'),(935,'Details','zh','細節'),(936,'Withdrawal is complete at','zh','提款完成於'),(937,'You withdrawal is complete','zh','您提款已完成'),(938,'Thanks for using our service and have a nice day','zh','感謝您使用我們的服務，祝您度過愉快的一天'),(939,'New purchase at','zh','新購買於'),(940,'Congratulations on your purchase at','zh','恭喜您購買'),(941,'You can see details of your purchases','zh','您可以查看您購買的詳細信息'),(942,'There in new purchase at','zh','新購買的有'),(943,'make a payment','zh','進行付款'),(944,'to your PayPal account','zh','到您的 PayPal 帳戶'),(945,'Your order has been shipped at','zh','您的訂單已發貨於'),(946,'Your order','zh','你的訂單'),(947,'has been shipped','zh','已經寄出'),(948,'After receiving, please update purchase status','zh','收到後請更新購買狀態'),(949,'Your order has been completed at','zh','您的訂單已完成於'),(950,'Your order has been completed','zh','您的訂單已完成'),(951,'Funds added to your account and available for withdrawal','zh','資金已添加至您的賬戶並可提取'),(952,'Orders not found','zh','未找到訂單'),(953,'Type','zh','類型'),(954,'Withdrawal request','zh','提款請求'),(955,'Money deposit','zh','存款'),(956,'Order','zh','命令'),(957,'Please, confirm transaction','zh','請確認交易'),(958,'Confirm payment','zh','確認付款'),(959,'Bots','zh','機器人'),(960,'Banned','zh','禁止'),(961,'Active','zh','積極的'),(962,'Please, describe this item','zh','請描述該商品'),(963,'Description (e.g. Blue Nike Vapor Cleats Size 10. Very comfortable and strong ankle support.)','zh','描述（例如，藍色 Nike Vapor 防滑鞋，尺碼 10。非常舒適且堅固的腳踝支撐。）'),(964,'Please, confirm item shipping address','zh','請確認商品的送貨地址'),(965,'State','zh','狀態'),(966,'City','zh','城市'),(967,'Zip code','zh','郵政編碼'),(968,'Street','zh','街道'),(969,'Phone number','zh','電話號碼'),(970,'Price','zh','價格'),(971,'Choose action','zh','選擇行動'),(972,'Edit item','zh','編輯項目'),(973,'Deactivate item','zh','停用項目'),(974,'Activate item','zh','激活項目'),(975,'List new Item','zh','列出新項目'),(976,'Edit Properties','zh','編輯屬性'),(977,'Keywords','zh','關鍵詞'),(978,'Mode','zh','模式'),(979,'Replace','zh','代替'),(980,'Cron error','zh','定時錯誤'),(981,'Save','zh','節省'),(982,'Are you sure?','zh','你確定嗎？'),(983,'Add value','zh','增值'),(984,'Edit property','zh','編輯屬性'),(985,'New value','zh','新價值'),(986,'Delete property','zh','刪除屬性'),(987,'Add new property','zh','添加新屬性'),(988,'Back to products','zh','返回產品'),(989,'Connect with social network','zh','連接社交網絡'),(990,'Delivery confirmation','zh','發貨確認'),(991,'Quality','zh','質量'),(992,'Your comment here','zh','您的評論在這裡'),(993,'Purchases','zh','購買'),(994,'Thank you for your order! Shipment in process now.','zh','謝謝您的訂單！ 現在正在發貨。'),(995,'There is no purchases','zh','沒有購買'),(996,'Finances','zh','財政'),(997,'The funds have been added to your account','zh','資金已添加至您的賬戶'),(998,'Balance','zh','平衡'),(999,'Pending','zh','待辦的'),(1000,'New','zh','新的'),(1001,'Transactions not found','zh','未找到交易'),(1002,'Request withdrawal','zh','請求提款'),(1003,'Confirm your PayPal','zh','確認您的貝寶'),(1004,'Deposit money','zh','存錢'),(1005,'Amount to deposit','zh','存入金額'),(1006,'About','zh','關於'),(1007,'Products','zh','產品'),(1008,'Orders','zh','命令'),(1009,'Finance','zh','金融'),(1010,'Order products','zh','訂購產品'),(1011,'Confirmation','zh','確認'),(1012,'Please, confirm your order','zh','請確認您的訂單'),(1013,'Remove product','zh','刪除產品'),(1014,'Sorry, there is no products','zh','抱歉，沒有產品'),(1015,'Total price','zh','總價'),(1016,'Shipping','zh','船運'),(1017,'Please, confirm your shipping address','zh','請確認您的送貨地址'),(1018,'Payment','zh','支付'),(1019,'First name','zh','名'),(1020,'Last name','zh','姓'),(1021,'Country','zh','國家'),(1022,'Process payment','zh','處理付款'),(1023,'FILTER RESULTS','zh','處理付款...'),(1024,'Already have an account?','zh','已經有帳戶？'),(1025,'Empty search query','zh','空搜索查詢'),(1026,'Cart','zh','大車'),(1027,'Last visit','zh','上次訪問'),(1028,'Checkout order?','zh','結帳訂單？'),(1029,'Error! Drag-n-drop disabled on this server','zh','錯誤！ 此服務器上禁用拖放操作'),(1030,'Uploading','zh','上傳中'),(1031,'Drop file here','zh','將文件拖放到此處'),(1032,'The user makes a purchase and payment!','zh','用戶進行購買並付款！'),(1033,'Order has been shipped','zh','訂單已發貨'),(1034,'User confirmed the receipt of the order','zh','用戶確認收到訂單'),(1035,'The user makes a purchase','zh','用戶進行購買'),(1036,'online','zh','Online'),(1037,'Perfomance','zh','表現'),(1038,'By hours','zh','按小時'),(1039,'Average Server Response','zh','平均服務器響應'),(1040,'Average Site Response','zh','平均站點響應'),(1041,'Page generation speed','zh','頁面生成速度'),(1042,'Profile image','zh','個人資料圖片'),(1043,'Navigation','zh','導航'),(1044,'Checkout order','zh','結帳訂單'),(1045,'Your Shopping Cart','zh','你的購物車'),(1046,'item(s)','zh','項目'),(1047,'Process order?','zh','處理訂單？'),(1048,'A new item has been added to your Shopping Cart','zh','新商品已添加到您的購物車'),(1049,'Continue shopping','zh','繼續購物'),(1050,'Time','zh','時間'),(1051,'Under construction','zh','建設中'),(1052,'daily report','zh','每日報告'),(1053,'Thanks for using our service','zh','感謝您使用我們的服務'),(1054,'This is a daily report for the website traffic and performance on','zh','這是網站流量和性能的每日報告'),(1055,'Transfer amount','zh','轉賬金額'),(1056,'New transaction','zh','新交易'),(1057,'Transaction completed','zh','交易完成'),(1058,'Transaction from admin','zh','來自管理員的交易'),(1059,'Page generation time','zh','頁面生成時間'),(1060,'Select an action','zh','選擇一個操作'),(1061,'Up to top','zh','到頂部'),(1062,'Delete article','zh','刪除文章'),(1063,'Engine version','zh','發動機版本'),(1064,'Total pages','zh','總頁數'),(1065,'Total articles','zh','文章總數'),(1066,'Total products','zh','產品總數'),(1067,'Total users','zh','用戶總數'),(1068,'Total comments','zh','評論總數'),(1069,'Visitors per day','zh','每日訪客數'),(1070,'Views per day','zh','每日觀看次數'),(1071,'Show more','zh','展示更多'),(1072,'Privacy policy','zh','隱私政策'),(1073,'Terms & conditions','zh','條款及條件'),(1074,'Any','zh','任何'),(1075,'Outbox','zh','發件箱'),(1076,'Continue','zh','繼續'),(1077,'Checkout','zh','查看'),(1078,'Show comments','zh','顯示評論'),(1079,'Latest comments','zh','最新評論'),(1080,'View source','zh','查看源碼'),(1081,'Delete file','zh','刪除文件'),(1082,'Delete template','zh','刪除模板'),(1083,'Articles','zh','文章'),(1084,'Member of','zh','成員'),(1085,'community','zh','共同體'),(1086,'Property','zh','屬性'),(1087,'Copy to','zh','複製到'),(1088,'translation','zh','翻譯'),(1089,'Color','zh','顏色'),(1090,'White','zh','白色的'),(1091,'Black','zh','黑色的'),(1092,'Silver','zh','銀'),(1093,'Gray','zh','灰色的'),(1094,'New bulk message','zh','新的群發消息'),(1095,'Profile','zh','輪廓'),(1096,'Ok','zh','好的'),(1097,'Cron status','zh','計劃狀態'),(1098,'Cache','zh','緩存'),(1099,'List articles','zh','列出文章'),(1100,'Edit catalog','zh','編輯目錄'),(1101,'Delete catalog','zh','刪除目錄'),(1102,'Resolution','zh','解決'),(1103,'1440 x 2560','zh','1440 x 2560'),(1104,'1080 x 1920','zh','1080 x 1920'),(1105,'Close','zh','關閉'),(1106,'Toggle fullscreen','zh','切換全屏'),(1107,'Zoom in/out','zh','放大/縮小'),(1108,'Previous (arrow left)','zh','上一頁（向左箭頭）'),(1109,'Next (arrow right)','zh','下一步（向右箭頭）'),(1110,'votes','zh','投票'),(1111,'Share friends','zh','分享好友'),(1112,'Submitted on','zh','提交於'),(1113,'Share','zh','分享'),(1114,'Subscription','zh','訂閱'),(1115,'Down to bottom','zh','到底部'),(1116,'Back to list','zh','返回目錄'),(1117,'Passwords do not match','zh','密碼不匹配'),(1118,'Repeat password','zh','重複輸入密碼'),(1119,'We are glad to confirm successful registration at','zh','我們很高興確認註冊成功'),(1120,'By registering on the site, you accept the','zh','通過在網站上註冊，您接受'),(1121,'Terms and Conditions','zh','條款和條件'),(1122,'and are familiar with the','zh','並熟悉'),(1123,'Delete account','zh','刪除帳戶'),(1124,'Are you sure you want to delete your account','zh','您確定要刪除您的帳戶嗎'),(1125,'Empty','zh','空的'),(1126,'Any action','zh','任何行動'),(1127,'Email sended','zh','郵件已發送'),(1128,'Messages not found','zh','未找到消息'),(1129,'Send to email','zh','發送至電子郵件'),(1130,'Send in chat','zh','在聊天中發送'),(1131,'Text of message','zh','消息正文'),(1132,'Send messages','zh','發送信息'),(1133,'Back to outbox','zh','返回發件箱'),(1134,'Referrer','zh','推薦人'),(1135,'Actions','zh','行動'),(1136,'View session','zh','查看會話'),(1137,'Mouse move to','zh','鼠標移至'),(1138,'Actions are finished at','zh','行動結束於'),(1139,'Click to','zh','點擊進入'),(1140,'Session finished','zh','會議結束'),(1141,'Internal Server Error','zh','內部服務器錯誤'),(1142,'Pending payment','zh','待付款'),(1143,'Invoice','zh','發票'),(1144,'An invoice for payment','zh','付款發票'),(1145,'Invoice date for payment','zh','付款發票日期'),(1146,'Total','zh','全部的'),(1147,'Total Paid','zh','總支付'),(1148,'Amount to be paid','zh','該付的錢'),(1149,'Make payment','zh','付款'),(1150,'Successfully paid','zh','支付成功'),(1151,'Partially paid','zh','部分付款'),(1152,'The funds have been added to your account balance','zh','資金已添加至您的賬戶餘額'),(1153,'Your cart is empty','zh','您的購物車是空的'),(1154,'View invoice','zh','查看發票'),(1155,'Order payment','zh','訂單支付'),(1156,'Step','zh','步'),(1157,'Login to website','zh','登錄網站'),(1158,'Close window','zh','關閉窗口'),(1159,'Select payment method','zh','選擇付款方式'),(1160,'Toggle navigation','zh','切換導航'),(1161,'Select an image to upload','zh','選擇要上傳的圖像'),(1162,'Administrators not found','zh','未找到管理員'),(1163,'Edit permission','zh','編輯權限'),(1164,'Delete from admin','zh','從管理員中刪除'),(1165,'Make admin','zh','設為管理員'),(1166,'Manage permission','zh','管理權限'),(1167,'Manage permission of','zh','管理權限'),(1168,'Back to access','zh','返回訪問'),(1169,'Section','zh','部分'),(1170,'Permission','zh','允許'),(1171,'No access','zh','無法訪問'),(1172,'Read-only','zh','只讀'),(1173,'Full access','zh','完全訪問權限'),(1174,'Primary admin','zh','主要管理員'),(1175,'Send as notification','zh','作為通知發送'),(1176,'Bulk message is sending now','zh','正在發送批量消息'),(1177,'Complete item description','zh','完整的物品描述'),(1178,'Add new admin','zh','添加新管理員'),(1179,'Do not have an account?','zh','還沒有賬號？'),(1180,'Forgot password','zh','忘記密碼'),(1181,'Reset password','zh','重設密碼'),(1182,'To confirm this password, use','zh','要確認此密碼，請使用'),(1183,'this link','zh','這個鏈接'),(1184,'To process restore, please check your email','zh','要處理恢復，請檢查您的電子郵件'),(1185,'Setup new password','zh','設置新密碼'),(1186,'New password activated!','zh','新密碼已激活！'),(1187,'Request for withdrawal of funds','zh','請求提取資金'),(1188,'Your withdrawal request will be processed within a few days of submitting','zh','您的提款請求將在提交後幾天內得到處理'),(1189,'Wallet','zh','錢包'),(1190,'Wallet ID','zh','錢包ID'),(1191,'Confirm request','zh','確認請求'),(1192,'Back to finances','zh','回到財務'),(1193,'Withdrawal confirmation','zh','提款確認'),(1194,'Withdrawal request processed','zh','提款請求已處理'),(1195,'Latest Articles','zh','最新的文章'),(1196,'Popular goods','zh','熱門商品'),(1197,'Last editing on','ru','Отредактировано'),(1198,'Metaverse','ru','Метавселенная'),(1199,'Metaverse','zh','元宇宙'),(1200,'Level Name','ru','Название уровня'),(1201,'Show project scheme','ru','Показать схему проекта'),(1202,'Add level','ru','Добавить уровень'),(1203,'Project properties','ru','Свойства проекта'),(1204,'Scene Name','ru','Название сцены'),(1205,'Show level plan','ru','Показать схему уровня'),(1206,'Upload scenes','ru','Загрузить сцены'),(1207,'Add new scene','ru','Добавить новую сцену'),(1208,'Position','ru','Position'),(1209,'Rotation','ru','Rotation'),(1210,'Latitude','ru','Latitude'),(1211,'Longitude','ru','Latitude'),(1212,'Floor position','ru','Положение пола'),(1213,'Floor radius','ru','Радиус пола'),(1214,'Logo size','ru','Размер лого'),(1215,'level properties','ru','свойства уровня'),(1216,'Scenes not found','ru','Сцены не найдены'),(1217,'Levels not found','ru','Этажи не найдены'),(1218,'Average response time','ru','Среднее время ответа'),(1219,'Projects not found','ru','Проекты не найдены'),(1220,'Rules','zh','规则'),(1221,'Rules','ru','Правила'),(1222,'The original document is in a','ru','Оригинал документа находится в'),(1223,'public repository','ru','публичном репозитории'),(1224,'and is available for editing by the community','ru','и доступен для редактирования сообществом'),(1225,'DAO constitution','ru','Конституция DAO'),(1226,'The original document is in a','zh','原始文檔位於'),(1227,'public repository','zh','公共存儲庫'),(1228,'and is available for editing by the community','zh','並且可供社區編輯'),(1229,'DAO constitution','zh','DAO 章程'),(1230,'Constitution','zh','章程'),(1231,'Constitution','ru','Конституция'),(1232,'Community rules','ru','Правила сообщества'),(1233,'Community rules','zh','社區規則'),(1234,'Panorama','ru','Панорама'),(1235,'Mansion','ru','Особняк'),(1236,'Decentralized organization','ru','Децентрализованная организация'),(1237,'Multiplayer','ru','Мультиплеер'),(1238,'All articles','ru','Все статьи'),(1239,'Level Name','zh','關卡名稱'),(1240,'Show project scheme','zh','展示項目方案'),(1241,'Add level','zh','添加新級別'),(1242,'Project properties','zh','項目屬性'),(1243,'Scene Name','zh','場景名稱'),(1244,'Show level plan','zh','顯示關卡平面圖'),(1245,'Upload scenes','zh','上傳場景'),(1246,'Add new scene','zh','添加新場景'),(1247,'Position','zh','位置'),(1248,'Rotation','zh','迴轉'),(1249,'Latitude','zh','緯度'),(1250,'Longitude','zh','經度'),(1251,'Floor position','zh','地板位置'),(1252,'Floor radius','zh','地板半徑'),(1253,'Logo size','zh','標誌尺寸'),(1254,'level properties','zh','級別屬性'),(1255,'Telegram','zh','Telegram'),(1256,'DAO Mansion','zh','DAO 別墅'),(1257,'Panorama','zh','全景'),(1258,'Mansion','zh','別墅'),(1259,'Decentralized organization','zh','分散的組織'),(1260,'Multiplayer','zh','多人遊戲'),(1261,'All articles','zh','所有文章'),(1262,'Multiplayer scene','ru','Мультиплеер'),(1263,'Telegram','ru','Telegram'),(1264,'DAO Mansion','ru','DAO Особняк'),(1265,'Levels not found','zh','未找到級別'),(1266,'Scenes not found','zh','未找到場景'),(1267,'Projects not found','zh','未找到項目'),(1268,'Average response time','zh','平均回應時間'),(1269,'Multiplayer scene','zh','多人場景'),(1270,'Web 3.0 community','zh','Web 3.0 社區'),(1271,'DAO Whitepaper','zh','DAO 白皮書'),(1272,'DAO Mansion whitepaper','zh','DAO 別墅白皮書'),(1273,'Web 3.0 community','ru','Web 3.0 сообщество'),(1274,'DAO Whitepaper','ru','Технический документ DAO'),(1275,'DAO Mansion whitepaper','ru','Технический документ DAO Mansion'),(1276,'Email is required','ru','Email обязателен'),(1277,'Password is required','ru','Пароль обязателен'),(1278,'Password confirmation is required','ru','Подтверждение пароля обязательно'),(1279,'Telegram id is required','ru','Telegram id обязателен'),(1280,'Email confirmation','ru','Подтверждение Email адреса'),(1281,'Please check your email and enter the code from the mail to activate your account','ru','Пожалуйста, проверьте свою электронную почту и введите код из письма, чтобы активировать свою учетную запись'),(1282,'Email is required','zh','電子郵件為必填項'),(1283,'Password is required','zh','密碼是必需的'),(1284,'Password confirmation is required','zh','需要確認密碼'),(1285,'Telegram id is required','zh','電報 ID 為必填項'),(1286,'Email confirmation','zh','郵件確認'),(1287,'Please check your email and enter the code from the mail to activate your account','zh','請檢查您的電子郵件並輸入郵件中的代碼以啟動您的帳戶'),(1288,'Contact us','ru','Контакты'),(1289,'Online','zh','Online'),(1290,'online','ru','online'),(1291,'Telegram','zh','Telegram'),(1292,'Telegram','ru','Telegram'),(1293,'Contact us','zh','聯絡我們');
/*!40000 ALTER TABLE `nodes_language` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `nodes_meta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nodes_meta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(400) NOT NULL,
  `lang` varchar(4) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `keywords` varchar(300) NOT NULL,
  `mode` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lang` (`lang`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `nodes_meta` WRITE;
/*!40000 ALTER TABLE `nodes_meta` DISABLE KEYS */;
/*!40000 ALTER TABLE `nodes_meta` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `nodes_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nodes_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `date` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  `shipping` int(11) NOT NULL DEFAULT '0',
  `payment` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `nodes_order` WRITE;
/*!40000 ALTER TABLE `nodes_order` DISABLE KEYS */;
/*!40000 ALTER TABLE `nodes_order` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `nodes_outbox`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nodes_outbox` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `caption` varchar(400) NOT NULL,
  `text` text NOT NULL,
  `action` tinyint(4) NOT NULL,
  `date` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `nodes_outbox` WRITE;
/*!40000 ALTER TABLE `nodes_outbox` DISABLE KEYS */;
/*!40000 ALTER TABLE `nodes_outbox` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `nodes_perfomance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nodes_perfomance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `server_time` double NOT NULL,
  `script_time` double NOT NULL,
  `cache_id` int(11) NOT NULL DEFAULT '0',
  `date` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `nodes_perfomance` WRITE;
/*!40000 ALTER TABLE `nodes_perfomance` DISABLE KEYS */;
/*!40000 ALTER TABLE `nodes_perfomance` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `nodes_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nodes_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `votes` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `nodes_product` WRITE;
/*!40000 ALTER TABLE `nodes_product` DISABLE KEYS */;
/*!40000 ALTER TABLE `nodes_product` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `nodes_product_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nodes_product_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL DEFAULT '0',
  `value` varchar(100) NOT NULL,
  `url` varchar(40) NOT NULL,
  `order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `cat_id` (`cat_id`),
  KEY `value` (`value`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `nodes_product_data` WRITE;
/*!40000 ALTER TABLE `nodes_product_data` DISABLE KEYS */;
/*!40000 ALTER TABLE `nodes_product_data` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `nodes_product_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nodes_product_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL DEFAULT '0',
  `order_id` int(11) NOT NULL DEFAULT '0',
  `price` double NOT NULL,
  `count` int(11) NOT NULL DEFAULT '0',
  `track` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `date` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `order_id` (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `nodes_product_order` WRITE;
/*!40000 ALTER TABLE `nodes_product_order` DISABLE KEYS */;
/*!40000 ALTER TABLE `nodes_product_order` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `nodes_product_property`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nodes_product_property` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL DEFAULT '0',
  `value` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `nodes_product_property` WRITE;
/*!40000 ALTER TABLE `nodes_product_property` DISABLE KEYS */;
INSERT INTO `nodes_product_property` VALUES (1,0,'Category');
/*!40000 ALTER TABLE `nodes_product_property` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `nodes_property_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nodes_property_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL DEFAULT '0',
  `property_id` int(11) NOT NULL DEFAULT '0',
  `data_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `property_id` (`property_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `nodes_property_data` WRITE;
/*!40000 ALTER TABLE `nodes_property_data` DISABLE KEYS */;
/*!40000 ALTER TABLE `nodes_property_data` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `nodes_referrer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nodes_referrer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(400) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `nodes_referrer` WRITE;
/*!40000 ALTER TABLE `nodes_referrer` DISABLE KEYS */;
/*!40000 ALTER TABLE `nodes_referrer` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `nodes_relations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nodes_relations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user1` int(11) NOT NULL,
  `user2` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `nodes_relations` WRITE;
/*!40000 ALTER TABLE `nodes_relations` DISABLE KEYS */;
/*!40000 ALTER TABLE `nodes_relations` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `nodes_session`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nodes_session` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `token` varchar(32) NOT NULL,
  `ip` varchar(40) NOT NULL,
  `create_at` datetime NOT NULL,
  `expire_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `nodes_session` WRITE;
/*!40000 ALTER TABLE `nodes_session` DISABLE KEYS */;
INSERT INTO `nodes_session` VALUES (1,1,'i7mcn5ojfmuv6cfc0b3kjfbe16','109.194.51.80','2024-06-27 20:24:25','2024-07-27 20:24:25');
/*!40000 ALTER TABLE `nodes_session` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `nodes_shipping`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nodes_shipping` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `zip` varchar(100) NOT NULL,
  `street1` varchar(100) NOT NULL,
  `street2` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `nodes_shipping` WRITE;
/*!40000 ALTER TABLE `nodes_shipping` DISABLE KEYS */;
INSERT INTO `nodes_shipping` VALUES (1,1,'','','Russia','Kursk','Kursk','305040','50 let Oktyabrya','','+1234567890');
/*!40000 ALTER TABLE `nodes_shipping` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `nodes_transaction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nodes_transaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `ip` varchar(40) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `invoice_id` (`invoice_id`),
  KEY `order_id` (`order_id`),
  KEY `status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `nodes_transaction` WRITE;
/*!40000 ALTER TABLE `nodes_transaction` DISABLE KEYS */;
/*!40000 ALTER TABLE `nodes_transaction` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `nodes_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nodes_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `confirm` tinyint(1) NOT NULL,
  `code` varchar(4) NOT NULL,
  `bulk_ignore` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

DROP TABLE IF EXISTS `nodes_user_outbox`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nodes_user_outbox` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `outbox_id` int(11) NOT NULL DEFAULT '0',
  `date` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `nodes_user_outbox` WRITE;
/*!40000 ALTER TABLE `nodes_user_outbox` DISABLE KEYS */;
/*!40000 ALTER TABLE `nodes_user_outbox` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `nodes_vr_level`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nodes_vr_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `text` text NOT NULL,
  `image` varchar(100) NOT NULL,
  `rotation` int(11) NOT NULL,
  `scale` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `nodes_vr_level` WRITE;
/*!40000 ALTER TABLE `nodes_vr_level` DISABLE KEYS */;
/*!40000 ALTER TABLE `nodes_vr_level` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `nodes_vr_link`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nodes_vr_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `scene_id` int(11) NOT NULL,
  `url` varchar(200) NOT NULL,
  `position` varchar(100) NOT NULL,
  `scale` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `nodes_vr_link` WRITE;
/*!40000 ALTER TABLE `nodes_vr_link` DISABLE KEYS */;
/*!40000 ALTER TABLE `nodes_vr_link` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `nodes_vr_navigation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nodes_vr_navigation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `scene_id` int(11) NOT NULL,
  `target` int(11) NOT NULL,
  `position` varchar(100) NOT NULL,
  `scale` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `nodes_vr_navigation` WRITE;
/*!40000 ALTER TABLE `nodes_vr_navigation` DISABLE KEYS */;
/*!40000 ALTER TABLE `nodes_vr_navigation` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `nodes_vr_object`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nodes_vr_object` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `scale` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `nodes_vr_object` WRITE;
/*!40000 ALTER TABLE `nodes_vr_object` DISABLE KEYS */;
/*!40000 ALTER TABLE `nodes_vr_object` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `nodes_vr_project`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nodes_vr_project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `nodes_vr_project` WRITE;
/*!40000 ALTER TABLE `nodes_vr_project` DISABLE KEYS */;
/*!40000 ALTER TABLE `nodes_vr_project` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `nodes_vr_scene`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nodes_vr_scene` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `logo_size` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `nodes_vr_scene` WRITE;
/*!40000 ALTER TABLE `nodes_vr_scene` DISABLE KEYS */;
/*!40000 ALTER TABLE `nodes_vr_scene` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

