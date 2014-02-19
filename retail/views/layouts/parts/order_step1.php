
    <div class="box-modal" id="order">
        <div class="modal-login-left modal-reg">
            <p style="text-align: center">Перепроверьте, пожалуйста, ваш телефон и выберите способ доставки</p>
            <form id="order_step1" method="post" action="javascript:void(null);">
                <br />
                <table width="100%" cellspacing="0" cellpadding="5">
                    <tr>
                        <td width="50%" valign="center">
                            <input id="phone" type="text" placeholder="Телефон" name="order[phone]" value="<?=$customer->phone?>" required />
                        </td>
                    </tr>
                    <tr>
                         <td width="50%" valign="center">
                                <select id="pickup_method" style="width: auto; height: 50px"  name="order[pickup_method]" required>
                                    <?php foreach($deliveries as $delivery) {?>
                                        <option style="text-align: center" value="<?=$delivery->id?>"><?=$delivery->name?></option>
                                    <?php }?>
                                </select>
                            </td>
                    </tr>
                </table>
                <button type="submit" id="order_submit">Продолжить</button>
            </form>
         </div>

