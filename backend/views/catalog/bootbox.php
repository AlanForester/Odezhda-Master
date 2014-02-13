<?php
//todo откорректировать
// таблица
$this->widget(
    'backend.widgets.CompactGrid',
    [

        'pageSize' => $page_size,

        'dataProvider' => $this->gridDataProvider,

        'gridColumns' => [
        ],
    ]
);
