<div class="center-container">
    <a href="<?php echo site_url("tasks/add"); ?>">
    <div class="center-top-button">
        новая задача</div>
    </a>
    <h1 class="main-h1 user-head">Задачи:</h1>
    <div class="tasks-list">
        <?php
        foreach($tasks as $task)
        {
            ?>
            <div class="task-item w-clearfix">
                <div class="task-caption"><?php echo $task['caption']; ?></div>

                <div class="task-users">
                    <?php
                    $u = " ";
                    foreach($task['users'] as $user )
                    {
                        $u.=' <a class="link" href= '.site_url("users/".$user['login']).'>'.$user['fio'].'</a>,';
                    }
                    echo substr($u, 0, -1);
                    ?>
                </div>
                <div class="task-edit w-clearfix">
                    <a class="task-edit-button" href="<?php echo site_url("tasks/".$task['id']); ?>">редактировать</a>
                </div>
            </div>
        <?php
        }
        ?>

    </div>
</div>