<?php
/**
* Backend main page file.
* @path /engine/site/main.php
*
* @name    DAO Mansion    @version 1.0.2
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*
* @var $this->title - Page title.
* @var $this->content - Page HTML data.
* @var $this->keywords - Array meta keywords.
* @var $this->description - Page meta description.
* @var $this->img - Page meta image.
* @var $this->onload - Page executable JavaScript code.
* @var $this->configs - Array MySQL configs.
*/

if(!empty($_GET[0])){
    $this->content = engine::error();
    return;
}
$this->title = "DAO";
// $this->content .= engine::print_site_navigation(engine::lang("Project whitepaper"));

$query = 'SELECT value FROM nodes_config WHERE name = "git"';
$res = engine::mysql($query);
$data = mysqli_fetch_array($res);
$git = $data["value"];

if ($_SESSION["Lang"] == "ru") {
    $this->description = 'Цель проекта - построить сообщество, объект недвижимости и цифровую инфраструктуру для комфортного существования участников согласно принципам DAO (децентрализованной автономной организации).';
    $this->keywords = Array(
        "DAO",
        "Особняк",
        "Вилла",
        "Web 3.0",
        "Децентрализованная организация",
        "Токеномика",
        "dApp",
        "NFT",
        "Timeshare",
        "Аренда"
    );
    $this->content .= '
    <div class="document980 article">
        <div class="whitepaper text">
        <h1>DAO</h1>
        <p>
            <video id="intro" width="100%" height="auto" autoplay muted controls="controls" poster="'.$_SERVER["DIR"].'/img/video.jpg">
               <source src="file/1.mp4" type=\'video/mp4; codecs="avc1.42E01E, mp4a.40.2"\'>
            </video>
        </p>
        <p>Цель проекта - построить сообщество, объект недвижимости и цифровую инфраструктуру для комфортного существования участников согласно принципам DAO (децентрализованной автономной организации).</p>
        <ul>
            <li><a href="#1">Описание проекта</a></li>
            <li><a href="#2">Децентрализованное приложение</a></li>
            <li><a href="#3">Токеномика</a></li>
            <li><a href="#4">Голосования</a></li>
            <li><a href="#5">Социальный граф</a></li>
            <li><a href="#6">Проектная область</a></li>
        </ul>
        <h2>Описание проекта</h2>
        <a name="1"></a>
        <p>Проект на базе открытой модели общества и использующий принципы блокчейна для организации микроэкономики. В зависимости от конкретного этапа, целевой вид проект отличается: </p>
        <ol>
            <li>Децентрализованное приложение. </li>
            <li>Недвижимость с DAO управлением. </li>
            <li>Листинг внутреннего токена на бирже. </li>
        </ol>
        <p>Воплощая концепцию информационного общества типа Web 3.0, проект нацелен на создание прогрессивного, устойчивого сообщества, которое совместит экологические, социальные и экономические преимущества.</p>
        <h2>Децентрализованное приложение</h2>
        <a name="2"></a>
        <p>Недвижимость будет монетизироваться через продажу услуг, доступных через dApp, который позволит пользователям завести криптовалюту на свой счет и обратно, а также получить доступ ко всем аспектам проекта.</p>
        <p>Кроме того, приложение будет содержать следующие коммерческие функции:</p>
        <ol>
            <li>Аренда гостевых номеров посуточно, гостевого зала и парковки почасово и парилки поминутно.</li>
            <li>Покупка вина с автоматизированной подачей.</li>
            <li>Покупка энергии на парилку, подогрев бассейна и ротонды до комфортной температуры.</li>
            <li>Добавочная стоимость на продажи эксклюзивных лотов посредствам спотовой торговли в номер.</li>
            <li>Площадка для P2P торговли внутренним токеном, NFT с возможностью продаж через аукцион.</li>
        </ol>
        <h2>Токеномика</h2>
        <a name="3"></a>
        <p>
            Концепция распределения прав и дохода включает в себя два вида токенов: ограниченное количество DAO токенов и несколько тысяч различных NFT, которые существуют в контексте сети Bitcoin. 
            Общие DAO токены будут выпущены разово в количестве 1.000.000 токенов, и будут использоваться как основная валюта и гарантировать право голоса в голосованиях и возможность торговли токеном на рыночных условиях.
            NFT будут содержать в себе эквивалент стоимости затрат на физическую составляющую помещений и частичного (или полного, при приобретении всех 100 токенов одного из объектов недвижимости) право на пребывание в конкретном помещении. 
            Кроме того, NFT будут нести его владельцев добавочную стоимость аренды (если это NFT гостевого домика).
            Для основной части здания и 5 гостевых домиков видится по 100 NFT, владение которыми будет гарантировать соответствующее право доли имущественной собственности (1 токен = 1% от собственности и 1% от чистого дохода с аренды соответственно).
        </p>
        <p>
            Для владельца наибольшего количества NFT токенов основного здания будет доступ в серверную и на верхние этажи физически, он же и считается фактически основным собственником, и отвечает за состояние инфраструктуры перед остальными участниками.
            Для проживания в любом помещениях нужно будет забронировать их под свои нужды сроком до года (с возможностью продления с приоритетом в заселении). При этом в случае проживания владельца 100 токенов этого помещения, он оплачивает только коммунальные услуги, без "сжигания" части токенов.
            Для 2 крайних гостевых домиков есть идея применить концепцию Timeshare NFT, выпустив для них не по 1 NFT, а по 365, по 1 на один день права пребывания или получения выгоды в виде половины добавочной стоимости аренды помещений 3-мя лицами.
            Схема распределения дохода от аренды помещений предусматривает вычет себестоимости обслуживания, половины добавочной стоимости владельцу NFT, и сжигание (перевод в депо токена на бирже) половины с целью увеличения капитализации токена.
            Вообще сейчас схема распределения дохода от аренды помещений видится так:
        <blockquote> Из дохода вычитается себестоимость обслуживания, половину добавочной стоимости владельцу NFT, половину "сжигаем" (переводим в депо токена на бирже) с целью увеличения капитализации и, как следствие, рыночной стоимости остальных DAO токенов.</blockquote></p>
        <h2>Голосования</h2>
        <a name="4"></a>
        <p>Голосуются как минимум 6 аспектов: </p>
        <ol>
            <li>Список базовых правил. </li>
            <li>Правки в модель здания, интерьера или территории. </li>
            <li>Правки в социальный граф. </li>
            <li>Правки в децентрализованное приложение. </li>
            <li>Правки и приоритеты задач дорожной карты.</li>
        </ol>
        <p>Эти голосования как раз проходят в счет общих токенов, с последующих их уничтожением (переводом в биржевой депо токена) с целью увеличения капитализации сети. Кроме того, с помощью dApp можно организовать еще крудфандинг-голосования (за покупку каких
            либо спотов, вроде картин или статуй).</p>
        <h2>Cоциальный граф</h2>
        <a name="5"></a>
        <p>
            Группа людей, которая составляет основу сообщества, получает право тусоваться (пребывать) на территории без необходимости иметь токены или бронировать номера. В настоящее время в сообществе участвуют несколько человек, и существуют три типа возможных отношений:
            сексуальные, конкурентные и партнерские.
            <br>Решения о добавлении или удалении участников из социального графа принимаются через систему голосования на основе двух кошельков. Связи между участниками устанавливаются приглашением и взаимным согласием, а удаление происходит по инициативе одной
            из сторон.
            <br>Если требуется голосование за исключение участника, это должно быть подтверждено ссылкой на пункт из списка базовых правил. Это позволит добавить экологических персонажей почти бесплатно, в то время как добавление токсичных людей будет нецелесообразно.
            <br>Кроме того, стоит предусмотреть механизм автоматического удаление участника после утраты конструктивных связей.
        </p>
        <h2>Проектная область</h2>
        <a name="6"></a>
        <p><a target="_blank" href="'.$git.'">Публичный DAO репозиторий</a></p>
        <p><a target="_blank" href="https://github.com/restinpc/Mansion">Исходники макета здания</a></p>
        <p><a target="_blank" href="https://github.com/restinpc/Mansion-build">Демо-версия с поддержкой VR</a> </p>
        <br/>
        <p>
            <video id="outro" width="100%" height="auto" controls="controls" poster="'.$_SERVER["DIR"].'/img/outro.jpg">
               <source src="file/2.mp4" type=\'video/mp4; codecs="avc1.42E01E, mp4a.40.2"\'>
            </video>
        </p>
        </div>
        <br/>
        <br/>
    </div>';
} else if ($_SESSION["Lang"] == "zh") {
    $this->description = '项目目标是根据 DAO（去中心化自治组织）原则建立社区、别墅和数字基础设施，以确保参与者的舒适生活。';
    $this->keywords = Array(
        "DAO",
        "別墅",
        "大廈",
        "Web 3.0",
        "分散的組織",
        "通证经济",
        "dApp",
        "NFT",
        "Timeshare",
        "租"
    );
    $this->content .= '
    <div class="document980 article">
        <div class="whitepaper text">
        <h1>DAO 別墅</h1>
        <p>
            <video id="intro" width="100%" height="auto" controls="controls" poster="'.$_SERVER["DIR"].'/img/video.jpg">
               <source src="'.$_SERVER["DIR"].'/file/1.mp4" type=\'video/mp4; codecs="avc1.42E01E, mp4a.40.2"\'>
            </video>
        </p>
        <p>项目目标是根据 DAO（去中心化自治组织）原则建立社区、别墅和数字基础设施，以确保参与者的舒适生活。</p>
        <ul>
            <li><a href="#1">项目描述</a></li>
            <li><a href="#2">去中心化应用</a></li>
            <li><a href="#3">通证经济</a></li>
            <li><a href="#4">投票</a></li>
            <li><a href="#5">社交网络</a></li>
            <li><a href="#6">项目领域</a></li>
        </ul>
        <h2>项目描述</h2>
        <a name="1"></a>
        <p>一個基於社會開放模型並利用區塊鏈原理組織微觀經濟學的項目。根据具体阶段的不同，项目的目标类型也不同：</p>
        <ol>
            <li>去中心化应用</li>
            <li>DAO 原则下的别墅</li>
            <li>在币安上列出内部代币</li>
        </ol>
        <p>在实现Web 3.0类型的信息社会理念的同时，该项目旨在创建一个兼具生态、社会和经济优势的进步可持续社区。</p>
        <h2>去中心化应用</h2>
        <a name="2"></a>
        <p>通过提供 dApp 上可用的服务来将别墅商品化，用户可以将加密货币存入和取出账户，并访问项目的所有方面。</p>
        <p>此外，该应用还将包括以下商业功能：</p>
        <ol>
            <li>按小时租赁客房、客厅和停车场，按分钟租赁桑拿房。</li>
            <li>自动售卖酒类。</li>
            <li>购买桑拿、加热游泳池和旋转餐厅的能源，使其保持舒适温度。</li>
            <li>通过酒店内的即时交易为独特商品增加价值。</li>
            <li>基于拍卖的 NFT 对等交易平台。</li>
        </ol>
        <h2>通证经济</h2>
        <a name="3"></a>
        <p>
            權利和收入分配的概念包括兩種類型的代幣：有限數量的 DAO 代幣和存在於比特幣網路環境中的數千種不同的 NFT。的上下文中总共将发行万个DAO代币，作为主要货币使用，并确在投票中拥表决权和在市场条件进行代币交的权利。NFT将包含物理间成本和特定间居住权（在购买某个房地产对象全部100个代币，可以获得部或全部居住权）。此外，NFT还将为其所有者增加租金价值（如果是客的NFT）。对于建筑的主体部分和5客房，预计个有100个NFT，拥这些NFT将保相应的财产所有份额（1个代币=相应财的1%和租金净收入的1%）。
        </p>
        <p>
            对拥有最多NFT代币的主楼的所有，他们将能物理进入服务器和顶层，际上被视为要业主，并对基础设施的状态对其他参与负责。要居住任何房间中，需要预订并根据自己的需预订一年的时间（具有入住优先权的延长选项）。在种情况下，如果个房间的100个币的所有者居住该房间中，只需支付公用事业费而无需“烧毁部分代币。于两个极端房，有一个使用Timeshare NFT概念的想，为它们发行365NFT，每天一个以供3个人享受住权或获得租金额外费用的一半。房间租金收中分配收入的方包括扣除服务成本、将一半的外费用支付给NFT所有者，并“烧毁”（将其转移到交所的存储库）另一半，以增加代币市值。总体上，目房间租金收入分配方案如：
        <blockquote>从收入中扣除服务本，将一半的额外费用支付给NFT所有者将另一半烧毁”（转移到交所的存储库），以增加代币的市值，从而提高其他代币的市场价值。</blockquote></p>
        <h2>投票</h2>
        <a name="4"></a>
        <p>至少有6个方面进行投票：</p>
        <ol>
            <li>基本规则清单。</li>
            <li>建筑、室内或场地模型的修改。</li>
            <li>社交网络的修改。</li>
            <li>去中心化应用程序的修改。</li>
            <li>路线图任务的修改和优先级。</li>
        </ol>
        <p>这些投票正好是通过共同代币进行的，并随后销毁（将其转换为交易所存放库），以增加网络的资本化。此外，借助dApp，还可以组织众筹投票（例如购买艺术品或雕塑等）。</p>
        <h2>社交网络</h2>
        <a name="5"></a>
        <p>
            構成社區核心的人群有權在領土上聚會（停留），無需代幣或預訂房間。当前社区有几个人参与，并存在三种可能的关系类型：性关系、竞争关系和合作关系。
            有关添加或删除社交网络成员的决策是通过基于两个钱包的投票系统进行的。成员之间的联系是通过邀请和相互同意来建立的，而删除则由其中一方发起。
            如果需要对成员进行排除投票，则必须提供基本规则清单中的条款链接作为确认。这将使得添加环保人物几乎免费，而添加有毒人物则不切实际。
            此外，应考虑在失去建设性联系后自动删除成员的机制。
        </p>
        <h2>项目领域</h2>
        <a name="6"></a>
        <p><a target="_blank" href="'.$git.'">公共 DAO 儲存庫</a></p>
        <p><a target="_blank" href="https://github.com/restinpc/Mansion">建筑设计源文件</a></p>
        <p><a target="_blank" href="https://github.com/restinpc/Mansion-build">支持虚拟现实的演示版本</a> </p>
        <br/>
        <p>
            <video id="outro" width="100%" height="auto" controls="controls" poster="'.$_SERVER["DIR"].'/img/outro.jpg">
               <source src="file/2.mp4" type=\'video/mp4; codecs="avc1.42E01E, mp4a.40.2"\'>
            </video>
        </p>
        </div>
        <br/>
        <br/>
    </div>';
} else {
    $this->description = 'The goal of the project is to build a community, villa, and digital infrastructure for the comfortable existence of participants according to the principles of a Decentralized Autonomous Organization (DAO).';
    $this->keywords = Array(
        "DAO",
        "Mansion",
        "Web 3.0",
        "Decentralized Organization",
        "Tokenomics",
        "dApp",
        "NFT",
        "Timeshare",
        "Rent"
    );
    $this->content .= '
    <div class="document980 article">
        <div class="whitepaper text">
        <h1>DAO Mansion</h1>
        <p>
            <video id="intro" width="100%" height="auto" controls="controls" poster="'.$_SERVER["DIR"].'/img/video.jpg">
               <source src="'.$_SERVER["DIR"].'/file/1.mp4" type=\'video/mp4; codecs="avc1.42E01E, mp4a.40.2"\'>
            </video>
        </p>
        <p>The project is about to build a community, mansion, and digital infrastructure for the comfortable existence of participants according to the principles of a Decentralized Autonomous Organization (DAO).</p>
        <ul>
            <li><a href="#1">Project Description</a></li>
            <li><a href="#2">Decentralized Application</a></li>
            <li><a href="#3">Tokenomics</a></li>
            <li><a href="#4">Voting</a></li>
            <li><a href="#5">Social Graph</a></li>
            <li><a href="#6">Project Scope</a></li>
        </ul>
        <h2>Project Description</h2>
        <a name="1"></a>
        <p>A project based on an open model of society and using blockchain principles to organize microeconomics. Depending on the specific stage, the project\'s target form differs:</p>
        <ol>
            <li>Decentralized Application.</li>
            <li>Realty with a DAO manage principles.</li>
            <li>Listing of internal token on the exchange.</li>
        </ol>
        <p>Incorporating the concept of Web 3.0 information society, the project aims to create a progressive and sustainable community that combines ecological, social, and economic benefits.</p>
        <h2>Decentralized Application</h2>
        <a name="2"></a>
        <p>The villa will be monetized through the sale of services available through a dApp, which allows users to deposit and withdraw cryptocurrency to and from their accounts, as well as access all aspects of the project.</p>
        <p>In addition, the application will include the following commercial features:</p>
        <ol>
            <li>Rent of guest rooms by the day, guest hall and parking by the hour and sauna by the minute.</li>
            <li>Purchasing wine with automated delivery.</li>
            <li>Purchasing extra energy for sauna, pool heating, and rotunda heating to a comfortable temperature.</li>
            <li>Value-added sales on exclusive lots through spot trading in the room.</li>
            <li>Platform for P2P trading of internal tokens, NFTs with the possibility of auction sales.</li>
        </ol>
        <h2 name="tokenomics">Tokenomics</h2><a name="3"></a>
        <p>
            The concept of rights and income distribution includes two types of tokens: a limited supply of DAO tokens and several NFTs that exist within the context of Bitcoin (BTC) network.
            The common DAO tokens will be issued once with a quantity of 1,000, tokens and will serve as the primary currency, guaranteeing voting rights in governance and the ability to trade the token on market conditions. The NFTs will represent the equivalent value of the physical components of the properties and partial (or full, when acquiring all 100 tokens of a specific property) rights to occupy a particular space. Additionally, NFTs will add value to their owners\' rental income (if it is NFT for a guest house). For the main building and five guest houses, there will be 100 NFTs each, ownership of which will guarantee a corresponding share of property ownership (1 token = 1% ownership and 1% of net rental income, respectively).
        </p>
        <p>
            The owner with the highest number of NFT tokens for the main building will have an access to the server room and upper floors physically. They are considered the de facto main owner and responsible for the infrastructure\'s condition for other participants. To reside in any of the spaces, they will need reserve them for their needs for to a year (with the possibility of extension and priority in occupancy). the case of the owner of 100 tokens for a specific space, they only pay for utilities without "burning" a portion of the tokens. For the two outermost guest houses, there is an idea to apply the concept of Timeshare NFT by issuing 365 NFTs for each, representing one day of occupancy or receiving half of the additional rental value by three individuals. The income distribution scheme from renting the spaces involves deducting the cost of maintenance, allocating half of the additional value to the NFT owner, and "burning" (transferring a token depot on the exchange) the other half increase the token\'s capitalization. Currently, the income distribution scheme from renting the spaces is envisioned as follows:
        <blockquote>From the income, the cost of maintenance is deducted, half of the additional value is allocated to the NFT owner, and the other half is "burned" (transferred a token depot on the exchange) to increase the capitalization and, consequently, the market value of the remaining DAO tokens.</blockquote></p>
        <h2>Voting</h2>
        <a name="4"></a>
        <p>At least 6 aspects are subject to voting:</p>
        <ol>
            <li>List of basic rules.</li>
            <li>Changes in the building model, interior, or territory.</li>
            <li>Changes in the social graph.</li>
            <li>Changes in the decentralized application.</li>
            <li>Roadmap tasks, modifications, and priorities.</li>
        </ol>
        <p>These votes are conducted using the common tokens, with subsequent destruction (transfer to the token depot on the exchange) to increase the network\'s capitalization. Additionally, through the dApp, crowdfunding-style votes can be organized (for the purchase of spots, such as paintings or statues).</p>
        <h2>Social Graph</h2>
        <a name="5"></a>
        <p>
            The group of people that forms the core of the community has the right to party (stay) on the territory without the need for tokens or room reservations. Currently, several individuals participate in the community, and there are three types of potential relationships: sexual, competitive, and partnership.
            Decisions regarding the addition or removal of participants from the social graph are made through a voting system based on two wallets. Connections between participants are established through invitations and mutual consent, and removal occurs at the initiative of either party.
            If a vote is required for the exclusion of a participant, it must be supported by a reference to an item from the list of basic rules. This allows for the addition of environmentally conscious individuals almost free of charge, while adding toxic people would be impractical.
            Furthermore, it is worth considering a mechanism for automatic removal of a participant after the loss of constructive connections.
        </p>
        <h2>Project Scope</h2>
        <a name="6"></a>
        <p><a target="_blank" href="'.$git.'">Public DAO repository</a></p>
        <p><a target="_blank" href="https://github.com/restinpc/Mansion">Mansion VR sources</a></p>
        <p><a target="_blank" href="https://github.com/restinpc/Mansion-build">Mansion VR demo version</a> </p>
        <br/>
        <p>
            <video id="outro" width="100%" height="auto" controls="controls" poster="'.$_SERVER["DIR"].'/img/outro.jpg">
               <source src="file/2.mp4" type=\'video/mp4; codecs="avc1.42E01E, mp4a.40.2"\'>
            </video>
        </p>
        </div>
        <br/>
        <br/>
    </div>';
}

$this->onload .= '
    try {
        window.addEventListener("click", () => {
            document.getElementById("outro").addEventListener("ended", () => {
                window.location = "'.$_SERVER["DIR"].'/webvr/panorama";
            }, false);
        });
    } catch(e) { }
';
