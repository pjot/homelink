<?php
require dirname(__FILE__) . '/smarty/Smarty.class.php';
class MySmarty extends Smarty
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplateDir(ROOT . '/Templates');
        $this->setCacheDir(ROOT . '/Cache/Smarty/Cache');
        $this->setCompileDir(ROOT . '/Cache/Smarty/Compiled');
        $this->assign('baseUrl', BASE_URL);
    }
}
