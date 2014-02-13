<?php
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
                ],
            ],
            [
                'name' => 'lastname',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                ],
            ],
            [
                'name' => 'email',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                ],
            ],
            [
                'name' => 'phone',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
                ],
            ],
            [
                'name' => 'id',
                'headerHtmlOptions' => [
                ],
                'htmlOptions' => [
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