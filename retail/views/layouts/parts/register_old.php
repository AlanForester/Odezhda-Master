<div class="g-hidden">
    <div class="box-modal modal-reg" id="exampleModal2">
        <div class="box-modal_close arcticmodal-close modal-reg">X</div>
        <div class="modal-login-left modal-reg">
            <p>Регистрация</p>
            <form  method="post" action="/site/registration">
                <div class="reg-input">
                    <input type="text" name="RetailRegisterForm[name_surname]" placeholder="Имя, Фамилия*" />
                    <input type="text" name="RetailRegisterForm[email]" placeholder="E-mail*" />
                </div>
                <div class="left-info">
                    <div class="date-birth">
                        <p>Дата рождения</p>
                        <select id="day" name="RetailRegisterForm[day]" class="intro-select-day">
                            <?php
                                $days='';
                                for ($day=1; $day<=31; $day++){
                                    $days.='<option value="'.$day.'">'.$day.'</option>';
                                }
                                echo $days;
                            ?>
                        </select>
                        <select id="month" name="RetailRegisterForm[month]" class="intro-select-month" onChange="rewrite_days();">
                            <option value="1" selected>январь</option>
                            <option value="2">февраль</option>
                            <option value="3">март</option>
                            <option value="4">апрель</option>
                            <option value="5">май</option>
                            <option value="6">июнь</option>
                            <option value="7">июль</option>
                            <option value="8">август</option>
                            <option value="9">сентябрь</option>
                            <option value="10">октябрь</option>
                            <option value="11">ноябрь</option>
                            <option value="12">декабрь</option>
                        </select>
                        <select id="year" name="RetailRegisterForm[year]" class="intro-select-year" onChange="rewrite_days();">
                            <?php
                            $years='';
                            for ($year=1930; $year<= date('Y') - 14; $year++){
                                $years.='<option value="'.$year.'">'.$year.'</option>';
                            }
                            echo $years;
                            ?>
                        </select>
                        <h6>Подарки и сюрпризы на день рождения от Lapana.ru</h6>
                    </div>
                    <input type="text" name="RetailRegisterForm[phone]" placeholder="Мобильный" />
                    <h6>Для sms-уведомлений о состоянии заказа и связи с вами, когда вы заказываете доставку. Мы не берем за это денег, не рассылаем спам и не раскрываем ваш номер сторонним организациям.</h6>
                    <input type="text" name="RetailRegisterForm[promo]" placeholder="Промо-код" />
                    <h6>Вводится при регистрации по приглашению от действующего участника программы Lapa-bonus</h6>
                </div>
                <div class="right-info">
                    <div class="remember">
                        <p><input name="RetailRegisterForm[notes_email]" type="checkbox" value="1" /><span>Я хочу получать уведомления по электронной почте</span></p>
                        <p><input name="RetailRegisterForm[notes_sms]" type="checkbox" value="1" /><span>Я хочу получать sms-уведомления</span></p>
                        <p><input name="RetailRegisterForm[rememberMe]" type="checkbox" value="1" /><span>Запомнить меня</span></p>
                    </div>
                    <h6>чтобы автоматически входить на сайт при каждом посещении</h6>
                    <h6>Lapana.ru не передает и не продает персональную информацию. Нажимая кнопку "РЕГИСТРАЦИЯ" Вы соглашаетесь на обработку Ваших персональных данных в соответствии с ФЗ РФ от 27.07.2006 г. № 152-ФЗ (в ред. 25.07.2011 г.) "О персональных данных", а так же с нашей Политикой конфиденциальности и условиями договора публичной оферты.</h6>
                    <button type="submit">Регистрация</button>
                </div>
            </form>
        </div>
    </div>
</div>