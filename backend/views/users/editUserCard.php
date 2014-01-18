<?php
$this->pageTitle='Редактирование ['.$user['email_address'].']';
$this->pageButton = [
    [
        'label'=>'Сохранить',
        'icon'=>TbHtml::ICON_OK_SIGN,
        'buttonType'=>'link',
        'url'=>'/users/add',
        'type'=>'success',
        'htmlOptions'=>[
            'color' => TbHtml::BUTTON_COLOR_SUCCESS,
        ]
    ],


    [
        'label'=>'Применить',
        'icon'=>TbHtml::ICON_PLUS_SIGN,
        'buttonType'=>'link',
        'url'=>'/users/add',
        'type'=>'primary',
        'htmlOptions'=>[
            'color' => TbHtml::BUTTON_COLOR_PRIMARY,
        ]
    ],
    [
        'label'=>'Отмена',
        'icon'=>TbHtml::ICON_REMOVE_SIGN,
        'buttonType'=>'link',
        'url'=>'/users/add',
        'type'=>'danger',
        'htmlOptions'=>[
            'color' => TbHtml::BUTTON_COLOR_DANGER,
        ]
    ]
];
?>

<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
));?>

<fieldset>
    <?php echo $form->textFieldControlGroup($model, 'id', array('value'=>$user['id'],'disabled' => true)); ?>
    <?php echo $form->textFieldControlGroup($model, 'Группа', array('value'=>$user['groups_id'])); ?>
    <?php echo $form->textFieldControlGroup($model, 'Имя', array('value'=>$user['firstname'])); ?>
    <?php echo $form->textFieldControlGroup($model, 'Фамилия', array('value'=>$user['lastname'])); ?>
    <?php echo $form->textFieldControlGroup($model, 'Email', array('value'=>$user['email_address'])); ?>
    <?php echo $form->textFieldControlGroup($model, 'created', array('value'=>$user['created'], 'disabled' => true)); ?>
    <?php echo $form->textFieldControlGroup($model, 'modified', array('value'=>$user['modified'], 'disabled' => true)); ?>
    <?php echo $form->textFieldControlGroup($model, 'Последнее посещение', array('value'=>$user['logdate'], 'disabled' => true)); ?>
    <?php echo $form->textFieldControlGroup($model, 'Кол-во авторизаций', array('value'=>$user['lognum'], 'disabled' => true)); ?>

</fieldset>
<?php $this->endWidget(); ?>


<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
    //'class'=>'span5'
));?>
        <?php echo $form->textFieldControlGroup($model, 'created', array('value'=>$user['created'], 'disabled' => true)); ?>
        <?php echo $form->textFieldControlGroup($model, 'modified', array('value'=>$user['modified'], 'disabled' => true)); ?>
        <?php echo $form->textFieldControlGroup($model, 'Последнее посещение', array('value'=>$user['logdate'], 'disabled' => true)); ?>
        <?php echo $form->textFieldControlGroup($model, 'Кол-во авторизаций', array('value'=>$user['lognum'], 'disabled' => true)); ?>
<?php $this->endWidget(); ?>