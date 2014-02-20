<?php
/**
 * DateTimePicker widget class
 * исправление бага в WhDateTimePicker,
 * из-за которого не подгружались языки, кроме английского
 */
Yii::import('yiiwheels.widgets.datetimepicker.WhDateTimePicker');

class DateTimePicker extends WhDateTimePicker
{
    /**
     *
     * Registers required css js files
     */
    public function registerClientScript()
    {
        /* publish assets dir */
        $path = YiiBase::getPathOfAlias('yiiwheels.widgets.datetimepicker') . DIRECTORY_SEPARATOR . 'assets';
        $assetsUrl = $this->getAssetsUrl($path);

        /* @var $cs CClientScript */
        $cs = Yii::app()->getClientScript();

        $cs->registerCssFile($assetsUrl . '/css/bootstrap-datetimepicker.min.css');
        $cs->registerScriptFile($assetsUrl . '/js/bootstrap-datetimepicker.min.js', CClientScript::POS_END);
        if (isset($this->pluginOptions['language'])) {
            $cs->registerScriptFile(
                $assetsUrl . '/js/locales/bootstrap-datetimepicker.' . $this->pluginOptions['language'] . '.js',
                CClientScript::POS_END
            );
        }
        /* initialize plugin */
        $selector = null === $this->selector
            ? '#' . TbArray::getValue('id', $this->htmlOptions, $this->getId()) . '_datetimepicker'
            : $this->selector;

        $this->getApi()->registerPlugin('datetimepicker', $selector, $this->pluginOptions);

        if($this->events)
        {
            $this->getApi()->registerEvents($selector, $this->events);
        }
    }
}