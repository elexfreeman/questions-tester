
<div class="main-nav w-nav" data-animation="over-left" data-collapse="all" data-contain="1" data-duration="400">
    <div class="main-nav-container w-container">
        <div class="nav-menu-button w-nav-button">
            <div class="w-icon-nav-menu"></div>
        </div>
        <a class="w-clearfix w-nav-brand" href="<?php echo site_url(); ?>">
            <img class="top-logo" src="https://daks2k3a4ib2z.cloudfront.net/578736a1ccda65ac618bae8f/578738691c0e63b1517cf7f8_logo1.jpg">

            <div class="top-logo-text w-hidden-small w-hidden-tiny">
                <strong><em>support</em></strong>.medlan.samara.ru
            </div>
        </a>
        <nav class="nav-menu w-nav-menu" role="navigation">
            <a class="top-menu-item w-nav-link" href="/tasks">Задачи</a>
            <a class="top-menu-item w-nav-link" href="#">Заявки</a>
            <a class="top-menu-item w-nav-link" href="#">Мониторинг</a>
            <a class="top-menu-item w-nav-link" href="#">Общая информация</a>
        </nav>
        <div class="user-drop w-dropdown" data-delay="0">
            <div class="w-dropdown-toggle">
                <div>Пользователь: <?php echo $auth->login; ?></div>
                <div class="w-icon-dropdown-toggle"></div>
            </div>
            <nav class="user-menu-list w-dropdown-list">
                <a class="top user-menu-item w-dropdown-link" href="#">Настройки</a>
                <a class="user-menu-item w-dropdown-link" href="<?php echo site_url("/auth/logout"); ?>">Выход</a>
            </nav>
        </div>
    </div>
</div>
<div class="top-space"></div>

