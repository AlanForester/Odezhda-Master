//retail order edit

function gridBox(id, grid, title){
    bootbox.dialog({
        message: grid,
        title: title,
        buttons: {
            /*success: {
             label: "Выбрать",
             className: "btn-small btn-success",
             callback: function() {

             }
             },*/
            cancel: {
                label: "Отмена",
                className: "btn-small btn-danger",
                callback: function() {

                }
            }
        }
    });
    //todo: сразу не срабатывает. возможно, потому, что grid в этот момент еще не отрисован.
    //позже переделаю
    setTimeout(function() {
        //console.log(jQuery("#"+id));
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
    }, 1000);
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
    /*$.fn.yiiGridView.update(
     "whgrid",
     {
     data:{
     "filters[group_id]":$("#filter_groups").val()
     }
     }
     )*/
}

function addRetailOrdersProduct(event, orderId, infoPath, editPath) {
    //var event=event||window.event;
    var target=event.target||event.srcElement;
    var productId = $(target).closest("tr").find("input[name='gridids[]']").val();
    //$("input[name='RetailOrders[customers_id]']").val(customerId);
    //$("table#yw2").hide();
    $.getJSON(infoPath, {
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
            '<tr class="'+newRowClass+'"><td class="checkbox-column"><input type="checkbox" name="gridids[]" value="'+newRowId+'" class="select-on-check">'
                + '<label><input type="checkbox" name="gridids[]" value="'+newRowId+'" class="select-on-check"><span class="lbl"></span></label>'
                + '</td><td><input type="hidden" name="RetailOrdersProducts['+newRowId+'][products_id]" value="'+json.catalog.id+'"><input type="hidden" name="RetailOrdersProducts['+newRowId+'][name]" value="'+json.catalog.name+'">'+json.catalog.name+'</td>'
                + '<td><input type="hidden" name="RetailOrdersProducts['+newRowId+'][model]" value="'+json.catalog.model+'">'+json.catalog.model+'</td>'
                + '<td><input type="hidden" name="RetailOrdersProducts['+newRowId+'][attributes][size]" value=""><a href="#" onclick="return false;" class="editable editable-click editable-empty">не задано</a></td>'
                + '<td><input type="hidden" name="RetailOrdersProducts['+newRowId+'][quantity]" value="1"><a href="#" onclick="return false;" class="editable editable-click editable-empty">не задано</a></td>'
                + '<td><input type="hidden" name="RetailOrdersProducts['+newRowId+'][price]" value="'+json.catalog.price+'">'+json.catalog.price+'</td>'
                + '<td width="50px" class="action-buttons"><a href="#" onclick="$(this).closest(\'tr\').remove(); return false;" rel="tooltip" title="" class="red bigger-130" data-original-title="Удалить"><i class="icon-trash"></i></a></td></tr>'
        );

        //var input = $("<input>", { type: "hidden", name: "mydata", value: "bla" }); $('#form1').append($(input));

        //console.log();
    });
    bootbox.hideAll();
}