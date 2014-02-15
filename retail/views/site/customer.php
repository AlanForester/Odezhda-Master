<?php
Yii::app()->clientScript->registerPackage('product');
$this->breadcrumbs=array(
   'Личный кабинет',
);
$genders = [''=>'Не указан', 'm'=>'Мужчина', 'f'=>'Женщина'];
$yesNo = ['1'=>'Да', '0'=>'Нет'];
?>
<div class="wrapper">
    <div class="karta-wrap">
<?php
$form = $this->beginWidget(
    'CActiveForm',
    [
//                'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
        //'enableAjaxValidation' => true,
//        'action'=>$this->createUrl('customer/save'),
        'enableClientValidation' => true,
        'clientOptions' => [
            'validateOnSubmit' => true,
        ]
    ]

);?>
    <fieldset>
<!--        <legend>Личный кабинет</legend>-->
        <div class="row">
            <?php echo $form->labelEx($customer,'firstname');
                  echo $form->textField($customer,'firstname');
                  echo $form->error($customer,'firstname'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($customer,'middlename');
            echo $form->textField($customer,'middlename');
            echo $form->error($customer,'middlename'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($customer,'lastname');
            echo $form->textField($customer,'lastname');
            echo $form->error($customer,'lastname'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($customer,'password');
            echo $form->passwordField($customer,'password',['autocomplete' => 'off', 'value' => '']);
            echo $form->error($customer,'password'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($customer,'gender');
            echo $form->dropDownList($customer,'gender',$genders);
            echo $form->error($customer,'gender'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($customer,'dob');
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model'=>$customer,
                'attribute'=>'dob',
                'options'=>array(
                    'dateFormat'=>'dd/mm/yy',
                ),
            ));

//            echo $form->dateField($customer,'dob',['dateFormat'=>'dd/mm/yy',]);
            echo $form->error($customer,'dob');
            ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($customer,'email');
            echo $form->textField($customer,'email');
            echo $form->error($customer,'email'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($customer,'phone');
            echo $form->textField($customer,'phone');
            echo $form->error($customer,'phone'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($customer,'fax');
            echo $form->textField($customer,'fax');
            echo $form->error($customer,'fax'); ?>
        </div>
        <input type="hidden" name="form_action" value="save">
        <?php echo CHtml::submitButton('Сохранить изменения'); ?>

    </fieldset>
<?php $this->endWidget(); ?>
    </div>
</div>

