<?php
/**
 * @var BackendSiteController $this
 */
//$this->pageTitle=Yii::app()->name;
//if(Yii::app()->user->checkAccess('administrator')){
//            echo "hello, I'm administrator";
//        }

$this->pageTitle = 'Панель управления';
?>

<div id="dashboard">

<!--Первая строка-->
<div class="row-fluid">
    <div class="span6">
        <div class="widget-box transparent">
            <div class="widget-header widget-header-flat">
                <h4 class="lighter">
                    <i class="icon-star orange"></i>
                    Сейчас на сайте
                </h4>

                <!--                <div class="widget-toolbar">-->
                <!--                    <a data-action="collapse" href="#">-->
                <!--                        <i class="icon-chevron-up"></i>-->
                <!--                    </a>-->
                <!--                </div>-->
            </div>

            <div class="widget-body">
                <div class="widget-body-inner" style="display: block;">
                    <div class="widget-main no-padding">


                    </div>
                    <!-- /widget-main -->
                </div>
            </div>
            <!-- /widget-body -->
        </div>
    </div>

    <div class="span6">
        <div class="widget-box transparent">
            <div class="widget-header widget-header-flat">
                <h4 class="lighter">
                    <i class="icon-star orange"></i>
                    Новые пользователи
                </h4>

<!--                <div class="widget-toolbar">-->
<!--                    <a data-action="collapse" href="#">-->
<!--                        <i class="icon-chevron-up"></i>-->
<!--                    </a>-->
<!--                </div>-->
            </div>

            <div class="widget-body">
                <div class="widget-body-inner" style="display: block;">
                    <div class="widget-main no-padding">

                        <?php
                        $this->widget(
                            'yiiwheels.widgets.grid.WhGridView',
                            [
                                'id' => 'wh_users_grid',
                                //        'CssClass'=>'dataTables_wrapper',
                                'dataProvider' => $usersDataProvider,
                                'itemsCssClass' => 'table-bordered items',
                                //                                'fixedHeader' => true,
                                'responsiveTable' => true,
                                'template' => '{items}',
                                'type' => 'striped bordered',
                                'htmlOptions' => [
                                    'class' => 'grid-view dataTables_wrapper'
                                ],
                                'emptyText' => 'Нет данных для отображения',

                                'columns' => [
                                    [
                                        'type' => 'text',
                                        'header' => '<i class="icon-caret-right blue"></i>Имя',
                                        'name' => 'firstname',

//                                        'headerOptions'=>[
//                                            'icon'=>'icon-time'
//                                        ]
                                    ],
                                    [
                                        'type' => 'text',
                                        'header' => '<i class="icon-caret-right blue"></i>Фамилия',
                                        'name' => 'lastname',
                                    ],
                                    [
                                        'type' => 'text',
                                        'header' => '<i class="icon-caret-right blue"></i>E-mail',
                                        'name' => 'email',
                                    ],
                                    //                                    [
                                    //                                        'header' => 'Группа',
                                    //                                        'name' => 'group_id',
                                    //                                    ],
                                    //                                    [
                                    //                                        'header' => 'Последний визит',
                                    //                                        'name' => 'logdate',
                                    //                                    ],
                                    [
                                        'header' => 'Id',
                                        'name' => 'id',
                                    ],
                                ]
                            ]
                        )
                        ?>
                    </div>
                    <!-- /widget-main -->
                </div>
            </div>
            <!-- /widget-body -->
        </div>

<!--        <fieldset>-->
<!--            <legend>Новые пользователи</legend>-->
<!--            --><?php
//            $this->widget(
//                'yiiwheels.widgets.grid.WhGridView',
//                [
//                    'id' => 'wh_users_grid',
//                    //        'CssClass'=>'dataTables_wrapper',
//                    'dataProvider' => $usersDataProvider,
//                    'itemsCssClass' => 'table-bordered items',
//                    //                                'fixedHeader' => true,
//                    'responsiveTable' => true,
//                    'template' => '{items}',
//                    'type' => 'striped bordered',
//                    'htmlOptions' => [
//                        'class' => 'grid-view dataTables_wrapper'
//                    ],
//                    'emptyText' => 'Нет данных для отображения',
//
//                    'columns' => [
//                        [
//                            'type' => 'text',
//                            'header' => 'Имя',
//                            'name' => 'firstname',
//                        ],
//                        [
//                            'type' => 'text',
//                            'header' => 'Фамилия',
//                            'name' => 'lastname',
//                        ],
//                        [
//                            'type' => 'text',
//                            'header' => 'E-mail',
//                            'name' => 'email',
//                        ],
//                        //                                    [
//                        //                                        'header' => 'Группа',
//                        //                                        'name' => 'group_id',
//                        //                                    ],
//                        //                                    [
//                        //                                        'header' => 'Последний визит',
//                        //                                        'name' => 'logdate',
//                        //                                    ],
//                        [
//                            'header' => 'Id',
//                            'name' => 'id',
//                        ],
//                    ]
//                ]
//            )
//            ?>
<!---->
<!--        </fieldset>-->
    </div>
</div>

<!--Вторая строка-->
<div class="row-fluid">
    <div class="span6">
        <div class="widget-box transparent">
            <div class="widget-header widget-header-flat">
                <h4 class="lighter">
                    <i class="icon-star orange"></i>
                    Новые заказы
                </h4>

                <!--                <div class="widget-toolbar">-->
                <!--                    <a data-action="collapse" href="#">-->
                <!--                        <i class="icon-chevron-up"></i>-->
                <!--                    </a>-->
                <!--                </div>-->
            </div>

            <div class="widget-body">
                <div class="widget-body-inner" style="display: block;">
                    <div class="widget-main no-padding">


                    </div>
                    <!-- /widget-main -->
                </div>
            </div>
            <!-- /widget-body -->
        </div>
    </div>

    <div class="span6">
        <div class="widget-box transparent">
            <div class="widget-header widget-header-flat">
                <h4 class="lighter">
                    <i class="icon-star orange"></i>
                    Новые товары
                </h4>

                <!--                <div class="widget-toolbar">-->
                <!--                    <a data-action="collapse" href="#">-->
                <!--                        <i class="icon-chevron-up"></i>-->
                <!--                    </a>-->
                <!--                </div>-->
            </div>

            <div class="widget-body">
                <div class="widget-body-inner" style="display: block;">
                    <div class="widget-main no-padding">

                        <?php
                        $this->widget(
                            'yiiwheels.widgets.grid.WhGridView',
                            [
                                'id' => 'wh_users_grid',
                                //        'CssClass'=>'dataTables_wrapper',
                                'dataProvider' => $productsDataProvider,
                                'itemsCssClass' => 'table-bordered items',
                                //                                'fixedHeader' => true,
                                'responsiveTable' => true,
                                'template' => '{items}',
                                'type' => 'striped bordered',
                                'htmlOptions' => [
                                    'class' => 'grid-view dataTables_wrapper'
                                ],
                                'emptyText' => 'Нет данных для отображения',

                                'columns' => [
                                    [
                                        'type' => 'text',
                                        'header' => '<i class="icon-caret-right blue"></i>Название',
                                        'name' => 'name',

                                        //                                        'headerOptions'=>[
                                        //                                            'icon'=>'icon-time'
                                        //                                        ]
                                    ],
                                    [
                                        'type' => 'text',
                                        'header' => '<i class="icon-caret-right blue"></i>Цена',
                                        'name' => 'price',
                                    ],
//                                    [
//                                        'type' => 'text',
//                                        'header' => '<i class="icon-caret-right blue"></i>E-mail',
//                                        'name' => 'email',
//                                    ],
                                    //                                    [
                                    //                                        'header' => 'Группа',
                                    //                                        'name' => 'group_id',
                                    //                                    ],
                                    //                                    [
                                    //                                        'header' => 'Последний визит',
                                    //                                        'name' => 'logdate',
                                    //                                    ],
                                    [
                                        'header' => 'Id',
                                        'name' => 'id',
                                    ],
                                ]
                            ]
                        )
                        ?>


                    </div>
                    <!-- /widget-main -->
                </div>
            </div>
            <!-- /widget-body -->
        </div>
    </div>
</div>
</div>