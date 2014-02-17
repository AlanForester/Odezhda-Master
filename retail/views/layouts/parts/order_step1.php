
    <div class="box-modal" id="order">
        <div class="modal-login-left modal-reg">
            <p>Перепроверьте, пожалуйста, ваш телефон и укажите способ доставки</p>
<!--            <form id="log" method="post" action="javascript:void(null);">-->
                <input id="phone" type="text" placeholder="Телефон" name="phone" value="<?=$customer->phone?>"/><br />
                <span class="delivery"><input type="radio" name="delivery" value="post" checked/><span>Доставка почтой России</span></span>
                <span class="delivery"><input type="radio" name="delivery" value="pickup"/><span>Самовывоз</span></span>
                <select id="pickup_method">
                    <option selected>Доставка почт Россииой</option>
                    <option>Самовывоз</option>
                </select>
                <button type="submit" id="login_submit">Продолжить</button>
<!--            </form>-->
         </div>

