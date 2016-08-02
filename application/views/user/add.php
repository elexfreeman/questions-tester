<div class="center-container">
    <h1 class="main-h1 user-head">Добавление пользователя:</h1>

    <div class="w-form">
        <label class="error" >
        <?php echo validation_errors(); ?>
        </label>
        <form class="w-clearfix" name="add-user-form" method="post" enctype="multipart/form-data">
            <input name="action" value="insert-user" type="hidden">
            <div class="w-row">
                <div class="w-col w-col-4">
                    <label class="search-label" for="password">логин:</label>
                    <input class="user-input-ava w-input" maxlength="256" name="login" type="login" required
                           value="<?php echo set_value('login'); ?>">
                    <label class="search-label" for="password">пароль:</label>

                    <input class="user-input-ava w-input" maxlength="256" name="password1" type="password" required
                           value="<?php echo set_value('password1'); ?>">
                    <input class="user-input-ava w-input" maxlength="256" name="password2" type="password" required
                    value="<?php echo set_value('password2'); ?>">

                    <label class="search-label" for="user-avatar">Изменить аватар:</label>
                    <input class="user-input-ava w-input" id="user-avatar"  name="avatar" type="file">

                </div>
                <div class="w-col w-col-4">
                    <label class="search-label" for="user-name">ФИО:</label>
                    <input class="w-input"
                           value="<?php echo set_value('fio'); ?>"
                           id="user-name" maxlength="256" name="fio" type="text" required>

                    <label class="search-label" for="field">Отдел:</label>
                    <input class="w-input" id="user-otd" maxlength="256"
                           value="<?php echo set_value('otd'); ?>"
                           name="otd" type="text">

                    <label class="search-label" for="user-doljn-2">Должность:</label>
                    <input class="w-input" id="user-doljn-2"
                           value="<?php echo set_value('post'); ?>"
                           maxlength="256" name="post" type="text">

                    <label class="search-label" for="user-phone-3">телефон:</label>
                    <input class="w-input" id="user-phone-3" maxlength="256" name="phone" type="text">
                </div>
                <div class="w-col w-col-4">
                    <label class="search-label" for="group-2">группа:</label>
                    <select class="w-select" id="group-2" name="group" required>
                        <?php foreach($groups as $group) {?>
                        <option <?php if($group['id']=='2') echo "selected" ?> value="<?php echo $group['id']; ?>"><?php echo $group['caption']; ?></option>
                        <?php }?>
                    </select>

                    <label class="search-label" for="group-2">задачи (+Ctrl):</label>
                    <select class="user-tascs w-select" id="field-2" multiple="multiple" name="tasks[]">
                        <?php foreach($tasks as $task) {?>
                            <option value="<?php echo $task['id']; ?>"><?php echo $task['caption']; ?></option>
                        <?php }?>
                    </select>
                </div>
            </div>
            <input class="user-button w-button" type="submit" value="сохранить">
        </form>

    </div>
</div>