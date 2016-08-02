<div class="center-container">
    <a href="<?php echo site_url("courses/".$course['id']."/add"); ?>"><div class="center-top-button">Добавить лекцию</div></a>
    <h1 class="main-h1">Редактировать курс</h1>
    <div class="w-form">
        <form class="w-clearfix" method="post" enctype="multipart/form-data">
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="id" value="<?php echo $course['id']; ?>">
            <label for="caption">Название курса:</label>
            <input class="w-input" id="caption"
                   value="<?php echo $course['caption']; ?>"
                   maxlength="256" name="caption" required type="text">
            <input class="user-button w-button" type="submit" value="Сохранить">
        </form>
    </div>





    <div class="tasks-list">
        <?php $n=1;

        foreach ($lectures as $lecture)
        {
            $d = strtotime( $lecture['date_start'] );
            $d = date( 'd.m.Y', $d );

            $t = strtotime( $lecture['date_start'] );
            $t = date( 'H:i', $t );
            ?>
            <div class="lect-date"><?php echo $d; ?> в <?php echo $t; ?></div>
            <div class="task-item w-clearfix">
                <div class="task-caption"><em>Лекция <?php echo $n; ?>:</em> <?php echo $lecture['caption']; ?></div>
                <div class="task-users">1 видео, 1 тест</div>
                <div class="task-edit w-clearfix"><a class="task-edit-button" href="<?php echo site_url("courses/".$course_id."/".$lecture['id']) ?>">редактировать</a></div>
            </div>
            <?php
            $n++;
        }
        ?>


    </div>

</div>

