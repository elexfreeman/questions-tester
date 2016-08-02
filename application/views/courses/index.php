
<div class="center-container">
    <a href="<?php echo site_url("courses/add"); ?>"><div class="center-top-button">Создать</div></a>
    <h1 class="main-h1 user-head">Курсы:</h1>

    <div class="tasks-list">

        <?php foreach($courses as $course){ ?>
            <div class="task-item w-clearfix">
                <div class="task-caption"><?php echo $course['caption']; ?></div>
                <div class="task-users">4 лекции, 3 теста, 2 видео</div>
                <div class="task-edit w-clearfix">
                    <a class="task-edit-button" href="<?php echo site_url("courses/".$course['id']); ?>">редактировать</a>
                </div>
            </div>
        <?php } ?>
    </div>
</div>