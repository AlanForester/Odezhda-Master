//retail order edit

function showBootbox(title) {
    bootbox.dialog({
        message: '<div class="ajax-loading"></div>',
        title: title,
        buttons: {
            success: {
                label: "ОК",
                className: "btn-small btn-success",
                callback: function() {

                }
            },
            cancel: {
                label: "Отмена",
                className: "btn-small btn-danger",
                callback: function() {

                }
            }
        }
    });
}

function loadGrid(id, url){
    $.ajax({
        url: url,
        //?ajax=catalog_grid&from=bootbox",
        dataType : "html",
        success: function (data, textStatus) {
            $(".bootbox-body").html(data);
            registerGrid(id);
        }
    });
}

function selectCustomer(event, orderId, infoPath, editPath) {
    //var event=event||window.event;
    var target=event.target||event.srcElement;
    var customerId = $(target).closest("tr").find("input[name='gridids[]']").val();
    $("input[name='RetailOrders[customers_id]']").val(customerId);
    $("table#yw2").hide();
    $.getJSON(infoPath, {
        id: customerId
    }, function(json){
        $("input[name='RetailOrders[customers_name]']").val(json.customer.customers_firstname + " " + json.customer.customers_lastname);
        $("input[name='RetailOrders[customers_city]']").val(json.default_address.entry_city==null ? "-" : json.default_address.entry_city);
        $("input[name='RetailOrders[customers_telephone]']").val(json.customer.customers_telephone);
        $("table#yw2").remove();
        $("#customer_info").html(
            '<table id="yw2" class="detail-view table table-striped table-condensed"><tbody><tr class="odd"><th>ID</th><td>'+customerId+'</td></tr><tr class="even"><th>Имя</th><td>'+json.customer.customers_firstname+'</td></tr><tr class="odd"><th>Фамилия</th><td>'+json.customer.customers_lastname+'</td></tr><tr class="even"><th>E-mail</th><td>'+json.customer.customers_email_address+'</td></tr><tr class="odd"><th>Телефон</th><td>'+json.customer.customers_telephone+'</tbody></table>'
                + '<a href="' + editPath + customerId + '/?from=retail_order&fromId=' + orderId + '" class="btn-small btn btn-info" buttontype="link"><i class="icon-user"></i> Редактировать</a>'
        );
    });
    bootbox.hideAll();
    registerGrid('ropgrid');
}

function selectRetailOrdersProductOptions(event, orderId, optionsSelectionViewPath, queuePath) {
    //bootbox.hideAll();

    //var event=event||window.event;
    var target = event.target||event.srcElement,
        productId = $(target).closest("tr").find("input[name='gridids[]']").val();

    $(".bootbox-body").html('<div class="ajax-loading"></div>');

    $.ajax({
        url: optionsSelectionViewPath + productId,
        type: 'GET',
        //dataType : "json",
        data: {
            //productId: productId,
            //orderId: orderId
        },
        success: function (data, textStatus) {
            $(".bootbox.modal").css({width:'620px',top:'10%',left:'50%'});
            $(".bootbox.modal .bootbox-body").css({height:'200px'}).html(data);
            //registerGrid(id);
            $(".bootbox .modal-footer .btn-success").show()
                .bind( "click", function() {
                    addRetailOrdersProduct(
                        productId,
                        orderId,
                        $(".bootbox-body input[name='ShopProduct[quantity]']").val(),  //quantity,
                        $(".bootbox-body select[name='ShopProduct[size]']").val(),  //size,
                        queuePath
                    );
                });

        }
    });

}

function addRetailOrdersProduct(productId, orderId, quantity, size, queuePath) {
    $.ajax({
        url: queuePath,
        type: 'POST',
        //dataType : "json",
        data: {
            'RetailOrdersProducts[productId]': productId,
            'RetailOrdersProducts[orderId]': orderId,
            'RetailOrdersProducts[quantity]': quantity,
            'RetailOrdersProducts[size]': size
        },
        success: function (data, textStatus) {
            registerGrid("ropgrid");
            //$.fn.yiiGridView.update("ropgrid", {url:'', data:{}});
            $.fn.yiiGridView.update("ropgrid");
        }
    });

    bootbox.hideAll();
}

function registerGrid(id) {
    jQuery("#"+id).yiiGridView({
        "ajaxUpdate":[id],
        "ajaxVar":"ajax",
        "pagerClass":"pagination",
        "loadingClass":"grid-view-loading",
        "filterClass":"filters",
        "tableClass":"table-bordered items table table-striped table-bordered",
        "selectableRows":2,
        "enableHistory":false,
        "updateSelector":"{page}, {sort}",
        "filterSelector":"{filter}",
        "pageVar":"Customer_page",
        "afterAjaxUpdate": function(id, data) {
            $("#"+id).trigger("ajaxUpdate.editable");
            if(id == 'ropgrid')
                $("#ropgrid div.keys").attr("title", "");    //очистить параметры предыдущего запроса
            /*(function(){
             $("#"+id).trigger("ajaxUpdateTree");
             }).apply(this, arguments);*/
        }
    });
}
