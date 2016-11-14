<?php
 
class BlockWidget extends CWidget
{
    public $item = '';
 
    /**
     * Запуск виджета
     */
    public function run()
    {
        $alias = $this->item['alias'];
        $this->render($alias, array('item' => $this->item));
    }
}