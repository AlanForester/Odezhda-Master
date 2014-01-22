<?php

class Grid extends CWidget {

    /**
     * Кнопки управления для контроллера
     * @var array
     */
    public $buttons = [];
    //public $pageButton = [];

    /**
     * Элементы фильтра
     * @var array
     */
    public $filter = [];

    /**
     * Контроллер страницы
     * @var
     */
    public $controller;

    public function init(){
        if ($this->controller){
            $this->controller->pageButton = $this->pageButton;
        }
    }

    public function run(){

        echo '
            <div class="span2">
                <div id="sidebar">'.$this->renderFilter().'</div>
            </div>
            <div class="span10">
                <div>'.$this->renderGrid().'</div>
            </div>
        ';
    }

    public function renderFilter(){
        return '<h4 class="page-header">Фильтр:</h4>';
    }

    public function renderGrid(){
        return 'grid';
    }

}