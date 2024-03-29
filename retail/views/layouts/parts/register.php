<?php
Yii::app()->clientScript->registerPackage('index');
?>
<div class="box-modal" id="registration">
    <div class="modal-login-left modal-reg">
        <p>Регистрация</p>

        <form id="registr" method="post" action="javascript:void(null);">
            <div class="reg-input">
            </div>
            <div class="left-info">
                <input type="text" id="email" name="RetailRegisterForm[email]" placeholder="E-mail" class="required"/>
                <input type="text" id="phone" name="RetailRegisterForm[phone]" placeholder="Мобильный" class="required"/>
                <h6>Для sms-уведомлений о состоянии заказа и связи с вами, когда вы заказываете доставку. Мы не берем за
                    это денег, не рассылаем спам и не раскрываем ваш номер сторонним организациям.</h6>
                <span id="reg_error"></span>
            </div>
            <div class="right-info">
                <div class="remember">
                    <p><input name="RetailRegisterForm[notes_email]" type="checkbox" value="1" checked="checked"/><span>Я хочу получать уведомления по электронной почте</span>
                    </p>

                    <p><input name="RetailRegisterForm[notes_sms]" type="checkbox" value="1" checked="checked"/><span>Я хочу получать sms-уведомления</span>
                    </p>

                    <p><input name="RetailRegisterForm[rememberMe]" type="checkbox" value="1" checked="checked"/><span>Запомнить меня</span>
                    </p>
                </div>
                <h6>чтобы автоматически входить на сайт при каждом посещении</h6>
                <h6>Lapana.ru не передает и не продает персональную информацию. Нажимая кнопку "РЕГИСТРАЦИЯ" Вы
                    соглашаетесь на обработку Ваших персональных данных в соответствии с ФЗ РФ от 27.07.2006 г. № 152-ФЗ
                    (в ред. 25.07.2011 г.) "О персональных данных", а так же с нашей Политикой конфиденциальности и
                    условиями договора публичной оферты.</h6>
                <button type="submit" id="reg_submit">Регистрация</button>
                <button type="submit" id="reg_submit_process">Отправка запроса <img src="/img/loading.gif" /></button>
            </div>
        </form>
    </div>
</div>