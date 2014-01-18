<h1>Карточка пользователя</h1>
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
)); ?>

<fieldset>
    <?php echo $form->textFieldControlGroup($model, 'id', array('value'=>$user['id'],'disabled' => true)); ?>
    <?php echo $form->textFieldControlGroup($model, 'groups_id', array('value'=>$user['groups_id'])); ?>
    <?php echo $form->textFieldControlGroup($model, 'firstname', array('value'=>$user['firstname'])); ?>
    <?php echo $form->textFieldControlGroup($model, 'lastname', array('value'=>$user['lastname'])); ?>
    <?php echo $form->textFieldControlGroup($model, 'email_address', array('value'=>$user['email_address'])); ?>
    <?php echo $form->textFieldControlGroup($model, 'created', array('value'=>$user['created'], 'disabled' => true)); ?>
    <?php echo $form->textFieldControlGroup($model, 'modified', array('value'=>$user['modified'], 'disabled' => true)); ?>
    <?php echo $form->textFieldControlGroup($model, 'logdate', array('value'=>$user['logdate'], 'disabled' => true)); ?>
    <?php echo $form->textFieldControlGroup($model, 'lognum', array('value'=>$user['lognum'], 'disabled' => true)); ?>

</fieldset>

<?php echo TbHtml::formActions(array(
    TbHtml::submitButton('Сохранить изменения', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)),
    TbHtml::resetButton('Reset'),
)); ?>

<?php $this->endWidget(); ?>