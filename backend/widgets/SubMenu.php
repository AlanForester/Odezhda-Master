<?php

class SubMenu extends CWidget {

    /**
     * Пункты бокового под-меню
     * @var null
     */
    public $submenu = null;

    public $hrTemplate = '<hr class="hr-condensed">';

    public function init() {

    }

    public function run() {
        echo '
            <div class="span2">
                <div id="sidebar" class="sidebar">' . $this->renderSubmenu() . '</div>
            </div>';
    }

    /**
     * Проверка, является ли текущий пункт под-раздела тактивным
     * @param array $item данные пункта меню
     * @param string $route текущий запрос из контроллера
     * @return bool
     */
    protected function isItemActive($item, $route) {
        //die(trim($item['url'][0], '/'));
        if (isset($item['url']) && is_array($item['url']) && strpos(trim($item['url'][0], '/'), $route) !== false) {

            unset($item['url']['#']);
            if (count($item['url']) > 1) {
                foreach (array_splice($item['url'], 1) as $name => $value) {
                    if (!isset($_GET[$name]) || $_GET[$name] != $value) {
                        return false;
                    }
                }
            }
            return true;
        }
        return false;
    }

    /**
     * Генерация html кода под-меню
     * @return null|string
     */
    public function renderSubmenu() {
        if ($this->submenu) {
            $route = $this->controller->getRoute();

            // определяем текущий активный пункт
            foreach ($this->submenu as $n => $item) {
                $this->submenu[$n]['active'] = $this->isItemActive($item, $route);
            }

            return
                '<h4 class="page-header">Подразделы:</h4>' .

                $this->widget(
                    'bootstrap.widgets.TbNav',
                    [
                        'htmlOptions' => [
                            'class' => 'nav-list nav',
                        ],
                        'items' => $this->submenu
                    ],
                    true
                );

            //$this->hrTemplate;
        }

        return null;
    }

}
