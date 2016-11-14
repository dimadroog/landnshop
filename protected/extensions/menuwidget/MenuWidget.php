<?php
 
class MenuWidget extends CWidget
{
    public $layout = '';
 
    /**
     * Запуск виджета
     */
    public function run()
    {
        $this->render($this->layout);
    }
}