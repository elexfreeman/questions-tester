
<div class="main-nav w-nav" data-animation="over-left" data-collapse="all" data-contain="1" data-duration="400">
    <div class="main-nav-container w-container">
        <div class="nav-menu-button w-nav-button">
            <div class="w-icon-nav-menu"></div>
        </div>
        <a class="w-clearfix w-nav-brand" href="<?php echo site_url(); ?>">
            <img class="top-logo" src="<?php echo site_url('images/Lecture-512.png'); ?>">
            <div class="top-logo-text w-hidden-small w-hidden-tiny"><strong><em>Лекционные курсы</em></strong></div>
        </a>
        <nav class="nav-menu w-nav-menu" role="navigation">
            <a class="top-menu-item w-nav-link" href="<?php echo site_url("/users"); ?>">Пользователи</a>
            <a class="top-menu-item w-nav-link" href="<?php echo site_url("/courses"); ?>">Курсы</a>

        </nav>
        <div class="user-drop w-dropdown" data-delay="0">
            <div class="w-dropdown-toggle">
                <div>Пользователь: <?php echo $auth->fio; ?></div>
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

