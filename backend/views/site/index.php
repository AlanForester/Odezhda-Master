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
        <fieldset>
            <legend>Сейчас на сайте</legend>

        </fieldset>
    </div>

    <div class="span6">
        <fieldset>
            <legend>Новые пользователи</legend>
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
                            'header' => 'Имя',
                            'name' => 'firstname',
                        ],
                        [
                            'type' => 'text',
                            'header' => 'Фамилия',
                            'name' => 'lastname',
                        ],
                        [
                            'type' => 'text',
                            'header' => 'E-mail',
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

        </fieldset>
    </div>
</div>

<!--Вторая строка-->
<div class="row-fluid">
    <div class="span6">
        <fieldset>
            <legend>Новые заказы</legend>

        </fieldset>
    </div>

    <div class="span6">
        <fieldset>
            <legend>Новые товары</legend>

        </fieldset>
    </div>
</div>
</div>