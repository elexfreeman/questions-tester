<div class="center-container">

    <div class="w-row">
        <div class="w-col w-col-3">
            <img class="user-page-ava" src="<?php
            if((isset($user->avatar))and($user->avatar!=''))
            {
                echo $images_avatar.$user->avatar;
            }
            else
            {
                echo $default_user_avatar;
            }
            ?>">

            <div class="user-page-msg">Отправить сообщение</div>
        </div>
        <div class="w-col w-col-9">
            <div class="user-page-name"><?php echo $user_name; ?></div>
            <div class="user-page-item-text"><strong>отдел:</strong> <?php echo $user->otd; ?></div>
            <div class="user-page-item-text">
                <strong>должность:</strong> <?php echo $user->post; ?>
            </div>
            <div class="user-page-item-text"><strong>Телефон:</strong> <?php echo $user->phone; ?></div>

        </div>
    </div>
</div>
<div class="center-container">
    <div class="center-top-button">Добавить курс пользователю</div>
    <h1 class="main-h1 user-head">Курсы:</h1>

    <div class="tasks-list">
        <div class="task-item w-clearfix">
            <div class="task-caption">Основы информатизации населения в доисторическиц период существования
                человечеста
            </div>
            <div class="task-users">4 лекции, 3 теста, 2 видео</div>
            <div class="task-edit w-clearfix"><a class="task-edit-button" href="#">редактировать</a></div>
        </div>
        <div class="task-item w-clearfix">
            <div class="task-caption">Основы информатизации населения в доисторическиц период существования
                человечеста
            </div>
            <div class="task-users">4 лекции, 3 теста, 2 видео</div>
            <div class="task-edit w-clearfix"><a class="task-edit-button" href="#">редактировать</a></div>
        </div>
        <div class="task-item w-clearfix">
            <div class="task-caption">Основы информатизации населения в доисторическиц период существования
                человечеста
            </div>
            <div class="task-users">4 лекции, 3 теста, 2 видео</div>
            <div class="task-edit w-clearfix"><a class="task-edit-button" href="#">редактировать</a></div>
        </div>
        <div class="task-item w-clearfix">
            <div class="task-caption">Основы информатизации населения в доисторическиц период существования
                человечеста
            </div>
            <div class="task-users">4 лекции, 3 теста, 2 видео</div>
            <div class="task-edit w-clearfix"><a class="task-edit-button" href="#">редактировать</a></div>
        </div>
    </div>
</div>