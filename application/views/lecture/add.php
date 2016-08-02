<div class="breadcrumbs">
    <a class="bread-link" href="<?php echo site_url("couses"); ?>">Курсы</a> &gt;&gt;
    <a class="bread-link" href="<?php echo site_url("courses/".$course['id']); ?>"><?php echo $course['caption']; ?></a> &gt;&gt;Добавить
</div>


<div class="center-container">
    <h1 class="lecture-title main-h1">
        <em>Добавить лекцию:</em>
    </h1>

    <div class="w-form">
        <form class="w-clearfix" method="post" enctype="multipart/form-data">
            <input type="hidden" name="course_id" value="<?php echo $course['id']; ?>">
            <input type="hidden" name="action" value="lecture_add">
            <label for="name">Название лекции:</label>
            <input class="w-input" data-name="caption" id="caption" maxlength="256" name="caption" type="text">

            <label for="description">Порядок в списке:</label>
            <input class="w-input" id="order_number" maxlength="256" name="order_number" type="number">

            <label for="date_start">Дата начала:</label>
            <input class="w-input hasDatepicker" id="date_start" maxlength="256" name="date_start" required>

            <label for="video">Видео:</label>
            <input class="w-input" id="video" maxlength="256" name="video"  type="file">

            <label for="description">Материал:</label>
            <textarea class="lect-text-arrea w-input" id="description" maxlength="5000" name="description"></textarea>



            <div class="lect-video"></div>

            <input class="user-button w-button" type="submit" value="Сохранить">
        </form>


    </div>
</div>