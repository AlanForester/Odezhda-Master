
    <div class="box-modal" id="order">
        <div class="modal-login-left modal-reg">
            <p>Перепроверьте, пожалуйста, ваш телефон и выберите способ доставки</p>
            <form id="order_step1" method="post" action="javascript:void(null);">
                <input id="phone" type="text" placeholder="Телефон" name="order[phone]" value="<?=$customer->phone?>" required /><br />
                <span class="delivery"><input type="radio" name="order[delivery]" value="post" id="order_delivery_1" checked required /><label for="order_delivery_1">Доставка почтой России</label></span>
                <span class="delivery"><input type="radio" name="order[delivery]" value="pickup" id="order_delivery_2" required /><label for="order_delivery_2">Самовывоз</label></span>
                <select id="pickup_method" style="display: none" name="order[pickup_method]">
                    <?php foreach($deliveries as $delivery) {?>
                    <option value="<?=$delivery->id?>"><?=$delivery->name?></option>
                    <?php }?>
                </select>
                <button type="submit" id="order_submit">Продолжить</button>
            </form>
         </div>
