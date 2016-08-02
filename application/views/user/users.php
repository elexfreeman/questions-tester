<div class="center-container">
    <a href="<?php echo site_url('users/add'); ?>">
        <div class="center-top-button">Новый</div>
    </a>
    <h1 class="main-h1 user-head">Пользователи:</h1>

    <div class="users-list">
        <?php
        foreach($users as $user)
        {
            ?>
            <div class="user-item w-clearfix">
                <img class="user-item-img" src="<?php
                if((isset($user['avatar']))and($user['avatar']!=''))
                {
                    echo $images_avatar.$user['avatar'];
                }
                else
                {
                    echo $default_user_avatar;
                }
                ?>">
                <a href="<?php echo site_url("users/".$user['login']) ?>"><div class="user-item-name"><?php echo $user['fio']; ?></div></a>
                <div class="user-doljn"><?php echo $user['post']; ?></div>
                <div class="user-item-phone"><?php echo $user['phone']; ?></div>
                <div class="user-item-button-block">
                    <a class="task-edit-button user-edit" href="<?php echo site_url('users/'.$user['login'].'/edit'); ?>">редактировать</a>
                </div>
            </div>
           <?php
        }
        ?>

    </div>
</div>