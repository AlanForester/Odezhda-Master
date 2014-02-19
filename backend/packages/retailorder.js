//retail order edit

function showBootbox(title) {
    bootbox.dialog({
        message: '<div></div>',
        title: title,
        buttons: {
            success: {
                label: "ОК",
                className: "btn-small btn-success",
                callback: function() {
                    /*addRetailOrdersProduct(
                        productId,
                        orderId,
                        $(".bootbox-body input[name='ShopProduct[quantity]']").val(),  //quantity,
                        $(".bootbox-body select[name='ShopProduct[size]']").val(),  //size,
                        queuePath
                    );*/
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
            //gridBox("catalog_grid", data, "Выбор товара");
            $(".bootbox-body").html(data);
            registerGrid(id);

            /*
            //todo: сразу не срабатывает. возможно, потому, что grid в этот момент еще не отрисован.
            //позже переделаю
            setTimeout(function() {
                //console.log(jQuery("#"+id));
                registerGrid(id);
            }, 1000);*/
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
        //var button = $(".btn-info").length>0 ? $(".btn-info") : $("button[name=yt2]");
        //console.log(button);
        //$(button).before("<table id="yw2" class="detail-view table table-striped table-condensed"><tbody><tr class="odd"><th>ID</th><td>"+customerId+"</td></tr><tr class="even"><th>Имя</th><td>"+json.customer.customers_firstname+"</td></tr><tr class="odd"><th>Фамилия</th><td>"+json.customer.customers_lastname+"</td></tr><tr class="even"><th>E-mail</th><td>"+json.customer.customers_email_address+"</td></tr><tr class="odd"><th>Телефон</th><td>"+json.customer.customers_telephone+"</tbody></table>");
    });
    bootbox.hideAll();
    registerGrid('ropgrid');
}

function selectRetailOrdersProductOptions(event, orderId, optionsSelectionViewPath, queuePath) {
    //bootbox.hideAll();

    //var event=event||window.event;
    var target = event.target||event.srcElement,
        productId = $(target).closest("tr").find("input[name='gridids[]']").val();

    /*$.getJSON(infoPath, {
        id: productId
    }, function(json){
        if(json.catalog.products_options_values_id != null) {
            $.each(json.catalog.products_options_values_id, function( index, value ) {

            });
        }
    });*/

    $.ajax({
        url: optionsSelectionViewPath + productId,
        type: 'GET',
        //dataType : "json",
        data: {
            //productId: productId,
            //orderId: orderId
        },
        success: function (data, textStatus) {
            $(".bootbox-body").html(data);
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

            /*bootbox.dialog({
                message: data,
                title: 'Выбор параметров товара',
                buttons: {
                    success: {
                        label: "ОК",
                        className: "btn-small btn-success",
                        callback: function() {
                            addRetailOrdersProduct(
                                productId,
                                orderId,
                                $(".bootbox-body input[name='ShopProduct[quantity]']").val(),  //quantity,
                                $(".bootbox-body select[name='ShopProduct[size]']").val(),  //size,
                                queuePath
                            );
                        }
                    },
                    cancel: {
                        label: "Отмена",
                        className: "btn-small btn-danger",
                        callback: function() {

                        }
                    }
                }
            });*/
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
            //$("#ropgrid").html(data);
            registerGrid("ropgrid");
            jQuery("#ropgrid").yiiGridView("update");
        }
    });



    /*$.getJSON(infoPath, {
        id: productId
    }, function(json){
        var newRowClass = $("#ropgrid table tbody tr:last-child").hasClass("even") ? 'odd' : 'even';
        var emptyRow = $("#ropgrid table tbody tr td.empty");
        if(emptyRow.length>0)
            $(emptyRow).remove();

        //виртуальные (не сохраненные) товары обозначаются отрицательными ид до тех пор, пока не получат реальный ид
        var newRowId = -1;
        $("#ropgrid table tbody tr").each(function( index, element ) {
            var currentId = $(element).find("input[name='gridids[]']").val();
            newRowId = currentId <= newRowId ? currentId-1 : newRowId;
        });

        $("#ropgrid table tbody").append(
            '<tr class="'+newRowClass+'"><td class="checkbox-column">'
                + '<label><input type="checkbox" name="gridids[]" value="'+newRowId+'" class="select-on-check"><span class="lbl"></span></label>'
                + '</td><td><input type="hidden" name="RetailOrdersProducts['+newRowId+'][products_id]" value="'+json.catalog.id+'"><input type="hidden" name="RetailOrdersProducts['+newRowId+'][name]" value="'+json.catalog.name+'">'+json.catalog.name+'</td>'
                + '<td><input type="hidden" name="RetailOrdersProducts['+newRowId+'][model]" value="'+json.catalog.model+'">'+json.catalog.model+'</td>'
                + '<td><input type="hidden" name="RetailOrdersProducts['+newRowId+'][attributes][size]" value=""><a href="#" onclick="return false;" class="editable editable-click editable-empty">не задано</a></td>'
                + '<td><input type="hidden" name="RetailOrdersProducts['+newRowId+'][quantity]" value="1"><a href="#" onclick="return false;" class="editable editable-click editable-empty">не задано</a></td>'
                + '<td><input type="hidden" name="RetailOrdersProducts['+newRowId+'][price]" value="'+json.catalog.price+'">'+json.catalog.price+'</td>'
                + '<td width="50px" class="action-buttons"><a href="#" onclick="$(this).closest(\'tr\').remove(); return false;" rel="tooltip" title="" class="red bigger-130" data-original-title="Удалить"><i class="icon-trash"></i></a></td></tr>'
        );
    });*/
    bootbox.hideAll();
    //registerGrid('ropgrid');
    //jQuery("#ropgrid").yiiGridView("update");
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
            /*(function(){
             $("#"+id).trigger("ajaxUpdateTree");
             }).apply(this, arguments);*/
        }
    });
}
