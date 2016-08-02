<div class="center-container">
    <h1 class="main-h1 user-head">Редактирование <b><?php echo $user->login; ?></b>:</h1>
    <div class="w-form">

        <form class="w-clearfix" name="add-user-form" method="post" enctype="multipart/form-data">
            <input name="action" value="update" type="hidden">
            <div class="w-row">
                <div class="w-col w-col-4">
                    <img class="user-edit user-page-ava" src="<?php
                    if((isset($user->avatar))and($user->avatar!=''))
                    {
                        echo $images_avatar.$user->avatar;
                    }
                    else
                    {
                        echo $default_user_avatar;
                    }
                    ?>">

                    <label class="search-label" for="user-avatar">Изменить аватар:</label>
                    <input class="user-input-ava w-input" id="user-avatar"  name="avatar" type="file">

                    <label class="search-label" for="password">пароль:</label>

                    <?php if(isset($error['password'])) {?>
                    <label class="error" for="password">пароли не совпадают:</label>
                    <?php }?>
                    <input class="user-input-ava w-input" maxlength="256" name="password1" type="password"
                           value="<?php echo $user->password; ?>">
                    <input class="user-input-ava w-input" maxlength="256" name="password2" type="password"
                           value="<?php echo $user->password; ?>">
                </div>
                <div class="w-col w-col-4">
                    <label class="search-label" for="fio">ФИО:</label>
                    <input required value="<?php echo $user->fio; ?>" class="w-input" id="fio" maxlength="256" name="fio" type="text">

                    <label class="search-label" for="otd">Отдел:</label>
                    <input value="<?php echo $user->otd; ?>"  class="w-input" id="otd" maxlength="256"  name="otd" type="text">

                    <label class="search-label" for="post">Должность:</label>
                    <input value="<?php echo $user->post; ?>"  class="w-input" id="post" maxlength="256" name="post" type="text">

                    <label class="search-label" for="phone">телефон:</label>
                    <input value="<?php echo $user->phone; ?>"  class="w-input" id="phone" maxlength="256" name="phone" type="text">
                </div>
                <div class="w-col w-col-4">
                    <label class="search-label" for="group">группа:</label>
                    <select class="w-select" id="group" name="group" required>

                        <?php foreach($groups as $group) {?>
                            <option <?php if ($group['id']==$user->group) echo 'selected' ?> value="<?php echo $group['id']; ?>"><?php echo $group['caption']; ?></option>
                        <?php }?>
                    </select>

                    <label class="search-label" for="group">задачи (+Ctrl):</label>
                    <select class="user-tascs w-select" id="field" multiple="multiple" name="tasks[]">
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