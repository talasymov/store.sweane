<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo $data['MetaDescription'] ?? ''; ?>"/>
    <meta name="keywords" content="<?php echo $data['MetaKeywords'] ?? ''; ?>"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>

    <link rel="shortcut icon" href="favicon.png"/>

    <title><?php echo $data['Title'] ?? 'Главная страница'; ?></title>
    <link rel="stylesheet" href="/libs/bootstrap/bootstrap.min.css"/>
    <link rel="stylesheet" href="/libs/datepicker/css/bootstrap-datetimepicker.min.css"/>
    <link rel="stylesheet" href="/libs/owl-carousel/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="/libs/owl-carousel/owl-carousel/owl.theme.css">

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <!--    user css-->
    <?php echo $data['CSS']; ?>
    <!--    end-->
</head>
<body>
<header id="header">
    <div class="container">
        <div class="row top-panel">
            <div class="col-md-12">
                <nav class="link-panel">
                    <?php
                    $header = $data['Template']['Header']['Header'];
                    foreach ($header as $array) {
                        foreach ($array as $key => $item) {
                            if ($key == 'Link') {
                                if ($item != "http://champ.in.ua/") {
                                    print("<a href=\"/$item\"><div class=\"top-panel-link\">");
                                } else {
                                    print("<a target=\"_blank\" id=\"adv_agent_link\" href=\"$item\"><div class=\"top-panel-link\">");
                                }
                            }
                            if ($key == 'LinkName') {
                                if ($item != "Рекламное агенство") {
                                    print("<p>$item</p></div></a>");
                                } else {
                                    print("<p>
                                    <img src=\"\" alt=\"Move to champ.in.ua\" id=\"adv_logo_link\">
                                    $item</p></div></a>");
                                }
                            }
                        }
                    }
                    ?>
                </nav>
                <div class="callback-header-btn">
                    <button id="callback-modal"><i class="fa fa-phone" aria-hidden="true"></i>
                        <p>Обратный звонок</p></button>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bg-wrap">
        <div class="container">
            <div class="row main-header-row">
                <div class="col-md-12">
                    <div class="logo">
                        <a href="/"><img src="/img/logo.svg" alt="logo link"></a>
                    </div>
                    <div class="search">
                        <input type="text" id="searchInp" placeholder="Что будем искать?">
                        <button id="searchBtn"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </div>
                    <div class="telephone-numbers">
                        <?php
                        $telephones_arr = explode(",", $data['Template']['Telephones']);
                        $first_phone_trimmed = str_replace(" ", "", $telephones_arr[0]);
                        print("
                    <p>
                        <a id=\"telephone-link\" href=\"tel:+38$first_phone_trimmed\">
                            <span>
                                <i class=\"fa fa-phone\" aria-hidden=\"true\"></i>
                            </span>
                            <span id=\"header-selected-telephone\">$telephones_arr[0]</span>
                        </a>
                        <span id=\"telephone-caret\">
                            <i class=\"fa fa-angle-down\" aria-hidden=\"true\"></i>
                        </span>
                    </p>");
                        print("<ul class=\"telephones-ul\">");
                        foreach ($telephones_arr as $telephone) {
                            print("<li class=\"telephone-li\">$telephone</li>");
                        }
                        print("</ul>");
                        ?>
                    </div>
                    <div class="user-link-header">
                        <div class="favorite">
                            <a href="javascript:void(0);" id="favorite-btn">
                                <div class="favorite-count"><span id="fav-count-span">0</span></div>
                                <i class="fa fa-heart-o" aria-hidden="true"></i>
                            </a>
                            <div class="favorite-slider favorite-slider-left">
                                <p>
                                    У Вас <span id="favorite-count-prod"></span>товара (доделать четкое окончание
                                    (switch))
                                    <a href="/Profile/Favorite">Перейти к избранным</a>
                                </p>
                            </div>
                        </div>
                        <div class="trash">
                            <a href="javascript:void(0);" id="trash-btn">
                                <div class="trash-count"><span id="trash-count-span">0</span></div>
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                            </a>
                            <div class="trash-slider trash-slider-left">
                                <p>В <a href="/Trash">вашей корзине</a></p>
                                <p>
                                    <span id="product-count-span"></span>товара на сумму
                                    <span id="product-summary-price"></span> грн.
                                </p>
                            </div>
                        </div>
                        <div class="account">
                            <a href="javascript:void(0);" id="account-btn">
                                <i class="fa fa-user-o" aria-hidden="true"></i>
                            </a>
                            <div class="account-slider account-slider-left">
                                <?php
                                $non_authorize = <<<EOF
                                <h4>Вход в личный кабинет:</h4>
                                <p>Электронная почта (e-mail)*</p><input type="email" required="required" name="email" id="sign-in-email">
                                <p>Пароль*</p><input type="password" required="required" id="sign-in-password" name="password">
                                <a href="javascript:void(0);" id="password_forget">Забыли пароль?</a>
                                <button id="signInUserBtn">Войти</button>
                                <p>Или войти через соц. сети</p>
                                <div class="sign_in-links">
                                    <a href="javascript:void(0);">
                                        <img src="/img/socialnetworks/facebook.svg" alt="Sign In With Facebook">
                                    </a>
                                    <a href="javascript:void(0);">
                                        <img src="/img/socialnetworks/googleplus.svg" alt="Sign In With Google Plus">
                                    </a>
                                    <a href="javascript:void(0);">
                                        <img src="/img/socialnetworks/vk.svg" alt="Sign In With VK.com">
                                    </a>
                                </div>
                                <p>Нет учетной записи ?</p><a href="/SignUp">Зарегистрироваться</a>
EOF;
                                $authorize = <<<EOF
                                <div class="account-slider-wrap">
                                    <a href="/Profile"><div class="my_profile">Мой профиль</div></a>
                                    <a href="/Profile/Favorite"><div class="my_favorite">Избранные товары</div></a>
                                    <a href="/Trash"><div class="my_trash">Корзина</div></a>
                                    <a href="/Profile/PreviousOrders"><div class="my_orders">Мои заказы</div></a>
                                    <a href="/Profile/ProfileReviews"><div class="my_reviews">Мои отзывы</div></a>
                                    <a href="javascript:void(0);"><div class="userExitBtn"><p>Выйти</p></div></a>
                                </div>
EOF;
                                if ($_SESSION['isUserCorrect']) {
                                    echo $authorize;
                                } else {
                                    echo $non_authorize;
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="category-catalog">
                <button id="catalog-slide-btn">
                    <i class="fa fa-bars" aria-hidden="true"></i>
                    Каталог товара
                </button>
                <div id="catalog-slide">
                    <ul class="catalog-slide-ul">
                        <?php
                        $catalog['Main'] = $data['Template']['Sidebar']['MainCategory'];
                        $catalog['Sub'] = $data['Template']['Sidebar']['SubCategory'];

                        foreach ($catalog['Main'] as $root_category) {
                            print("<li class=\"root_category_li\"><p>{$root_category['RootCategory']}<i class=\"fa fa-chevron-right\" aria-hidden=\"true\"></i>
</p>
                                   <ul class=\"catalog-sub-ul\">");
                            foreach ($catalog['Sub'] as $sub_category) {
                                if ($root_category['RootCategoryID'] == $sub_category['MainCategoryID']) {
                                    print("<li class=\"sub_category_li\"><p>{$sub_category['CategoryName']}</p></li>");
                                }
                            }
                            print("</ul></li>");
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="product-path">
                <a href="/">Главная</a>
                <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                <?php
                printf('<a href="javascript:void(0);" class="root_category_link" data-id-category="%s">%s</a>
                        <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                        <a href="javascript:void(0);" class="sub_category_link" data-id-category="%s">%s</a>'
                    , $data['ProductData']['RootCategory']['CategoryID']
                    , $data['ProductData']['RootCategory']['CategoryName']
                    , $data['ProductData']['SubCategory']['ID_SubCategory']
                    , $data['ProductData']['SubCategory']['SubCategoryName']);
                ?>
            </div>
        </div>
    </div>
    <div class="catalog-slide-bg"></div>
    <?php include 'application/views/' . $content_view; ?>

</div>
<footer id="footer">
    <?php $footer = $data['Template']['Footer']['Footer']; ?>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="footer-col-1">
                    <p>Интернет магазин компании "Champion Group" <br> 2013-2016</p>
                    <br>
                    <p>График работы Call-центра:</p>
                    <p>В будние дни с 8:00 до 19:00</p>
                    <p>Суббота с 9:00 до 19:00</p>
                    <p>Воскресенье с 10:00 до 19:00</p>
                </div>
            </div>
            <div class="col-md-2">
                <ul class="footer-links-ul">
                    <?php
                    $i = 0;
                    foreach ($footer as $array) {
                        foreach ($array as $key => $item) {
                            if ($i++ < 8) {
//                            echo $key . "  " . $item . "<br>";
                                if ($key == "Link") {
                                    print("<li class=\"footer-link-li\"><a href=\"$item\">");
                                }
                                if ($key == "LinkName") {
                                    print("$item</a></li>");
                                }
                            } else {
                                break 2;
                            }
                        }
                    }
                    ?>
                </ul>
            </div>
            <div class="col-md-2">
                <ul class="footer-links-ul">
                    <?php
                    $i = 0;
                    foreach ($footer as $array) {
                        foreach ($array as $key => $item) {
                            if ($i++ < 8) {
                                continue;
                            } else {
                                if ($key == "Link") {
                                    print("<li class=\"footer-link-li\"><a href=\"$item\">");
                                }
                                if ($key == "LinkName") {
                                    print("$item</a></li>");
                                }
                            }
                        }
                    }
                    ?>
                </ul>
            </div>
            <div class="col-md-4">
                <p>Подпишитесь и получайте новости об акциях и специальных предложениях</p>
                <div class="footer-subscribe">
                    <input type="text" placeholder="Введите e-mail" id="subscribe-email">
                    <button id="subscribe-btn">Подписаться</button>
                </div>
                <div class="social-links">
                    <p>Champion Group в соц. сетях:</p>
                    <?php
                    unset($footer);

                    $social = $data['Template']['SocialData']['SocialData'];

                    foreach ($social as $array) {
                        foreach ($array as $key => $item) {
                            if ($key == 'Link') {
                                print("<a target=\"_blank\" href=\"$item\">");
                            }
                            if ($key == 'Name') {
                                print("<img alt=\"$item\" ");
                            }
                            if ($key == 'SocialNetworkImg') {
                                print("src=\"$item\"></a>");
                            }
                        }
                    }
                    ?>
                </div>
                <div class="pay-type-footer">
                    <p>Мы принимаем:</p>
                    <img src="/img/payment-img/visa.svg" alt="Мы принимаем Visa">
                    <img src="/img/payment-img/mastercard.svg" alt="Мы принимаем Master Card">
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="/libs/jquery/jquery-3.1.0.min.js" charset="utf-8"></script>
<script src="/libs/owl-carousel/owl-carousel/owl.carousel.min.js"></script>
<script type="text/javascript" src="/libs/datepicker/js/moment-with-locales.min.js"></script>
<script type="text/javascript" src="/libs/bootstrap/bootstrap.min.js"></script>
<script type="text/javascript" src="/libs/datepicker/js/bootstrap-datetimepicker.min.js"></script>
<script src="/libs/noty/js/jquery.noty.packaged.min.js"></script>

<!--user scripts-->
<?php echo $data['JS']; ?>
<!--end-->
</body>
</html>