<div class="center-container"><h1 class="main-h1 user-head">Новая задача:</h1>
    <div class="w-form">
        <form class="w-clearfix" method="post">
            <input type="hidden" name="action" value="add" >
            <input class="w-input" data-name="task-caption"
                                   id="task-caption"
                                   maxlength="256"
                                   name="caption"
                                   placeholder="введите название задачи"
                                   required="required"
                                   type="text">
            <div class="task-users-select">
                <?php  foreach($users as $user)
                {?>
                    <div class="msg-1-user tak-select1">
                        <div class="msg1-name"><?php echo($user['fio']);?></div>
                        <img class="msg1-user-img" src= "https://daks2k3a4ib2z.cloudfront.net/578736a1ccda65ac618bae8f/57875061ccda65ac618be5b5_support-128.png">
                        <div class="msg-u-doljnst"><?php echo($user['post']);?></div>
                        <div class="msg-user-phone"><?php echo($user['phone']);?></div>
                        <div class="userselect-c w-checkbox">
                            <div class="userselect-c w-checkbox">
                                <input class="user-check w-checkbox-input"
                                       id="user_<?php echo($user["id"]);?>"
                                       name="users[]"
                                       value="<?php echo($user["id"]);?>"
                                       type="checkbox">
                                <label class="task-select-text-c w-form-label" for="user">Выбрать</label>
                            </div>
                        </div>
                    </div>
                <?php }?>
            </div>
            <input class="save-button w-button" data-wait="Please wait..." type="submit" value="Сохранить"></form>

    </div>
</div>