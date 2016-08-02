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
            <?php if(($user->group==1)or($user->group==3)) { ?>
            <div class="user-page-item-text"><strong>задачи:</strong>
                <?php
                foreach($user_tasks as $task)
                {
                    ?>
                    <a class="link" href="#"><?php echo $task['caption']; ?></a>
                     <?php
                }
                ?>
            </div>
            <?php }?>
        </div>
    </div>
</div>

<div class="center-container"><h1 class="main-h1 user-head">Мои курсы:</h1>

    <div class="tasks-list">
        <div class="task-item w-clearfix">
            <div class="task-caption">Основы информатизации населения в доисторическиц период существования
                человечеста
            </div>
            <div class="task-users">4 лекции, 3 теста, 2 видео</div>
            <div class="task-edit w-clearfix"><a class="task-edit-button" href="#">перейти</a></div>
        </div>
        <div class="task-item w-clearfix">
            <div class="task-caption">Основы информатизации населения в доисторическиц период существования
                человечеста
            </div>
            <div class="task-users">4 лекции, 3 теста, 2 видео</div>
            <div class="task-edit w-clearfix"><a class="task-edit-button" href="#">ПЕРЕЙТИ</a></div>
        </div>
        <div class="task-item w-clearfix">
            <div class="task-caption">Основы информатизации населения в доисторическиц период существования
                человечеста
            </div>
            <div class="task-users">4 лекции, 3 теста, 2 видео</div>
            <div class="task-edit w-clearfix"><a class="task-edit-button" href="#">ПЕРЕЙТИ</a></div>
        </div>
        <div class="task-item w-clearfix">
            <div class="task-caption">Основы информатизации населения в доисторическиц период существования
                человечеста
            </div>
            <div class="task-users">4 лекции, 3 теста, 2 видео</div>
            <div class="task-edit w-clearfix"><a class="task-edit-button" href="#">ПЕРЕЙТИ</a></div>
        </div>
    </div>
</div>