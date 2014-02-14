<?php
//todo откорректировать
// таблица
$this->widget(
    'backend.widgets.CompactGrid',
    [

        'pageSize' => 10,   //$criteria['page_size'],

        'dataProvider' => $gridDataProvider,

        'gridColumns' => [
            [
                'name' => 'firstname',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                    'onClick' => 'js: (function(){
                        //var event=event||window.event;
                        var target=event.target||event.srcElement;
                        var customerId = $(target).closest("tr").find("input[name=\'gridids[]\']").val();
                        $("input[name=\'RetailOrders[customers_id]\']").val(customerId);
                        $("table#yw2").hide();
                        $.getJSON("' . Yii::app()->createUrl('/customers/info/') . '", {
                            id: customerId
                        }, function(json){
                            $("input[name=\'RetailOrders[customers_name]\']").val(json.customer.customers_firstname + " " + json.customer.customers_lastname);
                            $("input[name=\'RetailOrders[customers_city]\']").val(json.default_address.entry_city==null ? "-" : json.default_address.entry_city);
                            $("input[name=\'RetailOrders[customers_telephone]\']").val(json.customer.customers_telephone);
                            $("table#yw2").remove();
                            $("#customer_info").html(
                                "<table id=\"yw2\" class=\"detail-view table table-striped table-condensed\"><tbody><tr class=\"odd\"><th>ID</th><td>"+customerId+"</td></tr><tr class=\"even\"><th>Имя</th><td>"+json.customer.customers_firstname+"</td></tr><tr class=\"odd\"><th>Фамилия</th><td>"+json.customer.customers_lastname+"</td></tr><tr class=\"even\"><th>E-mail</th><td>"+json.customer.customers_email_address+"</td></tr><tr class=\"odd\"><th>Телефон</th><td>"+json.customer.customers_telephone+"</tbody></table>"
                                + "<a href=\"' . Yii::app()->createUrl('/customers/edit/') . '"+customerId+"\" class=\"btn-small btn btn-info\" buttontype=\"link\"><i class=\"icon-user\"></i> Редактировать</a>"
                            );
                            //var button = $(".btn-info").length>0 ? $(".btn-info") : $("button[name=yt2]");
                            //console.log(button);
                            //$(button).before("<table id=\"yw2\" class=\"detail-view table table-striped table-condensed\"><tbody><tr class=\"odd\"><th>ID</th><td>"+customerId+"</td></tr><tr class=\"even\"><th>Имя</th><td>"+json.customer.customers_firstname+"</td></tr><tr class=\"odd\"><th>Фамилия</th><td>"+json.customer.customers_lastname+"</td></tr><tr class=\"even\"><th>E-mail</th><td>"+json.customer.customers_email_address+"</td></tr><tr class=\"odd\"><th>Телефон</th><td>"+json.customer.customers_telephone+"</tbody></table>");
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
                    })()',
                    //'class' => 'clickable-el',
                ],
            ],
            [
                'name' => 'lastname',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                    'onClick' => 'js: (function(){
                        //var event=event||window.event;
                        var target=event.target||event.srcElement;
                        var customerId = $(target).closest("tr").find("input[name=\'gridids[]\']").val();
                        $("input[name=\'RetailOrders[customers_id]\']").val(customerId);
                        $("table#yw2").hide();
                        $.getJSON("' . Yii::app()->createUrl('/customers/info/') . '", {
                            id: customerId
                        }, function(json){
                            $("input[name=\'RetailOrders[customers_name]\']").val(json.customer.customers_firstname + " " + json.customer.customers_lastname);
                            $("input[name=\'RetailOrders[customers_city]\']").val(json.default_address.entry_city==null ? "-" : json.default_address.entry_city);
                            $("input[name=\'RetailOrders[customers_telephone]\']").val(json.customer.customers_telephone);
                            $("table#yw2").remove();
                            $("#customer_info").html(
                                "<table id=\"yw2\" class=\"detail-view table table-striped table-condensed\"><tbody><tr class=\"odd\"><th>ID</th><td>"+customerId+"</td></tr><tr class=\"even\"><th>Имя</th><td>"+json.customer.customers_firstname+"</td></tr><tr class=\"odd\"><th>Фамилия</th><td>"+json.customer.customers_lastname+"</td></tr><tr class=\"even\"><th>E-mail</th><td>"+json.customer.customers_email_address+"</td></tr><tr class=\"odd\"><th>Телефон</th><td>"+json.customer.customers_telephone+"</tbody></table>"
                                + "<a href=\"' . Yii::app()->createUrl('/customers/edit/') . '"+customerId+"\" class=\"btn-small btn btn-info\" buttontype=\"link\"><i class=\"icon-user\"></i> Редактировать</a>"
                            );
                        });
                        bootbox.hideAll();
                    })()',
                ],
            ],
            [
                'name' => 'email',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                    'onClick' => 'js: (function(){
                        //var event=event||window.event;
                        var target=event.target||event.srcElement;
                        var customerId = $(target).closest("tr").find("input[name=\'gridids[]\']").val();
                        $("input[name=\'RetailOrders[customers_id]\']").val(customerId);
                        $("table#yw2").hide();
                        $.getJSON("' . Yii::app()->createUrl('/customers/info/') . '", {
                            id: customerId
                        }, function(json){
                            $("input[name=\'RetailOrders[customers_name]\']").val(json.customer.customers_firstname + " " + json.customer.customers_lastname);
                            $("input[name=\'RetailOrders[customers_city]\']").val(json.default_address.entry_city==null ? "-" : json.default_address.entry_city);
                            $("input[name=\'RetailOrders[customers_telephone]\']").val(json.customer.customers_telephone);
                            $("table#yw2").remove();
                            $("#customer_info").html(
                                "<table id=\"yw2\" class=\"detail-view table table-striped table-condensed\"><tbody><tr class=\"odd\"><th>ID</th><td>"+customerId+"</td></tr><tr class=\"even\"><th>Имя</th><td>"+json.customer.customers_firstname+"</td></tr><tr class=\"odd\"><th>Фамилия</th><td>"+json.customer.customers_lastname+"</td></tr><tr class=\"even\"><th>E-mail</th><td>"+json.customer.customers_email_address+"</td></tr><tr class=\"odd\"><th>Телефон</th><td>"+json.customer.customers_telephone+"</tbody></table>"
                                + "<a href=\"' . Yii::app()->createUrl('/customers/edit/') . '"+customerId+"\" class=\"btn-small btn btn-info\" buttontype=\"link\"><i class=\"icon-user\"></i> Редактировать</a>"
                            );
                        });
                        bootbox.hideAll();
                    })()',
                ],
            ],
            [
                'name' => 'phone',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                    'onClick' => 'js: (function(){
                        //var event=event||window.event;
                        var target=event.target||event.srcElement;
                        var customerId = $(target).closest("tr").find("input[name=\'gridids[]\']").val();
                        $("input[name=\'RetailOrders[customers_id]\']").val(customerId);
                        $("table#yw2").hide();
                        $.getJSON("' . Yii::app()->createUrl('/customers/info/') . '", {
                            id: customerId
                        }, function(json){
                            $("input[name=\'RetailOrders[customers_name]\']").val(json.customer.customers_firstname + " " + json.customer.customers_lastname);
                            $("input[name=\'RetailOrders[customers_city]\']").val(json.default_address.entry_city==null ? "-" : json.default_address.entry_city);
                            $("input[name=\'RetailOrders[customers_telephone]\']").val(json.customer.customers_telephone);
                            $("table#yw2").remove();
                            $("#customer_info").html(
                                "<table id=\"yw2\" class=\"detail-view table table-striped table-condensed\"><tbody><tr class=\"odd\"><th>ID</th><td>"+customerId+"</td></tr><tr class=\"even\"><th>Имя</th><td>"+json.customer.customers_firstname+"</td></tr><tr class=\"odd\"><th>Фамилия</th><td>"+json.customer.customers_lastname+"</td></tr><tr class=\"even\"><th>E-mail</th><td>"+json.customer.customers_email_address+"</td></tr><tr class=\"odd\"><th>Телефон</th><td>"+json.customer.customers_telephone+"</tbody></table>"
                                + "<a href=\"' . Yii::app()->createUrl('/customers/edit/') . '"+customerId+"\" class=\"btn-small btn btn-info\" buttontype=\"link\"><i class=\"icon-user\"></i> Редактировать</a>"
                            );
                        });
                        bootbox.hideAll();
                    })()',
                ],
            ],
            [
                'name' => 'id',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                    'onClick' => 'js: (function(){
                        //var event=event||window.event;
                        var target=event.target||event.srcElement;
                        var customerId = $(target).closest("tr").find("input[name=\'gridids[]\']").val();
                        $("input[name=\'RetailOrders[customers_id]\']").val(customerId);
                        $.getJSON("' . Yii::app()->createUrl('/customers/info/') . '", {
                            id: customerId
                        }, function(json){
                            $("input[name=\'RetailOrders[customers_name]\']").val(json.customer.customers_firstname + " " + json.customer.customers_lastname);
                            $("input[name=\'RetailOrders[customers_city]\']").val(json.default_address.entry_city==null ? "-" : json.default_address.entry_city);
                            $("input[name=\'RetailOrders[customers_telephone]\']").val(json.customer.customers_telephone);
                            $("table#yw2").remove();
                            $("#customer_info").html(
                                "<table id=\"yw2\" class=\"detail-view table table-striped table-condensed\"><tbody><tr class=\"odd\"><th>ID</th><td>"+customerId+"</td></tr><tr class=\"even\"><th>Имя</th><td>"+json.customer.customers_firstname+"</td></tr><tr class=\"odd\"><th>Фамилия</th><td>"+json.customer.customers_lastname+"</td></tr><tr class=\"even\"><th>E-mail</th><td>"+json.customer.customers_email_address+"</td></tr><tr class=\"odd\"><th>Телефон</th><td>"+json.customer.customers_telephone+"</tbody></table>"
                                + "<a href=\"' . Yii::app()->createUrl('/customers/edit/') . '"+customerId+"\" class=\"btn-small btn btn-info\" buttontype=\"link\"><i class=\"icon-user\"></i> Редактировать</a>"
                            );
                        });
                        bootbox.hideAll();
                    })()',
                ],
            ],
        ],
    ]
);
?>
<!--<script>
    jQuery(function($) {
        //console.log(jQuery("#whgrid"));
        jQuery("#whgrid").yiiGridView({
            "ajaxUpdate":["whgrid"],
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
                $("#whgrid").trigger("ajaxUpdate.editable");
                (function(){
                    $("#whgrid").trigger("ajaxUpdateTree");
                }).apply(this, arguments);
        }});
    });
</script>-->