<div class="breadcrumbs">
    <a class="bread-link" href="<?php echo site_url("couses"); ?>">Курсы</a> &gt;&gt;
    <a class="bread-link" href="<?php echo site_url("courses/".$course['id']); ?>"><?php echo $course['caption']; ?></a> &gt;&gt;
    <a class="bread-link" href="<?php echo site_url("courses/".$course['id']."/".$lecture['id']); ?>">Редактирование лекции</a>
</div>

<div class="center-container">
    <h1 class="lecture-title main-h1">
        <em>Редактироавние лекции</em>
    </h1>

    <div class="w-form">
        <form class="w-clearfix" method="post" enctype="multipart/form-data">

            <input type="hidden" name="course_id" value="<?php echo $course['id']; ?>">
            <input type="hidden" name="lecture_id" value="<?php echo $lecture['id']; ?>">
            <input type="hidden" name="action" value="lecture_update">
            <label for="name">Название лекции:</label>
            <input class="w-input"
                   value="<?php echo $lecture['caption']; ?>"
                   id="caption" maxlength="256" name="caption" type="text">

            <label for="description">Порядок в списке:</label>
            <input class="w-input" id="order_number"
                   value="<?php echo $lecture['order_number']; ?>"
                   maxlength="256" name="order_number" type="number">

            <label for="date_start">Дата начала:</label>
            <input class="w-input hasDatepicker"
                value="<?php echo $lecture['date_start']; ?>"
                   id="date_start" maxlength="256" name="date_start" required>

            <label for="video">Видео:</label>
            <input class="w-input" id="video" maxlength="256" name="video"  type="file">

            <label for="description">Материал:</label>
            <textarea class="lect-text-arrea w-input" id="description" maxlength="5000" name="description"><?php echo $lecture['description']; ?></textarea>



            <div class="lect-video"></div>

            <input class="user-button w-button" type="submit" value="Сохранить">
        </form>

    </div>



    <div class="test-capt w-clearfix">Тест: <span class="edit-test-button">добавить тест</span></div>
    <div class="tests-admin">
        <div class="test-item">
            <div class="test-question w-clearfix"><span class="w-clearfix test-edit"><span class="test-edit">Редактировать</span></span><strong>Вопрос
                    1:</strong> Печальный Демон, дух изгнанья,Летал над грешною землей,И лучших дней
                воспоминаньяПред ним теснилися толпой;Тех дней, когда в жилище светаБлистал он, чистый
                херувим,Когда бегущая кометаУлыбкой ласковой приветаЛюбила поменяться с ним,Когда сквозь вечные
                туманы,Познанья жадный, он следилКочующие караваныВ пространстве брошенных светил;Когда он верил
                и любил,Счастливый первенец творенья!Не знал ни злобы, ни сомненья,
            </div>
            <div class="test-answers">
                <div class="row-answers w-row">
                    <div class="w-col w-col-3">
                        <div class="answer-item">
                            <div class="answer-capt">Ответ 1:</div>
                            <div class="answer good">Правильный ответ</div>
                        </div>
                    </div>
                    <div class="w-col w-col-3">
                        <div class="answer-item">
                            <div class="answer-capt">Ответ 2:</div>
                            <div class="answer">не правильный ответ</div>
                        </div>
                    </div>
                    <div class="w-col w-col-3">
                        <div class="answer-item">
                            <div class="answer-capt">Ответ 3:</div>
                            <div class="answer">не правильный ответ</div>
                        </div>
                    </div>
                    <div class="w-col w-col-3">
                        <div class="answer-item">
                            <div class="answer-capt">Ответ 4:</div>
                            <div class="answer">не правильный ответ</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="test-item">
            <div class="test-question w-clearfix"><span class="w-clearfix test-edit"><span class="test-edit">Редактировать</span></span><strong>Вопрос
                    1:</strong> Печальный Демон, дух изгнанья,Летал над грешною землей,И лучших дней
                воспоминаньяПред ним теснилися толпой;Тех дней, когда в жилище светаБлистал он, чистый
                херувим,Когда бегущая кометаУлыбкой ласковой приветаЛюбила поменяться с ним,Когда сквозь вечные
                туманы,Познанья жадный, он следилКочующие караваныВ пространстве брошенных светил;Когда он верил
                и любил,Счастливый первенец творенья!Не знал ни злобы, ни сомненья,
            </div>
            <div class="test-answers">
                <div class="row-answers w-row">
                    <div class="w-col w-col-3">
                        <div class="answer-item">
                            <div class="answer-capt">Ответ 1:</div>
                            <div class="answer good">Правильный ответ</div>
                        </div>
                    </div>
                    <div class="w-col w-col-3">
                        <div class="answer-item">
                            <div class="answer-capt">Ответ 2:</div>
                            <div class="answer">не правильный ответ</div>
                        </div>
                    </div>
                    <div class="w-col w-col-3">
                        <div class="answer-item">
                            <div class="answer-capt">Ответ 3:</div>
                            <div class="answer">не правильный ответ</div>
                        </div>
                    </div>
                    <div class="w-col w-col-3">
                        <div class="answer-item">
                            <div class="answer-capt">Ответ 4:</div>
                            <div class="answer">не правильный ответ</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="test-item">
            <div class="test-question w-clearfix"><span class="w-clearfix test-edit"><span class="test-edit">Редактировать</span></span><strong>Вопрос
                    1:</strong> Печальный Демон, дух изгнанья,Летал над грешною землей,И лучших дней
                воспоминаньяПред ним теснилися толпой;Тех дней, когда в жилище светаБлистал он, чистый
                херувим,Когда бегущая кометаУлыбкой ласковой приветаЛюбила поменяться с ним,Когда сквозь вечные
                туманы,Познанья жадный, он следилКочующие караваныВ пространстве брошенных светил;Когда он верил
                и любил,Счастливый первенец творенья!Не знал ни злобы, ни сомненья,
            </div>
            <div class="test-answers">
                <div class="row-answers w-row">
                    <div class="w-col w-col-3">
                        <div class="answer-item">
                            <div class="answer-capt">Ответ 1:</div>
                            <div class="answer good">Правильный ответ</div>
                        </div>
                    </div>
                    <div class="w-col w-col-3">
                        <div class="answer-item">
                            <div class="answer-capt">Ответ 2:</div>
                            <div class="answer">не правильный ответ</div>
                        </div>
                    </div>
                    <div class="w-col w-col-3">
                        <div class="answer-item"></div>
                    </div>
                    <div class="w-col w-col-3">
                        <div class="answer-item"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="test-item">
            <div class="test-question w-clearfix"><span class="w-clearfix test-edit"><span class="test-edit">Редактировать</span></span><strong>Вопрос
                    1:</strong> Печальный Демон, дух изгнанья,Летал над грешною землей,И лучших дней
                воспоминаньяПред ним теснилися толпой;Тех дней, когда в жилище светаБлистал он, чистый
                херувим,Когда бегущая кометаУлыбкой ласковой приветаЛюбила поменяться с ним,Когда сквозь вечные
                туманы,Познанья жадный, он следилКочующие караваныВ пространстве брошенных светил;Когда он верил
                и любил,Счастливый первенец творенья!Не знал ни злобы, ни сомненья,
            </div>
            <div class="test-answers">
                <div class="row-answers w-row">
                    <div class="w-col w-col-3">
                        <div class="answer-item">
                            <div class="answer-capt">Ответ 1:</div>
                            <div class="answer good">Правильный ответ</div>
                        </div>
                    </div>
                    <div class="w-col w-col-3">
                        <div class="answer-item">
                            <div class="answer-capt">Ответ 2:</div>
                            <div class="answer">не правильный ответ</div>
                        </div>
                    </div>
                    <div class="w-col w-col-3">
                        <div class="answer-item">
                            <div class="answer-capt">Ответ 3:</div>
                            <div class="answer">не правильный ответ</div>
                        </div>
                    </div>
                    <div class="w-col w-col-3">
                        <div class="answer-item">
                            <div class="answer-capt">Ответ 4:</div>
                            <div class="answer">не правильный ответ</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="test-item">
            <div class="test-question w-clearfix"><span class="w-clearfix test-edit"><span class="test-edit">Редактировать</span></span><strong>Вопрос
                    1:</strong> Печальный Демон, дух изгнанья,Летал над грешною землей,И лучших дней
                воспоминаньяПред ним теснилися толпой;Тех дней, когда в жилище светаБлистал он, чистый
                херувим,Когда бегущая кометаУлыбкой ласковой приветаЛюбила поменяться с ним,Когда сквозь вечные
                туманы,Познанья жадный, он следилКочующие караваныВ пространстве брошенных светил;Когда он верил
                и любил,Счастливый первенец творенья!Не знал ни злобы, ни сомненья,
            </div>
            <div class="test-answers">
                <div class="row-answers w-row">
                    <div class="w-col w-col-3">
                        <div class="answer-item">
                            <div class="answer-capt">Ответ 1:</div>
                            <div class="answer good">Правильный ответ</div>
                        </div>
                    </div>
                    <div class="w-col w-col-3">
                        <div class="answer-item">
                            <div class="answer-capt">Ответ 2:</div>
                            <div class="answer">не правильный ответ</div>
                        </div>
                    </div>
                    <div class="w-col w-col-3">
                        <div class="answer-item">
                            <div class="answer-capt">Ответ 3:</div>
                            <div class="answer">не правильный ответ</div>
                        </div>
                    </div>
                    <div class="w-col w-col-3">
                        <div class="answer-item">
                            <div class="answer-capt">Ответ 4:</div>
                            <div class="answer">не правильный ответ</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
