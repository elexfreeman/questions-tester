<div class="breadcrumbs">
    <a class="bread-link" href="<?php echo site_url("couses"); ?>">Курсы</a> &gt;&gt;
    <a class="bread-link" href="<?php echo site_url("courses/".$course['id']); ?>"><?php echo $course['caption']; ?></a> &gt;&gt;
    <a class="bread-link" href="<?php echo site_url("courses/".$course['id']."/".$lecture['id']); ?>"><?php echo $lecture['caption']; ?></a> &gt;&gt;
    Добавить вопрос
</div>


<div class="center-container">
    <h1 class="main-h1">Добавить вопрос:</h1>

    <div class="w-form">
        <form class="w-clearfix" id="email-form-5" name="email-form-5">
            <input type="hidden" name="lecture_id" value="<?php echo $lecture_id;?>">
            <input type="hidden" name="course_id" value="<?php echo $course_id;?>">
            <input type="hidden" name="action" value="question_add">
            <label for="question-text">Текст вопроса:</label>
            <textarea class="question-text w-input" id="question" maxlength="5000" name="question"></textarea>

            <div class="w-row">
                <div class="w-col w-col-3">
                    <div class="answer-item edit">
                        <label for="field-4">Ответ 1:</label>
                        <input class="w-input" id="answer1" maxlength="256" name="answer1"  type="text">

                        <div class="w-checkbox">
                            <input class="w-checkbox-input" id="answer1r" name="right_answer" type="checkbox" value="1">
                            <label class="w-form-label" for="answer1r">Правельный</label>
                        </div>
                    </div>
                </div>
                <div class="w-col w-col-3">
                    <div class="answer-item edit">
                        <label for="field-5">Ответ 2:</label>
                        <input class="w-input" id="answer2" maxlength="256" name="answer2" type="text">

                        <div class="w-checkbox">
                            <input class="w-checkbox-input" id="answer2r" name="right_answer" type="checkbox" value="2">
                            <label class="w-form-label" for="checkbox-9">Правельный</label>
                        </div>
                    </div>
                </div>
                <div class="w-col w-col-3">
                    <div class="answer-item edit">
                        <label for="field-6">Ответ 3:</label>
                        <input class="w-input" id="field-6" maxlength="256" name="answer3" type="text">

                        <div class="w-checkbox">
                            <input class="w-checkbox-input" id="answer3r" name="right_answer" type="checkbox" value="3">
                            <label class="w-form-label" for="answer3r">Правельный</label>
                        </div>
                    </div>
                </div>
                <div class="w-col w-col-3">
                    <div class="answer-item edit">
                        <label for="field-7">Ответ 4:</label>
                        <input class="w-input" id="answer4" maxlength="256" name="answer4" type="text">

                        <div class="w-checkbox"><input class="w-checkbox-input" id="answer4r" name="right_answer" type="checkbox">
                            <label class="w-form-label" for="answer4r">Правельный</label>
                        </div>
                    </div>
                </div>
            </div>
            <input class="user-button w-button" type="submit" value="Сохранить">
        </form>

    </div>
</div>