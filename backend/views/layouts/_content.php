<div class="container-fluid">
    <!-- BREADCRUMBS-->
    <?php if (isset($this->breadcrumbs)): ?>
        <?php $this->widget(
            'bootstrap.widgets.TbBreadcrumb',
            array(
                'links' => $this->breadcrumbs,
            )
        ); ?>
    <?php endif ?>

    <!--    <div class="page-header">-->
    <!--        <h1 class="page-title">--><?php //echo $this->pageTitle ?><!--</h1>-->
    <!--    </div>-->

    <div id="statusMsg">
        <?php
        $this->widget(
            'bootstrap.widgets.TbAlert',
            array(
                'block'=>true,
            ));
        ?>
    </div>

    <!-- CONTENT-->
    <div class="row-fluid">
        <div class="span12">
            <?= $content; ?>
        </div>
    </div>
</div>