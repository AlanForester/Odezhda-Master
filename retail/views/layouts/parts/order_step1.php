
    <div class="box-modal" id="order">
        <div class="modal-login-left modal-reg">
            <p>Перепроверьте, пожалуйста, ваш телефон и выберите способ доставки</p>
            <form id="order_step1" method="post" action="javascript:void(null);">
                <input id="phone" type="text" placeholder="Телефон" name="phone" value="<?=$customer->phone?>" required /><br />
                <span class="delivery"><input type="radio" name="delivery" value="post" checked required /><span>Доставка почтой России</span></span>
                <span class="delivery"><input type="radio" name="delivery" value="pickup" required /><span>Самовывоз</span></span>
                <select id="pickup_method" style="display: none">
                    <?php foreach($deliveries as $delivery) {?>
                    <option><?=$delivery->name?></option>
                    <?php }?>
                </select>
                <button type="submit" id="order_submit">Продолжить</button>
            </form>
         </div>

