<div class="center-container">
    <h1 class="main-h1 user-head">
       Редактирование задачи:
    </h1>
    <div class="w-form">
        <form class="w-clearfix" method="post">
            <input name="action" value="task-update" type="hidden">
            <input name="task_id" value="<?php echo $task_id; ?>" type="hidden">
            <input class="w-input"  value="<?php echo($task["caption"]);?>"
                                    maxlength="256"
                                    name="task-caption"
                                    placeholder="введите название задачи"
                                    required="required"
                                    type="text">

            <?php  foreach($users as $user)
            {?>
                <div class="task-users-select">
                    <div class="msg-1-user tak-select">
                        <div class="msg1-name"> <?php echo($user["fio"]); ?>  </div>
                        <img class="msg1-user-img" src= "https://daks2k3a4ib2z.cloudfront.net/578736a1ccda65ac618bae8f/57875061ccda65ac618be5b5_support-128.png">
                        <div class="msg-u-doljnst"><?php echo($user["post"]);?></div>
                        <div class="msg-user-phone"><?php echo($user["phone"]);?></div>
                        <div class="userselect-c w-checkbox">
                            <input class="user-check w-checkbox-input"
                                   <?php if (in_array($user["id"], $task_users)) { echo "checked"; } ?>

                                   id="user_<?php echo($user["id"]);?>"
                                   name="users[]"
                                   value="<?php echo($user["id"]);?>"
                                   type="checkbox">
                            <label class="task-select-text-c w-form-label" for="user">Выбрать</label>
                        </div>
                    </div>
            <?php }?>
                </div>
            <input class="save-button w-button" data-wait="Please wait..." type="submit" value="Сохранить">
        </form>

    </div>
</div>